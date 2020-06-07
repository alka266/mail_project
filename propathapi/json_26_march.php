<?php

error_reporting(1);




include_once("config.php");

include_once("constants.php");

//echo "hello";

//DB Connection

$con = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);      

if (mysqli_connect_errno())

{

  echo "Failed to connect to MySQL: " . mysqli_connect_error();

}

//Setting up the charset

mysqli_set_charset($con,"utf8");



// Files for functions



include_once("functions.php");



header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: POST");

header("Access-Control-Max-Age: 3600");

header("Content-length: 4000");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

date_default_timezone_set("Asia/Calcutta");

$cur_date = date("y-m-d");

$cur_time = date('H:i:s');

$date_time = $cur_date." ".$cur_time;





// echo $newfile_url = "https://ctdworld.co/athlete/".UPLOAD_DIR.$new_name;



// die;





######################################################End Attach Files###############################################

$mode='';





if (isset($_REQUEST['create_training_plan_new'])) {

  if ($_REQUEST['create_training_plan_new'] == 1) {

    $mode = 'create training plan new';

  }

}



if (isset($_REQUEST['edit_training_plan_new'])) { 

  if ($_REQUEST['edit_training_plan_new'] == 1) {

    edit_training_plan_new($_REQUEST,$con);

  }

}



if (isset($_REQUEST['edit_training_plan_whole'])) { 

  if ($_REQUEST['edit_training_plan_whole'] == 1) {

    edit_training_plan_whole($_REQUEST,$con);

  }

}



if (isset($_REQUEST['edit_training_plan_new_item_rn'])) {

  if ($_REQUEST['edit_training_plan_new_item_rn'] == 1) {

    $mode = 'edit training plan new item rn';

  }

}



if (isset($_REQUEST['delete_training_plan_new_item_rn'])) {

  if ($_REQUEST['delete_training_plan_new_item_rn'] == 1) {

    $mode = 'delete training plan new item rn';

  }

}



if (isset($_REQUEST['registration'])) {

  if ($_REQUEST['registration'] == 1) {

    $mode = 'Registration';

  }

}







if (isset($_REQUEST['login'])) {

  if ($_REQUEST['login'] == 1) {

    $mode = 'Login';

  }

}







if (isset($_REQUEST['forgotpassword'])) {

  if ($_REQUEST['forgotpassword'] == 1) {

    $mode = 'Forgot Password';

  }

}







if (isset($_REQUEST['Profile'])) {

  if ($_REQUEST['Profile'] == 1) {

    $mode = 'User Profile';

  }

}





if (isset($_REQUEST['change_password'])) {

  if ($_REQUEST['change_password'] == 1) {

    $mode = 'Change Password';

  }

}





if (isset($_REQUEST['get_all_roles'])) {

  if ($_REQUEST['get_all_roles'] == 1) {

    $mode = 'GetAllRoles';

  }

}





if (isset($_REQUEST['get_all_users'])) {

  if ($_REQUEST['get_all_users'] == 1) {

    $mode = 'GetAllusers';

  }

}





if (isset($_REQUEST['logout'])) {

  if ($_REQUEST['logout'] == 1) {

    $mode = 'logout Api';

  }

}



if (isset($_REQUEST['updateprofile'])) {

  if ($_REQUEST['updateprofile'] == 1) {

    $mode = 'Update profile';

  }

}





if (isset($_REQUEST['image_upload'])) {

  if ($_REQUEST['image_upload'] == 1) {

    $mode = 'image upload';

  }

}



if (isset($_REQUEST['image_upload_ios'])) {

  if ($_REQUEST['image_upload_ios'] == 1) {

    $mode = 'image upload ios';

  }

}





if (isset($_REQUEST['contact_no_api'])) {

  if ($_REQUEST['contact_no_api'] == 1) {

    $mode = 'Contact API';

  }

}





if (isset($_REQUEST['get_all_contact'])) {

  if ($_REQUEST['get_all_contact'] == 1) {

    $mode = 'Get Contact API';

  }

}



if (isset($_REQUEST['delete_contact_friend'])) {

  if ($_REQUEST['delete_contact_friend'] == 1) {

    $mode = 'Delete Contact Friend API';

  }

}



if (isset($_REQUEST['send_request'])) {

  if ($_REQUEST['send_request'] == 1) {

    $mode = 'Send Request';

  }

}





if (isset($_REQUEST['user_search_name'])) {

  if ($_REQUEST['user_search_name'] == 1) {

    $mode = 'user_search_name';

  }

}





if (isset($_REQUEST['responseByfriend'])) {

  if ($_REQUEST['responseByfriend'] == 1) {

    $mode = 'response By friend';

  }

}





if (isset($_REQUEST['get_all_friends'])) {

  if ($_REQUEST['get_all_friends'] == 1) {

    $mode = 'get all friends';

  }

}



if (isset($_REQUEST['connection_request_status'])) {

  if ($_REQUEST['connection_request_status'] == 1) {

    $mode = 'connection_request_status';

  }

}



if (isset($_REQUEST['get_msg_list'])) {

  if ($_REQUEST['get_msg_list'] == 1) {

    $mode = 'get_msg_list';

  }

}

if (isset($_REQUEST['update_token'])) {

  if ($_REQUEST['update_token'] == 1) {

    $mode = 'update_token';

  }

}



######################################### Career Plan APIs ###########################



if (isset($_REQUEST['create_career_plan'])) {

  if ($_REQUEST['create_career_plan'] == 1) {

    $mode = 'create_career_plan';

  }

}

if (isset($_REQUEST['update_career_plan'])) {

  if ($_REQUEST['update_career_plan'] == 1) {

    $mode = 'update_career_plan';

  }

}

if (isset($_REQUEST['show_career_plan'])) {

  if ($_REQUEST['show_career_plan'] == 1) {

    $mode = 'show_career_plan';

  }

}

if (isset($_REQUEST['get_all_career_plan'])) {

  if ($_REQUEST['get_all_career_plan'] == 1) {

    $mode = 'get_all_career_plan';

  }

}



if (isset($_REQUEST['delete_career_plan'])) {

  if ($_REQUEST['delete_career_plan'] == 1) {   

    $mode = 'delete_career_plan'; 

  }

}



############################################# Welfare APIs #############################

if (isset($_REQUEST['welfare_add_docs'])) {

  if ($_REQUEST['welfare_add_docs'] == 1) {

    $mode = 'welfare_add_docs';

  }

}

if (isset($_REQUEST['welfare_get_docs'])) {

  if ($_REQUEST['welfare_get_docs'] == 1) {

    $mode = 'welfare_get_docs';

  }

}

if (isset($_REQUEST['welfare_delete_docs'])) {

  if ($_REQUEST['welfare_delete_docs'] == 1) {

    $mode = 'welfare_delete_docs';

  }

}



######################################################################################



if (isset($_REQUEST['read_push_notification'])) {

  if ($_REQUEST['read_push_notification'] == 1) {

    $mode = 'read_push_notification';

  }

}



##################### News Feed APIs ####################################



if (isset($_REQUEST['add_news_feed'])) {

  if ($_REQUEST['add_news_feed'] == 1) {

    $mode = 'add_news_feed';

  }

}

if (isset($_REQUEST['share_news_feed'])) {

  if ($_REQUEST['share_news_feed'] == 1) {

    $mode = 'share_news_feed';

  }

}

if (isset($_REQUEST['edit_news_feed'])) {

  if ($_REQUEST['edit_news_feed'] == 1) {

    $mode = 'edit_news_feed';

  }

}



if (isset($_REQUEST['delete_news_feed'])) {

  if ($_REQUEST['delete_news_feed'] == 1) {

    $mode = 'delete_news_feed';

  }

}

if (isset($_REQUEST['view_news_feed'])) {

  if ($_REQUEST['view_news_feed'] == 1) {

    $mode = 'view_news_feed';

  }

}

if (isset($_REQUEST['edit_share_status'])) {

  if ($_REQUEST['edit_share_status'] == 1) {

    $mode = 'edit_share_status';

  }

}

if (isset($_REQUEST['refresh_chat_list'])) {

  if ($_REQUEST['refresh_chat_list'] == 1) {

    $mode = 'refresh_chat_list';

  }

}

if (isset($_REQUEST['add_like_post'])) {

  if ($_REQUEST['add_like_post'] == 1) {

    $mode = 'add_like_post';

  }

}



if (isset($_REQUEST['list_like_user'])) {

  if ($_REQUEST['list_like_user'] == 1) {

    $mode = 'list_like_user';

  }

}



if (isset($_REQUEST['add_comment_post'])) {

  if ($_REQUEST['add_comment_post'] == 1) {

    $mode = 'add_comment_post';

  }

}

if (isset($_REQUEST['view_comment_post'])) {

  if ($_REQUEST['view_comment_post'] == 1) {

    $mode = 'view_comment_post';

  }

}

if (isset($_REQUEST['edit_comment_post'])) {

  if ($_REQUEST['edit_comment_post'] == 1) {

    $mode = 'edit_comment_post';

  }

}

if (isset($_REQUEST['delete_comment_post'])) {

  if ($_REQUEST['delete_comment_post'] == 1) {

    $mode = 'delete_comment_post';

  }

}





if (isset($_REQUEST['add_feedback'])) {

  if ($_REQUEST['add_feedback'] == 1) {

    $mode = 'add_feedback';

  }

}



#######################################Below this line all the APIs were adited by Rakesh Chandel##############



if (isset($_REQUEST['send_msg'])) {

  if ($_REQUEST['send_msg'] == 1) {

    $mode = 'send_msg';

  }

}



if (isset($_REQUEST['send_report_request'])) {

  if ($_REQUEST['send_report_request'] == 1) {

    $mode = 'send_report_request';

  }

}



if (isset($_REQUEST['school_review_report'])) {

  if ($_REQUEST['school_review_report'] == 1) {

    $mode = 'school_review_report';

  }

}



if (isset($_REQUEST['response_report_request'])) {

  if ($_REQUEST['response_report_request'] == 1) {

    $mode = 'response_report_request';

  }

}





####################Using Function.php#######################



if (isset($_REQUEST['contact_to_be_added'])) {

  if ($_REQUEST['contact_to_be_added'] == 1) {

//$mode = 'contact_to_be_added';

    contact_to_be_added($_REQUEST,$con);



  }

}

if (isset($_REQUEST['check_friend_status'])) {

  if ($_REQUEST['check_friend_status'] == 1) {

//$mode = 'check_friend_status';

    check_friend_status($_REQUEST,$con);



  }

}



################################ Notes APIs ####################################



if (isset($_REQUEST['add_notes_category'])) {

  if ($_REQUEST['add_notes_category'] == 1) {

//$mode = 'add_notes_category';

    add_notes_category($_REQUEST,$con);



  }

}



if (isset($_REQUEST['get_notes_category'])) {

  if ($_REQUEST['get_notes_category'] == 1) {

    get_notes_category($_REQUEST,$con);

  }

}



if (isset($_REQUEST['create_note'])) {

  if ($_REQUEST['create_note'] == 1) {

    create_note($_REQUEST,$con);

  }

}



if (isset($_REQUEST['copy_note'])) {

  if ($_REQUEST['copy_note'] == 1) {

    copy_note($_REQUEST,$con);

  }

}



if (isset($_REQUEST['edit_notes'])) { 

  if ($_REQUEST['edit_notes'] == 1) {



    edit_notes($_REQUEST,$con);

  }

}





if (isset($_REQUEST['get_all_notes_incategory'])) { 

  if ($_REQUEST['get_all_notes_incategory'] == 1) {

    get_all_notes_incategory($_REQUEST,$con);

  }

}  



if (isset($_REQUEST['delete_note'])) {

  if ($_REQUEST['delete_note'] == 1) {



    delete_note($_REQUEST,$con);

  }

}



if (isset($_REQUEST['delete_notes_category'])) {

  if ($_REQUEST['delete_notes_category'] == 1) {



    delete_notes_category($_REQUEST,$con);

  }

}





if (isset($_REQUEST['share_notes'])) { 

  if ($_REQUEST['share_notes'] == 1) {



    share_notes($_REQUEST,$con);

  }

}







if (isset($_REQUEST['get_notes_list'])) {

  if ($_REQUEST['get_notes_list'] == 1) {

    get_notes_list($_REQUEST,$con);

  }

}



if (isset($_REQUEST['get_notes_details'])) {

  if ($_REQUEST['get_notes_details'] == 1) {

    get_notes_details($_REQUEST,$con);

  }

}





if (isset($_REQUEST['get_frnd_group_notes'])) { 

  if ($_REQUEST['get_frnd_group_notes'] == 1) {

    get_frnd_group_notes($_REQUEST,$con);

  }

}



################################## Group APIs ##################################

if (isset($_REQUEST['add_group_memeber'])) {

  if ($_REQUEST['add_group_memeber'] == 1) {

//$mode = 'add_group_memeber';

    add_group_memeber($_REQUEST,$con);



  }

}



if (isset($_REQUEST['remove_group_memeber'])) {

  if ($_REQUEST['remove_group_memeber'] == 1) {

//$mode = 'remove_group_memeber';

    remove_group_memeber($_REQUEST,$con);



  }

}





if (isset($_REQUEST['chat_list'])) {

  if ($_REQUEST['chat_list'] == 1) {

//$mode = 'chat_list';

    chat_list($_REQUEST,$con);

  }

}



if (isset($_REQUEST['create_chat_group'])) {

  if ($_REQUEST['create_chat_group'] == 1) {

    $mode = 'create_chat_group';

  }

}

if (isset($_REQUEST['edit_group_name'])) {

  if ($_REQUEST['edit_group_name'] == 1) {

    $mode = 'edit_group_name';

  }

}

if (isset($_REQUEST['edit_group_image'])) {

  if ($_REQUEST['edit_group_image'] == 1) {

    $mode = 'edit_group_image';

  }

}

if (isset($_REQUEST['change_groupmember_role'])) {

  if ($_REQUEST['change_groupmember_role'] == 1) {

    $mode = 'change_groupmember_role';

  }

}





if (isset($_REQUEST['group_list'])) {

  if ($_REQUEST['group_list'] == 1) {

    $mode = 'group_list';

  }

}

if (isset($_REQUEST['group_member_list'])) {

  if ($_REQUEST['group_member_list'] == 1) {

    $mode = 'group_member_list';

  }

}



if (isset($_REQUEST['send_chat_group_msg'])) {

  if ($_REQUEST['send_chat_group_msg'] == 1) {

    $mode = 'send_chat_group_msg';

  }

}





################### School Review in Education Module ###########################

//For All SChool Reviews of a user  



if (isset($_REQUEST['add_self_review'])) {

  if ($_REQUEST['add_self_review'] == 1) {

//$mode = 'add_self_review';

    add_self_review($_REQUEST, $con);

  }

}



if (isset($_REQUEST['edit_self_review'])) {

  if ($_REQUEST['edit_self_review'] == 1) {

//$mode = 'edit_self_review';

    edit_self_review($_REQUEST, $con);

  }

}



// delete_self_review API by ranjeet on 15-04-2019



if (isset($_REQUEST['delete_self_review'])) {

  if ($_REQUEST['delete_self_review'] == 1) {

 //$mode = 'delete_self_review';

    delete_self_review($_REQUEST, $con);

  }

}



// update_school_review API By Ranjeet On 05-04-2019



if (isset($_REQUEST['update_school_review'])) {

  if ($_REQUEST['update_school_review'] == 1) {

     $mode = 'update_school_review';

  //  update_school_review($_REQUEST, $con);

  }

}



// delete_school_review API By Ranjeet On 15-04-2019



if (isset($_REQUEST['delete_school_review'])) {

  if ($_REQUEST['delete_school_review'] == 1) {

     //$mode = 'delete_school_review';

      delete_school_review($_REQUEST, $con);

  }

}



if (isset($_REQUEST['get_self_review'])) {

  if ($_REQUEST['get_self_review'] == 1) {

    get_self_review($_REQUEST, $con);

  }

}







if (isset($_REQUEST['get_selfreviewd_athlete'])) {

  if ($_REQUEST['get_selfreviewd_athlete'] == 1) {

    get_selfreviewd_athlete($_REQUEST,$con);

  }

}



if (isset($_REQUEST['get_self_review_detail'])) {

  if ($_REQUEST['get_self_review_detail'] == 1) {

    get_self_review_detail($_REQUEST, $con);

  }

}







if (isset($_REQUEST['add_school_review'])) {

  if ($_REQUEST['add_school_review'] == 1) {

//$mode = 'add_school_review';

    add_school_review($_REQUEST, $con);

  }

}



if (isset($_REQUEST['edit_school_review'])) {

  if ($_REQUEST['edit_school_review'] == 1) {

//$mode = 'edit_school_review';

    edit_school_review($_REQUEST, $con);

  }

}



//For All SChool Reviews of a user  

if (isset($_REQUEST['get_school_review'])) {

  if ($_REQUEST['get_school_review'] == 1) {

    get_school_review($_REQUEST, $con);

  }

}



///For Specific School Review////

if (isset($_REQUEST['get_school_review_detail'])) {

  if ($_REQUEST['get_school_review_detail'] == 1) {

    get_school_review_detail($_REQUEST, $con);

  }

}



///For Specific School Review////

if (isset($_REQUEST['get_school_reviews_byteacher'])) {

  if ($_REQUEST['get_school_reviews_byteacher'] == 1) {

//$mode = 'get_school_review_detail';



    get_school_reviews_byteacher($_REQUEST, $con);

  }

}





if (isset($_REQUEST['get_school_request_status'])) {

  if ($_REQUEST['get_school_request_status'] == 1) {

    get_school_request_status($_REQUEST, $con);

  }

}



if (isset($_REQUEST['get_school_reviewed'])) {

  if ($_REQUEST['get_school_reviewed'] == 1) {

    get_school_reviewed($_REQUEST, $con);

  }

}





if (isset($_REQUEST['create_match_self_review'])) {

  if ($_REQUEST['create_match_self_review'] == 1) {

    match_self_review($_REQUEST, $con);

  }

}



if (isset($_REQUEST['get_match_self_review_description'])) {

  if ($_REQUEST['get_match_self_review_description'] == 1) {    

    get_match_self_review_description($_REQUEST, $con); 

  }

}



if (isset($_REQUEST['edit_match_self_review'])) {

  if ($_REQUEST['edit_match_self_review'] == 1) {   

    edit_match_self_review($_REQUEST, $con); 

  }

}



if (isset($_REQUEST['delete_match_self_review'])) {

  if ($_REQUEST['delete_match_self_review'] == 1) {   

    delete_match_self_review($_REQUEST, $con); 

  }

}



if (isset($_REQUEST['get_all_match_feedback'])) {

  if ($_REQUEST['get_all_match_feedback'] == 1) {

    get_match_self_review($_REQUEST, $con);

  }

}



if (isset($_REQUEST['get_self_match_feedback'])) {

  if ($_REQUEST['get_self_match_feedback'] == 1) {

    get_self_match_feedback($_REQUEST, $con);

  }

}





################################# Athlete Aceivement APIs ################################





if (isset($_REQUEST['athlete_representative'])) {

  if ($_REQUEST['athlete_representative'] == 1) {

    athlete_representative($_REQUEST, $con);

  }

}





if (isset($_REQUEST['get_athlete_representative'])) {

  if ($_REQUEST['get_athlete_representative'] == 1) {

//$mode = 'get athlete representative';

    get_athlete_representative($_REQUEST, $con);

  }

}



if (isset($_REQUEST['delete_athlete_representative'])) {

  if ($_REQUEST['delete_athlete_representative'] == 1) {

//$mode = 'get athlete representative';

    delete_athlete_representative($_REQUEST, $con);

  }

}



if (isset($_REQUEST['edit_athlete_representative'])) {

  if ($_REQUEST['edit_athlete_representative'] == 1) {

//$mode = 'get athlete representative';

    edit_athlete_representative($_REQUEST, $con);

  }

}



if (isset($_REQUEST['get_all_athlete'])) {

  if ($_REQUEST['get_all_athlete'] == 1) {

    get_all_athlete($_REQUEST,$con);

  }

}



################### Coach Feedback APIs ###########################

if (isset($_REQUEST['add_coach_feedback'])) {

  if ($_REQUEST['add_coach_feedback'] == 1) {

    add_coach_feedback($_REQUEST, $con);

  }

}



if (isset($_REQUEST['delete_coach_feedback'])) {

  if ($_REQUEST['delete_coach_feedback'] == 1) {

    delete_coach_feedback($_REQUEST, $con);

  }

}



if (isset($_REQUEST['edit_coach_feedback'])) {

  if ($_REQUEST['edit_coach_feedback'] == 1) {

    edit_coach_feedback($_REQUEST, $con);

  }

}



if (isset($_REQUEST['show_coach_feedback'])) {

  if ($_REQUEST['show_coach_feedback'] == 1) {

    show_coach_feedback($_REQUEST, $con);

  }

}



if (isset($_REQUEST['get_coach_feedbacklist'])) {

  if ($_REQUEST['get_coach_feedbacklist'] == 1) {

    get_coach_feedbacklist($_REQUEST, $con);

  }

}

if (isset($_REQUEST['particular_coach_feedback'])) {

  if ($_REQUEST['particular_coach_feedback'] == 1) {

    particular_coach_feedback($_REQUEST, $con);

  }

}





if (isset($_REQUEST['get_all_feedback_list'])) {

  if ($_REQUEST['get_all_feedback_list'] == 1) {

    get_all_feedback_list($_REQUEST, $con);

  }

}

#######################Survey Apis################################



if (isset($_REQUEST['add_survey'])) { 

  if ($_REQUEST['add_survey'] == 1) {

    add_survey($_REQUEST,$con); 

  }

}



if (isset($_REQUEST['get_all_survey'])) { 

  if ($_REQUEST['get_all_survey'] == 1) {

    get_all_survey($_REQUEST,$con); 

  }

}



if (isset($_REQUEST['get_all_survey_new'])) { 

  if ($_REQUEST['get_all_survey_new'] == 1) {

    get_all_survey_new($_REQUEST,$con); 

  }

}





if (isset($_REQUEST['delete_survey'])) { 

  if ($_REQUEST['delete_survey'] == 1) {

    delete_survey($_REQUEST,$con);  

  }

}





if (isset($_REQUEST['get_shared_survey'])) { 

  if ($_REQUEST['get_shared_survey'] == 1) {

    get_shared_survey($_REQUEST,$con);  

  }

}





if (isset($_REQUEST['share_survey'])) { 

  if ($_REQUEST['share_survey'] == 1) {

    share_survey($_REQUEST,$con); 

  }

}







if (isset($_REQUEST['copy_survey'])) { 

  if ($_REQUEST['copy_survey'] == 1) {

    copy_survey($_REQUEST,$con);  

  }

}



if (isset($_REQUEST['enable_disable_survey'])) { 

  if ($_REQUEST['enable_disable_survey'] == 1) {

    enable_disable_survey($_REQUEST,$con);  

  }

}



if (isset($_REQUEST['show_anonymous_survey'])) { 

  if ($_REQUEST['show_anonymous_survey'] == 1) {

    show_anonymous_survey($_REQUEST,$con);  

  }

}



if (isset($_REQUEST['get_frnd_group_survey'])) {

  if ($_REQUEST['get_frnd_group_survey'] == 1) {

    get_frnd_group_survey($_REQUEST,$con);

  }

}

if (isset($_REQUEST['edit_survey'])) {

  if ($_REQUEST['edit_survey'] == 1) {

    edit_survey($_REQUEST,$con);

  }

}



if (isset($_REQUEST['submit_survey'])) {

  if ($_REQUEST['submit_survey'] == 1) {

    submit_survey($_REQUEST,$con);

  }

}







if (isset($_REQUEST['get_submitted_survey'])) {

  if ($_REQUEST['get_submitted_survey'] == 1) {

    get_submitted_survey($_REQUEST,$con);

  }

}



if (isset($_REQUEST['get_survey_stat'])) {

  if ($_REQUEST['get_survey_stat'] == 1) {

    get_survey_stat($_REQUEST,$con);

  }

}







##################### Nutrition Feed APIs ####################################



if (isset($_REQUEST['add_nutrition_feed'])) {

  if ($_REQUEST['add_nutrition_feed'] == 1) {

    add_nutrition_feed($_REQUEST,$con);

  }

}

if (isset($_REQUEST['delete_nutrition'])) {

  if ($_REQUEST['delete_nutrition'] == 1) {

    delete_nutrition($_REQUEST,$con);

  }

}



if (isset($_REQUEST['share_nutrition_feed'])) {

  if ($_REQUEST['share_nutrition_feed'] == 1) {

    share_nutrition_feed($_REQUEST,$con);

  }

}

if (isset($_REQUEST['edit_nutrition_feed'])) {

  if ($_REQUEST['edit_nutrition_feed'] == 1) {

    edit_nutrition_feed($_REQUEST,$con);

  }

}

if (isset($_REQUEST['view_nutrition_feed'])) {

  if ($_REQUEST['view_nutrition_feed'] == 1) {

    view_nutrition_feed($_REQUEST,$con);

  }

}



if (isset($_REQUEST['add_like_nutrition'])) {

  if ($_REQUEST['add_like_nutrition'] == 1) {

    add_like_nutrition($_REQUEST,$con);

  }

}

if (isset($_REQUEST['add_comment_nutrition'])) {

  if ($_REQUEST['add_comment_nutrition'] == 1) {

    add_comment_nutrition($_REQUEST,$con);

  }

}

if (isset($_REQUEST['view_comment_nutrition'])) {

  if ($_REQUEST['view_comment_nutrition'] == 1) {

    view_comment_nutrition($_REQUEST,$con);

  }

}

if (isset($_REQUEST['edit_comment_nutrition'])) {

  if ($_REQUEST['edit_comment_nutrition'] == 1) {

    edit_comment_nutrition($_REQUEST,$con);

  }

}

if (isset($_REQUEST['delete_comment_nutrition'])) {

  if ($_REQUEST['delete_comment_nutrition'] == 1) {

    delete_comment_nutrition($_REQUEST,$con);

  }

}



if (isset($_REQUEST['get_frnd_group_nutrition'])) {

  if ($_REQUEST['get_frnd_group_nutrition'] == 1) {

    get_frnd_group_nutrition($_REQUEST,$con);

  }

}







##############################Training Plan API########



if (isset($_REQUEST['create_trainingplan'])) {

  if ($_REQUEST['create_trainingplan'] == 1) {

    create_trainingplan($_REQUEST,$con);

  }

}





if (isset($_REQUEST['edit_trainingplan'])) { 

  if ($_REQUEST['edit_trainingplan'] == 1) {

    edit_trainingplan($_REQUEST,$con);

  }

}

if (isset($_REQUEST['delete_trainingplan'])) {

  if ($_REQUEST['delete_trainingplan'] == 1) {

    delete_trainingplan($_REQUEST,$con);

  }

}



if (isset($_REQUEST['add_training_item'])) {

  if ($_REQUEST['add_training_item'] == 1) {

    add_training_item($_REQUEST,$con);

  }

}



if (isset($_REQUEST['edit_training_item'])) { 

  if ($_REQUEST['edit_training_item'] == 1) {

    edit_training_item($_REQUEST,$con);

  }

}





if (isset($_REQUEST['delete_trainingplan_item'])) {

  if ($_REQUEST['delete_trainingplan_item'] == 1) {



    delete_trainingplan_item($_REQUEST,$con);

  }

}







if (isset($_REQUEST['share_trainingplan'])) { 

  if ($_REQUEST['share_trainingplan'] == 1) {

    share_trainingplan($_REQUEST,$con);

  }

}



if (isset($_REQUEST['get_all_trainingplan'])) { 

  if ($_REQUEST['get_all_trainingplan'] == 1) {

    get_all_trainingplan($_REQUEST,$con);

  }

}  



if (isset($_REQUEST['list_trainingplan'])) { 

  if ($_REQUEST['list_trainingplan'] == 1) {

    $mode = 'List Trainingplan';

  }

} 



/* if (isset($_REQUEST['edit_training_plan_new'])) { 

  if ($_REQUEST['edit_training_plan_new'] == 1) {

    $mode = 'edit training plan new';

  }

} */





if (isset($_REQUEST['save_edit_training_plan_new'])) { 

  if ($_REQUEST['save_edit_training_plan_new'] == 1) {

    $mode = 'save edit training plan new';

  }

} 



if (isset($_REQUEST['get_trainingplan_items'])) {

  if ($_REQUEST['get_trainingplan_items'] == 1) {

    get_trainingplan_items($_REQUEST,$con);

  }

}



if (isset($_REQUEST['create_survey_multiple'])) {

  if ($_REQUEST['create_survey_multiple'] == 1) {

    $mode = 'create_survey_multiple';

  }

}



/* Created on 18th July */



if (isset($_REQUEST['edit_survey_multiple'])) {

  if ($_REQUEST['edit_survey_multiple'] == 1) {

    $mode = 'edit_survey_multiple';

  }

}



if (isset($_REQUEST['create_yes_no_survey'])) {

  if ($_REQUEST['create_yes_no_survey'] == 1) {

    $mode = 'create_yes_no_survey';

  }

}



/* Created on 18th July */

if (isset($_REQUEST['edit_yes_no_survey'])) {

  if ($_REQUEST['edit_yes_no_survey'] == 1) {

    $mode = 'edit_yes_no_survey';

  }

}





/* create 26 march */

if (isset($_REQUEST['message_report'])) {

  if ($_REQUEST['message_report'] == 1) {

    $mode = 'message_report';

  }

}



/*

if (isset($_REQUEST['get_frnd_group_notes'])) { 

  if ($_REQUEST['get_frnd_group_notes'] == 1) {

    get_frnd_group_notes($_REQUEST,$con);

  }

}










*/



##############################################################



switch ($mode) {

########################################################Login###############################################

//url :http://localhost/athelet/jsondata.php?login=1&user_email=rahulsingh5071@gmail.com&password=rahul

// create 26 march //

case "message_report": 

$message_id = $_REQUEST['message_id']; 

$report_type = $_REQUEST['report_type'];        

$user_id = $_REQUEST['user_id'];



if ($message_id != '' && $report_type != '' && $user_id != '')

  {


    $uArr1 = mysqli_query($con,"select * from `message_report` where `report_type`='$report_type'");

    if (mysqli_num_rows($uArr1) == 0) {

      $res=mysqli_query($con,"INSERT INTO `message_report` (`message_id`, `report_type`, `user_id`) 

        VALUES ('$message_id','$report_type','$user_id')");

      $eventid = mysqli_insert_id($con);

      if($res)

      {

        $res1=mysqli_query($con ,"select * from `message_report` where `message_id`='$message_id'");

        while($row=mysqli_fetch_assoc($res1))

        {

          $empt[]=$row;

          $empt1 = array("res"=>'success',"response"=>$empt);

          echo json_encode($empt1);                

        }

      }

   }
    else
    {

      $empt=array("res"=>'0',"response"=>'Report successfully');

      echo json_encode($empt);

    }    

 }





  case "Login":        

  $username = $_REQUEST['user_email'];

  $password = $_REQUEST['password'];



  $mobile_token = $_REQUEST['mobile_token'];       



  if ($password != '' && $username != '') {

    $uArr = mysqli_query($con,"select * from `athlete_users` where `user_password` ='" . md5($password) . "' and `user_email`='$username' and user_status='1' ");

    if (mysqli_num_rows($uArr) > 0) { 

      $resultUser = mysqli_fetch_assoc($uArr);

      $userid = $resultUser['user_id']; 

      mysqli_query($con, "UPDATE `athlete_users` SET `user_activity`='1', `mobile_token`='$mobile_token' WHERE `user_id`='$userid'"); 

      $uArrdetail = mysqli_query($con,"SELECT * FROM `athlete_users` WHERE `user_id` = '$userid'");



      if($resultUser_detail = mysqli_fetch_assoc($uArrdetail)){

        $aurh = $resultUser_detail['user_id'];

        $cdata['UserID'] = $resultUser_detail['user_id'];

        $cdata['UserName'] = $resultUser_detail['user_name'];

        $cdata['UserProfile'] = PROFILE_IMAGE.$resultUser_detail['profile_image'];

        $cdata['EmailID'] = $resultUser_detail['user_email']; 

        $cdata['AuthToken'] = $resultUser_detail['AuthToken'];

        $cdata['UserRole'] = $resultUser_detail['user_role'];

        $cdata['Userstatus'] = $resultUser_detail['user_status'];

        $cdata['UserActivity'] = $resultUser_detail['user_activity'];

        $cdata['athlete_playlist'] = $resultUser_detail['athlete_playlist'];

        $cdata['athlete_highlight'] = $resultUser_detail['athlete_highlight'];

        $data_response = $cdata;

      }

      $data['success'] = "1";

      $data['message'] = "Logged in successfully.";

      $data['data'] = $data_response;          

/*if ($resultUser['user_activity'] == 1) {

$data['success'] = "1";

$data['message'] = "Logged in successfully.";

$data['data'] = $data_response;

} else {

$data['success'] = "0";

$data['message'] = "Your account has been deactivated,please contact to admin.";

}*/

} else {

  $data['success'] = "0";

  $data['message'] = "Invalid username or password.";

}

} else {

  $data['success'] = "0";

  $data['message'] = "Please enter username and password.";

}



echo json_encode($data);

break;

######################################################End Login###############################################



case "Registration": 

$fname = $_REQUEST['name']; 

$email = $_REQUEST['email'];        

$role = $_REQUEST['role'];

$password = $_REQUEST['password'];

$repassword = $_REQUEST['repassword'];

$mobile_token = $_REQUEST['mobile_token'];

$newpass=rand(100000,999999);

$string = base64_encode(10);

if($password==$repassword){



  $mdpass = md5($password);

  if ($fname != '' && $email != '' && $password != '' && $role !='')

  {



    $uArr1 = mysqli_query($con,"select * from `athlete_users` where `user_email`='$email'");

    if (mysqli_num_rows($uArr1) == 0) {

      $res=mysqli_query($con,"INSERT INTO `athlete_users` (`user_name`, `user_email`, `user_password`,`user_otp` ,`AuthToken`,`user_role`,`mobile_token`) 

        VALUES ('$fname','$email','$mdpass','$newpass','$string','$role','$mobile_token')");

      $eventid = mysqli_insert_id($con);

      if($res)

      {

        $res1=mysqli_query($con ,"select * from `athlete_users` where `user_id`='$eventid'");

        while($row=mysqli_fetch_assoc($res1))

        {

          $empt[]=$row;

          $empt1 = array("res"=>'success',"response"=>$empt);

          echo json_encode($empt1);                

        }

      }



    }else{

      $empt=array("res"=>'0',"response"=>'Email All ready registred');

      echo json_encode($empt);

    }    

  }

  else

  {

    $empt=array("res"=>'0',"response"=>'Please enter all required fields');

    echo json_encode($empt);

  } 

}else{

  $empt=array("res"=>'0',"response"=>'Please enter same password');

  echo json_encode($empt);

}

break;

##########################################################################################################################################################

case "Forgot Password": 



//echo"hello";

$email = $_REQUEST['email'];

if($email!=''){

  $uArr=mysqli_query($con, "select * from `athlete_users` where `user_email`='$email' ");

  if(mysqli_fetch_array($uArr)>0){



    $rs=mysqli_fetch_object($uArr); 

    $site_title=SITE_TITLE;

    $name = strstr($email,'@', true);

    $password = $name.'_'.rand(0,999999);



    $to="$email";

//echo $email;

    $subject="Recover your password";        

    $message = "<html>

    <head>

    <title>HTML email</title>

    </head>

    <body>

    <table>





    <tr><td style='height: 35px;'>Welcome to Athlete Life</td></tr>



    <tr><td style='height: 35px;'>Please find the login details below:</td></tr>



    <tr><td style='height: 35px;'> You can login to the app by having the following credentials :<br>

    </td></tr>



    <tr><td style='height: 35px;'>Your Email Id: " . stripslashes($email) . "

    <br>

    Your password: " . stripslashes($password) . "</td></tr>





    <tr><td style='height: 35px;'>Warm Regards, <br> Athlete Life App <br></td></tr>



    <tr><td style='height: 30px;'><hr></td></tr>



    </table>

    </body>

    </html>



    ";

// $message .= "<b>and User Name : $dbname</b><br>";

//$message .= "<b>$newpass</b><br>";

// $message .= "<b>Please go to application to change your password.</b>";

    $header = "From:proftcode@gmail.com \r\n";

//$header .= "Cc:afgh@somedomain.com \r\n";

    $header .= "MIME-Version: 1.0\r\n";

    $header .= "Content-type: text/html\r\n";

    $retval = mail ($to,$subject,$message,$header);



    if($retval)

    {

      $uArr=mysqli_query($con,"update `athlete_users` set `user_password`='".md5($password)."' where `user_email`='$email' ");

      $data['success']=1; 

      $data['message']="Your password has been sent to your mail.!"; 

    }



  }else{

    $data['success']=0;

    $data['message']="Email not found,Please try again with a valid ID";

  }



}else{

  $data['success']=0;

  $data['message']="Please enter email id";

}

echo json_encode($data);

break;

#########################################################################







case "User Profile":

// http://localhost/athelet/jsondata.php?Profile=1&userid=1



$userid = $_REQUEST['userid'];  

if ($userid != '') {      

  $uArr = mysqli_query($con,"SELECT * FROM `athlete_users` WHERE `user_id` = '$userid'");  



//$uArr = mysql_query("select * from wp_users where user_activation_key !='' "); 



  while($resultUser = mysqli_fetch_array($uArr)){ 



    $resultUserRole = $resultUser['user_role'];

    $res1_uu =mysqli_query($con,"SELECT * FROM `athlete_user_role` WHERE `role_id`='$resultUserRole'");

    while($rowuu=mysqli_fetch_assoc($res1_uu))

    {

      $user_role = $rowuu['role_name'];

    }





    $cdata['UserID'] = $resultUser['user_id'];

    $cdata['UserName'] = $resultUser['user_name'];

    $cdata['EmailID'] = $resultUser['user_email'];  

    $cdata['AuthToken'] = $resultUser['AuthToken'];

    $cdata['UserRole'] = $user_role;

    $cdata['UserRole_id'] = $resultUser['user_role'];

    $cdata['Userstatus'] = $resultUser['user_status'];

    $cdata['UserActivity'] = $resultUser['user_activity'];     

    $cdata['athelete_spot_code'] = $resultUser['athelete_spot_code']; 

    $cdata['address'] = $resultUser['address']; 

    $cdata['bio_details'] = $resultUser['bio_details'];

    $cdata['profile_image'] = $resultUser['profile_image']; 

    $cdata['athlete_playlist'] = $resultUser['athlete_playlist'];

    $cdata['athlete_highlight'] = $resultUser['athlete_highlight'];                   

    $data_response = $cdata;

  }



  $response['success'] = "1";

  $response['message'] = "User data"; 

  $response['data']=$data_response;

} else {

  $response['success'] = "0";

  $response['message'] = "Please enter all required fields.";

}



echo json_encode($response);



break;



####################################################################################################################





case "Change Password":





$user_id = $_REQUEST['user_id'];      

$oldpassword = $_REQUEST['oldpassword'];

$newpassword = $_REQUEST['newpassword'];

$confirmpass = $_REQUEST['confirmpass'];

if($newpassword == $confirmpass){

  if ($oldpassword != '' && $user_id != '' && $newpassword !='' && $confirmpass !='') {

    $uArr = mysqli_query($con, "select * from `athlete_users` where `user_id`='$user_id' AND user_password='" . md5($oldpassword) . "'  ");

    if (mysqli_num_rows($uArr)>0) {

      $sqlUser = mysqli_query($con,"update `athlete_users` set `user_password`='".md5($newpassword)."' where `user_id`='$user_id' "); 





      $fetchUserDetails = mysqli_fetch_array($uArr);

      $data['success'] = "1";

      $data['message'] = "Your password has been successfully changed.";

      $data['User ID'] = $fetchUserDetails['user_id'];







    } else {

      $data['success'] = "0";

      $data['message'] = "Please enter correct Old password";

    }

  } else {

    $data['success'] = "0";

    $data['message'] = "Please enter all required fields.";

  }

}else{

  $data['success'] = "0";

  $data['message'] = "New password and confirm password does not match.";

}





echo json_encode($data);



break;











###################################################################################################################



case "GetAllRoles":

$res = mysqli_query($con,"SELECT * FROM `athlete_user_role` WHERE `status`='1'");

while($row=mysqli_fetch_assoc($res))

{

  $empt[]=$row;

}

$empt1=array("res"=>'1',"message"=>$empt);

echo json_encode($empt1);



break;













######################################################################################################### edit by mahesh jangid



case "GetAllusers":

$user_id = $_REQUEST['user_id'];

$request_for = "Friend_request";

if($user_id != '')

{   

  $sql = mysqli_query($con, "Select * from  `athlete_users` where `user_id` != '$user_id'");

  while($row = mysqli_fetch_assoc($sql))

  {

    $row['friend_request_status'] = 0;

    $requestid = $row['user_id'];

    $check1 = mysqli_query($con, "select * from `athlete_report_request` WHERE (`request_from`='$requestid' && `request_to`='$user_id' && `request_for` = '$request_for' || `request_to`='$requestid' && `request_from`='$user_id' && `request_for` = '$request_for')");

    if($row1 = mysqli_fetch_assoc($check1))

    {

      $status = $row1['status'];



      if($status == 0)

      {

        $row['friend_request_status'] = 0;

      }

      else        if($status == 1)

      {

        $row['friend_request_status'] = 1;

      }

      else if($status == 2)

      {

        $row['friend_request_status'] = 2;

      } 

    } 

    $alldata[] = $row;

  }

  if ($alldata) {

    $empt1 = array("res" => '1', "message" => $alldata);

    echo json_encode($empt1);

  } else {

    $empt1 = array("res" => '0', "message" => 'Not Found');

    echo json_encode($empt1);

  }

}

else

{

  $response['success'] = "0";

  $response['message'] = "Please enter all required fields.";

  echo json_encode($response);

}





break;











#################################################################################################################



case"logout Api":



$user_id=$_REQUEST['user_id'];

$AuthToken=$_REQUEST['authtoken'];

$res=mysqli_query($con,"UPDATE `athlete_users` SET `user_activity`='0' WHERE `user_id`='$user_id' AND `AuthToken`='$AuthToken' ");

if($res)

{

  $empt=array("success"=>'1',"message"=>'Logout successfully');

  echo json_encode($empt);

}else{

  $empt=array("success"=>'0',"message"=>'Please Try again');

  echo json_encode($empt);

}



break;





######################################################################################################





case "Update profile":



$user_id = $_REQUEST['user_id'];



$profile_image = $_REQUEST['profile_image'];

$user_name = $_REQUEST['user_name'];

$athelete_spot_code = $_REQUEST['athelete_spot_code'];

$bio_details = $_REQUEST['bio_details']; 





$athlete_highlight = $_REQUEST['athlete_highlight']; 

$athlete_playlist = $_REQUEST['athlete_playlist']; 





$address = $_REQUEST['address'];

$AuthToken= $_REQUEST['AuthToken'];



if ($user_id != '' && $AuthToken !='') {

  if(strlen($profile_image) > 30) {

    

    $image = explode('profile/', $profile_image, 2);

    $profile_image = $image[1];

  }



  $res=mysqli_query($con,"UPDATE `athlete_users` SET `user_name`='$user_name',`athelete_spot_code`='$athelete_spot_code',`bio_details`='$bio_details',`profile_image`='$profile_image',`address`='$address',`athlete_highlight`='$athlete_highlight',`athlete_playlist`='$athlete_playlist' WHERE `user_id`='$user_id' AND `AuthToken`='$AuthToken'");

  //$res = true;



  if($res){

    $uArr = mysqli_query($con,"SELECT * FROM `athlete_users` WHERE `user_id` = '$user_id' AND `AuthToken`='$AuthToken'"); 

    while($fetchUserDetails = mysqli_fetch_array($uArr)){   





      $cdata['UserID'] = $fetchUserDetails['user_id'];

      $cdata['UserName'] = $fetchUserDetails['user_name'];

      $cdata['EmailID'] = $fetchUserDetails['user_email'];  

      $cdata['AuthToken'] = $fetchUserDetails['AuthToken'];



      $cdata['UserRole_id'] = $fetchUserDetails['user_role'];

      $cdata['Userstatus'] = $fetchUserDetails['user_status'];

      $cdata['UserActivity'] = $fetchUserDetails['user_activity'];     

      $cdata['athelete_spot_code'] = $fetchUserDetails['athelete_spot_code']; 

      $cdata['address'] = $fetchUserDetails['address']; 

      $cdata['bio_details'] = $fetchUserDetails['bio_details'];

      $cdata['profile_image'] = $fetchUserDetails['profile_image']; 

      $cdata['athlete_highlight'] = $fetchUserDetails['athlete_highlight'];

      $cdata['athlete_playlist'] = $fetchUserDetails['athlete_playlist'];                                                                              

      $data_response = $cdata;

    }



    $response['success'] = "1";

    $response['message'] = "profile sucessfully updated"; 

    $response['data']=$data_response;



  }else{

    $response['success'] = "0";

    $response['message'] = "Please Try again.";

  }



} else {

  $response['success'] = "0";

  $response['message'] = "Please enter all required fields.";

}



echo json_encode($response);



break;





#############################################################################################################



case "image upload":

set_time_limit(0);

$img = $_REQUEST['photo'];

$img_exp = explode(',', $img);

$img = str_replace($img_exp[0], '', $img);



$data = base64_decode($img);

$ini = substr($img_exp[0], 11);

$type = explode(';', $ini);



$fileimage = uniqid() . '.' . $type[0];

$file = UPLOAD_DIR . $fileimage;

$success = file_put_contents($file, $data);

if ($file) {

  $response['success'] = "1";

  $response['message'] = "image sucessfully uploaded";

  $response['data'] = $fileimage;

} else {

  $response['success'] = "0";

  $response['message'] = "Please Try again.";

}



echo json_encode($response);



break;



case "image upload ios":

  //print_r($_REQUEST);

  //print_r($_FILES);

  set_time_limit(0);

  $img = $_FILES["photo"]["name"];

  $fileimage = uniqid() . '_' . $img;

  $file = UPLOAD_DIR . $fileimage;

  //die;

   if($_FILES['photo']['size'] > 0){

    /*$chat_data = 'https://ctdworld.co/athlete/uploads/chat_data/';*/

    //$target="uploads/chat_data/";

    $type = $_FILES['photo']['type'];

    $name = $_FILES['photo']['name'];

    $name1 = str_replace(" ","",$name);

    $new_name = uniqid()."_".basename($name1);

    $new = $new_name;

    $file_url = UPLOAD_DIR.$new_name;

    if(move_uploaded_file($_FILES['photo']['tmp_name'],$file_url))

    {

      $response['success'] = "1";

      $response['message'] = "image sucessfully uploaded";

      $response['data'] = $new;

    }else{

      $response['success'] = "0";

      $response['message'] = "Please Try again.";

    }

}

else

{

  $response['success'] = "0";

  $response['message'] = "Please Try again.";

}

echo json_encode($response);

break;



############################################################################################################

/* API for delete contact */



########################################################################################################################

/* case "Delete Contact API":

  $user_id = $_REQUEST['user_id'];

  $ures = mysqli_query($con,"delete from `athlete_contact_user` where `user_id` ='$user_id'");

  $response['message'] = "Contact has been deleted sucessfully";

  echo json_encode($response);

  break; */



############################################################################################################





########################################################################################################################

case "Contact API":



$user_id = $_REQUEST['user_id'];

$cname = $_REQUEST['cname'];

$cnumber = $_REQUEST['cnumber'];



if ($user_id != '') {



  $uArr = mysqli_query($con,"select * from `athlete_contact_user` where `user_id` ='$user_id' and `contact_name`='$cname'");

  if (mysqli_num_rows($uArr) == 0) {



    $res=mysqli_query($con,"INSERT INTO `athlete_contact_user` (`user_id`, `contact_name`, `contact_no`) 

      VALUES ('$user_id','$cname','$cnumber')");

    $eventid = mysqli_insert_id($con);

    if($res)

    {

      $uArr = mysqli_query($con,"SELECT * FROM `athlete_contact_user` WHERE `id` = '$eventid'"); 

      while($fetchUserDetails = mysqli_fetch_array($uArr)){   



        $cdata['id'] = $fetchUserDetails['id'];                     

        $cdata['UserID'] = $fetchUserDetails['user_id'];

        $cdata['contact_name'] = $fetchUserDetails['contact_name'];

        $cdata['contact_no'] = $fetchUserDetails['contact_no'];                                                                                    

        $data_response = $cdata;

      }



      $response['success'] = "1";

      $response['message'] = "contact sucessfully added"; 

      $response['data']=$data_response;

    }



  }else{



    $response['success'] = "0";

    $response['message'] = "you have allready Added";



  }



}else{

  $response['success'] = "0";

  $response['message'] = "Please enter all required fields.";

}

echo json_encode($response);



break;





#########################################################################################################################





case "Get Contact API":



$user_id = $_REQUEST['user_id'];

$res = mysqli_query($con,"select * from `athlete_contact_user` WHERE `user_id` = '$user_id'");

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

break;

#######################################################################################################################



case "Send Request":



$user_id = $_REQUEST['user_id'];

$to_request_id = $_REQUEST['to_request_id'];

$from_request_id = $_REQUEST['from_request_id'];



if ($to_request_id != '' && $from_request_id != '') {

  if ($to_request_id != $from_request_id) {

    $res = mysqli_query($con, "select * from `athlete_chat_users` WHERE (`request_form`='$from_request_id' && `request_to`='$to_request_id')  || (`request_form`='$to_request_id' && `request_to`='$from_request_id')");



    if (mysqli_num_rows($res) == 0) {

      $add_fav = mysqli_query($con, "INSERT INTO `athlete_chat_users`(`request_form`, `request_to`,`status`) VALUES ('$from_request_id','$to_request_id','0')");

      $eventid = mysqli_insert_id($con);



      if ($add_fav) {

        $res1_uu = mysqli_query($con, "SELECT * FROM `athlete_users` WHERE `user_id`='$to_request_id'");

        while ($rowuu = mysqli_fetch_assoc($res1_uu)) {

          $user_token = $rowuu['mobile_token'];

        }

        $res1_uu_stu = mysqli_query($con, "SELECT * FROM `athlete_users` WHERE `user_id`='$from_request_id'");

        while ($rowuu_stu = mysqli_fetch_assoc($res1_uu_stu)) {

          $user_student = $rowuu_stu;

        }

        error_reporting(-1);

        ini_set('display_errors', 'On');

        require_once __DIR__ . '/firebase.php';

        require_once __DIR__ . '/push.php';

        $firebase = new Firebase();

        $push = new Push();







        $emptTest1 = array("status" => '1', "message" => "Request for adding", "id" => $eventid, "data" => $user_student);

        $message1 = json_encode($emptTest1);



//$payload = array();

        $payload['Msg'] = $message1;

//$payload['score'] = '5.6';

//echo $message11;

        $title = "You are added by Athelete";





//$message=$fullnm;



        $emptTest = array("status" => '1', "message" => "Request for adding", "id" => $eventid, "data" => $user_student);





        $emptTest11 = array("status" => '1', "message" => 'Request for adding', "id" => $eventid, "data" => $user_student);





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

          $regId = $user_token;

          $response = $firebase->send($regId, $json);

        }

        $msg = 'Request send by '.$user_student['user_name'];





        if ($response != '') {

/*$json = json_decode($response, true);

//echo $json['success']; 



if($json['success']==1){

$notification_status = '1';               

}else{

$notification_status = '0';

}*/

$push_noti = mysqli_query($con, "INSERT INTO `pushnotifications`(`user_id`, `to_id`,`message`,`status`) VALUES ('$from_request_id','$to_request_id','$msg','0')");

}







$empt[] = array("res" => '1', "Result" => 'Request for Adding');

echo json_encode($empt);

} else {

  $empt[] = array("res" => '0', "Result" => 'Error');

  echo json_encode($empt);

}

} else {



  $empt[] = array("res" => '0', "Result" => 'All ready Added');

  echo json_encode($empt);

}

} else {

  $empt[] = array("res" => '0', "Result" => 'same request id not exists.');

  echo json_encode($empt);

}

} else {

  $empt[] = array("res" => '0', "Result" => 'Please enter all required fields');

  echo json_encode($empt);

}



break;







####################################################################################################################



case"user_search_name":

{

  $name=$_REQUEST['name'];

  $res=mysqli_query($con,"SELECT * FROM `athlete_users` WHERE  user_name LIKE '%$name%' ");

  while($row=mysqli_fetch_assoc($res))

  {

    $image = $row['profile_image'];

    if(!empty($image)){

      $iamges = $image;

    }else{

      $iamges = "dummy-image.jpg";

    }

    $empt=$row;

    $alldata[] = array("data"=>$empt,"image"=>$iamges);



  }

  if($empt){

    $empt1=array("res"=>'1',"message"=>$alldata);

    echo json_encode($empt1); 

  }else{

    $empt1=array("res"=>'0',"message"=>'Not Found');

    echo json_encode($empt1);

  }

}

break;



################################################################################################





case "response By friend": {



  $requestid = $_REQUEST['requestid'];

  $status = $_REQUEST['status'];

  $from_id = $_REQUEST['from_id'];

  $to_id = $_REQUEST['to_id'];





  if ($from_id != '' && $to_id != '') {

    $res = mysqli_query($con, "select * from `athlete_chat_users` WHERE `request_form`='$to_id' && `request_to`='$from_id'");

    if (mysqli_num_rows($res) == 1) {



      if ($status == 2) {

        $noti_status = '2';

        $add_delete = mysqli_query($con, "DELETE FROM `athlete_chat_users` WHERE `request_form`='$to_id' && `request_to`='$from_id'");

      } elseif ($status == 1) {

        $noti_status = '1';

        $add_fav = mysqli_query($con, "UPDATE `athlete_chat_users` SET `status`='$status' WHERE `request_form`='$to_id' && `request_to`='$from_id'");

      } else {

        $noti_status = '0';

        $empt[] = array("res" => '1', "Result" => 'Request is pending');

        echo json_encode($empt);

        exit;

      }



      if ($add_fav) {

        $res1_uu = mysqli_query($con, "SELECT * FROM `athlete_users` WHERE `user_id`='$to_id'");

        while ($rowuu = mysqli_fetch_assoc($res1_uu)) {

          $user_token = $rowuu['mobile_token'];

        }



        $res1_uu_meb = mysqli_query($con, "SELECT * FROM `athlete_users` WHERE `user_id`='$from_id'");

        while ($rowuu_meb = mysqli_fetch_assoc($res1_uu_meb)) {

          $user_meb_dd = $rowuu_meb;

        }



        error_reporting(-1);

        ini_set('display_errors', 'On');

        require_once __DIR__ . '/firebase.php';

        require_once __DIR__ . '/push.php';

        $firebase = new Firebase();

        $push = new Push();

        $emptTest1 = array("status" => '1', "message" => "Request for adding added", "data" => $user_meb_dd);

        $message1 = json_encode($emptTest1);

//$payload = array();

        $payload['Msg'] = $message1;

//$payload['score'] = '5.6';

//echo $message11;

        $title = "You are added";



//$message=$fullnm;



        $emptTest = array("status" => '1', "message" => "Request for adding added", "data" =>$user_meb_dd);

//$message=json_encode($emptTest);

//$message ="Request for blood Donation";        

        $emptTest11 = array("status" => '1', "message" => "Request for adding added", "data" => $user_meb_dd);



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



        $msg = 'Request accepted successfully '.$user_meb_dd['user_name'];





        $json = '';

        $response = '';



        if ($push_type == 'topic') {

          $json = $push->getPush();

          $response = $firebase->sendToTopic('global', $json);

        } else if ($push_type == 'individual') {

          $json = $push->getPush();

//$regId = isset($_REQUEST['$regId1']) ? $_REQUEST['$regId1'] : '';

          $regId = $user_token;

          $response = $firebase->send($regId, $json);

        }



        if ($response != '') {

/* $json = json_decode($response, true);

//echo $json['success']; 



if($json['success']==1){

$notification_status = '1';               

}else{

$notification_status = '0';

}*/



if($noti_status == 2){    

  $push_noti_del = mysqli_query($con, "DELETE FROM `pushnotifications` WHERE `user_id`='$to_id' && `to_id`='$from_id'");

}

if($noti_status == 1){    

  $add_fav1 = mysqli_query($con, "UPDATE `pushnotifications` SET `status`='$noti_status' WHERE `user_id`='$to_id' && `to_id`='$from_id'");

  $push_noti = mysqli_query($con, "INSERT INTO `pushnotifications`(`user_id`, `to_id`,`message`,`status`) VALUES ('$from_id','$to_id','$msg','$noti_status')");

}      

}

$empt[] = array("res" => '1', "Result" => 'Request accepeted successfully');

echo json_encode($empt);

exit;

} else {

  $empt[] = array("res" => '1', "Result" => 'Request Rejected Successfully.');

  echo json_encode($empt);

  exit;

}

} else {

  $empt[] = array("res" => '0', "Result" => 'Request not found.');

  echo json_encode($empt);

  exit;

}

} else {

  $empt[] = array("res" => '0', "Result" => 'Please enter all required fields');

  echo json_encode($empt);

  exit;

}

}

break;

######################################################################################################################edit by mahesh jangid





case "get all friends":



$user_id = $_REQUEST['user_id'];

$status = $_REQUEST['status'];

$request_for = $_REQUEST['request_for'];

$res = mysqli_query($con, "select * from `athlete_report_request` WHERE (`request_from`='$user_id' && `status`='$status' && `request_for` = '$request_for' || `request_to`='$user_id' && `status`='$status' && `request_for` = '$request_for') ");



while ($row = mysqli_fetch_assoc($res)) {

  if ($user_id != $row['request_to']) {

    $request_to = $row['request_to'];

  } else if ($user_id != $row['request_from']) {

    $request_to = $row['request_from'];

  }



  $res2 = mysqli_query($con, "select * from `athlete_users` WHERE `user_id`='$request_to'");

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



break;



################################################################################################################ edit by mahesh jangid

case "connection_request_status":



$user_id = $_REQUEST['user_id'];

/*

$res = mysqli_query($con, "SELECT a.*, b.profile_image,b.user_name FROM `pushnotifications` a left JOIN `athlete_users` b on a.user_id = b.user_id WHERE a.to_id='$user_id'");

*/



$res = mysqli_query($con,"SELECT a.*, b.profile_image , b.user_name FROM `pushnotifications` a left JOIN `athlete_users` b on a.user_id = b.user_id WHERE a.to_id='$user_id'") ;



while ($row = mysqli_fetch_assoc($res)) 

{

  $alldata[] = $row;

}



if ($alldata) {

  $empt1 = array("res" => '1', "message" => $alldata);

  echo json_encode($empt1);

} else {

  $empt1 = array("res" => '0', "message" => 'Not Found');

  echo json_encode($empt1);

}

break;





################################################################################################edit by mahesh jangid$chat_data



case "send_msg":



$from_request_id = $_REQUEST['from_id'];

$to_request_id = $_REQUEST['to_id'];

$msg_type = $_REQUEST['msg_type'];

$message = $_REQUEST['message'];

$chat_type = $_REQUEST['chat_type'];

$group_type = $_REQUEST['group_type'];



$cur_date = date("y-m-d");

$cur_time = date('H:i:s');

$date_time = $cur_date." ".$cur_time;

if ($to_request_id != '' && $from_request_id != '' && $msg_type != '' && $chat_type != '') 

{

  $txt = "Friend_request";

  if($chat_type == "OtoO")

  {

    $res = mysqli_query($con, "select * from `athlete_report_request` WHERE (`request_from`='$from_request_id' && `request_to`='$to_request_id' && `request_for` = '$txt' && `status` = 2) || (`request_from`='$to_request_id' && `request_to`='$from_request_id' && `request_for` = '$txt' && `status` = 2)");

  }

  else if($chat_type == "MtoM")

  {

    $res = mysqli_query($con, "select * from `athlete_chat_group_member` WHERE `group_id`='$to_request_id' && `group_member`='$from_request_id'"); 

  }

//echo mysqli_num_rows($res);

  if (mysqli_num_rows($res) >= 1) 

  {



    if($chat_type == "OtoO")

    {

      $check_list = mysqli_query($con, "select * from `athlete_chatlist` where (`from_id` = '$from_request_id' && to_id = '$to_request_id ' && `chat_type` = '$chat_type') || (`from_id` = '$to_request_id' && to_id = '$from_request_id' && `chat_type` = '$chat_type')");

    }

    else if($chat_type == "MtoM")

    {

      $check_list = mysqli_query($con, "select * from `athlete_chatlist` where  `to_id` = '$to_request_id' && `chat_type` = '$chat_type'");

    }





    if($row21 = mysqli_fetch_assoc($check_list))

    {

      $up_id = $row21['id'];



      $up_check_list = mysqli_query($con,"update `athlete_chatlist` set `from_id` = '$from_request_id', `to_id` = '$to_request_id', `date_time` = '$date_time' where `id` = '$up_id' && `chat_type` = '$chat_type' ");

    }

    else

    {

      $in_check_list = mysqli_query($con,"insert into `athlete_chatlist`(`from_id`,`to_id`,`chat_type`,`date_time`) values('$from_request_id','$to_request_id','$chat_type','$date_time')");

    }    











    if((($msg_type == "Message") || $msg_type == "Post") && $message != '')

    {
      $post_id = !isset($_REQUEST['post_id'])?0:$_REQUEST['post_id'];

      $add_fav = mysqli_query($con, "INSERT INTO `user_chat_msg`(`from_id`, `to_id`,`post_id`,`msg_type`,`description`,`chat_type`,`date_time`,`cur_date`,`cur_time`) VALUES ('$from_request_id','$to_request_id','$post_id','$msg_type','$message','$chat_type','$date_time','$cur_date','$cur_time')");



      $eventid = mysqli_insert_id($con);

      $last_id = mysqli_insert_id($con);

      if($add_fav)

      {

        $data['res'] = "1";

        $data['Result'] = "Message Send Sucessfully.";



      }

      else

      {

        $data['res'] = "0";

        $data['Result'] = "Error.";



      }



    }

    else if($msg_type == "Image" || $msg_type == "Video")

    {

      foreach($_FILES["file"]["tmp_name"] as $key=>$tmp_name)

      { 

        /*$chat_data = 'https://ctdworld.co/athlete/uploads/chat_data/';*/

        $target="uploads/chat_data/";

        $type = $_FILES['file']['type'][$key];

        $name = $_FILES['file']['name'][$key];

        $name1 = str_replace(" ","",$name);

        $new_name = uniqid().basename($name1);

        $new = $target.$new_name;

        $file_url = CHAT_DATA.$new_name;

        if(move_uploaded_file($_FILES['file']['tmp_name'][$key],$new))

        {

          $add_fav = mysqli_query($con, "INSERT INTO `user_chat_msg`(`from_id`, `to_id`,`msg_type`,`description`,`filename`,`chat_type`,`date_time`,`cur_date`,`cur_time`) VALUES ('$from_request_id','$to_request_id','$msg_type','$file_url','$new_name','$chat_type','$date_time','$cur_date','$cur_time')");

          $eventid = mysqli_insert_id($con);

          $last_id = mysqli_insert_id($con);

        }



      }



      if($add_fav)

      {

        if($msg_type == "Image")

        {

          $data['res'] = "1";

          $data['Result'] = "Image Send Successfully";



        }

        else if($msg_type == "Video")

        {

          $data['res'] = "1";

          $data['Result'] = "Video Send Successfully";



        }



      }  

    }

    /*dummy group msg*/

    $msg_id = $eventid;

    $group_id = $to_request_id;

    if($chat_type == "MtoM")

    {

      $sql_check = mysqli_query($con,"select * from `athlete_chat_group_member` where `group_id` = '$group_id'");

      while($rm = mysqli_fetch_assoc($sql_check))

      {

        $member_id = $rm['group_member'];

        $status=($from_request_id==$member_id)?'1':'0';



        $in_dt = mysqli_query($con,"insert into `dummy_group_msg`(`msg_id`,`group_id`,`member_id`,`date_time`,    `status`)value('$msg_id','$group_id','$member_id','$date_time','$status')");

      }



    }











    /* Push notification */

    if($chat_type == "OtoO")

    {

      $res1_uu = mysqli_query($con, "SELECT * FROM `athlete_users` WHERE `user_id`='$to_request_id'");

      while ($rowuu = mysqli_fetch_assoc($res1_uu)) {

        $user_token = $rowuu['mobile_token'];

      }

    }else if($chat_type == "MtoM"){ 

      $group_id = $to_request_id;



      $sql_check = mysqli_query($con,"select * from `athlete_chat_group_member` where `group_id` = '$group_id'");

      while($rm = mysqli_fetch_assoc($sql_check))

      {

        $member_id = $rm['group_member'];

        if($member_id!=$from_request_id){

          $user_tok[]=get_mobile_token($member_id);

        }

      }





    }

    $res1_uu_stu = mysqli_query($con, "SELECT * FROM `athlete_users` WHERE `user_id`='$from_request_id'");

    while ($rowuu_stu = mysqli_fetch_assoc($res1_uu_stu)) {

      $user_student = $rowuu_stu;

    }





    $chat_data = mysqli_query($con, "SELECT * FROM `user_chat_msg` WHERE `id`='$last_id' && `status` = 0");

    if($chat_row = mysqli_fetch_assoc($chat_data))

    {

      $dt_date = $chat_row['date_time'];



      $chatdata['from_id'] = $chat_row['from_id'];

      $chatdata['from_name'] = $user_student['user_name'];

      $chatdata['profile_image'] = PROFILE_IMAGE.$user_student['profile_image'];

      $chatdata['to_id'] = $chat_row['to_id'];

      $chatdata['msg_type'] = $chat_row['msg_type'];

      $chatdata['date_time'] = $chat_row['date_time'];

      $chatdata['data_id'] = $eventid; 

      $chatdata['chat_type']=$chat_type; 

      $chatdata['group_type']=$group_type; 

      if($chat_type == "MtoM"){

        $group_data = mysqli_query($con, "SELECT * FROM `athlete_chat_group` WHERE id='$to_request_id' ");

        if($group_row = mysqli_fetch_assoc($group_data))

        {

          $chatdata['group_name'] = $group_row[group_name];

          $chatdata['group_icon'] = $group_row[group_icon];

          $chatdata['admin_id'] = $group_row[admin_id];

          $chatdata['group_id'] = $group_row[id];

        }



      }





/* $chatdata['type'] = $type;  

$chatdata['name'] = $name;  

$chatdata['name1'] = $name1; */ 

}

$i=0;

$chat_data1 = mysqli_query($con, "SELECT `description` FROM `user_chat_msg` WHERE `date_time`='$dt_date' && `status` = 0");

while($chat_row1 = mysqli_fetch_assoc($chat_data1))

{

  $chatdata['urls'][$i] = $chat_row1;

  $i++;

}

$data['message'] = $chatdata;
if((isset( $_REQUEST['post_id'])) && (!empty( $_REQUEST['post_id'])) ) {


  $p_id = $_REQUEST['post_id'];
  $po_query = "SELECT athlete_news_feed.*,athlete_users.user_name,athlete_users.profile_image FROM `athlete_news_feed` LEFT JOIN athlete_users ON athlete_users.user_id = athlete_news_feed.user_id WHERE athlete_news_feed.id= $p_id";
  //echo $po_query;die();
  $post_data = mysqli_query($con,$po_query);

      if($get_post_data = mysqli_fetch_assoc($post_data)) {
        $da_post['title'] = $get_post_data['title'];
        $da_post['post_message'] = ($get_post_data['post_share_text'] != 0)?$get_post_data['post_share_text']:'';
        $da_post['media_url'] = $get_post_data['media_url'];
        $da_post['date_time'] = date('d M,Y',strtotime($get_post_data['date_time']));
        $da_post['user_name'] = $get_post_data['user_name'];
        $da_post['user_image'] = $get_post_data['profile_image'];
        
      }
      $data['post_data'] = $da_post;
}






error_reporting(-1);

ini_set('display_errors', 'On');

require_once __DIR__ . '/firebase.php';

require_once __DIR__ . '/push.php';

$firebase = new Firebase();

$push = new Push();



$msg = 'chat_detail';

$request_for = "New Message";



$emptTest1 = array("res" => '1', "chat_detail" => $chatdata, "id" => $eventid);

$message1 = json_encode($emptTest1);



//$payload = array();

$payload['Msg'] = $message1;

//$payload['score'] = '5.6';

//echo $message11;

$title = $msg;



$emptTest = array("res" => '1', "chat_detail" => $chatdata, "id" => $eventid);



$emptTest11 = array("res" => '1', "chat_detail" => $chatdata, "id" => $eventid);



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

  if($chat_type == "MtoM"){  

    if(!empty($user_tok)){ 

    foreach($user_tok as $val){ 

      $regId1 = $val;



      $response = $firebase->send($regId1, $json);

    }

    }

  }else{

    $regId = $user_token;

    $response = $firebase->send($regId, $json);



  }

}



if ($response != '') 

{

/*$json = json_decode($response, true);

//echo $json['success']; 



if($json['success']==1){

$notification_status = '1';               

}else{

$notification_status = '0';

} there chage */

/*$push_noti = mysqli_query($con, "INSERT INTO `pushnotifications`(`user_id`, `to_id`,`message`,`request_for`,`status`) VALUES ('$from_request_id','$to_request_id','$msg','$request_for','0')");*/

}



echo json_encode($data);



} 

else {

  $img_type = $_FILE['img_file']['type'];

  $empt[] = array("res" => '0', "Result" => 'This user not added friend list');

  echo json_encode($empt);

}

} else {

  $empt[] = array("res" => '0', "Result" => 'Please enter all required fields');

  echo json_encode($empt);

}

break;



####################################################################################################################

case "get_msg_list":



$from_id = $_REQUEST['from_id'];

$to_id = $_REQUEST['to_id'];

$chat_type = $_REQUEST['chat_type'];

if ($from_id != '' && $to_id != '') 

{

  if($chat_type == "OtoO")

  {

    $update_status = mysqli_query($con, "update `user_chat_msg` set `status`=1 WHERE `from_id`='$to_id' && `to_id`='$from_id' && `chat_type` = '$chat_type' ");    



    $res = mysqli_query($con, "Select `cur_date` from (SELECT DISTINCT `cur_date` from `user_chat_msg` WHERE (`from_id`='$from_id' && `to_id`='$to_id' && `chat_type` = '$chat_type' )  || (`from_id`='$to_id' && `to_id`='$from_id' && `chat_type` = '$chat_type' ) ORDER BY `cur_date` desc limit 5) tmp ORDER BY tmp.cur_date asc");    





    while ($row = mysqli_fetch_assoc($res)) 

    {



      $cur_date = $row['cur_date'];

      $res1 = mysqli_query($con,"SELECT * from `user_chat_msg` WHERE (`from_id`='$from_id' && `to_id`='$to_id' && `cur_date` = '$cur_date' && `chat_type` = '$chat_type' )  || (`from_id`='$to_id' && `to_id`='$from_id' && `cur_date` = '$cur_date' && `chat_type` = '$chat_type' ) ORDER BY `cur_time`") ; 



      while($row1 = mysqli_fetch_assoc($res1))

      {

        $from_id1 = $row1['from_id'];

        $id_name = mysqli_query($con, "select * from `athlete_users` where `user_id` = '$from_id1'");

        if($in_row = mysqli_fetch_assoc($id_name))

        {

          $row1['from_name'] = $in_row['user_name'];

          $row1['from_profile_image'] = PROFILE_IMAGE.$in_row['profile_image'];

        }
        if($row1['post_id'] != 0) {
          $get_post_id = $row1['post_id'];
          $pos_query = "SELECT athlete_news_feed.*,athlete_users.user_name,athlete_users.profile_image FROM `athlete_news_feed` LEFT JOIN athlete_users ON athlete_users.user_id = athlete_news_feed.user_id WHERE athlete_news_feed.id= $get_post_id";
          $post_data_get = mysqli_query($con,$pos_query);

              if($get_post_data = mysqli_fetch_assoc($post_data_get)) {
                $row1['post_title'] = $get_post_data['title'];
                $row1['post_message'] = ($get_post_data['post_share_text'] != 0)?$get_post_data['post_share_text']:'';
                $row1['post_media_url'] = $get_post_data['media_url'];
                $row1['post_date_time'] = date('d M,Y',strtotime($get_post_data['date_time']));
                $row1['post_user_name'] = $get_post_data['user_name'];
                $row1['post_user_image'] = $get_post_data['profile_image'];
                
              }
        }

        $alldata1[] = $row1;

      }



      $alldata[] = $alldata1;

      unset($alldata1);

    }

  }

  else if($chat_type == "MtoM")

  {



    $update_status = mysqli_query($con, "update `dummy_group_msg` set `status`=1 WHERE `group_id`='$to_id' && `member_id`='$from_id'  ");    





    $res = mysqli_query($con, "Select `cur_date` from (SELECT DISTINCT `cur_date` from `user_chat_msg` WHERE `to_id`='$to_id' && `chat_type` = '$chat_type' ORDER BY `cur_date` desc limit 5) tmp ORDER BY tmp.cur_date asc"); 



    while ($row = mysqli_fetch_assoc($res)) 

    {



      $cur_date = $row['cur_date'];

      $res1 = mysqli_query($con,"SELECT * from `user_chat_msg` WHERE `to_id`='$to_id' && `cur_date` = '$cur_date' && `chat_type` = '$chat_type'  ORDER BY `cur_time`") ; 



      while($row1 = mysqli_fetch_assoc($res1))

      {

        $from_id1 = $row1['from_id'];

        $id_name = mysqli_query($con, "select * from `athlete_users` where `user_id` = '$from_id1'");

        

        if($in_row = mysqli_fetch_assoc($id_name))

        {

          $row1['from_name'] = $in_row['user_name'];

          $row1['from_profile_image'] = PROFILE_IMAGE.$in_row['profile_image'];

        }

        if($row1['post_id'] != 0) {
          $get_post_id = $row1['post_id'];
          $pos_query = "SELECT athlete_news_feed.*,athlete_users.user_name,athlete_users.profile_image FROM `athlete_news_feed` LEFT JOIN athlete_users ON athlete_users.user_id = athlete_news_feed.user_id WHERE athlete_news_feed.id= $get_post_id";         
          $post_data_get = mysqli_query($con,$pos_query);

              if($get_post_data = mysqli_fetch_assoc($post_data_get)) {
                $row1['title'] = $get_post_data['title'];
                $row1['post_message'] = ($get_post_data['post_share_text'] != 0)?$get_post_data['post_share_text']:'';
                $row1['media_url'] = $get_post_data['media_url'];
                $row1['date_time_post'] = date('d M,Y',strtotime($get_post_data['date_time']));
                $row1['post_user_name'] = $get_post_data['user_name'];
                $row1['post_user_image'] = $get_post_data['profile_image'];
              }
        }

        $alldata1[] = $row1;

      }



      $alldata[] = $alldata1;

      unset($alldata1);

    }

  }

  //print_r($alldata);die();

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

  $empt = array("res" => '0', "message" => 'Please enter all required fields');

  echo json_encode($empt);

}



break;







####################################################################################################################



case "refresh_chat_list":



$from_id = $_REQUEST['from_id'];

$to_id = $_REQUEST['to_id'];

$last_date = $_REQUEST['last_date'];

$chat_type = $_REQUEST['chat_type'];



if ($from_id != '' && $to_id != '' && $last_date != '') 

{

  if($chat_type == "OtoO")

  {

    $res = mysqli_query($con, "Select `cur_date` from (SELECT DISTINCT `cur_date` from `user_chat_msg` WHERE (`from_id`='$from_id' && `to_id`='$to_id' && `chat_type` = '$chat_type' &&`cur_date` <= '$last_date')  || (`from_id`='$to_id' && `to_id`='$from_id' && `chat_type` = '$chat_type'  && `cur_date` <= '$last_date') ORDER BY `cur_date` desc limit 3) tmp ORDER BY tmp.cur_date asc");    



    while ($row = mysqli_fetch_assoc($res)) 

    {

      $cur_date = $row['cur_date'];

      $res1 = mysqli_query($con,"SELECT * from `user_chat_msg` WHERE (`from_id`='$from_id' && `to_id`='$to_id' && `cur_date` = '$cur_date' && `chat_type` = '$chat_type' )  || (`from_id`='$to_id' && `to_id`='$from_id' && `cur_date` = '$cur_date' && `chat_type` = '$chat_type' ) ORDER BY `cur_time`") ; 



      while($row1 = mysqli_fetch_assoc($res1))

      {

        $from_id1 = $row1['from_id'];

        $id_name = mysqli_query($con, "select * from `athlete_users` where `user_id` = '$from_id1'");

        if($in_row = mysqli_fetch_assoc($id_name))

        {

          $row1['from_name'] = $in_row['user_name'];

          $row1['from_profile_image'] = PROFILE_IMAGE.$in_row['profile_image'];

        }

        $alldata1[] = $row1;

      }



      $alldata[] = $alldata1;

      unset($alldata1);

    }

  }

  else if($chat_type == "MtoM")

  {

/*$res = mysqli_query($con, "Select `cur_date` from (SELECT DISTINCT `cur_date` from `user_chat_msg` WHERE (`from_id`='$from_id' && `to_id`='$to_id' && `chat_type` = '$chat_type' &&`cur_date` <= '$last_date')  || (`from_id`='$to_id' && `to_id`='$from_id' && `chat_type` = '$chat_type'  && `cur_date` <= '$last_date') ORDER BY `cur_date` desc limit 3) tmp ORDER BY tmp.cur_date asc");    

*/



$res = mysqli_query($con, "Select `cur_date` from (SELECT DISTINCT `cur_date` from `user_chat_msg` WHERE `to_id`='$to_id' && `chat_type` = '$chat_type' && `cur_date` <= '$last_date' ORDER BY `cur_date` desc limit 3) tmp ORDER BY tmp.cur_date asc"); 



while ($row = mysqli_fetch_assoc($res)) 

{



  $cur_date = $row['cur_date'];

  $res1 = mysqli_query($con,"SELECT * from `user_chat_msg` WHERE `to_id`='$to_id' && `cur_date` = '$cur_date' && `chat_type` = '$chat_type'  ORDER BY `cur_time`");

  while($row1 = mysqli_fetch_assoc($res1))

  {

    $from_id1 = $row1['from_id'];

    $id_name = mysqli_query($con, "select * from `athlete_users` where `user_id` = '$from_id1'");

    if($in_row = mysqli_fetch_assoc($id_name))

    {

      $row1['from_name'] = $in_row['user_name'];

      $row1['from_profile_image'] = PROFILE_IMAGE.$in_row['profile_image'];

    }

    $alldata1[] = $row1;

  }

  $alldata[] = $alldata1;

  unset($alldata1);

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

else {

  $empt = array("res" => '0', "message" => 'Please enter all required fields');

  echo json_encode($empt);

}



break;



########################################################################################################################        



case "update_token":





$user_id = $_REQUEST['user_id'];      

$mobile_token = $_REQUEST['mobile_token'];

if ($user_id != '' && $mobile_token != '') {

  $uArr = mysqli_query($con, "select * from `athlete_users` where `user_id`='$user_id'");

  if (mysqli_num_rows($uArr)>0) {

    $sqlUser = mysqli_query($con,"update `athlete_users` set `mobile_token`='$mobile_token' where `user_id`='$user_id' "); 





    $fetchUserDetails = mysqli_fetch_array($uArr);

    $data['success'] = "1";

    $data['message'] = "Your device token update successfully changed.";

    $data['User ID'] = $fetchUserDetails['user_id'];







  } else {

    $data['success'] = "0";

    $data['message'] = "Please enter correct user id.";

  }

} else {

  $data['success'] = "0";

  $data['message'] = "Please enter all required fields.";

}







echo json_encode($data);



break;







////////////////////////////////////////////////////////////////////////////////////////////



case "get_school_review_OLD_obselete":



$user_id = $_REQUEST['user_id'];



if($user_id != '')

{   

  $res = mysqli_query($con,"SELECT a.*, b.profile_image , b.user_name FROM `athlete_school_review` a left JOIN `athlete_users` b on a.user_id = b.user_id WHERE a.user_id='$user_id' ") ;



  if ($row = mysqli_fetch_array($res)) 

  {

    $sub = $row['subject'];

    $alldata['id'] = $row['id'];

    $alldata['profile_image'] = $row['profile_image'];

    $alldata['user_name'] = $row['user_name'];

    $alldata['comment'] = $row['comments'];

    $alldata['date'] = $row['date_time'];

  }

  $res1 = mysqli_query($con,"SELECT * from `athlete_school_review` WHERE user_id='$user_id' ") ;

  $i=0;

  while ($row1 = mysqli_fetch_array($res1))

  {

    $grade= $row1['grade'];

    $tach_id = $row1['teacher_id'];

    $techs = mysqli_query($con,"SELECT * from `athlete_users` where user_id='$tach_id'");

    while($tech_row = mysqli_fetch_array($techs))

    {

      $teacher_name = $tech_row['user_name'];

    }

    $alldata['teacher_name'] = $teacher_name;

    $review_sys[$i]['subject'] = $row1['subject'];

    $review_sys[$i]['grade'] = $row1['grade'];





    $i++;

  }

  $alldata['review'] = $review_sys;





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



################################################################################################

case "school_review_report":



$request_from = $_REQUEST['request_from'];

$request_to = $_REQUEST['request_to'];



if($request_to != '' && $request_from != '')

{    

  $txt = "Teacher";

  $res1 = mysqli_query($con,"SELECT * from `athlete_user_role` WHERE role_name='$txt' and role_id='$request_from'");



  $res2 = mysqli_query($con,"SELECT * from `athlete_report_request` WHERE request_from='$request_from' and request_to='$request_to' and status=1");



  if($row = mysqli_fetch_assoc($res1) || $row2 = mysqli_fetch_assoc($res2))

  {



    $user_id =  $_REQUEST['request_to'];

    $res = mysqli_query($con,"SELECT a.*, b.profile_image , b.user_name FROM `athlete_school_review` a left JOIN `athlete_users` b on a.user_id = b.user_id WHERE a.user_id='$user_id'") ;

    if ($row = mysqli_fetch_assoc($res)) 

    {



      $alldata['id'] = $row['id'];

      $alldata['profile_image'] = $row['profile_image'];

      $alldata['user_name'] = $row['user_name'];

      $alldata['comment'] = $row['comments'];

      $alldata['date'] = $row['date_time'];

      $res1 = mysqli_query($con,"SELECT * from `athlete_school_review` WHERE user_id='$user_id' ") ;

      $i=0;

      while ($row1 = mysqli_fetch_array($res1))

      {

        $grade= $row1['grade'];

        $tach_id = $row1['teacher_id'];

        $techs = mysqli_query($con,"SELECT * from `athlete_users` where user_id='$tach_id'");

        while($tech_row = mysqli_fetch_array($techs))

        {

          $teacher_name = $tech_row['user_name'];

        }

        $alldata['teacher_name'] = $teacher_name;

        $review_sys[$i]['subject'] = $row1['subject'];

        $review_sys[$i]['grade'] = $row1['grade'];





        $i++;

      }

      $alldata['review'] = $review_sys;

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



  }

  else

  {

    $data['success'] = "0";

    $data['message'] = "You can not see School Report , Please Send Request to athlete.";

    echo json_encode($data);

  }



}

else

{

  $data['success'] = "0";

  $data['message'] = "Please enter all required fields.";

  echo json_encode($data);

}    

break;

############################################################################################    

case "send_report_request":



$request_from = $_REQUEST['request_from'];

$request_to = $_REQUEST['request_to'];

$request_for = $_REQUEST['request_for'];



$cur_date = date("y-m-d");

$cur_time = date('H:i:s');

$date_time = $cur_date." ".$cur_time;



if($request_to != '' && $request_from != '' && $request_for !='')

{  

  $res2 = mysqli_query($con,"SELECT * from `athlete_report_request` WHERE request_from='$request_from' and request_to='$request_to' and request_for = '$request_for' and status=1");

  if($row2 = mysqli_fetch_assoc($res2))

  {

    $data['res'] = "0";

    $data['Result'] = "You allready Sent Request.";

    echo json_encode($data);  

  }

  else

  {

    $add_rqst=mysqli_query($con,"INSERT INTO `athlete_report_request` (`request_from`, `request_to` , `request_for`,`date_time`) 

      VALUES('$request_from','$request_to', '$request_for','$date_time')"); 



    $eventid = mysqli_insert_id($con);



    if($add_rqst)

    {

      $res1_uu = mysqli_query($con, "SELECT * FROM `athlete_users` WHERE `user_id`='$request_to'");

      while ($rowuu = mysqli_fetch_assoc($res1_uu)) 

      {

        $user_token = $rowuu['mobile_token'];

        /*echo json_encode($user_token); */ 

      }

      $res1_uu_stu = mysqli_query($con, "SELECT * FROM `athlete_users` WHERE `user_id`='$request_from'");

      while ($rowuu_stu = mysqli_fetch_assoc($res1_uu_stu)) 

      {

        $user_student = $rowuu_stu; 

        /*echo json_encode($user_student);  */

      }

      $user_student['request_for']=$request_for;

      error_reporting(-1);

      ini_set('display_errors', 'On');

      require_once __DIR__ . '/firebase.php';

      require_once __DIR__ . '/push.php';

      $firebase = new Firebase();

      $push = new Push();





      if($request_for == "Education")

      {

        $push_msg = 'Request send for Progress Report.';

        $msg = 'Request send for Progress Report.';

      }

      else if($request_for == "Coach_feedback")

      {

        $push_msg = 'Request send for Coach Feedback.';

        $msg = 'Request send for Coach Feedback.';

      }

      else if($request_for == "Friend_request")

      {

        $push_msg = 'Friend Request send.';

        $msg = 'Friend Request send.';

      }

      else if($request_for == "Byteacher_athlete_review")

      {

        $push_msg = 'Request send for School Review.';

        $msg = 'Request send for School Review.';

      }

      else if($request_for == "Access_self_review")

      {

        $push_msg = 'Request send for Self Review.';

        $msg = 'Request send for Self Review.';

      }

      else if($request_for == "view career plan")

      {

        $push_msg = 'Request send for Viewing Career Plan.';

        $msg = 'Request send for Viewing Career Plan.';

      }

      else if($request_for == "view_coach_self_review")

      {

        $push_msg = 'Request send for Viewing Coach Self Review.';

        $msg = 'Request send for Viewing Coach Self Review.';

      }







      $emptTest1 = array("res" => '1', "Result" => $push_msg, "id" => $eventid, "data" => $user_student);

      $message1 = json_encode($emptTest1);

//$payload = array();

      $payload['Msg'] = $message1;

//$payload['score'] = '5.6';

//echo $message11;

//$title = $push_msg;

      $title = "Request";



      $emptTest = array("res" => '1', "Result" => $push_msg, "id" => $eventid, "data" => $user_student);



      $emptTest11 = array("res" => '1', "Result" => $push_msg, "id" => $eventid, "data" => $user_student);



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



      if ($push_type == 'topic') {

        $json = $push->getPush();

        $response = $firebase->sendToTopic('global', $json);

      } else if ($push_type == 'individual') {

        $json = $push->getPush();

//$regId = isset($_REQUEST['$regId1']) ? $_REQUEST['$regId1'] : '';

        $regId = $user_token;

        $response = $firebase->send($regId, $json);

      }







      if ($response != '') 

      {

/*$json = json_decode($response, true);

//echo $json['success']; 



if($json['success']==1){

$notification_status = '1';               

}else{

$notification_status = '0';

}*/

$push_noti = mysqli_query($con, "INSERT INTO `pushnotifications`(`user_id`, `to_id`,`message`,`request_for`,`date_time`) VALUES ('$request_from','$request_to','$msg','$request_for','$date_time')");

}



$data['res'] = "1";

$data['request_for']=$request_for;

$data['Result'] = $push_msg;

echo json_encode($data);  





}

else 

{

  $data['res'] = "0";

  $data['Result'] = "Error.";

  echo json_encode($data);  

/*$empt = array("res" => '0', "Result" => 'Error');

echo json_encode($empt);*/

}



}

}   

else

{

  $data['res'] = "0";

  $data['Result'] = "Please enter all required fields.";

  echo json_encode($data);

}



break;

############################################################################################    

case "response_report_request":



$status = $_REQUEST['status'];

$from_id = $_REQUEST['from_id'];

$to_id = $_REQUEST['to_id']; 

$request_for = $_REQUEST['request_for']; 

//echo "kailash"; die;

if($to_id != '' && $from_id != '' && $request_for != '' && $status != '')

{

  // echo "select * from `athlete_report_request` WHERE `request_from`='$to_id' && `request_to`='$from_id' and `request_for` = '$request_for' and `status` = 1"; die;

  // echo "select * from `athlete_report_request` WHERE `request_from`='$to_id' && `request_to`='$from_id' and `request_for` = '$request_for' and `status` = '$status'";

  $res = mysqli_query($con, "select * from `athlete_report_request` WHERE `request_from`='$to_id' && `request_to`='$from_id' and `request_for` = '$request_for' and `status` = '0'"); 



  if (mysqli_num_rows($res) == 1)  

  {

    if ($status == 0) 

    {

      $noti_status = '0';

      



      $add_fav = mysqli_query($con ,"DELETE FROM `athlete_report_request` WHERE `request_from`='$to_id' && `request_to`='$from_id' && `request_for` = '$request_for'");

    } 

    elseif ($status == 2) 

    {

      $noti_status = '2';

      $add_fav = mysqli_query($con, "UPDATE `athlete_report_request` SET `status`='$status' WHERE `request_from`='$to_id' && `request_to`='$from_id' and `request_for` = '$request_for'");



    }

    else 

    {

      $noti_status = '1';

      $data['request_status'] = "1";

      $data['res'] = "0";

      $data['Result'] = "Request is Pending";

      echo json_encode($data);

      exit;  

    }



    if($add_fav){

      $res1_uu = mysqli_query($con, "SELECT * FROM `athlete_users` WHERE `user_id`='$to_id'");

      while ($rowuu = mysqli_fetch_assoc($res1_uu)){

        $user_token = $rowuu['mobile_token'];

      }

      $res1_uu_meb = mysqli_query($con, "SELECT * FROM `athlete_users` WHERE `user_id`='$from_id'");

      while ($rowuu_meb = mysqli_fetch_assoc($res1_uu_meb)){

        $user_meb_dd = $rowuu_meb;

      }

      $user_meb_dd['request_for']=$request_for;

      $user_meb_dd['request_status']=$status;

      if($status == 0){ 

        if($request_for == "Education"){

          $pushmsg1 = 'Request Rejected for Progress Report.';

          $msg = 'Request Rejected for Progress Report.';

        }

        else if($request_for == "Coach_feedback"){

          $pushmsg1 = 'Request Rejected for Coach Feedback.';

          $msg = 'Request Rejected for Coach Feedback.';

        } 

        else if($request_for == "Friend_request"){

          $pushmsg1 = 'Friend Request Rejected.';

          $msg = 'Friend Request Rejected.';

        } 

        else if($request_for == "Byteacher_athlete_review"){

          $pushmsg1 = 'Request Rejected for School Review.';

          $msg = 'Request Rejected for School Review.';

        }

        else if($request_for == "Access_self_review"){

          $pushmsg1 = 'Request Rejected for Self Review.';

          $msg = 'Request Rejected for Self Review.';

        }

        else if($request_for == "view career plan"){

          $pushmsg1 = 'Request Rejected Viewing Career Plan.';

          $msg = 'Request Rejected for Viewing Career Plan.';

        }



      }

      else if($status == 2){ 

        if($request_for == "Education"){

          $pushmsg1 = 'Request Approved for Progress Report.';

          $msg = 'Request Approved for Progress Report.'; 

        }

        else if($request_for == "Coach_feedback"){

          $pushmsg1 = 'Request Approved for Coach Feedback.';

          $msg = 'Request Approved for Coach Feedback.'; 

        }

        else if($request_for == "Friend_request"){

          $pushmsg1 = 'Friend Request Accepted.';

          $msg = 'Friend Request Accepted.'; 

        }

        else if($request_for == "Byteacher_athlete_review"){

          $pushmsg1 = 'Request Accepted for School Review.';

          $msg = 'Request Accepted for School Review.';

        }

        else if($request_for == "Access_self_review"){

          $pushmsg1 = 'Request Accepted for Self Review.';

          $msg = 'Request Accepted for Self Review.';

        }



        else if($request_for == "view career plan"){

          $pushmsg1 = 'Request Accepted Viewing Career Plan.';

          $msg = 'Request Accepted for Viewing Career Plan.';

        }

      }



      error_reporting(-1);

      ini_set('display_errors', 'On');

      require_once __DIR__ . '/firebase.php';

      require_once __DIR__ . '/push.php';

      $firebase = new Firebase();

      $push = new Push();

      $emptTest1 = array("res" => '1', "Result" => $pushmsg1, "data" => $user_meb_dd);

      $message1 = json_encode($emptTest1);

      $payload['Msg'] = $message1;

      $title = "Request Response";

      $emptTest = array("res" => '1', "Result" => $pushmsg1, "data" =>$user_meb_dd);

      $emptTest11 = array("res" => '1', "Result" => $pushmsg1, "data" => $user_meb_dd);

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

      $msg = $pushmsg1;

      $json = '';

      $response = '';

      if ($push_type == 'topic'){

        $json = $push->getPush();

        $response = $firebase->sendToTopic('global', $json);

      } else if ($push_type == 'individual') {

        $json = $push->getPush();

//$regId = isset($_REQUEST['$regId1']) ? $_REQUEST['$regId1'] : '';

        $regId = $user_token;

        $response = $firebase->send($regId, $json);

      }



      if ($response != ''){     

        /*$add_fav1 = mysqli_query($con, "UPDATE `pushnotifications` SET `status`='$status',`read_status` = 1  WHERE `user_id`='$to_id' && `to_id`='$from_id' && `request_for`='$request_for'");*/

        $sql2 = mysqli_query($con ,"DELETE FROM `pushnotifications` WHERE `user_id`='$to_id' && `to_id`='$from_id' && `request_for`='$request_for'");

// Delete the data..

        $push_noti = mysqli_query($con, "INSERT INTO `pushnotifications`(`user_id`, `to_id`,`message`,`request_for`,`status`) VALUES ('$from_id','$to_id','$msg','$request_for','$status')");

      }

      $data['res'] = "1";

      $data['request_status'] = $status;

      $data['request_for']=$request_for;

      $data['Result'] = $pushmsg1;

      echo json_encode($data);

      exit;

    }else{

      $data['res'] = "0";

      $data['Result'] = "Error.";

      echo json_encode($data);

    }     

  }else{

    $data['res'] = "0";

    $data['Result'] = "Record Not Found.";

    echo json_encode($data); 

  }

}else{

  $data['res'] = "0";

  $data['Result'] = "Please enter all required fields.";

  echo json_encode($data);

}



break;

############################################################################################    

case "create_career_plan":



$athlete_id = $_REQUEST['athlete_id'];

$future_career = $_REQUEST['future_career'];

$location = $_REQUEST['location'];

$scholarship = $_REQUEST['scholarship'];

$school_subject = $_REQUEST['school_subject'];  



$internship = $_REQUEST['internship'];  

$apprenticeship = $_REQUEST['apprenticeship'];  

$email = $_REQUEST['email'];  

$phone_number = $_REQUEST['phone_number'];  





if($athlete_id != '' && $future_career != '' && $school_subject != '' && $location != '' && $scholarship != '')

{

  /*

   * Code modified on 4th of july 2019

   * Initially user was able to create only 1 career plan, and when user tries to add more user

   * was getting error that "Career Plan Is Already Created"

   * 

   * With recent modification user can create as many carrer plan as he want

   * 

  $sql = mysqli_query($con,"Select * from `athlete_career_plan` where athlete_id = '$athlete_id'");

  if($row2 = mysqli_fetch_assoc($sql))

  {

    $data['success'] = "0";

    $data['message'] = "Career Plan Is Already Created.";

    echo json_encode($data);  

  }

  else

  {

    $add_fav = mysqli_query($con, "INSERT INTO `athlete_career_plan`(`athlete_id`, `future_career`,`location`,`scholarship`,`school_subject`) VALUES ('$athlete_id','$future_career','$location','$scholarship','$school_subject')");



    if($add_fav)

    {

      $data['success'] = "1";

      $data['message'] = "Data added Successfully.";

      echo json_encode($data);

    }

    else

    {

      $data['success'] = "0";

      $data['message'] = "Something mistake.";

      echo json_encode($data);

    }

  }

  */



  $add_fav = mysqli_query($con, "INSERT INTO `athlete_career_plan`(`athlete_id`, `future_career`,`location`,`scholarship`,`school_subject`, `internship`, `apprenticeship`, `email`, `phone_number`) VALUES ('$athlete_id','$future_career','$location','$scholarship','$school_subject', '$internship', '$apprenticeship', '$email', '$phone_number')");

  $lastId = mysqli_insert_id($con);

  

  if($add_fav)

  {

    $res = mysqli_query($con,"SELECT user_id, user_name, user_role, profile_image  FROM athlete_users WHERE user_id = '$athlete_id'") ;



    $alldata = array();



    while ($row = mysqli_fetch_assoc($res)) 

    {

      $out = array();

      $userId = $row['user_id'];

      /* Now since we have users we will try to get career plans attached with each user */

      $careerRS = mysqli_query($con,"SELECT *  FROM athlete_career_plan WHERE carrer_id = ".$lastId);

      

      if(mysqli_num_rows($careerRS) !== 0)

      {

        $out = $row;



        while ($crow = mysqli_fetch_assoc($careerRS)) 

        {

          $out['career_plan'][] = $crow;

        }



        $alldata[] = $out;

      }

    } 





    $data['success'] = "1";

    $data['message'] = "Data added Successfully.";

    $data['data'] = $alldata;

    echo json_encode($data);

  }

  else

  {

    $data['success'] = "0";

    $data['message'] = "Something mistake.";

    echo json_encode($data);

  }



}

else

{

  $data['success'] = "0";

  $data['message'] = "Please enter all required fields.";

  echo json_encode($data);

}



break;



##################################################################################################  

case "update_career_plan":



$career_plan_id = $_REQUEST['career_plan_id'];

$athlete_id = $_REQUEST['athlete_id'];

$future_career = $_REQUEST['future_career'];

$location = $_REQUEST['location'];

$scholarship = $_REQUEST['scholarship'];

$school_subject = $_REQUEST['school_subject'];  



$internship = $_REQUEST['internship'];  

$apprenticeship = $_REQUEST['apprenticeship'];  

$email = $_REQUEST['email'];  

$phone_number = $_REQUEST['phone_number'];  



if($athlete_id != '' && $future_career != '' && $school_subject != '' && $location != '' && $scholarship != '')

{

  

  $add_fav = mysqli_query($con, "update  `athlete_career_plan` set 

  `future_career` = '$future_career',

  `location`='$location',

  `scholarship`='$scholarship',

  `school_subject`='$school_subject',

  `internship`='$internship',

  `apprenticeship`='$apprenticeship',

  `email`='$email',

  `phone_number`='$phone_number'

  where `carrer_id` = '$career_plan_id'");

  // echo "update  `athlete_career_plan` set `future_career` = '$future_career',`location`='$location',`scholarship`='$scholarship',`school_subject`='$school_subject' where `carrer_id` = '$career_plan_id'";

  if($add_fav)

  {

    $data['success'] = "1";

    $data['message'] = "Data Updated Successfully.";

    echo json_encode($data);

  }

  else

  {

    $data['success'] = "0";

    $data['message'] = "Something mistake.";

    echo json_encode($data);

  }

  

}

else

{

  $data['success'] = "0";

  $data['message'] = "Please enter all required fields.";

  echo json_encode($data);

}

break;



##################################################################################################    



case "show_career_plan":



$athlete_id = $_REQUEST['athlete_id'];



if($athlete_id != '')

{

  $res1 = mysqli_query($con,"SELECT a.*, b.profile_image , b.user_name FROM `athlete_career_plan` a left JOIN `athlete_users` b on a.athlete_id = b.user_id WHERE a.athlete_id='$athlete_id'") ;



  if ($row = mysqli_fetch_assoc($res1)) 

  {

    $alldata[] = $row;

  }



  if ($alldata) 

  {

    $empt1 = array("res" => '1', "message"=>'Data List', "data" => $alldata);

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

break;    

############################################################################################################

case "get_all_career_plan":



/*

 * Primary requirement where one user can have only one career plan

 * now requirment is changed so query to be modified so that all career plan for all users can be fetched

$res = mysqli_query($con,"SELECT a.*, b.* FROM `athlete_career_plan` a left JOIN `athlete_users` b on a.athlete_id = b.user_id ") ;

while ($row = mysqli_fetch_assoc($res)) 

{



  $alldata[] = $row;

}



if ($alldata) {

  $empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);

  echo json_encode($empt1);

} else {

  $empt1 = array("res" => '0', "message" => 'Data Not Found');

  echo json_encode($empt1);



}    

*/    

    

$loggedInUserId = $_REQUEST['user_id'];



if($loggedInUserId == "")

{

  echo json_encode(["res" => '0', "message" => 'Please provide user id']);

  exit();

}







// $res = mysqli_query($con,"SELECT user_id, user_name, user_role, profile_image  FROM athlete_users WHERE user_id != '$loggedInUserId'") ;



$res = mysqli_query($con,"SELECT user_id, user_name, user_role, profile_image  FROM athlete_users") ;



$alldata = array();



while ($row = mysqli_fetch_assoc($res)) 

{

  $out = array();

  $userId = $row['user_id'];

  

  /* Now since we have users we will try to get career plans attached with each user */

  $careerRS = mysqli_query($con,"SELECT *  FROM athlete_career_plan WHERE athlete_id = ".$userId);

  

  if(mysqli_num_rows($careerRS) !== 0)

  {

    $out = $row;



    /* Get request status */



    $out['request_status'] = "0";

    $requestRs = mysqli_query($con, "SELECT * FROM `athlete_report_request` WHERE `request_from` = '$loggedInUserId' AND `request_to` = '$userId' AND `request_for` = 'view career plan'");

    

    if(mysqli_num_rows($requestRs) !== 0)

    {

      while ($requestRow = mysqli_fetch_assoc($requestRs)) 

      {

        $out['request_status'] = $requestRow['status'] == 2 ? 0 : $requestRow['status'];

      }

    }



    while ($crow = mysqli_fetch_assoc($careerRS)) 

    {

      $out['career_plan'][] = $crow;

    }



    $alldata[] = $out;

  }



  

  

}



if (!empty($alldata)) 

{

  $empt1 = array("res" => '1', "message"=>'Message List', "data" => $alldata);

  echo json_encode($empt1);

} 

else 

{

  $empt1 = array("res" => '0', "message" => 'Data Not Found');

  echo json_encode($empt1);



}



break;   



case "delete_career_plan":



$careerPlanIds = implode(',', $_REQUEST['career_plan_id']);

$userId = $_REQUEST['user_id'];

// echo "DELETE FROM `athlete_career_plan` WHERE `user_id` = '$userId' AND `carrer_id` in ($careerPlanIds)"; die;

$res = mysqli_query($con,"DELETE FROM `athlete_career_plan` WHERE `athlete_id` = '$userId' AND `carrer_id` in ($careerPlanIds)") ; 



if ($res) 

{

  $empt1 = array("res" => '1', "message"=>'Record removed successfully');

  echo json_encode($empt1);

} 

else 

{

  $empt1 = array("res" => '0', "message" => 'Data Not Found');

  echo json_encode($empt1);



}



break;   

















###########################################################################################################################################     

case "welfare_add_docs":



$welfare_id = $_REQUEST['welfare_id'];

$categroy  = $_REQUEST['categroy'];

$file_name = $_REQUEST['file_name'];



$type=$_FILES['file']['type'];

$allowext = array("doc","docx","pdf","odt","txt");

$temp = explode(".", $_FILES['file']['name']);

$ext = end($temp);

if($welfare_id != '' && $categroy!='' && $file_name != '')

{

  if(!in_array($ext,$allowext))

  {

    $data['success'] = "0";

    $data['message'] = "Invaild File Format.";

    echo json_encode($data);

  }

  else

  {

    $target="uploads/career/";

    $new_name = uniqid().basename($_FILES['file']['name']);

    $new = $target.$new_name;

    $file_url = CAREER_MEDIA.$new_name;

    if(move_uploaded_file($_FILES['file']['tmp_name'],$new))

    {

      $sql = mysqli_query($con,"insert into `welfare_emp_docs`(`welfare_id`,`categroy`,`file_name`,`file_url`)VALUES('$welfare_id','$categroy','$file_name','$file_url')");

      if($sql)

      {

        $data['success'] = "1";

        $data['message'] = "File Successfully Added.";

        echo json_encode($data);

      }

    }

    else

    {

      $data['success'] = "0";

      $data['message'] = "Something Mistake, File is not Upload.";

      echo json_encode($data);

    }

  }

}

else

{

  $data['success'] = "0";

  $data['message'] = "Please enter all required fields.";

  echo json_encode($data);

}



break;







###########################################################################################################################################   

case "welfare_get_docs":



$categroy  = $_REQUEST['categroy'];

if($categroy != '')

{

  $res = mysqli_query($con,"Select * from `welfare_emp_docs` where `categroy` = '$categroy'") ;

  while($row = mysqli_fetch_assoc($res)) 

  {

    $alldata[] = $row;

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





break;

########################################################################################################################################### 

case "welfare_delete_docs":



$docs_id = $_REQUEST['docs_id'];

if($docs_id != '')

{



  $sql2 = mysqli_query($con ,"DELETE FROM `welfare_emp_docs` WHERE `id`='$docs_id'");

  if ($sql2) 

  {

    $data['success'] = "1";

    $data['message'] = "Record deleted successfully.";

    echo json_encode($data);

  } 

  else 

  {

    echo "Error deleting record: " . $conn->error;

  }



}

else

{

  $data['success'] = "0";

  $data['message'] = "Please enter all required fields.";

  echo json_encode($data);

}







break;





########################################################################################################################################### 





##########################################################################################################################################  

case "read_push_notification":



$push_id = $_REQUEST['push_id'];

if($push_id != '')

{

  $add_fav1 = mysqli_query($con, "UPDATE `pushnotifications` SET `read_status` = 1  WHERE `id` = '$push_id'");

  if($add_fav1)

  {

    $data['res'] = "1";

    $data['result'] = "Push notification Read status changed";

    echo json_encode($data);

  }

  else

  {

    $data['res'] = "0";

    $data['result'] = "Error.";

    echo json_encode($data);

  }

}

else

{

  $data['res'] = "0";

  $data['result'] = "Please enter all required fields.";

  echo json_encode($data);

}





break;







###########################################################################################################################################

case "chat_list_old_obselete":



$user_id = $_REQUEST['user_id'];



if($user_id != '')

{



//select ac.id as chat_id, ac.from_id, ac.to_id, ac.chat_type, acg.id as chat_group_id, acg.group_name,acg.group_icon, acg.admin_id from `athlete_chatlist` as ac left join athlete_chat_group as acg on ac.to_id = acg.id WHERE (ac.from_id='2' || ac.to_id='2') and ac.chat_type='MtoM' order by ac.date_time desc









  $res = mysqli_query($con, "select * from `athlete_chatlist` WHERE (`from_id`='$user_id' || `to_id`='$user_id') order by `date_time` desc");

  while($row = mysqli_fetch_assoc($res))

  {

    $chat_type = $row['chat_type'];

    $to_id = $row['to_id'];

    $from_id = $row['from_id'];



    if($chat_type == "MtoM")

    {

      $chatlist['from_id'] = $row['from_id'];

      $chatlist['to_id'] = $row['to_id'];

      $date_time = $row['date_time'];

      $chats_type = "MtoM";



      $id_name = mysqli_query($con, "select * from `athlete_chat_group` where `id` = '$to_id'");

      $chatlist['front_id'] = $to_id;

      if($in_row = mysqli_fetch_assoc($id_name))

      {

        $chatlist['name'] = $in_row['group_name'];



        $chatlist['profile_image'] = $in_row['group_icon'];

        $chatlist['admin_id'] = $in_row['admin_id'];

/*$chatlist['group_name'] = $in_row['group_name'];

$chatlist['group_image'] = $in_row['group_icon'];*/

/*$chatlist['group_id'] = $in_row['id'];

$chatlist['admin_id'] = $in_row['admin_id'];*/

}



$id_name = mysqli_query($con, "select * from `athlete_users` where `user_id` = '$from_id'");



if($in_row = mysqli_fetch_assoc($id_name))

{

  $sender_name = $in_row['user_name'];   

}



$count_msg = mysqli_query($con,"select count(*)  AS `total` from `user_chat_msg` where `from_id` = '$from_id' && `to_id` = '$to_id' && `chat_type`= '$chats_type'  && `status` = 0");

if($msg_row = mysqli_fetch_assoc($count_msg))

{

  $chatlist['count_msg'] = $msg_row['total'];

}



$msg_des = mysqli_query($con,"select * from `user_chat_msg` where `from_id` = '$from_id' && `to_id` = '$to_id' && `date_time` = '$date_time' && `chat_type`= '$chats_type'");

if($msg_details = mysqli_fetch_assoc($msg_des))

{



  $chatlist['msg_type'] = $msg_details['msg_type'];

  $chatlist['chat_type'] = $msg_details['chat_type'];

  $chatlist['description'] = $sender_name." : ".$msg_details['description'];

  $chatlist['date_time'] = $msg_details['date_time'];

  $chatlist['cur_date'] = $msg_details['cur_date'];

  $chatlist['cur_time'] = $msg_details['cur_time'];



}



}

else if($chat_type == "OtoO" )

{

  $chats_type = "OtoO";

  if($from_id != $user_id)

  {

    $date_time = $row['date_time'];

    $chatlist['from_id'] = $row['from_id'];

    $chatlist['to_id'] = $row['to_id'];

    $id_name = mysqli_query($con, "select * from `athlete_users` where `user_id` = '$from_id'");

    $chatlist['front_id'] = $from_id;

    if($in_row = mysqli_fetch_assoc($id_name))

    {

      $chatlist['name'] = $in_row['user_name'];

      $chatlist['profile_image'] = PROFILE_IMAGE.$in_row['profile_image'];

      $chatlist['admin_id'] = "";

    }

    $count_msg = mysqli_query($con,"select count(*)  AS `total` from `user_chat_msg` where `from_id` = '$from_id' && `to_id` = '$to_id' && `chat_type`= '$chats_type'  && `status` = 0");

    if($msg_row = mysqli_fetch_assoc($count_msg))

    {

      $chatlist['count_msg'] = $msg_row['total'];

    }



    $msg_des = mysqli_query($con,"select * from `user_chat_msg` where `from_id` = '$from_id' && `to_id` = '$to_id' && `date_time` = '$date_time' && `chat_type`= '$chats_type'");

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

    $id_name = mysqli_query($con, "select * from `athlete_users` where `user_id` = '$to_id'");

    if($in_row = mysqli_fetch_assoc($id_name))

    {

      $chatlist['name'] = $in_row['user_name'];

      $chatlist['profile_image'] = PROFILE_IMAGE.$in_row['profile_image'];

      $chatlist['admin_id'] = "";

    }

/*$count_msg = mysqli_query($con,"select count(*)  AS `total` from `user_chat_msg` where `from_id` = '$from_id' && `to_id` = '$to_id' && `status` = 0");

if($msg_row = mysqli_fetch_assoc($count_msg))

{

$chatlist['count_msg'] = $msg_row['total'];



}*/

$chatlist['count_msg'] = "0";

$msg_des = mysqli_query($con,"select * from `user_chat_msg` where `from_id` = '$from_id' && `to_id` = '$to_id' && `date_time` = '$date_time' && `chat_type`= '$chats_type'");

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



}



$chatlist1[] = $chatlist;



unset($chatlist);

}



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





break;



########################################################################################################################################### 



case "add_news_feed":



$user_id = $_REQUEST['user_id'];

$title = $_REQUEST['title'];

$comment_status = $_REQUEST['comment_status'];

$share_with = $_REQUEST['share_with'];



//$news_feeds_data = 'https://ctdworld.co/athlete/uploads/news_feeds/';

$cur_date = date("y-m-d");

$cur_time = date('H:i:s');

$date_time = $cur_date." ".$cur_time;
ini_set('upload_max_filesize', '100M');
    ini_set('post_max_size', '100M');
    ini_set('max_input_time', 300);
    ini_set('max_execution_time', 83000);
if($user_id != '' &&  $comment_status != '' && $share_with != '')

{
    

  $target="uploads/news_feeds/";

  $new_name = uniqid().basename($_FILES['file']['name']);

  $new = $target.$new_name;

  $file_url = NEWSFEED_MEDIA.$new_name;

  if(move_uploaded_file($_FILES['file']['tmp_name'],$new))

  {

    $sql = mysqli_query($con,"insert into `athlete_news_feed`(`user_id`,`title`,`media_url`,`share_with`,`comment_status`,`date_time`)VALUES('$user_id','$title','$file_url','$share_with','$comment_status','$date_time')");

    if($sql)

    {

      $data['res'] = "1";

      $data['result'] = "News Feeds Successfully Added.";

      echo json_encode($data);

    }

  }

  else

  {

    $sql = mysqli_query($con,"insert into `athlete_news_feed`(`user_id`,`title`,`share_with`,`comment_status`,`date_time`)VALUES('$user_id','$title','$share_with','$comment_status','$date_time')");

    if($sql)

    {

      $data['res'] = "1";

      $data['result'] = "News Feeds Successfully Added.";

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







break;







###########################################################################################################################################  

case "share_news_feed":



$post_id = $_REQUEST['post_id'];

$post_share_by = $_REQUEST['post_share_by'];

$share_text = $_REQUEST['share_text'];

$comment_status = $_REQUEST['comment_status'];

$share_with = $_REQUEST['share_with'];



if($post_share_by != '' && $post_id != '')

{

  $res = mysqli_query($con, "Select * from `athlete_news_feed` where `id` = '$post_id'");

  if($row = mysqli_fetch_assoc($res))

  {

    $user_id = $row['user_id'];

    $title = $row['title'];

    $media_url = $row['media_url'];

    $sql = mysqli_query($con,"insert into `athlete_news_feed`(`user_id`,`title`,`media_url`,`share_with`,`comment_status`,`post_share_by`,`post_share_text`,`date_time`)VALUES('$user_id','$title','$media_url','$share_with','$comment_status','$post_share_by','$share_text','$date_time')");

    if($sql)

    {

      $data['res'] = "1";

      $data['result'] = "News Feeds Successfully Shared.";

      echo json_encode($data);

    }

    else

    {

      $data['res'] = "0";

      $data['result'] = "Something mistake.";

      echo json_encode($data);

    }



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



break;    

###########################################################################################################################################   

case "edit_news_feed":



$post_id = $_REQUEST['post_id'];

$title = $_REQUEST['title'];

$comment_status = $_REQUEST['comment_status'];

$share_with = $_REQUEST['share_with'];

$img_status=$_REQUEST['image_status'];



//$news_feeds_data = 'https://ctdworld.co/athlete/uploads/news_feeds/';

if($post_id != '' && $img_status != '')

{

  if($img_status == 0)

  {

    $sql1=mysqli_query($con, "select * from `athlete_news_feed` where id='$post_id'");

    if ($rows1 = mysqli_fetch_assoc($sql1)) {

      $dt=$rows1['media_url'];

    }



    $sql = mysqli_query($con,"update `athlete_news_feed` set `title` = '$title' ,`media_url` = '$dt', `share_with` = '$share_with',`comment_status` = '$comment_status' where `id` = '$post_id'");

    /*$sql = mysqli_query($con,"insert into `athlete_news_feed`(`user_id`,`title`,`share_with`,`comment_status`,`date_time`)VALUES('$user_id','$title','$share_with','$comment_status','$date_time')");*/

    if($sql)

    {

      $data['res'] = "1";

      $data['result'] = "News Feeds Successfully Updated.";

      echo json_encode($data);

    }

  }

  else if($img_status == 1)

  {

    $target="uploads/news_feeds/";

    $new_name = uniqid().basename($_FILES['file']['name']);

    $new = $target.$new_name;

    $file_url = NEWSFEED_MEDIA.$new_name;

    if(move_uploaded_file($_FILES['file']['tmp_name'],$new))

    {

      $sql = mysqli_query($con,"update `athlete_news_feed` set `title` = '$title' , `media_url` = '$file_url',`share_with` = '$share_with',`comment_status` = '$comment_status' where `id` = '$post_id'");

      /* $sql = mysqli_query($con,"insert into `athlete_news_feed`(`user_id`,`title`,`media_url`,`share_with`,`comment_status`,`date_time`)VALUES('$user_id','$title','$file_url','$share_with','$comment_status','$date_time')");*/

      if($sql)

      {

        $data['res'] = "1";

        $data['result'] = "News Feeds Successfully Updated.";

        echo json_encode($data);

      }

    }

  }

  else if($img_status == 2)

  {

    $dt="";

    $sql = mysqli_query($con,"update `athlete_news_feed` set `title` = '$title' ,`media_url` = '$dt', `share_with` = '$share_with',`comment_status` = '$comment_status' where `id` = '$post_id'");

    /*$sql = mysqli_query($con,"insert into `athlete_news_feed`(`user_id`,`title`,`share_with`,`comment_status`,`date_time`)VALUES('$user_id','$title','$share_with','$comment_status','$date_time')");*/

    if($sql)

    {

      $data['res'] = "1";

      $data['result'] = "News Feeds Successfully Updated.";

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







break;







###########################################################################################################################################   

case "view_news_feed":





$user_id = $_REQUEST['user_id'];   

if($user_id != '')

{

  $sql = mysqli_query($con,"select * from `athlete_news_feed` ORDER BY `date_time` desc");

  while($row = mysqli_fetch_assoc($sql)) 

  {

    /*$data[] = $row;*/

    $check_id = $row['user_id'];

    $share_status = $row['share_with'];

    $post_share_by = $row['post_share_by'];

/*

0 = public;

1 = friend;

*/

$comment_status = $row['comment_status'];

/*

0 = not;

1 = yes;

*/

if($share_status == 0 )

{     

  $from_id =  $row['user_id'];



  $id_name = mysqli_query($con, "select * from `athlete_users` where `user_id` = '$from_id'");

  if($in_row = mysqli_fetch_assoc($id_name))

  {

    $row['user_name'] = $in_row['user_name'];

    $row['user_profile_image'] = PROFILE_IMAGE.$in_row['profile_image'];



  }



  $post_share_by = $row['post_share_by'];

  $id_name = mysqli_query($con, "select * from `athlete_users` where `user_id` = '$post_share_by'");

  if($in_row = mysqli_fetch_assoc($id_name))

  {

    $row['post_share_by'] = $in_row['user_name'];

    /*$row['user_profile_image'] = PROFILE_IMAGE.$in_row['profile_image'];*/



  } 

  $post_id = $row['id'];

  $lk = 1;



  $like_check = mysqli_query($con,"select * from `athlete_like_post`  where `post_id` = '$post_id' && `user_id` = '$user_id' && `status`='$lk'");

  if(mysqli_fetch_assoc($like_check))

  {



    $row['like'] = 1;

  }

  else

  {

    $row['like'] = 0;

  }





  $like = mysqli_query($con,"select count(*)  AS `total` from `athlete_like_post` where `post_id` = '$post_id' && `status` = '$lk'");

  if($msg_row = mysqli_fetch_assoc($like))

  {

    $row['like_count'] = $msg_row['total'];

  }



  $comment = mysqli_query($con,"select count(*)  AS `total` from `athlete_comment_post` where `post_id` = '$post_id'");



  if($msg_row1 = mysqli_fetch_assoc($comment))

  {

    $row['comment_count'] = $msg_row1['total'];

  } 

  $data[] = $row;

}





else if($share_status == 1 || $user_id == $check_id || $post_share_by == $user_id)

{

  $from_request_id =  $row['user_id'];

  $to_request_id = $user_id;



  $txt = "Friend_request";

  $res = mysqli_query($con, "select * from `athlete_report_request` WHERE (`request_from`='$from_request_id' && `request_to`='$to_request_id') && (`request_for` = '$txt' && `status` = 2) || (`request_from`='$to_request_id' && `request_to`='$from_request_id') && (`request_for` = '$txt' && `status` = 2) ");

  if (mysqli_num_rows($res) == 1 || $user_id == $check_id) 

  {

    $from_id =  $row['user_id'];

    $id_name = mysqli_query($con, "select * from `athlete_users` where `user_id` = '$from_id'");

    if($in_row = mysqli_fetch_assoc($id_name))

    {

      $row['user_name'] = $in_row['user_name'];

      $row['user_profile_image'] = PROFILE_IMAGE.$in_row['profile_image'];



    } 



    $post_share_by = $row['post_share_by'];

    $id_name = mysqli_query($con, "select * from `athlete_users` where `user_id` = '$post_share_by'");

    if($in_row = mysqli_fetch_assoc($id_name))

    {

      $row['post_share_by'] = $in_row['user_name'];

      /*$row['user_profile_image'] = PROFILE_IMAGE.$in_row['profile_image'];*/



    } 

    $post_id = $row['id'];

    $lk = 1; 



    $like_check = mysqli_query($con,"select * from `athlete_like_post`  where `post_id` = '$post_id' && `user_id` = '$user_id' && `status`='$lk'");

    if(mysqli_fetch_assoc($like_check))

    {

      $row['like'] = 1;



    }

    else

    {

      $row['like'] = 0;

    }



    $like = mysqli_query($con,"select count(*)  AS `total` from `athlete_like_post` where `post_id` = '$post_id' && `status` = '$lk'");

    if($msg_row = mysqli_fetch_assoc($like))

    {

      $row['like_count'] = $msg_row['total'];

    }



    $comment = mysqli_query($con,"select count(*)  AS `total` from `athlete_comment_post` where `post_id` = '$post_id'");



    if($msg_row1 = mysqli_fetch_assoc($comment))

    {

      $row['comment_count'] = $msg_row1['total'];

    }   

    $data[] = $row;

  }

}



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

break;





########################################################################################################################################### 

case "edit_share_status":



$post_id = $_REQUEST['post_id'];

$share_with = $_REQUEST['share_with'];

$comment_status = $_REQUEST['comment_status'];



if($post_id != '' && $share_with != '' && $comment_status != '')

{

  $in_check_list = mysqli_query($con,"update `athlete_news_feed` set `share_with` = '$share_with', `comment_status` = '$comment_status' where `id` = '$post_id'");

  if($in_check_list)

  {

    $empt = array("res" => '1', "result" => 'Update Privacy Successfully');

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

  $data['res'] = "0";

  $data['result'] = "Please enter all required fields.";

  echo json_encode($data);

}





break;







###########################################################################################################################################  

case "add_like_post" :



$user_id = $_REQUEST['user_id'];

$post_id = $_REQUEST['post_id'];

$status = $_REQUEST['status'];

$cur_date = date("y-m-d");

$cur_time = date('H:i:s');

$date_time = $cur_date." ".$cur_time;



if($user_id != '' && $post_id != '' && $status != '')

{

  $check_list = mysqli_query($con, "select * from `athlete_like_post` where `user_id` = '$user_id' && `post_id` = '$post_id'");



  if($row21 = mysqli_fetch_assoc($check_list))

  {

    $up_id = $row21['id'];

    $in_check_list = mysqli_query($con,"update `athlete_like_post` set `user_id` = '$user_id', `post_id` = '$post_id',`status` = '$status', `date_time` = '$date_time' where `id` = '$up_id'");

  }

  else

  {

    $in_check_list = mysqli_query($con,"insert into `athlete_like_post`(`user_id`,`post_id`,`status`,`date_time`) values('$user_id','$post_id','$status','$date_time')");

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





break;

###########################################################################################################################################     



###########################################################################################################################################  

case "list_like_user" :



  $user_id = $_REQUEST['user_id'];

  $post_id = $_REQUEST['post_id'];

  

  

  if($user_id != '' && $post_id != '')

  {

      $q ="select athlete_users.user_name as name,athlete_users.profile_image,athlete_users.user_id as id,athlete_like_post.date_time from `athlete_like_post` LEFT JOIN athlete_users ON athlete_users.user_id = athlete_like_post.user_id where athlete_like_post.post_id = '$post_id' AND athlete_like_post.status = 1";

    $check_list = mysqli_query($con,$q);

    $like_array=array();

      while($row = mysqli_fetch_assoc($check_list)) 

      {
      $row['date_time'] = date('d-M-y h:i:sa',strtotime($row['date_time']));
          $like_array[] = $row;

      }

      //echo $q;

      if(count($like_array) > 0) {
      $empt = array("res" => '1', "like_result_list" => $like_array);
      echo json_encode($empt);

      }else{

         $empt = array("res" => '0', "like_result_list" => 'No Details Found');

       echo json_encode($empt);

      }



  

  }

  else

  {

    $empt = array("res" => '0', "result" => 'Please enter all required fields');

    echo json_encode($empt);

  }

  

  

  break;

  ###########################################################################################################################################     

case "add_comment_post" :



$user_id = $_REQUEST['user_id'];

$post_id = $_REQUEST['post_id'];

$comment = $_REQUEST['comment'];

$cur_date = date("y-m-d");

$cur_time = date('H:i:s');

$date_time = $cur_date." ".$cur_time;



if($user_id != '' && $post_id != '' && $comment != '')

{



  $in_check_list = mysqli_query($con,"insert into `athlete_comment_post`(`user_id`,`post_id`,`comment`,`date_time`) values('$user_id','$post_id','$comment','$date_time')");

  if($in_check_list)

  {

    $empt = array("res" => '1', "result" => 'Add Comment Successfully');

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





break;

###########################################################################################################################################

case "view_comment_post":



$post_id = $_REQUEST['post_id'];



if($post_id != '')

{

  $post_data1 = mysqli_query($con, "select * from `athlete_comment_post` where `post_id` = '$post_id' order by id desc");

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





break;





###########################################################################################################################################        

case "edit_comment_post" :



$user_id = $_REQUEST['user_id'];

$comment_id = $_REQUEST['comment_id'];

$post_id = $_REQUEST['post_id'];

$comment = $_REQUEST['comment'];

$cur_date = date("y-m-d");

$cur_time = date('H:i:s');

$date_time = $cur_date." ".$cur_time;



if($user_id != '' && $post_id != '' && $comment != '' && $comment_id != '')

{



  $in_check_list = mysqli_query($con,"update `athlete_comment_post` set `user_id` = '$user_id', `post_id` = '$post_id',`comment` = '$comment', `date_time` = '$date_time' where `id` = '$comment_id'");

  if($in_check_list)

  {

    $empt = array("res" => '1', "result" => 'Update Comment Successfully');

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





break;

###########################################################################################################################################   

case "delete_comment_post" :



$comment_id = $_REQUEST['comment_id'];

if($comment_id != '')

{

  $in_check_list = mysqli_query($con, "DELETE FROM `athlete_comment_post` where `id` = '$comment_id'");

  if($in_check_list)

  {

    $empt = array("res" => '1', "result" => 'Delete Comment Successfully');

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





break;



################################################################################################################################  

case "create_chat_group" :



$group_name = $_REQUEST['group_name'];

$group_type = $_REQUEST['group_type'];

$admin_id = $_REQUEST['admin_id'];



if($admin_id != '' && $group_name != '' && $group_type !='')

{

  $member_role  = "admin";

  $in_group = mysqli_query($con,"insert into `athlete_chat_group`(`group_name`,`group_type`,`admin_id`,`date_time`) values('$group_name','$group_type','$admin_id','$date_time')"); 







  $group_id = mysqli_insert_id($con);



  $message = "New Group Created";

  $chat_type = "MtoM";

  $from_request_id = $admin_id;

  $to_request_id = $group_id;

  $msg_type = "Message";



  $in_check_list = mysqli_query($con,"insert into `athlete_chatlist`(`from_id`,`to_id`,`chat_type`,`date_time`) values('$from_request_id','$to_request_id','$chat_type','$date_time')");



  $add_fav = mysqli_query($con, "INSERT INTO `user_chat_msg`(`from_id`, `to_id`,`msg_type`,`description`,`chat_type`,`date_time`,`cur_date`,`cur_time`) VALUES ('$from_request_id','$to_request_id','$msg_type','$message','$chat_type','$date_time','$cur_date','$cur_time')");







  $in_group_data = mysqli_query($con,"insert into `athlete_chat_group_member`(`group_id`,`group_member`,`member_role`,`admin_id`,`date_time`) values('$group_id','$admin_id','$member_role','$admin_id','$date_time')");





  $sql_query = mysqli_query($con , "select * from `athlete_chat_group` where `id` = '$group_id'");



  if($ros = mysqli_fetch_assoc($sql_query))

  {

    $data =  $ros;

  }



  if($in_group && $in_group_data)

  {

    $empt = array("res" => '1', "result" => $data);

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





break;





###########################################################################################################################################   

case "edit_group_name" :



$group_id = $_REQUEST['group_id'];

$group_name = $_REQUEST['group_name'];





if($group_id != '' && $group_name != '')

{

  $sql_query = mysqli_query($con, "update `athlete_chat_group` set `group_name` = '$group_name' where `id` = '$group_id'"); 







  $sql_query = mysqli_query($con , "select * from `athlete_chat_group` where `id` = '$group_id'");



  if($ros = mysqli_fetch_assoc($sql_query))

  {

    $data =  $ros;

  }



  if($sql_query)

  {

    $empt = array("res" => '1', "result" => $data);

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



break;



############################################group_pic_file##############################################################    



//$group_icon = 'https://ctdworld.co/athlete/uploads/group_icon/'; 



case "edit_group_image" :



$group_id = $_REQUEST['group_id'];



if($group_id != '')

{

  $target="uploads/group_icon/";

  $new_name = uniqid().basename($_FILES['file']['name']);

  $new = $target.$new_name;

  $file_url = GROUP_ICON.$new_name;

  if(move_uploaded_file($_FILES['file']['tmp_name'],$new))

  {

    $sql = mysqli_query($con,"update `athlete_chat_group` set `group_icon` = '$file_url' where `id` = '$group_id' ");

    if($sql)

    {

      $data['res'] = "1";

      $data['result'] = "Group Image update Successfully.";

      echo json_encode($data);

    }

    $group_id = mysqli_insert_id($con);

    $sql_query = mysqli_query($con , "select * from `athlete_chat_group` where `id` = '$group_id'");



    if($ros = mysqli_fetch_assoc($sql_query))

    {

      $data =  $ros;

    }

  }

}

else

{

  $empt = array("res" => '0', "result" => $data);

  echo json_encode($empt);

}

break;



#############################################################################################################################

case "change_groupmember_role":



$group_id = $_REQUEST['group_id'];

/*$group_type = $_REQUEST['group_type'];*/

$group_member = $_REQUEST['member_id'];

$member_role  = $_REQUEST['member_role'];

/*$user_id = $_REQUEST['user_id'];*/



if($group_id != '' && $group_member != '' && $member_role !='')

{   





  $in_check_list = mysqli_query($con,"update `athlete_chat_group_member` set `member_role` = '$member_role' where `id` = '$group_member'");



  /*$in_group_data1 = mysqli_query($con,"insert into `athlete_chat_group_member`(`group_id`,`group_type`,`group_member`,`member_role`,`member_add_by`,`date_time`) values('$group_id','$group_type','$member_id','$member_role','$user_id','$date_time')");*/



  if($in_check_list)

  {

    $empt = array("res" => '1', "result" => 'Member Role Update Successfully');

    echo json_encode($empt);

  }

  else

  {

    $empt = array("res" => '0', "result" => 'Date not Found');

    echo json_encode($empt);

  }

}

else

{

  $empt = array("res" => '0', "result" => 'Please enter all required fields');

  echo json_encode($empt);

}



break;



######################################################################################################################

case "group_list":



$user_id = $_REQUEST['user_id'];

$group_type =  $_REQUEST['group_type'];



if($user_id != '')

{   

  $sql_query = mysqli_query($con, "select * from `athlete_chat_group_member` where `group_member` = '$user_id'");

  while($row = mysqli_fetch_assoc($sql_query))

  {

    $gp_id = $row['group_id'];

    $sql_query1 = mysqli_query($con, "select * from `athlete_chat_group` where `id` = '$gp_id' && `group_type` = '$group_type' ");

    if($row1 = mysqli_fetch_assoc($sql_query1))

    {

      $post_data[] = $row1;

    }

  }

  if($post_data)

  {

    $empt = array("res" => '1', "result" => $post_data);

    echo json_encode($empt);

  }

  else

  {

    $empt = array("res" => '0', "result" => 'Date not Found');

    echo json_encode($empt);

  }



}

else

{

  $empt = array("res" => '0', "result" => 'Please enter all required fields');

  echo json_encode($empt);

}





break;

#############################################################################################################################

case "group_member_list":



$group_id = $_REQUEST['group_id'];



if($group_id != '')

{   

  $group_nm = mysqli_query($con, "select * from `athlete_chat_group` where `id` = '$group_id'");



  if($gp = mysqli_fetch_assoc($group_nm))

  {

    $group_name = $gp['group_name'];

    $group_profile = $gp['group_icon'];



    $post_data1[group_name] = $group_name;

    $post_data1[group_profile] = $group_profile;

  }





  $sql_query = mysqli_query($con, "select * from `athlete_chat_group_member` where `group_id` = '$group_id'");

  $i=1;

  while($row = mysqli_fetch_assoc($sql_query))

  {

    $user_id = $row['group_member'];





    $id_name = mysqli_query($con, "select * from `athlete_users` where `user_id` = '$user_id'");



    if($in_row = mysqli_fetch_assoc($id_name))

    {

      $row1['member_id'] =  $user_id;

      $row1['member_role'] =  $row['member_role'];

      $row1['name'] = $in_row['user_name'];

      $row1['profile_image'] = PROFILE_IMAGE.$in_row['profile_image'];  

    }



    $post_data1['member_list'][] = $row1;



  }

  $post_data[] = $post_data1;

  if($post_data){

    $empt = array("res" => '1', "result" => $post_data);

    echo json_encode($empt);

  }

  else{

    $empt = array("res" => '0', "result" => 'Date not Found');

    echo json_encode($empt);

  }



}

else

{

  $empt = array("res" => '0', "result" => 'Please enter all required fields');

  echo json_encode($empt);

}    

break;

##########################################################################################################################

############################################################################################################################   



case "add_feedback":



$name = $_REQUEST['name'];

$email = $_REQUEST['email'];

$message1 = $_REQUEST['message'];

$user_id = $_REQUEST['user_id'];



if($name !='' && $email != '' && $message1 != '' && $user_id != '')  

{

  $id_name = mysqli_query($con, "select * from `athlete_users` where `user_id` = '$user_id'");



  if($row = mysqli_fetch_assoc($id_name))

  {



    $user_email =  $row['user_email'];



  }





  $sql = mysqli_query($con,"insert into  `athlete_feedback`(`name`,`email`,`message`,`date_time`)values('$name','$email','$message1','$date_time')");

  if($sql)

  {

    $site_title=SITE_TITLE;

    $name = strstr($email,'@', true);

    // $to="niudigital@mapss.org.nz";

    $to="apps@mapss.org.nz";
    //$to="lalitpathak815@gmail.com";

    $subject="For feedback"; 



    $message = "<html>

    <head>

    <title>HTML email</title>

    </head>

    <body>

    <table>





    <tr><td style='height: 35px;'>Welcome to Pro Path</td></tr>



    <tr><td style='height: 35px;'>Please find the feedback details below:</td></tr>







    <tr><td style='height: 35px;'>Your Email Id: " . stripslashes($email) . "

    <br>

    Your Message: " . stripslashes($message1) . "</td></tr>





    <tr><td style='height: 35px;'>Warm Regards, <br> Pro Path App <br></td></tr>



    <tr><td style='height: 30px;'><hr></td></tr>



    </table>

    </body>

    </html>



    ";

    $te = "From:".$user_email." \r\n";

    $header = $te;

    $header .= "MIME-Version: 1.0\r\n";

    $header .= "Content-type: text/html\r\n";

    $retval = mail ($to,$subject,$message,$header);

    $empt = array("res" => '1', "result" => "Feedback Added Successfully" ,"asd" => $te);

    echo json_encode($empt);

  }

  else{

    $empt = array("res" => '0', "result" => 'Something Mistake');

    echo json_encode($empt);

  }

}

else{

  $empt = array("res" => '0', "result" => 'Please enter all requireds fields');

  echo json_encode($empt); 

}

break;



########################################################################################################################   



####################################################################################      

case 'edit training plan new':

  $plan_id=$_REQUEST['plan_id'];

  //$user_id=3;

  $getsql="select * from `athlete_trainingplan` where id='$plan_id' and flag=1 order by id desc";

  $res_gettraining = mysqli_query($con, $getsql);

  $i=0;

  while($row=mysqli_fetch_assoc($res_gettraining))

  {

    //print_r($row);

    $empt[$i]['training_plan_id']=$row['id'];

    $empt[$i]['title']=$row['title'];

    $empt[$i]['description']=$row['description'];

    $empt[$i]['created_by']=$row['user_id'];

    $getitemssql="select * from athlete_training_media where training_plan_id='".$row['id']."'";

    $res_gettrainingitems = mysqli_query($con, $getitemssql);

    $j=0;

    while($rowitems=mysqli_fetch_assoc($res_gettrainingitems)){

      $newitems[$j]['item_id']=$rowitems['id'];

      $newitems[$j]['title']=$rowitems['title'];

      $newitems[$j]['media_url']=$rowitems['link'];

      $newitems[$j]['media_type']=$rowitems['type'];

      $j++;

    }

    //print_r($newitems);

    $empt[$i]['items_list']=$newitems;

    $i++;



                

  } 

  

  $empt1 = array("res"=>'success',"response"=>$empt);

  echo json_encode($empt1);

  

  break;

case 'save edit training plan new':

  $plan_id=$_REQUEST['plan_id'];

  //$user_id=$_REQUEST['user_id'];

  $title=$_REQUEST['plan_title'];

  $description=$_REQUEST['plan_description'];

  $numofmedia=$_REQUEST['num_of_media'];

  if($plan_id!='' && $title!='')

  {

    $insrtsql="update `athlete_trainingplan` set `title`='$title',`description`='$description' where id='$plan_id'";

    $add_training = mysqli_query($con, $insrtsql);

    for($i=0;$i<$numofmedia;$i++){

      $itemtitle=$_REQUEST['item_title'][$i];

      $item_mediatype=$_REQUEST['mediatype'][$i];

      $item_id=$_REQUEST['item_id'][$i];

      $deleted_item_id=$_REQUEST['del_item_id'][$i];

      if($_FILES['mediafile']['size'][$i] > 0){

      /*$chat_data = 'https://ctdworld.co/athlete/uploads/chat_data/';*/

      //$target="uploads/chat_data/";

      $type = $_FILES['mediafile']['type'][$i];

      $name = $_FILES['mediafile']['name'][$i];

      $name1 = str_replace(" ","",$name);

      $new_name = uniqid()."_".basename($name1);

      $new = $new_name;

      $file_url = UPLOAD_DIR.$new_name;

      $newfile_url = "https://ctdworld.co/athlete/".UPLOAD_DIR.$new_name;

      move_uploaded_file($_FILES['mediafile']['tmp_name'][$i],$file_url);     

      }

      else{

        $new = $_REQUEST['item_filename'][$i];

        $newfile_url = $_REQUEST['item_mediaurl'][$i];

      }

      if($item_id != 0 && $deleted_item_id == 0 ){

      $itemupdsql="update athlete_training_media  set title='$itemtitle' ,type='$item_mediatype',filename='$new',link='$newfile_url' where  id='$item_id'";

      $upd_trainingitem = mysqli_query($con, $itemupdsql);

      }

      else if($item_id == 0 && $deleted_item_id == 0){        

        $iteminsrtsql="INSERT into athlete_training_media (training_plan_id ,title ,type,filename,link) values('$training_planid','$itemtitle','$item_mediatype','$new','$newfile_url') ";

        $add_trainingitem = mysqli_query($con, $iteminsrtsql);        

      }

      else if($deleted_item_id == 1){       

        $itemdelsql="delete from athlete_training_media where id='$item_id' ";

        $del_trainingitem = mysqli_query($con, $itemdelsql);        

      }

    }

  

      $data['message'] = "Training Plan Updated successfully.";

      $empt1 = array("res" => '1', "result"=>$data);

      echo json_encode($empt1); 

    } 

    else

    {

      $data['success'] = "0";

      $data['message'] = "Please enter all required fields.";

      echo json_encode($data);

    }



  break;

case 'create training plan new':



/*

echo "<pre>";

print_r($_REQUEST);

print_r($_FILES);

echo "</pre>";

*/



$user_id=$_REQUEST['user_id'];

$title=$_REQUEST['plan_title'];

$description=$_REQUEST['plan_description'];

$numofmedia=$_REQUEST['num_of_media'];

$cur_date = date("y-m-d");

$cur_time = date('H:i:s');

$date_time = $cur_date." ".$cur_time;

if($user_id!='' && $title!='')

{ 

  $insrtsql="INSERT into `athlete_trainingplan`(`user_id`,`title`,`description`,`date_time`,`flag`) values('$user_id','$title','$description','$date_time',1) ";

  $add_training = mysqli_query($con, $insrtsql);

  $training_id = mysqli_insert_id($con);

  $data['training_id'] = $training_id;

  for($i=0;$i<$numofmedia;$i++){

    //echo "--".$i;

    $itemtitle=$_REQUEST['item_title'][$i];

    $youtube_link=$_REQUEST['youtube_link'][$i];

    $item_mediatype=$_REQUEST['mediatype'][$i];

    $training_planid=$training_id;



    if($_FILES['mediafile']['size'][$i] > 0){

      /*$chat_data = 'https://ctdworld.co/athlete/uploads/chat_data/';*/

      //$target="uploads/chat_data/";

      $type = $_FILES['mediafile']['type'][$i];

      $name = $_FILES['mediafile']['name'][$i];

      $name1 = str_replace(" ","",$name);

      $new_name = uniqid()."_".basename($name1);

      $new = $new_name;

      $file_url = UPLOAD_DIR.$new_name;

      $newfile_url = "https://ctdworld.co/athlete/".UPLOAD_DIR.$new_name;

      move_uploaded_file($_FILES['mediafile']['tmp_name'][$i],$file_url);     

    }

    $iteminsrtsql="INSERT into athlete_training_media (training_plan_id ,title ,youtube_link,type,filename,link) values('$training_planid','$itemtitle','$youtube_link','$item_mediatype','$new','$newfile_url') ";

    $add_trainingitem = mysqli_query($con, $iteminsrtsql);

  }   

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

break;

case 'List Trainingplan':

  $user_id=$_REQUEST['user_id'];

  //$user_id=3;



  $sql1 = mysqli_query($con ,"SELECT training_plan_id,shared_to FROM `athlete_shared_trainingplan` WHERE `shared_to`='$user_id' and  `isDeleted`='0' ");

  $num_rec1=mysqli_num_rows($sql1); 

  if ($num_rec1>0) {  

    $i=0;

    while($row=mysqli_fetch_assoc($sql1))

    { 

      $training_plan_id2[]=$row['training_plan_id'];



    }



  }





  $sql2 = mysqli_query($con ,"SELECT id FROM `athlete_trainingplan` WHERE `user_id`='$user_id' and flag=1 ");

  // $sql2 = mysqli_query($con ,"SELECT id, B.user_name, C.role_name FROM `athlete_trainingplan` A 

  //    JOIN `athlete_users` B ON B.`user_id` = A.`user_id`

  //    JOIN `athlete_user_role` C ON C.`role_id`= B.`user_role`

  //    WHERE A.`user_id`='$user_id' and `flag`=1 ");

  $num_rec2=mysqli_num_rows($sql2); 

  if ($num_rec2>0) {   

    while($row2=mysqli_fetch_assoc($sql2))

    { 

      // print_r($row2);die;

      $training_plan_id2[]=$row2['id'];



    }

  }

  // print_r($training_plan_id2);



  $training_planidstring= implode($training_plan_id2,",");

  //echo "select * from `athlete_trainingplan` where id In ('$training_planidstring') and flag=1 order by id desc";

  // $getsql="select * from `athlete_trainingplan` where id In ($training_planidstring) and flag=1 order by id desc";

  

  $getsql="select A.*, B.user_name, B.profile_image, B.user_role, C.role_name FROM `athlete_trainingplan` A

  JOIN `athlete_users` B ON B.`user_id` = A.`user_id`

  JOIN `athlete_user_role` C ON C.`role_id`= B.`user_role`

  WHERE A.id In ($training_planidstring) and A.flag=1 order by id desc";



  $res_gettraining = mysqli_query($con, $getsql);

  $i=0;

  while($row=mysqli_fetch_assoc($res_gettraining))

  {

    $empt[$i]['training_plan_id']=$row['id'];

    $empt[$i]['title']=$row['title'];



    $empt[$i]['created_by_name']=$row['user_name'];

    $empt[$i]['created_by_role_id']=$row['user_role'];

    $empt[$i]['created_by_profile_pic']= $imageurl.'/'.$row['profile_image'];

    $empt[$i]['created_date_time']=$row['date_time'];

    $empt[$i]['updated_date_time']=$row['date_time'];



    $empt[$i]['description']=$row['description'];

    $empt[$i]['created_by']=$row['user_id'];

    $getitemssql="select * from athlete_training_media where training_plan_id='".$row['id']."'";

    $res_gettrainingitems = mysqli_query($con, $getitemssql);

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

    $empt[$i]['items_list']=$newitems;

    $i++;



                

  } 

  

  $empt1 = array("res"=>'success',"response"=>$empt);

  echo json_encode($empt1);

  break;

default:

break;





################################################################################

// update_school_review API By Ranjeet On 05-04-2019



case "update_school_review":



if($_SERVER['REQUEST_METHOD']=='POST'){

  $id = $_REQUEST['id'];

  $user_id = $_REQUEST['user_id'];

  $subject = $_REQUEST['subject'];

  $grade = $_REQUEST['grade'];

  $comments = $_REQUEST['comments'];

  $teacher_id = $_REQUEST['teacher_id'];

  

    //date_default_timezone_set('Asia/Kolkata');

    //$updated_date = date('d-m-Y H:i');   

if($user_id != '' && $subject != '' && $comments != '' && $teacher_id != '' && $updated_date != '' && $id != '')

{

  $add_fav = mysqli_query($con, "update  `athlete_school_review` set `comments`='$comments' where `id` = '$id'");

  $add_fav = mysqli_query($con, "update  `athlete_school_review_details` set `subject`='$subject', `grade`='$grade', where `review_id` = '$id' && where `subject` = '$subject' && where `grade` = '$grade'");



  if($add_fav)

  {

    $data['success'] = "1";

    $data['message'] = "Data Updated Successfully.";

    echo json_encode($data);

  }

  else

  {

    $data['success'] = "0";

    $data['message'] = "Something mistake.";

    echo json_encode($data);

  }

}

else

{

  $data['success'] = "0";

  $data['message'] = "Please enter all required fields.";

  echo json_encode($data);

}

}

else{

  $data['success'] = "0";

  $data['message'] = "Please check again something mistake.";

  echo json_encode($data);

}

break;





################################################################################ 

// edit training plan new item rn update API By Ranjeet On 12-04-2019



case "edit training plan new item rn":



if($_SERVER['REQUEST_METHOD']=='POST'){

        $item_id = $_REQUEST['item_id'];

      $numofmedia=$_REQUEST['num_of_media'];

      $training_id = $_REQUEST['training_plan_id'];

        if($item_id!='' && $training_id!='')

{     

  for($i=0;$i<$numofmedia;$i++){

    //echo "--".$i;

    $itemtitle=$_REQUEST['item_title'][$i];

    $item_mediatype=$_REQUEST['mediatype'][$i];

    $training_planid=$training_id;



    if($_FILES['mediafile']['size'][$i] > 0){

      /*$chat_data = 'https://ctdworld.co/athlete/uploads/chat_data/';*/

      //$target="uploads/chat_data/";

      $type = $_FILES['mediafile']['type'][$i];

      $name = $_FILES['mediafile']['name'][$i];

      $name1 = str_replace(" ","",$name);

      $new_name = uniqid()."_".basename($name1);

      $new = $new_name;

      $file_url = UPLOAD_DIR.$new_name;

      $newfile_url = "https://ctdworld.co/athlete/".UPLOAD_DIR.$new_name;

      move_uploaded_file($_FILES['mediafile']['tmp_name'][$i],$file_url);     

    }

        $add_fav = mysqli_query($con, "update  `athlete_training_media` set `title`='$itemtitle', `type`='$item_mediatype',`filename`='$new', `link`='$newfile_url', where `id` = '$item_id' && `training_plan_id` = '$training_planid'");

  }

    

  





  if($add_fav)

  {

    $data['success'] = "1";

    $data['message'] = "Data Updated Successfully.";

    echo json_encode($data);

  }

  else

  {

    $data['success'] = "0";

    $data['message'] = "Something mistake.";

    echo json_encode($data);

  }

}

else

{

  $data['success'] = "0";

  $data['message'] = "Please enter all required fields.";

  echo json_encode($data);

}

}

else{

  $data['success'] = "0";

  $data['message'] = "Please check again something mistake.";

  echo json_encode($data);

}

break;



################################################################################

// delete training plan new item rn API By Ranjeet On 12-04-2019   



case "delete training plan new item rn" :



//$delete_training_plan_new_item_rn = $_REQUEST['delete_training_plan_new_item_id'];

$item_id = $_REQUEST['item_id'];

$training_plan_id = $_REQUEST['training_plan_id'];

//$title = $_REQUEST['title'];

//$type = $_REQUEST['type'];

//$filename = $_REQUEST['filename'];

//$link = $_REQUEST['link'];

if($item_id != '' && $training_plan_id != '')

{

  

  $rescount=mysqli_query($con,"SELECT * from `athlete_training_media`  where training_plan_id='$training_plan_id' && id='$item_id'");

  $rocount=mysqli_num_rows($rescount);

    if($rocount>0){

  $in_check_list = mysqli_query($con, "DELETE FROM `athlete_training_media` where `training_plan_id` = '$training_plan_id' && `id` = '$item_id'");

  if($in_check_list)

  {

    $empt = array("success" => '1', "message" => 'Deleted Training Plan Item Successfully', "postId" =>$item_id);

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

    $empt = array("success" => '0', "message" => 'This Data Already has been deleted');

    echo json_encode($empt);

  }



}

else

{

  $empt = array("success" => '0', "message" => 'Please enter all required fields');

  echo json_encode($empt);

}





break;

################################################################################



// delete_news_feed API By Ranjeet On 09-04-2019   



case "delete_news_feed" :



$delete_news_feed_id = $_REQUEST['delete_news_feed_id'];

if($delete_news_feed_id != '')

{

  

  $rescount=mysqli_query($con,"SELECT * from `athlete_news_feed`  where id='$delete_news_feed_id' ");

  $rocount=mysqli_num_rows($rescount);

    if($rocount>0){

  $in_check_list = mysqli_query($con, "DELETE FROM `athlete_news_feed` where `id` = '$delete_news_feed_id'");

  if($in_check_list)

  {

    $empt = array("success" => '1', "message" => 'Deleted News Feed Successfully', "postId" =>$delete_news_feed_id);

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

    $empt = array("success" => '0', "message" => 'This Data Already has been deleted');

    echo json_encode($empt);

  }



}

else

{

  $empt = array("success" => '0', "message" => 'Please enter all required fields');

  echo json_encode($empt);

}





break;



###############################################################################



// Delete Contact Friend API By Ranjeet On 23-04-2019   



case "Delete Contact Friend API" :



$delete_contact_id_from = $_REQUEST['delete_contact_id_from'];

$delete_contact_id_to_count = count($_REQUEST['delete_contact_id_to']);

if($delete_contact_id_from != '')

{

    if($_REQUEST['delete_contact_id_to']!=''){

  for($i=0;$i<$delete_contact_id_to_count;$i++) 

  {

  $delete_contact_id_to = $_REQUEST['delete_contact_id_to'];  

  $in_check_list = mysqli_query($con, "DELETE FROM `athlete_report_request` WHERE (`request_from`='$delete_contact_id_from' && `request_to`='$delete_contact_id_to[$i]' || `request_from`='$delete_contact_id_to[$i]' && `request_to`='$delete_contact_id_from' )");            



    }

  }else{

    echo "";

  }

  if($in_check_list)

  {

    $empt = array("success" => '1', "message" => 'Deleted Contact Successfully', "postId" =>$delete_contact_id_to);

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





break;



###############################################################################



// create_survey_multiple API By Ranjeet On 04-06-2019   



case 'create_survey_multiple':



/*

echo "<pre>";

print_r($_REQUEST);

print_r($_FILES);

echo "</pre>";

die;

*/



$user_id=$_REQUEST['user_id'];

$title=$_REQUEST['survey_title'];

$description=$_REQUEST['survey_description'];

$num_of_questions=$_REQUEST['num_of_questions'];

$cur_date = date("y-m-d");

$cur_time = date('H:i:s');

$date_time = $cur_date." ".$cur_time;

if($user_id!='' && $title!='')

{ 

  $insrtsql="INSERT into `athlete_survey_multiple`(`user_id`,`title`,`description`,`date_time`,`flag`) values('$user_id','$title','$description','$date_time',1) ";

  $add_survey_multiple = mysqli_query($con, $insrtsql);

  $survey_multiple_id = mysqli_insert_id($con);

  $data['survey_multiple_id'] = $survey_multiple_id;

  

  for($i=0;$i<$num_of_questions;$i++)

  {

    //echo "--".$i;

    // print_r($_REQUEST['question_option'][$i]); die;

    

    $question_title=$_REQUEST['question_title'][$i];

    //$question_image=$_REQUEST['question_image'][$i];    

    $question_type=$_REQUEST['question_type'];

    $question_option=json_encode($_REQUEST['question_option'][$i]);

    $survey_id=$survey_multiple_id;



    if($_FILES['question_file']['size'][$i] > 0)

    {

      /*$chat_data = 'https://ctdworld.co/athlete/uploads/chat_data/';*/

      //$target="uploads/chat_data/";

      $type = $_FILES['question_file']['type'][$i];

      $name = $_FILES['question_file']['name'][$i];

      $name1 = str_replace(" ","",$name);

      $new_name = uniqid()."_".basename($name1);

      $new = $new_name;

      $file_url = UPLOAD_DIR.$new_name;

      $newfile_url = "https://ctdworld.co/athlete/".UPLOAD_DIR.$new_name;

      move_uploaded_file($_FILES['question_file']['tmp_name'][$i],$file_url);     

    }

    $iteminsrtsql="INSERT into `athlete_survey_media` (survey_id ,question_title ,question_type,question_option,filename,link) values('$survey_id','$question_title','$question_type','$question_option','$new','$newfile_url') ";

    $add_trainingitem = mysqli_query($con, $iteminsrtsql);

  }   

  $data['message'] = "Survey created successfully.";

  $empt1 = array("res" => '1', "result"=>$data);

  echo json_encode($empt1); 

} 

else

{

  $data['success'] = "0";

  $data['message'] = "Please enter all required fields.";

  echo json_encode($data);

}

break;



/* Created on 18th July  edit survey multiple */

case 'edit_survey_multiple':

  // echo "<pre>";

  // print_r($_REQUEST);

  // print_r($_FILES); die;

  $survey_multiple_id = $_REQUEST['survey_multiple_id'];

  $user_id=$_REQUEST['user_id'];

  $title=$_REQUEST['survey_title'];

  $description=$_REQUEST['survey_description'];

  $num_of_questions = $_REQUEST['num_of_questions'];

  $cur_date = date("y-m-d");

  $cur_time = date('H:i:s');

  $date_time = $cur_date." ".$cur_time;

  if($survey_multiple_id !="" && $user_id !='' && $title !='')

  { 

    //$insrtsql="INSERT into `athlete_survey_multiple`(`user_id`,`title`,`description`,`date_time`,`flag`) values('$user_id','$title','$description','$date_time',1) ";



    mysqli_query($con, "UPDATE `athlete_survey_multiple` SET `title` = '$title', `description` = '$description',

    `updated_date_time` = '$date_time' WHERE id = $survey_multiple_id");



    /* Before updating remove previous entries from athlete_survey_media via survey_multiple_id */



    mysqli_query($con, "DELETE FROM `athlete_survey_media` WHERE `survey_id` = '$survey_multiple_id'");



    /* Here we have two cases one is where we are updating new questions and media to survey 

     * and other is where we are updating the previously created 

     */





    /* The below code will help to update already added records */



    if(isset($_REQUEST['up_ques']) && !empty($_REQUEST['up_ques']))

    {

      foreach($_REQUEST['up_ques'] as $key => $value)

      {







        /* Let's update question_title, question_type, question_option and filename and link*/  

        $question_title = $value['question_title'];

        $question_type = $value['question_type'];

        $question_option = json_encode($value['question_option']);

        $link = $value['link'];



        $sql = "UPDATE athlete_survey_media SET `question_title` = '$question_title', `question_type` = '$question_type', 

        `question_option` = '$question_option', `link` = '$link' WHERE `id` = '$key' and `survey_id` = $survey_multiple_id";

        mysqli_query($con, $sql);

      }

    }

    // echo "<pre>";

    // print_r($_FILES['up_ques']['name']); die;



    if(isset($_FILES['up_ques_file']) && !empty($_FILES['up_ques_file']))

    {

      foreach($_FILES['up_ques_file']['name'] as $key => $value)

      {     

        $type = $_FILES['up_ques_file']['type'][$key];

        $name = $_FILES['up_ques_file']['name'][$key];

        $name1 = str_replace(" ","",$name);

        $new_name = uniqid()."_".basename($name1);

        $new = $new_name;

        $file_url = UPLOAD_DIR.$new_name;

        $newfile_url = "https://ctdworld.co/athlete/".UPLOAD_DIR.$new_name;

        move_uploaded_file($_FILES['up_ques_file']['tmp_name'][$key],$file_url);      

        

        $sql = "UPDATE athlete_survey_media SET `filename` = '$new_name' WHERE `id` = '$key' and `survey_id` = $survey_multiple_id";

        mysqli_query($con, $sql);       

      }

    }



    $data['survey_multiple_id'] = $survey_multiple_id;

    

    for($i=0; $i<$num_of_questions;$i++)

    {

      //echo "--".$i;



      $imageURL = $_REQUEST['imageURL'][$i];

      $imagename = $_REQUEST['imagename'][$i];

      $question_title=$_REQUEST['question_title'][$i];

      //$question_image=$_REQUEST['question_image'][$i];    

      $question_type=$_REQUEST['question_type'];

      $question_option= json_encode($_REQUEST['question_option'][$i]);

      $survey_id=$survey_multiple_id;



      if(!empty($_FILES['question_file']))

      {

        /*$chat_data = 'https://ctdworld.co/athlete/uploads/chat_data/';*/

        //$target="uploads/chat_data/";

        $type = $_FILES['question_file']['type'][$i];

        $name = $_FILES['question_file']['name'][$i];

        $name1 = str_replace(" ","",$name);

        $new_name = uniqid()."_".basename($name1);

        $new = $new_name;

        $file_url = UPLOAD_DIR.$new_name;

        $newfile_url = "https://ctdworld.co/athlete/".UPLOAD_DIR.$new_name;

        move_uploaded_file($_FILES['question_file']['tmp_name'][$i],$file_url);     

      }



      if($type){



      $iteminsrtsql="INSERT into `athlete_survey_media` (survey_id ,question_title ,question_type,question_option,filename,link) values('$survey_id','$question_title','$question_type','$question_option','$new','$newfile_url') ";





            }elseif ($imageURL){ 



$iteminsrtsql="INSERT into `athlete_survey_media` (survey_id ,question_title ,question_type,question_option,filename,link) values('$survey_id','$question_title','$question_type','$question_option','$imagename','$imageURL') ";

      

    }else{

  $iteminsrtsql="INSERT into `athlete_survey_media` (survey_id ,question_title ,question_type,question_option) values('$survey_id','$question_title','$question_type','$question_option') ";

    }



    $add_trainingitem = mysqli_query($con, $iteminsrtsql);

    } 



    $data['message'] = "Survey updated successfully.";

    $empt1 = array("res" => '1', "result"=>$data);

    echo json_encode($empt1); 

  } 

  else

  {

    $data['success'] = "0";

    $data['message'] = "Please enter all required fields.";

    echo json_encode($data);

  }

break;

























































###############################################################################



// create_yes_no_survey API By Ranjeet On 20-06-2019   



case 'create_yes_no_survey':



$user_id=$_REQUEST['user_id'];

$title=$_REQUEST['title'];

$description=$_REQUEST['description'];

$num_of_questions=$_REQUEST['num_of_questions'];

$cur_date = date("Y-m-d");

$cur_time = date('H:i:s');

$date_time = $cur_date." ".$cur_time;

if($user_id!='' && $title!='')

{ 

  $insrtsql="INSERT into `athlete_survey_yes_no`(`user_id`,`title`,`description`,`date_time`,`flag`) values('$user_id','$title','$description','$date_time',1) ";

  $add_survey_yes_no = mysqli_query($con, $insrtsql);

  $survey_yes_no_id = mysqli_insert_id($con);

  $data['survey_yes_no'] = $survey_yes_no_id;

  for($i=0;$i<$num_of_questions;$i++){

    $add_question=$_REQUEST['add_question'][$i];

    $question_type=$_REQUEST['question_type'];

    $survey_id=$survey_yes_no_id;



    if($_FILES['question_file']['size'][$i] > 0){

      /*$chat_data = 'https://ctdworld.co/athlete/uploads/chat_data/';*/

      //$target="uploads/chat_data/";

      $type = $_FILES['question_file']['type'][$i];

      $name = $_FILES['question_file']['name'][$i];

      $name1 = str_replace(" ","",$name);

      $new_name = uniqid()."_".basename($name1);

      $new = $new_name;

      $file_url = UPLOAD_DIR.$new_name;

      $newfile_url = "https://ctdworld.co/athlete/".UPLOAD_DIR.$new_name;

      move_uploaded_file($_FILES['question_file']['tmp_name'][$i],$file_url);     

    }

    $iteminsrtsql="INSERT into `athlete_survey_yes_no_media` (survey_id ,add_question ,question_type,filename,link) values('$survey_id','$add_question','$question_type','$new','$newfile_url') ";

    $add_trainingitem = mysqli_query($con, $iteminsrtsql);

  }   

  $data['message'] = "Survey Yes No created successfully.";

  $empt1 = array("res" => '1', "result"=>$data, "created_date"=>$date_time);

  echo json_encode($empt1); 

} 

else

{

  $data['success'] = "0";

  $data['message'] = "Please enter all required fields.";

  echo json_encode($data);

}

break;



/* Edit Yes No API Survey */



case 'edit_yes_no_survey':



$user_id=$_REQUEST['user_id'];

$survey_id=$_REQUEST['survey_id'];

$title=$_REQUEST['title'];

$description=$_REQUEST['description'];

$num_of_questions=$_REQUEST['num_of_questions'];

$cur_date = date("y-m-d");

$cur_time = date('H:i:s');

$date_time = $cur_date." ".$cur_time;



if($user_id!='' && $title!='' && $survey_id !="")

{ 

  $sql = mysqli_query($con, "UPDATE `athlete_survey_yes_no` SET `title` = '$title',`description` = '$description',

  `updated_date_time` = '$date_time' WHERE id = '$survey_id'"); 

  

  /* Once survey is updated let's remove earlier updated media first */

  

  $sql = mysqli_query($con, "DELETE FROM `athlete_survey_yes_no_media` WHERE `survey_id` = $survey_id");



  for($i=0; $i<$num_of_questions; $i++)

  {







    $imageURL = $_REQUEST['imageURL'][$i];

      $imagename = $_REQUEST['imagename'][$i];

    $add_question=$_REQUEST['add_question'][$i];

    $edit_questionid=$_REQUEST['edit_questionid'][$i];

    $question_type=$_REQUEST['question_type'];

    // $survey_id=$survey_yes_no_id;



    if(!empty($_FILES['question_file']))

    {

      /*$chat_data = 'https://ctdworld.co/athlete/uploads/chat_data/';*/

      //$target="uploads/chat_data/";

      $type = $_FILES['question_file']['type'][$i];

      $name = $_FILES['question_file']['name'][$i];

      $name1 = str_replace(" ","",$name);

      $new_name = uniqid()."_".basename($name1);

      $new = $new_name;

      $file_url = UPLOAD_DIR.$new_name;

      $newfile_url = "https://ctdworld.co/athlete/".UPLOAD_DIR.$new_name;

        move_uploaded_file($_FILES['question_file']['tmp_name'][$i],$file_url); 

        

    }

if($type){

     $iteminsrtsql="INSERT into `athlete_survey_yes_no_media` (survey_id ,add_question ,question_type,filename,link) values('$survey_id','$add_question','$question_type','$new','$newfile_url') ";

}elseif($imageURL){



$iteminsrtsql="INSERT into `athlete_survey_yes_no_media` (survey_id ,add_question ,question_type,filename,link) values('$survey_id','$add_question','$question_type','$imagename','$imageURL') ";



    }else{

 $iteminsrtsql="INSERT into `athlete_survey_yes_no_media` (survey_id ,add_question ,question_type) values('$survey_id','$add_question','$question_type') ";

    }



    $add_trainingitem = mysqli_query($con, $iteminsrtsql);

  }   

  $data['message'] = "Survey Yes No updated successfully.";

  $empt1 = array("res" => '1', "result"=>$data);

  echo json_encode($empt1); 

} 

else

{

  $data['success'] = "0";

  $data['message'] = "Please enter all required fields.";

  echo json_encode($data);

}

break;













}





?>