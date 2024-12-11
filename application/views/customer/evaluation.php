<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Evaluation</b></h3>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped" id="records_table">
								<thead>
								<tr>
									<th colspan="2" style="background-color: #2EBDCC">
										<label for="moduleId">Select Module &emsp;</label>
										<select style="width: 80%" id="moduleId" name="moduleId"
												class="form-control selectModule"></select>
										<input type="hidden" id="selectedModuleId" name="selectedModuleId">
									</th>
								</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.text-danger {
		color: red;
	}
</style>
<script>
	$(document).ready(function () {
		$(".selectModule").select2({
			placeholder: "Select Module",
			ajax: {
				url: '<?= customer_url("getModuleSearch") ?>',
				dataType: 'json',
				type: "POST",
				quietMillis: 50,
				allowClear: true,
				data: function (params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				}
			}
		});

		var storedModuleId = localStorage.getItem('selectedModuleId');
		if (storedModuleId) {
			$.ajax({
				url: '<?= customer_url("getModuleById") ?>',
				type: 'POST',
				data: {moduleId: storedModuleId},
				success: function (response) {
					var moduleData = JSON.parse(response);
					var moduleName = moduleData.title;

					$("#selectedModuleId").val(storedModuleId);
					var newOption = new Option(moduleName, storedModuleId, false, true);
					$(".selectModule").append(newOption).trigger('change.select2');
					loadRecords(storedModuleId);
				}
			});
		}

		$(".selectModule").on('select2:select', function (event) {
			var moduleId = $(this).val();
			$("#selectedModuleId").val(moduleId);
			localStorage.setItem('selectedModuleId', moduleId);
			loadRecords(moduleId);
		});
	});

	function loadRecords(moduleId) {
		if (moduleId) {
			$.ajax({
				url: '<?= customer_url("getQuestionsByModuleEvaluation") ?>',
				type: 'POST',
				data: {moduleId: moduleId},
				success: function (response) {
					var savedQuestions = JSON.parse(response);
					console.log(savedQuestions.length);
					$('#records_table tbody').empty();
					if (savedQuestions.length > 0) {
						var tableData = '';
						$.each(savedQuestions, function (i, item) {
							tableData += '<tr>';
							tableData += '<td><h3>' + item.questionNumber + '</h3><p>' + item.ask + '&emsp;<b>Answer: </b>' + item.inventory + '</p>' +
								'<a href="javascript:void(0);" onclick="loadPopup(\'' + '<?= customer_url('viewAssessmentCriteria/') ?>' + item.questionId + '\')" class="btn-link">Assessment criteria</a>&emsp;&emsp;&emsp;' +
								'<a href="javascript:void(0);" onclick="loadPopup(\'' + '<?= customer_url('viewLawsRulesStandard/') ?>' + item.questionId + '\')" class="btn-link">Laws, rules and standards</a></td>';
							tableData += '</tr>';

							// New row for additional inputs
							tableData += '<tr>';
							tableData += '<td>';
							tableData += '<table class="table table-bordered" cellspacing="5">';
							tableData += '<tr style="background-color: #DDF2F4;"><th>Judgement</th><th>Risk</th><th>Priority and Bottleneck</th><th>Basic Risk Factor</th></tr>';
							tableData += '<tr>';
							tableData += '<td><div class="row"><div class="col-md-4">Number of employees</div><div class="col-md-4"><input type="text" class="form-control"></div><div class="col-md-4">employees</div></div>' +
								'<label for="effects">Ranking van het Effect</label><select name="effects" id="effects" class="form-control">' +
								'<option value="1">Gering, letsel zonder verzuim</option><option value="3">Belangrijk, letsel met verzuim</option><option value="7">Ernstig, (invaliditeit)</option><option value="15">Zeer ernstig, één dode</option>' +
								'<option value="40">Ramp, enkele doden</option><option value="100">Catastrofe, vele doden</option></select></td>';
							tableData += '<td>middle</td>';
							tableData += '<td><label for="policyMatters">Policy matters</label><select class="form-control" name="policyMatters" id="policyMatter"><option value="No">No</option>' +
								'<option value="Policy is missing">Policy is missing</option><option value="Policy is limited in availability">Policy is limited in availability</option>' +
								'<option value="Policy is in place but not yet fylly implemented; imporvements are possible">Policy is in place but not yet fylly implemented; imporvements are possible</option></td>';
							tableData += '<td><label for="riskFactor">Basic Risk Factor</label><select name="riskFactor" id="riskFactor" class="form-control">' +
								'<option value="No">No</option><option value="Design">Design</option><option value="Material and Resources">Material and Resources</option><option value="Maintenance">Maintenance</option><option value="Environmental factors">Environmental factors</option>' +
								'<option value="Organization/Procedural">Organization/Procedural</option><option value="Organization/Cultural">Organization/Cultural</option>' +
								'<option value="Training and education">Training and education</option><option value="Purchasing and selection">Purchasing and selection</option>' +
								'<option value="Communication">Communication</option><option value="Order and Tidomess">Order and Tidomess</option>' +
								'<option value="Employee behavior">Employee behavior</option></select></td>';
							tableData += '</tr>';
							tableData += '</table>';
							tableData += '</td>';
							tableData += '</tr>';

							// Add a spacing row if not the last item
							if (i < savedQuestions.length - 1) {
								tableData += '<tr><td colspan="2" style="height: 10px;"></td></tr>';
							}
						});
					} else {
						tableData = '<tr><td style="background-color: #DDF2F4;" class="text-center text-danger text-bold" colspan="2">No Question Assigned!!</td></tr>';
					}
					$('#records_table tbody').append(tableData);

				}
			});
		}
	}
</script>
