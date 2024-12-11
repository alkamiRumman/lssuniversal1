<style>
	/* Table Styles */
	.gantt-table {
		width: 100%;
		border-collapse: collapse;
		table-layout: fixed;
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
		background-color: #807d7d;
		text-align: center;
	}

	.task-name-column, .phase-column {
		width: 15%;
		vertical-align: middle !important;
	}

	/* Timeline and Gantt Bar */
	.timeline-column {
		position: relative;
		height: 50px;
		background-color: #f9f9f9;
	}

	.gantt-bar {
		position: relative;
		z-index: 9999;
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

	/* Container for the main content */
	.main-content {
		width: 100%;
		transition: width 0.4s ease;
	}

	/* Sidebar modal styling */
	.side-modal {
		position: fixed;
		top: 0;
		right: -50%; /* Initially hidden */
		width: 50%;
		height: 100%;
		background-color: #f8f9fa; /* Light background */
		box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
		transition: left 0.4s ease; /* Smooth slide-in */
		z-index: 1050; /* Ensure it's above other elements */
		overflow-y: auto;
		display: flex;
		flex-direction: column;
	}
</style>

<div class="container-fluid">
	<!-- Main content -->
	<div id="mainContent" class="main-content">
		<button id="openModal" class="btn btn-primary">Open Modal</button>
		<p>Your main content goes here.</p>
	</div>

	<!-- Sidebar Modal -->
	<div id="sideModal" class="side-modal">
		<div class="modal-header">
			<button type="button" class="close" id="closeModal">&times;</button>
			<h4 class="modal-title">Modal Title</h4>
		</div>
		<div class="modal-body">
			<p>Modal content goes here.</p>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Project Roadmap</b></h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="gantt-table" id="gantt-chart">
						<thead>
						<tr>
							<th colspan="2" rowspan="3" class="task-name-column" style="font-size: 20px">Overview</th>
							<th style="background-color: #7d7c81; color: white">Start Month</th>
							<td colspan="2">November 1, 2024</td>
							<td colspan="7" style="border: 0px solid white"></td>
							<th style="background-color: #7d7c81; color: white">Legend</th>
							<td><span class="label label-danger">Milestone</span></td>
						</tr>
						<tr>
							<th colspan="3" class="quarter-header">Q1 (Jan - Mar)</th>
							<th colspan="3" class="quarter-header">Q2 (Apr - Jun)</th>
							<th colspan="3" class="quarter-header">Q3 (Jul - Sep)</th>
							<th colspan="3" class="quarter-header">Q4 (Oct - Dec)</th>
						</tr>
						<tr>
							<th class="month-header">Jan</th>
							<th class="month-header">Feb</th>
							<th class="month-header">Mar</th>
							<th class="month-header">Apr</th>
							<th class="month-header">May</th>
							<th class="month-header">Jun</th>
							<th class="month-header">Jul</th>
							<th class="month-header">Aug</th>
							<th class="month-header">Sep</th>
							<th class="month-header">Oct</th>
							<th class="month-header">Nov</th>
							<th class="month-header">Dec</th>
						</tr>
						</thead>
						<tbody id="gantt-body"></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('#openModal').on('click', function () {
		$('#sideModal').css('right', '0'); // Slide in the modal
		$('#mainContent').css('width', '50%'); // Shrink main content
	});

	// Close the modal
	$('#closeModal').on('click', function () {
		$('#sideModal').css('right', '-50%'); // Slide out the modal
		$('#mainContent').css('width', '100%'); // Restore main content size
	});

	$(document).ready(function () {
		const tasks = [
			{
				phase: 'Pre-production',
				title: "Primary Task",
				name: "Task 1",
				start_date: "2024-04-10",
				end_date: "2024-05-25"
			},
			{
				phase: 'Pre-production',
				title: "Primary Task",
				name: "Task 2",
				start_date: "2024-04-15",
				end_date: "2024-06-10"
			},
			{
				phase: 'Pre-production',
				title: "Secondary Task",
				name: "Task 3",
				start_date: "2024-04-05",
				end_date: "2024-06-15"
			},
			{
				phase: 'Pre-production',
				title: "Secondary Task",
				name: "Task 4",
				start_date: "2024-07-01",
				end_date: "2024-09-10"
			},
			{
				phase: 'Production',
				title: "Optional Task",
				name: "Task 5",
				start_date: "2024-10-20",
				end_date: "2024-11-15"
			},
			{
				phase: 'Production',
				title: "Optional Task",
				name: "Task 6",
				start_date: "2024-10-25",
				end_date: "2024-12-05"
			},
			{phase: 'Standard', title: "New Task", name: "Task 7", start_date: "2024-06-20", end_date: "2024-10-04"},
			{
				phase: 'Standard',
				title: "Redefine Task",
				name: "Task 8",
				start_date: "2025-02-25",
				end_date: "2025-10-05"
			},
		];

		// Generate unique colors for each title
		const titleColors = {};
		tasks.forEach((task, index) => {
			if (!titleColors[task.title]) {
				titleColors[task.title] = generateRandomColor(index);
			}
		});

		// Group tasks by phase and then by title
		const groupedTasks = tasks.reduce((acc, task) => {
			acc[task.phase] = acc[task.phase] || {};
			acc[task.phase][task.title] = acc[task.phase][task.title] || [];
			acc[task.phase][task.title].push(task);
			return acc;
		}, {});

		// Function to calculate Gantt bar position and width
		const calculateBar = (startDate, endDate) => {
			const start = new Date(startDate);
			const end = new Date(endDate);

			const startMonth = start.getMonth();
			const endMonth = end.getMonth();
			const startDay = start.getDate();
			const endDay = end.getDate();

			const daysInStartMonth = new Date(start.getFullYear(), startMonth + 1, 0).getDate();
			const daysInEndMonth = new Date(end.getFullYear(), endMonth + 1, 0).getDate();

			const startOffset = (startDay / daysInStartMonth) * 100; // Percent start within start month
			const endWidth = ((endDay / daysInEndMonth) * 100) + (endMonth - startMonth) * 100; // Width in percent

			return {startMonth, startOffset, endWidth};
		};

		// Populate Gantt chart
		const tbody = $("#gantt-chart tbody");

		for (const [phase, titles] of Object.entries(groupedTasks)) {
			let phaseRowAdded = false;

			for (const [title, tasks] of Object.entries(titles)) {
				const row = $("<tr></tr>");

				// Add phase column only for the first title in the group with rowspan
				if (!phaseRowAdded) {
					const phaseRowspan = Object.values(titles).length; // Number of unique titles in the phase
					row.append(`<td class="phase-column" rowspan="${phaseRowspan}">${phase}</td>`);
					phaseRowAdded = true;
				}

				// Add title column
				row.append(`<td class="task-name-column" style="color: white; background-color: ${titleColors[title]};">${title}</td>`);

				// Create timeline columns
				for (let i = 0; i < 12; i++) {
					row.append(`<td class="timeline-column"></td>`);
				}

				// Add task bars to their respective columns
				tasks.forEach((task) => {
					const {startMonth, startOffset, endWidth} = calculateBar(task.start_date, task.end_date);

					// Append Gantt bar to the corresponding month column
					row.find(`td.timeline-column:eq(${startMonth})`)
						.append(
							`<div class="gantt-bar" style="left: ${startOffset}%; width: ${endWidth}%; background-color: ${titleColors[title]};">
                            ${task.name}, start: ${task.start_date}
                        </div>`
						);
				});

				// Append the row to the table
				tbody.append(row);
			}
		}

		// Generate a random color for Gantt bars
		function generateRandomColor(index) {
			const hueStep = 137.5; // Golden angle for evenly spaced hues
			const baseHue = (index * hueStep) % 360;
			// Adjust hue to avoid red (0° to 30° and 330° to 360°)
			const hue = baseHue >= 0 && baseHue < 30 ? baseHue + 30 : baseHue >= 330 ? baseHue - 30 : baseHue;

			const saturation = 70; // Vibrant colors
			const lightness = 50;  // Balanced brightness

			return `hsl(${hue}, ${saturation}%, ${lightness}%)`;
		}
	});
</script>
