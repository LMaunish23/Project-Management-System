<!DOCTYPE html>
<html>
<head>
  <title>PMS | Add-Employee</title>
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
  <script type="text/javascript">
    function userN()
    {       
       var uname = document.getElementById('fname').value;
       var getyear = document.getElementById('datepicker1').value;
       var year = getyear.split("-");          
       document.getElementById('username').value = uname.toLowerCase() + year[0];
    }
    function copyAddress()
    {
       var current = document.getElementById('caddress').value; 
       var permanent = document.getElementById('paddress');
       if(document.getElementById('addressCopy').checked)
       {
          permanent.value = current;
       }
       else
       {
          permanent.value = "";
       }
    }
  </script>
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
        Add Employee
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active">Add Employee</li>
      </ol>      
    </section>

    <!-- Main content -->
    <br>
    <div class="col-md-6" style="margin-left: 15%;width: 70%;">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Employee</h3>
            </div>
            <!-- /.box-header -->
            <!-- alerts start -->
              <?php if($this->session->flashdata('success')) {?>
                <div class="myAlert alert alert-success alert-dismissible" role="alert">
                   <strong>Successfull !</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->session->flashdata('success') ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url('index.php/main_controller/employee_viewpage'); ?>" class="alert-link">View Employees.</a>
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
            <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/main_controller/add_employee'); ?>" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">

                  <label for="inputEmail3" class="col-sm-2 control-label">Salutation</label>

                  <div class="col-sm-10">
                    <input type="radio" checked value="Mr" class="minimal" name="gen">&nbsp;Mr
                    <input type="radio" value="Ms" class="minimal" name="gen">&nbsp;Ms
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">First Name<label class="impf">*</label></label>
                  <div class="col-sm-10">                     
                    <input type="text" class="form-control" name="fname" id="fname" required placeholder="First Name"><h6 class="error"><?php echo form_error('fname'); ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Middle Name</label>
                  <div class="col-sm-10">                     
                    <input type="text" class="form-control" name="mname" id="mname" placeholder="Middle Name"><h6 class="error"><?php echo form_error('mname'); ?></h6>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Last Name<label class="impf">*</label></label>
                  <div class="col-sm-10">                     
                    <input type="text" required class="form-control" name="lname" id="lname" placeholder="Last Name"><h6 class="error"><?php echo form_error('lname'); ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Birthdate</label>
                  <div class="col-sm-10">                          
                     <!-- date start -->        
                        <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date"  name="birthdate" class="form-control pull-right" id="datepicker1"><h6 class="error"><?php echo form_error('birthdate'); ?></h6>
                </div>
                      <!-- date end -->
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Designation <label class="impf">*</label></label>
                  <div class="col-sm-10">
                    <select class="form-control select2" style="width: 100%;" name="designation">
                      <option selected="" disabled="">--select designation--</option>
                      <?php if(count($getjobtype)): ?>
                        <?php foreach ($getjobtype as $jobtype): ?>
                            <option value="<?php echo $jobtype->jt_id;?>"><?php echo $jobtype->jt_name; ?> </option>
                        <?php endforeach; ?>
                      <?php endif; ?>                 
                </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Joining Date<label class="impf">*</label></label>
                  <div class="col-sm-10">                          
                     <!-- date start -->        
                        <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" required name="joiningdate" class="form-control pull-right" id="datepicker2"><h6 class="error"><?php echo form_error('joiningdate'); ?></h6>
                </div>
                      <!-- date end -->
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Image</label>
                  <div class="col-sm-10">
                    <?php echo form_open_multipart('/main_controller/do_ipload'); ?>                     
                    <input type="file" class="form-control" name="pimage" id="pimage">                 
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Mobile No</label>

                  <div class="col-sm-10">
                    <input type="text"  onfocus="userN()" onclick="userN()" placeholder="Enter Contact" name="contact" class="form-control" data-inputmask='"mask": "(99)99999-99999"' data-mask><h6 class="error"><?php echo form_error('contact'); ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Skype ID</label>

                  <div class="col-sm-10">
                    <input type="text"  placeholder="Skype Id" name="skypeid" class="form-control" ><h6 class="error"><?php echo form_error('skypeid'); ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Current Address</label>

                  <div class="col-sm-10">
                    <textarea placeholder="Enter.." class="form-control"  name="caddress" id="caddress"></textarea><h6 class="error"><?php echo form_error('caddress'); ?></h6>
                  </div>
                </div> 
                 <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">                    
                    <label>
                          <input type="checkbox" class="minimal" id="addressCopy" onclick="copyAddress()" name="addressCopy">Same as current address
                    </label>                   
                  </div>
                </div>   
                 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Permanent Address</label>

                  <div class="col-sm-10">
                    <textarea placeholder="Enter.." class="form-control"  name="paddress" id="paddress"></textarea><h6 class="error"><?php echo form_error('paddress'); ?></h6>
                  </div>
                </div>                                                             
                
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Username<label class="impf">*</label></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  id="username" name="username" placeholder="username"><h6 class="error"><?php echo form_error('username'); ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Personal Email<label class="impf">*</label></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" required id="pemail" name="pemail" placeholder="abc@gmail.com"><h6 class="error"><?php echo form_error('pemail'); ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Company Email</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="cemail" name="cemail" placeholder="abc@gmail.com"><h6 class="error"><?php echo form_error('cemail'); ?></h6>
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
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Business Unit</label>

                  <div class="col-sm-10">
                     <div class="checkbox">
                        <?php if(count($getbusinessunit)): ?>
                            <?php foreach($getbusinessunit as $BUList): ?>
                            <label>
                              <input type="radio" class="minimal" name="businessUnit" value="<?php echo $BUList->bu_id;?>"> &nbsp;<?php echo $BUList->businessUnitName; ?> &nbsp;                     
                            </label>
                            <?php endforeach;?>                                       
                      <?php endif; ?>                        
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