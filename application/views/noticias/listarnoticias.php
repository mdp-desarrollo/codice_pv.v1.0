<?php
//funcion para recortar la cnatidad de palabras
function limitWords ($aText, $wordCountLimit)
   {
      if (strlen($aText) > 0)
      {
         $tagStrippedText = strip_tags($aText);
         if (str_word_count($tagStrippedText) <= $wordCountLimit)
         {
            return $tagStrippedText;
         }
         return implode(' ', array_slice(explode(' ', $tagStrippedText, $wordCountLimit), 0, ($wordCountLimit - 1))) . '...';
      }
      return '';
   }
?>
<div id="noticias">
    <h2 class="subtitulo2">Noticias:</h2>
<?php foreach ($noticias as $n): ?>
<div class="noticias">
<div class="contenido"      
    <h2><?php echo $n->titulo; ?></h2>
    <a><img src="<?php echo URL::base().'media/fotos/'.$n->foto_mini; ?>" alt="<?php echo $n->titulo;?>" class="thumb" height="80" width="120" align="left"/></a>
    <div class="description"> <span><?php echo date('d M Y',$n->fecha_creacion);?></span><br/>
<p><?php echo limitWords($n->descripcion,30);?></p>
<a href="<?php echo URL::base().'comunicados/detalle/'.$n->id;?>"> Leer Mas</a>
    </div>
<br/>
</div>
</div>
<?php endforeach; ?>
</div>
