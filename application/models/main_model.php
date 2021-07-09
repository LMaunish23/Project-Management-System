<?php

class main_model extends CI_Model 
{	
	var $column_order = array(null, 'taskcode','title','project_id','startDate','endDate','description','Allocate','Edit','Delete'); //set column field database for datatable orderable
	var $column_search = array('taskcode','title','project_id','startDate','endDate','description'); //set column field database for datatable searchable 
	var $order = array('pt_id' => 'asc'); // default order 

	//--------------------- filter process start-----------------------

	private function _get_datatables_query()
	{		
		//add custom filter here
		$user = $_SESSION['admin_id'];
		if($this->input->post('project_id'))
		{			
			$string_version = implode(',',$this->input->post('project_id'));
			$destination_array = explode(',',$string_version);
			$name_to_id = $this->main_model->find_projectBy_name($destination_array[0]); 
			$this->db->where('projectID', $name_to_id);
		}	
		if($this->input->post('startDate'))
		{
			$this->db->like('startDate', $this->input->post('startDate'));
		}
		if($this->input->post('endDate'))
		{
			$this->db->like('endDate', $this->input->post('endDate'));
		}		
		$this->db->from('tbl_project_task')->where('task_allocation_flag = 0');
		
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_datatables() // main_controller //pmtl_controller
	{		
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	public function count_filtered() // main_controller //pmtl_controller
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all() // main_controller //pmtl_controller
	{
		$this->db->from('tbl_project_task');
		return $this->db->count_all_results();
	}





	//------------------filter process end-------------------------------

	// --------------------start login code ----------------------------

	public function login_process($login_id,$password)
	{
		$msg;
	    $this->db->select('*');
	    $this->db->like('personal_email',$login_id);
	    $this->db->or_like('username',$login_id);
		$this->db->where('password',$password);		
		$row = $this->db->get('tbl_employee');
		if($row->result() == NULL)
		{
			$msg;
		    $this->db->select('*');
		    $this->db->like('email',$login_id);
		    $this->db->or_like('username',$login_id);
			$this->db->where('password',$password);		
			$row = $this->db->get('tbl_admin');		
			return $row;
		}	
		else
		{
			return $row;
		}		
	}


	// --------------------end login code ----------------------------
	

	// --------------------start admin code ----------------------------
	public function getJobType() // main_controller
	{
			$query = $this->db->get('tbl_jobtype');
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
	}
	public function getProject() // main_controller //pmtl_controller
	{
		$query = $this->db->get('tbl_project');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	public function get_list_projects() // main_controller //pmtl_controller
	{
		$this->db->select('project_title');
		// $this->db->like('account_manager_id',$_SESSION['admin_id']);
	    $this->db->like('project_manager_id',$_SESSION['admin_id']);
	    $this->db->or_like('team_leader_id',$_SESSION['admin_id']);
		$this->db->from('tbl_project');
		$this->db->order_by('project_title','asc');
		$query = $this->db->get();
		$result = $query->result();		
		$getProjectName = array();
		foreach ($result as $row) 
		{
			$getProjectName[] = $row->project_title;
		}
		return $getProjectName;
	}
	public function list_projects($id) // main_controller //pmtl_controller
	{
		$this->db->select('project_title')->where('project_id',$id);
		$this->db->from('tbl_project');		
		$query = $this->db->get();
		$result = $query->result();		
		$getProjectName = "";
		foreach ($result as $row) 
		{
			$getProjectName = $row->project_title;
		}
		return $getProjectName;
	}
	public function find_projectBy_name($title)
	{	
		$query = $this->db->query("SELECT project_id from tbl_project where project_title = '$title'");
		$result = $query->result();		
		$getProjectId = "";
		foreach ($result as $row) 
		{
			$getProjectId = $row->project_id;
		}
		return $getProjectId;
	}
	public function getActivityType() // main_controller //pmtl_controller
	{
			$query = $this->db->get('tbl_activity_type');
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
	}
	public function getBUList() // main_controller
	{
		$query = $this->db->query("select * from tbl_businessunit");
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{ 
			 $msg = "No Result";
			 return $msg;
		}
	}
	public function getEmpList() // main_controller  //pmtl_controller
	{
		$query = $this->db->get('tbl_employee');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	public function getholidayList() // main_controller //pmtl_controller
	{	
		$row = $this->db->query('SELECT * FROM `tbl_holidayset` ORDER BY `tbl_holidayset`.`holiday_date` ASC');
		return $row;
	}
	public function getContactInfoType()
	{
			$query = $this->db->get('tbl_contact_info_type');
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
	}
	public function getCountry() // main_controller
	{
			$query = $this->db->query('select * from tbl_relatedmaster where masterType = "Country" AND isActive = 1');
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
	}
	public function getCurrency() // main_controller
	{
			$query = $this->db->query('select * from tbl_relatedmaster where masterType = "Currency" AND isActive = 1');
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
	}
	public function getProjectStatus()
	{
		$query = $this->db->query('select * from tbl_relatedmaster where masterType = "ProjectStatus" AND isActive = 1');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	public function disp_allocated_task()
	{			 
		if(empty($_SESSION['logged_in']))
		{
		    redirect(base_url());
		}
		else
		{
			$uid = $_SESSION['user_id'];
			$d = date('Y-m-d');
			$row1 = $this->db->query("select c.clientCode,pt.task_code,pt.title,p.project_title,p.project_code,a.startDate,a.endDate,a.allocated_time,a.allocatedById,a.allocatedToId,ad.spentTime,ad.status,ad.priority,ad.allocated_date,ad.ad_id FROM tbl_project_task AS pt,tbl_project AS p,tbl_allocationDetail AS ad,tbl_allocation AS a,tbl_client AS c WHERE pt.projectID = p.project_id AND a.projectTaskId = pt.pt_id AND a.al_id = ad.allocation_id AND a.allocatedToId = $uid AND c.co_id = p.client_id AND ad.allocated_date <= '$d' AND ad.status != 2 ORDER BY ad.allocated_date DESC");			
			return $row1;
		}		
	}
	public function getWorkDates()
	{
		$query = $this->db->get('tbl_workdetail');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	public function updateWStatus($id,$status,$workdetailsdata,$workday) //pmtl_controller
	{
		echo $id;
		$this->db->set('status',$status);
		$this->db->where('ad_id',$id);
		$this->db->update('tbl_allocationdetail');	

		$qry = $this->db->query("select allocationDetailID from tbl_workdetail where workDate = '$workday' AND allocationDetailID = $id");
		$record = $qry->result();
		if(count($record) > 0)
		{
			foreach ($record as $key)
			{
				if($key->allocationDetailID == $id)
				{
					$this->db->where('allocationDetailID',$id);
					$this->db->where('workDate',$workday);
					$this->db->update('tbl_workdetail',$workdetailsdata);
				}
			}			
		}
		else
		{
			$this->db->insert('tbl_workdetail',$workdetailsdata);
		}			
		$result = $this->db->query("select ad.status,ad.ad_id,w.allocationDetailID,w.startTime,w.endTime FROM tbl_workdetail AS w,tbl_allocationDetail AS ad WHERE ad.ad_id = w.allocationDetailID AND w.allocationDetailID = $id");
		return $result;
	}
	public function MyselftaskList() //pmtl_controller
	{
		if(empty($_SESSION['logged_in']))
		{
		    redirect(base_url());
		}
		else
		{
			$uid = $_SESSION['user_id'];
			$d = date('Y-m-d');
			$row = $this->db->query("select c.clientCode,pt.task_code,pt.title,p.project_title,p.project_code,a.startDate,a.endDate,a.allocated_time,a.allocatedById,a.allocatedToId,ad.spentTime,ad.status,ad.priority,ad.allocated_date,ad.ad_id FROM tbl_project_task AS pt,tbl_project AS p,tbl_allocationDetail AS ad,tbl_allocation AS a,tbl_client AS c WHERE pt.projectID = p.project_id AND a.projectTaskId = pt.pt_id AND a.al_id = ad.allocation_id AND a.allocatedToId = $uid AND c.co_id = p.client_id AND ad.allocated_date <= '$d' AND ad.status != 2 ORDER BY ad.allocated_date DESC");
			return $row;
		}
	}
	public function DelightedtaskList() //pmtl_controller
	{
		if(empty($_SESSION['logged_in']))
		{
		    redirect(base_url());
		}
		else
		{
			$uid = $_SESSION['user_id'];
			$d = date('Y-m-d');
			$row = $this->db->query("select c.clientCode,pt.task_code,pt.title,p.project_title,p.project_code,a.startDate,a.endDate,a.allocated_time,a.allocatedById,a.allocatedToId,ad.spentTime,ad.status,ad.priority,ad.allocated_date FROM tbl_project_task AS pt,tbl_project AS p,tbl_allocationDetail AS ad,tbl_allocation AS a,tbl_client AS c WHERE pt.projectID = p.project_id AND a.projectTaskId = pt.pt_id AND a.al_id = ad.allocation_id AND a.allocatedById = $uid AND a.allocatedToId != $uid AND c.co_id = p.client_id AND ad.allocated_date <= '$d' ORDER BY ad.allocated_date DESC");
			return $row;
		}
	}
	public function add_employee($data,$url) // main_controller
	{
		// $this->db->insert('tbl_client',$data);		
		// $id = $this->db->insert_id();
		// $this->db->set('emp_id',$id);
		// $this->db->set('logo',$url);
		// $this->db->insert('tbl_client',$data);		
		// $id = $this->db->insert_id();
		// $this->db->set('emp_id',$id);
		// return $this->db->insert('tbl_login',$data2);
		$this->db->set('profile_pic',$url);
		return $this->db->insert('tbl_employee',$data);		
	}
	public function add_announcementData($data)
	{
		return $this->db->insert('tbl_announcement',$data);
	}
	public function add_adminData($data,$url) // main_controller
	{
		$this->db->set('image',$url);
		return $this->db->insert('tbl_admin',$data);		
	}
	public function add_Taskdata($data,$pid) // main_controller //pmtl_controller
	{		
		$this->db->insert('tbl_project_task',$data);
		$qry = $this->db->query('select task_code from tbl_project_task where projectID = '.$pid);
		$returndata = $qry->result();
		foreach ($returndata as $key)
		{
			$num = $key->task_code;
		}
		return $this->db->query("Update tbl_project set last_taskCode = $num where project_id = $pid");		 
	}
	public function add_client_data($data) // main_controller
	{
		return $this->db->insert('tbl_client',$data);
	}
	public function add_holidayData($data) // main_controller
	{
		return $this->db->insert('tbl_holidayset',$data);
	}
	public function add_allocationData($data,$tid) // main_controller //pmtl_controller
	{
		$this->db->insert('tbl_allocation',$data);
		$id = $this->db->insert_id();
		$this->db->query("Update tbl_project_task set 	task_allocation_flag = 1 where pt_id = $tid");
		return $id;
	}	
	public function add_allocationDetails($data2) // main_controller //pmtl_controller
	{
		return $this->db->insert('tbl_allocationdetail',$data2);
	}	
	public function add_sundayWeekday($data) // main_controller
	{
		return $this->db->insert('tbl_holidayset',$data);
	}
	public function add_businessunit_data($data) // main_controller
	{
		return $this->db->insert('tbl_businessunit',$data);
	}
	public function add_projectdata($data) // main_controller //pmtl_controller
	{
		return $this->db->insert('tbl_project',$data);
	}
	public function checkcode()  //also used for view employee page   // main_controller
	{
		$this->db->select('*');
		$code = $this->db->get('tbl_employee');
		return $code;
	}
	public function checkLastTaskCode($pid) // main_controller //pmtl_controller
	{	
		$row = $this->db->query('select last_taskCode from tbl_project where project_id = '.$pid);
		return $row;
	}
	public function fetch_employee($id) // main_controller
	{
		$eid = base64_decode(urldecode($id));
		$this->db->select('*')->where('emp_id='.$eid);
		$row = $this->db->get('tbl_employee');
		return $row;	
	}
	public function fetch_project($id) // main_controller
	{
		$pid = base64_decode(urldecode($id));
		$this->db->select('*')->where('project_id='.$pid);
		$row = $this->db->get('tbl_project');
		return $row;	
	}
	public function fetch_holidays($id) // main_controller
	{
		$hid = base64_decode(urldecode($id));
		$this->db->select('*')->where('holiday_id='.$hid);
		$row = $this->db->get('tbl_holidayset');
		return $row;	
	}
	public function fetch_announcements($id) // main_controller
	{
		$hid = base64_decode(urldecode($id));
		$this->db->select('*')->where('an_id='.$hid);
		$row = $this->db->get('tbl_announcement');
		return $row;
	}	
	public function fetch_client($id) // main_controller
	{
		$cid = base64_decode(urldecode($id));
		$this->db->select('*')->where('co_id='.$cid);
		$row = $this->db->get('tbl_client');
		return $row;	
	}	
	public function fetch_businessunit($id) // main_controller
	{
		$bid = base64_decode(urldecode($id));
		$this->db->select('*')->where('bu_id='.$bid);
		$row = $this->db->get('tbl_businessunit');
		return $row;	
	}
	public function fetch_task($id) // main_controller //pmtl_controller
	{
		$tid = base64_decode(urldecode($id));
		$this->db->select('*')->where('pt_id='.$tid);
		$row = $this->db->get('tbl_project_task');
		return $row;	
	}
	public function getRowsCo($params = array()) // main_controller  //searching company in add_project page 
	{
		$this->db->select("*");
		$this->db->from('tbl_client');

		if(array_key_exists("conditions",$params))
		{
			foreach ($params['conditions'] as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		if(!empty($params['searchTerm'])){
			$this->db->like('clientName',$params['searchTerm']);
		}
		$this->db->order_by('clientName','asc');

		if(array_key_exists("id", $params))
		{
			$this->db->where('co_id',$params['id']);
			$query = $this->db->get();
            $result = $query->row_array();
		}
		else
		{
			 $query = $this->db->get();
             $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
		}
		return $result;

	}
	public function getRowsPro($params = array()) // main_controller //pmtl_controller  //searching company in add_project page
	{
		$this->db->select("*");
		$this->db->from('tbl_project');

		if(array_key_exists("conditions",$params))
		{
			foreach ($params['conditions'] as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		if(!empty($params['searchTerm'])){
			$this->db->like('project_title',$params['searchTerm']);
		}

		$this->db->order_by('project_title','asc');

		if(array_key_exists("id", $params))
		{
			$this->db->where('project_id',$params['id']);
			$query = $this->db->get();
            $result = $query->row_array();
		}
		else
		{
			 $query = $this->db->get();
             $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
		}		
		return $result;
	}
	public function getRowsEmp($params = array()) // main_controller  //searching person in add_project page
	{
		$this->db->select("*");
		$this->db->from('tbl_employee');

		if(array_key_exists("conditions",$params))
		{
			foreach ($params['conditions'] as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		if(!empty($params['searchTerm'])){
			$this->db->like('firstname',$params['searchTerm']);
			$this->db->or_like('lastname',$params['searchTerm']);
		}
		if(array_key_exists("id", $params))
		{
			$this->db->where('emp_id',$params['id']);
			$query = $this->db->get();
            $result = $query->row_array();
		}
		else
		{
			 $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
		}		
		return $result;

	}
	public function edit_employeedata($data,$id) // main_controller
	{
		$this->db->where('emp_id='.$id);
		return $this->db->update('tbl_employee',$data);
	}
	public function edit_taskdata($data,$id,$pid,$old_id) // main_controller //pmtl_controller
	{
		$qry = $this->db->query('select task_code from tbl_project_task where projectID = '.$old_id);
		$returndata = $qry->result();
		foreach ($returndata as $key)
		{
			$num = $key->task_code;
		}
		$num = $num - 1;
		$this->db->query("Update tbl_project set last_taskCode = $num where project_id = $old_id");
		$this->db->where('pt_id='.$id);
		$this->db->update('tbl_project_task',$data);		
		$qry = $this->db->query('select task_code from tbl_project_task where projectID = '.$pid);
		$returndata = $qry->result();
		foreach ($returndata as $key)
		{
			$num = $key->task_code;
		}
		return $this->db->query("Update tbl_project set last_taskCode = $num where project_id = $pid");		
	}
	public function edit_clientdata($data,$id) // main_controller
	{
		$this->db->where('co_id='.$id);
		return $this->db->update('tbl_client',$data);
	}
	public function edit_holidaydata($data,$id) // main_controller
	{
		$this->db->where('holiday_id='.$id);
		return $this->db->update('tbl_holidayset',$data);
	}
	public function edit_announcementdata($data,$id)  //main_controller
	{
		$this->db->where('an_id='.$id);
		return $this->db->update('tbl_announcement',$data);
	}
	public function edit_businessUnitdata($data,$id) // main_controller
	{
		$this->db->where('bu_id='.$id);
		return $this->db->update('tbl_businessunit',$data);
	}
	public function edit_projectdata($data,$id) // main_controller //pmtl_controller
	{ 
		$this->db->where('project_id='.$id);
		return $this->db->update('tbl_project',$data);
	}
	public function view_client() // main_controller
	{
		$row = $this->db->query("select * from tbl_client");
		return $row;
	}
	public function view_announcement() // main_controller
	{
		$row = $this->db->query("select * from tbl_announcement");
		return $row;
	}
	public function view_admin() // main_controller
	{
		$row = $this->db->query("select * from tbl_admin");
		return $row;
	}
	public function view_holiday() // main_controller
	{
		$row = $this->db->query("select * from tbl_holidayset");
		return $row;
	}
	public function view_businessUnit() // main_controller
	{
		$row = $this->db->query("select * from tbl_businessunit");
		return $row;
	}
	public function view_project() // main_controller //pmtl_controller
	{		
		$row = $this->db->query('Select * from tbl_project');
		return $row;
	}
	public function view_project_pmtl() // pmtl_controller
	{	
		$this->db->select('*');
		$this->db->like('account_manager_id',$_SESSION['user_id']);
	    $this->db->or_like('project_manager_id',$_SESSION['user_id']);
	    $this->db->or_like('team_leader_id',$_SESSION['user_id']);
		$this->db->from('tbl_project');
		$this->db->order_by('project_title','asc');
		$row = $this->db->get();
		return $row;
	}
	public function projectListPmtl() //pmtl_controller
	{
		$this->db->select('*');
		$this->db->like('account_manager_id',$_SESSION['user_id']);
	    $this->db->or_like('project_manager_id',$_SESSION['user_id']);
	    $this->db->or_like('team_leader_id',$_SESSION['user_id']);
		$this->db->from('tbl_project');
		$this->db->order_by('project_title','asc');
		$row = $this->db->get();
		if($row->num_rows() > 0)
		{
			return $row->result();
		}
	}
	public function view_task() // main_controller //pmtl_controller
	{		
		$row = $this->db->query('select * from tbl_project_task Where task_allocation_flag = 0');
		return $row;
	}
	// --------------------end admin code ----------------------------
}
