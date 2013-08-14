<?php
//header("Content-type: image/gif");//Habilitar si es para web y no para documentos
// Definimos las dimensiones de la grafica
$im_w = 20; // Ancho de la imagen
$im_h = 110; // Alto de la imagen
$im_margen = 0; // Margen lateral
$origen = $im_h-5; // Origen del texto
// Creamos la imagen
$imagen = imagecreate($im_w,$im_h);
// Definimos los colores
$bg = imagecolorallocate($imagen,255,255,255);
$negro = imagecolorallocate($imagen,0,0,0);
// Definimos la fuente
$f = 6;
// Obtenemos el ancho y alto de la fuente 
$f_w = imagefontwidth($f);
imagestringup($imagen,$f,$im_margen,$origen,$nur,$negro);
imagegif($imagen);
imagedestroy($imagen);
?>