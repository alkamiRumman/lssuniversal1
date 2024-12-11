<div class="modal fade" id="remoteModal1" role="dialog" aria-hidden="true" data-backdrop="static"
	 data-keyboard="false" style="z-index: 999999"></div>
<div class="modal fade" id="remoteModal2" role="dialog" aria-hidden="true" data-backdrop="static"
	 data-keyboard="false" style="z-index: 999999"></div>
</section>
<div id="loadingSpinner" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.8); z-index: 9999; display: flex; justify-content: center; align-items: center;">
	<i class="fa fa-spinner fa-spin" style="font-size: 80px; color: black;"></i>
</div>
</body>
</html>

<script src="<?= base_url('assets/adminLte/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/datatables.net/js/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/datatable/js/tables/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/datatables.net-bs/js/buttons.colVis.min.js') ?>"></script>
<script src="<?= base_url('assets/datatable/js/tables/jquery.dataTables.yadcf.js') ?>"></script>
<!--<script src="--><? //= base_url('assets/adminLte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?><!--"></script>-->
<script src="<?= base_url('assets/adminLte/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/moment/min/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/bower_components/fastclick/lib/fastclick.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/dist/js/adminlte.min.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/dist/js/demo.js') ?>"></script>
<script src="<?= base_url('assets/adminLte/dist/js/select.min.js') ?>"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"/>
<script type="text/javascript"
		src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
</body>
</html>
<style>
	#loadingSpinner {
		opacity: 1;
		transition: opacity 0.5s ease;
	}

	#loadingSpinner.hidden {
		opacity: 0;
		pointer-events: none; /* Ensures it doesn't block interactions after hiding */
	}

	.box {
		background: #f9f9f9;
		border-radius: 8px;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		/*padding: 20px;*/
	}

	.active a {
		color: black !important;
		background-color: #D5D7DD !important;
		font-weight: bold;
		border-radius: 5px;
	}

	.responsive-img {
		height: 200px; /* Fixed height on larger screens */
		width: auto; /* Maintain aspect ratio */
		max-width: 100%; /* Ensures image doesn't overflow container */
		object-fit: cover; /* Ensures image covers area while maintaining aspect ratio */
		display: inline-block; /* Centers image */
	}

	@media (max-width: 768px) {
		.responsive-img {
			height: auto; /* Responsive height on smaller screens */
			width: 100%; /* Full width on smaller screens */
		}
	}
</style>
<script>
	window.addEventListener('load', function() {
		document.getElementById('loadingSpinner').style.display = 'none';
	});

	window.addEventListener('load', function() {
		document.getElementById('loadingSpinner').classList.add('hidden');
		setTimeout(function() {
			document.getElementById('loadingSpinner').style.display = 'none';
		}, 500); // Match the transition duration for smooth hiding
	});

	setTimeout(function () {
		$('.alert').hide('fast');
	}, 3000);
	toastr.options = {
		"debug": false,
		"positionClass": "toast-bottom-right",
		"onclick": null,
		"fadeIn": 300,
		"fadeOut": 1000,
		"timeOut": 5000,
		"extendedTimeOut": 1000,
		"closeButton": true,
		"progressBar": true
	}

	<?php if($this->session->flashdata('persistent_success')) { ?>
	toastr.options = {
		"debug": false,
		"positionClass": "toast-bottom-full-width",  // Notification will appear at the top
		"onclick": null,
		"fadeIn": 300,
		"fadeOut": 1000,
		"timeOut": 0,
		"extendedTimeOut": 0,
		"closeButton": true,
		"progressBar": true
	};
	toastr.success("<?php echo $this->session->flashdata('persistent_success'); ?>");
	<?php } else if($this->session->flashdata('success')) { ?>
	toastr.success("<?php echo $this->session->flashdata('success'); ?>");
	<?php }else if($this->session->flashdata('danger')){  ?>
	toastr.error("<?php echo $this->session->flashdata('danger'); ?>");
	<?php }else if($this->session->flashdata('warning')){  ?>
	toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
	<?php }else if($this->session->flashdata('info')){  ?>
	toastr.info("<?php echo $this->session->flashdata('info'); ?>");
	<?php } ?>
	$(function () {
		$('li.dropdown').hover(
			function () {
				// Mouse enter: open the dropdown
				$(this).addClass('open');
			},
			function () {
				// Mouse leave: close the dropdown
				$(this).removeClass('open');
			}
		);
	});
</script>
