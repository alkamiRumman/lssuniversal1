<style>
	.panel .panel-heading {
		color: white;
		background-color: black;
	}

	.box-title .tTimelineTrack {
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

	/* Table Styles */
	.gantt-table {
		width: 100%;
		border-collapse: collapse;
		overflow-x: auto;
		/*table-layout: fixed;*/
	}

	.stickyColumn {
		position: sticky;
		left: 0;
		z-index: 1 !important;
	}

	.stickyColumn1 {
		position: sticky;
		left: 80px;
		z-index: 1 !important;
	}

	.stickyColumn2 {
		position: sticky;
		left: 180px;
		z-index: 1 !important;
	}

	.stickyColumn3 {
		position: sticky;
		left: 300px;
		z-index: 1 !important;
	}

	.stickyColumn4 {
		position: sticky;
		left: 380px;
		z-index: 1 !important;
	}

	.gantt-table th,
	.gantt-table td {
		border: 1px solid #ccc;
		text-align: center;
		padding: 5px;
		vertical-align: top;
	}

	/* Header and Styling */
	.month-header {
		font-weight: bold;
		background-color: #f4f4f4;
		border-top: 2px solid #000;
	}

	.quarter-header {
		font-weight: bold;
		color: white;
		background-color: black;
		text-align: center;
	}

	.task-name-column, .phase-column {
		width: 15%;
		vertical-align: middle !important;
	}

	/* Timeline and Gantt Bar */


	.gantt-bar {
		position: relative;
		/*z-index: 9999;*/
		top: 5px;
		margin-bottom: 3px;
		height: 30px;
		background-color: #4CAF50;
		border-radius: 5px;
		color: #fff;
		text-align: center;
		line-height: 30px;
		font-size: 12px;
		padding: 0 5px;
		overflow: hidden;
		white-space: nowrap;
		text-overflow: ellipsis;
	}

	.gantt-bar:hover {
		background-color: #45a049;
		cursor: pointer;
	}

	@media (max-width: 768px) {
		/* Reduce padding and font sizes for smaller screens */
		.box-title .tTimelineTrack {
			font-size: 1em;
		}

		.box-title .description {
			font-size: 0.8em;
		}

		.gantt-table th,
		.gantt-table td {
			padding: 3px;
			font-size: 0.9em; /* Smaller font for better readability */
		}

		.task-name-column,
		.phase-column {
			width: 50%; /* Allow more space for tasks */
		}

		.timeline-column {
			height: auto; /* Adjust height dynamically */
			min-height: 40px;
		}

		.gantt-bar {
			height: 25px; /* Reduce bar height */
			font-size: 10px;
			line-height: 25px;
		}
	}

	/* Responsive Adjustments for Extra Small Screens */
	@media (max-width: 480px) {
		/* Make table scrollable */
		.gantt-table {
			display: block;
			overflow-x: auto;
			white-space: nowrap; /* Prevent table from breaking */
		}

		/* Stack task/phase names vertically if space is too tight */
		.task-name-column,
		.phase-column {
			width: 100%; /* Full width on very small screens */
			text-align: left;
		}

		/* Reduce bar size even further */
		.gantt-bar {
			height: 20px;
			font-size: 9px;
			line-height: 20px;
		}
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">
					<b class="title"><?= $data->title ?></b>
					<span class="description">Roadmap</span>
				</h3>
				<div class="form-group pull-right">
					<a class="btn btn-default" href="<?= customer_url('overviewProject/' . $data->id) ?>">Overview</a>
					<a class="btn btn-default" href="<?= customer_url('projectKpi/' . $data->id) ?>">Team
						KPI</a>
					<a class="btn btn-default active">Roadmap</a>
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
				<div class="table-responsive">
					<table class="gantt-table" id="gantt-chart">
						<thead>
						</thead>
						<tbody id="gantt-body"></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		// Parse the tasks JSON
		const tasks = JSON.parse('<?php echo addslashes(json_encode($projectKpiDetails)); ?>');
		// Find the minimum start date and maximum end date
		const dates = tasks.map(task => ({
			start: new Date(task.iStartDate),
			end: new Date(task.iDueDate)
		}));
		const minDate = new Date(Math.min(...dates.map(d => d.start)));
		const maxDate = new Date(Math.max(...dates.map(d => d.end)));
		let options = {year: "numeric", month: "long", day: "numeric"};
		let formattedDate = '';
		if (minDate != 'Invalid Date') {
			formattedDate = minDate.toLocaleDateString("en-US", options);
		} else {
			formattedDate = '-';
		}

		// Generate the list of quarters and months
		const generateTimelineHeaders = (start, end) => {
			const headers = [];
			let current = new Date(start.getFullYear(), start.getMonth(), 1);

			while (current <= end) {
				const year = current.getFullYear();
				const quarter = Math.floor(current.getMonth() / 3) + 1;
				const month = current.toLocaleString('default', {month: 'long'});

				headers.push({year, quarter, month});
				current.setMonth(current.getMonth() + 1);
			}

			return headers;
		};

		const timelineHeaders = generateTimelineHeaders(minDate, maxDate);

		// Generate unique colors for each title
		const titleColors = {};
		tasks.forEach((task, index) => {
			if (!titleColors[task.tTimelineTrack]) {
				titleColors[task.tTimelineTrack] = generateRandomColor(index);
			}
		});

		// Group tasks by phase and then by title
		const groupedTasks = tasks.reduce((acc, task) => {
			acc[task.tProductionPhase] = acc[task.tProductionPhase] || {};
			acc[task.tProductionPhase][task.tTimelineTrack] = acc[task.tProductionPhase][task.tTimelineTrack] || [];
			acc[task.tProductionPhase][task.tTimelineTrack].push(task);
			return acc;
		}, {});

		// Populate Gantt chart headers
		const headerRow = $("#gantt-chart thead");
		headerRow.empty();

		const yearHeaders = {};
		timelineHeaders.forEach(({year, quarter, month}) => {
			if (!yearHeaders[year]) {
				yearHeaders[year] = {quarters: {}};
			}
			yearHeaders[year].quarters[quarter] = yearHeaders[year].quarters[quarter] || [];
			yearHeaders[year].quarters[quarter].push(month);
		});

		const daysInMonth = {
			January: 31,
			February: 28,
			March: 31,
			April: 30,
			May: 31,
			June: 30,
			July: 31,
			August: 31,
			September: 30,
			October: 31,
			November: 30,
			December: 31
		};

		// Calculate the total number of days for all months
		const totalColumns = timelineHeaders.reduce((total, {month}) => total + daysInMonth[month], 0);
// Add Year Header Row
		let yearRow = `
    <tr>
        <th colspan="2" rowspan="5" class="task-name-column stickyColumn" style="background-color: #f1eeee; font-size: 20px">Overview</th>
        <th colspan="6" class="stickyColumn1" style="background-color: black; color: white">Start Month</th>
        <td colspan="6" class="stickyColumn2">${formattedDate}</td>
        <th colspan="3" class="stickyColumn3" style="background-color: black; color: white">Legend</th>
        <td colspan="8" class="stickyColumn4">
            <span class="label label-danger">Milestone</span>
            <span class="label" style="background-color: #7d7c81">Completed</span>
            <span class="label" style="background-color: red">Blocked (X)</span>
        </td>
    </tr><tr>`;

// Generate year headers
		Object.entries(yearHeaders).forEach(([year, {quarters}]) => {
			const yearColspan = Object.values(quarters).flat().reduce((sum, months) => sum + daysInMonth[months], 0);
			yearRow += `<th colspan="${yearColspan}" class="month-header" style="border-right: 1px solid black">${year}</th>`;
		});
		yearRow += '</tr>';
		headerRow.append(yearRow);

// Add Quarter Header Row
		let quarterRow = '<tr>';
		Object.values(yearHeaders).forEach(({quarters}) => {
			Object.entries(quarters).forEach(([quarter, months]) => {
				const quarterColspan = months.reduce((sum, month) => sum + daysInMonth[month], 0);
				quarterRow += `<th colspan="${quarterColspan}" class="quarter-header" style="border-right: 1px solid white">Q${quarter}</th>`;
			});
		});
		quarterRow += '</tr>';
		headerRow.append(quarterRow);

// Add Month Header Row
		let monthRow = '<tr>';
		timelineHeaders.forEach(({month}) => {
			const days = daysInMonth[month]; // Get days for this month
			monthRow += `<th colspan="${days}" class="month-header" style="border-right: 1px solid black">${month}</th>`;
		});
		monthRow += '</tr>';
		headerRow.append(monthRow);

// Add Days Header Row
		let daysRow = '<tr>';
		timelineHeaders.forEach(({month}, index) => {
			const days = daysInMonth[month]; // Get days for this month
			for (let day = 1; day <= days; day++) {
				// Check if this is the last day of the month
				const isLastDayOfMonth = day === days;
				// Add style if it is the last day of the month
				const style = isLastDayOfMonth ? 'style="border-right: 1px solid black"' : '';

				daysRow += `<th class="day-header" ${style}>${day}</th>`;
			}
		});
		daysRow += '</tr>';
		headerRow.append(daysRow);


		// Function to calculate Gantt bar position and width
		const tbody = $("#gantt-chart tbody").empty();
		let hasData = false; // Flag to track if any data is rendered

		Object.entries(groupedTasks).forEach(([phase, titles]) => {
			Object.entries(titles).forEach(([title, tasks]) => {
				// Filter tasks where iTimelineView === 1
				const filteredTasks = tasks.filter(task => parseInt(task.iTimelineView) === 1);

				// Skip processing if no tasks match the condition
				if (filteredTasks.length === 0) return;

				hasData = true; // Data found
				const phaseRowspan = filteredTasks.length;

				// Iterate over filtered tasks and create rows
				filteredTasks.forEach((task, index) => {
					const row = $("<tr></tr>");

					// Add phase and title only once for the grouped rows
					if (index === 0) {
						row.append(
							`<td class="phase-column stickyColumn" rowspan="${phaseRowspan}" style="color: white; background-color: black">${phase}</td>`
						);
						row.append(
							`<td class="task-name-column stickyColumn1" rowspan="${phaseRowspan}" style="color: white; background-color: ${titleColors[title] || '#ccc'};">${title}</td>`
						);
					}

					// Validate dates and calculate start and end index
					const startDate = new Date(task.iStartDate);
					const endDate = new Date(task.iDueDate);
					if (isNaN(startDate) || isNaN(endDate)) return;

					const startIndex = Math.floor((startDate - minDate) / (1000 * 60 * 60 * 24));
					const endIndex = Math.floor((endDate - minDate) / (1000 * 60 * 60 * 24));

					if (startIndex < 0 || endIndex < 0 || startIndex >= totalColumns || endIndex >= totalColumns) {
						console.error(`Invalid date range for task: ${task.iTimelineGoal}`);
						return; // Skip invalid tasks
					}

					// Update the appropriate timeline columns with the task bar
					let taskColor = titleColors[title] || '#ccc';
					let blockedSign = '';
					if (parseInt(task.iMilestoneMark) === 1) taskColor = '#DD4B39';
					if (task.iStatus === 'Completed') taskColor = '#7d7c81';
					if (task.iStatus === 'Blocked') blockedSign = '<span class="label" style="background-color: red">X</span>';

					// Create timeline columns
					const timelineColumns = Array(totalColumns).fill('<td class="timeline-column"></td>');

					// Check if the startIndex and endIndex are within the table length
					if (startIndex < totalColumns) {
						const actualEndIndex = Math.min(endIndex, totalColumns - 1); // Prevent overflow
						const colspan = actualEndIndex - startIndex + 1;

						// Replace only the valid range in the timelineColumns array
						timelineColumns[startIndex] = `
							<td class="timeline-column" colspan="${colspan}">
								<div class="gantt-bar"
									title="${task.iTimelineGoal}"
									onclick="loadPopup('<?= customer_url('viewProjectKpiItem/') ?>${task.iId}')"
									style="background-color: ${taskColor};">
									${blockedSign} ${task.iTimelineGoal}
								</div>
							</td>
						`;

						// Clear the overlapping cells within the colspan range
						for (let i = startIndex + 1; i <= actualEndIndex; i++) {
							timelineColumns[i] = ''; // Mark as empty to avoid extra `<td>`
						}
					}

					// Combine all timeline columns into the row
					row.append(timelineColumns.join(''));

					// Append the row to tbody
					tbody.append(row);
				});
			});
		});

		// Show empty message if no data was added
		const noTaskColumn = totalColumns < 23 ? 26 : (totalColumns - 26);
		if (!hasData) {
			tbody.append(`
					<tr>
						<td colspan="${noTaskColumn}" class="text-center text-danger text-bold">
							<h4>No tasks to display</h4>
						</td>
					</tr>
				`);
		}


		// Generate a random color for Gantt bars
		function generateRandomColor(index) {
			const hueStep = 137.5;
			let hue = (index * hueStep) % 360;

			// Adjust the hue to skip the red range (0-30 and 330-360)
			if (hue >= 330 || hue <= 30) {
				hue = (hue + 30) % 360; // Shift hue to a non-red range
			}

			const saturation = 70;
			const lightness = 50;
			return `hsl(${hue}, ${saturation}%, ${lightness}%)`;
		}
	});

</script>
