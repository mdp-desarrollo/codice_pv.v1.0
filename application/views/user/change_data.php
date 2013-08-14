<script type="text/javascript">
$(function(){
    $("#frmUsuario").validate();
});
</script>
<h2 class="subtitulo">Cambiar datos<br/><span>formulario para cambiar datos del usuario</span></h2>
<?php if(sizeof($info)>0){?>
<div class="info">
    <ul>
    <?php foreach($info as $k=>$e):?>
        <li><?php echo $e;?></li>
    <?php endforeach;?>
    </ul>    
</div>
<a href="/index">Ir al Inicio</a>
<?php } else {?>
<?php if(sizeof($errors)>0):?>
<div class="error">
    <ul>
    <?php foreach($errors as $k=>$e):?>
        <li><?php echo $e;?></li>
    <?php endforeach;?>
    </ul>
</div>
<?php endif;?>
<form method="post" action="" id="frmUsuario">
<table>
        <tr>
        <td>
            Nombre completo:
        </td>        
        <td>
            <?php echo Form::input('nombre',$user->nombre,array('size'=>40,'class'=>'required')); ?>
        </td>
        </tr>
        <tr>
        <td>
            Cargo:
        </td>
        <td>
            <?php echo Form::input('cargo',$user->cargo,array('size'=>40,'class'=>'required')); ?>
        </td>
        </tr>
        <tr>
        <td>
            Mosca:
        </td>
        <td>
            <?php echo Form::input('mosca',$user->mosca,array('size'=>40,'class'=>'required')); ?>
        </td>
        </tr>
        <tr>
        <td>
            E-mail:
        </td>
        <td>
            <?php echo Form::input('email',$user->email,array('size'=>40,'class'=>'required email')); ?>
        </td>
        </tr>
        <tr>
        <td>
            Genero:
        </td>
        <td>
            <?php echo Form::select('genero',array('hombre'=>'Hombre','mujer'=>'Mujer'),$user->genero ); ?>
        </td>
        </tr>
        <tr>
            <td></td>
        <td>
            <br/>
            <?php echo Form::submit('submit','Modificar datos',array('class'=>'uiButton','type'=>'submit')); ?>
        </td>
        </tr>
</table>
</form>


<?php }?>