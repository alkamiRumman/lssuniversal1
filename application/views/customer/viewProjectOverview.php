<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-primary btn-sm pull-right printButton" id="Print">Print</button>
				<button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal" aria-label="Close">
					Close
				</button>
				<h4 class="modal-title"><b><?= $data->title ?> Project Overview</b></h4>
			</div>
			<div class="modal-body" id="printThis">
				<div class="row">
					<div class="col-xs-12 col-md-12 text-center">
						<img class="responsive-img img-fluid" style="max-height: 150px;"
							 src="<?= base_url('images/3.png') ?>" alt="User Image">
					</div>
				</div>
				<hr style="border: 1px solid black;">
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<div class="panel">
							<div class="panel-heading"><strong><?= $data->title ?> Details</strong></div>
							<div class="panel-body" style="padding-bottom: 0">
								<table class="table" style="padding: 0; margin: 0;">
									<tr>
										<th>Start Date</th>
										<td style="font-weight: normal"><?= date('d M Y', strtotime($data->startDate)) ?></td>
										<th>End Date</th>
										<td style="font-weight: normal"><?= date('d M Y', strtotime($data->endDate)) ?></td>
										<th>Production Venue</th>
										<td style="font-weight: normal"><?= $data->venueName ?></td>
									</tr>
									<tr>
										<th>Start Time</th>
										<td style="font-weight: normal"><?= date('h:i:s A', strtotime($data->startTime)) ?></td>
										<th>End Time</th>
										<td style="font-weight: normal"><?= date('h:i:s A', strtotime($data->endTime)) ?></td>
										<th>Venue Address</th>
										<td style="font-weight: normal"><?= $data->address . ', ' . $data->city . ', ' . $data->state . ' - ' . $data->zip ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<label for="synopsisEdit"> Synopsis </label>
						<textarea class="form-control" id="synopsisEdit"
								  name="synopsis"><?= $projectOverview->synopsis ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<label for="aboutEdit"> About </label>
						<textarea class="form-control" id="aboutEdit"
								  name="about"><?= $projectOverview->about ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<label for="intentionsEdit"> Intentions </label>
						<textarea class="form-control" id="intentionsEdit"
								  name="intentions"><?= $projectOverview->intentions ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<label for="problemStatementEdit"> The Problem Statement </label>
						<textarea class="form-control" id="problemStatementEdit"
								  name="problemStatement"><?= $projectOverview->problemStatement ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<label for="proposedSolutionEdit"> Proposed Solution </label>
						<textarea class="form-control" id="proposedSolutionEdit"
								  name="proposedSolution"><?= $projectOverview->proposedSolution ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<label for="risksEdit"> Risks </label>
						<textarea class="form-control" id="risksEdit"
								  name="risks"><?= $projectOverview->risks ?></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	td {
		font-weight: normal;
	}

	@media screen {
		#printSection {
			display: none;
		}
	}

	@media print {
		.responsive-img {
			height: 200px !important; /* Fixed height for print */
			width: auto !important; /* Maintain aspect ratio */
			max-width: 100% !important; /* Ensure it fits within the print area */
			object-fit: contain !important; /* Ensure the entire image is visible */
			display: block !important; /* Ensure proper layout */
			margin: 0 auto !important; /* Center image horizontally */
		}

		body * {
			visibility: hidden;
		}

		@page {
			size: A4;
			margin: 1cm;
		}

		#printSection, #printSection * {
			visibility: visible;
		}

		.panel {
			page-break-inside: avoid; /* Avoid breaking the panel across pages */
			margin: 0;
		}

		.table {
			page-break-inside: auto; /* Ensure tables break nicely if they exceed one page */
		}

		.table th, .table td {
			font-size: 12px; /* Smaller font for compact display */
		}

		.page-break {
			page-break-before: always;
			content: "";
			display: block;
			height: 0;
		}

		.modal-body {
			width: 21cm;
			min-height: 29.7cm;
			padding: 0.5cm;
			margin: 0;
			background: white;
		}

		#printSection {
			position: absolute;
			left: 0;
			top: 0;
		}
	}
</style>
<script>
	$('#synopsisEdit, #aboutEdit, #intentionsEdit, #problemStatementEdit, #proposedSolutionEdit, #risksEdit').summernote({
		toolbar: false,
		height: 'auto',
		focus: false,
		disableResizeEditor: true,
		callbacks: {
			onInit: function () {
				$(this).next('.note-editor').find('.note-editable').attr('contenteditable', false); // Make it read-only
			}
		}
	});
	document.getElementById("Print").onclick = function () {
		printElement(document.getElementById("printThis"));
	};

	function printElement(elem) {
		var domClone = elem.cloneNode(true);

		var $printSection = document.getElementById("printSection");

		if (!$printSection) {
			var $printSection = document.createElement("div");
			$printSection.id = "printSection";
			document.body.appendChild($printSection);
		}

		$printSection.innerHTML = "";
		$printSection.appendChild(domClone);
		window.print();
	}
</script>
