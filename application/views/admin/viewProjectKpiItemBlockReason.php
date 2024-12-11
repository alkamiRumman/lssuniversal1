<div class="modal fade in" id="modal-default" style="display: block; overflow: auto;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Block Reason</b></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<textarea class="form-control" name="rejectedReason" id="rejectedReason"
								  rows="12" style="height: auto" readonly><?= $data->blockReason ?></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
