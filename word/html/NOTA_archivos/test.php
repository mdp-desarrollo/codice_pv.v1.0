<?php
define('IN_CB',true);
require('../codigobar/class/index.php');
require('../codigobar/class/FColor.php');
require('../codigobar/class/BarCode.php');
require('../codigobar/class/FDrawing.php');
include('../codigobar/class/code39.barcode.php');
$color_black = new FColor(0,0,0);
$color_white = new FColor(255,255,255);
$code_generated = new code39(30,$color_black,$color_white,1,$nur,0);
$drawing = new FDrawing(1024,1024,'',$color_white);
$drawing->init();
$drawing->add_barcode($code_generated);
$drawing->draw_all();
$im = $drawing->get_im();
$im2 = imagecreate($code_generated->lastX,$code_generated->lastY);
imagecopyresized($im2, $im, 0, 0, 0, 0, $code_generated->lastX, $code_generated->lastY, $code_generated->lastX, $code_generated->lastY);
$drawing->set_im($im2);
$drawing->finish(IMG_FORMAT_JPEG);
?>