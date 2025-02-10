<?php
// Sample task data (replace this with actual data from your PHP model or database)
$tasks = [
	['phase' => 'Pre-production', 'title' => "Primary Task", 'name' => "Task 1", 'start_date' => "2024-04-10", 'end_date' => "2024-05-25"],
	['phase' => 'Pre-production', 'title' => "Primary Task", 'name' => "Task 2", 'start_date' => "2024-04-15", 'end_date' => "2024-06-10"],
	['phase' => 'Pre-production', 'title' => "Secondary Task", 'name' => "Task 3", 'start_date' => "2024-04-05", 'end_date' => "2024-06-15"],
	['phase' => 'Pre-production', 'title' => "Secondary Task", 'name' => "Task 4", 'start_date' => "2024-07-01", 'end_date' => "2024-09-10"],
	['phase' => 'Production', 'title' => "Optional Task", 'name' => "Task 5", 'start_date' => "2024-10-20", 'end_date' => "2024-11-15"],
	['phase' => 'Production', 'title' => "Optional Task", 'name' => "Task 6", 'start_date' => "2024-10-25", 'end_date' => "2024-12-05"],
	['phase' => 'Standard', 'title' => "New Task", 'name' => "Task 7", 'start_date' => "2024-06-20", 'end_date' => "2024-10-04"],
	['phase' => 'Standard', 'title' => "Redefine Task", 'name' => "Task 8", 'start_date' => "2025-02-25", 'end_date' => "2025-10-05"],
	['phase' => 'Standard', 'title' => "Redo Task", 'name' => "Task 9", 'start_date' => "2025-02-25", 'end_date' => "2025-05-05"],
];

// Function to generate random colors for task titles
function generateRandomColor($title)
{
	// Simple hash to generate a consistent color per title
	$hash = crc32($title);
	$hue = $hash % 360; // Hue between 0 and 359
	return "hsl($hue, 70%, 50%)";
}

// Find the min and max dates to dynamically calculate the quarters and months
$minTimestamp = min(array_map(function ($task) {
	return strtotime($task['start_date']);
}, $tasks));

$maxTimestamp = max(array_map(function ($task) {
	return strtotime($task['end_date']);
}, $tasks));

// Convert timestamps to DateTime objects directly using "@"
$minDate = new DateTime("@$minTimestamp");
$maxDate = new DateTime("@$maxTimestamp");

// Adjust timezone if needed
$minDate->setTimezone(new DateTimeZone(date_default_timezone_get()));
$maxDate->setTimezone(new DateTimeZone(date_default_timezone_get()));

// Generate Quarters and Months dynamically
$quarters = [];
$months = [];
$currentDate = clone $minDate;

// Normalize to the first day of the start month
$currentDate->modify('first day of this month');

// Loop through the months and quarters from the min to the max date
while ($currentDate <= $maxDate) {
	$quarter = ceil($currentDate->format('n') / 3);
	$quarterKey = $currentDate->format('Y') . "-Q" . $quarter; // Unique key per year-quarter
	if (!isset($quarters[$quarterKey])) {
		$quarters[$quarterKey] = [];
	}
	$quarters[$quarterKey][] = $currentDate->format('M');
	$months[] = $currentDate->format('M') . ' ' . $currentDate->format('Y'); // Including year for uniqueness
	$currentDate->modify('+1 month');
}

// Group tasks by phase and title
$groupedTasks = [];
foreach ($tasks as $task) {
	$phase = $task['phase'];
	$title = $task['title'];
	if (!isset($groupedTasks[$phase])) {
		$groupedTasks[$phase] = [];
	}
	if (!isset($groupedTasks[$phase][$title])) {
		$groupedTasks[$phase][$title] = [];
	}
	$groupedTasks[$phase][$title][] = $task;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Project Roadmap Gantt Chart</title>
	<style>
		.gantt-table {
			width: 100%;
			border-collapse: collapse;
		}

		.gantt-table th, .gantt-table td {
			border: 1px solid #ccc;
			padding: 5px;
			text-align: center;
			position: relative;
		}

		.gantt-table th.quarter-header {
			background-color: #7d7c81;
			color: white;
			font-size: 14px;
		}

		.gantt-table th.month-header {
			background-color: #f0f0f0;
			font-size: 12px;
		}

		.gantt-table td.timeline-column {
			height: 40px;
		}

		.gantt-bar {
			position: absolute;
			top: 15%;
			left: 0;
			height: 80%;
			border-radius: 3px;
			color: white;
			font-size: 10px;
			overflow: hidden;
			white-space: nowrap;
			text-overflow: ellipsis;
		}

		.phase-column {
			background-color: #d9edf7;
			font-weight: bold;
		}

		.task-name-column {
			color: white;
			font-weight: bold;
		}
	</style>
</head>
<body>
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
							<td colspan="2"><?= $minDate->format('F d, Y') ?></td>
							<td colspan="<?= count($quarters) * 3 ?>" style="border: 0px solid white"></td>
							<th style="background-color: #7d7c81; color: white">Legend</th>
							<td><span class="label label-danger">Milestone</span></td>
						</tr>
						<tr>
							<?php foreach ($quarters as $quarterKey => $quarterMonths):
								// Extract year and quarter
								list($year, $q) = explode("-Q", $quarterKey);
								$q = intval($q);
								// Get last two digits of the year
								$yearShort = substr($year, -2);
								?>
								<th colspan="<?= count($quarterMonths) ?>" class="quarter-header">
									Q<?= $q ?> (<?= implode(' - ', $quarterMonths) ?> <?= $yearShort ?>)
								</th>
							<?php endforeach; ?>
						</tr>
						<tr>
							<?php foreach ($months as $monthYear):
								// Split month and year for display
								list($month, $year) = explode(' ', $monthYear);
								?>
								<th class="month-header"><?= $month ?></th>
							<?php endforeach; ?>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($groupedTasks as $phase => $titles): ?>
							<?php
							// Calculate rowspan for phase
							$rowspan = count($titles);
							$phaseRendered = false;
							?>
							<?php foreach ($titles as $title => $tasksGroup): ?>
								<?php foreach ($tasksGroup as $task):
									// Calculate start and end months (0-based index)
									$taskStartDate = new DateTime($task['start_date']);
									$taskEndDate = new DateTime($task['end_date']);

									// Find the index in $months array for start and end
									$startIndex = array_search($taskStartDate->format('M Y'), $months);
									$endIndex = array_search($taskEndDate->format('M Y'), $months);

									// Handle cases where end date is beyond the maxDate
									if ($endIndex === false) {
										$endIndex = count($months) - 1;
									}

									// Calculate position and width
									$startDay = $taskStartDate->format('j');
									$endDay = $taskEndDate->format('j');

									$daysInStartMonth = cal_days_in_month(CAL_GREGORIAN, $taskStartDate->format('n'), $taskStartDate->format('Y'));
									$startOffset = ($startDay / $daysInStartMonth) * 100; // Percentage start within start month

									// Calculate total days for width
									$totalDays = ($taskEndDate->getTimestamp() - $taskStartDate->getTimestamp()) / (60 * 60 * 24);
									$totalMonths = $endIndex - $startIndex + 1;
									$barWidth = ($totalDays / (cal_days_in_month(CAL_GREGORIAN, $taskStartDate->format('n'), $taskStartDate->format('Y')) * $totalMonths)) * 100;

									// Ensure barWidth does not exceed 100%
									if ($barWidth > 100) $barWidth = 100;
									?>
									<tr>
										<?php if (!$phaseRendered): ?>
											<td class="phase-column" rowspan="<?= $rowspan ?>"><?= $phase ?></td>
											<?php $phaseRendered = true; ?>
										<?php endif; ?>
										<td class="task-name-column"
											style="background-color: <?= generateRandomColor($title); ?>"><?= htmlspecialchars($title) ?></td>
										<?php foreach ($months as $index => $monthYear): ?>
											<td class="timeline-column" style="position: relative;">
												<?php
												if ($index === $startIndex):
													// Display Gantt bar
													?>
													<div class="gantt-bar" style="
														left: <?= $startOffset ?>%;
														width: <?= $barWidth ?>%;
														background-color: <?= generateRandomColor($title); ?>;
														">
														<?= htmlspecialchars($task['name']) ?>
													</div>
												<?php endif; ?>
											</td>
										<?php endforeach; ?>
									</tr>
								<?php endforeach; ?>
							<?php endforeach; ?>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
