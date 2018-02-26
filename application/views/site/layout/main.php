<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ARCIS SMS HUB| Students</title>
		<!-- Bootstrap core CSS -->
		
		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png">
		<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
		<link href="<?php echo  base_url(); ?>assets/css/dashboard.css" rel="stylesheet">
		<link href="<?php echo  base_url(); ?>assets/css/custom.css" rel="stylesheet">
		<link href="<?php echo  base_url(); ?>assets/css/animate.css" rel="stylesheet">

		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="https://printjs-4de6.kxcdn.com/print.min.css">	
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
					<a class="navbar-brand" href="<?php echo base_url() ?>admin"><strong>ARCIS SMS RESULT CHECKING SYSTEM</strong></a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<?php if ($this->session->userdata('logged_in')): ?>
						<?php if ($this->session->userdata('user_type')  == 'examiner'): ?>
						<li><a href="<?php echo base_url(); ?>examiner/dashboard">Dashboard</a></li>
						<li class="text-info"><a ><span class="glyphicon glyphicon-user"></span>
							<?php echo $this->session->userdata('full_name') ;?></a></li>
						<?php endif; ?>
						<?php if ($this->session->userdata('user_type')  == 'admin'): ?>
						<li><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
						<li class="text-info"><a href="<?php echo base_url(); ?>admin/dashboard/logout">Logout</a></li>
						<li class="text-info"><a ><span class="glyphicon glyphicon-user"></span>
							<?php echo $this->session->userdata('full_name') ;?></a></li>
						<li class="notifications">
						<a href="#">
							<i class="glyphicon glyphicon-globe" title="notifications"></i>
							<?php if($this->session->userdata('notification_count') > 0 ): ?>
								<span class="badge js-notification-count">
									<?php echo $this->session->userdata('notification_count') ;?>
								</span>
							<?php endif; ?>
						</a>
						</li>
						<?php endif; ?>
						<?php else: ?>
						<li><?php echo anchor('login', 'Admin', 'title="Login"'); ?></li>
						<li><?php echo anchor('examiner', 'Chief Examiner', 'title="Login"'); ?></li>
						<?php endif; ?>
					</ul>					
					</div><!--/.nav-collapse -->
				</div>
			</nav>
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-3 col-md-2 sidebar">
						<ul class="nav nav-sidebar text-center">
							<li class="active"><?php echo anchor('site', 'Student Dashboard', 'title="Dashboard Home"'); ?></li>
							<li class="<?php if($this->uri->segment(2) == 'check_result'){echo "item";} ?>"><?php echo anchor('site/check_result', 'Check Results', 'title="Check Results"'); ?></li>
							<li class="<?php if($this->uri->segment(2) == 'reset_password'){echo "item";} ?>"><?php echo anchor('site/reset_password', 'Reset Student Password', 'title="Reset Password"'); ?></li>
							<li class="<?php if($this->uri->segment(2) == 'change_password'){echo "item";} ?>"><?php echo anchor('site/change_password', 'Change Student Password', 'title="Change Password"'); ?></li>
							<li class="<?php if($this->uri->segment(2) == 'get_help'){echo "item";} ?>"><?php echo anchor('site/get_help', 'View Instructions', 'title="View Messaging Instruction"'); ?></li>
							<li class="<?php if($this->uri->segment(2) == 'activities'){echo "item";} ?>"><?php echo anchor('site/activities', 'View Student Activities', 'title="Student Activities"'); ?></li>
							<li class="active"><?php echo anchor('admin/dashboard', '<<< &nbsp;Back To Admin Dashboard', 'title="Back to  Home"'); ?></li>
						</ul>
						<hr>
					</div>
				</div>
				<?php $notification_unread = $this->session->userdata('notification_unread'); ?>
				<?php if($notification_unread): ?>							
					<div class="list-group unread_messages">
						<?php foreach($notification_unread as $notification): ?>	
							<a href="<?php echo base_url(); ?>admin/notifications/detail/<?php echo $notification->id ;?>" class="list-group-item">
								<h5 class="list-group-item-heading"><strong><?php echo $notification->title ;?></strong></h5>
								<p class="list-group-item-text"><?php echo implode(' ', array_slice(explode(' ', $notification->message), 0, 10)). '....'; ;?></p>
								<small class="list-group-item-text"><b><?php echo date('jS F Y  h:i:sa', strtotime($notification->sent_on));?></b></small>							
							</a>
						<?php endforeach; ?>	
					</div>				
				<?php endif; ?>	

				<div class="col-sm-10 col-sm-offset-2 main">
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