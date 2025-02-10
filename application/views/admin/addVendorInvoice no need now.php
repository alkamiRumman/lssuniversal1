<div class="modal fade in" id="modal-default" style="display: block; overflow: auto;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Add New Vendor Invoice</b></h4>
			</div>
			<form id="formEdit" action="<?= admin_url('saveVendorInvoice') ?>" method="post"
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
								<div class="form-group">
									<label for="vendorId">Select Vendor <b class="text-danger">*</b></label>
									<select id="vendorId" name="vendorId" class="form-control selectVendor"
											style="width: 100%;" required></select>
								</div>
								<table class="table table-bordered table-sm">
									<tr>
										<th>Vendor Id</th>
										<td id="vendorIdText"></td>
									</tr>
									<tr>
										<th>POC Name</th>
										<td id="vendorName"></td>
									</tr>
									<tr>
										<th>POC Phone</th>
										<td id="phone"></td>
									</tr>
									<tr>
										<th>POC Email</th>
										<td id="email"></td>
									</tr>
									<tr>
										<th>EIN</th>
										<td id="ein"></td>
									</tr>
									<tr>
										<th>Business Address</th>
										<td id="businessAddress"></td>
									</tr>
									<tr>
										<th>City</th>
										<td id="city"></td>
									</tr>
									<tr>
										<th>State</th>
										<td id="state"></td>
									</tr>
									<tr>
										<th>Zip Code</th>
										<td id="zip"></td>
									</tr>
								</table>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="productionId">Select Production <b class="text-danger">*</b></label>
									<select id="productionId" name="productionId" class="form-control selectProduction"
											style="width: 100%;" required></select>
								</div>
								<table class="table table-bordered table-sm">
									<tr>
										<th>Event Month</th>
										<td id="startDate"></td>
									</tr>
									<tr>
										<th>Event Year</th>
										<td id="eventYear"></td>
									</tr>
									<tr>
										<th>Venue</th>
										<td id="venue"></td>
									</tr>
								</table>
								<div class="row">
									<div class="form-group col-md-6">
										<label for="date">Net <b class="text-danger">*</b></label>
										<select class="form-control" name="net" id="net">
											<option value="30">30</option>
											<option value="60">60</option>
											<option selected value="90">90</option>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label for="date">Date <b class="text-danger">*</b></label>
										<div class="input-group date">
											<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
											<input type="text" class="form-control" name="date" id="date"
												   value="<?= date('d M Y') ?>" required>
										</div>
									</div>
									<div class="form-group col-md-6">
										<label for="dueDate">Due Date <b class="text-danger">*</b></label>
										<div class="input-group date">
											<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
											<input type="text" class="form-control" name="dueDate" id="dueDate"
												   value="<?= date('d M Y', strtotime('+90 days')) ?>" required>
										</div>
									</div>
								</div>
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
									<tbody></tbody>
									<tfoot>
									<tr>
										<td colspan="4" class="text-right font-weight-bold">Total Sum:</td>
										<td id="totalSum">0</td>
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
								<input type="hidden" name="invoiceAmount" class="invoiceAmount">
								<textarea class="form-control input-sm" name="vendorNotes"
										  id="vendorNotes" rows="2"></textarea>
							</div>
						</div>
						<hr style="border: 1px solid black;">
						<p style="font-weight: normal">Please upload the fully executed Master Service Agreement (MSA).
							Invoices default to Net 90 terms unless otherwise specified. If different terms are found
							during review, the due date will be adjusted within 7 business days. The listed POC will
							receive an automatic email once updates are processed or the invoice is paid.</p>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="msa"> Master Service Agreement <b class="text-danger">*</b></label>
								<input class="form-control" type="file" name="msa" id="msa" accept="application/pdf"
									   placeholder="Select File Here">
							</div>
							<div class="form-group col-md-6">
								<label for="w9Form"> w9Form <b class="text-danger">*</b></label>
								<input class="form-control" type="file" name="w9Form" id="w9Form"
									   accept="application/pdf"
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
						<!--						<div class="row">-->
						<!--							<div class="form-group col-md-4">-->
						<!--								<label for="pocName"> Point of Contact </label>-->
						<!--								<input class="form-control" type="text" name="pocName" id="pocName"-->
						<!--									   placeholder="Enter Full Name">-->
						<!--							</div>-->
						<!--							<div class="form-group col-md-4">-->
						<!--								<label for="pocPhone"> Phone Number </label>-->
						<!--								<input class="form-control" type="text" name="pocPhone" id="pocPhone"-->
						<!--									   placeholder="Enter Phone Number">-->
						<!--							</div>-->
						<!--							<div class="form-group col-md-4">-->
						<!--								<label for="pocEmail"> Email </label>-->
						<!--								<input class="form-control" type="email" name="pocEmail" id="pocEmail"-->
						<!--									   placeholder="Enter Email Address">-->
						<!--							</div>-->
						<!--						</div>-->
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="submit" class="btn" style="color: white; background-color: #0081CE">Submit
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
		let rowNumber = 1; // Start row number from 1

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
			rowNumber = 1; // Reset row number
			$('#dynamicTable tbody tr').each(function () {
				$(this).find('.row-number').text(rowNumber++);
			});
		}

		// Automatically add one row when the page is loaded
		const initialRow = addNewRow();
		initialRow.find('input.description').focus(); // Set focus to the first input of the first row

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
		$(".selectVendor").select2({
			placeholder: "Select Vendor",
			dropdownParent: $('#remoteModal1'),
			ajax: {
				url: '<?= admin_url("getVendorSearch") ?>',
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
			$('#vendorIdText').text(data.id);
			$('#vendorName').text(data.name);
			$('#phone').text(data.phone);
			$('#email').text(data.username);
			$('#ein').text(data.ein);
			$('#businessAddress').text(data.businessAddress);
			$('#city').text(data.city);
			$('#state').text(data.state);
			$('#zip').text(data.zip);
		});
		$(".selectProduction").select2({
			placeholder: "Select Production",
			dropdownParent: $('#remoteModal1'),
			ajax: {
				url: '<?= admin_url("getProductionSearch") ?>',
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
			$('#startDate').text(data.startDate);
			$('#eventYear').text(data.eventYear);
			$('#venue').text(data.venueName);
		});
	});
</script>
