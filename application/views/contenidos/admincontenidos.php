<script type="text/javascript">
$(function() {
	$('#demo').dataTable({"sPaginationType": "full_numbers",
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]],

            "oLanguage": {
			"sLengthMenu": "Mostrar _MENU_ por página",
			"sZeroRecords": "No se encontro nada - lo siento",
			"sInfo": "Mostrando _START_ - _END_ de _TOTAL_ documentos",
			"sInfoEmpty": "Mostrando 0 - 0 de 0 records",
			"sInfoFiltered": "(filtered from _MAX_ total records)"
		}
                });
        $('.delete').click(function(){
            var noticia=$(this).attr('alt');
            var id=$(this).attr('id');
            if(confirm('ELIMINAR CONTENIDO: '+noticia)){
              windows.location="../eliminar/"+id;
            }
            else
            return false;
            
        });
} );
</script>
<div id="noticias3">
    <h2 class="subtitulo2">Administrador de contenidos:</h2>
    <?php echo html::anchor(url::base().'contenido/add',html::image('media/images/add.png'),array('title'=>'Agregar nueva noticia')); ?>
    <hr/>
<table id="demo">
    <thead>
        <tr>
            <th>ID</th><th>Titulo</th><th>Fecha publicación</th><th>Opciones</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($contenidos as $c): ?>
        <tr>
            <td><?php echo $c->id;?></td><td><?php echo $c->titulo;?></td><td><?php echo date('d M Y',$c->fecha_creacion);?></td><td><?php echo html::anchor(url::base().'contenido/editar/'.$c->id,html::image('media/images/edit.png'),array('title'=>'Editar Noticia')); echo html::anchor(url::base().'contenido/eliminar/'.$c->id,html::image('media/images/delete.png'),array('title'=>'Eliminar Noticia','id'=>$c->id,'class'=>'delete','alt'=>$c->titulo));?></td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>
</div>
