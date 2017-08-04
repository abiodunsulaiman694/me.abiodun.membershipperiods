<?php

class CRM_Membershipperiods_Page_MembershipPage extends CRM_Core_Page {

  public function run() {
    // Page title
    CRM_Utils_System::setTitle(ts('Membership Periods'));
	$sno=0;
	
	if(isset($_GET['cid'])){
		/**
		* Gets all the membership period records for the given "cid" and generates an HTML table
		*
		*/
		$cid = $_GET['cid'];
		$check = "SELECT p.start_date, p.end_date, p.renewed_date, p.contribution_id 
				  FROM civicrm_membership_period p
				  INNER JOIN civicrm_membership m ON m.id = p.membership_id
			      WHERE m.contact_id = $cid
			     ";
				 
		$results = CRM_Core_DAO::executeQuery($check);
		$myContent = "<div id=\"memberships\">
						<table id=\"active_membership\" class=\"display\">
							<thead>
								<tr>
									<th>S.No</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Renewed on</th>
									<th>View Contribution</th>
								</tr>
							</thead>
					  ";
					  
		while ($results->fetch()) {
			$myContent .= "<tr id=\"crm-membership_31\" class=\"odd-row  crm-membership\">
								<td>".++$sno."</td>
								<td>".date('M j Y', strtotime($results->start_date))."</td>
								<td>".date('M j Y', strtotime($results->end_date))."</td>
								<td>".date('M j Y g:i A', strtotime($results->renewed_date))."</td>
						  ";
						  
			if($results->contribution_id != 0){
				$myContent .="	<td class=\"crm-membership-source\"><a href=\"index.php?q=civicrm/contact/view/contribution&reset=1&id=$results->contribution_id&cid=$cid&action=view&context=contribution&selectedChild=contribute\">View</a></td>";
			}
				else
				$myContent .="<td class=\"crm-membership-source\">Not Paid</td>	";
			$myContent .="</tr>";
		}
		$myContent .= "</table></div>";

	}
	else {
		$myContent = "Sorry, No results found";
	}
		$this->assign('customContent', $myContent);				 
		parent::run();	
  }
}
