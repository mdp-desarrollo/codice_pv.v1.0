<script type="text/javascript">
    $(function(){
        $('table.classy tbody tr:odd').addClass('odd'); 
        $("#imprime").click(function(){
            window.print();
            return false;
        });
    });
</script>
<h2 class="subtitulo">Correspondencia Enviada<br/><span>Correspondencia enviada DE FECHA <b><?php echo date('d/m/Y',strtotime($fecha1));?></b> al  <b><?php echo date('d/m/Y',strtotime($fecha2));?></b> A <b><?php echo $oficina;?></b></span></h2>
<p style="float: right;"><a href="/enviados_excel.php?id_oficina=<?php echo $id_oficina;?>&fecha1=<?php echo $fecha1;?>&fecha2=<?php echo $fecha2;?>&id_user=<?php echo $id_user;?>" class="uibutton"><img src="/media/images/excel.png" align="absmiddle" alt=""/>Excel</a><a href="javascript:void(0)" id="imprime" class="uibutton"><img src="/media/images/excel.png" align="absmiddle" alt=""/>Imprimir</a></p><br/>
<table class="classy">
    <thead>
        <tr>
            <th>#</th>
            <th>NUR</th>
            <th>DOCUMENTO</th>
            <th>FECHA EMISION</th>
            <th>FECHA RECEPCION</th>
            <th>DERIVADO A</th> 
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
            <td><?php echo $r['nombre_receptor'];?></br><b><?php echo $r['cargo_receptor'];?></b></td>            
            <td><?php echo $r['proveido'];?></td>
        </tr>
        <?php $i++; endforeach;?>
        
    </tbody>
</table>
