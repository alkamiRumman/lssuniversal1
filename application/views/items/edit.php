<div class="modal fade in" id="modal-default" style="display: block;overflow: auto; padding-left: 25px;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
				<h4 class="modal-title"><b>Update Item</b></h4>
			</div>
			<div class="modal-body">
				<form role="form" action="<?= items_url('update/' . $items->id) ?>" method="post"
					  enctype="multipart/form-data">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="titleId"> Movie Title </label>
							<input class="form-control" value="<?= $items->title ?>" id="titleId" readonly>
							<input type="hidden" class="form-control" value="<?= $items->titleId ?>" name="titleId">
						</div>
						<div class="form-group col-md-12">
							<label for="postingTitle">Posting Title </label>
							<input class="form-control" type="text" name="postingTitle" id="postingTitle"
								   value="<?= $items->postingTitle ?>">
						</div>
						<div class="form-group col-md-12">
							<label for="postingSubTitle">Posting Sub-Title </label>
							<input class="form-control" type="text" name="postingSubTitle" id="postingSubTitle"
								   value="<?= $items->postingSubTitle ?>">
						</div>
						<div class="form-group col-md-3">
							<label for="format">Format</label>
							<input class="form-control" type="text" name="format" id="format"
								   value="<?= $items->format ?>" required>
						</div>
						<div class="form-group col-md-3">
							<label for="dimensions">Dimensions</label>
							<input class="form-control" type="text" name="dimensions" id="dimensions"
								   value="<?= $items->dimensions ?>">
						</div>
						<div class="form-group col-md-3">
							<label for="quantity">Quantity</label>
							<input class="form-control" type="text" name="quantity" id="quantity" required
								   value="<?= $items->quantity ?>">
						</div>
						<div class="form-group col-md-3">
							<label for="nationality">Nationality</label>
							<input class="form-control" type="text" name="nationality" id="nationality"
								   value="<?= $items->nationality ?>">
						</div>
						<div class="form-group col-md-3">
							<label for="lowValue">Low Value</label>
							<input class="form-control" type="text" name="lowValue" id="lowValue"
								   value="<?= $items->lowValue ?>">
						</div>
						<div class="form-group col-md-3">
							<label for="highValue">High Value</label>
							<input class="form-control" type="text" name="highValue" id="highValue"
								   value="<?= $items->highValue ?>">
						</div>
						<div class="form-group col-md-3">
							<label for="source">Source</label>
							<input class="form-control" type="text" name="source" id="source"
								   value="<?= $items->source ?>">
						</div>
						<div class="form-group col-md-3">
							<label for="location">Location</label>
							<input class="form-control" type="text" name="location" id="location"
								   value="<?= $items->location ?>">
						</div>
						<div class="form-group col-md-12">
							<label for="description">Product Description</label>
							<textarea class="form-control" rows="4" name="description"
									  id="description"><?= $items->description ?></textarea>
						</div>
						<div class="form-group col-md-12">
							<label for="conditions">Condition</label>
							<textarea class="form-control" rows="3" name="conditions"
									  id="conditions"><?= $items->conditions ?></textarea>
						</div>
						<div class="form-group col-md-12">
							<label for="overallCondition">Overall Condition</label>
							<textarea class="form-control" rows="3" name="overallCondition" id="overallCondition"><?= $items->overallCondition ?></textarea>
						</div>
						<div class="form-group col-md-12">
							<label for="oldTitle">Old Title</label>
							<input class="form-control" type="text" name="oldTitle" id="oldTitle"
								   value="<?= $items->oldTitle ?>">
						</div>
						<div class="form-group col-md-12">
							<label for="oldComments">Old Comments</label>
							<textarea class="form-control" rows="3" name="oldComments"
									  id="oldComments"><?= $items->oldComments ?></textarea>
						</div>
						<div class="form-group col-md-6">
							<label for="oldFormat">Old Format</label>
							<input class="form-control" type="text" name="oldFormat" id="oldFormat"
								   value="<?= $items->oldFormat ?>">
						</div>
						<div class="form-group col-md-6">
							<label for="oldYear">Old Year</label>
							<input class="form-control" type="text" name="oldYear" id="oldYear"
								   value="<?= $items->oldYear ?>">
						</div>
						<div class="form-group col-md-6">
							<label for="eBayCategory">eBay Category</label>
							<input class="form-control" type="text" name="eBayCategory" id="eBayCategory"
								   value="<?= $items->eBayCategory ?>">
						</div>
						<div class="form-group col-md-6">
							<label for="status"> Status </label>
							<select class="form-control" name="status" id="status">
								<option value="">Select One</option>
								<option <?= $items->status == 'Images Scanned' ? 'selected' : '' ?> value="Images Scanned">
									Images Scanned
								</option>
								<option <?= $items->status == 'Description Prepared' ? 'selected' : '' ?> value="Description Prepared">
									Description Prepared
								</option>
								<option <?= $items->status == 'Ready to post' ? 'selected' : '' ?> value="Ready to post">
									Ready to post
								</option>
								<option <?= $items->status == 'Sold' ? 'selected' : '' ?> value="Sold">
									Sold
								</option>
								<option <?= $items->status == 'Do not sell' ? 'selected' : '' ?> value="Do not sell">
									Do not sell
								</option>
							</select>
						</div>
						<div class="form-group col-md-12">
							<label for="oldNotes">Old Notes</label>
							<textarea class="form-control" rows="3" name="oldComments"
									  id="oldComments"><?= $items->oldNotes ?></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" style="padding-bottom: 9px">
							<input type="hidden" id="image1" name="image1"
								   value="<?= $items->image1 ? base_url('images/' . $items->image1) : '' ?>">
							<div class="input-field1">
								<div class="input-images1"></div>
							</div>
						</div>
						<div class="col-md-12" style="padding-bottom: 9px">
							<input type="hidden" id="image2" name="image2"
								   value="<?= $items->image2 ? base_url('images/' . $items->image2) : '' ?>">
							<div class="input-field2">
								<div class="input-images2"></div>
							</div>
						</div>
						<div class="col-md-12" style="padding-bottom: 9px">
							<input type="hidden" id="image3" name="image3"
								   value="<?= $items->image3 ? base_url('images/' . $items->image3) : '' ?>">
							<div class="input-field3">
								<div class="input-images3"></div>
							</div>
						</div>
						<div class="col-md-12" style="padding-bottom: 9px">
							<input type="hidden" id="image4" name="image4"
								   value="<?= $items->image4 ? base_url('images/' . $items->image4) :
										   '' ?>">
							<div class="input-field4">
								<div class="input-images4"></div>
							</div>
						</div>
						<div class="col-md-12" style="padding-bottom: 9px">
							<input type="hidden" id="image5" name="image5"
								   value="<?= $items->image5 ? base_url('images/' . $items->image5) :
										   '' ?>">
							<div class="input-field5">
								<div class="input-images5"></div>
							</div>
						</div>
						<div class="col-md-12" style="padding-bottom: 9px">
							<input type="hidden" id="image6" name="image6"
								   value="<?= $items->image6 ? base_url('images/' . $items->image6) :
										   '' ?>">
							<div class="input-field6">
								<div class="input-images6"></div>
							</div>
						</div>
						<div class="col-md-12" style="padding-bottom: 9px">
							<input type="hidden" id="image7" name="image7"
								   value="<?= $items->image7 ? base_url('images/' . $items->image7) :
										   '' ?>">
							<div class="input-field7">
								<div class="input-images7"></div>
							</div>
						</div>
						<div class="col-md-12" style="padding-bottom: 9px">
							<input type="hidden" id="image8" name="image8"
								   value="<?= $items->image8 ? base_url('images/' . $items->image8) :
										   '' ?>">
							<div class="input-field8">
								<div class="input-images8"></div>
							</div>
						</div>
						<div class="col-md-12" style="padding-bottom: 9px">
							<input type="hidden" id="image9" name="image9"
								   value="<?= $items->image9 ? base_url('images/' . $items->image9) :
										   '' ?>">
							<div class="input-field9">
								<div class="input-images9"></div>
							</div>
						</div>
						<div class="col-md-12" style="padding-bottom: 9px">
							<input type="hidden" id="image10" name="image10"
								   value="<?= $items->image10 ? base_url('images/' . $items->image10) :
										   '' ?>">
							<div class="input-field10">
								<div class="input-images10"></div>
							</div>
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

<style>
	.iui-close:before {
		content: "\e900"
	}

	.iui-cloud-upload:before {
		content: "\e901"
	}

	.image-uploader {
		min-height: 32rem;
		border: 2px dashed grey;
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

	.image-uploader .uploaded .uploaded-image {
		display: block;
		margin-left: auto;
		margin-right: auto;
	}

	.image-uploader .uploaded .uploaded-image img {
		/*width: 100%;*/
		height: 500px;
		/*object-fit: cover;*/
		/*position: absolute*/
	}

	.image-uploader .uploaded .uploaded-image .delete-image {
		display: none;
		cursor: pointer;
		position: absolute;
		top: .7rem;
		right: 3.2rem;
		border-radius: 50%;
		padding: .3rem;
		line-height: 1;
		background-color: rgba(0, 0, 0, .5);
		-webkit-appearance: none;
		border: none;
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
			width: calc(100% - 1rem);
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
			/*width: 100%;*/
			/*padding-bottom: calc(100% - .3rem);*/
			/*margin: .3rem*/
		}
	}

	@media screen and (max-width: 450px) {
		.image-uploader .uploaded {
			padding: .2rem
		}

		.image-uploader .uploaded .uploaded-image {
			width: calc(50% - .4rem);
			/*padding-bottom: calc(100% - .4rem);*/
			margin: .2rem
		}
	}

</style>

<script type="text/javascript">
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
	});
	$(document).ready(function () {
		for (var i = 1; i < 11; i++) {
			var path = $('#image' + i).val();
			console.log(path);
			if (path != '') {
				let preloaded = [
					{id: i, src: path}
				];
				$('.input-images' + i).imageUploader({
					imagesInputName: 'files',
					label: 'Image ' + i,
					extensions: ['.jpg', '.jpeg', '.png'],
					mimes: ['image/jpeg', 'image/png', 'image/jpg'],
					maxFiles: 1,
					preloaded: preloaded
				});
			} else {
				$('.input-images' + i).imageUploader({
					imagesInputName: 'files',
					label: 'Image ' + i,
					extensions: ['.jpg', '.jpeg', '.png'],
					mimes: ['image/jpeg', 'image/png', 'image/jpg'],
					maxFiles: 1,
				});
			}
		}
	});

</script>
