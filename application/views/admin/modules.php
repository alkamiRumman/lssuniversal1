<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Modules</b></h3>
				<a href="javascript:void(0);"
				   onclick="loadPopup('<?= admin_url('addModules') ?>')"
				   class="btn btn-sm btn-info pull-right">Add New</a>
			</div>
			<div class="box-body">
				<div class="row">
					<?php
					$id_array = ['General', 'Working at specific locations', 'Physical factors', 'Physical strain', 'Work equipment', 'Hazardous substances', 'Accidents / Fire safety', 'Other'];
					$serial_number = 1;
					$column_count = 3;
					$items_per_column = ceil(count($id_array) / $column_count);
					$current_column = 0;
					foreach ($id_array as $index => $category) {
						if ($index % $items_per_column == 0) {
							if ($index != 0) {
								echo '</div>';
							}
							// Open new column
							echo '<div class="col-md-4">';
							$current_column++;
						}

						if (isset($modules[$category])) {
							?>
							<label><?= $serial_number . '. ' . $category ?></label><br>
							<ul>
								<?php foreach ($modules[$category] as $item) { ?>
									<li class="link"
										onclick="loadPopup('<?= base_url('admin/viewModule/') . $item->id ?>')">
										<?= $item->title ?>
										- <a href="javascript:void(0);"
											 onclick="event.stopPropagation(); loadPopup('<?= base_url('admin/editModule/') . $item->id ?>')"
											 class="btn-sm"><i class="fa fa-edit"></i></a>
										- <a href="javascript:void(0);"
											 onclick="event.stopPropagation(); deleteModule('<?= base_url('admin/deleteModule/') . $item->id ?>')"
											 class="btn-sm"><i class="fa fa-trash text-danger"></i></a>
									</li>
								<?php } ?>
							</ul>
							<?php
							$serial_number++;
						}
					}
					echo '</div>';
					?>
				</div>
			</div>

		</div>
	</div>
</div>
<style>
	li.link:hover {
		color: blue;
		text-decoration: underline;
		cursor: default;
	}
</style>
<script>
	function deleteModule(url) {
		if (confirm('Are you sure you want to delete this module?')) {
			window.location.href = url;
		}
	}
</script>
