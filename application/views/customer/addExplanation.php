<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal" aria-label="Close">
					Close
				</button>
				<h4 class="modal-title"><b>Update Explanation</b></h4>
			</div>
			<form id="form" action="<?= customer_url('saveExplanation/' . $data->questionId) ?>" method="post"
				  enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<label for="explanation"> Explanation </label>
							<textarea class="form-control" id="explanation" name="explanation">
							<?= $data->explanation ?>
						</textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label>Images</label>
							<input type="file" name="inventoryAttachment" accept="image/*" id="inventoryAttachment"><br>
							<div class="card-body text-center">
								<img width="250" style="height: 250px;"
									 class="img-responsive img-thumbnail center-block" id="previewEdit"
									 src="<?= $data->inventoryAttachment != '' ? base_url('images/' .
											 $data->id . '/' . getSession()->id . '/' . $data->inventoryAttachment) : base_url('images/noImage.png') ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="row">
						<div class="form-group col-md-12">
							<button type="submit" class="btn btn-primary pull-right">Update</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(`#explanation`).summernote({
		height: 250,
		toolbar: [
			[ 'style', [ 'style' ] ],
			[ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
			[ 'fontname', [ 'fontname' ] ],
			[ 'fontsize', [ 'fontsize' ] ],
			[ 'color', [ 'color' ] ],
			[ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
			[ 'table', [ 'table' ] ],
			[ 'insert', [ 'link'] ],
			[ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview' ] ]
		]
	});
	$(document).ready(function () {
		$("#form").submit(function (submitEvent) {
			var filename = $("#inventoryAttachment").val();
			var extension = filename.replace(/^.*\./, '');

			if (extension == filename) {
				extension = '';
			} else {
				extension = extension.toLowerCase();
			}
			switch (extension) {
				case 'jpg':
				case 'jpeg':
				case 'png':
				case '':
					break;

				default:
					toastr.warning('Image format does not match!');
					submitEvent.preventDefault();
			}

		});
	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#previewEdit').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]); // convert to base64 string
		}
	}

	$("#inventoryAttachment").change(function () {
		readURL(this);
	});
</script>
