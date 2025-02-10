<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">
					<b class="title"><?= $data->title ?></b>
					<span class="description"><?= $data->description ?></span>
				</h3>
				<div class="form-group pull-right">
					<a class="btn btn-default active">Overview</a>
					<a class="btn btn-default" href="<?= admin_url('projectKpi/' . $data->id) ?>">Team
						KPI</a>
					<a class="btn btn-default"
					   href="<?= admin_url('projectRoadmap/' . $data->id) ?>">Roadmap</a>
					<?php if ($data->archivesStatus == 0) { ?>
						<a class="btn" style="color: white; background-color: black"
						   href="<?= admin_url('project') ?>">Back</a>
					<?php } else { ?>
						<a class="btn" style="color: white; background-color: black"
						   href="<?= admin_url('archivesProject') ?>">Back</a>
					<?php } ?>
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
							<div class="panel-heading"><strong>Production Details</strong></div>
							<div class="panel-body" style="padding-bottom: 0">
								<table class="table">
									<tr>
										<th>Production Start Date</th>
										<td style="font-weight: normal"><?= date('d M Y', strtotime($data->startDate)) . ' ' . date('h:i:s A', strtotime($data->startTime)) ?></td>
										<th>Production End Date</th>
										<td style="font-weight: normal"><?= date('d M Y', strtotime($data->endDate)) . ' ' . date('h:i:s A', strtotime($data->endTime)) ?></td>
										<th>Production Venue</th>
										<td style="font-weight: normal"><?= $data->venueName ?></td>
										<th>Venue Address</th>
										<td style="font-weight: normal"><?= $data->address . ', ' . $data->city . ', ' . $data->state . ' - ' . $data->zip ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
							<div class="panel-heading"><strong>Executive Summary Overview</strong></div>
							<div class="panel-body" style="padding-bottom: 0">
								<form id="form" action="<?= admin_url('updateProjectOverview/') . $data->id ?>"
									  method="post">
									<div class="row">
										<div class="col-md-12">
											<label for="synopsis"> Synopsis <i class="fa fa-info-circle text-danger"
																			   title="A compelling narrative that will capture the audience using 2-3 sentence"></i></label>
											<textarea class="form-control" id="synopsis"
													  name="synopsis"><?= $projectOverview->synopsis ?></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<label for="about"> About <i class="fa fa-info-circle text-danger"
																		 title="What is the project?&#10;Who is the targeted audience?&#10;Is there important background to info?"></i></label>
											<textarea class="form-control" id="about"
													  name="about"><?= $projectOverview->about ?></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<label for="intentions"> Intentions <i class="fa fa-info-circle text-danger"
																				   title="Why are we considering this project?&#10;What purpose does it serve?&#10;What is the overall goal to be accomplished?"></i></label>
											<textarea class="form-control" id="intentions"
													  name="intentions"><?= $projectOverview->intentions ?></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<label for="problemStatement"> The Problem Statement <i
													class="fa fa-info-circle text-danger"
													title="What is the gap we are looking to fill in the market?&#10;What challenges exist?"></i></label>
											<textarea class="form-control" id="problemStatement"
													  name="problemStatement"><?= $projectOverview->problemStatement ?></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<label for="proposedSolution"> Proposed Solution <i
													class="fa fa-info-circle text-danger"
													title="How are we solving the problem?"></i></label>
											<textarea class="form-control" id="proposedSolution"
													  name="proposedSolution"><?= $projectOverview->proposedSolution ?></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<label for="risks"> Risks <i class="fa fa-info-circle text-danger"
																		 title="What challenges could we run into?&#10;(e.g. budget, marketing, ads, resources, etc)"></i></label>
											<textarea class="form-control" id="risks"
													  name="risks"><?= $projectOverview->risks ?></textarea>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-12 text-center">
											<button type="submit" id="submit"
													style="background-color: black; color: white"
													class="btn">Save
											</button>
											<a href="javascript:void(0);"
											   onclick="loadPopup('<?= admin_url('viewProjectOverview/') . $data->id ?>')"
											   class="btn" style="color: white; background-color: black">View</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.panel .panel-heading {
		color: white;
		background-color: black;
	}

	.box-title .title {
		font-weight: bold;
		font-size: 1.2em;
	}

	.box-title .description {
		display: block;
		font-weight: normal;
		font-size: 0.9em;
		color: #555;
		margin-top: 7px; /* Add spacing if needed */
	}
</style>
<script>
	$('#synopsis, #about, #intentions, #problemStatement, #proposedSolution, #risks').summernote({
		height: 'auto',
		toolbar: [
			['style', ['style']],
			['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
			['fontname', ['fontname']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ol', 'ul', 'paragraph', 'height']],
			['table', ['table']],
			['insert', ['link']],
			['view', ['undo', 'redo', 'fullscreen']]
		],
		callbacks: {
			onInit: function () {
				// Remove default bold style
				$('.note-editable').css('font-weight', 'normal');
			}
		}
	});
</script>
