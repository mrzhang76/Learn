<?php 
    require_once("file_exceptions.php");

    define('TIREPRICE',100);
    define('OILPRICE',10);
    define('SPARKPRICE',4);
    $document_root = $_SERVER['DOCUMENT_ROOT'];
    $tireqty = (int) $_POST['tireqty'];
    $oilqty = (int) $_POST['oilqty'];
    $sparkqty = (int) $_POST['sparkqty'];
    $address = preg_replace('/\t|\R/',' ',$_POST['address']);
    $document_root = $_SERVER['DOCUMENT_ROOT'];
    $date = date('H:i, jS F Y');
    $totalqty = 0;
    $totalqty = $tireqty + $oilqty + $sparkqty;
    $totalamount = 0.00;
    $totalamount = $tireqty * TIREPRICE + $oilqty * OILPRICE + $sparkqty * SPARKPRICE;
    $taxrate = 0.10; 
    $totalamount = $totalamount * (1 + $taxrate);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bob`s Auto Parts - Order Results</title>
    </head>
    <body>
        <h1>Bob`s Auto Parts</h1>
        <h2>Order Results</h2>
        <?php 
            if($totalqty == 0){
                echo '<p style="color:red">';
                echo "You did not order anything on the previous page!<br />";
                echo '</p>';
                exit;
            }
            echo"<p>Order processed at ";
            echo date(' H:i, jS F Y');
            echo "</p>";
            echo "<p>Your order is as follows:</p>";
            if($tireqty > 0)
                echo htmlspecialchars($tireqty).' tires<br/>';
            if($oilqty > 0)
                echo htmlspecialchars($oilqty).' bottles of oil<br />';
            if($sparkqty > 0)
                echo htmlspecialchars($sparkqty).' spark plugs<br />';
            echo "<p> Items ordered :".$totalqty."<br />";
            echo "Subtotal: $".number_format($totalamount,2)."<br />";
            echo "Total including tax: $".number_format($totalamount,2)."</p>"; 
            echo "<p>Address to ship to is ".htmlspecialchars($address)."</p>";
            $outputstring = $date."\t".$tireqty." tires \t".$oilqty." oil\t".$sparkqty." spark plugs\t\$".$totalamount."\t".$address."\n";
            
            try{
                if(!($fp = @fopen("$document_root/../orders/orders.txt",'ab'))){
                    throw new fileOpenException();
                }
                
                if(!flock($fp,LOCK_EX)){
                    throw new fileLockException();
                }
                
                if(!fwrite($fp,$outputstring,strlen($outputstring))){
                    throw new fileWriteException();
                }
                
                flock($fp,LOCK_UN);
                fclose($fp);
                echo "<p>Order written.</p>";    

            }catch(fileOpenException $foe){
                echo "<p><strong> Your order could not be processed at this time. Please try again later.</strong></p>";
            }catch(Exception $e){
                echo "<p><strong> Your order could not be processed at this time. Please try again later.</strong></p>";
            }


              ?>
    </body>
</html>