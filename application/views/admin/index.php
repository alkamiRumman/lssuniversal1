<!--<pre>Please don't share anything regarding this conversation in fiverr. If you are agree with me then contact my whatsapp +8801521430459 otherwise please ignore it. But please don't talk anything related with this in fiverr.</pre>-->
<!--<pre>Just want to know, is there any way for you to make the payment outside from the fiverr? so far i know fiverr charges extra from both you and me. I need to pay 20% from the total order amount to them.-->
<!--So it will be better for me if you can make payment outside of fiverr.</pre>-->

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
					<div class="col-md-3">
						<a href="<?= admin_url('customers') ?>">
							<div class="stat-box bg-gray-active">
								<div class="inner">
									<h3><?= $totalUser ?></h3>
									<p>Team Members</p>
								</div>
								<div class="icon">
									<i class="fa fa-user"></i>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-3">
						<a href="<?= admin_url('vendors') ?>">
							<div class="stat-box bg-gray">
								<div class="inner">
									<h3><?= $totalVendor ?></h3>
									<p>Vendors</p>
								</div>
								<div class="icon">
									<i class="fa fa-user-secret"></i>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-3">
						<a href="<?= admin_url('productions') ?>">
							<div class="stat-box bg-black-gradient">
								<div class="inner">
									<h3><?= $totalCompleteProduction ?></h3>
									<p>Completed Productions</p>
								</div>
								<div class="icon">
									<i class="fa fa-tasks"></i>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-3">
						<a href="<?= admin_url('productions') ?>">
							<div class="stat-box bg-blue-gradient">
								<div class="inner">
									<h3><?= $totalIncompleteProduction ?></h3>
									<p>In-Progress Productions</p>
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
	</div>
	<div class="col-md-6">
		<div class="box box-info">
			<div class="box-body">
				<div class="row">
					<!-- Invoices -->
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
					<!-- Unpaid Invoices -->
					<div class="col-md-3">
						<div class="stat-box bg-warning">
							<div class="inner">
								<h3><?= $totalUnpaidInvoices ?></h3>
								<p>Unpaid Invoices</p>
							</div>
							<div class="icon">
								<i class="fa fa-hourglass"></i>
							</div>
						</div>
					</div>
					<!-- Paid Invoices -->
					<div class="col-md-3">
						<div class="stat-box bg-success">
							<div class="inner">
								<h3><?= $totalPaidInvoices ?></h3>
								<p>Paid Invoices</p>
							</div>
							<div class="icon">
								<i class="fa fa-check"></i>
							</div>
						</div>
					</div>
					<!-- Rejected Invoices -->
					<div class="col-md-3">
						<div class="stat-box bg-danger">
							<div class="inner">
								<h3><?= $totalRejectedInvoices ?></h3>
								<p>Rejected Invoices</p>
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
		<div class="box box-primary">
			<div class="row">
				<div class="col-md-12">
					<div class="chartSpace">
						<canvas id="chartContainer" style="height: 400px; width: 100%;"></canvas>
					</div>
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
		var chart = new Chart(ctx, {
			type: "bar",
			options: {
				responsive: true,
				maintainAspectRatio: false,
				scales: {
					xAxes: [{
						barPercentage: 1.0
					}],
					yAxes: [{
						ticks: {
							beginAtZero: true,
							stepSize: 1,
							callback: function (value) {
								return value
							}
						}
					}]
				},
				gridLines: {
					display: true
				},
				responsive: true,
				legend: {
					display: true,
				},
				title: {
					display: true,
					position: "top",
					text: "Production By Team Members",
					fontSize: 18,
					fontColor: "#111"
				},
			},
			data: {
				labels: cData.label,
				datasets: [
					{
						type: "bar",
						backgroundColor: '#212121',
						borderWidth: 1,
						barThickness: 1,
						label: "Complete",
						data: cData.totalComplete
					},
					{
						type: "bar",
						backgroundColor: '#0081CE',
						borderWidth: 1,
						barThickness: 1,
						label: "In-progress",
						data: cData.totalIncomplete
					}
				]
			}
		});
	});
</script>
