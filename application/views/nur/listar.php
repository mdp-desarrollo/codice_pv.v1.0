<h2>Hojas de Ruta: <br/><span>Hojas de Ruta generados:</span></h2>
<table id="theTable">
    <thead>
        <tr>
            <th>NUR(i)</th>
            <th>Proceso</th>
            <th>Referencia</th>
            <th>Proceso</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($result as $n):?>
        <tr>
            <td><?php echo HTML::anchor('seguimiento/hs/'. $n['id'],$n['nuri']);?></td>
            <td><?php echo $n['proceso'];?></td>
            <td><?php echo $n['referencia'];?></td>
            <td><?php echo $n['codigo'];?></td>
            <td><?php echo $n['codigo'];?></td>
            <td><?php echo $n['codigo'];?></td>
            <td><?php echo $n['codigo'];?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php echo $page_links; ?>
