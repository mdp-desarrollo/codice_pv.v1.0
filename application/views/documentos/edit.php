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
        theme_advanced_buttons3_add : "pastetext,pasteword,selectall",
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
        
        var tabContainers=$('div.tabs > div');
        tabContainers.hide().filter(':first').show();
        $('div.tabs ul.tabNavigation a').click(function(){
            tabContainers.hide();
            tabContainers.filter(this.hash).show();
            $('div.tabs ul.tabNavigation a').removeClass('selected');
            $(this).addClass('selected');
            return false;
        }).filter(':first').click();
    
    
        $('#frmEditar').validate();
        
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
    
//Modificaod por freddy Velasco
<?php if($documento->fucov==1){ ?>
$('#contenido1').hide();
$('#label_referencia').text('Motivo');
//adicionar atributos
$("#origen").attr("class", "required");
$("#destino").attr("class", "required");
$("#fecha_inicio").attr("class", "required");
$("#fecha_fin").attr("class", "required");
$("#hora_inicio").attr("class", "required");
$("#hora_fin").attr("class", "required");
$("#detalle_comision").attr("class","required");
<?php } else { ?>
    $('#label_contenido').hide();
    $('#contenido2').hide();
<?php } ?>    
    $('#fucov').click(function(){
    if($('#fucov').is(':checked')) {
            $('#label_referencia').text('Motivo');
            $('#label_contenido').show();
            $('#contenido1').hide();
            $('#contenido2').show();
            //adicionar atributos
            $("#origen").attr("class", "required");
            $("#destino").attr("class", "required");
            $("#fecha_inicio").attr("class", "required");
            $("#fecha_fin").attr("class", "required");
            $("#hora_inicio").attr("class", "required");
            $("#hora_fin").attr("class", "required");
            $("#detalle_comision").attr("class","required");
        } else {
            $('#label_referencia').text('Referencia');
            $('#label_contenido').hide();
            $('#contenido1').show();
            $('#contenido2').hide();
            //elimar atribuitos
             $("#origen").removeAttr("class");
             $("#destino").removeAttr("class");
             $("#fecha_inicio").removeAttr("class");
             $("#fecha_fin").removeAttr("class");
             $("#hora_inicio").removeAttr("class");
             $("#hora_fin").removeAttr("class");
             $("#detalle_comision").removeAttr("class");
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
                dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
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


/////////////end////////////////////

        $('#btnword').click(function(){
            $('#word').val(1);
            return true

        });
        $('#save').click(function(){
            $('#frmEditar').submit();        
        });
        $('#subir').click(function(){
            var id=$(this).attr('rel');
            var left=screen.availWidth;
            var top=screen.availHeight;
            left=(left-700)/2;
            top=(top-500)/2;
            var r=window.showModalDialog("/archivo/add/"+id,"","center:0;dialogWidth:600px;dialogHeight:450px;scroll=yes;resizable=yes;status=yes;"+"dialogLeft:"+left+"px;dialogTop:"+top+"px");
            alert(r);
            return false;
        });        
        $("input.file").si();

    });
</script>
<style type="text/css">
    form#frmCreate{ padding: 0 5px; margin: 0;}
    .cke_contents{height: 500px;}
    cke_skin_kama{border: none;}
    div.si label.cabinet {
        width: 156px;
        height: 34px;
        display: block;
        overflow: hidden;
        position: relative;
        z-index: 3;
        float: left;
        cursor: pointer; 
    }
    div.si label.cabinet input {
        position: relative;
        left: -140px;
        top: 0;
        height: 100%;
        width: auto !important;
        z-index: 2;
        opacity: 0;
        -moz-opacity: 0;
        filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);
    }
    div.si div.uploadButton {
        position: relative;
        float: left;
    }
    div.si div.uploadButton div {
        width: 156px;
        height: 34px;
        background: url(/media/images/examinar.png) 0 0 no-repeat;
        left: -156px;
        position: absolute;
        z-index: 1;

    }
    div.si label.selectedFile {
        margin-left: 5px;
        line-height: 34px;
    }

</style>

<?php 
$origen =  '';
$destino = '';
$detalle_comision = '';
$fi = '';
$ff = '';
$hi = '';
$hf = '';
$obs = '';
$checked = '';
$diai = '';
$diaf = '';

if($documento->fucov==1) {
$origen =  $pvcomision->origen;
$destino = $pvcomision->destino;
$detalle_comision = $pvcomision->detalle_comision;
$fi = date('Y-m-d', strtotime($pvcomision->fecha_inicio));
$ff = date('Y-m-d',  strtotime($pvcomision->fecha_fin));
$hi = date('H:i:s', strtotime($pvcomision->fecha_inicio));
$hf = date('H:i:s',  strtotime($pvcomision->fecha_fin));
$diai=  dia_literal(date("w", strtotime($fi)));
$diaf=  dia_literal(date("w", strtotime($ff)));
$obs = $pvcomision->observacion;
$checked = 'checked';
} 

function dia_literal($n) {
    switch ($n) {
        case 1: return 'Lun'; break;
        case 2: return 'Mar'; break;
        case 3: return 'Mie'; break;
        case 4: return 'Jue'; break;
        case 5: return 'Vie'; break;
        case 6: return 'Sab'; break;
        case 0: return 'Dom'; break;
    }
}
?>

<h2 class="subtitulo">Editar <?php echo $documento->codigo; ?> - <b><?php echo $documento->nur; ?></b><br/><span> Editar documento <?php echo $documento->codigo; ?> </span></h2>
<div class="tabs">
    <ul class="tabNavigation">
        <li><a href="#editar">Edición</a></li>
        <li><a href="#adjuntos">Adjuntos</a></li>        
    </ul>
    <div id="editar"> 

        <div class="formulario"  >  
            <div style="border-bottom: 1px solid #ccc; background: #F2F7FC; display: block; padding: 10px 0;   width: 100%;  ">    
                <a href="#" class="link save" id="save" title="Guardar cambios hechos al documento" > Guardar</a>
                | <a href="/pdf/<?php echo $tipo->action ?>.php?id=<?php echo $documento->id; ?>" class="link pdf" target="_blank" title="Imprimir PDF" >PDF</a>
                |  
                <?php if ($documento->estado == 1): ?> 
                    <a href="/seguimiento/?nur=<?php echo $documento->nur; ?>" class="link derivar" title="Ver seguimiento" >Derivado</a>      
                <?php else: ?>
                    <a href="/hojaruta/derivar/?id_doc=<?php echo $documento->id; ?>" class="link derivar" title="Derivar a partir del documento, si ya esta derivado muestra el seguimiento" >Derivar</a>      
                <?php endif; ?>
                <?php
                $session = Session::instance();
                if ($session->get('super') == 1):
                    ?>
                    |  <a href="/word/print.php?id=<?php echo $documento->id; ?>" class="link word" target="_blank" title="Editar este documento en word" >Editar en Word</a>       
                <?php endif; ?>
            </div>
            <form action="/documento/editar/<?php echo $documento->id; ?>" method="post" id="frmEditar" >  
                <?php if (sizeof($mensajes) > 0): ?>
                    <div class="info">
                        <p><span style="float: left; margin-right: .3em;" class="ui-icon-info"></span>
                            <?php foreach ($mensajes as $k => $v): ?>
                                <strong><?= $k ?>: </strong> <?php echo $v; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>        
                <br/>
                <?php
                if ($documento->id_tipo == 5):
                    echo Form::hidden('proceso', 1);
                else:
                    ?>        
                    <fieldset> <legend>Proceso: <?php echo Form::select('proceso', $options, $documento->id_proceso); ?>
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            <?php
                            if ($documento->id_tipo == '2') { ?>FUCOV: <?php echo Form::checkbox('fucov',1,FALSE,array('id'=>'fucov','name'=>'fucov',$checked,'title'=>'seleccione si quiere habilitar un memoramdum de viaje'))?><?php }?>    
                        </legend>
                    <?php endif; ?>            
                    <table width="100%">
                        <tr>
                            <td style=" border-right:1px dashed #ccc; padding-left: 5px;">
                                <?php if ($documento->id_tipo == '5'): ?>
                                    <p>
                                        <label>Titulo:</label>
                                        <select name="titulo" class="required">
                                            <option></option>
                                            <option <?php
                                if ($documento->titulo == 'Señor') {
                                    echo 'selected';
                                }
                                    ?> >Señor</option>
                                            <option <?php
                                            if ($documento->titulo == 'Señora') {
                                                echo 'selected';
                                            }
                                    ?>>Señora</option>
                                            <option <?php
                                            if ($documento->titulo == 'Señores') {
                                                echo 'selected';
                                            }
                                    ?>>Señores</option>    
                                        </select>
                                    </p>
                                <?php else: ?>
                                    <input type="hidden" name="titulo" />   
                                <?php endif; ?>    
                                <p>
                                    <?php
                                    echo Form::hidden('id_doc', $documento->id);
                                    echo Form::label('destinatario', 'Nombre del destinatario:', array('class' => 'form'));
                                    echo Form::input('destinatario', $documento->nombre_destinatario, array('id' => 'destinatario', 'size' => 45, 'class' => 'required'));
                                    ?>
                                </p>
                                <p>
                                    <?php
                                    echo Form::label('destinatario', 'Cargo Destinatario:', array('class' => 'form'));
                                    echo Form::input('cargo_des', $documento->cargo_destinatario, array('id' => 'cargo_des', 'size' => 45, 'class' => 'required'));
                                    ?>
                                </p> 
                                <?php if ($tipo->via == 0): ?>
                                    <p>
                                        <label>Institución Destinatario</label>
                                        <input type="text" size="40" value="<?php echo $documento->institucion_destinatario; ?>" name="institucion_des" />    
                                    </p>
                                    <input type="hidden" size="40" value="" name="via" />    
                                    <input type="hidden" size="40" value="" name="cargovia" />    
                                <?php else: ?>
                                    <input type="hidden" size="40" value="" name="institucion_des" />    

                                    <p>
                                        <?php
                                        echo Form::label('via', 'Via:', array('class' => 'form'));
                                        echo Form::input('via', $documento->nombre_via, array('id' => 'via', 'size' => 45/* ,'class'=>'required' */));
                                        ?>
                                        <?php
                                        echo Form::label('cargovia', 'Cargo Via:', array('class' => 'form'));
                                        echo Form::input('cargovia', $documento->cargo_via, array('id' => 'cargovia', 'size' => 45/* ,'class'=>'required' */));
                                        ?>
                                    <?php endif; ?>

                                </p>
                            </td>
                            <td style=" border-right:1px dashed #ccc; padding-left: 5px;">
                                <p>
                                    <?php
                                    echo Form::label('remitente', 'Nombre del remitente: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mosca', array('class' => 'form'));
                                    echo Form::input('remitente', $documento->nombre_remitente, array('id' => 'remitente', 'size' => 32, 'class' => 'required'));
                                    ?>            
                                    <?php
                                    //  echo Form::label('mosca','Mosca:');
                                    echo Form::input('mosca', $documento->mosca_remitente, array('id' => 'mosca', 'size' => 4));
                                    ?>
                                    <?php
                                    echo Form::label('cargo', 'Cargo Remitente:', array('class' => 'form'));
                                    echo Form::input('cargo_rem', $documento->cargo_remitente, array('id' => 'cargo_rem', 'size' => 45, 'class' => 'required'));
                                    ?>
                                    <?php
                                    echo Form::label('adjuntos', 'Adjunto:', array('class' => 'form'));
                                    echo Form::input('adjuntos', $documento->adjuntos, array('id' => 'adjuntos', 'size' => 45/* ,'class'=>'required','title'=>'Ejemplo: Lo citado' */));
                                    ?>
                                    <?php
                                    echo Form::label('copias', 'Con copia a:', array('class' => 'form'));
                                    echo Form::input('copias', $documento->copias, array('id' => 'adjuntos', 'size' => 45/* ,'class'=>'required' */));
                                    ?>
                                </p>
                            </td>



                            <td rowspan="2" style="padding-left: 5px;">
                                <?php echo Form::label('dest', 'Mis destinatarios:'); ?>
                                <div id="vias">
                                    <ul>

                                        <!-- Vias -->    

                                        <!-- Destinatario -->    
                                        <?php foreach ($vias as $v): ?>
                                            <li class="<?php echo $v['genero'] ?>"><?php echo HTML::anchor('#', $v['nombre'], array('class' => 'destino', 'nombre' => $v['nombre'], 'title' => $v['cargo'], 'cargo' => $v['cargo'], 'via' => $v['via'], 'cargo_via' => $v['cargo_via'])); ?></li>
                                        <?php endforeach; ?>

                                        <!-- Inmediato superior -->    
                                        <?php //foreach($superior  as $v){    ?>
                                        <li class="<?php //echo $v['genero']    ?>"><?php //echo HTML::anchor('#',$v['nombre'],array('class'=>'destino','nombre'=>$v['nombre'],'title'=>$v['cargo'],'cargo'=>$v['cargo'],'via'=>'','cargo_via'=>''));    ?></li>
                                        <?php //}    ?>
                                        <!-- dependientes -->    
                                        <?php // foreach($dependientes  as $v){    ?>
                                        <li class="<?php // echo $v['genero']    ?>"><?php //echo HTML::anchor('#',$v['nombre'],array('class'=>'destino','nombre'=>$v['nombre'],'title'=>$v['cargo'],'cargo'=>$v['cargo'],'via'=>'','cargo_via'=>''));    ?></li>
                                        <?php //}    ?>
                                    </ul>
                                </div>
                            </td>


                        </tr>

                        <tr>
                            <td colspan="2" style="padding-left: 5px;">
                                <?php echo Form::label('referencia', 'Referencia:', array('id' => 'label_referencia', 'class' => 'form')); ?> 
                                <textarea name="referencia" id="referencia" style="width: 510px;" class="required"><?php echo $documento->referencia ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <input type="hidden" id="word" value="0" name="word"  />
                            </td>
                        </tr>
                    </table>

                    <div style="width: 800px;float: left; ">
                        <?php echo Form::label('contenido', 'Contenido:', array('id' => 'label_contenido', 'class' => 'form')); ?> 
                        <div id='contenido1'>
                            <?php
                            echo Form::textarea('descripcion', $documento->contenido, array('id' => 'descripcion', 'cols' => 50, 'rows' => 20));
                            ?>
                        </div>
                        
                        
                        <div id='contenido2'>
                            <br>
                            Por medio del presente Memorándum se ordena a su persona trasladarse desde:<br> 
                            ciudad (origen)
                            <?php echo Form::input('origen', $origen, array('id' => 'origen')); ?> 
                            hasta la ciudad (destino)
                            <?php echo Form::input('destino', $destino, array('id' => 'destino')); ?><br>
                            con el objetivo de asistir a (detalle de comision)
                            <p><?php echo Form::textarea('detalle_comision', $detalle_comision, array('id' => 'detalle_comision', 'cols' => 150, 'rows' => 2)); ?></p>
                            desde el 
                            <input type="text" id="fecha_inicio" name="fecha_inicio" size='16' value="<?php echo $diai.' '.$fi;?>"/> a Hrs. <input type="text" name="hora_inicio" id="hora_inicio" value="<?php echo $hi; ?>" size='6'/>
                            hasta el
                            <input type="text" id="fecha_fin" name="fecha_fin" size='16' value="<?php echo $diaf.' '.$ff?>"/> a Hrs. <input type="text" id="hora_fin" name="hora_fin" value="<?php echo $hf; ?>" size='6'/><br>
                            Sírvase tramitar ante la Dirección General de Asuntos Administrativos la asignación de pasajes y viáticos de acuerdo a escala autorizada para los cual su persona deberá coordinar la elaboración del FUCOV.
                            Una vez completada la comisión sírvase hacer llegar el informe de descargo dentro de los próximos 8 días hábiles de concluída la comisión de acuerdo al artículo 25 del reglamento de Pasajes y viáticos del Ministerio de Desarrollo Productivo y Economía Plural.
                            <?php echo Form::label('observacion', 'Observacion:', array('id' => 'label_observacion', 'class' => 'form')); ?> 
                            <?php echo Form::textarea('observacion', $obs, array('id' => 'observacion', 'cols' => 150, 'rows' => 2)); ?>
                        </div>
                    </div>  
                    <div id="op">
                        <!-- <a href="#" class="link imagen">Insertar Imagen</a>
                         <a href="#" class="link imagen">Seleccionar todo</a>    -->
                    </div>
                    <div style="clear:both; display: block;"></div>
                    <input type="hidden" id="con" value="<?php echo strlen($documento->contenido . $documento->referencia); ?> "/>
                    <p>
                    <hr/>
                    <input type="submit" name="documento" value="Modificar documento" class="uibutton" />   
                    </p>
                </fieldset>

            </form>
        </div>
    </div>
    <div id="adjuntos">
        <div class="formulario">        
            <form method="post" enctype="multipart/form-data" action="" >
                <label>Selecione un archivo para subir...</label>
                <input type="file" class="file" name="archivo"/>                 
                <input type="hidden" name="id_doc" value="<?php echo $documento->id; ?>"/>
                <input type="submit" name="adjuntar" value="subir"/>
            </form>        
            <div style="clear: both;">

            </div>
            <h2 style="text-align:center;">Archivos Adjuntos </h2><hr/>
            <table id="theTable">
                <thead>
                    <tr>
                        <th>NOMBRE ARCHIVO</th>
                        <th>TAMA&Ntilde;O</th>
                        <th>FECHA DE SUBIDA</th>
                        <th>ACCION</th>
                    </tr>
                </thead>
                <tbody>                
                    <?php foreach ($archivos as $a): ?>
                        <tr>
                            <td><a href="/descargar.php/?id=<?php echo $a->id; ?>"><?php echo substr($a->nombre_archivo, 13) ?></a></td>
                            <td align="center"><?php echo number_format(($a->tamanio / 1024) / 1024, 2) . ' MB'; ?></td>
                            <td align="center"><?php echo $a->fecha ?></td>
                            <td align="center"><a href="/archivo/eliminar/<?php echo $a->id; ?>" class="link delete">Eliminar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>    
        </div>
    </div>
</div>