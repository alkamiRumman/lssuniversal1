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
				<h3 class="box-title"><b>Production List</b></h3>
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
							<th>PRODUCTION ID</th>
							<th>PRODUCTION TITLE</th>
							<th>EVENT MONTH</th>
							<th>EVENT YEAR</th>
							<th>VENUE NAME</th>
							<th>ADDRESS</th>
							<th>CITY</th>
							<th>STATE</th>
							<th>VENUE CAPACITY</th>
							<th>TOTAL PRODUCTION COST</th>
							<th>TICKET FEES TOTAL</th>
							<th>OVERALL PRODUCTION COST</th>
							<th>BASE TICKET PRICE</th>
							<th>TICKET MARK-UP</th>
							<th>NEW TICKET PRICE</th>
							<th>PROJECT ROI</th>
							<th>STATUS</th>
							<th>CREATE AT</th>
							<th>LAST UPDATE</th>
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
						if (row['adminStatus'] == 1) {
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
					}, "targets": [9, 10, 11, 12, 13, 14, 15]
				},
				{
					"render": function (data, type, row) {
						console.log(data);
						if (data !== 'Rejected' && data !== 'Green Lit' && data !== 'Wrapped') {
							var html = '<select class="completedStatus" id="' + row.id + '" name="completedStatus" onchange="updateSelectColor(this)">' +
								'<option value="In-progress" ' + (data === "In-progress" ? "selected" : "") + ' data-color="#007BFF">In-progress</option>' +
								'<option value="Waiting for Review" ' + (data === "Waiting for Review" ? "selected" : "") + ' data-color="#FFA500">Waiting for Review</option>' +
								'<option disabled value="Rejected" ' + (data === "Rejected" ? "selected" : "") + ' data-color="#DC3545">Rejected</option>' +
								'<option disabled value="Green Lit" ' + (data === "Green Lit" ? "selected" : "") + ' data-color="#28A745">Green Lit</option>' +
								'<option disabled value="Wrapped" ' + (data === "Wrapped" ? "selected" : "") + ' data-color="#000000">Wrapped</option>' +
								'</select>';
						} else {
							var html = '<select disabled class="completedStatus" id="' + row.id + '" name="completedStatus" onchange="updateSelectColor(this)">' +
								'<option value="In-progress" ' + (data === "In-progress" ? "selected" : "") + ' data-color="#007BFF">In-progress</option>' +
								'<option value="Waiting for Review" ' + (data === "Waiting for Review" ? "selected" : "") + ' data-color="#FFA500">Waiting for Review</option>' +
								'<option value="Rejected" ' + (data === "Rejected" ? "selected" : "") + ' data-color="#DC3545">Rejected</option>' +
								'<option value="Green Lit" ' + (data === "Green Lit" ? "selected" : "") + ' data-color="#28A745">Green Lit</option>' +
								'<option value="Wrapped" ' + (data === "Wrapped" ? "selected" : "") + ' data-color="#000000">Wrapped</option>' +
								'</select>';
						}
						if (data === 'Rejected') {
							html += '<br><button class="styled-button" onclick="loadPopup(\'' + '<?= customer_url('viewProductRejectedReason/') ?>' + row.id + '\')">View Reason</button>';
						}
						return html;
					},
					"targets": 16
				},
				{
					"render": function (data, type, row) {
						if (data) {
							return moment(data).format('DD MMM YYYY hh:mm:ss A');
						} else {
							return data;
						}
					}, "targets": [18, 17], "sType": 'date'
				}
			],
			'aoColumns': [{mData: "id"}, {mData: "title"}, {mData: "eventMonth"}, {mData: "eventYear"}, {mData: "venueName"},
				{mData: "address"}, {mData: "city"}, {mData: "state"}, {mData: "totalVenueCapacity"}, {mData: "totalProductionCost"},
				{mData: "finalTotalTicketFee"}, {mData: "overallProductionCost"}, {mData: "baseTicketPrice"}, {mData: "ticketMarkup"}, {mData: "newTicketPrice"},
				{mData: "projectedROI"}, {mData: "completedStatus"}, {mData: "createAt"}, {mData: "updateAt"}, {
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
			'sAjaxSource': '<?= customer_url('getProduction') ?>',
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

			},
			dom: '<"top"B<"pull-right"f>>irtlp',
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
	$('#reportTable tbody').on('click', 'tr td:not(:last-child):not(:nth-child(17))', function () {
		var data = $('#reportTable').DataTable().row(this).data();
		loadPopup('<?= customer_url('viewProduction/')?>' + data.id);
	});

	$('#reportTable tbody').on('change', '.completedStatus', function () {
		var id = $(this).attr('id');
		var status = $(this).val();
		var $row = $(this).closest('tr');
		var table = $('#reportTable').DataTable();
		$.ajax({
			url: '<?= customer_url("updateStatus") ?>',
			type: 'POST',
			data: {
				id: id,
				completedStatus: status
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
	});
</script>
