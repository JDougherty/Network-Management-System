<?php
	$drop_database = array(
		'id' => 'drop_database',
		'name' => 'drop_database',
		'value' => 1,
		'checked' => 0
	); 
	$recreate_tables = array(
		'id' => 'recreate_tables',
		'name' => 'recreate_tables',
		'value' => 1,
		'checked' => 1,
		'disabled' => 'disabled'
	);
	$submit = array (
		'class' => 'blue',
		'value' => 'Submit'
	);
?>

<h1>Initialize Database</h1>
<?php echo form_open('idb/initialize'); ?>
	<div>
		<div class="row">
			<?php echo form_checkbox($drop_database); ?>
			<label class="checkbox" for="drop_database">Recreate Database</label>
		</div>
		
		<div class="row">
			<?php echo form_checkbox($recreate_tables); ?>
			<label class="checkbox" for="recreate_tables">Recreate Tables</label>
		</div>
		
		<div id="submit_row">
			<?php echo form_submit($submit); ?>
		</div>
	</div>
<?php echo form_close(); ?>