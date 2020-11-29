<?php 

$soft_skill = get_soft_skill();
$applications = get_application_area();
$simulations = get_simulations_experience();
$software = get_software_experience();
$research_development = get_research_development_experience();
$physics = get_physics_experience();

$settings = get_pabe_settings();

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

.ratings i{
  color: #ff6600;
  margin-right: 4px;
}
.licls li{
  float: left;
  list-style: none;
  background-color: #dedede;
  color: #000;
  margin-left: 5px;
  margin-bottom: 5px;
  padding: 2px 5px;
}

ul.licls {
 
    padding-inline-start: 0px;
  }

  .btncont button{

    margin-top: -15px;
    margin-bottom: 5px;
  }


 
.radio-inline.mycustom, .checkbox-inline.mycustom {
     
    padding-left: 0px;
    color: #f00;
     
}
</style>


  <div class="content-wrapper">
  <div class="page-title">
    <div style="width: 100%">
      <h1 class="text-uppercase"> 
        FEATURED EXPERTS
        <!--   <button type="submit" class="btn btn-sm btn-primary pull-right"> SAVE MEET THE TALENTS </button> -->
      </h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="contents">
            <div class="row">
              <div class=" col-md-12">
               
                <div id="retmsg"></div>
                <form id="formmeetTalent" name="formmeetTalent">
                   <div class="form-group">
                      <label for="email">Title:</label>
                      <input type="text" class="form-control" id="txttitle" name="txttitle" value="<?php if(!empty($settings)){ echo $settings->featured_experts; } ?>" >
                    </div>

                   <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                             <th>
                             <!--  <label class="checkbox-inline">
                              <input type="checkbox" name="expertsmarkAll"><b> ALL</b></label> -->
                              #
                             </th>
                             <th>NAME </th>
                             <th>APPLICTION </th>
                             <th>SKILLS </th>
                             <th>RATINGS </th>
                             <th>JOB SUCCESS </th>
                              
                           </tr>
                        </thead>
                        <?php 
                      if(!empty($experts)){
                        $count = 0;
                        $selected_array = explode(",", $settings->selected_experts);
                        foreach ($experts as $expert) {
                          $checked = '';
                          if(in_array($expert->id, $selected_array)){
                            $checked = 'checked';
                          }
                         
                      ?>
                        <tr>
                          <td> 
                            <label class="checkbox-inline">
                              <!-- <input type="checkbox" name="expert_data[]" value="<?php echo $expert->id; ?>" /></label> -->
                              <label class="checkbox-inline mycustom">
                                <input <?php echo $checked ?> type="checkbox" name="expertschkbox[]" value="<?php echo $expert->id; ?>" id="<?php echo $expert->unique_code?>">MARK
                              </label>

                          </td>
                          <td> <?php echo $expert->name ." ". $expert->last_name;  ?>  
                          <div><small><b>(<?php echo $expert->designation; ?>)</b></small></div></td>
                          <td>
                           <ul class="licls">
                            <?php
                              if(!empty($applications)) {
                                $data_array = explode(",", $expert->application_area);
                                foreach ($applications as $data) {                              
                                  if(!empty($expert->application_area)){
                                    if(in_array($data->id, $data_array)){
                              ?>
                                      <li><?php echo $data->name;  ?></li>
                              <?php
                                     }
                                    }
                                  }
                                }
                            ?>
                           </ul>
                          </td>

                          <td>
                          <ul  class="licls">
                            <?php 
                            if(!empty($simulations)){
                              $selectedData = [];
                              if(!empty($expert)){
                                $selectedData = explode(",", $expert->simulations_experience);
                              }
                              foreach ($simulations as $data) {
                                 
                                if(in_array($data->id, $selectedData)){
                            ?>
                              <li><?php echo $data->name; ?></li>
                            <?php
                                }
                              }
                            }
                            ?>
                            <?php 
                            if(!empty($software)){
                                $selectedData = [];
                                if(!empty($expert)){
                                  $selectedData = explode(",", $expert->software_experience);
                                }
                                foreach ($software as $data) {                    
                                  if(in_array($data->id, $selectedData)){
                            ?>
                                  <li><?php echo $data->name; ?></li>
                            <?php
                                  }
                            
                                }
                              }
                             ?>

                          <?php 
                            if(!empty($research_development)){
                              $selectedData = [];
                              if(!empty($expert)){
                                $selectedData = explode(",", $expert->research_development_experience);
                              }
                              foreach ($research_development as $data) {                    
                                if(in_array($data->id, $selectedData)){
                          ?>
                                <li><?php echo $data->name; ?></li>
                          <?php
                                }
                          
                              }
                            }
                           ?>

                           <?php 
                            if(!empty($physics)){

                              $selectedData = [];
                              if(!empty($expert)){
                                $selectedData = explode(",", $expert->physics_experience);
                              }

                              foreach ($physics as $data) {                 
                                if(in_array($data->id, $selectedData)){
                          ?>
                          <li> <?php echo $data->name; ?></li>
                          <?php
                                }
                              }
                            }
                           ?> 

                           <?php 
                            if(!empty($soft_skill)){
                              $selectedData = [];
                              if(!empty($expert)){
                                $selectedData = explode(",", $expert->soft_skill);
                              }
                              foreach ($soft_skill as $data) {
                                
                                if(in_array($data->id, $selectedData)){
                          ?>
                                <li> <?php echo $data->name; ?></li>
                          <?php
                                }
                         
                              }
                            }
                           ?> 

                          </ul>
                          </td>

                          <td class="ratings">
                            <?php 
                              $mydata = get_overall_rating_for_expert($expert->id, 1);
                              for ($i=1; $i <= (int)$mydata; $i++) { 
                              echo '<i class="fa fa-star"></i>';
                              }
                              $checkpoint = explode('.', $mydata);

                              if(count($checkpoint) == 2){
                                echo '<i class="fa fa-star-half-o"></i>';
                              } 
                              for ($i= ceil($mydata)+1; $i <= 5 ; $i++) { 
                                echo '<i class="fa fa-star-o"></i>';
                              }
                            ?> 
                          </td>

                          <td><div class="JObSuccess">
                            <?php $success = get_expert_job_success($expert->id); ?>
                            <!-- <p><?php echo $success ?>%  </p>  -->
                            <?php echo $success ?>%
                            <div class="progress" style="height:8px;">
                              <div class="progress-bar" style="width:<?php echo $success ?>%;height:8px;"></div>
                            </div> 
                            </div>
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
                    <hr>
                    <div class="btncont">
                    <button type="submit" class="btn btn-sm btn-primary pull-right"> SAVE MEET THE TALENTS </button>
                  </div>
                  <!-- <hr> -->
                  <div class="clearfix"></div>

                </form>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>


 

 <script type="text/javascript"> 
    $('#formmeetTalent').on('submit', function(e){       
        e.preventDefault();

        $('#retmsg').removeClass(' alert alert-info');
        $('#retmsg').removeClass(' alert alert-success');
        $('#retmsg').removeClass(' alert alert-danger');

        

        $('#retmsg').html('Please wait');
        $('#retmsg').show().delay(5000).fadeOut();
        $('#retmsg').addClass(' alert alert-info');
        // $('#myloader').show();
        $.ajax({
            url: '<?php echo base_url('admin/talent-selection'); ?>',
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
         
 
 

      
