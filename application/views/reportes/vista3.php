<script type="text/javascript">
    $(function(){
        $('table.classy tbody tr:odd').addClass('odd'); 
        $("#imprime").click(function(){
            window.print();
            return false;
        });
    });
</script>
<h2 class="subtitulo">Correspondencia <?php echo $estado->plural;?> : <b><?php echo $oficina;?></b><br/><span>DE FECHA <b><?php echo date('d/m/Y',strtotime($fecha1));?></b> al  <b><?php echo date('d/m/Y',strtotime($fecha2));?></b>  </span></h2>
<p style="float: right;"><a href="javascript:void(0)" id="imprime" class="uibutton"><img src="/media/images/excel.png" align="absmiddle" alt=""/>Imprimir</a></p><br/></p><br/>
<table class="classy">
    <thead>
        <tr>
            <th>#</th>
            <th>HOJA RUTA</th>
            <th>documento</th>
            <th>DERIVADO POR</th> 
            <th>DERIVADO A</th> 
            <th>PROVEIDO</th>
            <th>FECHA EMISION</th>
            <th>FECHA RECEPCION</th>            
            
                       
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($results as $r):?>
        <tr>
            <td><?php echo $i;?></td>
            <td><a href="/seguimiento/?nur=<?php echo $r['nur'];?>"><?php echo $r['nur'];?></a></td>
            <td><?php echo $r['cite_original'];?></td>            
            <td><?php echo $r['nombre_emisor'];?></br><b><?php echo $r['cargo_emisor'];?></b></td>            
            <td><?php echo $r['nombre_receptor'];?></br><b><?php echo $r['cargo_receptor'];?></b></td>            
            <td><?php echo $r['proveido'];?></td>
            <td><?php echo $r['fecha_emision'];?></td>
            <td><?php echo $r['fecha_recepcion'];?></td>            
        </tr>
        <?php $i++; endforeach;?>
        
    </tbody>
</table>
