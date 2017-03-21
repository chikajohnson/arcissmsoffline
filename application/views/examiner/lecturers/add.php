<div class="row">
	<div class="col-md-12">
		<h4><b>Add a Lecturer</b></h4>		
	</div>
	<div>
		<?php echo validation_errors('<br><p class="alert alert-warning">'); ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>examiner/lecturers"><i class=" "></i> Dashboard</a></li>
			<li><a href="<?php echo base_url(); ?>examiner/lecturers"><i class=" "></i>Lecturers</a></li>
			<li class="active"><i class=" "></i> Add a Lecturer</li>
		</ol>
	</div>
</div>
	<?php echo form_open('examiner/lecturers/add'); ?>
	<div class="form-group">
		<div class="form-group">
			<label>Title </label>
			<input name="title" type="text" class="form-control" placeholder="Enter title eg. Prof, Dr, Mr, Mrs etc" value="<?php echo set_value('title'); ?>">
		</div>
		<label>Last Name</label>
			<input name="last_name" type="text" class="form-control" placeholder="Enter last name" value="<?php echo set_value('last_name'); ?>">
		</div>
		<div>
			<label>First Name</label>
			<input name="first_name" type="text" class="form-control" placeholder="Enter first name" value="<?php echo set_value('first_name'); ?>">
		</div>
		<div>
			<label>Other Names</label>
			<input name="other_names" type="text" class="form-control" placeholder="Enter other names" value="<?php echo set_value('other_names'); ?>">
		</div>
		<div class="form-group">
			<label>Phone Number</label>
			<input name="phonenumber" type="text" class="form-control" placeholder="Enter phone number in this format +23470287772722" value="<?php echo set_value('phonenumber1'); ?>">
		</div>		
		<div class="form-group">
			<label>Email</label>
			<input name="email" type="email" class="form-control" placeholder="Enter email" value="<?php echo set_value('email'); ?>">
		</div>
		<div class="col-md-12">
			<div class="btn-group pull-right">
				<input type="submit" name="submit" id="page_submit" value = "Add " class="btn btn-sm btn-primary">
				<a href="<?php echo base_url(); ?>examiner/lecturers" class="btn btn-sm btn-default">Close</a>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>