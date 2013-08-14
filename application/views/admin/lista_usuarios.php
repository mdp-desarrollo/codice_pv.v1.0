<script type="text/javascript">
$(function(){
    $('#id_oficina').change(function(){
        var id=$(this).val();
        location.href='/admin/user/lista/'+id;
    });
});
</script>
<h2 class="subtitulo"><?php echo $oficina;?><br/><span>LISTA DE USUARIOS</span></h2>
<div style="text-align: center; " ><a href="/admin/oficinas/lista/<?php echo $entidad->id;?>" style="font-size: 14px; "><?php echo $entidad->entidad;?></a></div>
<br/>
<?php echo Form::select('id_oficina', $options, $id_oficina,array('id'=>'id_oficina'));?>
<div style="float: right;"><a href="/admin/user/create/<?php echo $id_oficina;?>" class="uibutton">+ Nuevo Usuario</a></div>
<br/>
<br/>
<table id="theTable">
    <thead>
        <tr>
            <th>
                USERNMAE
            </th>
            <th>
                NOMBRE
            </th>
            <th>
                CARGO
            </th>
            <th>
                OPCIONES
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $u ): ?>
        <tr>
            <td>
             <?php echo $u->username?>   
            </td>
            <td>
             <a href="/admin/user/detalle/<?php echo $u->id?>"><?php echo $u->nombre?></a>   
            </td>
            <td>
             <?php echo $u->cargo?>   
            </td>
            <td>
             <?php // echo $u->fecha_creacion;?>                     
             <a href="/admin/user/detalle/<?php echo $u->id?>" title="Cambiar contraseña" ><img src="/media/images/16x16/key.png" /></a>      
             <a href="/admin/user/detalle/<?php echo $u->id?>" title="Dar de Baja" ><img src="/media/images/16x16/down.png" /></a>      
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php
//echo '<pre>';
//var_dump($users);
//echo '</pre>';

?>
