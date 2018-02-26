<div class="panel"">
	<div>
		<?php echo validation_errors('<br><p class="alert alert-warning">'); ?>
			<?php if($this->session->flashdata('success')): ?>
			<?php echo '<div class="alert alert-success alert-dismissable">'.$this->session->flashdata('success').'</div>'; ?>
			<?php endif;?>
			<?php if($this->session->flashdata('error')): ?>
			<?php echo '<div class="alert alert-warning alert-dismissable">'.$this->session->flashdata('error').'</div>'; ?>
			<?php endif;?>
		</div>
		<div class="panel-heading text-center"  style="background:lightgray;>
			<h3 class="panel-title">
			<strong style="font-size:24px;">Allocate Course to Lecturer</strong>
			</h3>
		</div>
		<div class="panel-body">
			<div class="row col-sm-12">
				<?php echo form_open('examiner/lecturers/view_list'); ?>
				<div class="btn-group  pull-right">
					<input type="submit" name="view_list" id="view_list" value = "&nbsp; View Course Allocation &nbsp; " class="btn btn-lg  btn-default">
				</div>
				<?php echo form_close(); ?>
			</div>
			<?php echo form_open('examiner/lecturers/allocate'); ?>
			<div class="form-group">
				<div class="form-group">
					<div class="row">
						<div class="form-group col-sm-6">
							<label>Courses</label>
							<select name="course" class="form-control">
								<option value="0" >Select Course</option>
								<?php if($courses) : ?>
								<?php foreach($courses as $course): ?>
								<option value="<?php echo $course->id; ?>  <?php if ($course->id == set_value('course')) echo "selected = 'selected'"?>"><?php echo $course->code. ' - '. $course->title; ?></option><?php endforeach; ?>
								<?php endif;?>
							</select>
						</div>
						<div class="form-group col-sm-6">
							<label>Course Lecturers</label>
							<select name="lecturer" class="form-control">
								<option value="0">Select Course Lecturer</option>
								<?php if($lecturers) : ?>
								<?php foreach($lecturers as $lecturer): ?>
								<option value="<?php echo $lecturer->id; ?>"><?php echo $lecturer->title.' '. $lecturer->last_name. ' '. $lecturer->first_name. ' '. $lecturer->other_names; ?></option>
								<?php endforeach; ?>
								<?php endif;?>
							</select>
						</select>
					</div>
					<div class="col-md-12 text-center">
						<div class="btn-group">
							<input type="submit" onclick="" name="allocate" id="allocate" value = "&nbsp; Allocate Course&nbsp; " class="btn btn-lg  btn-success">
						</div>
					</div>
				</div>
				<br>
				
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>

