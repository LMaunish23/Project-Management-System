<html>
<head>
  <title>PMS | Add-Client</title>  
  <?php include('header.php'); ?> 
   <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css" rel="stylesheet" type="text/css">
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
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/plugins/fxss-rate/rate.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="<?php echo base_url() ?>/assets/plugins/fxss-rate/rate.js"></script>  
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
        Add Client
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <br><br>  
    <div class="col-md-6" style="margin-left: 12%;width: 75%">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Client</h3>
            </div>
            <!-- /.box-header -->
            <!-- alerts start -->
              <?php if($this->session->flashdata('success')) {?>
                <div class="myAlert alert alert-success alert-dismissible" role="alert">
                   <strong>Successfull !</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->session->flashdata('success') ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url('index.php/main_controller/client_viewpage'); ?>" class="alert-link">View Clients.</a>
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
      <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/main_controller/add_client'); ?>" enctype="multipart/form-data">
       <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Name<label class="impf">*</label></label>
                  <div class="col-sm-10">                     
                    <input type="text" class="form-control" name="cname" id="cname" required placeholder="Client Name"><h6 class="error"><?php echo form_error('cname'); ?></h6>               
                  </div>
                </div> 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Website</label>
                  <div class="col-sm-10">                     
                    <input type="text" class="form-control" name="website" id="website" placeholder="Enter.."> <h6 class="error"><?php echo form_error('website'); ?></h6>               
                  </div>
                </div>
                 <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Rating<label class="impf">*</label></label>
                  <div class="col-sm-10">                     
                    <div class="paragraph padding-left-20">
                        <div id="rateBox"></div>
                        <input type="hidden" name="rateNum" value="" id="rateNum">
                            <script>
                                $("#rateBox").rate({
                                    length: 5,
                                    value: 3,
                                    readonly: false,
                                    size: '25px',
                                    selectClass: 'fxss_rate_select',
                                    incompleteClass: 'fxss_rate_no_all_select',
                                    customClass: 'custom_class',
                                    callback: function(object){
                                        console.log(object)                                       
                                        $('#rateNum').val(object.index);
                                    },                                     
                                });
                            </script>
                        </div>                    
                    </div>
                </div> 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email<label class="impf">*</label></label>
                  <div class="col-sm-10">                     
                    <input type="text" class="form-control" name="email" id="email" required placeholder="Enter.."><h6 class="error"><?php echo form_error('email'); ?></h6>               
                  </div>
                </div>                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Alternet Email</label>
                  <div class="col-sm-10">                     
                    <input type="text" class="form-control" name="aemail" id="aemail" placeholder="Enter.."><h6 class="error"><?php echo form_error('aemail'); ?></h6>               
                  </div>
                </div> 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Billing Email<label class="impf">*</label></label>
                  <div class="col-sm-10">                     
                    <input type="text" class="form-control" name="bemail" id="bemail" required placeholder="Enter.."><h6 class="error"><?php echo form_error('bemail'); ?></h6>               
                  </div>
                </div> 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Account Manager<label class="impf">*</label></label>
                  <div class="col-sm-10">                     
                       <select class="form-control select2" style="width: 100%;" name="account_manager">
                      <option selected="" disabled="">--select employee--</option>
                      <?php if(count($getemplist)): ?>
                        <?php foreach ($getemplist as $emplist): ?>
                            <option value="<?php echo $emplist->emp_id;?>"><?php echo $emplist->firstname?>&nbsp;&nbsp;<?php echo $emplist->lastname?></option>
                        <?php endforeach; ?>
                      <?php endif; ?>                       
                    </select>            
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Project Manager<label class="impf">*</label></label>
                  <div class="col-sm-10">                     
                        <select class="form-control select2" style="width: 100%;" name="project_manager">
                      <option selected="" disabled="">--select employee--</option>
                      <?php if(count($getemplist)): ?>
                        <?php foreach ($getemplist as $emplist): ?>
                            <option value="<?php echo $emplist->emp_id;?>"><?php echo $emplist->firstname?>&nbsp;&nbsp;<?php echo $emplist->lastname?></option>
                        <?php endforeach; ?>
                      <?php endif; ?>                        
                    </select>           
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Team Leader<label class="impf">*</label></label>
                  <div class="col-sm-10">                     
                       <select class="form-control select2" style="width: 100%;" name="teamLeader">
                      <option selected="" disabled="">--select employee--</option>
                      <?php if(count($getemplist)): ?>
                        <?php foreach ($getemplist as $emplist): ?>
                            <option value="<?php echo $emplist->emp_id;?>"><?php echo $emplist->firstname?>&nbsp;&nbsp;<?php echo $emplist->lastname?></option>
                        <?php endforeach; ?>
                      <?php endif; ?>                         
                    </select>            
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Contact No</label>
                  <div class="col-sm-10">                     
                    <input type="text" class="form-control" name="contact" id="contact" placeholder="Contact No"><h6 class="error"><?php echo form_error('contact'); ?></h6>               
                  </div>
                </div>                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
                  <div class="col-sm-10">                     
                    <textarea class="form-control" name="address" placeholder="Enter Address..." id="address"></textarea> <h6 class="error"><?php echo form_error('address'); ?></h6>                 
                  </div>
                </div>                            
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">City<label class="impf">*</label></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="city" id="city" placeholder="City"><h6 class="error"><?php echo form_error('city'); ?></h6> 
                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Country<label class="impf">*</label></label>
                  <div class="col-sm-10">                   
                    <select class="form-control select2" style="width: 100%;" name="country">
                       <option selected="" disabled="">--select country--</option>
                      <?php if(count($getcountry)): ?>
                        <?php foreach ($getcountry as $country): ?>
                            <option value="<?php echo $country->id;?>"><?php echo $country->name; ?> </option>
                        <?php endforeach; ?>
                      <?php endif; ?>                   
                    </select>
                    <h6 class="error"><?php echo form_error('country'); ?></h6> 
                  </div>
                </div>        
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Comment<label class="impf">*</label></label>

                  <div class="col-sm-10">
                    <textarea class="form-control" name="comment" id="comment"></textarea><h6 class="error"><?php echo form_error('comment'); ?></h6> 
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
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- jQuery 2.2.3 -->
<?php include('ex-jquery.php'); ?>

</body>
</html>