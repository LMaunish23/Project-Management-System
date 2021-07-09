<!DOCTYPE html>
<html>
<head>
  <title>PMS | Task-Allocation</title>
  <?php include('application/views/header.php'); ?>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
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
        Task Allocation
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Task Allocation</li>
      </ol>
    </section>

    <!-- Main content -->
     <br><br>  
    <div class="col-md-6" style="margin-left: 12%;width: 75%">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Task Allocation</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
                  
                  foreach ($row->result() as $key){
            ?>
            <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/pmtl_controller/allocateTask');?>" enctype="multipart/form-data">
              <div class="box-body">                  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Project</label>
                  <div class="col-sm-10">                 
                   <input disabled="" placeholder="Enter Project Name"  value="<?php 
                              foreach ($getProjectName as $projectName): 
                                  if($projectName->project_id == $key->projectID)
                                  { 
                                    echo $projectName->project_title;                    
                                  }
                                  else
                                  {
                                    echo "";
                                  }
                              endforeach;
                          ?>" type="text" style="font-weight: bold;" name="sproject_name" id="sproject_name" class="form-control"> 
                    <input type="hidden" name="pro_id" id="pro_id">   
                    
                  </div>
                </div>
                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Task Title</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="task-id" value="<?=$key->pt_id?>">
                   <input type="text" disabled  class="form-control" value="<?=$key->title;?>"  name="task_title" id="task_title" required=""  placeholder="Task Title"> 
                  </div>
                </div>
                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">                     
                    <textarea disabled class="form-control" name="task_desc" id="task_desc"   placeholder="Description"><?php echo $key->description;?></textarea>    
                  </div>
                </div>                            
               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Allocated By</label>
                  <div class="col-sm-10">                   
                     <input type="text" disabled="" class="form-control" placeholder="<?php echo $_SESSION["username"] ?>" style="cursor: not-allowed;" name="allocated_by" value="<?php $_SESSION["user_id"]; ?>">                
                  </div>
                </div> 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Allocated Date</label>
                  <div class="col-sm-10">                     
                    <input type="date" name="task_allocatedDate" id="task_allocatedDate" class="form-control">  
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Allocated To</label>
                  <div class="col-sm-10">                   
                    <select class="form-control select2" style="width: 100%;" name="Allocated_To">
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
                  <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">                   
                    <select class="form-control select2" style="width: 100%;" name="allocation_status">
                      <option disabled="">--select status--</option>
                      <option value="0" selected="">Yet To start</option>
                      <option value="1" >To be continued</option>
                      <option value="2" >Done</option>
                    </select>  
                   
                  </div>
                </div> 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Priority</label>
                  <div class="col-sm-10">                   
                    <select class="form-control select2" style="width: 100%;" name="allocation_priority">
                      <option selected="" disabled="">--select priority--</option> 
                      <option>Urgent</option>
                      <option>High</option>
                      <option>Medium</option>  
                      <option>Low</option>
                      <option>Not Important</option>                                    
                    </select>  
                   
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
                    <div class="col-md-2">                 
                      <select class="form-control" name="whh">                        
                        <option disabled="" class="form-control" selected>hh</option>
                        <?php $i = 1; while ($i < 100) { ?>
                        <option><?php $i = sprintf('%02d',$i); echo $i; ?></option>
                        <?php $i++; } ?>
                      </select>
                      </div>
                      <div class="col-md-2">
                        <select name="wmm" class="form-control">
                          <option disabled="" selected>mm</option>
                          <?php $i = 15; while ($i < 46) { ?>
                            <option><?php $i = sprintf('%02d',$i); echo $i; ?></option>
                          <?php $i = $i + 15; } ?>
                        </select> 
                      </div>                        
                </div>
           </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input  type="button" value="Cancel" onClick="javascript:history.go(-1)" class="btn btn-default">
                <input type="submit" name="submit" class="btn btn-info pull-right" value="Save">
              </div>
              <!-- /.box-footer -->
            <?php } ?>
            </form>
          </div>
          <!-- /.box -->
</div>   

      
        
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
<script type="text/javascript"> 
$j1(document).ready(function() {    

     $j1("#csearch").autocomplete({
        source: function(request,response){
          $.ajax({          
          url: "<?php echo base_url('index.php/Main_Controller/autocompletecustomer'); ?>",
          dataType: "json",
          data: {
            q: $j1("#csearch").val()
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 2,
      select: function( event, ui ) {
        $j1('.com_id').val(ui.item.id);
      },
    });
    $j1("#Allocated_By").autocomplete({
        source: function(request,response){
          $.ajax({          
          url: "<?php echo base_url('index.php/main_controller/autocompleteemployee'); ?>",
          dataType: "json",
          data: {
            q:  $j1("#Allocated_By").val()
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 2,
      select: function( event, ui ) {
        $j1('.ab_id').val(ui.item.id);
      },
    }); 
    $j1("#Allocated_To").autocomplete({
        source: function(request,response){
          $.ajax({          
          url: "<?php echo base_url('index.php/main_controller/autocompleteemployee'); ?>",
          dataType: "json",
          data: {
            q: $j1("#Allocated_To").val()
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 2,
      select: function( event, ui ) {
        $j1('.at_id').val(ui.item.id);
      },
    });        
//document.ready end   
});

</script> 
</body>
</html>
	