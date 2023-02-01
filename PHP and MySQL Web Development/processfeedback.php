<?php 
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $feedback = trim($_POST['feedback']);

    $toaddress = "feedback@example.com";
    $subject = "Feedback from web site";
    $mailcontent = "Customer name: ".str_replace("\r\n","",$name)."\n".
                   "Customer email: ".str_replace("\r\n","",$email)."\n".
                   "Customer comments:\n".str_replace("\r\n","",$feedback)."\n";
    
    $fromaddress = "From: webserver@example.com";
    if(preg_match('/^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/',$email) === 0 ){
        echo "<p>That is not a valid email address.</p>". 
             "<p>Please return to the previous page and try again.</p>";
        exit;
    }
    if(preg_match('/shop|costomer service|retail/',$feedback)){
        $toaddress = 'retail@example.com';
    }else if(preg_match('/deliver|fulfill/',$feedback)){
        $toaddress = 'fulfillment@example.com';
    }else if(preg_match('/bill|account/',$feedback)){
        $toaddress = 'account@example.com';
    }
    if(preg_match('/bigcustomer\.com/',$email)){
        $toaddress = 'bob@example.com';
    }
    
    mail($toaddress,$subject,$mailcontent,$fromaddress);

    ?>
<html>
    <head>
        <title>Bob`s Auto Parts - Feedback Submitted</title>
    </head>
    <body>
        <h1>Feedback submited</h1>
        <p>Your feedback (shown below) has been sent.</p>
        <p><?php echo nl2br(htmlspecialchars($feedback)); ?></p>
    </body>
</html>