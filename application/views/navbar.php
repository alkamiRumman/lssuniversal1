<body class="skin-black-light layout-top-nav" data-new-gr-c-s-check-loaded="14.1193.0" data-gr-ext-installed=""
	  style="height: auto; min-height: 100%;">
<div class="wrapper" style="height: auto; min-height: 100%;">
	<header class="main-header">
		<nav class="navbar navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand"><b><?= COMPANY ?></a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
							data-target="#navbar-collapse" aria-expanded="false">
						<i class="fa fa-bars"></i>
					</button>
				</div>

				<div class="navbar-collapse pull-left collapse" id="navbar-collapse" aria-expanded="false"
					 style="height: 1px;">
					<ul class="nav navbar-nav">
						<?php if (isAdmin()) { ?>
							<li class="<?= $this->uri->segment(2) == 'index' ? 'active' : '' ?>">
								<a href="<?= admin_url('index') ?>"><i class="fa fa-dashboard"></i>
									<span>Dashboard</span>
								</a>
							</li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									Team Members <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li class="<?= $this->uri->segment(2) == 'customers' ? 'active' : '' ?>"><a
												href="<?= admin_url('customers') ?>"><i
													class="fa fa-user-circle"></i> Team Members</a></li>
									<li class="<?= $this->uri->segment(2) == 'project' ? 'active' : '' ?>"><a
												href="<?= admin_url('project') ?>"><i
													class="fa fa-product-hunt"></i> Project </a></li>
								</ul>
							</li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									Production Center <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li class="<?= $this->uri->segment(2) == 'add' ? 'active' : '' ?>"><a
												href="<?= admin_url('add') ?>"><i
													class="fa fa-plus"></i> Add Production</a></li>
									<li class="<?= $this->uri->segment(2) == 'productions' ? 'active' : '' ?>"><a
												href="<?= admin_url('productions') ?>"><i
													class="fa fa-tasks"></i> View Productions</a></li>
									<li class="<?= $this->uri->segment(2) == 'runOfShow' ? 'active' : '' ?>"><a
												href="<?= admin_url('runOfShow') ?>"><i
													class="fa fa-video-camera"></i> Run of Show</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									Vendor Network <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li class="<?= $this->uri->segment(2) == 'vendors' ? 'active' : '' ?>">
										<a href="<?= admin_url('vendors') ?>"><i
													class="fa fa-user-secret"></i> Vendors </a>
									</li>
									<li class="<?= $this->uri->segment(2) == 'vendorInvoice' ? 'active' : '' ?>">
										<a href="<?= admin_url('vendorInvoice') ?>"><i
													class="fa fa-money"></i> Vendor Invoice </a>
									</li>
								</ul>
							</li>
							<li class="<?= $this->uri->segment(2) == 'venues' ? 'active' : '' ?>">
								<a href="<?= admin_url('venues') ?>"><i
											class="fa fa-map-marker"></i> <span>House of Venues</span></a>
							</li>
						<?php } else if (isCustomer()) { ?>
							<li class="<?= $this->uri->segment(2) == 'index' ? 'active' : '' ?>">
								<a href="<?= customer_url('index') ?>"><i class="fa fa-dashboard"></i>
									<span>Dashboard</span> </a>
							</li>
							<li class="<?= $this->uri->segment(2) == 'customers' ? 'active' : '' ?>">
								<a href="<?= customer_url('customers') ?>"><i
											class="fa fa-user-circle"></i> <span>Team Members</span></a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									Production Center <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li class="<?= $this->uri->segment(2) == 'add' ? 'active' : '' ?>"><a
												href="<?= customer_url('add') ?>"><i
													class="fa fa-plus"></i> Add Production</a></li>
									<li class="<?= $this->uri->segment(2) == 'productions' ? 'active' : '' ?>"><a
												href="<?= customer_url('productions') ?>"><i
													class="fa fa-tasks"></i> View Productions</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									Vendor Network <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li class="<?= $this->uri->segment(2) == 'vendors' ? 'active' : '' ?>">
										<a href="<?= customer_url('vendors') ?>"><i
													class="fa fa-user-secret"></i> Vendors </a>
									</li>
									<li class="<?= $this->uri->segment(2) == 'vendorInvoice' ? 'active' : '' ?>">
										<a href="<?= customer_url('vendorInvoice') ?>"><i
													class="fa fa-money"></i> Vendor Invoice </a>
									</li>
								</ul>
							</li>
							<li class="<?= $this->uri->segment(2) == 'venues' ? 'active' : '' ?>">
								<a href="<?= customer_url('venues') ?>"><i
											class="fa fa-map-marker"></i> <span>House of Venues</span></a>
							</li>
						<?php } else if (isVendor()) { ?>
							<li class="<?= $this->uri->segment(2) == 'index' ? 'active' : '' ?>">
								<a href="<?= vendor_url('index') ?>"><i class="fa fa-dashboard"></i>
									<span>Welcome</span> </a>
							</li>
							<li class="<?= $this->uri->segment(2) == 'updateProfile' ? 'active' : '' ?>">
								<a href="<?= vendor_url('updateProfile') ?>"><i
											class="fa fa-user"></i> Update Profile </a>
							</li>
							<li class="<?= $this->uri->segment(2) == 'addVendorInvoice' ? 'active' : '' ?>">
								<a href="<?= vendor_url('addVendorInvoice') ?>"><i
											class="fa fa-plus"></i> Submit Invoice </a>
							</li>
							<li class="<?= $this->uri->segment(2) == 'vendorInvoice' ? 'active' : '' ?>">
								<a href="<?= vendor_url('vendorInvoice') ?>"><i
											class="fa fa-bars"></i> Vendor Invoice </a>
							</li>
						<?php } ?>
						<li>
							<a href="<?= login_url('logout') ?>"><i
										class="fa fa-power-off"></i> <span>Sign out</span></a>
						</li>
					</ul>
				</div>


				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<img src="<?= getSession()->profilePicture ? base_url('images/' . getSession()->id . '/' . getSession()->profilePicture)
										: base_url('assets/adminLte/dist/img/noImage.png') ?>" class="user-image"
									 alt="User Image">
								<span class="hidden-xs"><?= getSession()->name ?></span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-header">
									<img src="<?= getSession()->profilePicture ? base_url('images/' . getSession()->id . '/' . getSession()->profilePicture)
											: base_url('assets/adminLte/dist/img/noImage.png') ?>" class="img-circle"
										 alt="User Image">
									<p>
										<?= getSession()->name ?>
										<small>Joined Since
											- <?= date('d F Y', strtotime(getSession()->createAt)) ?></small>
									</p>
								</li>
								<li class="user-footer">
									<div class="pull-left">
										<a onclick="loadPopup('<?= login_url('profile') ?>')"
										   class="btn btn-default btn-flat">Profile</a>
									</div>
									<div class="pull-right">
										<a href="<?= login_url('logout') ?>" class="btn btn-default btn-flat">Sign
											out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>

			</div>

		</nav>
	</header>
	<div class="content-wrapper" style="min-height: 743px;">
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box">
						<div class="box-body" style="background: black">
							<div class="row">
								<div class="col-md-12 text-center">
									<img class="responsive-img" src="<?= base_url('images/3.png') ?>" alt="User Image">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
