<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">
					<b class="title"><?= $data->title ?></b>
					<span class="description"><?= $data->description ?></span>
				</h3>
				<div class="form-group pull-right">
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
								<h5 class="box-title" style="font-size: 14px"><b>Timed Access Link</b></h5>
								<?php if ($data->archivesStatus == 0) { ?>
									<a href="javascript:void(0);" style="background-color: #2D2D2D; color: white"
									   onclick="loadPopup('<?= customer_url('addTimeAccessLink/') . $data->id ?>')"
									   class="btn btn-xs pull-right"><i class="fa fa-plus"></i> Add New</a>
								<?php } ?>
							</div>
							<div class="box-body">
								<div class="table-responsive" style="overflow: auto;">
									<table id="timedAccessLink" style="width: 99%;border-bottom: 1px solid black"
										   class="table table-bordered table-hover table-striped table-timedAccessLink">
										<thead>
										<tr>
											<th>ID</th>
											<th>User Access Title</th>
											<th>Production Schedule</th>
											<th>Show Private Note</th>
											<th>Crew Travel</th>
											<th>Talent Travel</th>
											<th>ROS POC</th>
											<th>Link Status</th>
											<?php if ($data->archivesStatus == 0) { ?>
												<th>Actions</th>
											<?php } ?>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($timedAccessLink as $item) { ?>
											<tr style="font-weight: normal">
												<td><?= $item->id ?></td>
												<td><?= $item->userAccessTitle ?></td>
												<td><?= $item->showProduction == 1 ? '<span class="label" style="background-color: black">Yes</span>' : '<span class="label" style="background-color: gray">No</span>' ?></td>
												<td><?= $item->showPrivateNote == 1 ? '<span class="label" style="background-color: black">Yes</span>' : '<span class="label" style="background-color: gray">No</span>' ?></td>
												<td><?php if ($timedAccessLinkCrewTravel) { ?>
														<ul class="list-unstyled">
															<?php foreach ($timedAccessLinkCrewTravel as $data1) {
																if ($item->id == $data1->timedAccessLinkId) {
																	echo '<li>' . $data1->firstName . ' ' . $data1->lastName . '</li>';
																}
															} ?>
														</ul>
													<?php } ?></td>
												<td><?php if ($timedAccessLinkTalentTravel) { ?>
														<ul class="list-unstyled">
															<?php foreach ($timedAccessLinkTalentTravel as $data1) {
																if ($item->id == $data1->timedAccessLinkId) {
																	echo '<li>' . $data1->firstName . ' ' . $data1->lastName . '</li>';
																}
															} ?>
														</ul>
													<?php } ?></td>
												<td><?php if ($timedAccessLinkPOC) { ?>
														<ul class="list-unstyled">
															<?php foreach ($timedAccessLinkPOC as $data1) {
																if ($item->id == $data1->timedAccessLinkId) {
																	echo '<li>' . $data1->name . ' (' . $data1->title . ')</li>';
																}
															} ?>
														</ul>
													<?php } ?></td>
												<td><select class="status" id="<?= $item->id ?>" name="status"
															onchange="updateStatusColor(this)">
														<option value="0" <?= $item->status == 0 ? "selected" : "" ?>
																data-color="#007BFF">Active
														</option>
														<option value="1" <?= $item->status == 1 ? "selected" : "" ?>
																data-color="#DC3545">Inactive
														</option>
													</select>
												</td>
												<?php if ($data->archivesStatus == 0) { ?>
													<td>
														<div class="dropdown">
															<button class="btn btn-sm dropdown-toggle"
																	style="color: white; background-color: black"
																	type="button"
																	data-toggle="dropdown">Actions
																<span class="caret"></span></button>
															<ul class="dropdown-menu">
																<?php if ($item->status == 0) { ?>
																	<li>
																		<a href="javascript:void(0);"
																		   data-text="<?= login_url('viewTimedAccessLink/' . $item->id) ?>"
																		   class="copy-link">Share Schedule</a>
																	</li>
																<?php } ?>
																<li><a href="javascript:void(0);"
																	   onclick="loadPopup('<?= base_url('customer/viewTimedAccessLink/' . $item->id) ?>')">View</a>
																</li>
																<li><a href="javascript:void(0);"
																	   onclick="loadPopup('<?= base_url('customer/editTimedAccessLink/' . $item->id) ?>')">Edit</a>
																</li>
																<li>
																	<a href="<?= base_url('customer/deleteTimedAccessLink/' . $item->id) ?>"
																	   onclick="return confirm('Are you sure?')">Delete</a>
																</li>
															</ul>
														</div>
													</td>
												<?php } ?>
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

	.status {
		width: 100px;
		padding: 6px;
		font-size: 14px;
		border: 1px solid #ced4da;
		border-radius: 5px;
		appearance: none;
		color: #fff;
		text-align: center;
		background-position: calc(100% - 10px) center;
		background-repeat: no-repeat;
	}

	.status:focus {
		color: black !important;
		background-color: #fff !important;
	}

	table tr {
		cursor: pointer;
	}

</style>
<script>
	function updateStatusColor(selectElement) {
		var selectedOption = selectElement.options[selectElement.selectedIndex];
		var color = selectedOption.getAttribute('data-color');
		selectElement.style.backgroundColor = color || '#fff';
	}

	$(document).ready(function () {
		$('.copy-link').on('click', function () {
			const linkText = $(this).data('text');

			navigator.clipboard.writeText(linkText).then(function () {
				toastr.success('Link copied successfully!');
			}).catch(function (error) {
				toastr.error('Failed to copy link.');
			});
		});

		$('#timedAccessLink').DataTable({
			ordering: false,
			"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
			"pageLength": 10,
			"drawCallback": function () {
				document.querySelectorAll('.status').forEach(function (select) {
					updateStatusColor(select);
				});
			}
		});

		$('#timedAccessLink tbody').on('change', '.status', function () {
			var id = $(this).attr('id');
			var status = $(this).val();

			$.ajax({
				url: '<?= customer_url("updateTimedAccessLinkStatus") ?>',
				type: 'POST',
				data: {
					id: id,
					status: status
				},
				success: function (response) {
					var data;
					try {
						data = JSON.parse(response);
					} catch (e) {
						toastr.error("Unexpected response format.");
						return;
					}

					if (data.status === 'success') {
						toastr.success('Status Update Successfully!');
					} else {
						toastr.error('Failed to save. Please try again.');
					}
				},
				error: function () {
					toastr.error('Failed to save. Please try again.');
				}
			});
		});
	});
	$('#timedAccessLink tbody').on('click', 'tr td', function () {
		var data = $('#timedAccessLink').DataTable().row(this).data();
		var columnIndex = $(this).index();
		switch (columnIndex) {
			case 7:
			case 8:
				break;
			default:
				loadPopup('<?= customer_url('viewTimedAccessLink/') ?>' + data[0]);
				break;
		}
	});
</script>
