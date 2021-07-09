<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TechTeam_Controller extends CI_Controller 
{	
	public function index()
	{
		$getEmpList = $this->main_model->getEmpList();
		$getWorkDates = $this->main_model->getWorkDates();
		$a = array(
					'getEmpList'=>$getEmpList,
					'getWorkDates'=>$getWorkDates
				);
		$data1['row1'] = $this->main_model->disp_allocated_task();
		$merge = array_merge($data1,$a);
		$this->load->view('technical_team/index',$merge);
	}
	public function events()
	{
		$this->load->view('technical_team/calendar');
	}
	public function alltasks_viewpage()
	{
		$this->load->view('technical_team/view_alltasks');
	}
	public function minutes($time)
	{
	    $timesplit=explode(':',$time);
	    $min=($timesplit[0]*60)+($timesplit[1])+($timesplit[2]>30?1:0);
	   	return $min;
	}
	public function updateStatus()  // updating task status through Ajax
	{
		$returndata = array();
		$id = $this->input->post('ad_id');
		$status = $this->input->post('status');
		$workday = $this->input->post('workday');
		$starttime = $this->minutes($this->input->post('starttime'));
		$endtime = $this->minutes($this->input->post('endtime'));
		$spenttime = $this->minutes($this->input->post('spenttime'));
		$workdetailsdata = array(
							'allocationDetailID' => $id,
							'workDate' => $this->input->post('workday'),
							'startTime' => $starttime,
							'endTime' => $endtime,
							'spentTime' => $spenttime,
							'status' => $status
						);
		$data['result'] = $this->main_model->updateWStatus($id,$status,$workdetailsdata,$workday);
		if(!empty($data))
		{	
			foreach ($data['result']->result() as $key) 
			{
				$answer = array(
					'status' => $key->status,
					'endTime' => $key->endTime 
				);
				array_push($returndata,$answer);
			}
		}			
		else
		{
			$msg = "No Record Found";
			array_push($returndata,$msg);
		}
		echo json_encode($returndata);die;
	}
}

?>