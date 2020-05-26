<div class="modal fade in" id="modal-default" style="display: block;overflow: auto; padding-left: 25px;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
				<h4 class="modal-title"><b>Movie's Details</b></h4>
			</div>
			<div class="modal-body" style="padding-left: 35px; padding-right: 30px">
				<div class="row">
					<div class="col-md-3 pull-right">
						<?php if ($titles->poster != 'N/A') { ?>
							<img class="thumbnail" src="<?= $titles->poster ?>"
								 alt="<?= $titles->title ?>" height="250">
						<?php } else { ?>
							<img class="thumbnail" src="<?= base_url('images/noImage.png') ?>"
								 alt="<?= $titles->title ?>" height="250" width="200">
						<?php } ?>
					</div>
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-3">
								<label>Title</label>
							</div>
							<div class="col-md-9">
								<p><?= $titles->title ?></p>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<label>Year</label>
							</div>
							<div class="col-md-9">
								<p><?= $titles->ReleaseYear == '' ? 'N/A' : $titles->ReleaseYear ?></p>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<label>Rated</label>
							</div>
							<div class="col-md-9">
								<p><?= $titles->rated ?></p>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<label>Released Date</label>
							</div>
							<div class="col-md-9">
								<p><?= $titles->released ?></p>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<label>Runtime</label>
							</div>
							<div class="col-md-9">
								<p><?= $titles->runtime ?></p>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<label>Language</label>
							</div>
							<div class="col-md-9">
								<p><?= $titles->language ?></p>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<label>Country</label>
							</div>
							<div class="col-md-9">
								<p><?= $titles->country ?></p>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<label>imdb ID</label>
							</div>
							<div class="col-md-9">
								<p><?= $titles->imdbID ?></p>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<label>Type</label>
							</div>
							<div class="col-md-9">
								<p><?= $titles->type ?></p>
							</div>
						</div>
					</div>
				</div>

				<input type="hidden" id="genreCheck" value="<?= $titles->genre ?>">
				<div class="row">
					<div class="col-md-2">
						<label>Genre</label>
					</div>
					<div class="col-md-10">
						<p id="genre"><?php if (!empty($titles->genre)) {
								foreach (json_decode($titles->genre) as $genre) {
									echo $genre . ', ';
								}
							} ?></p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<label>Director(s)</label>
					</div>
					<div class="col-md-10">
						<p><?= $titles->director ?></p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<label>Writer(s)</label>
					</div>
					<div class="col-md-10">
						<p><?= $titles->writer ?></p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<label>Actors</label>
					</div>
					<div class="col-md-10">
						<p><?= $titles->actors ?></p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<label>Plot</label>
					</div>
					<div class="col-md-10">
						<p class="text-justify"><?= $titles->plot ?></p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<label>Awards</label>
					</div>
					<div class="col-md-10">
						<p><?= $titles->awards ?></p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<label>Production</label>
					</div>
					<div class="col-md-10">
						<p><?= $titles->production ?></p>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left"
						data-dismiss="modal">Close
				</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

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
