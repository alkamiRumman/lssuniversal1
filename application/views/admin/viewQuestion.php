<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal" aria-label="Close">
					Close
				</button>
				<h4 class="modal-title"><b>Question Details</b></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group col-md-12">
						<label for="module"> Module <b class="text-danger">*</b></label>
						<pre class="form-control"><?= $data->title ?></pre>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
						<label for="questionNumber"> Question Number</label>
						<pre class="form-control"><?= $data->questionNumber ?></pre>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label for="ask"> Ask <b class="text-danger">*</b></label>
						<textarea class="form-control"><?= $data->ask ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
						<label for="assessmentCriteria"> Assessment Criteria </label>
						<textarea class="form-control"
								  id="assessmentCriteria"><?= $data->assessmentCriteria ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
						<label for="laws"> Laws (summary) </label>
						<textarea class="form-control" id="laws"><?= $data->laws ?></textarea>
						<p class="no-padding no-margin text-danger">This text is used in reports. Leave the field empty
							to
							automatically generate a summary</p>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
						<label for="lawsRulesStandard"> Laws, rules and standards </label>
						<textarea class="form-control"
								  id="lawsRulesStandard"><?= $data->lawsRulesStandard ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
						<div class="checkbox">
							<label for="policyQuestion" class="custom-checkbox">
								<input type="checkbox" id="policyQuestion"
									   name="policyQuestion" <?= $data->policyQuestion == 1 ? 'checked' : '' ?>
									   onclick="return false;" value="1">
								<span class="custom-check"></span>
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
								<input type="checkbox" id="warningPossible"
									   name="warningPossible" <?= $data->warningPossible == 1 ? 'checked' : '' ?>
									   onclick="return false;" value="1">
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
							<label class="custom-radio">
								<input type="radio" class="form-check-input" name="bottleneckAnswer" value="and"
									   id="bottleneckAnswer" <?= $data->bottleneckAnswer == 'and' ? 'checked' : '' ?>
									   onclick="return false;">
								<span class="custom-radio-check"></span>
								and
							</label>
						</div>
						<div class="form-check">
							<label class="custom-radio">
								<input type="radio" class="form-check-input" name="bottleneckAnswer" value="nee"
									   id="bottleneckAnswer1" <?= $data->bottleneckAnswer == 'nee' ? 'checked' : '' ?>
									   onclick="return false;">
								<span class="custom-radio-check"></span>
								nee
							</label>
						</div>
						<small class="text-muted text-justify">
							Which answer is the question a sticking point? Indicate whether this is 'yes' or 'no'
						</small>
					</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="form-group col-md-12">
							<button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal"
									aria-label="Close">Close
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(`#assessmentCriteria, #laws, #lawsRulesStandard`).summernote({
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
