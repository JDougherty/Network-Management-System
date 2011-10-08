<?php $this->load->view('layouts/main/header'); ?>

	<?php if (isset($sidebar)) $this->load->view($sidebar); ?>

	<div id="content" <?php echo (isset($sidebar))?'class="sidebar"':''?>>
		<?php $this->load->view($content); ?>
	</div>

<?php $this->load->view('layouts/main/footer'); ?>