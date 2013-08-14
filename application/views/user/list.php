<h2>Lista del Personal Dependiente de <?php echo $oficina->nombre;?></h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Cargo</th>
            <th>email</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
<?php $i=1; foreach ($usuarios as $usuario):?>
        <tr>
            <td><?php echo $i; $i++;?></td>
            <td><?php echo $usuario->nombre;?></td>
            <td><?php echo $usuario->cargo;?></td>
            <td><?php echo $usuario->email;?></td>
            <td><?php echo HTML::anchor('user/edit/'.$usuario->id,'Edit');?></td>
        </tr>
 <?php endforeach;?>
    </tbody>
</table>