
<script type="text/javascript">
$(function(){
$('#frmContenido').validate();
 });
</script>
<fieldset>
    <legend>Subir Imagenes:</legend>
<?php
echo Form::open(URL::base().'imagenes/add', array('enctype' => 'multipart/form-data'));
?>
<p>
<?php
echo Form::label('imagen','Archivo:');
echo Form::file('imagen',array('id'=>'file','size'=>40));
?>
</p>
<p>
<?php
echo '<hr/>';
echo Form::button('submit', 'Subir',array('type'=>'submit','class'=>'submitbutton'));
echo '&nbsp;';
echo Form::close(); //fin del formulario
?></p>
</fieldset>