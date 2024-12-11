<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Questions Selection</b></h3>
			</div>
			<div class="box-body">
				<div class="row" style="margin-top: 10px">
					<?php
					$id_array = ['General', 'Working at specific locations', 'Physical factors', 'Physical strain', 'Work equipment', 'Hazardous substances', 'Accidents / Fire safety', 'Other'];
					$serial_number = 1;
					$column_count = 1;
					$items_per_column = ceil(count($id_array) / $column_count);
					foreach ($id_array as $index => $category) {
						if ($index % $items_per_column == 0) {
							if ($index != 0) {
								echo '</div>';
							}
							echo '<div class="col-md-12">';
						}

						if (isset($modules[$category])) {
							// Check if the module has questions
							$hasQuestions = false;
							foreach ($modules[$category] as $item) {
								if (!empty($questionsByModule[$item->id])) {
									$hasQuestions = true;
									break;
								}
							}
							?>
							<?php if ($hasQuestions) { ?>
								<label><?= $serial_number . '. ' . $category ?></label><br>
								<?php foreach ($modules[$category] as $item) { ?>
									<?php if (!empty($questionsByModule[$item->id])) {
										$questionCount = !empty($questionsByModule[$item->id]) ? count($questionsByModule[$item->id]) : '-'; ?>
										<div class="panel-group" id="accordion<?= $item->id ?>">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														<input type="checkbox" class="accordion-checkbox pull-left"
															   data-target="#accordion<?= $item->id ?>">
														<a data-toggle="collapse"
														   data-parent="#accordion<?= $item->id ?>"
														   href="#collapseOne<?= $item->id ?>">
															&nbsp;&nbsp;<?= $item->title ?>
															<span class="pull-right"><?= $questionCount ?></span>
														</a>
													</h4>
												</div>
												<div id="collapseOne<?= $item->id ?>" class="panel-collapse collapse">
													<div class="panel-body">
														<ul>
															<?php foreach ($questionsByModule[$item->id] as $question) { ?>
																<li class="link">
																	<input type="checkbox" class="item-checkbox"
																		   id="checkbox<?= $question->id ?>"
																		   data-question-id="<?= $question->id ?>"
																		   data-parent="#accordion<?= $item->id ?>">
																	&nbsp;&nbsp;<?= $question->questionNumber . ' ' . $question->ask ?>
																</li>
															<?php } ?>
														</ul>
													</div>
												</div>
											</div>
										</div>
									<?php } ?>
								<?php } ?>
							<?php } else { ?>
								<label><?= $serial_number . '. ' . $category ?></label><br>
								<p>No questions available.</p>
							<?php } ?>
							<?php
							$serial_number++;
						}
					}
					echo '</div>';
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.panel-group {
		margin-bottom: 5px;
	}

	.panel {
		margin: 0;
		border-radius: 0; /* Ensures no rounding on panel edges */
		border: none; /* Removes borders between panels */
		box-shadow: none; /* Removes any shadow effects */
	}

	.panel-heading {
		padding: 0;
		margin: 0;
	}

	.panel-title {
		display: flex;
		align-items: center;
		padding: 10px 15px; /* Adjusts the clickable area */
		margin: 0;
		text-decoration: none;
	}

	.panel-title a {
		flex-grow: 1; /* Makes the link take up remaining space */
	}

	.panel-collapse {
		margin: 0;
		padding: 0;
	}

	.panel-body {
		padding: 10px 15px;
		margin: 0;
	}

	.caret {
		transition: transform 0.3s ease-in-out;
	}

	.caret-right {
		border-left: 4px solid;
		border-bottom: 4px solid transparent;
		border-top: 4px solid transparent;
	}

	.caret-down {
		transform: rotate(90deg);
	}

	ul {
		list-style-type: none;
	}

	li:hover {
		cursor: default;
	}
</style>

<script>
	function deleteModule(url) {
		if (confirm('Are you sure you want to delete this question?')) {
			window.location.href = url;
		}
	}

	$(document).ready(function () {
		$(".selectCustomer").select2({
			placeholder: "Select Customer",
			ajax: {
				url: '<?= admin_url("getCustomerSearch") ?>',
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
					console.log(response);
					return {
						results: response
					};
				}
			}
		}).on('select2:select', function (event) {
			var customerId = $(this).val();
			$("#selectedCustomerId").val(customerId);

			if (customerId) {
				$.ajax({
					url: '<?= admin_url("getSavedQuestions") ?>',
					type: 'POST',
					data: {customerId: customerId},
					success: function (response) {
						var savedQuestions = JSON.parse(response);
						$('.item-checkbox, .accordion-checkbox').prop('checked', false).prop('indeterminate', false);

						$.each(savedQuestions, function (index, questionId) {
							$('#checkbox' + questionId).prop('checked', true).trigger('change');
						});
					}
				});
			}
		});
		$('.panel-group').on('shown.bs.collapse', function (e) {
			$(e.target).prev('.panel-heading').find('.caret').addClass('caret-down');
			var active = $(e.target).attr('id');
			$.cookie('activeAccordionGroup', active);
		});

		$('.panel-group').on('hidden.bs.collapse', function (e) {
			$(e.target).prev('.panel-heading').find('.caret').removeClass('caret-down');
			if ($('.panel-group .in').length === 0) {
				$.removeCookie('activeAccordionGroup');
			}
		});

		var last = $.cookie('activeAccordionGroup');
		if (last != null) {
			$("#accordion .panel-collapse").removeClass('in');
			$("#" + last).addClass("in").prev('.panel-heading').find('.caret').addClass('caret-down');
		}

		$('.item-checkbox').on('click', function () {
			var customerId = $("#selectedCustomerId").val();
			if (!customerId) {
				toastr.warning("Please select a customer first.");
				$(this).prop('checked', !$(this).prop('checked')); // Revert the checkbox state
				return;
			}

			var isChecked = $(this).is(':checked');
			var questionId = $(this).data('question-id');

			$.ajax({
				url: '<?= base_url("admin/saveQuestionSelection") ?>',
				type: 'POST',
				data: {
					customerId: customerId,
					questionId: questionId,
					isChecked: isChecked
				},
				success: function (response) {
					toastr.success('Selection saved successfully.');
				},
				error: function (xhr, status, error) {
					toastr.warning('Failed to save the selection.');
					$(this).prop('checked', !$(this).prop('checked')); // Revert the checkbox state
				}
			});
		});

		$('.accordion-checkbox').on('click', function () {
			var customerId = $("#selectedCustomerId").val();
			if (!customerId) {
				toastr.warning("Please select a customer first.");
				$(this).prop('checked', !$(this).prop('checked')); // Revert the checkbox state
				return;
			}

			var isChecked = $(this).is(':checked');
			var target = $(this).data('target');
			var questionIds = [];

			$(target).find('.item-checkbox').each(function () {
				$(this).prop('checked', isChecked);
				questionIds.push($(this).data('question-id'));
			});

			$.ajax({
				url: '<?= admin_url("saveMultipleQuestionSelection") ?>',
				type: 'POST',
				data: {
					customerId: customerId,
					questionIds: questionIds,
					isChecked: isChecked
				},
				success: function (response) {
					toastr.success('Selection saved successfully.');
				},
				error: function (xhr, status, error) {
					toastr.warning('Failed to save the selection.');
					$(this).prop('checked', !$(this).prop('checked')); // Revert the checkbox state
				}
			});
		});

		// Additional logic for the accordion-checkbox and item-checkbox interaction
		$('.accordion-checkbox').on('change', function () {
			var target = $(this).data('target');
			var isChecked = $(this).is(':checked');
			$(target).find('.item-checkbox').prop('checked', isChecked).trigger('change');
		});

		$('.item-checkbox').on('change', function () {
			var parentAccordion = $(this).closest('.panel-group');
			var allItems = parentAccordion.find('.item-checkbox');
			var allChecked = allItems.length === allItems.filter(':checked').length;
			var noneChecked = allItems.filter(':checked').length === 0;
			parentAccordion.find('.accordion-checkbox').prop('checked', allChecked).prop('indeterminate', !allChecked && !noneChecked);
		});
	});
</script>
