<div class="row">
	<div class="col-md-12">
		<h4><b>Edit result</b></h4>
	</div>	
</div>
<?php echo validation_errors('<br><p class="alert alert-warning">'); ?>
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>lecturer/dashboard"><i class=" "></i> Dashboard</a></li>
			<li><a href="<?php echo base_url(); ?>lecturer/results"><i class=" "></i>Results</a></li>
			<li class="active"><i class=" "></i> Edit result</li>
		</ol>
	</div>
</div>
<?php echo form_open('lecturer/results/edit/'.$result->id); ?>
<div class="form-group">
	<div class="form-group">
		<label>Matric Number</label>
		<input name="matric" type="number" class="form-control" placeholder="Enter matric number" value="<?php echo $result->matric; ?>">
	</div>
	<div class="row">
		<div class="form-group col-md-4">
			<label>Course</label>
			<select name="course" class="form-control">
				<option  value="0">Select course</option>
				<?php if($courses) : ?>
					<?php foreach($courses as $course): ?>
						<?php if ($course->id == $result->course_id): ?>
						<?php $selected = 'selected'; ?>
				<?php else: ?>
					<?php $selected = ''; ?>
				<?php endif; ?>
				<option value="<?php echo $course->id; ?>" <?php echo $selected; ?>><?php echo $course->code. ' - '. $course->title ; ?> </option>
				<?php endforeach; ?>
				<?php endif;?>
			</select>
		</div>
		<div class="form-group col-md-4">
			<label>Academic Session</label>
			<select name="session" class="form-control">
				<option  value="0">Select course</option>
				<?php if($sessions) : ?>
				<?php foreach($sessions as $session): ?>
				<?php if ($session->id == $result->session_id): ?>
				<?php $selected = 'selected'; ?>
				<?php else: ?>
				<?php $selected = ''; ?>
				<?php endif; ?>
				<option value="<?php echo $session->id; ?>" <?php echo $selected; ?>><?php echo $session->name ; ?> </option>
				<?php endforeach; ?>
				<?php endif;?>
			</select>
		</div>
		<div class="form-group col-md-4">
			<label>Semester</label>
			<select name="semester" class="form-control">
				<option  value="0">Select semester</option>
				<?php if($semesters) : ?>
				<?php foreach($semesters as $semester): ?>
				<?php if ($semester->id == $result->semester_id): ?>
				<?php $selected = 'selected'; ?>
				<?php else: ?>
				<?php $selected = ''; ?>
				<?php endif; ?>
				<option value="<?php echo $semester->id; ?>" <?php echo $selected; ?>><?php echo $semester->name; ?> </option>
				<?php endforeach; ?>
				<?php endif;?>
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<label>Continuous Assessment</label>
		<input id="assessment" name="assessment" type="text" class="form-control" placeholder="Enter assessment" value="<?php echo $result->assessment; ?>">
	</div>
	<div class="form-group">
		<label>Exam score </label>
		<input id="exam_score" name="exam_score" type="number" onkeyup="populateText();populateStatus();" step="0.001"  class="form-control" placeholder="Enter the exam score" value="<?php echo $result->exam_score; ?>">
	</div>
	<div class="form-group">
		<label>Total Score</label>
		<input id="total_score" name="total_score" type="number" readonly="true" class="form-control" placeholder="Enter the Total_score" value="<?php echo $result->total_score; ?>">
	</div>
	<div class="form-group">
		<label>Remark</label>
		<input id="remark" name="remark" type="text" readonly class="form-control" value="<?php echo $result->remark; ?>">
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Course Lecturer 1</label>
				<input name="course_lecturer1" type="text" class="form-control" placeholder="Enter the name of the course lecturer" value="<?php echo $result->course_lecturer1; ?>">
			</div>
			<div class="form-group">
				<label>Course Lecturer 2</label>
				<input name="course_lecturer2" type="text" class="form-control" placeholder="Enter the name of the course lecturer" value="<?php echo $result->course_lecturer2; ?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Course Lecturer 3</label>
				<input name="course_lecturer3" type="text" class="form-control" placeholder="Enter the name of the course lecturer" value="<?php echo $result->course_lecturer3; ?>">
			</div>
			<div class="form-group">
				<label>Course Lecturer 4</label>
				<input name="course_lecturer4" type="text" class="form-control" placeholder="Enter the name of the course lecturer" value="<?php echo $result->course_lecturer4; ?>">
			</div>
		</div>
	</div>	
	<div class="form-group">
		<label>Chief Examiner</label>
		<input name="chief_examiner" type="text" class="form-control" placeholder="Enter name Chief Examiner" value="<?php echo $result->chief_examiner; ?>">
	</div>
	<div class="col-md-12">
		<div class="btn-group pull-right">
			<input type="submit" name="submit" id="page_submit" value = "Save " class="btn btn-sm btn-primary">
			<a href="<?php echo base_url(); ?>lecturer/results" class="btn btn-sm btn-default">Close</a>
		</div>
	</div>
	<?php echo form_close(); ?>


	<script type="text/javascript">

	function populateText(){
		var assessment = document.getElementById('assessment').value;
		var exam =  document.getElementById('exam_score').value;
		var total = 0;

		total = parseInt(assessment) + parseInt(exam);

		document.getElementById('total_score').value = total;
	}

	function populateStatus(){
		var assessment = document.getElementById('assessment').value;
		var exam =  document.getElementById('exam_score').value;
		var total = 0;

		total = parseInt(assessment) + parseInt(exam);
		var remark = "";

		if(total >= 40){
			remark = "PASS";
		}else{
			remark = "FAIL"
		}

		document.getElementById('remark').value = remark;
	}

	function cleartext(inputControl) {
		var cleared = true;
		if(cleared){
			inpotControl.value  = "";

			cleared = false;
		}
	}
	
</script>