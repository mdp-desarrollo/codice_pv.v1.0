<script type="text/javascript">
$(function(){
    $("#frm").validate();
});
</script>

<h2 class="subtitulo">Crear una nueva carpeta<br/><span>Llene correctamente los datos del formulario</span></h2>
<?php //if($mensaje!='') echo "Se creo corectamente la carpeta $mensaje"; ?>
<?php if(sizeof($error)>0): ?>
<ul>
    <?php foreach($error as $e):?>
    <li><?php echo $e?></li>
    <?php endforeach;?>
</ul>
<?php endif;?>
<?php if(sizeof($info)>0):?>
<div class="info">
    <p><span style="float: left; margin-right: .3em;" class=""></span>
    <?php foreach($info as $k=>$v):?>
        <strong><?=$k?>: </strong> <?php echo $v;?></p>
    <?php endforeach;?>   
</div>
 <?php endif;?>
<form method="post" action="/admin/carpetas/save" id="frm">
    <?php     
    echo Form::hidden('id',$carpeta->id);
    ?>
    <table>
        <tr>
            <td><?php echo Form::label('Oficina');?></td>
            <td><?php echo Form::select('id_oficina',$options,$carpeta->id_oficina, array('id'=>'id_oficina','class'=>'required'))?></td>
        </tr>
        <tr>
            <td><?php echo Form::label('Nombre Carpeta');?></td>
            <td><?php echo Form::input('carpeta',$carpeta->carpeta,array('size'=>60,'class'=>'required'));?></td>
        </tr>
        <tr>
            <td><?php echo Form::label('Nivel');?></td>
            <td><?php echo Form::input('nivel',$carpeta->nivel,array('class'=>'required number'));?></td>
        </tr>
    </table>
<hr/>
<br/>
<input type="submit" value="Crear carpeta" name="create" class="uibutton" />
</form>    