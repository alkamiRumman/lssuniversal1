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
					   href="<?= admin_url('viewRunOfShowSchedule/' . $data->id) ?>">Schedule</a>
					<a class="btn btn-default" href="<?= admin_url('viewRunOfShowCrewTravel/' . $data->id) ?>">Crew
						Travel</a>
					<a class="btn btn-default" href="<?= admin_url('viewRunOfShowTalentCrew/' . $data->id) ?>">Talent
						Travel</a>
					<a class="btn btn-default active">ROS POC</a>
					<a class="btn" style="color: white; background-color: black"
					   href="<?= admin_url('runOfShow') ?>">Back</a>
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
										<th>Production Date & Time</th>
										<td style="font-weight: normal"><?= date('d M Y H:i:s A', strtotime($data->createAt)) ?></td>
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
							<div class="box-header with-border">
								<h3 class="box-title text-black"><b>SECTION 4: PRODUCTION POINT OF CONTACT</b></h3>
								<a href="javascript:void(0);" style="background-color: #2D2D2D; color: white"
								   onclick="loadPopup('<?= admin_url('addRunOfShowPoc/') . $data->id ?>')"
								   class="btn btn-sm pull-right"><i class="fa fa-plus"></i> Add New</a>
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
											<th>Actions</th>
										</tr>
										</thead>
										<tbody>
										<?php
										if ($pocDetails) {
										foreach ($pocDetails

										as $pocDetail) { ?>
										<tr>
											<td style="vertical-align: middle;"><?= date('d M Y h:i:s A', strtotime($pocDetail->createAt)) ?></td>
											<td>
												<table class="table table-sm nested-table">
													<thead>
													<tr style="background-color: #dee2e6; border: black">
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
											<td style="vertical-align: middle;"><?= $pocDetail->updateAt ? date('d M Y h:i:s A', strtotime($pocDetail->updateAt)) : '--' ?></td>
											<td style="vertical-align: middle;">
												<a href="javascript:void(0);"
												   onclick="loadPopup('<?= base_url('admin/editRunOfShowPoc/' . $pocDetail->id) ?>')"
												   class="btn btn-sm btn-info"><i
															class="fa fa-edit"></i></a>
												<a href="<?= base_url('admin/deleteRunOfShowPoc/' . $pocDetail->id) ?>"
												   class="btn btn-sm btn-danger"
												   onclick="return confirm('Are you sure?')">
													<i class="fa fa-trash"></i></a>
											</td>
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