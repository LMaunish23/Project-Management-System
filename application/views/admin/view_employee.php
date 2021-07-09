<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PMS | View-Employee</title>
  <?php include('header.php'); ?> 
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/datatables/dataTables.bootstrap.css"> 
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include('header-body.php'); ?>  
  <!-- Left side column. contains the logo and sidebar -->
 <?php include('sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>       
        <small>View Employee Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active">View Employee Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <?php 
          $record = $row->result(); 
          $c = count($record);
          if(count($record) == 0)
          {
    ?>
    <br><br>
    
    <h3 align="center" style="font-size: xx-large">No Record Found</h3> 
    
  <?php   }  else   {   ?>
  <br>
    <section class="content">
      <div class="row">
                
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Employee Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- alerts start -->
              <?php if($this->session->flashdata('success')) {?>
              <div class="myAlert alert alert-success" role="alert">
                  <?php echo $this->session->flashdata('success') ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </div>
            <?php } ?>
            <?php if($this->session->flashdata('error')) {?>
              <div class="myAlert alert alert-danger" role="alert">
                   <?php echo $this->session->flashdata('error') ?>
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </div>
            <?php } ?>           
            <!-- alerts End -->
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Designation</th>
                  <th>Contact</th>
                  <th>Skype</th>
                  <th>Email</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                
                <tbody>
                  <?php $c=1; foreach ($row->result() as $key) { ?>
                   <tr>
                      <td><?=$c++?></td>
                      <td><?=$key->salutation?>&nbsp;<?=$key->firstname?>&nbsp;&nbsp;<?=$key->lastname?></td>
                      <td><?php for($i = $c; $i >= $c;$i--): ?>
                        <?php foreach ($getjobtype as $jobtype): ?>
                            <?php if($jobtype->jt_id == $key->designation_id){ echo $jobtype->jt_name; } ?>
                          <?php endforeach; ?>
                      <?php endfor; ?></td>
                      <td><?=$key->mobile_no?></td>
                      <td><?=$key->skype?></td>
                      <td><?=$key->personal_email?></td>
                      <td><a href="<?php echo base_url('index.php/main_controller/employee_editpage/'.urlencode(base64_encode($key->emp_id))); ?>"><i class="fa fa-edit (alias)"></i>&nbsp;Edit</a></td>
                      <td><a style="cursor: not-allowed;" href=""><i class="fa fa-minus-square"></i>&nbsp;Delete</a></td>
                  </tr>
                  <?php } ?>
                </tbody>                
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Designation</th>
                  <th>Contact</th>
                  <th>Skype</th>
                  <th>Email</th>
                  <th>Edit</th>
                  <th>Delete</th>
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
  <?php include('footer.php'); ?>
  <!-- Control Sidebar -->
  <?php include('side-controllbar.php');?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include('ex-jquery.php'); ?>
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
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

</body>
</html>
