<div class="container-fluid">
	<div class="panel panel-default">
	<?php echo validation_errors('<br><p class="alert alert-warning">'); ?>

	<?php if($message): ?>
			<div class="alert alert-warning alert-dismissible fade in text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only"> close</span>
				</button>
				<?php echo $message; ?>
			</div>
	<?php endif; ?>
	<?php if($message_success): ?>
			<div class="alert alert-success alert-dismissible fade in text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only"> close</span>
				</button>
				<?php echo $message_success; ?>
			</div>
	<?php endif; ?>
	
	
		<div class="panel-heading text-center">
			<h1 class="panel-title">
			<strong style="font-size:28px;">Reset Login Password</strong>
			</h1>
		</div>
		<div class="panel-body" >
			<?php echo form_open('site/reset_password', 'class="form-horizontal"'); ?>
				<div class="form-group">
					<label  class="col-sm-3 control-label">Matric Number</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="matric"
						placeholder="Enter matric number" autocomplete="false" value="<?php echo set_value('matric');?>">
					</div>
				</div>							
				
							
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-danger" onclick="confirmAction();" title="Reset login password">Reset password</button>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div> 

<p class="col-md-4"><a class="btn btn-lg btn-default" href="<?php echo base_url(); ?>site" title="Back to Dashboard"><<<&nbsp;&nbsp;Back&nbsp;</a></p>
<script>

 function confirmAction() {
      if($)
	  }
      response = confirm("Resetting a password makes the user's matric number the default password. Are you sure you want to reset the password for this student?");
	      if(response == true){
	      return true;
      }
      else if (response == false){
      	event.preventDefault();
      }
      
      }
 </script>