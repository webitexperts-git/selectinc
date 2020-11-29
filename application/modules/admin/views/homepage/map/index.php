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
         MAP
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
                            <input type="text" name="txtpagetitle" id="txtpagetitle" class="form-control" value="<?php if(!empty(get_pabe_settings())){echo get_pabe_settings()->map_title; } ?>">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <label for="email">.</label>
                          <button type="submit" class="btn btn-primary btn-block">SAVE</button>
                        </div>
                        <div class="clearfix"></div>
                        <div id="retmsg"></div>
                      </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>


 

 <script type="text/javascript"> 
    $('#FormSaveData').on('submit', function(e){       
        e.preventDefault();

        $('#retmsg').removeClass(' alert alert-info');
        $('#retmsg').removeClass(' alert alert-success');
        $('#retmsg').removeClass(' alert alert-danger');

        

        $('#retmsg').html('Please wait');
        $('#retmsg').show().delay(5000).fadeOut();
        $('#retmsg').addClass(' alert alert-info');
        // $('#myloader').show();
        $.ajax({
            url: '<?php echo base_url('admin/save-map-title'); ?>',
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
         
 
 

      
