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

        @$db = new mysqli('localhost','bookorama','bookorama123','Books');
        #@$db = mysqli_connect('localhost','bookorama','bookorama123','Books'); 
        if(mysqli_connect_errno()){
            echo '<p>Error: Could not connect to database.<br />Please try again later.</p>';
            exit;
        }

        $query = "SELECT ISBN, Author, Title, Price FROM Books WHERE $searchtype = ?";
        $stmt = $db -> prepare($query);
        $stmt -> bind_param('s',$searchterm);
        $stmt -> execute();
        $stmt -> store_result();

        $stmt -> bind_result($isbn, $author, $title, $price);

        echo "<p>Number of books found: ".$stmt->num_rows."</p>";

        while($stmt -> fetch()){
            echo "<p><strong>Title: ".$title."</strong>";
            echo "<br />Author: ".$author;
            echo "<br />ISBN: ".$isbn;
            echo "<br />Price: \$".number_format($price,2)."</p>";
        }

        $stmt -> free_result();
        $db -> close();

        ?>
    </body>
</html>