<div class="modal fade in" id="modal-default" style="display: block; overflow: auto;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Update Vendor Invoice</b></h4>
			</div>
			<form id="formEdit" action="<?= vendor_url('updateVendorInvoice/') . $data->id ?>" method="post"
				  enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<img class="responsive-img img-fluid" style="max-height: 150px;"
								 src="<?= base_url('images/3.png') ?>" alt="User Image">
						</div>
					</div>
					<hr style="border: 1px solid black;">
					<div class="panel panel-body">
						<div class="row">
							<div class="col-md-6">
								<table class="table table-bordered table-sm">
									<tr>
										<th>Vendor Id</th>
										<td id="vendorIdText"><?= $data->vendorId ?></td>
									</tr>
									<tr>
										<th>POC Name</th>
										<td id="vendorName"><?= $data->name ?></td>
									</tr>
									<tr>
										<th>POC Phone</th>
										<td id="phone"><?= $data->phone ?></td>
									</tr>
									<tr>
										<th>POC Email</th>
										<td id="email"><?= $data->username ?></td>
									</tr>
									<tr>
										<th>EIN</th>
										<td id="ein"><?= $data->ein ?></td>
									</tr>
									<tr>
										<th>Business Address</th>
										<td id="businessAddress"><?= $data->businessAddress ?></td>
									</tr>
									<tr>
										<th>City</th>
										<td id="city"><?= $data->city ?></td>
									</tr>
									<tr>
										<th>State</th>
										<td id="state"><?= $data->state ?></td>
									</tr>
								</table>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="productionId">Select Production <b class="text-danger">*</b></label>
									<select id="productionId" name="productionId" class="form-control selectProduction"
											style="width: 100%;" required>
										<option selected value="<?= $data->productionId ?>"><?= $data->title ?></option>
									</select>
								</div>
								<table class="table table-bordered table-sm">
									<tr>
										<th>Event Month</th>
										<td id="eventMonth"><?= $data->eventMonth ?></td>
									</tr>
									<tr>
										<th>Event Year</th>
										<td id="eventYear"><?= $data->eventYear ?></td>
									</tr>
									<tr>
										<th>Venue</th>
										<td id="venue"><?= $data->venueName ?></td>
									</tr>
									<tr>
										<th>Date</th>
										<td id="Date"><?= date('d M Y', strtotime($data->submissionDate)) ?></td>
									</tr>
									<tr>
										<th>Net</th>
										<td id="Net">90</td>
									</tr>
									<tr>
										<th>Due Date</th>
										<td id="dueDate"><?= date('d M Y', strtotime($data->dueDate)) ?></td>
									</tr>
								</table>
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-md-12">
								<table class="table table-bordered table-striped" id="dynamicTable">
									<thead>
									<tr class="bg-info text-center">
										<th>No</th>
										<th>Description</th>
										<th>Qty</th>
										<th>Price</th>
										<th>Total</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<?php if ($details) {
										foreach ($details as $key => $detail) { ?>
											<tr>
												<td class="row-number"><?= ($key + 1) ?></td>
												<td><input type="text" name="description[]"
														   class="form-control description"
														   value="<?= $detail->description ?>" required></td>
												<td><input type="number" name="qty[]" value="<?= $detail->qty ?>"
														   class="form-control qty"
														   step="any" min="0" required></td>
												<td><input type="number" name="price[]" value="<?= $detail->price ?>"
														   class="form-control price"
														   step="any" min="0">
													<input type="hidden" class="totalPrice"
														   value="<?= $detail->total ?>" name="total[]"></td>
												<td class="total"><?= $detail->total ?></td>
												<td>
													<button type="button" class="btn btn-sm btn-danger remove-row"><i
																class="fa fa-trash"></i></button>
												</td>
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
										<td colspan="4" class="text-right font-weight-bold">Total Sum:</td>
										<td id="totalSum"><?= $data->invoiceAmount ?></td>
										<td></td>
									</tr>
									<tr>
										<td class="text-center" colspan="6">
											<button id="addRow" style="color: white; background-color: #0081CE"
													class="btn add-row">Add Row
											</button>
										</td>
									</tr>
									</tfoot>
								</table>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-md-12">
								<label for="vendorNotes">Vendor Notes</label>
								<input type="hidden" name="invoiceAmount" class="invoiceAmount" value="<?= $data->invoiceAmount ?>">
								<textarea class="form-control input-sm" name="vendorNotes"
										  id="vendorNotes" rows="2"><?= $data->vendorNotes ?></textarea>
							</div>
						</div>
						<hr style="border: 1px solid black;">
						<p style="font-weight: normal">Please upload the fully executed Master Service Agreement (MSA).
							Invoices default to Net 90 terms unless otherwise specified. If different terms are found
							during review, the due date will be adjusted within 7 business days. The listed POC will
							receive an automatic email once updates are processed or the invoice is paid.</p>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="msa"> Master Service Agreement</label>
								<input class="form-control" type="file" name="msa" id="msa" accept="application/pdf"
									   placeholder="Select File Here">
							</div>
							<div class="form-group col-md-6">
								<label for="w9Form"> W9 Form <span class="text-danger">*</span></label>
								<input class="form-control" type="file" name="w9Form" id="w9Form" accept="application/pdf"
									   placeholder="Select File Here">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label class="form-group col-md-12 checkbox-inline">
									<input id="verify" type="checkbox" value="1" required>Please verify all vendor
									information of file is correct, or update your account
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="submit" class="btn" style="color: white; background-color: #0081CE">Update
						Invoice
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

	.total-sum {
		text-align: right;
		font-weight: bold;
	}

	.add-row, .delete-row {
		cursor: pointer;
	}
</style>
<script>
	$(document).ready(function () {
		var rowNumber = $("#dynamicTable tbody tr").length + 1;

		// Function to calculate total for a row
		function calculateRowTotal(row) {
			const qty = parseFloat($(row).find('.qty').val()) || 0;
			const price = parseFloat($(row).find('.price').val()) || 0;
			const total = qty * price;
			$(row).find('.total').text(total.toFixed(2)); // Display total
			$(row).find('.totalPrice').val(total.toFixed(2)); // Display total
			calculateGrandTotal(); // Update grand total
		}

		// Function to calculate grand total
		function calculateGrandTotal() {
			let grandTotal = 0;
			$('#dynamicTable tbody tr').each(function () {
				const total = parseFloat($(this).find('.total').text()) || 0;
				grandTotal += total;
			});
			$('#totalSum').text(grandTotal.toFixed(2)); // Update total sum
			$('.invoiceAmount').val(grandTotal.toFixed(2)); // Update hidden input
		}

		// Function to add a new row to the table
		function addNewRow() {
			const newRow = `
        <tr>
            <td class="row-number">${rowNumber++}</td>
            <td><input type="text" name="description[]" class="form-control description" required></td>
            <td><input type="number" name="qty[]" class="form-control qty" step="any" min="0" required></td>
            <td><input type="number" name="price[]" class="form-control price" step="any" min="0">
				<input type="hidden" class="totalPrice" name="total[]"></td>
            <td class="total">0.00</td>
            <td><button type="button" class="btn btn-sm btn-danger remove-row"><i class="fa fa-trash"></i></button></td>
        </tr>`;
			$('#dynamicTable tbody').append(newRow);
			return $('#dynamicTable tbody tr:last'); // Return the last added row
		}

		// Handle "Enter" key press to add a new row and move focus
		$('#dynamicTable').on('keydown', 'input', function (e) {
			if (e.key === 'Enter') {
				e.preventDefault(); // Prevent form submission
				const newRow = addNewRow(); // Add a new row
				newRow.find('input.description').focus(); // Focus on the first input in the new row
			}
		});

		// Calculate row total when qty or price changes
		$('#dynamicTable').on('input', '.qty, .price', function () {
			const row = $(this).closest('tr');
			calculateRowTotal(row);
		});

		// Remove a row
		$('#dynamicTable').on('click', '.remove-row', function () {
			$(this).closest('tr').remove();
			calculateGrandTotal();
			updateRowNumbers();
		});

		// Update row numbers after deletion
		function updateRowNumbers() {
			$('#dynamicTable tbody tr').each(function (index) {
				$(this).find('.row-number').text(index + 1); // Update the row number
			});
		}

		// Add a new row when the "Add Row" button is clicked
		$('#addRow').click(function (e) {
			e.preventDefault(); // Prevent form submission
			const newRow = addNewRow(); // Add a new row
			newRow.find('input.description').focus(); // Focus on the first input in the new row
		});
	});

	$('#date, #net').on('change', function () {
		var date = $('#date').val();
		var net = $('#net').find(":selected").val();

		if (date && net) {
			var newDate = new Date(date);
			newDate.setDate(newDate.getDate() + parseInt(net));
			var dueDate = moment(newDate).format('DD MMM YYYY');
			console.log(dueDate);
			$('#dueDate').val(dueDate);
		}
	});

	$('#date').datepicker({
		autoclose: true,
		todayHighlight: true,
		startDate: '+0d',
		format: 'dd M yyyy'
	});

	$(function () {
		$(".selectProduction").select2({
			placeholder: "Select Production",
			dropdownParent: $('#remoteModal1'),
			ajax: {
				url: '<?= vendor_url("getProductionSearch") ?>',
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
			var data = event.params.data;
			console.log(data.id);
			$('#eventMonth').text(data.eventMonth);
			$('#eventYear').text(data.eventYear);
			$('#venue').text(data.venueName);
		});
	});
</script>
