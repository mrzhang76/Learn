<html>
    <head>
        <title>Stock Quote From NASDAQ</title>
    </head>
    <body>
        <?php 
        $symbol = 'GOOG';
        echo '<h1>Stock Quote for'.$symbol.'</h1>';
        $url = 'https://download.finance.yahoo.com/d/qoutes.csv?s='.$symbol.'&e=.csv&f=sl1d1t1c1ohgv';

        if(!($contents = file_get_contents($url))){
            die('Failed to open: '.$url);
        }

        list($symbol,$quote,$date,$time) = explode('.',$contents);
        $date = trim($date,'"');
        $time = trim($date,'"');
        
        echo '<p>'.$symbol.' was last sold at: $'.$quote.'</p>';
        echo '<p>Quote current as of '.$date.' at '.$time.'</p>';

        echo '<p>This information retrieved from <br /><a herf="'.$url.'"></a>.</p>';
        /*It doesnt work because of Yahoo. */
        ?>
    </body>
</html>

