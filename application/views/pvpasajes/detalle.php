<script type="text/javascript">

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
    //var dia_s = fecha_s.substring(0, 3);
    fecha_s = fecha_s.substring(4, 14);
    var fecha_a = $("#fecha_arribo").val();
    //var dia_a = fecha_a.substring(0, 3);
    fecha_a = fecha_a.substring(4, 14);
    //calculo de viaticos
    if(fecha_s != '' && fecha_a !='') {
        var fecha2 = fecha_a.replace(/-/g, '/');
        var fecha1 = fecha_s.replace(/-/g, '/');
        var diferencia =  Math.floor(( Date.parse(fecha2) - Date.parse(fecha1) ) / 86400000);
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
calculo_dias();
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
//calcular el numero de dias
/*$fecha1 = strtotime($pvfucov->fecha_salida);
$fecha2 = strtotime($pvfucov->fecha_arribo);
$diff =  $fecha2 - $fecha1;//echo 'DIFF.: '.$diff.'<br />';
if($diff < 0)
    $diff = $diff*(-1);
$hora = date('H:i:s', strtotime($pvfucov->fecha_arribo));
if ($diff==0)
    $dias = 1;
else{
    $dias = intval((($diff) / (60*60*24))+1);
    if (strcasecmp($hora, '12:00:00') != 0) {
        if(strcasecmp($hora, '12:00:00') > 0)
            $dias ++;
    }
}*/
    if($pvfucov->tipo_moneda == '0')
        $moneda = 'Bs.';
    else
        $moneda = '$us.';
?>
<input type="hidden" id="id_fucov" value="<?php echo $pvfucov->id;?>" />
<h2 style="text-align: center;"> PASAJES Y VI&Aacute;TICOS</h2>
        <div class="formulario">
            <div id="comision" style="border-bottom: 1px solid #ccc; background: #F2F7FC; display: block; padding: 10px 0;   width: 100%;">
                <form action="/pvpasajes/editarfucov/<?php echo $pvfucov->id; ?>" method="post" id="frmEditarFucov" >
                INFORMACI&Oacute;N DE LA COMISI&Oacute;N:<br />
                <?php echo Form::hidden('representacion',$pvfucov->representacion,array('id'=>'representacion','name'=>'representacion'));?>
                <?php echo Form::hidden('impuesto',$pvfucov->impuesto,array('id'=>'impuesto','name'=>'impuesto'));?>
                        <table border="1px" width="100%">
                            <tr>
                                <td>Fecha y Hora de Inicio</td>
                                <td><?php echo Form::input('fecha_salida',$diai.' '.$fi,array('id'=>'fecha_salida','size'=>14,'class' => 'required'))?><?php echo Form::input('hora_salida',$hi,array('id'=>'hora_salida','size'=>12,'class' => 'required'))?><br /></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Fecha y Hora de Conclusi&oacute;n:</td>
                                <td><?php echo Form::input('fecha_arribo',$diaf.' '.$ff,array('id'=>'fecha_arribo','size'=>14,'class' => 'required'))?><?php echo Form::input('hora_arribo',$hf,array('id'=>'hora_arribo','size'=>12,'class' => 'required'))?><br /></td>
                                <td><input type="submit" value="Modificar Comision" class="uibutton" name="submit" id="crear" title="Modificar"/></td>                    
                            </tr>
                        </table>
                <br />
                <hr />
                <br />
                <table border="1" width="100%">
                    <tr>
                        <td>Nro Dias</td>
                        <td>Viaticos</td>
                        <td>Viatico x Dia</td>
                        <td>Total Vi&aacute;ticos</td>
                        <td>IVA 13 %: </td>
                        <td>Gastos Representaci&oacute;n:</td>
                        <td>Cambio</td>
                        <td>Total Pasajes</td>
                    </tr>
                    <tr>
                        <td><?php echo Form::input('nro_dias', /*$dias*/'', array('id' => 'nro_dias', 'size' => 3,'readonly')) ?></td>
                        <td><?php echo Form::input('porcentaje_viatico', $pvfucov->porcentaje_viatico, array('id' => 'porcentaje_viatico', 'size' => 3,'readonly')) ?> %</td>
                        <td><?php echo Form::input('viatico_dia', $pvfucov->viatico_dia, array('id' => 'viatico_dia', 'size' => 5,'readonly'));echo $moneda;?> </td>
                        <td><?php echo Form::input('total_viatico', $pvfucov->total_viatico, array('id' => 'total_viatico', 'size' => 8,'readonly'));echo $moneda; ?></span></td>
                        <td><?php echo Form::input('gasto_imp', $pvfucov->gasto_imp, array('id' => 'gasto_imp', 'size' => 8,'readonly'));echo $moneda;?></td>
                        <td><?php echo Form::input('gasto_representacion', $pvfucov->gasto_representacion, array('id' => 'gasto_representacion', 'size' => 8,'readonly')); echo $moneda;?></td>
                        <td><?php echo Form::input('tipo_cambio', $tipo_cambio->cambio_venta, array('id' => 'tipo_cambio', 'size' => 3,'readonly'));echo $moneda; ?></td>
                        <td><?php echo Form::input('total_pasaje', $pvfucov->total_pasaje, array('id' => 'total_pasaje', 'size' => 8,'class'=>'required'));echo $moneda; ?></td>
                    </tr>
                </table>
                </form>
            </div>
        </div>
            <br />
    <!--<div id="asignar" style="margin:10px 0; padding: 1px; background-color:#EFF4FA; border: 1px solid #000000; width: 85px;" >+ Asignar Pasaje</div>-->
    <button id="asignar"> + Asignar Pasaje</button>
    <br />
    <div id="pasajes" class="formulario" hidden="true" >
        <form action="/pvpasajes/adicionarpasaje/<?php echo $pvfucov->id; ?>" method="post" id="frmAdicionar" >
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
                                    <td><?php echo Form::input('origen','',array('id'=>'origen','size'=>'11','class'=>'required'));?></td>
                                    <td><?php echo Form::input('destino','',array('id'=>'destino','size'=>'11','class'=>'required'));?></td>
                                    <td><?php echo Form::input('fecha_ida',dia_literal(date("w")).' '.date("Y-m-d"),array('id'=>'fecha_ida','size'=>'14','class'=>'required'));?><br /> <?php echo Form::input('hora_ida','00:00:00',array('id'=>'hora_ida','size'=>'10','class'=>'required'));?></td>
                                    <td><?php echo Form::input('fecha_llegada',dia_literal(date("w")).' '.date("Y-m-d"),array('id'=>'fecha_llegada','size'=>'14','class'=>'required'));?><br /><?php echo Form::input('hora_llegada','00:00:00',array('id'=>'hora_llegada','size'=>'10','class'=>'required'));?></td>
                                    <td><?php echo Form::select('transporte',array('Aereo'=>'Aereo','Terrestre'=>'Terrestre','Vehiculo Oficial'=>'Vehiculo Oficial'),'',array('id'=>'transporte'));?></td>
                                    <td><?php echo Form::input('nro_boleto','',array('id'=>'nro_boleto','size'=>'3','class'=>'required'));?></td>
                                    <td><?php echo Form::input('costo','',array('id'=>'costo','size'=>'3','class'=>'required'));?></td>
                                    <td><?php echo Form::input('empresa','',array('id'=>'empresa','size'=>'5','class'=>'required'));?></td>
                                </tr>
                                <tr>
                                    <td colspan="8" style="text-align: center;"><button id="adicionar">Adicionar</button><button id="cancelar" class="uibutton">Cancelar</button></td>
                                </tr>
                        </table>
                    <?php endif;?>
                <?php endif;?>
        </form>
    </div>
        <br />                   
        <?php if(sizeof($pasajes)>0):?> 
            <div id="asignados" class="formulario" >
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
                            <th>OPCIONES</th>
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
                            <td><a href="/pvpasajes/eliminarpasaje/<?php echo $p->id?>" class="eliminar">Eliminar</a></td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                
                <br />
                <?php else:?>
                <div id="msg3" class="info2">
                <b>!!!NO HAY PASAJES ASIGNADOS.</b>
                </div>
                <br />
                <?php endif?>
    <center>
        <a href="/pdf/fucov.php?id=<?php echo $pvfucov->id_documento; ?>" class="link pdf" target="_blank" title="Imprimir PDF" >PDF</a>
        <?php if($pvfucov->etapa_proceso == 0):?>
             <div id="msg4" class="info2"><b>!!!EL FUCOV NO FUE LLENADO POR EL FUNCIONARIO EN COMISION.</b></div>
        <?php endif;?>
        <?php if($pvfucov->etapa_proceso == 1):?>
        <a href="/pvpasajes/autorizarfucov/<?php echo $pvfucov->id; ?>" class="autorizar"  title="Autorizar FUCOV" ><img src="/media/images/tick.png"/>Autorizar FUCOV</a>
        <?php endif;?>
        <?php if($pvfucov->etapa_proceso == 2):?>
            <a href="/hojaruta/derivar/?id_doc=<?php echo $pvfucov->id_memo; ?>" class="link derivar" title="Derivar a partir del documento, si ya esta derivado muestra el seguimiento" >Derivar</a>
        <?php endif;?>
    </center>
<br />
<br />
&nbsp;

                