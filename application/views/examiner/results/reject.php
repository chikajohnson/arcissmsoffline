<div class="row">
	<h4><b>Result Rejection Reason</b></h4>
    <hr>
	<div>
		<?php echo validation_errors('<br><p class="alert alert-warning">'); ?>
		</div>
	</div>	
	<?php echo form_open('examiner/dashbaord/reject'); ?>
	<div class="form-group">
		<div class="form-group">
			<label>Enter reason for rejecction.</label>
			<textarea name="rejection_reason" placeholder="state reason for rejection" class="form-control"><?php echo set_value('rejection_reason'); ?></textarea>
		</div>
				
		<div class="col-md-12">
			<div class="btn-group pull-right">
				<input type="submit" name="submit" id="page_submit" value = "Reject " class="btn btn-sm btn-primary">
				<a href="<?php echo base_url(); ?>examiner/dashbaord/approve_list" class="btn btn-sm btn-default">Cancel</a>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>
	