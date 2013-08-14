<?php
foreach($contenido as $c){
echo '<h2 class="subtitulo2">'.$c->titulo.'</h2>';
echo '<hr class="linea" />';
echo $c->contenido;
}
?>
