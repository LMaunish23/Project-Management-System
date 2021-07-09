<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PMS | View-Project</title>
  <?php include('application/views/header.php'); ?> 
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/datatables/dataTables.bootstrap.css"> 
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include('application/views/header-body.php'); ?>  
  <!-- Left side column. contains the logo and sidebar -->
 <?php include('sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>       
        <small>View All Project Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active">View Project Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <?php 
      $record = $row->result(); 
      if(count($record) == 0)
      {
  ?>
  <h3 align="center" style="font-size: xx-large;">No Record Found</h3> 
   <?php
      }
      else
      {   

   ?><br>
    <section class="content">
      <div class="row">
                
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Project Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- alerts start -->            
              <?php if($this->session->flashdata('success')) {?>
              <div class="myAlert alert alert-success alert-dismissible" role="alert">
                  <?php echo $this->session->flashdata('success') ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </div>
            <?php } ?>
            <?php if($this->session->flashdata('error')) {?>
              <div class="myAlert alert alert-danger" role="alert">
                   <h5><?php echo $this->session->flashdata('error') ?></h5>   
              </div>
            <?php } ?>
            <!-- alerts End -->
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Project Code</th>
                  <th>Title</th>
                  <th>Account Manager</th>  
                  <th>Project Manager</th>                 
                  <th>Booking Date</th>                 
                  <th>Status</th>
                  <th>Remarks</th>                 
                </tr>
                </thead>
                
                <tbody>
                  <?php $c=1; foreach ($row->result() as $key) { ?>
                   <tr>
                      <td><?=$c++?></td>
                      <td><?=$key->project_code?></td>
                      <td><?=$key->project_title?></td>
                      <td>
                        <?php foreach ($getEmpList as $emp): ?>                            
                            <?php if($key->account_manager_id == $emp->emp_id){ echo $emp->firstname.' '.$emp->lastname; } ?>
                        <?php endforeach; ?> 
                      </td>
                      <td>
                        <?php foreach ($getEmpList as $emp): ?>                            
                            <?php if($key->project_manager_id == $emp->emp_id){ echo $emp->firstname.' '.$emp->lastname; } ?>
                      <?php endforeach; ?>
                      </td>
                      <td><?php $date = date_create($key->booking_date);
echo date_format($date, 'd -m -Y'); ?></td>
                      <td></td>
                      <td><?php if($key->remark == ""){echo"-";} else {echo $key->remark;}?></td>
                  </tr>
                  <?php } ?>
                </tbody>                
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Project Code</th>
                  <th>Title</th>
                  <th>Account Manager</th>  
                  <th>Project Manager</th>                 
                  <th>Booking Date</th>                 
                  <th>Status</th>
                  <th>Remarks</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
     
       
      </div>
      <!-- /.row -->
    </section>
    <?php } ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('application/views/footer.php'); ?>
  <!-- Control Sidebar -->
  <?php include('application/views/side-controllbar.php');?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include('application/views/ex-jquery.php'); ?>
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>/assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>/assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>var $bu = jQuery.noConflict();</script>
<!-- page script -->
<script>
  $bu(function () {
    $bu("#example1").DataTable();
    $bu('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
  });
</script>

</body>
</html>