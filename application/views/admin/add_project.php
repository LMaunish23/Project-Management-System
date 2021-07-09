<!DOCTYPE html>
<html>
<head>
  <title>PMS | Add-Project</title>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
   <?php include('header.php'); ?>
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
       Add Project
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Project</li>
      </ol>
    </section>

    <!-- Main content -->
     <br><br>  
    <div class="col-md-6" style="margin-left: 12%;width: 75%">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Project</h3>
            </div>
            <!-- /.box-header -->
            <!-- alerts start -->
              <?php if($this->session->flashdata('success')) {?>
                <div class="myAlert alert alert-success alert-dismissible" role="alert">
                   <strong>Successfull !</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->session->flashdata('success') ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url('index.php/main_controller/project_viewpage'); ?>" class="alert-link">View Projects.</a>
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
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/main_controller/add_project_data'); ?>" enctype="multipart/form-data">
              <div class="box-body">      

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Title<label class="impf">*</label></label>
                  <div class="col-sm-10">                     
                    <input type="text" class="form-control" name="ptitle" id="ptitle" required=""  placeholder="Project Title">            
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Client Name<label class="impf">*</label></label>
                  <div class="col-sm-10">                     
                    
                    <i class="fa fa-search" style="position: absolute;top: 11px;left: 4%;font-size: 15px;"></i>  <input placeholder="Enter Client Name" type="text" style="background-color: #E5E8E8;font-weight: bold;text-indent: 30px;" name="csearch" id="csearch" class="form-control"> 
                    <input type="hidden" name="com_id" class="com_id">                                     
                    <a href="<?php echo base_url('index.php/main_controller/client_addpage'); ?>"><i class="fa fa-plus" style="position: absolute;top: 11px;left: 94%;font-size: 15px;"></i></a>
                   
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
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                        <input type="checkbox" name="is_ongoing"> Is On Going
                      </label>
                    </div>
                  </div>
                </div>                               
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Booking Date<label class="impf">*</label></label>
                  <div class="col-sm-10">                     
                    <input type="date" name="bookdate" id="bookdate" class="form-control">  
                  </div>
                </div>
                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Start Date</label>
                  <div class="col-sm-10">                     
                    <input type="date" name="psdate" id="psdate" class="form-control">  
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">End Date</label>
                  <div class="col-sm-10">                     
                    <input type="date" name="pedate" id="pedate" class="form-control">  
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Estimated Time</label>
                  <div class="col-sm-10">  
                    <div class="row">
                        <div class="col-xs-4">
                          <input type="text" id="hh" onkeyup="addDetails()" name="hh" class="form-control" placeholder="hh">
                          <input type="hidden" id="total_time" name="total_time">
                        </div>
                        <div class="col-xs-3">
                          <label type="text" id="lbldays"  name="lbldays"></label>
                        </div>                        
                        <div class="col-xs-3">
                          <label type="text" id="lblmonth"  name="lblmonth"></label>
                        </div>
                    </div>
                  </div>
                </div>              
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                        <input type="checkbox" name="is_billable"> Is Billable
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Technology</label>
                  <div class="col-sm-10">                     
                    <input type="text" class="form-control" name="technology" id="technology" placeholder="Enter..">            
                  </div>
                </div> 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Remark<label class="impf">*</label></label>
                  <div class="col-sm-10">                     
                    <textarea class="form-control" name="remark" required="" id="remark" placeholder="Enter.."></textarea>         
                  </div>
                </div>                 
                <div class="form-group">        
                
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                        <input type="checkbox" name="is_active"> Is Active
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>var $jq = jQuery.noConflict();</script>

<script type="text/javascript"> 
$jq(document).ready(function() {    

     $jq("#csearch").autocomplete({
        source: function(request,response){
          $.ajax({          
          url: "<?php echo base_url('index.php/Main_Controller/autocompleteclient'); ?>",
          dataType: "json",
          data: {
            q: $jq("#csearch").val()
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 2,
      select: function( event, ui ) {
        $jq('.com_id').val(ui.item.id);
      },
    });
    $jq("#account_manager").autocomplete({
        source: function(request,response){
          $.ajax({          
          url: "<?php echo base_url('index.php/main_controller/autocompleteemployee'); ?>",
          dataType: "json",
          data: {
            q:  $jq("#account_manager").val()
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 2,
      select: function( event, ui ) {
        $jq('.am_id').val(ui.item.id);
      },
    }); 
    $jq("#project_manager").autocomplete({
        source: function(request,response){
          $.ajax({          
          url: "<?php echo base_url('index.php/main_controller/autocompleteemployee'); ?>",
          dataType: "json",
          data: {
            q: $jq("#project_manager").val()
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 2,
      select: function( event, ui ) {
        $jq('.pm_id').val(ui.item.id);
      },
    }); 
    $jq("#team_leader").autocomplete({
        source: function(request,response){
          $.ajax({          
          url: "<?php echo base_url('index.php/main_controller/autocompleteemployee'); ?>",
          dataType: "json",
          data: {
            q: $jq("#team_leader").val()
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 2,
      select: function( event, ui ) {
        $jq('.tl_id').val(ui.item.id);
      },
    });   
//document.ready end   
});

</script> 
<script type="text/javascript">
   function addDetails()
   {
      var h = document.getElementById('hh').value; 
      document.getElementById('total_time').value = h * 60;          
      document.getElementById('lbldays').innerHTML = 'Approx : ' + Math.round((h * 60) / 1440) + '  Days';
      document.getElementById('lblmonth').innerHTML = 'Approx : ' + Math.round(h * 60 / 43800.048
) + '  Months';
      
   }
</script>
</body>
</html>
	