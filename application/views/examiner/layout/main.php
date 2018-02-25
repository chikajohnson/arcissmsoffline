<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ARCIS SMS HUB| Chief Examiner DASHBOARD</title>
		<!-- Bootstrap core CSS -->

		 <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png">
		<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
		<link href="<?php echo  base_url(); ?>assets/css/dashboard.css" rel="stylesheet">
		<link href="<?php echo  base_url(); ?>assets/css/custom.css" rel="stylesheet">
		<link href="<?php echo  base_url(); ?>assets/css/animate.css" rel="stylesheet">	
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
					<a class="navbar-brand" href="<?php echo base_url() ?>admin"><strong>ARCIS SMS RESULT CHECKING SYSTEM</strong></a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
					<?php if($this->session->flashdata('login')): ?>
      					<li><?php echo '<span class="alert alert-success alert-dismissable">'.$this->session->flashdata('login').'</span>'; ?></li>
    				<?php endif;?>

    				<?php if ($this->session->userdata('logged_in')): ?>	
						<li><a href="<?php echo base_url(); ?>admin"><?php  ?></a></li>
					<?php endif; ?>
						<li><a href="<?php echo base_url(); ?>examiner/dashboard/logout">Logout</a></li>
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
					</ul>					
					</div><!--/.nav-collapse -->
				</div>
			</nav>
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-3 col-md-2 sidebar">
						<ul class="nav nav-sidebar text-center">
							<li class="<?php if($this->uri->segment(1) == 'examiner'){echo "active";} ?>"><?php echo anchor('examiner/dashboard', 'Chief Examiner Dashboard', 'title="Dashboard Home"'); ?></li>
							<li style="position:relative;" class="<?php if($this->uri->segment(2) == 'notifications'){echo "item";} ?>"><?php echo anchor('examiner/notifications', 'Notifications', 'title="Notifications"'); ?>
								<!-- <span style="position:absolute; top:10px; right:50px;" class="badge">33</span> -->
								<?php if($this->session->userdata('notification_count') > 0 ): ?>
									<span style="position:absolute; top:10px; right:50px;" class="badge js-notification-count">
										<?php echo $this->session->userdata('notification_count') ;?>
									</span>
								<?php endif; ?>
							</li>
							<li class="<?php if($this->uri->segment(2) == 'users'){echo "item";} ?>"><?php echo anchor('examiner/users', 'Manage Users', 'title="manage users"'); ?></li>
							<!-- <li class="<?php if($this->uri->segment(3) == 'allocate'){echo "item";} ?>"><?php echo anchor('examiner/lecturers/allocate', 'Allocate Courses', 'title="Allocate Courses"'); ?></li> -->
							<li class="<?php if($this->uri->segment(2) == 'lecturers' && $this->uri->segment(3) == null){echo "item";} ?>"><?php echo anchor('examiner/lecturers', 'Manage Lecturers', 'title="manage lecturers"'); ?></li>
							<li class="<?php if($this->uri->segment(2) == 'usergroups'){echo "item";} ?>"><?php echo anchor('examiner/usergroups', 'Manage User Groups', 'title="Manage User Groups"'); ?></li>
							<li class="<?php if($this->uri->segment(3) == 'approve_list' || $this->uri->segment(3) == 'view'){echo "item";} ?>"><?php echo anchor('examiner/dashboard/approve_list', 'Approve Results', 'title=" Approve Results"'); ?></li>
							<li class="<?php if($this->uri->segment(3) == 'activities'){echo "item";} ?>"><?php echo anchor('examiner/dashboard/activities', 'View Users Activities', 'title=" Monitor Users Activities"'); ?></li>	
							<?php if($this->uri->segment(2) == "dashboard"): ?>
								<li class="active"><?php echo anchor('/', 'Back To Home', 'title="Back to Home"'); ?></li>
							<?php else: ?>
								<li class="active"><?php echo anchor('examiner/dashboard', 'Back To Examiner Dashboard', 'title="Back To Examiner Dashboard"'); ?></li>
							<?php endif; ?>												
						</ul>
						<hr>
					</div>
				</div>

				<?php $notification_unread = $this->session->userdata('notification_unread'); ?>
				<?php if($notification_unread): ?>							
					<div class="list-group unread_messages">
						<?php foreach($notification_unread as $notification): ?>	
							<a href="<?php echo base_url(); ?>examiner/notifications/detail/<?php echo $notification->id ;?>" class="list-group-item">
								<h5 class="list-group-item-heading"><strong><?php echo $notification->title ;?></strong></h5>
								<p class="list-group-item-text"><?php echo $notification->message ;?></p>
								<small class="list-group-item-text"><b><?php echo $notification->sent_on ;?></b></small>							
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
		</body>
	</html>