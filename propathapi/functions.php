<?php

function get_user_roleid($u_id){
	global $con;
	$qu="SELECT USER.user_role, ROLE.role_name from `athlete_users` as USER left Join  `athlete_user_role` as ROLE  on USER.user_role=ROLE.role_id WHERE `user_id`='$u_id'";
	$res2 = mysqli_query($con,$qu );
	if($row4 = mysqli_fetch_assoc($res2)) 
	{
		return $row4['user_role']  ;  
	}

}

function get_user_name($u_id){
	global $con;
	$qu="SELECT U.user_name from `athlete_users` as  U WHERE U.`user_id`='$u_id'";
	$res2 = mysqli_query($con,$qu );
	if($row4 = mysqli_fetch_assoc($res2)) 
	{
		return $row4['user_name']  ;  
	}

}

function get_mobile_token($u_id){
	global $con;
	$qu="SELECT USER.mobile_token from `athlete_users` as  USER WHERE `user_id`='$u_id'";
	$res2 = mysqli_query($con,$qu );
	if($row4 = mysqli_fetch_assoc($res2)) 
	{
		return $row4['mobile_token']  ;  
	}

}
function get_school_review_count($teacher_id,$athlete_id){
	global $con;
	$qu="SELECT count(*)  AS `total` from `athlete_school_review`  WHERE teacher_id='$teacher_id' and user_id='$athlete_id' ";
	$res2 = mysqli_query($con,$qu );
	if($row4 = mysqli_fetch_assoc($res2)) 
	{
		return $row4['total']  ;  
	}else{
		return 0;
	}
}

function get_coach_feedback_count($coach_id,$athlete_id){

	global $con;
	$qu="SELECT count(*)  AS `total` from `athlete_coach_feedback`  WHERE `coach_id`='$coach_id' and athlete_id='$athlete_id' ";
	$res2 = mysqli_query($con,$qu);
	if($row4 = mysqli_fetch_assoc($res2)) 
	{
		return $row4['total']  ;  
	}else{
		return 0;
	}

}


function get_category_name($cat_id){
	global $con;
	$qu="SELECT C.category from `athlete_notes_category` as  C WHERE C.`id`='$cat_id'";
	$res2 = mysqli_query($con,$qu );
	if($row4 = mysqli_fetch_assoc($res2)) 
	{
		return $row4['category']  ;  
	}

}
###############################by Rakesh on 28/12/2018 ################################
function contact_to_be_added($req,$con){
	$user_id = $_REQUEST['user_id'];
	$group_id = $_REQUEST['group_id'];
	$request_for='Friend_request';
	if($user_id!='' && $group_id!=''){

//Method 1 start here
/*    	$res1 = mysqli_query($con, "SELECT * from `athlete_report_request` WHERE `request_from`='$user_id'  && `request_for` = '$request_for' && status='2'");
if (mysqli_num_rows($res1) > 0) {
while($row1=mysqli_fetch_assoc($res1))
{
if(!in_array($row1['request_to'],$contactsto)){
$contactsto[]=$row1['request_to'];
}
}
}
$res2 = mysqli_query($con, "SELECT * from `athlete_report_request` WHERE  `request_to`='$user_id'  && `request_for` = '$request_for' && status='2'");
if (mysqli_num_rows($res2) > 0) {
while($row2=mysqli_fetch_assoc($res2))
{
if(!in_array($row2['request_from'],$contactsfrom)){
$contactsfrom[]=$row2['request_from'];
}
}
}
$contacts=array_merge($contactsto, $contactsfrom);
*/
//Method 1 ends here
//Method 2 Starts here
$res1 = mysqli_query($con, "SELECT * from `athlete_report_request` WHERE (`request_to`='$user_id'||`request_from`='$user_id') && `request_for` = '$request_for' && status='2'");
if (mysqli_num_rows($res1) > 0) {
	while($row1=mysqli_fetch_assoc($res1))
	{
		if(!in_array($row1['request_to'],$contacts)&&($row1['request_to']!=$user_id)){
			$contacts[]=$row1['request_to'];
		}
		if(!in_array($row1['request_from'],$contacts)&&($row1['request_from']!=$user_id)){
			$contacts[]=$row1['request_from'];
		}
	}
}
//Method 2 ends here

$resgroup = mysqli_query($con,"SELECT group_member from `athlete_chat_group_member` WHERE `group_id` = '$group_id' and admin_id='$user_id'");
while($row1=mysqli_fetch_assoc($resgroup))
{
	$groupcontacts[]=$row1['group_member'];
}

$result=array_diff($contacts,$groupcontacts);
//print_r($result);
foreach($result as $uid ){
	$res22 = mysqli_query($con, "SELECT * from `athlete_users` WHERE `user_id`='$uid'");

	if (mysqli_num_rows($res22) > 0) {
		if ($row4 = mysqli_fetch_assoc($res22)) {
			$alldata[] = $row4;
			/* $mentor = $row4;*/
		}
	}		   	
}
}
if ($alldata) {
	$empt1 = array("res" => '1', "message" => $alldata);
	echo json_encode($empt1);
} else {
	$empt1 = array("res" => '0', "message" => 'Not Found');
	echo json_encode($empt1);
}


}
###############################by Rakesh on 28/12/2018 ################################
function check_friend_status($req, $con){
	$user_id = $_REQUEST['my_user_id'];
	$other_id = $_REQUEST['other_user_id'];
	$request_for='Friend_request';
	if($user_id!='' && $other_id!=''){
		//$query1="SELECT * from `athlete_report_request` WHERE (`request_from`='$user_id' && `request_to`='$other_id' || `request_to`='$user_id' && `request_from`='$other_id' ) && `request_for` = '$request_for' ";
		$res1 = mysqli_query($con, "SELECT * from `athlete_report_request` WHERE (`request_from`='$user_id' && `request_to`='$other_id' || `request_to`='$user_id' && `request_from`='$other_id' ) && `request_for` = '$request_for' order by id desc limit 0,1 ");
		$num_row=mysqli_num_rows($res1);
		if( $num_row>0 ) 
		{
			$rowarr = mysqli_fetch_assoc($res1);
			if($rowarr['status']==1){
				$empt1 = array("res" => '1', "result" => 'Request Pending');
			}
			elseif($rowarr['status']==2){
				$empt1 = array("res" => '2', "result" => 'Friend');
			}else{
				$empt1 = array("res" => '0', "result" => 'No Friend');
			}			
			//echo json_encode($rowarr);
			echo json_encode($empt1);
		} 
		else 
		{
			$empt1 = array("res" => '0', "result" => 'Not a friend');
			echo json_encode($empt1);
		}
	}
	else
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}



########################################################################################

function   remove_group_memeber($req, $con){
	$group_id = $_REQUEST['group_id'];    
	$member_id = $_REQUEST['member_id'];    
	if($group_id != '' && $member_id != '')
	{
		$sql_group = mysqli_query($con,"SELECT * from `athlete_chat_group` where `id`  = '$group_id'");
		if($row4 = mysqli_fetch_assoc($sql_group)) 
		{
			$admin_id= $row4['admin_id'] ;  
		}

		if($member_id==$admin_id){
			$sql_query1 = mysqli_query($con,"delete from `athlete_chat_group_member` where  `group_id` = '$group_id' and `admin_id`='$member_id'");
			$sql_query2 = mysqli_query($con,"delete from `athlete_chat_group` where  `id` = '$group_id' and `admin_id`='$member_id'" );
			if($sql_query2||$sql_query1)
			{
				$empt = array("res" => '1', "result" => 'Memeber and Group Removed Successfully');
				echo json_encode($empt);
			}
			else
			{
				$empt = array("res" => '0', "result" => 'Something mistake');
				echo json_encode($empt);
			}
		}else{	

			$sql_query = mysqli_query($con,"SELECT * from `athlete_chat_group_member` where `group_member` = '$member_id' && `group_id` = '$group_id'");
			if (mysqli_num_rows($sql_query) > 0) {

				$sql_query = mysqli_query($con,"delete from `athlete_chat_group_member` where `group_member` = '$member_id' && `group_id` = '$group_id'");
				if($sql_query)
				{
					$empt = array("res" => '1', "result" => 'Memeber Removed Successfully');
					echo json_encode($empt);
				}
				else
				{
					$empt = array("res" => '0', "result" => 'Something mistake');
					echo json_encode($empt);
				}
			}else{
				$empt = array("res" => '0', "result" => 'Group Member not found');
				echo json_encode($empt);
			}
		}
	}
	else
	{
		$empt = array("res" => '0', "result" => 'Please enter all required fields');
		echo json_encode($empt);
	}
}
function  add_group_memeber($req, $con){
	$group_id = $_REQUEST['group_id'];
	$group_member = $_REQUEST['group_member'];
	$admin_id = $_REQUEST['admin_id'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;

	if($admin_id != '' && $group_id != '' && $group_member != '')
	{   
		foreach($group_member as   $value)
		{
			$value=ltrim($value,'[');
			$value=rtrim($value,']');
			$member_ids=explode(",",$value);
			foreach($member_ids as $member_id){
				$member_role  = "member";
				$ss= "INSERT into `athlete_chat_group_member`(`group_id`,`group_member`,`member_role`,`admin_id`,`date_time`) values('".$group_id."','".$member_id."','".$member_role."','".$admin_id."','".$date_time."')";
				$in_group_data1 = mysqli_query($con,$ss);
			}
		}	
		if($in_group_data1)
		{
			$empt = array("res" => '1', "result" => 'Member Add Successfully');
			echo json_encode($empt);
		}
		else
		{
			$empt = array("res" => '0', "result" => 'Something mistake');
			echo json_encode($empt);
		}
	}
	else
	{
		$empt = array("res" => '0', "result" => 'Please enter all required fields');
		echo json_encode($empt);
	}
}
###########################################By Rakesh Chat list#######################################################
function chat_list($req, $con){
	$user_id = $_REQUEST['user_id'];
	$chat_listtype=$_REQUEST['chat_listtype'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;

	if($user_id != ''){
/////Many to many data start here//////
		$ssq="SELECT acgm.group_id as chat_group_id, acgm.group_member, acg.id as group_id , acg.group_name, acg.group_icon FROM `athlete_chat_group_member` as acgm left join athlete_chat_group as acg  on acgm.group_id=acg.id where acgm.group_member=$user_id and acg.group_type='$chat_listtype' ";
//exit;
		$ressq = mysqli_query($con, $ssq);
		$nummem=mysqli_num_rows($ressq);
		if($nummem>0){
			while($rowssq = mysqli_fetch_assoc($ressq))
			{
				$chats_type = "MtoM";
				$id_name = mysqli_query($con, "SELECT * from `athlete_chat_group` where `id` = '$rowssq[group_id]'");
				$chatlist['front_id'] = $to_id;
				if($in_row = mysqli_fetch_assoc($id_name))
				{
					$chatlist['name'] = $in_row['group_name'];
					$chatlist['profile_image'] = $in_row['group_icon'];
					$chatlist['admin_id'] = $in_row['admin_id'];
				}
				$pp="SELECT * from `athlete_chatlist` where `to_id` = '$rowssq[group_id]' and chat_type='".$chats_type."'";
				$id_names = mysqli_query($con, $pp);
				$chatlist['front_id'] = $rowssq[group_id];
				if($in_rows = mysqli_fetch_assoc($id_names))
				{
					$from_ids=$in_rows['from_id'];
					$to_ids=$in_rows['to_id'];
					$datet=$in_rows['date_time'];
				}
				$rrr="SELECT * from `athlete_users` where `user_id` = '$from_ids'";
				$id_name = mysqli_query($con, $rrr);
				if($in_row = mysqli_fetch_assoc($id_name))
				{
					$sender_name = $in_row['user_name'];   
				}
				$rrrr="SELECT count(*)  AS `total` from `dummy_group_msg` where `member_id` = '$user_id' && `group_id` = '$to_ids' &&  `status` = 0";
				$count_msg = mysqli_query($con,$rrrr);
				if($msg_row = mysqli_fetch_assoc($count_msg))
				{
					$chatlist['count_msg'] = $msg_row['total'];
				}
				$rrrrr="SELECT * from `user_chat_msg` where `from_id` = '$from_ids' && `to_id` = '$to_ids' && `date_time` = '$datet' && `chat_type`= '$chats_type'";
				$msg_des = mysqli_query($con,$rrrrr);
				if($msg_details = mysqli_fetch_assoc($msg_des))
				{
					$chatlist['msg_type'] = $msg_details['msg_type'];
					$chatlist['chat_type'] = $msg_details['chat_type'];
					$chatlist['description'] = $sender_name." : ".$msg_details['description'];
					$chatlist['date_time'] = $msg_details['date_time'];
					$chatlist['cur_date'] = $msg_details['cur_date'];
					$chatlist['cur_time'] = $msg_details['cur_time'];
				}

				$chatlist1[] = $chatlist;
			}
		}
/////Many to many data ends here//////
///////One to one message start//////
		if($chat_listtype=='group_chat'){
			$res = mysqli_query($con, "SELECT * from `athlete_chatlist` WHERE (`from_id`='$user_id' || `to_id`='$user_id') and chat_type='OtoO' order by `date_time` desc");
			while($row = mysqli_fetch_assoc($res))
			{
				$chat_type = $row['chat_type'];
				$to_id = $row['to_id'];
				$from_id = $row['from_id'];
				$chats_type = "OtoO";
				if($from_id != $user_id)
				{
					$date_time = $row['date_time'];
					$chatlist['from_id'] = $row['from_id'];
					$chatlist['to_id'] = $row['to_id'];
					$id_name = mysqli_query($con, "SELECT * from `athlete_users` where `user_id` = '$from_id'");
					$chatlist['front_id'] = $from_id;
					if($in_row = mysqli_fetch_assoc($id_name))
					{
						$chatlist['name'] = $in_row['user_name'];
						$chatlist['profile_image'] = PROFILE_IMAGE.$in_row['profile_image'];
						$chatlist['admin_id'] = "";
					}
					$count_msg = mysqli_query($con,"SELECT count(*)  AS `total` from `user_chat_msg` where `from_id` = '$from_id' && `to_id` = '$to_id' && `chat_type`= '$chats_type'  && `status` = '0' ");
					if($msg_row = mysqli_fetch_assoc($count_msg)){
						$chatlist['count_msg'] = $msg_row['total'];
					}
					$msg_des = mysqli_query($con,"SELECT * from `user_chat_msg` where `from_id` = '$from_id' && `to_id` = '$to_id' && `date_time` = '$date_time' && `chat_type`= '$chats_type'");
					if($msg_details = mysqli_fetch_assoc($msg_des))
					{
						$chatlist['msg_type'] = $msg_details['msg_type'];
						$chatlist['chat_type'] = $msg_details['chat_type'];
						$chatlist['description'] = $msg_details['description'];
						$chatlist['date_time'] = $msg_details['date_time'];
						$chatlist['cur_date'] = $msg_details['cur_date'];
						$chatlist['cur_time'] = $msg_details['cur_time'];
					}
				}
				else if($from_id == $user_id)
				{
					$date_time = $row['date_time'];
					$chatlist['from_id'] = $row['from_id'];
					$chatlist['to_id'] = $row['to_id'];
					$chatlist['front_id'] = $to_id;
					$id_name = mysqli_query($con, "SELECT * from `athlete_users` where `user_id` = '$to_id'");
					if($in_row = mysqli_fetch_assoc($id_name))
					{
						$chatlist['name'] = $in_row['user_name'];
						$chatlist['profile_image'] = PROFILE_IMAGE.$in_row['profile_image'];
						$chatlist['admin_id'] = "";
					}
					$chatlist['count_msg'] = "0";
					$msg_des = mysqli_query($con,"SELECT * from `user_chat_msg` where `from_id` = '$from_id' && `to_id` = '$to_id' && `date_time` = '$date_time' && `chat_type`= '$chats_type'");
					if($msg_details = mysqli_fetch_assoc($msg_des))
					{
						$chatlist['msg_type'] = $msg_details['msg_type'];
						$chatlist['chat_type'] = $msg_details['chat_type'];
						$chatlist['description'] = $msg_details['description'];
						$chatlist['date_time'] = $msg_details['date_time'];
						$chatlist['cur_date'] = $msg_details['cur_date'];
						$chatlist['cur_time'] = $msg_details['cur_time'];
					}
				}
				$chatlist1[] = $chatlist;
				unset($chatlist);
			}
		}
////For one to one message data end//
		if ($chatlist1)
		{
			$empt1 = array("res" => '1', "result"=>$chatlist1);
			echo json_encode($empt1);
		}
		else 
		{
			$empt1 = array("res" => '0', "result" => 'Data Not Found');
			echo json_encode($empt1);
		}
	}
	else
	{
		$data['res'] = "0";
		$data['result'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}
################## /*Edit by Rakesh*/ #########################################       
function add_school_review($req, $con){
	$user_id = $_REQUEST['user_id'];
	$subject = $_REQUEST['subject'];
	$comments = $_REQUEST['comments'];
	$teacher_id = $_REQUEST['teacher_id'];

	$strengths = $_REQUEST['strengths']; 
	$improvements_needed = $_REQUEST['improvements_needed']; 
	$suggestions = $_REQUEST['suggestions'];
	$assistance_requested = $_REQUEST['assistance_requested'];
	$qualification = $_REQUEST['qualification'];

	$cur_year=date("Y");
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;
	$rescount=mysqli_query($con,"SELECT * from `athlete_school_review`  where user_id='$user_id' and teacher_id='$teacher_id' and EXTRACT(year FROM date_time) ='$cur_year' ");
	$rocount=mysqli_num_rows($rescount);
if($rocount<8){    // Check for max school review from a particular teacher of a user
	foreach($subject as  $key => $value){ 	
		$subN = $key;
		$gradeN = $value;
	}
	$subo=explode(',', $subN);
	$gradeo=explode(',', $gradeN);
	$subject=array_combine($subo, $gradeo);

	$uArr=mysqli_query($con,"UPDATE `athlete_users` set `school_reviewd`=1 where `user_id`='$user_id'");
	if($user_id != '' && $teacher_id != '' && $comments != '' && $subject != '')
	{
		$res=mysqli_query($con,"INSERT INTO `athlete_school_review` (`user_id`, `comments`,`teacher_id`,`date_time`, `strengths`, `improvements_needed`, `suggestions`, `assistance_requested`, `qualification`) 
			VALUES('$user_id','$comments','$teacher_id','$date_time', '$strengths', '$improvements_needed', '$suggestions', '$assistance_requested', '$qualification')");
		$event_id=mysqli_insert_id($con);	

		foreach($subject as  $key => $value)
		{
			$sub = $key;
			$grade = $value;
//Changed for multiple entries into other details table
			$res=mysqli_query($con,"INSERT INTO `athlete_school_review_details` (`review_id`, `subject`,`grade`) 
				VALUES('$event_id','$sub','$grade')");
			if($res)
			{
				$data['success'] = "1";
				$data['message'] = "Review Added Successfully";
			}
			else
			{
				$data['success'] = "0";
				$data['message'] = "Something Mistake";
			} 
		}
	}
	else 
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
	}
}
else{
	$data['review_count']=$rocount;
	$data['success'] = "0";
	$data['message'] = "Already shared maximum review for this user";
}
echo json_encode($data);
}
###############################New And Changed by Rakesh Chandel########################################################        
//List of Reviews For Athelete and other roles except the teacher       
function get_school_review($req, $con){
	$user_id = $_REQUEST['user_id'];
	$role=get_user_roleid($user_id);
	if($user_id != '')
	{   

		if($role=='10'){    		
			$res = mysqli_query($con,"SELECT * FROM `athlete_school_review`  WHERE teacher_id='$user_id' ORDER BY `athlete_school_review`.`date_time` DESC ") ;
		}elseif($role=='13'){
			$res = mysqli_query($con,"SELECT * FROM `athlete_school_review`  WHERE user_id='$user_id' ORDER BY `date_time` DESC") ;
		}
		$i=0;
		while($row = mysqli_fetch_array($res)) 
		{
//$review_sys;
//$sub = $row['subject'];
			$alldata[$i]['id'] = $row['id'];
//$alldata[$i]['profile_image'] = $row['profile_image'];
//$alldata[$i]['user_name'] = $row['user_id'];
//$alldata[$i]['comment'] = $row['comments'];
			$tach_id = $row['teacher_id'];
			$alldata[$i]['teacher_id'] = $tach_id;
			$teacher_name=get_user_name($tach_id);
			$alldata[$i]['teacher_name'] = $teacher_name;
			$alldata[$i]['athlete_id'] = $row['user_id'];
			$athlete_name=get_user_name($row['user_id']);
			$alldata[$i]['athlete_name'] = $athlete_name;
			$alldata[$i]['date'] = $row['date_time'];
/*        		$res1 = mysqli_query($con,"SELECT  * from `athlete_school_review_details`  WHERE review_id=".$row['id']."  ") ;
$j=0;
while ($row1 = mysqli_fetch_array($res1))
{
$review_sys[$j]['subject'] = $row1['subject'];
$review_sys[$j]['grade'] = $row1['grade'];
$j++;
}

$alldata[$i]['review'] = $review_sys;
unset($review_sys);
*/
$i++;
}
if ($alldata) 
{
	$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
	echo json_encode($empt1);
} 
else
{
	$empt1 = array("res" => '0', "message" => 'Data Not Found');
	echo json_encode($empt1);
}
}
else
{
	$data['success'] = "0";
	$data['message'] = "Please enter all required fields.";
	echo json_encode($data);
}
}
#####################################################################
function get_school_reviewed($req, $con){
	$user_id = $_REQUEST['user_id'];
	$role=get_user_roleid($user_id);
	if($user_id != '')
	{     		
		if($role=='10'){    		
			$sql1 = mysqli_query($con,"SELECT A.*, B.* FROM `athlete_school_review` as A left join `athlete_users` as B on A.user_id= B.user_id WHERE A.teacher_id='$user_id' group by B.user_id ORDER BY A.user_id , A.`date_time` DESC") ;
			while ($row = mysqli_fetch_assoc($sql1)) {
				$row['show_report_status'] = 2;
				$alldata[] = $row;
			}

			if ($alldata) {
				$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
				echo json_encode($empt1);
			} else {
				$empt1 = array("res" => '0', "message" => 'Data Not Found');
				echo json_encode($empt1);
			}
		}elseif($role=='13'){
			$sql2 = mysqli_query($con,"SELECT A.*, B.* FROM `athlete_school_review` as A left join `athlete_users` as B on A.teacher_id= B.user_id WHERE A.user_id='$user_id' ORDER BY A.teacher_id , A.`date_time` DESC") ;
			while ($row = mysqli_fetch_assoc($sql2)) {
				$row['show_report_status'] = 2;
				$alldata[] = $row;
			}
			if ($alldata) {
				$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
				echo json_encode($empt1);
			} else {
				$empt1 = array("res" => '0', "message" => 'Data Not Found');
				echo json_encode($empt1);
			}
		}
		else
		{
			$sql3 = mysqli_query($con,"SELECT * FROM `athlete_users` WHERE `school_reviewd` = 1 and `user_role`=13");
			while ($row = mysqli_fetch_assoc($sql3)) 
			{
				$athlete_id = $row['user_id'];
				$res2 = mysqli_query($con,"SELECT * from `athlete_report_request` WHERE request_from='$user_id' and request_to='$athlete_id' and status=2");
				$res3 = mysqli_query($con,"SELECT * from `athlete_report_request` WHERE request_from='$user_id' and request_to='$athlete_id' and status=1");

				if($row2 = mysqli_fetch_assoc($res2))
				{
					$row['show_report_status'] = 2;
				}
				else if($row3 = mysqli_fetch_assoc($res3))
				{
					$row['show_report_status'] = 1;
				}
				else
				{
					$row['show_report_status'] = 0;
				}
				$alldata[] = $row;
			}
			if ($alldata) {
				$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
				echo json_encode($empt1);
			} else {
				$empt1 = array("res" => '0', "message" => 'Data Not Found');
				echo json_encode($empt1);
			}  
		}
	}
	else
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}
################################################################################################ 
#####################################New And Get Specific School Review by Rakesh Chandel#############################        
//This is incomplete
function get_school_review_detail($req, $con){

	$user_id = $_REQUEST['user_id'];
	$review_id=$_REQUEST['review_id'];

	if($user_id != '')
	{   
		$res = mysqli_query($con,"SELECT a.*, b.profile_image , b.user_name FROM `athlete_school_review` a left JOIN `athlete_users` b on a.user_id = b.user_id WHERE a.user_id='$user_id' and a.id='$review_id' ") ;
		$i=0;
		while($row = mysqli_fetch_array($res)) 
		{ 
//$review_sys;
//$sub = $row['subject'];
			$alldata[$i]['id'] = $row['id'];
			$alldata[$i]['profile_image'] = $row['profile_image'];
			$alldata[$i]['user_name'] = $row['user_name'];
			$alldata[$i]['comment'] = $row['comments'];
			$tach_id = $row['teacher_id'];
			$teacher_name=get_user_name($tach_id);
			$alldata[$i]['teacher_name'] = $teacher_name;
			$alldata[$i]['date'] = $row['date_time'];

			$alldata[$i]['strengths'] = $row['strengths'];
			$alldata[$i]['improvements_needed'] = $row['improvements_needed'];
			$alldata[$i]['suggestions'] = $row['suggestions'];
			$alldata[$i]['assistance_requested'] = $row['assistance_requested'];
			$alldata[$i]['qualification'] = $row['qualification'];

//echo "SELECT  * from `athlete_school_review_details`  WHERE review_id=".$row['id'];
			$res1 = mysqli_query($con,"SELECT  * from `athlete_school_review_details`  WHERE review_id=".$row['id']."  ") ;
			$j=0;
			while ($row1 = mysqli_fetch_array($res1))
			{
				$review_sys[$j]['subject'] = $row1['subject'];
				$review_sys[$j]['subject_id'] = $row1['id'];
				$review_sys[$j]['grade'] = $row1['grade'];
				$j++;
			}

			$alldata[$i]['review'] = $review_sys;
			unset($review_sys);
			$i++;
		}
		if ($alldata) 
		{
			$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
			echo json_encode($empt1);
		} 
		else
		{
			$empt1 = array("res" => '0', "message" => 'Data Not Found');
			echo json_encode($empt1);
		}
	}
	else
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}
#################################################################################
function add_self_review($req, $con){
	$user_id = $_REQUEST['user_id'];
	$comments = $_REQUEST['comments'];
	$label = $_REQUEST['label'];
	$subject = $_REQUEST['subject'];
//$teacher_id = $_REQUEST['teacher_id'];

	$strengths = $_REQUEST['strengths']; 
	$improvements_needed = $_REQUEST['improvements_needed'];
	$suggestions = $_REQUEST['suggestions']; 
	$assistance_requested = $_REQUEST['assistance_requested'];


	$cur_year=date("Y");
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;
	foreach($subject as  $key => $value){ 	
		$subN = $key;
		$gradeN = $value;
	}
	$subo=explode(',', $subN);
	$gradeo=explode(',', $gradeN);
	$subject=array_combine($subo, $gradeo);
	$uArr=mysqli_query($con,"UPDATE `athlete_users` set `self_review`=1 where `user_id`='$user_id'");
	if($user_id != ''  && $comments != '' && $subject != '')
	{
		$res=mysqli_query($con,"INSERT INTO `athlete_self_review` (`user_id`, `comments`,`label`,`date_time`, `strengths`, `improvements_needed`, `suggestions`, `assistance_requested`) 
			VALUES('$user_id','$comments','$label','$date_time', '$strengths', '$improvements_needed', '$suggestions', '$assistance_requested')");
		$event_id=mysqli_insert_id($con);	
		foreach($subject as  $key => $value)
		{
			$sub = $key;
			$grade = $value;
//Changed for multiple entries into other details table
			$res=mysqli_query($con,"INSERT INTO `athlete_self_review_details` (`review_id`, `subject`,`grade`) 
				VALUES('$event_id','$sub','$grade')");
			if($res)
			{
				$data['success'] = "1";
				$data['message'] = "Self Review Added Successfully";
			}
			else
			{
				$data['success'] = "0";
				$data['message'] = "There is some error";
			} 
		}
	}
	else 
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
	}
	echo json_encode($data);
}
####################################################################################################
function get_self_review($req, $con){
	$user_id = $_REQUEST['user_id'];
	if($user_id != '')
	{   
		$res = mysqli_query($con,"SELECT * FROM `athlete_self_review`  WHERE user_id='$user_id' ORDER BY `date_time` DESC") ;
		$i=0;
		while($row = mysqli_fetch_array($res)) 
		{
			$alldata[$i]['id'] = $row['id'];
			$alldata[$i]['label'] = $row['label'];
			$alldata[$i]['date'] = $row['date_time'];

			$alldata[$i]['strengths'] = $row['strengths'];
			$alldata[$i]['improvements_needed'] = $row['improvements_needed'];
			$alldata[$i]['suggestions'] = $row['suggestions'];
			$alldata[$i]['assistance_requested'] = $row['assistance_requested'];
			
			$i++;
		}
		if ($alldata) 
		{
			$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
			echo json_encode($empt1);
		} 
		else
		{
			$empt1 = array("res" => '0', "message" => 'Data Not Found');
			echo json_encode($empt1);
		}
	}
	else
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}

#####################################New And Get Specific School Review by Rakesh Chandel#############################        

function get_self_review_detail($req, $con){

	$user_id = $_REQUEST['user_id'];
	$review_id=$_REQUEST['review_id'];

	if($user_id != '')
	{   
		$res = mysqli_query($con,"SELECT a.*, b.profile_image , b.user_name FROM `athlete_self_review` a left JOIN `athlete_users` b on a.user_id = b.user_id WHERE a.user_id='$user_id' and a.id='$review_id' ") ;
		$i=0;
		while($row = mysqli_fetch_array($res)) 
		{
//$review_sys;
//$sub = $row['subject'];
			$alldata[$i]['id'] = $row['id'];
			$alldata[$i]['profile_image'] = $row['profile_image'];
			$alldata[$i]['user_name'] = $row['user_name'];
			$alldata[$i]['comment'] = $row['comments'];
			$alldata[$i]['label'] = $row['label'];
			$alldata[$i]['date'] = $row['date_time'];

			$alldata[$i]['strengths'] = $row['strengths'];
			$alldata[$i]['improvements_needed'] = $row['improvements_needed'];
			$alldata[$i]['suggestions'] = $row['suggestions'];
			$alldata[$i]['assistance_requested'] = $row['assistance_requested'];
//echo "SELECT  * from `athlete_school_review_details`  WHERE review_id=".$row['id'];
			$res1 = mysqli_query($con,"SELECT  * from `athlete_self_review_details`  WHERE review_id=".$row['id']."  ") ;
			$j=0;
			while ($row1 = mysqli_fetch_array($res1))
			{
				$review_sys[$j]['subject'] = $row1['subject'];
				$review_sys[$j]['subject_id'] = $row1['id'];
				$review_sys[$j]['grade'] = $row1['grade'];
				$j++;
			}

			$alldata[$i]['review'] = $review_sys;
			unset($review_sys);
			$i++;
		}
		if ($alldata) 
		{
			$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
			echo json_encode($empt1);
		} 
		else
		{
			$empt1 = array("res" => '0', "message" => 'Data Not Found');
			echo json_encode($empt1);
		}
	}
	else
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}
##############################################################################
function   get_school_request_status($req, $con){
	$user_id = $_REQUEST['user_id'];
	$status = $_REQUEST['status'];
	$request_for = $_REQUEST['request_for'];
	$res = mysqli_query($con, "SELECT * from `athlete_report_request` WHERE (`request_from`='$user_id' && `status`='$status' && `request_for` = '$request_for' || `request_to`='$user_id' && `status`='$status' && `request_for` = '$request_for') ");
	while ($row = mysqli_fetch_assoc($res)) {
		if ($user_id != $row['request_to']) {
			$request_to = $row['request_to'];
		} else if ($user_id != $row['request_from']) {
			$request_to = $row['request_from'];
		}

		$res2 = mysqli_query($con, "SELECT * from `athlete_users` WHERE `user_id`='$request_to'");
		if ($row4 = mysqli_fetch_assoc($res2)) {
			$alldata[] = $row4;
			/* $mentor = $row4;*/
		}
		/*$empt = $row;     "data" => $empt,*/
		/* $alldata[] = array("user_details" => $mentor);*/
	}
	if ($alldata) {
		$empt1 = array("res" => '1', "message" => $alldata);
		echo json_encode($empt1);
	} else {
		$empt1 = array("res" => '0', "message" => 'Not Found');
		echo json_encode($empt1);
	}
}

###############################################################################################
function get_all_athlete($req, $con){

	$request_type=$_REQUEST[request_type];

	$txt = "Athlete";
	$res1 = mysqli_query($con,"SELECT * from `athlete_user_role` WHERE role_name='$txt'");
	while($row = mysqli_fetch_array($res1))
	{
		$role_id = $row['role_id'];
	}
	if($_REQUEST['user_id']!='' && $request_type=='school_review'){
		$teacher_id=$_REQUEST['user_id'];
		$sql_per = mysqli_query($con,"SELECT A.* from `athlete_users` as A where 
			A.user_role='$role_id' ");
		while ($row = mysqli_fetch_assoc($sql_per)) {
			$athlete_id=$row[user_id];

			$res2 = mysqli_query($con,"SELECT * from `athlete_report_request` WHERE request_from='$teacher_id' and request_to='$athlete_id' and request_for='Byteacher_athlete_review' and status=1");
			$res3 = mysqli_query($con,"SELECT * from `athlete_report_request` WHERE request_from='$teacher_id' and request_to='$athlete_id' and request_for='Byteacher_athlete_review' and status=2");
			$counter=get_school_review_count($teacher_id,$athlete_id);
			if($row2 = mysqli_fetch_assoc($res2)){
				$row['show_report_status'] = 1;
				$row['school_review_counter']=$counter;
				$row['teacher_id']=$teacher_id;
			}
			elseif($row3 = mysqli_fetch_assoc($res3)){
				$row['show_report_status'] = 2;
				$row['school_review_counter']=$counter;
				$row['teacher_id']=$teacher_id;
			}
			else{
				$row['show_report_status'] = 0;
				$row['school_review_counter']=$counter;
				$row['teacher_id']=$teacher_id;
			}
			$alldata[] = $row;
		}
	}elseif($_REQUEST['user_id']!='' && $request_type=='coach_feedback'){


		$coach_id=$_REQUEST['user_id'];
		$sql_per = mysqli_query($con,"SELECT A.* from `athlete_users` as A where 
			A.user_role='$role_id' ");
		while($row = mysqli_fetch_assoc($sql_per)){
			$athlete_id=$row[user_id];
			$count=get_coach_feedback_count($coach_id,$athlete_id);
			$row['coach_feedback_counter'] = $count;
			$row['coach_id'] = $coach_id;


			$alldata[] = $row;

		}




	}else{
		$sql_per = mysqli_query($con,"SELECT * from `athlete_users` where user_role='$athlete_id'");
		while ($row = mysqli_fetch_assoc($sql_per)) {

			$alldata[] = $row;

		}
	}


	if ($alldata) {
		$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
		echo json_encode($empt1);
	} else {
		$empt1 = array("res" => '0', "message" => 'Data Not Found');
		echo json_encode($empt1);
	}
}
########################## List of all the athletes who had self reviewd #################################
function get_selfreviewd_athlete($req, $con){

	$txt = "Athlete";
	$res1 = mysqli_query($con,"SELECT * from `athlete_user_role` WHERE role_name='$txt'");
	while($row = mysqli_fetch_array($res1))
	{
		$athlete_id = $row['role_id'];
	}
	if($_REQUEST['user_id']!=''){
		$user_id=$_REQUEST['user_id'];
		$sql_per = mysqli_query($con,"SELECT A.* from `athlete_users` as A where 
			A.user_role='$athlete_id' and A.self_review='1' ");
		while ($row = mysqli_fetch_assoc($sql_per)) {
			$athlete_id=$row[user_id];

			$res2 = mysqli_query($con,"SELECT * from `athlete_report_request` WHERE request_from='$user_id' and request_to='$athlete_id' and request_for='Access_self_review' and status=1");
			$res3 = mysqli_query($con,"SELECT * from `athlete_report_request` WHERE request_from='$user_id' and request_to='$athlete_id' and request_for='Access_self_review' and status=2");

			if($row2 = mysqli_fetch_assoc($res2)){
				$row['show_report_status'] = 1;
			}
			else if($row3 = mysqli_fetch_assoc($res3)){
				$row['show_report_status'] = 2;
			}
			else{
				$row['show_report_status'] = 0;
			}
			$alldata[] = $row;
		}
		if ($alldata) {
			$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
			echo json_encode($empt1);
		} else {
			$empt1 = array("res" => '0', "message" => 'Data Not Found');
			echo json_encode($empt1);
		}
	}else{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}

##############################To add a Coach feedback of an athlete by a coach role########################################
function  add_coach_feedback($req, $con){   
	$coach_id = $_REQUEST['coach_id'];
	$athlete_id = $_REQUEST['athlete_id'];
	$event = $_REQUEST['event'];
	$strenths = $_REQUEST['strenths'];
	$workons = $_REQUEST['workons'];
	$improvement_needed = $_REQUEST['improvement_needed'];
	$suggestions = $_REQUEST['suggestions'];
	$assistance_requested = $_REQUEST['assistance_requested'];
	$assistance_offered = $_REQUEST['assistance_offered'];
	$cur_year=date("Y");
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;
	if($coach_id != '' && $athlete_id != '' && $event != '' && $strenths != '' && $workons != '')
	{ 


//$count=get_coach_feedback_count($coach_id,$athlete_id);

//if($count==0){

		$sql = mysqli_query($con,"Select * from `athlete_users` where `user_id` = '$coach_id' and `user_role` = 1");
		if($row2 = mysqli_fetch_assoc($sql))
		{
			$uArr=mysqli_query($con,"UPDATE `athlete_users` set `coach_feedback`=1 where `user_id`='$athlete_id'");
			$sql1 = mysqli_query($con,"INSERT into `athlete_coach_feedback`(`coach_id`,`athlete_id`,`event`,`strenths`,`workons`,`improvement_needed`,`suggestions`,`assistance_requested`,`assistance_offered`,`date_time`)VALUES('$coach_id','$athlete_id','$event','$strenths','$workons', '$improvement_needed','$suggestions','$assistance_requested','$assistance_offered', '$date_time')");
			 
			if($sql1)
			{
				$data['success'] = "1";
				$data['message'] = "Data Successfully Added.";
				echo json_encode($data);
			}
		}
		else
		{
			$data['success'] = "0";
			$data['message'] = "You are not visible for Feedback.";
			echo json_encode($data);  
		}

/*}else{

$data['success'] = "0";
$data['message'] = "You have already submitted the Feedback for this athlete.";
echo json_encode($data);  
}
*/

}
else
{
	$data['success'] = "0";
	$data['message'] = "Please enter all required fields.";
	echo json_encode($data);
}

}
#######################################To Show Coach feedback of a particular athlete from a coach############################
function show_coach_feedback($req, $con){
	$feedback_id = $_REQUEST['id'];
	$athlete_id = $_REQUEST['user_id'];
	if($feedback_id != '' && $athlete_id !='')
	{
		$role_cond=" and `user_role` = 1 ";
		$sql_feed="SELECT a.*, b.profile_image , b.user_name FROM `athlete_coach_feedback` a left JOIN `athlete_users` b on a.athlete_id = b.user_id WHERE a.athlete_id='$athlete_id' and a.id='$feedback_id'";
		$res1 = mysqli_query($con,$sql_feed) ;
		if ($row = mysqli_fetch_assoc($res1)){

			$athlete_name=get_user_name($row['athlete_id']);
			$row['athlete_name'] = $athlete_name;
			$coach_name=get_user_name($row['coach_id']);
			$row['coach_name'] = $coach_name;
			$alldata = $row;
		}

		if ($alldata){
			$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
			echo json_encode($empt1);
		}
		else{
			$empt1 = array("res" => '0', "message" => 'Data Not Found');
			echo json_encode($empt1);
		}
	}
	else{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}
###########################################################################################################################################    

//New function

function get_coach_feedbacklist($req, $con){
	$user_id = $_REQUEST['user_id'];
	$role=get_user_roleid($user_id);
	if($user_id != '')
	{     		
		if($role=='1'){    		
			$sql1 = mysqli_query($con,"SELECT A.*, B.* FROM `athlete_coach_feedback` as A left join `athlete_users` as B on A.athlete_id= B.user_id WHERE A.coach_id='$user_id' group by B.user_id ORDER BY A.athlete_id , A.`date_time` DESC") ;
			while ($row = mysqli_fetch_assoc($sql1)) {
				$coach_id=$user_id;
				$athlete_id=$row['athlete_id'];

				$count=get_coach_feedback_count($coach_id,$athlete_id);

				$row['feedback_counter'] = $count;
				$row['show_report_status'] = 2;
				$alldata[] = $row;
			}

			if ($alldata) {
				$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
				echo json_encode($empt1);
			} else {
				$empt1 = array("res" => '0', "message" => 'Data Not Found');
				echo json_encode($empt1);
			}
		}elseif($role=='13'){

			$sql2 = mysqli_query($con,"SELECT A.*, B.* FROM `athlete_coach_feedback` as A left join `athlete_users` as B on A.coach_id= B.user_id WHERE A.athlete_id='$user_id' ORDER BY A.coach_id , A.`date_time` DESC") ;
			while ($row = mysqli_fetch_assoc($sql2)) {
				$row['show_report_status'] = 2;
				$alldata[] = $row;
			}
			if ($alldata) {
				$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
				echo json_encode($empt1);
			} else {
				$empt1 = array("res" => '0', "message" => 'Data Not Found');
				echo json_encode($empt1);
			}
		}
		else
		{
			$sql3 = mysqli_query($con,"SELECT * FROM `athlete_users` WHERE  `user_role`='13' and coach_feedback='1'  ");
			while ($row = mysqli_fetch_assoc($sql3)) 
			{
				$athlete_id = $row['user_id'];
				$d = "Coach_feedback";
				$res2 = mysqli_query($con,"SELECT * from `athlete_report_request` WHERE request_for='$d' and request_from='$user_id' and request_to='$athlete_id' and status=2");
				$res3 = mysqli_query($con,"SELECT * from `athlete_report_request` WHERE request_for='$d' and request_from='$user_id' and request_to='$athlete_id' and status=1");

				if($row2 = mysqli_fetch_assoc($res2))
				{
					$row['show_report_status'] = 2;
				}
				else if($row3 = mysqli_fetch_assoc($res3))
				{
					$row['show_report_status'] = 1;
				}
				else
				{
					$row['show_report_status'] = 0;
				}
				$alldata[] = $row;
			}
			if ($alldata) {
				$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
				echo json_encode($empt1);
			} else {
				$empt1 = array("res" => '0', "message" => 'Data Not Found');
				echo json_encode($empt1);
			}  
		}
	}
	else
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}
##################################################################################################################################
function particular_coach_feedback($req, $con){
	$request_from = $_REQUEST['request_from'];
	$request_to = $_REQUEST['request_to'];
	if($request_from != '' && $request_to !='')
	{
		$sql = mysqli_query($con,"Select * from `athlete_users` where `user_id` = '$request_from' and `user_role` = 1");
		$sql2 = mysqli_query($con,"Select * from `athlete_users` where `user_id` = '$request_from' and `user_role` = '13'");
		if($row2 = mysqli_fetch_assoc($sql))
		{
			$res1 = mysqli_query($con,"SELECT a.*, b.profile_image , b.user_name FROM `athlete_coach_feedback` a left JOIN `athlete_users` b on a.athlete_id = b.user_id WHERE a.athlete_id='$request_to'") ;
			if ($row = mysqli_fetch_assoc($res1)) 
			{
				$alldata[] = $row;
			}
		}
		else if($row2 = mysqli_fetch_assoc($sql2))
		{
			$sql_feed="SELECT a.*, b.profile_image , b.user_name FROM `athlete_coach_feedback` a left JOIN `athlete_users` b on a.coach_id = b.user_id WHERE a.coach_id='$request_to'";
			$res1 = mysqli_query($con,$sql_feed) ;
			if ($row = mysqli_fetch_assoc($res1)) 
			{
				$alldata[] = $row;
			}
		}

		if ($alldata)
		{
			$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
			echo json_encode($empt1);
		}
		else 
		{
			$empt1 = array("res" => '0', "message" => 'Data Not Found');
			echo json_encode($empt1);
		}
	}
	else
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}



function get_all_feedback_list($req, $con){
	$user_id=$_REQUEST['user_id'];
	$role_id=$_REQUEST['role_id'];

$res = mysqli_query($con,"SELECT * FROM `athlete_user_role` WHERE `role_id`='$role_id'");

while($row=mysqli_fetch_assoc($res))
{
	$role_type=$row['role_name'];
}

	//$sql2 = mysqli_query($con,"SELECT A.*, B.* FROM `athlete_coach_feedback` as A left join `athlete_users` as B on A.coach_id= B.user_id WHERE A.athlete_id='$user_id' ORDER BY A.coach_id , A.`date_time` DESC") ;
	
	if($role_type=="Coach"){
	$sql2 = mysqli_query($con,"SELECT A.*, B.* FROM `athlete_coach_feedback` as A left join `athlete_users` as B on A.coach_id= B.user_id WHERE A.athlete_id='$user_id' && A.coach_status='1' ORDER BY A.coach_id , A.`date_time` DESC") ;
	}else{
	$sql2 = mysqli_query($con,"SELECT A.*, B.* FROM `athlete_coach_feedback` as A left join `athlete_users` as B on A.coach_id= B.user_id WHERE A.athlete_id='$user_id' && A.athlete_status='1' ORDER BY A.coach_id , A.`date_time` DESC") ;
	}
	while ($row = mysqli_fetch_assoc($sql2)) {
		$row['show_report_status'] = 2;
		$alldata[] = $row;
	}
	if ($alldata) {
		$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
		echo json_encode($empt1);
	} else {
		$empt1 = array("res" => '0', "message" => 'Data Not Found');
		echo json_encode($empt1);
	}

}
############################################################################################################
function athlete_representative($req, $con){
	$user_id = $_REQUEST['user_id'];
	$team = $_REQUEST['team'];
	$media = $_REQUEST['media'];
	$location = $_REQUEST['location'];
	$from_month = $_REQUEST['from_month'];
	$from_year = $_REQUEST['from_year'];
	$to_month = $_REQUEST['to_month'];
	$to_year = $_REQUEST['to_year'];
	$role = $_REQUEST['role'];
	$link = $_REQUEST['link'];
/*$rep_achievement = $_REQUEST['rep_achievement'];
$athlete_highlight = $_REQUEST['athlete_highlight'];
$athlete_playlist = $_REQUEST['athlete_playlist'];*/
if ($user_id != '') {
	$res=mysqli_query($con,"INSERT INTO `athlete_representative`(`user_id`, `team`, `location`, `from_month`, `from_year`, `to_month`, `to_year`, `role`, `media`, `link`) VALUES ('$user_id','$team','$location','$from_month','$from_year','$to_month','$to_year','$role','$media','$link')");
	$insrtid = mysqli_insert_id($con);
	if($res){
		$getdata = mysqli_query($con,"SELECT * FROM `athlete_representative` WHERE `id`='$insrtid'");
		while($resultUser = mysqli_fetch_array($getdata)){ 	
//echo "<pre>";print_r($resultUser);exit;
			$cdata['ID'] = $resultUser['Id'];		  	              
			$cdata['UserID'] = $resultUser['user_id'];
			$cdata['team'] = $resultUser['team'];
			$cdata['location'] = $resultUser['location'];	
			$cdata['from_month'] = $resultUser['from_month'];	
			$cdata['from_year'] = $resultUser['from_year'];
			$cdata['to_month'] = $resultUser['to_month'];
			$cdata['to_year'] = $resultUser['to_year'];	   
			$cdata['role'] = $resultUser['role'];	
			$cdata['media'] = $resultUser['media'];
			$cdata['link'] = $resultUser['link'];
/*$cdata['athlete_playlist'] = $resultUser['athlete_playlist'];
$cdata['rep_achievement'] = $resultUser['rep_achievement'];
$cdata['athlete_highlight'] = $resultUser['athlete_highlight'];*/

$data_response = $cdata;
}
$data['success'] = "1";
$data['message'] = "Added sucessfully"; 
$data['data']= $data_response;						
}else{
	$data['success'] = "0";
	$data['message'] = "Please Try again";
}
} else {
	$data['success'] = "0";
	$data['message'] = "Please enter all required fields.";
}
echo json_encode($data); 
}
###############################################################################################################
function get_athlete_representative($req, $con){
	$user_id = $_REQUEST['user_id'];
	$res = mysqli_query($con,"SELECT * from `athlete_representative` WHERE `user_id` = '$user_id'");
	if (mysqli_num_rows($res) > 0) {
		while($row=mysqli_fetch_assoc($res))
		{
			$empt[]=$row;
		}
		$empt1=array("success"=>'1',"message"=>$empt);
		echo json_encode($empt1);
	}else{
		$empt1=array("success"=>'0',"message"=>'Not Found');
		echo json_encode($empt1);
	}
}
#############################################################################################################
function edit_athlete_representative($req, $con){
	$id=$_REQUEST['id'];
	$user_id = $_REQUEST['user_id'];
	$team = $_REQUEST['team'];
	$media = $_REQUEST['media'];
	$location = $_REQUEST['location'];
	$from_month = $_REQUEST['from_month'];
	$from_year = $_REQUEST['from_year'];
	$to_month = $_REQUEST['to_month'];
	$to_year = $_REQUEST['to_year'];
	$role = $_REQUEST['role'];
	$link = $_REQUEST['link'];
/*$rep_achievement = $_REQUEST['rep_achievement'];
$athlete_highlight = $_REQUEST['athlete_highlight'];
$athlete_playlist = $_REQUEST['athlete_playlist'];*/
if ($user_id != '') {
	$res=mysqli_query($con,"UPDATE `athlete_representative`set `user_id`='$user_id', `team`='$team', `location`='$location', `from_month`='$from_month', `from_year`='$from_year', `to_month`='$to_month', `to_year`='$to_year', `role`='$role', `media`='$media', `link`='$link' where id='$id' ");
//$userid = mysqli_insert_id($con);
	if($res){
		$getdata = mysqli_query($con,"SELECT * FROM `athlete_representative` WHERE `id`='$id'");
		while($resultUser = mysqli_fetch_array($getdata)){ 	
//echo "<pre>";print_r($resultUser);exit;
			$cdata['ID'] = $resultUser['Id'];		  	              
			$cdata['UserID'] = $resultUser['user_id'];
			$cdata['team'] = $resultUser['team'];
			$cdata['location'] = $resultUser['location'];	
			$cdata['from_month'] = $resultUser['from_month'];	
			$cdata['from_year'] = $resultUser['from_year'];
			$cdata['to_month'] = $resultUser['to_month'];
			$cdata['to_year'] = $resultUser['to_year'];	   
			$cdata['role'] = $resultUser['role'];	
			$cdata['media'] = $resultUser['media'];
			$cdata['link'] = $resultUser['link'];
/*$cdata['athlete_playlist'] = $resultUser['athlete_playlist'];
$cdata['rep_achievement'] = $resultUser['rep_achievement'];
$cdata['athlete_highlight'] = $resultUser['athlete_highlight'];*/

$data_response = $cdata;
}
$data['success'] = "1";
$data['message'] = "Record Updated sucessfully"; 
$data['data']= $data_response;						
}else{
	$data['success'] = "0";
	$data['message'] = "Please Try again";
}
} else {
	$data['success'] = "0";
	$data['message'] = "Please enter all required fields.";
}
echo json_encode($data); 
}
############################################################################################
function delete_athlete_representative($req, $con){
	$ach_id = $_REQUEST['id'];
	if($ach_id != ''){
		$sql2 = mysqli_query($con ,"DELETE FROM `athlete_representative` WHERE `id`='$ach_id'");
		if ($sql2){
			$data['success'] = "1";
			$data['message'] = "Achievement deleted successfully.";
			echo json_encode($data);
		}else{
			echo "Error deleting record: " . $conn->error;
		}
	}else{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}
##################################################################################################################################

#######################################################################

function add_survey($req,$con){  

	$title = $_REQUEST['title'];
	$created_by=$_REQUEST['user_id'];    
	$description = $_REQUEST['description'];    
	$question_no = $_REQUEST['question_no'];    
	$question_type = $_REQUEST['question_type']; 
	$question = $_REQUEST['question'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;

	if($title !='' && $description != '' && $question_no != '' && $question_type != '')  
	{ 

		$sql = mysqli_query($con,"INSERT into  `athlete_survey`(`title`,`description`,`question_no`,`user_id`,`question_type`,hit_count,`date_time`)values('$title','$description','$question_no','$created_by','$question_type','0','$date_time')");
		$eventid = mysqli_insert_id($con);

		foreach($question as  $key => $value)
		{
			/** 
			* Add image with each question, code added on 25 July 2019
			*/
			$file_url = "";

			if(!empty($_FILES['survey_image'])) 
			{ 
				$target="uploads/notes_media/";
				$type = $_FILES['survey_image']['type'][$key];
				$name = $_FILES['survey_image']['name'][$key];
				
				$name = str_replace(" ","",$name);
				$name = uniqid().basename($name);
				
				$new = $target.$name;
				$file_url = NOTES_MEDIA.$name;

				move_uploaded_file($_FILES['survey_image']['tmp_name'][$key],$new);
			}

			$questions = $value;
			$sql = mysqli_query($con,"INSERT into  `athlete_survey_details`(`survey_id`,`survey_question`, `survey_image`, `user_id`,`date_time`)values('$eventid','$questions', '$file_url', '$created_by', '$date_time')");
		}
		if($sql)
		{
			$empt = array("res" => '1', "result" => "Survey Added Successfully");
			echo json_encode($empt);
		}
		else
		{
			$empt = array("res" => '0', "result" => 'Something Mistake');
			echo json_encode($empt);
		}

	}
	else
	{
		$empt = array("res" => '0', "result" => 'Please enter all required fields');
		echo json_encode($empt);
	}     
}

#############################################################################
function get_all_survey($req,$con){  
	$user_id=$_REQUEST['user_id'];
	if($user_id != '')  
	{ 
		$sql1 = mysqli_query($con ,"SELECT * FROM `athlete_survey` WHERE `user_id`='$user_id' and `isDeleted`='0' order by date_time DESC");
		$num_rec=mysqli_num_rows($sql1);	

		if ($num_rec>0) { 
			$i=0;

			while($row=mysqli_fetch_assoc($sql1))
			{ 

				$survey_id=$row['id'];
				$alldata[$i]['id']=$row['id'];
				$alldata[$i]['user_id']=$row['user_id'];

				$alldata[$i]['title']=$row['title'];
				$alldata[$i]['description']=$row['description'];
				$alldata[$i]['question_type']=$row['question_type'];
				$alldata[$i]['question_no']=$row['question_no'];
				$alldata[$i]['hit_count']=$row['hit_count'];
				$alldata[$i]['status']=$row['status'];
				$alldata[$i]['show_anonymous']=$row['show_anonymous'];

				$sql2 = mysqli_query($con ,"SELECT * FROM `athlete_survey_details` WHERE `survey_id`='$survey_id' and `isDeleted`='0' ");
				$num_rec=mysqli_num_rows($sql2);
				$j=0;

				while($rowdetails=mysqli_fetch_assoc($sql2))
				{

					$review_sys[$j]['question_id'] = $rowdetails['question_id'];
					$review_sys[$j]['survey_question'] = $rowdetails['survey_question'];					
					$j++;
				}

				$alldata[$i]['Survey'] = $review_sys;
				unset($review_sys);
				$i++;

			}

			$data=array("success"=>'1',"message"=>$alldata);
			echo json_encode($data);
		}else{
			$data=array("success"=>'0',"message"=>'Not Found');
			echo json_encode($data);
		}
	}
	else
	{
		$data = array("res" => '0', "result" => 'Please enter all required fields');
		echo json_encode($data);
	}
}

#################################################################################################

function delete_survey($req, $con)
{
	/* 
	 * This will be modified to ensure that we delete survey based on survey type
	 * so as of now we have survey, survey multiple and survey yes no
	 * based on type send by user we will delete the survey
	 */

	/* Items to get in request */	

	$userId = $_REQUEST['user_id'];
	$surveyId = $_REQUEST['survey_id'];
	$surveyType = $_REQUEST['survey_type']; // Possible values are yes_no, multiple, single
	
	if((!isset($_REQUEST['survey_id']) && empty($surveyId)) || (!isset($_REQUEST['survey_type']) && empty($surveyType)) || empty($userId))
	{
		$data = array("res" => '0', "result" => 'Please enter all required fields');
		echo json_encode($data); exit;
	}

	switch ($surveyType) 
	{
		case 'single':
			$sql1 = mysqli_query($con ,"SELECT `id` FROM `athlete_survey` WHERE `id`='$surveyId'");
			$num_rec=mysqli_num_rows($sql1);

			if ($num_rec == 0)
			{
				$data=array("success"=>'0',"message"=>'Data Not Found !!!');
				echo json_encode($data); exit;
			}

			$sql2 = mysqli_query($con ,"UPDATE  `athlete_survey` set `isDeleted`='1' WHERE `id`='$surveyId'");
			
			$sql3 = mysqli_query($con ,"UPDATE  `athlete_survey_details` set `isDeleted`='1' WHERE `survey_id`='$surveyId'");

			$data['success'] = "1";
			$data['message'] = "Survey deleted successfully.";
			echo json_encode($data); exit;
				
			
			break;
		case 'multiple':
			$sql1 = mysqli_query($con ,"SELECT `id` FROM `athlete_survey_multiple` WHERE `id`='$surveyId'");
			$num_rec=mysqli_num_rows($sql1);

			if ($num_rec == 0)
			{
				$data=array("success"=>'0',"message"=>'Data Not Found !!!');
				echo json_encode($data); exit;
			}

			$sql2 = mysqli_query($con ,"UPDATE  `athlete_survey_multiple` set `isDeleted`='1' WHERE `id`='$surveyId'");
			
			//$sql3 = mysqli_query($con ,"UPDATE  `athlete_survey_media` set `isDeleted`='1' WHERE `survey_id`='$surveyId'");

			$data['success'] = "1";
			$data['message'] = "Survey deleted successfully.";
			echo json_encode($data); exit;
			break;
		case 'yes_no':
			$sql1 = mysqli_query($con ,"SELECT `id` FROM `athlete_survey_yes_no` WHERE `id`='$surveyId'");
			$num_rec=mysqli_num_rows($sql1);
			
			if ($num_rec == 0)
			{
				$data=array("success"=>'0',"message"=>'Data Not Found !!!');
				echo json_encode($data); exit;
			}

			$sql2 = mysqli_query($con ,"UPDATE  `athlete_survey_yes_no` set `isDeleted`='1' WHERE `id`='$surveyId'");
			
			//$sql3 = mysqli_query($con ,"UPDATE  `athlete_survey_media` set `isDeleted`='1' WHERE `survey_id`='$surveyId'");

			$data['success'] = "1";
			$data['message'] = "Survey deleted successfully.";
			echo json_encode($data); exit;
			break;
		default:
			# code...
			break;
	}

	/*
	$survey_id = $_REQUEST['id'];
	$sql1 = mysqli_query($con ,"SELECT `id` FROM `athlete_survey` WHERE `id`='$survey_id'");
	$num_rec=mysqli_num_rows($sql1);	

	if($survey_id != ''){ 
		if ($num_rec>0) { 

			$sql2 = mysqli_query($con ,"UPDATE  `athlete_survey` set `isDeleted`='1' WHERE `id`='$survey_id'");
			if ($sql2){
				$sql3 = mysqli_query($con ,"UPDATE  `athlete_survey_details` set `isDeleted`='1' WHERE `survey_id`='$survey_id'");

				$data['success'] = "1";
				$data['message'] = "Survey deleted successfully.";
				echo json_encode($data);
			}
			else{
				echo "Error deleting record: " . $conn->error;
			} 
		}
		else{
			$data=array("success"=>'0',"message"=>'Not Found');
			echo json_encode($data);
		}

	}else{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
	*/
}


function share_survey11($req, $con){ 

	$survey_id = $_REQUEST['survey_id'];
	$group_id  = $_REQUEST['group_id'];
	$user_id = $_REQUEST['user_id'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;

	if($survey_id != ''){ 

		$sql1 = mysqli_query($con ,"SELECT * FROM `athlete_survey` WHERE `id`='$survey_id' and `isDeleted`='0' order by date_time");
		$num_rec=mysqli_num_rows($sql1);	
		if($num_rec>0){ 

			if($row=mysqli_fetch_assoc($sql1)){ 
				$creator_id=$row[user_id];
			}
			if(!empty($_REQUEST['group_id'])) {    

				foreach($group_id as   $value)
				{
					$value=ltrim($value,'[');
					$value=rtrim($value,']');
					$group_ids=explode(",",$value);
					foreach($group_ids as $val){

						$sql2 = mysqli_query($con ,"SELECT * from athlete_chat_group_member where group_id='$val' ");
						while($row2=mysqli_fetch_assoc($sql2)){
							if( ($row2['group_member']!=$creator_id) && (!in_array($row2['group_member'],$to_member) && count($row2['group_member'])>0) ){
								$to_member[]=$row2['group_member'];
							}
						}

					}
				}
			}

			if(!empty($_REQUEST['user_id'])&& count($_REQUEST['user_id'])>0) {   

				foreach($user_id as   $value1)
				{
					$value1=ltrim($value1,'[');
					$value1=rtrim($value1,']');
					$user_ids=explode(",",$value1);
					foreach($user_ids as $val1){


						if(!in_array($val1,$to_member) && $val1!=''){ 
							$to_member[]=$val1;
						}
					}
				}
			}

			foreach($to_member as $tomember){ 

				$sql1 = mysqli_query($con ,"SELECT id FROM `athlete_shared_survey` WHERE `survey_id`='$survey_id' and `shared_to`='$tomember' ");
				$num_survey=mysqli_num_rows($sql1);	
				if($num_survey==0){ 

					$survey_share_sql="INSERT into `athlete_shared_survey` (`survey_id`,`shared_from`, `shared_to`, `date_time`) values('$survey_id' ,'$creator_id','$tomember', '$date_time') ";
					$survey_insert = mysqli_query($con , $survey_share_sql);

				}
			}

			if($survey_insert){

				$data['success'] = "1";
				$data['message'] = "Survey Shared successfully"; 
				echo json_encode($data);
			}
		}

	}else{ 
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}

}

####################################################################

function share_survey($req, $con){ 


	$survey_id = $_REQUEST['survey_id'];
	$group_id  = $_REQUEST['group_id'];
	$user_id = $_REQUEST['user_id'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;

	if($survey_id != ''){ 

		$sql1 = mysqli_query($con ,"SELECT * FROM `athlete_survey` WHERE `id`='$survey_id' and `isDeleted`='0' order by date_time DESC");
		$num_rec=mysqli_num_rows($sql1);	
		if($num_rec>0){ 

			if($row=mysqli_fetch_assoc($sql1)){ 
				$creator_id=$row[user_id];
				$survey_title=$row[title];
			}
			if(!empty($_REQUEST['group_id'])) {    

				foreach($group_id as   $value)
				{
					$value=ltrim($value,'[');
					$value=rtrim($value,']');
					$group_ids=explode(",",$value);
					foreach($group_ids as $val){

						$sql2 = mysqli_query($con ,"SELECT * from athlete_chat_group_member where group_id='$val' ");
						while($row2=mysqli_fetch_assoc($sql2)){
							$mem_id=$row2['group_member'];
							$mem_role=get_user_roleid($mem_id);
							// $res_roles=array(2,6,10,11);

							if( ( $row2['group_member']!=$creator_id) && ( !in_array($row2['group_member'],$to_member)) && (count($row2['group_member'])>0 ) && ( !in_array($mem_role) ) ){
								$to_member[]=$row2['group_member'];
							}
						}

					}
				}
			}

			if(!empty($_REQUEST['user_id'])&& count($_REQUEST['user_id'])>0) {   

				foreach($user_id as   $value1)
				{
					$value1=ltrim($value1,'[');
					$value1=rtrim($value1,']');
					$user_ids=explode(",",$value1);
					foreach($user_ids as $val1){ 

						$mem_role=get_user_roleid($val1);
						$res_roles=array(2,6,10,11);
						if(!in_array($val1,$to_member) && ($val1!='') && (!in_array($mem_role,$res_roles))){ 
							$to_member[]=$val1;
						}
					}
				}
			}

			foreach($to_member as $tomember){ 

				$sql1 = mysqli_query($con ,"SELECT id FROM `athlete_shared_survey` WHERE `survey_id`='$survey_id' and `shared_to`='$tomember' ");
				$num_survey=mysqli_num_rows($sql1);	
				if($num_survey==0){ 


					$survey_share_sql="INSERT into `athlete_shared_survey` (`survey_id`,`shared_from`, `shared_to`, `date_time`) values('$survey_id' ,'$creator_id','$tomember', '$date_time') ";
					$survey_insert = mysqli_query($con , $survey_share_sql);

				}
			}



			error_reporting(-1);
			ini_set('display_errors', 'On');
			require_once __DIR__ . '/firebase.php';
			require_once __DIR__ . '/push.php';
			$firebase = new Firebase();
			$push = new Push();

			$msg = 'survey_shared';
			$request_for = "New Message";

			$chatdata="$survey_title shared with you.";

			$emptTest1 = array("res" => '1', "chat_detail" => $chatdata);
			$message1 = json_encode($emptTest1);

//$payload = array();
			$payload['Msg'] = $message1;
//$payload['score'] = '5.6';
//echo $message11;
			$title = $msg;

			$emptTest = array("res" => '1', "chat_detail" => $chatdata);

			$emptTest11 = array("res" => '1', "chat_detail" => $chatdata);

			$message = json_encode($emptTest11);

			$push_type = "individual";
			$include_image = isset($_REQUEST['include_image']) ? TRUE : FALSE;

			$push->setTitle($title);
			$push->setMessage($message);
			if ($include_image) {
				$push->setImage(DEF_PUSH_ICON);
			} else {
				$push->setImage('');
			}
			$push->setIsBackground(FALSE);
			$push->setPayload($payload);

			$json = '';
			$response = '';

			if ($push_type == 'topic') {
				$json = $push->getPush();
				$response = $firebase->sendToTopic('global', $json);
			} else if ($push_type == 'individual') { 
				$json = $push->getPush();
//$regId = isset($_REQUEST['$regId1']) ? $_REQUEST['$regId1'] : '';
				if(!empty($to_member)){
					foreach($to_member as $val){ 
						$regId1 = $val;

						$response = $firebase->send($regId1, $json);
					}
				}

			}



			$data['success'] = "1";
			$data['message'] = "Survey Shared successfully"; 
			echo json_encode($data);

		}
		else
		{ 
		$data['success'] = "0";
		$data['message'] = "No Record Found ";
		echo json_encode($data);
	   }

	}else{ 
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}

}


####################################################################

function get_shared_survey($req, $con){ 

	$user_id = $_REQUEST['user_id'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;
	if($user_id != ''){ 

		$sql12 = mysqli_query($con ,"SELECT A.`survey_id`, A.`shared_to`, A.`isCompleted`, B.* FROM `athlete_shared_survey` as A LEFT JOIN `athlete_survey` as B on A.`survey_id`=B.`id` WHERE A.`shared_to`='$user_id'  and B.`isDeleted`= 0 and B.`status`='0' order by A.date_time DESC");
		$num_rec=mysqli_num_rows($sql12);	

		if ($num_rec>0) { 
			$i=0;

			while($row=mysqli_fetch_assoc($sql12))
			{ 

				$survey_id=$row['id'];
				$alldata[$i]['id']=$row['id'];
				$alldata[$i]['user_id']=$row['user_id'];
				$shared_by=get_user_name($row['user_id']);
				$alldata[$i]['shared_by']=$shared_by;
				$shared_to=get_user_name($row['shared_to']);
//$alldata[$i]['shared_to']=$shared_to;

				$alldata[$i]['title']=$row['title'];
				$alldata[$i]['description']=$row['description'];
				$alldata[$i]['question_type']=$row['question_type'];
				$alldata[$i]['question_no']=$row['question_no'];
				$alldata[$i]['hit_count']=$row['hit_count'];
				$alldata[$i]['status']=$row['status'];
				$alldata[$i]['isCompleted']=$row['isCompleted'];
				$alldata[$i]['show_anonymous']=$row['show_anonymous'];

				$sql2 = mysqli_query($con ,"SELECT * FROM `athlete_survey_details` WHERE `survey_id`='$survey_id' and `isDeleted`='0' ");
				$num_rec1=mysqli_num_rows($sql2);
				$j=0;

				while($rowdetails=mysqli_fetch_assoc($sql2))
				{

					$review_sys[$j]['question_id'] = $rowdetails['question_id'];
					$review_sys[$j]['survey_question'] = $rowdetails['survey_question'];					
					$j++;
				}

				$alldata[$i]['Survey'] = $review_sys;
				unset($review_sys);
				$i++;

			}


			$data=array("success"=>'1',"message"=>$alldata);
			echo json_encode($data);
		}else{
			$data=array("success"=>'0',"message"=>'Not Found');
			echo json_encode($data);
		}
	}else{ 
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}

}


function copy_survey($req,$con)
{
	/* 
	 * This will be modified to ensure that we copy survey based on survey type
	 * so as of now we have survey, survey multiple and survey yes no
	 * based on type send by user we will copy the survey
	 */

	/* Items to get in request */	

	$userId = $_REQUEST['user_id'];
	$surveyId = $_REQUEST['survey_id'];
	$surveyType = $_REQUEST['survey_type']; // Possible values are yes_no, multiple, single
	$title=$_REQUEST['survey_title']; 

	if((!isset($_REQUEST['survey_id']) && empty($surveyId)) || (!isset($_REQUEST['survey_type']) && empty($surveyType)) || empty($title) || empty($userId))
	{
		$data = array("res" => '0', "result" => 'Please enter all required fields');
		echo json_encode($data); exit;
	}

	$alldata = array();

	switch ($surveyType) 
	{
		case 'single':
			/* Check if some survey exists with the survey_id */
			
			$sql = mysqli_query($con ,"SELECT * FROM `athlete_survey` WHERE `id`='$surveyId' and isDeleted='0' ");

			if($row=mysqli_fetch_assoc($sql))
			{ 
				$survey_id=$row['id'];
				$alldata['id']=$row['id'];
				$user_id=$row['user_id'];

				$description=$row['description'];
				$question_no=$row['question_no'];
				$created_by=$row['user_id'];
				$question_type=$row['question_type'];
				$hit_count=$row['hit_count'];
				$status=$row['status'];
				$show_anonymous=$row['show_anonymous'];
				
				$sqlinsrt = mysqli_query($con,"INSERT into  `athlete_survey`(`title`,`description`,`question_no`,`user_id`,`question_type`,hit_count,`status`,`show_anonymous`,`date_time`)values('$title','$description','$question_no','$userId','$question_type','0','$status','$show_anonymous','$date_time')");
				$eventid = mysqli_insert_id($con);

				$sql2 = mysqli_query($con ,"SELECT * FROM `athlete_survey_details` WHERE `survey_id`='$survey_id' and `isDeleted`='0' ");
				$num_rec=mysqli_num_rows($sql2);
				$j=0;

				while($rowdetails=mysqli_fetch_assoc($sql2))
				{
					$survey_question = $rowdetails['survey_question'];	
					$sqldetail = mysqli_query($con,"INSERT into  `athlete_survey_details`(`survey_id`,`survey_question`,`user_id`,`date_time`)values('$eventid','$survey_question','$userId', '$date_time')");

					$j++;
				}

				$alldata['Survey'] = $review_sys;
				unset($review_sys);
			}

			break;
		case 'multiple':
			$sql2 = mysqli_query($con ,"SELECT * FROM `athlete_survey_multiple` WHERE `id`='$surveyId' and isDeleted='0' ");
			if($row2=mysqli_fetch_assoc($sql2))
			{
				//$title = $row2['title'];
				$description = $row2['description'];
				$date_time = new DateTime();
				$date_time = $date_time->format('Y-m-d H:i:s');

				$sqlinsrt = mysqli_query($con,"INSERT into  `athlete_survey_multiple`(
					`user_id`, `title`,`description`,`date_time`)
					values('$userId', '$title','$description','$date_time')");
				
				$eventId = mysqli_insert_id($con);
				
				$sql3 = mysqli_query($con ,"SELECT * FROM `athlete_survey_media` WHERE `survey_id`='$surveyId'");
				
				while($row3=mysqli_fetch_assoc($sql3))
				{
					
					$questionTitle = $row3['question_title'];
					$questionType = $row3['question_type'];
					$questionOptions = $row3['question_option'];
					$filename = $row3['filename'];
					$link = $row3['link'];
	
					$rs =  mysqli_query($con,"INSERT into  `athlete_survey_media`(
						`survey_id`,`question_title`,`question_type`,`question_option`,`filename`, `link`)
						values('$eventId','$questionTitle','$questionType', '$questionOptions', '$filename', '$link')");

					
				}

				if($sqlinsrt){
					$alldata['Survey'] = array('status'=>true, 'message'=>'Copied Successfully !!!');
				}
			}
			break;
		case 'yes_no':
			$sql2 = mysqli_query($con ,"SELECT * FROM `athlete_survey_yes_no` WHERE `id`='$surveyId' and isDeleted='0' ");
			if($row2=mysqli_fetch_assoc($sql2))
			{
				//$title = $row2['title'];
				$description = $row2['description'];
				$date_time = new DateTime();
				$date_time = $date_time->format('Y-m-d H:i:s');

				$sqlinsrt = mysqli_query($con,"INSERT into  `athlete_survey_yes_no`(
					`user_id`, `title`,`description`,`date_time`)
					values('$userId', '$title','$description','$date_time')");
				
				$eventid = mysqli_insert_id($con);
				
				$sql3 = mysqli_query($con ,"SELECT * FROM `athlete_survey_yes_no_media` WHERE `survey_id`='$surveyId' and `isDeleted`='0' ");
				while($row3=mysqli_fetch_assoc($sql3))
				{
					$add_question = $row3['add_question'];
					$question_type = $row3['question_type'];
					$filename = $row3['filename'];
					$link = $row3['link'];

					$survey_question = $rowdetails['survey_question'];	
					$rs = mysqli_query($con,"INSERT into  `athlete_survey_yes_no_media`(
						`survey_id`,`add_question`,`question_type`,`filename`, `link`)
						values('$eventid','$add_question','$question_type', '$filename', '$link')");

					
				}

				if($sqlinsrt){
					$alldata['Survey'] = array('status'=>true, 'message'=>'Copied Successfully !!!');
				}
			}

			break;
		default:
			# code...
			break;
	}

	if(!empty($alldata))
	{
		$data = array("res" => '1', "result" => "Survey copied as $title");
		echo json_encode($data); exit;
	}

	$data = array("res" => '1', "result" => "No data exists with given survey id");
	echo json_encode($data); exit;

	/*
	$survey_id=$_REQUEST['survey_id'];
	$newtitle=$_REQUEST['title'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;
	
	if($survey_id != '')
	{ 
		
		$sql1 = mysqli_query($con ,"SELECT * FROM `athlete_survey` WHERE `id`='$survey_id' and isDeleted='0' ");
		
		if($row=mysqli_fetch_assoc($sql1))
		{ 
			$survey_id=$row['id'];
			$alldata['id']=$row['id'];
			$user_id=$row['user_id'];

			$description=$row['description'];
			$question_no=$row['question_no'];
			$created_by=$row['user_id'];
			$question_type=$row['question_type'];
			$hit_count=$row['hit_count'];
			$status=$row['status'];
			$show_anonymous=$row['show_anonymous'];

			$sqlinsrt = mysqli_query($con,"INSERT into  `athlete_survey`(`title`,`description`,`question_no`,`user_id`,`question_type`,hit_count,`status`,`show_anonymous`,`date_time`)values('$newtitle','$description','$question_no','$created_by','$question_type','0','$status','$show_anonymous','$date_time')");
			$eventid = mysqli_insert_id($con);

			$sql2 = mysqli_query($con ,"SELECT * FROM `athlete_survey_details` WHERE `survey_id`='$survey_id' and `isDeleted`='0' ");
			$num_rec=mysqli_num_rows($sql2);
			$j=0;

			while($rowdetails=mysqli_fetch_assoc($sql2))
			{
				$survey_question = $rowdetails['survey_question'];	
				$sqldetail = mysqli_query($con,"INSERT into  `athlete_survey_details`(`survey_id`,`survey_question`,`user_id`,`date_time`)values('$eventid','$survey_question','$created_by', '$date_time')");

				$j++;
			}

			$alldata['Survey'] = $review_sys;
			unset($review_sys);

		}
		
		

		$sql2 = mysqli_query($con ,"SELECT * FROM `athlete_survey_yes_no` WHERE `id`='$survey_id' and isDeleted='0' ");
		if($row2=mysqli_fetch_assoc($sql2))
		{
			$title = $row2['title'];
			$description = $row2['description'];
			$date_time = new DateTime();
			$date_time = $date_time->format('Y-m-d H:i:s');

			$sqlinsrt = mysqli_query($con,"INSERT into  `athlete_survey_yes_no`(
				`title`,`description`,`date_time`)
				values('$title','$description','$date_time')");
			
			$eventid = mysqli_insert_id($con);
			
			$sql3 = mysqli_query($con ,"SELECT * FROM `athlete_survey_yes_no_media` WHERE `survey_id`='$survey_id' and `isDeleted`='0' ");
			while($row3=mysqli_fetch_assoc($sql3))
			{
				$add_question = $row3['add_question'];
				$question_type = $row3['question_type'];
				$filename = $row3['filename'];
				$link = $row3['link'];

				$survey_question = $rowdetails['survey_question'];	
				$sqldetail = mysqli_query($con,"INSERT into  `athlete_survey_yes_no_media`(
					`survey_id`,`add_question`,`question_type`,`filename`, `link`)
					values('$eventid','$add_question','$question_type', '$filename', '$link')");
			}
			

		}
 

		$data = array("res" => '1', "result" => "Survey copied as $title");
		echo json_encode($data);		
	}
	else
	{
		$data = array("res" => '0', "result" => 'Please enter all required fields');
		echo json_encode($data);
	}

	*/
}



function enable_disable_survey($req, $con){ 
	$survey_id = $_REQUEST['survey_id'];
	$status=$_REQUEST['status'];
	$show_anonymous=$_REQUEST['show_anonymous'];

	$sql1 = mysqli_query($con ,"SELECT `id` FROM `athlete_survey` WHERE `id`='$survey_id'");
	$num_rec=mysqli_num_rows($sql1);	

	if($survey_id != ''){ 
		if ($num_rec>0) { 

			$sql2 = mysqli_query($con ,"UPDATE  `athlete_survey` set `status`='$status', `show_anonymous`='$show_anonymous'  WHERE `id`='$survey_id'");
			if ($sql2){

				$data['success'] = "1";
				$data['message'] = "Survey Status Changed successfully.";
				echo json_encode($data);
			}
			else{
				echo "Error updating record: " . $conn->error;
			} 
		}
		else{
			$data=array("success"=>'0',"message"=>'Not Found');
			echo json_encode($data);
		}

	}else{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}

############################################################

// function show_anonymous_survey($req, $con){ 
// 	$survey_id = $_REQUEST['survey_id'];
// 	$status=$_REQUEST['status'];
// 	$sql1 = mysqli_query($con ,"SELECT `id` FROM `athlete_survey` WHERE `id`='$survey_id'");
// 	$num_rec=mysqli_num_rows($sql1);	

// 	if($survey_id != ''){ 
// 		if ($num_rec>0) { 

// 			$sql2 = mysqli_query($con ,"UPDATE  `athlete_survey` set `show_anonymous`='$status' WHERE `id`='$survey_id'");
// 			if ($sql2){

// 				$data['success'] = "1";
// 				$data['message'] = "Status Changed successfully.";
// 				echo json_encode($data);
// 			}
// 			else{
// 				echo "Error updating record: " . $conn->error;
// 			} 
// 		}
// 		else{
// 			$data=array("success"=>'0',"message"=>'Not Found');
// 			echo json_encode($data);
// 		}

// 	}else{
// 		$data['success'] = "0";
// 		$data['message'] = "Please enter all required fields.";
// 		echo json_encode($data);
// 	}
// }


#######################################################################################################

function get_frnd_group_survey($req,$con){
	$user_id = $_REQUEST['user_id'];    
	$survey_id = $_REQUEST['survey_id'];    

	if($user_id != ''){ 
		$status = 2;
		$request_for = "Friend_request";
//echo "SELECT * from `athlete_report_request` WHERE (`request_from`='$user_id' && `status`='$status' && `request_for` = '$request_for') || (`request_to`='$user_id' && `status`='$status' && `request_for` = '$request_for')";
		$res = mysqli_query($con, "SELECT * from `athlete_report_request` WHERE (`request_from`='$user_id' && `status`='$status' && `request_for` = '$request_for') || (`request_to`='$user_id' && `status`='$status' && `request_for` = '$request_for') ");
		$p=0;
		while ($row = mysqli_fetch_assoc($res)){ 
			if ($user_id != $row['request_to']){
				$request_too = $row['request_to'];
			} 
			else if ($user_id != $row['request_from']){
				$request_too = $row['request_from'];
			}

			if( !in_array($request_too,$request_tor) )
				{ $request_tor[$p]=$request_too; }
			$p++;

		}

		foreach($request_tor as $request_to){   


			$res_shared = mysqli_query($con, "SELECT * from `athlete_shared_survey` WHERE `shared_to`='$request_to' and `survey_id`='$survey_id'");
			$num_shared=mysqli_num_rows($res_shared);
			if($num_shared==0){  
				$res2 = mysqli_query($con, "SELECT * from `athlete_users` WHERE `user_id`='$request_to'");
				if($row4 = mysqli_fetch_assoc($res2)){   
					$data['id'] = $row4['user_id'];
					$data['name'] = $row4['user_name'];
					$data['image'] = PROFILE_IMAGE.$row4['profile_image'];
					$data['type'] = "Friend";
					$data['role']= $row4['user_role'];
					$role=$row4['user_role'];
					$res_roles=array(2,6,10,11);

				}
				if(!in_array($role,$res_roles)){ 
					$allfrienddata[] = $data;
				}
			}
		}

//print_r($allfrienddata);
/*$gr_res = mysqli_query($con,"Select * from `athlete_chat_group_member` where `group_member` = '$user_id'");
while($gr_row = mysqli_fetch_assoc($gr_res)){
echo $gp_id = $gr_row['group_id'];
$id_name = mysqli_query($con, "SELECT * from `athlete_chat_group` where `id` = '$gp_id'");
if($in_row = mysqli_fetch_assoc($id_name)){
$gr_data['id'] = $gp_id; 
$gr_data['name'] = $in_row['group_name'];
$gr_data['image'] = $in_row['group_icon'];
$gr_data['type'] = "Group";
}
$allgroupdata[] = $gr_data;
}*/


$gr_res = mysqli_query($con,"Select A.*, B.* from `athlete_chat_group` as A left join `athlete_chat_group_member` as B on A.id=B.group_id where B.`group_member` = '$user_id' and `group_type`='group_chat' ");
while($in_row = mysqli_fetch_assoc($gr_res)){

	$gr_data['id'] = $in_row['group_id'];; 
	$gr_data['name'] = $in_row['group_name'];
	$gr_data['image'] = $in_row['group_icon'];
	$gr_data['type'] = "Group";

	$allgroupdata[] = $gr_data;
}

if(!empty($allfrienddata)  && !empty($allgroupdata)){
	$alldata = array_merge($allfrienddata, $allgroupdata); 
}
else if(!empty($allfrienddata)){
	$alldata = $allfrienddata;
}
else if(!empty($allgroupdata)){
	$alldata = $allgroupdata;
}
if($alldata){ 
	$empt1 = array("res" => '1', "result" => $alldata);
	echo json_encode($empt1);
} 
else{
	$empt1 = array("res" => '0', "result" => 'Data not Found');
	echo json_encode($empt1);
}
}
else{
	$empt = array("res" => '0', "result" => 'Please enter all requireds fields');
	echo json_encode($empt); 
}

}



function edit_survey($req,$con){  
	$survey_id=$_REQUEST['survey_id'];

	$title = $_REQUEST['title'];
	$created_by=$_REQUEST['user_id'];    
	$description = $_REQUEST['description'];    
	$question_no = $_REQUEST['question_no'];    
	$question_type = $_REQUEST['question_type']; 
	$question = $_REQUEST['question'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;
	

	if($survey_id!='' && $title !='' && $description != '' && $question_no != '' && $question_type != '')  
	{ 

		$sql = mysqli_query($con,"UPDATE  `athlete_survey`set `title`='$title', `description`='$description', `question_no`='$question_no',`user_id`='$created_by',`question_type`='$question_type' where id='$survey_id'");
//$eventid = mysqli_insert_id($con);
		$sqldel = mysqli_query($con,"DELETE FROM  `athlete_survey_details` where survey_id='$survey_id'");

		foreach($question as  $key => $value)
		{


            $file_url = "";
            $imageURL = $_REQUEST['imageURL'][$key]; 

			if(!empty($_FILES['survey_image'])) 
			{ 
				$target="uploads/notes_media/";
				$type = $_FILES['survey_image']['type'][$key];
				$name = $_FILES['survey_image']['name'][$key];
				
				$name = str_replace(" ","",$name);
				$name = uniqid().basename($name);
				
				$new = $target.$name;
				$file_url = NOTES_MEDIA.$name;

				move_uploaded_file($_FILES['survey_image']['tmp_name'][$key],$new);
			}

			$questions = $value;
if($type){
			$sql = mysqli_query($con,"INSERT into  `athlete_survey_details`(`survey_id`,`survey_question`,`survey_image`,`user_id`,`date_time`)values('$survey_id','$questions','$file_url','$created_by', '$date_time')");
}elseif($imageURL) {

	$sql = mysqli_query($con,"INSERT into  `athlete_survey_details`(`survey_id`,`survey_question`,`survey_image`,`user_id`,`date_time`)values('$survey_id','$questions','$imageURL','$created_by', '$date_time')");

		}else{
			$sql = mysqli_query($con,"INSERT into  `athlete_survey_details`(`survey_id`,`survey_question`,`user_id`,`date_time`)values('$survey_id','$questions','$created_by', '$date_time')");
		}

		}
		if($sql)
		{
			$empt = array("res" => '1', "result" => "Survey Updated Successfully");
			echo json_encode($empt);
		}
		else
		{
			$empt = array("res" => '0', "result" => 'Something Mistake');
			echo json_encode($empt);
		}

	}
	else
	{
		$empt = array("res" => '0', "result" => 'Please enter all required fields');
		echo json_encode($empt);
	}     
}

#################################################################################################


function submit_survey($req,$con){  
	$survey_id=$_REQUEST['survey_id'];
	$created_by=$_REQUEST['user_id'];
	$question = $_REQUEST['question'];
	$answer = $_REQUEST['answer'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;
	$counter=count($question);
	if($survey_id!='' && !empty($question)){ 

		$sql1 = mysqli_query($con ,"SELECT `status`,`hit_count` FROM `athlete_survey` WHERE `id`='$survey_id' and `isDeleted`='0'");
		$num_rec=mysqli_num_rows($sql1);	
		if($num_rec>0){
			$row=mysqli_fetch_assoc($sql1);
			$status=$row['status'];
			$hit_count=$row['hit_count']+1;
		}

		if($status==0){ 


			for($i=0;$i<$counter;$i++)
			{
				$qns=$question[$i];
				$ans=$answer[$i];
				$sql = mysqli_query($con,"INSERT into  `athlete_survey_completed`(`survey_id`,`survey_question`,`survey_answer`,`user_id`,`date_time`)values('$survey_id','$qns','$ans','$created_by', '$date_time')");

				$hitsql=mysqli_query($con,"UPDATE `athlete_survey` set `hit_count`='$hit_count' where `id`='$survey_id'");
				$sbmtsql=mysqli_query($con,"UPDATE `athlete_shared_survey` set `isCompleted`=1 where `survey_id`='$survey_id' and shared_to='$created_by' ");


			}
			if($sql)
			{
				$empt = array("res" => '1', "result" => "Survey completed Successfully");
				echo json_encode($empt);
			}
			else
			{
				$empt = array("res" => '0', "result" => 'Something Mistake');
				echo json_encode($empt);
			}

		}
		else
		{
			$empt = array("res" => '0', "result" => 'Survey is already closed');
			echo json_encode($empt);
		}
	}
	else
	{
		$empt = array("res" => '0', "result" => 'Please enter all required fields');
		echo json_encode($empt);
	}   

}

##################################################################################################################################

function get_submitted_survey($req,$con){  
	$survey_id=$_REQUEST['survey_id'];
	$submit_by=$_REQUEST['user_id'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;
	if( $survey_id != '' && $submit_by != ''){ 


		$sql12 = mysqli_query($con ,"SELECT A.* from `athlete_survey` as A WHERE A.`id`='$survey_id' and A.`isDeleted`= 0 and A.`status`='0' order by A.date_time DESC");
		$num_rec=mysqli_num_rows($sql12);	

		if ($num_rec>0) { 

			if($row=mysqli_fetch_assoc($sql12))
			{ 

//print_r($row);
				$survey_id=$row['id'];
				$alldata['id']=$row['id'];
//$alldata['user_id']=$row['user_id'];
				$shared_by=get_user_name($row['user_id']);
				$alldata['shared_by']=$shared_by;

				$submitted_by=get_user_name($submit_by);
				$alldata['submit_by']=$submitted_by;

				$alldata['title']=$row['title'];
				$alldata['description']=$row['description'];
				$alldata['question_type']=$row['question_type'];
				$alldata['question_no']=$row['question_no'];
				$alldata['hit_count']=$row['hit_count'];
				$alldata['status']=$row['status'];
//$alldata['isCompleted']=$row['isCompleted'];
				$alldata['show_anonymous']=$row['show_anonymous'];

//$sql = mysqli_query($con,"INSERT into  `athlete_survey_completed`(`survey_id`,`survey_question`,`survey_answer`,`user_id`,`date_time`)values('$survey_id','$qns','$ans','$created_by', '$date_time')");

				$sql2 = mysqli_query($con ,"SELECT * FROM `athlete_survey_completed` WHERE `survey_id`='$survey_id' and `user_id`='$submit_by' and  `isDeleted`='0' ");
				$num_rec1=mysqli_num_rows($sql2);
				$j=0;

				while($rowdetails=mysqli_fetch_assoc($sql2))
				{

					$review_sys[$j]['question_id'] = $rowdetails['question_id'];
					$review_sys[$j]['survey_question'] = $rowdetails['survey_question'];					
					$review_sys[$j]['survey_answer'] = $rowdetails['survey_answer'];					

					$j++;
				}

				$alldata['Survey'] = $review_sys;
				unset($review_sys);

			}


			$data=array("success"=>'1',"message"=>$alldata);
			echo json_encode($data);
		}else{
			$data=array("success"=>'0',"message"=>'Not Found');
			echo json_encode($data);
		}
	}else{ 
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}
###########################################################################




function get_survey_stat($req,$con){ 

	$survey_id=	$_REQUEST['survey_id'];



	require_once __DIR__ . '/PHPExcel/Classes/PHPExcel.php';
	require_once __DIR__ . '/PHPExcel/Classes/PHPExcel/Writer/Excel5.php';

	$query = "SELECT A.title as Title, A.question_type as Type, A.hit_count as Hit, B.survey_question as Question, B.survey_answer as Answer, B.user_id as Completed_by, B.date_time as Date FROM athlete_survey as A left join `athlete_survey_completed` as B on A.id=B.survey_id where B.`survey_id`='$survey_id' order by B.date_time DESC";
	$result = mysqli_query($con, $query);
	$num=mysqli_num_rows($result);
	if($num> 0 && $survey_id!='' )
	{

		$objPHPExcel = new PHPExcel();

// Set document properties
		$objPHPExcel->getProperties()->setCreator("Govinda");
		$objPHPExcel->getProperties()->setLastModifiedBy("Govinda");
		$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
		$objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");
		$objPHPExcel->getProperties()->setCategory("Test result file");
// Add some data
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);

		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);


		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Title');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'Date/Time');

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Respondent');

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Question');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'Answer');

		$rowCount = 2;

		while($row = mysqli_fetch_array($result)){

			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['Title']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['Date']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, get_user_name($row['Completed_by']));

			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['Question']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $row['Answer']);

			$rowCount++;
		}

// Rename worksheet


		$objPHPExcel->getActiveSheet()->setTitle('Survey Data');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file
//date('H:i:s') , " Write to Excel2007 format" , EOL;
		$callStartTime = microtime(true);

// Use PCLZip rather than ZipArchive to create the Excel2007 OfficeOpenXML file
		PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
		$filename=$survey_id.'-'.rand(4,10000).'.xlsx';

		$target="uploads/stats/";

		$objWriter->save($target.$filename);


		$shareurl=STATS.$filename;


// Redirect output to a client�s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
		header('Content-Disposition: attachment;filename="userList.xls"');
		header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

//var_dump($objPHPExcel);
$empt1=array("success"=>'1',"message"=>$shareurl);
echo json_encode($empt1);

}else
{
	$data['success'] = "0";
	$data['message'] = "Please enter all required fields.";
	echo json_encode($data);
}

}
###############################by Rakesh on 28/12/2018 ################################

function add_notes_category($req, $con){
	$user_id = $_REQUEST['user_id'];
	$title = $_REQUEST['title'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;

	if($user_id!='' && $title!=''){
		$res1 = mysqli_query($con, "INSERT into athlete_notes_category(`user_id`, `category`, `status`, `datetime`) 
			VALUES ('$user_id','$title','0', '$date_time')");
		$eventid = mysqli_insert_id($con);
		if($eventid){

			$empt['title'] = $title;
			$empt['category_id'] = $eventid;

			$data=array("success"=>'1',"message"=>$empt);
			echo json_encode($data);
		}
		else
		{
			$data['success'] = "0";
			$data['message'] = "There is some error.";
			echo json_encode($data);  
		}

	}else
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}
###############################by Rakesh on 28/12/2018 ################################

function get_notes_category($req, $con){
	$user_id = $_REQUEST['user_id'];
	if($user_id!=''){
		$res = mysqli_query($con, "SELECT * from athlete_notes_category where `user_id`='$user_id' && status='0' && isDeleted='0' ORDER BY id DESC");
		if (mysqli_num_rows($res) > 0) {
			while($row=mysqli_fetch_assoc($res))
			{
				$empt[]=$row;
			}
			$empt1=array("success"=>'1',"message"=>$empt);
			echo json_encode($empt1);
		}else{
			$empt1=array("success"=>'0',"message"=>'Not Found');
			echo json_encode($empt1);
		}
	}
}

#######################################################################################
function create_note($req, $con)
{

	$user_id=$_REQUEST['user_id'];
	$category_id=$_REQUEST['category_id'];
	if($category_id=='' || $category_id=='0'){
		$category_id='1';

	}
	$title=$_REQUEST['title'];
	$description=$_REQUEST['description'];
//$img_Files=$_REQUEST['img_Files'];
//$video_Files=$_REQUEST['video_Files'];
//$user_id=$_REQUEST['links'];
//$user_id=$_REQUEST['doc_files'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;
	$insrtsql="INSERT into `athlete_notes`(`user_id`,`category_id`,`title`,`description`,`date_time`) values('$user_id','$category_id','$title','$description','$date_time') ";

	$add_notes = mysqli_query($con, $insrtsql);
	$notes_id = mysqli_insert_id($con);

	if($add_notes)
	{ 
		if(!empty($_FILES['img_files'])) { 

			$typed='image';
			foreach($_FILES["img_files"]["tmp_name"] as $key=>$tmp_name)
			{ 
				$target="uploads/notes_media/";
				$type = $_FILES['img_files']['type'][$key];
				$name = $_FILES['img_files']['name'][$key];
				$name1 = str_replace(" ","",$name);
				$new_name = uniqid()."_".basename($name1);
				$new = $target.$new_name;
				$file_url = NOTES_MEDIA.$new_name;
				if(move_uploaded_file($_FILES['img_files']['tmp_name'][$key],$new))
				{
					$add_file = mysqli_query($con, "INSERT INTO `athlete_notes_media`(`notes_id`, `type`,`filename`,`link`) VALUES ('$notes_id','$typed','$new_name','$file_url')");
				}

			}
		}

		if(!empty($_FILES['videos'])) {

			$typed='video';
			foreach($_FILES["videos"]["tmp_name"] as $key=>$tmp_name)
			{ 
				$target="uploads/notes_media/";
				$type = $_FILES['videos']['type'][$key];
				$name = $_FILES['videos']['name'][$key];
				$name1 = str_replace(" ","",$name);
				$new_name = uniqid()."_".basename($name1);
				$new = $target.$new_name;
				$file_url = NOTES_MEDIA.$new_name;
				if(move_uploaded_file($_FILES['videos']['tmp_name'][$key],$new))
				{
					$add_videofile = mysqli_query($con, "INSERT INTO `athlete_notes_media`(`notes_id`, `type`,`filename`,`link`) VALUES ('$notes_id','$typed','$new_name','$file_url')");
				}

			}
		}


		if(!empty($_FILES['documents']))
		{
			$typed='document';

			foreach($_FILES["documents"]["tmp_name"] as $key=>$tmp_name){
				$type=$_FILES['documents']['type'][$key];
				$allowext = array("doc","docx","pdf","odt","txt");
				$temp = explode(".", $_FILES['documents']['name'][$key]);
				$ext = end($temp);

				if(!in_array($ext,$allowext))
				{
					$data['success'] = "0";
					$data['message'] = "Invaild File Format.";
					echo json_encode($data);
				}
				else
				{
					$target="uploads/notes_media/";
					$new_name = uniqid()."_".basename($_FILES['documents']['name'][$key]);
					$new = $target.$new_name;
					$file_url = NOTES_MEDIA.$new_name;
					if(move_uploaded_file($_FILES['documents']['tmp_name'][$key],$new)){
						$add_docfile = mysqli_query($con, "INSERT INTO `athlete_notes_media`(`notes_id`, `type`,`filename`,`link`) VALUES ('$notes_id','$typed','$new_name','$file_url')");

					}

				}
			}
		}

		if(!empty($_REQUEST['links'])) {
			$typed='link';
			foreach($_REQUEST['links'] as $val){

				$add_links = mysqli_query($con, "INSERT INTO `athlete_notes_media`(`notes_id`, `type`,`link`) VALUES ('$notes_id','$typed','$val')");

			}
		}

		$data['success'] = "1";
		$data['message'] = "Notes created successfully.";
		echo json_encode($data);

	}	
	else
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}

}




function copy_note($req,$con)
{
	$userId = $_REQUEST['user_id'];
	$noteID = $_REQUEST['note_id'];
	$title = $_REQUEST['note_title']; 

	if((!isset($_REQUEST['note_id']) && empty($noteID)) || empty($title) || empty($userId))
	{
		$data = array("res" => '0', "result" => 'Please enter all required fields');
		echo json_encode($data); exit;
	}

	$alldata = array();

			$sql2 = mysqli_query($con ,"SELECT * FROM `athlete_notes` WHERE `id`='$noteID' and isDeleted='0' ");
			if($row2=mysqli_fetch_assoc($sql2))
			{
				//$title = $row2['title'];
				$category_id = $row2['category_id'];
				$description = $row2['description'];
				$title_row = $row2['category_id'];
				$date_time = new DateTime();
				$date_time = $date_time->format('Y-m-d H:i:s');

				$sqlinsrt = mysqli_query($con,"INSERT into  `athlete_notes`(
					`user_id`, `title`,`description`,`date_time`,`category_id`)
					values('$userId', '$title_row','$description','$date_time','$category_id')");
				
				$eventId = mysqli_insert_id($con);
				
				$sql3 = mysqli_query($con ,"SELECT * FROM `athlete_notes_media` WHERE `notes_id`='$noteID'");
				
				while($row3=mysqli_fetch_assoc($sql3))
				{
					
					$type = $row3['type'];
					$filename = $row3['filename'];
					$link = $row3['link'];
					
					$rs =  mysqli_query($con,"INSERT into  `athlete_notes_media`(
						`notes_id`,`type`,`filename`,`link`)
						values('$eventId','$type','$filename', '$link')");

					
				}

				if($sqlinsrt){
					$alldata['Note'] = array('status'=>true, 'message'=>'Copied Successfully !!!');
				}
			}

				if($sqlinsrt){
					$alldata['Note'] = array('status'=>true, 'message'=>'Copied Successfully !!!');
				}

	if(!empty($alldata))
	{
		$data = array("res" => '1', "result" => "Note copied as $title");
		echo json_encode($data); exit;
	}

	$data = array("res" => '1', "result" => "No data exists with given note id");
	echo json_encode($data); exit;
}

############################################################################################
function delete_note($req, $con){ 
	$notes_id = $_REQUEST['id'];
	$sql1 = mysqli_query($con ,"SELECT `id` FROM `athlete_notes` WHERE `id`='$notes_id'");
	$num_rec=mysqli_num_rows($sql1);	

	if($notes_id != ''){ 
		if ($num_rec>0) { 

			$sql2 = mysqli_query($con ,"UPDATE `athlete_notes` set `isDeleted`='1' WHERE `id`='$notes_id'");
			if ($sql2){
				$sql3 = mysqli_query($con ,"UPDATE `athlete_notes_media` set `isDeleted`='1' WHERE `notes_id`='$notes_id'");
				$sql4 = mysqli_query($con ,"UPDATE `athlete_shared_notes` set `isDeleted`='1' WHERE `notes_id`='$notes_id'");

				$data['success'] = "1";
				$data['message'] = "Notes deleted successfully.";
				echo json_encode($data);
			}
			else{
				echo "Error deleting record: " . $conn->error;
			} 
		}
		else{
			$data=array("success"=>'0',"message"=>'Not Found');
			echo json_encode($data);
		}

	}else{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}

####################################################################################################

function get_all_notes_incategory($req, $con){ 
	$cat_id = $_REQUEST['cat_id'];
	$user_id = $_REQUEST['user_id'];

	if($cat_id != ''){ 
//echo "SELECT * FROM `athlete_notes` WHERE `category_id`='$cat_id' and `isDeleted`='0' and `status`='0'";
		//$sql1 = mysqli_query($con ,"SELECT * FROM `athlete_notes` WHERE `category_id`='$cat_id' and `user_id`='$user_id' and `isDeleted`='0' and `status`='0' order by date_time DESC");
		
		$sql1 = mysqli_query($con ,"SELECT A.*, B.user_name, B.profile_image, B.user_role, B.user_role FROM `athlete_notes` A 
				JOIN `athlete_users` B ON B.`user_Id` = A.`user_id`
				JOIN `athlete_user_role` C ON C.`role_id` = B.`user_role`
				WHERE A.`category_id`='$cat_id' and A.`isDeleted`='0' and A.`status`='0' order by A.date_time DESC");
		
		
		
		$num_rec=mysqli_num_rows($sql1);	
		if ($num_rec>0) { 
			$i=0;
			while($row=mysqli_fetch_assoc($sql1))
			{
				$notes_id = $row['id'];
//$empt[]=$row;

//$notes_id=$row['id'];
				$alldata[$i]['id']=$row['id'];
				$alldata[$i]['user_name']=$row3['user_name'];
				$alldata[$i]['role_name']=$row3['role_name'];
				$alldata[$i]['user_role']=$row3['user_role'];
				$alldata[$i]['user_pic']=PROFILE_IMAGE.$row3['profile_image'];
				$alldata[$i]['date_time']=$row3['date_time'];
				$alldata[$i]['updated_date_time']=$row3['updated_date_time'];
				$alldata[$i]['notes_id']=$notes_id;
				$alldata[$i]['created_by']=$row['user_id'];
				$alldata[$i]['category_id']=$row['category_id'];
				$alldata[$i]['category_name']=get_category_name($row['category_id']);
				$alldata[$i]['title']=$row['title'];
				$alldata[$i]['description']=$row['description'];
				$alldata[$i]['status']=$row['status'];

				$sql2 = mysqli_query($con ,"SELECT * FROM `athlete_notes_media` WHERE `notes_id`='$notes_id' and `type`='image' ");
				$im=0;
				$vd=0;
				$doc=0;
				$lnk=0;
				while($row_image=mysqli_fetch_assoc($sql2)){  

					$notes_image[$im]['id']=$row_image['id'];
					$notes_image[$im]['link']=$row_image['link'];
					$im++;

				}

				$sql3 = mysqli_query($con ,"SELECT * FROM `athlete_notes_media` WHERE `notes_id`='$notes_id' and `type`='video' ");

				while($row_video=mysqli_fetch_assoc($sql3)){  

					$notes_video[$vd]['id']=$row_video['id'];
					$notes_video[$vd]['link']=$row_video['link'];					
					$vd++;
				}

				$sql4 = mysqli_query($con ,"SELECT * FROM `athlete_notes_media` WHERE `notes_id`='$notes_id' and `type`='link' ");

				while($row_link=mysqli_fetch_assoc($sql4)){  

					$notes_link[$lnk]['id']=$row_link['id'];
					$notes_link[$lnk]['link']=$row_link['link'];					
					$lnk++;
				}
				$sql5 = mysqli_query($con ,"SELECT * FROM `athlete_notes_media` WHERE `notes_id`='$notes_id' and `type`='document' ");

				while($row_doc=mysqli_fetch_assoc($sql5)){  

					$notes_doc[$doc]['id']=$row_doc['id'];
					$notes_doc[$doc]['link']=$row_doc['link'];					
					$doc++;
				}

				$alldata[$i][notes_images]=$notes_image;
				$alldata[$i][notes_videos]=$notes_video;
				$alldata[$i][notes_documents]=$notes_doc;
				$alldata[$i][notes_links]=$notes_link;

				$i++;
			}
			$data=array("res"=>'1',"result"=>$alldata);
			echo json_encode($data);
		}else{ 
			$data=array("res"=>'0',"result"=>'Not Found');
			echo json_encode($data);
		}
	}
	else{
		$data['res'] = "0";
		$data['result'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}



################################################################################################


function get_notes_details($req, $con){  
	$notes_id = $_REQUEST['notes_id'];
	if($notes_id != ''){ 

		$sql1 = mysqli_query($con ,"SELECT A.*, B.user_name, B.profile_image, B.user_role, C.role_name FROM `athlete_notes` A 
				LEFT JOIN `athlete_users` B ON B.`user_Id` = A.`user_id`
				LEFT JOIN `athlete_user_role` C ON C.`role_id` = B.`user_role`
				WHERE A.`id`='$notes_id' and A.`isDeleted`='0' order by date_time DESC");
		// echo "SELECT A.*, B.user_name, B.profile_image, B.user_role, C.role_name FROM `athlete_notes` A 
		// JOIN `athlete_users` B ON B.`user_Id` = A.`user_id`
		// JOIN `athlete_user_role` C ON C.`role_id` = B.`user_role`
		// WHERE A.`id`='$notes_id' and A.`isDeleted`='0' and A.`status`='0' order by date_time DESC";
		// $sql1 = mysqli_query($con ,"SELECT * FROM `athlete_notes` WHERE `id`='$notes_id' and `isDeleted`='0' order by date_time DESC");
		$num_rec=mysqli_num_rows($sql1);	
		if($num_rec>0){

			if($row=mysqli_fetch_assoc($sql1))
			{ 
				
				$alldata['user_name']=$row['user_name'];
				$alldata['role_name']=$row['role_name'];
				$alldata['user_role']=$row['user_role'];
				$alldata['date_time']=$row['date_time'];
				$alldata['updated_date_time']=$row['updated_date_time'];
				$alldata['user_pic']=PROFILE_IMAGE.$row['profile_image'];


				$alldata['notes_id']=$row['id'];

				$alldata['created_by']=$row['user_id'];
				$alldata['category_id']=$row['category_id'];
				$alldata['category_name']=get_category_name($row['category_id']);
				$alldata['title']=$row['title'];
				$alldata['description']=$row['description'];
				$alldata['status']=$row['status'];




				$sql2 = mysqli_query($con ,"SELECT * FROM `athlete_notes_media` WHERE `notes_id`='$notes_id' and `type`='image' ");
				$im=0;
				$vd=0;
				$doc=0;
				$lnk=0;
				while($row_image=mysqli_fetch_assoc($sql2)){  

					$notes_image[$im]['id']=$row_image['id'];
					$notes_image[$im]['link']=$row_image['link'];
					$im++;

				}

				$sql3 = mysqli_query($con ,"SELECT * FROM `athlete_notes_media` WHERE `notes_id`='$notes_id' and `type`='video' ");

				while($row_video=mysqli_fetch_assoc($sql3)){  

					$notes_video[$vd]['id']=$row_video['id'];
					$notes_video[$vd]['link']=$row_video['link'];					
					$vd++;
				}

				$sql4 = mysqli_query($con ,"SELECT * FROM `athlete_notes_media` WHERE `notes_id`='$notes_id' and `type`='link' ");

				while($row_link=mysqli_fetch_assoc($sql4)){  

					$notes_link[$lnk]['id']=$row_link['id'];
					$notes_link[$lnk]['link']=$row_link['link'];					
					$lnk++;
				}
				$sql5 = mysqli_query($con ,"SELECT * FROM `athlete_notes_media` WHERE `notes_id`='$notes_id' and `type`='document' ");

				while($row_doc=mysqli_fetch_assoc($sql5)){  

					$notes_doc[$doc]['id']=$row_doc['id'];
					$notes_doc[$doc]['link']=$row_doc['link'];					
					$doc++;
				}

				$alldata[notes_images]=$notes_image;
				$alldata[notes_videos]=$notes_video;
				$alldata[notes_documents]=$notes_doc;
				$alldata[notes_links]=$notes_link;


			}
			$empt1 = array("res" => '1', "result" => $alldata);
			echo json_encode($empt1);

		}else{
			$data['success'] = "0";
			$data['message'] = "Data not found.";		
			echo json_encode($data);
		}

	}else{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}

}



function share_notes($req, $con){ 

	$notes_id = $_REQUEST['notes_id'];
	$group_id  = $_REQUEST['group_id'];
	$user_id = $_REQUEST['user_id'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;

	if($notes_id != ''){ 
		$sql1 = mysqli_query($con ,"SELECT * FROM `athlete_notes` WHERE `id`='$notes_id' and `isDeleted`='0' order by date_time DESC");
		$num_rec=mysqli_num_rows($sql1);	

		if($num_rec>0){ 

			if($row=mysqli_fetch_assoc($sql1)){ 
				$creator_id=$row[user_id];
				$notes_title=$row[title];
			}
			if(!empty($_REQUEST['group_id'])) {    

				foreach($group_id as   $value)
				{
					$value=ltrim($value,'[');
					$value=rtrim($value,']');
					$group_ids=explode(",",$value);
					foreach($group_ids as $val){

						$sql2 = mysqli_query($con ,"SELECT * from athlete_chat_group_member where group_id='$val' ");
						while($row2=mysqli_fetch_assoc($sql2)){
							$mem_id=$row2['group_member'];
							$mem_role=get_user_roleid($mem_id);

							if( ( $row2['group_member']!=$creator_id) && ( !in_array($row2['group_member'],$to_member)) && (count($row2['group_member'])>0 )  ){
								$to_member[]=$row2['group_member'];
							}
						}

					}
				}
			}

			if(!empty($_REQUEST['user_id'])&& count($_REQUEST['user_id'])>0) {   

				foreach($user_id as   $value1)
				{
					$value1=ltrim($value1,'[');
					$value1=rtrim($value1,']');
					$user_ids=explode(",",$value1);
					foreach($user_ids as $val1){ 

						$mem_role=get_user_roleid($val1);
						$to_member[]=$val1;

					}
				}
			}

			foreach($to_member as $tomember){ 

				$sql1 = mysqli_query($con ,"SELECT id FROM `athlete_shared_notes` WHERE `notes_id`='$notes_id' and `shared_to`='$tomember' ");
				$num_survey=mysqli_num_rows($sql1);	
				if($num_survey==0){ 


					$survey_share_sql="INSERT into `athlete_shared_notes` (`notes_id`,`shared_by`, `shared_to`, `date_time`) values('$notes_id' ,'$creator_id','$tomember', '$date_time') ";
					$survey_insert = mysqli_query($con , $survey_share_sql);

				}
			}



			error_reporting(-1);
			ini_set('display_errors', 'On');
			require_once __DIR__ . '/firebase.php';
			require_once __DIR__ . '/push.php';
			$firebase = new Firebase();
			$push = new Push();

			$msg = 'notes_shared';
			$request_for = "New Message";

			$chatdata="$notes_title shared with you.";

			$emptTest1 = array("res" => '1', "chat_detail" => $chatdata);
			$message1 = json_encode($emptTest1);

//$payload = array();
			$payload['Msg'] = $message1;
//$payload['score'] = '5.6';
//echo $message11;
			$title = $msg;

			$emptTest = array("res" => '1', "chat_detail" => $chatdata);

			$emptTest11 = array("res" => '1', "chat_detail" => $chatdata);

			$message = json_encode($emptTest11);

			$push_type = "individual";
			$include_image = isset($_REQUEST['include_image']) ? TRUE : FALSE;

			$push->setTitle($title);
			$push->setMessage($message);
			if ($include_image) {
				$push->setImage(DEF_PUSH_ICON);
			} else {
				$push->setImage('');
			}
			$push->setIsBackground(FALSE);
			$push->setPayload($payload);

			$json = '';
			$response = '';

			if ($push_type == 'topic') {
				$json = $push->getPush();
				$response = $firebase->sendToTopic('global', $json);
			} else if ($push_type == 'individual') {
				$json = $push->getPush();
//$regId = isset($_REQUEST['$regId1']) ? $_REQUEST['$regId1'] : '';
				if(!empty($to_member)){ 

					foreach($to_member as $val){ 
						$regId1 = $val;

						$response = $firebase->send($regId1, $json);
					}
				}

			}



			$data['success'] = "1";
			$data['message'] = "Notes Shared successfully"; 
			echo json_encode($data);

		}else{ 
			$data['success'] = "0";
			$data['message'] = "Notes not exist or deleted Notes.";
			echo json_encode($data);



		}



	}else{ 
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}

}



function get_frnd_group_notes($req,$con){ 
	$user_id = $_REQUEST['user_id'];    

	if($user_id != ''){ 
		$status = 2;
		$request_for = "Friend_request";
//echo "SELECT * from `athlete_report_request` WHERE (`request_from`='$user_id' && `status`='$status' && `request_for` = '$request_for') || (`request_to`='$user_id' && `status`='$status' && `request_for` = '$request_for')";
		$res = mysqli_query($con, "SELECT * from `athlete_report_request` WHERE (`request_from`='$user_id' && `status`='$status' && `request_for` = '$request_for') || (`request_to`='$user_id' && `status`='$status' && `request_for` = '$request_for') ");
		$p=0;
		while ($row = mysqli_fetch_assoc($res)){ 
			if ($user_id != $row['request_to']){
				$request_too = $row['request_to'];
			} 
			else if ($user_id != $row['request_from']){
				$request_too = $row['request_from'];
			}

			if( !in_array($request_too,$request_tor) )
				{ $request_tor[$p]=$request_too; }
			$p++;

		}

		foreach($request_tor as $request_to){   


			$res2 = mysqli_query($con, "SELECT * from `athlete_users` WHERE `user_id`='$request_to'");
			if($row4 = mysqli_fetch_assoc($res2)){   
				$data['id'] = $row4['user_id'];
				$data['name'] = $row4['user_name'];
				$data['image'] = PROFILE_IMAGE.$row4['profile_image'];
				$data['type'] = "Friend";
				$data['role']= $row4['user_role'];
				$role=$row4['user_role'];

			}
			$allfrienddata[] = $data;


		}

		$gr_res = mysqli_query($con,"SELECT A.*, B.* from `athlete_chat_group` as A left join `athlete_chat_group_member` as B on A.id=B.group_id where B.`group_member` = '$user_id' and `group_type`='group_chat' ");
		while($in_row = mysqli_fetch_assoc($gr_res)){

			$gr_data['id'] = $in_row['group_id'];; 
			$gr_data['name'] = $in_row['group_name'];
			$gr_data['image'] = $in_row['group_icon'];
			$gr_data['type'] = "Group";

			$allgroupdata[] = $gr_data;
		}

		if(!empty($allfrienddata)  && !empty($allgroupdata)){
			$alldata = array_merge($allfrienddata, $allgroupdata); 
		}
		else if(!empty($allfrienddata)){
			$alldata = $allfrienddata;
		}
		else if(!empty($allgroupdata)){
			$alldata = $allgroupdata;
		}
		if($alldata){ 
			$empt1 = array("res" => '1', "result" => $alldata);
			echo json_encode($empt1);
		} 
		else{
			$empt1 = array("res" => '0', "result" => 'Data not Found');
			echo json_encode($empt1);
		}
	}
	else{
		$empt = array("res" => '0', "result" => 'Please enter all requireds fields');
		echo json_encode($empt); 
	}

}




function delete_notes_category($req, $con){ 

	$cat_id = $_REQUEST['cat_id'];
	$sql1 = mysqli_query($con ,"SELECT `id` FROM `athlete_notes_category` WHERE `id`='$cat_id'");
	$num_rec=mysqli_num_rows($sql1);	
	if($cat_id != '' ){  
		if ($num_rec > 0 &&  $cat_id != 1 ) { 

			$sql2 = mysqli_query($con ,"UPDATE `athlete_notes_category` set `isDeleted`='1' WHERE `id`='$cat_id'");
			if ($sql2){
				$sql3 = mysqli_query($con ,"UPDATE `athlete_notes` set `category_id`='1' WHERE `category_id`='$cat_id'");

				$data['success'] = "1";
				$data['message'] = "Notes deleted successfully.";
				echo json_encode($data);
			}
			else{
				echo "Error deleting record: " . $conn->error;
			} 
		}
		else{
			$data=array("success"=>'0',"message"=>'Not Found');
			echo json_encode($data);
		}

	}else{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}

}


function edit_notes($req, $con){  

	$notes_id=$_REQUEST['notes_id'];
	$edit_category_id=$_REQUEST['edit_category_id'];
	$edit_title=$_REQUEST['edit_title'];
	$edit_description=$_REQUEST['edit_description'];
	$edit_links=$_REQUEST['edit_links'];
	$delete_images=$_REQUEST['delete_images'];
	$delete_videos=$_REQUEST['delete_videos'];
	$delete_documents=$_REQUEST['delete_documents'];
	$delete_links=$_REQUEST['delete_links'];
	$add_documents=$_FILES['add_documents'];
	$add_images=$_FILES['add_images'];
	$add_videos=$_FILES['add_videos'];
	$add_links=$_REQUEST['add_links'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;

	$select_notes_sql="SELECT * from `athlete_notes` where id='$notes_id'";
	$row_notes = mysqli_query($con, $select_notes_sql);
	if (mysqli_num_rows($row_notes) > 0)
	{ 


		$updtsql="UPDATE `athlete_notes` set `category_id`='$edit_category_id',`title`='$edit_title',`description`='$edit_description',`date_time`='$date_time' where `id`='$notes_id'";
		$edit_notes = mysqli_query($con, $updtsql);

		if(!empty($_FILES['add_images'])) { 

			$typed='image';
			foreach($_FILES["add_images"]["tmp_name"] as $key=>$tmp_name)
			{ 
				$target="uploads/notes_media/";
				$type = $_FILES['add_images']['type'][$key];
				$name = $_FILES['add_images']['name'][$key];
				$name1 = str_replace(" ","",$name);
				$new_name = uniqid().basename($name1);
				$new = $target.$new_name;
				$file_url = NOTES_MEDIA.$new_name;
				if(move_uploaded_file($_FILES['add_images']['tmp_name'][$key],$new))
				{
					$add_file = mysqli_query($con, "INSERT INTO `athlete_notes_media`(`notes_id`, `type`,`filename`,`link`) VALUES ('$notes_id','$typed','$new_name','$file_url')");
				}

			}
		}

		if(!empty($_FILES['add_videos'])) {

			$typed='video';
			foreach($_FILES["add_videos"]["tmp_name"] as $key=>$tmp_name)
			{ 
				$target="uploads/notes_media/";
				$type = $_FILES['add_videos']['type'][$key];
				$name = $_FILES['add_videos']['name'][$key];
				$name1 = str_replace(" ","",$name);
				$new_name = uniqid().basename($name1);
				$new = $target.$new_name;
				$file_url = NOTES_MEDIA.$new_name;
				if(move_uploaded_file($_FILES['add_videos']['tmp_name'][$key],$new))
				{
					$add_videofile = mysqli_query($con, "INSERT INTO `athlete_notes_media`(`notes_id`, `type`,`filename`,`link`) VALUES ('$notes_id','$typed','$new_name','$file_url')");
				}

			}
		}


		if(!empty($_FILES['add_documents']))
		{
			$typed='document';

			foreach($_FILES["add_documents"]["tmp_name"] as $key=>$tmp_name){
				$type=$_FILES['add_documents']['type'][$key];
				$allowext = array("doc","docx","pdf","odt","txt");
				$temp = explode(".", $_FILES['add_documents']['name'][$key]);
				$ext = end($temp);

				if(!in_array($ext,$allowext))
				{
					$data['success'] = "0";
					$data['message'] = "Invaild File Format.";
					echo json_encode($data);
				}
				else
				{
					$target="uploads/notes_media/";
					$new_name = uniqid().basename($_FILES['add_documents']['name'][$key]);
					$new = $target.$new_name;
					$file_url = NOTES_MEDIA.$new_name;
					if(move_uploaded_file($_FILES['add_documents']['tmp_name'][$key],$new)){
						$add_docfile = mysqli_query($con, "INSERT INTO `athlete_notes_media`(`notes_id`, `type`,`filename`,`link`) VALUES ('$notes_id','$typed','$new_name','$file_url')");

					}

				}
			}
		}

		if(!empty($_REQUEST['add_links'])) { 
			$typed='link';
			foreach($_REQUEST['add_links'] as $val){

				$add_links = mysqli_query($con, "INSERT INTO `athlete_notes_media`(`notes_id`, `type`,`link`) VALUES ('$notes_id','$typed','$val')");

			}
		}

		if(!empty($_REQUEST['delete_links'])) { 
			foreach($_REQUEST['delete_links'] as $val1){

				$del_links = mysqli_query($con, "DELETE from `athlete_notes_media` where `notes_id`='$notes_id' and `id`='$val1' ");

			}
		}


		if(!empty($_REQUEST['delete_images'])) { 
			foreach($_REQUEST['delete_images'] as $val2){

				$del_images = mysqli_query($con, "DELETE from `athlete_notes_media` where `notes_id`='$notes_id' and `id`='$val2' ");

			}
		}

		if(!empty($_REQUEST['delete_videos'])) { 
			foreach($_REQUEST['delete_videos'] as $val3){

				$del_videos = mysqli_query($con, "DELETE from `athlete_notes_media` where `notes_id`='$notes_id' and `id`='$val3' ");

			}
		}


		if( !empty($_REQUEST['delete_documents']) ) { 
			foreach($_REQUEST['delete_documents'] as $val4){

				$del_documents = mysqli_query($con, "DELETE from `athlete_notes_media` where `notes_id`='$notes_id' and `id`='$val4' ");

			}
		}


		if(!empty($_REQUEST['edit_links'])){ 
			$subject=$_REQUEST['edit_links'];
			foreach($subject as  $key => $value){ 	
				$subN = $key;
				$gradeN = $value;
			}
			$subo=explode(',', $subN);
			$gradeo=explode(',', $gradeN);
			$subject=array_combine($subo, $gradeo);

			foreach($subject as  $key => $value)
			{
				$link_id = $key;
				$link_value = $value;

				$upd_link = mysqli_query($con, "UPDATE  `athlete_notes_media` set `link`='$link_value' where `notes_id`='$notes_id' and `id`='$link_id' ");

			}
		}

		$data['success'] = "1";
		$data['message'] = "Notes Updated successfully.";
		echo json_encode($data);

	}	
	else
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}

}

#################################################################################################

function get_notes_list($req, $con){ 

	$user_id = $_REQUEST['user_id'];


	if($user_id != ''){ 


		$sql1 = mysqli_query($con ,"SELECT notes_id,shared_to FROM `athlete_shared_notes` WHERE `shared_to`='$user_id' and  `isDeleted`='0' ");
		$num_rec1=mysqli_num_rows($sql1);	
		if ($num_rec1>0) {  
			$i=0;
			while($row=mysqli_fetch_assoc($sql1))
			{ 
				$notes_id[]=$row['notes_id'];

			}

		}


		$sql2 = mysqli_query($con ,"SELECT id FROM `athlete_notes` WHERE `user_id`='$user_id' and  `isDeleted`='0' ");
		$num_rec2=mysqli_num_rows($sql2);	
		if ($num_rec2>0) {   
			while($row2=mysqli_fetch_assoc($sql2))
			{ 
				$notes_id[]=$row2['id'];

			}
		}

		if(!empty($notes_id)){ 
			$i=0;
			
			foreach($notes_id as $val){ 
				
				//$sql3 = mysqli_query($con ,"SELECT * FROM `athlete_notes` WHERE `id`='$val' and `isDeleted`='0' and `status`='0'");
				//;
				$sql3 = mysqli_query($con ,"SELECT A.*, B.user_name, B.profile_image, B.user_role, B.user_role FROM `athlete_notes` A 
				JOIN `athlete_users` B ON B.`user_Id` = A.`user_id`
				JOIN `athlete_user_role` C ON C.`role_id` = B.`user_role`
				WHERE A.`id`='$val' and A.`isDeleted`='0' and A.`status`='0'");
				
				if($row3=mysqli_fetch_assoc($sql3))
				{ 
//$notes_id=$row['id'];
					$alldata[$i]['id']=$row3['id'];

					$alldata[$i]['user_name']=$row3['user_name'];
					$alldata[$i]['role_name']=$row3['role_name'];
					$alldata[$i]['user_role']=$row3['user_role'];
					$alldata[$i]['user_pic']=PROFILE_IMAGE.$row3['profile_image'];
					$alldata[$i]['date_time']=$row3['date_time'];
					$alldata[$i]['updated_date_time']=$row3['updated_date_time'];
					$alldata[$i]['notes_id']=$val;
					$alldata[$i]['created_by']=$row3['user_id'];
					$alldata[$i]['category_id']=$row3['category_id'];
					$alldata[$i]['category_name']=get_category_name($row3['category_id']);
					$alldata[$i]['title']=$row3['title'];
					$alldata[$i]['description']=$row3['description'];
					$alldata[$i]['status']=$row3['status'];
					
				}
				
				$sql2 = mysqli_query($con ,"SELECT * FROM `athlete_notes_media` WHERE `notes_id`='$val' and `type`='image' ");
				$im=0;
				$vd=0;
				$doc=0;
				$lnk=0;
				while($row_image=mysqli_fetch_assoc($sql2)){  

					$notes_image[$im]['id']=$row_image['id'];
					$notes_image[$im]['link']=$row_image['link'];
					$im++;

				}

				$sql3 = mysqli_query($con ,"SELECT * FROM `athlete_notes_media` WHERE `notes_id`='$val' and `type`='video' ");

				while($row_video=mysqli_fetch_assoc($sql3)){  

					$notes_video[$vd]['id']=$row_video['id'];
					$notes_video[$vd]['link']=$row_video['link'];					
					$vd++;
				}

				$sql4 = mysqli_query($con ,"SELECT * FROM `athlete_notes_media` WHERE `notes_id`='$val' and `type`='link' ");

				while($row_link=mysqli_fetch_assoc($sql4)){  

					$notes_link[$lnk]['id']=$row_link['id'];
					$notes_link[$lnk]['link']=$row_link['link'];					
					$lnk++;
				}
				$sql5 = mysqli_query($con ,"SELECT * FROM `athlete_notes_media` WHERE `notes_id`='$val' and `type`='document' ");

				while($row_doc=mysqli_fetch_assoc($sql5)){  

					$notes_doc[$doc]['id']=$row_doc['id'];
					$notes_doc[$doc]['link']=$row_doc['link'];					
					$doc++;
				}

				$alldata[$i][notes_images]=$notes_image;
				$alldata[$i][notes_videos]=$notes_video;
				$alldata[$i][notes_documents]=$notes_doc;
				$alldata[$i][notes_links]=$notes_link;

				$i++;
			}
			$data=array("res"=>'1',"result"=>$alldata);
			echo json_encode($data);
		}else{

			$data['success'] = "1";
			$data['message'] = "No Data Found.";
			echo json_encode($data);


		}

	}
	else{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}


}


################################################Nutrition Feed #############################

function add_nutrition_feed($req, $con){ 
	$user_id = $_REQUEST['user_id'];
	$title = $_REQUEST['title'];
	$comment_status = $_REQUEST['comment_status'];
//$share_with = $_REQUEST['share_with'];

//$news_feeds_data = 'https://ctdworld.co/athlete/uploads/news_feeds/';
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;
	if($user_id != '' )
	{
		$target="uploads/nutrition_feed/";
		$new_name = uniqid().basename($_FILES['file']['name']);
		$new = $target.$new_name;
		$file_url = NUTRITION_MEDIA.$new_name;
		if(move_uploaded_file($_FILES['file']['tmp_name'],$new))
		{
			$sql = mysqli_query($con,"insert into `athlete_nutrition_feed`(`user_id`,`title`,`media_url`,`comment_status`,`date_time`)VALUES('$user_id','$title','$file_url','$comment_status','$date_time')");
			$post_id = mysqli_insert_id($con);
		}
		else
		{
			$sql = mysqli_query($con,"insert into `athlete_nutrition_feed`(`user_id`,`title`,`comment_status`,`date_time`)VALUES('$user_id','$title','$comment_status','$date_time')");
			$post_id = mysqli_insert_id($con);

			
		}



		if(!empty($_REQUEST['group_id']))
		{ 
			foreach($_REQUEST['group_id'] as   $value)
			{
				$value=ltrim($value,'[');
				$value=rtrim($value,']');
				$group_ids=explode(",",$value);
				foreach($group_ids as $val){
					$sql2 = mysqli_query($con ,"SELECT * from athlete_chat_group_member where group_id='$val' ");
					while($row2=mysqli_fetch_assoc($sql2)){
						$mem_id=$row2['group_member'];
						$mem_role=get_user_roleid($mem_id);
						if( ( $row2['group_member']!=$user_id) && ( !in_array($row2['group_member'],$to_member)) && (count($row2['group_member'])>0 )  ){
							$to_member[]=$row2['group_member'];
						}
					}
				}
			}
			$res = mysqli_query($con, "Select * from `athlete_nutrition_feed` where `id` = '$post_id'");
			if($row = mysqli_fetch_assoc($res))
			{
				//$user_id = $row['user_id'];
				$title = $row['title'];
				$media_url = $row['media_url'];
				//$post_share_by = $_REQUEST['post_share_by'];
				$share_text = $row['share_text'];
				$comment_status = $row['comment_status'];


				foreach($to_member as $shared_to){
					$sql1 = mysqli_query($con,"insert into `athlete_nutrition_feed`(`user_id`,`title`,`media_url`,`comment_status`,`post_share_by`,`post_share_text`,`date_time`)VALUES('$shared_to','$title','$media_url','$comment_status','$user_id','$share_text','$date_time')");

				}
			}
		}
		if($sql)
		{
			$data['res'] = "1";
			$data['result'] = "Nutrition Feeds Successfully Added and Shared.";
			echo json_encode($data);
		}
	}
	else
	{
		$data['res'] = "0";
		$data['result'] = "Please enter all required fields.";
		echo json_encode($data);
	}


}


###########################################################################

function delete_nutrition($req, $con){ 
	$nutrition_id = $_REQUEST['nutrition_id'];

//$news_feeds_data = 'https://ctdworld.co/athlete/uploads/news_feeds/';
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;
	if($nutrition_id != '' )
	{
			$res = mysqli_query($con, "Select * from `athlete_nutrition_feed` where `id` = '$nutrition_id'");
			if($row = mysqli_fetch_assoc($res))
			{
				//$user_id = $row['user_id'];
				$user_id = $row['user_id'];
				$title = $row['title'];
				$media_url = $row['media_url'];
				$like_count = $row['like_count'];
				$shared_to = $row['shared_to'];
				$comment_status = $row['comment_status'];
				$post_share_by = $row['post_share_by'];
				$post_share_text = $row['post_share_text'];
				//$post_share_by = $_REQUEST['post_share_by'];
				$status = $row['status'];
				$query  = "insert into `athlete_nutrition_feed_delete`(`user_id`,`title`,`media_url`,`comment_status`,`post_share_by`,`post_share_text`,`date_time`)VALUES('$user_id','$title','$media_url','$comment_status','$post_share_by','$post_share_text','$date_time')";

					$sql1 = mysqli_query($con,$query);

			}
			$sql2 = mysqli_query($con, "DELETE from `athlete_nutrition_feed` where `id` = '$nutrition_id'");
		
		if($sql1)
		{
			$data['res'] = "1";
			$data['result'] = "Nutrition Feeds Successfully Deleted.";
			echo json_encode($data);
		}else{
			$data['res'] = "0";
			$data['result'] = "Provide Correct Nutrition ID.";
			echo json_encode($data);

		}
	}
	else
	{
		$data['res'] = "0";
		$data['result'] = "Please enter all required fields.";
		echo json_encode($data);
	}


}
###########################################################################
function share_nutrition_feed($req, $con){ 
	$post_id = $_REQUEST['post_id'];
	$post_share_by = $_REQUEST['post_share_by'];
	$share_text = $_REQUEST['share_text'];
	$group_id = $_REQUEST['group_id'];
	$comment_status = $_REQUEST['comment_status'];
	if($post_share_by != '' && $post_id != '' && !empty($_REQUEST['group_id']))
	{ 
		foreach($group_id as   $value)
		{
			$value=ltrim($value,'[');
			$value=rtrim($value,']');
			$group_ids=explode(",",$value);
			foreach($group_ids as $val){
				$sql2 = mysqli_query($con ,"SELECT * from athlete_chat_group_member where group_id='$val' ");
				while($row2=mysqli_fetch_assoc($sql2)){
					$mem_id=$row2['group_member'];
					$mem_role=get_user_roleid($mem_id);
					if( ( $row2['group_member']!=$post_share_by) && ( !in_array($row2['group_member'],$to_member)) && (count($row2['group_member'])>0 )  ){
						$to_member[]=$row2['group_member'];
					}
				}
			}
		}
		$res = mysqli_query($con, "Select * from `athlete_nutrition_feed` where `id` = '$post_id'");
		if($row = mysqli_fetch_assoc($res))
		{
			$user_id = $row['user_id'];
			$title = $row['title'];
			$media_url = $row['media_url'];

			foreach($to_member as $shared_to){
				$sql = mysqli_query($con,"insert into `athlete_nutrition_feed`(`user_id`,`title`,`media_url`,`comment_status`,`post_share_by`,`post_share_text`,`date_time`)VALUES('$shared_to','$title','$media_url','$comment_status','$post_share_by','$share_text','$date_time')");

			}
			$data['res'] = "1";
			$data['result'] = "Nutrition Feed Successfully Shared.";
			echo json_encode($data);
			

		}
		else
		{

			$data['res'] = "0";
			$data['result'] = "Data Not Found.";
			echo json_encode($data);

		}
	}
	else
	{
		$data['res'] = "0";
		$data['result'] = "Please enter all required fields.";
		echo json_encode($data);
	}

}
################################


function get_frnd_group_nutrition($req,$con){ 
	$user_id = $_REQUEST['user_id'];    
	if($user_id != ''){ 
		
		
		$gr_res = mysqli_query($con,"Select A.*, B.* from `athlete_chat_group` as A left join `athlete_chat_group_member` as B on A.id=B.group_id where B.`group_member` = '$user_id' and `group_type`='group_chat' ");		
		while($in_row = mysqli_fetch_assoc($gr_res)){

			$gr_data['id'] = $in_row['group_id'];; 
			$gr_data['name'] = $in_row['group_name'];
			$gr_data['image'] = $in_row['group_icon'];
			$gr_data['type'] = "Group";

			$allgroupdata[] = $gr_data;
		}

		if(!empty($allgroupdata)){
			$alldata = $allgroupdata;
		}
		if($alldata){ 
			$empt1 = array("res" => '1', "result" => $alldata);
			echo json_encode($empt1);
		} 
		else{
			$empt1 = array("res" => '0', "result" => 'Data not Found');
			echo json_encode($empt1);
		}
	}
	else{
		$empt = array("res" => '0', "result" => 'Please enter all requireds fields');
		echo json_encode($empt); 
	}

}


########################

function edit_nutrition_feed($req, $con){

	$post_id = $_REQUEST['post_id'];
	$title = $_REQUEST['title'];
	$comment_status = $_REQUEST['comment_status'];

	$img_status=$_REQUEST['image_status'];

	if($post_id != '' && $img_status != '')
	{
		if($img_status == 0)
		{
			$sql1=mysqli_query($con, "select * from `athlete_nutrition_feed` where id='$post_id'");
			if ($rows1 = mysqli_fetch_assoc($sql1)) {
				$dt=$rows1['media_url'];
			}

			$sql = mysqli_query($con,"update `athlete_nutrition_feed` set `title` = '$title' ,`media_url` = '$dt', `comment_status` = '$comment_status' where `id` = '$post_id'");
			if($sql)
			{
				$data['res'] = "1";
				$data['result'] = "Nutrition Feed Successfully Updated.";
				echo json_encode($data);
			}
		}
		else if($img_status == 1)
		{
			$target="uploads/nutrition_feed/";
			$new_name = uniqid().basename($_FILES['file']['name']);
			$new = $target.$new_name;
			$file_url = NUTRITION_MEDIA.$new_name;
			if(move_uploaded_file($_FILES['file']['tmp_name'],$new))
			{
				$sql = mysqli_query($con,"update `athlete_nutrition_feed` set `title` = '$title' , `media_url` = '$file_url', `comment_status` = '$comment_status' where `id` = '$post_id'");
				if($sql)
				{
					$data['res'] = "1";
					$data['result'] = "Nutrition Feed Successfully Updated.";
					echo json_encode($data);
				}
			}
		}
		else if($img_status == 2)
		{
			$dt="";
			$sql = mysqli_query($con,"update `athlete_nutrition_feed` set `title` = '$title' ,`media_url` = '$dt', `comment_status` = '$comment_status' where `id` = '$post_id'");
			if($sql)
			{
				$data['res'] = "1";
				$data['result'] = "Nutrition Feed Successfully Updated.";
				echo json_encode($data);
			}
		}


	}
	else
	{
		$data['res'] = "0";
		$data['result'] = "Please enter all required fields.";
		echo json_encode($data);
	}



}


function add_comment_nutrition($req, $con){ 

	$user_id = $_REQUEST['user_id'];
	$post_id = $_REQUEST['post_id'];
	$comment = $_REQUEST['comment'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;

	if($user_id != '' && $post_id != '' && $comment != '')
	{

		$in_check_list = mysqli_query($con,"insert into `athlete_comment_nutrition`(`user_id`,`post_id`,`comment`,`date_time`) values('$user_id','$post_id','$comment','$date_time')");
		if($in_check_list)
		{
			$empt = array("res" => '1', "result" => 'Comment posted Successfully');
			echo json_encode($empt);
		}
		else
		{
			$empt = array("res" => '0', "result" => 'There is some error');
			echo json_encode($empt);
		}

	}
	else
	{
		$empt = array("res" => '0', "result" => 'Please enter all required fields');
		echo json_encode($empt);
	}


}
##########################################################################
function add_like_nutrition($req,$con){

	$user_id = $_REQUEST['user_id'];
	$post_id = $_REQUEST['post_id'];
	$status = $_REQUEST['status'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;

	if($user_id != '' && $post_id != '' && $status != '')
	{
		$check_list = mysqli_query($con, "select * from `athlete_like_nutritionfeed` where `user_id` = '$user_id' && `post_id` = '$post_id'");

		if($row21 = mysqli_fetch_assoc($check_list))
		{
			$up_id = $row21['id'];
			$in_check_list = mysqli_query($con,"update `athlete_like_nutritionfeed` set `user_id` = '$user_id', `post_id` = '$post_id',`status` = '$status', `date_time` = '$date_time' where `id` = '$up_id'");
		}
		else
		{
			$in_check_list = mysqli_query($con,"insert into `athlete_like_nutritionfeed`(`user_id`,`post_id`,`status`,`date_time`) values('$user_id','$post_id','$status','$date_time')");
		}  
		if($in_check_list)
		{
			$empt = array("res" => '1', "result" => 'Like Update');
			echo json_encode($empt);
		}

	}
	else
	{
		$empt = array("res" => '0', "result" => 'Please enter all required fields');
		echo json_encode($empt);
	}


}


############################################################################


function view_comment_nutrition($req, $con){  
	$post_id = $_REQUEST['post_id'];

	if($post_id != '')
	{
		$post_data1 = mysqli_query($con, "select * from `athlete_comment_nutrition` where `post_id` = '$post_id' order by id desc");
		while($row = mysqli_fetch_assoc($post_data1))
		{
			$user_id = $row['user_id'];

			$id_name = mysqli_query($con, "select * from `athlete_users` where `user_id` = '$user_id'");

			if($in_row = mysqli_fetch_assoc($id_name))
			{
				$row['name'] = $in_row['user_name'];
				$row['profile_image'] = PROFILE_IMAGE.$in_row['profile_image'];
			} 
			$post_data[] = $row;



		}
		if($post_data)
		{
			$empt = array("res" => '1', "result" => $post_data);
			echo json_encode($empt);
		}
		else
		{
			$empt = array("res" => '0', "result" => 'Something mistake');
			echo json_encode($empt);
		}

	}
	else
	{
		$empt = array("res" => '0', "result" => 'Please enter all required fields');
		echo json_encode($empt); 
	}


}

###########################################################################################################################################        
function edit_comment_nutrition($req, $con){  

	$user_id = $_REQUEST['user_id'];
	$comment_id = $_REQUEST['comment_id'];
	$post_id = $_REQUEST['post_id'];
	$comment = $_REQUEST['comment'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;

	if($user_id != '' && $post_id != '' && $comment != '' && $comment_id != '')
	{

		$in_check_list = mysqli_query($con,"update `athlete_comment_nutrition` set `user_id` = '$user_id', `post_id` = '$post_id',`comment` = '$comment', `date_time` = '$date_time' where `id` = '$comment_id'");
		if($in_check_list)
		{
			$empt = array("res" => '1', "result" => 'Comment updated Successfully');
			echo json_encode($empt);
		}
		else
		{
			$empt = array("res" => '0', "result" => 'Something mistake');
			echo json_encode($empt);
		}

	}
	else
	{
		$empt = array("res" => '0', "result" => 'Please enter all required fields');
		echo json_encode($empt);
	}

}
###########################################################################################################################################   
function delete_comment_nutrition($req, $con){  

	$comment_id = $_REQUEST['comment_id'];
	if($comment_id != '')
	{
		$in_check_list = mysqli_query($con, "DELETE FROM `athlete_comment_nutrition` where `id` = '$comment_id'");
		if($in_check_list)
		{
			$empt = array("res" => '1', "result" => 'Comment deleted Successfully');
			echo json_encode($empt);
		}
		else
		{
			$empt = array("res" => '0', "result" => 'Something mistake');
			echo json_encode($empt);
		}

	}
	else
	{
		$empt = array("res" => '0', "result" => 'Please enter all required fields');
		echo json_encode($empt);
	}

}


#######################Yet to be completed####################################

function view_nutrition_feed($req, $con){  

	$user_id = $_REQUEST['user_id'];   
	if($user_id != '')
	{
		$sql = mysqli_query($con,"select * from `athlete_nutrition_feed` where `user_id`='$user_id'  ORDER BY `date_time` desc");
		while($row = mysqli_fetch_assoc($sql)) 
		{
			$check_id = $row['user_id'];
			$post_share_by = $row['post_share_by'];

			$comment_status = $row['comment_status'];


			$from_id =  $row['user_id'];

			$id_name = mysqli_query($con, "select * from `athlete_users` where `user_id` = '$from_id'");
			if($in_row = mysqli_fetch_assoc($id_name))
			{
				$row['user_name'] = $in_row['user_name'];
				$row['user_profile_image'] = PROFILE_IMAGE.$in_row['profile_image'];

			}

			$post_share_by = $row['post_share_by'];
			if($post_share_by>0){	

				$id_name = mysqli_query($con, "select * from `athlete_users` where `user_id` = '$post_share_by'");
				if($in_row = mysqli_fetch_assoc($id_name))
				{
					$row['post_share_by'] = $in_row['user_name'];

				} 
			}else{
				$row['post_share_by']="0";

			}
			$post_id = $row['id'];
			$lk = 1;

			$like_check = mysqli_query($con,"select * from `athlete_like_nutritionfeed`  where `post_id` = '$post_id' && `user_id` = '$user_id' && `status`='$lk'");
			if(mysqli_fetch_assoc($like_check))
			{

				$row['like'] = 1;
			}
			else
			{
				$row['like'] = 0;
			}


			$like = mysqli_query($con,"select count(*)  AS `total` from `athlete_like_nutritionfeed` where `post_id` = '$post_id' && `status` = '$lk'");
			if($msg_row = mysqli_fetch_assoc($like))
			{
				$row['like_count'] = $msg_row['total'];
			}

			$comment = mysqli_query($con,"select count(*)  AS `total` from `athlete_comment_nutrition` where `post_id` = '$post_id'");

			if($msg_row1 = mysqli_fetch_assoc($comment))
			{
				$row['comment_count'] = $msg_row1['total'];
			} 
			$data[] = $row;




		}

		if ($data)
		{
			$empt1 = array("res" => '1', "result"=>$data);
			echo json_encode($empt1);
		}
		else 
		{
			$empt1 = array("res" => '0', "result" => 'Data Not Found');
			echo json_encode($empt1);
		}
	}
	else
	{
		$data['res'] = "0";
		$data['result'] = "Please enter all required fields.";
		echo json_encode($data);
	}


}

########################################Training Plans########################################
function create_trainingplan($req, $con)
{
	$user_id=$_REQUEST['user_id'];
	$title=$_REQUEST['title'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;
	if($user_id!='' && $title!='')
	{ 
		$insrtsql="INSERT into `athlete_trainingplan`(`user_id`,`title`,`date_time`) values('$user_id','$title','$date_time') ";
		$add_training = mysqli_query($con, $insrtsql);
		$training_id = mysqli_insert_id($con);
		
		$data['training_id'] = $training_id;
		$data['message'] = "Training Plan created successfully.";
		$empt1 = array("res" => '1', "result"=>$data);
		echo json_encode($empt1);
		
	}	
	else
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}
###########################################################

function edit_trainingplan($req, $con)
{
	$training_plan_id=$_REQUEST['training_plan_id'];
	$title=$_REQUEST['title'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;
	if($training_plan_id!='' && $title!='')
	{ 
		$updsql="UPDATE  `athlete_trainingplan` set `title`='$title' where `id`='$training_plan_id' ";
		$edit_training = mysqli_query($con, $updsql);
		$data['success'] = "1";
		$data['message'] = "Training Plan Updated successfully.";
		echo json_encode($data);
	}	
	else
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}
###########################################################
function share_trainingplan($req,$con){
	$training_plan_id = $_REQUEST['training_plan_id'];
	$group_id  = $_REQUEST['group_id'];
	$user_id = $_REQUEST['user_id'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;
	if($training_plan_id != ''){ 
		$sql1 = mysqli_query($con ,"SELECT * FROM `athlete_trainingplan` WHERE `id`='$training_plan_id' and `isDeleted`='0' order by date_time DESC");
		$num_rec=mysqli_num_rows($sql1);	
		if($num_rec>0){ 
			if($row=mysqli_fetch_assoc($sql1)){ 
				$creator_id=$row[user_id];
				$training_title=$row[title];
			}
			if(!empty($_REQUEST['group_id'])) {    
				foreach($group_id as   $value)
				{
					$value=ltrim($value,'[');
					$value=rtrim($value,']');
					$group_ids=explode(",",$value);
					foreach($group_ids as $val){
						$sql2 = mysqli_query($con ,"SELECT * from athlete_chat_group_member where group_id='$val' ");
						while($row2=mysqli_fetch_assoc($sql2)){
							$mem_id=$row2['group_member'];
							$mem_role=get_user_roleid($mem_id);

							if( ( $row2['group_member']!=$creator_id) && ( !in_array($row2['group_member'],$to_member)) && (count($row2['group_member'])>0 )  ){
								$to_member[]=$row2['group_member'];
							}
						}
					}
				}
			}
			if(!empty($_REQUEST['user_id'])&& count($_REQUEST['user_id'])>0) {   
				foreach($user_id as   $value1)
				{
					$value1=ltrim($value1,'[');
					$value1=rtrim($value1,']');
					$user_ids=explode(",",$value1);
					foreach($user_ids as $val1){ 
						$mem_role=get_user_roleid($val1);
						$to_member[]=$val1;
					}
				}
			}
			foreach($to_member as $tomember){ 
				$sql1 = mysqli_query($con ,"SELECT id FROM `athlete_shared_trainingplan` WHERE `training_plan_id`='$training_plan_id' and `shared_to`='$tomember' ");
				$num_survey=mysqli_num_rows($sql1);	
				if($num_survey==0){ 
					$survey_share_sql="INSERT into `athlete_shared_trainingplan` (`training_plan_id`,`shared_by`, `shared_to`, `date_time`) values('$training_plan_id' ,'$creator_id','$tomember', '$date_time') ";
					$survey_insert = mysqli_query($con , $survey_share_sql);
				}
			}
///////////////////Push Notification//////////////////
			error_reporting(-1);
			ini_set('display_errors', 'On');
			require_once __DIR__ . '/firebase.php';
			require_once __DIR__ . '/push.php';
			$firebase = new Firebase();
			$push = new Push();
			$msg = 'Training_plan_shared';
			$request_for = "New Message";
			$chatdata="$training_title shared with you.";
			$emptTest1 = array("res" => '1', "chat_detail" => $chatdata);
			$message1 = json_encode($emptTest1);
//$payload = array();
			$payload['Msg'] = $message1;
//$payload['score'] = '5.6';
//echo $message11;
			$title = $msg;
			$emptTest = array("res" => '1', "chat_detail" => $chatdata);
			$emptTest11 = array("res" => '1', "chat_detail" => $chatdata);
			$message = json_encode($emptTest11);
			$push_type = "individual";
			$include_image = isset($_REQUEST['include_image']) ? TRUE : FALSE;
			$push->setTitle($title);
			$push->setMessage($message);
			if ($include_image) {
				$push->setImage(DEF_PUSH_ICON);
			} else {
				$push->setImage('');
			}
			$push->setIsBackground(FALSE);
			$push->setPayload($payload);
			$json = '';
			$response = '';
			if ($push_type == 'topic') {
				$json = $push->getPush();
				$response = $firebase->sendToTopic('global', $json);
			} else if ($push_type == 'individual') {
				$json = $push->getPush();
//$regId = isset($_REQUEST['$regId1']) ? $_REQUEST['$regId1'] : '';
				if(!empty($to_member)){ 
					foreach($to_member as $val){ 
						$regId1 = $val;
						$response = $firebase->send($regId1, $json);
					}
				}
			}
			$data['success'] = "1";
			$data['message'] = "Training Plan Shared successfully"; 
			echo json_encode($data);
		}else{ 
			$data['success'] = "0";
			$data['message'] = "Training Plan not exist or deleted Notes.";
			echo json_encode($data);
		}
	}else{ 
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}
###########################################################################
function delete_trainingplan($req, $con){ 
	$training_plan_id = $_REQUEST['training_plan_id'];
	if(!empty($training_plan_id)){ 

		foreach($_REQUEST['training_plan_id'] as   $value)
		{ 
			$value=ltrim($value,'[');
			$value=rtrim($value,']');
			$group_ids=explode(",",$value);
			foreach($group_ids as $val){ 
				//echo "SELECT `id` FROM `athlete_trainingplan` WHERE `id`='$val'";
				$sql1 = mysqli_query($con ,"SELECT `id` FROM `athlete_trainingplan` WHERE `id`='$val'");
				$num_rec=mysqli_num_rows($sql1);	
				if ($num_rec>0) {  
					//echo "<br>---delete from `athlete_trainingplan` WHERE `id`='$val'";
					$sql2 = mysqli_query($con ,"delete from `athlete_trainingplan` WHERE `id`='$val'");
					if ($sql2){
						$sql3 = mysqli_query($con ,"delete from `athlete_training_media` WHERE `training_plan_id`='$val'");
						$sql4 = mysqli_query($con ,"delete from `athlete_shared_trainingplan` WHERE `training_plan_id`='$val'");

					}

				}

			}
		}
		$data['success'] = "1";
		$data['message'] = "Training Plans deleted successfully.";
		echo json_encode($data);


	}else{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}

####################################################################################################
function delete_trainingplan_item($req,$con){ 
	$training_plan_item_id = $_REQUEST['training_plan_item_id'];
	
	if(!empty($training_plan_item_id)){ 
		foreach($_REQUEST['training_plan_item_id'] as   $value)
		{ 
			$value=ltrim($value,'[');
			$value=rtrim($value,']');
			$group_ids=explode(",",$value);
			foreach($group_ids as $val){ 			
			$sql1 = mysqli_query($con ,"SELECT `id` FROM `athlete_training_media` WHERE `id`='$val'");
			$num_rec=mysqli_num_rows($sql1);	
			if ($num_rec>0) { 
				$sql2 = mysqli_query($con ,"DELETE from `athlete_training_media`  WHERE `id`='$val'");

			}

		}
	}
	$data['success'] = "1";
	$data['message'] = "Training Plan Items deleted successfully.";
	echo json_encode($data);	

}else{
	$data['success'] = "0";
	$data['message'] = "Please enter all required fields.";
	echo json_encode($data);
}

}
####################################################################################################
function get_all_trainingplan($req, $con){ 

	$user_id = $_REQUEST['user_id'];


	if($user_id != ''){ 


		$sql1 = mysqli_query($con ,"SELECT training_plan_id,shared_to FROM `athlete_shared_trainingplan` WHERE `shared_to`='$user_id' and  `isDeleted`='0' ");
		$num_rec1=mysqli_num_rows($sql1);	
		if ($num_rec1>0) {  
			$i=0;
			while($row=mysqli_fetch_assoc($sql1))
			{ 
				$training_plan_id[]=$row['training_plan_id'];

			}

		}


		$sql2 = mysqli_query($con ,"SELECT id FROM `athlete_trainingplan` WHERE `user_id`='$user_id' and  `isDeleted`='0' ");
		$num_rec2=mysqli_num_rows($sql2);	
		if ($num_rec2>0) {   
			while($row2=mysqli_fetch_assoc($sql2))
			{ 
				$training_plan_id[]=$row2['id'];

			}
		}

		if(!empty($training_plan_id)){ 
			$i=0;

			foreach($training_plan_id as $val){ 

				$sql3 = mysqli_query($con ,"SELECT * FROM `athlete_trainingplan` WHERE `id`='$val' and `isDeleted`='0' and `status`='0'");

				if($row3=mysqli_fetch_assoc($sql3))
				{ 
//$notes_id=$row['id'];
					$alldata[$i]['training_plan_id']=$row3['id'];

					$alldata[$i]['created_by']=$row3['user_id'];
					$alldata[$i]['title']=$row3['title'];
					$alldata[$i]['status']=$row3['status'];
				}
				$i++;


			}
			$data=array("success"=>'1',"message"=>$alldata);
			echo json_encode($data);
		}else{

			$data['success'] = "1";
			$data['message'] = "No Data Found.";
			echo json_encode($data);


		}

	}
	else{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}


}


#############################################################################
function get_trainingplan_items($req, $con){ 
	$training_plan_id = $_REQUEST['training_plan_id'];

	$res = mysqli_query($con ,"SELECT * FROM `athlete_training_media` WHERE `training_plan_id`='$training_plan_id'");
	if (mysqli_num_rows($res) > 0) { 
		while($row=mysqli_fetch_assoc($res))
		{
			$empt[]=$row;
		}
		$empt1=array("success"=>'1',"message"=>$empt);
		echo json_encode($empt1);
	}else{
		$empt1=array("success"=>'0',"message"=>'Not Found');
		echo json_encode($empt1);
	}
}


################################################################################
function add_training_item($req,$con){ 
	$training_plan_id=$_REQUEST['training_plan_id'];
	$item_title=$_REQUEST['title'];
	$file_type=$_REQUEST['file_type'];
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;
	if($training_plan_id!=''){ 

		$typed=$file_type;
		$target="uploads/training_media/";
		$type = $_FILES['file_path']['type'];
		$name = $_FILES['file_path']['name'];
		$name1 = str_replace(" ","",$name);
		$new_name = uniqid().basename($name1);
		$new = $target.$new_name;
		$file_url = TRAINING_MEDIA.$new_name;
		if(move_uploaded_file($_FILES['file_path']['tmp_name'],$new))
		{
			$add_file = mysqli_query($con, "INSERT INTO `athlete_training_media`(`training_plan_id`,`title`, `type`,`filename`,`link`) VALUES ('$training_plan_id','$item_title','$typed','$new_name','$file_url')");
			$training_plan_item_id=mysqli_insert_id($con);
		}else{

			$add_file = mysqli_query($con, "INSERT INTO `athlete_training_media`(`training_plan_id`,`title`) VALUES ('$training_plan_id','$item_title')");
			$training_plan_item_id=mysqli_insert_id($con);

		}

		if($add_file){
			$data['training_plan_item_id'] = $training_plan_item_id;
			$data['message'] = "Training Plan ITEM added successfully.";
			$empt1=array("success"=>'1',"message"=>$data);
			echo json_encode($empt1);
		}
	}	
	else
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}
###################################################
function edit_training_item($req,$con){  
	$item_id=$_REQUEST['item_id'];
	$item_title=$_REQUEST['title'];
	$youtube_link=$_REQUEST['youtube_link'];
	$file_type=$_REQUEST['file_type'];
	if($item_id!=''){ 
		$typed=$file_type;
		$target="uploads/training_media/";
		$type = $_FILES['file_path']['type'];
		$name = $_FILES['file_path']['name'];
		$name1 = str_replace(" ","",$name);
		$new_name = uniqid().basename($name1);
		$new = $target.$new_name;
		$file_url = TRAINING_MEDIA.$new_name;
		if(move_uploaded_file($_FILES['file_path']['tmp_name'],$new))
		{
			$add_file = mysqli_query($con, "UPDATE  `athlete_training_media` set `title`='$item_title', `youtube_link`='$youtube_link', `type`='$typed',`filename`='$new_name',`link`='$file_url' where `id`='$item_id'");
		}else{

			$add_file = mysqli_query($con, "UPDATE  `athlete_training_media` set `title`='$item_title' where `id`='$item_id'");

		}

		
		$data['success'] = "1";
		$data['message'] = "Training Plan ITEM updated successfully.";
		$data['type'] = $typed;
		$data['file_url'] = $file_url;
		echo json_encode($data);
	}	
	else
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}

################################################################################
// delete_self_review API by ranjeet on 15-04-2019

function delete_self_review($req, $con){
	$delete_self_review_id = $_REQUEST['delete_self_review_id'];
	$delete_self_review_count = count($_REQUEST['delete_self_review_id']);
//$teacher_id = $_REQUEST['teacher_id'];

	if($delete_self_review_id != '')
	{

	  for($i=0;$i<$delete_self_review_count;$i++) 
	  {
    
	$in_check_list = mysqli_query($con, "DELETE FROM `athlete_self_review` where `id` = '$delete_self_review_id[$i]'");
	$in_check_list = mysqli_query($con, "DELETE FROM `athlete_self_review_details` where `review_id` = '$delete_self_review_id[$i]'");
	  }
	if($in_check_list)
	{
		$empt = array("success" => '1', "message" => 'Deleted Self Review Successfully', "postId" =>$delete_self_review_id);
		echo json_encode($empt);
	}
	else
	{
		$empt = array("success" => '0', "message" => 'Something mistake');
		echo json_encode($empt);
	}

	
	}		
	else 
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
	
}

################################################################################
// delete_school_review API by ranjeet on 15-04-2019

function delete_school_review($req, $con){
	$delete_school_review_id = $_REQUEST['delete_school_review_id'];
	$delete_school_review_count = count($_REQUEST['delete_school_review_id']);
//$teacher_id = $_REQUEST['teacher_id'];

	if($delete_school_review_id != '')
	{

	  for($i=0;$i<$delete_school_review_count;$i++) 
	  {
    
	$in_check_list = mysqli_query($con, "DELETE FROM `athlete_school_review` where `id` = '$delete_school_review_id[$i]'");
	$in_check_list = mysqli_query($con, "DELETE FROM `athlete_school_review_details` where `review_id` = '$delete_school_review_id[$i]'");
	  }
	if($in_check_list)
	{
		$empt = array("success" => '1', "message" => 'Deleted School Review Successfully', "postId" =>$delete_school_review_id);
		echo json_encode($empt);
	}
	else
	{
		$empt = array("success" => '0', "message" => 'Something mistake');
		echo json_encode($empt);
	}

	
	}		
	else 
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
	
}


###################################################
function edit_training_plan_new($req,$con){
   
    $trainingplan_id=$_REQUEST['trainingplan_id'];
    $title=$_REQUEST['plan_title'];
    $description=$_REQUEST['plan_description'];   
	$item_id=$_REQUEST['item_id'];
	$item_title=$_REQUEST['title'];
	$youtube_link=$_REQUEST['youtube_link'];
	$file_type=$_REQUEST['file_type'];
	if($item_id!='' && $trainingplan_id!=''){

        $updatesql = mysqli_query($con, "UPDATE  `athlete_trainingplan` set `title`='$title', `description`='$description' where `id`='$trainingplan_id'");		
		
		$typed=$file_type;
		$target="uploads/training_media/";
		$type = $_FILES['file_path']['type'];
		$name = $_FILES['file_path']['name'];
		$name1 = str_replace(" ","",$name);
		$new_name = uniqid().basename($name1);
		$new = $target.$new_name;
		$file_url = TRAINING_MEDIA.$new_name;
		if(move_uploaded_file($_FILES['file_path']['tmp_name'],$new))
		{
			$add_file = mysqli_query($con, "UPDATE  `athlete_training_media` set `title`='$item_title',`youtube_link`='$youtube_link', `type`='$typed',`filename`='$new_name',`link`='$file_url' where `id`='$item_id'");
		}else{

			$add_file = mysqli_query($con, "UPDATE  `athlete_training_media` set `title`='$item_title',`youtube_link`='$youtube_link' where `id`='$item_id'");

		}

		
		$data['success'] = "1";
		$data['message'] = "Training Plan updated successfully.";
		$data['type'] = $typed;
		$data['file_url'] = $file_url;
		echo json_encode($data);
	}	
	else
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}
}

###################################################
/* edit_training_plan_whole API by ranjeet on 03-05-2019 */

function edit_training_plan_whole($req,$con){
   
    $trainingplan_id=$_REQUEST['trainingplan_id'];
    $title=$_REQUEST['edit_plan_title'];
    $description=$_REQUEST['edit_plan_description'];   
	$item_id_count=count($_REQUEST['edit_item_id']);

	if($trainingplan_id!=''){

 		if($_REQUEST['edit_plan_title']!='' || $_REQUEST['edit_plan_description']!='')
		{
        $updatesql = mysqli_query($con, "UPDATE  `athlete_trainingplan` set `title`='$title', `description`='$description' where `id`='$trainingplan_id'");		
		}
		else
		{
			echo " ";
		}
	    
		  if($_REQUEST['edit_item_id']!='')
		{
		for($i=0;$i<$item_id_count;$i++) 
		{
		$item_id=$_REQUEST['edit_item_id'];
		$item_title=$_REQUEST['edit_item_title'][$i];		
		$item_youtube_link=$_REQUEST['edit_youtube_link'][$i];		
	    $file_type=$_REQUEST['edit_file_type'][$i];
		$typed=$file_type;
		$target="uploads/training_media/";
		$type = $_FILES['edit_file_path']['type'][$i];
		$name = $_FILES['edit_file_path']['name'][$i];
		$name1 = str_replace(" ","",$name);
		$new_name = uniqid().basename($name1);
		$new = $target.$new_name;
		$file_url = TRAINING_MEDIA.$new_name;
		if(move_uploaded_file($_FILES['edit_file_path']['tmp_name'][$i],$new))
		{
			$add_file = mysqli_query($con, "UPDATE  `athlete_training_media` set `title`='$item_title',`youtube_link`='$item_youtube_link',`type`='$typed',`filename`='$new_name',`link`='$file_url' where `id`='$item_id[$i]'");
		}else
		{

			$add_file = mysqli_query($con, "UPDATE  `athlete_training_media` set `title`='$item_title',`youtube_link`='$item_youtube_link' where `id`='$item_id[$i]'");

		}
		    }
			
	  }

		else
		{
			echo " ";
		}
		
		if($_REQUEST['delete_item_id']!='')
		{
		$rowCount = count($_REQUEST["delete_item_id"]);
        for($i=0;$i<$rowCount;$i++) 
		{
            $delete_item_id=$_REQUEST['delete_item_id'];
            
            	mysqli_query($con, "DELETE FROM `athlete_training_media` where `id` = '$delete_item_id[$i]'");
        }
		}
		else
		{
			echo " ";
		}
	    
		if($_REQUEST['add_item_title']!='')
		{
	   $numofmedia=count($_REQUEST['add_item_title']);
	   	for($i=0;$i<$numofmedia;$i++){
		//echo "--".$i;
		$itemtitle=$_REQUEST['add_item_title'][$i];
		$add_youtube_link=$_REQUEST['add_youtube_link'][$i];
		$item_mediatype=$_REQUEST['add_mediatype'][$i];
		$training_planid=$trainingplan_id;

		if($_FILES['add_mediafile']['size'][$i] > 0){
			/*$chat_data = 'https://ctdworld.co/athlete/uploads/chat_data/';*/
			//$target="uploads/chat_data/";
			$type = $_FILES['add_mediafile']['type'][$i];
			$name = $_FILES['add_mediafile']['name'][$i];
			$name1 = str_replace(" ","",$name);
			$new_name = uniqid()."_".basename($name1);
			$new = $new_name;
			$file_url = UPLOAD_DIR.$new_name;
			$newfile_url = "https://ctdworld.co/athlete/".UPLOAD_DIR.$new_name;
			move_uploaded_file($_FILES['add_mediafile']['tmp_name'][$i],$file_url);			
		}
		$iteminsrtsql="INSERT into athlete_training_media (training_plan_id ,title ,youtube_link,type,filename,link) values('$training_planid','$itemtitle','$add_youtube_link','$item_mediatype','$new','$newfile_url') ";
		$add_trainingitem = mysqli_query($con, $iteminsrtsql);
	}
		}else
		{
			echo " ";
		}
	if($trainingplan_id!='')
	{
$res_gettraining=mysqli_query($con,"SELECT * from `athlete_trainingplan`  where id='$trainingplan_id' ");
$row=mysqli_fetch_assoc($res_gettraining);
        $empt['training_plan_id']=$row['id']; 
		$empt['title']=$row['title'];
		$empt['description']=$row['description'];
		$empt['created_by']=$row['user_id'];
		//print_r($empt);
	$getitemssql="select * from athlete_training_media where training_plan_id='".$row['id']."'";
	$res_gettrainingitems = mysqli_query($con, $getitemssql);
		
		//$rescountm=mysqli_query($con,"SELECT * FROM `athlete_training_media` where training_plan_id='$user_id' ORDER BY `athlete_training_media`.`training_plan_id` ASC");
		$j=0;
		while($rowitems=mysqli_fetch_assoc($res_gettrainingitems)){
			$newitems[$j]['item_id']=$rowitems['id'];
			$newitems[$j]['title']=$rowitems['title'];
			$newitems[$j]['youtube_link']=$rowitems['youtube_link'];
			$newitems[$j]['media_url']=$rowitems['link'];
			$newitems[$j]['media_type']=$rowitems['type'];
			$j++;
		}
		//print_r($newitems);
		$empt['items_list']=$newitems;
		
	$empt1 = array("res"=>'success',"response"=>array($empt));
	echo json_encode($empt1);
	}else
	{
	$empt1 = array("res"=>'success',"response"=>'something mistek');
	echo json_encode($empt1);	
	}
	}	
	else
	{
	$empt1 = array("res"=>'success',"response"=>"Please enter all required fields.");
	echo json_encode($empt1);
	}
}

################################################################################

/* edit_self_review API by ranjeet on 31-05-2019 */

function edit_self_review($req, $con){
	$user_id = $_REQUEST['user_id'];
	$review_id = $_REQUEST['review_id'];

	$strengths = $_REQUEST['strengths']; 
	$improvements_needed = $_REQUEST['improvements_needed']; 
	$suggestions = $_REQUEST['suggestions'];
	$assistance_requested = $_REQUEST['assistance_requested'];



	if($user_id != ''  && $review_id != '')
	{		
		 if($_REQUEST['comments']!='')
		{
		 $comments = $_REQUEST['comments'];
		 $label = $_REQUEST['label'];
		$updatesql1 = mysqli_query($con, "UPDATE  `athlete_self_review` set 
		`comments`='$comments', 
		`label`='$label',
		`strengths` = '$strengths',
		`improvements_needed` = '$improvements_needed',
		`suggestions` = '$suggestions',
		`assistance_requested` = '$assistance_requested'
		where `id`='$review_id'"
		);		

		}else{
			echo " ";
		}
		
		if($_REQUEST['add_subject']!='')
		{
	   $count_add_subject=count($_REQUEST['add_subject']);
	   	for($i=0;$i<$count_add_subject;$i++){
		$add_subject=$_REQUEST['add_subject'][$i];
		$add_grade=$_REQUEST['add_grade'][$i];
			
	   $res=mysqli_query($con,"INSERT INTO `athlete_self_review_details` (`review_id`, `subject`,`grade`) 
				VALUES('$review_id','$add_subject','$add_grade')");
	   }
		}else
		{
			echo " ";
		}
		   if($_REQUEST['edit_subject_id']!='')
		{
		 $edit_subject_id_count=count($_REQUEST['edit_subject_id']);
		for($i=0;$i<$edit_subject_id_count;$i++) 
		{
		$edit_subject_id=$_REQUEST['edit_subject_id'];
		$sub=$_REQUEST['edit_subject'][$i];		
		$grade=$_REQUEST['edit_subject'][$i];		

			$updatesql2 = mysqli_query($con, "UPDATE  `athlete_self_review_details` set `subject`='$sub', `grade`='$grade' where `id`='$edit_subject_id[$i]'");
       }
			
	    }else
		{
			echo " ";
		}
             if($updatesql2)
			{
				$data['success'] = "1";
				$data['message'] = "Self Review Updated Successfully";
			}
			else
			{
				$data['success'] = "0";
				$data['message'] = "There is some error";
			} 
	}
	else 
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
	}
	echo json_encode($data);
}

################################################################################

/* edit_school_review  API Done by ranjeet on 06-06-2019 */

function edit_school_review($req, $con){
	$user_id = $_REQUEST['user_id'];
	$review_id = $_REQUEST['review_id'];

	$strengths = $_REQUEST['strengths']; 
	$improvements_needed = $_REQUEST['improvements_needed']; 
	$suggestions = $_REQUEST['suggestions'];
	$assistance_requested = $_REQUEST['assistance_requested'];
	$qualification = $_REQUEST['qualification'];

	if($user_id != ''  && $review_id != '')
	{		
		 if($_REQUEST['comments']!='')
		{
		 $comments = $_REQUEST['comments'];
		$updatesql1 = mysqli_query($con, "UPDATE  `athlete_school_review` set 
		`comments`='$comments', 
		`strengths`='$strengths',
		`improvements_needed`='$improvements_needed',
		`suggestions`='$suggestions',
		`assistance_requested`='$assistance_requested' ,
		`qualification` = '$qualification'	
		where `id`='$review_id'");		
		}else{
			echo " ";
		}
		
		if($_REQUEST['add_subject']!='')
		{
	   $count_add_subject=count($_REQUEST['add_subject']);
	   	for($i=0;$i<$count_add_subject;$i++){
		$add_subject=$_REQUEST['add_subject'][$i];
		$add_grade=$_REQUEST['add_grade'][$i];
			
	   $res=mysqli_query($con,"INSERT INTO `athlete_school_review_details` (`review_id`, `subject`,`grade`) 
				VALUES('$review_id','$add_subject','$add_grade')");
	   }
		}else
		{
			echo " ";
		}
		   if($_REQUEST['edit_subject_id']!='')
		{
		 $edit_subject_id_count=count($_REQUEST['edit_subject_id']);
		for($i=0;$i<$edit_subject_id_count;$i++) 
		{
		$edit_subject_id=$_REQUEST['edit_subject_id'];
		$sub=$_REQUEST['edit_subject'][$i];		
		$grade=$_REQUEST['edit_grade'][$i];		

			$updatesql2 = mysqli_query($con, "UPDATE  `athlete_school_review_details` set `subject`='$sub', `grade`='$grade' where `id`='$edit_subject_id[$i]'");
       }
			
	    }else
		{
			echo " ";
		}
             if($updatesql2)
			{
				$data['success'] = "1";
				$data['message'] = "School Review Updated Successfully";
			}
			else
			{
				$data['success'] = "0";
				$data['message'] = "There is some error";
			} 
	}
	else 
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
	}
	echo json_encode($data);
}

###################################################
/* delete_coach_feedback API by ranjeet on 12-06-2019 */

function  delete_coach_feedback($req, $con){   

$delete_coach_feedback_id = $_REQUEST['delete_coach_feedback_id'];
$role_id=$_REQUEST['role_id'];

$res = mysqli_query($con,"SELECT * FROM `athlete_user_role` WHERE `role_id`='$role_id'");

while($row=mysqli_fetch_assoc($res))
{
	$role_type=$row['role_name'];
}
if($delete_coach_feedback_id != '')
{
	for($i=0;$i<count($delete_coach_feedback_id);$i++){
	 if($role_type=="Coach"){
    $in_check_list = mysqli_query($con, "UPDATE  `athlete_coach_feedback` set `coach_status`='0' where `id`='$delete_coach_feedback_id[$i]'");
	// $in_check_list = mysqli_query($con, "DELETE FROM `athlete_coach_feedback` where `id` = '$delete_coach_feedback_id[$i]'");
		}else{
	$in_check_list = mysqli_query($con, "UPDATE  `athlete_coach_feedback` set `athlete_status`='0' where `id`='$delete_coach_feedback_id[$i]'");
	//$sql2 = mysqli_query($con,"SELECT A.*, B.* FROM `athlete_coach_feedback` as A left join `athlete_users` as B on A.coach_id= B.user_id WHERE A.athlete_id='$user_id' && A.athlete_status='1' ORDER BY A.coach_id , A.`date_time` DESC") ;
	}
	}
	if($in_check_list)
	{
		$empt = array("success" => '1', "message" => 'Deleted Coach Feedback Successfully', "postId" =>$delete_coach_feedback_id);
		echo json_encode($empt);
	}
	else
	{
		$empt = array("success" => '0', "message" => 'Something mistake');
		echo json_encode($empt);
	}

}
else
{
	$empt = array("success" => '0', "message" => 'Please enter all required fields');
	echo json_encode($empt);
}

}

###################################################
/* edit_coach_feedback API by ranjeet on 15-06-2019 */

function  edit_coach_feedback($req, $con){   
	$coach_id = $_REQUEST['coach_id'];
	$athlete_id = $_REQUEST['athlete_id'];
	$event = $_REQUEST['event'];
	$strenths = $_REQUEST['strenths'];
	$workons = $_REQUEST['workons'];
	$coach_feedback_id = $_REQUEST['coach_feedback_id'];
	
	$improvement_needed = $_REQUEST['improvement_needed'];
	$suggestions = $_REQUEST['suggestions'];
	$assistance_requested = $_REQUEST['assistance_requested'];
	$assistance_offered = $_REQUEST['assistance_offered'];

	$cur_year=date("Y");
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;
	if($coach_id != '' && $athlete_id != '' && $event != '' && $strenths != '' && $workons != '')
	{ 


//$count=get_coach_feedback_count($coach_id,$athlete_id);

//if($count==0){

		$sql = mysqli_query($con,"Select * from `athlete_users` where `user_id` = '$coach_id' and `user_role` = 1");
		if($row2 = mysqli_fetch_assoc($sql))
		{
			$sql1 = mysqli_query($con, "UPDATE  `athlete_coach_feedback` set `event`='$event', `strenths`='$strenths', `workons`='$workons', `improvement_needed`='$improvement_needed', `suggestions`='$suggestions', `assistance_requested`='$assistance_requested', `assistance_offered`='$assistance_offered' where `id`='$coach_feedback_id'");
			if($sql1)
			{
				$data['success'] = "1";
				$data['message'] = "Data Successfully Updated.";
				echo json_encode($data);
			}
		}
		else
		{
			$data['success'] = "0";
			$data['message'] = "You are not visible for Feedback.";
			echo json_encode($data);  
		}

/*}else{

$data['success'] = "0";
$data['message'] = "You have already submitted the Feedback for this athlete.";
echo json_encode($data);  
}
*/

}
else
{
	$data['success'] = "0";
	$data['message'] = "Please enter all required fields.";
	echo json_encode($data);
}

}

###################################################
/* get_all_survey_new API by ranjeet on 24-06-2019 */

function get_all_survey_new($req,$con){  
	$user_id=$_REQUEST['user_id'];
	if($user_id != '')  
	{ 
		
		$sql1 = mysqli_query($con ,"SELECT * FROM `athlete_survey` WHERE `user_id`='$user_id' and `isDeleted`='0' order by date_time DESC");
		$num_rec=mysqli_num_rows($sql1);	

		// if ($num_rec>0) { 
			$i=0;

			while($row=mysqli_fetch_assoc($sql1))
			{ 

				$survey_id=$row['id'];
				$alldata[$i]['id']=$row['id'];
				$alldata[$i]['user_id']=$row['user_id'];

				$alldata[$i]['title']=$row['title'];
				$alldata[$i]['description']=$row['description'];
				$alldata[$i]['question_type']=$row['question_type'];
				$alldata[$i]['question_no']=$row['question_no'];
				$alldata[$i]['hit_count']=$row['hit_count'];
				$alldata[$i]['status']=$row['status'];
				$alldata[$i]['show_anonymous']=$row['show_anonymous'];

				$alldata[$i]['date_time']=$row['date_time'];

				$sql2 = mysqli_query($con ,"SELECT * FROM `athlete_survey_details` WHERE `survey_id`='$survey_id' and `isDeleted`='0' ");
				$num_rec=mysqli_num_rows($sql2);
				$j=0;

				while($rowdetails=mysqli_fetch_assoc($sql2))
				{

					$review_sys[$j]['question_id'] = $rowdetails['question_id'];
					$review_sys[$j]['survey_question'] = $rowdetails['survey_question'];
					$review_sys[$j]['survey_image'] = $rowdetails['survey_image'];	 				
					$j++;
				}

				$alldata[$i]['Survey'] = $review_sys;
				unset($review_sys);
				$i++;

			}
			   $all_survey['Survey_free_responce_data']=$alldata;
			   
			   if($all_survey['Survey_free_responce_data']!=""){
				   $all_survey['Survey_free_responce_data']=$alldata;
			   }else{
				   $all_survey['Survey_free_responce_data']=[];
			   }
			   
	    $sql_r2 = mysqli_query($con ,"SELECT * FROM `athlete_survey_yes_no` WHERE `user_id`='$user_id' and `isDeleted`='0' order by id DESC");
		$num_rec=mysqli_num_rows($sql_r2); 
		    $i=0;
			 while($row=mysqli_fetch_assoc($sql_r2))
			{ 

				$survey_yes_no_id=$row['id'];
				$alldata_yes_no[$i]['id']=$row['id'];
				$alldata_yes_no[$i]['user_id']=$row['user_id'];

				$alldata_yes_no[$i]['title']=$row['title'];
				$alldata_yes_no[$i]['description']=$row['description'];
				$alldata_yes_no[$i]['date_time']=$row['date_time'];

				$sql_r3 = mysqli_query($con ,"SELECT * FROM `athlete_survey_yes_no_media` WHERE `survey_id`='$survey_yes_no_id' order by id ASC ");
				$num_rec=mysqli_num_rows($sql_r3);
				$j=0;

				while($rowdetails=mysqli_fetch_assoc($sql_r3))
				{

					$review_sys[$j]['question_id'] = $rowdetails['id'];
					$review_sys[$j]['survey_question'] = $rowdetails['add_question'];					
					$review_sys[$j]['survey_question'] = $rowdetails['add_question'];
					$review_sys[$j]['survey_image'] = $rowdetails['survey_image'];						
					$question_type = $rowdetails['question_type'];					
					$review_sys[$j]['filename'] = $rowdetails['filename'];					
					$review_sys[$j]['link'] = $rowdetails['link'];					
					$j++;
				}
				
				
				$alldata_yes_no[$i]['question_type'] = $question_type;
				$alldata_yes_no[$i]['question_no']="1";
				$alldata_yes_no[$i]['hit_count']="0";
				$alldata_yes_no[$i]['status']="0";
				$alldata_yes_no[$i]['show_anonymous']="1";

				$alldata_yes_no[$i]['Survey_yes_no'] = $review_sys;
				unset($review_sys);
				$i++;

			}
			 $all_survey['Survey_yes_no_data']=$alldata_yes_no;
			  
			  if($all_survey['Survey_yes_no_data']!=""){
				   $all_survey['Survey_yes_no_data']=$alldata_yes_no;
			   }else{
				   $all_survey['Survey_yes_no_data']=[];
			   }
			 
		$sql_r3 = mysqli_query($con ,"SELECT * FROM `athlete_survey_multiple` WHERE `user_id`='$user_id' and `isDeleted`='0' order by id DESC");
		$num_rec=mysqli_num_rows($sql_r3); 
		    $i=0;
			 while($row=mysqli_fetch_assoc($sql_r3))
			{ 

				$survey_multiple_id=$row['id'];
				$alldata_multiple[$i]['id']=$row['id'];
				$alldata_multiple[$i]['user_id']=$row['user_id'];

				$alldata_multiple[$i]['title']=$row['title'];
				$alldata_multiple[$i]['description']=$row['description'];
				$alldata_multiple[$i]['date_time']=$row['date_time'];

				$sql_r4 = mysqli_query($con ,"SELECT * FROM `athlete_survey_media` WHERE `survey_id`='$survey_multiple_id' ORDER BY id ASC ");
				$num_rec=mysqli_num_rows($sql_r4);
				$j=0;

				while($rowdetails=mysqli_fetch_assoc($sql_r4))
				{

					$review_sys[$j]['question_id'] = $rowdetails['id'];
					$review_sys[$j]['survey_question'] = $rowdetails['question_title'];					
				    $question_type = $rowdetails['question_type'];					
					$review_sys[$j]['question_option'] = json_decode($rowdetails['question_option'], true);					
					$review_sys[$j]['filename'] = $rowdetails['filename'];					
					$review_sys[$j]['link'] = $rowdetails['link'];					
					$j++;
				}
                 					
				$alldata_multiple[$i]['question_type'] = $question_type;
				$alldata_multiple[$i]['question_no']="1";
				$alldata_multiple[$i]['hit_count']="0";
				$alldata_multiple[$i]['status']="0";
				$alldata_multiple[$i]['show_anonymous']="1";
				
				$alldata_multiple[$i]['Survey_multiple'] = $review_sys;
				unset($review_sys);
				unset($review_sys[$j]['question_type']);
				$i++;

			}
			 $all_survey['Survey_multiple_data']=$alldata_multiple;
			 
			 	if($all_survey['Survey_multiple_data']!=""){
				$all_survey['Survey_multiple_data']=$alldata_multiple;
			   }else{
				   $all_survey['Survey_multiple_data']=[];
			   }

		// }

		if(!empty($all_survey))
		{
			$data=array("success"=>'1',"message"=>$all_survey);
			echo json_encode($data);
		}
		else
		{
			$data=array("success"=>'0',"message"=>'Not Found');
			echo json_encode($data);
		}
	}
	else
	{
		$data = array("res" => '0', "result" => 'Please enter all required fields');
		echo json_encode($data);
	}
}

function match_self_review($req, $con)
{
	$user_id = $_REQUEST['user_id'];
	
	$eventMatch = $_REQUEST['event_match'];
	$strengths = $_REQUEST['strengths']; 
	$improvements_needed = $_REQUEST['improvements_needed'];
	$suggestions = $_REQUEST['suggestions']; 
	$assistance_requested = $_REQUEST['assistance_requested'];
	
	$cur_year=date("Y");
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;

	if($eventMatch == "" || $strengths == "" || $improvements_needed =="" || $suggestions == "" || $assistance_requested == "") 
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";

		echo json_encode($data); exit(0);
	}

	$res=mysqli_query($con,"INSERT INTO `athlete_match_self_review` 
				(`athlete_id`, `event_match`,`strength`, `improvement_needed`, `suggestion`, `assistance_requested`, `created_at`, `updated_at`) 
				VALUES('$user_id','$eventMatch','$strengths', '$improvements_needed', '$suggestions', '$assistance_requested', '$date_time', '$date_time')");
	if($res)
	{
		$data['success'] = "1";
		$data['message'] = "Self Review Added Successfully";
	}
	else
	{
		$data['success'] = "0";
		$data['message'] = "There is some error";
	} 

	echo json_encode($data); exit(0);
}

function get_match_self_review_description($req, $con)
{
	$reviewId = $_REQUEST['review_id'];

	$res=mysqli_query($con,"SELECT A.*, B.user_name, B.profile_image FROM `athlete_match_self_review` A 
	JOIN `athlete_users` B on A.`athlete_id` = B.`user_id`	
	WHERE A.`id` = $reviewId");
	// echo "SELECT A.*, B.user_name, B.profile_image FROM `athlete_match_self_review` A 
	// JOIN `athlete_users` B on A.`athlete_id` = B.`user_id`	
	// WHERE A.`id` = $reviewId"; die;
	$alldata = array();
	while($row = mysqli_fetch_array($res)) 
	{
		$output = array();

		$output['id'] = $row['id'];
		$output['athlete_id'] = $row['athlete_id'];
		$output['user_name'] = $row['user_name'];
		$output['profile_image'] = $row['profile_image'];
		$output['event_match'] = $row['event_match'];
		$output['strength'] = $row['strength'];
		$output['improvement_needed'] = $row['improvement_needed'];
		$output['suggestion'] = $row['suggestion'];
		$output['assistance_requested'] = $row['assistance_requested'];
		$output['created_at'] = $row['created_at'];
		$output['updated_at'] = $row['updated_at'];

		$alldata = $output;
	}
	if ($alldata) 
	{
		$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
		echo json_encode($empt1);
	} 
	else
	{
		$empt1 = array("res" => '0', "message" => 'Data Not Found');
		echo json_encode($empt1);
	}
	
	
}

function edit_match_self_review($req, $con)
{
	$reviewId = $_REQUEST['review_id'];
	
	$eventMatch = $_REQUEST['event_match'];
	$strengths = $_REQUEST['strengths']; 
	$improvements_needed = $_REQUEST['improvements_needed'];
	$suggestions = $_REQUEST['suggestions']; 
	$assistance_requested = $_REQUEST['assistance_requested'];
	
	$cur_year=date("Y");
	$cur_date = date("y-m-d");
	$cur_time = date('H:i:s');
	$date_time = $cur_date." ".$cur_time;

	if($eventMatch == "" || $strengths == "" || $improvements_needed =="" || $suggestions == "" || $assistance_requested == "") 
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";

		echo json_encode($data); exit(0);
	}
		
	$res=mysqli_query($con,"UPDATE `athlete_match_self_review` SET 									 
				`event_match` = '$eventMatch',
				`strength` = '$strengths', 
				`improvement_needed` = '$improvements_needed', 
				`suggestion` = '$suggestions', 
				`assistance_requested` = '$assistance_requested', 
				`updated_at` = '$date_time' WHERE `id` = '$reviewId'");

	if($res)
	{
		$data['success'] = "1";
		$data['message'] = "Self Review Updated Successfully";
	}
	else
	{
		$data['success'] = "0";
		$data['message'] = "There is some error";
	} 

	echo json_encode($data); exit(0);
}

function delete_match_self_review($req, $con)
{
	$reviewId = $_REQUEST['review_id'];
	$userId = $_REQUEST['user_id'];

	$res = mysqli_query($con,"delete from `athlete_match_self_review` where  `id` = '$reviewId' and `athlete_id`='$userId'");
	
	if($res)
	{
		$empt = array("res" => '1', "result" => 'Match review Removed Successfully');
		echo json_encode($empt);
	}
	else
	{
		$empt = array("res" => '0', "result" => 'Something mistake');
		echo json_encode($empt);
	}
}



function get_match_self_review($req, $con)
{
	$user_id = $_REQUEST['user_id'];
	
	$res=mysqli_query($con,"SELECT * FROM `athlete_match_self_review` WHERE `athlete_id` = $user_id");
	
	$alldata = array();
	while($row = mysqli_fetch_array($res)) 
	{
		$output = array();

		$output['id'] = $row['id'];
		$output['athlete_id'] = $row['athlete_id'];
		$output['event_match'] = $row['event_match'];
		$output['strength'] = $row['strength'];
		$output['improvement_needed'] = $row['improvement_needed'];
		$output['suggestion'] = $row['suggestion'];
		$output['assistance_requested'] = $row['assistance_requested'];
		$output['created_at'] = $row['created_at'];
		$output['updated_at'] = $row['updated_at'];

		$alldata[] = $output;
	}
	if ($alldata) 
	{
		$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
		echo json_encode($empt1);
	} 
	else
	{
		$empt1 = array("res" => '0', "message" => 'Data Not Found');
		echo json_encode($empt1);
	}
	
	echo json_encode($data); exit(0);
}



function get_self_match_feedback($req, $con)
{

	$user_id = $_REQUEST['user_id'];
	$role=get_user_roleid($user_id);
	
	if($user_id != '')
	{    				
		$sql3 = mysqli_query($con,"SELECT A.*, B.* FROM `athlete_match_self_review` as A left join `athlete_users` as B on A.athlete_id= B.user_id group by B.user_id ORDER BY A.athlete_id , A.`created_at` DESC");
		while ($row = mysqli_fetch_assoc($sql3)) 
		{
			$athlete_id = $row['user_id'];
			$d = "Coach_feedback";
			
			/*
			$res2 = mysqli_query($con,"SELECT * from `athlete_report_request` WHERE request_for='$d' and request_from='$user_id' and request_to='$athlete_id' and status=2");
			$res3 = mysqli_query($con,"SELECT * from `athlete_report_request` WHERE request_for='$d' and request_from='$user_id' and request_to='$athlete_id' and status=1");

			if($row2 = mysqli_fetch_assoc($res2))
			{
				$row['show_report_status'] = 2;
			}
			else if($row3 = mysqli_fetch_assoc($res3))
			{
				$row['show_report_status'] = 1;
			}
			else
			{
				$row['show_report_status'] = 0;
			}
			*/

			$res3 = mysqli_query($con,"SELECT * from `athlete_report_request` WHERE request_for='$d' and request_from='$user_id' and request_to='$athlete_id'");
			$row['show_report_status'] = "0";
			if($row2 = mysqli_fetch_assoc($res3))
			{
				$status = $row2['status'];

				if($status == 2) $status = 0;

				$row['show_report_status'] = $status;
			}

			$alldata[] = $row;
		}
		if ($alldata) {
			$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
			echo json_encode($empt1);
		} else {
			$empt1 = array("res" => '0', "message" => 'Data Not Found');
			echo json_encode($empt1);
		}  
		
	}
	else
	{
		$data['success'] = "0";
		$data['message'] = "Please enter all required fields.";
		echo json_encode($data);
	}




	// $user_id = $_REQUEST['user_id'];
	
	// // $res=mysqli_query($con,"SELECT * FROM `athlete_match_self_review` WHERE `athlete_id` = '$user_id'");
	// //$res=mysqli_query($con,"SELECT * FROM `athlete_match_self_review`");
	// $res=mysqli_query($con,"SELECT A.*, B.user_name, B.profile_image FROM `athlete_match_self_review` A 
	// JOIN `athlete_users` B on A.`athlete_id` = B.`user_id`");

	// $alldata = array();
	// while($row = mysqli_fetch_array($res)) 
	// {
	// 	$output = array();

	// 	$output['id'] = $row['id'];
	// 	$output['user_name'] = $row['user_name'];
	// 	$output['profile_image'] = $row['profile_image'];
	// 	// $output['event_match'] = $row['event_match'];
	// 	// $output['strength'] = $row['strength'];
	// 	// $output['improvement_needed'] = $row['improvement_needed'];
	// 	// $output['suggestion'] = $row['suggestion'];
	// 	// $output['assistance_requested'] = $row['assistance_requested'];
	// 	// $output['created_at'] = $row['created_at'];
	// 	// $output['updated_at'] = $row['updated_at'];

	// 	$alldata[] = $output;
	// }
	// if ($alldata) 
	// {
	// 	$empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);
	// 	echo json_encode($empt1);
	// } 
	// else
	// {
	// 	$empt1 = array("res" => '0', "message" => 'Data Not Found');
	// 	echo json_encode($empt1);
	// }
}


?>