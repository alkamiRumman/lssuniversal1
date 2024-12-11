<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Inventory</b></h3>
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
				url: '<?= customer_url("getQuestionsByModule") ?>',
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
							tableData += '<td style="background-color: #DDF2F4;"><h3>' + item.questionNumber + '</h3><p>' + item.ask + '</p>' +
								'<a href="javascript:void(0);" onclick="loadPopup(\'' + '<?= customer_url('viewAssessmentCriteria/') ?>' + item.questionId + '\')" class="btn-link">Assessment criteria</a>&emsp;&emsp;&emsp;' +
								'<a href="javascript:void(0);" onclick="loadPopup(\'' + '<?= customer_url('viewLawsRulesStandard/') ?>' + item.questionId + '\')" class="btn-link">Laws, rules and standards</a></td>';
							tableData += '<td style="vertical-align: top;">';
							tableData += '<div>';
							tableData += '<label><input ' + (item.inventory === "Yes" ? "checked" : "") + ' type="radio" name="answer_' + item.id + '" value="Yes"> Yes</label><br>';
							tableData += '<label><input ' + (item.inventory === "No" ? "checked" : "") + ' type="radio" name="answer_' + item.id + '" value="No"> No</label><br>';
							tableData += '<label><input ' + (item.inventory === "Not applicable" ? "checked" : "") + ' type="radio" name="answer_' + item.id + '" value="Not applicable"> Not applicable</label><br>';
							tableData += '</div>';

							const hasExplanation = item.explanation.length > 0 || item.inventoryAttachment.length > 0;

							tableData += '<a href="javascript:void(0);" onclick="loadPopup(\'' + '<?= customer_url('addExplanation/') ?>' + item.id + '\')" class="btn-link ' + (hasExplanation ? 'text-danger' : '') + '">';
							tableData += hasExplanation ? 'Change explanation' : 'Add explanation';
							tableData += '</a>';

							tableData += '</td>';
							tableData += '</tr>';

							if (i < savedQuestions.length - 1) {
								tableData += '<tr><td colspan="2" style="height: 10px;"></td></tr>';
							}
						});
					} else {
						tableData = '<tr><td style="background-color: #DDF2F4;" class="text-center text-danger text-bold" colspan="2">No Question Assigned!!</td></tr>';
					}
					$('#records_table tbody').append(tableData);

					$('input[type="radio"]').on('change', function () {
						var selectionId = $(this).attr('name').split('_')[1];
						var selectedAnswer = $(this).val();

						$.ajax({
							url: '<?= customer_url("saveInventoryAnswer") ?>',
							type: 'POST',
							data: {
								selectionId: selectionId,
								answer: selectedAnswer
							},
							success: function (response) {
								toastr.success('Answer saved successfully!');
							},
							error: function () {
								toastr.error('Failed to save the answer. Please try again.');
							}
						});
					});
				}
			});
		}
	}
</script>
