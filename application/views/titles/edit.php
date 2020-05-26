<div class="modal fade in" id="modal-default" style="display: block;overflow: auto; padding-left: 25px;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
				<h4 class="modal-title"><b>Update Title</b></h4>
			</div>
			<div class="modal-body">
				<form role="form" action="<?= titles_url('update/' . $titles->id) ?>" method="post"
				      enctype="multipart/form-data">
					<div class="row">
						<div class="form-group col-md-3">
							<label for="title"> Title <b class="text-danger">*</b></label>
							<input type="text" class="form-control" id="title" name="title"
							       value="<?= $titles->title ?>" required="">
						</div>

						<div class="form-group col-md-3">
							<label for="ReleaseYear"> Year </label>
							<input type="text" id="ReleaseYear" name="ReleaseYear" class="form-control"
							       value="<?= $titles->ReleaseYear ?>">
						</div>

						<div class="form-group col-md-6">
							<label for="director"> Director(s) </label>
							<input type="text" class="form-control" id="director" name="director"
							       value="<?= $titles->director ?>">
						</div>
					</div>

					<?php
						if (!empty($titles->genre)) {
							foreach (json_decode($titles->genre) as $genre) { ?>
								<input type="hidden" id="genreValue" name="genreValue[]" value="<?= $genre ?>">
							<? }
						} ?>

					<div class="row">
						<div class="form-group col-md-12 inputGenre">
							<label for="genre"> Genre </label>
							<select id="genre" name="genre[]" class="form-control genre" multiple
							        data-max-options="10">
								<option value="Action">Action</option>
								<option value="Adult">Adult</option>
								<option value="Adventure">Adventure</option>
								<option value="Animation">Animation</option>
								<option value="Biography">Biography</option>
								<option value="Comedy">Comedy</option>
								<option value="Crime">Crime</option>
								<option value="Documentary">Documentary</option>
								<option value="Drama">Drama</option>
								<option value="Family">Family</option>
								<option value="Fantasy">Fantasy</option>
								<option value="Fiction">Fiction</option>
								<option value="Film-Noir">Film-Noir</option>
								<option value="History">History</option>
								<option value="Horror">Horror</option>
								<option value="Music">Music</option>
								<option value="Musical">Musical</option>
								<option value="Mystery">Mystery</option>
								<option value="Philosophical">Philosophical</option>
								<option value="Political">Political</option>
								<option value="Realism">Realism</option>
								<option value="Romance">Romance</option>
								<option value="Sci-Fi">Sci-Fi</option>
								<option value="Short">Short</option>
								<option value="Social">Social</option>
								<option value="Talk-Show">Talk-Show</option>
								<option value="Thriller">Thriller</option>
								<option value="War">War</option>
								<option value="Western">Western</option>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-12">
							<label for="writer"> Writer(s) </label>
							<input type="text" class="form-control" id="writer" name="writer"
							       value="<?= $titles->writer ?>">
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-12">
							<label for="actors"> Actors </label>
							<input type="text" class="form-control" id="actors" name="actors"
							       value="<?= $titles->actors ?>">
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-12">
							<label for="awards"> Awards </label>
							<input type="text" class="form-control" id="awards" name="awards"
							       value="<?= $titles->awards ?>">
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-3">
							<label for="rated"> Rated </label>
							<input type="text" class="form-control" id="rated" name="rated"
							       value="<?= $titles->rated ?>">
						</div>


						<div class="form-group col-md-3">
							<label for="released"> Released Date </label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" id="released"
								       name="released" value="<?= $titles->released ?>">
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="runtime"> Runtime </label>
							<input type="text" class="form-control" id="runtime" name="runtime"
							       value="<?= $titles->runtime ?>">
						</div>

						<div class="form-group col-md-3">
							<label for="language"> Language </label>
							<input type="text" class="form-control" id="language" name="language"
							       value="<?= $titles->language ?>">
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-3">
							<label for="country"> Country </label>
							<input type="text" class="form-control" id="country" name="country"
							       value="<?= $titles->country ?>">
						</div>

						<div class="form-group col-md-3">
							<label for="imdbID"> imdb ID <b class="text-danger">*</b></label>
							<input type="text" class="form-control" id="imdbID" name="imdbID"
							       value="<?= $titles->imdbID ?>" required="">
						</div>

						<div class="form-group col-md-3">
							<label for="type"> Type <b class="text-danger">*</b></label>
							<input type="text" class="form-control" id="type" name="type"
							       value="<?= $titles->type ?>" required="">
						</div>

						<div class="form-group col-md-3">
							<label for="production"> Production </label>
							<input type="text" class="form-control" id="production" name="production"
							       value="<?= $titles->production ?>">
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-12">
							<label for="poster"> Movie Poster </label>
							<input type="text" class="form-control" id="poster" name="poster"
							       value="<?= $titles->poster ?>">
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-12">
							<label for="plot"> Plot </label>
							<textarea class="form-control" id="plot" name="plot"
							          rows="4"><?= $titles->plot ?></textarea>
						</div>
					</div>

					<div class="box-footer">
						<div class="row">
							<div class="form-group col-md-12">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function () {
		$('#released').datepicker({
			autoclose: true,
			todayHighlight: true,
			changeMonth: true,
			changeYear: true,
			format: 'd M yyyy'
		});
	});
	var picker;
	$(document).ready(function () {
		picker = $('.genre').selectpicker();
		var date = $('#released').val();
		console.log(date);
		$('#released').datepicker().datepicker("setDate", new Date(date));

		$('#genreValue').each(function (i, v) {
			console.log(v);
			var values = $("input[name='genreValue[]']")
				.map(function () {
					return $(this).val();
				}).get();
			picker.selectpicker('val', values);
		});
	});
</script>
