<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Update Theatre Crew</b></h4>
			</div>
			<form id="formEdit" action="<?= admin_url('updateTheatreCrew/') . $data->id ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="memberTitle">Theatre Crew Member Title <span
										class="text-danger">*</span></label>
							<input class="form-control input-sm" type="text" name="memberTitle"
								   id="memberTitle" value="<?= $data->memberTitle ?>" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="hourlyRate">Hourly Rate <span class="text-danger">*</span></label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input class="form-control input-sm"
									   type="number" step="any" min="0" name="hourlyRate"
									   id="hourlyRate" value="<?= $data->hourlyRate ?>" required>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="laborHour">Labor Hours <span class="text-danger">*</span></label>
							<input class="form-control input-sm" type="number"
								   step="any" min="0" value="<?= $data->laborHour ?>" name="laborHour" required
								   id="laborHour">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="total">Total Cost</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input class="form-control input-sm"
									   type="number" value="<?= $data->total ?>" step="any" min="0" name="total"
									   id="total" readonly>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="form-group col-md-12">
							<button type="submit" id="submit" class="btn btn-info pull-right">Update</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$('#hourlyRate, #laborHour').on('input', function () {
		var hourlyRate = parseFloat($('#hourlyRate').val()) || 0;
		var laborHour = parseFloat($('#laborHour').val()) || 0;
		var total = hourlyRate * laborHour;
		$('#total').val(total.toFixed(2));
	});
	$('#formEdit').on('submit', function (e) {
		e.preventDefault();
		var form = $(this);
		var actionUrl = form.attr('action');
		$.ajax({
			url: actionUrl,
			type: 'POST',
			data: form.serialize(),
			error: function () {
				toastr.warning('Something is wrong');
			},
			success: function (data) {
				$("#remoteModal1").modal('hide');
				$("#theatreCrewTable").load(window.location + " #theatreCrewTable > *");
				setTimeout(function () {
					calculateCosts();
				}, 1000);
				toastr.success("Record updated successfully");
			}
		});
	});
</script>
