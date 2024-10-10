<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog" style="width: 90%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Update Venue Details</b></h4>
			</div>
			<form id="formEdit" action="<?= admin_url('updateVenue/') . $data->id ?>" method="post"
				  enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-2">
							<label for="venueName">Venue Name <span class="text-danger">*</span></label>
							<input class="form-control input-sm" type="text" name="venueName"
								   placeholder="Enter Venue Name" value="<?= $data->venueName ?>" id="venueName"
								   required>
						</div>
						<div class="form-group col-md-2">
							<label for="venueWebsite">Venue Website <span class="text-danger">*</span></label>
							<input class="form-control input-sm" type="text" name="venueWebsite"
								   placeholder="Enter Venue Website" value="<?= $data->venueWebsite ?>"
								   id="venueWebsite" required>
						</div>
						<div class="form-group col-md-2">
							<label for="address">Address <span class="text-danger">*</span></label>
							<input class="form-control input-sm" type="text" name="address"
								   placeholder="Enter Address" id="address" value="<?= $data->address ?>" required>
						</div>
						<div class="form-group col-md-2">
							<label for="city">City <span class="text-danger">*</span></label>
							<input class="form-control input-sm" type="text" name="city"
								   placeholder="Enter City" id="city" value="<?= $data->city ?>" required>
						</div>
						<div class="form-group col-md-2">
							<label for="stateEdit">State <span class="text-danger">*</span></label>
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
									$selected = ($data->state == $state) ? 'selected' : '';
									echo "<option value='{$state}' {$selected}>{$state}</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label for="zip"> Zip Code <b class="text-danger">*</b></label>
							<input class="form-control input-sm" type="text" name="zip" id="zip"
								   value="<?= $data->zip ?>"
								   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
								   placeholder="Enter Zip Code" maxlength="5" required>
						</div>
						<div class="form-group col-md-2">
							<label for="rentalFee">Rental Fee <b class="text-danger">*</b></label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input class="form-control rental input-sm" type="number" step="any" min="0"
									   name="rentalFee" id="rentalFee" value="<?= $data->rentalFee ?>" required>
							</div>
						</div>
						<div class="form-group col-md-2">
							<label for="standingEdit">Standing </label>
							<input class="form-control input-sm" type="number"
								   onkeydown="if(event.key==='.'){event.preventDefault();}"
								   step="1" min="0" name="standing" value="<?= $data->standing ?>"
								   id="standingEdit">
						</div>
						<div class="form-group col-md-2">
							<label for="orchestaEdit">Orchestra </label>
							<input class="form-control input-sm" type="number"
								   onkeydown="if(event.key==='.'){event.preventDefault();}"
								   step="1" min="0" name="orchesta" value="<?= $data->orchesta ?>"
								   id="orchestaEdit">
						</div>
						<div class="form-group col-md-2">
							<label for="mezzanineEdit">Mezzanine </label>
							<input class="form-control input-sm" type="number"
								   onkeydown="if(event.key==='.'){event.preventDefault();}"
								   step="1" min="0" name="mezzanine" value="<?= $data->mezzanine ?>"
								   id="mezzanineEdit">
						</div>
						<div class="form-group col-md-2">
							<label for="balconyEdit">Balcony </label>
							<input class="form-control input-sm" type="number"
								   onkeydown="if(event.key==='.'){event.preventDefault();}"
								   step="1" min="0" name="balcony" value="<?= $data->balcony ?>"
								   id="balconyEdit">
						</div>
						<div class="form-group col-md-2">
							<label for="totalVenueCapacityEdit">Total Capacity </label>
							<input class="form-control input-sm" type="number" step="1" min="0"
								   name="totalVenueCapacity" value="<?= $data->totalVenueCapacity ?>"
								   id="totalVenueCapacityEdit" readonly>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="panel panel-info">
								<div class="panel-heading">
									Venue Point of Contact
									<button class="btn btn-sm btn-info pull-right addEdit"><i
												class="fa fa-plus"></i>
									</button>
								</div>
								<div class="panel-body">
									<div class="repeatEdit">
										<?php if ($pocs) {
											foreach ($pocs as $key => $item) { ?>
												<div class="repeatEditBox<?= ($key + 1) ?>">
													<div class="row">
														<div class="form-group col-md-3">
															<label for="pocName"> Name <b
																		class="text-danger">*</b></label>
															<input class="form-control input-sm" type="text"
																   name="pocName[]"
																   id="pocName" value="<?= $item->pocName ?>"
																   placeholder="Enter Full Name" required>
														</div>
														<div class="form-group col-md-3">
															<label for="pocTitle"> Title <b
																		class="text-danger">*</b></label>
															<input class="form-control input-sm" type="text"
																   name="pocTitle[]"
																   id="pocTitle" value="<?= $item->pocTitle ?>"
																   placeholder="Enter Title" required>
														</div>
														<div class="form-group col-md-3">
															<label for="pocPhone"> Phone Number <b
																		class="text-danger">*</b></label>
															<input class="form-control input-sm" type="tel"
																   name="pocPhone[]"
																   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
																   maxlength="10" minlength="10" pattern="[0-9]{10}" title="Must be 10 numbers"
																   id="pocPhone" value="<?= $item->pocPhone ?>"
																   placeholder="Enter Phone Number" required>
														</div>
														<div class="form-group col-md-2">
															<label for="pocEmail"> Email <b
																		class="text-danger">*</b></label>
															<input class="form-control input-sm" type="email"
																   name="pocEmail[]"
																   id="pocEmail" value="<?= $item->pocEmail ?>"
																   placeholder="Enter Email Address" required>
														</div>
														<div class="form-group col-md-1 remove pull-left"><br>
															<button class="btn btn-sm btn-danger" id="<?= ($key + 1) ?>"
																	onclick="deleteRepeatEdit(this)"><i
																		class="fa fa-close"></i></button>
														</div>
													</div>
												</div>
											<?php }
										} else { ?>
											<div class="repeatEditBox0">
												<div class="row">
													<div class="form-group col-md-3">
														<label for="pocName"> Name <b
																	class="text-danger">*</b></label>
														<input class="form-control input-sm" type="text"
															   name="pocName[]"
															   id="pocName"
															   placeholder="Enter Full Name" required>
													</div>
													<div class="form-group col-md-3">
														<label for="pocTitle"> Title <b
																	class="text-danger">*</b></label>
														<input class="form-control input-sm" type="text"
															   name="pocTitle[]"
															   id="pocTitle"
															   placeholder="Enter Title" required>
													</div>
													<div class="form-group col-md-3">
														<label for="pocPhone"> Phone Number <b
																	class="text-danger">*</b></label>
														<input class="form-control input-sm" type="tel"
															   name="pocPhone[]"
															   id="pocPhone"
															   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
															   maxlength="10" minlength="10" pattern="[0-9]{10}" title="Must be 10 numbers"
															   placeholder="Enter Phone Number" required>
													</div>
													<div class="form-group col-md-2">
														<label for="pocEmail"> Email <b
																	class="text-danger">*</b></label>
														<input class="form-control input-sm" type="email"
															   name="pocEmail[]"
															   id="pocEmail"
															   placeholder="Enter Email Address" required>
													</div>
													<div class="form-group col-md-1 removeEdit pull-left"><br>
														<button class="btn btn-sm btn-danger" id="0"
																onclick="deleteRepeatEdit(this)"><i
																	class="fa fa-close"></i></button>
													</div>
												</div>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="panel panel-info">
								<div class="panel-heading">
									Attachment
									<button class="btn btn-sm btn-info pull-right addAttachEdit"><i
												class="fa fa-plus"></i>
									</button>
								</div>
								<div class="panel-body">
									<p class="text-danger text-bold no-padding">Upload file again will override the
										current file.</p>
									<div class="repeatAttachEdit">
										<?php if ($attachments) {
											foreach ($attachments as $key => $item) { ?>
												<div class="repeatBoxEditAttach<?= ($key + 1) ?>">
													<div class="row">
														<div class="form-group col-md-6">
															<label for="attachmentName"> Attachment Name </label>
															<input class="form-control input-sm" type="text"
																   name="attachmentName[]"
																   id="attachmentName"
																   value="<?= $item->attachmentName ?>"
																   placeholder="Enter Attachment Name">
															<input type="hidden" name="attachmentId[]"
																   value="<?= $item->id ?>">
														</div>
														<div class="form-group col-md-5">
															<label for="attachment"> File </label>
															<input class="form-control input-sm" type="file"
																   name="attachment[]"
																   id="attachment" accept="application/pdf, image/*"
																   placeholder="Select File"
																   value="<?= $item->attachment ?>">
														</div>
														<div class="form-group col-md-1 removeAttachEdit pull-left"><br>
															<button class="btn btn-sm btn-danger" id="<?= ($key + 1) ?>"
																	onclick="deleteRepeatAttachEdit(this)"><i
																		class="fa fa-close"></i></button>
														</div>
													</div>
												</div>
											<?php }
										} else { ?>
											<div class="repeatBoxEditAttach0">
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
														<input class="form-control input-sm" type="file"
															   name="attachment[]"
															   id="attachment" accept="application/pdf, image/*"
															   placeholder="Select File">
													</div>
													<div class="form-group col-md-1 removeAttachEdit pull-left"><br>
														<button class="btn btn-sm btn-danger" id="0"
																onclick="deleteRepeatAttachEdit(this)"><i
																	class="fa fa-close"></i></button>
													</div>
												</div>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="form-group col-md-12">
							<button type="submit" id="submit" style="background-color: black; color: white"
									class="btn pull-right">Update
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {

		var pocCounter = $('div[class^="repeatEditBox"]').length;
		var attachCounter = $('div[class^="repeatBoxEditAttach"]').length;

		// Function to remove Point of Contact rows
		window.deleteRepeatEdit = function (elem) {
			event.preventDefault();  // Prevent form submission
			var id = $(elem).attr("id");
			$(".repeatEditBox" + id).remove();
		};

		// Function to remove Attachment rows
		window.deleteRepeatAttachEdit = function (elem) {
			event.preventDefault();  // Prevent form submission
			var id = $(elem).attr("id");
			$(".repeatBoxEditAttach" + id).remove();
		};

		// Add dynamic Point of Contact row
		$(".addEdit").click(function (e) {
			e.preventDefault();
			pocCounter++;

			var html = '<div class="repeatEditBox' + pocCounter + '">';
			html += '<div class="row">';
			html += '<div class="form-group col-md-3">';
			html += '<label for="pocName"> Name <b class="text-danger">*</b></label>';
			html += '<input class="form-control input-sm" type="text" name="pocName[]" placeholder="Enter Full Name" required>';
			html += '</div>';
			html += '<div class="form-group col-md-3">';
			html += '<label for="pocTitle"> Title <b class="text-danger">*</b></label>';
			html += '<input class="form-control input-sm" type="text" name="pocTitle[]" placeholder="Enter Title" required>';
			html += '</div>';
			html += '<div class="form-group col-md-3">';
			html += '<label for="pocPhone"> Phone Number <b class="text-danger">*</b></label>';
			html += '<input class="form-control input-sm" type="tel" name="pocPhone[]" ' +
				'oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" minlength="10" pattern="[0-9]{10}" title="Must be 10 numbers" placeholder="Enter Phone Number" required>';
			html += '</div>';
			html += '<div class="form-group col-md-2">';
			html += '<label for="pocEmail"> Email <b class="text-danger">*</b></label>';
			html += '<input class="form-control input-sm" type="email" name="pocEmail[]" placeholder="Enter Email Address" required>';
			html += '</div>';
			html += '<div class="form-group col-md-1 remove pull-left"><br>';
			html += '<button class="btn btn-sm btn-danger" id="' + pocCounter + '" onclick="deleteRepeatEdit(this)"><i class="fa fa-close"></i></button>';
			html += '</div>';
			html += '</div>';
			html += '</div>';
			$(".repeatEdit").append(html);
		});

		// Add dynamic Attachment row
		$(".addAttachEdit").click(function (e) {
			e.preventDefault();
			attachCounter++;

			var html = '<div class="repeatBoxEditAttach' + attachCounter + '">';
			html += '<div class="row">';
			html += '<div class="form-group col-md-6">';
			html += '<label for="attachmentName"> Attachment Name </label>';
			html += '<input class="form-control input-sm" type="text" name="attachmentName[]" placeholder="Enter Attachment Name">';
			html += '</div>';
			html += '<div class="form-group col-md-5">';
			html += '<label for="attachment"> File </label>';
			html += '<input class="form-control input-sm" type="file" name="attachment[]" accept="application/pdf, image/*" placeholder="Select File">';
			html += '</div>';
			html += '<div class="form-group col-md-1 removeAttachEdit pull-left"><br>';
			html += '<button class="btn btn-sm btn-danger" id="' + attachCounter + '" onclick="deleteRepeatAttachEdit(this)"><i class="fa fa-close"></i></button>';
			html += '</div>';
			html += '</div>';
			html += '</div>';
			$(".repeatAttachEdit").append(html);
		});
	});


	$('#standingEdit, #orchestaEdit, #mezzanineEdit, #balconyEdit').on('input', function () {
		var standing = parseInt($('#standingEdit').val()) || 0;
		var orchesta = parseInt($('#orchestaEdit').val()) || 0;
		var mezzanine = parseInt($('#mezzanineEdit').val()) || 0;
		var balcony = parseInt($('#balconyEdit').val()) || 0;
		var total = standing + orchesta + mezzanine + balcony;
		$('#totalVenueCapacityEdit').val(total);
	});
	$(document).ready(function () {
		$('#stateEdit').select2({
			placeholder: "Select a state",
			dropdownParent: $('#remoteModal1'),
			allowClear: true
		});
	});
</script>
