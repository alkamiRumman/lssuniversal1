<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">
					Close
				</button>
				<a href="javascript:void(0);" class="btn pull-right"
				   style="background-color: black; color: white"
				   onclick="loadPopup('<?= customer_url('editProjectKpiItem/') . $data->id ?>')">Edit</a>
				<h4 class="modal-title"><b>Key Result Details</b></h4>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<tbody>
						<tr>
							<th>OKR #</th>
							<td><?= $data->tOkr . '.' . $data->okr ?></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<th>Production Phase</th>
							<td colspan="3"><?= $data->productionPhase ?></td>
						</tr>
						<tr>
							<th>Timeline Track</th>
							<td><?= $data->timelineTrack ?></td>
							<th>Timeline Action</th>
							<td><?= $data->timelineGoal ?></td>
						</tr>
						<tr>
							<th>Action Details</th>
							<td colspan="3"><?= nl2br($data->timelineAction) ?></td>
						</tr>
						<tr>
							<th>Start Date</th>
							<td><?= date('d M Y', strtotime($data->startDate)) ?></td>
							<th>Due Date</th>
							<td><?= date('d M Y', strtotime($data->dueDate)) ?></td>
						</tr>
						<tr>
							<th>QTR</th>
							<td><?= $data->qtr ?></td>
							<th>Status</th>
							<td><?= $data->status ?></td>
						</tr>
						<?php if ($data->status == 'Blocked') : ?>
							<tr>
								<th>Block Reason</th>
								<td colspan="3"><?= $data->blockReason ?></td>
							</tr>
						<?php endif; ?>
						<tr>
							<th>Responsible</th>
							<td><?= $data->responsible ?></td>
							<th>Accountable</th>
							<td><?= $data->accountable ?></td>
						</tr>
						<tr>
							<th>Consulted</th>
							<td><?= $data->consulted ?></td>
							<th>Informed</th>
							<td><?= $data->informed ?></td>
						</tr>
						<tr>
							<th>XFN Partner Name</th>
							<td><?= $data->xfnName ?></td>
							<th>XFN Partner Email</th>
							<td><?= $data->xfnEmail ?></td>
						</tr>
						<tr>
							<th>File Name</th>
							<td><?= $data->studioFloName ?></td>
							<th>StudioFlo Directory/Link</th>
							<td><?php
								$url = $data->studioFloDirectory;
								if ($url) {
									if (!preg_match('/^(http:\/\/|https:\/\/|www\.)/i', $url)) {
										$url = 'https://' . $url;
									}
								} else {
									$url = '';
								}
								echo '<a class="btn-link" style="color: black; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: inline-block; max-width: 200px;" href="' . $url . '" target="_blank">' . $url . '</a>';
								?>
							</td>
						</tr>
						<tr>
							<th>Timeline View</th>
							<td>
								<input class="timelineView-checkbox" id="timelineView"
									   type="checkbox"
									   name="timelineView" <?= $data->timelineView == 1 ? 'checked' : '' ?>
									   onclick="return false"
									   style="width:20px;height:20px;">
							</td>
							<th>Mark as Milestone</th>
							<td>
								<input class="timelineView-checkbox" id="timelineView"
									   type="checkbox"
									   name="timelineView" <?= $data->milestoneMark == 1 ? 'checked' : '' ?>
									   onclick="return false"
									   style="width:20px;height:20px;accent-color: #980808">
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.table-bordered {
		border: 1px solid #ddd;
	}

	.table td {
		font-weight: normal;
	}

	.table th, .table td {
		vertical-align: middle;
		text-align: left;
	}

	.table th {
		background-color: #f1eeee;
		font-weight: bold;
		width: 25%;
	}
</style>
