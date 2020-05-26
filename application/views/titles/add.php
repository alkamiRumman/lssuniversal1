<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Add New Title</b></h3>
				<a href="<?= titles_url('index') ?>" class="btn btn-primary pull-right">Title List</a>
			</div>
			<div class="box-body">
				<form action="" method="post">
					<div class="row">
						<div class="form-group col-md-3">
							<label for="movieTitle"> Title </label>
							<input type="text" class="form-control" id="movieTitle" name="movieTitle"
							       placeholder="Enter Movie Title">
							<p id="emptyTitle" class="text-danger">Enter Movie's Title!!</p>
						</div>

						<div class="form-group col-md-3">
							<label for="year"> Year </label>
							<input id="year" name="year" class="form-control"
							       placeholder="Release Year">
						</div>

						<div class="form-group col-md-1" style="margin-top: 4px">
							<label for="fetch"></label>
							<button type="button" id="fetch" class="form-control btn btn-info">Fetch</button>
							<p id="fetchResult" class="text-danger">No data found!!</p>
						</div>
					</div>
				</form>

				<div class="row">
					<div class="form-group col-md-12">
						<hr>
					</div>
				</div>

				<form role="form" action="<?= titles_url('save') ?>" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="form-group col-md-3">
							<label for="title"> Title <b class="text-danger">*</b></label>
							<input type="text" class="form-control" id="title" name="title"
							       placeholder="Movie Title" required="">
						</div>

						<div class="form-group col-md-3">
							<label for="ReleaseYear"> Year </label>
							<input type="text" id="ReleaseYear" name="ReleaseYear" class="form-control"
							       placeholder="Release Year">
						</div>

						<div class="form-group col-md-6">
							<label for="director"> Director(s) </label>
							<input type="text" class="form-control" id="director" name="director"
							       placeholder="Director">
						</div>
					</div>
					<!---->
					<!--					<div class="row">-->
					<!--						<div class="form-group col-md-12 fetchGenre">-->
					<!--							<label for="director"> Genre </label>-->
					<!--							<input type="text" class="form-control" id="fetchGenre" name="genre[]"-->
					<!--							       placeholder="genre">-->
					<!--						</div>-->
					<!--					</div>-->

					<div class="row">
						<div class="form-group col-md-12">
							<label for="genre"> Genre </label>
							<select id="genre" name="genre[]" class="form-control" multiple data-max-options="10">
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
							       placeholder="Writer">
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-12">
							<label for="actors"> Actors </label>
							<input type="text" class="form-control" id="actors" name="actors"
							       placeholder="Actors Name">
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-12">
							<label for="awards"> Awards </label>
							<input type="text" class="form-control" id="awards" name="awards"
							       placeholder="Awards">
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-3">
							<label for="rated"> Rated </label>
							<input type="text" class="form-control" id="rated" name="rated"
							       placeholder="Enter Rating">
						</div>


						<div class="form-group col-md-3">
							<label for="released"> Released Date </label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" id="released"
								       name="released" placeholder="Movie Release Date">
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="runtime"> Runtime </label>
							<input type="text" class="form-control" id="runtime" name="runtime"
							       placeholder="Runtime">
						</div>

						<div class="form-group col-md-3">
							<label for="language"> Language </label>
							<input type="text" class="form-control" id="language" name="language"
							       placeholder="Release Language">
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-3">
							<label for="country"> Country </label>
							<input type="text" class="form-control" id="country" name="country"
							       placeholder="Country Name">
						</div>

						<div class="form-group col-md-3">
							<label for="imdbID"> imdb ID <b class="text-danger">*</b></label>
							<input type="text" class="form-control" id="imdbID" name="imdbID"
							       placeholder="imdb ID" required="">
						</div>

						<div class="form-group col-md-3">
							<label for="type"> Type <b class="text-danger">*</b></label>
							<input type="text" class="form-control" id="type" name="type"
							       placeholder="Enter Type" required="">
						</div>

						<div class="form-group col-md-3">
							<label for="production"> Production </label>
							<input type="text" class="form-control" id="production" name="production"
							       placeholder="Production Name">
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-12">
							<label for="poster"> Movie Poster </label>
							<input type="text" class="form-control" id="poster" name="poster"
							       placeholder="Poster Url">
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-12">
							<label for="plot"> Plot </label>
							<textarea class="form-control" id="plot" name="plot"
							          placeholder="Short Story of the Movie" rows="4"></textarea>
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

		$('p#fetchResult').hide();
		$('p#emptyTitle').hide();
		$('#fetch').on('click', function () {
			var title = $('#movieTitle').val();
			var year = $('#year').val();
			console.log(title);
			if (year === '') {
				var flickerAPI = "https://www.omdbapi.com/?apikey=da664eab&t=" + title + "&plot=full";
				$.getJSON(flickerAPI, {
					tags: "mount rainier",
					tagmode: "any",
					format: "json"
				})
					.done(function (data) {
						console.log(data);
						if ($('#movieTitle').val() === '') {
							$('p#emptyTitle').show().fadeOut(3000);
						} else if (data.Response !== 'False') {
							var g = data.Genre;
							genrePicker.selectpicker('val', g.split(", "));
							$('#title').val(data.Title);
							$('#ReleaseYear').val(data.Year);
							$('#director').val(data.Director);
							$('#writer').val(data.Writer);
							$('#actors').val(data.Actors);
							$('#awards').val(data.Awards);
							$('#rated').val(data.Rated);
							$('#released').val(data.Released);
							$('#runtime').val(data.Runtime);
							$('#language').val(data.Language);
							$('#country').val(data.Country);
							$('#imdbID').val(data.imdbID);
							$('#type').val(data.Type);
							$('#production').val(data.Production);
							$('#poster').val(data.Poster);
							$('#plot').val(data.Plot);
						} else {
							$('p#fetchResult').show().fadeOut(3000);
						}
					});
			} else {
				var flickerAPI = "https://www.omdbapi.com/?apikey=da664eab&t=" + title + "&plot=full&y=" + year;
				$.getJSON(flickerAPI, {
					tags: "mount rainier",
					tagmode: "any",
					format: "json"
				})
					.done(function (data) {
						if ($('#movieTitle').val() === '') {
							$('p#emptyTitle').show().fadeOut(3000);
						} else if ($('#year').val() === '') {
							$('p#emptyYear').show().fadeOut(3000);
						} else if (data.Response !== 'False') {
							var g = data.Genre;
							genrePicker.selectpicker('val', g.split(", "));
							$('#title').val(data.Title);
							$('#ReleaseYear').val(data.Year);
							$('#director').val(data.Director);
							$('#writer').val(data.Writer);
							$('#actors').val(data.Actors);
							$('#awards').val(data.Awards);
							$('#rated').val(data.Rated);
							$('#released').val(data.Released);
							$('#runtime').val(data.Runtime);
							$('#language').val(data.Language);
							$('#country').val(data.Country);
							$('#imdbID').val(data.imdbID);
							$('#type').val(data.Type);
							$('#production').val(data.Production);
							$('#poster').val(data.Poster);
							$('#plot').val(data.Plot);
						} else {
							$('p#fetchResult').show().fadeOut(3000);
						}
					});

			}
		});
	});
	var genrePicker;
	$(document).ready(function () {
		genrePicker = $('#genre').selectpicker();
	});
</script>
