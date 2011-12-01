<?php if(count($devices) > 0): ?>
	<div id="viewall">
		<table>
			<tr>
				<th style="width: 260px">Hostname</th>
				<th style="width: 160px">Address</th>
				<th style="width: 80px"></th>
			</tr>
			<?php foreach ($devices as $device): ?>
				<tr>
					<td><?php echo anchor("/devices/view/" . $device->id, $device->hostname); ?></td>
					<td><?php echo $device->address; ?></td>
					<td><?php echo anchor("/devices/delete/" . $device->id, "X"); ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
<?php else: ?>
	<p>No devices found.</p>
<?php endif; ?>