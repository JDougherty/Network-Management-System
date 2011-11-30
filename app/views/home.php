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

<?php echo form_open(); ?>
	<div>
		<?php if(isset($message)): ?>
			<div><?php echo $message; ?></div>
		<?php endif; ?>
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