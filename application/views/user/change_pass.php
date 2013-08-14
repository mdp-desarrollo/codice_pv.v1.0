<h2 class="subtitulo">Cambiar Contrase&ntilde;a<br/><span>formulario para cambiar contraseña</span></h2>
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
<form method="post">
<table>
        <tr>
        <td>
            Ingrese su contraseña anterior:
        </td>        
        <td>
            <?php echo Form::password('pass_old','',array('size'=>40)); ?>
        </td>
        </tr>
        <tr>
        <td>
            Ingrese su contraseña nueva:
        </td>
        <td>
            <?php echo Form::password('pass_new','',array('size'=>40)); ?>
        </td>
        </tr>
        <tr>
        <td>
            Repita su contraseña:
        </td>
        <td>
            <?php echo Form::password('pass_new2','',array('size'=>40)); ?>
        </td>
        </tr>
        <tr>
            <td></td>
        <td>
            <br/>
            <?php echo Form::submit('submit','Cambiar Contraseña',array('class'=>'uiButton','type'=>'submit')); ?>
        </td>
        </tr>
</table>
</form>


<?php }?>