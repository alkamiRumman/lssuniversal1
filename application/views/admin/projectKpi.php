<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">
					<b class="title"><?= $data->title ?></b>
					<span class="description"><?= $data->description ?></span>
				</h3>
				<div class="form-group pull-right">
					<a class="btn btn-default" href="<?= admin_url('overviewProject/' . $data->id) ?>">Overview</a>
					<a class="btn btn-default active">Team
						KPI</a>
					<a class="btn btn-default"
					   href="<?= admin_url('projectRoadmap/' . $data->id) ?>">Roadmap</a>
					<?php if ($data->archivesStatus == 0) { ?>
						<a class="btn" style="color: white; background-color: black"
						   href="<?= admin_url('project') ?>">Back</a>
					<?php } else { ?>
						<a class="btn" style="color: white; background-color: black"
						   href="<?= admin_url('archivesProject') ?>">Back</a>
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
							<div class="box-header with-border"
								 style="background-color: black; color: white; border-top-right-radius: 5px; border-top-left-radius: 5px">
								<h3 class="box-title" style="font-size: 14px"><b>Team Key Performance Indicators</b>
								</h3>
							</div>
							<div class="box-body">
								<form id="dynamicForm" method="post"
									  action="<?php echo admin_url('saveProjectKpi/' . $data->id); ?>">
									<?php if ($data->archivesStatus == 0) { ?>
										<div class="form-group">
											<button type="button" class="btn btn-sm"
													style="color: white; background-color: #0081CE"
													onclick="loadPopup('<?= admin_url('addProjectKpiTitle/') . $data->id ?>')"
													id="addTitleRow">Add Objective
											</button>
											<button type="submit" class="btn btn-sm"
													style="color: white; background-color: black">Save
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
												<th>OKR #</th>
												<th>Production Phase</th>
												<th>Track</th>
												<th>Timeline Action</th>
												<th>Action Details</th>
												<th>Timeline View</th>
												<th>Mark as Milestone</th>
												<th>Metrics</th>
												<th>Start Date</th>
												<th>Due Date</th>
												<th>Qtr</th>
												<th>Status</th>
												<th>Completed</th>
												<th>Responsible</th>
												<th>Accountable</th>
												<th>Consulted</th>
												<th>Informed</th>
												<th>XFN Partner Name</th>
												<th>XFN Partner Email</th>
												<th>StudioFlo Directory/Link</th>
												<?php if ($data->archivesStatus == 0) { ?>
													<th class="no-wrap">Actions</th>
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
															<td style="background-color: black; color: white"><?= $detail['tTimelineAction']; ?></td>
															<td class="text-center"
																style="background-color: black; color: white">
																<input class="timelineView-checkbox" id="timelineView"
																	   type="checkbox"
																	   value="1"
																	   name="timelineView" <?= $detail['tTimelineView'] == 1 ? 'checked' : '' ?>
																	   onclick="return false"
																	   style="width:20px;height:20px;">
															</td>
															<td class="text-center"
																style="background-color: black; color: white">
																<input class="timelineView-checkbox" id="timelineView"
																	   type="checkbox"
																	   value="1"
																	   name="timelineView" <?= $detail['tMilestoneMark'] == 1 ? 'checked' : '' ?>
																	   onclick="return false"
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
																	echo '<a href="' . $url . '" target="_blank">' . $name . '</a>';
																} else {
																	echo '';
																}
																?>
															</td>
															<?php if ($data->archivesStatus == 0) { ?>
																<td class="no-wrap" style="background-color: black">
																	<div class="dropdown">
																		<button class="btn btn-sm dropdown-toggle"
																				type="button" data-toggle="dropdown">
																			Actions
																			<span class="caret"></span></button>
																		<ul class="dropdown-menu">
																			<li>
																				<a href="<?= admin_url('deleteProjectKpiTitle/') . $detail['tId'] ?>"
																				   onclick="return confirm('Are you sure?')">Delete</a>
																			</li>
																			<li><a href="javascript:void(0);"
																				   class="editTitleRow"
																				   onclick="loadPopup('<?= admin_url('editProjectKpiTitle/') . $detail['tId'] ?>')">Edit</a>
																			</li>
																			<li><a href="javascript:void(0);"
																				   class="addRowUnderTitle"
																				   onclick="loadPopup('<?= admin_url('addProjectKpiItem/') . $data->id . '/' . $detail['tId'] ?>')">Add
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
														<tr data-title-id="<?= $detail['iOkr']; ?>">
															<td><?= $detail['iType']; ?></td>
															<td><?= $detail['tOkr'] . '.' . $detail['iOkr']; ?></td>
															<td><?= $detail['tProductionPhase']; ?></td>
															<td><?= $detail['tTimelineTrack']; ?></td>
															<td><?= $detail['iTimelineGoal']; ?></td>
															<td><?= $detail['iTimelineAction']; ?></td>
															<td class="text-center">
																<input class="timelineView-checkbox" id="timelineView"
																	   type="checkbox"
																	   value="1"
																	   name="timelineView" <?= $detail['iTimelineView'] == 1 ? 'checked' : '' ?>
																	   onclick="return false"
																	   style="width:20px;height:20px;">
															</td>
															<td class="text-center">
																<input class="timelineView-checkbox" id="timelineView"
																	   type="checkbox"
																	   value="1"
																	   name="timelineView" <?= $detail['iMilestoneMark'] == 1 ? 'checked' : '' ?>
																	   onclick="return false"
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
																	   onclick="loadPopup('<?= admin_url('viewProjectKPIItemBlockReason/') . $detail['iId'] ?>')">View
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
																	$name = $detail['iStudioFloName'] ? $detail['iStudioFloDirectory'] : 'Sample File';
																	$url = $detail['iStudioFloDirectory'];
																	// Check if the URL starts with http, https, or www
																	if (!preg_match('/^(http:\/\/|https:\/\/|www\.)/i', $url)) {
																		$url = 'https://' . $url;
																	}
																	echo '<a class="btn-link" href="' . $url . '" target="_blank">' . $name . '</a>';
																} else {
																	echo '';
																}
																?>
															</td>
															<?php if ($data->archivesStatus == 0) { ?>
																<td class="no-wrap">
																	<div class="dropdown">
																		<button class="btn btn-sm dropdown-toggle"
																				type="button" data-toggle="dropdown"
																				style="color:white; background-color: black">
																			Actions
																			<span class="caret"></span></button>
																		<ul class="dropdown-menu">
																			<li><a href="javascript:void(0);"
																				   onclick="loadPopup('<?= admin_url('editProjectKpiItem/') . $detail['iId'] ?>')">Edit</a>
																			</li>
																			<li>
																				<a href="<?= admin_url('deleteProjectKpiItem/') . $detail['tId'] . '/' . $detail['iId'] ?>"
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
								</form>
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

	table td {
		font-weight: normal;
	}

	table#dynamicTable td:not(.no-wrap),
	table#dynamicTable th:not(.no-wrap) {
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis; /* Adds "..." for long text */
	}
</style>
<script>


</script>
