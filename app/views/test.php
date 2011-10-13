<?php
	$host = array(
		'name' => 'host',
		'value'	=> set_value('host')
	);
	$community = array(
		'name' => 'community',
		'value'	=> set_value('community')
	);
	$submit = array(
		'value' => 'Poll'
	);
?>

<?php if(isset($router)): ?>
	<h1>Details for <?php echo $router->host; ?></h1>
	
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
	<?php echo form_open(); ?>
		<div>
			<label>
				<div>Host:<span class="error"><?php echo form_error('host'); ?></span></div>
				<?php echo form_input($host); ?>
			</label>
			<label>
				<div>Community:<span class="error"><?php echo form_error('community'); ?></span></div>
				<?php echo form_input($community); ?>
			</label>
			<?php echo form_submit($submit); ?>
		</div>
	<?php echo form_close(); ?>
<?php endif; ?>