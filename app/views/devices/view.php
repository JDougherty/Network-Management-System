<?php if(isset($router)): ?>
	<h2>Interfaces</h2>
	<table>
		<tr>
			<th style="width: 170px"></th>
			<th style="width: 100px">MTU</th>
			<th style="width: 100px">Speed</th>
			<th style="width: 150px">MAC</th>
			<th style="width: 150px">IP Address</th>
			<th style="width: 150px">Subnet Mask</th>
			<th style="width: 150px">Network Address</th>
		</tr>
		<?php foreach ($router->interfaces as $interface): ?>
			<?php if ($interface->type == 6): ?>
				<tr>
					<th><?php echo $interface->description; ?></th>
					<td><?php echo $interface->mtu; ?></td>
					<td><?php echo $interface->speed; ?></td>
					<td><?php echo $interface->mac; ?></td>
					<td><?php echo $interface->ipAdEntAdd; ?></td>
					<td><?php echo $interface->ipAdEntNetMask; ?></td>
					<td><?php echo long2ip(ip2long($interface->ipAdEntNetMask) & ip2long($interface->ipAdEntAdd)); ?></td>
				</tr>
			<?php endif; ?>
		<?php endforeach; ?>
	</table>

	<h2>Routing Table</h2>
	<table>
		<tr>
			<th style="width: 100px">Protocol</th>
			<th style="width: 170px">Route</th>
			<th style="width: 100px">Metric</th>
			<th style="width: 170px">Next Hop</th>
		</tr>
		<?php foreach ($router->routes as $route): ?>
			<tr>
				<td><?php echo $route->protocol; ?></td>
				<td><?php echo $route->destination; ?></td>
				<td><?php echo $route->metric_1; ?></td>
				<td><?php echo $route->next_hop; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
	
	<?php if (isset($diagram)): ?>
		<h2>Diagram</h2>
		<div style="text-align: center;">
			<img src="<?php echo base_url() . 'images/uploads/' . $diagram; ?>" />
		</div>
	<?php endif; ?>
<?php else: ?>
	<p>Failed to load device.</p>
<?php endif; ?>
