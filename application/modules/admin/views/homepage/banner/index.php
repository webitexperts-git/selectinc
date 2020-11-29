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
         Banner
      </h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="contents">
            <div class="row">
              <div class=" col-md-12">
                  <form method="POST" id="FormAddData" name="FormAddData" enctype="multipart/form-data" >
                    <div class="row">
                        <div class="col-md-9">
                          <div class="form-group">
                            <label for="email">Image:</label>
                            <input type="file" class="form-control" id="txtimage" name="txtimage" >
                          </div>
                          <div class="form-group">
                            <label for="email">Title:</label>
                            <input type="text" class="form-control" id="txttitle" name="txttitle" value="<?php if(!empty($data)){ echo $data->title; } ?>" >
                          </div>
                          <div class="form-group">
                            <label for="email">Description:</label>
                            <textarea class="form-control" id="txtdescription" name="txtdescription"> <?php if(!empty($data)){ echo $data->description; } ?> </textarea>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <img style="max-width: 100%" src="<?php if(!empty($data)){ echo base_url('assets/upload/home/').$data->image; }?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="email">Button-1 Text:</label>
                      <input type="text" class="form-control" id="txtbtn1text" name="txtbtn1text"  value="<?php if(!empty($data)){ echo $data->btn1; } ?>" >
                    </div>
                    <div class="form-group">
                      <label for="email">Button-2 Text:</label>
                      <input type="text" class="form-control" id="txtbtn2text" name="txtbtn2text"  value="<?php if(!empty($data)){ echo $data->btn2; } ?>" >
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
            url: '<?php echo base_url('admin/save-home-banner'); ?>',
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

    
  </script>
         
 
 

      
