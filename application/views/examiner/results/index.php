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
            <div class="list-group col-sm-4" style="height: 210px;">
              <?php if($result->approved == true): ?>
                <div class="list-group-item  bg-4">
                <span><b><strong><?php echo $result->course_fullname; ?> <br>(<?php echo $result->session_name; ?>)</strong></b></span>
              </div>
              <?php  else:?>
              <div class="list-group-item  bg-1">
                <span><b><strong><?php echo $result->course_fullname; ?> <br>(<?php echo $result->session_name; ?>)</strong></b></span>
              </div>
            <?php endif; ?>
              
              <div class="list-group-item bg-success">
                <span>Total Results: <b><strong><?php echo $result->group_count; ?> </strong></b></span>
              </div>
              <div class="list-group-item">
                <span>Lecturer : &nbsp;<b><strong><?php echo $result->lecturer_name; ?> </strong></b></span>
              </div>
              <?php if($result->approved == false): ?>
              <div class="list-group-item bg-light">
                <a class="btn bg-white" href="<?php echo base_url() ?>examiner/dashboard/view/<?php echo  $result->group_code;?>" title="">View</a>
                <a class="btn btn-success" onclick="confirmAction();" href="<?php echo base_url() ?>examiner/dashboard/approve/<?php echo  $result->group_code;?>"title="">Approve</a>
                <a class="btn btn-danger" onclick="confirmRejectAction();" href="<?php echo base_url() ?>examiner/dashboard/reject/<?php echo  $result->group_code;?>"title="">Reject</a>


              </div>
              <?php else: ?>
                <div class="list-group-item bg-4">
                 Result(s) have been approved.
              </div>
              <?php endif; ?>               
            </div>
            <?php endforeach; ?>
              <?php if($all_results_approved == true): ?>
                
                <div>                
                  <h4 class="text-success" ><strong>All results have been approved</strong></h4>
                </div>
              <?php endif; ?>
            <?php else: ?>
              <br>
            <h4>No result has been submiited for approval.</h4>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title text-center text-primary" for="textarea"><strong> Enter reason for rejecting this result</strong></h3>
      </div>
      <div class="modal-body row">        
        <div class="form-group">
          <div class="col-sm-12">
          <strong><textarea name="reason" id="textarea" class="form-control" rows="5" required="required" placeholder="State reasons, at least 20 craracters long."></textarea></strong>
          </div>
        </div>
        
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-lg btn-danger pull-left" >Reject Result</button>
        <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>
  <!-- modal page end -->
  
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

  function confirmRejectAction() {
  
  response = confirm("Are you sure you want to reject these results");
  if(response == true){
  return true;
  }
  else if (response == false){
  event.preventDefault();
  }
  
  }
  </script>