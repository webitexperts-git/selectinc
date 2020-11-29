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
         Degree
          <button data-toggle="modal" data-target="#modalAddData" class="btn btn-sm btn-primary pull-right"> ADD DEGREE </button>
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
                           <th>NAME </th>
                           <th>EDIT</th>
                           <th>DELETE</th>
                         </tr>
                      </thead>
                      <?php 
                    if(!empty($degrees)){
                      $count = 0;
                      foreach ($degrees as $data) {
                       
                    ?>
                      <tr>
                        <td> <?php echo ++$count; ?></td>
                        <td> <?php echo strip_tags($data->name)  ?>  </td>

                        <td> <button  type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#modalEditData' 
                          data-id="<?php echo $data->id; ?>"  
                          data-title="<?php echo base64_encode($data->name); ?>"  
                          onclick="
                          $('#txeditid').val($(this).attr('data-id')); 
                          $('#txeditttitle').val(atob($(this).attr('data-title'))); 
                          "><i class="fa fa-pencil-square-o"></i> EDIT</button> </td>
                        <td> <button  type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modalDeleteData' data-id="<?php echo $data->id; ?>"  onclick="$('#txtdelid').val($(this).attr('data-id'))"  ><i class="fa fa-trash"></i> DELETE</button></td>
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
        <h4 class="modal-title">Add Degree</h4>
      </div>
      <div class="modal-body">
         <form method="POST" id="FormAddData" name="FormAddData" enctype="multipart/form-data" >
            <div class="form-group">
              <label for="email">Name:</label>
              <input type="text" class="form-control" id="txttitle" name="txttitle" >
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
        <h4 class="modal-title">Edit Degree</h4>
      </div>
      <div class="modal-body">
         <form method="POST" id="FormEditData" name="FormEditData" enctype="multipart/form-data">
            <div class="form-group">
              <label for="title">Name:</label>
              <input type="hidden" class="form-control" id="txeditid" name="txeditid" >
              <input type="text" class="form-control" id="txeditttitle" name="txeditttitle" >
            </div>

              <div id="reteditmsg"></div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary text-uppercase">SAVE Industry</button>
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
            url: '<?php echo base_url('admin/add-degree'); ?>',
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
            url: '<?php echo base_url('admin/save-degree'); ?>',
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
          url: '<?php echo base_url('admin/delete-degree'); ?>',
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
         
 
 

      
