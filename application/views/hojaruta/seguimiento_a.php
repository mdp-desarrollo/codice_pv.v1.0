
<?php if(sizeof($seguimiento)>0){?>
<h2 class="subtitulo">Seguimiento a la Hoja de Ruta:  <?php echo $detalle['nur'];?><br/><span>DOCUMENTO ORIGINAL</span></h2>

<div id="titulares2" >
<table style="width: 100%;">
<tr>
    <td><b>Fecha Asignación: </b></td>       
    <td><?php $fecha=new controller_myClass($detalle['fecha']); echo $fecha->larga(). ' '.$fecha->hora_corta(); ?></td>
    <td><b>Tipo documento: </b></td>       
    <td><?php echo $detalle['tipo']; ?></td>
</tr>
<tr>           
    <td><b>Documento: </b></td>       
    <td><?php echo $detalle['codigo']; ?></td>        
    <td><b>Proceso: </b></td>       
    <td><?php echo $detalle['proceso']; ?></td>        
</tr>
<tr>
    <td><b>Destinatario: </b></td>       
    <td><?php echo $detalle['destinatario']; ?><br/><b><?php echo $detalle['cargo_destinatario']; ?></b></td>        
    <td><b>Remitente: </b></td>       
    <td><?php echo $detalle['remitente']; ?><br/><b><?php echo $detalle['cargo_remitente']; ?></b></td>        
</tr>
<tr>
    <td><b>Referencia: </b></td>       
    <td colspan="3"><?php echo $detalle['referencia']; ?></td>        
</tr>
<tr>
    <td><b>Adjunto: </b></td>       
    <td colspan="3"><?php echo $archivo->nombre_archivo; ?></td>        
</tr>
 </table>
</div>
<!--  Seguimiento -->
<h2 class="subtitulo" style="width:100%; text-align: center;"><span>tabla de Seguimiento</span></h2>
<table id="theTable">
    <thead>
        <tr>
            <th>DERIVADO POR</th>
            <th>DERIVADO A</th>
            <th>FECHA DE ENVIO</th>            
            <th>RECEPCION</th>            
            <th>ACCION</th>            
            <th>ESTADO</th>
            <th>DOCUMENTO/ADJUNTOS</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($seguimiento as $s): ?>
        <tr class="oficial<?php echo $s->oficial;?>">
            <td rowspan="2" id="<?php if($s->oficial==1)
            {
              if($s->fecha_recepcion=='') echo 'estrella';
              else echo 'pasos';
            }
            ?>"
            class="oficial<?php echo $s->oficial;?> estado<?php echo $s->estado;?>" style="border-top: 2px solid #fff; ;" >
            <b><?php echo $s->de_oficina;?></b><br/>            
            <?php echo $s->cargo_emisor;?><br/>
            <b><?php echo $s->nombre_emisor;?></b>            
            </td>            
            <td rowspan="2" id="estado<?php 
            if($s->oficial==1)
            {
            echo $s->id;
            }?>"
            class="oficial<?php echo $s->oficial;?>" style="border-top: 2px solid #fff; ;" >

            <b><?php echo $s->a_oficina;?></b><br/>            
            <?php echo $s->cargo_receptor;?><br/>
            <b><?php echo $s->nombre_receptor;?></b>
            
            </td>
            <td style="border-top: 2px solid #fff; ;">
                <?php $fecha= New controller_myClass($s->fecha_emision);
                      echo $fecha->corta().' '.$fecha->hora_corta();?>
            </td>
            <td style="border-top: 2px solid #fff; ;">
                <?php if($s->fecha_recepcion!=''){
                        $fecha= New controller_myClass($s->fecha_recepcion);
                      echo $fecha->corta().' '.$fecha->hora_corta();
                }
                ?>
            </td>
            <td style="border-top: 2px solid #fff; ;">
            <?php echo $s->accion;?>                       
            </td>
            <td style="border-top: 2px solid #fff; ;">
            <?php echo $s->estado;?>                       
            </td>
            <td style="border-top: 2px solid #fff; ;">
                <?php foreach(json_decode($s->adjuntos) as $a):
                    echo HTML::anchor('documentos/vista/?doc='.$a,$a);
                    echo '<br/>';
                   endforeach;
                ?>
            </td>
        </tr>
        <tr class="oficial<?php echo $s->oficial;?>">
            <td colspan="5"  >
                <i><?php echo $s->proveido;?></i>
            </td>
        </tr>
     <?php endforeach;?>
    </tbody>
</table>
<?php } 
else{ ?>
<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
    <strong>Error!</strong> Hoja de ruta no derivada aun.</p>
</div>
<?php }?>
<?php /*
File: C:\Users\Softpedia\Downloads\X3_NetTuts.PHP\PHP\TMA-Delphina.2011-02-16.wmv

Filter 0: Video Renderer
Filename: C:\Windows\SysWOW64\quartz.dll
Filter CRC: 2239FB6E
Date: 2009-12-19 | 05:02:48
Filter 1: Default DirectSound Device
Filename: C:\Windows\SysWOW64\quartz.dll
Filter CRC: 2239FB6E
Date: 2009-12-19 | 05:02:48
Filter 2: WMVideo Decoder DMO
Filename: C:\Windows\SysWOW64\qasf.dll
Filter CRC: F46CB91D
Date: 2009-07-13 | 21:16:12
Filter 3: WMAudio Decoder DMO
Filename: C:\Windows\SysWOW64\qasf.dll
Filter CRC: F46CB91D
Date: 2009-07-13 | 21:16:12
Filter 4: C:\Users\Softpedia\Downloads\X3_NetTuts.PHP\PHP\TMA-Delphina.2011-02-16.wmv
Filename: C:\Windows\SysWOW64\qasf.dll
Filter CRC: F46CB91D
Date: 2009-07-13 | 21:16:12*/
?>