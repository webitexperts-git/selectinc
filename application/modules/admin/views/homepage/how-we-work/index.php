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
         How We Work
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
                            <label for="email">Main Title:</label>
                            <input type="text" class="form-control" id="main_title" name="main_title" value="<?php if(!empty($data)){ echo $data->main_title; } ?>" >
                          </div>
                          <div class="form-group">
                            <label for="email">Image1:</label>
                            <input type="file" class="form-control" id="image1" name="image1" >
                          </div>
                           <div class="form-group">
                            <label for="email">Image1:</label>
                            <input type="file" class="form-control" id="image2" name="image2" >
                          </div> 
                          <div class="form-group">
                            <label for="email">Title 1:</label>
                            <input type="text" class="form-control" id="title1" name="title1" value="<?php if(!empty($data)){ echo $data->title1; } ?>" >
                          </div>
                           <div class="form-group">
                            <label for="email">Title 2:</label>
                            <input type="text" class="form-control" id="title2" name="title2" value="<?php if(!empty($data)){ echo $data->title2; } ?>" >
                          </div>
                          <div id="retmsg"></div>
                          <div class="text-center">
                            <button type="submit" class="btn btn-primary">SUBMIT</button>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div>
                            <?php            
                              $imgext = ['jpg', 'png', 'jpeg'];
                              $vdoext = ['mp4', 'avi', 'mpeg'];
                              
                              if(!empty($data->image1)){
                                $extarray = explode(".", $data->image1); 
                                $ext = end($extarray);
                              }

                              $url = base_url('assets/upload/home/').$data->image1;
                              if(in_array($ext, $vdoext)){
                              ?>
                              <video width="100%" controls>
                                <source src="<?php echo $url; ?>" type="video/mp4">
                              </video>
                              <?php
                              }
                              else if(in_array($ext, $imgext)){
                              ?>
                              <img style="max-width: 100%"  src="<?php echo $url; ?>" alt="How I Work Image" />
                              <?php
                              }           
                            ?> 
                          </div>
                          <br>
                          <div>
                            <?php            
                              $imgext = ['jpg', 'png', 'jpeg'];
                              $vdoext = ['mp4', 'avi', 'mpeg'];
                              
                              if(!empty($data->image2)){
                                $extarray = explode(".", $data->image2); 
                                $ext = end($extarray);
                              }

                              $url = base_url('assets/upload/home/').$data->image2;
                              if(in_array($ext, $vdoext)){
                              ?>
                              <video width="100%" controls>
                                <source src="<?php echo $url; ?>" type="video/mp4">
                              </video>
                              <?php
                              }
                              else if(in_array($ext, $imgext)){
                              ?>
                              <img style="max-width: 100%"  src="<?php echo $url; ?>" alt="How I Work Image" />
                              <?php
                              }           
                            ?> 
                          </div>
                        </div>
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
            url: '<?php echo base_url('admin/save-how-we-work'); ?>',
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
         
 
 

      
