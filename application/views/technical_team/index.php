<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PMS | Home</title>
  <?php include('application/views/header.php'); ?> 
  <style type="text/css">
    .badge-important {
        background-color: #ff6666;
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
         <!-- /.col -->
        <div class="col-md-3">
          <div class="box box-danger box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Critically Pending Tasks</h3>

              <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" align="center">
             1
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
        <div class="col-md-3">
          <div class="box box-warning box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Carry Forwarded Tasks</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" align="center">
              1
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
        <div class="col-md-3">
          <div class="box box-default box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Newly Allocated Tasks</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" align="center">
              1
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
        <div class="col-md-3">
          <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Completed Tasks</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" align="center">
              1
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
       
      </div>
      <!-- Tasks List for My Self start -->
      
      
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tasks List</h3>
              <a href="<?php echo base_url('index.php/techteam_controller/alltasks_viewpage'); ?>"><button style="float: right" class="btn btn-info">All Tasks&nbsp;&nbsp;<i class="fa fa-arrow-circle-right"></i></button></a>
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
                  <th>Allocated Date&nbsp;<i class="fa fa-long-arrow-up"></i></th>
                  <th>Estimated Time</th>
                  <th>Spent Time</th>
                  <th>Allocated By</th>
                  <th>Reporting To</th>
                  <th>Status</th>
                  <th><i class="fa fa-clock-o"></i></th>
                  <th>Total Tracked Time</th>
                  <th>Total Chargeable Time</th>
                </tr>
                </thead>                
                <tbody>

                  <?php $c1=1;$c2=1;$c3=1;$c4=1;$c5=1;$c6=1;$c7=1;
                  foreach ($row1->result() as $key) {  
                  ?>
                <tr>                    
                    <td hidden="" id="ad-<?=$c4++?>"><?=$key->ad_id?></td>
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
                    <td>
                      <?php 
                            if($key->allocated_date == date('Y-m-d'))
                            {
                              echo "<b>".$key->allocated_date."&nbsp;&nbsp;<span class='badge bg-grey'>T</span>";
                            }
                            else
                            {
                              echo $key->allocated_date;} ?>
                                
                    </td>
                     <td hidden="" id="workday-<?=$c5++?>"><?php echo $key->allocated_date; ?></td>
                     <td>
                        <?php 
                            $time = $key->allocated_time / 60; 
                            $t = explode(".",$time); echo $t[0].'h'.' '.$t[1].'m'; 
                        ?>                      
                      </td>
                    <td><?=$key->spentTime?></td>                    
                    <td>
                        <?php foreach ($getEmpList as $emp): ?>                            
                           <?php if($key->allocatedById == $emp->emp_id){ echo $emp->firstname.' '.$emp->lastname; } ?>
                        <?php endforeach; ?> </td>                  
                    <td>
                        <?php foreach ($getEmpList as $emp): ?>                            
                            <?php if($key->allocatedById == $emp->emp_id){ echo $emp->firstname.' '.$emp->lastname; } ?>
                        <?php endforeach; ?> 
                    </td>
                    <td id="status">
                        <?php 
                            if($key->status == 0)
                            {
                                echo "<label class='text-light-blue'>Yet to start</label>";
                            }
                            else if($key->status == 1)
                            {
                                echo "<label class='text-red'>Pending</label>";
                            }
                            else
                            {
                                echo "<label class='text-green'>Completed</label>";
                            }
                        ?>
                    </td>
                    <td><button id="<?=$c1++?>" class="b1 btn btn-primary" value="" >Start</button></td>
                    <td >
                      <div id="tcL-<?=$c3++?>" style="font-size: small;" class="tcL label label-default">

                        <?php foreach($getWorkDates as $wdates): ?>    

                        <?php
                          if($key->allocated_date == $wdates->workDate AND $key->ad_id = $wdates->wd_id)
                            { 
                              $init = $wdates->startTime * 60;
                                  echo gmdate("H:i:s",$init);
                                  break;                             
                            }                   
                        ?>
                        <?php endforeach; ?>
                       </div>
                       
                      <!-- temporary stores start time of task -->
                       
                        <div id="tempStartTime-<?=$c7++?>" style="font-size: small;display: none;" class="tcL label label-default">
                        <?php foreach ($getWorkDates as $wdates): ?>                            
                          <?php 
                            if($key->allocated_date == $wdates->workDate AND $key->ad_id = $wdates->wd_id) 
                            { 
                              $init = $wdates->startTime * 60;
                              echo gmdate("H:i:s",$init);
                              break;
                            }
                          ?>
                        <?php endforeach; ?>
                        </div>

                      <!-- temporary stores start time of task -->
                      

                        &nbsp;| + 
                      <div id="t-<?=$c2++?>" style="font-size: small;" class="label label-default">00:00:00</div> 
                    </td>
                    <td>
                      <div id="tcR-<?=$c6++?>" style="font-size: small;" class="label label-default">
                        <?php foreach ($getWorkDates as $wdates): ?>                            
                          <?php 
                            if($key->allocated_date == $wdates->workDate AND $key->ad_id = $wdates->wd_id)
                            { 
                              $init = $wdates->startTime * 60;
                              echo gmdate("H:i:s",$init);
                              break;
                            }
                          ?>
                        <?php endforeach; ?>
                      </div>
                    </td>
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
  
  var total=0,p=0,r=0,id;
  var updatedTime;
  var updateStartTime;
  var updateEndTime;

  $( document ).ready(function() 
  {

     function timestrToSec(timestr) 
     {
        var parts = timestr.split(":");
        return (parts[0] * 3600) + (parts[1] * 60) + (+parts[2]);
    }
    function pad(num) 
    {
        if(num < 10) {
          return "0" + num;
        } else {
          return "" + num;
        }
    }
    function formatTime(seconds) 
    {
      return [pad(Math.floor(seconds/3600)),pad(Math.floor(seconds/60)%60),pad(seconds%60),].join(":");
    }
     
     (function(){      
      $(".b1").click(function(){
      id = this.id;

     switch($(this).html().toLowerCase())
     {
          case "start":
          $("#t-"+id).timer('remove');
          $("#t-"+id).timer({ action: 'start',seconds: 0,format:'%H:%M:%S' });
          r = parseInt($("#t-"+id).html());
          $(this).html("Stop");
          $("input[name='s']").attr("disabled", "disabled");
          $("#t-"+id).addClass("badge-important");
          break;
            
          case "stop": //you can specify action via object                     
          time1 = $("#tcL-"+id).html();
          time2 = $("#t-"+id).html();
          a = $("#tempStartTime-"+id).html();         
          updateStartTime = formatTime(timestrToSec(time2) + timestrToSec(a)); 
          updateEndTime = $("#t-"+id).html();
          updatedTime = formatTime(timestrToSec(time1) + timestrToSec(time2));
          $("#tcL-"+id).html(updatedTime);
          $("#tcR-"+id).html(updatedTime);
          $("#t-"+id).timer('pause');
          $("#t-"+id).html('00:00:00');        
          $(this).html("Start")
          $('#exampleModalCenter').modal('show');
          $("#t-"+id).removeClass("badge-important");         
          break;
      }    
    
  });
  })();

  $('#save').click(function(){
      var saveid = $('#ad-'+id).html();
      // console.log(updateStartTime);
      // console.log(updateEndTime);
      // console.log(updatedTime);
      // console.log($('#t-'+id).html());
      $.ajax({          
          url: "<?php echo base_url('index.php/techteam_controller/updateStatus'); ?>",
          method:'post',
          dataType: "json",
          data: {
            ad_id : saveid,
            status : $('#status-update').val(),
            workday : $('#workday-'+id).html(),
            starttime : updateStartTime,
            endtime : updateEndTime,
            spenttime : updatedTime
          },
          success: function( data ) {
             var yourval = JSON.parse(JSON.stringify(data));
              console.log(yourval);
              var newStartTime = yourval[0]['endTime']
               if(yourval[0]['status'] == 0)
               {
                  $('#status').css('font-weight','bold');
                  $('#tcL-'+id).html(yourval[0]['endTime']);
                  $('#status').css('color','blue');
                  $('#status').html('Yet To Start');
               }
               else if(yourval[0]['status'] == 1)
               {
                  $('#status').css('font-weight','bold');
                  $('#status').css('color','red');
                  $('#tcL-'+id).html(yourval[0]['endTime']);
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

  
 });

  
</script>
</body>
</html>