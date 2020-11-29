

<!-- Start Dashboard -->
<section class="Dashboard">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<?php include 'sidebar.php' ?>
			</div>
			<div class="col-md-9">
				<div class="DashboardContent">
					<div class="OpenTicket Box">
						<div class="BoxHeading">
							<h4>Edit Client Management</h4>
						</div>
						<div class="ClientManagement">
							<button type="button" class="btn bg-white btn-outline-primary"><img src="<?php echo base_url('assets/frontend/'); ?>images/teamwork.svg" alt="Icon"> All Clients</button>
							<button type="button" class="btn bg-white btn-outline-primary"><img src="<?php echo base_url('assets/frontend/'); ?>images/funnel.svg" alt="Icon"> Search / Filter</button>
							<button type="button" class="btn bg-white btn-outline-primary"><img src="<?php echo base_url('assets/frontend/'); ?>images/contact.svg" alt="Icon"> Add Client</button>
							<button type="button" class="btn bg-white btn-outline-primary"><img src="<?php echo base_url('assets/frontend/'); ?>images/import.svg" alt="Icon"> Import Client</button>
						</div>
						<div class="ModelMgmt">
							<div class="row">
								<div class="col-md-6">
									<div class="InputBox">
										<form>
											<div class="Form">
												<div class="row">
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Company Name</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Company Name" />
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Name</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Name" />
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Address Line 1</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Address Line 1" />
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Post Code</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Post Code" />
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Vat Number/TIN</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Vat Number/TIN" />
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Email</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Email" />
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Mobile No.</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Mobile No." />
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="col-md-6">
									<div class="InputBox">
										<form>
											<div class="Form">
												<div class="row">
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Client Fee</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Client Fee 0.3%" />
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Surname</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Surname" />
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Address Line 2</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Address Line 2" />
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">City</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="City" />
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Country</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Country" />
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Telephone</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Telephone" />
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Internal Notes</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Internal Notes" />
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>			
						</div>
						<div class="BoxHeading HeadingLeft">
							<h4>Other Shipping Address</h4>
						</div>
						<div class="ModelMgmt">
							<div class="row">
								<div class="col-md-6">
									<div class="InputBox">
										<form>
											<div class="Form">
												<div class="row">
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Company Name</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Company Name" />
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="col-md-6"></div>
								<div class="col-md-6">
									<div class="InputBox">
										<form>
											<div class="Form">
												<div class="row">
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Name</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Name" />
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Address Line 1</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Address Line 1" />
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Post Code</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Post Code" />
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="col-md-6">
									<div class="InputBox">
										<form>
											<div class="Form">
												<div class="row">
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Surname</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Surname" />
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">Address Line 2</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="Address Line 2" />
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<label for="usr">City</label>
														</div>
													</div>
													<div class="col-md-7">
														<div class="form-group">
															<input type="text" class="form-control" value="City" />
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>			
						</div>
						<div class="BtnBox">
							<button type="button" class="btn Save">Save</button>
							<button type="button" class="btn cancel">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Dashboard -->
