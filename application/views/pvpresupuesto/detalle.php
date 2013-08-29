<script type="text/javascript">
/*
function calculo_viaticos(){
    var porcentaje = $("#porcentaje_viatico").val();
    var impuesto = $("input[name='impuesto']:checked").val(); //impuesto iva
    var representacion = $("input[name='representacion']:checked").val(); 
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
            var total_viatico=parseFloat(monto_parcial)+parseFloat(gastos_rep)-parseFloat(desc_iva);
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
});*/

$(function(){
    $('#fuente').change(function(){
        ajaxppt();
    });
    function ajaxppt()
    {
        var id = $('#fuente').val();
        control = $('#saldoppt');
        if(id){
            var pasaje = $('#total_pasaje').val();
            var viatico = $('#total_viatico').val();
            var viaje = $('#id_tipoviaje').val();
            var gasto = $('#gasto_representacion').val();
            $.ajax({
                type: "POST",
                data: { id: id, pasaje:pasaje, viatico:viatico, viaje:viaje, gasto:gasto},
                url: "/pvajax/pptdisponibleuser",
                dataType: "json",
                success: function(item)
                {
                    $(control).html(item);
                },
                error: $(control).html('Error'),
                });
        }
        else
            control.html('NO HAY FUENTE DE FINANCIMIENTO SELECCIONADA.');
    }
    
    $('#frmEditarFucov').validate();
});
</script>
<?php /*
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
$fecha1 = strtotime($pvfucov->fecha_salida);
$fecha2 = strtotime($pvfucov->fecha_arribo);
$diff =  $fecha2 - $fecha1;
$hora = date('H:i:s', strtotime($pvfucov->fecha_arribo));
if ($diff==0)
    $dias = 1;
else{
    if($hora >'12:00:00')
        $dias = intval((($diff) / (60*60*24))+2);

    else
        $dias = intval((($diff) / (60*60*24))+1);    
}*/
    if($pvfucov->tipo_moneda == '0')
        $moneda = 'Bs.';
    else
        $moneda = 'Us.';
?>
<input type="hidden" id="id_fucov" value="<?php echo $pvfucov->id;?>" />
<h2 style="text-align: center;"> PRESUPUESTO</h2>
        <div class="formulario">
TOTAL PASAJES: <?php echo Form::input('total_pasaje', $pvfucov->total_pasaje, array('id' => 'total_pasaje', 'size' => 8,'readonly')); echo $moneda; ?><br />
TOTAL VIATICOS: <?php echo Form::input('total_viatico', $pvfucov->total_viatico, array('id' => 'total_viatico', 'size' => 8,'readonly')); echo $moneda; ?><br />
GASTO REP: <?php echo Form::input('gasto_representacion', $pvfucov->gasto_representacion, array('id' => 'gasto_representacion', 'size' => 8,'readonly')); echo $moneda; ?><br />
<?php echo Form::hidden('id_tipoviaje', $pvfucov->id_tipoviaje, array('id' => 'id_tipoviaje', 'size' => 8,'readonly'))?><br />
    <form id="frmEditarFucov" action="/pvpresupuesto/editarfucov/<?php echo $pvfucov->id;?>" method="post">
        <div style="border-bottom: 1px solid #ccc; background: #F2F7FC; display: block; padding: 10px 0;   width: 100%;  ">
        <hr/>
            <fieldset>
                <table>
                    <tr>
                        <td>Fuentes de Financiamiento:<?php echo Form::select('fuente', $fuente, $pvfucov->id_programatica, array('id' => 'fuente', 'class' => 'required')) ?></td> 
                        <td><input type="submit" value="Actualizar Fucov" class="uibutton" name="submit" id="crear" title="Actualizar"/></td>
                    </tr>
                </table>
            </fieldset>
        </div>
    </form>
    <div id="saldoppt"><?php echo $partidasgasto; ?></div>
        </div>
    
    <?php if($pvfucov->etapa_proceso == 2):?>
    <a href="/pvpresupuesto/autorizarfucov/<?php echo $pvfucov->id; ?>" class="link derivar" title="Autorizar FUCOV" >Autorizar FUCOV</a>
    <?php endif;?>
    <?php if($pvfucov->etapa_proceso == 3):?>
        <a href="/hojaruta/derivar/?id_doc=<?php echo $pvfucov->id_memo; ?>" class="link derivar" title="Derivar a partir del documento, si ya esta derivado muestra el seguimiento" >Derivar</a>
    <?php endif;?>
<br />
<br />
&nbsp;
