<h1>Initialize Database</h1>
<p>If there are no errors, you have just initialized the database.</p>

<?php if(isset($dropped_database)): ?>
<h2>Dropped Database</h2>
<table>
	<tr>
		<td>All</td>
		<td><?php echo ($dropped_database == 0) ? '<strong class="green">Success</strong>' : '<strong class="red">Failure</strong>'; ?></td>
	</tr>
</table>
<?php endif; ?>

<h2>Dropped Tables</h2>
<table>
	<tr>
		<td>All</td>
		<td><?php echo ($dropped_tables > 0) ? '<strong class="green">Success</strong>' : '<strong class="red">Failure</strong>'; ?></td>
	</tr>
</table>

<h2>Created Tables</h2>
<table>
<?php foreach ($created_tables as $table => $status): ?>
	<tr>
		<td><?php echo $table; ?></td>
		<td><?php echo ($status > 0) ? '<strong class="green">Success</strong>' : '<strong class="red">Failure</strong>'; ?></td>
	</tr>
<?php endforeach; ?>
</table>

<?php if(isset($altered_tables)): ?>
<h2>Altered Tables</h2>
<table>
<?php foreach ($altered_tables as $table => $status): ?>
	<tr>
		<td><?php echo $table; ?></td>
		<td><?php echo ($status > 0) ? '<strong class="green">Success</strong>' : '<strong class="red">Failure</strong>'; ?></td>
	</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>

<?php if(isset($created_triggers)): ?>
<h2>Created Triggers</h2>
<table>
<?php foreach ($created_triggers as $table => $status): ?>
	<tr>
		<td><?php echo $table; ?></td>
		<td><?php echo ($status > 0) ? '<strong class="green">Success</strong>' : '<strong class="red">Failure</strong>'; ?></td>
	</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>

<?php if(isset($added_sample_data)): ?>
<h2>Added Sample Data</h2>
<table>
	<tr>
		<td>Total</td>
		<td><strong><?php echo $added_sample_data; ?></strong></td>
	</tr>
</table>
<?php endif; ?>

<p class="center"><a href="<?php echo base_url(); ?>">Go to Homepage</a></p>
