<div class="modal fade in" id="modal-default" style="display: block; overflow: auto;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-sm btn-primary pull-right printButton" id="Print">Print</button>
				<button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal" aria-label="Close">
					Close
				</button>
				<?php if ($data->vendorStatus == 1) { ?>
					<a href="<?= admin_url('vendorInvoiceMarkRead/') . $data->id ?>"
					   onclick="return confirm('Are you sure?')"
					   class="btn btn-sm pull-right btn-warning">Mark as read</a>
				<?php } ?>
				<h4 class="modal-title"><b> Vendor Invoice Details</b></h4>
			</div>
			<form id="formEdit" action="<?= admin_url('saveVendorInvoice') ?>" method="post"
				  enctype="multipart/form-data">
				<div class="modal-body" id="printThis">
					<div class="row">
						<div class="col-xs-12 text-center">
							<img class="responsive-img img-fluid" style="max-height: 150px;"
								 src="<?= base_url('images/3.png') ?>" alt="User Image">
						</div>
					</div>
					<hr style="border: 1px solid black;">
					<div class="panel panel-body">
						<div class="row">
							<div class="col-xs-6">
								<table class="table no-border table-sm">
									<tr>
										<th>Vendor Id</th>
										<td><?= $data->vendorId ?></td>
									</tr>
									<tr>
										<th>POC Name</th>
										<td><?= $data->name ?></td>
									</tr>
									<tr>
										<th>POC Phone</th>
										<td><?= $data->phone ?></td>
									</tr>
									<tr>
										<th>POC Email</th>
										<td><?= $data->username ?></td>
									</tr>
									<tr>
										<th>EIN</th>
										<td><?= $data->ein ?></td>
									</tr>
									<tr>
										<th>Business Address</th>
										<td><?= $data->businessAddress . ', ' . $data->city . ', ' . $data->state ?></td>
									</tr>
								</table>
							</div>
							<div class="col-xs-6">
								<table class="table no-border table-sm">
									<tr>
										<th>Production Title</th>
										<td><?= $data->title ?></td>
									</tr>
									<tr>
										<th>Production Start Date</th>
										<td><?= date('d M Y', strtotime($data->startDate)) . ' ' . date('h:i:s A', strtotime($data->startTime)) ?></td>
									</tr>
									<tr>
										<th>Production End Date</th>
										<td><?= date('d M Y', strtotime($data->endDate)) . ' ' . date('h:i:s A', strtotime($data->endTime)) ?></td>
									</tr>
									<tr>
										<th>Venue</th>
										<td><?= $data->venueName ?></td>
									</tr>
									<tr>
										<th>Date</th>
										<td><?= date('d F Y', strtotime($data->submissionDate)) ?></td>
									</tr>
									<tr>
										<th>Net</th>
										<td><?= $data->net ?></td>
									</tr>
									<tr>
										<th>Due Date</th>
										<td><?= date('d F Y', strtotime($data->dueDate)) ?></td>
									</tr>
								</table>
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-xs-12">
								<div class="table-container" style="position: relative;">
									<table class="table table-bordered table-striped" id="dynamicTable">
										<thead>
										<tr class="bg-info text-center">
											<th>No</th>
											<th>Description</th>
											<th>Qty</th>
											<th>Price</th>
											<th>Total</th>
										</tr>
										</thead>
										<tbody>
										<?php if ($details) {
											foreach ($details as $key => $detail) { ?>
												<tr>
													<td><?= ($key + 1) ?></td>
													<td><?= $detail->description ?></td>
													<td><?= $detail->qty ?></td>
													<td><?= $detail->price ?></td>
													<td><?= $detail->total ?></td>
												</tr>
											<?php }
										} else { ?>
											<tr>
												<td colspan="6" class="text-center text-bold text-danger">No record
													found!!
												</td>
											</tr>
										<?php } ?>
										</tbody>
										<tfoot>
										<tr>
											<th colspan="4" class="text-right font-weight-bold">Total Sum:</th>
											<th id="totalSum"><?= $data->invoiceAmount ?></th>
										</tr>
										</tfoot>
									</table>
									<?php if ($data->status == 'Paid') { ?>
										<div class="rubber">
											PAID
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-xs-12">
								<label for="vendorNotes">Vendor Notes</label>
								<p><?= $data->vendorNotes ?></p>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">
						Close
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<style>
	td {
		font-weight: normal;
	}

	.table-container {
		position: relative;
	}

	.rubber {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%) rotate(-15deg);
		box-shadow: 0 0 0 3px #800020, 0 0 0 2px #800020 inset;
		border: 2px solid transparent;
		border-radius: 5px;
		display: inline-block;
		padding: 10px 2px;
		line-height: 25px;
		color: #800020;
		font-size: 34px; /* Increased font size for watermark */
		font-family: 'Black Ops One', cursive;
		text-transform: uppercase;
		text-align: center;
		opacity: 0.2;
		width: 180px;
		z-index: 0; /* Ensure it stays behind the table */
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

		.rubber {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%) rotate(-15deg);
			box-shadow: 0 0 0 3px #800020, 0 0 0 2px #800020 inset !important;
			border: 2px solid transparent;
			border-radius: 5px;
			display: inline-block;
			padding: 10px 2px;
			line-height: 25px;
			color: #800020 !important;
			font-size: 34px; /* Increased font size for watermark */
			font-family: 'Black Ops One', cursive;
			text-transform: uppercase;
			text-align: center;
			opacity: 0.2;
			width: 180px;
			z-index: 0; /* Ensure it stays behind the table */
		}

		.logo {
			margin-top: 0;
		}

		body * {
			visibility: hidden;
		}

		#dynamicTable thead tr {
			background-color: #D9EDF7 !important;
			color: #000 !important;
			-webkit-print-color-adjust: exact;
			print-color-adjust: exact;
		}

		#dynamicTable thead th {
			background-color: #D9EDF7 !important;
			color: #000 !important;
		}

		@page {
			size: A4;
			margin: 2cm;
		}

		.table {
			padding: 0;
			margin: 0;
			page-break-inside: auto; /* Ensure tables break nicely if they exceed one page */
		}

		.table th, .table td {
			font-size: 12px; /* Smaller font for compact display */
		}

		#printSection, #printSection * {
			visibility: visible;
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
			padding: 1cm;
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
