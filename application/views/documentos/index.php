<script type="text/javascript">
    $(function(){
         $("#theTable").tablesorter({sortList:[[4,1]], 
                widgets: ['zebra'],
                headers: {             
                    6: { sorter:false}
                }
            });
    });
</script>
<h2 class="subtitulo">Documentos<br/><span>Documentos creados por mi usuario</span></h2>
<?php if(sizeof($recientes)>0){?>
<?php foreach ($documentos as $d):?>
    <div class="doc<?php echo $d['id_tipo'];?>">     
        <div class="docs doc">     
        <span style="color:#4989D7; font-size:20px;"></span>
        <a href="/documento/tipo/<?php echo $d['id_tipo'];?>"><?php echo $tipos[$d['id_tipo']].': '.$d['n'];?></a>        
        </div>
    </div>
<?php endforeach;?>
<div style="clear:both;"></div>   
<h2 class="subtitulo">Creados Recientemente<br/><span> Los ultimos 10 documentos creados:</span></h2>
<table id="theTable" class="tablesorter">
    <thead>
        <tr>
            <th>CITE</th>            
            <th>Tipo</th>
            <th>Referencia</th>    
            <th>Destinatario</th>            
            <th width="60" >Fecha</th>            
            <th width="80">HOJA RUTA</th>
            <th width="70" >Acción</th>
        </tr>
    </thead>    
    <tbody>
    <?php    
    foreach ($recientes as $d): ?>
        <tr>
            <td width="130" >
                <a href="/documento/editar/<?php echo $d['id'];?>"><?php echo substr($d['codigo'],0,-13);?><br/><?php echo substr($d['codigo'],-13);?></a>                
            </td>
            
            <td ><b><?php echo $d['tipo'];?></b></td>
            <td ><?php echo $d['referencia'];?></td>
            <td width="225" ><b><?php echo $d['nombre_destinatario'];?></b><br/><?php echo $d['cargo_destinatario'];?></td>
            <td><?php echo Date::fecha_corta($d['fecha_creacion']); ?>
                
                <?php //echo date('g:i:s A',$fecha);?>
                </td> 
            <td style="text-align: right;" >
                <a href="/hojaruta/derivar/?id_doc=<?php echo $d['id'];?>"><?php echo $d['nur'];?></a>
            </td>
            <td style="text-align: right;" >
                <?php if($d['estado']==1):?>                
                <a href="/seguimiento/?nur=<?php echo $d['nur'];?>" title="Ver seguimiento" >Derivado</a>
                <?php else: ?>                
                <a href="/hojaruta/derivar/?id_doc=<?php echo $d['id'];?>" title="Derivar" ><img src="/media/images/derivar.png"/></a>                            
                <?php endif;?>                
                <a href="/documento/editar/<?php echo $d['id'];?>" title="Editar documento" ><img src="/media/images/edit.png"/></a>                
            </td>  
        </tr>        
    <?php endforeach; ?>
   </tbody>   
</table>
<?php } else {?>
<div class="info"> 
<p><span style="float: left; margin-right: .3em;" class="info"></span>
    <strong>0 Documentos !</strong> Usted no Tiene documentos Generados.</p>
</div>
<?php } ?>

