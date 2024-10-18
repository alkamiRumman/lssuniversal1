<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-body" style="background: black">
				<div class="row">
					<div class="col-md-12 text-center">
						<img class="responsive-img" src="<?= base_url('images/3.png') ?>" alt="User Image">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Add New Team Member</b></h3>
			</div>
			<div class="box-body">
				<form role="form" action="<?= admin_url('saveCustomer') ?>" method="post" autocomplete="off">
					<div class="row">
						<div class="form-group col-md-3">
							<label for="name"> Name <b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="name" id="name"
								   placeholder="Enter Member Name" required>
						</div>
						<div class="form-group col-md-3">
							<label for="username"> Username <b class="text-danger">*</b></label>
							<input class="form-control" type="email" name="username" id="username"
								   placeholder="Enter Email Address" required>
						</div>
						<div class="form-group col-md-2">
							<label for="phone"> Phone <b class="text-danger">*</b></label>
							<input class="form-control" type="number" name="phone" id="phone"
								   placeholder="Enter Phone Number" required>
							<input type="hidden" name="type" value="Customer">
						</div>
						<div class="form-group col-md-2">
							<label for="password"> Password <b class="text-danger">*</b></label>
							<input type="password" class="form-control" name="password" id="password"
								   placeholder="Password" required>
						</div>
						<div class="form-group col-md-2">
							<label for="password1"> Confirm Password </label>
							<input type="password" class="form-control" name="password1" id="password1"
								   placeholder="Retype password">
						</div>
					</div>

					<div class="box-footer">
						<div class="row">
							<div class="form-group col-md-12">
								<button type="submit" id="submit" class="btn btn-success pull-right">Save</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Team Member List</b></h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered"
						   style="width: 99% !important;" id="item-list">
						<thead>
						<tr>
							<th>Name</th>
							<th>Username</th>
							<th>Phone</th>
							<th>Access</th>
							<th>Join At</th>
							<th>Last Update</th>
							<th style="padding-right: 30px">Actions</th>
						</tr>
						</thead>
						<tbody style="font-weight: normal">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	var checkEmail = 0;
	$('#username').on('keyup', function () {
		var email = $('#username').val();
		if (email != '') {
			$.ajax({
				url: "<?php echo admin_url('fetch_email'); ?>",
				method: "POST",
				data: {email: email},
				success: function (data) {
					if (data == 1) {
						checkEmail = 1;
					} else {
						checkEmail = 0;
					}
				}
			});
		}
	});

	var status = 0;
	$('#password, #password1').on('keyup', function () {
		var password = $('#password').val();
		if (password == $('#password1').val()) {
			status = 0;
		} else {
			status = 1;
		}
	});

	$('#submit').on('click', function (e) {
		if (status == 1) {
			toastr.error('Password doesn\'t match!');
			e.preventDefault();
		}
		if (checkEmail == 1) {
			toastr.error('Email already exist!');
			e.preventDefault();
		}
	});
	var Table, selectedIDs = [];
	window.onload = function () {
		geTableData();
	};

	function geTableData() {
		Table = $('#item-list').DataTable({
			serverSide: true,
			order: [[0, "ASC"]],
			// destroy: true,
			stateSave: true,
			"columnDefs": [
				{
					"render": function (data, type, row) {
						console.log(data);
						var html = '<select class="adminAccess" id="' + row.id + '" name="type">' +
							'<option value="Admin" ' + (data === 'Admin' ? "selected" : "") + '>Admin Access</option>' +
							'<option value="Customer" ' + (data === 'Customer' ? "selected" : "") + '>Limited Access</option>' +
							'</select>';
						return html;
					},
					"targets": 3
				},
				{
					"render": function (data, type, row) {
						if (data) {
							return moment(data).format('DD MMM YYYY hh:mm:ss A');
						} else {
							return '--'
						}
					}, "targets": [5, 4]
				}
			],
			'aoColumns': [{mData: "name"}, {mData: "username"}, {mData: "phone"}, {mData: "type"}, {mData: "createAt"}, {mData: "updateAt"}, {
				mData: "actions",
				bSortable: false
			}],
			"aLengthMenu": [[25, 50, 100, 200, 500, 1000], [25, 50, 100, 200, 500, 1000]],
			"iDisplayLength": 25,
			'bProcessing': true,
			"language": {
				processing: '<div><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading Please Wait...</span></div>'
			},
			'bServerSide': true,
			'sAjaxSource': '<?= admin_url('getCustomers') ?>',
			'fnServerData': function (sSource, aoData, fnCallback) {
				$.ajax({
					'dataType': 'json',
					'type': 'POST',
					'url': sSource,
					'data': aoData,
					'success': function (d, e, f) {
						console.log(d);
						fnCallback(d, e, f);
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.log(jqXHR);
						if (jqXHR.jqXHRstatusText)
							alert(jqXHR.jqXHRstatusText);
					}
				});
			},
			"fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
				// console.log(nRow);
			},
			dom: '<"top"B<"pull-right"fi>>rtlp',
			// dom: 'lfrtip',
		});
	}

	$('#item-list tbody').on('change', '.adminAccess', function () {
		var id = $(this).attr('id');
		var val = $(this).val();
		$.ajax({
			url: '<?= admin_url("updateAdminAccess") ?>',
			type: 'POST',
			data: {
				id: id,
				value: val
			},
			success: function (response) {
				var data = JSON.parse(response);
				if (data.status == 'success') {
					toastr.success('Status Update Successfully!');
					$('#item-list').DataTable().ajax.reload(null, false);
				} else {
					toastr.error('Failed to save. Please try again.');
				}
			},
			error: function () {
				toastr.error('Failed to save. Please try again.');
			}
		});
	});
</script>


