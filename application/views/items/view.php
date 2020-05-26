<div class="modal fade in" id="modal-default" style="display: block;overflow: auto; padding-left: 25px;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
				<h4 class="modal-title"><b>Movie's Details</b></h4>
			</div>
			<div class="modal-body" style="padding-left: 35px;">
				<div class="row">
					<div class="col-md-3">
						<img class="thumbnail"
							 src="<?= $titles->poster != 'N/A' ? $titles->poster : base_url('images/noImage.png') ?>"
							 alt="<?= $titles->title ?>" width="200">
					</div>
					<div class="col-md-8">
						<p><b>Title: </b><?= $titles->title ?><br>
							<b>Year: </b><?= $titles->ReleaseYear == '' ? 'N/A' : $titles->ReleaseYear ?><br>
							<b>Director(s): </b><?= $titles->director ?><br>
							<b>Writer(s): </b><?= $titles->writer ?><br>
							<b>Actors: </b><?= $titles->actors ?><br>
							<b>Rated: </b><?= $titles->rated ?> | <b>Released Date: </b><?= $titles->released ?> |
							<b>Runtime: </b><?= $titles->runtime ?><br>
							<b>Language: </b><?= $titles->language ?> | <b>Country: </b><?= $titles->country ?><br>
							<b>Type: </b><?= $titles->type ?> | <b>Awards: </b><?= $titles->awards ?><br>
							<b>Genre: </b><?php if (!empty($titles->genre)) {
								foreach (json_decode($titles->genre) as $genre) {
									echo $genre . ', ';
								}
							} ?><br>
							<b>Production: </b><?= $titles->production ?> </p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-10">
						<h4>Item Details</h4>
						<hr>
					</div>
				</div>

				<div class="row">
					<div class="col-md-2" style="margin-bottom: 0">
						<b>Item Id: </b>
					</div>
					<div class="col-md-8">
						<p><?= $items->id ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2">
						<b>Movie Title: </b>
					</div>
					<div class="col-md-8">
						<p><?= $titles->title ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2">
						<b>Format: </b>
					</div>
					<div class="col-md-8">
						<p><?= $items->format ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2">
						<b>Quantity: </b>
					</div>
					<div class="col-md-8">
						<p><?= $items->quantity ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2">
						<b>Dimensions: </b>
					</div>
					<div class="col-md-8">
						<p><?= $items->dimensions ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2">
						<b>Item Nationality: </b>
					</div>
					<div class="col-md-8">
						<p><?= $items->nationality ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2">
						<b>Value: </b>
					</div>
					<div class="col-md-8">
						<p>Low: &nbsp <?= $items->lowValue ?> &nbsp&nbsp&nbsp&nbsp High: &nbsp <?= $items->highValue ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2">
						<b>Source: </b>
					</div>
					<div class="col-md-8">
						<p><?= $items->source ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2">
						<b>Location: </b>
					</div>
					<div class="col-md-8">
						<p><?= $items->location ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2">
						<b>Status: </b>
					</div>
					<div class="col-md-8">
						<p><?= $items->status ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10">
						<p><b>Description: </b><br><?= $items->description ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10">
						<p><b>Condition: </b><br><?= $items->conditions ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10">
						<h4>Old Data</h4>
						<hr>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<b>Old Title: </b>
					</div>
					<div class="col-md-9">
						<p><?= $items->oldTitle ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<b>Old Year:</b>
					</div>
					<div class="col-md-9">
						<p><?= $items->oldYear ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<b>Old Format:</b>
					</div>
					<div class="col-md-9">
						<p><?= $items->oldFormat ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<b>Old Comments: </b>
					</div>
					<div class="col-md-9">
						<p><?= $items->oldComments ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<b>Old Notes:</b>
					</div>
					<div class="col-md-9">
						<p><?= $items->oldNotes ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<b>Overall Condition:</b>
					</div>
					<div class="col-md-9">
						<p><?= $items->overallCondition ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<b>Posting Title:</b>
					</div>
					<div class="col-md-9">
						<p><?= $items->postingTitle ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<b>Posting Sub-Title:</b>
					</div>
					<div class="col-md-9">
						<p><?= $items->postingSubTitle ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php if ($items->image1) { ?>
							<img src="<?= base_url('images/' . $items->image1) ?>" width="100%">
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php if ($items->image2) { ?>
							<img src="<?= base_url('images/' . $items->image2) ?>" width="100%">
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php if ($items->image3) { ?>
							<img src="<?= base_url('images/' . $items->image3) ?>" width="100%">
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php if ($items->image4) { ?>
							<img src="<?= base_url('images/' . $items->image4) ?>" width="100%">
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php if ($items->image5) { ?>
							<img src="<?= base_url('images/' . $items->image5) ?>" width="100%">
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php if ($items->image6) { ?>
							<img src="<?= base_url('images/' . $items->image6) ?>" width="100%">
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php if ($items->image7) { ?>
							<img src="<?= base_url('images/' . $items->image7) ?>" width="100%">
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php if ($items->image8) { ?>
							<img src="<?= base_url('images/' . $items->image8) ?>" width="100%">
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php if ($items->image9) { ?>
							<img src="<?= base_url('images/' . $items->image9) ?>" width="100%">
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php if ($items->image10) { ?>
							<img src="<?= base_url('images/' . $items->image10) ?>" width="100%">
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left"
						data-dismiss="modal">Close
				</button>
			</div>
		</div>
	</div>
</div>

<style>
</style>

<script>
	$(document).ready(function () {
		var cg = $('#genreCheck').val();
		console.log(cg);
		console.log($('#genre').text());
		if (cg == 0) {
			$('p#genre').text('N/A');
		} else {
			var g = new String($('#genre').text());
			var gn = g.slice(0, -2);
			$('p#genre').text(gn);
		}
	})
</script>
