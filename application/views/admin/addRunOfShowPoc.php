<div class="modal fade in" id="modal-default" style="display: block; overflow: auto;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Add Point Of Contact Details</b></h4>
			</div>
			<form id="formEdit" action="<?= admin_url('saveRunOfShowPoc/') . $id ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<label for="title" class="control-label">Primary POC</label>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-3">
											<label for="name"> Name <b class="text-danger text-bold">*</b></label>
											<input type="text" class="form-control input-sm" name="name" id="name"
												   required>
										</div>
										<div class="col-md-3">
											<label for="title">Title <b class="text-danger text-bold">*</b></label>
											<input class="form-control input-sm" type="text" name="title" id="title"
												   required>
										</div>
										<div class="col-md-3">
											<label for="phone">Phone <b class="text-danger text-bold">*</b></label>
											<input class="form-control input-sm" min="0" type="number" name="phone"
												   id="phone" required>
										</div>
										<div class="col-md-3">
											<label for="email">Email </label>
											<input class="form-control input-sm" type="email" name="email" id="email">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<label for="title" class="control-label">
									Assistant POC</label>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-3">
											<label for="assistantName"> Name </label>
											<input type="text" class="form-control input-sm"
												   name="assistantName" id="assistantName">
										</div>
										<div class="col-md-3">
											<label for="assistantTitle">Title </label>
											<input class="form-control input-sm" type="text" name="assistantTitle"
												   id="assistantTitle">
										</div>
										<div class="col-md-3">
											<label for="assistantPhone">Phone </label>
											<input class="form-control input-sm" min="0" type="number"
												   name="assistantPhone"
												   id="assistantPhone">
										</div>
										<div class="col-md-3">
											<label for="assistantEmail">Email </label>
											<input class="form-control input-sm" type="email" name="assistantEmail"
												   id="assistantEmail">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<label for="title" class="control-label">
									Back-Up POC</label>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-3">
											<label for="backUpName"> Name </label>
											<input type="text" class="form-control input-sm"
												   name="backUpName" id="backUpName">
										</div>
										<div class="col-md-3">
											<label for="backUpTitle">Title </label>
											<input class="form-control input-sm" type="text" name="backUpTitle"
												   id="backUpTitle">
										</div>
										<div class="col-md-3">
											<label for="backUpPhone">Phone </label>
											<input class="form-control input-sm" min="0" type="backUpPhone"
												   name="backUpPhone"
												   id="backUpPhone">
										</div>
										<div class="col-md-3">
											<label for="backUpEmail">Email </label>
											<input class="form-control input-sm" type="email" name="backUpEmail"
												   id="backUpEmail">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="form-group col-md-12">
							<button type="submit" id="submit" class="btn pull-right"
									style="background-color: black; color: white">Save
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<style>
	#remoteModal1 label {
		color: white;
	}

	.panel-default {
		background-color: #0E2231;
		color: white;
		border-color: #007bff;
		position: relative;
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
