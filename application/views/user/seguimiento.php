<h2>Seguimiento a la hoja de ruta: <?php echo $documento->nuri; ?></h2>
<?php echo $documento->codigo;?>
<?php echo $documento->referencia;?>
<table id="theTable">
    <thead>
        <tr>
            <th>DERIVADO POR:</th>
            <th></th>
            <th>DERIVADO A:</th>
            <th>PROVEIDO</th>
            <th>ACCION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($seguimiento as $s): ?>
        
            <?php if($s->oficial==1){?>
            
            <td class="oficial">
                <b><?php echo $s->de_oficina; ?></b>
                <br/><?php echo $s->nombre_emisor; ?>
                <br/><b><?php echo $s->cargo_emisor; ?></b>
            </td>
            <td class="oficial">
                
                <span style="font-size: 30px;"><span class="ui-icon ui-icon-arrow-1-e" ></span> 
                </span>  
            </td>
            <td class="oficial">
                <b><?php echo $s->a_oficina; ?></b>
                <br/><?php echo $s->nombre_receptor; ?>
                <br/><b><?php echo $s->cargo_receptor; ?></b>
            </td>
            <td class="oficial">
                <span style="border-bottom: 1px solid;"><?php echo $s->accion; ?></span>
                <?php echo $s->proveido; ?>              
                
                <br/>
                <?php echo $s->estado; ?>
                
            </td>
            <td class="oficial">
                <b><?php echo $s->fecha_recepcion; ?></b>
                
            </td>
            <td class="oficial">
                <?php echo $s->nombres; ?>
            </td>
            <td class="oficial">
                <?php
                $adjuntos=json_decode($s->adjuntos);
                foreach($adjuntos as $a):?>
                <a href=""><?php echo $a;?></a>                
                <br/>
                <?php endforeach;?>
            </td>
            <td>
                
            </td>
         </tr>
         <tr>
             <td class="oficial" colspan="2">
                <span style="color: #333; font-style: italic; font-size: 10px;">
                <?php                
                $fecha=new myClass($s->fecha_emision);                
                echo $fecha->larga();
                echo ' ';
                echo $fecha->hora();
                 ?>
                </span>
             </td>
             <td class="oficial" colspan="2">
                 <span style="color: #333; font-style: italic; font-size: 10px;">
                <?php
                if($s->fecha_recepcion==''){
                    echo 'No Recibido';
                }
                else {
                $fecha=new myClass($s->fecha_recepcion);                
                echo $fecha->larga();
                echo ' ';
                echo $fecha->hora();
                }
                 ?>
                 </span>
             </td>
             <td>
                 
             </td>
         </tr>
            <?php } else { ?>
            
            <?php }?>
         <tr><td colspan="5"></td></tr>     
        <?php endforeach;?>
    </tbody>
</table>