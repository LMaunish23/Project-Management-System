<!DOCTYPE html>
<html>
<head>
  <title>PMS | Announcement</title>
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
        Announcement
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Announcement</li>s
      </ol>
    </section>

    <!-- Main content -->
     <br><br>  
    <div class="col-md-6" style="margin-left: 12%;width: 75%">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Announcement</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           <!-- alerts start -->
              <?php if($this->session->flashdata('success')) {?>
                <div class="myAlert alert alert-success alert-dismissible" role="alert">
                   <strong>Successfull !</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->session->flashdata('success') ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url('index.php/main_controller/announcement_viewpage'); ?>" class="alert-link">View Announcements.</a>
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>   
              </div>             
            <?php } ?>
            <?php if($this->session->flashdata('error')) {?>
              <div class="myAlert alert alert-danger alert-dismissible" role="alert">
                   <?php echo $this->session->flashdata('error') ?>
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
            <?php } ?>           
            <!-- alerts End -->
            <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/main_controller/add_announcement'); ?>" enctype="multipart/form-data">
              <div class="box-body"> 
                
                 <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  name="announcement_title" id="announcement_title" required="" placeholder="Announcement Title">
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Date</label>
                  <div class="col-sm-10">                     
                    <input type="date" name="announcement_date" id="announcement_date" class="form-control">  
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">                     
                    <textarea class="form-control" rows="4" name="announcement_desc" id="announcement_desc"   placeholder="Description"></textarea>    
                  </div>
                </div> 
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                        <input type="checkbox" class="minimal" name="is_public"> is public
                      </label>
                    </div>
                  </div>
                </div>     
           </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input  type="button" value="Cancel" onClick="javascript:history.go(-1)" class="btn btn-default">
                <input type="submit" name="submit" class="btn btn-info pull-right" value="Add">
              </div>
              <!-- /.box-footer -->
          
            </form>
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
	