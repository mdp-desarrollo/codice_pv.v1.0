<?php
$string = $_GET['nur'];
$font = 500;
$width = ImageFontWidth($font) * strlen($string);
$height = ImageFontHeight($font);
$im = @imagecreate ($width,$height);
$background_color = imagecolorallocate ($im, 255, 255, 255); //white background
$text_color = imagecolorallocate ($im, 0, 0,0);//black text
imagestring ($im, $font, 0, 0, $string, $text_color);
header('Content-type: image/png');
imagepng ($im);
?>
