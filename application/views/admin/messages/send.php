<div class="row">
	<h4><b>Send message</b><small><a href="<?php echo base_url(); ?>admin/messages" title="back to messages" class="btn btn-md btn-default pull-right">Back</a></small></h4>
	<div>
		<?php echo validation_errors('<br><p class="alert alert-warning">'); ?>
		</div>
	</div>
	<?php if($this->session->flashdata('error')): ?>
	<?php echo '<div class="alert alert-warning alert-dismissable">'.$this->session->flashdata('error').'</div>'; ?>
	<?php endif;?>
	<div id="upload_div">
		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
		<h3 class="text-danger">
			<span class="sr-only">Loading...</span>
		</h3>
	</div>
	<form method="post"  action="<?php echo base_url() ?>admin/messages/send/<?php echo $message->id; ?>">
		<div class="form-group">	
			<br>
			<label>Message</label>
			<textarea rows="3" name="message" class="form-control" readonly><?php echo $message->message; ?></textarea>
		</div>
		<div class="col-sm-6">
		</div>
		<div class="form-group">
			<label  class="col-sm-12 control-label">Select the message recipients</label>
			<div class="col-sm-12">			
				<div class="radio">
					<label>
						<input type="radio" name="message_radio" id="all-radio" value="all" checked="True">
						Select all recipients in a given session
					</label>
				</div>
				<div class="form-group" id="all">
					<select name="academic_session" class="form-control">
						<option value="0" >Select students' Session</option>
						<?php if($sessions) : ?>
						<?php foreach($sessions as $session): ?>
						<option value="<?php echo $session->id; ?>"><?php echo $session->name; ?></option>
						<?php endforeach; ?>
						<?php endif;?>
					</select>
					<br>
					<select name="course" class="form-control">
						<option value="0" >Select Courses the recipients registered for </option>
						<?php if($courses) : ?>
						<?php foreach($courses as $course): ?>
						<option value="<?php echo $course->id; ?>"><?php echo $course->code . ' - ' . $course->title ; ?></option>
						<?php endforeach; ?>
						<?php endif;?>
					</select>

				</div>

				<div class="radio">
					<label>
						<input type="radio" name="message_radio" id="some-radio"
						value="custom" > Enter the phone numbers manually
					</label>
				</div>
				<div class="form-group" id="custom">
					<textarea rows="8" name="phonenumbers" placeholder="Enter phone number(s) each separated by a comma e.g. 2349038883838,234837738733,2348737338288" class="form-control"><?php echo set_value('phonenumbers'); ?></textarea>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-6">
				<br>
			</div>
			
			<div class="col-md-12">
				<div class="btn-group pull-left">
					<input type="submit" name="submit" id="page_submit" onclick="validateInputs();" value = "Send " class="btn btn-lg btn-success">
				</div>
			</div>
			
		</div>
	</form>	
	<script>
	 function validateInputs() {
	    $('#upload_div').show();  
	  }
	</script>