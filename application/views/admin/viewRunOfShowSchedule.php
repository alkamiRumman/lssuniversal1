<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">
					<b class="title"><?= $data->title ?></b>
					<span class="description"><?= $data->description ?></span>
				</h3>
				<div class="form-group pull-right">
					<a class="btn btn-default active">Schedule</a>
					<a class="btn btn-default" href="<?= admin_url('viewRunOfShowCrewTravel/' . $data->id) ?>">Crew
						Travel</a>
					<a class="btn btn-default" href="<?= admin_url('viewRunOfShowTalentCrew/' . $data->id) ?>">Talent
						Travel</a>
					<a class="btn btn-default" href="<?= admin_url('viewRunOfShowPoc/' . $data->id) ?>">ROS POC</a>
					<?php if ($data->archivesStatus == 0) { ?>
						<a class="btn" style="color: white; background-color: black"
						   href="<?= admin_url('runOfShow') ?>">Back</a>
					<?php } else { ?>
						<a class="btn" style="color: white; background-color: black"
						   href="<?= admin_url('archives') ?>">Back</a>
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
								<h3 class="box-title" style="font-size: 14px"><b>Production Schedule</b></h3>
							</div>
							<div class="box-body">
								<form id="dynamicForm" method="post"
									  action="<?php echo admin_url('saveRunOfShowScheduleDetails/' . $data->id); ?>">
									<?php if ($data->archivesStatus == 0) { ?>
										<div class="form-group">
											<button type="button" class="btn btn-sm"
													style="color: white; background-color: #0081CE" id="addTitleRow">Add
												Title
												Row
											</button>
											<button type="submit" class="btn btn-sm"
													style="color: white; background-color: black">Save
											</button>
										</div>
									<?php } ?>
									<div class="table-responsive" style="overflow: auto;">
										<table id="dynamicTable" style="width: 99%;margin-bottom: 5%"
											   class="table table-bordered table-hover">
											<thead>
											<tr>
												<th>Title</th>
												<th>Start</th>
												<th>Duration</th>
												<th>Lead Team Member</th>
												<th>Crew Member</th>
												<th>Talent</th>
												<th>Location</th>
												<th>Area/Space</th>
												<th>Details</th>
												<th>Private Note Reminder</th>
												<?php if ($data->archivesStatus == 0) { ?>
													<th>Actions</th>
												<?php } ?>
											</tr>
											</thead>
											<tbody>
											<?php
											$currentTitleId = null;
											if ($runOfShowDetails) {
												foreach ($runOfShowDetails as $detail):
													if ($currentTitleId !== $detail['title_id']):
														$currentTitleId = $detail['title_id']; ?>
														<tr class="title-row"
															data-title-id="<?= $detail['title_id']; ?>">
															<td style="background-color: black"><input type="text"
																									   name="title[<?= $detail['title_id'] ?>]"
																									   class="input-sm form-control"
																									   value="<?= $detail['title_name']; ?>"
																									   placeholder="Enter Title Name"
																									   required></td>
															<td style="background-color: black" colspan="9"></td>
															<?php if ($data->archivesStatus == 0) { ?>
																<td style="background-color: black">
																	<div class="dropdown">
																		<button class="btn btn-sm dropdown-toggle"
																				type="button" data-toggle="dropdown">
																			Actions
																			<span class="caret"></span></button>
																		<ul class="dropdown-menu">
																			<li><a href="javascript:void(0);"
																				   class="deleteTitleRow"
																				   data-title-id="<?= $detail['title_id']; ?>">Delete</a>
																			</li>
																			<li><a href="javascript:void(0);"
																				   class="addRowUnderTitle"
																				   data-title-id="<?= $detail['title_id']; ?>">Add
																					Row</a>
																			</li>
																		</ul>
																	</div>
																</td>
															<?php } ?>
														</tr>
													<?php endif; ?>
													<tr data-title-id="<?= $detail['title_id']; ?>">
														<td><input type="text"
																   name="items[<?= $detail['title_id']; ?>][]"
																   value="<?= $detail['item_name']; ?>"
																   class="input-sm form-control"
																   placeholder="Enter Item Name" required></td>
														<td><input type="time"
																   name="start[<?= $detail['title_id']; ?>][]"
																   value="<?= $detail['start_time']; ?>"
																   class="input-sm form-control start-time" readonly>
														</td>
														<td><input type="number" min="0"
																   name="duration[<?= $detail['title_id']; ?>][]"
																   value="<?= $detail['duration']; ?>"
																   class="input-sm form-control duration"
																   placeholder="Enter Duration (min)" required></td>
														<td><select class="input-sm form-control selectTeamMember"
																	style="width: 100%">
																<?php if ($detail['leadTeamMember']) { ?>
																	<option selected
																			value="<?= $detail['leadTeamMember']; ?>"><?= $detail['name']; ?></option>
																<?php } ?>
															</select>
															<input type="hidden"
																   name="leadTeamMember[<?= $detail['title_id']; ?>][]"
																   value="<?= $detail['leadTeamMember']; ?>"
																   class="selectTeamMemberHidden">
														</td>
														<td><input type="text"
																   name="crewMember[<?= $detail['title_id']; ?>][]"
																   value="<?= $detail['crew_member']; ?>"
																   placeholder="Enter Crew Member"
																   class="input-sm form-control"></td>
														<td><input type="text"
																   name="talent[<?= $detail['title_id']; ?>][]"
																   value="<?= $detail['talent']; ?>"
																   placeholder="Enter Talent"
																   class="input-sm form-control">
														</td>
														<td><input type="text"
																   name="location[<?= $detail['title_id']; ?>][]"
																   value="<?= $detail['location']; ?>"
																   placeholder="Enter Location"
																   class="input-sm form-control"></td>
														<td><input type="text"
																   name="area[<?= $detail['title_id']; ?>][]"
																   value="<?= $detail['area_space']; ?>"
																   placeholder="Enter Area/Space"
																   class="input-sm form-control"></td>
														<td><input type="text"
																   name="details[<?= $detail['title_id']; ?>][]"
																   value="<?= $detail['details']; ?>"
																   placeholder="Enter Details"
																   class="input-sm form-control"></td>
														<td><input type="text"
																   name="privateNotes[<?= $detail['title_id']; ?>][]"
																   value="<?= $detail['private_notes']; ?>"
																   placeholder="Enter Private Note"
																   class="input-sm form-control"></td>
														<?php if ($data->archivesStatus == 0) { ?>
															<td>
																<div class="dropdown">
																	<button class="btn btn-sm dropdown-toggle"
																			style="color:white; background-color: black"
																			type="button" data-toggle="dropdown">Actions
																		<span class="caret"></span></button>
																	<ul class="dropdown-menu">
																		<li><a href="javascript:void(0);"
																			   class="removeRow"
																			   data-title-id="<?= $detail['title_id']; ?>">Delete</a>
																		</li>
																		<li><a href="javascript:void(0);"
																			   class="addRowUnderTitle"
																			   data-title-id="<?= $detail['title_id']; ?>">Add
																				Row</a>
																		</li>
																	</ul>
																</div>
																<!--														<button type="button" class="btn btn-sm btn-danger removeRow">-->
																<!--															<i class="fa fa-trash"></i>-->
																<!--														</button>-->
															</td>
														<?php } ?>
													</tr>
												<?php endforeach;
											} else { ?>
												<tr id="noRecordRow">
													<th colspan="<?= $data->archivesStatus == 0 ? '11' : '10' ?>"
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

	.dragging {
		opacity: 0.7;
	}

	.drop-hover {
		background-color: #e0e0e0;
	}
</style>
<script>
	function selectTeamMember() {
		$(".selectTeamMember").select2({
			placeholder: "Select Team Member",
			allowClear: true,
			ajax: {
				url: '<?= admin_url("getCustomerSearch") ?>',
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
					console.log(response);
					return {
						results: response
					};
				}
			}
		}).on('select2:select', function (event) {
			var data = event.params.data;
			$(this).closest('td').find('.selectTeamMemberHidden').val(data.id);
		}).on('change', function () {
			if (!$(this).val()) {
				$(this).closest('td').find('.selectTeamMemberHidden').val("");
			}
		});
	}

	$(function () {
		selectTeamMember();
	});

	$(document).ready(function () {
		let titleCounter = 0; // Unique identifier for each title
		const initialTime = '<?= date("H:i", strtotime($data->time)); ?>';

		// Add new title row
		$('#addTitleRow').click(function () {
			if ($('#noRecordRow').length > 0) {
				$('#noRecordRow').remove();
			}
			titleCounter++; // Increment the title counter for each new title

			let titleRow = `
		<tr class="title-row" data-title-id="${titleCounter}">
			<td style="background-color: black"><input type="text" name="title[${titleCounter}]" class="input-sm form-control" placeholder="Enter Title Name" required></td>
			<td style="background-color: black" colspan="9"></td>
			<td style="background-color: black">
				<div class="dropdown">
					<button class="btn btn-sm dropdown-toggle"
							type="button" data-toggle="dropdown">Actions
						<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="javascript:void(0);"
							   class="deleteTitleRow"
							   data-title-id="${titleCounter}">Delete</a>
						</li>
						<li><a href="javascript:void(0);"
							   class="addRowUnderTitle"
							   data-title-id="${titleCounter}">Add
								Row</a>
						</li>
					</ul>
				</div>
			</td>
		</tr>`;
			$('#dynamicTable tbody').append(titleRow);
		});

		// Add new row under specific title row
		$(document).on('click', '.addRowUnderTitle', function () {
			const titleId = $(this).data('title-id');
			const clickedRow = $(this).closest('tr');
			let lastStartTime = clickedRow.find('.start-time').val() || initialTime; // Get clicked row's start time
			let lastDuration = clickedRow.find('.duration').val() || 0;
			const newStartTime = calculateNewStartTime(lastStartTime, lastDuration);
			const newRow = generateRow(newStartTime, titleId);
			clickedRow.after(newRow);
			recalculateStartTimes();
			selectTeamMember();
		});


		// Generate a new row with fields for start time, duration, etc.
		function generateRow(startTime, titleId) {
			let newRow = `<tr data-title-id="${titleId}">
			<td><input type="text" name="items[${titleId}][]" class="input-sm form-control" placeholder="Enter Item Name" required></td>
			<td><input type="time" readonly name="start[${titleId}][]" value="${startTime}" class="input-sm form-control start-time"></td>
			<td><input type="number" min="0" name="duration[${titleId}][]" class="input-sm form-control duration" placeholder="Enter Duration (min)" required></td>
			<td><select class="input-sm form-control selectTeamMember" style="width: 100%"></select>
			<input type="hidden" name="leadTeamMember[${titleId}][]" class="selectTeamMemberHidden"></td>
			<td><input type="text" name="crewMember[${titleId}][]" placeholder="Enter Crew Member" class="input-sm form-control"></td>
			<td><input type="text" name="talent[${titleId}][]" placeholder="Enter Talent" class="input-sm form-control"></td>
			<td><input type="text" name="location[${titleId}][]" placeholder="Enter Location" class="input-sm form-control"></td>
			<td><input type="text" name="area[${titleId}][]" placeholder="Enter Area/Space" class="input-sm form-control"></td>
			<td><input type="text" name="details[${titleId}][]" placeholder="Enter Details" class="input-sm form-control"></td>
			<td><input type="text" name="privateNotes[${titleId}][]" placeholder="Enter Private Note" class="input-sm form-control"></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-sm dropdown-toggle" style="color:white; background-color: black"
							type="button" data-toggle="dropdown">Actions
						<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="javascript:void(0);"
							   class="removeRow"
							   data-title-id="${titleId}">Delete</a>
						</li>
						<li><a href="javascript:void(0);"
							   class="addRowUnderTitle"
							   data-title-id="${titleId}">Add
								Row</a>
						</li>
					</ul>
				</div>
			</td>
			</tr>`;
			return newRow;
		}

		// Calculate the new start time based on the current time and duration
		function calculateNewStartTime(currentTime, duration) {
			if (!currentTime || !duration) return currentTime;  // No time or duration to calculate from

			const timeParts = currentTime.split(':');
			let hours = parseInt(timeParts[0]);
			let minutes = parseInt(timeParts[1]);

			minutes += parseInt(duration);
			while (minutes >= 60) {
				minutes -= 60;
				hours++;
			}
			// Convert back to "HH:mm" format (24-hour)
			hours = hours < 10 ? '0' + hours : hours;
			minutes = minutes < 10 ? '0' + minutes : minutes;
			return `${hours}:${minutes}`;
		}

		// Recalculate start times for all rows when the duration changes
		function recalculateStartTimes() {
			let lastStartTime = initialTime;
			let lastDuration = 0;

			$('#dynamicTable tbody tr').each(function () {
				const startTimeField = $(this).find('.start-time');
				const durationField = $(this).find('.duration').val() || 0;
				const newStartTime = calculateNewStartTime(lastStartTime, lastDuration);

				startTimeField.val(newStartTime);
				lastStartTime = newStartTime;
				lastDuration = durationField;
			});
		}

		// Update the start time for the next rows when the duration changes
		$(document).on('input', '.duration', function () {
			recalculateStartTimes();
		});

		// Remove row functionality
		$(document).on('click', '.removeRow', function () {
			$(this).closest('tr').remove();
			recalculateStartTimes(); // Recalculate after removal
		});

		$(document).on('click', '.deleteTitleRow', function () {
			const titleId = $(this).data('title-id'); // Get the title ID from the button
			const titleRow = $(this).closest('tr'); // Get the title row

			// Remove the title row and all rows that have the same title ID
			titleRow.nextUntil('.title-row').filter(`[data-title-id="${titleId}"]`).remove(); // Remove all data rows under the title
			titleRow.remove(); // Remove the title row

			recalculateStartTimes(); // Recalculate the start times after deletion
		});
	});

</script>
