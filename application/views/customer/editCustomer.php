<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-md" style="width: 30%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Update Vendor Details</b></h4>
			</div>
			<div class="modal-body">
				<form role="form" action="<?= customer_url('updateCustomer/' . $data->id) ?>" method="post">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="businessNameEdit"> Vendor Business Name <b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="businessName" id="businessNameEdit"
								   placeholder="Enter Business Name" value="<?= $data->businessName ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label for="einEdit"> EIN <b class="text-danger">*</b></label>
							<input class="form-control" type="number" min="0" step="1" maxlength="9" name="ein"
								   id="einEdit"
								   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
								   placeholder="Enter EIN" value="<?= $data->ein ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label for="businessAddressEdit"> Business Address <b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="businessAddress" id="businessAddressEdit"
								   placeholder="Enter Business Address" value="<?= $data->businessAddress ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label for="cityEdit"> City <b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="city" id="cityEdit"
								   placeholder="Enter City" value="<?= $data->city ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label for="stateEdit"> State <b class="text-danger">*</b></label>
							<select class="form-control input-sm" name="state" style="width: 100%"
									id="stateEdit" required>
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
						<div class="form-group col-md-6">
							<label for="zip"> Zip Code <b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="zip" id="zip"
								   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
								   placeholder="Enter Zip Code" maxlength="5" value="<?= $data->zip ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label for="businessLine1Edit">Business Line 1 <b class="text-danger">*</b></label><br>
							<select id="businessLine1Edit" style="width: 100%" class="businessLineEdit form-control"
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
						<div class="form-group col-md-6">
							<label for="service1Edit">Services 1 <b class="text-danger">*</b></label>
							<select id="service1Edit" name="service1" class="form-control" disabled required>
								<option value="" selected disabled>Select a Service</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="businessLine2Edit">Business Line 2 </label><br>
							<select id="businessLine2Edit" style="width: 100%" class="businessLineEdit form-control"
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
						<div class="form-group col-md-6">
							<label for="service2Edit">Services 2</label>
							<select id="service2Edit" name="service2" class="form-control" disabled>
								<option value="" selected disabled>Select a Service</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="businessLine3Edit">Business Line 3 </label><br>
							<select id="businessLine3Edit" style="width: 100%" class="businessLineEdit form-control"
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
						<div class="form-group col-md-6">
							<label for="service3Edit">Services 3</label>
							<select id="service3Edit" name="service3" class="form-control" disabled>
								<option value="" selected disabled>Select a Service</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="name"> Name<b class="text-danger">*</b> </label>
							<input class="form-control" type="text" name="name" id="name"
								   value="<?= $data->name ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label for="email"> Username <small class="text-danger"> [Leave it blank if not
									change]</small></label>
							<input class="form-control" type="email" name="username" id="emailEdit"
								   value="<?= $data->username ?>">
							<input type="hidden" name="type" id="typeEdit" value="<?= $data->type ?>">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="phone"> Phone <b class="text-danger">*</b></label>
							<input class="form-control" type="number" name="phone" id="phone"
								   min="0" step="1" maxlength="10"
								   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
								   value="<?= $data->phone ?>" required>
						</div>
					</div>
					<div class="form-group custom-checkbox">
						<label class="checkbox-inline">
							<input type="checkbox" value="checkbox" id="checkbox">Change Password
						</label>
					</div>
					<div class="row">
						<div class="form-group col-md-6 password">
							<label for="passwordEdit"> Password </label>
							<input type="password" class="form-control" name="password" id="passwordEdit"
								   placeholder="Password">

						</div>
						<div class="form-group col-md-6 password">
							<label for="passwordEdit1"> Confirm Password </label>
							<input type="password" class="form-control" name="password1" id="passwordEdit1"
								   placeholder="Retype password">
						</div>
					</div>
					<div class="box-footer">
						<div class="row">
							<div class="form-group col-md-12">
								<button type="submit" id="submitEdit" style="background-color: black; color: white;"
										class="btn btn-info pull-right">Update
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$('#stateEdit').select2({
			dropdownParent: $('#remoteModal1'),
			placeholder: "Select a state",
			allowClear: true
		});
		$('.businessLineEdit').select2({
			dropdownParent: $('#remoteModal1'),
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
	populateServices('#businessLine1Edit', '#service1Edit', '<?= $data->service1 ?>');
	populateServices('#businessLine2Edit', '#service2Edit', '<?= $data->service2 ?>');
	populateServices('#businessLine3Edit', '#service3Edit', '<?= $data->service3 ?>');

	var checkEmailEdit = 0;
	$('#emailEdit').on('keyup', function () {
		var email = $('#emailEdit').val();
		if (email != '') {
			$.ajax({
				url: "<?php echo customer_url('fetch_email'); ?>",
				method: "POST",
				data: {email: email},
				success: function (data) {
					if (data == 1) {
						checkEmailEdit = 1;
					} else {
						checkEmailEdit = 0;
					}
				}
			});
		} else {
			checkEmailEdit = 0;
		}
	});
	$('.password').hide();
	$("#checkbox").on('click', function () {
		if ($('[type="checkbox"]').is(":checked")) {
			$('.password').show();
			$('#passwordEdit').attr('required', true);
			$('#passwordEdit1').attr('required', true);
		} else {
			$('.password').hide();
			$('#passwordEdit').val('');
			$('#passwordEdit1').val('');
			$('#passwordEdit').attr('required', false);
			$('#passwordEdit1').attr('required', false);
		}
	});
	statusEdit = 0;
	$('#passwordEdit, #passwordEdit1').on('keyup', function () {
		var password = $('#passwordEdit1').val();
		if (password == $('#passwordEdit').val()) {
			statusEdit = 0;
		} else {
			statusEdit = 1;
		}
	});
	$('#submitEdit').on('click', function (e) {
		if (statusEdit == 1) {
			toastr.error('Password doesn\'t match!');
			e.preventDefault();
		}
		if (checkEmailEdit == 1) {
			toastr.error('Email already exist!');
			e.preventDefault();
		}
	});
</script>
