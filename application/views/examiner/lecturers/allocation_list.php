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
			<strong style="font-size:24px;">Course Allocation Detail </strong>
			</h3>
		</div>
		<div class="panel-body">
			<form method="POST" action="<?php echo base_url(); ?>examiner/lecturers/view_list/<?php echo $code; ?>">
				<div class="form-group">
					<div class="form-group">
						<div class="row">
							<div class="form-group col-sm-12">
								<label>Courses</label>
								<select name="allocation" id="allocation" class="form-control" onchange="this.form.submit(); showItem();">
									<option value="0" >Select Course to view the allocation details</option>
									<?php if($courses) : ?>
									<?php foreach($courses as $course): ?>
									<option value="<?php echo $course->id; ?>" <?php if ($course->id == set_value('allocation')) echo "selected = 'selected'"?>><?php echo $course->code. ' - '. $course->title; ?></option>
									<?php endforeach; ?>
									<?php endif;?>
								</select>
							</div>
							
						</div>
						<br>
						<!-- inlet panel starts -->
						<div class="panel panel-default" id="inlet_panel">
							<div class="panel-heading text-center">
								<h3 class="panel-title ">
								<strong style="font-size:20px;"><?php echo $course_detail->code. ' - '. $course_detail->title; ?></strong>
								</h3>
							</div>
							<div class="panel-body">
								<div class="form-group">
									<div class="form-group">
										<div class="row">
											
											<!-- table start -->
											<div class="table-responsive">
												<?php if($allocations) :?>
												<?php $count = 1; ?>
												<table class="table table-striped">
													<thead>
														<tr>
															<th>#</th>
															<th><strong style="font-size:18px;">&nbsp;&nbsp;Course Lecturer(s)</strong></th>
														</tr>
													</thead>
													<tbody>
														
														<?php foreach($allocations as $allocation):?>
														<tr>
															<td><?php echo $count; ?></td>
															<td><?php echo $allocation->lecturer_name; ?></td>
															
															<td><a href="<?php echo site_url("examiner/lecturers/remove/{$allocation->course_id}/{$allocation->lecturer_id}"); ?>"  onclick="confirmActionRemoval();" title="Remove course" class="btn btn-sm btn-danger">Remove</a>
														</td>
													</tr>
													<?php $count++; ?>
													<?php endforeach;?>
													
												</tbody>
											</table>
											<?php else: ?>
											<div class="text-center text-danger">
												<h4><?php echo $course_detail->code. ' - '. $course_detail->title; ?> has not been assigned to any lecturer. </h4>
											</div>
											<div class="btn-group  pull-right">
												<a  name="view_list" id="view_list" href="<?php echo base_url() ?>examiner/lecturers/allocate" class="btn btn-lg  btn-default">&nbsp; Go To Allocation &nbsp; </a>
											</div>
											<?php endif ?>
										</div>
										<!-- table ends -->
									</div>
								</div>
							</div>
						</div>
						<!-- inlet panel starts -->
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>

			<script>
				
				function confirmActionRemoval() {
			
				response = confirm("Are you sure you want to remove the lecturer?");
				if(response == true){
					return true;
					}
					else if (response == false){
					event.preventDefault();
					}
			
			}

			
			</script>											