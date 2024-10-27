<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b><?= $data->title ?></b></h3>
				<a class="btn  pull-right" style="color: white; background-color: black"
				   href="javascript:window.history.go(-1);">Back</a>
			</div>
			<div class="box-body">
				<form id="dynamicForm" method="post"
					  action="<?php echo admin_url('saveRunOfShowDetails/' . $data->id); ?>">
					<div class="form-group">
						<button type="button" class="btn btn-success" id="addTitleRow">Add Title Row</button>
						<button type="button" class="btn btn-info" id="addColumn">Add New Column</button>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>

					<div class="table-responsive">
						<table id="dynamicTable" class="table table-striped table-bordered"
							   style="width: 99% !important;">
							<thead>
							<tr>
								<th>Title</th>
								<th>Start</th>
								<th>Duration</th>
								<th>Private Note</th>
								<th>Cast</th>
								<th>Actions</th>
							</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		let columnCount = 5; // Default number of columns (including Actions)
		let titleCounter = 0; // Unique identifier for each title
		let customColumns = 0; // Track the number of custom columns added

		// Initial start time from PHP data
		const initialTime = '<?= date("H:i", strtotime($data->time)); ?>';

		// Add new title row
		$('#addTitleRow').click(function () {
			titleCounter++; // Increment the title counter for each new title

			let titleRow = `
		<tr class="title-row" data-title-id="${titleCounter}">
			<td><input type="text" name="title[${titleCounter}]" class="form-control" placeholder="Enter Title Name" required></td>
			${generateEmptyColumns(columnCount, titleCounter)}
			<td><button type="button" class="btn btn-success addRowUnderTitle" data-title-id="${titleCounter}">Add Row</button></td>
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

		// Add new column linked to the corresponding title
		$('#addColumn').click(function () {
			columnCount += 1;
			customColumns += 1; // Increase the count of custom columns

			// Add new header input field for custom column name
			$('#dynamicTable thead tr th:last').before(`<th><input type="text" class="form-control custom-column-header" name="customColumnHeader[]" placeholder="Custom Header Name"></th>`);

			// Add new column inputs for each title row and corresponding data rows under each title
			$('#dynamicTable tbody tr').each(function () {
				const titleId = $(this).data('title-id'); // Get the title ID of the row

				// For title rows, append an empty column cell
				if ($(this).hasClass('title-row')) {
					$(this).find('td:last').before(`<td data-title-id="${titleId}"></td>`);
				} else {
					// For data rows, add a new input field in the new column associated with the title
					$(this).find('td:last').before(`<td><input type="text" name="customColumn[${titleId}][]" class="form-control" placeholder="Enter Data"></td>`);
				}
			});
		});

		// Generate a new row with fields for start time, duration, etc.
		function generateRow(startTime, titleId) {
			let newRow = `<tr data-title-id="${titleId}">
			<td><input type="text" name="items[${titleId}][]" class="form-control" placeholder="Enter Item Name" required></td>
			<td><input type="time" readonly name="start[${titleId}][]" value="${startTime}" class="form-control start-time"></td>
			<td><input type="number" min="0" name="duration[${titleId}][]" class="form-control duration" placeholder="Enter Duration (min)" required></td>
			<td><input type="text" name="privateNotes[${titleId}][]" placeholder="Enter Private Note" class="form-control"></td>
			<td><input type="text" name="cast[${titleId}][]" class="form-control" placeholder="Enter Cast"></td>`;

			// Append custom columns to the new row
			for (let i = 0; i < customColumns; i++) {
				newRow += `<td><input type="text" name="customColumn[${titleId}][]" class="form-control" placeholder="Enter Data"></td>`;
			}

			newRow += `<td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-trash"></i></button></td></tr>`;
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

		// Helper function to generate empty columns when adding a title row
		function generateEmptyColumns(count, titleId) {
			let columns = '';
			for (let i = 1; i < count; i++) {
				columns += `<td data-title-id="${titleId}"></td>`;
			}
			return columns;
		}
	});
</script>


