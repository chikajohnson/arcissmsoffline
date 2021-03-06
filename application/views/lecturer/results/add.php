<div class="row">
	<h4><b>Add Student's Result</b></h4>
	<div>
		<?php echo validation_errors('<br><p class="alert alert-warning">'); ?>
	</div>
	<?php if($this->session->flashdata('error')): ?>
  	<?php echo '<div class="alert alert-warning alert-dismissable">'.$this->session->flashdata('error').'</div>'; ?>
	<?php endif;?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>lecturer/dashboard"><i class=" "></i> Dashboard</a></li>
				<li><a href="<?php echo base_url(); ?>lecturer/results"><i class=" "></i>Results</a></li>
				<li class="active"><i class=" "></i> Add Result</li>
			</ol>
		</div>
	</div>
	<?php echo form_open('lecturer/results/add'); ?>
	<div class="form-group">
		<div class="form-group">
			<label>Matric Number</label>
			<input name="matric" type="number" class="form-control" placeholder="Enter matric number" value="<?php echo set_value('matric'); ?>">
		</div>
		<div class="row">
			
			<div class="form-group col-sm-4">
				<label>Course</label>
				<select name="course" class="form-control">
					<option value="0" >Select course</option>
					<?php if($courses) : ?>
					<?php foreach($courses as $course): ?>
					<option value="<?php echo $course->id; ?>"><?php echo $course->code. ' - '. $course->title; ?></option>
					<?php endforeach; ?>
					<?php endif;?>
				</select>
			</div>
			<div class="form-group col-sm-4">
				<label>Academic Session</label>
				<select name="session" class="form-control">
					<option value="0">Select session</option>
					<?php if($sessions) : ?>
					<?php foreach($sessions as $session): ?>
					<option value="<?php echo $session->id; ?>"><?php echo $session->name; ?></option>
					<?php endforeach; ?>
					<?php endif;?>
				</select>
			</select>
		</div>
		<div class="form-group col-sm-4">
			<label>Semester</label>
			<select name="semester" class="form-control">
				<option value="0">Select Semester</option>
				<?php if($semesters) : ?>
				<?php foreach($semesters as $semester): ?>
				<option value="<?php echo $semester->id; ?>"><?php echo $semester->name; ?></option>
				<?php endforeach; ?>
				<?php endif;?>
			</select>
		</select>
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6">
		<label>Continuous Assessment</label>
		<input id="assessment" name="assessment" type="text" class="form-control" placeholder="Enter assessment" value="<?php echo set_value('assessment'); ?>">
	</div>
	<div class="form-group col-sm-6">
		<label>Exam Score </label>
		<input id="exam_score" name="exam_score" type="number" onkeyup="populateText();populateStatus();" class="form-control" placeholder="Enter the  total score" value="<?php echo set_value('exam_score'); ?>">
	</div>
</div>
<div class="form-group">
	<label>Total Mark</label>
	<input id="total_score" name="total_score" readonly="true" type="number" class="form-control" placeholder="0" value="<?php echo set_value('total_score'); ?>">
</div>
<div class="form-group">
	<label>Remark</label>
	<input id="remark" name="remark" type="text" class="form-control" readonly  value="<?php echo set_value('remark'); ?>">
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Course Lecturer 1</label>
			<input name="course_lecturer1" type="text" class="form-control" placeholder="Enter the name of the course lecturer" value="<?php echo set_value('course_lecturer1'); ?>">
		</div>
		<div class="form-group">
			<label>Course Lecturer 2</label>
			<input name="course_lecturer2" type="text" class="form-control" placeholder="Enter the name of the course lecturer" value="<?php echo set_value('course_lecturer2'); ?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Course Lecturer 3</label>
			<input name="course_lecturer3" type="text" class="form-control" placeholder="Enter the name of the course lecturer" value="<?php echo set_value('course_lecturer3'); ?>">
		</div>
		<div class="form-group">
			<label>Course Lecturer 4</label>
			<input name="course_lecturer4" type="text" class="form-control" placeholder="Enter the name of the course lecturer" value="<?php echo set_value('course_lecturer4'); ?>">
		</div>
	</div>
</div>
<div class="form-group">
	<label>Chief Examiner</label>
	<input name="chief_examiner" type="text" class="form-control" placeholder="Enter name Chief Examiner" value="<?php echo set_value('chief_examiner'); ?>">
</div>
<div class="col-md-12">
	<div class="btn-group pull-right">
		<input type="submit" name="submit" id="page_submit" value = "Add Result" class="btn btn-sm btn-primary">
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