<script type="text/javascript">
/*
function calculo_viaticos(){
    var porcentaje = $("#porcentaje_viatico").val();
    var impuesto = $("#impuesto").val(); //impuesto iva
    var representacion = $("#representacion").val(); 
    var viatico_dia = $('#viatico_dia').val();
    var nro_dias = $('#nro_dias').val();
//calculo
    var monto_parcial = ((parseFloat(porcentaje)*parseFloat(viatico_dia))/100)*parseFloat(nro_dias);
    var desc_iva=0;
    if(impuesto == 'Si'){
        desc_iva = (13*parseFloat(monto_parcial))/100;
    }
    var gastos_rep=0;
            if(representacion == 'Si'){
                gastos_rep = (25*parseFloat(monto_parcial))/100;
            }
            var total_viatico=parseFloat(monto_parcial)-parseFloat(desc_iva);
            $('#gasto_imp').val(desc_iva.toFixed(2));
            $('#gasto_representacion').val(gastos_rep.toFixed(2));
            $('#total_viatico').val(total_viatico.toFixed(2));
            //$("#porcentaje_viatico").val(porcentaje);
    }
    
    
    
function calculo_dias(){
    var fecha_s = $("#fecha_salida").val();
    var dia_s = fecha_s.substring(0, 3);
    fecha_s = fecha_s.substring(4, 14);
    var fecha_a = $("#fecha_arribo").val();
    var dia_a = fecha_a.substring(0, 3);
    fecha_a = fecha_a.substring(4, 14);
    //calculo de viaticos
    if(fecha_s != '' && fecha_a !='') {
        var diferencia =  Math.floor(( Date.parse(fecha_a) - Date.parse(fecha_s) ) / 86400000);
        if(diferencia >= 0){
            if(diferencia == 0){
                diferencia = 1;
            } else {
                if($("#hora_arribo").val()>'12:00:00'){
                    diferencia +=1;
                }
            }
            $('#nro_dias').val(diferencia);
        }
        else{
            alert('la fecha de salida no puede ser mayor a la fecha de arribo.');
            $('#fecha_salida').val($('#fecha_arribo').val());
            $('#nro_dias').val(1);
        }
    }
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

 var pickerOpts = { changeMonth: true, minDate: 0, changeYear: true, yearRange: "-10:+1", dateFormat: 'D yy-mm-dd',onSelect: function(){ calculo_dias();calculo_viaticos();}};
    $('#fecha_ida, #fecha_llegada,#fecha_salida,#fecha_arribo').datepicker(pickerOpts,$.datepicker.regional['es']);
    $('#hora_ida,#hora_llegada,#hora_salida,#hora_arribo').timeEntry({show24Hours: true, showSeconds: true});
    
    $("#hora_salida, #hora_arribo").keydown(function(event) {    
        calculo_dias();    
        calculo_viaticos();
    });
    $('#asignar').click(function(){
       $('#asignar').hide();
       $('#pasajes').show();
       $('#asignados').hide();
    });
    
    $('#cancelar').click(function(){
       $('#asignar').show();
       $('#pasajes').hide();
       $('#asignados').show();
       $('#origen,#destino,#nro_boleto,#costo,#empresa').val('');
       return false;
    });
    
    $('#frmEditarFucov').validate();
    $('#frmAdicionar').validate();
    $('#frmAutorizar').validate();
    
    $('.autorizar').live('click', function() {
        var answer = confirm("Esta seguro de Autorizar el FUCOV? ")
        if (answer)
            return true;
        return false;
});
    $('.eliminar').live('click', function() {
        var answer = confirm("Esta seguro de Eliminar el Pasaje? ")
        if (answer)
            return true;
        return false;
    });
    
});*/
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
//calcular el numero de dias
/*$fecha1 = strtotime($pvfucov->fecha_salida);
$fecha2 = strtotime($pvfucov->fecha_arribo);
$diff =  $fecha2 - $fecha1;
if($diff <0)
    $diff = $diff*-1;
$hora = date('H:i:s', strtotime($pvfucov->fecha_arribo));
if ($diff==0)
    $dias = 1;
else{
    if($hora >'12:00:00')
        $dias = intval((($diff) / (60*60*24))+1);
    else
        $dias = intval((($diff) / (60*60*24))+0);
}
*/
    $fi = date('Y-m-d', strtotime($pvfucov->fecha_salida));
    $ff = date('Y-m-d', strtotime($pvfucov->fecha_arribo));
    $fecha1 = strtotime($fi);
        $fecha2 = strtotime($ff);
        $diff =  $fecha2 - $fecha1;
        if($diff < 0)
            $diff = $diff*(-1);
        if ($diff==0)
            $dias = 1;
        else{
            $dias = intval((($diff) / (60*60*24)));
            if (strcasecmp($hf, '12:00:00') != 0) {
                if(strcasecmp($hf, '12:00:00') > 0)
                    $dias ++;
            }
        }

    if($pvfucov->tipo_moneda == '0')
        $moneda = 'Bs.';
    else
        $moneda = '$us.';
?>
<input type="hidden" id="id_fucov" value="<?php echo $pvfucov->id;?>" />
<div style="width: 800px;">
            <div id="comision" style="border-bottom: 1px solid #ccc; background: #FCFCFC; display: block; padding: 10px 0;   width: 100%;">
                <a href="/pdf/fucov.php?id=<?php echo $pvfucov->id_documento; ?>" class="link pdf" target="_blank" title="Imprimir PDF" >PDF</a>
                <!--<form action="/pvpasajes/editarfucov/<?php echo $pvfucov->id; ?>" method="post" id="frmEditarFucov" >-->
                <h2 style="text-align: center;"> PASAJES Y VI&Aacute;TICOS</h2>
                <br /><hr /><br />
                <table border ="0" width="100%">
                    <tr>
                        <td><b>Autoriza el Viaje:</b></td>
                        <td colspan="2"><?php echo $memo->nombre_remitente;?><br/><b><?php echo $memo->cargo_remitente;?></b></td>
                    </tr>
                    <tr> 
                        <td><b>Funcionario en Comisi&oacute;n:</b><br/> </td>
                        <td colspan="2"><br /><?php echo $memo->nombre_destinatario;?><br/><b><?php echo $memo->cargo_destinatario;?></b></td>
                    </tr>
                    <tr> 
                        <td><b>Fecha de Creación:</b><br/> </td>
                        <td colspan="2"><br /><?php echo Date::fecha($memo->fecha_creacion);?></td>
                    </tr>
                    <tr> 
                        <td><b>Referencia:</b><br/> </td>
                        <td colspan="2"><br /><?php echo $memo->referencia;?></td>
                    </tr>
                    <tr>
                        <td colspan="3"><br /><hr /><br /></td>
                    </tr>
                    <tr> 
                        <td colspan="3">
                    <center><b><h2>INFORMACION DE LA COMISI&Oacute;N</h2></b></center>
                            <table border="0" width="100%" class="classy" >
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">Orígen</th>
                                        <th style="text-align:center;">Destino</th>
                                        <th style="text-align:center;">Fecha y Hora <br>Salida</th>
                                        <th style="text-align:center;">Fecha y Hora <br>Retorno</th>
                                        <th style="text-align:center;">Transporte</th>
                                        <th style="text-align:center;">Viaticos</th>
                                        <th style="text-align:center;">Desc. IVA</th> 
                                        <th style="text-align:center;">Gastos<br>Repres.</th>

                                    </tr>
                                </thead>
                                <?php
                                if ($pvfucov->cancelar == 'Hospedaje y alimentacion' || $pvfucov->cancelar == 'Hospedaje') {
                                    $cancelar = "<b>Financiado por:</b><br>" . $pvfucov->financiador . "<br><br> * " . $pvfucov->cancelar;
                                } else {
                                    $cancelar = "* " . $pvfucov->cancelar;
                                }

                                $tipo_moneda="Bs.";
                                if($pvfucov->tipo_moneda==1){
                                    $tipo_moneda='$us.';
                                }


                                ?>
                                <tbody>
                                    <tr style="text-align:center">
                                        <td><?php echo $pvfucov->origen ?></td>
                                        <td><?php echo $pvfucov->destino ?></td>
                                        <td><?php echo $diai . ' ' . $fi; ?> <br><?php echo $hi ?></td>
                                        <td><?php echo $diaf . ' ' . $ff; ?> <br><?php echo $hf ?></td>
                                        <td><?php echo $pvfucov->transporte ?></td>
                                        <td><?php echo $cancelar ?></td>
                                        <td><?php echo $pvfucov->impuesto ?></td>
                                        <td><?php echo $pvfucov->representacion ?></td>

                                    </tr>
                                </tbody>

                            </table>
                            <table width="100%">
                                <?php  if ($pvfucov->justificacion_finsem != '') {?> 
                                <tr><td colspan="2" style="padding-left: 5px;"><br><b>Justificacion Fin de Semana:</b><br><?php echo $pvfucov->justificacion_finsem; ?></td></tr>
                                <?php } ?>

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><br /><hr /><br /></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                        <center><b><h2>CÁLCULO DE VIATICOS</h2></b></center>
                            <table border="0" width="100%" class="classy">
                                <thead>
                                    <th>Nro Dias</th>
                                    <th>Viaticos</th>
                                    <th>Viatico x Dia</th>
                                    <th>Total Vi&aacute;ticos</th>
                                    <th>Desc. IVA 13 %: </th>
                                    <th>Gasto Rep</th>
                                    <!--<th>Cambio</th>-->
                                    <th>Total Pasajes</th>
                                </thead>
                                <tbody>
                                    <tr style="text-align:center">
                                        <td><?php echo $dias?></td>
                                        <td><?php echo $pvfucov->porcentaje_viatico?> %</td>
                                        <td><?php echo $pvfucov->viatico_dia?> </td>
                                        <td><?php echo $pvfucov->total_viatico.' '.$moneda; ?></span></td>
                                        <td><?php echo $pvfucov->gasto_imp.' '.$moneda;?></td>
                                        <td><?php echo $pvfucov->gasto_representacion.' '.$moneda;?></td>
                                        <!--<td><?php //echo Form::input('tipo_cambio', $tipo_cambio->cambio_venta, array('id' => 'tipo_cambio', 'size' => 3,'readonly'));echo $moneda; ?></td>-->
                                        <td><?php echo $pvfucov->total_pasaje.' '.$moneda; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><br /><hr /><br /></td>
                    </tr>
                    <!--<tr>    
                        <td><b>TOTAL VIATICOS:</b> <?php echo $pvfucov->total_viatico .' '. $tipo_moneda; ?></td>
                            <td width="300"><b>GASTOS DE REPRESENTACIÓN:</b> <?php echo $pvfucov->gasto_representacion .' '. $tipo_moneda; ?></td>    
                            <td><b>TOTAL PASAJES:</b> <?php echo $pvfucov->total_pasaje .' '. $tipo_moneda; ?></td>
                    </tr>
                    <tr>
                            <td colspan="3" style="padding-left: 5px;"><b>% Viaticos: </b><?php echo $pvfucov->porcentaje_viatico ?> %</td>
                    </tr>
                    <tr>
                            <td colspan="3" style="padding-left: 5px;"><b>Viatico x Dia:</b> <?php echo $pvfucov->viatico_dia .' '. $tipo_moneda; ?> </td>
                    </tr>     
                    <tr>
                            <td colspan="3" style="padding-left: 5px;"><b>Descuento IVA 13 %:</b> <?php echo $pvfucov->gasto_imp .' '. $tipo_moneda; ?></td>
                    </tr> 
                    <tr>
                        <td colspan="3"><br /><hr /><br /></td>
                    </tr>-->
                    <tr>
                        <td colspan="3">
                        <center><b><h2>LISTA DE PASAJES ASIGNADOS:</h2></b></center>
                            <?php if(sizeof($pvpasajes)>0):?>
                                    <table class="classy" border="0">
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
                                            <!--<th>OPCIONES</th>-->
                                        </thead>
                                        <tbody>
                                        <?php $c=1; foreach($pvpasajes as $p):?>
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
                                            <!--<td><a href="/pvpasajes/eliminarpasaje/<?php echo $p->id?>" class="eliminar">Eliminar</a></td>-->
                                        </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>

                                <?php else:?>
                                <div id="msg3" class="info2">
                                <b>!!!NO HAY PASAJES ASIGNADOS.</b>
                                </div>
                                <br />
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
                <br />
            <div class="info" style="text-align:center;margin-top: 20px;">
                <p><span style="float: left; margin-right: .3em;" class=""></span>    
                &larr;<a onclick="javascript:history.back(); return false;" href="#" style="font-weight: bold; text-decoration: underline;  " > Regresar<a/></p>    
            </div>
                <!--</form>-->
        </div>
</div>


                