<!DOCTYPE html>
<html>
<head>
  <title>PMS | Edit-Employee</title>
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
  </style>
  <script type="text/javascript">
    function userN()
    {       
       var uname = document.getElementById('fname').value;
       var getyear = document.getElementById('datepicker').value;
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
       else if(document.getElementById('addressCopy').checked == false)
       {
          permanent.value = document.getElementById('paddress').value;
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
        Edit Employee
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Employee</li>
      </ol>
    </section>

    <!-- Main content -->
    <br>
    <div class="col-md-6" style="margin-left: 15%;width: 70%;">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Employee</h3>
            </div>
            <!-- /.box-header -->
            <!-- alerts start -->
              <?php if($this->session->flashdata('warning')) {?>
              <div class="myAlert alert alert-warning" role="alert">
                  <h5><?php echo $this->session->flashdata('warning') ?></h5>
              </div>
            <?php } ?>
             <!-- alerts end -->
            <!-- form start -->
            <?php
                  $c=1;
                  foreach ($row->result() as $key)
                   {

            ?>
            <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/main_controller/edit_employee/'.$key->emp_id); ?>" enctype="multipart/form-data">
              <div class="box-body">
                  
                 <!--  <?php if($this->session->flashdata('warning')) {?>
                    <div class="myAlert alert alert-warning" role="alert">
                         <h5><?php echo $this->session->flashdata('warning') ?></h5>   
                    </div>
                  <?php } ?> -->

                <div class="form-group">

                  <label for="inputEmail3" class="col-sm-2 control-label">Salutation</label>

                  <div class="col-sm-10">
                    <input type="radio" <?php if($key->salutation == 'Mr'){ ?> checked="true" <?php }?> value="Mr" class="minimal" name="gen">&nbsp;Mr
                    <input type="radio" <?php if($key->salutation == 'Ms'){ ?>checked="true" <?php } ?> value="Ms" class="minimal" name="gen">&nbsp;Ms
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">First Name</label>
                  <div class="col-sm-10">                     
                    <input type="text" class="form-control" name="fname" id="fname" required placeholder="First Name" value="<?=$key->firstname?>"><h6 class="error"><?php echo form_error('fname'); ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Middle Name</label>
                  <div class="col-sm-10">                     
                    <input type="text" value="<?=$key->middlename?>" class="form-control" name="mname" id="mname"  placeholder="Middle Name"><h6 class="error"><?php echo form_error('mname'); ?></h6>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Last Name</label>
                  <div class="col-sm-10">                     
                    <input type="text" required class="form-control" name="lname" id="lname" placeholder="Last Name" value="<?=$key->lastname?>"><h6 class="error"><?php echo form_error('lname'); ?></h6>
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
                  <input type="date" value="<?=$key->birthday?>"  name="birthdate" class="form-control pull-right" id="datepicker"><h6 class="error"><?php echo form_error('birthdate'); ?></h6>
                </div>
                      <!-- date end -->
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Designation</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" style="width: 100%;" name="designation">
                  
                  <option selected disabled="">--select designation--</option>    
                    <<?php if(count($getjobtype)): ?>
                        <?php foreach ($getjobtype as $jobtype): ?>
                            <option value="<?php echo $jobtype->jt_id;?>" <?php if($jobtype->jt_id == $key->designation_id){ ?> selected <?php }?>><?php echo $jobtype->jt_name; ?> </option>
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
                  <input type="date" required value="<?=$key->joining_date?>" name="joiningdate" class="form-control pull-right" id="datepicker"><h6 class="error"><?php echo form_error('joiningdate'); ?></h6>
                </div>
                      <!-- date end -->
                  </div>
                </div>               
                 <!-- <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Image</label>
                  <div class="col-sm-10">
                    <?php //echo form_open_multipart('/main_controller/do_ipload'); ?>                     
                    <input type="file" class="form-control" name="pimage" id="pimage">                 
                  </div>
                </div> -->
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Mobile No</label>

                  <div class="col-sm-10">
                    <input type="text"  onfocus="userN()" onclick="userN()" placeholder="Enter Contact" name="contact" class="form-control" value="<?=$key->mobile_no?>" data-inputmask='"mask": "(99)99999-99999"' data-mask><h6 class="error"><?php echo form_error('contact'); ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Skype ID</label>

                  <div class="col-sm-10">
                    <input type="text"  placeholder="Skype Id" value="<?=$key->skype?>" name="skypeid" class="form-control" ><h6 class="error"><?php echo form_error('skypeid'); ?></h6>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Current Address</label>

                  <div class="col-sm-10">
                    <textarea placeholder="Enter.." class="form-control" required  name="caddress" id="caddress"><?=$key->current_address ?></textarea><h6 class="error"><?php echo form_error('caddress'); ?></h6>
                  </div>
                </div> 
                 <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">                    
                    <label>
                          <input type="checkbox" id="addressCopy" onclick="copyAddress()" name="addressCopy">Same as current address
                    </label>                   
                  </div>
                </div>   
                 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Permanent Address</label>

                  <div class="col-sm-10">
                    <textarea placeholder="Enter.." class="form-control"  name="paddress" id="paddress"><?=$key->permanent_address ?></textarea><h6 class="error"><?php echo form_error('paddress'); ?></h6>
                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Username<label class="impf">*</label></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  id="username" value="<?=$key->username?>" name="username" placeholder="username"><h6 class="error"><?php echo form_error('username'); ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Personal Email<label class="impf">*</label></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" required id="pemail" value="<?=$key->personal_email?>" name="pemail" placeholder="abc@gmail.com"><h6 class="error"><?php echo form_error('pemail'); ?></h6>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Company Email</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="cemail" name="cemail" placeholder="abc@gmail.com" value="<?=$key->company_email?>"><h6 class="error"><?php echo form_error('cemail'); ?></h6>
                  </div>
                </div>               
               <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                        <input type="checkbox" name="is_active" <?php if($key->IsActive == 1){ ?> checked <?php } ?>>  Is Active
                      </label>
                    </div>
                  </div>
                </div> 
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Company</label>

                  <div class="col-sm-10">
                     <div class="checkbox">
                        <?php if(count($getbusinessunit)): ?>
                            <?php foreach($getbusinessunit as $BUList): ?>
                            <label>
                              <input type="radio" class="minimal" name="businessUnit" value="<?php echo $BUList->bu_id;?>" <?php if($BUList->bu_id == $key->businessunit_id){ ?> checked <?php }?>> &nbsp;<?php echo $BUList->businessUnitName; ?> &nbsp;                     
                            </label>
                            <?php endforeach;?>                                       
                      <?php endif; ?>                        
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
              <!-- /.box-body -->
              <div class="box-footer">
                <input  type="button" value="Cancel" onClick="javascript:history.go(-1)" class="btn btn-default">
                <input type="submit" name="submit" class="btn btn-info pull-right" value="Update">
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
  $('.myAlert').click('closed.bs.alert', function () {
        $('.myAlert').alert('close')
    });
   $(function() {
               $("#datepicker").datepicker({ dateFormat: "yyyy-mm-dd" }).val()               
       });

</script>
</body>
</html>