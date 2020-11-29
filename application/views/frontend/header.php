<!DOCTYPE html>
<html lang="en">
<head>
	<title>Select Inc.</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/style.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/responsive.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>plugin/bootstrap.min.css">
	<link rel="icon" href="<?php echo base_url('assets/frontend'); ?> assets/images/fav-icon.png" type="image/png" sizes="16x16"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="<?php echo base_url('assets/frontend/'); ?>script/script.js"></script>
	<script src="<?php echo base_url('assets/frontend/'); ?>plugin/jquery.min.js"></script>
	<script src="<?php echo base_url('assets/frontend/'); ?>plugin/popper.min.js"></script>
	<script src="<?php echo base_url('assets/frontend/'); ?>plugin/bootstrap.min.js"></script>
</head> 
<body>

	<!-- Start Header -->
	<section class="Header">
		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<div class="Logo">
						<a href="index.php"><img src="<?php echo base_url('assets/frontend/'); ?>images/logo.png" alt="Logo" /></a>
					</div>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-4">
					<div class="SearchInput">
						<form>
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Search" />
								<div class="input-group-append">
									<span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
								</div>
							</div>
						</form> 
					</div>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-2">
					<div class="HeaderOption">
						<ul>
							<li class="Notification"><a href="javascript:void(0)"data-toggle="collapse" data-target="#Setting"><i class="fa fa-cog" aria-hidden="true"></i></a>
								<div id="Setting" class="collapse HeaderCollapse"><div class="InnerNavigation">
									<div class="DashboardNavigation">
										<ul>
											<li><a href="javascript:void(0"><img src="<?php echo base_url('assets/frontend/'); ?>images/utilities.svg" alt="Icon"> Invoice </a></li>
											<li><a href="javascript:void(0"><img src="<?php echo base_url('assets/frontend/'); ?>images/money-back.svg" alt="Icon"> Refunds </a></li>
											<li><a href="javascript:void(0"><img src="<?php echo base_url('assets/frontend/'); ?>images/minus.svg" alt="Icon"> Deductions </a></li>
											<li><a href="javascript:void(0"><img src="<?php echo base_url('assets/frontend/'); ?>images/business-report.svg" alt="Icon"> Reports </a></li>
											<li><a href="javascript:void(0"><img src="<?php echo base_url('assets/frontend/'); ?>images/manager.svg" alt="Icon"> Administration </a></li>
										</ul>
									</div>
								</div>
								</div>
							</li>
							<li class="Notification"><a href="javascript:void(0)"data-toggle="collapse" data-target="#Notification"><i class="fa fa-bell" aria-hidden="true"></i> <span class="NotificationCount">+9</span></a>
								<div id="Notification" class="collapse HeaderCollapse">
									<div class="SingleNotification">
										<div class="row">
											<div class="col-3">
												<div class="NotificationImage">
													<img src="<?php echo base_url('assets/frontend/'); ?>images/2.jpg" alt="Notification Image" />
												</div>
											</div>
											<div class="col-9">
												<div class="NotificationAletText">
													<h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</h6>
													<p>1:00 AM <span>30/9/2020</span></p>
												</div>
											</div>
										</div>
									</div>
									<div class="SingleNotification">
										<div class="row">
											<div class="col-3">
												<div class="NotificationImage">
													<img src="<?php echo base_url('assets/frontend/'); ?>images/2.jpg" alt="Notification Image" />
												</div>
											</div>
											<div class="col-9">
												<div class="NotificationAletText">
													<h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</h6>
													<p>1:00 AM <span>30/9/2020</span></p>
												</div>
											</div>
										</div>
									</div>
									<div class="SingleNotification">
										<div class="row">
											<div class="col-3">
												<div class="NotificationImage">
													<img src="<?php echo base_url('assets/frontend/'); ?>images/2.jpg" alt="Notification Image" />
												</div>
											</div>
											<div class="col-9">
												<div class="NotificationAletText">
													<h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</h6>
													<p>1:00 AM <span>30/9/2020</span></p>
												</div>
											</div>
										</div>
									</div>
									<div class="SingleNotification">
										<div class="row">
											<div class="col-3">
												<div class="NotificationImage">
													<img src="<?php echo base_url('assets/frontend/'); ?>images/2.jpg" alt="Notification Image" />
												</div>
											</div>
											<div class="col-9">
												<div class="NotificationAletText">
													<h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</h6>
													<p>1:00 AM <span>30/9/2020</span></p>
												</div>
											</div>
										</div>
									</div>
									<div class="SingleNotification">
										<div class="row">
											<div class="col-3">
												<div class="NotificationImage">
													<img src="<?php echo base_url('assets/frontend/'); ?>images/2.jpg" alt="Notification Image" />
												</div>
											</div>
											<div class="col-9">
												<div class="NotificationAletText">
													<h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</h6>
													<p>1:00 AM <span>30/9/2020</span></p>
												</div>
											</div>
										</div>
									</div>
									<div class="SingleNotification">
										<div class="row">
											<div class="col-3">
												<div class="NotificationImage">
													<img src="<?php echo base_url('assets/frontend/'); ?>images/2.jpg" alt="Notification Image" />
												</div>
											</div>
											<div class="col-9">
												<div class="NotificationAletText">
													<h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</h6>
													<p>1:00 AM <span>30/9/2020</span></p>
												</div>
											</div>
										</div>
									</div>
									<div class="SingleNotification">
										<div class="row">
											<div class="col-3">
												<div class="NotificationImage">
													<img src="<?php echo base_url('assets/frontend/'); ?>images/2.jpg" alt="Notification Image" />
												</div>
											</div>
											<div class="col-9">
												<div class="NotificationAletText">
													<h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</h6>
													<p>1:00 AM <span>30/9/2020</span></p>
												</div>
											</div>
										</div>
									</div>
									<div class="SingleNotification">
										<div class="row">
											<div class="col-3">
												<div class="NotificationImage">
													<img src="<?php echo base_url('assets/frontend/'); ?>images/2.jpg" alt="Notification Image" />
												</div>
											</div>
											<div class="col-9">
												<div class="NotificationAletText">
													<h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</h6>
													<p>1:00 AM <span>30/9/2020</span></p>
												</div>
											</div>
										</div>
									</div>
									<div class="MarkAsRead">
										<a href="javascript:void(0)">Mark all as Read</a>
									</div>
								</div>
							</li>
							<li class="UserImage"><a href="javascript:void(0)"><img src="<?php echo base_url('assets/frontend/'); ?>images/2.jpg" alt="User Image" /> <span></span></a>
							</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
<!-- End Header -->
