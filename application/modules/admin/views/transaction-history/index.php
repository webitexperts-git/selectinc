<?php 
// print_r($category);
?>

<style type="text/css">
  .profileimgcont{
    margin-top: 25px;
  }
  .profileimgcont img{
    border: 1px solid #e1e1e1;
    padding: 2px;
    max-height: 125px;
  }
  .btn-primary {
    color: #fff;
    background-color: #337ab7;
    border-color: #2e6da4;
}
.btn-primary:hover {
    color: #fff;
    background-color: #286090;
    border-color: #204d74;
}

table.table tr th, table.table tr td {
  /*font-style: 15px;*/
}

</style>

<div class="content-wrapper">
  <div class="page-title">
    <div style="width: 100%">
      <h1 class="text-uppercase"> 
         Transaction History
          <!-- <button data-toggle="modal" data-target="#modalAddData" class="btn btn-sm btn-primary pull-right"> ADD DEGREE </button> -->
      </h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="contents">
            <div class="row">
              <div class=" col-md-12">
                 <div class="table-responsive">
                   <table class="table">
                      <thead>
                         <tr>
                           <th>#</th>
                           <th>TRANSACTION ID </th>
                           <th>PROJECT DETAIL</th>
                           <!-- <th>PROJECT TYPE</th> -->
                           <!-- <th>CURRENCY</th> -->
                           <th>AMOUNT</th>
                           <th>SERVICE FEE</th>
                           <th>PAY TO EXPERT</th>
                           <!-- <th>PAID AMOUNT</th> -->
                           <th>STATUS</th>
                           <th>CREATION DATE</th>
                           <th>PAYOUT</th>
                         </tr>
                      </thead>
                      <?php 
                    if(!empty($transactions)){
                      $count = 0;
                      $currncy_data = array( 'USD' => '$', 'INR' => '₹');
                      foreach ($transactions as $transaction) {
                        $project_type = '-';
                        
                        $service_fee = ($transaction->payment_gross * $transaction->service_fee)/100;
                        $pay_to_expert = $transaction->payment_gross - $service_fee;

                        if($transaction->type == 1){
                          $project_type = 'Fixed (Milestone)';
                        }
                        if($transaction->type == 2){
                          $project_type = 'Fixed (Project)';
                        }
                        if($transaction->type == 3){
                          $project_type = 'Hourly';
                        }
                        
                        $color = '#d40505';
                        if($transaction->admin_paid == 1){
                          $color = '#21710d';
                        }
                       
                    ?>
                      <tr style="color: <?php echo $color ?>">
                        <td> <?php echo ++$count; ?></td>
                        <td> <?php echo $transaction->txn_id  ?> </td>
                        <td title="<?php echo $transaction->title; ?>"> 
                          <?php echo substr($transaction->title, 0, 20)  ?> 
                          <div><small>ID : <?php echo $transaction->project_code  ?> </small></div>
                          <div><small><?php echo $project_type  ?></small></div>
                        </td>
                        <!-- <td> <?php echo $project_type  ?>  </td>                         -->
                        <!-- <td> <?php echo $transaction->mc_currency  ?> </td> -->

                        <td> <?php echo $currncy_data[$transaction->mc_currency].''.$transaction->payment_gross  ?> </td>

                        <td> <?php echo $currncy_data[$transaction->mc_currency].''.$service_fee.'('.(int)$transaction->service_fee .'%)' ?> </td>
                        <td> <?php echo $currncy_data[$transaction->mc_currency].''.$pay_to_expert;  ?> </td>
                        <td> <?php echo ucwords(strtolower($transaction->payment_status)) ; ?> </td>
                        <td> 
                          <?php echo date('d M, Y', strtotime($transaction->creation_date)) ; ?> 
                          <div><small><b><?php echo date('h:i A', strtotime($transaction->creation_date)) ; ?> </b></small></div>
                        </td>

                        <td> 
                          <?php 
                          if($transaction->admin_paid != 1){
                            if($transaction->milestone_status == 3){
                                if($transaction->mc_currency == 'USD'){
                          ?>
                            <button onclick="payUSDamount(<?php echo $transaction->expert_id; ?>, <?php echo $service_fee; ?>, <?php echo $pay_to_expert; ?>, <?php echo $transaction->payment_gross; ?>, <?php echo $transaction->milestone_id; ?>)" class="btn btn-sm btn-primary btn-block">RELEASE </button>
                            <?php 
                              }
                              else{
                            ?>
                             <button onclick="modalRealeaseINR(<?php echo $transaction->expert_id; ?>, <?php echo $service_fee; ?>, <?php echo $pay_to_expert; ?>, <?php echo $transaction->payment_gross; ?>, <?php echo $transaction->milestone_id; ?>)" class="btn btn-sm btn-primary btn-block">RELEASE </button>
                            <?php
                              }
                            }
                          }
                          else{
                          ?>
                          <button class="btn btn-sm btn-danger btn-block">COMPLETED </button>
                          <?php
                          }
                          ?>
                        </td>
 
                      </tr>
                    <?php
                      }
                    }else{
                    ?>
                      
                    <?php
                    }
                    ?>
                   </table>
                 </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

 

<div id="modalRealeaseUSD" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Release Amount </h4>
      </div>
      <div class="modal-body">
         <form method="POST" id="formReleaseUSDamount" name="formReleaseUSDamount" enctype="multipart/form-data">
            
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="title">Expert Code:</label>
                  <input type="hidden" class="form-control" id="txtmilestoneid" name="txtmilestoneid" >
                  <input type="text" class="form-control" id="txtexpertcode" name="txtexpertcode" >
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="title">First Name:</label>
                  <input type="text" class="form-control" id="txtfname" name="txtfname" >
                </div>
              </div>
               <div class="col-md-4">
                <div class="form-group">
                  <label for="title">Last Name:</label>
                  <input type="text" class="form-control" id="txtlname" name="txtlname" >
                </div>
              </div>
            </div>
            
            
            <div class="form-group">
              <label for="title">Email id:</label>
              <input type="text" class="form-control" id="txtemail" name="txtemail" >
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="title">Service Fee($):</label>
                  <input type="text" class="form-control" id="txtservicefee" name="txtservicefee" >
                </div>
              </div>
 
              <div class="col-md-4"> 
                <div class="form-group">
                  <label for="title">Payable Amount to Expert($):</label>
                  <input type="text" class="form-control" id="txtexpertamount" name="txtexpertamount" >
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="title">Total Amount($):</label>
                  <input type="text" class="form-control" id="txtamount" name="txtamount" >
                </div>
              </div>
            </div>
              <div class="form-group">
                <label for="title">Payal Id:</label>
                <input type="text" class="form-control" id="txtpaypalid" name="txtpaypalid" >
              </div>
            <div class="form-group">
              <label for="title">Paypal Transaction Id:</label>
              <input type="text" class="form-control" id="txtbnrefno" name="txtbnrefno" >
            </div>

              <div id="dispmsg"></div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary text-uppercase">PAY AMOUNT</button>
              </div> 
          </form>
      </div>
    </div>
  </div>
</div>


<div id="modalRealeaseINR" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Release Amount </h4>
      </div>
      <div class="modal-body">
         <form method="POST" id="formReleaseINRamount" name="formReleaseINRamount" enctype="multipart/form-data">
            
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="title">Expert Code:</label>
                  <input type="hidden" class="form-control" id="txtmilestoneidinr" name="txtmilestoneidinr" >
                  <input type="text" class="form-control" id="txtexpertcodeinr" name="txtexpertcodeinr" >
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="title">First Name:</label>
                  <input type="text" class="form-control" id="txtfnameinr" name="txtfnameinr" >
                </div>
              </div>
               <div class="col-md-4">
                <div class="form-group">
                  <label for="title">Last Name:</label>
                  <input type="text" class="form-control" id="txtlnameinr" name="txtlnameinr" >
                </div>
              </div>
            </div>
            
            
            <div class="form-group">
              <label for="title">Email id:</label>
              <input type="text" class="form-control" id="txtemailinr" name="txtemailinr" >
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="title">Service Fee(₹):</label>
                  <input type="text" class="form-control" id="txtservicefeeinr" name="txtservicefeeinr" >
                </div>
              </div>
 
              <div class="col-md-4"> 
                <div class="form-group">
                  <label for="title">Payable Amount to Expert(₹):</label>
                  <input type="text" class="form-control" id="txtexpertamountinr" name="txtexpertamountinr" >
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="title">Total Amount(₹):</label>
                  <input type="text" class="form-control" id="txtamountinr" name="txtamountinr" >
                </div>
              </div>
            </div>

              <div class="form-group">
                <label for="title">Bank Name:</label>
                <input type="text" class="form-control" id="txtbanknameinr" name="txtbanknameinr" >
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Account No:</label>
                    <input type="text" class="form-control" id="txtacountnoinr" name="txtacountnoinr" >
                  </div>
                </div>

                <div class="col-md-6">
                   <div class="form-group">
                    <label for="title">IFSC Code:</label>
                    <input type="text" class="form-control" id="txtifsccodeinr" name="txtifsccodeinr" >
                  </div>
                </div>
              </div>

              <div id="dispmsginr"></div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary text-uppercase">PAY AMOUNT</button>
              </div> 
          </form>
      </div>
    </div>
  </div>
</div>


 

 <script type="text/javascript"> 
  
  function payUSDamount(expert_id, service_fee, pay_to_expert, total_amount, milstone_id){
    $.ajax({
        url: '<?php echo base_url('admin/profile-for-payout'); ?>',
        type: "POST",
        data: {
          expert_id : expert_id,
          type : 0
        },
        success: function (data) { 

          var ret_data = JSON.parse(data);
          if(ret_data['error'] == 'success'){
              $('#txtexpertid').val(ret_data['data'].id);
              $('#txtexpertcode').val(ret_data['data'].unique_code);
              $('#txtfname').val(ret_data['data'].name);
              $('#txtlname').val(ret_data['data'].last_name);
              $('#txtemail').val(ret_data['data'].email);
              $('#txtpaypalid').val(ret_data['data'].paypal_username);
              $('#txtamount').val(total_amount);
              $('#txtmilestoneid').val(milstone_id);
              $('#txtservicefee').val(service_fee);
              $('#txtexpertamount').val(pay_to_expert);

              $('#modalRealeaseUSD').modal('show');
              return true;
          }
          else if(ret_data['error'] == 'error'){
            $('#dispmsg').html('No Paypal Detail Found');
            $('#dispmsg').addClass('alert alert-danger');
             return true;
          }

          $('#dispmsg').html(ret_data['data']);
          $('#dispmsg').addClass('alert alert-danger');

        }
    });
  }


  function modalRealeaseINR(expert_id, service_fee, pay_to_expert, total_amount, milstone_id){
    $.ajax({
        url: '<?php echo base_url('admin/profile-for-payout'); ?>',
        type: "POST",
        data: {
          expert_id : expert_id,
          type : 1
        },
        success: function (data) { 

          var ret_data = JSON.parse(data);
          if(ret_data['error'] == 'success'){
              $('#txtexpertidinr').val(ret_data['data'].id);
              $('#txtexpertcodeinr').val(ret_data['data'].unique_code);
              $('#txtfnameinr').val(ret_data['data'].name);
              $('#txtlnameinr').val(ret_data['data'].last_name);
              $('#txtemailinr').val(ret_data['data'].email);
              $('#txtamountinr').val(total_amount);
              $('#txtmilestoneidinr').val(milstone_id);
              $('#txtservicefeeinr').val(service_fee);
              $('#txtexpertamountinr').val(pay_to_expert);

              $('#txtbanknameinr').val(ret_data['data'].bank_name);
              $('#txtacountnoinr').val(ret_data['data'].account_no);
              $('#txtifsccodeinr').val(ret_data['data'].ifsc);

              $('#modalRealeaseINR').modal('show');
              return true;
          }
          else if(ret_data['error'] == 'error'){
            $('#dispmsg').html('No Paypal Detail Found');
            $('#dispmsg').addClass('alert alert-danger');
             return true;
          }

          $('#dispmsg').html(ret_data['data']);
          $('#dispmsg').addClass('alert alert-danger');

        }
    });
  }




  $('#formReleaseUSDamount').on('submit', function(e){       
      e.preventDefault();

      $('#dispmsg').removeClass(' alert alert-info');
      $('#dispmsg').removeClass(' alert alert-success');
      $('#dispmsg').removeClass(' alert alert-danger');

      

      $('#dispmsg').html('Please wait');
      $('#dispmsg').show().delay(5000).fadeOut();
      $('#dispmsg').addClass(' alert alert-info');
      // $('#myloader').show();
      $.ajax({
          url: '<?php echo base_url('admin/usd-payout-transfer'); ?>',
          type: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          async: true,
          success: function (data) { 
             
            if(data == 'success'){
              $('#dispmsg').html('Successfully paid.');
              $('#dispmsg').show().delay(5000).fadeOut();
              $('#dispmsg').addClass(' alert alert-success');
              location.reload();
              return true;
            }
            if(data == 'paid'){
              $('#dispmsg').html('Already paid.');
              $('#dispmsg').show().delay(5000).fadeOut();
              $('#dispmsg').addClass(' alert alert-danger');
              return true;
            }
            if(data == 'error'){
              $('#dispmsg').html('Error to paid amount');
              $('#dispmsg').show().delay(5000).fadeOut();
              $('#dispmsg').addClass(' alert alert-danger');
              return true;
            }
            $('#dispmsg').html(data);
            $('#dispmsg').show().delay(5000).fadeOut();
            $('#dispmsg').addClass(' alert alert-danger');
            
          }
      });
  });


  $('#formReleaseINRamount').on('submit', function(e){       
          
      e.preventDefault();

      $('#dispmsginr').removeClass(' alert alert-info');
      $('#dispmsginr').removeClass(' alert alert-success');
      $('#dispmsginr').removeClass(' alert alert-danger');

      $('#dispmsginr').html('Please wait');
      $('#dispmsginr').show().delay(5000).fadeOut();
      $('#dispmsginr').addClass(' alert alert-info');
      // $('#myloader').show();
      $.ajax({
          url: '<?php echo base_url('admin/inr-payout-transfer'); ?>',
          type: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          async: true,
          success: function (data) { 
             
            if(data == 'success'){
              $('#dispmsginr').html('Successfully paid.');
              $('#dispmsginr').show().delay(5000).fadeOut();
              $('#dispmsginr').addClass(' alert alert-success');
              location.reload();
              return true;
            }
            if(data == 'paid'){
              $('#dispmsginr').html('Already paid.');
              $('#dispmsginr').show().delay(5000).fadeOut();
              $('#dispmsginr').addClass(' alert alert-danger');
              return true;
            }
            if(data == 'error'){
              $('#dispmsginr').html('Error to paid amount');
              $('#dispmsginr').show().delay(5000).fadeOut();
              $('#dispmsginr').addClass(' alert alert-danger');
              return true;
            }
            $('#dispmsginr').html(data);
            $('#dispmsginr').show().delay(5000).fadeOut();
            $('#dispmsginr').addClass(' alert alert-danger');
            
          }
      });
  });

    
  </script>
         
 
 

      
