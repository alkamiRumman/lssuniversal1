<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Update Ticket Tiering</b></h4>
			</div>
			<form id="formEdit" action="<?= admin_url('updateTicketTiering/') . $data->id ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="tierLevel">Tier Level <span class="text-danger">*</span></label>
							<input class="form-control input-sm" type="text" name="tierLevel"
								   id="tierLevel" value="<?= $data->tierLevel ?>" required>
							<input type="hidden" value="<?= $remainingSeats ?>" name="remainingSeats"
								   id="remainingSeats">
						</div>
						<div class="form-group col-md-6">
							<label for="section">Section <span class="text-danger">*</span></label>
							<input class="form-control input-sm"
								   type="text" step="any" min="0" name="section"
								   id="section" value="<?= $data->section ?>" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-4">
							<label for="ofSeats"># Of Seats </label>
							<input class="form-control input-sm" type="number"
								   step="1" min="0" value="<?= $data->ofSeats ?>" name="ofSeats" id="ofSeats">
						</div>
						<div class="form-group col-md-4">
							<label for="baseTicketPrice">Base Ticket Price</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input class="form-control input-sm"
									   type="number" step="any" min="0" name="baseTicketPrice"
									   value="<?= $data->baseTicketPrice ?>"
									   id="baseTicketPrice">
							</div>
							<?php if ($data->baseTicketPrice !== $value) { ?>
								<p class="text-bold newBaseTicketPrice">New Price: <?= $value ?></p>
							<?php } ?>
						</div>
						<div class="form-group col-md-4">
							<label for="ticketTieringMarkUp">Ticket Mark-Up <span class="text-danger">*</span></label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input class="form-control input-sm"
									   type="number" step="any" min="0" name="ticketMarkUp"
									   value="<?= $data->ticketMarkUp ?>"
									   id="ticketTieringMarkUp" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-4">
							<label for="newTicketPrice">New Ticket Price</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input class="form-control input-sm"
									   type="number" step="any" min="0" name="newTicketPrice"
									   value="<?= $data->newTicketPrice ?>"
									   id="newTicketPriceModal" readonly>
							</div>
						</div>
						<div class="form-group col-md-4">
							<label for="roi">ROI</label>
							<input class="form-control input-sm"
								   type="number" step="any" min="0" name="roi" value="<?= $data->roi ?>"
								   id="roi" readonly>
						</div>
						<div class="col-md-2">
							<label for="comp">COMP </label><br>
							<input class="itemTimelineView-checkbox"
								   id="comp" type="checkbox" value="1"
								   name="comp" <?= $data->comp == 1 ? 'checked' : '' ?>
								   style="width:20px;height:20px;">
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="form-group col-md-12">
							<button type="submit" id="submit" class="btn btn-info pull-right">Update</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$('#comp').on('change', function () {
		$('#ofSeats, #baseTicketPrice, #ticketTieringMarkUp').trigger('input'); // Recalculate on checkbox change
	});

	$('#comp').on('change', function () {
		var roi = Number($('#roi').val());
		const isChecked = $(this).is(':checked') ? 1 : 0;

		if (isChecked) {
			$('#roi').val(roi > 0 ? roi * -1 : roi);
		} else {
			$('#roi').val(roi < 0 ? roi * -1 : roi);
		}
	});
	$('#ofSeats, #baseTicketPrice, #ticketTieringMarkUp').on('input', function () {
		var ofSeats = parseFloat($('#ofSeats').val()) || 0;
		var baseTicketPrice = parseFloat($('#baseTicketPrice').val()) || 0;
		var ticketMarkup = parseFloat($('#ticketTieringMarkUp').val()) || 0;
		var newTicketPrice = baseTicketPrice + ticketMarkup;
		var roi = ofSeats * newTicketPrice;
		const isChecked = $('#comp').is(':checked');

		if (ticketMarkup > 0) {
			$('#newTicketPriceModal').val(newTicketPrice.toFixed(2));
			$('#roi').val(isChecked ? -roi.toFixed(2) : roi.toFixed(2));
		} else {
			$('#newTicketPriceModal').val(0);
			$('#roi').val(isChecked ? -roi.toFixed(2) : 0);
		}
	});
	$('#formEdit').on('submit', function (e) {
		e.preventDefault();
		var form = $(this);
		var actionUrl = form.attr('action');
		$.ajax({
			url: actionUrl,
			type: 'POST',
			data: form.serialize(),
			error: function () {
				toastr.warning('Something is wrong');
			},
			success: function (data) {
				$("#remoteModal1").modal('hide');
				$("#ticketTieringTable").load(window.location + " #ticketTieringTable > *");
				if (data) {
					$("#remainingSeats").val(data);
				} else {
					toastr.error("No seats available!");
				}
				$("#form").trigger('submit', ['saveProgress']);
			}
		});
	});
</script>
