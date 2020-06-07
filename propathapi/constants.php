<?php
/*
ini_set('max_execution_time', 3000);
set_time_limit(300);
ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '64M');
*/
// Server database details

define('DBHOST', 'localhost');
define('DBNAME', 'allpro_api123');
define('DBUSER', 'apiathlete123456');
define('DBPASS', 'ctd@@123$$098');
// Local database details
// define('DBHOST', 'localhost');
// define('DBNAME', 'myblog');
// define('DBUSER', 'root');
// define('DBPASS', '');
define('UPLOAD_DIR', 'uploads/profile/');
define('UPLOAD_DOCS_DIR', 'uploads/docs/');
define('UPLOAD_CHAT_DIR', 'uploads/chat_data/');
$apiroot= "https://ctdworld.co/athlete/";
$defpushicon="http://api.androidhive.info/images/minion.jpg";
$imageurl = $apiroot.'uploads/profile/'; 
$notesurl = $apiroot.'uploads/notes_media/'; 
$nutritionsurl = $apiroot.'uploads/nutrition_feed/'; 
$statsurl = $apiroot.'uploads/stats/'; 
$trainingurl = $apiroot.'uploads/training_media/'; 
$docsurl = $apiroot.'uploads/docs/';  
$careerurl = $apiroot.'uploads/career/';  
$chat_data = $apiroot.'uploads/chat_data/';
$news_feeds_data = $apiroot.'uploads/news_feeds/';
$group_icon = $apiroot.'uploads/group_icon/';
define(PROFILE_IMAGE, $imageurl);
define(NEWSFEED_MEDIA, $news_feeds_data);
define(CHAT_DATA, $chat_data);
define(GROUP_ICON, $group_icon);
define(NOTES_MEDIA, $notesurl);
define(NUTRITION_MEDIA, $nutritionsurl);
define(STATS, $statsurl);
define(TRAINING_MEDIA, $trainingurl);
define(DEF_PUSH_ICON, $defpushicon);
define(CAREER_MEDIA, $careerurl);
//Table names//
define('PREFIX', 'athlete_'); 
?>