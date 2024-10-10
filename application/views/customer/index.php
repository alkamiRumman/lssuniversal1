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
	<div class="col-md-6">
		<div class="box box-success">
			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<a href="<?= customer_url('productions') ?>">
							<div class="stat-box bg-black-gradient">
								<div class="inner">
									<h3><?= $totalCompleteProduction ?></h3>
									<p>Total Completed Productions</p>
								</div>
								<div class="icon">
									<i class="fa fa-tasks"></i>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-6">
						<a href="<?= customer_url('productions') ?>">
							<div class="stat-box bg-blue-gradient">
								<div class="inner">
									<h3><?= $totalIncompleteProduction ?></h3>
									<p>Total In-Progress Productions</p>
								</div>
								<div class="icon">
									<i class="fa fa-tasks"></i>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="box box-info">
			<div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<a href="<?= customer_url('vendorInvoice') ?>">
							<div class="stat-box bg-gray-active">
								<div class="inner">
									<h3><?= $totalInvoices ?></h3>
									<p>Total Invoices</p>
								</div>
								<div class="icon">
									<i class="fa fa-file-text"></i>
								</div>
							</div>
						</a>
					</div>
					<!-- Unpaid Invoices -->
					<div class="col-md-3">
						<a href="<?= customer_url('vendorInvoice') ?>">
							<div class="stat-box bg-warning">
								<div class="inner">
									<h3><?= $totalUnpaidInvoices ?></h3>
									<p>Unpaid Invoices</p>
								</div>
								<div class="icon">
									<i class="fa fa-hourglass"></i>
								</div>
							</div>
						</a>
					</div>
					<!-- Paid Invoices -->
					<div class="col-md-3">
						<a href="<?= customer_url('vendorInvoice') ?>">
							<div class="stat-box bg-success">
								<div class="inner">
									<h3><?= $totalPaidInvoices ?></h3>
									<p>Paid Invoices</p>
								</div>
								<div class="icon">
									<i class="fa fa-check"></i>
								</div>
							</div>
						</a>
					</div>
					<!-- Rejected Invoices -->
					<div class="col-md-3">
						<a href="<?= customer_url('vendorInvoice') ?>">
							<div class="stat-box bg-danger">
								<div class="inner">
									<h3><?= $totalRejectedInvoices ?></h3>
									<p>Rejected Invoices</p>
								</div>
								<div class="icon">
									<i class="fa fa-times-circle"></i>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Complete vs In-progress Chart</h3>
			</div>
			<div class="box-body">
				<div class="chartSpace">
					<canvas id="chartContainer" style="height: 400px; width: 100%;"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
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
		font-size: 38px;
		margin: 0;
		font-weight: 700;
	}

	.stat-box p {
		font-size: 15px;
		margin: 5px 0 0;
	}

	.stat-box .icon {
		position: absolute;
		top: 20px;
		right: 20px;
		font-size: 35px;
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

	.bg-gray {
		background-color: #17A2B8 !important;
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

	/* Responsive Design */
	@media (max-width: 768px) {
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
<script>
	$(function () {
		var cData = JSON.parse(`<?php echo $data1; ?>`);
		var ctx = document.getElementById("chartContainer");
		var options = {
			scales: {
				xAxes: [{
					barPercentage: 1.0
				}],
				yAxes: [{
					ticks: {
						beginAtZero: true,
						aspectRatio: false
					}
				}]
			},
			gridLines: {
				display: true
			},
			responsive: true,
			title: {
				display: false,
			},
			legend: {
				display: false,
			},
			plugins: {
				colorschemes: {
					scheme: 'brewer.Paired12'
				}
			}
		};
		var dataPie = {
			labels: ['Complete', 'In-progress'],
			datasets: [
				{
					label: 'Total',
					data: [cData.totalComplete, cData.totalIncomplete],
					backgroundColor: [
						'#212121',
						'#0081CE',
					],
					hoverBackgroundColor: [
						'#3D3D3D',
						'#0099E5',
					],
					hoverOffset: 4
				}
			]
		}
		var chart2 = new Chart(ctx, {
			type: "pie",
			data: dataPie,
			options: {
				responsive: true,
				title: {
					display: false,
				}
			}
		});
	});
</script>
