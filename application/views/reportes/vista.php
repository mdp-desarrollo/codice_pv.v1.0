<script type="text/javascript">
    $(function(){
        $('table.classy tbody tr:odd').addClass('odd'); 
    });
</script>
<h2 class="subtitulo">Correspondencia Recibida<br/><span>Correspondencia recibida DE FECHA <b><?php echo date('d/m/Y',strtotime($fecha1));?></b> al  <b><?php echo date('d/m/Y',strtotime($fecha2));?></b> DE <b><?php echo $oficina;?></b></span></h2>
<table class="classy">
    <thead>
        <tr>
            <th>#</th>
            <th>NUR</th>
            <th>documento</th>
            <th>FECHA EMISION</th>
            <th>FECHA RECEPCION</th>
            <th>DERIVADO POR</th>            
            <th>PROVEIDO</th>
            
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($results as $r):?>
        <tr>
            <td><?php echo $i;?></td>
            <td><a href="/seguimiento/?nur=<?php echo $r['nur'];?>"><?php echo $r['nur'];?></a></td>
            <td><?php echo $r['codigo'];?></td>
            <td><?php echo $r['fecha_emision'];?></td>
            <td><?php echo $r['fecha_recepcion'];?></td>            
            <td><?php echo $r['nombre_emisor'];?></br><b><?php echo $r['cargo_emisor'];?></b></td>            
            <td><?php echo $r['proveido'];?></td>
        </tr>
        <?php $i++; endforeach;?>        
    </tbody>
</table>
