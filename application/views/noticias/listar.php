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
    <h2 class="subtitulo2">Titulares:</h2>
<?php foreach ($noticias as $n): ?>
<div class="noticias">
    <div class="contenido">
    <h2 class="subtitulo"><?php echo $n->titulo; ?></h2>
    <a><?php echo html::image('media/images/miniaturas2/'.$n->foto_mini,array('class'=>'thumb', 'height'=>80, 'width'=>120, 'align'=>'left'));?></a>
    <div class="description"> <span>La Paz, <?php echo date('d M Y',$n->fecha_creacion);?></span><br/>
    <p><?php echo limitWords($n->descripcion,30);?></p>
    <?php echo html::anchor('./comunicados/detalle/'.$n->id,'Leer mas');?>
    </div>
<br/>
</div>
</div>
<?php endforeach; ?>
</div>
<?php
$anuncios =  ORM::factory('comunicados')->where('tipo','=',4)->limit(3)->find_all();
?>
<div id="publicidad" class="widget Feed"     >
    <h2 class="subtitulo2">Anuncios:</h2>
    <?php foreach($anuncios as $a):?>
    <a href="<?php echo $a->url;?>" target="_blank" class="anuncios">
        <h3><?php echo $a->titulo; ?></h3>
        <?php echo html::image('media/images/miniaturas2/'.$a->foto_mini,array('width'=>'150')); ?>
        <?php echo $a->url;?>
    </a>
    <?php endforeach;?>
</div>
<div class="clearfix"></div>
<div class="clearfix"></div>
<div id="caroussel">
<h2 class="subtitulo2">Empresas y Entidades Dependientes</h2>
<div class="image_carousel">
	<div id="foo1">
            <a href="http://www.senavex.gob.bo/" target="_blank"><img src="media/images/senavex.png" alt="basketball" width="125" height="95" /></a>
            <a href="http://www.autoridadempresas.gob.bo/" target="_blank"><img src="media/images/aemp.png" alt="basketball" width="125" height="95" /></a>
            <a href="http://www.senapi.gob.bo/" target="_blank"><img src="media/images/senapi.png" alt="basketball" width="125" height="95" /></a>
            <a href="http://www.promueve.gob.bo/" target="_blank"><img src="media/images/promueve.png" alt="basketball" width="125" height="95" /></a>
            <a href="http://www.produccion.gob.bo/siexco/ingenio/" target="_blank"><img src="media/images/siexco.png" alt="basketball" width="125" height="95" /></a>
            <a href="http://www.probolivia.gob.bo/" target="_blank"><img src="media/images/probolivia.png" alt="basketball" width="125" height="95" /></a>
            <a href="http://www.insumosbolivia.gob.bo/" target="_blank"><img src="media/images/insumos.png" alt="basketball" width="125" height="95" /></a>		

	</div>
	<div class="clearfix"></div>
</div>
</div>

<?php echo date('d M Y h:i:s',time());
echo  time();?>