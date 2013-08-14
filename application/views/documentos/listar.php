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
 $("#theTable").tablesorter({sortList:[[0,1]], 
                widgets: ['zebra'],
                headers: {             
                    5: { sorter:false}
                }
            });
 //$('#theTable tbody tr:odd').addClass('odd');
 $('input').focus();    
});//document.ready
</script>
<style type="text/css">
    td{margin: 0; padding-top: -5px;padding-bottom: -5px;}
    input[type="text"]{ line-height: 20px; height: 20px; font-size: 14px;}
 </style>
<h2 class="subtitulo"><?php echo $tipo->plural;?><br/><span>Lista de <?php echo $tipo->plural;?> creados</span></h2>
<?php if(sizeof($results)>0){?>
<br/>
<p style="margin: 5px auto; font-size: 10px; font-weight: normal; "> FILTRAR: <input type="text" id="FilterTextBox" name="FilterTextBox" size="40" />
    <span style="float:right; padding-right: 5px;"><a href="/documento/crear/<?php echo $tipo->action;?>" class="uiButton">Crear <?php echo $tipo->tipo;?></a>
</span></p>
<table id="theTable" class="tablesorter">
    <thead>
        <tr>
            <th width="150">cite</th>            
            <th width="300">Referencia</th>
            <th width="285">Destinatario</th>                
            <th width="30">Hoja Ruta</th>
            <th width="50">Fecha</th>
            <th width="80">Accion</th>

        </tr>
    </thead>
    
    <tbody>
    <?php
    foreach ($results as $d): ?>
        <tr>
            <td class="codigo" align="center">
                <a href="/documento/editar/<?php echo $d->id;?>" ><?php echo substr($d->codigo,0,-13).'<br/>'.substr($d->codigo,-13);?></a>               
            </td>
            <td ><?php echo $d->referencia;?></td>
            <td ><b><?php echo $d->nombre_destinatario;?></b><br/><?php echo $d->cargo_destinatario;?></td>
            <td align="right" valign="center" >
                <a href="/hojaruta/derivar/?id_doc=<?php echo $d->id;?>"><?php echo $d->nur;?></a>            
            </td>
            <td align="right" valign="center" ><?php echo Date::fecha_corta($d->fecha_creacion); ?>
             </td> 
            <td style="text-align: right;" >
                <?php if($d->estado==1):?>                
                <a href="/seguimiento/?nur=<?php echo $d->nur;?>" title="Ver seguimiento" >Derivado</a>
                <?php else: ?>                
                <a href="/hojaruta/derivar/?id_doc=<?php echo $d->id;?>" title="Derivar" ><img src="/media/images/derivar.png"/></a>          
                <?php endif;?>
                <a href="/documento/editar/<?php echo $d->id;?>" title="Editar documento" ><img src="/media/images/edit.png"/></a>                                  
            </td>             
        </tr>        
    <?php endforeach; ?>
   </tbody>
   <tfoot>
       <tr>
           <td colspan="5"><?php echo $page_links; ?></td>
       </tr>
   </tfoot>
</table>


<?php } else { ?>
<div class="info">
<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
    <strong>Info! </strong> No tiene documentos.</p>
</div>
    <?php }?>
