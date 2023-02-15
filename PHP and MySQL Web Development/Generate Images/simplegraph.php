<?php 
    $height = 200;
    $width = 200;

    $im = imagecreatetruecolor($width,$height);
    $white = imagecolorallocate($im, 255, 255, 255);
    $blue = imagecolorallocate($im, 0, 0, 255);

    imagefill($im, 0, 0, $blue);
    imageline($im, 0, 0, $width, $height, $white);
    imagestring($im, 4, 50, 150, 'Sales', $white);

    header('Content-type: image/png');
    imagepng($im);
    $filename = 'simple.png';
    imagepng($im,$filename); //output png to file
    imagedestroy($im);
?>