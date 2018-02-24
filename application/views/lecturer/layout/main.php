<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ARCIS SMS HUB | ADMIN DASHBOARD</title>
		<!-- Bootstrap core CSS -->

		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png">
		<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
		<link href="<?php echo  base_url(); ?>assets/css/dashboard.css" rel="stylesheet">
		<link href="<?php echo  base_url(); ?>assets/css/custom.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="https://printjs-4de6.kxcdn.com/print.min.css">		
  
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<div class="btn btn-sm"></div>
					<a class="navbar-brand" href="<?php echo base_url() ?>"><strong>ARCIS SMS RESULT CHECKING SYSTEM</strong></a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
					<?php if($this->session->flashdata('login')): ?>
      				<li><?php echo '<span class="alert alert-success alert-dismissable">'.$this->session->flashdata('login').'</span>'; ?></li>
    				<?php endif;?>
    				<?php if ($this->session->userdata('logged_in')): ?>	
						<li><a href="<?php echo base_url(); ?>lecturer"><?php  ?></a></li>
					<?php endif; ?>
					<?php if ($this->session->userdata('user_type')  == 'lecturer'): ?>	
						<li><a href="<?php echo base_url(); ?>lecturer/dashboard/logout">Logout</a></li>
						<li class="text-info"><a ><span class="glyphicon glyphicon-user"></span>
							<?php echo $this->session->userdata('full_name') ;?>
						</a></li>
					<?php endif; ?>
					</ul>					
				</div><!--/.nav-collapse -->
			</div>
			</nav>
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-3 col-md-2 sidebar">
						<ul class="nav nav-sidebar text-center">
							<li class="<?php if($this->uri->segment(1) == 'lecturer'){echo "active";} ?>"><?php echo anchor('lecturer/dashboard', 'Lecturer Dashboard', 'title="Lecturer Home"'); ?>
							</li>
							<li class="<?php if($this->uri->segment(2) == 'notifications'){echo "item";} ?>"><?php echo anchor('lecturer/notifications', 'Notifications', 'title="Notifications"'); ?></li>

							<li class="<?php if($this->uri->segment(2) == 'results' && ($this->uri->segment(3) == null || $this->uri->segment(3) == "view" || $this->uri->segment(3) == "add" || $this->uri->segment(3) == "detail" || $this->uri->segment(3) == "edit")) {echo "item";} ?>"><?php echo anchor('lecturer/results', 'View  Results', 'title="View Results"'); ?></li>	

							<li class="<?php if($this->uri->segment(2) == 'results' && $this->uri->segment(3) == 'upload_result'){echo "item";} ?>"><?php echo anchor('lecturer/results/upload_result', 'Upload Results', 'title="Upload Results"'); ?></li>
							
							<?php if($this->uri->segment(3) == null || $this->uri->segment(2) == "dashboard"): ?>
								<li class="active"><?php echo anchor('/', 'Back To Home', 'title="Back to Home"'); ?></li>
							<?php else: ?>
								<li class="active"><?php echo anchor('lecturer/dashboard', 'Back To Lecturer Dashboard', 'title="Back To Lecturer Dashboard"'); ?></li>
							<?php endif; ?>
							
						</ul>
					</div>
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<?php
						$this->load->view($main);
					?>
				</div>
			</div>
			<!-- Bootstrap core JavaScript
			================================================== -->
			<!-- Placed at the end of the document so the pages load faster -->
			<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
			<!-- <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script> -->

			 <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
			<script src="<?php echo  base_url(); ?>assets/js/bootstrap.js"></script>			
			<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
			<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
		</body>
	</html>