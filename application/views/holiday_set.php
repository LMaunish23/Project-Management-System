<!DOCTYPE html>
<html>
<head>
  <title>PMS | Holiday Set</title>
  <?php include('application/views/header.php'); ?>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include('application/views/header-body.php'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('application/views/admin/sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="overflow: auto;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>        
        Holiday Set
      </h1>
      <ol class="breadcrumb">
        
      </ol>
    </section>

    <!-- Main content -->
     <br><br>  
    <div class="col-md-6" style="margin-left: 12%;width: 75%">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Holiday Set</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
            <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/main_controller/add_holidays'); ?>" enctype="multipart/form-data">
              <div class="box-body"> 
                
                 <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Holiday Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  name="holiday_title" id="holiday_title" required="" placeholder="Holiday Title">
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Holiday Date</label>
                  <div class="col-sm-10">                     
                    <input type="date" name="holiday_date" id="holiday_date" class="form-control">  
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">                     
                    <textarea class="form-control" name="holiday_desc" id="holiday_desc"   placeholder="Description"></textarea>    
                  </div>
                </div>      
           </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input  type="button" value="Cancel" onClick="javascript:history.go(-1)" class="btn btn-default">
                <input type="submit" name="submit" class="btn btn-info pull-right" value="Refresh">
              </div>
              <!-- /.box-footer -->
          
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
	