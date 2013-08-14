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
            if(confirm('ELIMINAR NOTICIA: '+noticia)){
                
            }
            else
            return false;
            
        });
} );
</script>
<div id="noticias3">
    <h2 class="subtitulo2">Administrador de documentos:</h2>
    <?php echo html::anchor(url::base().'documentos/add',html::image('media/images/add.png'),array('title'=>'Agregar nueva noticia')); ?>
    <hr/>
<table id="demo">
    <thead>
        <tr>
            <th>ID</th><th>Titulo</th><th>Fecha publicación</th><th>Opciones</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($documentos as $d): ?>
        <tr>
            <td><?php echo $d['tipo'];?></td><td><?php echo $d['titulo'];?></td><td><?php echo $d['nombre_documento'];?></td><td><?php echo html::anchor(url::base().'noticias/editar/'.$d['id'],html::image('media/images/edit.png'),array('title'=>'Editar Noticia')); echo html::anchor(url::base().'noticias/eliminar/'.$d['id'],html::image('media/images/delete.png'),array('title'=>'Eliminar Noticia','class'=>'delete','alt'=>$d['titulo']));?></td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>
</div>
