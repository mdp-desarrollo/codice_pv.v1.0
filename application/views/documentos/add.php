
<script type="text/javascript">
$(function(){
$('#frmDocumento').validate();
 });
</script>
<fieldset>
    <legend>Subir Imagenes:</legend>
<?php
echo Form::open(URL::base().'documentos/add', array('enctype' => 'multipart/form-data','id'=>'frmDocumento'));
?>
<p>
<?php 
echo Form::label('tipo','Tipo de documento:');
$options=array(''=>'Seleccione...');
foreach ($tipos as $t) {
    $options[$t->id]=$t->documento;
}
echo Form::select('tipo', $options, NULL, array('id'=> 'tipo','class'=>'required'));
?>
</p>
<p>
<?php
echo Form::label('titulo','Titulo:');
echo Form::input('titulo','',array('id'=>'titulo','size'=>40,'class'=>'required'));
?>
</p>
<p>
<?php
echo Form::label('archivo','Archivo:');
echo Form::file('archivo',array('id'=>'archivo','size'=>40,'class'=>'required'));
?>
</p>

<p>
<?php
echo '<hr/>';
echo Form::button('submit', 'Subir Documento',array('type'=>'submit','class'=>'submitbutton'));
echo '&nbsp;';
echo Form::close(); //fin del formulario
?></p>

</fieldset>