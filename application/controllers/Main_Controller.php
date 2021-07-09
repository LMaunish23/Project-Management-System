<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_Controller extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->view('admin/index');
	}	
	//-------------------- start admin_controller----------------------------
	function weekdays_sundays() // this function will add holidays and weekends directly to the database according to current year
	{
		$cMonth = 1;$cYear = date("Y");
		$firstSaturday = array();
		$ThirdSaturday = array();
		$AllSundays = array();
		for($j=1;$j<13;$j++)
		{            
		  
			  $timestamp = mktime(0,0,0,$cMonth,1,$cYear);
			  $maxday = date("t",$timestamp);
			  $thismonth = getdate ($timestamp);
			  $startday = $thismonth['wday'];
			  $first_S = date("Y-m-d", strtotime("first saturday $cYear-$cMonth"))."<br>";
			  array_push($firstSaturday,$first_S);
			  $Third_S = date("Y-m-d", strtotime("third saturday $cYear-$cMonth"))."<br>";
			  array_push($ThirdSaturday,$Third_S); 	               

			  for ($i=0; $i<($maxday+$startday); $i++) 
			  {
			      if(($i % 7) == 0 );
			      if($i < $startday);
			      else
			      {
			        $day = ($i - $startday + 1);                  
			        $c = $cYear."-".$cMonth."-".$day;
			        $d = date_create($c);
			        $alldays = date_format($d,'Y-m-d');                             
			        if(date("N F", mktime(0,0,0,$cMonth,($i - $startday + 1),$cYear)) == 7)
			        {
			           array_push($AllSundays,$alldays);
			        }
			      }             
			      if(($i % 7) == 6);  
			  }
			  $cMonth++;
			  echo"<br>";
		}
		$merge = array_merge($firstSaturday,$ThirdSaturday,$AllSundays);
		for($i=0;$i<count($merge)-1;$i++)
		{
			$data = array('holiday_title' => 'weekday',
					  'holiday_date' => $merge[$i]
				);
			$insertWeekdaySunday = $this->main_model->add_sundayWeekday($data);
		}		
	}

	public function employee_addpage()
	{
		$getjobtype = $this->main_model->getJobType();
		$getbusinessunit = $this->main_model->getBUList();	
		$a = array(
					'getjobtype'=>$getjobtype,
					'getbusinessunit'=>$getbusinessunit
				);
		$this->load->view('admin/add_employee',$a);
	}
	public function admin_addpage()
	{		
		$this->load->view('admin/add_admin');
	}
	public function holidaySet_addpage()
	{
		$this->load->view('admin/add_holiday');
	}
	public function announcement_addpage()
	{
		$this->load->view('admin/add_announcement');
	}
	public function businessUnit_addpage()
	{
		$getcountry = $this->main_model->getCountry();		
		$getemplist = $this->main_model->getEmpList();
		$a = array(
					'getcountry'=>$getcountry,					
					'getemplist'=>$getemplist

				);		
		$this->load->view('admin/add_businessunit',$a);
	}
	public function project_addpage()
	{			
		$getemplist = $this->main_model->getEmpList();
		$a = array(							
					'getemplist'=>$getemplist
				);	
		$this->load->view('admin/add_project',$a);	
	}
	public function task_addpage()
	{
		$getactivityType = $this->main_model->getActivityType();
		$getemplist = $this->main_model->getEmpList();
		$a = array(
					'getactivityType'=>$getactivityType,
					'getemplist'=>$getemplist
				);
		$this->load->view('admin/add_task',$a);
	}
	public function client_addpage()
	{
		$getcountry = $this->main_model->getCountry();
		$getcurrency = $this->main_model->getCurrency();
		$getemplist = $this->main_model->getEmpList();
		$a = array(
					'getcountry'=>$getcountry,
					'getcurrency'=>$getcurrency,
					'getemplist'=>$getemplist

				);		
		$this->load->view('admin/add_client',$a);
	}
	public function events()
	{
		$this->load->view('admin/calendar');
	}
	public function employee_viewpage()
	{
		$getjobtype = $this->main_model->getJobType();
		$a = array(
					'getjobtype'=>$getjobtype
				);
		$data['row'] = $this->main_model->checkcode();	
		$merge = array_merge($data,$a);			
		$this->load->view('admin/view_employee',$merge);
	}
	public function announcement_viewpage()
	{
		$data['row'] = $this->main_model->view_announcement();						
		$this->load->view('admin/view_announcement',$data);
	}
	public function admin_viewpage()
	{		
		$data['row'] = $this->main_model->view_admin();		
		$this->load->view('admin/view_admin',$data);
	}
	public function client_viewpage()
	{
		$data['row'] = $this->main_model->view_client();
		$this->load->view('admin/view_clients',$data);
	}
	public function businessUnits_viewpage()
	{
		$data['row'] = $this->main_model->view_businessUnit();
		$this->load->view('admin/view_businessunit',$data);
	}
	public function project_viewpage()
	{
		$getEmpList = $this->main_model->getEmpList();
		$a = array(
					'getEmpList'=>$getEmpList
				);
		$data['row'] = $this->main_model->view_project();
		$merge = array_merge($data,$a);	
		$this->load->view('admin/view_project',$merge);
	}
	public function task_viewpage()
	{		
		$getProjectName = $this->main_model->get_list_projects();
		$opt = array();
		foreach ($getProjectName as $projectName) {
			$opt[$projectName] = $projectName;
		}
		$data1['form_projects'] = form_dropdown('',$opt,'','id="project_id" name="project_id" multiple class="form-control"');
		$data2['row'] = $this->main_model->view_task();
		$merge = array_merge($data1,$data2);
		$this->load->view('admin/view_task',$merge);
	}	
	public  function employee_editpage($id)
	{	
		$getjobtype = $this->main_model->getJobType();
		$getbusinessunit = $this->main_model->getBUList();
		$a = array(
					'getjobtype'=>$getjobtype,
					'getbusinessunit'=>$getbusinessunit
				);
		$data['row'] = $this->main_model->fetch_employee($id);
		$merge = array_merge($data,$a);
		$this->load->view('admin/edit_employee',$merge);
	}
	public function task_editpage($id)
	{
		$getProjectName = $this->main_model->getProject();
		$getactivityType = $this->main_model->getActivityType();		
		$a = array(
					'getProjectName'=>$getProjectName,
					'getactivityType'=>$getactivityType,					
				);		
		$data['row'] = $this->main_model->fetch_task($id);
		$merge = array_merge($data,$a);	
		$this->load->view('admin/edit_task',$merge);
	}
	public function taskAllocation_addpage($id)
	{
		$getProjectName = $this->main_model->getProject();
		$getemplist = $this->main_model->getEmpList();
		$a = array(		
					'getProjectName'=>$getProjectName,			
					'getemplist'=>$getemplist
				);
		$data['row'] = $this->main_model->fetch_task($id);
		$merge = array_merge($data,$a);	
		$this->load->view('admin/task_allocation',$merge);
	}
	function date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d' ) 
	{
	    $dates = array();
	    $current = $first;
	    $last = $last;

	    while( $current <= $last ) {

	        $dates[] = date($output_format, $current);
	        $current = strtotime($step, $current);
	    }	    
	    return $dates;
	}
	public function allocateTask()
	{	 
		$data = array('allocatedDate' => $this->input->post('task_allocatedDate'),
					  'projectTaskId'=> $this->input->post('task-id'),
					  'allocatedById'=> $_SESSION["admin_id"],	
					  'allocatedToId' => $this->input->post('Allocated_To'),
					  'startDate' => $this->input->post('task_startdate'),
					  'endDate' => $this->input->post('task_enddate'),
					  'allocated_time' => $this->input->post('whh') .'.'. $this->input->post('wmm'),  
					  'description' => $this->input->post('task_desc') 
				);
		$tid = $this->input->post('task-id');
		$insertAllocationData['id'] = $this->main_model->add_allocationData($data,$tid);
		$allocationID = $insertAllocationData['id'];
		if($allocationID == NULL)
		{
			$this->session->set_flashdata('error', 'Unable To Allocate Task');
			redirect(base_url('index.php/main_controller/task_viewpage'));
		}
		else
		{
			$date1 = strtotime($this->input->post('task_startdate'));  
			$date2 = strtotime($this->input->post('task_enddate'));
			$getholidayList['row'] = $this->main_model->getholidayList();
			$working_days = array();
			$holidays_from_date_list = array();		
			$holidays = array();		// list of all holidays				
			$result['dates'] = $this->date_range($date1,$date2); // date list					
			foreach($getholidayList['row']->result() as $key)
	        {
	        	array_push($holidays,$key->holiday_date);        	
	        }        
	        $holidays_from_date_list = array_intersect($result['dates'], $holidays);  
		    $subtract_days = array_diff($result['dates'],$holidays_from_date_list);   		        
			$iZero = array_values($subtract_days);
			$working_days = array_combine(range(1, count($subtract_days)), array_values($subtract_days));		
	        for($i=1;$i<count($working_days)+1;$i++)
	        {
	        	$data2 = array('allocation_id' => $allocationID,
						  	'allocated_date' => $working_days[$i],
						  'allocated_time' => 0,
						   'spentTime' => 0,
						   'priority' =>  $this->input->post('allocation_priority'),
						   'status' => $this->input->post('allocation_status')
				);        	
	        	$allocation_Details = $this->main_model->add_allocationDetails($data2);
	        }
	        $this->session->set_flashdata('success', 'Task Allocated');
			redirect(base_url('index.php/main_controller/task_viewpage'));
		}
			
	}	
	public  function businessunit_editpage($id)
	{		
		$getcountry = $this->main_model->getCountry();
		$a = array(
					'getcountry'=>$getcountry
				);
		$data['row'] = $this->main_model->fetch_businessunit($id);
		$merge = array_merge($data,$a);
		$this->load->view('admin/edit_businessunit',$merge);
	}
	public function project_editpage($id)
	{	
		$getcountry = $this->main_model->getCountry();
		$getemplist = $this->main_model->getEmpList();
		$a = array(
					'getcountry'=>$getcountry,
					'getemplist'=>$getemplist
				);
		$data['row'] = $this->main_model->fetch_project($id);
		$merge = array_merge($data,$a);
		$this->load->view('admin/edit_project',$merge);
	}
	public  function client_editpage($id)
	{			
		$getcountry = $this->main_model->getCountry();
		$getemplist = $this->main_model->getEmpList();
		$a = array(
					'getcountry'=>$getcountry,
					'getemplist'=>$getemplist
				);
		$data['row'] = $this->main_model->fetch_client($id);
		$merge = array_merge($data,$a);
		$this->load->view('admin/edit_client',$merge);
	}	

	function autocompleteclient()
	{		
		$returndata = array();
		$conditions['searchTerm'] = $this->input->get('q');
		$conditions['conditions']['isActive'] = 1;
		$data = $this->main_model->getRowsCo($conditions);
		if(!empty($data))
		{	
			foreach ($data as $row) 
			{
				$data['id'] = $row['co_id'];
				$data['value'] = $row['clientName'];
				array_push($returndata, $data);
			}
		}			
		else
		{
			$msg = "No Record Found";
			array_push($returndata,$msg);
		}
	    echo json_encode($returndata);die;		
	}
	function autocompleteproject()
	{
		$returndata = array();

		$conditions['searchTerm'] = $this->input->get('q');
		//$conditions['conditions'][''] = 0; put any conditions if require
		$data = $this->main_model->getRowsPro($conditions);

		if(!empty($data))
		{		
			foreach ($data as $row) 
			{
				$data['id'] = $row['project_id'];
				$data['value'] = $row['project_title'];
				array_push($returndata, $data);
			}
		}
		else
		{
			$msg = "No Record Found";
			array_push($returndata,$msg);
		}			
		echo json_encode($returndata);die;		
	}
	function autocompleteemployee()
	{
		$returndata = array();
		$conditions['searchTerm'] = $this->input->get('q');		
		$data = $this->main_model->getRowsEmp($conditions);
		if(!empty($data))
		{		
			foreach ($data as $row) 
			{
				$data['id'] = $row['emp_id'];
				$data['value'] = $row['firstname'] .' '. $row['lastname'];
				array_push($returndata, $data);
			}
		}
		else
		{
			$msg = "No Record Found";
			array_push($returndata,$msg);
		}			
		echo json_encode($returndata);die;		
	}
	public function ajax_list()
	{		
		$list = $this->main_model->get_datatables();		
		$data = array();		
		$no = $_POST['start'];
		foreach ($list as $main_model) {
			$no++;
			$row1 = array();
			$row1[] = $no;
			$row1[] = $main_model->task_code;
			$row1[] = $main_model->title;			
			$row1[] = $this->main_model->list_projects($main_model->projectID);
			$row1[] = $main_model->startDate;
			$row1[] = $main_model->endDate;
			$row1[] = $main_model->description;
			$row1[] = "<a href='".base_url('index.php/main_controller/taskAllocation_addpage/'.urlencode(base64_encode($main_model->pt_id)))."'<i class='fa fa-check-square-o'></i>&nbsp;Allocate</a>";
			$row1[] = "<a href='".base_url('index.php/main_controller/task_editpage/'.urlencode(base64_encode($main_model->pt_id)))."'<i class='fa fa-edit (alias)'></i>&nbsp;Edit</a>";
			$row1[] = "<a style='cursor: not-allowed;' href=''><i class='fa fa-minus-square'></i>&nbsp;Delete</a>";
			$data[] = $row1;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->main_model->count_all(),
						"recordsFiltered" => $this->main_model->count_filtered(),
						"data" => $data,
				);		
		//output to json format
		echo json_encode($output);

	}
	public function add_holiday()
	{
		$data = array('holiday_title' => $this->input->post('holiday_title'),
					  'holiday_date' => $this->input->post('holiday_date'),
					  'custom_holiday_flag' => 1					   
				);		
		$insertHoliday = $this->main_model->add_holidayData($data);
		if($insertHoliday)
		{			
			$this->session->set_flashdata('success', 'Record Inserted');
			redirect(base_url('index.php/main_controller/holidaySet_addpage'));
		}
		else
		{
			$this->session->set_flashdata('error', 'Error');
			redirect(base_url('index.php/main_controller/holidaySet_addpage'));			
		}
	}
	public function add_announcement()
	{
		if($this->input->post('is_public') == 'on')
		{
			$is_public = 1;
		}
		else
		{
			$is_public = 0;	
		}
		$data = array('an_title' => $this->input->post('announcement_title'),
					  'an_date' => $this->input->post('announcement_date'),
					  'an_desc' => $this->input->post('announcement_desc'),
					  'isPublic' => $is_public					   
				);		
		$insertAnnouncement = $this->main_model->add_announcementData($data);
		if($insertAnnouncement)
		{			
			$this->session->set_flashdata('success', 'Record Inserted');
			redirect(base_url('index.php/main_controller/announcement_addpage'));
		}
		else
		{
			$this->session->set_flashdata('error', 'Error');
			redirect(base_url('index.php/main_controller/announcement_addpage'));			
		}
	}
	public function edit_announcement($id)
	{
		if($this->input->post('is_public') == 'on')
		{
			$is_public = 1;
		}
		else
		{
			$is_public = 0;	
		}
		$name = $this->input->post('announcement_title');
		$data = array('an_title' => $this->input->post('announcement_title'),
					  'an_date' => $this->input->post('announcement_date'),
					  'an_desc' => $this->input->post('announcement_desc'),
					  'isPublic' => $is_public					   
				);		
		$updateAnnouncement = $this->main_model->edit_announcementdata($data,$id);
		if($updateAnnouncement)
		{			
			$this->session->set_flashdata('success', $name.' '.'Details Updated');
			redirect(base_url('index.php/main_controller/announcement_viewpage'));				
		}
		else
		{
			$this->session->set_flashdata('error','Unable to update details of'.' '.$name);		
			redirect(base_url('index.php/main_controller/announcement_viewpage'));
		}
	}
	public function edit_holiday($id)
	{
		$name = $this->input->post('holiday_title');
		$data = array('holiday_title' => $this->input->post('holiday_title'),
					  'holiday_date' => $this->input->post('holiday_date'),
					  'custom_holiday_flag' => 1				   
				);		
		$updateHoliday = $this->main_model->edit_holidaydata($data,$id);
		if($updateHoliday)
		{			
			$this->session->set_flashdata('success', $name.' '.'Details Updated');
			redirect(base_url('index.php/main_controller/holiday_viewpage'));				
		}
		else
		{
			$this->session->set_flashdata('error','Unable to update details of'.' '.$name);		
			redirect(base_url('index.php/main_controller/holiday_viewpage'));
		}
	}
	public function holiday_editpage($id)
	{
		$data['row'] = $this->main_model->fetch_holidays($id);		
		$this->load->view('admin/edit_holiday',$data);	
	}
	public function announcement_editpage($id)
	{
		$data['row'] = $this->main_model->fetch_announcements($id);		
		$this->load->view('admin/edit_announcement',$data);	
	}
	public function holiday_viewpage()
	{
		$data['row'] = $this->main_model->view_holiday();						
		$this->load->view('admin/view_holiday',$data);
	}
	public function add_task()
	{		
		if($this->input->post('is_active') == 'on')
		{
			$is_active = 1;
		}
		else
		{
			$is_active = 0;	
		}
		if($this->input->post('is_billable') == 'on')
		{
			$is_billable = 1;
		}
		else
		{
			$is_billable = 0;	
		}
		if($this->input->post('is_ongoing') == 'on')
		{
			$is_ongoing = 1;
		}
		else
		{
			$is_ongoing = 0;	
		}
		$pid = $this->input->post('pro_id');
		$Code = $this->main_model->checkLastTaskCode($pid);
		$record1 = $Code->result();		
		foreach ($record1 as $key) 
		{
				$num = $key->last_taskCode;				
		}
		$num = sprintf('%010d',++$num);	
		$Ttime	= $this->input->post('whh') .'.'. $this->input->post('wmm');
		$data = array('title' => $this->input->post('task_title'),
					  'projectID'=> $this->input->post('pro_id'),
					  'task_code'=> $num,	
					  'isOnGoing' => $is_ongoing,
					  'isBillable' => $is_billable,
					  'startDate' => $this->input->post('task_startdate'),
					  'endDate' => $this->input->post('task_enddate'),					  
					  'estimatedTime' => $Ttime * 60,
					  'description' => $this->input->post('task_desc'),
					  'isActive' => $is_active,
					  'acitivityType_id' => $this->input->post('activityType')					  
				);		
		$insertTask = $this->main_model->add_Taskdata($data,$pid);
		if($insertTask)
		{			
			echo"<script>alert('Successfully Added New Task');</script>";
			redirect(base_url('index.php/main_controller/task_viewpage'));
		}
		else
		{
			echo"<script>alert('Unable To Add New Task');</script>";	
			redirect(base_url('index.php/main_controller/task_viewpage'));
		}
		
	}	
	public function add_project_data()
	{		
		if($this->input->post('is_ongoing') == 'on')
		{
			$is_ongoing = 1;
		}
		else
		{
			$is_ongoing = 0;	
		}
		if($this->input->post('is_billable') == 'on')
		{
			$is_billable = 1;
		}
		else
		{
			$is_billable = 0;	
		}	
		if($this->input->post('is_active') == 'on')
		{
			$is_active = 1;
		}
		else
		{
			$is_active = 0;	
		}		
		$Code = $this->main_model->view_project();
		$num = $Code->num_rows();
		$num = sprintf('%05d',++$num);
		$calculate_minutes = ($this->input->post('hh') * 60);
		$data = array('project_title'=> $this->input->post('ptitle'),
			'client_id'=> $this->input->post('com_id'),
			'project_code'=> $num,
			'account_manager_id'=> $this->input->post('account_manager'),
			'project_manager_id'=> $this->input->post('project_manager'),
			'team_leader_id'=> $this->input->post('teamLeader'),
			'isGoingOn'=> $is_ongoing,
			'estimatedTime' => $this->input->post('total_time'),
			'booking_date'=> $this->input->post('bookdate'),
			'startDate'=> $this->input->post('psdate'),
			'plannedEndDate'=> $this->input->post('pedate'),
			'isBillable'=> $is_billable,
			'technology'=> $this->input->post('technology'),
			'remark'=> $this->input->post('remark'),
			'isActive'=> $is_active,
			'last_taskCode' => 0
			);			
		$result['row'] = $this->main_model->add_projectdata($data);
		if($result)
		{			
			$this->session->set_flashdata('success', 'Record Inserted');
			redirect(base_url('index.php/main_controller/project_addpage'));
		}
		else
		{
			$this->session->set_flashdata('error', 'Error');
			redirect(base_url('index.php/main_controller/project_addpage'));			
		}
	}
	public function edit_employee($id)
	{		
		$this->form_validation->set_rules('fname','First Name','required|alpha|trim');
		$this->form_validation->set_rules('lname','Last Name','required|alpha|trim');
		$this->form_validation->set_rules('username','User Name','trim');
		$this->form_validation->set_rules('birthdate','Birthdate','trim');
		$this->form_validation->set_rules('contact','Contact','numeric|trim');
		$this->form_validation->set_rules('caddress','Current Address','trim');		
		$this->form_validation->set_rules('paddress','Permanent Address','trim');		
		$this->form_validation->set_rules('pemail','Email','required|valid_email|trim');	

		if($this->form_validation->run() == True)
		{
				$name = $this->input->post('fname') .'  '.$this->input->post('lname');
				if($this->input->post('is_active') == 'on')
				{
					$is_active = 1;
				}
				else
				{
					$is_active = 0;	
				}
				$data = array(
					'salutation' => $this->input->post('gen'),					
					'firstname' => $this->input->post('fname'),
					'middlename' => $this->input->post('mname'),
					'lastname' => $this->input->post('lname'),
					'birthday' => $this->input->post('birthdate'),
					'joining_date' => $this->input->post('joiningdate'),
					'current_address' => $this->input->post('caddress'),
					'permanent_address' => $this->input->post('paddress'),
					'mobile_no' => $this->input->post('contact'),
					'skype' => $this->input->post('skypeid'),					
					'designation_id' => $this->input->post('designation'),
					'username' =>$this->input->post('username'),
					'personal_email' =>$this->input->post('pemail'),
					'company_email' =>$this->input->post('cemail'),
					'businessunit_id'=>$this->input->post('businessUnit'),				
					'IsActive' => $is_active
				);												
				$result = $this->main_model->edit_employeedata($data,$id);				
				if($result)
				{
					$this->session->set_flashdata('success', $name.' '.'\'s Details Updated');
					redirect(base_url('index.php/main_controller/employee_viewpage'));
				}
				else
				{
					$this->session->set_flashdata('error','Unable to update');	
					redirect(base_url('index.php/main_controller/employee_viewpage'));
				}		
		}
		else
		{
			$this->session->set_flashdata('warning','Fill Valid Information');				
			$this->employee_editpage($id);
		}

	}
	public function edit_businessunit($id)
	{
		$name = $this->input->post('bname');
		if($this->input->post('is_active') == 'on')
		{
			$is_active = 1;
		}
		else
		{
			$is_active = 0;	
		}		
		$data = array('businessUnitName' => $this->input->post('bname'),						
					'website' => $this->input->post('website'),
					'email' => $this->input->post('email'),
					'alter_email' => $this->input->post('aemail'),
					'billing_email' => $this->input->post('bemail'),
					'contactNo' => $this->input->post('contact'),
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'country_id' => $this->input->post('country'),					
					'comment' => $this->input->post('comment'),
					'isActive' => $is_active						
				);	
		$result = $this->main_model->edit_businessUnitdata($data,$id);
		if($result)
		{
			$this->session->set_flashdata('success', $name.' '.'Details Updated');
			redirect(base_url('index.php/main_controller/businessUnits_viewpage'));				
		}
		else
		{
			$this->session->set_flashdata('error','Unable to update details of'.' '.$name);		
			redirect(base_url('index.php/main_controller/businessunit_editpage'));
		}
	}
	public function edit_project($id)
	{
		$name = $this->input->post('ptitle');
		if($this->input->post('is_ongoing') == 'on')
		{
			$is_ongoing = 1;
		}
		else
		{
			$is_ongoing = 0;	
		}
		if($this->input->post('is_billable') == 'on')
		{
			$is_billable = 1;
		}
		else
		{
			$is_billable = 0;	
		}	
		if($this->input->post('is_active') == 'on')
		{
			$is_active = 1;
		}
		else
		{
			$is_active = 0;	
		}		
		$data = array('project_title'=> $this->input->post('ptitle'),
			'client_id'=> $this->input->post('com_id'),			
			'account_manager_id'=> $this->input->post('account_manager'),
			'project_manager_id'=> $this->input->post('project_manager'),
			'team_leader_id'=> $this->input->post('teamLeader'),
			'isGoingOn'=> $is_ongoing,
			'estimatedTime' => $this->input->post('total_time'),
			'booking_date'=> $this->input->post('bookdate'),
			'startDate'=> $this->input->post('psdate'),
			'plannedEndDate'=> $this->input->post('pedate'),	
			'isBillable'=> $is_billable,
			'technology'=> $this->input->post('technology'),
			'remark'=> $this->input->post('remark'),
			'isActive'=> $is_active,			
			);		
		$result['row'] = $this->main_model->edit_projectdata($data,$id);
		if($result)
		{			
			$this->session->set_flashdata('success', $name.' '.'Details Updated');
			redirect(base_url('index.php/main_controller/project_viewpage'));				
		}
		else
		{
			$this->session->set_flashdata('error','Unable to update details of'.' '.$name);		
			redirect(base_url('index.php/main_controller/project_viewpage'));
		}
	}
	public function edit_task($id)
	{
		$name = $this->input->post('task_title');
		if($this->input->post('is_active') == 'on')
		{
			$is_active = 1;
		}
		else
		{
			$is_active = 0;	
		}
		if($this->input->post('is_billable') == 'on')
		{
			$is_billable = 1;
		}
		else
		{
			$is_billable = 0;	
		}
		if($this->input->post('is_ongoing') == 'on')
		{
			$is_ongoing = 1;
		}
		else
		{
			$is_ongoing = 0;	
		}
		$pid = $this->input->post('pro_id');
		$old_id =  $this->input->post('old_pro_id');
		if($pid != $old_id)
		{
			$Code = $this->main_model->checkLastTaskCode($pid);
			$record1 = $Code->result();		
			foreach ($record1 as $key) 
			{
					$num = $key->last_taskCode;				
			}
			$num = sprintf('%010d',++$num);
		}
		else
		{
			$num = sprintf('%010d',$this->input->post('old_taskCode'));
		}				
		$data = array('title' => $this->input->post('task_title'),
					  'projectID'=> $this->input->post('pro_id'),
					  'task_code'=> $num,	
					  'isOnGoing' => $is_ongoing,
					  'isBillable' => $is_billable,
					  'startDate' => $this->input->post('task_startdate'),
					  'endDate' => $this->input->post('task_enddate'),					  
					  'estimatedTime' => $this->input->post('whh') .'.'. $this->input->post('wmm'),
					  'description' => $this->input->post('task_desc'),
					  'isActive' => $is_active,
					  'acitivityType_id' => $this->input->post('activityType')					  
				);
//		echo"<pre>";print_r($data);echo"</pre>";exit;
		
		$insertTask = $this->main_model->edit_taskdata($data,$id,$pid,$old_id);
		if($insertTask)
		{			
			$this->session->set_flashdata('success', $name.' '.'Details Updated');
			redirect(base_url('index.php/main_controller/task_viewpage'));				
		}
		else
		{
			$this->session->set_flashdata('error','Unable to update details of'.' '.$name);		
			redirect(base_url('index.php/main_controller/task_viewpage'));
		}
	}

	public function add_admin()
	{	
		$this->form_validation->set_rules('email','Email','required|valid_email|trim');		
		$this->form_validation->set_rules('password','Password','required|trim');

		if($this->form_validation->run() == True)
		{
				if($this->input->post('is_active') == 'on')
				{
					$is_active = 1;
				}
				else
				{
					$is_active = 0;	
				}				
				$data = array(
					'username' =>$this->input->post('username'),
					'email' =>$this->input->post('email'),					
					'password' => $this->input->post('password'),					
					'is_active' => $is_active
				);							
				$url = $this->do_upload2();		
				$result = $this->main_model->add_admindata($data,$url);
				if($result)
				{
					$this->session->set_flashdata('success','Record Inserted');
					redirect(base_url('index.php/main_controller/admin_addpage'));					
				}
				else
				{
					$this->session->set_flashdata('error','Error');
					redirect(base_url('index.php/main_controller/admin_addpage'));
				}		
		}
		else
		{
			$this->admin_addpage();
		}

	}
	public function add_employee()
	{	
		$this->form_validation->set_rules('fname','First Name','required|alpha|trim');
		$this->form_validation->set_rules('mname','Middle Name','alpha|trim');
		$this->form_validation->set_rules('lname','Last Name','required|alpha|trim');
		$this->form_validation->set_rules('birthdate','Birthdate','trim');
		$this->form_validation->set_rules('designation','Designation','trim');
		$this->form_validation->set_rules('joiningdate','Joiningdate','trim');
		$this->form_validation->set_rules('pimage','Image','trim');
		$this->form_validation->set_rules('contact','Contact','trim|numeric');
		$this->form_validation->set_rules('skypeid','Skype ID','trim');
		$this->form_validation->set_rules('caddress','Current Address','trim');
		$this->form_validation->set_rules('paddress','Permanent Address','trim');
		$this->form_validation->set_rules('username','User Name','required|trim');
		$this->form_validation->set_rules('pemail','Personal Email','required|valid_email|trim');
		$this->form_validation->set_rules('cemail','Comapny Email','valid_email|trim');
		$this->form_validation->set_rules('password','Password','required|trim');

		if($this->form_validation->run() == True)
		{
				if($this->input->post('is_active') == 'on')
				{
					$is_active = 1;
				}
				else
				{
					$is_active = 0;	
				}
				$checkCode = $this->main_model->checkcode();
				$num = $checkCode->num_rows();
				$num = sprintf('%03d',++$num);				
				$empcode = 'AVIWS'.$num;
				$data = array('emp_code' => $empcode,
					'salutation' => $this->input->post('gen'),					
					'firstname' => $this->input->post('fname'),
					'middlename' => $this->input->post('mname'),
					'lastname' => $this->input->post('lname'),
					'birthday' => $this->input->post('birthdate'),
					'joining_date' => $this->input->post('joiningdate'),
					'current_address' => $this->input->post('caddress'),
					'permanent_address' => $this->input->post('paddress'),
					'mobile_no' => $this->input->post('contact'),
					'skype' => $this->input->post('skypeid'),					
					'designation_id' => $this->input->post('designation'),
					'username' =>$this->input->post('username'),
					'personal_email' =>$this->input->post('pemail'),
					'company_email' =>$this->input->post('cemail'),
					'password' => $this->input->post('password'),
					'businessunit_id'=>	$this->input->post('businessUnit'),		
					'IsActive' => $is_active
				);				
				$data2 = array('username' =>$this->input->post('username'),
					'email' =>$this->input->post('pemail'),
					'password' => $this->input->post('password')
				);				
				$url = $this->do_upload($empcode);		
				$result = $this->main_model->add_employee($data,$url,$data2);
				if($result)
				{
					$this->session->set_flashdata('success','Record Inserted');
					redirect(base_url('index.php/main_controller/employee_addpage'));					
				}
				else
				{
					$this->session->set_flashdata('error','Error');
					redirect(base_url('index.php/main_controller/employee_addpage'));
				}		
		}
		else
		{
			$this->employee_addpage();
		}

	}
	public function add_businessUnit()
	{
		$this->form_validation->set_rules('bname','Business Unit Name','required|trim');
		$this->form_validation->set_rules('website','Website','trim');
		$this->form_validation->set_rules('email','Email','trim');
		$this->form_validation->set_rules('aemail','Alternet Email','trim');
		$this->form_validation->set_rules('bemail','Billing Email','trim');
		$this->form_validation->set_rules('contact','Contact','trim');
		$this->form_validation->set_rules('address','Address','trim');
		$this->form_validation->set_rules('country','Country','trim');		
		$this->form_validation->set_rules('comment','Comment','trim');	
		
		if($this->form_validation->run() == True)
		{
				if($this->input->post('is_active') == 'on')
				{
					$is_active = 1;
				}
				else
				{
					$is_active = 0;	
				}					
				$Code = $this->main_model->view_businessUnit();
				$num = $Code->num_rows();
				$num = sprintf('%03d',++$num);
				$comcode = 'AVI'.$num;					
				$data = array('businessUnitName' => $this->input->post('bname'),					
					'businessUnitCode' => $comcode,
					'website' => $this->input->post('website'),
					'email' => $this->input->post('email'),
					'alter_email' => $this->input->post('aemail'),
					'billing_email' => $this->input->post('bemail'),
					'contactNo' => $this->input->post('contact'),
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'country_Id' => $this->input->post('country'),					
					'comment' => $this->input->post('comment'),
					'isActive' => $is_active						
				);					
				$result = $this->main_model->add_businessunit_data($data);
				if($result)
				{
					echo"<script>alert('Business Unit Details Added');</script>";
					redirect(base_url('index.php/main_controller/businessUnits_viewpage'));					
				}
				else
				{
					echo"<script>alert('Unable To Add Client Details');</script>";	
					redirect(base_url('index.php/main_controller/businessUnits_viewpage'));
				}		
		}
		else
		{
			$this->businessUnit_addpage();
		}
	}
	public function add_client()
	{
		$this->form_validation->set_rules('cname','Client Name','required|alpha|trim');
		$this->form_validation->set_rules('website','Website','trim');
		$this->form_validation->set_rules('email','Email','trim');
		$this->form_validation->set_rules('aemail','Alternet Email','trim');
		$this->form_validation->set_rules('bemail','Billing Email','trim');
		$this->form_validation->set_rules('contact','Contact','trim');
		$this->form_validation->set_rules('address','Address','trim');
		$this->form_validation->set_rules('country','Country','trim');		
		$this->form_validation->set_rules('comment','Comment','trim');	
		
		if($this->form_validation->run() == True)
		{
				if($this->input->post('is_active') == 'on')
				{
					$is_active = 1;
				}
				else
				{
					$is_active = 0;	
				}					
				$Code = $this->main_model->view_client();
				$num = $Code->num_rows();
				$num = sprintf('%03d',++$num);
				$comcode = 'AVI'.$num;					
				$data = array('clientName' => $this->input->post('cname'),						
					'clientCode' => $comcode,
					'website' => $this->input->post('website'),
					'email' => $this->input->post('email'),
					'alter_email' => $this->input->post('aemail'),
					'billing_email' => $this->input->post('bemail'),
					'contactNo' => $this->input->post('contact'),
					'address' => $this->input->post('address'),
					'country_Id' => $this->input->post('country'),					
					'account_manager_id' => $this->input->post('account_manager'),
					'project_manager_id' => $this->input->post('project_manager'),
					'team_leader_id' => $this->input->post('teamLeader'),
					'comment' => $this->input->post('comment'),
					'clientRating'=> $this->input->post('rateNum'),
					'isActive' => $is_active						
				);					
				//echo"<pre>";print_r($data);echo"</pre>";exit;
				$result = $this->main_model->add_client_data($data);
				if($result)
				{
					$this->session->set_flashdata('success','Record Inserted');
					redirect(base_url('index.php/main_controller/client_addpage'));		
				}
				else
				{
					$this->session->set_flashdata('error','Unable To Add Client');
					redirect(base_url('index.php/main_controller/client_addpage'));
				}		
		}
		else
		{
			$this->client_addpage();
		}				
	}	
	public function edit_client($id)
	{		
		$name = $this->input->post('cname');
		if($this->input->post('is_active') == 'on')
		{
			$is_active = 1;
		}
		else
		{
			$is_active = 0;	
		}		
		$data = array('clientName' => $this->input->post('cname'),						
					'website' => $this->input->post('website'),
					'email' => $this->input->post('email'),
					'alter_email' => $this->input->post('aemail'),
					'billing_email' => $this->input->post('bemail'),
					'contactNo' => $this->input->post('contact'),
					'address' => $this->input->post('address'),
					'country_Id' => $this->input->post('country'),					
					'account_manager_id' => $this->input->post('account_manager'),
					'project_manager_id' => $this->input->post('project_manager'),
					'team_leader_id' => $this->input->post('teamLeader'),
					'comment' => $this->input->post('comment'),
					'clientRating'=> $this->input->post('rateNum'),
					'isActive' => $is_active				
							
				);			
		$result = $this->main_model->edit_clientdata($data,$id);
		if($result)
		{
			$this->session->set_flashdata('success', $name.' '.'Details Updated');
			redirect(base_url('index.php/main_controller/client_viewpage'));				
		}
		else
		{
			$this->session->set_flashdata('error','Unable to update details of'.' '.$name);		
			redirect(base_url('index.php/main_controller/client_viewpage'));
		}
	}
	public function do_upload($empcode)
	{
		$type = explode('.',$_FILES["pimage"]["name"]);
		$type = $type[count($type)-1];
		$url = "assets/emp_images/".$empcode.'.'.$type;
		if(in_array($type,array("jpg","jpeg","png")))
			if(is_uploaded_file($_FILES["pimage"]["tmp_name"]))
				if(move_uploaded_file($_FILES["pimage"]["tmp_name"], $url))
					return $url;

		return "";
	}
	public function do_upload2()
	{	
		$num = rand();
		$type = explode('.',$_FILES["admin_img"]["name"]);
		$type = $type[count($type)-1];
		$url = "assets/emp_images/".$num.'.'.$type;
		if(in_array($type,array("jpg","jpeg","png")))
			if(is_uploaded_file($_FILES["admin_img"]["tmp_name"]))
				if(move_uploaded_file($_FILES["admin_img"]["tmp_name"], $url))
					return $url;

		return "";
	}
	public function do_upload_1($cname)
	{
		$type = explode('.',$_FILES["logofld"]["name"]);
		$type = $type[count($type)-1];
		$url = "assets/co_logo/".$cname.'.'.$type;
		if(in_array($type,array("jpg","jpeg","png")))
			if(is_uploaded_file($_FILES["logofld"]["tmp_name"]))
				if(move_uploaded_file($_FILES["logofld"]["tmp_name"], $url))
					return $url;

		return "";
	}		
	//--------------------- End admin_controller------------------------

}