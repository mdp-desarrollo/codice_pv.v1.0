<script type="text/javascript">  
        CKEDITOR.config.scayt_autoStartup = true;  
        // needs to migrate your pages to licensed server version from trial          
        CKEDITOR.config.scayt_maxSuggestions = 4;  
        // needs to migrate to hosted service from trial  
        // set up encrypted customer id           
        // set up SCAYT default language   
        CKEDITOR.config.scayt_sLang ="es_ES";

    
    
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
$("#frmCreate").validate();
    var config={
    toolbar : [ ['Maximize','Preview','SelectAll','Cut', 'Copy','Paste', 'Pagebreak','PasteFromWord','PasteText','-','Bold','Italic','Underline','FontSize','Font','TextColor','BGColor',,'NumberedList','BulletedList'],
                ['Undo','Redo','-','SpellChecker','Scayt','-','Find','Replace','-','Table','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']],
	language: 'es'
    }
	$('textarea#descripcion').ckeditor(config);
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
    if(via==undefined)
        $('#via').val("");
    else $('#via').val(via);
    if(cargo_via==undefined)
        $('#cargovia').val("");
    else $('#cargovia').val(cargo_via);
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
<h2 class="subtitulo">Crear <?php echo $documento->tipo;?> <br/><span>LLENE CORRECTAMENTE LOS DATOS EN EL FORMULARIO</span></h2>
<div class="formulario">
    <form action="/documento/crear/<?php echo $documento->action;?>" method="post" id="frmCreate">
    <br/>
    <fieldset>
        <?php if($tipo->tipo=='Carta'):
        echo Form::hidden('proceso',1);
        else: ?>
        <legend>Proceso: <?php echo Form::select('proceso', $options, NULL);?></legend>
        <hr/>
        <?php endif; ?>
    <table width="100%">
<tr>
<td style=" border-right:1px dashed #ccc; padding-left: 5px;">
<?php if($documento->tipo=='Carta'):?>
<p>
<label>Titulo:</label>
<select name="titulo" class="required">
    <option></option>
    <option>Señor</option>
    <option>Señora</option>
    <option>Señores</option>    
</select>
</p>
<?php else:?>
<input type="hidden" name="titulo" />   
<?php endif;?>
<p>
<?php
echo Form::label('destinatario', 'Nombre del destinatario:',array('class'=>'form'));
echo Form::input('destinatario','',array('id'=>'destinatario','size'=>40,'class'=>'required'));
?>
</p>
<p>
<?php
echo Form::label('destinatario', 'Cargo Destinatario:',array('class'=>'form'));
echo Form::input('cargo_des','',array('id'=>'cargo_des','size'=>40,'class'=>'required'));
?>
</p>   
    <?php if($tipo->via==0):?>
<p>
<label>Institución Destinatario</label>
    <input type="text" size="40" name="institucion_des" />    
    <input type="hidden" name="via" />   
    <input type="hidden" name="cargovia" />   
</p>
<?php else:?>
<input type="hidden" size="40" name="institucion_des" />   
<?php
echo Form::label('via', 'Via:',array('class'=>'form'));
echo Form::input('via','',array('id'=>'via','size'=>40));
?>
<?php
echo Form::label('cargovia', 'Cargo Via:',array('class'=>'form'));
echo Form::input('cargovia','',array('id'=>'cargovia','size'=>40));
?>
<?php endif;?>
</p>
</td>
<td style=" border-right:1px dashed #ccc; padding-left: 5px;">
<p>
<?php
   echo Form::label('remitente', 'Remitente:',array('class'=>'form'));
   echo Form::input('remitente',$user->nombre,array('id'=>'remitente','size'=>35,'class'=>'required'));            
?>            
<?php
   //echo Form::label('mosca','Mosca:');
   echo Form::input('mosca',$user->mosca,array('id'=>'mosca','size'=>5));
?>
<?php
   echo Form::label('cargo', 'Cargo Remitente:',array('class'=>'form'));
   echo Form::input('cargo_rem',$user->cargo,array('id'=>'cargo_rem','size'=>40,'class'=>'required'));
?>
<?php
   echo Form::label('adjuntos', 'Adjunto:',array('class'=>'form'));
   echo Form::input('adjuntos','',array('id'=>'adjuntos','size'=>40,'title'=>'Ejemplo: Lo citado'));
?>
<?php
            echo Form::label('copias', 'Con copia a:',array('class'=>'form'));
            echo Form::input('copias','',array('id'=>'adjuntos','size'=>40));
            ?>
</p>
</td>
<?php if($documento->via>-10){ ?>
<td rowspan="2" style="padding-left: 5px;">
    <?php  echo Form::label('dest','Mis destinatarios:');?>
    <div id="vias">
        <ul>
            
            <!-- Vias -->    
            
            <!-- Destinatario -->    
            <?php foreach($destinatarios  as $v): ?>
            <li class="<?php echo $v['genero']?>"><?php echo HTML::anchor('#',$v['nombre'],array('class'=>'destino','nombre'=>$v['nombre'],'title'=>$v['cargo'],'cargo'=>$v['cargo'],'via'=>$v['via'],'cargo_via'=>$v['cargo_via']));?></li>
            <?php endforeach; ?>
            <!-- Inmediato superior -->    
            <?php //foreach($superior  as $v){ ?>
            <li class="<?php //echo $v['genero']?>"><?php //echo HTML::anchor('#',$v['nombre'],array('class'=>'destino','nombre'=>$v['nombre'],'title'=>$v['cargo'],'cargo'=>$v['cargo'],'via'=>'','cargo_via'=>''));?></li>
            <?php //} ?>
            <!-- dependientes -->    
            <?php // foreach($dependientes  as $v){ ?>
            <li class="<?php // echo $v['genero']?>"><?php //echo HTML::anchor('#',$v['nombre'],array('class'=>'destino','nombre'=>$v['nombre'],'title'=>$v['cargo'],'cargo'=>$v['cargo'],'via'=>'','cargo_via'=>''));?></li>
            <?php //} ?>
        </ul>
    </div>
</td>
<?php 
}
?>
</tr>

<tr>
<td colspan="2" style="padding-left: 5px;">
<?php
echo Form::label('referencia', 'Referencia:',array('class'=>'form'));?> 
    <textarea name="referencia" id="referencia" style="width: 500px;" class="required"></textarea>

</td>
</tr>
<tr>
<td colspan="3">
<input type="hidden" id="word" value="0" name="word"  />
<div class="descripcion" style="width: 700px; float: left; ">
<?php
echo Form::textarea('descripcion','',array('id'=>'descripcion','cols'=>50,'rows'=>10));
?>
</div>
<div id="op"><!--
    <a href="#" class="link imagen" id="insertarImagen">Insertar nueva Imagen</a><br/>
    <a href="#" class="link imagen" id="insertarImagen2">Insertar imagen existente</a><br/>
	-->
</div>
<div style="clear:both; display: block;"></div>
<hr/>
<p>
<input type="submit" value="Crear documento" class="uibutton" name="submit" id="crear" title="Crear documento nuevo" />    
</p>
</td>
<td></td>
</tr>
</table>
</fieldset>
</form>
</div>
