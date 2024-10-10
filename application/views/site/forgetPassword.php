<div class="modal fade in" id="modal-default" style="display: block;overflow: auto; padding-left: 25px;">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-xs btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Forget Password</b></h4>
			</div>
			<div class="modal-body">
				<form action="<?= login_url('verifyEmail') ?>" method="post">
					<div class="form-group has-feedback">
						<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address">
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="row">
						<div class="col-xs-4 pull-right">
							<button type="submit" style="background-color: black; color: white" class="btn btn-block btn-flat">Send</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
