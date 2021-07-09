<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pmtl_Controller extends CI_Controller 
{
	public function index()
	{
		$getEmpList = $this->main_model->getEmpList();
		$a = array(
					'getEmpList'=>$getEmpList
				);
		$data1['row1'] = $this->main_model->MyselftaskList();
		$data2['row2'] = $this->main_model->DelightedtaskList();
		$merge = array_merge($data1,$a,$data2);	
		$this->load->view('pmtl/index',$merge);
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
	public function updateStatus()  // updating task status through Ajax
	{
		$returndata = array();
		$id = $this->input->post('ad_id');
		$status = $this->input->post('status');
		$spent_time = $this->input->post('spenttime');
		$data['result'] = $this->main_model->updateWStatus($id,$status,$spent_time);
		if(!empty($data))
		{	
			foreach ($data['result']->result() as $key) 
			{
				$a = $key->status;
				array_push($returndata,$a);
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
	public function events()
	{
		$this->load->view('pmtl/calendar');
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
			$row1[] = "<a href='".base_url('index.php/pmtl_controller/taskAllocation_addpage/'.urlencode(base64_encode($main_model->pt_id)))."'<i class='fa fa-check-square-o'></i>&nbsp;Allocate</a>";
			$row1[] = "<a href='".base_url('index.php/pmtl_controller/task_editpage/'.urlencode(base64_encode($main_model->pt_id)))."'<i class='fa fa-edit (alias)'></i>&nbsp;Edit</a>";
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
	public function task_addpage()
	{
		$getactivityType = $this->main_model->getActivityType();
		$getemplist = $this->main_model->getEmpList();
		$underprojectName = $this->main_model->projectListPmtl();
		$a = array(
					'getactivityType'=>$getactivityType,
					'getemplist'=>$getemplist,
					'underprojectName'=>$underprojectName
				);
		$this->load->view('pmtl/add_task',$a);
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
		$pid = $this->input->post('sproject_name');
		$Code = $this->main_model->checkLastTaskCode($pid);
		$record1 = $Code->result();		
		foreach ($record1 as $key) 
		{
				$num = $key->last_taskCode;				
		}
		$num = sprintf('%010d',++$num);	
		$h = $this->input->post('whh');
		$m = $this->input->post('wmm');
		$t = (int)$h.".".(int)$m;
		$t1 = $t * 60;
		$data = array('title' => $this->input->post('task_title'),
					  'projectID'=> $this->input->post('sproject_name'),
					  'task_code'=> $num,	
					  'isOnGoing' => $is_ongoing,
					  'isBillable' => $is_billable,
					  'startDate' => $this->input->post('task_startdate'),
					  'endDate' => $this->input->post('task_enddate'),					  
					  'estimatedTime' => $t1,
					  'description' => $this->input->post('task_desc'),
					  'isActive' => $is_active,
					  'acitivityType_id' => $this->input->post('activityType')					  
				);
		
		$insertTask = $this->main_model->add_Taskdata($data,$pid);
		if($insertTask)
		{			
			echo"<script>alert('Successfully Added New Task');</script>";
			redirect(base_url('index.php/pmtl_controller/task_viewpage'));
		}
		else
		{
			echo"<script>alert('Unable To Add New Task');</script>";	
			redirect(base_url('index.php/pmtl_controller/task_viewpage'));
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
		$h = $this->input->post('whh');
		$m = $this->input->post('wmm');
		$t = (int)$h.".".(int)$m;
		$t1 = $t * 60;
		$data = array('title' => $this->input->post('task_title'),
					  'projectID'=> $this->input->post('pro_id'),
					  'task_code'=> $num,	
					  'isOnGoing' => $is_ongoing,
					  'isBillable' => $is_billable,
					  'startDate' => $this->input->post('task_startdate'),
					  'endDate' => $this->input->post('task_enddate'),					  
					  'estimatedTime' =>  $t1,
					  'description' => $this->input->post('task_desc'),
					  'isActive' => $is_active,
					  'acitivityType_id' => $this->input->post('activityType')					  
				);		
		$insertTask = $this->main_model->edit_taskdata($data,$id,$pid,$old_id);
		if($insertTask)
		{			
			$this->session->set_flashdata('success', $name.' '.'Details Updated');
			redirect(base_url('index.php/pmtl_controller/task_viewpage'));				
		}
		else
		{
			$this->session->set_flashdata('error','Unable to update details of'.' '.$name);		
			redirect(base_url('index.php/pmtl_controller/task_viewpage'));
		}
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
		$this->load->view('pmtl/edit_task',$merge);
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
		$this->load->view('pmtl/view_task',$merge);
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
		$this->load->view('pmtl/task_allocation',$merge);
	}
	public function allocateTask()
	{	 
		$h = $this->input->post('whh');
		$m = $this->input->post('wmm');
		$t = (int)$h.".".(int)$m;
		$t1 = $t * 60;
		$data = array('allocatedDate' => $this->input->post('task_allocatedDate'),
					  'projectTaskId'=> $this->input->post('task-id'),
					  'allocatedById'=> $_SESSION["user_id"],	
					  'allocatedToId' => $this->input->post('Allocated_To'),
					  'startDate' => $this->input->post('task_startdate'),
					  'endDate' => $this->input->post('task_enddate'),
					  'allocated_time' => $t1,
					  'description' => $this->input->post('task_desc') 
				);
		$tid = $this->input->post('task-id');
		$insertAllocationData['id'] = $this->main_model->add_allocationData($data,$tid);
		$allocationID = $insertAllocationData['id'];
		if($allocationID == NULL)
		{
			$this->session->set_flashdata('error', 'Unable To Allocate Task');
			redirect(base_url('index.php/pmtl_controller/task_viewpage'));
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
			redirect(base_url('index.php/pmtl_controller/task_viewpage'));
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
		$data = array('project_title'=> $this->input->post('ptitle'),
			'client_id'=> $this->input->post('com_id'),
			'project_code'=> $num,
			'account_manager_id'=> $this->input->post('account_manager'),
			'project_manager_id'=> $this->input->post('project_manager'),
			'team_leader_id'=> $this->input->post('teamLeader'),
			'isGoingOn'=> $is_ongoing,
			'estimatedTime' => $this->input->post('hh').'.'.$this->input->post('mm'),
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
			redirect(base_url('index.php/pmtl_controller/project_addpage'));
		}
		else
		{
			$this->session->set_flashdata('error', 'Error');
			redirect(base_url('index.php/pmtl_controller/project_addpage'));			
		}
	}
	public function project_addpage()
	{			
		$getemplist = $this->main_model->getEmpList();
		$a = array(							
					'getemplist'=>$getemplist
				);	
		$this->load->view('pmtl/add_project',$a);	
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
		$this->load->view('pmtl/edit_project',$merge);
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
			'estimatedTime' => $this->input->post('hh').'.'.$this->input->post('mm'),
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
			redirect(base_url('index.php/pmtl_controller/project_viewpage'));				
		}
		else
		{
			$this->session->set_flashdata('error','Unable to update details of'.' '.$name);		
			redirect(base_url('index.php/pmtl_controller/project_viewpage'));
		}
	}
	public function project_viewpage()
	{
		$getEmpList = $this->main_model->getEmpList();
		$a = array(
					'getEmpList'=>$getEmpList
				);
		$data['row'] = $this->main_model->view_project_pmtl();
		$merge = array_merge($data,$a);	
		$this->load->view('pmtl/view_project',$merge);
	}
}

?>