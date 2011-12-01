<?php
	$address = array(
		'name' => 'address',
		'value'	=> set_value('address', $device->address)
	);
	$community = array(
		'name' => 'community',
		'value'	=> set_value('community', $device->community)
	);
	$upload = array(
		'id' => 'upload',
		'name' => 'upload'
	);
	$fakeupload = array(
		'id' => 'fakeupload',
		'name' => 'fakeupload',
		'class' => 'fileupload',
		'readonly' => 'readonly'
	);
	$select = array(
		'id' => 'select',
		'content' => 'Select'
	);
	$submit = array(
		'value' => 'Update'
	);
?>

<script type="text/javascript">
	$(document).ready(function() {
		$("#select").click(function() {
			$("#upload").trigger("click");
		});
		
		$("#upload").change(function() {
			var vals = $(this).val();
			val = vals.length ? vals.split("\\").pop() : "";

			$("#fakeupload").val(val);
		});
	});
</script>

<?php echo form_open_multipart('/devices/edit/' . $id); ?>
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
			<?php echo form_password($community); ?>
		</label><label>
			<div>Diagram:<span class="error"><p><?php if (isset($upload_error)) echo $upload_error; ?></p></span></div>
			<?php echo form_input($fakeupload); ?>
			<?php echo form_button($select); ?>
			<?php echo form_upload($upload); ?>
		</label>
		<div class="bottomrow">
			<?php echo form_submit($submit); ?>
			<?php if(isset($saved)): ?>
				<?php if($saved): ?>
					<p>Updated device.</p>
				<?php else: ?>
					<p>Failed to update device.</p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
<?php echo form_close(); ?>