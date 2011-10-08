<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<title>Network Management System <?php if (isset($page_title)) echo ' :: ', $page_title; ?></title>
		
		<link type="text/css" rel="stylesheet" href="<?php echo base_url('css/reset.css'); ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url('css/main.css'); ?>" />
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('js/loader.js'); ?>"></script>
	</head>
	<body>
		<div id="container">
			<div id="header" class="no_select">
				<div class="logo">
					<a href="<?php echo base_url(); ?>">
						<img alt="Home" src="<?php echo base_url('images/logo.png'); ?>" height="82" width="322" />
					</a>
				</div>
			</div>
			
			<div id="breadcrumbs" class="no_select">
				<ul>
					<li>
						<a class="home" href="<?php echo base_url(); ?>">
							<img alt="Home" src="<?php echo base_url(); ?>images/home.png" height="24" width="24" />
						</a>
					</li>
					<li><a>Thing One</a></li>
					<li><a>Thing Two</a></li>
					<li><a>Thing Three</a></li>
					<?php
						
						if (isset($breadcrumbs))
						{
							foreach ($breadcrumbs as $name => $location)
							{
								if ($location != '')
									echo '<li>' . anchor($location, $name) . '</li>';
								else
									echo '<li><p>' . $name . '</p></li>';
							}
						}
					?>
				</ul>
			</div>