<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

	<header class="main-header">
		<!-- Logo -->
		<a href="<?= dashboard_url('index') ?>" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
<!--			<span class="logo-mini"><b>--><?//= SHORTNAME ?><!--</b></span>-->
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><b>Admin </b><?= SHORTNAME ?></span>
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top">
			<!-- Sidebar toggle button-->
<!--			<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">-->
<!--				<span class="sr-only">Toggle navigation</span>-->
<!--			</a>-->

			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li class="float-left">
						<a href="<?= dashboard_url('index') ?>"><i class="fa fa-dashboard"></i> Dashboard </a>
					</li>
					<li class="float-left">
						<a href="<?= titles_url('index') ?>"><i class="fa fa-list"></i> Title List </a>
					</li>
					<li>
						<a href="<?= titles_url('add') ?>"><i class="fa fa-plus-square"></i> Add Title </a>
					</li>
					<li>
						<a href="<?= items_url('index') ?>"><i class="fa fa-list"></i> Item List </a>
					</li>
					<li>
						<a href="<?= items_url('add') ?>"><i class="fa fa-plus-square"></i> Add Item </a>
					</li>
					<li>
						<a href="<?= login_url('logout') ?>"><i class="fa fa-power-off"></i> Sign out</a>
					</li>
					<li class="dropdown messages-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?= COMPANY ?>
						</a>
					</li>

<!--					<li class="dropdown user user-menu">-->
<!--						<a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--							<img src="--><?//= base_url('assets/adminLte/dist/img/noImage.png') ?><!--" class="user-image"-->
<!--								 alt="User Image">-->
<!--							<span class="hidden-xs">Steven Davis</span>-->
<!--						</a>-->
<!--						<ul class="dropdown-menu">-->
<!--							<li class="user-header">-->
<!--								<img src="--><?//= base_url('assets/adminLte/dist/img/noImage.png') ?><!--" class="img-circle"-->
<!--									 alt="User Image">-->
<!--								<p>-->
<!--									Steven Davis - Owner-->
<!--									<small>Last Update - April 12, 2020</small>-->
<!--								</p>-->
<!--							</li>-->
<!--							<li class="user-footer">-->
<!--								<div class="pull-left">-->
<!--									<a href="#" class="btn btn-default btn-flat">Profile</a>-->
<!--								</div>-->
<!--								<div class="pull-right">-->
<!--									<a href="--><?//= login_url('logout') ?><!--" class="btn btn-default btn-flat">Sign out</a>-->
<!--								</div>-->
<!--							</li>-->
<!--						</ul>-->
<!--					</li>-->
				</ul>
			</div>
		</nav>
	</header>
</div>
<!-- Left side column. contains the logo and sidebar -->


<!-- Content Wrapper. Contains page content -->
<!--<div class="content-wrapper">-->
<section class="content">
	<?php
		if ($this->session->flashdata('success')) {
			?>
			<div class="text-center alert alert-success" role="alert">
				<p style="font-size: 20px">
					<?php echo $this->session->flashdata('success'); ?></p>
			</div>
			<?php
		}
		if ($this->session->flashdata('danger')) {
			?>
			<div class="alert alert-danger text-center" role="alert">
				<p style="font-size: 20px">
					<?php echo $this->session->flashdata('danger'); ?></p>
			</div>
		<?php } ?>

	<script>
		$(function () {
			var url = window.location;
			$('.treeview-menu li a[href="' + url + '"]').parent().addClass('active');
			$('.treeview-menu li a').filter(function () {
				return this.href == url;
			}).parent().parent().parent().addClass('active', 'text-danger');
		});
	</script>




