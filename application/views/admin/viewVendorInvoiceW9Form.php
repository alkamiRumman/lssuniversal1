<div class="modal fade in" id="myModal" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
				<h4 class="modal-title"><b>W9 Form</b></h4>
			</div>
			<div class="modal-body" id="printThis">
				<div class="row">
					<div class="col-xs-12 text-center">
						<?php if ($data->w9Form != '') { ?>
						<iframe src="<?= base_url('images/' . $data->id . '/w9Form' . '/' . $data->w9Form) ?>"
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
