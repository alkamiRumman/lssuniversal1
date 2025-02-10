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
					   href="<?= customer_url('viewRunOfShowSchedule/' . $data->id) ?>">Schedule</a>
					<a class="btn btn-default" href="<?= customer_url('viewRunOfShowCrewTravel/' . $data->id) ?>">Crew
						Travel</a>
					<a class="btn btn-default" href="<?= customer_url('viewRunOfShowTalentCrew/' . $data->id) ?>">Talent
						Travel</a>
					<a class="btn btn-default active">ROS POC</a>
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
								<h3 class="box-title" style="font-size: 14px"><b>Production Point Of Contact</b></h3>
								<?php if ($data->archivesStatus == 0) { ?>
									<a href="javascript:void(0);" style="background-color: #2D2D2D; color: white"
									   onclick="loadPopup('<?= customer_url('addRunOfShowPoc/') . $data->id ?>')"
									   class="btn btn-xs pull-right"><i class="fa fa-plus"></i> Add New</a>
								<?php } ?>
							</div>
							<div class="box-body">
								<div class="table-responsive" style="overflow: auto;">
									<table id="dynamicTable" style="width: 99%;"
										   class="table table-bordered table-hover">
										<thead>
										<tr>
											<th>Create At</th>
											<th>Details</th>
											<th>Last Update</th>
											<?php if ($data->archivesStatus == 0) { ?>
												<th>Actions</th>
											<?php } ?>
										</tr>
										</thead>
										<tbody>
										<?php
										if ($pocDetails) {
											foreach ($pocDetails as $pocDetail) { ?>
												<tr>
													<td style="vertical-align: middle; border-bottom: 1px solid black"><?= date('d M Y h:i:s A', strtotime($pocDetail->createAt)) ?></td>
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
													<td style="vertical-align: middle;border-bottom: 1px solid black"><?= $pocDetail->updateAt ? date('d M Y h:i:s A', strtotime($pocDetail->updateAt)) : '--' ?></td>
													<?php if ($data->archivesStatus == 0) { ?>
														<td style="vertical-align: middle;border-bottom: 1px solid black">
															<div class="dropdown">
																<button class="btn btn-sm dropdown-toggle"
																		style="color: white; background-color: black"
																		type="button"
																		data-toggle="dropdown">Actions
																	<span class="caret"></span></button>
																<ul class="dropdown-menu">
																	<li><a href="javascript:void(0);"
																		   onclick="loadPopup('<?= base_url('customer/editRunOfShowPoc/' . $pocDetail->id) ?>')">Edit</a>
																	</li>
																	<li>
																		<a href="<?= base_url('customer/deleteRunOfShowPoc/' . $pocDetail->id) ?>"
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

	/* Reduce border thickness */
	.table-theatreCrew,
	#dynamicTable td,
	#dynamicTable th {
		border: 1px solid #dee2e6;
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

	#dynamicTable td,
	.nested-table td {
		font-weight: normal;
	}

</style>
<script>
	$(document).ready(function () {
		$('#dynamicTable').DataTable({
			ordering: false,
			"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
			"pageLength": 5
		});
	});
</script>
