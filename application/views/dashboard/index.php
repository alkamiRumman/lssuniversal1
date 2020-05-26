<div class="row">
	<div class="col-md-3">
		<!-- small box -->
		<a href="<?= titles_url('index') ?>">
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3><?= $totalTitles ?></h3>
					<p>Total Titles</p>
				</div>
				<div class="icon">
					<i class="ion ion-android-clipboard"></i>
				</div>
			</div>
		</a>
	</div>

	<!-- ./col -->
	<div class="col-md-3">
		<!-- small box -->
		<a href="<?= items_url('index') ?>">
			<div class="small-box bg-green">
				<div class="inner">
					<h3><?= $totalItems ?></h3>
					<p>Total Items</p>
				</div>
				<div class="icon">
					<i class="ion ion-archive"></i>
				</div>
			</div>
		</a>
	</div>
	<!-- ./col -->
	<div class="col-md-3">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3><?= $todayTotalTitles ?></h3>
				<p>Today's Update Titles</p>
			</div>
			<div class="icon">
				<i class="ion ion-ios-list-outline"></i>
			</div>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<h3><?= $todayTotalItems ?></h3>
				<p>Today's Update Items</p>
			</div>
			<div class="icon">
				<i class="ion ion-grid"></i>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Last 10 Updated Item List</b></h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered serverSide-table dtr-inline"
						   style="width: 100% !important;">
						<thead>
						<tr>
							<th>Thumbnail</th>
							<th>Title</th>
							<th>Format</th>
							<th>Status</th>
							<th>Director(s)</th>
							<th>Actors</th>
							<th>Location</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($lastTen as $item) { ?>
							<tr>
								<td><img width="90" src="<?= $item->image1 != null ? base_url('images/' . $item->image1) :
											base_url('images/noImage.png') ?>"></td>
								<td><?= $item->title ?></td>
								<td><?= $item->format ?></td>
								<td><?= $item->status ?></td>
								<td><?= $item->director ?></td>
								<td><?= $item->actors ?></td>
								<td><?= $item->location ?></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
