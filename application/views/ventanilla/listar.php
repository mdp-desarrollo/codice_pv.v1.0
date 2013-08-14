<script type="text/javascript">
$(function(){
 //add index column with all content.
 $("table#theTable tbody tr:has(td)").each(function(){
   var t = $(this).text().toLowerCase(); //all row text
   $("<td class='indexColumn'></td>")
    .hide().text(t).appendTo(this);
 });//each tr
 $("#FilterTextBox").keyup(function(){
   var s = $(this).val().toLowerCase().split(" ");
   //show all rows.
   $("#theTable tbody tr:hidden").show();
   $.each(s, function(){
       $("#theTable tbody tr:visible .indexColumn:not(:contains('"
          + this + "'))").parent().hide();
   });//each
 });//key up.
 //zebra
 //$('#theTable tbody tr:odd').addClass('odd');
 $("#FilterTextBox").focus();
});//document.ready
</script>
<h2 class="subtitulo">Documentaci&oacute;n externa:<br/> <span>Lista de documentos recepcionados</span></h2>
<?php if(sizeof($documentos)>0):?> 
<p style="margin: 5px auto;"> 
    <b>Filtrar/Buscar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="40" />
</p>
<table id="theTable">
    <thead>
        <tr>
            <th>hoja ruta</th>
            <th>Proceso</th>
            <th>Cite original</th>
            <th>Documento Original</th>
            <th>Referencia</th>
            <th>Destinatario</th>
            <th>Fecha</th>
            <th>Adjunto</th>
            <th>Hojas</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($documentos as $n):?>
        <tr>
            <td><?php echo HTML::anchor('hojaruta/derivar/?id='. $n['id_nur'],$n['nur']);?></td>
            <td><?php echo $n['proceso'];?></td>
            <td><b><?php echo $n['citeOriginal'];?></b></td>
            <td><b><?php echo $n['codigo'];?></b></td>            
            <td><?php echo $n['referencia'];?></td>
            <td><?php echo $n['nombreDestinatario'];?></td>  
            <td><?php echo date('d/m/Y H:i:s',strtotime($n['fecha']));?></td> 
            <td><?php echo $n['adjuntos']?></td> 
            <td><?php echo $n['nroHojas']?></td> 
            <td align="center" width="50" >
                <?php if($n['estado']):?>
                <a href="/seguimiento/id/<?php echo $n['id_nur'];?>" title="Seguimeinto <?php echo $n['nur'] ?>" >Derivado</a>
                <?php else: ?>
                <a href="/hojaruta/derivar/<?php echo $n['id_nur'];?>" title="Derivar <?php echo $n['nur'] ?>" ><img src="/media/images/derivar.png"/></a>
                <?php endif;?>                
            </td>        
            <td>
                <a href="/print_hr.php?id=<?php echo $n['id_nur'];?>" title="Imprimir <?php echo $n['nur'] ?>" ><img src="/media/images/printer.png"/> </a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php echo $page_links; ?>
<?php else: ?>
<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all">
    <p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span>    
     <strong>Info: </strong> <?php echo 'Usted no tiene hojas de ruta creadas';?></p>    
</div>
<?php endif; ?>

