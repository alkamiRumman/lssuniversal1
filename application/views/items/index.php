<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Title List</b></h3>
				<a href="<?= items_url('add') ?>" class="btn btn-primary pull-right">Add New Item</a>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered serverSide-table dtr-inline"
						   style="width: 100% !important;">
						<thead>
						<tr>
							<th>Thumbnail</th>
							<th>Title</th>
							<th>Release Year</th>
							<th>Dimensions</th>
							<th>Format</th>
							<th>Quantity</th>
							<th>Nationality</th>
							<th>Product Description</th>
							<th>Condition</th>
							<th>Low Value</th>
							<th>High Value</th>
							<th>Status</th>
							<th>Source</th>
							<th>Old Title</th>
							<th>Old Comments</th>
							<th>Old Notes</th>
							<th>Old Format</th>
							<th>Old Year</th>
							<th>eBay Category</th>
							<th>Overall Condition</th>
							<th>Posting Title</th>
							<th>Posting Sub-Title</th>
							<th>Genre</th>
							<th>Country</th>
							<th>Director(s)</th>
							<th>Writer(s)</th>
							<th>Actors</th>
							<th>Location</th>
							<th>Updated Date</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	var Table, selectedIDs = [];
	window.onload = function () {
		geTableData();
	};

	function geTableData() {
		Table = $('.serverSide-table').DataTable({
			order: [[1, "ASC"]],
			// destroy: true,
			// stateSave: true,
			"columnDefs": [
				{
					"render": function (data, type, row) {
						if (data != null) {
							return '<img src="<?= base_url('images/')?>' + data + '" width="90" class="thumbnail" style="margin: 0 auto" id="poster"' +
									'onclick="loadPopup(\'<?= items_url("view/") ?>' + row.id + '\')">';
						} else {
							return '<img src="<?= base_url('images/noImage.png') ?>" width="90" class="thumbnail" style="margin: 0 auto" id="poster"' +
									'onclick="loadPopup(\'<?= items_url("view/") ?>' + row.id + '\')">';
						}
					},
					"targets": 0
				},
				{
					"targets": [2, 3, 5, 6, 7, 8, 9, 10, 11, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 25, 28],
					"visible": false
				},
				{
					"render": function (data, type, row) {
						// console.log(data);
						return JSON.parse(data);
					},
					"targets": 22
				},
				{
					"render": function (data, type, row) {
						if (data != null) {
							return moment(data).format('DD MMM YYYY');
						} else {
							return 'Not update';
						}
					},
					"targets": 28
				}
			],
			'aoColumns': [{mData: "image1", bSortable: false}, {mData: "title"}, {mData: "ReleaseYear"}, {mData: "dimensions"}, {mData: "format"},
				{mData: "quantity"}, {mData: "nationality"}, {mData: "description"}, {mData: "conditions"}
				, {mData: "lowValue"}, {mData: "highValue"}, {mData: "status"}, {mData: "source"}, {mData: "oldTitle"}, {mData: "oldComments"}
				, {mData: "oldNotes"}, {mData: "oldFormat"}, {mData: "oldYear"}, {mData: "eBayCategory"}, {mData: "overallCondition"}
				, {mData: "postingTitle"}, {mData: "postingSubTitle"}, {mData: "genre"}, {mData: "country"}, {mData: "director"}
				, {mData: "writer"}, {mData: "actors"}, {mData: "location"}, {mData: "updateAt"}, {mData: "actions", bSortable: false}],
			"aLengthMenu": [[25, 50, 100, 200, 500, 1000], [25, 50, 100, 200, 500, 1000]],
			"iDisplayLength": 25,
			'bProcessing': true,
			"language": {
				processing: '<div><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading Please Wait...</span></div>'
			},
			'bServerSide': true,
			'sAjaxSource': '<?= items_url('getItems') ?>',
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
			select: {
				style: 'multi',
				selector: 'td:first-child'
			},
			dom: '<"top"B<"pull-right"l>>irtp',
			//dom: 'Blfrtip',
			buttons: [
				'copy', 'csv', 'excel', {
					extend: 'colvis',
					text: 'Column Visibility',
					collectionLayout: 'two-column'
				}
			]
		});
		yadcf.init(Table, [
			{column_number: 1, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 2, filter_default_label: "Type..", filter_type: "text"},
			{column_number: 3, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 4, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 5, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 6, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 7, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 8, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 9, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 10, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 11, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 12, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 13, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 14, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 15, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 16, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 17, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 18, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 19, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 20, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 21, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 22, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 23, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 24, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 25, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 26, filter_default_label: "Type...", filter_type: "text"}
		], "header");
	}

</script>
