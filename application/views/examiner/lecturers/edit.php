<div class="row">
	<div class="col-md-12">
		<h4><b>Edit Lecturers</b></h4>
	</div>
</div>
<?php echo validation_errors('<p class="alert alert-warning">'); ?>
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>examiner/dashboard"><i class=" "></i> Dashboard</a></li>
			<li><a href="<?php echo base_url(); ?>examiner/lecturers"><i class=" "></i>Lecturers</a></li>
			<li class="active"><i class=" "></i> Edit Lecturer</li>
		</ol>
	</div>
</div>
<?php echo form_open('examiner/lecturers/edit/'.$lecturer->id); ?>
<div class="form-group">
	<div class="form-group">
		<label>Title</label>
		<input name="title" type="text" class="form-control" placeholder="Enter title eg. Prof, Dr, Mr, Mrs etc" value="<?php echo  $lecturer->title; ?>">
	</div>
	<div class="form-group">
		<label>Last Name</label>
		<input name="last_name" type="text" class="form-control" placeholder="Enter lastname" value="<?php echo  $lecturer->last_name; ?>">
	</div>
	<div class="form-group">
		<label>First Name</label>
		<input name="first_name" type="text" class="form-control" placeholder="Enter first name" value="<?php echo  $lecturer->first_name; ?>">
	</div>
	<div class="form-group">
		<label>Other Names</label>
		<input name="other_names" type="text" class="form-control" placeholder="Enter Other names" value="<?php echo  $lecturer->other_names; ?>">
	</div>
	<div class="form-group">
		<label>Phone Number</label>
		<input name="phonenumber" type="number" class="form-control" placeholder="Enter phone number" value="<?php echo  $lecturer->phonenumber; ?>">
	</div>	
	<div class="form-group">
		<label>Email</label>
		<input name="email" type="email" class="form-control" placeholder="Enter email" value="<?php echo  $lecturer->email; ?>">
	</div>	
	<div class="col-md-12">
		<div class="btn-group pull-right">
			<input type="submit" name="submit" id="page_submit" value = "Save " class="btn btn-sm btn-primary">
			<a href="<?php echo base_url(); ?>examiner/lecturers" class="btn btn-sm btn-default">Close</a>
		</div>
	</div>
	
</div>
<?php echo form_close(); ?>