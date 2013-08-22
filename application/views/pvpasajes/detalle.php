<script type="text/javascript">
/*
function validar(){
    
    if(('#financiamiento').val() == 100) {        
        var answer = confirm("Para "+$('#autorizar').html()+" el Documento haga clic en Aceptar");
            if (answer)
                $('#frmAutorizar').submit();
            else
                return false;
    }
    else
        alert('No ha Asignado Pasajes');
}

function calcular(id,ctrl){
    if ( ctrl == 'fechaIda' || ctrl == 'fechaRet' || ctrl == 'harribo')
    {    
        var fecha1 = $('#fechaSalidaIda').val();
        var fecha2 = $('#fechaArriboRet').val();
        var diferencia =  Math.floor(( Date.parse(fecha2) - Date.parse(fecha1) ) / 86400000);        
        if(diferencia < 0) {diferencia = diferencia*(-1);}
        if(diferencia == 0)
            diferencia = 1;
        else{
            if($('#horaArriboRet').val()>'12:00:00')
                diferencia += 1;
        }
        $('#dias_cal').val(diferencia);
    }
    var viaticos = parseFloat($("#viaticoDia").val());
    var dias = $("#dias_cal").val();        
    var factor = $('#porcentaje').val();                          
        $("#totalViaticos").val((viaticos * dias * factor) /100);    
}
*/
$(function(){/*
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
            yearSuffix: ''};
$.datepicker.setDefaults($.datepicker.regional['es']);
var pickerOpts2 = { changeMonth: true, minDate: 0, changeYear: true, yearRange: "-10:+1", dateFormat: 'yy-mm-dd',onSelect: function(){ var id = $("#fechaSalidaIda").val(); calcular(id,'fechaIda');}};
var pickerOpts3 = { changeMonth: true, minDate: 0, changeYear: true, yearRange: "-10:+1", dateFormat: 'yy-mm-dd',onSelect: function(){ var id = $("#fechaArriboRet").val(); calcular(id,'fechaRet');}};
$("#fechaSalidaIda").datepicker(pickerOpts2,$.datepicker.regional['es']);
$("#fechaArriboRet").datepicker(pickerOpts3,$.datepicker.regional['es']);

$("#fechaSalidaIda,#fechaArriboRet,#dias_cal,#viaticoDia,#cambio").keydown(function(event) {
    return false;});

$("#horaArriboRet").change(function(){
    id = $("#horaArriboRet").val();
    calcular(id,'harribo');    
});    

$("#costoIda,#costoRet").keydown(function(event) {
    if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 ||
        (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode >= 35 && event.keyCode <= 39) || (event.keyCode == 110 || event.keyCode == 190) ) {
            return;
        }
        else {
        
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) ) {
                event.preventDefault();
            }
        }   
});

$("#costoIda,#costoRet").blur(function(){
    var ida = parseFloat($("#costoIda").val());
    var ret = parseFloat($("#costoRet").val());
    if(!ida || ida < 0) ida = 0;
    if(!ret || ret < 0) ret = 0;
    $("#pasajeIda").val(ida);$("#costoIda").val(ida);
    $("#pasajeRetorno").val(ret);$("#costoRet").val(ret);
    $("#totalPasajes").val(ida + ret);
});
*/

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
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''};
$.datepicker.setDefaults($.datepicker.regional['es']);

var pickerOpts = { changeMonth: true, minDate: 0, changeYear: true, yearRange: "-10:+1", dateFormat: 'yy-mm-dd'};
$('#fechasalida,#fechaarribo').datepicker(pickerOpts,$.datepicker.regional['es']);
$('#horasalida,#horaarribo').timeEntry({show24Hours: true, showSeconds: true});
$('#frmAsignar').validate();
});
</script>
<style>
    #file-word{ display: none;  }
    td{padding:5px;}    
</style>
<div style="text-align:rigth;margin-top: 5px; margin-bottom: 15px;">
<!--<a href="/pyvpasajes/autorizados" class="uibutton" title="Solicitudes Autorizadas" ><img src="/media/images/print.png"/>Solicitudes Autorizadas</a>-->
</div>
<h2>PASAJES Y VI&Aacute;TICOS</h2>
<br />
<?php if(sizeof($pasajes)>0):?> 
    <h2>Pasajes Asignados:</h2>
    <table>
        <thead>
            <td>Empresa</td>
            <td>Nro. Boleto</td>
            <td>Fecha Salida</td>
            <td>Fecha Arribo</td>
        </thead>
        <tbody>
        <?php foreach($pasajes as $p):?>
        <tr>
            <td><?php echo $p['empresa']?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
<?php else:?>
    <h2>No hay Pasajes Asignados</h2>
<?php endif;?>
<?php if($estado == 2):?>
    <?php if( $fucov->etapa_proceso == 0 || $fucov->etapa_proceso == 2):?>
        <form action="/pvpasajes/asignarpasaje/<?php echo $fucov->id;?>" method="post" id="frmAsignar">
            <br />
            <h2>Asignación de Pasajes</h2>
            <table width="100%" border="1px" >
                <thead>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Fecha y Hora de Salida</th>
                    <th>Fecha y Hora de Arribo</th>
                    <th>Transporte</th>
                    <th>Nro. Boleto</th>
                    <th>Costo</th>
                    <th>Empresa</th>
                </thead>
                <tbody>
                    <tr>
                    <td><?php echo Form::input('origen','',array('class'=>'form','id'=>'origen','size'=>'15','class'=>'required'))?></td>
                    <td><?php echo Form::input('destino','',array('class'=>'form','id'=>'destino','size'=>'15','class'=>'required'));?></td>
                    <td>
                        <?php echo Form::input('fechasalida','',array('class'=>'form','id'=>'fechasalida','size'=>'15','class'=>'required','name'=>'fechasalida'))?>
                        <?php echo Form::input('horasalida',date("H:m:s"),array('class'=>'form','id'=>'horasalida','size'=>'7','class'=>'required'))?>
                    </td>
                    <td>
                        <?php echo Form::input('fechaarribo','',array('class'=>'form','id'=>'fechaarribo','size'=>'15','class'=>'required'));?>
                        <?php echo Form::input('horaarribo',date("H:m:s"),array('class'=>'form','id'=>'horaarribo','size'=>'7','class'=>'required'))?>
                    </td>
                    <td><?php echo Form::select('transporte',array('aereo'=>'Aereo','terrestre'=>'Terrestre','oficial'=>'Oficial'),NULL,array('class'=>'form','id'=>'transporte','class'=>'required'))?></td>
                    <td><?php echo Form::input('nroboleto','',array('class'=>'form','id'=>'nroboleto','name'=>'nroboleto','size'=>'10','class'=>'required'))?></td>
                    <td><?php echo Form::input('costo','',array('class'=>'form','id'=>'costo','name'=>'costo','size'=>'5','class'=>'required'));?></td>      
                    <td><?php echo Form::input('empresa','',array('class'=>'form','id'=>'empresa','name'=>'empresa','size'=>'10','class'=>'required'))?></td>
                    </tr>
                </tbody>
            </table>
        
            <input type="submit" value="Asignar Pasaje" class="uibutton" name="submit" id="crear" title="Asignar Pasaje"/>
            <a href="/hojaruta/derivar/?id_doc=<?php echo $fucov->id_memo; ?>" class="link derivar" title="Derivar a partir del documento, si ya esta derivado muestra el seguimiento" >Derivar</a>
        </form>
    <?php endif;?>
<?php endif;?>