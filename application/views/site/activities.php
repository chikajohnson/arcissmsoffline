<div class="col-md-offset-3">
	<h3> Students Activities</h3>
</div>
<div class="row">
	<form method="post" accept-charset="utf-8" method="POST" action="<?php echo base_url(); ?>site/paginate">
		<div class="col-sm-6">
			<div class="col-sm-1 pull-left" style="width:40px;" >
				<span class="label label-default" style="width:120%; height:35px;font-size:12px">Show</span>
			</div>
			<div class="col-sm-2">
				<select name="activities" style="width:120%; height:20px;font-size:12px" onchange="this.form.submit()">
					<option value="<?php echo $index; ?>"><?php echo $index; ?></option>					
					<option value="1000000">All</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="500">500</option>
					<option value="1000">1000</option>
				</select>
			</div>
		</div>
	</form>
	<?php $item = 1; ?>
	<?php echo form_open('site/search'); ?>
	<div class="col-sm-2">
		<select name="activities" style="width:120%; height:35px;font-size:12px;" class="form-control">
			<option value="0" >Select Search Column</option>
			<option value="matric">Matric Number</option>
			<option value="phonenumber">Phone Number</option>
			<option value="sms_type">SMS Type</option>
		</select>
	</div>
	<div class="col-sm-2">
		<div class="form-group" style="dispaly:inline;">
			<input type="text" id="search" name="search_param" style="width:120%; height:35px;" class="form-control" placeholder="Enter Search item">
		</div>
	</div>
	<div class="col-sm-1">
		<button type="submit" class="btn-sm btn-default" style="width:220%; height:35px;">Search</button>
	</div>
	<?php echo form_close(); ?>
</div>
<div class="col-sm-12">
	<?php $item_count = 1 ?>
	<?php if($activities): ?>
	<table class="table table-striped table table-responsive table-condensed table-striped table-hover table-bordered">
		<thead>
			<tr>
				<th>#</th>
				<th style="width:25%" colspan="4">Date</th>
				<th>User</th>
				<th>Phonenumber</th>
				<th>SMS Type</th>
				<th>Status</th>
				<th>Message </th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($activities as $activity):?>
			<tr>
				<td><?php echo $item_count; ?></td>
				<td colspan="4"><?php echo date('jS F Y  h:i:sa', strtotime($activity->request_time)); ?></td>
				<td><?php echo $activity->matric; ?></td>
				<td><?php echo $activity->phonenumber; ?></td>
				<td><?php echo $activity->sms_type; ?></td>
				<td><?php echo $activity->status; ?></td>
				<td><?php echo $activity->sms_message; ?></td>
			</tr>
			<?php $item_count ++; ?>
			<?php endforeach; ?>
		</tbody>			
	</table>
	<div>
		<h5>Showing : <?php echo $item_count - 1; ?> of <?php echo $count; ?> records</h5>
	</div>
</div>
<?php else: ?>	
<h5>Showing : <?php echo $item_count - 1; ?> of <?php echo $count; ?> records</h5>
<?php endif; ?>