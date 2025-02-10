<div class="modal fade in" id="modal-default" style="display: block; overflow: auto;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal" aria-label="Close">
					Close
				</button>
				<h4 class="modal-title"><b><?= $data->name ?> Details</b></h4>
			</div>
			<div class="modal-body">
				<!-- Business Information Table -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>Business Information</strong>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<tbody>
								<tr>
									<th>Name</th>
									<td><?= $data->name ?></td>
									<th>Phone</th>
									<td><?= $data->phone ?></td>
								</tr>
								<tr>
									<th>Vendor Business Name</th>
									<td><?= $data->businessName ?></td>
									<th>EIN</th>
									<td><?= $data->ein ?></td>
								</tr>
								<tr>
									<th>Business Address</th>
									<td><?= $data->businessAddress ?></td>
									<th>City</th>
									<td><?= $data->city ?></td>
								</tr>
								<tr>
									<th>State</th>
									<td><?= $data->state ?></td>
									<th>Zip Code</th>
									<td><?= $data->zip ?></td>
								</tr>
								<tr>
									<th>Business Line 1</th>
									<td><?= $data->businessLine1 ?></td>
									<th>Services 1</th>
									<td><?= $data->service1 ?></td>
								</tr>
								<tr>
									<th>Business Line 2</th>
									<td><?= $data->businessLine2 ?></td>
									<th>Services 2</th>
									<td><?= $data->service2 ?></td>
								</tr>
								<tr>
									<th>Business Line 3</th>
									<td><?= $data->businessLine3 ?></td>
									<th>Services 3</th>
									<td><?= $data->service3 ?></td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<!-- Banking Information Table -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>Banking Information</strong>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<tbody>
								<tr>
									<th>Bank Name</th>
									<td><?= $data->bankName ?></td>
									<th>Street Address</th>
									<td><?= $data->bankAddress ?></td>
								</tr>
								<tr>
									<th>City</th>
									<td><?= $data->bankCity ?></td>
									<th>State</th>
									<td><?= $data->bankState ?></td>
								</tr>
								<tr>
									<th>Zip</th>
									<td><?= $data->bankZip ?></td>
									<th>Account Name</th>
									<td><?= $data->accountName ?></td>
								</tr>
								<tr>
									<th>ABA Routing #</th>
									<td><?= $data->abaRouting ?></td>
									<th>Account Number</th>
									<td><?= $data->accountNumber ?></td>
								</tr>
								<tr>
									<th>Account Type</th>
									<td colspan="3">
										<label class="radio-inline">
											<input type="radio"
												   onclick="return false;" <?= $data->accountType == 'Checking' ? 'checked' : '' ?>>
											Checking
										</label>
										<label class="radio-inline">
											<input type="radio"
												   onclick="return false;" <?= $data->accountType == 'Savings' ? 'checked' : '' ?>>
											Savings
										</label>
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	table td {
		font-weight: normal;
	}

	.modal .panel-default {
		border-color: #ddd;
	}

	.modal .panel-heading {
		background-color: black;
		color: white;
		font-size: 16px;
		padding: 10px;
	}

	.modal .table th,
	.modal .table td {
		vertical-align: middle;
		text-align: left;
	}
</style>
