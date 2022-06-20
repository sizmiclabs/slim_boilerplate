<?php
use DI\Container;
$aws = $container->get('config')['aws'];
$smsgateway = $container->get('config')['bulksmsgateway'];

function sendmail_amazonses($file, $data)
{
    global $aws;

    if($file !== "admin_alert") {    
        // include $root_path . "/templates/emails/" . $file;
        include __DIR__ . '/email_templates/' . $file;
     } else {
         $body = $data["body"];
         $subject = $data["subject"];
     }

     $ses = new \SimpleEmailService($aws["aws_access_key"], $aws["aws_secret"], $aws["aws_host"]);

    $msg = new \SimpleEmailServiceMessage();
    

    $msg->replyto = array("test@test.com");
    $msg->from = "Test <test@test.com>";
    // $msg->subject = "Just checking";
    // $msg->messagetext = "Test email";
    $msg->subject = $subject;
    $msg->to = array($data["email"]);

    if(isset($body_html)) { 
        $msg->messagehtml = $body_html;
    } else {
        $msg->messagetext = $body;
    }


    try {
		$res = $ses->sendEmail($msg);
    	var_dump($res);
	} catch (Exception $e) {
		var_dump($e);
	}

    return $response;
}

