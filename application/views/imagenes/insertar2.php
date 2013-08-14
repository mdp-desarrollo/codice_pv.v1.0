<script type="text/javascript">
    $(function(){
        $('.insertar').click(function(){
	var imagen=new Array();
	imagen[0]=$(this).attr('href');
	window.returnValue = imagen;
	window.close();
        return false;
	});	
    });
</script>
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
            <td><?php  echo html::anchor('media/images/miniaturas2/'.$imagen->nombre,'Insertar',array('target'=>'_blank','class'=>'insertar'));?></td>
        </tr>
<?php $i++; endforeach;  ?>
    </tbody>
  </table>
</div>