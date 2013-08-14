
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
    var config={
    toolbar : [ ['Maximize','Preview','SelectAll','Cut', 'Copy','Paste', 'Pagebreak','PasteFromWord','PasteText','-','Bold','Italic','Underline','FontSize','Font','TextColor','BGColor',,'NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','Undo','Redo'],
                ['Print','SpellChecker','Scayt','-','Find','Replace','-','Table']]
    }
	$('#descripcion,textarea').ckeditor(config);
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

        $('#cambiarImagen').click(function(){
	var left=screen.availWidth;
	var top=screen.availHeight;
	left=(left-700)/2;
	top=(top-500)/2;
	var r=window.showModalDialog("../otros/imagenes2","","center:0;dialogWidth:600px;dialogHeight:450px;scroll=yes;resizable=yes;status=yes;"+"dialogLeft:"+left+"px;dialogTop:"+top+"px");
        $('#foto').val(r[0]);
        $('#fotox').attr('src',r[0]);
        });

 });
</script>
<div id="documento">
               <h2 style="border-bottom: 1px dotted #ccc;">Generar Documento<br/><span>Tipo Documento: <?php echo 'Carta';?><?php echo '';?></span></h2>
               
</div>    
<?php echo Form::open(URL::base().'generar/carta', array('enctype' => 'multipart/form-data')); ?>
    <fieldset> <legend>Datos del destinatario:</legend>
<table>
<tr>
<td>
    <p><?php
echo Form::label('titulo', 'Titulo:',array('class'=>'form'));
$options=array(''=>'Ninguno','Señor'=>'Señor','Señora'=>'Señora','Señores'=>'Señores');
echo '<br/>';
echo Form::select('titulo', $options, NULL);
?></p><p>
<?php
echo Form::label('destinatario', 'Nombre del destinatario:',array('class'=>'form'));
echo '<br/>';
echo Form::input('destinatario','',array('id'=>'destinatario','size'=>60,'class'=>'required'));
?>
</p>
</td>       
<td>
    <p><?php
echo Form::label('destinatario', 'Cargo Destinatario:',array('class'=>'form'));
echo '<br/>';
echo Form::input('cargo_des','',array('id'=>'cargo_des','size'=>60,'class'=>'required'));
?>
</p>
    <p><?php
echo Form::label('institucion', 'Institución:',array('class'=>'form'));
echo '<br/>';
echo Form::input('institucion','',array('id'=>'institucion','size'=>60,'class'=>'required'));
?>
</p>
</td>
</tr>
<tr>
<td colspan="2">
<?php
echo Form::label('referencia', 'Referencia:',array('class'=>'form'));
echo '<br/>';
echo Form::input('referencia','',array('id'=>'referencia','size'=>130,'class'=>'required'));
?> 
</td>
</tr>
</table>
</fieldset>

<!--
<p>
<input  type="button" value="Insertar Imagen" id="insertarImagen" /><input  type="button" value="Subir Imagenes" id="subirImagen" />
</p>
-->
<p>
</p>
<div class="descripcion">
<?php
//echo Form::label('descripcion','Descripcion:',array('class'=>'form'));
//echo '<br/>';
echo Form::textarea('descripcion','',array('id'=>'descripcion','cols'=>50,'rows'=>90));
?>
    </div>
<fieldset><legend>Datos del Remitente: </legend>
    <table>
        <tr>
         <td>
            <?php
            echo Form::label('remitente', 'Remitente:',array('class'=>'form'));
            echo '<br>';
            echo Form::input('remitente',$usuario->nombre,array('id'=>'remitente','size'=>60,'class'=>'required'));            
            ?>            
         </td>
         <td>
            <?php
            echo Form::label('mosca','Mosca:');
            echo '<br/>';
            echo Form::input('mosca',$usuario->mosca,array('id'=>'mosca','size'=>10));
            ?>
            </td>
         <td colspan="2">
            <?php
            echo Form::label('cargo', 'Cargo Remitente:',array('class'=>'form'));
            echo '<br/>';
            echo Form::input('cargo_rem',$usuario->cargo,array('id'=>'cargo_rem','size'=>60,'class'=>'required'));
            ?>                
         </td>
        </tr>
        <tr> 
         <td>
            <?php
            echo Form::label('adjuntos', 'Adjunto:',array('class'=>'form'));
            echo Form::input('adjuntos','',array('id'=>'adjuntos','size'=>60,'class'=>'required','title'=>'Ejemplo: Lo citado'));
            ?>
         <td>
         <td>
            <?php
            echo Form::label('copias', 'Con copia a:',array('class'=>'form'));
            echo Form::input('copias','',array('id'=>'adjuntos','size'=>60,'class'=>'required'));
            ?>
        </td>
        </tr>
</table>
</fieldset>
<p>
<?php
echo '<hr/>';
echo Form::button('submit', 'Crear Carta',array('type'=>'submit','class'=>'submitbutton'));
echo '&nbsp;';
echo Form::button('reset', 'Resetear Campos', array('type'=>'reset','class'=>'submitbutton'));
echo Form::close(); //fin del formulario
?></p>
</div>
