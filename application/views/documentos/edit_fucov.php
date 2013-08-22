<script type="text/javascript">   
   
    $(function(){
        
        $('table.classy tbody tr:odd').addClass('odd'); 
        
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
        
        $('#id_tipoviaje').change(function(){
            var id_tipoviaje = $('#id_tipoviaje').val();
            var id_categoria = $('#id_categoria').val();
            $.ajax({
	            type: "POST",
	            data: { id_tv: id_tipoviaje, id_ca:id_categoria},
	            url: "/ajax/getmonto",
	            dataType: "json",
	            success: function(item)
	            {
                        if(item)
                        {
                            $('#div_vd').text(item.monto);
                            $('#viatico_dia').val(item.monto);
                            $('#div_momeda1').text(item.moneda);
                            
                        }
	           }
          });
            
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
        $('#fecha_salida,#fecha_arribo').datepicker(pickerOpts,$.datepicker.regional['es']);
        $('#hora_salida,#hora_arribo').timeEntry({show24Hours: true, showSeconds: true});


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


    
    $fi = date('Y-m-d', strtotime($pvfucov->fecha_salida));
    $ff = date('Y-m-d', strtotime($pvfucov->fecha_arribo));
    $hi = date('H:i:s', strtotime($pvfucov->fecha_salida));
    $hf = date('H:i:s', strtotime($pvfucov->fecha_arribo));
    $diai = dia_literal(date("w", strtotime($fi)));
    $diaf = dia_literal(date("w", strtotime($ff)));
    

function dia_literal($n) {
    switch ($n) {
        case 1: return 'Lun';
            break;
        case 2: return 'Mar';
            break;
        case 3: return 'Mie';
            break;
        case 4: return 'Jue';
            break;
        case 5: return 'Vie';
            break;
        case 6: return 'Sab';
            break;
        case 0: return 'Dom';
            break;
    }
}
?>

<h2 class="subtitulo">Editar <?php echo $documento->codigo; ?> - <b><?php echo $documento->nur; ?></b><br/><span> Editar documento <?php echo $documento->codigo; ?> </span></h2>
<div class="tabs">
    <ul class="tabNavigation">
        <li><a href="#editar">Edición</a></li>
        <li><a href="#poa">POA</a></li>
        <li><a href="#pre">Presupuesto</a></li>
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
                    <fieldset> 
                        <legend>Viaje: <?php
                echo Form::select('id_tipoviaje', $opt_tv,$pvfucov->id_tipoviaje,array('id' => 'id_tipoviaje'));
                echo Form::hidden('proceso', 1);
                echo Form::hidden('id_categoria',$user->id_categoria,array('id' => 'id_categoria'));
                    ?>
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
                                <?php if ($documento->id_tipo == 5): ?>
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
                                        <?php //foreach($superior  as $v){     ?>
                                        <li class="<?php //echo $v['genero']      ?>"><?php //echo HTML::anchor('#',$v['nombre'],array('class'=>'destino','nombre'=>$v['nombre'],'title'=>$v['cargo'],'cargo'=>$v['cargo'],'via'=>'','cargo_via'=>''));      ?></li>
                                        <?php //}     ?>
                                        <!-- dependientes -->    
                                        <?php // foreach($dependientes  as $v){     ?>
                                        <li class="<?php // echo $v['genero']      ?>"><?php //echo HTML::anchor('#',$v['nombre'],array('class'=>'destino','nombre'=>$v['nombre'],'title'=>$v['cargo'],'cargo'=>$v['cargo'],'via'=>'','cargo_via'=>''));      ?></li>
                                        <?php //}     ?>
                                    </ul>
                                </div>
                            </td>


                        </tr>

                        <tr>
                            <td colspan="2" style="padding-left: 5px;">
                                <?php echo Form::label('referencia', 'Motivo:', array('id' => 'label_referencia', 'class' => 'form')); ?> 
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
                        <?php echo Form::hidden('descripcion', $documento->contenido, array('id' => 'descripcion')); ?>
                        <table class="classy" border="1">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Origen</th>
                                    <th style="text-align:center;">Destino</th>
                                    <th style="text-align:center;">Fecha y Hora <br>Salida</th>
                                    <th style="text-align:center;">Fecha y Hora <br>Retorno</th>
                                    <th style="text-align:center;">Transporte</th>
                                    <th style="text-align:center;">Viaticos</th>
                                    <th style="text-align:center;">Desc. IVA</th> 
                                    <th style="text-align:center;">Gastos<br>Repres.</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo Form::input('origen',$pvfucov->origen,array('id'=>'origen','size'=>15,'class' => 'required'))?></td>
                                    <td><?php echo Form::input('destino',$pvfucov->destino,array('id'=>'destino','size'=>15,'class' => 'required'))?></td>
                                    <td><?php echo Form::input('fecha_salida',$diai.' '.$fi,array('id'=>'fecha_salida','size'=>12,'class' => 'required'))?> <br><?php echo Form::input('hora_salida',$hi,array('id'=>'hora_salida','size'=>12,'class' => 'required'))?></td>
                                    <td><?php echo Form::input('fecha_arribo',$diaf.' '.$ff,array('id'=>'fecha_arribo','size'=>12,'class' => 'required'))?> <br><?php echo Form::input('hora_arribo',$hf,array('id'=>'hora_arribo','size'=>12,'class' => 'required'))?></td>
                                    <td>
                                        <input type="radio" name="transporte" value="Aereo" <?php if($pvfucov->transporte=='Aereo'){ echo 'checked';}?> > Aereo<br>
                                        <input type="radio" name="transporte" value="Terrestre" <?php if($pvfucov->transporte=='Terrestre'){ echo 'checked';}?>> Terrestre<br>
                                        <input type="radio" name="transporte" value="Vehiculo Oficial" <?php if($pvfucov->transporte=='Vehiculo Oficial'){ echo 'checked';}?>> Vehiculo<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Oficial
                                    </td>
                                    <td>
                                        <input type="radio" name="cancelar" value="MDPyEP" <?php if($pvfucov->cancelar=='MDPyEP'){ echo 'checked';}?>> MDPyEP<br><br>
                                        Otra Institucion:
                                        <?php echo Form::input('financiador',$pvfucov->financiador,array('id'=>'financiador','size'=>15))?><br>
                                        Cubre:<br>
                                        <input type="radio" name="cancelar" value="Hospedaje" <?php if($pvfucov->cancelar=='Hospedaje'){ echo 'checked';}?>> Hospedaje<br>
                                        <input type="radio" name="cancelar" value="Hospedaje y alimentacion" <?php if($pvfucov->cancelar=='Hospedaje y alimentacion'){ echo 'checked';}?>> Hospedaje y<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;alimentacion<br>
                                        <input type="radio" name="cancelar" value="Renuncia de viaticos" <?php if($pvfucov->cancelar=='Aereo'){ echo 'Renuncia de viaticos';}?>> Renuncia de<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;viaticos
                                    </td>
                                    <td>
                                        <input type="radio" name="impuesto" value="Si" <?php if($pvfucov->impuesto=='Si'){ echo 'checked';}?>> Si<br>
                                        <input type="radio" name="impuesto" value="No" <?php if($pvfucov->impuesto=='No'){ echo 'checked';}?>> No<br>
                                    </td>
                                    <td>
                                        <input type="radio" name="representacion" value="Si" <?php if($pvfucov->representacion=='Si'){ echo 'checked';}?>> Si<br>
                                        <input type="radio" name="representacion" value="No" <?php if($pvfucov->representacion=='No'){ echo 'checked';}?>> No<br>
                                    </td>

                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <table width="100%">
                        <tr>
                            <td colspan='3'>Viatico x Dia: <?php echo Form::input('viatico_dia', $pvfucov->viatico_dia,array('id'=>'viatico_dia','size'=>8))?> <spam id="div_momeda1">Bs.</spam></td>
                            
                       </tr>     
                        <tr>
                            <td colspan='3'>Nro Dias: <div id="div_nd"></div><div id="div_momeda2"></div></td>
                       </tr>     
                       <tr>
                            <td colspan='3'>% Viaticos: <div id="div_pv"></div></td>
                       </tr>
                        <tr>    
                            <td>TOTAL VIATICOS: <div id="div_tv"></div><div id="div_momeda3"></div></td>
                            <td>GASTOS DE REPRESENTACION: <div id="div_gr"></div><div id="div_momeda4"></div></td>
                            <td>TOTAL PASAJES: <div id="div_tp"></div><div id="div_moneda5"></div></td>
                        </tr>
                    </table>
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
    <div id="poa">
        poa
    </div>
    <div id="pre">
        presupuesto
    </div>
</div>