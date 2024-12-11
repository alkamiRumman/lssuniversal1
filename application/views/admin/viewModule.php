<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal" aria-label="Close">
					Close
				</button>
				<h4 class="modal-title"><b>Module Details</b></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<label for="title"> Title </label>
						<pre class="form-control"><?= $data->title ?></pre>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label for="columnName"> Column </label>
						<pre class="form-control"><?= $data->columnName ?></pre>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label for="description"> Description </label>
						<textarea id="description" class="form-control">
							<?= $data->description != '' ? $data->description : '-' ?></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(`#description`).summernote({
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
