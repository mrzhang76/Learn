<?php
function register($username,$email,$password){
    $conn = db_connect();
    $result = $conn -> query("select * from user where username='".$username."'");
    if(!$result){
        throw new Exception('Could not execute query');
    }
    if($result -> num_rows > 0){
        throw new Exception('That username is taken - go back and choose another one.');
    }
    $result = $conn -> query("insert into user values ('".$username."',sha1('".$password."'),'".$email."')");
    if(!$result){
        throw new Exception('Could not register you in database - please try again later.');
    }
}

function login($username,$password){
    $conn = db_connect();
    $result = $conn -> query("select * from user where username='".$username."' and passwd = sha1('".$password."')");
    if(!$result)
        throw new Exception('Could not log you in.(1)');
    if($result -> num_rows > 0)
        return true;
    else
        throw new Exception('Could not log you in.(2)');
}

function check_valid_user(){
    if(isset($_SESSION['valid_user']))
        echo "Logged in as ".$_SESSION['valid_user'].".<br />";
    else{
        do_html_heading('Problem: ');
        echo 'You are not logged in.(3)<br />';
        do_html_url('login.php','Login');
        do_html_footer();
        exit;
    }
}

function change_password($username, $old_password, $new_password){
    login($username, $old_password);
    $conn = db_connect();
    $result = $conn -> query("update user set passwd = sha1('".$new_password."') where username = '".$username."'");
    if(!$result)
        throw new Exception('Password could not be changed.');
    else   
        return ture;
}

function reset_password($username){
    $new_password = get_random_word(6,13);
    if($new_password == false)
        $new_password = "changeMe!";
    $rand_number = rand(0,999);
    $new_password .= $rand_number;
    $conn = db_connect();
    $result = $conn -> query("update user set passwd = sha1('".$new_password."') where username = '".$username."'");
    if(!$result)
        throw new Exception('Could not change password.');
    else
        return $new_password;
}

function get_random_word($min_length,$max_length){
    $word = '';
    $dictionary = '';
    $fp = @fopen($dictionary,'r');
    if(!$fp)
        return false;
    $size = filesize($dictionary);
    $rand_location = rand(0,$size);
    fseek($fp,$rand_location);
    while ((strlen($word) < $min_length) || (strlen($word) > $max_length) || (strstr($word,"'"))){
        if(feof($fp))
            fseek($fp,0);
        $word = fgets($fp,80);
        $word = fgets($fp,80);
    }
    $word = trim($word);
    return $word;
}

function notify_password($username, $password){
    $conn = db_connect();
    $result = $conn -> query("select email from user where username='".$username."'");
    if(!$result)
        throw new Exception('Could not find email address.');
    else if($result -> num_rows == 0)
        throw new Exception('Could not find email address.');
    else{
        $row = $result -> fetch_object();
        $email = $row -> email;
        $from = "From: support@phpbookmark \r\n";
        $mesg - "Your PHPBookmark password has been changed to ".$passwd."\r\n".
                "Please change it next time you log in. \r\n";
        
        if(mail($email,'PHPBookmark login information',$mesg,$from))
            return true;
        else
            throw new Exception('Could not send email.');
    }
}
?>