<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Update Production Details</b></h3>
			</div>
			<form id="form" action="<?= admin_url('update/') . $data->id ?>" method="post">
				<div class="box-body">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4">
									<label for="title">PRODUCTION TITLE<span class="text-danger">*</span></label>
									<input class="form-control input-sm" type="text" name="title" id="title" required
										   placeholder="Enter production title"
										   value="<?= $data ? $data->title : '' ?>">
								</div>
								<div class="col-md-2">
									<label for="id">PRODUCTION ID<span class="text-danger">*</span></label>
									<input class="form-control input-sm" type="text" name="id" id="id" readonly
										   title="Production Id" value="<?= $data->id ?>"
										   style="border-color: #007bff;">
								</div>
								<div class="col-md-2">
									<label for="startDate">START DATE<b class="text-danger">*</b></label>
									<div class="input-group date">
										<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
										<input type="text" class="form-control input-sm" name="startDate" id="startDate"
											   value="<?= $data ? date('d M Y', strtotime($data->startDate)) : '' ?>"
											   required>
									</div>
								</div>
								<div class="col-md-1">
									<label for="startTime">START TIME<b class="text-danger">*</b></label>
									<input type="time" class="form-control input-sm" value="<?= $data->startTime ?>"
										   name="startTime" id="startTime" required>
								</div>
								<div class="col-md-2">
									<label for="endDate">END DATE<b class="text-danger">*</b></label>
									<div class="input-group date">
										<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
										<input type="text" class="form-control input-sm" name="endDate" id="endDate"
											   value="<?= $data ? date('d M Y', strtotime($data->endDate)) : '' ?>"
											   required>
									</div>
								</div>
								<div class="col-md-1">
									<label for="endTime">END TIME<b class="text-danger">*</b></label>
									<input type="time" class="form-control input-sm" value="<?= $data->endTime ?>"
										   name="endTime"
										   id="endTime" required>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-8">
							<div class="panel panel-default">
								<label for="title" class="control-label">
									VENUE </label>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-3">
											<label for="venueId">SELECT VENUE <span class="text-danger">*</span></label>
											<select id="venueId" name="venueId"
													class="form-control input-sm selectVenue"
													style="width: 100%;" required>
												<?php if ($data) { ?>
													<option value="<?= $data->venueId ?>"
															selected><?= $data->venueName ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-md-3">
											<label for="address">ADDRESS </label>
											<input class="form-control input-sm" type="text" name="address"
												   id="address" value="<?= $data ? $data->address : '' ?>" readonly>
										</div>
										<div class="col-md-2">
											<label for="city">CITY </label>
											<input class="form-control input-sm" type="text" name="city"
												   id="city" value="<?= $data ? $data->city : '' ?>" readonly>
										</div>
										<div class="col-md-2">
											<label for="state">STATE </label>
											<input class="form-control input-sm" type="state" name="state"
												   id="state" value="<?= $data ? $data->state : '' ?>" readonly>
										</div>
										<div class="col-md-2">
											<label for="zip"> Zip Code <b class="text-danger">*</b></label>
											<input class="form-control input-sm" type="text" name="zip" id="zip"
												   placeholder="Enter Zip Code" value="<?= $data ? $data->zip : '' ?>"
												   maxlength="5" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="panel panel-default">
								<label for="title" class="control-label">
									VENUE RENTAL FEES </label>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-4">
											<label for="rentalFee">RENTAL FEE </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm rental" type="number" step="any"
													   min="0"
													   name="rentalFee" value="<?= $data ? $data->rentalFee : '' ?>"
													   id="rentalFee" readonly>
											</div>
										</div>
										<div class="col-md-4">
											<label for="backLine">BACK LINE </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm rental" type="number" step="any"
													   min="0"
													   name="backLine" value="<?= $data ? $data->backLine : '' ?>"
													   id="backLine">
											</div>
										</div>
										<div class="col-md-4">
											<label for="totalRentalFee">TOTAL </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number" step="any" min="0"
													   name="totalRentalFee"
													   value="<?= $data ? $data->totalRentalFee : '' ?>"
													   id="totalRentalFee" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<div class="panel panel-default">
								<label for="title" class="control-label">
									TICKET FEES </label>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-4">
											<label for="ticketFee">TICKET FEE <span class="text-danger">*</span></label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number" step="any" min="0"
													   name="ticketFee" value="<?= $data ? $data->ticketFee : '' ?>"
													   id="ticketFee" required>
											</div>
										</div>
										<div class="col-md-4">
											<label for="serviceFee">SERVICE FEE </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm"
													   value="<?= $data ? $data->serviceFee : '' ?>"
													   type="number" step="any" min="0" name="serviceFee"
													   id="serviceFee">
											</div>
										</div>
										<div class="col-md-4">
											<label for="totalTicketFee">TOTAL </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm"
													   type="number" step="any" min="0"
													   value="<?= $data ? $data->totalTicketFee : '' ?>"
													   name="totalTicketFee" id="totalTicketFee" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-7">
							<div class="panel panel-default">
								<label for="title" class="control-label">
									PRODUCTION FEES </label>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-3">
											<label for="productionFee">PRODUCTION FEE </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm"
													   type="number" step="any" min="0"
													   value="<?= $data ? $data->productionFee : '' ?>"
													   name="productionFee" id="productionFee">
											</div>
										</div>
										<div class="col-md-3">
											<label for="originationFee">ORIGINATION FEE </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm"
													   type="number" step="any" min="0"
													   value="<?= $data ? $data->originationFee : '' ?>"
													   name="originationFee" id="originationFee">
											</div>
										</div>
										<div class="col-md-3">
											<label for="coi">COI </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm"
													   value="<?= $data ? $data->coi : '' ?>"
													   type="number" step="any" min="0" name="coi"
													   id="coi">
											</div>
										</div>
										<div class="col-md-3">
											<label for="totalProductionFee">TOTAL </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm"
													   type="number" step="any"
													   value="<?= $data ? $data->totalProductionFee : '' ?>"
													   min="0" name="totalProductionFee"
													   id="totalProductionFee" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<label for="title" class="control-label">
									VENUE CAPACITY</label>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-3">
											<label for="standing">STANDING </label>
											<input class="form-control input-sm" type="number"
												   onkeydown="if(event.key==='.'){event.preventDefault();}"
												   step="1" min="0" name="standing"
												   value="<?= $data ? $data->standing : '' ?>"
												   id="standing">
										</div>
										<div class="col-md-2">
											<label for="orchesta">ORCHESTA </label>
											<input class="form-control input-sm" type="number"
												   onkeydown="if(event.key==='.'){event.preventDefault();}"
												   step="1" min="0" name="orchesta"
												   value="<?= $data ? $data->orchesta : '' ?>"
												   id="orchesta">
										</div>
										<div class="col-md-2">
											<label for="mezzanine">MEZZANINE </label>
											<input class="form-control input-sm" type="number"
												   onkeydown="if(event.key==='.'){event.preventDefault();}"
												   step="1" min="0" name="mezzanine"
												   value="<?= $data ? $data->mezzanine : '' ?>"
												   id="mezzanine">
										</div>
										<div class="col-md-2">
											<label for="balcony">BALCONY </label>
											<input class="form-control input-sm" type="number"
												   onkeydown="if(event.key==='.'){event.preventDefault();}"
												   step="1" min="0" name="balcony"
												   value="<?= $data ? $data->balcony : '' ?>"
												   id="balcony">
										</div>
										<div class="col-md-3">
											<label for="totalVenueCapacity">TOTAL </label>
											<input class="form-control input-sm" type="number" step="1" min="0"
												   name="totalVenueCapacity"
												   value="<?= $data ? $data->totalVenueCapacity : '' ?>"
												   id="totalVenueCapacity" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="box box-default" style="background-color: #D3D3D3">
								<div class="box-header with-border">
									<h3 class="box-title text-black"><b>PRODUCTION CREW</b></h3>
									<a href="javascript:void(0);" style="background-color: #2D2D2D; color: white"
									   onclick="loadPopup('<?= admin_url('addCrewMember/') . $data->id ?>')"
									   class="btn btn-sm pull-right"><i class="fa fa-plus"></i> Add Crew
										Member</a>
								</div>
								<div class="box-body">
									<div class="table-responsive" style="overflow: auto;">
										<table id="crewTable" style="width: 99%;"
											   class="table table-bordered table-hover table-crewMember">
											<thead>
											<tr>
												<th>First Name</th>
												<th>Last Name</th>
												<th>Role/Title</th>
												<th>Rate</th>
												<th>Hotel Name</th>
												<th>Hotel Nightly Rate</th>
												<th>Hotel Stay (Total Nights)</th>
												<th>Per Diem</th>
												<th>Airline</th>
												<th>Airline From</th>
												<th>Airline To</th>
												<th>Airline Ticket Type</th>
												<th>Round Trip</th>
												<th>Airline Ticket Cost</th>
												<th>Ground Trans Co.</th>
												<th>Ground Trans Cost</th>
												<th>Misc. Fee</th>
												<th>Equipment Rental</th>
												<th>Total Cost</th>
												<th>Actions</th>
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
														<td>
															<a href="javascript:void(0);"
															   onclick="loadPopup('<?= base_url('admin/editCrewMember/' . $datum->id) ?>')"
															   class="btn btn-xs btn-info"><i
																	class="fa fa-edit"></i></a>
															<a href="javascript:void(0);"
															   class="btn btn-xs btn-danger deleteCrew"
															   id="<?= $datum->id ?>">
																<i class="fa fa-trash"></i></a>
														</td>
													</tr>
												<?php endforeach;
											} ?>
											</tbody>
											<tfoot>
											<tr>
												<th class="text-right" colspan="18">Total Crew Cost</th>
												<th>
													<input type="hidden" name="totalCrewCost"
														   id="totalCrewCost"
														   value="<?= array_sum(array_column($crewData, 'crewCost')) ?>">
													$<?= number_format(array_sum(array_column($crewData, 'crewCost')), 2) ?>
												</th>
												<th></th>
											</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="box box-default" style="background-color: #D3D3D3">
								<div class="box-header with-border">
									<h3 class="box-title text-black"><b>ENTERTAINERS & CREW MEMBERS</b></h3>
									<a href="javascript:void(0);" style="background-color: #2D2D2D; color: white"
									   onclick="loadPopup('<?= admin_url('addEntertainer/') . $data->id ?>')"
									   class="btn btn-sm pull-right"><i class="fa fa-plus"></i> Add
										Entertainer</a>
								</div>
								<div class="box-body">
									<div class="table-responsive" style="overflow: auto;">
										<table id="entertainerTable" style="width: 99%;"
											   class="table table-bordered table-hover table-entertainer">
											<thead>
											<tr>
												<th>First Name</th>
												<th>Last Name</th>
												<th>Role/Title</th>
												<th>Booking Fee</th>
												<th>Hotel Name</th>
												<th>Hotel Nightly Rate</th>
												<th>Hotel Stay (Total Nights)</th>
												<th>Per Diem</th>
												<th>Airline</th>
												<th>Airline From</th>
												<th>Airline To</th>
												<th>Airline Ticket Type</th>
												<th>Round Trip</th>
												<th>Airline Ticket Cost</th>
												<th>Ground Trans Co.</th>
												<th>Ground Trans Cost</th>
												<th>Rider Fee</th>
												<th>Misc Fee</th>
												<th>Total Cost</th>
												<th>Actions</th>
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
														<td>
															<a href="javascript:void(0);"
															   onclick="loadPopup('<?= base_url('admin/editEntertainer/' . $datum->id) ?>')"
															   class="btn btn-xs btn-info"><i
																	class="fa fa-edit"></i></a>
															<a href="javascript:void(0);"
															   class="btn btn-xs btn-danger deleteEntertainer"
															   id="<?= $datum->id ?>">
																<i class="fa fa-trash"></i></a>
														</td>
													</tr>
												<?php endforeach;
											} ?>
											</tbody>
											<tfoot>
											<tr>
												<th class="text-right" colspan="18">Total Entertainer Cost</th>
												<th>
													<input type="hidden" name="totalEntertainerCost"
														   id="totalEntertainerCost"
														   value="<?= array_sum(array_column($entertainerData, 'entertainerCost')) ?>">
													$<?= number_format(array_sum(array_column($entertainerData, 'entertainerCost')), 2) ?>
												</th>
												<th></th>
											</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="box box-default" style="background-color: #D3D3D3">
								<div class="box-header with-border">
									<h3 class="box-title text-black"><b>THEATRE CREW</b></h3>
									<a href="javascript:void(0);" style="background-color: #2D2D2D; color: white"
									   onclick="loadPopup('<?= admin_url('addTheatreCrew/') . $data->id ?>')"
									   class="btn btn-sm pull-right"><i class="fa fa-plus"></i> Add New</a>
								</div>
								<div class="box-body">
									<div class="table-responsive" style="overflow: auto;">
										<table id="theatreCrewTable" style="width: 99%;"
											   class="table table-bordered table-hover table-theatreCrew">
											<thead>
											<tr>
												<th>Theatre Crew Member Title</th>
												<th>Hourly Rate</th>
												<th>Labor Hours</th>
												<th>Total</th>
												<th>Actions</th>
											</tr>
											</thead>
											<tbody>
											<?php if ($theatreCrewData) {
												foreach ($theatreCrewData as $datum): ?>
													<tr id="<?= $datum->id ?>">
														<td><?= $datum->memberTitle ?></td>
														<td><?= $datum->hourlyRate > 0 ? '$' . number_format($datum->hourlyRate, 2) : 0 ?></td>
														<td><?= $datum->laborHour ?></td>
														<td><?= $datum->total > 0 ? '$' . number_format($datum->total, 2) : 0 ?></td>
														<td>
															<a href="javascript:void(0);"
															   onclick="loadPopup('<?= base_url('admin/editTheatreCrew/' . $datum->id) ?>')"
															   class="btn btn-xs btn-info"><i
																	class="fa fa-edit"></i></a>
															<a href="javascript:void(0);"
															   class="btn btn-xs btn-danger deleteTheatreCrew"
															   id="<?= $datum->id ?>">
																<i class="fa fa-trash"></i></a>
														</td>
													</tr>
												<?php endforeach;
											} ?>
											</tbody>
											<tfoot>
											<tr>
												<th class="text-right" colspan="3">Total Theatre Crew Cost</th>
												<th><input type="hidden" name="totalTheatreCrewCost"
														   id="totalTheatreCrewCost"
														   value="<?= array_sum(array_column($theatreCrewData, 'total')) ?>">
													$<?= number_format(array_sum(array_column($theatreCrewData, 'total')), 2) ?>
												</th>
												<th></th>
											</tr>
											</tfoot>
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
									ADVERTISING</label>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-2">
											<label for="graphicDesign">Graphic Design </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number"
													   step="any" min="0" name="graphicDesign"
													   value="<?= $data ? $data->graphicDesign : '' ?>"
													   id="graphicDesign">
											</div>
										</div>
										<div class="col-md-2">
											<label for="radio">Radio </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number"
													   value="<?= $data ? $data->radio : '' ?>"
													   step="any" min="0" name="radio" id="radio">
											</div>
										</div>
										<div class="col-md-2">
											<label for="television">Television </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number"
													   value="<?= $data ? $data->television : '' ?>"
													   step="any" min="0" name="television"
													   id="television">
											</div>
										</div>
										<div class="col-md-2">
											<label for="billboard">Billboard </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number"
													   value="<?= $data ? $data->billboard : '' ?>"
													   step="any" min="0" name="billboard" id="billboard">
											</div>
										</div>
										<div class="col-md-2">
											<label for="facebook">Facebook </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number"
													   value="<?= $data ? $data->facebook : '' ?>"
													   step="any" min="0" name="facebook"
													   id="facebook">
											</div>
										</div>
										<div class="col-md-2">
											<label for="instagram">Instagram </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number"
													   value="<?= $data ? $data->instagram : '' ?>"
													   step="any" min="0" name="instagram" id="instagram">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-2">
											<label for="twitter">Twitter</label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number"
													   value="<?= $data ? $data->twitter : '' ?>"
													   step="any" min="0" name="twitter"
													   id="twitter">
											</div>
										</div>
										<div class="col-md-2">
											<label for="tikTok">TikTok </label>
											<input class="form-control input-sm" type="number"
												   value="<?= $data ? $data->tikTok : '' ?>"
												   step="any" min="0" name="tikTok" id="tikTok">
										</div>
										<div class="col-md-2">
											<label for="printing">Printing </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number"
													   value="<?= $data ? $data->printing : '' ?>"
													   step="any" min="0" name="printing" id="printing">
											</div>
										</div>
										<div class="col-md-2">
											<label for="trailerPromo">Trailer Promo</label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number"
													   value="<?= $data ? $data->trailerPromo : '' ?>"
													   step="any" min="0" name="trailerPromo" id="trailerPromo">
											</div>
										</div>
										<div class="col-md-2">
											<label for="other">Other</label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number"
													   value="<?= $data ? $data->other : '' ?>"
													   step="any" min="0" name="other" id="other">
											</div>
										</div>
										<div class="col-md-2">
											<label for="totalAdvertising">TOTAL </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number" step="1" min="0"
													   value="<?= $data ? $data->totalAdvertising : '' ?>"
													   name="totalAdvertising"
													   id="totalAdvertising" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="box box-default" style="background-color: #D3D3D3">
								<div class="box-header with-border">
									<h3 class="box-title text-black"><b>MARKETING FEES</b></h3>
									<a href="javascript:void(0);" style="background-color: #2D2D2D; color: white"
									   onclick="loadPopup('<?= admin_url('addMarketingFee/') . $data->id ?>')"
									   class="btn btn-sm pull-right"><i class="fa fa-plus"></i> Add New</a>
								</div>
								<div class="box-body">
									<div class="table-responsive" style="overflow: auto;">
										<table id="marketingFeesTable" style="width: 99%;"
											   class="table table-bordered table-hover table-marketingFees">
											<thead>
											<tr>
												<th>Title</th>
												<th>Total Fee</th>
												<th>Actions</th>
											</tr>
											</thead>
											<tbody>
											<?php if ($marketingFeeData) {
												foreach ($marketingFeeData as $datum) { ?>
													<tr id="<?= $datum->id ?>">
														<td><?= $datum->title ?></td>
														<td><?= $datum->total > 0 ? '$' . number_format($datum->total, 2) : 0 ?></td>
														<td>
															<a href="javascript:void(0);"
															   onclick="loadPopup('<?= base_url('admin/editMarketingFee/' . $datum->id) ?>')"
															   class="btn btn-xs btn-info"><i
																	class="fa fa-edit"></i></a>
															<a href="javascript:void(0);"
															   class="btn btn-xs btn-danger deleteMarketingFees"
															   id="<?= $datum->id ?>">
																<i class="fa fa-trash"></i></a>
														</td>
													</tr>
												<?php }
											} ?>
											</tbody>
											<tfoot>
											<tr>
												<th class="text-right">Total Marketing Fees</th>
												<th>
													<input type="hidden" name="totalMarketingFees"
														   id="totalMarketingFees"
														   value="<?= array_sum(array_column($marketingFeeData, 'total')) ?>">
													$<?= number_format(array_sum(array_column($marketingFeeData, 'total')), 2) ?>
												</th>
												<th></th>
											</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box box-default" style="background-color: #D3D3D3">
								<div class="box-header with-border">
									<h3 class="box-title text-black"><b>RENTALS & MISC.</b></h3>
									<a href="javascript:void(0);" style="background-color: #2D2D2D; color: white"
									   onclick="loadPopup('<?= admin_url('addRentalAndMisc/') . $data->id ?>')"
									   class="btn btn-sm pull-right"><i class="fa fa-plus"></i> Add New</a>
								</div>
								<div class="box-body">
									<div class="table-responsive" style="overflow: auto;">
										<table id="rentalAndMiscTable" style="width: 99%;"
											   class="table table-bordered table-hover table-rentalAndMisc">
											<thead>
											<tr>
												<th>Title</th>
												<th>Total Fee</th>
												<th>Actions</th>
											</tr>
											</thead>
											<tbody>
											<?php if ($rentalAndMiscData) {
												foreach ($rentalAndMiscData as $datum): ?>
													<tr id="<?= $datum->id ?>">
														<td><?= $datum->title ?></td>
														<td><?= $datum->total > 0 ? '$' . number_format($datum->total, 2) : 0 ?></td>
														<td>
															<a href="javascript:void(0);"
															   onclick="loadPopup('<?= base_url('admin/editRentalAndMisc/' . $datum->id) ?>')"
															   class="btn btn-xs btn-info"><i
																	class="fa fa-edit"></i></a>
															<a href="javascript:void(0);"
															   class="btn btn-xs btn-danger deleteRentalAndMisc"
															   id="<?= $datum->id ?>">
																<i class="fa fa-trash"></i></a>
														</td>
													</tr>
												<?php endforeach;
											} ?>
											</tbody>
											<tfoot>
											<tr>
												<th class="text-right">Total Rentals & Misc</th>
												<th>
													<input type="hidden" name="totalRentalAndMiscFees"
														   id="totalRentalAndMiscFees"
														   value="<?= array_sum(array_column($rentalAndMiscData, 'total')) ?>">
													$<?= number_format(array_sum(array_column($rentalAndMiscData, 'total')), 2) ?>
												</th>
												<th></th>
											</tr>
											</tfoot>
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
									FINALIZE CALCULATION</label>
								<div class="panel-body finalizeCalculation">
									<div class="row">
										<div class="col-md-2">
											<label for="totalProductionCost">Total Production Cost </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number"
													   step="any" min="0" name="totalProductionCost"
													   id="totalProductionCost"
													   value="<?= $data ? $data->totalProductionCost : '' ?>" readonly>
											</div>
										</div>
										<div class="col-md-2">
											<label for="finalTotalTicketFee">Ticket Fees Total </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number"
													   step="any" min="0" name="finalTotalTicketFee"
													   id="finalTotalTicketFee"
													   value="<?= $data ? $data->finalTotalTicketFee : '' ?>"
													   readonly>
											</div>
										</div>
										<div class="col-md-2">
											<label for="overallProductionCost">Overall Production Cost </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number"
													   value="<?= $data ? $data->overallProductionCost : '' ?>"
													   step="any" min="0" name="overallProductionCost"
													   id="overallProductionCost" readonly>
											</div>
										</div>
										<div class="col-md-2">
											<label for="baseTicketPrice">Base Ticket Price (Break Even)</label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number"
													   value="<?= $data ? $data->baseTicketPrice : '' ?>"
													   step="any" min="0" name="baseTicketPrice" id="baseTicketPrice"
													   readonly>
											</div>
										</div>
										<div class="col-md-2">
											<label for="ticketMarkup">Ticket Mark-up </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number"
													   step="any" min="0" name="ticketMarkup"
													   value="<?= $data ? $data->ticketMarkup : '' ?>"
													   id="ticketMarkup">
											</div>
										</div>
										<div class="col-md-2">
											<label for="newTicketPrice">New Ticket Price </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number"
													   value="<?= $data ? $data->newTicketPrice : '' ?>"
													   step="any" min="0" name="newTicketPrice" id="newTicketPrice"
													   readonly>
											</div>
										</div>
										<div class="col-md-2">
											<label for="projectedROI">Projected ROI </label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input class="form-control input-sm" type="number"
													   value="<?= $data ? $data->projectedROI : '' ?>"
													   step="any" min="0" name="projectedROI" id="projectedROI"
													   readonly>
											</div>
										</div>
										<div class="col-md-2">
											<label for="ticketTieringCheckbox">TICKET TIERING </label><br>
											<input class="itemTimelineView-checkbox"
												   id="ticketTieringCheckbox"
												   type="checkbox"
												   onchange="ticketTieringBox(event)"
												   value="1"
												   name="ticketTieringCheckbox" <?= $data->ticketTieringCheckbox == 1 ? 'checked' : '' ?>
												   style="width:20px;height:20px;">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div
						class="row ticketTieringBox" <?= $data ? ($data->ticketTieringCheckbox == 1 ? '' : 'style="display: none;"') : 'style="display: none;"' ?>>
						<div class="col-md-12">
							<div class="box box-default" style="background-color: #D3D3D3">
								<div class="box-header with-border">
									<div class="row">
										<div class="col-md-7">
											<h3 class="box-title"><b>TICKET TIERING</b></h3>
										</div>
										<div class="col-md-2 form-group">
											<div class="input-group">
												<span style="background-color: black; color: white"
													  class="input-group-addon">VENUE CAPACITY</span>
												<input class="form-control input-sm" type="number"
													   step="any" min="0" name="graphicDesign"
													   value="<?= $data ? $data->totalVenueCapacity : '' ?>"
													   id="ticketTieringVenueCapacity" readonly>
											</div>
										</div>
										<div class="col-md-2 form-group">
											<div class="input-group">
												<span style="background-color: black; color: white"
													  class="input-group-addon">REMAINING SEATS</span>
												<input class="form-control input-sm" type="number"
													   step="any" min="0" name="remainingSeats"
													   value="<?= $data ? $data->remainingSeats : '' ?>"
													   id="remainingSeats" readonly>
											</div>
										</div>
										<div class="col-md-1 form-group">
											<a href="javascript:void(0);"
											   style="background-color: #2D2D2D; color: white"
											   onclick="loadPopup('<?= admin_url('addTicketTiering/') . $data->id ?>' + '/' + document.getElementById('baseTicketPrice').value + '/' + document.getElementById('remainingSeats').value)"
											   class="btn btn-sm pull-right"><i class="fa fa-plus"></i> Add New</a>
										</div>
									</div>
									<div class="box-body">
										<div class="table-responsive" id="ticketTieringTableDiv"
											 style="overflow: auto;">
											<table id="ticketTieringTable" style="width: 99%;"
												   class="table table-bordered table-hover table-ticketTieringTable">
												<thead>
												<tr>
													<th>TIER LEVEL</th>
													<th>SELECTION</th>
													<th># OF SEATS</th>
													<th>BASE TICKET PRICE</th>
													<th>TICKET MARK-UP</th>
													<th>NEW TICKET PRICE</th>
													<th>ROI</th>
													<th>ACTION</th>
												</tr>
												</thead>
												<tbody>
												<?php if ($ticketTieringData) {
													foreach ($ticketTieringData as $datum): ?>
														<tr id="<?= $datum->id ?>"
															class="<?= $datum->comp == 1 ? 'bg-red' : '' ?>">
															<td><?= $datum->tierLevel ?></td>
															<td><?= $datum->section ?></td>
															<td><?= $datum->ofSeats ?></td>
															<td><?= $datum->baseTicketPrice ?></td>
															<td><?= $datum->ticketMarkUp ?></td>
															<td><?= $datum->newTicketPrice ?></td>
															<td><?= $datum->roi ?></td>
															<td>
																<a href="javascript:void(0);"
																   onclick="loadPopup('<?= base_url('admin/editTicketTiering/' . $datum->id) ?>' + '/' + document.getElementById('baseTicketPrice').value + '/' + document.getElementById('remainingSeats').value)"
																   class="btn btn-xs btn-info"><i
																		class="fa fa-edit"></i></a>
																<a href="javascript:void(0);"
																   class="btn btn-xs btn-danger"
																   onclick="deleteTicketTiering(event, <?= $datum->id ?>)"
																   id="<?= $datum->id ?>">
																	<i class="fa fa-trash"></i></a>
															</td>
														</tr>
													<?php endforeach;
												} ?>
												</tbody>
												<tfoot>
												<tr>
													<th colspan="6" class="text-right">Total Ticket Tiering ROI</th>
													<th>
														<input type="hidden" name="totalROI"
															   id="totalROI"
															   value="<?= $ticketTieringData ? number_format(array_sum(array_column($ticketTieringData, 'roi')), 2) : 0 ?>">
														<input type="hidden" id="totalOfSeats" name="totalOfSeats"
															   value="<?= number_format(array_sum(array_column($ticketTieringData, 'ofSeats')), 2); ?>">
														$<?= number_format(array_sum(array_column($ticketTieringData, 'roi')), 2) ?>
													</th>
													<th></th>
												</tr>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="col-md-12 text-center">
							<button type="submit" class="btn" style="color: white; background-color: #0081CE">Update
							</button>
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

	.table-crewMember {
		font-size: 12px;
	}

	.table-theatreCrew {
		font-size: 12px;
	}

	.table-entertainer {
		font-size: 12px;
	}

	.table-marketingFees {
		font-size: 12px;
	}

	.table-rentalAndMisc {
		font-size: 12px;
	}

	.panel-default {
		background-color: #0E2231;
		color: white;
		border-color: #007bff;
		position: relative;
	}

	.panel-crew {
		background-color: #D3D3D3;
		color: white;
		border-color: #007bff;
		position: relative;
	}

	#crewTable tbody tr {
		background-color: #D3D3D3;
	}

	#theatreCrewTable tbody tr {
		background-color: #D3D3D3;
	}

	#entertainerTable tbody tr {
		background-color: #D3D3D3;
	}

	#marketingFeesTable tbody tr {
		background-color: #D3D3D3;
	}

	#rentalAndMiscTable tbody tr {
		background-color: #D3D3D3;
	}

	#crewTable tbody tr:hover {
		background-color: white;
	}

	#theatreCrewTable tbody tr:hover {
		background-color: white;
	}

	#entertainerTable tbody tr:hover {
		background-color: white;
	}

	#marketingFeesTable tbody tr:hover {
		background-color: white;
	}

	#rentalAndMiscTable tbody tr:hover {
		background-color: white;
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
</style>
<script>
	function ticketTieringBox(event) {
		console.log(event);
		const checkbox = $(event.target);
		const isChecked = checkbox.is(':checked') ? 1 : 0;
		console.log('clicked');
		console.log(isChecked);
		if (isChecked) {
			$('.ticketTieringBox').show();
		} else {
			$('.ticketTieringBox').hide();
		}
	}

	$('#totalOfSeats').on('change', function () {
		var totalOfSeats = parseInt($('#totalOfSeats').val()) || 0;
		var totalSeats = parseInt($('#totalVenueCapacity').val()) || 0;
		var remaining = totalSeats - totalOfSeats;
		$('#remainingSeats').val(remaining);
	})

	$('#startDate, #endDate').datepicker({
		autoclose: true,
		todayHighlight: true,
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd M yy'
	});

	$('#startTime, #endTime').on('focus click', function () {
		this.showPicker();
	});

	$(function () {
		$(".selectVenue").select2({
			placeholder: "Select Venue",
			ajax: {
				url: '<?= admin_url("getVenueSearch") ?>',
				dataType: 'json',
				type: "POST",
				quietMillis: 50,
				allowClear: true,
				data: function (params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				}
			}
		}).on('select2:select', function (event) {
			var data = event.params.data;
			$('#address').val(data.address);
			$('#city').val(data.city);
			$('#state').val(data.state);
			$('#zip').val(data.zip);
			$('#rentalFee').val(data.rentalFee);
			var backLine = parseFloat($('#backLine').val()) || 0;
			var totalRentalFee = parseFloat(data.rentalFee) + backLine;
			$('#totalRentalFee').val(totalRentalFee);
			$('#standing').val(data.standing);
			$('#orchesta').val(data.orchesta);
			$('#mezzanine').val(data.mezzanine);
			$('#balcony').val(data.balcony);
			$('#totalVenueCapacity').val(data.totalVenueCapacity);
			calculateCosts();
		});
	});
	$(document).ready(function () {
		const tableIds = [
			'#crewTable',
			'#theatreCrewTable',
			'#entertainerTable',
			'#marketingFeesTable',
			'#rentalAndMiscTable'
		];

		tableIds.forEach(function (tableId) {
			$(tableId).DataTable({
				ordering: false,
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				"pageLength": 5
			});
		});

		calculateCosts();
	});
	$('#rentalFee, #backLine').on('input', function () {
		var rentalFee = parseFloat($('#rentalFee').val()) || 0;
		var backLine = parseFloat($('#backLine').val()) || 0;
		var total = rentalFee + backLine;
		$('#totalRentalFee').val(total.toFixed(2));
		calculateCosts();
	});
	$('#ticketFee, #serviceFee').on('input', function () {
		var ticketFee = parseFloat($('#ticketFee').val()) || 0;
		var serviceFee = parseFloat($('#serviceFee').val()) || 0;
		var total = ticketFee + serviceFee;
		$('#totalTicketFee').val(total.toFixed(2));
		calculateCosts();
	});
	$('#productionFee, #originationFee, #coi').on('input', function () {
		var productionFee = parseFloat($('#productionFee').val()) || 0;
		var originationFee = parseFloat($('#originationFee').val()) || 0;
		var coi = parseFloat($('#coi').val()) || 0;
		var total = productionFee + originationFee + coi;
		$('#totalProductionFee').val(total.toFixed(2));
		calculateCosts();
	});
	$('#standing, #orchesta, #mezzanine, #balcony').on('input', function () {
		var standing = parseInt($('#standing').val()) || 0;
		var orchesta = parseInt($('#orchesta').val()) || 0;
		var mezzanine = parseInt($('#mezzanine').val()) || 0;
		var balcony = parseInt($('#balcony').val()) || 0;
		var total = standing + orchesta + mezzanine + balcony;
		$('#totalVenueCapacity').val(total);
		calculateCosts();
	});
	$('#graphicDesign, #radio, #television, #billboard, #facebook, #instagram, #twitter, #tikTok, #printing, #trailerPromo, #other').on('input', function () {
		var graphicDesign = parseFloat($('#graphicDesign').val()) || 0;
		var radio = parseFloat($('#radio').val()) || 0;
		var television = parseFloat($('#television').val()) || 0;
		var billboard = parseFloat($('#billboard').val()) || 0;
		var facebook = parseFloat($('#facebook').val()) || 0;
		var instagram = parseFloat($('#instagram').val()) || 0;
		var twitter = parseFloat($('#twitter').val()) || 0;
		var tikTok = parseFloat($('#tikTok').val()) || 0;
		var printing = parseFloat($('#printing').val()) || 0;
		var trailerPromo = parseFloat($('#trailerPromo').val()) || 0;
		var other = parseFloat($('#other').val()) || 0;
		var total = graphicDesign + radio + television + billboard + facebook + instagram + twitter + tikTok + printing + trailerPromo + other;
		$('#totalAdvertising').val(total);
		calculateCosts();
	});
	$('#ticketMarkup').on('input', function () {
		calculateCosts();
	});

	function calculateCosts() {
		var totalRentalFee = parseFloat($('#totalRentalFee').val()) || 0;
		var totalTicketFee = parseFloat($('#totalTicketFee').val()) || 0;
		var totalProductionFee = parseFloat($('#totalProductionFee').val()) || 0;
		var totalVenueCapacity = parseInt($('#totalVenueCapacity').val()) || 0;
		var totalCrewCost = parseFloat($('#totalCrewCost').val()) || 0;
		var totalEntertainerCost = parseFloat($('#totalEntertainerCost').val()) || 0;
		var totalTheatreCrewCost = parseFloat($('#totalTheatreCrewCost').val()) || 0;
		var totalAdvertising = parseFloat($('#totalAdvertising').val()) || 0;
		var totalMarketingFees = parseFloat($('#totalMarketingFees').val()) || 0;
		var totalRentalAndMiscFees = parseFloat($('#totalRentalAndMiscFees').val()) || 0;
		var ticketMarkup = parseFloat($('#ticketMarkup').val()) || 0;

		var total = totalRentalFee + totalProductionFee + totalCrewCost + totalEntertainerCost +
			totalTheatreCrewCost + totalAdvertising + totalMarketingFees + totalRentalAndMiscFees;

		var finalTotalTicketFee = totalTicketFee * totalVenueCapacity;
		var overallProductionCost = total + finalTotalTicketFee;
		var baseTicketPrice = totalVenueCapacity > 0 ? (overallProductionCost / totalVenueCapacity) : 0;
		var newTicketPrice = baseTicketPrice + ticketMarkup;

		var projectedROI = (newTicketPrice * totalVenueCapacity) - overallProductionCost;

		$('#totalProductionCost').val(total.toFixed(2));
		$('#finalTotalTicketFee').val(finalTotalTicketFee.toFixed(2));
		$('#overallProductionCost').val(overallProductionCost.toFixed(2));
		$('#baseTicketPrice').val(baseTicketPrice.toFixed(2));
		$('#newTicketPrice').val(newTicketPrice.toFixed(2));
		$('#projectedROI').val(projectedROI.toFixed(2));
	}


	$('#crewTable').on('click', '.deleteCrew', function (e) {
		e.preventDefault();
		if (confirm('Are you sure?') == true) {
			var id = $(this).attr("id");
			$.ajax({
				url: '<?= admin_url('deleteCrewMember/') ?>' + id,
				type: 'POST',
				cache: false,
				error: function () {
					toastr.warning('Something is wrong');
				},
				success: function (data) {
					$('#' + id).remove();
					$("#crewTable").load(window.location + " #crewTable > *");
					setTimeout(function () {
						calculateCosts();
					}, 1000);
					toastr.success("Record successfully deleted.");
				}
			});
		}
	})
	$('#entertainerTable').on('click', '.deleteEntertainer', function (e) {
		e.preventDefault();
		if (confirm('Are you sure?') == true) {
			var id = $(this).attr("id");
			$.ajax({
				url: '<?= admin_url('deleteEntertainer/') ?>' + id,
				type: 'POST',
				cache: false,
				error: function () {
					toastr.warning('Something is wrong');
				},
				success: function (data) {
					$('#' + id).remove();
					$("#entertainerTable").load(window.location + " #entertainerTable > *");
					setTimeout(function () {
						calculateCosts();
					}, 1000);
					toastr.success("Record successfully deleted.");
				}
			});
		}
	})
	$('#theatreCrewTable').on('click', '.deleteTheatreCrew', function (e) {
		e.preventDefault();
		if (confirm('Are you sure?') == true) {
			var id = $(this).attr("id");
			$.ajax({
				url: '<?= admin_url('deleteTheatreCrew/') ?>' + id,
				type: 'POST',
				cache: false,
				error: function () {
					toastr.warning('Something is wrong');
				},
				success: function (data) {
					$('#' + id).remove();
					$("#theatreCrewTable").load(window.location + " #theatreCrewTable > *");
					setTimeout(function () {
						calculateCosts();
					}, 1000);
					toastr.success("Record successfully deleted.");
				}
			});
		}
	})
	$('#marketingFeesTable').on('click', '.deleteMarketingFees', function (e) {
		e.preventDefault();
		if (confirm('Are you sure?') == true) {
			var id = $(this).attr("id");
			$.ajax({
				url: '<?= admin_url('deleteMarketingFee/') ?>' + id,
				type: 'POST',
				cache: false,
				error: function () {
					toastr.warning('Something is wrong');
				},
				success: function (data) {
					$('#' + id).remove();
					$("#marketingFeesTable").load(window.location + " #marketingFeesTable > *");
					setTimeout(function () {
						calculateCosts();
					}, 1000);
					toastr.success("Record successfully deleted.");
				}
			});
		}
	})
	$('#rentalAndMiscTable').on('click', '.deleteRentalAndMisc', function (e) {
		e.preventDefault();
		if (confirm('Are you sure?') == true) {
			var id = $(this).attr("id");
			$.ajax({
				url: '<?= admin_url('deleteRentalAndMisc/') ?>' + id,
				type: 'POST',
				cache: false,
				error: function () {
					toastr.warning('Something is wrong');
				},
				success: function (data) {
					$('#' + id).remove();
					$("#rentalAndMiscTable").load(window.location + " #rentalAndMiscTable > *");
					setTimeout(function () {
						calculateCosts();
					}, 1000);
					toastr.success("Record successfully deleted.");
				}
			});
		}
	})
</script>
