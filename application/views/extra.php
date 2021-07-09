Task No    - tbl_project_task   
Task Title - tbl_project_task 


project Name  - tbl_project              



priority - tbl_allocationDetail
spent Time - tbl_allocationDetail
status - tbl_allocationDetail



Allocated By - tbl_allocation
Reporting To - tbl_allocation
Start Date - tbl_allocation
End Date - tbl_allocation
Allocated Date - tbl_allocation
Estimated Time - tbl_allocation



select pt.pt_id,pt.title,p.project_title,a.startDate,a.endDate,a.allocatedDate,a.allocatedById,a.allocatedToId,ad.spentTime,ad.status,ad.priority FROM tbl_project_task AS pt,tbl_project AS p,tbl_allocationDetail AS ad,tbl_allocation AS a WHERE pt.projectID = p.project_id AND a.projectTaskId = pt.pt_id AND a.al_id = ad.allocation_id AND a.allocatedToId = 5





select pt.pt_id,pt.title,p.project_id,p.project_title,a.al_id,a.startDate,a.endDate,a.allocatedDate,a.allocatedById,a.allocatedToId,ad.ad_id,ad.spentTime,ad.status,ad.priority FROM tbl_project_task AS pt,tbl_project AS p,tbl_allocationDetail AS ad,tbl_allocation AS a WHERE pt.projectID = p.project_id AND a.projectTaskId = pt.pt_id AND a.al_id = ad.allocation_id AND a.allocatedToId = 5


select pt.pt_id,pt.title,p.project_title,a.startDate,a.endDate,a.allocatedDate,a.allocatedById,a.allocatedToId,ad.spentTime,ad.status,ad.priority FROM tbl_project_task AS pt,tbl_project AS p,tbl_allocationDetail AS ad,tbl_allocation AS a WHERE pt.projectID = p.project_id AND a.projectTaskId = pt.pt_id AND a.al_id = ad.allocation_id AND a.allocatedToId = 5 AND ad.allocateddate = "2019-03-01"





final result




select pt.pt_id,pt.title,p.project_title,a.startDate,a.endDate,a.allocated_time,a.allocatedById,a.allocatedToId,ad.spentTime,ad.status,ad.priority,ad.allocated_date FROM tbl_project_task AS pt,tbl_project AS p,tbl_allocationDetail AS ad,tbl_allocation AS a WHERE pt.projectID = p.project_id AND a.projectTaskId = pt.pt_id AND a.al_id = ad.allocation_id AND a.allocatedToId = 5





select pt.task_code,pt.title,p.project_title,p.project_code,a.startDate,a.endDate,a.allocated_time,a.allocatedById,a.allocatedToId,ad.spentTime,ad.status,ad.priority,ad.allocated_date FROM tbl_project_task AS pt,tbl_project AS p,tbl_allocationDetail AS ad,tbl_allocation AS a WHERE pt.projectID = p.project_id AND a.projectTaskId = pt.pt_id AND a.al_id = ad.allocation_id AND a.allocatedToId = 5






select c.clientCode,pt.task_code,pt.title,p.project_title,p.project_code,a.startDate,a.endDate,a.allocated_time,a.allocatedById,a.allocatedToId,ad.spentTime,ad.status,ad.priority,ad.allocated_date FROM tbl_project_task AS pt,tbl_project AS p,tbl_allocationDetail AS ad,tbl_allocation AS a,tbl_client AS c WHERE pt.projectID = p.project_id AND a.projectTaskId = pt.pt_id AND a.al_id = ad.allocation_id AND a.allocatedToId = 5 AND c.co_id = p.client_id


select c.clientCode,pt.task_code,pt.title,p.project_title,p.project_code,a.startDate,a.endDate,a.allocated_time,a.allocatedById,a.allocatedToId,ad.spentTime,ad.status,ad.priority,ad.allocated_date FROM tbl_project_task AS pt,tbl_project AS p,tbl_allocationDetail AS ad,tbl_allocation AS a,tbl_client AS c WHERE pt.projectID = p.project_id AND a.projectTaskId = pt.pt_id AND a.al_id = ad.allocation_id AND a.allocatedToId = 5 AND c.co_id = p.client_id














-------------------today----------------------




select c.clientCode,pt.task_code,pt.title,p.project_title,p.project_code,a.startDate,a.endDate,a.allocated_time,a.allocatedById,a.allocatedToId,ad.spentTime,ad.status,
ad.priority,ad.allocated_date,ad.ad_id FROM tbl_project_task AS pt,tbl_project AS p,tbl_allocationDetail AS ad,tbl_allocation AS a,tbl_client AS c WHERE pt.projectID = p.project_id AND a.projectTaskId = pt.pt_id AND a.al_id = ad.allocation_id AND a.allocatedToId = 5 AND c.co_id = p.client_id AND ad.allocated_date = date('Y-m-d')





select c.clientCode,pt.task_code,pt.title,p.project_title,p.project_code,a.startDate,a.endDate,a.allocated_time,a.allocatedById,a.allocatedToId,ad.spentTime,ad.status,ad.priority,ad.allocated_date,ad.ad_id FROM tbl_project_task AS pt,tbl_project AS p,tbl_allocationDetail AS ad,tbl_allocation AS a,tbl_client AS c WHERE pt.projectID = p.project_id AND a.projectTaskId = pt.pt_id AND a.al_id = ad.allocation_id AND a.allocatedToId = 5 AND c.co_id = p.client_id AND ad.allocated_date <='2019-03-05' AND ad.status != 2 ORDER BY ad.allocated_date DESC







minutes to hours 




function foo($seconds) {
  $t = round($seconds);
  return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
}

echo foo('290.52262423327'), "\n";
echo foo('9290.52262423327'), "\n";
echo foo(86400+120+6), "\n";