<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Run of Show</b></h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table id="reportTable"
						   class="table table-striped table-bordered"
						   style="width: 99% !important;">
						<thead>
						<tr>
							<th>ID</th>
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
					"targets": 3,
					"sType": 'date'
				},
				{
					"render": function (data, type, row) {
						if (data) {
							return moment(data).format('DD MMM YYYY hh:mm:ss A');
						} else {
							return '--';
						}
					}, "targets": 4, "sType": 'date'
				}
			],
			'aoColumns': [{mData: "id"}, {mData: "title"}, {mData: "description"}, {mData: "date"}, {mData: "updateAt"}, {
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
			'sAjaxSource': '<?= admin_url('getArchives') ?>',
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
					action: function (e, dt, node, config) {
						window.location = "<?= base_url('admin/runOfShow') ?>";
					}
				},
				{
					text: 'Archives',
					className: 'active',
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
		console.log(data.id);
		var columnIndex = $(this).index();
		switch (columnIndex) {
			case 5:
				break;
			default:
				window.location = "<?= base_url('admin/viewRunOfShowSchedule/') ?>" + data.id;
				break;
		}
	});

</script>
