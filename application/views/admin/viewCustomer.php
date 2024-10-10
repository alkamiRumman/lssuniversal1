<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-lg" style="width: 90%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal" aria-label="Close">
					Close
				</button>
				<h4 class="modal-title"><b><?= $data->name ?> Details</b></h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-default">
					<label for="title" class="control-label">
						Business Information </label>
					<div class="panel-body">
						<div class="row">
							<div class="form-group col-md-2">
								<label> Name </label>
								<input class="form-control" value="<?= $data->name ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label> Phone </label>
								<input class="form-control" value="<?= $data->phone ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label> Vendor Business Name </label>
								<input class="form-control" value="<?= $data->businessName ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label> EIN </label>
								<input class="form-control" value="<?= $data->ein ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label> Business Address </label>
								<input class="form-control" value="<?= $data->businessAddress ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label> City </label>
								<input class="form-control" value="<?= $data->city ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label> State </label>
								<input class="form-control" value="<?= $data->state ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label> Zip Code </label>
								<input class="form-control" value="<?= $data->zip ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label>Business Line 1 </label>
								<input class="form-control" value="<?= $data->businessLine1 ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label for="service1">Services 1 </label>
								<input class="form-control" value="<?= $data->service1 ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label>Business Line 2</label>
								<input class="form-control" value="<?= $data->businessLine2 ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label for="service1">Services 2 </label>
								<input class="form-control" value="<?= $data->service2 ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label>Business Line 3 </label>
								<input class="form-control" value="<?= $data->businessLine3 ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label for="service1">Services 3 </label>
								<input class="form-control" value="<?= $data->service3 ?>" readonly>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<label for="title" class="control-label">
						Banking Information </label>
					<div class="panel-body">
						<div class="row">
							<div class="form-group col-md-2">
								<label> Bank Name </label>
								<input class="form-control" value="<?= $data->bankName ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label> Street Address </label>
								<input class="form-control" value="<?= $data->bankAddress ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label> City </label>
								<input class="form-control" value="<?= $data->bankCity ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label> State </label>
								<input class="form-control" value="<?= $data->bankState ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label> Zip </label>
								<input class="form-control" value="<?= $data->bankZip ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label> Account Name </label>
								<input class="form-control" value="<?= $data->accountName ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label> ABA Routing # </label>
								<input class="form-control" value="<?= $data->abaRouting ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label> Account Number </label>
								<input class="form-control" value="<?= $data->accountNumber ?>" readonly>
							</div>
							<div class="form-group col-md-2">
								<label>Account Type </label><br>
								<label class="radio-inline">
									<input type="radio" onclick="return false;"
											<?= $data->accountType == 'Checking' ? 'checked' : '' ?>> Checking
								</label>
								<label class="radio-inline">
									<input type="radio" onclick="return false;"
											<?= $data->accountType == 'Savings' ? 'checked' : '' ?>> Savings
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.panel-default {
		background-color: #0E2231;
		color: white;
		border-color: #007bff;
		position: relative;
	}

	.modal label {
		color: white;
	}

	.control-label {
		position: absolute;
		top: -10px;
		left: 15px;
		background-color: #f8f9fa;
		padding: 0 5px;
		color: #007bff !important;
		font-size: 14px;
	}
</style>
