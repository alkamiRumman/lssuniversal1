<div class="modal fade in" id="modal-default" style="display: block; overflow: auto;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b> Production Rejected Reason</b></h4>
			</div>
			<form id="formEdit" action="<?= admin_url('updateProductRejectedReason/') . $data->id ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<label for="rejectedReason"> Rejected Reason <b class="text-danger">*</b></label>
							<textarea class="form-control" name="rejectedReason" id="rejectedReason"
									  rows="12" style="height: auto" required><?= $data->rejectedReason ?></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="submit" class="btn btn-info pull-right">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
