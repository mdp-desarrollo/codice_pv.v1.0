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
//$('#frmCreate').validate();
    var config={
    toolbar : [ ['Maximize','Preview','SelectAll','Cut', 'Copy','Paste', 'Pagebreak','PasteFromWord','PasteText','-','Bold','Italic','Underline','FontSize','Font','TextColor','BGColor',,'NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                ['Undo','Redo','-','Print','SpellChecker','Scayt','-','Find','Replace','-','Table']]
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
//incluir destinatario
$('a.destino').click(function(){
    var nombre=$(this).attr('nombre');   
    var cargo=$(this).attr('cargo');   
    var via=$(this).attr('via');   
    var cargo_via=$(this).attr('cargo_via');   
    $('#destinatario').val(nombre);
    $('#cargo_des').val(cargo);
    $('#via').val(via);
    $('#cargovia').val(cargo_via);
    $('#referencia').focus();
    return false;
    });
$('#btnword').click(function(){
        $('#word').val(1);
        return true

    });
$('#crear').click(function(){
        $('#word').val(0);
        return true

    });
});
</script>
<style type="text/css">
    form#frmCreate{ padding: 0 5px; margin: 0;}
</style>
<div id="documento">
             
</div>
<h2 class="subtitulo">Editar Documento<br/><span> Editar documento <?php echo $documento->codigo;?> :</span></h2>
<div id="formulario" >  
    <form action="/documento/editar/<?php echo $documento->id;?>" method="post" id="frmCreate" >
<br/>
<div style="text-align: center;">
    <h2><?php echo $documento->codigo;?></h2>
    <h2 style="color:#3E76BB;"><?php echo $documento->nur;?></h2>         
</div>        
    <fieldset> <legend>Proceso: <?php echo Form::select('proceso', $options, $documento->id_proceso);?></legend>
        
<table width="100%">
<tr>
<td style=" border-right:1px dashed #ccc; padding-left: 5px;">
<p>
<?php
echo Form::hidden('id_doc',$documento->id);   
echo Form::label('destinatario', 'Nombre del destinatario:',array('class'=>'form'));
echo Form::input('destinatario',$documento->nombre_destinatario,array('id'=>'destinatario','size'=>45,'class'=>'required'));
?>
</p>
<p>
<?php
echo Form::label('destinatario', 'Cargo Destinatario:',array('class'=>'form'));
echo Form::input('cargo_des',$documento->cargo_destinatario,array('id'=>'cargo_des','size'=>45,'class'=>'required'));
?>
</p> 
<?php if($documento->id_tipo==5):?>
<p>
<label>Institución Destinatario</label>
    <input type="text" size="40" value="<?php echo $documento->institucion_destinatario;?>" name="institucion_des" />    
</p>
<?php else: ?>
<p>
<label>Institución Destinatario</label>
    <input type="hidden" size="40" value="" name="institucion_des" />    
</p>
<?php endif;?>
<?php
echo Form::label('via', 'Via:',array('class'=>'form'));
echo Form::input('via',$documento->nombre_via,array('id'=>'via','size'=>45,'class'=>'required'));
?>
<?php
echo Form::label('cargovia', 'Cargo Via:',array('class'=>'form'));
echo Form::input('cargovia',$documento->cargo_via,array('id'=>'cargovia','size'=>45,'class'=>'required'));
?>
</p>
</td>
<td style=" border-right:1px dashed #ccc; padding-left: 5px;">
<p>
<?php
   echo Form::label('remitente', 'Nombre del remitente: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mosca',array('class'=>'form'));
   echo Form::input('remitente',$documento->nombre_remitente,array('id'=>'remitente','size'=>32,'class'=>'required'));            
?>            
<?php
 //  echo Form::label('mosca','Mosca:');
   echo Form::input('mosca',$documento->mosca_remitente,array('id'=>'mosca','size'=>4));
   
?>
<?php
   echo Form::label('cargo', 'Cargo Remitente:',array('class'=>'form'));
   echo Form::input('cargo_rem',$documento->cargo_remitente,array('id'=>'cargo_rem','size'=>45,'class'=>'required'));
?>
<?php
   echo Form::label('adjuntos', 'Adjunto:',array('class'=>'form'));
   echo Form::input('adjuntos',$documento->adjuntos,array('id'=>'adjuntos','size'=>45,'class'=>'required','title'=>'Ejemplo: Lo citado'));
?>
<?php
            echo Form::label('copias', 'Con copia a:',array('class'=>'form'));
            echo Form::input('copias',$documento->copias,array('id'=>'adjuntos','size'=>45,'class'=>'required'));
            ?>
</p>
</td>
<?php if($tipo->via>0){ ?>
<td style="padding-left: 5px;">
    <?php echo Form::label('dest','Mis destinatarios:');?>
    <div id="vias">
        <ul>
            <?php foreach($vias  as $v): ?>
            <li class="<?php echo $v['genero']?>"><?php echo HTML::anchor('#',$v['nombre'],array('class'=>'destino','nombre'=>$v['nombre'],'title'=>$v['cargo'],'cargo'=>$v['cargo'],'via'=>$v['via'],'cargo_via'=>$v['cargo_via']));?></li>
            <?php endforeach; ?>
            <!-- Inmediato superior -->    
            <?php foreach($superior  as $v){ ?>
            <li class="<?php echo $v['genero']?>"><?php echo HTML::anchor('#',$v['nombre'],array('class'=>'destino','nombre'=>$v['nombre'],'title'=>$v['cargo'],'cargo'=>$v['cargo'],'via'=>'','cargo_via'=>''));?></li>
            <?php } ?>
        </ul>
    </div>
</td>
<?php 
}
?>
</tr>

<tr>
<td colspan="3" style="padding-left: 5px;">
<?php
echo Form::label('referencia', 'Referencia:',array('class'=>'form'));
echo Form::input('referencia',$documento->referencia,array('id'=>'referencia','size'=>127,'class'=>'required'));
?> 
<br/>    
<br/>
</td>
</tr>
<tr>
<td colspan="3">
<input type="hidden" id="word" value="0" name="word"  />
<div  style="width: 700px;">
<?php
echo Form::textarea('descripcion',$documento->contenido,array('id'=>'descripcion','cols'=>50,'rows'=>50));
?>
</div>
<p>
<?php
echo '<hr/>';
echo Form::input('submit', 'Modificar Documento',array('type'=>'submit','id'=>'crear'));
echo '&nbsp;';
?>
    
</p>
</td>
</tr>
</table>
<br/>
</fieldset>
    </form>
</div>
