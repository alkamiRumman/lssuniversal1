<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Update Key Result</b></h4>
			</div>
			<form id="formEdit" action="<?= admin_url('updateProjectKpiItem/') . $data->id ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-4">
							<label for="type"> Type</label>
							<input type="text" name="type" id="type" value="Key Result"
								   class="input-sm form-control type" readonly>
							<input type="hidden" name="projectId" value="<?= $data->projectId ?>">
							<input type="hidden" name="titleId" value="<?= $data->title_id ?>">
						</div>
						<div class="form-group col-md-4">
							<label for="okr"> OKR #</label>
							<input type="number" value="<?= $data->tOkr . '.' . $data->okr ?>" id="okr"
								   class="input-sm form-control okr" readonly>
							<input type="hidden" name="okr" value="<?= $data->okr ?>">
						</div>
						<div class="form-group col-md-4">
							<label for="productionPhase"> Production Phase <b
									class="text-danger text-bold">*</b></label>
							<input id="productionPhase" name="productionPhase"
								   value="<?= $data->productionPhase ?>"
								   class="input-sm form-control productionPhase" readonly>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="timelineTrack"> Timeline Track <b class="text-danger">*</b></label>
							<input type="text" name="timelineTrack" id="timelineTrack"
								   value="<?= $data->timelineTrack ?>"
								   class="input-sm form-control timelineTrack" maxlength="25" readonly>
						</div>
						<div class="form-group col-md-6">
							<label for="timelineGoal"> Timeline Action <b class="text-danger">*</b></label>
							<input type="text" id="timelineGoal" name="timelineGoal" value="<?= $data->timelineGoal ?>"
								   class="input-sm form-control timelineGoal" maxlength="25" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="timelineAction"> Action Details <b class="text-danger">*</b></label>
							<textarea rows="3" id="timelineAction" name="timelineAction"
									  class="input-sm form-control timelineAction"
									  required><?= $data->timelineAction ?></textarea>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-3">
							<label for="startDate">Start Date <b class="text-danger">*</b></label>
							<div class="input-group date">
								<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
								<input type="text" class="input-sm form-control" name="startDate" id="startDate"
									   value="<?= date('d M Y', strtotime($data->startDate)) ?>" required>
							</div>
						</div>
						<div class="form-group col-md-3">
							<label for="qtr"> QTR</label>
							<input type="text" name="qtr" id="qtr"
								   class="input-sm form-control qtr" value="<?= $data->qtr ?>"
								   readonly>
						</div>
						<div class="form-group col-md-3">
							<label for="dueDate">Due Date <b class="text-danger">*</b></label>
							<div class="input-group date">
								<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
								<input type="text" class="input-sm form-control" name="dueDate"
									   value="<?= date('d M Y', strtotime($data->dueDate)) ?>" id="dueDate" required>
								<input type="hidden" id="tDueDate" name="tDueDate"
									   value="<?= date('d M Y', strtotime($data->tDueDate)) ?>">
							</div>
						</div>
						<div class="form-group col-md-3">
							<label for="status"> Status <b
									class="text-danger text-bold">*</b></label>
							<select id="status" name="status"
									class="input-sm form-control status" required>
								<option <?= $data->status == 'Not Started' ? 'selected' : '' ?> value="Not Started">Not
									Started
								</option>
								<option <?= $data->status == 'In-Progress' ? 'selected' : '' ?> value="In-Progress">
									In-Progress
								</option>
								<option <?= $data->status == 'Blocked' ? 'selected' : '' ?> value="Blocked">
									Blocked
								</option>
								<option <?= $data->status == 'Completed' ? 'selected' : '' ?> value="Completed">
									Completed
								</option>
								<option disabled <?= $data->status == 'Late' ? 'selected' : '' ?> value="Late">Late
								</option>
							</select>
						</div>
					</div>
					<div class="row blockReason" style="<?= $data->status == 'Blocked' ? '' : 'display:none' ?>">
						<div class="form-group col-md-12">
							<label for="blockReason"> Block Reason <b
									class="text-danger text-bold">*</b></label>
							<input class="form-control" type="text" name="blockReason"
								   id="blockReason" <?= $data->status == 'Blocked' ? 'required' : '' ?>>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-3">
							<label for="responsibleId">Responsible <b class="text-danger">*</b></label>
							<select style="width: 100%" id="responsibleId" name="responsibleId"
									class="form-control selectCustomer" required>
								<?php if ($data->responsibleId) { ?>
									<option selected
											value="<?= $data->responsibleId ?>"><?= $data->responsible ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-md-3">
							<label for="accountableId">Accountable </label>
							<select style="width: 100%" id="accountableId" name="accountableId"
									class="form-control selectCustomer">
								<?php if ($data->accountableId) { ?>
									<option selected
											value="<?= $data->accountableId ?>"><?= $data->accountable ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-md-3">
							<label for="consultedId"> Consulted </label>
							<select style="width: 100%" id="consultedId" name="consultedId"
									class="form-control selectCustomer">
								<?php if ($data->consultedId) { ?>
									<option selected value="<?= $data->consultedId ?>"><?= $data->consulted ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-md-3">
							<label for="informedId"> Informed </label>
							<select style="width: 100%" id="informedId" name="informedId"
									class="form-control selectCustomer">
								<?php if ($data->informed) { ?>
									<option selected value="<?= $data->informedId ?>"><?= $data->informed ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-3">
							<label for="xfnName"> XFN Partner Name </label>
							<input class="form-control" type="text" value="<?= $data->xfnName ?>" name="xfnName"
								   id="xfnName">
						</div>
						<div class="form-group col-md-3">
							<label for="xfnEmail"> XFN Partner Email </label>
							<input class="form-control" type="text" value="<?= $data->xfnEmail ?>" name="xfnEmail"
								   id="xfnEmail">
						</div>
						<div class="form-group col-md-3">
							<label for="studioFloName"> File Name </label>
							<input class="form-control" type="text" name="studioFloName"
								   value="<?= $data->studioFloName ?>" id="studioFloName">
						</div>
						<div class="form-group col-md-3">
							<label for="studioFloDirectory"> StudioFlo Directory/Link </label>
							<input class="form-control" type="text" name="studioFloDirectory"
								   value="<?= $data->studioFloDirectory ?>" id="studioFloDirectory">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-3">
							<label for="timelineView"> Timeline View </label><br>
							<input class="timelineView-checkbox"
								   id="timelineView" type="checkbox"
								<?= $data->timelineView == 1 ? 'checked' : '' ?>
								   value="1" name="timelineView"
								   style="width:20px;height:20px;">
						</div>
						<div class="form-group col-md-3">
							<label for="milestoneMark"> Mark as Milestone </label><br>
							<input class="timelineView-checkbox"
								   id="milestoneMark" type="checkbox"
								<?= $data->milestoneMark == 1 ? 'checked' : '' ?>
								   value="1" name="milestoneMark"
								   style="width:20px;height:20px; accent-color: #980808">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="submit" class="btn" style="color: white; background-color: #0081CE">Update
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(function () {
		$(".selectCustomer").select2({
			dropdownParent: $('#remoteModal1'),
			placeholder: "Select Team Member",
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
					return {
						results: response
					};
				}
			}
		});
	});

	$('#status').on('change', function () {
		var val = $('#status').find(":selected").val();
		console.log(val);
		if (val === 'Blocked') {
			$('.blockReason').show();
			$('#blockReason').attr('required', true);
		} else {
			$('.blockReason').hide();
			$('#blockReason').attr('required', false);
		}
	});

	$('#startDate, #dueDate').datepicker({
		autoclose: true,
		todayHighlight: true,
		startDate: '+0d',
		endDate: $('#tDueDate').val(),
		format: 'dd M yyyy'
	});

	var dateValue = $('#startDate').val();
	if (dateValue) {
		const date = new Date(dateValue);
		if (!isNaN(date)) {
			const month = date.getMonth();
			const quarter = Math.ceil((month + 1) / 3);
			$('#qtr').val(quarter);
		} else {
			toastr.warning("Invalid date format.");
		}
	}

	$('#startDate').on('change', function () {
		var dateValue = $(this).val();
		if (dateValue) {
			const date = new Date(dateValue);
			if (!isNaN(date)) {
				const month = date.getMonth();
				const quarter = Math.ceil((month + 1) / 3);
				$('#qtr').val(quarter);
			} else {
				toastr.warning("Invalid date format.");
			}
		} else {
			toastr.warning("No date selected.");
		}
	})
</script>
