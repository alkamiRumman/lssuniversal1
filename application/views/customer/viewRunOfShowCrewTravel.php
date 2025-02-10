<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">
					<b class="title"><?= $data->title ?></b>
					<span class="description"><?= $data->description ?></span>
				</h3>
				<div class="form-group pull-right">
					<a class="btn btn-default"
					   href="<?= customer_url('/viewRunOfShowSchedule/' . $data->id) ?>">Schedule</a>
					<a class="btn btn-default active">Crew Travel</a>
					<a class="btn btn-default" href="<?= customer_url('viewRunOfShowTalentCrew/' . $data->id) ?>">Talent
						Travel</a>
					<a class="btn btn-default" href="<?= customer_url('viewRunOfShowPoc/' . $data->id) ?>">ROS POC</a>
					<?php if ($data->archivesStatus == 0) { ?>
						<a class="btn" style="color: white; background-color: black"
						   href="<?= customer_url('runOfShow') ?>">Back</a>
					<?php } else { ?>
						<a class="btn" style="color: white; background-color: black"
						   href="<?= customer_url('archives') ?>">Back</a>
					<?php } ?>
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
							<div class="panel-heading"><strong>Production Details</strong></div>
							<div class="panel-body" style="padding-bottom: 0">
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
				<div class="row">
					<div class="col-md-12">
						<div class="box box-default" style="background-color: #D3D3D3">
							<div class="box-header with-border"
								 style="background-color: black; color: white; border-top-right-radius: 5px; border-top-left-radius: 5px">
								<h5 class="box-title" style="font-size: 14px"><b>Production Crew Travel Details</b></h5>
								<?php if ($data->archivesStatus == 0) { ?>
									<a href="javascript:void(0);" style="background-color: #2D2D2D; color: white"
									   onclick="loadPopup('<?= customer_url('addRunOfShowCrewTravel/') . $data->id ?>')"
									   class="btn btn-xs pull-right"><i class="fa fa-plus"></i> Add New</a>
								<?php } ?>
							</div>
							<div class="box-body">
								<div class="table-responsive" style="overflow: auto;">
									<table id="theatreCrewTable" style="width: 99%;border-bottom: 1px solid black"
										   class="table table-bordered table-hover table-striped table-theatreCrew">
										<thead>
										<tr>
											<th>Traveler Information</th>
											<th>Travel Details</th>
											<?php if ($data->archivesStatus == 0) { ?>
												<th>Actions</th>
											<?php } ?>
										</tr>
										</thead>
										<tbody>
										<?php if ($crewTravelDetails) {
											foreach ($crewTravelDetails as $crewTravelDetail) { ?>
												<tr>
													<td style="vertical-align: middle;border-bottom: 1px solid black"><?= $crewTravelDetail->firstName . ' ' . $crewTravelDetail->lastName ?></td>
													<td style="border-bottom: 1pt solid black">
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
																	style="background-color: black; color: white">Ground
																	Trans
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
													<?php if ($data->archivesStatus == 0) { ?>
														<td style="vertical-align: middle; border-bottom: 1px solid black">
															<div class="dropdown">
																<button class="btn btn-sm dropdown-toggle"
																		style="color: white; background-color: black"
																		type="button"
																		data-toggle="dropdown">Actions
																	<span class="caret"></span></button>
																<ul class="dropdown-menu">
																	<li><a href="javascript:void(0);"
																		   onclick="loadPopup('<?= base_url('customer/editRunOfShowCrewTravel/' . $crewTravelDetail->id) ?>')">Edit</a>
																	</li>
																	<li>
																		<a href="<?= base_url('customer/deleteRunOfShowCrewTravel/' . $crewTravelDetail->id) ?>"
																		   onclick="return confirm('Are you sure?')">Delete</a>
																	</li>
																</ul>
															</div>
														</td>
													<?php } ?>
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
		</div>
	</div>
</div>
<style>
	.panel .panel-heading {
		color: white;
		background-color: black;
	}

	.box-title .title {
		font-weight: bold;
		font-size: 1.2em;
	}

	.box-title .description {
		display: block;
		font-weight: normal;
		font-size: 0.9em;
		color: #555;
		margin-top: 7px; /* Add spacing if needed */
	}

	/* Adjustments for nested tables */
	.nested-table {
		width: 100%;
		font-size: 12px;
		border-spacing: 0;
		border-collapse: collapse;
		margin-bottom: 0;
		padding-bottom: 0;
	}

	.table-theatreCrew,
	.table-theatreCrew td,
	.table-theatreCrew th {
		border: 1px solid #dee2e6;
	}

	#theatreCrewTable td,
	.nested-table td {
		font-weight: normal;
	}

</style>
<script>
	$(document).ready(function () {
		$('#theatreCrewTable').DataTable({
			ordering: false,
			"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
			"pageLength": 5
		});
	});
</script>
