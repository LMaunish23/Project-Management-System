<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PMS | View All Tasks</title>
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
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <!-- Tasks List for My Self start -->
      
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tasks List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow:scroll;white-space: nowrap;">
              <table id="example1"  class="table table-bordered table-striped" >
                <thead>
                <tr style="background-color:#A9CCE3">
                  <th>Task No</th>                  
                  <th>Project Name</th>                  
                  <th>Task Title</th>
                  <th>Priority</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Allocated Date</th>
                  <th>Estimated Time</th>
                  <th>Spent Time</th>
                  <th>Allocated By</th>
                  <th>Reporting To</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>AVI001.00001.0000000001</td>                 
                  <td>AVI Web Solutions' Official Website</td>  
                  <td>Home Page Design</td>
                  <td>High</td>
                  <td>01-02-2019</td> 
                  <td>01-02-2019</td>
                  <td>11-01-2019</td>
                  <td>04:00:00 AM</td> 
                  <td>12:00:00 AM</td>
                  <td>Harry Pet</td>                  
                  <td>Harry Pet</td>
                  <td><span class="label label-success">Approved</span></td>
                </tr>
                 <tr>
                  <td>AVI001.00001.0000000001</td>                  
                  <td>AVI Web Solutions' Official Website</td>  
                  <td>Home Page Design</td>
                  <td>High</td>
                  <td>01-02-2019</td> 
                  <td>01-02-2019</td>
                  <td>11-01-2019</td>
                  <td>04:00:00 AM</td> 
                  <td>12:00:00 AM</td>
                  <td>Harry Pet</td>                  
                  <td>Harry Pet</td>
                  <td><span class="label label-warning">Pending</span></td>
                </tr>
                <tr>
                  <td>AVI001.00001.0000000001</td>                  
                  <td>AVI Web Solutions' Official Website</td>  
                  <td>Home Page Design</td>
                  <td>High</td>
                  <td>01-02-2019</td> 
                  <td>01-02-2019</td>
                  <td>11-01-2019</td>
                  <td>04:00:00 AM</td> 
                  <td>12:00:00 AM</td>
                  <td>Harry Pet</td>                  
                  <td>Harry Pet</td>
                  <td><span class="label label-primary">Approved</span></td>
                </tr>
                 <tr>
                  <td>AVI001.00001.0000000001</td>
                  <td>AVI Web Solutions' Official Website</td>  
                  <td>Home Page Design</td>
                  <td>High</td>
                  <td>01-02-2019</td> 
                  <td>01-02-2019</td>
                  <td>11-01-2019</td>
                  <td>04:00:00 AM</td> 
                  <td>12:00:00 AM</td>
                  <td>Harry Pet</td>                  
                  <td>Harry Pet</td>
                  <td><span class="label label-danger">Denied</span></td>
                </tr>
                </tbody>
                <tfoot>
                
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    

      <!-- Tasks List for My Self end -->     
    </section>
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
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
</script>
</body>
</html>