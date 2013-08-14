<script type="text/javascript">
$(function(){
 $('#frmProveedor').validate();
 });
</script>
<fieldset>
    <legend>Addiconar contenido:</legend>
<?php
echo Form::open(URL::base().'proveedor/add',array('id'=>'frmProveedor'));
if ($errors){ 
?>
<p class="message">Some errors were encountered, please check the details you entered.</p>
<ul class="errors">
    <?php foreach ($errors as $message): ?>
    <li><?php echo $message ?></li>
   <?php endforeach;?>
</ul>
<?php
}
?>
<p><?php
echo Form::label('proveedor', 'Proveedor:');
echo Form::input('proveedor',$post['proveedor'],array('id'=>'proveedor','size'=>50,'class'=>'required'));
?>
</p>
<p>
<?php
echo Form::label('nit','NIT:');
echo Form::input('nit','',array('id'=>'nit','size'=>10,'class'=>'required number','minlength'=>8));
?>
</p>
<p>
<?php
echo Form::label('direccion','Direcci&oacute;n:');
echo Form::input('direccion','',array('id'=>'direccion','size'=>50));
?>
</p>
<p>
<?php
echo Form::label('telefonos','Telefonos:');
echo Form::input('telefonos','',array('id'=>'telefonos','size'=>40));
?>
</p>
<p>
<?php
echo Form::label('fax','Fax:');
echo Form::input('fax','',array('id'=>'fax','size'=>40));
?>
</p>
<p>
<?php
echo Form::label('email','Email:');
echo Form::input('email','',array('id'=>'email','size'=>40,'email'));
?>
</p>
<p>
<?php
echo '<hr/>';
echo Form::button('save', 'Guardar',array('type'=>'submit','class'=>'submitbutton'));
echo '&nbsp;';
echo Form::button('reset', 'Resetear Campos', array('type'=>'reset','class'=>'submitbutton'));
echo Form::close(); //fin del formulario
?></p>

</fieldset>