<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Add New Modules</b></h4>
			</div>
			<div class="modal-body">
				<form id="form" action="<?= admin_url('saveModules') ?>" method="post">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="title"> Title <b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="title" id="title"
								   placeholder="Enter Title Name" required>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label for="columnName"> Column <b class="text-danger">*</b></label>
							<div class="form-group">
								<div class="custom-control custom-radio">
									<input class="custom-control-input" type="radio" id="customRadio1"
										   name="columnName" value="General" required>
									<label for="customRadio1" class="custom-control-label">General</label>
								</div>
								<div class="custom-control custom-radio">
									<input class="custom-control-input" type="radio" id="customRadio2"
										   name="columnName" value="Working at specific locations">
									<label for="customRadio2" class="custom-control-label">Working at specific
										locations</label>
								</div>
								<div class="custom-control custom-radio">
									<input class="custom-control-input" type="radio" id="customRadio3"
										   name="columnName" value="Physical factors">
									<label for="customRadio3" class="custom-control-label">Physical factors</label>
								</div>
								<div class="custom-control custom-radio">
									<input class="custom-control-input" type="radio" id="customRadio4"
										   name="columnName" value="Physical strain">
									<label for="customRadio4" class="custom-control-label">Physical strain</label>
								</div>
								<div class="custom-control custom-radio">
									<input class="custom-control-input" type="radio" id="customRadio5"
										   name="columnName" value="Work equipment">
									<label for="customRadio5" class="custom-control-label">Work equipment</label>
								</div>
								<div class="custom-control custom-radio">
									<input class="custom-control-input" type="radio" id="customRadio6"
										   name="columnName" value="Hazardous substances">
									<label for="customRadio6" class="custom-control-label">Hazardous substances</label>
								</div>
								<div class="custom-control custom-radio">
									<input class="custom-control-input" type="radio" id="customRadio7"
										   name="columnName" value="Accidents / Fire safety">
									<label for="customRadio7" class="custom-control-label">Accidents / Fire
										safety</label>
								</div>
								<div class="custom-control custom-radio">
									<input class="custom-control-input" type="radio" id="customRadio8"
										   name="columnName" value="Other">
									<label for="customRadio8" class="custom-control-label">Other</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="description"> Description </label>
							<textarea id="summernote" name="description"></textarea>
						</div>
					</div>
					<div class="box-footer">
						<div class="row">
							<div class="form-group col-md-12">
								<button type="submit" id="submit" class="btn btn-success pull-right">Save</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$('#summernote').summernote({
		height: 300,
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
</script>
