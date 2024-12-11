<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Laws, rules and standards</b></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="assessmentCriteria"><?= $data->lawsRulesStandard ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(`.assessmentCriteria`).summernote({
		toolbar: false,
		height: 'auto',
		focus: false,
		callbacks: {
			onInit: function () {
				$(this).next('.note-editor').find('.note-editable').attr('contenteditable', false); // Make it read-only
			}
		}
	});
</script>
