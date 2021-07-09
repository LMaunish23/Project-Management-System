<!DOCTYPE html>
<html>
<head>
  <title>PMS | Edit Holiday</title>
  <?php include('header.php'); ?>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
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
        Holiday Set
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Holiday</li>s
      </ol>
    </section>

    <!-- Main content -->
     <br><br>  
    <div class="col-md-6" style="margin-left: 12%;width: 75%">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Holiday</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
                  
                  foreach ($row->result() as $key)
                   {

            ?>
            <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/main_controller/edit_holiday/'.$key->holiday_id); ?>" enctype="multipart/form-data">
              <div class="box-body"> 
                
                 <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Holiday Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  value="<?php echo $key->holiday_title ?>" name="holiday_title" id="holiday_title" required="" placeholder="Holiday Title">
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Holiday Date</label>
                  <div class="col-sm-10">                     
                    <input type="date" name="holiday_date" id="holiday_date" value="<?php echo $key->holiday_date ?>" class="form-control">  
                  </div>
                </div>                     
           </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input  type="button" value="Cancel" onClick="javascript:history.go(-1)" class="btn btn-default">
                <input type="submit" name="submit" class="btn btn-info pull-right" value="Update">
              </div>
              <!-- /.box-footer -->
          
            </form>
            <?php } ?>
          </div>
          <!-- /.box -->
</div>   

      
        
    <!-- /Main content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('footer.php'); ?>
  <?php include('side-controllbar.php');?>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<?php include('ex-jquery.php'); ?>
<script>
   $(function() {
               $("#datepicker").datepicker({ dateFormat: "yyyy-mm-dd" }).val();              
  });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>var $j1 = jQuery.noConflict();</script>

</body>
</html>
	