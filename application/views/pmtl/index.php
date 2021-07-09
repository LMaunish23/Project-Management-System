<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PMS | Home</title>
  <?php include('application/views/header.php'); ?> 
  <style type="text/css">
    .badge-important {
        background-color: red;
      }
  </style>  
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
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
     <!-- modal start-->


      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
             <select id="status-update" name="status-update" class="form-control">
                  <option selected="" disabled="">--select task status--</option>
                  <option value="1">Pending</option>
                  <option value="2">Completed</option>
              </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="save" name="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- modal end-->
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
      <!-- Tasks List for My Self start -->
      
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tasks List for My Self</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow:scroll;white-space: nowrap;">
              <table id="example1"  class="table table-bordered table-striped" >
                <thead>
                <tr style="background-color:#A9CCE3">
                  <th>Task No</th>                  
                  <th>Project Name</th>                  
                  <th>Task Title</th>
                  <th>Priority</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Allocated Date</th>
                  <th>Estimated Time</th>
                  <th>Spent Time</th>
                  <th>Allocated By</th>
                  <th>Reporting To</th>
                  <th>Status</th>
                  <th><i class="fa fa-clock-o"></i></th>
                  <th>Time Tracker</th>
                  <th>Total Chargeable Time</th>
                </tr>
                </thead>
               <tbody>
                  <?php foreach ($row1->result() as $key) { ?>
                <tr>
                    <td><?=$key->clientCode.'.'.$key->project_code.'.'.$key->task_code?></td> 
                    <td hidden="" id="adID"><?=$key->ad_id?></td>                
                    <td><?=$key->project_title?></td>
                    <td><?=$key->title?></td>                    
                    <td>
                      <?php if($key->priority == "Urgent"):?>
                        <span class="label label-danger"><?=$key->priority?></span>
                        <?php elseif($key->priority == "High"):?>
                        <span class="label label-danger"><?=$key->priority?></span>
                        <?php elseif($key->priority == "Medium"):?>
                        <span class="label label-primary"><?=$key->priority?></span>
                      <?php endif?>                                         
                    </td>
                    <td><?=$key->startDate?></td> 
                    <td><?=$key->endDate?></td>
                    <td><?php if($key->allocated_date == date('Y-m-d')){echo "<b>".$key->allocated_date."&nbsp;&nbsp;<span class='badge bg-grey'>T</span>";}else{echo $key->allocated_date;} ?></td>
                     <td><?php $time = $key->allocated_time / 60; $t = explode(".",$time); echo $t[0].':'.$t[1]; ?></td>
                    <td><?=$key->spentTime?></td>                    
                    <td><?php foreach ($getEmpList as $emp): ?>                            
                            <?php if($key->allocatedById == $emp->emp_id){ echo $emp->firstname.' '.$emp->lastname; } ?>
                        <?php endforeach; ?> </td>                  
                    <td><?php foreach ($getEmpList as $emp): ?>                            
                            <?php if($key->allocatedById == $emp->emp_id){ echo $emp->firstname.' '.$emp->lastname; } ?>
                        <?php endforeach; ?> </td>
                    <td id="status"><?php if($key->status == 0){echo "<label class='text-light-blue'>Yet to start</label>";}else if($key->status == 1){echo "<label class='text-red'>Pending</label>";}else{echo "<label class='text-green'>Completed</label>";}?></td>
                    <td><button id="btn" class="btn btn-primary" value="">Start</button></td>
                    <td><div id="t" class="badge">00:00</div></td>
                    <td><div id="tc" class="badge">00:00</div></td>
                </tr>
                 <?php } ?>
                </tbody>
                <tfoot>
                   
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    

      <!-- Tasks List for My Self end -->
      <!-- Delighted Tasks List start -->
      
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Delighted Tasks List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow:scroll;white-space: nowrap;">
              <table id="example1" class="table table-bordered table-striped" >
                <thead>
                <tr style="background-color:#A9CCE3">
                  <th>Task No</th>                  
                  <th>Project Name</th>                  
                  <th>Task Title</th>
                  <th>Priority</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Allocated Date</th>
                  <th>Estimated Time</th>
                  <th>Spent Time</th>
                  <th>Allocated By</th>
                  <th>Reporting To</th>
                  <th>Status</th>
                </tr>
                </thead>
                 <tbody>
                  <?php foreach ($row2->result() as $key) { ?>
                <tr>
                    <td><?=$key->clientCode.'.'.$key->project_code.'.'.$key->task_code?></td>                  
                    <td><?=$key->project_title?></td>
                    <td><?=$key->title?></td>                    
                    <td>
                      <?php if($key->priority == "Urgent"):?>
                        <span class="label label-danger"><?=$key->priority?></span>
                        <?php elseif($key->priority == "High"):?>
                        <span class="label label-danger"><?=$key->priority?></span>
                        <?php elseif($key->priority == "Medium"):?>
                        <span class="label label-primary"><?=$key->priority?></span>
                      <?php endif?>                                         
                    </td>
                    <td><?=$key->startDate?></td> 
                    <td><?=$key->endDate?></td>
                    <td><?=$key->allocated_date?></td>
                     <td><?php $time = $key->allocated_time / 60; $t = explode(".",$time); echo $t[0].':'.$t[1]; ?></td>
                    <td><?=$key->spentTime?></td>                    
                    <td><?php foreach ($getEmpList as $emp): ?>                            
                            <?php if($key->allocatedById == $emp->emp_id){ echo $emp->firstname.' '.$emp->lastname; } ?>
                        <?php endforeach; ?> </td>                  
                    <td><?php foreach ($getEmpList as $emp): ?>                            
                            <?php if($key->allocatedById == $emp->emp_id){ echo $emp->firstname.' '.$emp->lastname; } ?>
                        <?php endforeach; ?> </td>
                    <td><?php if($key->status == 0){echo "<label class='text-light-blue'>Yet to start</label>";}else if($key->status == 1){echo "<label class='text-red'>Pending</label>";}else{echo "<label class='text-green'>Completed</label>";}?></td>
                </tr>
                 <?php } ?>
                </tbody>
                <tfoot>
                
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    <!-- Delighted Tasks List end -->
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
  <?php include('application/views/footer.php'); ?>
  <?php include('application/views/side-controllbar.php');?>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<?php include('application/views/ex-jquery.php'); ?>
<script src="<?php echo base_url(); ?>/assets/plugins/timer-plugin/dist/timer.jquery.min.js"></script> 
<script>
  
  
  var total=0,p=0,r=0;
  (function(){

      $("#btn").click(function(){
      switch($(this).html().toLowerCase())
      {

          case "start":
          $("#t").timer({ action: 'start',seconds: 0,format:'%H:%M:%S' });
          $(this).html("Pause");
          $("input[name='s']").attr("disabled", "disabled");
          $("#t").addClass("badge-important");

          break;
            
          case "resume":
          $("#t").timer('resume');
          r = parseInt($("#t").html());          
          $(this).html("Pause")
          $("#t").addClass("badge-important");         
          break;
            
          case "pause": //you can specify action via object                     
          p = parseInt($("#t").html());
          $("#tc").html($("#t").html());
          $("#t").timer('pause');
          $(this).html("Resume")
          $('#exampleModalCenter').modal('show');
          $("#t").removeClass("badge-important");
          break;

      }
    });
  })();

  $('#save').click(function(){
    var hms = $('#tc').html();   // your input string
    var a = hms.split(':'); // split it at the colons // minutes are worth 60 seconds. Hours are worth 60 minutes.
    var minutes = (+a[0]) * 60 + (+a[1]); 
     $.ajax({          
          url: "<?php echo base_url('index.php/pmtl_controller/updateStatus'); ?>",
          method:'post',
          dataType: "json",
          data: {
            ad_id : $('#adID').html(),
            status : $('#status-update').val(),
            spenttime : minutes
          },
          success: function( data ) {    
               var yourval = JSON.parse(data);               
               if(yourval == 0)
               {
                  $('#status').css('font-weight','bold');
                  $('#status').css('color','blue');
                  $('#status').html('Yet To Start');
               }
               else if(yourval == 1)
               {
                  $('#status').css('font-weight','bold');
                  $('#status').css('color','red');
                  $('#status').html('Pending');
               }
               else
               {
                  $('#status').css('font-weight','bold');
                  $('#status').css('color','green');
                  $('#status').html('Completed');
               }
          }          
        });     
        $('#exampleModalCenter').modal('hide');//modal_1 is the id 1
 });

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