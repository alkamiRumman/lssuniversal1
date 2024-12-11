<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Add New Question</b></h4>
			</div>
			<div class="modal-body">
				<form id="form" action="<?= admin_url('saveQuestions/') . $data->id ?>" method="post">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="module"> Module <b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="module" id="module"
								   value="<?= $data->title ?>" readonly>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="questionNumber"> Question Number <b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="questionNumber" id="questionNumber"
								   placeholder="Enter Question Number" required>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<label for="ask"> Ask <b class="text-danger">*</b></label>
							<textarea class="form-control" id="ask" name="ask" required></textarea>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="assessmentCriteria"> Assessment Criteria </label>
							<textarea class="form-control" id="assessmentCriteria" name="assessmentCriteria"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="laws"> Laws (summary) </label>
							<textarea class="form-control" id="laws" name="laws"></textarea>
							<p class="no-padding no-margin text-danger">This text is used in reports. Leave the field empty to
								automatically generate a summary</p>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="lawsRulesStandard"> Laws, rules and standards </label>
							<textarea class="form-control" id="lawsRulesStandard" name="lawsRulesStandard"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<div class="checkbox">
								<label for="policyQuestion">
									<input type="checkbox" id="policyQuestion" name="policyQuestion" value="1">
									<strong>Policy question</strong><br>
									<small class="text-justify">
										Only check if your question concerns policy or organizational bottlenecks. In
										the
										IMA, the concrete workplace risks are weighted using the Kinney and Wiruth
										method. A
										ranking methodology is not applicable for policy and organizational bottlenecks.
									</small>
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<div class="checkbox">
								<label for="warningPossible">
									<input type="checkbox" id="warningPossible" name="warningPossible" value="1">
									<strong>Warning possible serious legal violation</strong><br>
									<small class="text-justify">
										Please tick when there may be a serious legal violation.
									</small>
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<div class="form-check">
								<label>Bottleneck answer <b class="text-danger">*</b></label><br>
								<input type="radio" class="form-check-input" name="bottleneckAnswer" value="and"
									   id="bottleneckAnswer" required>
								<label class="form-check-label" for="bottleneckAnswer">and</label>
							</div>
							<div class="form-check">
								<input type="radio" class="form-check-input" name="bottleneckAnswer" value="nee"
									   id="bottleneckAnswer1" required>
								<label class="form-check-label" for="bottleneckAnswer1">nee</label>
							</div>
							<small class="text-muted text-justify">
								Which answer is the question a sticking point? Indicate whether this is 'yes' or 'no'
							</small>
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
	$('#assessmentCriteria, #laws, #lawsRulesStandard').summernote({
		height: 150,
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
