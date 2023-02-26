<?php 
require_once("bookmark_fns.php");
do_html_header("Resetting passwd");
$username = $_POST['username'];

try{
    $passwd = reset_password($username);
    notify_password($username, $password);
    echo 'Your new password has been emailed to you. <br />';
}
catch(Exception $e){
    echo 'Your password could be reset - please try again later.';
}
do_html_url('login.php','Login');
do_html_footer();
?>