
<script type="text/javascript">
function InsertHTML(imagen)
{
	// Get the editor instance that we want to interact with.
	var oEditor = CKEDITOR.instances.descripcion;
	//var value = document.getElementById( 'plainArea' ).value;
		var value='<img src="'+imagen+'" />';
	// Check the active editing mode.
	if ( oEditor.mode == 'wysiwyg' )
	{
		// Insert the desired HTML.
		oEditor.insertHtml( value );
	}
	else
		alert( 'You must be on WYSIWYG mode!' );
}
$(function(){
$('#frmContenido').validate();
	$('#descripcion,textarea').ckeditor();
        $('#insertarImagen').click(function(){
	var left=screen.availWidth;
	var top=screen.availHeight;
	left=(left-700)/2;
	top=(top-500)/2;
	var r=window.showModalDialog("../otros/imagenes","","center:0;dialogWidth:600px;dialogHeight:450px;scroll=yes;resizable=yes;status=yes;"+"dialogLeft:"+left+"px;dialogTop:"+top+"px");
        InsertHTML(r[0]);
        });
 $('#subirImagen').click(function(){
	var left=screen.availWidth;
	var top=screen.availHeight;
	left=(left-700)/2;
	top=(top-500)/2;
	var r=window.showModalDialog("../otros/subirImagen","","center:0;dialogWidth:600px;dialogHeight:450px;scroll=yes;resizable=yes;status=yes;"+"dialogLeft:"+left+"px;dialogTop:"+top+"px");
        InsertHTML(r[0]);
        });
 });
</script>
<fieldset>
    <legend>Crear contenido:</legend>
<?php echo Form::open(url::base().'contenido/add'); ?>
<p><?php
echo Form::label('titulo', 'Titulo:');
echo Form::input('titulo','',array('id'=>'titulo','size'=>50,'class'=>'required'));
?>
</p>
<p><input id="subirImagen" type="button" value="Subir Fotos" />
<input  type="button" value="Insertar Imagen" id="insertarImagen" /></p>
<p>
<?php
echo Form::label('descripcion','Descripcion:');
echo Form::textarea('descripcion','',array('id'=>'descripcion','cols'=>40));
?>
</p>
<p>
<?php
echo '<hr/>';
echo Form::button('submit', 'Guardar',array('type'=>'submit','class'=>'submitbutton'));
echo '&nbsp;';
echo Form::button('reset', 'Resetear Campos', array('type'=>'reset','class'=>'submitbutton'));
echo Form::close(); //fin del formulario
?></p>

</fieldset>