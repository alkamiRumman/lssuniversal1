<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Update User</b></h4>
			</div>
			<div class="modal-body">
				<form role="form" action="<?= admin_url('updateUser/' . $data->id) ?>" method="post">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="name"> Name<b class="text-danger">*</b> </label>
							<input class="form-control" type="text" name="name" id="name"
								   value="<?= $data->name ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label for="email"> Username</label>
							<input class="form-control" type="text" name="username" id="emailEdit"
								   value="<?= $data->username ?>">
							<p class="text-danger">Leave it blank if not change</p>
						</div>
					</div>
					<div class="custom-checkbox">
						<label class="checkbox-inline"><input type="checkbox" value="checkbox" id="checkbox">Change
							Password</label>
					</div>
					<div class="row">
						<div class="form-group col-md-6 password">
							<label for="passwordEdit"> Password </label>
							<input type="password" class="form-control" name="password" id="passwordEdit"
								   placeholder="Password">

						</div>
						<div class="form-group col-md-6 password">
							<label for="passwordEdit1"> Confirm Password </label>
							<input type="password" class="form-control" name="password1" id="passwordEdit1"
								   placeholder="Retype password">
						</div>
					</div>
					<div class="box-footer">
						<div class="row">
							<div class="form-group col-md-12">
								<button type="submit" id="submitEdit" class="btn btn-info pull-right">Update</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	var checkEmailEdit = 0;
	$('#emailEdit').on('keyup', function () {
		var email = $('#emailEdit').val();
		if (email != '') {
			$.ajax({
				url: "<?php echo admin_url('fetch_email'); ?>",
				method: "POST",
				data: {email: email},
				success: function (data) {
					if (data == 1) {
						checkEmailEdit = 1;
					} else {
						checkEmailEdit = 0;
					}
				}
			});
		} else {
			checkEmailEdit = 0;
		}
	});
	$('.password').hide();
	$("#checkbox").on('click', function () {
		if ($('[type="checkbox"]').is(":checked")) {
			$('.password').show();
			$('#passwordEdit').attr('required', true);
			$('#passwordEdit1').attr('required', true);
		} else {
			$('.password').hide();
			$('#passwordEdit').val('');
			$('#passwordEdit1').val('');
			$('#passwordEdit').attr('required', false);
			$('#passwordEdit1').attr('required', false);
		}
	});
	statusEdit = 0;
	$('#passwordEdit, #passwordEdit1').on('keyup', function () {
		var password = $('#passwordEdit1').val();
		if (password == $('#passwordEdit').val()) {
			statusEdit = 0;
		} else {
			statusEdit = 1;
		}
	});
	$('#submitEdit').on('click', function (e) {
		if (statusEdit == 1) {
			toastr.error('Password doesn\'t match!');
			e.preventDefault();
		}
		if (checkEmailEdit == 1) {
			toastr.error('Email already exist!');
			e.preventDefault();
		}
	});
</script>
