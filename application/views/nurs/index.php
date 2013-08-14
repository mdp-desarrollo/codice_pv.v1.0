<script type="text/javascript">
$(function()
{
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
                    9: { sorter:false}
                }
            });
 $("#FilterTextBox").focus(); 
});//document.ready
</script>
<h2 class="subtitulo">Hojas de ruta<br/> <span>Lista de Hojas de Ruta creados por mi usuario</span></h2>
<?php if($count>0):?> 

<p style="margin: 5px auto;"> <b>Filtrar/Buscar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="40" /></p>

<table id="theTable" class="tablesorter">
    <thead>
        <tr>
            <th>NUR</th>
            <th>CITE ORIGINAL</th>            
            <th>Destinatario</th>
            <th>Remitente</th>
            <th>Referencia</th>            
            <th>Adjunto</th>            
            <th># Hojas</th>            
            <th>Fecha</th>
            <th>Estado</th>
            <th></th>            
        </tr>
    </thead>
    <tbody>
        <?php foreach($results as $n):?>
        <tr>
            <td><b><?php echo $n->nur;;?></b></td>
            <td><?php echo $n->cite_original;?></td>                                                
            <td><?php echo $n->nombre_destinatario;?><br/><b><?php echo $n->cargo_destinatario;?></b></td>
            <td><?php echo $n->nombre_remitente;?><br/><b><?php echo $n->cargo_remitente;?></b></td>
            <td><?php echo $n->referencia;?></td>                       
            <td><?php echo $n->adjuntos;?></td>                       
            <td><?php echo $n->hojas;?></td>                       
            <td><?php echo $n->fecha_creacion;?></td>                       
            <td align="center" width="50" >
                <?php if($n->estado):?>
                <a href="/seguimiento/?nur=<?php echo $n->nur;?>" title="Ver seguimiento del NUR <?php echo $n->nur; ?>" >Derivado</a>                
                <?php else: ?>
                <a href="/hojaruta/derivar/?id_doc=<?php echo $n->id;?>" title="Derivar <?php echo $n->nur; ?>" ><img src="/media/images/deriv.png"/></a>                
                <?php endif;?>                
            </td>        
            <td>
                <a href="/print_hr.php?nur=<?php echo $n->nur;?>" title="Imprimir <?php echo $n->nur; ?>" ><img src="/media/images/printer.png"/> </a>
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