<div class="modal fade in" id="modal-default" style="display: block; overflow: auto;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-sm btn-primary pull-right printButton" id="Print">Print</button>
				<button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal" aria-label="Close">
					Close
				</button>
				<h4 class="modal-title"><b>View Timed Access Link Details</b></h4>
			</div>
			<div class="modal-body" id="printThis">
				<div class="row">
					<div class="col-xs-12 text-center">
						<img class="responsive-img img-fluid" style="max-height: 150px;"
							 src="<?= base_url('images/3.png') ?>" alt="User Image">
					</div>
				</div>
				<hr style="border: 1px solid black;">
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table">
								<tr>
									<th>User Access Title</th>
									<td><?= $timedAccessLink->userAccessTitle ?></td>
									<th>Description</th>
									<td><?= $data->description ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
							<div class="panel-heading"><strong><?= $data->title ?></strong></div>
							<div class="panel-body" style="padding-bottom: 0; padding-top: 0">
								<div class="table-responsive">
									<table class="table">
										<tr>
											<th>Production Start Date</th>
											<td style="font-weight: normal"><?= date('d M Y', strtotime($data->startDate)) . ' ' . date('h:i:s A', strtotime($data->startTime)) ?></td>
											<th>Production End Date</th>
											<td style="font-weight: normal"><?= date('d M Y', strtotime($data->endDate)) . ' ' . date('h:i:s A', strtotime($data->endTime)) ?></td>
											<th>Production Venue</th>
											<td style="font-weight: normal"><?= $data->venueName ?></td>
											<th>Venue Address</th>
											<td style="font-weight: normal"><?= $data->address . ', ' . $data->city . ', ' . $data->state . ' - ' . $data->zip ?></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php if (!empty($runOfShowDetails)) { ?>
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<div class="panel-heading"><strong>Production Schedule</strong></div>
								<div class="panel-body" style="padding-bottom: 0; padding-top: 0">
									<div class="table-responsive">
										<table id="dynamicTable"
											   class="table table-bordered table-hover">
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
												<?php if ($timedAccessLink->showPrivateNote == 1) { ?>
													<th>Private Note Reminder</th>
												<?php } ?>
											</tr>
											</thead>
											<tbody>
											<?php
											$currentTitleId = null;
											foreach ($runOfShowDetails as $detail):
												if ($currentTitleId !== $detail['title_id']):
													$currentTitleId = $detail['title_id']; ?>
													<tr>
														<td colspan="<?= $timedAccessLink->showPrivateNote == 1 ? '10' : '9' ?>"
															style="background-color: black; color: white"><?= $detail['title_name']; ?></td>
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
													<?php if ($timedAccessLink->showPrivateNote == 1) { ?>
														<td><?= $detail['private_notes']; ?></td>
													<?php } ?>
												</tr>
											<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php }
				if (!empty($timedAccessLinkCrewTravel)) { ?>
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<div class="panel-heading"><strong>Crew Travel</strong></div>
								<div class="panel-body" style="padding-bottom: 0; padding-top: 0">
									<div class="table-responsive" style="overflow: auto;">
										<table id="talentTable" style="width: 100%;"
											   class="table table-bordered table-hover table-striped table-theatreCrew">
											<thead>
											<tr style="background-color: #D3D3D3;">
												<th>Traveler Information</th>
												<th>Travel Details</th>
											</tr>
											</thead>
											<tbody>
											<?php foreach ($timedAccessLinkCrewTravel as $key => $crewTravelDetail) { ?>
												<tr>
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
																<th>Date</th>
																<td><?= $crewTravelDetail->dateTo ? date('d M Y', strtotime($crewTravelDetail->dateTo)) : '' ?></td>
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
																<th>Date</th>
																<td><?= $crewTravelDetail->dateFrom ? date('d M Y', strtotime($crewTravelDetail->dateFrom)) : '' ?></td>
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
																<th>Check-In Date</th>
																<td><?= $crewTravelDetail->checkInDate ? date('d M Y', strtotime($crewTravelDetail->checkInDate)) : '' ?></td>
															</tr>
															<tr>
																<th>Confirmation #</th>
																<td><?= $crewTravelDetail->confirmationAccommodation ?></td>
																<th>Notes</th>
																<td><?= $crewTravelDetail->accommodationNote ?></td>
																<th>Check-Out Date</th>
																<td><?= $crewTravelDetail->checkOutDate ? date('d M Y', strtotime($crewTravelDetail->checkOutDate)) : '' ?></td>
															</tr>
															<tr>
																<th>Check-In Time</th>
																<td><?= $crewTravelDetail->checkIn ? date('h:i a', strtotime($crewTravelDetail->checkIn)) : '' ?></td>
																<th>Check-Out Time</th>
																<td><?= $crewTravelDetail->checkOut ? date('h:i a', strtotime($crewTravelDetail->checkOut)) : '' ?></td>
																<td></td>
																<td></td>
															</tr>
														</table>
													</td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php }
				if (!empty($timedAccessLinkTalentTravel)) { ?>
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<div class="panel-heading"><strong>Talent Travel</strong></div>
								<div class="panel-body" style="padding-bottom: 0; padding-top: 0">
									<div class="table-responsive" style="overflow: auto;">
										<table id="talentTable" style="width: 100%;"
											   class="table table-bordered table-hover table-striped table-talentCrew">
											<thead>
											<tr style="background-color: #D3D3D3;">
												<th>Traveler Information</th>
												<th>Travel Details</th>
											</tr>
											</thead>
											<tbody>
											<?php foreach ($timedAccessLinkTalentTravel as $key => $crewTravelDetail) { ?>
												<tr>
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
																<th>Date</th>
																<td><?= $crewTravelDetail->dateTo ? date('d M Y', strtotime($crewTravelDetail->dateTo)) : '' ?></td>
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
																<th>Date</th>
																<td><?= $crewTravelDetail->dateFrom ? date('d M Y', strtotime($crewTravelDetail->dateFrom)) : '' ?></td>
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
																<th>Check-In Date</th>
																<td><?= $crewTravelDetail->checkInDate ? date('d M Y', strtotime($crewTravelDetail->checkInDate)) : '' ?></td>
															</tr>
															<tr>
																<th>Confirmation #</th>
																<td><?= $crewTravelDetail->confirmationAccommodation ?></td>
																<th>Notes</th>
																<td><?= $crewTravelDetail->accommodationNote ?></td>
																<th>Check-Out Date</th>
																<td><?= $crewTravelDetail->checkOutDate ? date('d M Y', strtotime($crewTravelDetail->checkOutDate)) : '' ?></td>
															</tr>
															<tr>
																<th>Check-In Time</th>
																<td><?= $crewTravelDetail->checkIn ? date('h:i a', strtotime($crewTravelDetail->checkIn)) : '' ?></td>
																<th>Check-Out Time</th>
																<td><?= $crewTravelDetail->checkOut ? date('h:i a', strtotime($crewTravelDetail->checkOut)) : '' ?></td>
																<td></td>
																<td></td>
															</tr>
														</table>
													</td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php }
				if (!empty($timedAccessLinkPOC)) { ?>
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<div class="panel-heading"><strong>ROS POC</strong></div>
								<div class="panel-body" style="padding-bottom: 0; padding-top: 0">
									<div class="table-responsive" style="overflow: auto;">
										<table id="pocTable" style="width: 100%;"
											   class="table table-bordered table-hover table-striped table-poc">
											<tbody>
											<?php foreach ($timedAccessLinkPOC as $key => $pocDetail) { ?>
												<tr>
													<td style="border-bottom: 1px solid black">
														<table id="dynamicTable" class="table table-sm nested-table">
															<thead>
															<tr style="background-color: #D3D3D3;">
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
											<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<style>
	.panel .panel-heading {
		color: white;
		background-color: black;
	}

	td {
		font-weight: normal;
	}

	@media screen {
		#printSection {
			display: none;
		}
	}

	@media print {
		.responsive-img {
			height: 200px !important; /* Fixed height for print */
			width: auto !important; /* Maintain aspect ratio */
			max-width: 100% !important; /* Ensure it fits within the print area */
			object-fit: contain !important; /* Ensure the entire image is visible */
			display: block !important; /* Ensure proper layout */
			margin: 0 auto !important; /* Center image horizontally */
		}

		.logo {
			margin-top: 0;
		}

		body * {
			visibility: hidden;
		}

		#dynamicTable thead tr {
			background-color: #D9EDF7 !important;
			color: #000 !important;
			-webkit-print-color-adjust: exact;
			print-color-adjust: exact;
		}

		#dynamicTable thead th {
			background-color: #D3D3D3 !important;
			color: #000 !important;
		}

		@page {
			size: A4;
			margin: 0.5cm;
		}

		#printSection, #printSection * {
			visibility: visible;
		}

		.page-break {
			page-break-before: always;
			content: "";
			display: block;
			height: 0;
		}

		.modal-body {
			width: 21cm;
			min-height: 29.7cm;
			padding: 0.5cm;
			margin: 0;
			background: white;
		}

		#printSection {
			position: absolute;
			left: 0;
			top: 0;
		}

		.table {
			font-size: 12px;
			width: 100%;
			max-width: 100%;
			table-layout: auto;
			word-wrap: break-word;
		}

		/* Force page breaks for long tables */
		.page-break {
			page-break-before: always;
			content: "";
			display: block;
			height: 0;
		}
	}
</style>
<script>
	document.getElementById("Print").onclick = function () {
		printElement(document.getElementById("printThis"));
	};

	function printElement(elem) {
		var domClone = elem.cloneNode(true);

		var $printSection = document.getElementById("printSection");

		if (!$printSection) {
			var $printSection = document.createElement("div");
			$printSection.id = "printSection";
			document.body.appendChild($printSection);
		}

		$printSection.innerHTML = "";
		$printSection.appendChild(domClone);
		window.print();
	}
</script>
