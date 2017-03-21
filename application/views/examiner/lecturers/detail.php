<div class="row">
	<div class="table-responsive">
		<h4 ><b class="label label-default">Lecturer Details</b><a href="<?php echo base_url(); ?>examiner/lecturers" title="back to Lecturer" class="btn btn-md btn-default pull-right">Back</a></h3>
	</div>
	<hr>
	<table class="table table-striped table-condensed table-responsive" style="width:100%;">
		<tbody >
			<tr>
				<td>
					<div class="col-md-3">
						<h5><strong>Name :</strong></h5>
					</div>
					<div class="col-md-6">
						<h5><?php echo $lecturer->title.' &nbsp; '.$lecturer->last_name . ' &nbsp;'. $lecturer->first_name.' &nbsp;'. $lecturer->other_names; ?></h5>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="col-md-3">
						<h5><strong>Email :</strong></h5>
					</div>
					<div class="col-md-6">
						<h5><?php echo $lecturer->email; ?></h5>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="col-md-3">
						<h5><strong>Phone Number :</strong></h5>
					</div>
					<div class="col-md-6">
						<h5><?php echo $lecturer->phonenumber; ?></h5>
					</div>
				</td>
			</tr>
			<tr>
				<td>
				<h5><strong>List of Allocated Courses</strong></h5>
				<?php if($allocated_courses) : ?>
					<div class="col-md-12">						
						<ul class="list-group">
						<?php foreach($allocated_courses as $course): ?>
							<li class="list-group-item"><?php  echo $course->course_code . ' - ' . $course->course_title ;?></li>
						<?php endforeach; ?>
						</ul>
					</div>
				<?php else: ?>
					<h5>No course has been allocated</h5>
				<?php endif; ?>
				</td>
			</tr>
		</tbody>
	</table>
	<hr>
</div>
</div>