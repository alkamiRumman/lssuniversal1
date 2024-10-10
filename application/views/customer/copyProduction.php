<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Copy Production</b></h4>
			</div>
			<form role="form" action="<?= customer_url('saveCopyProduction/' . $data->id) ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="title">PRODUCTION TITLE <span class="text-danger">*</span></label>
							<input class="form-control input-sm" type="text" name="title" id="title" required
								   placeholder="Enter production title">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="eventMonth">EVENT MONTH <span class="text-danger">*</span></label>
							<select class="form-control input-sm" name="eventMonth" id="eventMonth" required>
								<option <?= (date('F') == 'January') ? 'selected' : '' ?>
										value="January">January
								</option>
								<option <?= (date('F') == 'February') ? 'selected' : '' ?>
										value="February">February
								</option>
								<option <?= (date('F') == 'March') ? 'selected' : '' ?>
										value="March">March
								</option>
								<option <?= (date('F') == 'April') ? 'selected' : '' ?>
										value="April">April
								</option>
								<option <?= (date('F') == 'May') ? 'selected' : '' ?>
										value="May">May
								</option>
								<option <?= (date('F') == 'June') ? 'selected' : '' ?>
										value="June">June
								</option>
								<option <?= (date('F') == 'July') ? 'selected' : '' ?>
										value="July">July
								</option>
								<option <?= (date('F') == 'August') ? 'selected' : '' ?>
										value="August">August
								</option>
								<option <?= (date('F') == 'September') ? 'selected' : '' ?>
										value="September">September
								</option>
								<option <?= (date('F') == 'October') ? 'selected' : '' ?>
										value="October">October
								</option>
								<option <?= (date('F') == 'November') ? 'selected' : '' ?>
										value="November">November
								</option>
								<option <?= (date('F') == 'December') ? 'selected' : '' ?>
										value="December">December
								</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="eventYear">EVENT YEAR <span class="text-danger">*</span></label>
							<input class="form-control input-sm" type="number" minlength="4"
								   min="<?= date('Y') ?>"
								   name="eventYear" value="<?= date('Y') ?>"
								   id="eventYear" required>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="checkbox-inline"><input type="checkbox" value="checkbox" id="checkbox">Same
									Value</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="venueId">SELECT VENUE <span class="text-danger">*</span></label>
							<select id="venueId" name="venueId"
									class="form-control input-sm selectVenue"
									style="width: 100%;" required>
							</select>
							<input type="hidden" id="venueIdVal" value="<?= $data->venueId ?>">
							<input type="hidden" id="venueNameVal" value="<?= $data->venueName ?>">
						</div>
						<div class="form-group col-md-6">
							<label for="address">ADDRESS <span class="text-danger">*</span></label>
							<input class="form-control input-sm" type="text" name="address"
								   id="address" readonly>
							<input type="hidden" id="addressVal" value="<?= $data ? $data->address : '' ?>">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="city">CITY <span class="text-danger">*</span></label>
							<input class="form-control input-sm" type="text" name="city"
								   id="city" readonly>
							<input type="hidden" id="cityVal" value="<?= $data ? $data->city : '' ?>">
						</div>
						<div class="form-group col-md-4">
							<label for="state">STATE <span class="text-danger">*</span></label>
							<input class="form-control input-sm" type="state" name="state"
								   id="state" readonly>
							<input type="hidden" id="stateVal" value="<?= $data ? $data->state : '' ?>">
						</div>
						<div class="col-md-2">
							<label for="zip"> Zip Code <b class="text-danger">*</b></label>
							<input class="form-control input-sm" type="text" name="zip" id="zip" readonly>
							<input type="hidden" id="zipVal" value="<?= $data ? $data->zip : '' ?>">
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="form-group col-md-12">
							<button type="submit" style="color: white; background-color: black" class="btn pull-right">
								Copy
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(function () {
		$(".selectVenue").select2({
			placeholder: "Select Venue",
			dropdownParent: $('#remoteModal1'),
			ajax: {
				url: '<?= customer_url("getVenueSearch") ?>',
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
					return {
						results: response
					};
				}
			}
		}).on('select2:select', function (event) {
			var data = event.params.data;
			$('#address').val(data.address);
			$('#city').val(data.city);
			$('#state').val(data.state);
			$('#zip').val(data.zip);
		});
		$("#checkbox").on('click', function () {
			if ($('[type="checkbox"]').is(":checked")) {
				var venueName = $('#venueNameVal').val();
				var venueId = $('#venueIdVal').val();
				var address = $('#addressVal').val();
				var city = $('#cityVal').val();
				var state = $('#stateVal').val();
				var zip = $('#zipVal').val();
				var option = $("<option selected></option>").val(venueId).text(venueName);
				$("#venueId").append(option).trigger('change');
				$('#address').val(address);
				$('#city').val(city);
				$('#state').val(state);
				$('#zip').val(zip);
			} else {
				$('.selectVenue').val('').trigger("change");
				$('#address').val('');
				$('#city').val('');
				$('#state').val('');
				$('#zip').val('');
			}
		});
	});
</script>
