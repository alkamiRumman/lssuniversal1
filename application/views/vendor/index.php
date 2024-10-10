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
<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
			<div class="box-body">
				<div class="row">
					<!-- Total Invoices -->
					<div class="col-md-3">
						<div class="stat-box bg-gray-active">
							<div class="inner">
								<h3><?= $totalInvoices ?></h3>
								<p>Total Invoices</p>
							</div>
							<div class="icon">
								<i class="fa fa-file-text"></i>
							</div>
						</div>
					</div>
					<!-- Total Unpaid Invoices -->
					<div class="col-md-3">
						<div class="stat-box bg-warning">
							<div class="inner">
								<h3><?= $totalUnpaidInvoices ?></h3>
								<p>Total Unpaid Invoices</p>
							</div>
							<div class="icon">
								<i class="fa fa-hourglass"></i>
							</div>
						</div>
					</div>
					<!-- Total Paid Invoices -->
					<div class="col-md-3">
						<div class="stat-box bg-success">
							<div class="inner">
								<h3><?= $totalPaidInvoices ?></h3>
								<p>Total Paid Invoices</p>
							</div>
							<div class="icon">
								<i class="fa fa-check"></i>
							</div>
						</div>
					</div>
					<!-- Total Rejected Invoices -->
					<div class="col-md-3">
						<div class="stat-box bg-danger">
							<div class="inner">
								<h3><?= $totalRejectedInvoices ?></h3>
								<p>Total Rejected Invoices</p>
							</div>
							<div class="icon">
								<i class="fa fa-times-circle"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h1 class="box-title">Vendor Network Information</h1>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12" style="font-weight: normal">
						<!-- Introduction Section -->
						<p class="lead" style="color: black;font-family: Arial, Helvetica, sans-serif; font-size: 18px">
							As part of our Vendor Network, you’re among the first to enjoy exclusive opportunities for
							collaboration on our live experiences!
							Your services play a crucial role in helping us create unforgettable moments that celebrate
							diversity and storytelling while fostering cultural unity.
						</p>
						<hr style="border: 1px solid black;">
						<h2 class="text-center" style="font-weight: bold;letter-spacing: 3px">SYSTEM GUIDELINES</h2>
						<div class="text-center">
							<button class="navigationButton form-group btn btn-lg text-uppercase"
									onclick="loadPopup('<?= vendor_url('showDashboard') ?>')"
									style="letter-spacing: 2px; color: white; background-color: black;">
								Navigating the vendor network
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	/* Stat Box Styles */
	.stat-box {
		position: relative;
		background: #f7f7f7;
		border-radius: 8px;
		color: #fff;
		padding: 20px;
		margin-bottom: 20px;
		overflow: hidden;
		text-align: center;
		transition: transform 0.3s ease;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
	}

	.stat-box .inner {
		position: relative;
		z-index: 2;
	}

	.stat-box h3 {
		font-size: 36px;
		margin: 0;
		font-weight: 700;
	}

	.stat-box p {
		font-size: 18px;
		margin: 5px 0 0;
	}

	.stat-box .icon {
		position: absolute;
		top: 20px;
		right: 20px;
		font-size: 50px;
		opacity: 0.3;
		z-index: 1;
		transition: opacity 0.3s ease;
	}

	.stat-box:hover {
		transform: translateY(-5px);
		box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
	}

	.stat-box:hover .icon {
		opacity: 0.6;
	}

	/* Background Color Styles */
	.bg-gray-active {
		background-color: #28a745 !important;
	}

	.bg-warning {
		background-color: #FFA500; /* Use Bootstrap warning color */
	}

	.bg-success {
		background-color: #000000; /* Use Bootstrap success color */
	}

	.bg-danger {
		background-color: #DC3545; /* Use Bootstrap danger color */
	}

	@media (min-width: 1200px) {
		.navigationButton {
			font-size: 25px;
			width: 30%; /* Adjust width for extra large screens */
		}
	}

	/* Responsive Design */
	@media (max-width: 768px) {
		.navigationButton {
			font-size: 15px;
			width: 95%;
		}
		.stat-box h3 {
			font-size: 28px; /* Smaller font size on smaller screens */
		}

		.stat-box p {
			font-size: 16px; /* Smaller font size on smaller screens */
		}

		.stat-box .icon {
			font-size: 40px; /* Smaller icon size on smaller screens */
		}
	}

</style>
