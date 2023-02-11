<?php 
    $document_root = $_SERVER['DOCUMENT_ROOT'];
    ?>
<html>
    <head>
        <title>Bob`s Auto Parts - Order Results</title>
    </head>
    <body>
        <h1>Bob`s Auto Parts</h1>
        <h2>Customer Order</h2>
        <?php 
            /*@$fp = fopen("$document_root/../orders/orders.txt",'rb');
            flock($fp,LOCK_SH);
            if(!$fp){
                echo "<p><strong>No orders pending.<br/>Please try again later.<strong></p>";
                exit;
            }
            while(!feof($fp)){
                $order = fgets($fp);
                echo htmlspecialchars($order)."<br />";
            }
            flock($fp,LOCK_UN);
            fclose($fp);*/
            $orders = file("$document_root/../orders/orders.txt");
            $number_of_orders = count($orders);
            if($number_of_orders == 0){
                echo "<p><strong>No orders pending.<br/>Please try again later.<strong></p>";
                exit;
            }
            for($i=0;$i<$number_of_orders;$i++){
                echo $orders[$i]."<br />";
            }
            ?>
    </body>
</html>