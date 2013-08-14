<div id="imagenes">
<table width="100%">
    <tbody>
<?php
$i=1;
foreach($imagenes as $imagen):?>
        <tr>
            <td><?php echo $i;?></td>
            <td><?php echo html::image('media/images/miniaturas2/'.$imagen->nombre); ?></td>
            <td><?php  echo date('d M Y',$imagen->fecha_subida);?></td>
            <td><?php  echo html::anchor('media/images/miniaturas/'.$imagen->nombre,'Ver Imagen',array('target'=>'_blank'));?></td>
        </tr>
<?php $i++; endforeach;  ?>
    </tbody>
  </table>
</div>