<!DOCTYPE html>
<html>
<head>
  <title>PMS | View-Businessunits</title>
  <?php include('application/views/header.php'); ?> 
  
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include('application/views/header-body.php'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="overflow: auto;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>       
        <small>View Business Units</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Business Units</li>
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

   ?>
  <br>
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Business Units</h3>
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
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>                  
                  <th>Name</th>
                  <th>Website</th>
                  <th>Email</th>
                  <th>Contact</th>
                 
                  <th colspan="2">Operation</th>
                </tr>
                </thead>
                <?php

              $c=1;
              foreach ($row->result() as $key)
               {

              ?>
              <tbody>
                  <tr>
                    <td class="td"><?=$c++?></td> 
                    <td class="td"><?=$key->businessUnitName?></td>
                    <td class="td"><a href="<?=$key->website?>"><?=$key->website?></a></td>
                    <td class="td"><?=$key->email?></td>
                    <td class="td"><?=$key->contactNo?></td>  
                    <td class="td"><a href="<?php echo base_url('index.php/main_controller/businessunit_editpage/'.urlencode(base64_encode($key->bu_id))); ?>"><i class="fa fa-edit (alias)"></i>&nbsp;Edit</a></td>
                    <td class="td"><a style="cursor: not-allowed;" href=""><i class="fa fa-minus-square"></i>&nbsp;Delete</a></td>
                   </tr>          
              </tbody>
              <?php } ?>
          </table>
      </div>
      <!-- /.box-body -->
     </div>
      <!-- /.box -->
<?php } ?>
<!-- /Main content -->
     
  </div>
  <!-- /.content-wrapper -->
  <?php include('application/views/footer.php'); ?>
  <?php include('application/views/side-controllbar.php');?>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<?php include('application/views/ex-jquery.php'); ?>
<script>
  $('.myAlert').click('closed.bs.alert', function () {
        $('.myAlert').alert('close')
    });
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
</body>
</html>