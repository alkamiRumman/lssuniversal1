<div class="modal fade in" id="modal-default" style="display: block; overflow: auto;">
	<div class="modal-dialog modal-lg" style="width: 80%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Create New Timed Access Link</b></h4>
			</div>
			<form id="formEdit" action="<?= admin_url('saveTimeAccessLink/') . $id ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<label for="title" class="control-label">
									User Access Title <b class="text-danger">*</b></label>
								<div class="panel-body">
									<input class="form-control" type="text" name="userAccessTitle" id="title"
										   required
										   placeholder="Enter user access title" aria-required="">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<label for="title" class="control-label">
									Production Schedule</label>
								<div class="panel-body">
									<div class="table-responsive" style="overflow: auto;">
										<table id="dynamicTable" style="width: 99%;"
											   class="table table-bordered table-hover">
											<caption class="text-center">
												<div class="form-inline d-flex justify-content-center">
													<label class="checkbox-inline font-weight-bold text-black mr-3"
														   for="showProduction">
														<input id="showProduction" type="checkbox" value="1"
															   name="showProduction" style="margin-right: 5px;">
														Show Schedule
													</label>
													<label class="checkbox-inline font-weight-bold text-black"
														   for="showPrivateNote">
														<input id="showPrivateNote" type="checkbox" value="1"
															   name="showPrivateNote" style="margin-right: 5px;">
														Show Private Note Reminder
													</label>
												</div>
											</caption>
											<thead>
											<tr style="background-color: #D3D3D3;">
												<th>Title</th>
												<th>Start</th>
												<th>Duration</th>
												<th>Lead Team Member</th>
												<th>Crew Member</th>
												<th>Talent</th>
												<th>Location</th>
												<th>Area/Space</th>
												<th>Details</th>
												<th>Private Note Reminder</th>
											</tr>
											</thead>
											<tbody>
											<?php
											$currentTitleId = null;
											foreach ($runOfShowDetails as $detail):
												if ($currentTitleId !== $detail['title_id']):
													$currentTitleId = $detail['title_id']; ?>
													<tr>
														<td style="background-color: black; color: white"><?= $detail['title_name']; ?></td>
														<td style="background-color: black" colspan="9"></td>
													</tr>
												<?php endif; ?>
												<tr data-title-id="<?= $detail['title_id']; ?>">
													<td><?= $detail['item_name']; ?></td>
													<td><?= date('h:i A', strtotime($detail['start_time'])) ?></td>
													<td><?= $detail['duration']; ?></td>
													<td><?= $detail['name']; ?></td>
													<td><?= $detail['crew_member']; ?></td>
													<td><?= $detail['talent']; ?></td>
													<td><?= $detail['location']; ?></td>
													<td><?= $detail['area_space']; ?></td>
													<td><?= $detail['details']; ?></td>
													<td><?= $detail['private_notes']; ?></td>
												</tr>
											<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<label for="title" class="control-label">
									Crew Travel </label>
								<div class="panel-body">
									<div class="table-responsive" style="overflow: auto;">
										<table id="talentTable" style="width: 99%;"
											   class="table table-bordered table-hover table-striped table-theatreCrew">
											<thead>
											<tr style="background-color: #D3D3D3;">
												<th><label class="checkbox-inline font-weight-bold text-black">
														<input type="checkbox" id="selectCrewAll"
															   style="margin-right: 8px;"> Select All
													</label></th>
												<th>Traveler Information</th>
												<th>Travel Details</th>
											</tr>
											</thead>
											<tbody>
											<?php if ($crewTravelDetails) {
												foreach ($crewTravelDetails as $key => $crewTravelDetail) { ?>
													<tr>
														<td style="vertical-align: middle;border-bottom: 1px solid black">
															<label class="checkbox-inline font-weight-bold text-black"
																   for="crewTravel<?= $key ?>"
																   style="display: flex; align-items: center;">
																<input class="crew-checkbox"
																	   id="crewTravel<?= $key ?>" type="checkbox"
																	   value="<?= $crewTravelDetail->crewMemberId ?>"
																	   name="crewTravel[]"
																	   style="margin-right: 8px;">Select</label>
														</td>
														<td style="vertical-align: middle;border-bottom: 1px solid black"><?= $crewTravelDetail->firstName . ' ' . $crewTravelDetail->lastName ?></td>
														<td style="border-bottom: 1px solid black">
															<table class="table table-sm nested-table">
																<tr>
																	<th colspan="6"
																		style="background-color: black; color: white">
																		Travel-To Info
																	</th>
																</tr>
																<tr>
																	<th>Travel Type</th>
																	<td><?= $crewTravelDetail->travelTypeTo ?></td>
																	<th>Airline</th>
																	<td><?= $crewTravelDetail->airlineTo ?></td>
																	<th></th>
																	<td></td>
																</tr>
																<tr>
																	<th>Specify Travel</th>
																	<td><?= $crewTravelDetail->specifyTravelTo ?></td>
																	<th>Airport From</th>
																	<td><?= $crewTravelDetail->airportFromTo ?></td>
																	<th>Departure Time</th>
																	<td><?= $crewTravelDetail->departureTimeTo ? date('h:i a', strtotime($crewTravelDetail->departureTimeTo)) : '' ?></td>
																</tr>
																<tr>
																	<th>Confirmation #</th>
																	<td><?= $crewTravelDetail->confirmationTo ?></td>
																	<th>Airport To</th>
																	<td><?= $crewTravelDetail->airportToTo ?></td>
																	<th>Arrival Time</th>
																	<td><?= $crewTravelDetail->arrivalTimeTo ? date('h:i a', strtotime($crewTravelDetail->arrivalTimeTo)) : '' ?></td>
																</tr>

																<tr>
																	<th colspan="6"
																		style="background-color: black; color: white">
																		Travel-From Info
																	</th>
																</tr>
																<tr>
																	<th>Travel Type</th>
																	<td><?= $crewTravelDetail->travelTypeFrom ?></td>
																	<th>Airline</th>
																	<td><?= $crewTravelDetail->airlineFrom ?></td>
																	<th></th>
																	<td></td>
																</tr>
																<tr>
																	<th>Specify Travel</th>
																	<td><?= $crewTravelDetail->specifyTravelFrom ?></td>
																	<th>Airport From</th>
																	<td><?= $crewTravelDetail->airportFromFrom ?></td>
																	<th>Departure Time</th>
																	<td><?= $crewTravelDetail->departureTimeFrom ? date('h:i a', strtotime($crewTravelDetail->departureTimeFrom)) : '' ?></td>
																</tr>
																<tr>
																	<th>Confirmation #</th>
																	<td><?= $crewTravelDetail->confirmationFrom ?></td>
																	<th>Airport To</th>
																	<td><?= $crewTravelDetail->airportToFrom ?></td>
																	<th>Arrival Time</th>
																	<td><?= $crewTravelDetail->arrivalTimeFrom ? date('h:i a', strtotime($crewTravelDetail->arrivalTimeFrom)) : '' ?></td>
																</tr>

																<tr>
																	<th colspan="6"
																		style="background-color: black; color: white">
																		Ground Trans
																	</th>
																</tr>
																<tr>
																	<th>Ground Trans Co.</th>
																	<td><?= $crewTravelDetail->groundTransCo ?></td>
																	<th>Vehicle Make</th>
																	<td><?= $crewTravelDetail->vehicleMake ?></td>
																	<th>Pick-Up Time</th>
																	<td><?= $crewTravelDetail->pickUpTime ? date('h:i a', strtotime($crewTravelDetail->pickUpTime)) : '' ?></td>
																</tr>
																<tr>
																	<th>Driver's Name</th>
																	<td><?= $crewTravelDetail->driverName ?></td>
																	<th>Vehicle Model</th>
																	<td><?= $crewTravelDetail->vehicleModel ?></td>
																	<th>Drop-Off Time</th>
																	<td><?= $crewTravelDetail->dropOffTime ? date('h:i a', strtotime($crewTravelDetail->dropOffTime)) : '' ?></td>
																</tr>
																<tr>
																	<th>Phone Number</th>
																	<td><?= $crewTravelDetail->driverPhone ?></td>
																	<th>Vehicle Tag #</th>
																	<td><?= $crewTravelDetail->vehicleTag ?></td>
																	<th>Drop-Off Location</th>
																	<td><?= $crewTravelDetail->dropOffLocation ?></td>
																</tr>
																<tr>
																	<th>Notes</th>
																	<td><?= $crewTravelDetail->groundNotes ?></td>
																	<th></th>
																	<td></td>
																	<th></th>
																	<td></td>
																</tr>

																<tr style="text-align: center">
																	<th colspan="6"
																		style="background-color: black; color: white">
																		Accommodations
																	</th>
																</tr>
																<tr>
																	<th>Hotel Name</th>
																	<td><?= $crewTravelDetail->hotelName ?></td>
																	<th>Per-Diem</th>
																	<td><?= $crewTravelDetail->perDiem ?></td>
																	<th>Room Type</th>
																	<td><?= $crewTravelDetail->roomType ?></td>
																</tr>
																<tr>
																	<th>Hotel Stay (Total Nights)</th>
																	<td><?= $crewTravelDetail->hotelStay ?></td>
																	<th>Hotel Address</th>
																	<td><?= $crewTravelDetail->hotelAddress ?></td>
																	<th>Check-In</th>
																	<td><?= $crewTravelDetail->checkIn ? date('h:i a', strtotime($crewTravelDetail->checkIn)) : '' ?></td>
																</tr>
																<tr>
																	<th>Confirmation #</th>
																	<td><?= $crewTravelDetail->confirmationAccommodation ?></td>
																	<th></th>
																	<td></td>
																	<th>Check-Out</th>
																	<td><?= $crewTravelDetail->checkOut ? date('h:i a', strtotime($crewTravelDetail->checkOut)) : '' ?></td>
																</tr>
																<tr>
																	<th>Notes</th>
																	<td><?= $crewTravelDetail->accommodationNote ?></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
															</table>
														</td>
													</tr>
												<?php }
											} ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<label for="title" class="control-label">
									Talent Travel </label>
								<div class="panel-body">
									<div class="table-responsive" style="overflow: auto;">
										<table id="talentTable" style="width: 99%;"
											   class="table table-bordered table-hover table-striped table-theatreCrew">
											<thead>
											<tr style="background-color: #D3D3D3;">
												<th><label class="checkbox-inline font-weight-bold text-black">
														<input type="checkbox" id="selectTalentAll"
															   style="margin-right: 8px;"> Select All
													</label></th>
												<th>Traveler Information</th>
												<th>Travel Details</th>
											</tr>
											</thead>
											<tbody>
											<?php if ($talentCrewDetails) {
												foreach ($talentCrewDetails as $key => $crewTravelDetail) { ?>
													<tr>
														<td style="vertical-align: middle;border-bottom: 1px solid black">
															<label class="checkbox-inline font-weight-bold text-black"
																   for="talentTravel<?= $key ?>"
																   style="display: flex; align-items: center;">
																<input class="talent-checkbox"
																	   id="talentTravel<?= $key ?>" type="checkbox"
																	   value="<?= $crewTravelDetail->crewMemberId ?>"
																	   name="talentTravel[]"
																	   style="margin-right: 8px;">Select</label>
														</td>
														<td style="vertical-align: middle;border-bottom: 1px solid black"><?= $crewTravelDetail->firstName . ' ' . $crewTravelDetail->lastName ?></td>
														<td style="border-bottom: 1px solid black">
															<table class="table table-sm nested-table">
																<tr>
																	<th colspan="6"
																		style="background-color: black; color: white">
																		Travel-To Info
																	</th>
																</tr>
																<tr>
																	<th>Travel Type</th>
																	<td><?= $crewTravelDetail->travelTypeTo ?></td>
																	<th>Airline</th>
																	<td><?= $crewTravelDetail->airlineTo ?></td>
																	<th></th>
																	<td></td>
																</tr>
																<tr>
																	<th>Specify Travel</th>
																	<td><?= $crewTravelDetail->specifyTravelTo ?></td>
																	<th>Airport From</th>
																	<td><?= $crewTravelDetail->airportFromTo ?></td>
																	<th>Departure Time</th>
																	<td><?= $crewTravelDetail->departureTimeTo ? date('h:i a', strtotime($crewTravelDetail->departureTimeTo)) : '' ?></td>
																</tr>
																<tr>
																	<th>Confirmation #</th>
																	<td><?= $crewTravelDetail->confirmationTo ?></td>
																	<th>Airport To</th>
																	<td><?= $crewTravelDetail->airportToTo ?></td>
																	<th>Arrival Time</th>
																	<td><?= $crewTravelDetail->arrivalTimeTo ? date('h:i a', strtotime($crewTravelDetail->arrivalTimeTo)) : '' ?></td>
																</tr>

																<tr>
																	<th colspan="6"
																		style="background-color: black; color: white">
																		Travel-From Info
																	</th>
																</tr>
																<tr>
																	<th>Travel Type</th>
																	<td><?= $crewTravelDetail->travelTypeFrom ?></td>
																	<th>Airline</th>
																	<td><?= $crewTravelDetail->airlineFrom ?></td>
																	<th></th>
																	<td></td>
																</tr>
																<tr>
																	<th>Specify Travel</th>
																	<td><?= $crewTravelDetail->specifyTravelFrom ?></td>
																	<th>Airport From</th>
																	<td><?= $crewTravelDetail->airportFromFrom ?></td>
																	<th>Departure Time</th>
																	<td><?= $crewTravelDetail->departureTimeFrom ? date('h:i a', strtotime($crewTravelDetail->departureTimeFrom)) : '' ?></td>
																</tr>
																<tr>
																	<th>Confirmation #</th>
																	<td><?= $crewTravelDetail->confirmationFrom ?></td>
																	<th>Airport To</th>
																	<td><?= $crewTravelDetail->airportToFrom ?></td>
																	<th>Arrival Time</th>
																	<td><?= $crewTravelDetail->arrivalTimeFrom ? date('h:i a', strtotime($crewTravelDetail->arrivalTimeFrom)) : '' ?></td>
																</tr>

																<tr>
																	<th colspan="6"
																		style="background-color: black; color: white">
																		Ground Trans
																	</th>
																</tr>
																<tr>
																	<th>Ground Trans Co.</th>
																	<td><?= $crewTravelDetail->groundTransCo ?></td>
																	<th>Vehicle Make</th>
																	<td><?= $crewTravelDetail->vehicleMake ?></td>
																	<th>Pick-Up Time</th>
																	<td><?= $crewTravelDetail->pickUpTime ? date('h:i a', strtotime($crewTravelDetail->pickUpTime)) : '' ?></td>
																</tr>
																<tr>
																	<th>Driver's Name</th>
																	<td><?= $crewTravelDetail->driverName ?></td>
																	<th>Vehicle Model</th>
																	<td><?= $crewTravelDetail->vehicleModel ?></td>
																	<th>Drop-Off Time</th>
																	<td><?= $crewTravelDetail->dropOffTime ? date('h:i a', strtotime($crewTravelDetail->dropOffTime)) : '' ?></td>
																</tr>
																<tr>
																	<th>Phone Number</th>
																	<td><?= $crewTravelDetail->driverPhone ?></td>
																	<th>Vehicle Tag #</th>
																	<td><?= $crewTravelDetail->vehicleTag ?></td>
																	<th>Drop-Off Location</th>
																	<td><?= $crewTravelDetail->dropOffLocation ?></td>
																</tr>
																<tr>
																	<th>Notes</th>
																	<td><?= $crewTravelDetail->groundNotes ?></td>
																	<th></th>
																	<td></td>
																	<th></th>
																	<td></td>
																</tr>

																<tr style="text-align: center">
																	<th colspan="6"
																		style="background-color: black; color: white">
																		Accommodations
																	</th>
																</tr>
																<tr>
																	<th>Hotel Name</th>
																	<td><?= $crewTravelDetail->hotelName ?></td>
																	<th>Per-Diem</th>
																	<td><?= $crewTravelDetail->perDiem ?></td>
																	<th>Room Type</th>
																	<td><?= $crewTravelDetail->roomType ?></td>
																</tr>
																<tr>
																	<th>Hotel Stay (Total Nights)</th>
																	<td><?= $crewTravelDetail->hotelStay ?></td>
																	<th>Hotel Address</th>
																	<td><?= $crewTravelDetail->hotelAddress ?></td>
																	<th>Check-In</th>
																	<td><?= $crewTravelDetail->checkIn ? date('h:i a', strtotime($crewTravelDetail->checkIn)) : '' ?></td>
																</tr>
																<tr>
																	<th>Confirmation #</th>
																	<td><?= $crewTravelDetail->confirmationAccommodation ?></td>
																	<th></th>
																	<td></td>
																	<th>Check-Out</th>
																	<td><?= $crewTravelDetail->checkOut ? date('h:i a', strtotime($crewTravelDetail->checkOut)) : '' ?></td>
																</tr>
																<tr>
																	<th>Notes</th>
																	<td><?= $crewTravelDetail->accommodationNote ?></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
															</table>
														</td>
													</tr>
												<?php }
											} ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<label for="title" class="control-label">
									ROS POC </label>
								<div class="panel-body">
									<div class="table-responsive" style="overflow: auto;">
										<table id="pocTable" style="width: 99%;"
											   class="table table-bordered table-hover table-striped table-theatreCrew">
											<thead>
											<tr style="background-color: #D3D3D3;">
												<th>
													<label class="checkbox-inline font-weight-bold text-black">
														<input type="checkbox" id="selectPocAll"
															   style="margin-right: 8px;"> Select All
													</label>
												</th>
												<th>Details</th>
											</tr>
											</thead>
											<tbody>
											<?php
											if ($pocDetails) {
												foreach ($pocDetails as $key => $pocDetail) { ?>
													<tr>
														<td style="vertical-align: middle; border-bottom: 1px solid black">
															<label class="checkbox-inline font-weight-bold text-black"
																   for="poc<?= $key ?>"
																   style="display: flex; align-items: center;">
																<input class="poc-checkbox" type="checkbox"
																	   id="poc<?= $key ?>"
																	   value="<?= $pocDetail->id ?>" name="poc[]"
																	   style="margin-right: 8px;"> Select
															</label>
														</td>
														<td style="border-bottom: 1px solid black">
															<table class="table table-sm nested-table">
																<thead>
																<tr style="background-color: black; color: white;">
																	<th>POC Type</th>
																	<th>Name</th>
																	<th>Title</th>
																	<th>Phone</th>
																	<th>Email</th>
																</tr>
																</thead>
																<tbody>
																<tr>
																	<th>Primary</th>
																	<td><?= $pocDetail->name ?></td>
																	<td><?= $pocDetail->title ?></td>
																	<td><?= $pocDetail->phone ?></td>
																	<td><?= $pocDetail->email ?></td>
																</tr>
																<tr>
																	<th>Assistant</th>
																	<td><?= $pocDetail->assistantName ?></td>
																	<td><?= $pocDetail->assistantTitle ?></td>
																	<td><?= $pocDetail->assistantPhone ?></td>
																	<td><?= $pocDetail->assistantEmail ?></td>
																</tr>
																<tr>
																	<th>Back-Up</th>
																	<td><?= $pocDetail->backUpName ?></td>
																	<td><?= $pocDetail->backUpTitle ?></td>
																	<td><?= $pocDetail->backUpPhone ?></td>
																	<td><?= $pocDetail->backUpEmail ?></td>
																</tr>
																</tbody>
															</table>
														</td>
													</tr>
												<?php }
											} ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="row">
						<div class="form-group col-md-12">
							<button type="submit" id="submit" class="btn pull-right"
									style="background-color: black; color: white">Save
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<style>
	#remoteModal1 label {
		color: white;
	}

	.panel-default {
		color: white;
		border-color: #007bff;
		position: relative;
	}

	.control-label {
		position: absolute;
		top: -10px;
		left: 15px;
		padding: 0 5px;
		color: #007bff !important;
		background-color: #f8f9fa;
		font-size: 14px;
	}

	.checkbox-inline input[type="checkbox"] {
		width: 18px;
		height: 18px;
		margin-top: 0; /* Aligns checkbox with label text */
		cursor: pointer;
	}

	.checkbox-inline {
		font-weight: bold;
		color: #333;
		font-size: 14px;
	}

	.checkbox-inline input[type="checkbox"]:checked + label {
		color: #007bff; /* Adds color when checked */
	}

	td {
		font-weight: normal;
	}

	#dynamicTable th:nth-child(10),
	#dynamicTable td:nth-child(10) {
		display: none;
	}
</style>
<script>
	$('#showPrivateNote').change(function () {
		if ($('#showPrivateNote').is(':checked')) {
			$('#dynamicTable th:nth-child(10), #dynamicTable td:nth-child(10)').show();
		} else {
			$('#dynamicTable th:nth-child(10), #dynamicTable td:nth-child(10)').hide();
		}
	});
	document.getElementById('selectPocAll').addEventListener('change', function () {
		let checkboxes = document.querySelectorAll('.poc-checkbox');
		checkboxes.forEach((checkbox) => {
			checkbox.checked = this.checked;
		});
	});

	document.querySelectorAll('.poc-checkbox').forEach((checkbox) => {
		checkbox.addEventListener('change', function () {
			// If any checkbox is unchecked, uncheck the "Select All" box
			if (!this.checked) {
				document.getElementById('selectPocAll').checked = false;
			}
			// If all checkboxes are checked, check the "Select All" box
			else if (document.querySelectorAll('.poc-checkbox:checked').length === document.querySelectorAll('.poc-checkbox').length) {
				document.getElementById('selectPocAll').checked = true;
			}
		});
	});

	document.getElementById('selectTalentAll').addEventListener('change', function () {
		let checkboxes = document.querySelectorAll('.talent-checkbox');
		checkboxes.forEach((checkbox) => {
			checkbox.checked = this.checked;
		});
	});

	document.querySelectorAll('.talent-checkbox').forEach((checkbox) => {
		checkbox.addEventListener('change', function () {
			// If any checkbox is unchecked, uncheck the "Select All" box
			if (!this.checked) {
				document.getElementById('selectTalentAll').checked = false;
			}
			// If all checkboxes are checked, check the "Select All" box
			else if (document.querySelectorAll('.talent-checkbox:checked').length === document.querySelectorAll('.talent-checkbox').length) {
				document.getElementById('selectTalentAll').checked = true;
			}
		});
	});

	document.getElementById('selectCrewAll').addEventListener('change', function () {
		let checkboxes = document.querySelectorAll('.crew-checkbox');
		checkboxes.forEach((checkbox) => {
			checkbox.checked = this.checked;
		});
	});

	document.querySelectorAll('.crew-checkbox').forEach((checkbox) => {
		checkbox.addEventListener('change', function () {
			// If any checkbox is unchecked, uncheck the "Select All" box
			if (!this.checked) {
				document.getElementById('selectCrewAll').checked = false;
			}
			// If all checkboxes are checked, check the "Select All" box
			else if (document.querySelectorAll('.crew-checkbox:checked').length === document.querySelectorAll('.crew-checkbox').length) {
				document.getElementById('selectCrewAll').checked = true;
			}
		});
	});
</script>
