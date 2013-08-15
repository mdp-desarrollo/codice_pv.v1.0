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
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor | fullscreen",
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
    $("#frmCreate").validate();
    var config={
        toolbar : [ ['Maximize','Preview','SelectAll','Cut', 'Copy','Paste', 'Pagebreak','PasteFromWord','PasteText','-','Bold','Italic','Underline','FontSize','Font','TextColor','BGColor',,'NumberedList','BulletedList'],
        ['Undo','Redo','-','SpellChecker','Scayt','-','Find','Replace','-','Table','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']],
        language: 'es'
    }
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

// Modificado por Freddy Velasco
$('#label_contenido').hide();
$('#contenido2').hide();
$('#fucov').click(function(){
    if($('#fucov').is(':checked')) {
            $('#label_referencia').text('Motivo');
            $('#label_contenido').show();
            $('#contenido1').hide();
            $('#contenido2').show();
            // $('#viaje').show();
            // $('#normal').hide();
        } else {
            $('#label_referencia').text('Referencia');
            $('#label_contenido').hide();
            $('#contenido1').show();
            $('#contenido2').hide();
            // $('#normal').show();
            // $('#viaje').hide();
        }  
});

$.datepicker.regional['es'] = {
                closeText: 'Cerrar',
                prevText: '&#x3c;Ant',
                nextText: 'Sig&#x3e;',
                currentText: 'Hoy',
                monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
                    'Jul','Ago','Sep','Oct','Nov','Dic'],
                dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
                dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
                weekHeader: 'Sm',
                dateFormat: 'dd/mm/yy',
                //dateFormat: 'Full - DD, d MM, yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
    };   
$.datepicker.setDefaults($.datepicker.regional['es']);
var pickerOpts  = { changeMonth: true, minDate: 0, changeYear: true, yearRange: "-10:+1", dateFormat: 'D yy-mm-dd',onSelect: function(){ feriados('fecha');}};
$('#fecha_inicio,#fecha_fin').datepicker(pickerOpts,$.datepicker.regional['es']);
$('#hora_inicio,#hora_fin').timeEntry({show24Hours: true, showSeconds: true});
///////////////////end//////////////////////////
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
            <legend>Proceso: <?php echo Form::select('proceso', $options, NULL);?>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <?php if ($documento->tipo == 'Memorandum'){?>FUCOV: <?php echo Form::checkbox('fucov',1,FALSE,array('id'=>'fucov','name'=>'fucov','title'=>'seleccione si quiere habilitar un memoramdum de viaje'))?><?php }?>    
            </legend>
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
        echo Form::label('referencia', 'Referencia:',array('id'=>'label_referencia','class'=>'form'));?> 
        <textarea name="referencia" id="referencia" style="width: 500px;" class="required"></textarea>

    </td>
</tr>
<tr>
    <td colspan="3">
        <input type="hidden" id="word" value="0" name="word"  />
        <div class="descripcion" style="width: 800px; float: left; ">
            <?php echo Form::label('contenido', 'Contenido:',array('id'=>'label_contenido','class'=>'form'));?> 
            <div id='contenido1'>
             <?php
            echo Form::textarea('descripcion','',array('id'=>'descripcion','cols'=>50,'rows'=>10));
            ?>
            </div>
            <div id='contenido2'>
                <br>
                Por medio del presente Memorándum se ordena a su persona trasladarse desde:<br> 
                ciudad (origen)
                <?php echo Form::input('origen','',array('id'=>'origen')); ?> 
                hasta la ciudad (destino)
                <?php echo Form::input('destino','',array('id'=>'destino')); ?><br>
                con el objetivo de asistir a (detalle de comision)
                <p><?php echo Form::textarea('detalle_comision','',array('id'=>'detalle_comision','cols'=>150,'rows'=>2)); ?></p>
                desde el 
                <input type="text" id="fecha_inicio" name="fecha_inicio" size='16'/> a Hrs. <input type="text" name="hora_inicio" id="hora_inicio" value="<?php echo date("H:i:s");?>" size='6'/>
                    hasta el
                <input type="text" id="fecha_fin" name="fecha_fin" size='16'/> a Hrs. <input type="text" id="hora_fin" name="hora_fin" value="<?php echo date("H:i:s");?>" size='6'/><br>
                Una vez completada la comisión sírvase hacer llegar el informe de descargo dentro de los próximos 8 días hábiles de concluída la comisión de acuerdo al artículo 25 del reglamento de Pasajes y viáticos del Ministerio de Desarrollo Productivo y Economía Plural.
                Sírvase tramitar ante la Dirección General de Asuntos Administrativos la asignación de pasajes y viáticos de acuerdo a escala autorizada para los cual su persona deberá coordinar la elaboración del FUCOV. 
                <?php echo Form::label('observacion', 'Observacion:',array('id'=>'label_observacion','class'=>'form'));?> 
                <?php echo Form::textarea('observacion','',array('id'=>'observacion','cols'=>150,'rows'=>2)); ?>
            </div>
            
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