<html>
    <head>
        <title>Mirror Update</title>
    </head>
    <body>
        <h1>Mirror Update</h1>
        <?php 
        $host = 'apache.cs.utah.edu';
        $user = 'anonymous';
        $password = 'me@example.com';
        $remotefile = '/apache.org/httpd/httpd-2.4.54.tar.gz';
        $localfile = './httpd-2.4.54.tar.gz';

        $conn = ftp_connect($host);

        if(!$conn){
            echo 'Error: Could not connect to '.host;
            exit;
        }

        echo 'Connected to '.$host.'<br />';

        $result = @ftp_login($conn, $user, $pass);
        if(!$result){
            echo 'Error: Could not log in as '.$user;
            ftp_quit($conn);
            exit;
        }

        echo 'Logged in as '.$user.'<br />';

        ftp_pasv($conn, true);

        echo 'Check file time...<br />';
        if(file_exists($localfile)){
            $localtime = filemtime($localfile);
            echo 'Local file last updated ';
            echo date('G:i j-M-Y', $localtime);
            echo '<br />';
        }
        else{
            $localtime = 0;
        }

        $remotetime = ftp_mdtm($conn, $remotefile);
        if(!($remotetime >= 0)){
            echo 'Can\'t access remote file time.<br />';
            $remotetime = $localtime + 1;
        }
        else{
            echo 'Remote file last updated ';
            echo date('G:i j-M-Y',$remotetime);
            echo '<br />';
        }

        if(!($remotetime > $localtime)){
            echo 'Local copy is up to date.<br />';
            exit;
        }

        echo 'Getting file from server...<br />';
        $fp = fopen($localfile,'wb');

        if(!$success = ftp_fget($conn, $fp, $remotefile, FTP_BINARY)){
            echo 'Error: Could not download file.';
            ftp_quit($conn);
            exit;
        }

        fclose($fp);
        echo 'File downloaded successfully.';
        ftp_close($conn);

        ?>
    </body>
</html>