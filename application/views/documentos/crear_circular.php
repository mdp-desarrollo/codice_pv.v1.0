<script>
tinymce.init({
    selector: "textarea#descripcion",
    theme: "modern",
    language : "es",
    // width: 595,
    height: 350,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   content_css: "css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
 }); 
</script>

<script type="text/javascript">  
$(function(){
$('#frmCreate').validate();
    var config={
    toolbar : [ ['Maximize','Preview','SelectAll','Cut', 'Copy','Paste', 'Pagebreak','PasteFromWord','PasteText','-','Bold','Italic','Underline','FontSize','Font','TextColor','BGColor',,'NumberedList','BulletedList'],
                ['Undo','Redo','-','Print','SpellChecker','Scayt','-','Find','Replace','-','Table','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']],
	language: 'es'
    }
//	$('textarea#descripcion').ckeditor(config);
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
    var destino=$('#destinatario').val();
    if(destino=='')
        $('#destinatario').val(nombre);    
    else
        $('#destinatario').val(destino+'\n'+nombre);    
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
        <legend></legend>
        <hr/>
    <table width="100%">
<tr>
<td style=" border-right:1px dashed #ccc; padding-left: 5px;" colspan="2">
<input type="hidden" name="titulo" value=""/>   
<input type="hidden" name="proceso" value="4"/> 
<p>
<?php echo Form::label('destinatario(s)', 'Destinatario(s):',array('class'=>'form'));?>
    <textarea name="destinatario" ROWS="5" id="destinatario" style="width: 500px;" class="required"></textarea>    
</p>
<input type="hidden" name="cargo_des" />
<p>
    <input type="hidden" size="40" name="institucion_des" />    
    <input type="hidden" name="via" />   
    <input type="hidden" name="cargovia" />   
</p>
</p>
</td>
<td rowspan="2" style="padding-left: 5px;">
    <?php echo Form::label('dest','Destinatarios:');?>
    <div id="vias">
        <ul>
            <?php foreach($oficinas  as $o): ?>
            <li class="oficinas"><?php echo HTML::anchor('#',$o->oficina,array('class'=>'destino','nombre'=>$o->oficina));?></li>
            <?php endforeach; ?>                         
        </ul>
    </div>
</td>
</tr>
<tr>
<td>
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
</p>
</td>
<td>
   <?php
   echo Form::label('adjuntos', 'Adjunto:',array('class'=>'form'));
   echo Form::input('adjuntos','',array('id'=>'adjuntos','size'=>40,'class'=>'required','title'=>'Ejemplo: Lo citado'));
?>
<?php
   echo Form::label('copias', 'Con copia a:',array('class'=>'form'));
   echo Form::input('copias','',array('id'=>'adjuntos','size'=>40));
?>
</td>
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
<div class="descripcion" style="width: 800px; float: left; ">
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
