<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PMS | Home</title>
  <?php include('header.php'); ?>   
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include('header-body.php'); ?>
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
      <div class="row">
         <div class="col-md-4">
            <div class="box box-solid box-danger" style="">
              <div class="box-header">
                 <h3 class="box-title">Critically Pending Tasks</h3>
              </div>
              <div align="center" class="box-body">
                 1
              </div>
            </div>
            <div class="box box-solid box-warning" style="">
              <div class="box-header">
                 <h3 class="box-title">
  Carry Forwarded Tasks</h3>
              </div>
             <div align="center" class="box-body">
                 1
              </div>
            </div>
         </div>
        
         <div class="col-md-4">
            <div class="box box-solid box-info" style="">
              <div class="box-header">
                 <h3 class="box-title">Newly Delighted Tasks</h3>
              </div>
              <div align="center" class="box-body">
                 1
              </div>
            </div>
            <div class="box box-solid box-default" style="">
              <div class="box-header">
                 <h3 class="box-title">Newly Allocated Tasks</h3>
              </div>
              <div align="center" class="box-body">
                 1
              </div>
            </div>
         </div>         
         <div class="col-md-4">
            <div class="box box-solid box-success" style="">
              <div class="box-header">
                 <h3 class="box-title">Completed Tasks</h3>
              </div>
              <div align="center" class="box-body">
                 1
              </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="box box-solid box-primary" style="">
              <div class="box-header">
                 <h3 class="box-title">Events</h3>
              </div>
              <div align="center" class="box-body">
                 1
              </div>
            </div>
         </div>
      </div>
      
     
      <!-- Announcement start -->
      
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Announcement</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" style="overflow:auto;" class="table table-bordered table-striped" >
                <thead>
                <tr style="background-color:#A9CCE3">
                  <th>Date</th>                  
                  <th>Title</th>                  
                  <th>Description</th>                
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>11-Jan-19</td>                 
                  <td>New member joins our team</td>  
                  <td>Harry has joins AVI today as PHP Developer</td>                  
                </tr>
                 <tr>
                  <td></td>                 
                  <td> </td>  
                  <td> </td>                     
                </tr>               
                </tbody>
                <tfoot>
                
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    <!-- Announcement end -->
     <!-- Events start -->      
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Events</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" style="overflow:auto;" class="table table-bordered table-striped" >
                <thead>
                <tr style="background-color:#A9CCE3">
                  <th>Date</th>                  
                  <th>Event Name</th>                  
                  <th>Notes</th>                
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>14-Jan-19</td>                 
                  <td>Makar Sankranti Holiday</td>  
                  <td></td>                                    
                </tr>
                 <tr>
                  <td></td>                 
                  <td> </td>  
                  <td> </td>                     
                </tr>               
                </tbody>
                <tfoot>
                
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    <!-- Events end -->
    </section>
    <!-- /Main content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('footer.php'); ?>
  <?php include('side-controllbar.php');?>
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