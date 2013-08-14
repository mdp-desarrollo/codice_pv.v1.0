<script type="text/javascript">
    $(function(){
        $('#theTable tbody tr:odd').addClass('odd'); 
        $("#imprime").click(function(){
            window.print();
            return false;
        });
    });
</script>
<h2 class="subtitulo">Reporte Ventanilla: <br/><span>documentos recepcionados de fecha: <b><?php echo date('d/m/Y',strtotime($fecha1));?></b> al  <b><?php echo date('d/m/Y',strtotime($fecha2));?></b></span></h2>
<p style="float: right;"><a href="javascript:void(0)" id="imprime" class="uibutton"><img src="/media/images/excel.png" align="absmiddle" alt=""/>Imprimir</a></p><br/></p><br/>
<br/>
<table id="theTable">
    <thead>
        <tr>
            <th>#</th>
            <th>NUR</th>
            <th>CITE ORIGINAL</th>
            <th>Destinatario</th>
            <th>Remitente</th>
            <th>Referencia</th>
            <th>Adjunto</th>            
            <th>hojas</th>            
            <th>Derivado</th>            
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($results as $r):?>
        <tr>
            <td><?php echo $i;?></td>
            <td><b><?php echo $r['nur'];?></b></td>
            <td><?php echo $r['cite_original'];?></td>
            <td><?php echo $r['nombre_destinatario'];?><br/>
                <b><?php echo $r['cargo_destinatario'];?></b>
            </td>            
            <td><?php echo $r['nombre_remitente'];?><br/>
                <b><?php echo $r['cargo_remitente'];?></b>
            </td>
            <td><?php echo $r['referencia'];?></td>            
            <td><?php echo $r['adjuntos'];?></td>            
            <td><?php echo $r['hojas'];?></td>            
            <td><?php echo (1 == $r['estado']) ? 'Si' : 'No';?></td>            
        </tr>
        <?php $i++; endforeach;?>
        
    </tbody>
</table>