<?php
	$label = array(
		'name' => 'label',
		'value'	=> set_value('label')
	);
	$host = array(
		'name' => 'host',
		'value'	=> set_value('host')
	);
	$community = array(
		'name' => 'community',
		'value'	=> set_value('community')
	);
	$submit = array(
		'value' => 'Add'
	);
?>

<?php if(count($devices) > 0): ?>
	<table>
		<tr>
			<th>Label</th>
			<th>Host</th>
			<th></th>
		</tr>
		<?php foreach ($devices as $device): ?>
			<tr>
				<td><?php echo anchor("/devices/view/" . $device->id, $device->label); ?></td>
				<td><?php echo $device->host; ?></td>
				<td></td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php else: ?>
	<p>No devices found.</p>
<?php endif; ?>