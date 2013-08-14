<h2>Recepci&oacute;n: <br/><span>Lista de Hojas de ruta para recepcionar</span></h2>
<hr class="azul"/>
<?php if(sizeof($norecibidos)){?>
<div id="titulares2">
<table id="docs" >
<tr>
    <td class="oficial2">    
        <div class="divoficial" ></div>Oficial
    </td>
    <td class="copia2">    
        <div class="divcopia" ></div>Copia
    </td>
    <td class="copia2">    
        <div class="divexterno" ></div>Externo
    </td>
</tr>
    </table>
    </div>

<table id="theTable">
    <thead>
        <tr>
            <th>NUR/NURI</th>
            <th>REMITE</th>
            <th>ACCION</th>            
            <th>FECHA DE ENVIO</th>
            <th>DOCUMENTO/ADJUNTOS</th>
            <th></th>
        </tr>
    </thead>
    <tbody><?php foreach($norecibidos as $s): ?>
            <?php if($s->oficial==1){?>
            <td class="oficial2" rowspan="2" style="border-bottom: 1px solid;">
                <h2 class="oficial"><?php echo $s->nuri;?></h2>
            </td>
            <td class="oficial2" >
                <b class="oficina"><?php echo $s->de_oficina; ?></b>
                <br/>
                <?php echo $s->nombre_emisor; ?>
                <br/>
                <b><?php echo $s->cargo_emisor; ?></b>
            </td>
            <td class="oficial2" ><?php echo $s->accion;?></td>
            <td class="oficial2" ><?php $fecha = new myClass($s->fecha);
            echo $fecha->larga();?></td>
            <td class="oficial2">                
            <?php echo $s->codigo;?>
                <br/>
                <?php
                $adjuntos=json_decode($s->adjuntos);
                foreach($adjuntos as $a):?>
                <a href=""><?php echo $a;?></a>                
                <br/>
                <?php endforeach;?>
                <?php echo substr($s->archivos,13);?>
            <td class="oficial2" >
                <?php echo HTML::anchor('hojaruta/recibir/'.$s->id,HTML::image('media/images/inbox.png'),array('title'=>'Recibir'));?>   
            </td>
         </tr>
         <tr>          
             
             <td class="oficial2" colspan="5" style="border-bottom: 1px solid; font-style: italic;">
                 <?php echo $s->proveido;?>
             </td>
         </tr>
            <?php } else { ?>
            <td class="copia2" rowspan="2" style="border-bottom: 1px solid;">
                <h2 class="copia"><?php echo $s->nuri;?></h2>
            </td>
            <td class="copia2" >
                <b class="oficina"><?php echo $s->de_oficina; ?></b>
                <br/>
                <?php echo $s->nombre_emisor; ?>
                <br/>
                <b><?php echo $s->cargo_emisor; ?></b>
            </td>
            <td class="copia2" ><?php echo $s->accion;?></td>
            <td class="copia2" ><?php $fecha = new myClass($s->fecha);
            echo $fecha->larga();?></td>
            <td class="copia2">                
            <?php echo $s->codigo;?>
                <br/>
                <?php
                $adjuntos=json_decode($s->adjuntos);
                foreach($adjuntos as $a):?>
                <a href=""><?php echo $a;?></a>                
                <br/>
                <?php endforeach;?>
                <?php echo substr($s->archivos,13);?>
            <td class="copia2">                
                <?php echo HTML::anchor('hojaruta/recibir/'.$s->id,HTML::image('media/images/inbox.png'),array('title'=>'Recibir : '.$s->nuri));?>   
            </td>
         </tr>
         <tr>          
             
             <td class="copia2" colspan="5" style="border-bottom: 1px solid; font-style: italic;">
                 <?php echo $s->proveido;?>
             </td>
         </tr>
            <?php }?>
            
        <?php endforeach;?>
    </tbody>
</table>
<?php } 
else{ ?>
<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
    <strong>Bandeja Vacia!</strong> Usted no tiene hojas de ruta para recepcionar.</p>
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