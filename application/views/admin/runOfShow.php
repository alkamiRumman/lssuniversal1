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
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Run of Show</b></h3>
				<a href="javascript:void(0);"
				   onclick="loadPopup('<?= admin_url('addRunShow') ?>')"
				   class="btn btn-sm pull-right" style="color: white; background-color: black">Create New</a>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table id="reportTable"
						   class="table table-striped table-bordered"
						   style="width: 99% !important;">
						<thead>
						<tr>
							<th>Name</th>
							<th>Description</th>
							<th>Start Date&Time</th>
							<th>Last Modified Date&Time</th>
							<th>ACTIONS</th>
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
<style>
	#reportTable tr:hover {
		cursor: default;
	}
</style>
<script>
	var Table = [];
	window.onload = function () {
		Table = $('#reportTable').DataTable({
			serverSide: true,
			order: [[0, "ASC"]],
			// destroy: true,
			stateSave: true,
			"columnDefs": [
				{
					"render": function (data, type, row) {
						// Parse date and time explicitly
						var formattedDate = moment(data).format('DD MMM YYYY');
						var formattedTime = moment(row['time'], 'HH:mm').format('hh:mm A'); // Ensure correct time format

						return formattedDate + ' ' + formattedTime;
					},
					"targets": 2,
					"sType": 'date'
				},
				{
					"render": function (data, type, row) {
						if (data) {
							return moment(data).format('DD MMM YYYY hh:mm:ss A');
						} else {
							return '--';
						}
					}, "targets": 3, "sType": 'date'
				}
			],
			'aoColumns': [{mData: "title"}, {mData: "description"}, {mData: "date"}, {mData: "updateAt"}, {
				mData: "actions",
				bSortable: false
			}],
			"aLengthMenu": [[25, 50, 100, 200, 500, 1000], [25, 50, 100, 200, 500, 1000]],
			"iDisplayLength": 25,
			'bProcessing': true,
			"language": {
				processing: '<div><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading Please Wait...</span></div>',
				emptyTable: "<h3>You don't have anything!</h3>"
			},
			'bServerSide': true,
			'sAjaxSource': '<?= admin_url('getRunOfShow') ?>',
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
			"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				console.log(aData);
			},
			dom: '<"top"B<"pull-right"fi>>rtlp',
			buttons: [
				{
					text: 'Run of Show',
					className: 'active',
					action: function (e, dt, node, config) {
						alert('This will be Run page!');
					}
				},
				{
					text: 'Templates',
					action: function (e, dt, node, config) {
						alert('This will be templates page!');
					}
				},
				{
					text: 'Archives',
					action: function (e, dt, node, config) {
						alert('This will be archives page!');
					}
				},
				{
					text: 'Files',
					action: function (e, dt, node, config) {
						alert('This will be files page!');
					}
				}
			]
		});
	}
	$('#reportTable tbody').on('click', 'tr td', function () {
		var data = $('#reportTable').DataTable().row(this).data();
		var columnIndex = $(this).index();
		switch (columnIndex) {
			case 4:
				break;
			default:
				alert('view run of show');
				break;
		}
	});


	$('#reportTable tbody').on('change', '.completedStatus', function () {
		var id = $(this).attr('id');
		var status = $(this).val();
		$.ajax({
			url: '<?= admin_url("updateVendorInvoiceStatus") ?>',
			type: 'POST',
			data: {
				id: id,
				status: status
			},
			success: function (response) {
				var data = JSON.parse(response);
				if (data.status == 'success') {
					toastr.success('Status Update Successfully!');
					$('#reportTable').DataTable().ajax.reload(null, false);
				} else {
					toastr.error('Failed to save. Please try again.');
				}
			},
			error: function () {
				toastr.error('Failed to save. Please try again.');
			}
		});
		if (status == 'Rejected') {
			loadPopup('<?= admin_url('viewRejectedReason/') ?>' + id);
		}
	});
</script>
