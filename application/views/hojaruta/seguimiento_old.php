<script>
    $(function(){
        $('a.documento').click(function(){
        var codigo=$(this).attr('alt')
        var left=screen.availWidth;
	var top=screen.availHeight;
	left=(left-600)/2;
	top=(top-500)/2;	
	var r=window.showModalDialog(""+codigo,"","center:0;dialogWidth:700px;dialogHeight:500px;scroll=yes;resizable=yes;status=yes;"+"dialogLeft:"+left+"px;dialogTop:"+top+"px");
	if(r[0]!=null){	
	}
        });
      if($('#hijo').val()>0)
       {
           $('#agrupado').show();
       }
    });
</script>
<?php if(sizeof($seguimiento)>0){?>
<h2 class="subtitulo">Seguimiento a la Hoja de Ruta:  <b><?php echo $detalle['nur'];?></b><br/><span>DESCRIPCION DEL PROCESO </span></h2>

<div id="titulares2" >
<table style="width: 100%;">
<tr>
    <td><span style="color:#414141;">Referencia: </span></td>       
    <td colspan="3"><a style="color: rgb(54, 111, 176); line-height: 22px;font-size:16px; " href="/documento/detalle/<?php echo $detalle['id_documento']?>"><?php echo $detalle['referencia']; ?></a>        </td>        
</tr>

<tr>           
    <td><span style="color:#414141;">Documento: </span></td>       
    <td><h2><a href="/documento/detalle/<?php echo $detalle['id_documento'];?>" ><?php echo $detalle['codigo']; ?></a></h2></td>        
    <td><span style="color:#414141;">Proceso: </span></td>       
    <td><h2><?php echo $detalle['proceso']; ?></h2></td>        
</tr>
<tr>
    <td><span style="color:#414141;">Destinatario: </span></td>       
    <td><h2><?php echo $detalle['destinatario']; ?> | <?php echo $detalle['cargo_destinatario']; ?></h2></td>        
    <td><span style="color:#414141;">Tipo documento: </span></td>       
    <td><h2><?php echo $detalle['tipo']; ?></h2></td>
</tr>
<tr>
    <td><span style="color:#414141;">Remitente: </span></td>       
    <td><h2><?php echo $detalle['remitente']; ?> | <?php echo $detalle['cargo_remitente']; ?></h2></td>        
    <td><span style="color:#414141;">Fecha Asignación: </span></td>       
    <td><?php echo Date::fecha($detalle['fecha']).' '.date('H:i:s',strtotime($detalle['fecha']));; ?></td>    
</tr>
<tr>
    <td><span style="color:#414141;">Adjunto: </span></td>       
    <td colspan="3">
    <?php foreach($archivo as $a):?>
    <?php echo substr($a->nombre_archivo,13); ?><br/> 
    <?php endforeach; ?>
    </td>        
</tr>
 </table>
</div>
<!--  Seguimiento -->

<h2 style="width:100%; text-align: center; margin-top: 20px;">Tabla de Seguimiento</h2>

<div id="agrupado" style="display:none; text-align: center;" >
    <p><img src="/media/images/agrupado.png" alt="" /><h2>AGRUPADO</h2></p>
</div>
<?php if(isset($agrupado->id)):?>
<div id="padre" style="text-align: center;" >
    <p><img src="/media/images/agrupado.png" alt="" /><h2>Una copia pertence a la Hoja de Seguimiento principal <br/><a href="/seguimiento/?nur=<?php echo $agrupado->padre;?>" style="color: #275592; font-weight: bold;  "><?php echo $agrupado->padre;?></a></h2></p>
</div>
<?php endif;?>
<table id="theTable">
    <thead>
        <tr>
            <th>DERIVADO POR</th>
            <th>DERIVADO A</th>           
            <th>ACCION</th>            
            <th>ESTADO</th>
            <th>DOCUMENTO/ADJUNTOS</th>
        </tr>
    </thead>
    <tbody>
    <?php $hijo=0; foreach($seguimiento as $s): ?>
        <tr class="oficial<?php echo $s->oficial;?>">
            <td rowspan="2" id="<?php if($s->oficial==1)
            {
              if($s->id_estado==1) echo 'estrella';
              else echo 'pasos';
            }
            ?>"
            class="oficial<?php echo $s->oficial;?> estado<?php echo $s->estado;?>"  >
            <b><?php echo $s->de_oficina;?></b><br/>            
            <?php echo $s->cargo_emisor;?><br/>
            <b><?php echo $s->nombre_emisor;?></b> <br/>
            <h><?php echo Date::fecha_corta($s->fecha_emision)
                   .' '.date('H:i',strtotime($s->fecha_emision));  ?></h>
            </td>            
            <td rowspan="2" id="<?php 
            if(($s->oficial==1)&&($s->id_estado==2))
            { 
                 echo 'estrella';               
            }?>"
            class="oficial<?php echo $s->oficial;?>"  >

            <b><?php echo $s->a_oficina;?></b><br/>            
            <?php echo $s->cargo_receptor;?><br/>
            <b><?php echo $s->nombre_receptor;?></b>
            <br/><h><?php if($s->fecha_recepcion!=''){
                        echo Date::fecha_corta($s->fecha_recepcion).' '.date('H:i',strtotime($s->fecha_recepcion));
                }
                ?></h>
            </td>
            <td >
             <?php echo $s->accion;?>    
            </td>
            <td >
             <b><?php echo $s->estado;?></b>   
            </td>
            <td>
                <?php foreach(json_decode($s->adjuntos) as $k=>$a):?>
                    <a href="/vista/?doc=<?php echo $a;?>&id_seg=<?php echo $s->id;?>" target="_blank" ><?php echo $a;?></a><br/>                   
                <br/>
                <?php  endforeach; ?>
                <?php                    
                $documentos=ORM::factory('documentos')->where('id_seguimiento','=',$s->id)->find_all();
                foreach($documentos as $d): ?>
                <a  href="/vista/?doc=<?php echo $d->cite_original;?>" target="_blank" ><?php echo $d->codigo;?></a><br/>
                <?php endforeach;               
                ?>
            </td>
        </tr>
        <tr class="oficial<?php echo $s->oficial;?>">
            <td colspan="3"  >
                <pro><?php echo $s->proveido;?></pro>
            </td>
        </tr>
     <?php $hijo+=$s->hijo; endforeach;?>
    </tbody>
</table>
<hr/>
<div style="text-align:center;">
    <?php if($hijo>0):?>
    <input type="hidden" id="hijo" value="1" name="hijo"/>
    <h2>Agrupado con:</h2>
    <?php
    $hijos=ORM::factory('agrupaciones')->where('padre','=',$detalle['nur'])->find_all();
    foreach($hijos as $h):?>
        <a href="/seguimiento/?nur=<?php echo $h->hijo;?>" style="color:#1C4781; font-size: 14px; text-decoration: underline;  " ><?php echo $h->hijo;?></a>
    <?php endforeach; ?>
    <?php else:?>
    <input type="hidden" id="hijo" value="0" name="hijo"/>
<?php endif;?>
</div>
<hr/>
<div class="info" style="text-align:center;">
    <p><span style="float: left; margin-right: .3em;" class=""></span>    
      &larr;<a onclick="javascript:history.back(); return false;" href="#" style="font-weight: bold; text-decoration: underline;  " > Regresar<a/></p>    
</div>
<?php } 
else{ ?>
<h2 class="subtitulo">Seguimiento a la Hoja de Ruta:  <?php echo $_GET['nur'];?><br/><span>DOCUMENTO ORIGINAL</span></h2>
<!-- mostrar mensajes -->
<div class="info">
    <p><span style="float: left; margin-right: .3em;" class=""></span>    
        <strong>Mensaje: </strong> Hoja de ruta aun no derivada. &larr;<a onclick="javascript:history.back(); return false;" href="#" style="font-weight: bold; text-decoration: underline;  " > Regresar</a></p>    
</div>
<br/>
<?php }?>
<?php 
?>