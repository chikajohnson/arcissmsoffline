<div class="container-fluid">
	<div>
		<?php echo validation_errors('<br><p class="alert alert-warning">'); ?>
		</div>
		<div class="panel panel-default" style="margin-top: 0px;">
			<div class="panel-heading text-center">
				<h1 class="panel-title">
				<strong style="font-size:22px;">Messaging Instruction and Guidelines</strong>
				</h1>
			</div>
			<br>
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="">
				<div class="panel panel-primary">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title text-center">
						<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							Message Formats
						</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
							<div class="row">
								<h4>&nbsp;&nbsp;&nbsp;These are the different messaging formats supported by the SMS Result Checking System. Each key item in the request SMS text is separeted by a comma (,) to  <span class="text-danger"><strong>"2348086371086"</strong></span></h4>
							</div>
							<div class="row">
								<ul>
									<h5 class="text-primary">1. <strong>REQUEST FOR EXAMINATION RESULTS</strong></h5>
									<li><i><b>Result, Matric, Password, Coursecode</b> </i> -----For a single course.</li>
									<li><i><b>Result, Matric,Password,Semester,Session</b></i>  -----For all results in a semester.</li>
								</ul>
							
								<ul>
									<h5 class="text-primary">2. <strong>CHANGE OF ACCESS PASSWORD</strong></h5>
									<li><i><b>Password, Matric, Old-password, New-password</b> </i> -----To change password.</li>							
								</ul>
						
								<ul>
									<h5 class="text-primary">3. <strong>REQUEST FOR HELP ON THE CORRECT TEXT MESSAGE FORMAT</strong></h5>
									<li><i><b>Help, Matric, Result</b> <i> -----For message format for checking the result of a single course.</li>
									<li><i><b>Help, Matric, Results</b> <i> -----For message format for checking the results of all the courses in a semester.</li>
									<li><i><b>Help, Matric, password</b> <i> -----For message format for change of access password.</li>
								</ul>
							</div>					
						</div>							
					</div>
					<br>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading" role="tab" id="headingTwo">
						<h4 class="panel-title text-center">
						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							Default Access
						</a>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
						<div class="panel-body">
							<div>
								<h4>A student's <b>matric number </b>is the the default access password for every registered student.</h4>
							</div>
						</div>
					</div>				
					<br>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading" role="tab" id="headingThree">
						<h4 class="panel-title text-center">
						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							Support
						</a>
						</h4>
					</div>
					<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
						<div class="panel-body">
							<h4><strong>For Support send email to the Site Administrator on </strong></h4>
							<a href="mailto:admin@arcissms.com" "email me"><strong>admin@arcissms.com</strong></a>
						</div>
					</div>
				</div>
			</div>			
		</div>
	</div>
	
	<p class="col-md-4"><a class="btn btn-lg btn-default" href="<?php echo base_url(); ?>site" title="Back to Dashboard"><<<&nbsp;&nbsp;Back&nbsp;</a></p>
</div>