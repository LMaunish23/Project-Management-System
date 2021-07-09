<!DOCTYPE html>
<html>
<head>
  <title>PMS | Add-Admin</title>
  <?php include('header.php'); ?> 
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/plugins/iCheck/all.css">
  <style type="text/css">
    .error{
      color: red;
      text-align: right;
      font-weight: bolder;
      font-family: consolas;      
    }
    .impf{
      color: red;
      font-size: small;
    }
  </style>  
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
        Add Admin
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active">Add Admin</li>
      </ol>      
    </section>

    <!-- Main content -->
    <br>
    <div class="col-md-6" style="margin-left: 15%;width: 70%;">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Admin</h3>
            </div>
            <!-- /.box-header -->
            <!-- alerts start -->
              <?php if($this->session->flashdata('success')) {?>
                <div class="myAlert alert alert-success alert-dismissible" role="alert">
                   <strong>Successfull !</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->session->flashdata('success') ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url('index.php/main_controller/admin_viewpage'); ?>" class="alert-link">View Admins.</a>
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>   
              </div>             
            <?php } ?>
            <?php if($this->session->flashdata('error')) {?>
              <div class="myAlert alert alert-danger" role="alert">
                   <h5><?php echo $this->session->flashdata('error') ?></h5>   
              </div>
            <?php } ?>           
            <!-- alerts End -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/main_controller/add_admin'); ?>" enctype="multipart/form-data">
              <div class="box-body">       
               
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Image</label>
                  <div class="col-sm-10">
                    <?php echo form_open_multipart('/main_controller/do_upload2'); ?>                     
                    <input type="file" class="form-control" name="admin_img" id="admin_img">                 
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Username<label class="impf">*</label></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  id="username" name="username" placeholder="username"><h6 class="error"><?php echo form_error('username'); ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Email<label class="impf">*</label></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" required id="email" name="email" placeholder="abc@gmail.com"><h6 class="error"><?php echo form_error('email'); ?></h6>
                  </div>
                </div>                
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Password<label class="impf">*</label></label>

                  <div class="col-sm-10">
                    <input type="Password" class="form-control" required id="Password" name="password" placeholder="Enter Password"><h6 class="error"><?php echo form_error('password'); ?></h6>
                  </div>
                </div>
               <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                        <input type="checkbox" class="minimal" name="is_active"> Is Active
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
               $("#datepicker1").datepicker({ dateFormat: "yyyy-mm-dd"}).val()
       });
    $(function() {
               $("#datepicker2").datepicker({ dateFormat: "yyyy-mm-dd"}).val()
       });
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });


</script>
</body>
</html>