<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Invoice List</b></h3>
				<span class="badge badge-info"
					  style="font-size: 18px;margin-left: 10px; background-color: #000000;"><?= $totalAdminStatus ?></span>

			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table id="reportTable"
						   class="table table-striped table-bordered"
						   style="width: 99% !important;">
						<thead>
						<tr>
							<th>ID</th>
							<th>INVOICE #</th>
							<th>Production Title</th>
							<th>SUBMISSION DATE</th>
							<th>DUE DATE</th>
							<th>NET</th>
							<th>INVOICE AMOUNT</th>
							<th>MSA</th>
							<th>STATUS</th>
							<th>Last Update</th>
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

	.completedStatus {
		width: 110px;
		padding: 7px;
		font-size: 14px;
		border: 1px solid #ced4da;
		border-radius: 5px;
		appearance: none;
		color: #fff;
		text-align: center;
		background-position: calc(100% - 10px) center;
		background-repeat: no-repeat;
	}

	.styled-button {
		display: inline-block;
		align-items: center;
		margin-top: 5px; /* Space between the select and button */
		padding: 6px 12px; /* Add some padding */
		font-size: 14px; /* Font size */
		color: #007BFF; /* Text color */
		background-color: transparent; /* Transparent background */
		border: 1px solid transparent; /* Transparent border */
		border-radius: 4px; /* Rounded corners */
		cursor: pointer; /* Pointer cursor */
		text-decoration: none; /* Remove underline */
		transition: color 0.3s ease, background-color 0.3s ease; /* Smooth transition */
	}

	/* Hover effect for the button */
	.styled-button:hover {
		color: #ffffff; /* Change text color */
		background-color: #007BFF; /* Background color on hover */
		border-color: #007BFF; /* Border color on hover */
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
						if (row['adminCustomerStatus'] == 1) {
							return data + '<span class="badge badge-info" style="font-size: 12px;margin-left: 10px; background-color: #000000;">1</span>';
						} else {
							return data;
						}
					}, "targets": 0
				},
				{
					"render": function (data, type, row) {
						if (data > 0) {
							return '$ ' + data;
						} else {
							return data;
						}
					}, "targets": 6
				},
				{
					"render": function (data, type, row) {
						if (data) {
							return '<span class="btn-link">' + data + '</span>';
						} else {
							return data;
						}
					},
					"targets": 7
				},
				{
					"render": function (data, type, row) {
						if (data == 'Unpaid') {
							return '<div class="completedStatus" style="background-color: #FFA500">Unpaid</div>';
						} else if (data == 'Paid') {
							return '<div class="completedStatus" style="background-color: #000000">Paid</div>';
						} else {
							return '<div class="completedStatus" style="background-color: #DC3545">Rejected</div>' +
								'<button class="styled-button" onclick="loadPopup(\'' + '<?= vendor_url('viewRejectedReason/') ?>' + row.id + '\')">View Reason</button>';
						}
					},
					"targets": 8
				},
				{
					"render": function (data, type, row) {
						var viewButton = '<li><a href="javascript:void(0);" onclick="loadPopup(\'<?= vendor_url("viewVendorInvoice/") ?>' + row.id + '\')">View</a></li>';
						var editButton = '<li><a href="javascript:void(0);" onclick="loadPopup(\'<?= vendor_url("editVendorInvoice/") ?>' + row.id + '\')">Edit</a></li>';
						if (row['status'] == 'Paid') {
							return '<div class="dropdown">' +
								'<button class="btn btn-sm dropdown-toggle" style="color: white; background-color: black" type="button" data-toggle="dropdown">Actions' +
								' <span class="caret"></span></button>' +
								'<ul class="dropdown-menu">' +
								viewButton +
								'</ul>' +
								'</div>';
						} else {
							return '<div class="dropdown">' +
								'<button class="btn btn-sm dropdown-toggle" style="color: white; background-color: black" type="button" data-toggle="dropdown">Actions' +
								' <span class="caret"></span></button>' +
								'<ul class="dropdown-menu">' +
								viewButton +
								editButton +
								'</ul>' +
								'</div>';
						}
					},
					"targets": 10
				},
				{
					"render": function (data, type, row) {
						if (data) {
							return moment(data).format('DD MMM YYYY');
						} else {
							return data;
						}
					}, "targets": [3, 4], "sType": 'date'
				},
				{
					"render": function (data, type, row) {
						if (data) {
							return moment(data).format('DD MMM YYYY hh:mm:ss A');
						} else {
							return '--';
						}
					}, "targets": 9, "sType": 'date'
				}
			],
			'aoColumns': [{mData: "id"}, {mData: "invoiceNumber"}, {mData: "title"},
				{mData: "submissionDate"}, {mData: "dueDate"}, {mData: "net"}, {mData: "invoiceAmount"},
				{mData: "msa"}, {mData: "status"}, {mData: "updateAt"}, {
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
			'sAjaxSource': '<?= vendor_url('getVendorInvoice') ?>',
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
			},
			dom: '<"top"B<"pull-right"fi>>rtlp',
			buttons: [
				{
					extend: 'print',
					text: 'Print',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 7, 9, 10, 11, 12, 13, 14, 15],
						modifier: {
							page: 'current'
						}
					}
				}, {
					extend: 'colvis',
					text: 'Column Visibility',
					collectionLayout: 'three-column'
				}
			]
		});
	}
	$('#reportTable tbody').on('click', 'tr td', function () {
		var data = $('#reportTable').DataTable().row(this).data();
		var columnIndex = $(this).index();

		switch (columnIndex) {
			case 7:
				loadPopup('<?= vendor_url('viewVendorInvoiceMSA/') ?>' + data.id);
				break;
			case 8:
			case 10:
				break;
			default:
				loadPopup('<?= vendor_url('viewVendorInvoice/') ?>' + data.id);
				break;
		}
	});
</script>
