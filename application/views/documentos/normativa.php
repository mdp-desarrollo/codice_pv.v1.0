
<script type="text/javascript">
$(function(){
$('#normativa tbody tr:odd').addClass('td_par');
$("a[href$='.pdf']").addClass("pdf").attr('title','Acrobat PDF');
$("a[href$='.docx']").addClass("doc").attr('title','Microsoft Word 2007-2010');
$("a[href$='.rtf']").addClass("doc").attr('title','Ritch Text Format');
$("a[href$='.xls']").addClass("excel").attr('title','Microsoft Excel 97-2003');
$("a[href$='.xlsx']").addClass("excel").attr('title','Microsoft Excel 2007-2010');
$("a[href$='.doc']").addClass("doc").attr('title','Microsoft Word 97-2003');
$("a[href$='.ppt']").addClass("ppt");
$("a[href$='.pptx']").addClass("ppt");
$('table tbody tr:odd').addClass('even');
//$('table tbody tr:even').addClass('even'); 
});
</script>
<h2 class="subtitulo2"><?php echo $titulo;?></h2>
<br/>
<table id="normativa">
    <thead>
        <tr>
            <th>Nombre del Documento</th><th width="100">Tamaño</th><th>Fecha de Actualización</th><th>Descargar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($documentos as $documento): ?>
        <tr>
            <td  ><?php echo $documento->titulo;?></td><td id="tamanio"><?php echo number_format($documento->tamanio/1024,0,',','.');?> Kb</td><td id="fecha"><?php echo date('d/m/Y', $documento->fecha_subida);?></td>
            <td id="doc">
                <?php $archivo=pathinfo($documento->nombre_documento);
                echo HTML::anchor('upload/'.$documento->nombre_documento, '',array('class'=>strtolower($archivo['extension']),'target'=>'_blank'));?>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
    <tfoot>
        
    </tfoot>
</table>
<br/>
<br/>
<?php echo  html::image('media/images/documento.jpg',array('class'=>'documento','align'=>'right')); ?>