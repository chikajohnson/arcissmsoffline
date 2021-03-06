<h4 class="text-justify" style="margin:  0 0 10px 0;"><span class="col-lg-offset-3 "><b>Notifications</b></span></h4> <br>
<?php if($this->session->flashdata('success')): ?>
<?php echo '<div class="alert alert-success alert-dismissable">'.$this->session->flashdata('success').'</div>'; ?>
<?php endif;?>
<div>
  <?php echo validation_errors('<br><p class="alert alert-warning">'); ?>
  </div> 
  <div class="row">
   <?php $item = 1; ?>
    <?php echo form_open('examiner/notifications/search'); ?>
    <div class="row">
      <div class="col-sm-6">
      </div>
      <div class="col-sm-2">
        <select name="notification" style="width:120%; height:35px;font-size:13px;" class="form-control">
          <option value="0" >Select Search Column</option>
          <option value="title">Title</option>
          <option value="sender">Sender name</option>
          <option value="sender_email">Sender Email</option>
        </select>
      </div>
      <div class="col-sm-2">
        <div class="form-group" style="dispaly:inline;">
          <input type="text" id="search" name="search_param" style="width:120%; height:35px;" class="form-control" placeholder="Enter Search item">
        </div>
      </div>
      <div class="col-sm-1">
        <button type="submit" class="btn-sm btn-default" style="width:148%; height:35px;">Search</button>
      </div>
      <?php echo form_close(); ?>
      <div class="col-sm-1">
        <button type="link" class="btn-sm btn-success" style="width:130%; height:35px;">Refresh</button>
      </div>
    </div>
  </div>
  <div class="row">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Sender</th>
              <th>Sender Email</th>
              <th>Sent On</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            
            <?php if($notifications) :?>
            <?php foreach($notifications as $notification):?>
            <tr>
              <td><?php echo $item++; ?></td>
              <td><?php echo $notification->title; ?>
                <?php if($notification->viewed == false): ?>
                  <span class="badge new">new</span>
                <?php endif; ?>
                
              </td>
              <td><?php echo $notification->sender; ?></td>
              <td><?php echo $notification->sender_email; ?></td>
              <td><?php echo  date('jS F Y  h:i:sa', strtotime($notification->sent_on)); ?></td>
              <td>
                <a href="<?php echo base_url(); ?>examiner/notifications/detail/<?php echo $notification->id ;?>" title="details" class="btn btn-sm bg-default">Details</a>
                <a href="<?php echo base_url(); ?>examiner/notifications/delete/<?php echo $notification->id ;?>" onclick="confirmAction();" title="delete" class="btn btn-sm btn-danger">Delete</a>               
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
          <div>
            <h5>Showing : <?php echo $item - 1; ?> of <?php echo $count; ?> records</h5>
          </div>
        </div>
      </div>
      <?php else: ?>
       <h5>Showing : <?php echo $item - 1; ?> of <?php echo $count; ?> records</h5>
        <?php endif; ?>

      <script type="text/javascript">
      
      function confirmAction() {
      
      response = confirm("Are you sure you want to delete the item?");
      if(response == true){
      return true;
      }
      else if (response == false){
      event.preventDefault();
      }
      
      }
      </script>