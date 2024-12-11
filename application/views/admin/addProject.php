<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Create New Project Brief</b></h4>
			</div>
			<form id="formEdit" action="<?= admin_url('saveProject') ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="productionId">Select Production <b class="text-danger">*</b></label>
							<select id="productionId" name="productionId" class="form-control selectProduction"
									style="width: 100%;" required></select>
						</div>
					</div>
					<div class="row detailsTable" style="display: none">
						<div class="form-group col-md-12">
							<table class="table table-bordered table-sm">
								<tr>
									<th>Event Month</th>
									<td id="eventMonth"></td>
								</tr>
								<tr>
									<th>Event Year</th>
									<td id="eventYear"></td>
								</tr>
								<tr>
									<th>Venue</th>
									<td id="venue"></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label for="description">Description </label>
							<textarea rows="3" type="text" id="description" name="description"
									  class="form-control"></textarea>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="form-group col-md-12">
							<button type="submit" id="submit" class="btn btn-primary pull-right">Save</button>
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
			// startDate: '+0d',
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
