<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Add New Venue</b></h3>
			</div>
			<form role="form" action="<?= customer_url('saveVenue') ?>" method="post" autocomplete="off"
				  enctype="multipart/form-data">
				<div class="box-body">
					<div class="row">
						<div class="form-group col-md-2">
							<label for="venueName">Venue Name <span class="text-danger">*</span></label>
							<input class="form-control input-sm" type="text" name="venueName"
								   placeholder="Enter Venue Name" id="venueName" required>
						</div>
						<div class="form-group col-md-2">
							<label for="venueWebsite">Venue Website <span class="text-danger">*</span></label>
							<input class="form-control input-sm" type="text" name="venueWebsite"
								   placeholder="Enter Venue Website" id="venueWebsite" required>
						</div>
						<div class="form-group col-md-2">
							<label for="address">Address <span class="text-danger">*</span></label>
							<input class="form-control input-sm" type="text" name="address"
								   placeholder="Enter Address" id="address" required>
						</div>
						<div class="form-group col-md-2">
							<label for="city">City <span class="text-danger">*</span></label>
							<input class="form-control input-sm" type="text" name="city"
								   placeholder="Enter City" id="city" required>
						</div>
						<div class="form-group col-md-2">
							<label for="state">State <span class="text-danger">*</span></label>
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
									// Set the option as selected if it matches the stored state
									echo "<option value='{$state}'>{$state}</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label for="zip"> Zip Code <b class="text-danger">*</b></label>
							<input class="form-control input-sm" type="text" name="zip" id="zip"
								   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
								   placeholder="Enter Zip Code" maxlength="5" required>
						</div>
						<div class="form-group col-md-2">
							<label for="rentalFee">Rental Fee <b class="text-danger">*</b></label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input class="form-control rental input-sm" type="number" step="any" min="0"
									   name="rentalFee" id="rentalFee" required>
							</div>
						</div>
						<div class="form-group col-md-2">
							<label for="standing">Standing </label>
							<input class="form-control input-sm" type="number"
								   onkeydown="if(event.key==='.'){event.preventDefault();}"
								   step="1" min="0" name="standing"
								   id="standing">
						</div>
						<div class="form-group col-md-2">
							<label for="orchesta">Orchestra </label>
							<input class="form-control input-sm" type="number"
								   onkeydown="if(event.key==='.'){event.preventDefault();}"
								   step="1" min="0" name="orchesta"
								   id="orchesta">
						</div>
						<div class="form-group col-md-2">
							<label for="mezzanine">Mezzanine </label>
							<input class="form-control input-sm" type="number"
								   onkeydown="if(event.key==='.'){event.preventDefault();}"
								   step="1" min="0" name="mezzanine"
								   id="mezzanine">
						</div>
						<div class="form-group col-md-2">
							<label for="balcony">Balcony </label>
							<input class="form-control input-sm" type="number"
								   onkeydown="if(event.key==='.'){event.preventDefault();}"
								   step="1" min="0" name="balcony"
								   id="balcony">
						</div>
						<div class="form-group col-md-2">
							<label for="totalVenueCapacity">Total Capacity </label>
							<input class="form-control input-sm" type="number" step="1" min="0"
								   name="totalVenueCapacity"
								   id="totalVenueCapacity" readonly>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="panel panel-info">
								<div class="panel-heading">
									Venue Point of Contact
									<button class="btn btn-sm btn-info pull-right add"><i
												class="fa fa-plus"></i>
									</button>
								</div>
								<div class="panel-body">
									<div class="repeat">
										<div class="repeatBox0">
											<div class="row">
												<div class="form-group col-md-3">
													<label for="pocName"> Name <b class="text-danger">*</b></label>
													<input class="form-control input-sm" type="text" name="pocName[]"
														   id="pocName"
														   placeholder="Enter Full Name" required>
												</div>
												<div class="form-group col-md-3">
													<label for="pocTitle"> Title <b class="text-danger">*</b></label>
													<input class="form-control input-sm" type="text" name="pocTitle[]"
														   id="pocTitle"
														   placeholder="Enter Title" required>
												</div>
												<div class="form-group col-md-3">
													<label for="pocPhone"> Phone Number <b
																class="text-danger">*</b></label>
													<input class="form-control input-sm" type="number" name="pocPhone[]"
														   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
														   maxlength="10" minlength="10" pattern="[0-9]{10}" title="Must be 10 numbers"
														   id="pocPhone" placeholder="Enter Phone Number" required>
												</div>
												<div class="form-group col-md-2">
													<label for="pocEmail"> Email <b class="text-danger">*</b></label>
													<input class="form-control input-sm" type="email" name="pocEmail[]"
														   id="pocEmail"
														   placeholder="Enter Email Address" required>
												</div>
												<div class="col-md-1 remove pull-left"><br>
													<button class="btn btn-sm btn-danger" id="0"
															onclick="deleteRepeat(this)"><i
																class="fa fa-close"></i></button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="panel panel-info">
								<div class="panel-heading">
									Attachment
									<button class="btn btn-sm btn-info pull-right addAttach"><i
												class="fa fa-plus"></i>
									</button>
								</div>
								<div class="panel-body">
									<div class="repeatAttach">
										<div class="repeatBoxAttach0">
											<div class="row">
												<div class="form-group col-md-6">
													<label for="attachmentName"> Attachment Name </label>
													<input class="form-control input-sm" type="text"
														   name="attachmentName[]"
														   id="attachmentName"
														   placeholder="Enter Attachment Name">
												</div>
												<div class="form-group col-md-5">
													<label for="attachment"> File </label>
													<input class="form-control input-sm" type="file" name="attachment[]"
														   id="attachment" accept="application/pdf, image/*"
														   placeholder="Select File">
												</div>
												<div class="col-md-1 removeAttach pull-left"><br>
													<button class="btn btn-sm btn-danger" id="0"
															onclick="deleteRepeatAttach(this)"><i
																class="fa fa-close"></i></button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="form-group col-md-12">
							<button type="submit" id="submit"
									class="btn pull-right" style="background-color: black; color: white">Save
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Venue List</b></h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered"
						   style="width: 99% !important;" id="item-list">
						<thead>
						<tr>
							<th>Venue Name</th>
							<th>Address</th>
							<th>Rental Fee</th>
							<th>Total Capacity</th>
							<th>POC Name</th>
							<th>POC Title</th>
							<th>POC Phone</th>
							<th>POC Email</th>
							<th>Venue Website</th>
							<th>Created By</th>
							<th>Created At</th>
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
<style>
	.panel .panel-heading {
		color: white;
		background-color: black;
	}

	#item-list tr:hover {
		cursor: default;
	}
</style>
<script>
	var id_count;
	var id_countAttach;

	function deleteRepeat(elem) {
		var v = $('.repeat').children('div').length;
		if ((v - 1) === 1) {
			$('.remove').hide();
		}
		id_count -= 1;
		id_count--;
		var id = $(elem).attr("id");
		$('.repeatBox' + id).remove();
	}

	function deleteRepeatAttach(elem) {
		var v = $('.repeatAttach').children('div').length;
		if ((v - 1) === 1) {
			$('.removeAttach').hide();
		}
		id_countAttach -= 1;
		id_countAttach--;
		var id = $(elem).attr("id");
		$('.repeatBoxAttach' + id).remove();
	}

	$(function () {
		var id_count = 1;
		$('.remove').hide();
		$('.add').on('click', function (e) {
			e.preventDefault();
			var repeat = '<div class="repeatBox' + id_count + '">' +
				'<div class="row">' +
				'<div class="form-group col-md-3">' +
				'<label for="pocName"> Name <b class="text-danger">*</b></label>' +
				'<input class="form-control input-sm" type="text" name="pocName[]"' +
				'   id="pocName"' +
				'  placeholder="Enter Full Name" required>' +
				'</div>' +
				'<div class="form-group col-md-3">' +
				'<label for="pocTitle"> Title <b class="text-danger">*</b></label>' +
				'<input class="form-control input-sm" type="text" name="pocTitle[]"' +
				'	   id="pocTitle"' +
				'		   placeholder="Enter Title" required>' +
				'</div>' +
				'<div class="form-group col-md-3">' +
				'<label for="pocPhone"> Phone Number <b' +
				'	class="text-danger">*</b></label>' +
				'<input class="form-control input-sm" type="number" name="pocPhone[]"' +
				'	   id="pocPhone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" minlength="10" pattern="[0-9]{10}" title="Must be 10 numbers"' +
				'	   placeholder="Enter Phone Number" required>' +
				'</div>' +
				'<div class="form-group col-md-2">' +
				'	<label for="pocEmail"> Email <b class="text-danger">*</b</label>' +
				'<input class="form-control input-sm" type="email" name="pocEmail[]"' +
				'	   id="pocEmail"' +
				'	   placeholder="Enter Email Address" required>' +
				'</div>' +
				'<div class="col-md-1 remove pull-left"><br>' +
				'<button class="btn btn-sm btn-danger" id="' + id_count + '" onclick="deleteRepeat(this)"><i class="fa fa-close"></i></button>' +
				'</div>' +
				'</div>' +
				'</div>';
			$('.repeat').append(repeat);
			if (id_count === 0) {
				$('.remove').hide();
			}
			if (id_count >= 1) {
				$('.remove').show();
			}
			id_count++;
		});

		var id_countAttach = 1;
		$('.removeAttach').hide();
		$('.addAttach').on('click', function (e) {
			e.preventDefault();
			var repeat = '<div class="repeatBoxAttach' + id_countAttach + '">' +
				'<div class="row">' +
				'<div class="form-group col-md-6">' +
				'<label for="attachmentName"> Attachment Name </label>' +
				'<input class="form-control input-sm" type="text" name="attachmentName[]"' +
				'   id="attachmentName"' +
				'   placeholder="Enter Attachment Name">' +
				'</div>' +
				'<div class="form-group col-md-5">' +
				'	<label for="attachment"> File </label>' +
				'	<input class="form-control input-sm" type="file" name="attachment[]"' +
				'		   id="attachment" accept="application/pdf, image/*"' +
				'		   placeholder="Select File">' +
				'</div>' +
				'<div class="col-md-1 removeAttach pull-left"><br>' +
				'<button class="btn btn-sm btn-danger" id="' + id_countAttach + '" onclick="deleteRepeatAttach(this)"><i class="fa fa-close"></i></button>' +
				'</div>' +
				'</div>' +
				'</div>';
			$('.repeatAttach').append(repeat);
			if (id_countAttach === 0) {
				$('.removeAttach').hide();
			}
			if (id_countAttach >= 1) {
				$('.removeAttach').show();
			}
			id_countAttach++;
		});
	});

	$('#standing, #orchesta, #mezzanine, #balcony').on('input', function () {
		var standing = parseInt($('#standing').val()) || 0;
		var orchesta = parseInt($('#orchesta').val()) || 0;
		var mezzanine = parseInt($('#mezzanine').val()) || 0;
		var balcony = parseInt($('#balcony').val()) || 0;
		var total = standing + orchesta + mezzanine + balcony;
		$('#totalVenueCapacity').val(total);
	});
	$(document).ready(function () {
		$('#state').select2({
			placeholder: "Select a state",
			allowClear: true
		});
	});

	var Table = [];
	window.onload = function () {
		Table = $('#item-list').DataTable({
			serverSide: true,
			order: [[0, "ASC"]],
			// destroy: true,
			stateSave: true,
			"columnDefs": [
				{
					"render": function (data, type, row) {
						if (!data.startsWith('http://') && !data.startsWith('https://') && !data.startsWith('www')) {
							data = 'https://' + data;
						}
						return '<a href="' + data + '" class="btn-link" target="_blank">' + data + '</a>';
					},
					"targets": 8
				},
				{
					"render": function (data, type, row) {
						return data + '<br>' + row['city'] + '<br>' + row['state'] + ' - ' + row['zip'];
					}, "targets": 1
				},
				{
					"render": function (data, type, row) {
						if (data > 0) {
							return '$' + data;
						} else {
							return data;
						}
					}, "targets": 2
				},
				{
					"render": function (data, type, row) {
						if (data) {
							return moment(data).format('DD MMM YYYY hh:mm:ss A');
						} else {
							return '--'
						}
					}, "targets": [10, 11]
				}
			],
			'aoColumns': [{mData: "venueName"}, {mData: "address"}, {mData: "rentalFee"}, {mData: "totalVenueCapacity"}, {mData: "pocName"}, {mData: "pocTitle"},
				{mData: "pocPhone"}, {mData: "pocEmail"}, {mData: "venueWebsite"}, {mData: "name"},
				{mData: "createAt"}, {mData: "updateAt"}, {
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
			'sAjaxSource': '<?= customer_url('getVenues') ?>',
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

	$('#item-list tbody').on('click', 'tr td', function () {
		var data = $('#item-list').DataTable().row(this).data();
		var columnIndex = $(this).index();
		switch (columnIndex) {
			case 12:
				break;
			case 8:
				break;
			default:
				loadPopup('<?= customer_url('viewVenue/') ?>' + data.id);
				break;
		}
	});
</script>


