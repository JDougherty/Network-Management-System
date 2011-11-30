<?php if(isset($router)): ?>
	<h1>Details for <?php echo $router->hostname->name . '(' . $router->address . ')'; ?></h1>

	<h2>Interfaces</h2>
	<?php foreach ($router->interfaces as $interface): ?>
		<?php if ($interface->type == 6): ?>
			<h3><?php echo $interface->description; ?></h3>
			<ul>
				<li>MTU: <?php echo $interface->mtu; ?></li>
				<li>Speed: <?php echo $interface->speed; ?></li>
				<li>MAC: <?php echo $interface->mac; ?></li>
			</ul>
		<?php endif; ?>
	<?php endforeach; ?>

	<h2>Routing Table</h2>
	<table>
		<tr>
			<th>Protocol</th>
			<th>Route</th>
			<th>Metric</th>
			<th>Next Hop</th>
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
<?php else: ?>
	<p><?php echo $message; ?></p>
<?php endif; ?>