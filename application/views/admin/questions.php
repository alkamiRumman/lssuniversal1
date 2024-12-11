<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Questions</b></h3>
			</div>
			<div class="box-body">
				<div class="row">
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
							?>
							<label><?= $serial_number . '. ' . $category ?></label><br>
							<?php foreach ($modules[$category] as $item) {
								$questionCount = !empty($questionsByModule[$item->id]) ? count($questionsByModule[$item->id]) : '-'; ?>
								<div class="panel-group" id="accordion<?= $item->id ?>">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion<?= $item->id ?>"
												   href="#collapseOne<?= $item->id ?>">
													<?= $item->title ?>
													<span class="pull-right"><?= $questionCount ?></span>
												</a>
											</h4>
										</div>
										<div id="collapseOne<?= $item->id ?>" class="panel-collapse collapse">
											<div class="panel-body">
												<?php if (!empty($questionsByModule[$item->id])) { ?>
													<ul>
														<?php foreach ($questionsByModule[$item->id] as $question) { ?>
															<li class="link"
																onclick="loadPopup('<?= base_url('admin/viewQuestion/') . $question->id ?>')">
																<b><?= $question->questionNumber . '</b><br>' . $question->ask ?>
																	- <a href="javascript:void(0);"
																		 onclick="event.stopPropagation(); loadPopup('<?= base_url('admin/editQuestion/') . $question->id ?>')"
																		 class="btn-sm"><i class="fa fa-edit"></i></a>
																	- <a href="javascript:void(0);"
																		 onclick="event.stopPropagation(); deleteModule('<?= base_url('admin/deleteQuestion/') . $question->id ?>')"
																		 class="btn-sm"><i
																				class="fa fa-trash text-danger"></i></a>
															</li>
														<?php } ?>
													</ul>
												<?php } else { ?>
													<p>No questions available.</p>
												<?php } ?>
												<a href="javascript:void(0);"
												   onclick="loadPopup('<?= admin_url('addQuestions/') . $item->id ?>')"
												   class="btn btn-sm btn-info">Add New Question</a>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
							<?php
							$serial_number++;
						}
					}
					echo '</div>'; // Close the last column
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

	.panel-title a {
		display: block;
		padding: 10px 15px; /* Adjusts the clickable area */
		margin: 0;
		text-decoration: none;
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

	li.link:hover {
		color: blue;
		text-decoration: underline;
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
	});
</script>
