<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-lg" style="width: 90%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-sm btn-primary pull-right printButton" id="Print">Print</button>
				<button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal" aria-label="Close">
					Close
				</button>
				<?php if ($data->adminStatus == 1) { ?>
					<a href="<?= customer_url('productionMarkRead/') . $data->id ?>"
					   onclick="return confirm('Are you sure?')"
					   class="btn btn-sm pull-right btn-warning">Mark as read</a>
				<?php } ?>
				<h4 class="modal-title"><b><?= $data->title ?> Details</b></h4>
			</div>
			<div class="modal-body" id="printThis">
				<div class="row logo">
					<div class="col-md-12">
						<div class="box">
							<div class="box-body" style="background: black">
								<div class="row">
									<div class="col-md-12 text-center">
										<img class="responsive-img" src="<?= base_url('images/3.png') ?>"
											 alt="User Image">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-xs-3">
						<div class="panel">
							<div class="panel-heading"><strong>Production Details</strong></div>
							<div class="panel-body">
								<table class="table"
									   style="border-collapse:separate;border-spacing: 7px">
									<tr>
										<th style="background-color: #BCBCBC; color: black">Production Id</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->id ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Production Title</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->title ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Start Date</th>
										<td style="background-color: #D9D9D9;color: black"><?= date('d M Y', strtotime($data->startDate)) . ' ' . date('h:i:s A', strtotime($data->startTime)) ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">End Date</th>
										<td style="background-color: #D9D9D9;color: black"><?= date('d M Y', strtotime($data->endDate)) . ' ' . date('h:i:s A', strtotime($data->endTime)) ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-xs-3">
						<div class="panel">
							<div class="panel-heading"><strong>Venue Details</strong></div>
							<div class="panel-body">
								<table class="table"
									   style="border-collapse:separate;border-spacing: 7px">
									<tr>
										<th style="background-color: #BCBCBC; color: black">Venue Name</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->venueName ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Address</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->address ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">City</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->city ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">State</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->state ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Zip</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->zip ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-xs-3">
						<div class="panel">
							<div class="panel-heading"><strong>Venue Rental Fees</strong></div>
							<div class="panel-body">
								<table class="table"
									   style="border-collapse:separate;border-spacing: 7px">
									<tr>
										<th style="background-color: #BCBCBC; color: black">Rental Fee</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->rentalFee > 0 ? '$' . number_format($data->rentalFee, 2) : 0 ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Back line Fee</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->backLine > 0 ? '$' . number_format($data->backLine, 2) : 0 ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Total</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->totalRentalFee > 0 ? '$' . number_format($data->totalRentalFee, 2) : 0 ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-xs-3">
						<div class="panel">
							<div class="panel-heading"><strong>Ticket Fees Details</strong></div>
							<div class="panel-body">
								<table class="table"
									   style="border-collapse:separate;border-spacing: 7px">
									<tr>
										<th style="background-color: #BCBCBC; color: black">Ticket Fee</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->ticketFee > 0 ? '$' . number_format($data->ticketFee, 2) : 0 ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Service Fee</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->serviceFee > 0 ? '$' . number_format($data->serviceFee, 2) : 0 ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Total</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->totalTicketFee > 0 ? '$' . number_format($data->totalTicketFee, 2) : 0 ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-xs-4">
						<div class="panel">
							<div class="panel-heading"><strong>Production Fee Details</strong></div>
							<div class="panel-body">
								<table class="table"
									   style="border-collapse:separate;border-spacing: 7px">
									<tr>
										<th style="background-color: #BCBCBC; color: black">Production Fee</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->productionFee > 0 ? '$' . number_format($data->productionFee, 2) : 0 ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Origination Fee</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->originationFee > 0 ? '$' . number_format($data->originationFee, 2) : 0 ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">COI</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->coi > 0 ? '$' . number_format($data->coi, 2) : 0 ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Total</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->totalProductionFee > 0 ? '$' . number_format($data->totalProductionFee, 2) : 0 ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-xs-4">
						<div class="panel">
							<div class="panel-heading"><strong>Venue Capacity</strong></div>
							<div class="panel-body">
								<table class="table"
									   style="border-collapse:separate;border-spacing: 7px">
									<tr>
										<th style="background-color: #BCBCBC; color: black">Standing</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->standing ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Orchestra</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->orchesta ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Mezzanine</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->mezzanine ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Belcony</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->balcony ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Total</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->totalVenueCapacity ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-xs-12">
						<div class="panel">
							<div class="panel-heading"><strong>Production Crew Details</strong></div>
							<div class="panel-body table-responsive">
								<table class="table">
									<tr>
										<th style="background-color: #BCBCBC; color: black">First Name</th>
										<th style="background-color: #BCBCBC; color: black">Last Name</th>
										<th style="background-color: #BCBCBC; color: black">Role/Title</th>
										<th style="background-color: #BCBCBC; color: black">Rate</th>
										<th style="background-color: #BCBCBC; color: black">Hotel Name</th>
										<th style="background-color: #BCBCBC; color: black">Hotel Nightly Rate</th>
										<th style="background-color: #BCBCBC; color: black">Hotel Stay (Total Nights)
										</th>
										<th style="background-color: #BCBCBC; color: black">Per Diem</th>
										<th style="background-color: #BCBCBC; color: black">Airline</th>
										<th style="background-color: #BCBCBC; color: black">Airline From</th>
										<th style="background-color: #BCBCBC; color: black">Airline To</th>
										<th style="background-color: #BCBCBC; color: black">Airline Ticket Type</th>
										<th style="background-color: #BCBCBC; color: black">Round Trip</th>
										<th style="background-color: #BCBCBC; color: black">Airline Ticket Cost</th>
										<th style="background-color: #BCBCBC; color: black">Ground Trans Co.</th>
										<th style="background-color: #BCBCBC; color: black">Ground Trans Cost</th>
										<th style="background-color: #BCBCBC; color: black">Misc. Fee</th>
										<th style="background-color: #BCBCBC; color: black">Equipment Rental</th>
										<th style="background-color: #BCBCBC; color: black">Total Cost</th>
										<th style="background-color: #BCBCBC; color: black">Notes</th>
									</tr>
									</thead>
									<tbody>
									<?php if ($crewData) {
										foreach ($crewData as $datum): ?>
											<tr id="<?= $datum->id ?>">
												<td><?= $datum->firstName ?></td>
												<td><?= $datum->lastName ?></td>
												<td><?= $datum->role ?></td>
												<td><?= $datum->rate > 0 ? '$' . number_format($datum->rate, 2) : 0 ?></td>
												<td><?= $datum->hotelName ?></td>
												<td><?= $datum->hotelNightlyRate > 0 ? '$' . number_format($datum->hotelNightlyRate, 2) : 0 ?></td>
												<td><?= $datum->totalNight ?></td>
												<td><?= $datum->perDiem > 0 ? '$' . number_format($datum->perDiem, 2) : 0 ?></td>
												<td><?= $datum->airline ?></td>
												<td><?= $datum->airlineFrom ?></td>
												<td><?= $datum->airlineTo ?></td>
												<td><?= $datum->airlineTicketType ?></td>
												<td><?= $datum->rountTrip ?></td>
												<td><?= $datum->ticketCost > 0 ? '$' . number_format($datum->ticketCost, 2) : 0 ?></td>
												<td><?= $datum->groundTransCo ?></td>
												<td><?= $datum->groundTransCost > 0 ? '$' . number_format($datum->groundTransCost, 2) : 0 ?></td>
												<td><?= $datum->miscFee > 0 ? '$' . number_format($datum->miscFee, 2) : 0 ?></td>
												<td><?= $datum->equipmentRental > 0 ? '$' . number_format($datum->equipmentRental, 2) : 0 ?></td>
												<td><?= $datum->crewCost > 0 ? '$' . number_format($datum->crewCost, 2) : 0 ?></td>
												<td><?= $datum->crewNotes ?></td>
											</tr>
										<?php endforeach;
									} else { ?>
										<tr>
											<td class="text-danger text-bold text-center" colspan="20">No record
												found!!
											</td>
										</tr>
									<?php } ?>
									</tbody>
									<?php if ($crewData) { ?>
										<tfoot>
										<tr>
											<th class="text-right" colspan="18">Total Crew Cost</th>
											<th>$<?= number_format(array_sum(array_column($crewData, 'crewCost')), 2) ?>
											</th>
											<th></th>
										</tr>
										</tfoot>
									<?php } ?>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-xs-12">
						<div class="panel">
							<div class="panel-heading"><strong>Entertainers & Crew Members Details</strong></div>
							<div class="panel-body table-responsive">
								<table class="table">
									<tr>
										<th style="background-color: #BCBCBC; color: black">First Name</th>
										<th style="background-color: #BCBCBC; color: black">Last Name</th>
										<th style="background-color: #BCBCBC; color: black">Role/Title</th>
										<th style="background-color: #BCBCBC; color: black">Booking Fee</th>
										<th style="background-color: #BCBCBC; color: black">Hotel Name</th>
										<th style="background-color: #BCBCBC; color: black">Hotel Nightly Rate</th>
										<th style="background-color: #BCBCBC; color: black">Hotel Stay (Total Nights)
										</th>
										<th style="background-color: #BCBCBC; color: black">Per Diem</th>
										<th style="background-color: #BCBCBC; color: black">Airline</th>
										<th style="background-color: #BCBCBC; color: black">Airline From</th>
										<th style="background-color: #BCBCBC; color: black">Airline To</th>
										<th style="background-color: #BCBCBC; color: black">Airline Ticket Type</th>
										<th style="background-color: #BCBCBC; color: black">Round Trip</th>
										<th style="background-color: #BCBCBC; color: black">Airline Ticket Cost</th>
										<th style="background-color: #BCBCBC; color: black">Ground Trans Co.</th>
										<th style="background-color: #BCBCBC; color: black">Ground Trans Cost</th>
										<th style="background-color: #BCBCBC; color: black">Rider Fee</th>
										<th style="background-color: #BCBCBC; color: black">Misc Fee</th>
										<th style="background-color: #BCBCBC; color: black">Total Cost</th>
										<th style="background-color: #BCBCBC; color: black">Notes</th>
									</tr>
									</thead>
									<tbody>
									<?php if ($entertainerData) {
										foreach ($entertainerData as $datum): ?>
											<tr id="<?= $datum->id ?>">
												<td><?= $datum->firstName ?></td>
												<td><?= $datum->lastName ?></td>
												<td><?= $datum->role ?></td>
												<td><?= $datum->bookingFee > 0 ? '$' . number_format($datum->bookingFee, 2) : 0 ?></td>
												<td><?= $datum->hotelName ?></td>
												<td><?= $datum->hotelNightlyRate > 0 ? '$' . number_format($datum->hotelNightlyRate, 2) : 0 ?></td>
												<td><?= $datum->totalNight ?></td>
												<td><?= $datum->perDiem > 0 ? '$' . number_format($datum->perDiem, 2) : 0 ?></td>
												<td><?= $datum->airline ?></td>
												<td><?= $datum->airlineFrom ?></td>
												<td><?= $datum->airlineTo ?></td>
												<td><?= $datum->airlineTicketType ?></td>
												<td><?= $datum->rountTrip ?></td>
												<td><?= $datum->ticketCost > 0 ? '$' . number_format($datum->ticketCost, 2) : 0 ?></td>
												<td><?= $datum->groundTransCo ?></td>
												<td><?= $datum->groundTransCost > 0 ? '$' . number_format($datum->groundTransCost, 2) : 0 ?></td>
												<td><?= $datum->miscFee > 0 ? '$' . number_format($datum->miscFee, 2) : 0 ?></td>
												<td><?= $datum->riderFee > 0 ? '$' . number_format($datum->riderFee, 2) : 0 ?></td>
												<td><?= $datum->entertainerCost > 0 ? '$' . number_format($datum->entertainerCost, 2) : 0 ?></td>
												<td><?= $datum->entertainerNotes ?></td>
											</tr>
										<?php endforeach;
									} else { ?>
										<tr>
											<td class="text-danger text-bold text-center" colspan="20">No record
												found!!
											</td>
										</tr>
									<?php } ?>
									</tbody>
									<?php if ($entertainerData) { ?>
										<tfoot>
										<tr>
											<th class="text-right" colspan="18">Total Entertainer Cost</th>
											<th>
												$<?= number_format(array_sum(array_column($entertainerData, 'entertainerCost')), 2) ?>
											</th>
											<th></th>
										</tr>
										</tfoot>
									<?php } ?>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-xs-4">
						<div class="panel">
							<div class="panel-heading"><strong>Theatre Crew Details</strong></div>
							<div class="panel-body">
								<table class="table">
									<tr>
										<th style="background-color: #BCBCBC; color: black">Theatre Crew Member Title
										</th>
										<th style="background-color: #BCBCBC; color: black">Hourly Rate</th>
										<th style="background-color: #BCBCBC; color: black">Labor Hours</th>
										<th style="background-color: #BCBCBC; color: black">Total</th>
									</tr>
									<tbody>
									<?php if ($theatreCrewData) {
										foreach ($theatreCrewData as $datum): ?>
											<tr id="<?= $datum->id ?>">
												<td><?= $datum->memberTitle ?></td>
												<td><?= $datum->hourlyRate > 0 ? '$' . number_format($datum->hourlyRate, 2) : 0 ?></td>
												<td><?= $datum->laborHour ?></td>
												<td><?= $datum->total > 0 ? '$' . number_format($datum->total, 2) : 0 ?></td>
											</tr>
										<?php endforeach;
									} else { ?>
										<tr>
											<td class="text-danger text-bold text-center" colspan="4">No record
												found!!
											</td>
										</tr>
									<?php } ?>
									</tbody>
									<?php if ($theatreCrewData) { ?>
										<tfoot>
										<tr>
											<th class="text-right" colspan="3">Total Theatre Crew Cost</th>
											<th>
												$<?= number_format(array_sum(array_column($theatreCrewData, 'total')), 2) ?>
											</th>
										</tr>
										</tfoot>
									<?php } ?>
								</table>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-xs-4">
						<div class="panel">
							<div class="panel-heading"><strong>Marketing Fees Details</strong></div>
							<div class="panel-body">
								<table class="table">
									<tr>
										<th style="background-color: #BCBCBC; color: black">Title</th>
										<th style="background-color: #BCBCBC; color: black">Total Fee</th>
									</tr>
									</thead>
									<tbody>
									<?php if ($marketingFeeData) {
										foreach ($marketingFeeData as $datum) { ?>
											<tr id="<?= $datum->id ?>">
												<td><?= $datum->title ?></td>
												<td><?= $datum->total > 0 ? '$' . number_format($datum->total, 2) : 0 ?></td>
											</tr>
										<?php }
									} else { ?>
										<tr>
											<td class="text-danger text-bold text-center" colspan="2">No record
												found!!
											</td>
										</tr>
									<?php } ?>
									</tbody>
									<?php if ($marketingFeeData) { ?>
										<tfoot>
										<tr>
											<th class="text-right">Total Marketing Fees</th>
											<th>
												$<?= number_format(array_sum(array_column($marketingFeeData, 'total')), 2) ?>
											</th>
										</tr>
										</tfoot>
									<?php } ?>
								</table>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-xs-4">
						<div class="panel">
							<div class="panel-heading"><strong>Rentals & MISC Details</strong></div>
							<div class="panel-body">
								<table class="table"
									   style="border-collapse:separate;border-spacing: 7px">
									<tr>
										<th style="background-color: #BCBCBC; color: black">Title</th>
										<th style="background-color: #BCBCBC; color: black">Total Fee</th>
									</tr>
									</thead>
									<tbody>
									<?php if ($rentalAndMiscData) {
										foreach ($rentalAndMiscData as $datum): ?>
											<tr id="<?= $datum->id ?>">
												<td><?= $datum->title ?></td>
												<td><?= $datum->total > 0 ? '$' . number_format($datum->total, 2) : 0 ?></td>
											</tr>
										<?php endforeach;
									} else { ?>
										<tr>
											<td class="text-danger text-bold text-center" colspan="2">No record
												found!!
											</td>
										</tr>
									<?php } ?>
									</tbody>
									<?php if ($rentalAndMiscData) { ?>
										<tfoot>
										<tr>
											<th class="text-right">Total Rentals & Misc</th>
											<th id="totalRentalAndMiscFees">
												$<?= number_format(array_sum(array_column($rentalAndMiscData, 'total')), 2) ?>
											</th>
										</tr>
										</tfoot>
									<?php } ?>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-xs-4">
						<div class="panel">
							<div class="panel-heading"><strong>Advertising Cost Details</strong></div>
							<div class="panel-body">
								<table class="table"
									   style="border-collapse:separate;border-spacing: 7px">
									<tr>
										<th style="background-color: #BCBCBC; color: black">Graphic Design</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->graphicDesign > 0 ? '$' . number_format($data->graphicDesign, 2) : 0 ?></td>
										<th style="background-color: #BCBCBC; color: black">Twitter</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->twitter > 0 ? '$' . number_format($data->twitter, 2) : 0 ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Radio</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->radio > 0 ? '$' . number_format($data->radio, 2) : 0 ?></td>
										<th style="background-color: #BCBCBC; color: black">TikTok</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->tikTok > 0 ? '$' . number_format($data->tikTok, 2) : 0 ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Television</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->television > 0 ? '$' . number_format($data->television, 2) : 0 ?></td>
										<th style="background-color: #BCBCBC; color: black">Printing</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->printing > 0 ? '$' . number_format($data->printing, 2) : 0 ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Billboard</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->billboard > 0 ? '$' . number_format($data->billboard, 2) : 0 ?></td>
										<th style="background-color: #BCBCBC; color: black">Traller Promo</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->trailerPromo > 0 ? '$' . number_format($data->trailerPromo, 2) : 0 ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Facebook</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->facebook > 0 ? '$' . number_format($data->facebook, 2) : 0 ?></td>
										<th style="background-color: #BCBCBC; color: black">Other</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->other > 0 ? '$' . number_format($data->other, 2) : 0 ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Instagram</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->instagram > 0 ? '$' . number_format($data->instagram, 2) : 0 ?></td>
										<th style="background-color: #BCBCBC; color: black">Total</th>
										<th style="background-color: #BCBCBC; color: black"><?= $data->totalAdvertising > 0 ? '$' . number_format($data->totalAdvertising, 2) : 0 ?></th>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-xs-4">
						<div class="panel">
							<div class="panel-heading"><strong>Final Calculation</strong></div>
							<div class="panel-body">
								<table class="table"
									   style="border-collapse:separate;border-spacing: 7px">
									<tr>
										<th style="background-color: #BCBCBC; color: black">Total Production Cost</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->totalProductionCost > 0 ? '$' . number_format($data->totalProductionCost, 2) : 0 ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Ticket Fee Total</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->finalTotalTicketFee > 0 ? '$' . number_format($data->finalTotalTicketFee, 2) : 0 ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Overall Production Cost</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->overallProductionCost > 0 ? '$' . number_format($data->overallProductionCost, 2) : 0 ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Base Ticket Price (Break
											Even)
										</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->baseTicketPrice > 0 ? '$' . number_format($data->baseTicketPrice, 2) : 0 ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Ticket Mark-up</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->ticketMarkup > 0 ? '$' . number_format($data->ticketMarkup, 2) : 0 ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">New Ticket Price</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->newTicketPrice > 0 ? '$' . number_format($data->newTicketPrice, 2) : 0 ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Projected POI</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->projectedROI > 0 ? '$' . number_format($data->projectedROI, 2) : 0 ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.panel-body {
		padding: 0;
	}

	.panel .panel-heading {
		color: white;
		background-color: black;
	}

	@media screen {
		#printSection {
			display: none;
		}
	}

	@media print {
		body * {
			visibility: hidden;
		}

		@page {
			size: A4 landscape;
		}

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

		#printSection, #printSection * {
			visibility: visible;
		}

		#printSection {
			position: absolute;
			left: 0;
			top: 0;
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
