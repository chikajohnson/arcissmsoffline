<div class="row">
	<div class="table-responsive">
		<h4 ><b>User-Group Details</b><a href="<?php echo base_url(); ?>examiner/usergroups" title="back to user group" class="btn btn-md btn-primary pull-right">Back</a></h3>
	</div>
	<hr>
	<table class="table table-striped table-condensed table-responsive" style="width:100%;">
		<tbody >
			<tr>
				<td>
					<div class="col-md-3">
						<h5><strong>Name :</strong></h5>
					</div>
					<div class="col-md-9">
						<h4><?php echo $user_group->name; ?></h4>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="col-md-3">
						<h5><strong>Description :</strong></h5>
					</div>
					<div class="col-md-9">
						<h4><?php echo $user_group->description; ?></h4>
					</div>
				</td>
			</tr>
			
		</tbody>
	</table>
	<div>
	</div>
	<br>
	
	<hr>
</div>
</div>