<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Copy Run of Show</b></h4>
			</div>
			<form id="formEdit" action="<?= admin_url('saveCopyRunShow/') . $data->id ?>" method="post">
				<div class="modal-body">
					<div class="row detailsTable">
						<div class="form-group col-md-12">
							<table class="table table-bordered table-sm">
								<tr>
									<th>Production Title</th>
									<td id="eventMonth"><?= $data->title ?></td>
								</tr>
								<tr>
									<th>Event Month</th>
									<td id="eventMonth"><?= $data->eventMonth ?></td>
								</tr>
								<tr>
									<th>Event Year</th>
									<td id="eventYear"><?= $data->eventYear ?></td>
								</tr>
								<tr>
									<th>Venue</th>
									<td id="venue"><?= $data->venueName ?></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="description">Description </label>
							<textarea rows="3" type="text" id="description" name="description"
									  class="form-control"><?= $data->description ?></textarea>
							<input type="hidden" name="productionId" value="<?= $data->productionId ?>">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="date">Date <b class="text-danger">*</b></label>
							<div class="input-group date">
								<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
								<input type="text" class="form-control"
									   value="<?= date('d M Y', strtotime($data->date)) ?>" name="date" id="date"
									   required>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="time">Time <b class="text-danger">*</b></label>
							<input type="time" value="<?= $data->time ?>" class="form-control" name="time" id="time"
								   required>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="form-group col-md-12">
							<button type="submit" id="submit" style="background-color: black; color: white"
									class="btn pull-right">Copy
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<style>
	/* Customizing the time input field */
	input[type="time"] {
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		padding: 10px;
		font-size: 16px;
		color: #333;
		background-color: #fff;
		border: 1px solid #ccc;
		border-radius: 4px;
		width: 100%;
		box-sizing: border-box;
	}

	/* Add hover and focus effects */
	input[type="time"]:hover {
		border-color: #888;
	}

	input[type="time"]:focus {
		border-color: #007bff;
		box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
	}

	/* Placeholder-like appearance */
	input[type="time"]::placeholder {
		color: #aaa;
		font-style: italic;
	}

	td {
		font-weight: normal;
	}
</style>
<script>
	$(document).ready(function () {
		$('#time').on('focus click', function () {
			this.showPicker();
		});
	});
	$(function () {
		$('#date').datepicker({
			autoclose: true,
			todayHighlight: true,
			format: 'dd M yyyy'
		});

		$(".selectProduction").select2({
			placeholder: "Select Production",
			dropdownParent: $('#remoteModal1'),
			ajax: {
				url: '<?= admin_url("getProductionSearch") ?>',
				dataType: 'json',
				type: "POST",
				quietMillis: 50,
				allowClear: true,
				data: function (params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function (response) {
					console.log(response);
					return {
						results: response
					};
				}
			}
		}).on('select2:select', function (event) {
			var data = event.params.data;
			$('.detailsTable').show();
			$('#eventMonth').text(data.eventMonth);
			$('#eventYear').text(data.eventYear);
			$('#venue').text(data.venueName);
		});
	});
</script>
