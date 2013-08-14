<?php foreach ($noticias as $n): ?>
<div class="detalle">
<h2 class="subtitulo2"><?php echo $n->titulo; ?></h2>
<hr class="linea"/>
<p><span><?php echo date('d M Y',$n->fecha_creacion);?></span><br/>
<?php echo $n->descripcion;?>
</p>
<?php echo html::anchor('./noticias','Lista de Noticias');?>
<br/>
</div>
<?php endforeach; ?>

