<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PMS | View-Task</title>
  <?php include('application/views/header.php'); ?> 
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/datatables/dataTables.bootstrap.css"> 
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include('application/views/header-body.php'); ?>  
  <!-- Left side column. contains the logo and sidebar -->
 <?php include('sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>       
        <small>View Task</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active">View Task</li>
      </ol>
    </section>
    <br>
     <!-- alerts start -->
              <?php if($this->session->flashdata('success')) {?>
              <div class="myAlert alert alert-success" role="alert">
                  <?php echo $this->session->flashdata('success') ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </div>
            <?php } ?>
            <?php if($this->session->flashdata('error')) {?>
              <div class="myAlert alert alert-danger" role="alert">
                   <?php echo $this->session->flashdata('error') ?>
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </div>
            <?php } ?>           
            <!-- alerts End -->
   <div class="col-md-10" style="margin-left: 7%;">

      <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Search</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="form-filter" class="form-horizontal">
              <div class="box-body">
                 
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Start Date</label>
                  <div class="col-sm-10">                     
                    <input type="date" class="form-control" name="startDate" id="startDate">
                  </div>
                </div> 
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">End Date</label>
                  <div class="col-sm-10">                     
                    <input type="date" class="form-control" name="endDate" id="endDate">
                  </div>
                </div>              
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Projects</label>
                  <div class="col-sm-10">                                         
                      <?php echo $form_projects; ?>   
                  </div>
                </div> 
                <div class="form-group">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-4">
                            <button type="button" id="btn-filter" class="btn btn-primary">Search</button>
                            <input type="reset" id="reset" class="btn btn-default" value="Reset">
                        </div>
                    </div>                           
              </div>
              <!-- /.box-body -->
            </form>
          </div>
          <!-- /.box -->
  </div>
      


  <div class="col-md-12" id="main_table" style="overflow: auto;">
    <section class="content">
      <div class="row">      
          <!-- /.box -->
          <div class="box" id="box" style="display: none;">
            <div class="box-header">
              <h3 class="box-title">View Task</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">             

              <table id="table" class="table table-bordered table-striped" >
                <thead>
                <tr>
                  <th>No</th>
                  <th>Task Code</th>
                  <th>Title</th>                                    
                  <th>Project </th>  
                  <th>Start Date</th>  
                  <th>End Date</th>
                  <th>Description</th>  
                  <th>Allocate</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                
                <tbody>
                     
                </tbody>                
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Task Code</th>
                  <th>Title</th>                                    
                  <th>Project </th>  
                  <th>Start Date</th>  
                  <th>End Date</th>
                  <th>Description</th> 
                  <th>Allocate</th>
                  <th>Edit</th>
                  <th>Delete</th>                 
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
     
       
      </div>
      <!-- /.row -->
    </section>
  
    </div>

    <!-- Main content -->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('application/views/footer.php'); ?>
  <!-- Control Sidebar -->
  <?php include('application/views/side-controllbar.php');?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include('application/views/ex-jquery.php'); ?>
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>/assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>/assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>var $task = jQuery.noConflict();</script>
<!-- page script -->

<script type="text/javascript">

var table;

$task(document).ready(function() {
    
    //dataTables
    table = $task('#table').DataTable({ 

        "searching" : false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('pmtl_controller/ajax_list')?>",
            "type": "POST",
             "data": function ( data ) {
                data.taskcode = $task('#taskcode').val();               
                data.project_id = $task('#project_id').val();
                console.log($task('#project_id').val());
                data.startDate = $task('#startDate').val();
                data.endDate = $task('#endDate').val();              
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],

    });
    $task('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload();  //just reload table
        $task("#box").css("display","block");
    });
   
    // $task('#reset').click(function(){ //button reset event click        
    //     $task('#form-filter')[0].reset();
    //     table.ajax.reload();  //just reload table
    // });

});

</script>
</body>
</html>
