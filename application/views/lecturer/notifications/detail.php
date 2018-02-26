<div class="row">
	<div class="table-responsive">
		<h4 ><span class="label label-default">Notifications Details<small><a href="<?php echo base_url(); ?>lecturer/notifications" title="back to notifications" class="btn btn-md btn-default pull-right">Back</a></small></span></h4>
	</div>
	<hr>
	<table class="table table-striped table-condensed table-responsive" style="width:100%;">
		<tbody >
			<tr>
				<td>
					<div class="col-md-3">
						<h5><strong>Title :</strong></h5>
					</div>
					<div class="col-md-9">
						<h5><strong><?php echo $notification->title; ?></strong></h5>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="col-md-3">
						<h5><strong>Message :</strong></h5>
					</div>
					<div class="col-md-9">
						<h5><strong><?php echo $notification->message; ?></strong></h5>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="col-md-3">
						<h5><strong>Sender Name :</strong></h5>
					</div>
					<div class="col-md-9">
						<h5><?php echo $notification->sender; ?></h5>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="col-md-3">
						<h5><strong>Sender Email :</strong></h5>					</div>
					<div class="col-md-9">
						<h5><?php echo $notification->sender_email; ?></h5>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="col-md-3">
						<h5><strong>Sent on :</strong></h5>					</div>
					<div class="col-md-9">
						<h5><?php echo date('jS F Y  h:i:sa', strtotime($notification->sent_on)); ?></h5>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	
	<hr>
</div>
</div>