<script type="text/javascript">
    $(function()
    {
        $("#theTable").tablesorter({sortList:[[3,1]], 
            widgets: ['zebra'],
            headers: {             
                5: { sorter:false},
                6: { sorter:false}
            }
        });
        
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
        
        $("#FilterTextBox").focus();
        
        
    });//document.ready
</script>


<h2 class="subtitulo">Seguimiento<br/> <span>Lista de hojas de ruta enviadas recientemente</span></h2>
<?php if(sizeof($results)>0):?> 
<p style="margin: 5px auto;"> <b>Filtrar/Buscar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="40" /></p>
<table id="theTable" class="tablesorter">
    <thead>
        <tr>
            <th>HOJA RUTA</th>
            <th>DESTINATARIO</th>            
            <th>PROVEIDO</th>            
            <th>ENVIADO</th>            
            <th>ESTADO</th>                       
            <th class="noprint" width="20">Opción</th>                       
        </tr>
    </thead>
    <tbody>
        <?php foreach($results as $n):?>
        <tr>
            <td><b><a href="/seguimiento/?nur=<?php echo $n->nur;?>" title="Ver seguimiento de la hoja de ruta" ><?php echo $n->nur;?></a></b></td>                              
            <td><?php echo $n->nombre_receptor;?><br/>
            <b><?php echo $n->cargo_receptor;?></b></td>
            <td><?php echo $n->proveido;?></td>            
            <td><?php
            $fecha=strtotime($n->fecha_emision);
            echo date('d/m/Y',$fecha);?></td>            
            <td align="center" width="50" class="noprint">
                <?php switch ($n->estado) {
                    case 1:
                           echo 'No Recibido'; 
                    break;
                    case 2:
                           echo 'Pendiente'; 
                    break;
                    case 4:
                           echo 'Derivado'; 
                    break;                        
                    case 10:
                           echo 'Archivado'; 
                    break;                        
                    default:
                        echo 'Agrupado';
                    break;
                }
                ?>                
            </td>
            <td>
                <a href="/seguimiento/?nur=<?php echo $n->nur?>" class="uibutton"><img src="/media/images/flag.png" alt="Ver seguimiento" align="absmiddle"/> Ver</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php else: ?>
<div style="margin-top: 20px; padding: 10px;" class="info">
    <p><span style="float: left; margin-right: .3em;" class=""></span>    
     <strong>Info: </strong> <?php echo 'Usted no tiene hojas de ruta enviadas recientemente';?></p>    
</div>
<?php endif; ?>