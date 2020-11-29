<!-- <!DOCTYPE html> -->

<?php 

$active_page = $this->uri->segment(2);
// print_r($this->session->userdata('admin')['image']);   

$profile_img = base_url('assets/admin/images/admin-profile.png');
if($this->session->userdata('admin')['image'] != ""){
  $profile_img = base_url('assets/admin/images/').$this->session->userdata('admin')['image'];
}  

?>

<style type="text/css">
  .submenu a{
    color: #fff;
  }

  .submenu.active{
    display: block;
  }
  .submenu{
    display: none;
  }
  .sidebar .user-panel>.image>img {
    width: 50px !important;
    max-width: 89px;
    height: 45px !important;
}
</style>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href=" logo.png" type="image/x-icon">
    <!-- CSS-->

    <title>PAANDUV |ADMIN </title>

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/css/main.css'); ?>">
    <script src="<?php echo base_url('assets/admin/js/jquery-2.1.4.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/plugins/pace.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/main.js'); ?>"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  
    <style>
        .logoTitle{
            font-size: 25px;
            text-align: center;
        }
        .note-editor.note-frame.panel.panel-default button{
            /*margin-right: 8px;*/
            padding: 5px 10px;
        }
    </style>
  </head>
  <body class="sidebar-mini fixed">
    <div class="wrapper">
    <header class="main-header hidden-print"><a class="logo text-uppercase" href="#"> PAANDUV
   </a>
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button--><a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
    <!-- Navbar Right Menu-->
    <div class="navbar-custom-menu">
      <ul class="top-nav">
        <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu">
            <!-- <li><a href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            <li><a href="page-user.html"><i class="fa fa-user fa-lg"></i> Profile</a></li> -->
            <li><a href="admin/logout"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
<!-- Side-Nav-->
<aside class="main-sidebar hidden-print">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
          <img class="img-circle" src="<?php echo $profile_img; ?>" alt="User Image">
          <!--<div class="logoTitle">GEEV</div>-->
        </div>
      <div class="pull-left info">
        <p>SUPER ADMIN</p>
        <p class="designation text-uppercase" style="color:#f7a95c ">PAANDUV </p>
      </div>
    </div>
    <!-- Sidebar Menu-->
    <ul class="sidebar-menu">

      <li class="<?php if($active_page == "dashboard"){ echo 'active'; } ?>"><a href="<?php echo base_url('admin/dashboard') ?>">
        <i class="fa fa-dashboard"></i><span>Dashboard</span></a>
      </li>

      <?php 
          $project_settings = ['users', 'experts-users', 'company-users'];
          
          $Active = "";
          $MenuOpen = "";
          $display = "";

          if(in_array($active_page, $project_settings)){
            $Active = "active";
            $MenuOpen = "menu-open";
            $display = "block";
          }

        ?>

      <li class="treeview <?php echo $Active; ?>">
        <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="app-menu__icon fa fa-users"></i>
          <span class="app-menu__label">Users</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu <?php echo $MenuOpen; ?>" style="display: <?php echo $display; ?> ">   
          <li><a class="treeview-item" href="<?php echo base_url('admin/users') ?>"><i class="icon fa fa-users"></i> All Users </a></li>       
          <li><a class="treeview-item" href="<?php echo base_url('admin/experts-users') ?>"><i class="icon fa fa-users"></i> Experts </a></li>
          <li><a class="treeview-item" href="<?php echo base_url('admin/company-users') ?>"><i class="icon fa fa-home"></i> Company </a></li>
        </ul>
      </li>

      <?php 
        $project_settings = ['jobs', 'pending-jobs', 'approved-jobs', 'rejected-jobs'];
        
        $Active = "";
        $MenuOpen = "";
        $display = "";

        if(in_array($active_page, $project_settings)){
          $Active = "active";
          $MenuOpen = "menu-open";
          $display = "block";
        }

      ?>

      <li class="treeview <?php echo $Active; ?>">
        <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="app-menu__icon fa fa-users"></i>
          <span class="app-menu__label">Jobs</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu <?php echo $MenuOpen; ?>" style="display: <?php echo $display; ?> ">   
          <li><a class="treeview-item" href="<?php echo base_url('admin/jobs') ?>"><i class="icon fa fa-users"></i> All Jobs </a></li>       
          <li><a class="treeview-item" href="<?php echo base_url('admin/pending-jobs') ?>"><i class="icon fa fa-users"></i> Pending Jobs </a></li>
          <li><a class="treeview-item" href="<?php echo base_url('admin/approved-jobs') ?>"><i class="icon fa fa-home"></i> Approved Jobs </a></li>
          <li><a class="treeview-item" href="<?php echo base_url('admin/rejected-jobs') ?>"><i class="icon fa fa-user"></i> Rejected Jobs </a></li>
        </ul>
      </li>


     <!--  <li class="treeview">
        <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="app-menu__icon fa fa-users"></i>
          <span class="app-menu__label">Profile</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">          
          <li><a class="treeview-item" href="<?php echo base_url('admin/users') ?>"><i class="icon fa fa-users"></i> All Profile </a></li>
          <li><a class="treeview-item" href="<?php echo base_url('admin/company') ?>"><i class="icon fa fa-home"></i> Company </a></li>
          <li><a class="treeview-item" href="<?php echo base_url('admin/experts') ?>"><i class="icon fa fa-user"></i> Expert </a></li>
        </ul>
      </li> -->

      

        <?php 
          $project_settings = ['application-area', 'physics-experience', 'project-length', 'project-visibility', 'research-development', 'simulations-experience', 'software-experience', 'soft-skill', 'timezone', 'industry', 'work', 'language', 'language-proficiency','degree', 'project-setings'];
          
          $Active = "";
          $MenuOpen = "";
          $display = "";

          if(in_array($active_page, $project_settings)){
            $Active = "active";
            $MenuOpen = "menu-open";
            $display = "block";
          }

        ?>

      <li class="treeview <?php echo $Active; ?>">
        <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="app-menu__icon fa fa-book"></i>
          <span class="app-menu__label">Project Settings</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>

        <ul class="treeview-menu <?php echo $MenuOpen; ?>" style="display: <?php echo $display; ?> ">  

          <li><a class="treeview-item" href="<?php echo base_url('admin/paanduv-service-fee') ?>"><i class="icon fa fa-caret-right"></i> Paanduv Service Fee </a></li>

          <!-- <li><a class="treeview-item" href="<?php echo base_url('admin/application-area') ?>"><i class="icon fa fa-caret-right"></i> Application Area </a></li> -->

          <li><a class="treeview-item" href="<?php echo base_url('admin/physics-experience') ?>"><i class="icon fa fa-caret-right"></i> Physics Experience </a></li>

          <li><a class="treeview-item" href="<?php echo base_url('admin/project-length') ?>"><i class="icon fa fa-caret-right"></i> Project Length </a></li>

          <li><a class="treeview-item" href="<?php echo base_url('admin/project-visibility') ?>"><i class="icon fa fa-caret-right"></i> Project Visibility </a></li>

          <li><a class="treeview-item" href="<?php echo base_url('admin/research-development') ?>"><i class="icon fa fa-caret-right"></i> Research & Development</a></li>

          <li><a class="treeview-item" href="<?php echo base_url('admin/simulations-experience') ?>"><i class="icon fa fa-caret-right"></i> Simulations Experience</a></li>

          <li><a class="treeview-item" href="<?php echo base_url('admin/software-experience') ?>"><i class="icon fa fa-caret-right"></i> Software Experience</a></li>

          <li><a class="treeview-item" href="<?php echo base_url('admin/soft-skill') ?>"><i class="icon fa fa-caret-right"></i> Soft Skill</a></li>

          <li><a class="treeview-item" href="<?php echo base_url('admin/timezone') ?>"><i class="icon fa fa-caret-right"></i> Timezone</a></li>

          <li><a class="treeview-item" href="<?php echo base_url('admin/industry') ?>"><i class="icon fa fa-caret-right"></i> Industries</a></li>

          <li><a class="treeview-item" href="<?php echo base_url('admin/work') ?>"><i class="icon fa fa-caret-right"></i> Work Type</a></li>

          <li><a class="treeview-item" href="<?php echo base_url('admin/language') ?>"><i class="icon fa fa-caret-right"></i> Language</a></li>

          <li><a class="treeview-item" href="<?php echo base_url('admin/language-proficiency') ?>"><i class="icon fa fa-caret-right"></i>Language Proficiency </a></li>

          <li><a class="treeview-item" href="<?php echo base_url('admin/degree') ?>"><i class="icon fa fa-caret-right"></i>Degree </a></li>   

          <li><a class="treeview-item" href="<?php echo base_url('admin/project-setings') ?>"><i class="icon fa fa-caret-right"></i> Settings </a></li>

        </ul>
      </li> 

      <li class="<?php if($active_page == "paanduv-test"){ echo 'active'; } ?>"><a href="<?php echo base_url('admin/paanduv-test') ?>">
        <i class="fa fa-pencil-square-o"></i><span>Test Link</span></a>
      </li>

      <?php 
        $project_settings = ['employer-membership', 'expert-membership'];
        
        $Active = "";
        $MenuOpen = "";
        $display = "";

        if(in_array($active_page, $project_settings)){
          $Active = "active";
          $MenuOpen = "menu-open";
          $display = "block";
        }

      ?>

      <li class="treeview <?php echo $Active; ?>">
        <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="app-menu__icon fa fa-users"></i>
          <span class="app-menu__label">Membership Plan</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu <?php echo $MenuOpen; ?>" style="display: <?php echo $display; ?> ">   
          <li><a class="treeview-item" href="<?php echo base_url('admin/employer-membership') ?>"><i class="icon fa fa-users"></i> Employer Membership Plan </a></li>       
          <li><a class="treeview-item" href="<?php echo base_url('admin/expert-membership') ?>"><i class="icon fa fa-users"></i>  Expert Membership Plan  </a></li>
        </ul>
      </li>


      <?php 
        $project_settings = ['home-banner', 'talent-agency', 'meet-talents', 'how-we-work', 'trusted-brand', 'client-say', 'publication', 'why-choose', 'map-title'];
        
        $Active = "";
        $MenuOpen = "";
        $display = "";

        if(in_array($active_page, $project_settings)){
          $Active = "active";
          $MenuOpen = "menu-open";
          $display = "block";
        }

      ?>

      <li class="treeview <?php echo $Active; ?>">
        <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="app-menu__icon fa fa-users"></i>
          <span class="app-menu__label">Home Page</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu <?php echo $MenuOpen; ?>" style="display: <?php echo $display; ?> ">   
          
          <li><a class="treeview-item" href="<?php echo base_url('admin/home-banner') ?>"><i class="icon fa fa-users"></i> Banner </a></li>   

          <!-- talent-agency  -->
          <li><a class="treeview-item" href="<?php echo base_url('admin/talent-agency') ?>"><i class="icon fa fa-users"></i> Open Projects</a></li>

           <li><a class="treeview-item" href="<?php echo base_url('admin/meet-talents') ?>"><i class="icon fa fa-users"></i>Featured Experts</a></li>

            <li><a class="treeview-item" href="<?php echo base_url('admin/how-we-work') ?>"><i class="icon fa fa-users"></i>How We Work</a></li>

            <li><a class="treeview-item" href="<?php echo base_url('admin/trusted-brand') ?>"><i class="icon fa fa-users"></i>Trusted Brand</a></li>

            <li><a class="treeview-item" href="<?php echo base_url('admin/client-say') ?>"><i class="icon fa fa-users"></i>Client Say</a></li>

            <li><a class="treeview-item" href="<?php echo base_url('admin/publication') ?>"><i class="icon fa fa-users"></i>Publication</a></li>

            <li><a class="treeview-item" href="<?php echo base_url('admin/why-choose') ?>"><i class="icon fa fa-users"></i>Why Choose</a></li>

             <li><a class="treeview-item" href="<?php echo base_url('admin/map-title') ?>"><i class="icon fa fa-users"></i>Map Title</a></li>

        </ul>
      </li>


      <?php 
        $project_settings = ['footer', 'social-icon'];
        
        $Active = "";
        $MenuOpen = "";
        $display = "";

        if(in_array($active_page, $project_settings)){
          $Active = "active";
          $MenuOpen = "menu-open";
          $display = "block";
        }

      ?>

      <li class="treeview <?php echo $Active; ?>">
        <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="app-menu__icon fa fa-users"></i>
          <span class="app-menu__label">Footer</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu <?php echo $MenuOpen; ?>" style="display: <?php echo $display; ?> ">   
          
          <li><a class="treeview-item" href="<?php echo base_url('admin/footer') ?>"><i class="icon fa fa-users"></i> Footer </a></li>   

          <li><a class="treeview-item" href="<?php echo base_url('admin/social-icon') ?>"><i class="icon fa fa-users"></i> Social Icons </a></li>   

         

        </ul>
      </li>
     
     
 

      
      <!-- <li class="treeview">
        <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="app-menu__icon fa fa-th-list"></i>
          <span class="app-menu__label">Portfolio</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">          
          <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i> Portfolio Category </a></li>
          <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i> Add Portfolio </a></li>
        </ul>
      </li>
 -->
      <!--<li class=""><a href="<?php echo base_url('admin/ad') ?>">-->
      <!--  <i class="fa fa-gift"></i><span>Ad</span></a>-->
      <!--</li>-->

      <!--<li class=""><a href="<?php echo base_url('admin/category') ?>">-->
      <!--  <i class="fa fa-bars"></i><span>Car Category</span></a>-->
      <!--</li>-->
      
      <!--<li class=""><a href="<?php echo base_url('admin/brand') ?>">-->
      <!--  <i class="fa fa-car"></i><span>Car Info</span></a>-->
      <!--</li>-->

      <!--<li class=""><a href="<?php echo base_url('admin/banner') ?>">-->
      <!--  <i class="fa fa-image"></i><span>Banners</span></a>-->
      <!--</li>-->
      
      <!--<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Pages</span><i class="treeview-indicator fa fa-angle-right"></i></a>-->
      <!--    <ul class="treeview-menu">-->
      <!--      <li><a class="treeview-item" href="<?php echo base_url('admin/home-page'); ?>"><i class="icon fa fa-circle-o"></i> Home Page </a></li>-->
      <!--      <li><a class="treeview-item" href="<?php echo base_url('admin/page-settings'); ?>"><i class="icon fa fa-circle-o"></i> Page Settings </a></li>-->
      <!--    </ul>-->
      <!--</li> -->
     
      <!-- <li class=""><a href="<?php echo base_url('admin/testimonials') ?>">-->
      <!--  <i class="fa fa-user"></i><span>Testimonials</span></a>-->
      <!--</li>-->



     <li class="<?php if($active_page == "newsletters"){ echo 'active'; } ?>"><a href="<?php echo base_url('admin/newsletters') ?>"> <i class="fa fa-cog"></i><span>Newsletter Subscription</span></a> </li>
      
      <li class="<?php if($active_page == "blog"){ echo 'active'; } ?>"><a href="<?php echo base_url('admin/blog') ?>">
        <i class="fa fa-cog"></i><span>Blogs</span></a>
      </li>
      

      <?php 
          $project_settings = ['company-info', 'about-paanduv', 'how-paanduv-work', 'why-paanduv', 'work-agreement', 'payment-protection', 'pricing'];
          
          $Active = "";
          $MenuOpen = "";
          $display = "";

          if(in_array($active_page, $project_settings)){
            $Active = "active";
            $MenuOpen = "menu-open";
            $display = "block";
          }

        ?>

      <li class="treeview <?php echo $Active; ?>">
        <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="app-menu__icon fa fa-home"></i>
          <span class="app-menu__label">Company Info</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu <?php echo $MenuOpen; ?>" style="display: <?php echo $display; ?> ">  
          <li><a class="treeview-item" href="<?php echo base_url('admin/about-paanduv') ?>"><i class="icon fa fa-home"></i> About Paanduv </a></li>       
          <li><a class="treeview-item" href="<?php echo base_url('admin/how-paanduv-work') ?>"><i class="icon fa fa-home"></i> How Paanduv Work </a></li>
          <li><a class="treeview-item" href="<?php echo base_url('admin/why-paanduv') ?>"><i class="icon fa fa-home"></i> Why Paanduv </a></li>
          <li><a class="treeview-item" href="<?php echo base_url('admin/work-agreement') ?>"><i class="icon fa fa-home"></i> Work Agreement </a></li>
          <li><a class="treeview-item" href="<?php echo base_url('admin/payment-protection') ?>"><i class="icon fa fa-home"></i> Payment Protection </a></li>
          <li><a class="treeview-item" href="<?php echo base_url('admin/pricing') ?>"><i class="icon fa fa-home"></i> Pricing </a></li>
        </ul>
      </li>



      <li class="<?php if($active_page == "profile"){ echo 'active'; } ?>"><a href="<?php echo base_url('admin/profile') ?>">
        <i class="fa fa-cog"></i><span>Profile Settings</span></a>
      </li>

      <li class="<?php if($active_page == "change-password"){ echo 'active'; } ?>"><a href="<?php echo base_url('admin/change-password') ?>">
        <i class="fa fa-key"></i><span>Change Password</span></a>
      </li>

      <li><a href="<?php echo base_url('admin/logout') ?>">
        <i class="fa fa-sign-out"></i><span>Logout</span></a>
      </li>
       
    </ul>
  </section> 
</aside>

<script type="text/javascript">
  $(function(){
      $('.mainmenu').click(function(){
          $('.submenu').removeClass(' active').slideUp();
          $(this).find('ul.submenu').addClass(' active').slideToggle();
      })
  })

</script>