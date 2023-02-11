<?php 
    $pictures = array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg');
    shuffle($pictures);
    ?>
<html>
    <head>
        <title>Bob`s Auto Parts</title>
    </head>
    <body>
        <h1>Bob`s Auto Parts</h1>
        <div align="center">
            <table style = "width:100%;text-align:center">
                <tr>
                    <?php 
                        for($i = 0; $i < 3; $i++){
                            echo "<td style=\"width:33%;text-align:center\"><img  width=\"33%\" src=\"pic/";
                            echo $pictures[$i];
                            echo "\"/></td>";
                        }
                    ?>
                </tr>
            </table>
        </div>
    </body>
</html>