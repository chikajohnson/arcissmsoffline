
<?php if($this->session->flashdata('success')): ?>
<?php echo '<div class="alert alert-success alert-dismissable">'.$this->session->flashdata('success').'</div>'; ?>
<?php endif;?>
<div class="row">
  <div class="table-responsive">
    <h4 ><span class="label label-default">Lecturer Information<small><a href="<?php echo base_url(); ?>examiner/lecturers/add" title="add lecturers" class="btn btn-sm btn-success pull-right">Add Lecturers</a></small></span></h4>
  <div class="table-responsive">
    <?php if($lecturers) :?>
      <?php $count = 1; ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Phone Number</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        
        <?php foreach($lecturers as $lecturer):?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $lecturer->title. '  ' . $lecturer->last_name. '  '. $lecturer->first_name; ?></td>
          <td><?php echo $lecturer->phonenumber ?></td>
          <td><?php echo $lecturer->email ?></td>
          <td>
            <a href="<?php echo base_url(); ?>examiner/lecturers/edit/<?php echo $lecturer->id ;?>" title="edit" class="btn btn-sm btn-primary">Edit</a>
            <a href="<?php echo base_url(); ?>examiner/lecturers/detail/<?php echo $lecturer->id ;?>" title="detail" class="btn btn-sm bg-default">Detail</a>
            <a href="<?php echo base_url(); ?>examiner/lecturers/delete/<?php echo $lecturer->id ;?>" onclick="confirmAction();" title="delete" class="btn btn-sm btn-danger">Delete</a>
          </td>
        </tr>
        <?php $count++; ?>
        <?php endforeach;?>
        <?php else: ?>
      </tbody>
    </table>
    <div class=""><h4><?php echo $alert ?></h4></div>
    <?php endif; ?>
  </div>
</div>

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