<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Create New Objective</b></h4>
			</div>
			<form id="formEdit" action="<?= admin_url('saveProjectKpiTitle/') . $id ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-4">
							<label for="type"> Type</label>
							<input type="text" name="type" id="type" value="Objective"
								   class="input-sm form-control type" readonly>
						</div>
						<div class="form-group col-md-4">
							<label for="okr"> OKR #</label>
							<input type="number" name="okr" value="<?= $okr ?>" id="okr"
								   class="input-sm form-control okr" readonly>
						</div>
						<div class="form-group col-md-4">
							<label for="productionPhase"> Production Phase <b
									class="text-danger text-bold">*</b></label>
							<select id="productionPhase" name="productionPhase"
									class="input-sm form-control productionPhase" required>
								<option value="Pre-Production">Pre-Production</option>
								<option value="Production">Production</option>
								<option value="Post-Production">Post-Production</option>
								<option value="Weave">Weave</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="timelineTrack"> Timeline Track <b class="text-danger">*</b></label>
							<input type="text" name="timelineTrack" id="timelineTrack"
								   class="input-sm form-control timelineTrack" maxlength="25" required>
						</div>
						<div class="form-group col-md-6">
							<label for="timelineGoal"> Timeline Action <b class="text-danger">*</b></label>
							<input type="text" id="timelineGoal" name="timelineGoal"
								   class="input-sm form-control timelineGoal" maxlength="25" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="timelineAction"> Action Details <b class="text-danger">*</b></label>
							<textarea rows="3" id="timelineAction" name="timelineAction"
									  class="input-sm form-control timelineAction" required></textarea>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-3">
							<label for="startDate">Start Date <b class="text-danger">*</b></label>
							<div class="input-group date">
								<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
								<input type="text" class="input-sm form-control" name="startDate" id="startDate"
									   value="<?= date('d M Y') ?>" required>
							</div>
						</div>
						<div class="form-group col-md-3">
							<label for="qtr"> QTR</label>
							<input type="text" name="qtr" id="qtr"
								   class="input-sm form-control qtr"
								   readonly>
						</div>
						<div class="form-group col-md-3">
							<label for="dueDate">Due Date <b class="text-danger">*</b></label>
							<div class="input-group date">
								<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
								<input type="text" class="input-sm form-control" name="dueDate" id="dueDate" required>
							</div>
						</div>
						<div class="form-group col-md-3">
							<label for="status"> Status <b
									class="text-danger text-bold">*</b></label>
							<input class="form-control" type="text" name="status" id="status" value="Not Started"
								   readonly>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-3">
							<label for="responsibleId">Responsible <b class="text-danger">*</b></label>
							<select style="width: 100%" id="responsibleId" name="responsibleId"
									class="form-control selectCustomer" required>
							</select>
						</div>
						<div class="form-group col-md-3">
							<label for="accountableId">Accountable </label>
							<select style="width: 100%" id="accountableId" name="accountableId"
									class="form-control selectCustomer">
							</select>
						</div>
						<div class="form-group col-md-3">
							<label for="consultedId"> Consulted </label>
							<select style="width: 100%" id="consultedId" name="consultedId"
									class="form-control selectCustomer">
							</select>
						</div>
						<div class="form-group col-md-3">
							<label for="informedId"> Informed </label>
							<select style="width: 100%" id="informedId" name="informedId"
									class="form-control selectCustomer">
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-3">
							<label for="xfnName"> XFN Partner Name </label>
							<input class="form-control" type="text" name="xfnName" id="xfnName">
						</div>
						<div class="form-group col-md-3">
							<label for="xfnEmail"> XFN Partner Email </label>
							<input class="form-control" type="text" name="xfnEmail" id="xfnEmail">
						</div>
						<div class="form-group col-md-3">
							<label for="studioFloName"> File Name </label>
							<input class="form-control" type="text" name="studioFloName" id="studioFloName">
						</div>
						<div class="form-group col-md-3">
							<label for="studioFloDirectory"> StudioFlo Directory/Link </label>
							<input class="form-control" type="text" name="studioFloDirectory" id="studioFloDirectory">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-3">
							<label for="timelineView"> Timeline View </label><br>
							<input class="timelineView-checkbox"
								   id="timelineView" type="checkbox"
								   value="1" name="timelineView"
								   style="width:20px;height:20px;">
						</div>
						<div class="form-group col-md-3">
							<label for="milestoneMark"> Mark as Milestone </label><br>
							<input class="timelineView-checkbox"
								   id="milestoneMark" type="checkbox"
								   value="1" name="milestoneMark"
								   style="width:20px;height:20px; accent-color: #980808">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="submit" class="btn" style="color: white; background-color: #0081CE">Add
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
	$('#startDate, #dueDate').datepicker({
		autoclose: true,
		todayHighlight: true,
		// startDate: '+0d',
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
