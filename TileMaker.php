<?php

namespace emilychan\hw4\views;

// Content type
$im = @imagecreatetruecolor(200, 200)
      or die('Cannot Initialize new GD image stream');
header('Content-Type: image/jpeg');
//Display on browser
imagejpeg($im);

//Save to images folder
imagejpeg($im, 'images/blank.jpg');

imagedestroy($im);


?>
