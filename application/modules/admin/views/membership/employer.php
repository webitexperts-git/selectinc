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
</style>

<div class="content-wrapper">
  <div class="page-title">
    <div style="width: 100%">
      <h1 class="text-uppercase"> 
          Employer Membership
          <!-- <button data-toggle="modal" data-target="#modalAddData" class="btn btn-sm btn-primary pull-right"> ADD EMPLOYER MEM.SHIP</button> -->
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
                           <th>MAMBERSHIP NAME </th>
                           <th>PRICE</th>
                           <th>EXPERT FOR YOUR PROJECTS</th>   
                            <th> FINAL REPORT </th>                   
                           <th>% OFF SERVICE FEE</th>
                           <th>EDIT</th>
                           <!-- <th>DELETE</th> -->
                         </tr>
                      </thead>
                      <?php 
                    if(!empty($memberships)){
                      $count = 0;
                      foreach ($memberships as $membership) {
                       
                        $m_price = 'Free';
                        if($membership->price > 0){
                          $m_price = $membership->price;
                        }
 
                        $post_pro = 'Included';
                        if($membership->max_project != -1){
                          $post_pro = $membership->max_project. " / Projects";
                        }

                        $repo_pro = 'Included';
                        if($membership->final_report != -1){
                          $repo_pro = $membership->final_report. " / Projects";
                        }

                        $ser_price = 'Included';
                        if($membership->percentage_off != -1){
                          $ser_price = $membership->percentage_off;
                        }
                       
                    ?>
                      <tr>
                        <td> <?php echo ++$count; ?></td>
                        <td> <?php echo $membership->membership_name;  ?>  </td>
                        <td> $ <?php echo $m_price;  ?>  </td>
                        <td> <?php echo $post_pro;  ?> </td>
                        <td> <?php echo $repo_pro;  ?> </td>
                        <td> <?php echo $ser_price;  ?>  </td>

                        <td> <button  type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#modalEditData' 
                          data-id="<?php echo $membership->id; ?>"  
                          data-title="<?php echo base64_encode($membership->membership_name); ?>"  
                          data-max_project="<?php if($membership->max_project != -1) { echo $membership->max_project; }else{ echo 0; } ?>"  
                         data-max_project_chk="<?php if($membership->max_project == -1) { echo $membership->max_project; } ?>"  
                          
                          data-final_report="<?php if($membership->final_report != -1) { echo $membership->final_report; }else{ echo 0; } ?>" 

                          data-final_report_chk="<?php if($membership->final_report == -1) { echo $membership->final_report; } ?>"  
                          
                          data-price="<?php echo $membership->price; ?>"  
                          
                          data-off="<?php if($membership->percentage_off != -1) { echo $membership->percentage_off; } ?>"

                          data-off_chk="<?php if($membership->percentage_off == -1) { echo $membership->percentage_off; } ?>" 

                          onclick="
                          $('#txeditid').val($(this).attr('data-id')); 
                          $('#txteditmembershipname').val(atob($(this).attr('data-title'))); 
                          $('#txeditmax_project').val($(this).attr('data-max_project')); 
                          $('#txeditprice').val($(this).attr('data-price')); 
                          $('#txeditoff').val($(this).attr('data-off'));
                          $('#txteditfinal_report').val($(this).attr('data-final_report'));
                          
                          if($(this).attr('data-max_project_chk') == -1) { $('#chkunltpostedpro').prop('checked', true); } 
                          
                          if($(this).attr('data-final_report_chk') == -1) { $('#chkunltfinalreport').prop('checked', true); }

                          if($(this).attr('data-off_chk') == -1) { $('#chkunltoff').prop('checked', true); }

                          "><i class="fa fa-pencil-square-o"></i> EDIT</button> </td>
                        <!-- <td> <button  type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modalDeleteData' data-id="<?php echo $membership->id; ?>"  onclick="$('#txtdelid').val($(this).attr('data-id'))"  ><i class="fa fa-trash"></i> DELETE</button></td> -->
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



<div id="modalAddData" class="modal fade" role="dialog">
  <div class="modal-dialog">
 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Membership</h4>
      </div>
      <div class="modal-body">
         <form method="POST" id="FormAddData" name="FormAddData" enctype="multipart/form-data" >
            <div class="form-group">
              <label for="title">Membership Name:</label>
              <input type="text" class="form-control" id="txtmembershipname" name="txtmembershipname" >
            </div>

            <div class="form-group">
              <label for="title">Max Posted Projects:</label>
              <input type="number" min="1" class="form-control" id="txtmax_project" name="txtmax_project" >
            </div>

            <div class="form-group">
              <label for="title"> Price :</label>
              <input type="number" step="any" class="form-control" id="txtprice" name="txtprice" >
            </div>

             <div class="form-group">
              <label for="title">Final Report for Grammatical and Technical Inaccuracies:</label>
              <input type="number" min="1" class="form-control" id="txtfinal_report" name="txtfinal_report" >
            </div>


            <div class="form-group">
              <label for="title"> % Off :</label>
              <input type="number" step="any" class="form-control" id="txtoff" name="txtoff" >
            </div>

            <div id="retmsg"></div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">SUBMIT</button>
            </div>
          </form>
      </div>
  
    </div>

  </div>
</div>


<div id="modalEditData" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Membership</h4>
      </div>
      <div class="modal-body">
         <form method="POST" id="FormEditData" name="FormEditData" enctype="multipart/form-data">
            <div class="form-group">
              <label for="title">Membership Name:</label>
              <input type="hidden" class="form-control" id="txeditid" name="txeditid" >
              <input type="text" class="form-control" id="txteditmembershipname" name="txteditmembershipname" >
            </div>


            <div class="form-group">
                <div class="checkbox">
                  <label><input value="-1" type="checkbox" id="chkunltpostedpro" name="chkunltpostedpro" value="">Unlimited Posted Projects</label>
                </div> 
              <label for="title">Max Posted Projects:</label>
              <input type="number" min="0" class="form-control" id="txeditmax_project" name="txeditmax_project" >
            </div>

            <div class="form-group">
              <label for="title"> Price :</label>
              <input type="text" class="form-control" id="txeditprice" name="txeditprice" >
            </div>

            <div class="form-group">
                <div class="checkbox">
                  <label><input value="-1" type="checkbox" id="chkunltfinalreport" name="chkunltfinalreport" value="">Unlimited Projects Inaccuracies</label>
                </div> 
              <label for="title">Final Report for Grammatical and Technical Inaccuracies:</label>
              <input type="number" min="0" class="form-control" id="txteditfinal_report" name="txteditfinal_report" >
            </div>

            <div class="form-group">
                <div class="checkbox">
                  <label><input value="-1" type="checkbox" id="chkunltoff" name="chkunltoff" value="">Unlimited Projects</label>
                </div> 
              <label for="title"> % Off :</label>
              <input type="text" class="form-control" id="txeditoff" name="txeditoff" >
            </div>

              <div id="reteditmsg"></div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary text-uppercase">SAVE MEMBERSHIP</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>

 <div id="modalDeleteData" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form id="FormDeleteData" name="FormDeleteData">
        <div class="modal-body">
          <div class="create-new">
               <div class="col-md-12">
                  <h3 class="text-center"> Are you sure, you want to delete this Records? </h3>
                  <input type="hidden" name="txtdelid" id="txtdelid">
               </div>
               <div class="clearfix"></div>
           </div>
            <div id="retdeletemsg"></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"  id="save_btn">Delete</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>

  </div>
</div>

 <script type="text/javascript"> 
    $('#FormAddData').on('submit', function(e){       
        e.preventDefault();

        $('#retmsg').removeClass(' alert alert-info');
        $('#retmsg').removeClass(' alert alert-success');
        $('#retmsg').removeClass(' alert alert-danger');

        

        $('#retmsg').html('Please wait');
        $('#retmsg').show().delay(5000).fadeOut();
        $('#retmsg').addClass(' alert alert-info');
        // $('#myloader').show();
        $.ajax({
            url: '<?php echo base_url('admin/add-employer-membership'); ?>',
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            async: true,
            success: function (data) { 

                $('#retmsg').removeClass(' alert alert-info');
                if(data == "success"){
                    $('#retmsg').html('Added successfully.');
                    $('#retmsg').show().delay(5000).fadeOut();
                    $('#retmsg').addClass(' alert alert-success');
                     location.reload();
                    return true;
                }

                if(data == "imageerror"){
                  $('#retmsg').html('Banner image cannot be empty');
                  $('#retmsg').show().delay(5000).fadeOut();
                  $('#retmsg').addClass(' alert alert-danger');
                  return false;
                }

                if(data == "error"){
                  $('#retmsg').html('Error to add, retry');
                  $('#retmsg').show().delay(5000).fadeOut();
                  $('#retmsg').addClass(' alert alert-danger');
                  return false;
                }

                $('#retmsg').html(data);
                $('#retmsg').show().delay(5000).fadeOut();
                $('#retmsg').addClass(' alert alert-danger');
            }
        });
    });


    $('#FormEditData').on('submit', function(e){       
        e.preventDefault();

        $('#reteditmsg').removeClass(' alert alert-info');
        $('#reteditmsg').removeClass(' alert alert-success');
        $('#reteditmsg').removeClass(' alert alert-danger');
 
        $('#reteditmsg').html('Please wait');
        $('#reteditmsg').show().delay(5000).fadeOut();
        $('#reteditmsg').addClass(' alert alert-info');
        // $('#myloader').show();
        $.ajax({
            url: '<?php echo base_url('admin/save-employer-membership'); ?>',
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            async: true,
            success: function (data) { 

                $('#reteditmsg').removeClass(' alert alert-info');
                if(data == "success"){
                    $('#reteditmsg').html('Saved successfully.');
                    $('#reteditmsg').show().delay(5000).fadeOut();
                    $('#reteditmsg').addClass(' alert alert-success');
                     location.reload();
                    return true;
                }
 
                if(data == "error"){
                  $('#reteditmsg').html('Error to save, retry');
                  $('#reteditmsg').show().delay(5000).fadeOut();
                  $('#reteditmsg').addClass(' alert alert-danger');
                  return false;
                }

                $('#reteditmsg').html(data);
                $('#reteditmsg').show().delay(5000).fadeOut();
                $('#reteditmsg').addClass(' alert alert-danger');
            }
        });
    });


    $('#FormDeleteData').on('submit', function(e){       
      e.preventDefault();

      $('#retdeletemsg').removeClass(' alert alert-info');
      $('#retdeletemsg').removeClass(' alert alert-success');
      $('#retdeletemsg').removeClass(' alert alert-danger');

      $('#retdeletemsg').html('Please wait');
      $('#retdeletemsg').show().delay(5000).fadeOut();
      $('#retdeletemsg').addClass(' alert alert-info');
      // $('#myloader').show();
      $.ajax({
          url: '<?php echo base_url('admin/delete-employer-membership'); ?>',
          type: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          async: true,
          success: function (data) { 

              $('#retdeletemsg').removeClass(' alert alert-info');
              if(data == "success"){
                  $('#retdeletemsg').html('Deleted successfully.');
                  $('#retdeletemsg').show().delay(5000).fadeOut();
                  $('#retdeletemsg').addClass(' alert alert-success');
                   location.reload();
                  return true;
              }

              if(data == "error"){
                $('#retdeletemsg').html('Error to delete, retry');
                $('#retdeletemsg').show().delay(5000).fadeOut();
                $('#retdeletemsg').addClass(' alert alert-danger');
                return false;
              }
              
              $('#retdeletemsg').html(data);
              $('#retdeletemsg').show().delay(5000).fadeOut();
              $('#retdeletemsg').addClass(' alert alert-danger');
          }
      });
  });


    
  </script>
         
 
 

      
