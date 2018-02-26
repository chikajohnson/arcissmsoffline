<div>
	<div class="row text-center">
		<h4 class=""> <strong>Welcome to ARCIS SMS RESULT CHECKING SYSTEM </strong></h4>
		<hr>
	</div>
	
	<div>
		<div>
			<div class="row text-center">
				<div class="col-md-12">
					<div class="text-center">
						<div class="list-group col-sm-3" style="">
							<div class="list-group-item bg-1">
								<span class="glyphicon glyphicon-user">&nbsp;<b><strong>Number of Registered Students</strong></b></span>
							</div>
							<div  class="list-group-item"><h4><strong><?php echo $student_count; ?></strong></h4></div>
						</div>
						<div class="list-group col-sm-3" style="">
							<div class="list-group-item bg-2">
								<span class="glyphicon glyphicon-book">&nbsp;<b>Total Examination Results uploaded </b></span>
							</div>
							<div  class="list-group-item"><h4><strong><?php echo $result_count; ?></strong></h4></div>
						</div>
						<div class="list-group col-sm-2" style="">
							<div  class="list-group-item bg-3">
								<span class="glyphicon glyphicon-tasks">&nbsp;<b>Programmes of Study</b></span>
							</div>
							<div  class="list-group-item"><h4><strong><?php echo $program_count; ?></strong></h4></div>
						</div>
						<div class="list-group col-sm-2" style="">
							<div  class="list-group-item bg-4">
								<span class="glyphicon glyphicon-phone">&nbsp;<b>SMS Requests By Students</b></span>
							</div>
							<div  class="list-group-item"><h4><strong><?php echo $sms_count; ?></strong></h4></div>
						</div>
						<div class="list-group col-sm-2" style="">
							<div class="list-group-item bg-5">
								<span class="glyphicon glyphicon-cloud">&nbsp;<b>Courses Registered For</b></span>
							</div>
							<div  class="list-group-item"><h4><strong><?php echo $course_count; ?></strong></h4></div>
						</div>						
					</div>
					<div class="row">
						<div class="col-md-12 text-justify">
							<h4><span class="glyphicon glyphicon-cog text">&nbsp;</span><strong class=" text-primary">Services and Features</strong></h4>
							<p>
								The <b> Admin Dashbaord</b> allows the admin to manage the different components of the admin module.
							</p>
							<p>
								The <b>Students Dashbaord</b> is a subsection of the admin section. It allows the admin access to the students' examination results, correct messaging instructions and login access data.
								The admin can perform the following functions:
								<ul>
									<li>--- Check students' examination results in a semester</li>
									<li>--- Manage a students access login.</li>
									<li>--- View the statistics of students activities</li>
									<li>--- Monitor activities of students on the system</li>
									<li>--- Compose and send text messages to students</li>
									<li>--- Print out results in PDF formats, etc</li>
								</ul>
							</p>
							<p class="text-center">
								<a  class="btn btn-lg btn-default " style="height:50%" title="click to enter the student's dashboard." href="<?php echo base_url(); ?>Site"><span class="glyphicon glyphicon-cog"></span>
								<strong><span class="text-default">Enter Student Dashbaord</span></strong>
								</a>
							</p>
								
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>