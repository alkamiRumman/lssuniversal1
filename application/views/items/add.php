<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Add New Items</b></h3>
				<a href="<?= items_url('index') ?>" class="btn btn-primary pull-right">Item List</a>
			</div>
			<div class="box-body">
				<div class="row title" style="display: none">
					<div class="col-md-2">
						<img src="" id="poster" class="thumbnail" height="220" width="170">
					</div>
					<div class="col-md-10">
						<p class="text-justify details"></p>
					</div>
					<div class="col-md-12">
						<hr>
					</div>
				</div>
				<form role="form" action="<?= items_url('save') ?>" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="titleId"> Movie Title <b class="text-danger">*</b></label>
							<select style="width: 100%" class="form-control select2" name="titleId" id="titleId" required></select>
						</div>
						<div class="form-group col-md-6">
							<label for="postingTitle">Posting Title </label>
							<input class="form-control" type="text" name="postingTitle" id="postingTitle"
								   placeholder="Enter Posting Title">
						</div>
						<div class="form-group col-md-6">
							<label for="postingSubTitle">Posting Sub-Title </label>
							<input class="form-control" type="text" name="postingSubTitle" id="postingSubTitle"
								   placeholder="Enter Posting Sub-Title">
						</div>
						<div class="form-group col-md-3">
							<label for="format">Format <b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="format" id="format"
								   placeholder="Enter Format" required>
						</div>
						<div class="form-group col-md-3">
							<label for="dimensions">Dimensions</label>
							<input class="form-control" type="text" name="dimensions" id="dimensions"
								   placeholder="Enter Dimensions">
						</div>
						<div class="form-group col-md-3">
							<label for="quantity">Quantity <b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="quantity" id="quantity" required
								   placeholder="Enter Quantity">
						</div>
						<div class="form-group col-md-3">
							<label for="nationality">Nationality</label>
							<input class="form-control" type="text" name="nationality" id="nationality"
								   placeholder="Enter Nationality">
						</div>
						<div class="form-group col-md-3">
							<label for="lowValue">Low Value</label>
							<input class="form-control" type="text" name="lowValue" id="lowValue"
								   placeholder="Enter Low Value">
						</div>
						<div class="form-group col-md-3">
							<label for="highValue">High Value</label>
							<input class="form-control" type="text" name="highValue" id="highValue"
								   placeholder="Enter High Value">
						</div>
						<div class="form-group col-md-3">
							<label for="source">Source</label>
							<input class="form-control" type="text" name="source" id="source"
								   placeholder="Enter Source">
						</div>
						<div class="form-group col-md-3">
							<label for="location">Location</label>
							<input class="form-control" type="text" name="location" id="location"
								   placeholder="Enter Location">
						</div>
						<div class="form-group col-md-12">
							<label for="description">Product Description</label>
							<textarea class="form-control" rows="4" name="description" id="description"
									  placeholder="Enter Product Description"></textarea>
						</div>
						<div class="form-group col-md-12">
							<label for="conditions">Condition</label>
							<textarea class="form-control" rows="3" name="conditions" id="conditions"
									  placeholder="Enter Condition"></textarea>
						</div>
						<div class="form-group col-md-12">
							<label for="overallCondition">Overall Condition</label>
							<textarea class="form-control" rows="3" name="overallCondition" id="overallCondition"
									  placeholder="Enter Overall Condition"></textarea>
						</div>
					</div>
<!--					<div class="row">-->
<!--						<div class="col-md-6" style="padding-right: 0">-->
<!--							<div class="input-field1">-->
<!--																<label class="active">Photos 1</label>-->
<!--								<div class="input-images1"></div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="col-md-6">-->
<!--							<div class="row">-->
<!--								--><?php //for ($i = 2; $i < 11; $i++) { ?>
<!--									<div class="col-md-4" style="padding-left: 5px; padding-bottom: 9px">-->
<!--										<div class="input-field--><?//= $i ?><!--">-->
<!--																						<label class="active">Photos --><?// //= $i ?><!--</label>-->
<!--											<div class="input-images--><?//= $i ?><!--"></div>-->
<!--										</div>-->
<!--									</div>-->
<!--								--><?php //} ?>
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
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

<style>
	.iui-close:before {
		content: "\e900"
	}

	.iui-cloud-upload:before {
		content: "\e901"
	}

	.image-uploader {
		min-height: 10rem;
		border: 2px dashed grey;
	}

	.input-images1 .image-uploader {
		min-height: 32rem;
		border: 2px dashed grey;
		/*position: relative*/
	}

	.image-uploader.drag-over {
		background-color: #f3f3f3
	}

	.image-uploader input[type=file] {
		width: 0;
		height: 0;
		position: absolute;
		z-index: -1;
		opacity: 0
	}

	.image-uploader .upload-text {
		position: absolute;
		top: 0;
		right: 0;
		left: 0;
		bottom: 0;
		display: flex;
		justify-content: center;
		align-items: center;
		flex-direction: column
	}

	.image-uploader .upload-text i {
		display: block;
		font-size: 3rem;
		margin-bottom: .5rem;
	}

	.image-uploader .upload-text span {
		display: block;
		text-align: center;
	}

	.image-uploader.has-files .upload-text {
		display: none
	}

	.image-uploader .uploaded {
		padding: .5rem;
		line-height: .6rem;
	}

	.image-uploader1 .uploaded .uploaded-image {
		display: inline-block;
		width: calc(16.6666667% - 1rem);
		padding-bottom: calc(16.6666667% - 1rem);
		height: 0;
		position: relative;
		margin: .5rem;
		background: #f3f3f3;
		cursor: default
	}

	.image-uploader .uploaded .uploaded-image img {
		/*width: 100%;*/
		height: 85px;
		/*object-fit: cover;*/
		/*position: absolute*/
	}

	.input-images1 .image-uploader .uploaded .uploaded-image img {
		/*width: 100%;*/
		height: 300px;
		/*object-fit: cover;*/
		/*position: absolute*/
	}

	.image-uploader .uploaded .uploaded-image .delete-image {
		display: none;
		cursor: pointer;
		position: absolute;
		top: .7rem;
		right: 1.5rem;
		border-radius: 50%;
		padding: .3rem;
		line-height: 1;
		background-color: rgba(0, 0, 0, .5);
		-webkit-appearance: none;
		border: none
	}

	.image-uploader .uploaded .uploaded-image:hover .delete-image {
		display: block
	}

	.image-uploader .uploaded .uploaded-image .delete-image i {
		display: block;
		color: #fff;
		width: 1.4rem;
		height: 1.4rem;
		font-size: 1.4rem;
		line-height: 1.4rem
	}

	@media screen and (max-width: 1366px) {
		.image-uploader .uploaded .uploaded-image {
			width: 100%;
			/*padding-bottom: calc(20% - 1rem)*/
		}
	}

	@media screen and (max-width: 992px) {
		.image-uploader .uploaded {
			padding: .4rem
		}

		.image-uploader .uploaded .uploaded-image {
			width: calc(25% - .8rem);
			/*padding-bottom: calc(25% - .4rem);*/
			margin: .4rem
		}
	}

	@media screen and (max-width: 786px) {
		.image-uploader .uploaded {
			padding: .3rem
		}

		.image-uploader .uploaded .uploaded-image {
			width: 100%;
			/*padding-bottom: calc(33.3333333333% - .3rem);*/
			/*margin: .3rem*/
		}
	}

	@media screen and (max-width: 450px) {
		.image-uploader .uploaded {
			padding: .2rem
		}

		.image-uploader .uploaded .uploaded-image {
			width: calc(50% - .4rem);
			/*padding-bottom: calc(50% - .4rem);*/
			margin: .2rem
		}
	}

</style>


<script type="text/javascript">
	$(document).ready(function () {
		for (var i = 1; i < 11; i++) {
			$('.input-images' + i).imageUploader({
				imagesInputName: 'files',
				preloadedInputName: 'preloaded',
				label: 'Image ' + i,
				extensions: ['.jpg', '.jpeg', '.png'],
				mimes: ['image/jpeg', 'image/png', 'image/jpg'],
				maxFiles: 1,
			});
		}
	});
	$(function () {
		$("#postingTitle").on('keyup', function () {
			var maxChars = 80;
			if ($(this).val().length > maxChars) {
				$(this).val($(this).val().substr(0, maxChars));
				alert("This field can take a maximum of 80 characters");
			}
		});

		$("#postingSubTitle").on('keyup', function () {
			var maxChars = 55;
			if ($(this).val().length > maxChars) {
				$(this).val($(this).val().substr(0, maxChars));
				alert("This field can take a maximum of 55 characters");
			}
		});

		function formatCustom(data) {
			var year = data.year;
			if (year == 'N/A') {
				return data.text;
			} else {
				return data.text + ' (' + year + ')';
			}
		}

		function selection(data) {
			var year = data.year;
			if (year == 'N/A') {
				return data.text;
			} else {
				return data.text + ' (' + year + ')';
			}
		}

		$(".select2").select2({
			templateResult: formatCustom,
			templateSelection: selection,
			ajax: {
				url: '<?= items_url("get_Titles") ?>',
				dataType: 'json',
				type: "POST",
				quietMillis: 50,
				data: function (params) {
					// console.log(params);
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				}
			}
		}).on('select2:select', function (event) {
			$('.title').show();
			var data = event.params.data;
			var genre = $.parseJSON(data.genre);

			$('#poster').attr('src', data.poster);
			$('.details').html('<p><b>Title: </b>' + data.text + '<br>' +
					'<b>Year: </b>' + data.year + '<br>' +
					'<b>Director(s): </b>' + data.director + '<br>' +
					'<b>Writer(s): </b>' + data.writer + '<br>' +
					'<b>Actors: </b>' + data.actors + '<br>' +
					'<b>Rated: </b>' + data.rated + ' | <b>Released Date: </b>' + data.released + ' | <b>Runtime: </b>' + data.runtime + '<br>' +
					'<b>Language: </b>' + data.language + ' | <b>Country: </b>' + data.country + '<br>' +
					'<b>Type: </b>' + data.type + ' | <b>Awards: </b>' + data.awards + '<br>' +
					'<b>Genre: </b>' + genre + ' <br>' +
					'<b>Production: </b>' + data.production + '</p>');
		});
	});
</script>
