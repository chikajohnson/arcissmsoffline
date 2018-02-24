<div>
  <div class="row text-center">
    <h4 class=""> <strong>List of examination results submitted for approval. </strong></h4>
    <hr>
  </div>
  <?php if($this->session->flashdata('approve')): ?>
  <?php echo '<div class="alert alert-success alert-dismissable">'.$this->session->flashdata('approve').'</div>'; ?>
  <?php endif;?>
  <?php if($this->session->flashdata('error')): ?>
  <?php echo '<div class="alert alert-warning alert-dismissable">'.$this->session->flashdata('error').'</div>'; ?>
  <?php endif;?>
  
  <div>
    <div>
      <div class="row text-center">
        <div class="col-md-12">
          <div class="text-center">
            <?php if($submitted_results): ?>
            <?php foreach($submitted_results as $result): ?>
            <div class="list-group col-sm-4" style="height: 200px;">
              <?php if($result->approved == true): ?>
                <div class="list-group-item  bg-4">
                <span><b><strong><?php echo $result->course_fullname; ?> (<?php echo $result->session_name; ?>)</strong></b></span>
              </div>
              <?php  else:?>
              <div class="list-group-item  bg-1">
                <span><b><strong><?php echo $result->course_fullname; ?> (<?php echo $result->session_name; ?>)</strong></b></span>
              </div>
            <?php endif; ?>
              
              <div class="list-group-item bg-success">
                <span>Total Results: <b><strong><?php echo $result->group_count; ?> </strong></b></span>
              </div>
              <div class="list-group-item">
                <span>Lecturer : &nbsp;<b><strong><?php echo $result->lecturer_name; ?> </strong></b></span>
              </div>
              <?php if($result->approved == false): ?>
              <div class="list-group-item ">
                <a class="btn btn-warning" href="<?php echo base_url() ?>examiner/dashboard/view/<?php echo  $result->group_code;?>" title="">View</a>
                <a class="btn btn-success" onclick="confirmAction();" href="<?php echo base_url() ?>examiner/dashboard/approve/<?php echo  $result->group_code;?>"title="">Approve</a>
              </div>
              <?php else: ?>
                <div class="list-group-item bg-4">
                 Result(s) have been approved.
              </div>
              <?php endif; ?>               
            </div>
            <?php endforeach; ?>
              <?php if($all_results_approved == true): ?>
                
                <div >
                  <h4 class="text-success"><strong>All results have been approved</strong></h4>
                </div>
              <?php endif; ?>
            <?php else: ?>
              <br>
            <h4>No results submiited for approval.</h4>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  
  function confirmAction() {
  
  response = confirm("Are you sure you want to approve these results");
  if(response == true){
  return true;
  }
  else if (response == false){
  event.preventDefault();
  }
  
  }
  </script>