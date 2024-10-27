<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Update Profile</b></h3>
			</div>
			<form id="form" action="<?= vendor_url('update') ?>" method="post" enctype="multipart/form-data">
				<div class="panel panel-default">
					<label for="title" class="control-label">
						Business Information </label>
					<div class="panel-body">
						<div class="row">
							<div class="form-group col-md-2">
								<label for="name"> Name<b class="text-danger">*</b> </label>
								<input class="form-control" type="text" name="name" id="name"
									   value="<?= $data->name ?>" required>
							</div>
							<div class="form-group col-md-2">
								<label for="phone"> Phone <b class="text-danger">*</b></label>
								<input class="form-control" type="text" name="phone" id="phone"
									   value="<?= $data->phone ?>" required>
							</div>
							<div class="form-group col-md-2">
								<label for="businessName"> Vendor Business Name <b class="text-danger">*</b></label>
								<input class="form-control" type="text" name="businessName" id="businessName"
									   placeholder="Enter Business Name" value="<?= $data->businessName ?>" required>
							</div>
							<div class="form-group col-md-2">
								<label for="ein"> EIN <b class="text-danger">*</b></label>
								<input class="form-control" type="number" min="0" step="1" maxlength="9" name="ein"
									   id="ein"
									   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
									   placeholder="Enter EIN" value="<?= $data->ein ?>" required>
							</div>
							<div class="form-group col-md-2">
								<label for="businessAddress"> Business Address <b class="text-danger">*</b></label>
								<input class="form-control" type="text" name="businessAddress" id="businessAddress"
									   placeholder="Enter Business Address" value="<?= $data->businessAddress ?>"
									   required>
							</div>
							<div class="form-group col-md-2">
								<label for="city"> City <b class="text-danger">*</b></label>
								<input class="form-control" type="text" name="city" id="city"
									   placeholder="Enter City" value="<?= $data->city ?>" required>
							</div>
							<div class="form-group col-md-2">
								<label for="state"> State <b class="text-danger">*</b></label>
								<select class="form-control" name="state" style="width: 100%"
										id="state" required>
									<option value="">Select State</option>
									<!-- Default placeholder option -->
									<?php $states = [
											"Alabama - AL", "Alaska - AK", "Arizona - AZ", "Arkansas - AR",
											"California - CA", "Colorado - CO", "Connecticut - CT", "Delaware - DE",
											"District of Columbia - DC", "Florida - FL", "Georgia - GA", "Guam - GU",
											"Hawaii - HI", "Idaho - ID", "Illinois - IL", "Indiana - IN",
											"Iowa - IA", "Kansas - KS", "Kentucky - KY", "Louisiana - LA",
											"Maine - ME", "Maryland - MD", "Massachusetts - MA", "Michigan - MI",
											"Minnesota - MN", "Mississippi - MS", "Missouri - MO", "Montana - MT",
											"Nebraska - NE", "Nevada - NV", "New Hampshire - NH", "New Jersey - NJ",
											"New Mexico - NM", "New York - NY", "North Carolina - NC", "North Dakota - ND",
											"Ohio - OH", "Oklahoma - OK", "Oregon - OR", "Pennsylvania - PA", "Puerto Rico - PR",
											"Rhode Island - RI", "South Carolina - SC", "South Dakota - SD", "Tennessee - TN",
											"Texas - TX", "Utah - UT", "Vermont - VT", "Virginia - VA", "Virgin Islands - VI",
											"Washington - WA", "West Virginia - WV", "Wisconsin - WI", "Wyoming - WY"
									];
									foreach ($states as $state) {
										// Set the option as selected if it matches the stored state
										$selected = ($data->state == $state) ? 'selected' : '';
										echo "<option value='{$state}' {$selected}>{$state}</option>";
									}
									?>
								</select>
							</div>
							<div class="form-group col-md-2">
								<label for="zip"> Zip Code <b class="text-danger">*</b></label>
								<input class="form-control" type="text" name="zip" id="zip"
									   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
									   placeholder="Enter Zip Code" maxlength="5" value="<?= $data->zip ?>" required>
							</div>
							<div class="form-group col-md-2">
								<label for="businessLine1">Business Line 1 <b class="text-danger">*</b></label><br>
								<select id="businessLine1" style="width: 100%" class="businessLine form-control"
										name="businessLine1" required>
									<option value="" selected disabled>Select a Category</option>
									<option <?= $data->businessLine1 == 'Catering and Food Service' ? 'selected' : '' ?>
											value="Catering and Food Service">Catering and Food Service
									</option>
									<option <?= $data->businessLine1 == 'A/V and Technical Service' ? 'selected' : '' ?>
											value="A/V and Technical Service">A/V and Technical Service
									</option>
									<option <?= $data->businessLine1 == 'Event Décor and Design' ? 'selected' : '' ?>
											value="Event Décor and Design">Event Décor and Design
									</option>
									<option <?= $data->businessLine1 == 'Entertainment Services' ? 'selected' : '' ?>
											value="Entertainment Services">Entertainment Services
									</option>
									<option <?= $data->businessLine1 == 'Photography and Videography' ? 'selected' : '' ?>
											value="Photography and Videography">Photography and Videography
									</option>
									<option <?= $data->businessLine1 == 'Rentals and Equipment' ? 'selected' : '' ?>
											value="Rentals and Equipment">Rentals and Equipment
									</option>
									<option <?= $data->businessLine1 == 'Security and Safety Service' ? 'selected' : '' ?>
											value="Security and Safety Service">Security and Safety Service
									</option>
									<option <?= $data->businessLine1 == 'Stage Build' ? 'selected' : '' ?>
											value="Stage Build">Stage Build
									</option>
									<option <?= $data->businessLine1 == 'Transportation and Logistics' ? 'selected' : '' ?>
											value="Transportation and Logistics">Transportation and Logistics
									</option>
									<option <?= $data->businessLine1 == 'Marketing, Promotions and Advertising' ? 'selected' : '' ?>
											value="Marketing, Promotions and Advertising">Marketing, Promotions and
										Advertising
									</option>
									<option <?= $data->businessLine1 == 'Event Staffing' ? 'selected' : '' ?>
											value="Event Staffing">Event Staffing
									</option>
								</select>
							</div>
							<div class="form-group col-md-2">
								<label for="service1">Services 1 <b class="text-danger">*</b></label>
								<select id="service1" name="service1" class="form-control" disabled required>
									<option value="" selected disabled>Select a Service</option>
								</select>
							</div>
							<div class="form-group col-md-2">
								<label for="businessLine2">Business Line 2 </label><br>
								<select id="businessLine2" style="width: 100%" class="businessLine form-control"
										name="businessLine2">
									<option value="" selected disabled>Select a Category</option>
									<option <?= $data->businessLine2 == 'Catering and Food Service' ? 'selected' : '' ?>
											value="Catering and Food Service">Catering and Food Service
									</option>
									<option <?= $data->businessLine2 == 'A/V and Technical Service' ? 'selected' : '' ?>
											value="A/V and Technical Service">A/V and Technical Service
									</option>
									<option <?= $data->businessLine2 == 'Event Décor and Design' ? 'selected' : '' ?>
											value="Event Décor and Design">Event Décor and Design
									</option>
									<option <?= $data->businessLine2 == 'Entertainment Services' ? 'selected' : '' ?>
											value="Entertainment Services">Entertainment Services
									</option>
									<option <?= $data->businessLine2 == 'Photography and Videography' ? 'selected' : '' ?>
											value="Photography and Videography">Photography and Videography
									</option>
									<option <?= $data->businessLine2 == 'Rentals and Equipment' ? 'selected' : '' ?>
											value="Rentals and Equipment">Rentals and Equipment
									</option>
									<option <?= $data->businessLine2 == 'Security and Safety Service' ? 'selected' : '' ?>
											value="Security and Safety Service">Security and Safety Service
									</option>
									<option <?= $data->businessLine2 == 'Stage Build' ? 'selected' : '' ?>
											value="Stage Build">Stage Build
									</option>
									<option <?= $data->businessLine2 == 'Transportation and Logistics' ? 'selected' : '' ?>
											value="Transportation and Logistics">Transportation and Logistics
									</option>
									<option <?= $data->businessLine2 == 'Marketing, Promotions and Advertising' ? 'selected' : '' ?>
											value="Marketing, Promotions and Advertising">Marketing, Promotions and
										Advertising
									</option>
									<option <?= $data->businessLine2 == 'Event Staffing' ? 'selected' : '' ?>
											value="Event Staffing">Event Staffing
									</option>
								</select>
							</div>
							<div class="form-group col-md-2">
								<label for="service2">Services 2</label>
								<select id="service2" name="service2" class="form-control" disabled>
									<option value="" selected disabled>Select a Service</option>
								</select>
							</div>
							<div class="form-group col-md-2">
								<label for="businessLine3">Business Line 3 </label><br>
								<select id="businessLine3" style="width: 100%" class="businessLine form-control"
										name="businessLine3">
									<option value="" selected disabled>Select a Category</option>
									<option <?= $data->businessLine3 == 'Catering and Food Service' ? 'selected' : '' ?>
											value="Catering and Food Service">Catering and Food Service
									</option>
									<option <?= $data->businessLine3 == 'A/V and Technical Service' ? 'selected' : '' ?>
											value="A/V and Technical Service">A/V and Technical Service
									</option>
									<option <?= $data->businessLine3 == 'Event Décor and Design' ? 'selected' : '' ?>
											value="Event Décor and Design">Event Décor and Design
									</option>
									<option <?= $data->businessLine3 == 'Entertainment Services' ? 'selected' : '' ?>
											value="Entertainment Services">Entertainment Services
									</option>
									<option <?= $data->businessLine3 == 'Photography and Videography' ? 'selected' : '' ?>
											value="Photography and Videography">Photography and Videography
									</option>
									<option <?= $data->businessLine3 == 'Rentals and Equipment' ? 'selected' : '' ?>
											value="Rentals and Equipment">Rentals and Equipment
									</option>
									<option <?= $data->businessLine3 == 'Security and Safety Service' ? 'selected' : '' ?>
											value="Security and Safety Service">Security and Safety Service
									</option>
									<option <?= $data->businessLine3 == 'Stage Build' ? 'selected' : '' ?>
											value="Stage Build">Stage Build
									</option>
									<option <?= $data->businessLine3 == 'Transportation and Logistics' ? 'selected' : '' ?>
											value="Transportation and Logistics">Transportation and Logistics
									</option>
									<option <?= $data->businessLine3 == 'Marketing, Promotions and Advertising' ? 'selected' : '' ?>
											value="Marketing, Promotions and Advertising">Marketing, Promotions and
										Advertising
									</option>
									<option <?= $data->businessLine3 == 'Event Staffing' ? 'selected' : '' ?>
											value="Event Staffing">Event Staffing
									</option>
								</select>
							</div>
							<div class="form-group col-md-2">
								<label for="service3">Services 3</label>
								<select id="service3" name="service3" class="form-control" disabled>
									<option value="" selected disabled>Select a Service</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="w9Form"> W9 Form </label>
								<input class="form-control" type="file" name="w9Form" id="w9Form" accept="application/pdf"
									   placeholder="Select File Here">
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<label for="title" class="control-label">
						Banking Information </label>
					<div class="panel-body">
						<div class="row">
							<div class="form-group col-md-2">
								<label for="bankName"> Bank Name<b class="text-danger">*</b> </label>
								<input class="form-control" type="text" name="bankName" id="bankName"
									   value="<?= $data->bankName ?>" required>
							</div>
							<div class="form-group col-md-2">
								<label for="bankAddress"> Street Address <b class="text-danger">*</b> </label>
								<input class="form-control" type="text" name="bankAddress" id="bankAddress"
									   value="<?= $data->bankAddress ?>" required>
							</div>
							<div class="form-group col-md-2">
								<label for="bankCity"> City <b class="text-danger">*</b> </label>
								<input class="form-control" type="text" name="bankCity" id="bankCity"
									   value="<?= $data->bankCity ?>" required>
							</div>
							<div class="form-group col-md-2">
								<label for="bankState"> State <b class="text-danger">*</b> </label>
								<select class="form-control" name="bankState" style="width: 100%"
										id="bankState" required>
									<option value="">Select State</option>
									<!-- Default placeholder option -->
									<?php $states = [
											"Alabama - AL", "Alaska - AK", "Arizona - AZ", "Arkansas - AR",
											"California - CA", "Colorado - CO", "Connecticut - CT", "Delaware - DE",
											"District of Columbia - DC", "Florida - FL", "Georgia - GA", "Guam - GU",
											"Hawaii - HI", "Idaho - ID", "Illinois - IL", "Indiana - IN",
											"Iowa - IA", "Kansas - KS", "Kentucky - KY", "Louisiana - LA",
											"Maine - ME", "Maryland - MD", "Massachusetts - MA", "Michigan - MI",
											"Minnesota - MN", "Mississippi - MS", "Missouri - MO", "Montana - MT",
											"Nebraska - NE", "Nevada - NV", "New Hampshire - NH", "New Jersey - NJ",
											"New Mexico - NM", "New York - NY", "North Carolina - NC", "North Dakota - ND",
											"Ohio - OH", "Oklahoma - OK", "Oregon - OR", "Pennsylvania - PA", "Puerto Rico - PR",
											"Rhode Island - RI", "South Carolina - SC", "South Dakota - SD", "Tennessee - TN",
											"Texas - TX", "Utah - UT", "Vermont - VT", "Virginia - VA", "Virgin Islands - VI",
											"Washington - WA", "West Virginia - WV", "Wisconsin - WI", "Wyoming - WY"
									];
									foreach ($states as $state) {
										// Set the option as selected if it matches the stored state
										$selected = ($data->bankState == $state) ? 'selected' : '';
										echo "<option value='{$state}' {$selected}>{$state}</option>";
									}
									?>
								</select>
							</div>
							<div class="form-group col-md-2">
								<label for="bankZip"> Zip <b class="text-danger">*</b> </label>
								<input class="form-control" type="text" name="bankZip" id="bankZip"
									   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
									   placeholder="Enter Zip Code" maxlength="5" value="<?= $data->bankZip ?>"
									   required>
							</div>
							<div class="form-group col-md-2">
								<label for="accountName"> Account Name <b class="text-danger">*</b> </label>
								<input class="form-control" type="text" name="accountName" id="accountName"
									   value="<?= $data->accountName ?>" required>
							</div>
							<div class="form-group col-md-2">
								<label for="abaRouting"> ABA Routing # <b class="text-danger">*</b> </label>
								<input class="form-control" type="text" name="abaRouting" id="abaRouting"
									   value="<?= $data->abaRouting ?>" required>
							</div>
							<div class="form-group col-md-2">
								<label for="accountNumber"> Account Number<b class="text-danger">*</b> </label>
								<input class="form-control" type="text" name="accountNumber" id="accountNumber"
									   value="<?= $data->accountNumber ?>" required>
							</div>
							<div class="form-group col-md-2">
								<label for="accountType">Account Type <b class="text-danger">*</b></label><br>
								<label class="radio-inline">
									<input type="radio"
										   value="Checking" <?= $data->accountType == 'Checking' ? 'checked' : '' ?>
										   id="accountTypeChecking" name="accountType" required> Checking
								</label>
								<label class="radio-inline">
									<input type="radio"
										   value="Savings" <?= $data->accountType == 'Savings' ? 'checked' : '' ?>
										   id="accountTypeSavings" name="accountType" required> Savings
								</label>
							</div>
						</div>
						<div class="row">
							<label style="margin-left: 15px" class="form-group col-md-6 checkbox-inline">
								<input id="verify" type="checkbox" value="1" required>I verify that the Routing and
								Account Number entered is correct
							</label>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<label for="title" class="control-label">
						Login Details </label>
					<div class="panel-body">
						<div class="row">
							<div class="form-group col-md-3">
								<label for="email"> Business Email <small class="text-danger"> [Leave it blank if not
										change]</small></label>
								<input class="form-control" type="text" name="username" id="email"
									   value="<?= $data->username ?>">
								<input type="hidden" name="type" id="type" value="<?= $data->type ?>">
							</div>
							<div class="form-group col-md-3 password">
								<label for="password"> Password <small class="text-danger"> [Leave it blank if
										not
										change]</small></label>
								<input type="password" class="form-control" name="password" id="password"
									   placeholder="Password">

							</div>
							<div class="form-group col-md-3 password">
								<label for="password1"> Confirm Password </label>
								<input type="password" class="form-control" name="password1" id="password1"
									   placeholder="Retype password">
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="form-group col-md-12 text-center">
							<button type="submit" id="submit" class="btn btn-info">Update</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<style>
	.form-control {
		border-color: #007bff;
	}

	.form-control:focus {
		border-color: red;
	}

	.panel-default {
		background-color: #0E2231;
		color: white;
		border-color: #007bff;
		position: relative;
	}

	.control-label {
		position: absolute;
		top: -10px;
		left: 15px;
		background-color: #f8f9fa;
		padding: 0 5px;
		color: #007bff;
		font-size: 14px;
	}

	.radio-inline {
		margin-right: 15px; /* Space between radio buttons */
	}

	.form-group {
		margin-bottom: 15px; /* Space below the form group */
	}
</style>

<script>
	$(document).ready(function () {
		$('#state, #bankState').select2({
			placeholder: "Select a state",
			allowClear: true
		});
		$('#businessLine1, #businessLine2, #businessLine3').select2({
			placeholder: "Select a Category",
		});
	});
	var categoryData = {
		'Catering and Food Service': [
			'Food Trucks',
			'Specialty Food Vendors',
			'Beverage Service (alcoholic and non-alcoholic)'
		],
		'A/V and Technical Service': [
			'Audio/Visual Equipment Rental',
			'Lighting and Sound Technicians',
			'LED Screens',
			'Truss and Rigging Systems Structural (supports for lighting, screens, and equipment)'
		],
		'Event Décor and Design': [
			'Florists and Event Designers',
			'Balloon Artists and Custom Signage',
			'Themed Decor and Props'
		],
		'Entertainment Services': [
			'Musicians and Bands',
			'DJ’s and Sound Mixers',
			'Talent Buying'
		],
		'Photography and Videography': [
			'Event Photographers',
			'Videographers and Drone Operators',
			'Photo Booth Service'
		],
		'Rentals and Equipment': [
			'Tent, Table, and Chair Rentals',
			'Staging and Flooring Rentals',
			'Portable Restroom Service'
		],
		'Security and Safety Service': [
			'Event Security Personnel',
			'First Aid and Medical Service',
			'Crowd Control Service'
		],
		'Stage Build': [
			'Renderings',
			'Construction Backdrop & Scenic Walls',
			'Stage Play Set Builds'
		],
		'Transportation and Logistics': [
			'Travel Arrangements (Flights & Ground)',
			'Hotel Accommodations',
			'Shuttle Service and Event Transportation',
			'Freight and Equipment Movers',
			'Parking and Valet Service'
		],
		'Marketing, Promotions and Advertising': [
			'Social Media Management',
			'Event Branding and Design',
			'Merchandise Providers',
			'Media Buying & Placement (Radio/TV/Social)'
		],
		'Event Staffing': [
			'Bartenders and Servers',
			'Event Coordinators and On-site Managers',
			'Ticketing and guest Service Staff'
		]
	};

	function populateServices(businessLineSelector, serviceSelector, preselectedService) {
		$(businessLineSelector).on('change', function () {
			var selectedCategory = $(this).val();
			var serviceSelect = $(serviceSelector);

			serviceSelect.empty().append('<option value="" selected disabled>Select a Service</option>');

			if (selectedCategory) {
				serviceSelect.prop('disabled', false);
				var services = categoryData[selectedCategory];

				$.each(services, function (index, val) {
					serviceSelect.append('<option value="' + val + '">' + val + '</option>');
				});

				// Pre-select service if available in data (edit case)
				if (preselectedService) {
					serviceSelect.val(preselectedService);
				}
			} else {
				serviceSelect.prop('disabled', true);
			}
		});

		// Trigger change event to populate services if a category is already selected
		$(businessLineSelector).trigger('change');
	}

	// Apply function to each business line and service pair
	populateServices('#businessLine1', '#service1', '<?= $data->service1 ?>');
	populateServices('#businessLine2', '#service2', '<?= $data->service2 ?>');
	populateServices('#businessLine3', '#service3', '<?= $data->service3 ?>');

	var checkEmail = 0;
	$('#username').on('keyup', function () {
		var email = $('#username').val();
		if (email != '') {
			$.ajax({
				url: "<?php echo vendor_url('fetch_email'); ?>",
				method: "POST",
				data: {email: email},
				success: function (data) {
					if (data == 1) {
						checkEmail = 1;
					} else {
						checkEmail = 0;
					}
				}
			});
		}
	});

	var status = 0;
	$('#password, #password1').on('keyup', function () {
		var password = $('#password').val();
		if (password == $('#password1').val()) {
			status = 0;
		} else {
			status = 1;
		}
	});

	$('#submit').on('click', function (e) {
		if (status == 1) {
			toastr.error('Password doesn\'t match!');
			e.preventDefault();
		}
		if (checkEmail == 1) {
			toastr.error('Username already exist!');
			e.preventDefault();
		}
	});
</script>
