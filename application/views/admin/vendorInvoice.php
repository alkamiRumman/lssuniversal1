<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Invoice List</b></h3>
				<span class="badge badge-info"
					  style="font-size: 18px;margin-left: 10px; background-color: #000000;"><?= $totalVendorStatus ?></span>
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
							<th>Vendor Name</th>
							<th>POC PHONE</th>
							<th>POC EMAIL</th>
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
		width: 130px;
		padding: 6px;
		font-size: 14px;
		border: 1px solid #ced4da;
		border-radius: 5px;
		appearance: none;
		background-color: #fff;
		color: #fff;
		text-align: center;
		background-position: calc(100% - 10px) center;
		background-repeat: no-repeat;
	}

	.completedStatus:focus {
		color: black !important;
		background-color: #fff !important;
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
	function updateSelectColor(selectElement) {
		var selectedOption = selectElement.options[selectElement.selectedIndex];
		var color = selectedOption.getAttribute('data-color');
		selectElement.style.backgroundColor = color || '#fff';
	}

	document.addEventListener('DOMContentLoaded', function () {
		document.querySelectorAll('.completedStatus').forEach(function (select) {
			updateSelectColor(select);

			select.addEventListener('focus', function () {
				select.style.backgroundColor = '#fff';
			});

			select.addEventListener('blur', function () {
				updateSelectColor(select);
			});

			select.addEventListener('change', function () {
				updateSelectColor(select);
			});
		});
	});
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
						if (row['vendorStatus'] == 1) {
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
					}, "targets": 9
				},
				{
					"render": function (data, type, row) {
						// Construct the select dropdown HTML with basic styling
						var html = '<select class="completedStatus styled-select" id="' + row.id + '" name="status" onchange="updateSelectColor(this)">' +
							'<option value="Unpaid" ' + (data === "Unpaid" ? "selected" : "") + ' data-color="#FFA500">Unpaid</option>' +
							'<option value="Paid" ' + (data === "Paid" ? "selected" : "") + ' data-color="#000000">Paid</option>' +
							'<option value="Rejected" ' + (data === "Rejected" ? "selected" : "") + ' data-color="#DC3545">Rejected</option>' +
							'</select>';

						// Add the button with styling
						if (data === 'Rejected') {
							html += '<br><button class="styled-button" onclick="loadPopup(\'' + '<?= admin_url('viewRejectedReason/') ?>' + row.id + '\')">View Reason</button>';
						}

						return html;
					},
					"targets": 11
				},
				{
					"render": function (data, type, row) {
						if (data) {
							return moment(data).format('DD MMM YYYY');
						} else {
							return data;
						}
					}, "targets": [6, 7], "sType": 'date'
				},
				{
					"render": function (data, type, row) {
						if (data) {
							return moment(data).format('DD MMM YYYY hh:mm:ss A');
						} else {
							return '--';
						}
					}, "targets": 12, "sType": 'date'
				}
			],
			'aoColumns': [{mData: "id"}, {mData: "invoiceNumber"}, {mData: "title"}, {mData: "name"}, {mData: "phone"}, {mData: "username"},
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
			'sAjaxSource': '<?= admin_url('getVendorInvoice') ?>',
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
			"drawCallback": function () {
				document.querySelectorAll('.completedStatus').forEach(function (select) {
					updateSelectColor(select);
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
					extend: 'copy',
					exportOptions: {
						columns: ':visible(:not(.not-export-col))'
					}
				}, {
					extend: 'excel',
					exportOptions: {
						columns: ':visible(:not(.not-export-col))'
					}
				}, {
					extend: 'csv',
					exportOptions: {
						columns: ':visible(:not(.not-export-col))'
					}
				}, {
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
			case 10:
				loadPopup('<?= admin_url('viewVendorInvoiceMSA/') ?>' + data.id);
				break;
			case 11:
				break;
			case 13:
				break;
			default:
				loadPopup('<?= admin_url('viewVendorInvoice/') ?>' + data.id);
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
