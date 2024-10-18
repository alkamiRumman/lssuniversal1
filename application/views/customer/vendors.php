<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-body" style="background: black">
				<div class="row">
					<div class="col-md-12 text-center">
						<img class="responsive-img" src="<?= base_url('images/3.png') ?>" alt="User Image">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Add New Vendor</b></h3>
			</div>
			<div class="box-body">
				<form role="form" action="<?= customer_url('saveCustomer') ?>" method="post" autocomplete="off">
					<div class="row">
						<div class="form-group col-md-2">
							<label for="businessName"> Vendor Business Name <b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="businessName" id="businessName"
								   placeholder="Enter Business Name" required>
						</div>
						<div class="form-group col-md-1">
							<label for="ein"> EIN <b class="text-danger">*</b></label>
							<input class="form-control" type="number" min="0" step="1" maxlength="9" name="ein" id="ein"
								   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
								   placeholder="Enter EIN" required>
						</div>
						<div class="form-group col-md-3">
							<label for="businessAddress"> Business Address <b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="businessAddress" id="businessAddress"
								   placeholder="Enter Business Address" required>
						</div>
						<div class="form-group col-md-2">
							<label for="city"> City <b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="city" id="city"
								   placeholder="Enter City" required>
						</div>
						<div class="form-group col-md-2">
							<label for="state"> State <b class="text-danger">*</b></label>
							<select class="form-control input-sm" name="state" style="width: 100%"
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
									echo "<option value='{$state}'>{$state}</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label for="zip"> Zip Code <b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="zip" id="zip"
								   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
								   placeholder="Enter Zip Code" maxlength="5" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-2">
							<label for="name"> Name <b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="name" id="name"
								   placeholder="Enter Point of Contact" required>
						</div>
						<div class="form-group col-md-2">
							<label for="username"> Username <b class="text-danger">*</b></label>
							<input class="form-control" type="email" name="username" id="username"
								   placeholder="Enter POC Business E-mail" required>
						</div>
						<div class="form-group col-md-2">
							<label for="phone"> Phone <b class="text-danger">*</b></label>
							<input class="form-control" type="number" name="phone" id="phone"
								   placeholder="Enter POC or Business Number" required>
							<input type="hidden" name="type" value="Vendor">
						</div>
						<div class="form-group col-md-2">
							<label for="businessLine1">Business Line 1 <b class="text-danger">*</b></label>
							<select id="businessLine1" class="businessLine form-control" name="businessLine1" required>
								<option value="" selected disabled>Select a Category</option>
								<option value="Catering and Food Service">Catering and Food Service</option>
								<option value="A/V and Technical Service">A/V and Technical Service</option>
								<option value="Event Décor and Design">Event Décor and Design</option>
								<option value="Entertainment Services">Entertainment Services</option>
								<option value="Photography and Videography">Photography and Videography</option>
								<option value="Rentals and Equipment">Rentals and Equipment</option>
								<option value="Security and Safety Service">Security and Safety Service</option>
								<option value="Stage Build">Stage Build</option>
								<option value="Transportation and Logistics">Transportation and Logistics</option>
								<option value="Marketing, Promotions and Advertising">Marketing, Promotions and
									Advertising
								</option>
								<option value="Event Staffing">Event Staffing</option>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label for="service1">Services 1</label>
							<select id="service1" name="service1" class="form-control" disabled>
								<option value="" selected disabled>Select a Service</option>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label for="businessLine2">Business Line 2 </label>
							<select id="businessLine2" class="businessLine form-control" name="businessLine2">
								<option value="" selected disabled>Select a Category</option>
								<option value="Catering and Food Service">Catering and Food Service</option>
								<option value="A/V and Technical Service">A/V and Technical Service</option>
								<option value="Event Décor and Design">Event Décor and Design</option>
								<option value="Entertainment Services">Entertainment Services</option>
								<option value="Photography and Videography">Photography and Videography</option>
								<option value="Rentals and Equipment">Rentals and Equipment</option>
								<option value="Security and Safety Service">Security and Safety Service</option>
								<option value="Stage Build">Stage Build</option>
								<option value="Transportation and Logistics">Transportation and Logistics</option>
								<option value="Marketing, Promotions and Advertising">Marketing, Promotions and
									Advertising
								</option>
								<option value="Event Staffing">Event Staffing</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-2">
							<label for="service2">Services 2</label>
							<select id="service2" name="service2" class="form-control" disabled>
								<option value="" selected disabled>Select a Service</option>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label for="businessLine3">Business Line 3 </label>
							<select id="businessLine3" class="businessLine form-control" name="businessLine3">
								<option value="" selected disabled>Select a Category</option>
								<option value="Catering and Food Service">Catering and Food Service</option>
								<option value="A/V and Technical Service">A/V and Technical Service</option>
								<option value="Event Décor and Design">Event Décor and Design</option>
								<option value="Entertainment Services">Entertainment Services</option>
								<option value="Photography and Videography">Photography and Videography</option>
								<option value="Rentals and Equipment">Rentals and Equipment</option>
								<option value="Security and Safety Service">Security and Safety Service</option>
								<option value="Stage Build">Stage Build</option>
								<option value="Transportation and Logistics">Transportation and Logistics</option>
								<option value="Marketing, Promotions and Advertising">Marketing, Promotions and
									Advertising
								</option>
								<option value="Event Staffing">Event Staffing</option>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label for="service3">Services 3</label>
							<select id="service3" name="service3" class="form-control" disabled>
								<option value="" selected disabled>Select a Service</option>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label for="password"> Password <b class="text-danger">*</b></label>
							<input type="password" class="form-control" name="password" id="password"
								   placeholder="Password" required>
						</div>
						<div class="form-group col-md-2">
							<label for="password1"> Confirm Password </label>
							<input type="password" class="form-control" name="password1" id="password1"
								   placeholder="Retype password">
						</div>
					</div>

					<div class="box-footer">
						<div class="row">
							<div class="form-group col-md-12">
								<button type="submit" id="submit" class="btn btn-success pull-right">Save</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Vendor List</b></h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered"
						   style="width: 99% !important;" id="item-list">
						<thead>
						<tr>
							<th>Name</th>
							<th>Username</th>
							<th>Phone</th>
							<th>Vendor Details</th>
							<th>Business Line 1</th>
							<th>Services 1</th>
							<th>Business Line 2</th>
							<th>Services 2</th>
							<th>Business Line 3</th>
							<th>Services 3</th>
							<th>W9 Form</th>
							<th>Join At</th>
							<th>Last Update</th>
							<th style="padding-right: 30px">Actions</th>
						</tr>
						</thead>
						<tbody style="font-weight: normal">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$('#state').select2({
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

	$('.businessLine').on('change', function () {
		var selectedCategory = $(this).val(); // Get selected category value
		var serviceId = $(this).attr('id').replace('businessLine', 'service'); // Get corresponding service select box ID
		var service = $('#' + serviceId); // Get the corresponding service select box element

		// Clear previous options and add a default option
		service.empty().append('<option value="" selected disabled>Select a Service</option>');

		if (selectedCategory) {
			service.prop('disabled', false); // Enable the service select box
			var services = categoryData[selectedCategory]; // Get the services for selected category

			// Add options to the service select box
			$.each(services, function (index, val) {
				service.append('<option value="' + val + '">' + val + '</option>');
			});
		} else {
			service.prop('disabled', true); // Disable the service select box if no valid category selected
		}
	});
	var checkEmail = 0;
	$('#username').on('keyup', function () {
		var email = $('#username').val();
		if (email != '') {
			$.ajax({
				url: "<?php echo customer_url('fetch_email'); ?>",
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
	var Table, selectedIDs = [];
	window.onload = function () {
		Table = $('#item-list').DataTable({
			serverSide: true,
			order: [[0, "ASC"]],
			// destroy: true,
			stateSave: true,
			"columnDefs": [
				{
					"render": function (data, type, row) {
						if (data) {
							return '<button class="btn btn-link" onclick="loadPopup(\'' + '<?= customer_url('viewVendorInvoiceW9Form/') ?>' + row['id'] + '\')">' + data + '</button>';
						} else {
							return '';
						}
					},
					"targets": 10
				},
				{
					"render": function (data, type, row) {
						if (data) {
							let ein = row['ein'] ? ' (' + row['ein'] + ')' : '';
							let businessAddress = row['businessAddress'] ? row['businessAddress'] : 'Address not available';
							let city = row['city'] ? row['city'] : '';
							let state = row['state'] ? row['state'] : '';
							let zip = row['zip'] && row['zip'] > 0 ? row['zip'] : '';

							return data + ein + '</br>' + businessAddress + '<br>' + city + (state ? ', ' + state : '') + (zip ? ' - ' + zip : '');
						} else {
							// Fallback when data is missing
							return '-- No data available --';
						}
					},
					"targets": 3
				},
				{
					"render": function (data, type, row) {
						if (data) {
							return moment(data).format('DD MMM YYYY hh:mm:ss A');
						} else {
							return '--'
						}
					}, "targets": [12, 11]
				}
			],
			'aoColumns': [{mData: "name"}, {mData: "username"}, {mData: "phone"}, {mData: "businessName"}, {mData: "businessLine1"}, {mData: "service1"},
				{mData: "businessLine2"}, {mData: "service2"}, {mData: "businessLine3"}, {mData: "service3"}, {mData: "w9Form"}, {mData: "createAt"}, {mData: "updateAt"}, {
					mData: "actions",
					bSortable: false
				}],
			"aLengthMenu": [[25, 50, 100, 200, 500, 1000], [25, 50, 100, 200, 500, 1000]],
			"iDisplayLength": 25,
			'bProcessing': true,
			"language": {
				processing: '<div><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading Please Wait...</span></div>'
			},
			'bServerSide': true,
			'sAjaxSource': '<?= customer_url('getVendors') ?>',
			'fnServerData': function (sSource, aoData, fnCallback) {
				$.ajax({
					'dataType': 'json',
					'type': 'POST',
					'url': sSource,
					'data': aoData,
					'success': function (d, e, f) {
						console.log(d);
						fnCallback(d, e, f);
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.log(jqXHR);
						if (jqXHR.jqXHRstatusText)
							alert(jqXHR.jqXHRstatusText);
					}
				});
			},
			"fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
				// console.log(nRow);
			},
			dom: '<"top"B<"pull-right"fi>>rtlp',
			// dom: 'lfrtip',
		});
	}
</script>


