<!DOCTYPE html>
<html>
<head>
  <title>PMS | Add-Task</title>
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
        Add Task
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
              <h3 class="box-title">Add Task</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/main_controller/add_task'); ?>" enctype="multipart/form-data">
              <div class="box-body">    
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">                     
                    <input type="text" class="form-control" name="task_title" id="task_title" required=""  placeholder="Task Title">            
                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Project</label>
                  <div class="col-sm-10">
                   <i class="fa fa-search" style="position: absolute;top: 11px;left: 4%;font-size: 15px;"></i>  <input placeholder="Enter Project Name" type="text" style="background-color: #E5E8E8;font-weight: bold;text-indent: 30px;" name="sproject_name" id="sproject_name" class="form-control"> 
                    <input type="hidden" name="pro_id" id="pro_id">                                     
                    <a href="<?php echo base_url('index.php/main_controller/project_addpage'); ?>"><i class="fa fa-plus" style="position: absolute;top: 11px;left: 94%;font-size: 15px;"></i></a>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Activity Type</label>
                  <div class="col-sm-10">
                    <select class="form-control select2" style="width: 100%;" name="activityType">
                       <option selected="" disabled="">--select activity--</option>
                      <?php if(count($getactivityType)): ?>
                        <?php foreach ($getactivityType as $getAType): ?>
                            <option value="<?php echo $getAType->activity_id;?>"><?php echo $getAType->activity_name; ?> </option>
                        <?php endforeach; ?>
                      <?php endif; ?> 
                    </select>
                  </div>
                </div>                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">                     
                    <textarea class="form-control" name="task_desc" id="task_desc"   placeholder="Description"></textarea>    
                  </div>
                </div>
                 <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                        <input type="checkbox" name="is_ongoing"> Is OnGoing
                      </label>
                    </div>
                  </div>
                </div> 
                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Start Date</label>
                  <div class="col-sm-10">                     
                    <input type="date" name="task_startdate" id="task_startdate" class="form-control">  
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">End Date</label>
                  <div class="col-sm-10">                     
                    <input type="date" name="task_enddate" id="task_enddate" class="form-control">  
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Estimated Time</label>
                  <div class="col-sm-10">                   
                      <select  name="whh">                        
                        <option disabled="" class="form-control" selected>hh</option>
                        <?php $i = 1; while ($i < 100) { ?>
                        <option><?php $i = sprintf('%02d',$i); echo $i; ?></option><?php $i++; } ?>            
                      </select>
                  
                      <select name="wmm">
                        <option disabled="" selected>mm</option>
                        <option>15</option>
                        <option>30</option>
                        <option>45</option>
                      </select> 
                    
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
<script>
   $(function() {
               $("#datepicker").datepicker({ dateFormat: "yyyy-mm-dd" }).val();              
  });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>var $j1 = jQuery.noConflict();</script>

<script type="text/javascript"> 
$j1(document).ready(function() {

    $j1("#sproject_name").autocomplete({
        source: function(request,response){
          $.ajax({          
          url: "<?php echo base_url('index.php/main_controller/autocompleteproject'); ?>",
          dataType: "json",
          data: {
            q: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 2,
      select: function( event, ui ) {
        $j1('#pro_id').val(ui.item.id);
      },
    });
  });
</script>
</body>
</html>
	