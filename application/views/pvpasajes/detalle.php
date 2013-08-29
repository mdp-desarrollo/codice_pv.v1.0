<script type="text/javascript">
function ajaxs(control)
{   
    //control = $('#asignados');
    var id_fucov = $('#id_fucov').val();
    var origen = $('#origen').val();
    var destino = $('#destino').val();
    var fecha_salida = $('#fecha_salida').val();
    var hora_salida = $('#hora_salida').val();
    var fecha_arribo = $('#fecha_arribo').val();
    var hora_arribo = $('#hora_arribo').val();
    fecha_salida = fecha_salida.substr(4,10)+' '+hora_salida;
    fecha_arribo = fecha_arribo.substr(4,10)+' '+hora_arribo;
    var transporte = $('#transporte').val();
    var nro_boleto = $('#nro_boleto').val();
    var costo = $('#costo').val();
    var empresa = $('#empresa').val();
    $.ajax({
	    type: "POST",
	    data: { id_fucov:id_fucov, origen: origen, destino: destino, fecha_salida: fecha_salida, fecha_arribo:fecha_arribo, transporte:transporte, nro_boleto: nro_boleto, costo:costo, empresa:empresa},
	    url: "/pvajax/adicionpasaje",
        dataType: "json",
        success: function(item)
        {
            //$(control).html(item);
            $('#asignados').html(item);
        },
    });
}
$(function(){
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
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''};
$.datepicker.setDefaults($.datepicker.regional['es']);

 var pickerOpts = { changeMonth: true, minDate: 0, changeYear: true, yearRange: "-10:+1", dateFormat: 'D yy-mm-dd'};
    $('#fecha_inicio, #fecha_fin,#fecha_salida,#fecha_arribo').datepicker(pickerOpts,$.datepicker.regional['es']);
    $('#hora_salida,#hora_arribo').timeEntry({show24Hours: true, showSeconds: true});
    
    $('#adicionar').click(function(){
        $("#asignados_inicial").hide();
        ctrl = $('#asignados');
        ajaxs(ctrl);
        $('#origen, #destino, #nro_boleto, #costo, #empresa').val('');
    });
    
});
</script>
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
<input type="hidden" id="id_fucov" value="<?php echo $pvfucov->id;?>" />
<h2 style="text-align: center;"> PASAJES Y VI&Aacute;TICOS</h2>
        <div class="formulario">
            <div style="border-bottom: 1px solid #ccc; background: #F2F7FC; display: block; padding: 10px 0;   width: 100%;">
                INFORMACI&Oacute;N DE LA COMISI&Oacute;N:<br />
                    
                        <table border="0px">
                            <tr>
                                <td>Fecha y Hora de Inicio</td>
                                <td><?php echo Form::input('fecha_inicio',$diai.' '.$fi,array('id'=>'fecha_inicio','size'=>14,'class' => 'required'))?><?php echo Form::input('hora_salida',$hi,array('id'=>'hora_salida','size'=>12,'class' => 'required'))?><br /></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Fecha y Hora de Conclusi&oacute;n:</td>
                                <td><?php echo Form::input('fecha_fin',$diaf.' '.$ff,array('id'=>'fecha_fin','size'=>14,'class' => 'required'))?><?php echo Form::input('hora_arribo',$hf,array('id'=>'hora_arribo','size'=>12,'class' => 'required'))?><br /></td>
                                <td><button id="modificar_comision" class="uibutton">Modificar Comision</button></td>                    
                            </tr>
                        </table>
            </div>
        </div>
            <br />
                <!--<button id="asignar" class="uibutton">+Asignar Pasaje</button>-->
                <div id="pasajes" class="formulario" >
                <b>ADICIONAR PASAJES:</b>
                    <?php if($estado == 2):?>
                        <?php if( $pvfucov->etapa_proceso == 1 || $pvfucov->etapa_proceso == 2):?>
                            <br />
                            <table id="x_tableMeta" class="classy" border="1">
                                <thead>
                                    <th>ORIGEN</th>
                                    <th>DESTINO</th>
                                    <th>FECHA Y HORA<br /> DE SALIDA</th>
                                    <th>FECHA Y HORA<br /> DE ARRIBO</th>
                                    <th>TRANSPORTE</th>
                                    <th>N. BOLETO</th>
                                    <th>COSTO</th>
                                    <th>EMPRESA</th>
                                </thead>
                                    <tr>
                                        <td><?php echo Form::input('origen','',array('id'=>'origen','size'=>'12'));?></td>
                                        <td><?php echo Form::input('destino','',array('id'=>'destino','size'=>'12'));?></td>
                                        <td><?php echo Form::input('fecha_salida',dia_literal(date("w")).' '.date("Y-m-d"),array('id'=>'fecha_salida','size'=>'15'));?><br /> <?php echo Form::input('hora_salida',date("h:m:s"),array('id'=>'hora_salida','size'=>'10'));?></td>
                                        <td><?php echo Form::input('fecha_arribo',dia_literal(date("w")).' '.date("Y-m-d"),array('id'=>'fecha_arribo','size'=>'15'));?><br /><?php echo Form::input('hora_arribo',date("h:m:s"),array('id'=>'hora_arribo','size'=>'10'));?></td>
                                        <td><?php echo Form::select('transporte',array('Aereo'=>'Aereo','Terrestre'=>'Terrestre','Vehiculo Oficial'=>'Vehiculo Oficial'),'',array('id'=>'transporte'));?></td>
                                        <td><?php echo Form::input('nro_boleto','',array('id'=>'nro_boleto','size'=>'5'));?></td>
                                        <td><?php echo Form::input('costo','',array('id'=>'costo','size'=>'5'));?></td>
                                        <td><?php echo Form::input('empresa','',array('id'=>'empresa','size'=>'8'));?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="8" style="text-align: center;"><button id="adicionar">Adicionar</button><!--<button id="cancelar" class="uibutton">Cancelar</button>--></td>                                        
                                    </tr>                                    
                            </table>
                        <?php endif;?>
                    <?php endif;?>
                </div>
                <br />
                                 
                <?php //if(sizeof($pasajes)>0):?> 
                <div id="asignados_inicial" class="formulario" >
                <b>LISTA DE PASAJES ASIGNADOS:</b><br />
                    <table class="classy">
                        <thead>
                            <th>TRAMO</th>
                            <th>ORIGEN</th>
                            <th>DESTINO</th>
                            <th>FECHA Y HORA<br /> DE SALIDA</th>
                            <th>FECHA Y HORA<br /> DE ARRIBO</th>
                            <th>TRANSPORTE</th>
                            <th>N. BOLETO</th>
                            <th>COSTO</th>
                            <th>EMPRESA</th>
                        </thead>
                        <tbody>
                        <?php $c=1; foreach($pasajes as $p):?>
                        <tr>
                            <td><?php echo $c; $c++;?></td>
                            <td><?php echo $p->origen;?></td>
                            <td><?php echo $p->destino;?></td>
                            <td><?php echo $p->fecha_salida;?></td>
                            <td><?php echo $p->fecha_arribo;?></td>
                            <td><?php echo $p->transporte;?></td>
                            <td><?php echo $p->nro_boleto;?></td>
                            <td><?php echo $p->costo;?></td>
                            <td><?php echo $p->empresa;?></td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                
                <br />
                <?php /*else:?>
                A&Uacute;N NO HA ASIGNADO PASAJES<br />
                <br />
                <?php endif;*/ ?>
            
                <div id="asignados"></div>
   <!--
<br />
<br />
    <input type="submit" value="Autorizar" class="uibutton" name="submit" id="crear" title="Autorizar"/>
    <?php if($pvfucov->etapa_proceso == 2):?>
        <a href="/hojaruta/derivar/?id_doc=<?php echo $pvfucov->id_memo; ?>" class="link derivar" title="Derivar a partir del documento, si ya esta derivado muestra el seguimiento" >Derivar</a>
    <?php endif;?>
                -->