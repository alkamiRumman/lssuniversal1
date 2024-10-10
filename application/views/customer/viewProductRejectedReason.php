<div class="modal fade in" id="modal-default" style="display: block; overflow: auto;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header custom-modal-header">
				<h4 class="modal-title"><b>Production Rejected Reason</b></h4>
				<button type="button" class="btn btn-danger close-btn" data-dismiss="modal" aria-label="Close">Close</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<label for="rejectedReason" class="form-label">Rejected Reason </label>
						<textarea class="form-control rejected-reason" name="rejectedReason" id="rejectedReason"
								  rows="12" readonly><?= $data->rejectedReason ?></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	/* Modal Header Styles */
	.custom-modal-header {
		background-color: #f7f7f7; /* Light grey background */
		border-bottom: 1px solid #ddd; /* Subtle bottom border */
		padding: 15px 20px; /* Space around content */
		position: relative;
	}

	/* Modal Title Styles */
	.modal-title {
		font-size: 18px;
		font-weight: 600;
		color: #333; /* Dark grey text */
		margin: 0; /* Remove default margin */
		line-height: 1.5;
	}

	/* Close Button Styles */
	.close-btn {
		position: absolute; /* Position to top right corner */
		right: 15px;
		top: 10px;
		padding: 6px 12px;
		background-color: #dc3545; /* Bootstrap danger color */
		border: none; /* Remove border */
		border-radius: 4px; /* Rounded corners */
		color: #fff; /* White text */
		cursor: pointer; /* Pointer cursor on hover */
		font-size: 14px;
		transition: background-color 0.3s ease; /* Smooth hover effect */
	}

	.close-btn:hover {
		background-color: #c82333; /* Darker shade on hover */
	}

	/* Label Styles */
	.form-label {
		font-size: 16px;
		color: #555; /* Medium grey text */
		font-weight: 500; /* Semi-bold text */
		margin-bottom: 8px; /* Space below label */
		display: block; /* Block display for label */
	}

	/* Textarea Styles */
	.rejected-reason {
		background-color: #f8f9fa; /* Light background */
		border: 1px solid #ced4da; /* Light grey border */
		border-radius: 4px; /* Rounded corners */
		padding: 12px; /* Inner padding for readability */
		font-size: 14px; /* Font size */
		color: #333; /* Dark text */
		resize: none; /* Disable resizing */
		box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1); /* Subtle inset shadow */
	}

	/* Responsive Design */
	@media (max-width: 768px) {
		.modal-dialog {
			width: 90%; /* Width reduced for smaller screens */
			margin: 30px auto; /* Centered with margin */
		}
	}

</style>
