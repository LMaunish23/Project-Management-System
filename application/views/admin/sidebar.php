 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url($_SESSION['admin_img']);?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$_SESSION['admin_name'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
        </div>
      </div>
      <!-- search form -->
     <!--  <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="<?php echo base_url('index.php/main_controller/task_viewpage'); ?>">
            <i class="fa fa-tasks"></i> <span>Tasks</span>
            <span class="pull-right-container">
              <small data-toggle="tooltip" data-placement="top" title="Critically Pending Tasks" class="label pull-right bg-red">3</small>
              <small data-toggle="tooltip" data-placement="top" title="Carry forwarded Tasks" class="label pull-right bg-yellow">5</small>
              <small data-toggle="tooltip" data-placement="top" title="Completed Tasks" class="label pull-right bg-green">7</small>
            </span>
          </a>
        </li>      
           
         <li class="treeview" style="display: block;">
          <a href="#">
            <i class="fa fa-file"></i> <span>Project</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('index.php/main_controller/project_addpage'); ?>"><i class="fa fa-plus-circle"></i>Add Project</a></li>
            <li><a href="<?php echo base_url('index.php/main_controller/project_viewpage'); ?>"><i class="fa fa-eye"></i>View Project</a></li>           
          </ul>
        </li>
         <li class="treeview" style="display: block;">
          <a href="#">
            <i class="fa fa-user"></i> <span>Employee</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('index.php/main_controller/employee_addpage'); ?>"><i class="fa fa-plus-circle"></i>Add Employee</a></li>
            <li><a href="<?php echo base_url('index.php/main_controller/employee_viewpage'); ?>"><i class="fa fa-eye"></i>View Employee</a></li>           
          </ul>
        </li>
        <li class="treeview" style="display: block;">
          <a href="#">
            <i class="fa fa-building"></i> <span>Client</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('index.php/main_controller/client_addpage'); ?>"><i class="fa fa-plus-circle"></i>Add New Client</a></li>
            <li><a href="<?php echo base_url('index.php/main_controller/client_viewpage'); ?>"><i class="fa fa-eye"></i>View Clients</a></li>            
          </ul>
        </li>
        <li class="treeview" style="display: block;">
          <a href="#">
            <i class="fa fa-users"></i> <span>Business Units</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('index.php/main_controller/businessUnit_addpage'); ?>"><i class="fa fa-plus-circle"></i>Add Business Unit</a></li>
            <li><a href="<?php echo base_url('index.php/main_controller/businessUnits_viewpage'); ?>"><i class="fa fa-eye"></i>View Business Units</a></li>            
          </ul>
        </li> 
        <li class="treeview" style="display: block;">
          <a href="#">
            <i class="fa fa-calendar"></i> <span>Holiday Set</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('index.php/main_controller/holidaySet_addpage'); ?>"><i class="fa fa-plus-circle"></i>Add Holiday</a></li>
            <li><a href="<?php echo base_url('index.php/main_controller/holiday_viewpage'); ?>"><i class="fa fa-eye"></i>View Holiday Set</a></li>            
          </ul>
        </li>
        <li class="treeview" style="display: block;">
          <a href="#">
            <i class="fa fa-bullhorn"></i> <span>Announcements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('index.php/main_controller/announcement_addpage'); ?>"><i class="fa fa-plus-circle"></i>Add Announcement</a></li>
            <li><a href="<?php echo base_url('index.php/main_controller/announcement_viewpage'); ?>"><i class="fa fa-eye"></i>View Announcement</a></li>            
          </ul>
        </li> 
        
      <!--   <li class="treeview" style="display: block;">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>System Manager</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-database"></i>Manage Records</a></li>
            <li><a href=""><i class="fa fa-pencil-square"></i>Rights & Roles</a></li>            
          </ul>
        </li> -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-secret"></i> <span>Admin</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url('index.php/main_controller/admin_addpage'); ?>"><i class="fa fa-plus-circle"></i>Add Admin</a></li>
            <li><a href="<?php echo base_url('index.php/main_controller/admin_viewpage'); ?>"><i class="fa fa-eye"></i>View Admin</a></li>
          </ul>
        </li>
         <li>
          <a href="<?php echo base_url(''); ?>">
            <i class="fa fa-file"></i> <span>Generate Reports</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>      
        <li>
          <a href="<?php echo base_url('index.php/main_controller/events'); ?>">
            <i class="fa fa-calendar"></i> <span>Events</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
       <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
          </ul>
        </li>  --> 
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>