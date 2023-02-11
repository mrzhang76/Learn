<html>
    <head>
        <title>Books-O-Rama Search Results</title>
    </head>
    <body>
        <h1>Books-o-Rama Search Results</h1>
        <?php 
        $searchtype = $_POST['searchtype'];
        $searchterm = trim($_POST['searchterm']);

        if(!$searchtype || !$searchterm){
            echo '<p>You have not entered search details.<br />Please go back and try again.</p>';
            exit;
        }

        switch ($searchtype){
            case 'Title':
            case 'Author':
            case 'ISBN':
                break;
            default:
                echo '<p>That is not a valid search type.<br />Please go back and try again.</p>';
                exit;
        }

        $user = 'bookorama';
        $pass = 'bookorama123';
        $host = 'localhost';
        $db_name = 'Books';

        $dsn = "mysql:host=$host;dbname=$db_name"; //不能有空格！！！

        try{
            $db = new PDO($dsn, $user, $pass);

            $query = "SELECT ISBN, Author, Title, Price FROM Books WHERE $searchtype = :searchterm";
            $stmt = $db -> prepare($query);
            $stmt -> bindParam(':searchterm',$searchterm);
            $stmt -> execute();
            
            echo "<p>Number of books found: ".$stmt -> rowCount()."</p>";

            while($result = $stmt -> fetch(PDO::FETCH_OBJ)){
                echo "<p><strong>Title: ".$result -> Title."</strong>";
                echo "<br />Author: ".$result -> Author;
                echo "<br />ISBN: ".$result -> ISBN;
                echo "<br />Price: \$".number_format($result -> Price,2)."</p>";
            }

            $db = NULL;    
        }catch(PDOException $e){
            echo "Error: ".$e -> getMessage();
            exit;
        }
        ?>
    </body>
</html>