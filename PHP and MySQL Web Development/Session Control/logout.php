<?php 
 session_start();
 $old_user = $_SESSION['valid_user'];
 unset($_SESSION['valid_user']);
 session_destroy();
?>
<html>
    <head>
        <title>Log out</title>
    </head>
    <body>
        <h1>Log out</h1>
        <?php 
        if(!empty($old_user)){
            echo '<p>You have been logged out.</p>';
        }
        else{
            echo '<p>You were not looged in, and so have not been logged out.</p>';
        }
        ?>
        <p><a href="authmain.php">Back to Home Page</a></p>
    </body>
</html>
