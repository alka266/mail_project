<?php

/**
 * @author Ravi Tamada
 * @link URL Tutorial link
 */
class Firebase {

    // sending push message to single user by firebase reg id
    public function send($to, $message) {
        $fields = array(
            'to' => $to,
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }

    // Sending message to a topic by topic name
    public function sendToTopic($to, $message) {
        $fields = array(
            'to' => '/topics/' . $to,
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }

    // sending push message to multiple users by firebase registration ids
    public function sendMultiple($registration_ids, $message) {
        $fields = array(
            'to' => $registration_ids,
            'data' => $message,
        );

        return $this->sendPushNotification($fields);
    }
    
 private function sendPushNotification11($fields) {
     //echo "<pre>";
     //print_r($fields);exit;
    $url = "https://fcm.googleapis.com/fcm/send";
    $token = "dHKP0SOOXyM:APA91bFE-nJhEJ0HRWTMjsgDa79zNanW1EckuTbrCV0qCf-Bs5mjyxl_wakJD2-Y-0ag3uLAk8z9B83ynqYsDOjnNHMMLZTBm81katDohmO1En-yaS0yl6jUEw5rIiMOQchlp4kBAPwN";
    $serverKey = 'AAAATTL0usI:APA91bEsJH_Nz8zCNl-ceJqinRXTc1X5lUTWdpmWOUkO5HYpWwwioK-RgYWLC2qdbAaXkyYnPAWEwEo4jJe_pODVL6CjPNkc9qmAwlLzj4NP7n-yoJ0zRCSiv7_oHS0J_V7XyMwiHwnZ';
    $title = "Notification title";
    $body = "Hello I am from Your php server";
    $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
    $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
    $json = json_encode($arrayToSend);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key='. $serverKey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
    //Send the request
    $response = curl_exec($ch);
    //Close request
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
}
    // function makes curl request to firebase servers
    private function sendPushNotification($fields) {
        
        require_once __DIR__ . '/config.php';
/*echo "<pre>";
print_r($fields);exit;*/
        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = array(
            'Authorization: key=' . FIREBASE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        return $result;
    }
}

?>