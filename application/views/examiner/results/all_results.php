<h4 style="margin:0 0 0 0;"><span class="col-lg-offset-3 "><b>Detail of the Uploaded Examination Results</b></span></h4><br>
<?php if($this->session->flashdata('success')): ?>
<?php echo '<div class="alert alert-success alert-dismissable">'.$this->session->flashdata('success').'</div>'; ?>
<?php endif;?>
<?php if($this->session->flashdata('cancel_upload')): ?>
<?php echo '<div class="alert alert-warning alert-dismissable">'.$this->session->flashdata('cancel_upload').'</div>'; ?>
<?php endif;?>
<hr>
<div>
  <?php echo validation_errors('<br><p class="alert alert-warning">'); ?>
  </div>
  <div class="row container-fluid">
    <div class="col-sm-3">
      <span>Lecturer: <b><strong><?php echo $result_detail->lecturer_name; ?> </strong></b></span>
    </div>
    <div class="col-sm-4">
      <span>Course: <b><strong><?php echo $result_detail->course_fullname;  ?> </strong></b></span>
    </div>
    <div class="col-sm-2">
      <span>Session: <b><strong><?php echo $result_detail->session_name;  ?> </strong></b></span>
    </div>
    <div class="col-sm-2">
      <span>Semester: <b><strong><?php echo $result_detail->semester_name;  ?> </strong></b></span>
    </div>
    <div class="col-sm-1">
      <a class="btn btn-success" onclick="confirmAction();" href="<?php echo base_url() ?>examiner/dashboard/approve/<?php echo  $result_detail->group_code;?>"title="">Approve Results</a>
    </div>
  </div>
  <div class="row">
    <?php $item = 1; ?>
    <div class="row">
      <div class="">
        <br>
        <table class="table table-striped table table-responsive table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Matric Number</th>
              <th>Assessement</th>
              <th>Exam score</th>
              <th>Total Score</th>              
              <th>Adjusted Score</th>
              <th>Remark</th>
            </tr>
          </thead>
          <tbody>
            <?php if($results) :?>
            <?php foreach($results as $result):?>
            <tr>
              <td><?php echo $item++; ?></td>
              <td><?php echo $result->matric; ?></td>
              <td><?php echo $result->assessment ?></td>
              <td><?php echo $result->exam_score; ?></td>
              <td><?php echo $result->total_score ?></td>
              <td><?php echo $result->adjusted_mark ?></td>
              <td><?php echo $result->remark; ?></td>              
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
        <div class="col-sm-12">
          <span>Total Number of Results:  <b><strong><?php echo $result_detail->group_count; ?> </strong></b></span>
         <a class="btn btn-default pull-right" href="<?php echo base_url() ?>examiner/dashboard/approve_list" title="Go Back">&nbsp;&nbsp;<<< BACK&nbsp;</a>

        </div>
        <div>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>
  <script type="text/javascript">
  
  function confirmAction() {
  
  response = confirm("Are you sure you want to approve these results?");
  if(response == true){
   return true;
  }
    else if (response == false){
    event.preventDefault();
  }
  
  }
  </script>