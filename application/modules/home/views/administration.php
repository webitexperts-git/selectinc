

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
							<h4>Administration </h4>
						</div>
					</div>
					<div class="SmallBox Administration">
						<div class="row">
							<div class="col-lg-4 col-md-2">
								<div class="Invoice Box">
									<div class="BoxHeading">
										<h6>Edit Rules</h6>
									</div>
									<div class="Booker">
										<button type="button" class="btn cancel">Booker - Only Add Deductions</button>
									</div>
									<div class="Booker">
										<button type="button" class="btn cancel">Accountant - Create and Export</button>
									</div>
									<div class="Booker">
										<button type="button" class="btn cancel">Administration - All Rights</button>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-2">
								<div class="Invoice Box">
									<div class="BoxHeading minmargin">
										<h6>Edit User</h6>
									</div>
									<div class="Booker minmargin">
										<button type="button" class="btn cancel">Accounting</button>
									</div>
									<div class="Booker minmargin">
										<button type="button" class="btn cancel">Secretary</button>
									</div>
									<div class="Booker minmargin">
										<button type="button" class="btn cancel">MWM Booker Paula</button>
									</div>
									<div class="Booker minmargin">
										<button type="button" class="btn cancel">MWM Booker Doreen</button>
									</div>
									<div class="Booker minmargin">
										<button type="button" class="btn cancel">MWM Booker Caroline</button>
									</div>
									<div class="Booker minmargin">
										<button type="button" class="btn cancel">MWM Booker Kathi</button>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-2">
								<div class="Invoice Box">
									<div class="BoxHeading">
										<h6>Edit My Infos</h6>
									</div>
									<p>
										Select Partners Inc Corregimiento, Obarrio, Calle 58 Este Y Calle 50 Edificio Office One piso 12 Panama, City Panama 
									</p>
									<div class="BtnBox Edit">
										<button type="button" class="btn">Save</button>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-2">
								<div class="Invoice Box">
									<div class="BoxHeading minmargin">
										<h6>Edit Footer and Header</h6>
									</div>
									<div class="HeaderFooter">
										<div class="upload-btn-wrapper">
											<button class="btn">Upload a file</button>
											<input type="file" id="HeaderFooter" multiple/>
										</div>
										<div class="image-preview"></div>
									</div>
									<div class="SaveButton">
										<button type="button" class="btn">Save</button>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-2">
								<div class="Invoice Box">
									<div class="BoxHeading minmargin">
										<h6>Edit Logo</h6>
									</div>
									<div class="HeaderFooter">
										<div class="upload-btn-wrapper">
											<button class="btn">Upload a file</button>
											<input type="file" id="HeaderFooter" multiple/>
										</div>
										<div class="image-preview"></div>
									</div>
									<div class="SaveButton">
										<button type="button" class="btn">Save</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Dashboard -->

<script type="text/javascript">
	let file_input = document.querySelector('#HeaderFooter');
	let image_preview = document.querySelector('.image-preview');

	const handle_file_preview = (e) => {
		let files = e.target.files;
		let length = files.length;

		for(let i = 0; i < length; i++) {
			let image = document.createElement('img');
      // use the DOMstring for source
      image.src = window.URL.createObjectURL(files[i]);
      image_preview.appendChild(image);
  }
}

file_input.addEventListener('change', handle_file_preview);

</script>
<!-- Start Footer -->


