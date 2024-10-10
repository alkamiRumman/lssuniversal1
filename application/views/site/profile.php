<div class="modal fade in" id="modal-default" style="display: block;overflow: auto; padding-left: 25px;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Update Profile</b></h4>
			</div>
			<div class="modal-body">
				<form id="form" action="<?= login_url('updateProfile/' . $user->id) ?>" enctype="multipart/form-data"
					  method="post">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="name"> Name <b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="name" id="name"
								   value="<?= $user->name ?>" required>
						</div>
					</div>
					<div class="custom-checkbox form-group">
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
					<div class="row">
						<div class="col-md-12">
							<div class="card-body">
								<img width="250" class="img-responsive center-block" id="preview"
									 src="<?= $user->profilePicture != '' ? base_url('images/' . $user->id . '/' .
											 $user->profilePicture) : base_url('images/noImage.png') ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label>Profile Picture</label>
							<input type="file" name="profilePicture" id="profilePicture">
						</div>
					</div>
					<div class="box-footer">
						<div class="row">
							<div class="form-group col-md-12">
								<button type="submit" id="submit" class="btn btn-info pull-right">Update</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$('.password').hide();
	$("#checkbox").on('click', function () {
		if ($('[type="checkbox"]').is(":checked")) {
			$('.password').show();
			$('#passwordEdit').attr('required', true);
			$('#passwordEdit1').attr('required', true);
		} else {
			$('.password').hide();
			$('#passwordEdit').attr('required', false);
			$('#passwordEdit1').attr('required', false);
		}
	});

	$(document).ready(function () {
		$("#form").submit(function (submitEvent) {
			var filename = $("#profilePicture").val();
			var extension = filename.replace(/^.*\./, '');

			if (extension == filename) {
				extension = '';
			} else {
				extension = extension.toLowerCase();
			}
			switch (extension) {
				case 'gif':
				case 'jpg':
				case 'jpeg':
				case 'png':
				case '':
					break;

				default:
					toastr.warning('Image format does not match!');
					submitEvent.preventDefault();
			}

		});
	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#preview').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]); // convert to base64 string
		}
	}

	$("#profilePicture").change(function () {
		readURL(this);
	});

	var statusEdit = 0;
	$('#passwordEdit, #passwordEdit1').on('input', function () {
		var password = $('#passwordEdit').val();
		if (password == $('#passwordEdit1').val()) {
			statusEdit = 0;
		} else {
			statusEdit = 1;
		}
	});

	$('#submit').on('click', function (e) {
		if (statusEdit == 1) {
			toastr.warning('Password doesn\'t match!');
			e.preventDefault();
		}
	});

</script>
