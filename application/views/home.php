<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>ARCIS SMS | Home </title>
    

   
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
     <link href="<?php echo base_url(); ?>assets/css/login.css" rel="stylesheet">    
     <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">     
     <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
  </head>
  <body>
    <!-- Fixed navbar -->
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
          
          <a class="navbar-brand" href="<?php echo base_url(); ?>"><strong>ARCIS SMS RESULT CHECKING SYSTEM</strong></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right">
          <?php if ($this->session->userdata('logged_in')): ?>  
              <?php if ($this->session->userdata('user_type')  == 'examiner'): ?> 
              <li class="notifications">
                <a href="#">
                  <i class="glyphicon glyphicon-globe"></i>
                  <span class="badge">23</span>
                </a>
              </li>           
              <li><a href="<?php echo base_url(); ?>examiner/dashboard">Enter Dashboard</a></li>
                  <li><a href="<?php echo base_url(); ?>admin/dashboard/logout">Logout</a></li>
              <?php endif; ?>

              <?php if ($this->session->userdata('user_type')  == 'admin'): ?>               
              <li><a href="<?php echo base_url(); ?>admin">Enter Dashboard</a></li>
                <li><a href="<?php echo base_url(); ?>admin/dashboard/logout">Logout</a></li>
                <li class="notifications">
                <a href="admin/notifications">
                <span class="glyphicon glyphicon-globe"></span>
                    <?php if($this->session->userdata('notification_count') > 0 ): ?>
                    <span  class="badge js-notification-count">
                      <?php echo $this->session->userdata('notification_count') ;?>
                    </span>
                  <?php endif; ?>
                </a>
              </li>
              <?php endif; ?>

              <?php if ($this->session->userdata('user_type')  == 'lecturer'): ?>  
              <li>
                 <a href="#">
                    <span class="glyphicon glyphicon-globe"></span>
                    <?php if($this->session->userdata('notification_count') > 0 ): ?>
                    <span style="position:absolute; top:10px; right:50px;" class="badge js-notification-count">
                      <?php echo $this->session->userdata('notification_count') ;?>
                    </span>
                  <?php endif; ?>
              </a>
              </li>
                <li><a href="<?php echo base_url(); ?>lecturer/dashboard">Enter Dashboard</a></li>
                <li><a href="<?php echo base_url(); ?>lecturer/dashboard/logout">Logout</a></li>
              <?php endif; ?>
          <?php else: ?>
            <li><?php echo anchor('login', 'Admin', 'title="Login"'); ?></li>
            <li><?php echo anchor('lecturer/dashboard/login', 'Lecturers', 'title="Login"'); ?></li>
            <li><?php echo anchor('examiner', 'Chief Examiner', 'title="Login"'); ?></li>
          <?php endif; ?>
           </ul>
            </div>
          </div>
        </nav>
        <div class="container">
          <div class="row">
            <div class="col-md-2"><img src="<?php echo base_url(); ?>assets/images/arcis-logo.png" alt="Arcis logo"></div>           
            <div class="text-center col-md-8">
              <span class="text-center"><h4><strong>AFRICA REGIONAL CENTRE FOR INFORMATION SCIENCE</strong>(ARCIS)</h4></span>
              <span class="text-center"><h5><strong>UNIVERSITY OF IBADAN, NIGERIA</strong></h5></span>
              <hr>
            <span class="text-center text-primary"><h4><strong>SMS RESULT CHECKING SYSTEM</strong></h4></span>
           </div>    
            <div class="col-md-2"><img src="<?php echo base_url(); ?>assets/images/ui-logo.png" alt="University of Ibadan logo" class="pull-right"></div>
          </div>
          <?php if($this->session->flashdata('not_allowed')): ?>
                <?php echo '<div class="alert alert-warning alert-dismissable">'.$this->session->flashdata('not_allowed').'</div>'; ?>
            <?php endif;?>
            <?php if($this->session->flashdata('error')): ?>
                <?php echo '<div class="alert alert-warning alert-dismissable">'.$this->session->flashdata('error').'</div>'; ?>
            <?php endif;?>
          <h4>Welcome To <strong>ARCIS</strong></h4>         
            <div class="container row">
              <div class="col-md-6">
                <h2 class="lead"><strong>Check Examination Results Via SMS</strong></h2>
                <p>
                 The ARCIS SMS Result Checking System allows
                  students to request for their examination results in a semester via SMS, <strong>without the the need for internet connection</strong>. <br><br>Students compose and send SMS text in a given format to a mobile number. The system processes the request and sends back an appropriate response as SMS.<br><br>

                  Example, a students can compose and send  this text : <i><strong>Result, 189354,22334, FSC755</strong></i> to <strong>+2347087266288 </strong> , to get his score for the course Information Technologies (FSC 755).            
                </p>
              </div>
              
              <div class="col-md-6">
                <h2 class="lead"><strong>Supported Services</strong></h2>
                <p>
                  The SMS Result Checking System provides a range of services. Some of these services include:
                  <ul class="">
                    <li>Alert students when results are released</li>
                    <li>Allow students to check their examination results</li>
                    <li>Permits students to change their access password</li>
                    <li>Allows students to request for help on correct messaging format</li>
                    <li>Provides a summary display display of student's exam results</li>
                    <li>Allows the admin to export examination results in pdf formats</li>
                    <li>Provides a backup of examination results, etc.</li>
                  </ul>
                </div>
                </div> <!-- /container -->
              </div>
              <!-- <div class="list-group">
                <a href="#" class="list-group-item active">
                  <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                  <p class="list-group-item-text">List Group Item Text</p>
                </a>
                <a href="#" class="list-group-item">
                  <h4 class="list-group-item-heading">Second List Group Item Heading</h4>
                  <p class="list-group-item-text">List Group Item Text</p>
                </a>
                <a href="#" class="list-group-item">
                  <h4 class="list-group-item-heading">Third List Group Item Heading</h4>
                  <p class="list-group-item-text">List Group Item Text</p>
                </a>
              </div> -->
              
              <footer class="footer text-center">
                <div class="container">
                  <p class="text-muted">
                    <h5 ><b>ARCIS SMS RESULT CHECKING SYSTEM</b></h5>
                    <small><b>ARCIS</b> </small> &copy; 2017
                  </p>
                </div>
              </footer>
              <!-- Bootstrap core JavaScript
              ================================================== -->
              <!-- Placed at the end of the document so the pages load faster -->
              <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
              <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
              <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
              <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

            </body>
          </html>