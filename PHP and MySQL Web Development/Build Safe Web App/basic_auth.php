<?php 
if((!isset($_SERVER['PHP_AUTH_USER'])) 
    && (!isset($_SERVER['PHP_AUTH_PW'])) 
    && (substr($_SERVER['HTTP_AUTHORIZATION'],0,6) == 'Basic')){
        list($_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW']) = 
            explode(':',base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'],6)));
    }

if(($_SERVER['PHP_AUTH_USER']!='user') || ($_SERVER['PHP_AUTH_PW']!='pass')){
    header('WWW-Authenticate:Basic realm="Realm-Name"');
    header('HTTP/1.0 401 Unauthorized');
    }else{
        ?>
        <html>
            <head>
                <title>Sercet Page</title>
            </head>
            <body>
            <?php
            echo '<h1>Here it is!</h1>
                  <p>I bet you are glad you can see this secret page.</p>';
            }
            ?>
            </body>    
        </html>
