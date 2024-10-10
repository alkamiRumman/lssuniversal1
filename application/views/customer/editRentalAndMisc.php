<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Update Rental & Misc Fee</b></h4>
			</div>
			<form id="formEdit" action="<?= customer_url('updateRentalAndMisc/') . $data->id ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="title"> Title <span
										class="text-danger">*</span></label>
							<input class="form-control input-sm" type="text" name="title"
								   id="title" value="<?= $data->title ?>" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="total">Total Cost <span
										class="text-danger">*</span></label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input class="form-control input-sm"
									   type="number" step="any" min="0" name="total"
									   id="total" value="<?= $data->total ?>" required>
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
				$("#rentalAndMiscTable").load(window.location + " #rentalAndMiscTable > *");
				setTimeout(function () {
					calculateCosts();
				}, 1000);
				toastr.success("Record updated successfully");
			}
		});
	});
</script>
