<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">
					<b class="title"><?= $data->title ?></b>
					<span class="description">Team KPI</span>
				</h3>
				<div class="form-group pull-right">
					<a class="btn btn-default" href="<?= customer_url('overviewProject/' . $data->id) ?>">Overview</a>
					<a class="btn btn-default active">Team
						KPI</a>
					<a class="btn btn-default"
					   href="<?= customer_url('projectRoadmap/' . $data->id) ?>">Roadmap</a>
					<?php if ($data->archivesStatus == 0) { ?>
						<a class="btn" style="color: white; background-color: black"
						   href="<?= customer_url('project') ?>">Back</a>
					<?php } else { ?>
						<a class="btn" style="color: white; background-color: black"
						   href="<?= customer_url('archivesProject') ?>">Back</a>
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
								<h3 class="box-title" style="font-size: 14px"><b>Team Key Performance Indicators</b>
								</h3>
							</div>
							<div class="box-body">
								<?php if ($data->archivesStatus == 0) { ?>
									<div class="form-group">
										<button type="button" class="btn btn-sm"
												style="color: white; background-color: black"
												onclick="loadPopup('<?= customer_url('addProjectKpiTitle/') . $data->id ?>')"
												id="addTitleRow">Add Objective
										</button>
									</div>
								<?php } ?>
								<div class="table-responsive">
									<table id="dynamicTable"
										   style="overflow-x: scroll; width: 100%;margin-bottom: 5%"
										   class="table table-bordered table-hover">
										<thead>
										<tr>
											<th>Type</th>
											<th>OKR #<br></th>
											<th>Production Phase<br></th>
											<th>Track</th>
											<th>Timeline Action</th>
											<th class="no-wrap">Action Details</th>
											<th>Timeline View</th>
											<th>Mark as Milestone</th>
											<th>Metrics<br></th>
											<th>Start Date<br></th>
											<th>Due Date<br></th>
											<th>Qtr<br></th>
											<th>Status<br></th>
											<th>Completed</th>
											<th>Responsible<br></th>
											<th>Accountable</th>
											<th>Consulted</th>
											<th>Informed</th>
											<th>XFN Partner Name</th>
											<th>XFN Partner Email</th>
											<th>StudioFlo Directory/Link</th>
											<?php if ($data->archivesStatus == 0) { ?>
												<th>Actions</th>
											<?php } ?>
										</tr>
										</thead>
										<tbody>
										<?php
										$currentTitleId = null;
										$titleHasItems = false; // Flag to track if a title has associated items
										if ($projectKpiDetails) {
											foreach ($projectKpiDetails as $index => $detail):
												// Check if we are encountering a new title
												if ($currentTitleId !== $detail['tOkr']):
													// Reset for the new title
													$currentTitleId = $detail['tOkr'];
													$titleHasItems = false; ?>
													<!-- Render the title row -->
													<tr class="title-row" data-title-id="<?= $detail['tId']; ?>">
														<td style="background-color: black; color: white"><?= $detail['tType']; ?></td>
														<td style="background-color: black; color: white"><?= $detail['tOkr']; ?></td>
														<td style="background-color: black; color: white"><?= $detail['tProductionPhase']; ?></td>
														<td style="background-color: black; color: white"><?= $detail['tTimelineTrack']; ?></td>
														<td style="background-color: black; color: white"><?= $detail['tTimelineGoal']; ?></td>
														<td class="no-wrap"
															style="background-color: black; color: white"><?= $detail['tTimelineAction']; ?></td>
														<td class="text-center"
															style="background-color: black; color: white">
															<input class="titleTimelineView-checkbox"
																   id="titleTimelineView"
																   type="checkbox"
																   value="1"
																   name="titleTimelineView" <?= $detail['tTimelineView'] == 1 ? 'checked' : '' ?>
																   data-id="<?= $detail['tId'] ?>"
																   style="width:20px;height:20px;">
														</td>
														<td class="text-center"
															style="background-color: black; color: white">
															<input class="titleMilestoneMark-checkbox"
																   id="titleMilestoneMark"
																   type="checkbox"
																   value="1"
																   name="titleMilestoneMark" <?= $detail['tMilestoneMark'] == 1 ? 'checked' : '' ?>
																   data-id="<?= $detail['tId'] ?>"
																   style="width:20px;height:20px;accent-color: #980808">
														</td>
														<td class="text-center"
															style="background-color: black; color: white"><?= $detail['tMetrics']; ?>
															%
														</td>
														<td style="background-color: black; color: white"><?= date('d M Y', strtotime($detail['tStartDate'])); ?></td>
														<td style="background-color: black; color: white"><?= date('d M Y', strtotime($detail['tDueDate'])); ?></td>
														<td class="text-center"
															style="background-color: black; color: white"><?= $detail['tQtr']; ?></td>
														<td style="background-color: black; color: white"><?= $detail['tStatus']; ?></td>
														<td style="background-color: black; color: white"><?= $detail['tMarkedDate'] ? date('d M Y', strtotime($detail['tMarkedDate'])) : ''; ?></td>
														<td style="background-color: black; color: white"><?= $detail['tResponsible']; ?></td>
														<td style="background-color: black; color: white"><?= $detail['tAccountable']; ?></td>
														<td style="background-color: black; color: white"><?= $detail['tConsulted']; ?></td>
														<td style="background-color: black; color: white"><?= $detail['tInformed']; ?></td>
														<td style="background-color: black; color: white"><?= $detail['tXfnName']; ?></td>
														<td style="background-color: black; color: white"><?= $detail['tXfnEmail']; ?></td>
														<td style="background-color: black; color: white">
															<?php
															if ($detail['tStudioFloDirectory']) {
																$name = $detail['tStudioFloName'] ? $detail['tStudioFloName'] : 'Sample File';
																$url = $detail['tStudioFloDirectory'];
																// Check if the URL starts with http, https, or www
																if (!preg_match('/^(http:\/\/|https:\/\/|www\.)/i', $url)) {
																	$url = 'https://' . $url;
																}
																echo '<a style="color: white;"  href="' . $url . '" target="_blank">' . $name . '</a>';
															} else {
																echo '';
															}
															?>
														</td>
														<?php if ($data->archivesStatus == 0) { ?>
															<td style="background-color: black">
																<div class="dropdown">
																	<button class="btn btn-sm dropdown-toggle"
																			type="button" data-toggle="dropdown">
																		Actions
																		<span class="caret"></span></button>
																	<ul class="dropdown-menu">
																		<li>
																			<a href="<?= customer_url('deleteProjectKpiTitle/') . $detail['tId'] ?>"
																			   onclick="return confirm('Are you sure?')">Delete</a>
																		</li>
																		<li><a href="javascript:void(0);"
																			   class="editTitleRow"
																			   onclick="loadPopup('<?= customer_url('editProjectKpiTitle/') . $detail['tId'] ?>')">Edit</a>
																		</li>
																		<li><a href="javascript:void(0);"
																			   class="addRowUnderTitle"
																			   onclick="loadPopup('<?= customer_url('addProjectKpiItem/') . $data->id . '/' . $detail['tId'] ?>')">Add
																				Key Result</a></li>
																	</ul>
																</div>
															</td>
														<?php } ?>
													</tr>
												<?php endif;
												// Check if this is an item row
												if ($detail['iOkr']):
													$titleHasItems = true; // Mark that this title has items
													?>
													<tr class="item-row" data-item-id="<?= $detail['iId'] ?>"
														data-title-id="<?= $detail['tId']; ?>">
														<td><?= $detail['iType']; ?></td>
														<td><?= $detail['tOkr'] . '.' . $detail['iOkr']; ?></td>
														<td><?= $detail['tProductionPhase']; ?></td>
														<td><?= $detail['tTimelineTrack']; ?></td>
														<td><?= $detail['iTimelineGoal']; ?></td>
														<td class="no-wrap"><?= $detail['iTimelineAction']; ?></td>
														<td class="text-center">
															<input class="itemTimelineView-checkbox"
																   id="itemTimelineView"
																   type="checkbox"
																   value="1"
																   data-titleid="<?= $detail['tId']; ?>"
																   data-id="<?= $detail['iId'] ?>"
																   name="itemTimelineView" <?= $detail['iTimelineView'] == 1 ? 'checked' : '' ?>
																   style="width:20px;height:20px;">
														</td>
														<td class="text-center">
															<input class="itemMilestoneMark-checkbox"
																   id="itemMilestoneMark"
																   type="checkbox"
																   value="1"
																   data-titleid="<?= $detail['tId']; ?>"
																   data-id="<?= $detail['iId'] ?>"
																   name="itemMilestoneMark" <?= $detail['iMilestoneMark'] == 1 ? 'checked' : '' ?>
																   style="width:20px;height:20px;accent-color: #980808">
														</td>
														<td class="text-center"><?= $detail['iMetrics']; ?> %</td>
														<td><?= date('d M Y', strtotime($detail['iStartDate'])); ?></td>
														<td><?= date('d M Y', strtotime($detail['iDueDate'])); ?></td>
														<td class="text-center"><?= $detail['iQtr']; ?></td>
														<td class="<?= $detail['iStatus'] == 'Completed' ? 'bg-green-active' : ($detail['iStatus'] == 'In-Progress' ? 'bg-light-blue' : ($detail['iStatus'] == 'Blocked' ?
																'bg-red' : ($detail['iStatus'] == 'Late' ? 'bg-yellow' : 'bg-black'))) ?>"><?= $detail['iStatus'];
															if ($detail['iStatus'] === 'Blocked') { ?>
																<br>
																<a href="javascript:void(0);"
																   class="btn btn-xs btn-default"
																   onclick="loadPopup('<?= customer_url('viewProjectKPIItemBlockReason/') . $detail['iId'] ?>')">View
																	Reason</a>
															<?php } ?>
														</td>
														<td><?= $detail['iMarkedDate'] ? date('d M Y', strtotime($detail['iMarkedDate'])) : ''; ?></td>
														<td><?= $detail['responsible']; ?></td>
														<td><?= $detail['accountable']; ?></td>
														<td><?= $detail['consulted']; ?></td>
														<td><?= $detail['informed']; ?></td>
														<td><?= $detail['iXfnName']; ?></td>
														<td><?= $detail['iXfnEmail']; ?></td>
														<td>
															<?php
															if ($detail['iStudioFloDirectory']) {
																$name = $detail['iStudioFloName'] ? $detail['iStudioFloName'] : 'Sample File';
																$url = $detail['iStudioFloDirectory'];
																// Check if the URL starts with http, https, or www
																if (!preg_match('/^(http:\/\/|https:\/\/|www\.)/i', $url)) {
																	$url = 'https://' . $url;
																}
																echo '<a class="btn-link" style="color: black;" href="' . $url . '" target="_blank">' . $name . '</a>';
															} else {
																echo '';
															}
															?>
														</td>
														<?php if ($data->archivesStatus == 0) { ?>
															<td>
																<div class="dropdown">
																	<button class="btn btn-sm dropdown-toggle"
																			type="button" data-toggle="dropdown"
																			style="color:white; background-color: black">
																		Actions
																		<span class="caret"></span></button>
																	<ul class="dropdown-menu">
																		<li><a href="javascript:void(0);"
																			   onclick="loadPopup('<?= customer_url('editProjectKpiItem/') . $detail['iId'] ?>')">Edit</a>
																		</li>
																		<li>
																			<a href="<?= customer_url('deleteProjectKpiItem/') . $detail['tId'] . '/' . $detail['iId'] ?>"
																			   onclick="return confirm('Are you sure?')">Delete</a>
																		</li>
																	</ul>
																</div>
															</td>
														<?php } ?>
													</tr>
												<?php endif;
												$titleHasItems = true; // Mark that this title has items
											endforeach;
											// Check for the last title if it had no items
										} else { ?>
											<tr id="noRecordRow">
												<th colspan="<?= $data->archivesStatus == 0 ? '22' : '21' ?>"
													class="text-center text-danger">No data available in table
												</th>
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

	table {
		cursor: pointer;
	}

	table td {
		font-weight: normal;
	}

	table#dynamicTable {
		table-layout: auto;
		width: 100%; /* Ensure the table spans its container */
	}

	/* Apply a fixed width to cells with the 'no-wrap' class */
	table#dynamicTable td.no-wrap {
		min-width: 750px; /* Limit the width of the cell */
		white-space: normal; /* Allow text wrapping */
		word-wrap: break-word; /* Ensure long words break to fit within the cell */
		word-break: break-word; /* Break lines even if it means splitting words */
		overflow-wrap: break-word; /* Modern equivalent for word breaking */
		text-align: justify;
	}

	/* Prevent wrapping for other cells, unless specified */
	table#dynamicTable td:not(.no-wrap),
	table#dynamicTable th:not(.no-wrap) {
		white-space: nowrap;
		/*overflow: hidden;*/
		text-overflow: ellipsis; /* Ensure ellipsis is added for overflowing content */
	}

	#yadcf-filter--dynamicTable-1 {
		width: 70px !important;
		max-width: 70px !important;
	}

	#yadcf-filter--dynamicTable-8 {
		width: 100px !important;
		max-width: 100px !important;
	}

	#yadcf-filter--dynamicTable-9 {
		width: 100px !important;
		max-width: 100px !important;
	}

	#yadcf-filter--dynamicTable-10 {
		width: 100px !important;
		max-width: 100px !important;
	}

	#yadcf-filter--dynamicTable-11 {
		width: 70px !important;
		max-width: 70px !important;
	}
</style>
<script>
	$(document).ready(function () {
		var table = $('#dynamicTable').DataTable({
			"pageLength": 25,
			"ordering": true, // Enable ordering
			"order": [[1, 'asc']], // Always sort by column 1 in ascending order
		});

		// Initialize YADCF
		yadcf.init(table, [
			{ column_number: 1, filter_default_label: "Type...", filter_type: "text" },
			{ column_number: 2, filter_type: "select", filter_match_mode: "exact" },
			{ column_number: 8, filter_default_label: "Type...", filter_type: "text" },
			{ column_number: 9, filter_type: "auto_complete", text_data_delimiter: "," },
			{ column_number: 10, filter_type: "auto_complete", text_data_delimiter: "," },
			{ column_number: 11, filter_default_label: "Type...", filter_type: "text" },
			{ column_number: 12, filter_type: "select", filter_match_mode: "exact" },
			{ column_number: 14, filter_type: "select", filter_match_mode: "exact" }
		]);

		// Prevent infinite loop when applying sorting
		var sortingApplied = false;

		table.on('draw', function () {
			if (!sortingApplied) {
				sortingApplied = true; // Set guard
				table.order([[1, 'asc']]).draw(false);
			} else {
				sortingApplied = false; // Reset guard after applying sorting
			}
		});
	});

	$(document).on('click', '.title-row td', function () {
		var $row = $(this).closest('.title-row'); // Get the row
		var columnIndex = $(this).index();       // Get the clicked column index
		// Define the specific columns you want to allow
		var allowedColumns = [0, 1, 2, 3, 4, 5, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18, 19, 20]; // Replace with the 0-based indices of the specific columns

		if (allowedColumns.includes(columnIndex)) {
			var titleId = $row.data('title-id');
			loadPopup('<?= customer_url('editProjectKpiTitle/') ?>' + titleId);
		}
	});

	$(document).on('click', '.item-row td', function () {
		var $row = $(this).closest('.item-row'); // Get the row
		var columnIndex = $(this).index();       // Get the clicked column index
		// Define the specific columns you want to allow
		var allowedColumns = [0, 1, 2, 3, 4, 5, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18, 19, 20]; // Replace with the 0-based indices of the specific columns

		if (allowedColumns.includes(columnIndex)) {
			var itemId = $row.data('item-id');
			loadPopup('<?= customer_url('editProjectKpiItem/') ?>' + itemId);
		}
	});

	$(document).on('change', '.titleTimelineView-checkbox', function () {
		const checkbox = $(this);
		const isChecked = checkbox.is(':checked') ? 1 : 0;
		const recordId = checkbox.data('id');
		console.log(recordId);
		console.log(isChecked);
		$.ajax({
			url: '<?= customer_url('changeTitleTimelineView') ?>',
			type: 'POST',
			data: {
				id: recordId,
				value: isChecked,
			},
			success: function (response) {
				response = JSON.parse(response);
				if (response.success) {
					$("#dynamicTable").load(window.location + " #dynamicTable > *");
					toastr.success('Timeline view updated successfully.');
				} else {
					toastr.error('Failed to update timeline view.');
					// Revert the checkbox state in case of an error
					checkbox.prop('checked', !isChecked);
				}
			},
			error: function () {
				console.error('Error:', error);
				console.error('Response:', xhr.responseText); // Log server error details
				toastr.error('An error occurred while updating the timeline view.');
				// Revert the checkbox state in case of an error
				checkbox.prop('checked', !isChecked);
			},
		});
	});

	$(document).on('change', '.titleMilestoneMark-checkbox', function () {
		const checkbox = $(this);
		const isChecked = checkbox.is(':checked') ? 1 : 0;
		const recordId = checkbox.data('id');
		console.log(recordId);
		console.log(isChecked);
		$.ajax({
			url: '<?= customer_url('changeTitleMilestoneMark') ?>',
			type: 'POST',
			data: {
				id: recordId,
				value: isChecked,
			},
			success: function (response) {
				response = JSON.parse(response);
				if (response.success) {
					$("#dynamicTable").load(window.location + " #dynamicTable > *");
					toastr.success('Milestone mark updated successfully.');
				} else {
					toastr.error('Failed to update milestone mark.');
					// Revert the checkbox state in case of an error
					checkbox.prop('checked', !isChecked);
				}
			},
			error: function () {
				console.error('Error:', error);
				console.error('Response:', xhr.responseText); // Log server error details
				toastr.error('An error occurred while updating the milestone mark.');
				// Revert the checkbox state in case of an error
				checkbox.prop('checked', !isChecked);
			},
		});
	});

	$(document).on('change', '.itemTimelineView-checkbox', function () {
		const checkbox = $(this);
		const isChecked = checkbox.is(':checked') ? 1 : 0;
		const recordId = checkbox.data('id');
		const titleId = checkbox.data('titleid');
		console.log(recordId);
		console.log(isChecked);
		$.ajax({
			url: '<?= customer_url('changeItemTimelineView') ?>',
			type: 'POST',
			data: {
				id: recordId,
				value: isChecked,
				titleId: titleId
			},
			success: function (response) {
				response = JSON.parse(response);
				if (response.success) {
					$("#dynamicTable").load(window.location + " #dynamicTable > *");
					toastr.success('Timeline view updated successfully.');
				} else {
					toastr.error('Failed to update timeline view.');
					// Revert the checkbox state in case of an error
					checkbox.prop('checked', !isChecked);
				}
			},
			error: function () {
				console.error('Error:', error);
				console.error('Response:', xhr.responseText); // Log server error details
				toastr.error('An error occurred while updating the timeline view.');
				// Revert the checkbox state in case of an error
				checkbox.prop('checked', !isChecked);
			},
		});
	});

	$(document).on('change', '.itemMilestoneMark-checkbox', function () {
		const checkbox = $(this);
		const isChecked = checkbox.is(':checked') ? 1 : 0;
		const recordId = checkbox.data('id');
		const titleId = checkbox.data('titleid');
		console.log(recordId);
		console.log(isChecked);
		$.ajax({
			url: '<?= customer_url('changeItemMilestoneMark') ?>',
			type: 'POST',
			data: {
				id: recordId,
				value: isChecked,
				titleId: titleId
			},
			success: function (response) {
				response = JSON.parse(response);
				if (response.success) {
					$("#dynamicTable").load(window.location + " #dynamicTable > *");
					toastr.success('Milestone mark updated successfully.');
				} else {
					toastr.error('Failed to update milestone mark.');
					// Revert the checkbox state in case of an error
					checkbox.prop('checked', !isChecked);
				}
			},
			error: function () {
				console.error('Error:', error);
				console.error('Response:', xhr.responseText); // Log server error details
				toastr.error('An error occurred while updating the milestone mark.');
				// Revert the checkbox state in case of an error
				checkbox.prop('checked', !isChecked);
			},
		});
	});
</script>
