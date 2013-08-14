<table>
    <thead>
        <tr>
            <th>Id</th><th>Producto</th><th>Descripcion</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach ($producto as $p):
?>
<tr>
    <td><?php echo $p->id;?></td>
    <td><?php echo $p->producto;?></td>
    <td><?php echo $p->descripcion;?></td>
</tr>
<?php endforeach;?>
</tbody>
</table
