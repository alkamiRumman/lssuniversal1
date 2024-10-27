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
					<a class="btn btn-default" href="<?= admin_url('viewRunOfShowTalentCrew/' . $data->id) ?>">Talent Travel</a>
					<a class="btn btn-default" href="<?= admin_url('viewRunOfShowPoc/' . $data->id) ?>">ROS POC</a>
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
								<h3 class="box-title text-black"><b>SECTION 3: PRODUCTION SCHEDULE</b></h3>
							</div>
							<div class="box-body">
								<form id="dynamicForm" method="post"
									  action="<?php echo admin_url('saveRunOfShowScheduleDetails/' . $data->id); ?>">
									<div class="form-group">
										<button type="button" class="btn btn-sm btn-success" id="addTitleRow">Add Title
											Row
										</button>
										<button type="submit" class="btn btn-sm"
												style="color: white; background-color: black"><?= empty($runOfShowDetails) ? 'Save' : 'Update' ?>
										</button>
									</div>
									<div class="table-responsive" style="overflow: auto;">
										<table id="dynamicTable" style="width: 99%;"
											   class="table table-bordered table-hover">
											<thead>
											<tr>
												<th>Title</th>
												<th>Start</th>
												<th>Duration</th>
												<th>Lead Crew Member</th>
												<th>Talent</th>
												<th>Location</th>
												<th>Area/Spac</th>
												<th>Details</th>
												<th>Private Note Reminder</th>
												<th>Actions</th>
											</tr>
											</thead>
											<tbody>
											<?php
											$currentTitleId = null;
											foreach ($runOfShowDetails as $detail):
												if ($currentTitleId !== $detail['title_id']):
													$currentTitleId = $detail['title_id']; ?>
													<tr class="title-row" data-title-id="<?= $detail['title_id']; ?>">
														<td><input type="text" name="title[<?= $detail['title_id'] ?>]"
																   class="input-sm form-control"
																   value="<?= $detail['title_name']; ?>"
																   placeholder="Enter Title Name" required></td>
														<td colspan="8"></td>
														<td>
															<button type="button"
																	class="btn btn-sm btn-danger deleteTitleRow"
																	data-title-id="<?= $detail['title_id']; ?>"><i
																		class="fa fa-trash"></i>
															</button>
															<button type="button"
																	class="btn btn-sm btn-success addRowUnderTitle"
																	data-title-id="<?= $detail['title_id']; ?>">Add Row
															</button>
														</td>
													</tr>
												<?php endif; ?>
												<tr data-title-id="<?= $detail['title_id']; ?>">
													<td><input type="text" name="items[<?= $detail['title_id']; ?>][]"
															   value="<?= $detail['item_name']; ?>"
															   class="input-sm form-control"
															   placeholder="Enter Item Name" required></td>
													<td><input type="time" name="start[<?= $detail['title_id']; ?>][]"
															   value="<?= $detail['start_time']; ?>"
															   class="input-sm form-control start-time" readonly></td>
													<td><input type="number" min="0"
															   name="duration[<?= $detail['title_id']; ?>][]"
															   value="<?= $detail['duration']; ?>"
															   class="input-sm form-control duration"
															   placeholder="Enter Duration (min)" required></td>
													<td><input type="text"
															   name="leadCrewMember[<?= $detail['title_id']; ?>][]"
															   value="<?= $detail['lead_crew_member']; ?>"
															   placeholder="Enter Lead Crew Member"
															   class="input-sm form-control"></td>
													<td><input type="text" name="talent[<?= $detail['title_id']; ?>][]"
															   value="<?= $detail['talent']; ?>"
															   placeholder="Enter Talent" class="input-sm form-control">
													</td>
													<td><input type="text"
															   name="location[<?= $detail['title_id']; ?>][]"
															   value="<?= $detail['location']; ?>"
															   placeholder="Enter Location"
															   class="input-sm form-control"></td>
													<td><input type="text" name="area[<?= $detail['title_id']; ?>][]"
															   value="<?= $detail['area_space']; ?>"
															   placeholder="Enter Area/Space"
															   class="input-sm form-control"></td>
													<td><input type="text" name="details[<?= $detail['title_id']; ?>][]"
															   value="<?= $detail['details']; ?>"
															   placeholder="Enter Details"
															   class="input-sm form-control"></td>
													<td><input type="text"
															   name="privateNotes[<?= $detail['title_id']; ?>][]"
															   value="<?= $detail['private_notes']; ?>"
															   placeholder="Enter Private Note"
															   class="input-sm form-control"></td>
													<td>
														<button type="button" class="btn btn-sm btn-danger removeRow">
															<i class="fa fa-trash"></i>
														</button>
													</td>
												</tr>
											<?php endforeach; ?>
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

</style>
<script>
	$(document).ready(function () {
		let titleCounter = 0; // Unique identifier for each title
		const initialTime = '<?= date("H:i", strtotime($data->time)); ?>';

		// Add new title row
		$('#addTitleRow').click(function () {
			titleCounter++; // Increment the title counter for each new title

			let titleRow = `
		<tr class="title-row" data-title-id="${titleCounter}">
			<td><input type="text" name="title[${titleCounter}]" class="input-sm form-control" placeholder="Enter Title Name" required></td>
			${generateEmptyColumns(titleCounter)}
			<td><button type="button" class="btn btn-sm btn-danger deleteTitleRow"
				data-title-id="${titleCounter}"><i class="fa fa-trash"></i></button>
				<button type="button" class="btn btn-sm btn-success addRowUnderTitle" data-title-id="${titleCounter}">Add Row</button></td>
		</tr>`;
			$('#dynamicTable tbody').append(titleRow);
		});

		// Add new row under specific title row
		$(document).on('click', '.addRowUnderTitle', function () {
			const titleId = $(this).data('title-id'); // Get the title ID from the button
			const titleRow = $(this).closest('tr'); // Get the clicked title row
			const lastRow1 = titleRow.nextUntil('.title-row').last();
			let lastRow = $('#dynamicTable tbody tr:not(.title-row)').last(); // Get the last data row globally

			let lastStartTime = lastRow.find('.start-time').val() || initialTime; // Get last row's start time
			let lastDuration = lastRow.find('.duration').val() || 0;

			// Calculate the new start time for the next row based on the last row's start time and duration
			const newStartTime = calculateNewStartTime(lastStartTime, lastDuration);

			// Generate the new row and append it after the title row
			const newRow = generateRow(newStartTime, titleId);
			if (lastRow1.length) {
				lastRow1.after(newRow); // Append after the last row under the title
			} else {
				titleRow.after(newRow); // If no rows exist, add it right after the title row
			}
			recalculateStartTimes();
		});

		// Generate a new row with fields for start time, duration, etc.
		function generateRow(startTime, titleId) {
			let newRow = `<tr data-title-id="${titleId}">
			<td><input type="text" name="items[${titleId}][]" class="input-sm form-control" placeholder="Enter Item Name" required></td>
			<td><input type="time" readonly name="start[${titleId}][]" value="${startTime}" class="input-sm form-control start-time"></td>
			<td><input type="number" min="0" name="duration[${titleId}][]" class="input-sm form-control duration" placeholder="Enter Duration (min)" required></td>
			<td><input type="text" name="leadCrewMember[${titleId}][]" placeholder="Enter Lead Crew Member" class="input-sm form-control"></td>
			<td><input type="text" name="talent[${titleId}][]" placeholder="Enter Talent" class="input-sm form-control"></td>
			<td><input type="text" name="location[${titleId}][]" placeholder="Enter Location" class="input-sm form-control"></td>
			<td><input type="text" name="area[${titleId}][]" placeholder="Enter Area/Space" class="input-sm form-control"></td>
			<td><input type="text" name="details[${titleId}][]" placeholder="Enter Details" class="input-sm form-control"></td>
			<td><input type="text" name="privateNotes[${titleId}][]" placeholder="Enter Private Note" class="input-sm form-control"></td>
			<td><button type="button" class="btn btn-sm btn-danger removeRow"><i class="fa fa-trash"></i></button></td>
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

			console.log(titleRow);

			// Remove the title row and all rows that have the same title ID
			titleRow.nextUntil('.title-row').filter(`[data-title-id="${titleId}"]`).remove(); // Remove all data rows under the title
			titleRow.remove(); // Remove the title row

			recalculateStartTimes(); // Recalculate the start times after deletion
		});

		// Helper function to generate empty columns when adding a title row
		function generateEmptyColumns(titleId) {
			let columns = '';
			for (let i = 1; i < 9; i++) {
				columns += `<td data-title-id="${titleId}"></td>`;
			}
			return columns;
		}
	});
</script>
