<?php 
// print_r($user_profile);
$searchtext = '';
if(!empty($_GET['search'])){
  $searchtext = $_GET['search'];
}
?>

<style type="text/css">
  .profileimgcont{
    margin-top: 5px;
  }
  .profileimgcont img{
    height: 90px;
    width: 100px;
    /*margin-top: 20px;*/
    border: 1px solid #ccc;
    padding: 2px;
  }

      .customdropdown .titleShow{
       border: 2px solid #cccccc;
    padding: 8px 12px;
    border-radius: 4px;
  }

  .subject-list{
      position: absolute;
    background-color: #fff;
    z-index: 999;
    width: 91.5%;
    padding: 10px;
    box-shadow: 0px 0px 5px #ccc;
    border-radius: 4px;
    height: 175px;
    overflow-y: auto;
    display: none;
  }

  .subject-list label{
    font-weight: normal;
  }

  .customdropdown:hover > .subject-list{
    display: block;
  }
  .stream, .subject-list{
    display: none;
  }

</style>

<div class="content-wrapper">
  <div class="page-title">
    <div style="width: 100%">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-uppercase"> 
              <i class="fa fa-user"></i> Edit User Profile
          </h1>
        </div>
        
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="contents">
            <div class="row">
              <div class="col-md-12">
                  <form id="adminprofile" name="adminprofile">
                    
                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                            <label for="email">First Name :</label>
                            <input type="text" class="form-control" id="txtfname" name="txtfname" value="<?php echo $user_profile->fname ?>">
                            <input type="hidden" class="form-control" id="txtuniqueid" name="txtuniqueid" value="<?php echo $user_profile->unique_code ?>">
                            <input type="hidden" class="form-control" id="txtuserid" name="txtuserid" value="<?php echo $user_profile->id ?>">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                            <label for="email">Last Name : </label>
                            <input type="text" class="form-control" id="txtlname" name="txtlname" value="<?php echo $user_profile->lname ?>">
                          </div>
                      </div>
                    
                      <div class="col-md-4">
                          <div class="form-group">
                            <label for="email">Contact No : </label>
                            <input type="text" class="form-control" id="txtcont1" name="txtcont1" value="<?php echo $user_profile->phone ?>">
                          </div>
                      </div>

                       
                    </div>

                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="text" class="form-control" id="txtemail" name="txtemail" value="<?php echo $user_profile->email ?>">
                          </div>
                      </div>

                      <div class="col-md-4">
                          <div class="form-group">
                            <label for="email">Profile Image :</label>
                            <input type="file" class="form-control" id="txtprofileimg" name="txtprofileimg">
                          </div>
                      </div> 

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="email">Selected Category :</label>
                          <div class="customdropdown">
                             <div class="titleShow">Select Home Category <i class=" pull-right fa fa-caret-down"></i></div>
                              <div class="subject-list">
                                <?php 
                                  if(!empty($user_profile->home_category)){                              
                                    $catArray = explode(",", $user_profile->home_category);
                                    foreach ($categories as $category) {
                                      $checked = "";
                                      if(in_array($category->id, $catArray)){
                                        $checked = "checked";
                                      }
                                ?>
                                <div>
                                  <label><input <?php echo $checked; ?> class="primary" type="checkbox" value="<?php echo $category->id; ?>" name="categories[]"> <?php echo $category->name; ?></label>
                                </div>
                                <?php                                   
                                    }
                                  }
                                ?> 
                              </div>
                          </div>
                        </div> 
                      </div>
                      


                    </div>

                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                            <label for="email">Address :</label>
                            <input type="text" class="form-control" id="txtaddress" name="txtaddress" value="<?php echo $user_profile->address ?>">
                          </div>
                      </div>

                      <div class="col-md-12">
                          <div class="form-group">
                            <label for="email">Landmark :</label>
                            <input type="text" class="form-control" id="txtlandmark" name="txtlandmark" value="<?php echo $user_profile->landmark ?>">
                          </div>
                      </div> 
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                          <div class="form-group">
                            <label for="email">City :</label>
                            <input type="text" class="form-control" id="txtcity" name="txtcity" value="<?php echo $user_profile->city ?>">
                          </div>
                      </div>

                      <div class="col-md-3">
                          <div class="form-group">
                            <label for="email">State :</label>
                            <input type="text" class="form-control" id="txtstate" name="txtstate" value="<?php echo $user_profile->state ?>">
                          </div>
                      </div> 

                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="email">Country :</label>
                            <input type="text" class="form-control" id="txtcountry" name="txtcountry" value="<?php echo $user_profile->country ?>">
                          </div>
                      </div> 

                      <div class="col-md-3">
                          <div class="form-group">
                            <label for="email">ZIP :</label>
                            <input type="text" class="form-control" id="txtzip" name="txtzip" value="<?php echo $user_profile->zip ?>">
                          </div>
                      </div> 
                    </div>
                   
                    <div class="row">
                      <div class="col-md-offset-3 col-md-6">
                          <div class="form-group">
                          <div id="retmsg"></div>
                          </div>
                      </div> 
                      <div class="clearfix"></div>
                      <div class="col-md-offset-3 col-md-6">
                          <div class="form-group">
                           <button type="submit" class="btn btn-primary btn-block">Save</button>
                          </div>
                      </div> 
                      <div class="clearfix"></div>
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
    
    $('#adminprofile').on('submit', function(e){       
        e.preventDefault();

        $('#retmsg').removeClass(' alert alert-info');
        $('#retmsg').removeClass(' alert alert-success');
        $('#retmsg').removeClass(' alert alert-danger');

        if($('#txtemail').val() == "" || $('#txtpassword').val() == "" ){
          $('#retmsg').html('Enter a valid Email and password');
          $('#retmsg').show().delay(3000).slideUp(1000);
          $('#retmsg').addClass(' alert alert-danger');
          return false;
        }

        $('#retmsg').html('Please wait');
        $('#retmsg').show().delay(5000).fadeOut();
        $('#retmsg').addClass(' alert alert-info');
        // $('#myloader').show();
        $.ajax({
            url: '<?php echo base_url('admin/save-profile'); ?>',
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            async: true,
            success: function (data) { 

                $('#retmsg').removeClass(' alert alert-info');

                if(data.indexOf("success#") >= 0){
                    $('#retmsg').html('Profile saved successfully.');
                    $('#retmsg').show().delay(5000).fadeOut();
                    $('#retmsg').addClass(' alert alert-success');                    
                    var redirect = "<?php echo base_url('admin/profile/') ?>"+ data.split('#')[1]+"/"+ $('#txtuniqueid').val();
                    window.location.href = redirect;
                    return true;
                }
                if(data == "error"){
                  $('#retmsg').html('Error to save data, retry');
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
         
 
 

      
    