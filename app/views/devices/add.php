<?php
	$address = array(
		'name' => 'address',
		'value'	=> set_value('address')
	);
	$community = array(
		'name' => 'community',
		'value'	=> set_value('community')
	);
	$submit = array(
		'value' => 'Add'
	);
?>

<?php if(isset($added)): ?>
	<?php if($added): ?>
		<p>Added device.</p>
	<?php else: ?>
		<p>Failed to add device.</p>
	<?php endif; ?>
<?php endif; ?>

<?php echo form_open(); ?>
	<div>
		<?php if(isset($message)): ?>
			<div><?php echo $message; ?></div>
		<?php endif; ?>
		<label>
			<div>Address:<span class="error"><?php echo form_error('address'); ?></span></div>
			<?php echo form_input($address); ?>
		</label>
		<label>
			<div>Community:<span class="error"><?php echo form_error('community'); ?></span></div>
			<?php echo form_input($community); ?>
		</label>
		<?php echo form_submit($submit); ?>
	</div>
<?php echo form_close(); ?>