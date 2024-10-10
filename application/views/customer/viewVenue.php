<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-lg" style="width: 70%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal" aria-label="Close">
					Close
				</button>
				<h4 class="modal-title"><b><?= $data->venueName ?> Details</b></h4>
			</div>
			<div class="modal-body">
				<div class="row logo">
					<div class="col-md-12">
						<div class="box">
							<div class="box-body" style="background: black">
								<div class="row">
									<div class="col-md-12 text-center">
										<img class="responsive-img" height="50" src="<?= base_url('images/3.png') ?>"
											 alt="User Image">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-xs-6">
						<div class="panel" style="padding: 0;">
							<div class="panel-heading"><strong>Venue Details</strong></div>
							<div class="panel-body" style="padding: 0;">
								<table class="table"
									   style="border-collapse:separate;border-spacing: 7px">
									<tr>
										<th style="background-color: #BCBCBC; color: black">Venue Name</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->venueName ?></td>
									</tr>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Venue Website</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->venueWebsite ?></td>
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
									<tr>
										<th style="background-color: #BCBCBC; color: black">Rental Fee</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->rentalFee ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-xs-6">
						<div class="panel">
							<div class="panel-heading"><strong>Venue Capacity</strong></div>
							<div class="panel-body" style="padding: 0;">
								<table class="table"
									   style="border-collapse:separate;border-spacing: 7px">
									<tbody>
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
										<th style="background-color: #BCBCBC; color: black">Balcony</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->balcony ?></td>
									</tr>
									</tbody>
									<tfoot>
									<tr>
										<th style="background-color: #BCBCBC; color: black">Total Capacity</th>
										<td style="background-color: #D9D9D9;color: black"><?= $data->totalVenueCapacity ?></td>
									</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-xs-6">
						<div class="panel">
							<div class="panel-heading"><strong>Venue Point of Contact</strong></div>
							<div class="panel-body" style="padding: 0;">
								<table class="table">
									<tr>
										<th style="background-color: #BCBCBC; color: black">Name</th>
										<th style="background-color: #BCBCBC; color: black">Title</th>
										<th style="background-color: #BCBCBC; color: black">Phone Number</th>
										<th style="background-color: #BCBCBC; color: black">Email</th>
									</tr>
									</thead>
									<tbody>
									<?php if ($pocs) {
										foreach ($pocs as $datum) { ?>
											<tr>
												<td><?= $datum->pocName ?></td>
												<td><?= $datum->pocTitle ?></td>
												<td><?= $datum->pocPhone ?></td>
												<td><?= $datum->pocEmail ?></td>
											</tr>
										<?php }
									} else { ?>
										<tr>
											<td class="text-danger text-bold text-center" colspan="4">No record
												found!!
											</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-xs-6">
						<div class="panel">
							<div class="panel-heading"><strong>Attachments</strong></div>
							<div class="panel-body" style="padding: 0;">
								<table class="table">
									<tr>
										<th style="background-color: #BCBCBC; color: black">Attachment Name</th>
										<th style="background-color: #BCBCBC; color: black">File</th>
									</tr>
									</thead>
									<tbody>
									<?php if ($attachments) {
										foreach ($attachments as $datum) { ?>
											<tr>
												<td><?= $datum->attachmentName ?></td>
												<?php $ext = pathinfo($datum->attachment, PATHINFO_EXTENSION);
												if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'jfif') { ?>
													<td>
														<img class="img-responsive img-thumbnail" width="250"
															 src="<?= base_url('images/venues/') . $datum->venueId . '/' . $datum->attachment ?>">
													</td>
												<?php } else { ?>
													<td><a href="javascript:void(0);"
														   onclick="loadPopup2('<?= base_url('customer/viewVenuePdf/') . $datum->id ?>')"><?= $datum->attachment ?></a>
													</td>
												<?php } ?>
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
	.panel .panel-heading {
		color: white;
		background-color: black;
	}
</style>
