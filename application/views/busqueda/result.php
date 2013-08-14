<script type="text/javascript">
$(function(){

});//document.ready
</script>
<style type="text/css">
    td{margin: 0; padding-top: -5px;padding-bottom: -5px;}
    input[type="text"]{ line-height: 20px; height: 20px; font-size: 14px;}
 /*   tbody tr:hover{background: #FBFDFF;}*/
</style>
<h2 class="subtitulo">Resultados<br/><span><b><?php echo $count;?></b> resultados encontrados para <b>'<?php echo $name;?>'</b></span></h2>
<?php if($count>0){?>
<br/>
<p style="color: #00498f;"><i>Para ver el seguimiento, haga click en el boton ver o el la hoja de ruta.</i></p><br/>
<table id="theTable">
    <thead>
        <tr>
            <th width="150">Nur</th>            
            <th width="160">Documento</th>            
            <th width="120">Tipo Doc</th>            
            <th width="285">Destinatario</th>
            <th width="285">Remitente</th>
            <th width="300">Referencia</th>    
            <th width="100">Fecha</th>    
            <th>Accion</th>    
        </tr>
    </thead>
    
    <tbody>
    <?php
    $mes=0;
    $dia=0;
    $meses=array(1=>'Ene',2=>'Feb',3=>'Mar',4=>'Abr',5=>'May',6=>'Jun',7=>'Jul',8=>'Ago',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dic');
    //    $meses=array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');
    // $dias=array(1=>'Lunes',2=>'Martes',3=>'Miercoles',4=>'Jueves',5=>'Viernes',6=>'Sabado',7=>'Domingo');
    foreach ($results as $d): ?>
        <tr>
            <td class="codigo" align="center">
                <a href="/seguimiento/?nur=<?php echo $d['nur'];?>"><?php echo $d['nur'];?></a> 
            </td>
            <td class="codigo" align="center">
                <a href="/documento/detalle/<?php echo $d['id'];?>" ><?php echo $d['cite_original'];?></a>               
            </td>
            <td align="center">
                <b><?php echo $d['tipo'];?></b>
            </td>
            <td ><b><?php echo $d['nombre_destinatario'];?></b><br/><?php echo $d['cargo_destinatario'];?></td>
            <td ><b><?php echo $d['nombre_remitente'];?></b><br/><?php echo $d['cargo_remitente'];?></td>
            <td ><?php echo $d['referencia'];?></td>           
            <td ><?php echo Date::fecha_corta($d['fecha_creacion']);?></td>           
            <td ><a href="/seguimiento/?nur=<?php echo $d['nur'];?>" title="Ver seguimiento" class="uibutton" ><img src="/media/images/seg.png" alt="" align="absmiddle"/>Ver</a></td>           
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
    <strong>Lo siento! </strong> Ningun proceso/tramite encontrado. Pruebe con <a href="/busqueda/buscar" title="Ir a" style="text-decoration: underline;" >busqueda avanzada</a></p>
</div>
<?php }?>
