<?php $this->load->view('layouts/form/header'); ?>

<div id="container">
	<div id="logo">
		<a href="<?php echo base_url(); ?>">
			<img alt="Home" src="<?php echo base_url(); ?>images/logo.png" height="82" width="322" />
		</a>
	</div>
	<div id="content">
		<?php $this->load->view($content); ?>
	</div>
</div>

<?php $this->load->view('layouts/form/footer'); ?>