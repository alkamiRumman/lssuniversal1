<div class="modal fade in" id="myModal" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
				<h4 class="modal-title"><b>Master Service Agreement</b></h4>
			</div>
			<div class="modal-body" id="printThis">
				<div class="row">
					<div class="col-xs-12 text-center">
						<?php if ($data->msa != '') { ?>
						<iframe src="<?= base_url('images/' . $data->vendorId . '/' . $data->productionId . '/' . $data->msa) ?>"
								width="100%" height="800">
							<?php } else { ?>
								<pre class="text-center text-danger">No file found!!</pre>
							<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>