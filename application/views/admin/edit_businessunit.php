<!DOCTYPE html>
<html>
<head>
  <title>PMS | Edit-Business Unit</title>
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
        Edit Business Unit Details
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
              <h3 class="box-title">Edit Business Unit Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
                  $c=1;
                  foreach ($row->result() as $key)
                   {

            ?>
            <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/main_controller/edit_businessunit/'.$key->bu_id); ?>" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Name<label class="impf">*</label></label>
                  <div class="col-sm-10">                     
                    <input type="text" value="<?=$key->businessUnitName?>" class="form-control" name="bname" id="bname" required placeholder="Business Unit Name"><h6 class="error"><?php echo form_error('bname'); ?></h6>               
                  </div>
                </div> 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Website</label>
                  <div class="col-sm-10">                     
                    <input type="text" value="<?=$key->website?>" class="form-control" name="website" id="website" placeholder="Enter.."> <h6 class="error"><?php echo form_error('website'); ?></h6>               
                  </div>
                </div> 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email<label class="impf">*</label></label>
                  <div class="col-sm-10">                     
                    <input type="text" value="<?=$key->email?>" class="form-control" name="email" id="email" required placeholder="Enter.."><h6 class="error"><?php echo form_error('email'); ?></h6>               
                  </div>
                </div> 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Alternet Email</label>
                  <div class="col-sm-10">                     
                    <input type="text" value="<?=$key->alter_email?>" class="form-control" name="aemail" id="aemail" placeholder="Enter.."><h6 class="error"><?php echo form_error('aemail'); ?></h6>               
                  </div>
                </div> 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Billing Email</label>
                  <div class="col-sm-10">                     
                    <input type="text" value="<?=$key->billing_email?>" class="form-control" name="bemail" id="bemail" placeholder="Enter.."><h6 class="error"><?php echo form_error('bemail'); ?></h6>               
                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Contact No</label>
                  <div class="col-sm-10">                     
                    <input type="text" value="<?=$key->contactNo?>" class="form-control" name="contact" id="contact"  placeholder="Contact No"><h6 class="error"><?php echo form_error('contact'); ?></h6>               
                  </div>
                </div>                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
                  <div class="col-sm-10">                     
                    <textarea class="form-control"  name="address" placeholder="Enter Address..." id="address"><?=$key->address?></textarea> <h6 class="error"><?php echo form_error('address'); ?></h6>                 
                  </div>
                </div>
                 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">City<label class="impf">*</label></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="city" value="<?php echo $key->city ?>" id="city" placeholder="City"><h6 class="error"><?php echo form_error('city'); ?></h6> 
                  </div>
                </div>           
                                                
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Country<label class="impf">*</label></label>
                  <div class="col-sm-10">                   
                    <select class="form-control select2" style="width: 100%;" name="country">
                       <option selected="" disabled="">--select country--</option>
                      <?php if(count($getcountry)): ?>
                        <?php foreach ($getcountry as $country): ?>
                            <option value="<?php echo $country->id;?>" <?php if($country->id == $key->country_id){ ?> selected <?php }?>><?php echo $country->name; ?> </option>
                        <?php endforeach; ?>
                      <?php endif; ?>                   
                    </select>
                    <h6 class="error"><?php echo form_error('country'); ?></h6> 
                  </div>
                </div>                             
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Comment<label class="impf">*</label></label>

                  <div class="col-sm-10">
                    <textarea class="form-control" name="comment" id="comment"><?=$key->comment?></textarea><h6 class="error"><?php echo form_error('comment'); ?></h6> 
                  </div>
                </div>                                        
                
               <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                       <input type="checkbox" name="is_active" <?php if($key->isActive == 1){ ?> checked <?php } ?>>  Is Active
                      </label>
                    </div>
                  </div>
                </div>                                              
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input  type="button" value="Cancel" onClick="javascript:history.go(-1)" class="btn btn-default">
                <input type="submit" name="submit" class="btn btn-info pull-right" value="Update">
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        <?php } ?>
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
    
    $jq("#account_manager").autocomplete({
        source: function(request,response){
          $.ajax({          
          url: "<?php echo base_url('index.php/main_controller/autocompleteemployee'); ?>",
          dataType: "json",
          data: {
            q: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 1,
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
            q: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 1,
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
            q: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 1,
      select: function( event, ui ) {
        $jq('.tl_id').val(ui.item.id);
      },
    });   
//document.ready end   
});

</script> 
<script>  
  $('select').timezones();
</script>
</body>
</html>