<?php if(count($devices) > 0): ?>
	<table>
		<tr>
			<th>Hostname</th>
			<th>Address</th>
			<th></th>
		</tr>
		<?php foreach ($devices as $device): ?>
			<tr>
				<td><?php echo anchor("/devices/view/" . $device->id, $device->hostname); ?></td>
				<td><?php echo $device->address; ?></td>
				<td></td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php else: ?>
	<p>No devices found.</p>
<?php endif; ?>