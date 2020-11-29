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
         WHY CHOOSE
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

                <div class="maintitle">
                    <form id="FormSaveData" name="FormSaveData">
                      <div class="row">
                        <div class="col-md-10">
                          <div class="form-group">
                            <label for="email">Title:</label>
                            <input type="text" name="txtpagetitle" id="txtpagetitle" class="form-control" value="<?php if(!empty(get_pabe_settings())){echo get_pabe_settings()->whychoose_title; } ?>">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <label for="email">.</label>
                          <button type="submit" class="btn btn-primary btn-block">SAVE</button>
                        </div>
                        <div class="clearfix"></div>
                        <div id="tlmsg"></div>
                      </div>
                    </form>
                </div>

                 <div class="table-responsive">
                   <table class="table">
                      <thead>
                         <tr>
                           <th>#</th>
                           <th>IMAGE </th>
                           <th>TITLE </th>
                           <th>DESCRIPTION </th>
                           <th>EDIT</th>
                           <!-- <th>DELETE</th> -->
                         </tr>
                      </thead>
                      <?php 
                    if(!empty($datas)){
                      $count = 0;
                      foreach ($datas as $data) {
                       
                    ?>
                      <tr>
                        <td> <?php echo ++$count; ?></td>
                        <td> <img  style="height: 60px; width: 60px" src="<?php echo base_url('assets/upload/whychoose/').$data->image; ?>"></td>

                        
                        <td> <?php echo  $data->title   ?>  </td>
                        <td> <?php echo  $data->description   ?>  </td>

                        <td> <button  type='button' class='btn btn-primary btn-sm' onclick="bindEditData('<?php echo $data->choose_code ?>')"><i class="fa fa-pencil-square-o"></i> EDIT</button> </td>
                        <!-- <td> <button  type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modalDeleteData' data-id="<?php echo $data->id; ?>"  onclick="$('#txtdelid').val($(this).attr('data-id'))"  ><i class="fa fa-trash"></i> DELETE</button></td> -->
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
        <h4 class="modal-title">SAVE WHY CHOOSE</h4>
      </div>
      <div class="modal-body">
         <form method="POST" id="FormAddData" name="FormAddData" enctype="multipart/form-data" >
            <div class="form-group">
              <label for="email">Title:</label>
              <input type="text" class="form-control" id="txttitle" name="txttitle" >
              <input type="hidden" class="form-control" id="txtchoosecode" name="txtchoosecode" >
            </div>
            <div class="form-group">
              <label for="email">Description:</label>
              <textarea class="form-control" name="txtdescription" id="txtdescription"></textarea>
            </div>
            <div class="form-group">
              <label for="email">Image:</label>
              <input type="file" name="txtimage" id="txtimage" class="form-control">
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

 

 <script type="text/javascript"> 


   $('#FormSaveData').on('submit', function(e){       
        e.preventDefault();

        $('#tlmsg').removeClass(' alert alert-info');
        $('#tlmsg').removeClass(' alert alert-success');
        $('#tlmsg').removeClass(' alert alert-danger');

        

        $('#tlmsg').html('Please wait');
        $('#tlmsg').show().delay(5000).fadeOut();
        $('#tlmsg').addClass(' alert alert-info');
        // $('#myloader').show();
        $.ajax({
            url: '<?php echo base_url('admin/save-whychoose-title'); ?>',
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            async: true,
            success: function (data) { 

                $('#tlmsg').removeClass(' alert alert-info');
                if(data == "success"){
                    $('#tlmsg').html('Deleted successfully.');
                    $('#tlmsg').show().delay(5000).fadeOut();
                    $('#tlmsg').addClass(' alert alert-success');
                     location.reload();
                    return true;
                }

                if(data == "imageerror"){
                  $('#tlmsg').html('Banner image cannot be empty');
                  $('#tlmsg').show().delay(5000).fadeOut();
                  $('#tlmsg').addClass(' alert alert-danger');
                  return false;
                }

                if(data == "error"){
                  $('#tlmsg').html('Error to add, retry');
                  $('#tlmsg').show().delay(5000).fadeOut();
                  $('#tlmsg').addClass(' alert alert-danger');
                  return false;
                }

                $('#tlmsg').html(data);
                $('#tlmsg').show().delay(5000).fadeOut();
                $('#tlmsg').addClass(' alert alert-danger');
            }
        });
    });


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
            url: '<?php echo base_url('admin/save-whychoose'); ?>',
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

    function bindEditData(whychoose_code){
         $.ajax({
            url: '<?php echo base_url('admin/get-whychoose-detail'); ?>',
            type: "POST",
            data: {
              whychoose_code:whychoose_code
            },
            success: function (data) { 

              var retdata = JSON.parse(data);

              if(retdata['error'] == 'success'){
                $('#txtchoosecode').val(retdata['data'].choose_code)
                $('#txttitle').val(retdata['data'].title)
                $('#txtdescription').val(retdata['data'].description)
                $('#modalAddData').modal('show'); 
              }
            }
        });
    }

 

        
    
  </script>
         
 
 

      
