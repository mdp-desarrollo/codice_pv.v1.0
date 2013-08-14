<script type="text/javascript">
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
            dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''};
        $.datepicker.setDefaults($.datepicker.regional['es']); 
        var pickerOpts = {
        changeMonth: true,
        changeYear: true,
        yearRange: "-10:+1",
        dateFormat:"yy-mm-dd"
        };
      $("#fecha1,#fecha2").datepicker(pickerOpts,$.datepicker.regional['es']);        
      $('#hoy').click(function(){
            var f = new Date();
            var mes=(f.getMonth() +1);
            if(mes<10)
                mes='0'+mes;
            var dia=f.getDate();
            if(dia<10)
                dia='0'+dia;
            var fecha=f.getFullYear() + "-" + mes  + "-" + dia; 
            $("#fecha1,#fecha2").val(fecha);
      });
    });
</script>
<h2 class="subtitulo">Reporte: Correspondencia recibida<br/><span>Elija las opciones</span></h2>
<form action="" method="post">
    <table>        
        <tr>
            <td>De fecha:</td>
            <td><input type="text" name="fecha1" value="<?php echo $fecha_inicio;?>" id="fecha1"/></td>
            <td>A fecha:</td>
            <td><input type="text" name="fecha2" value="<?php echo date('Y-m-d');?>" id="fecha2"/></td>
            <td><input id="hoy" value="Hoy" type="button" class="uibutton"/></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">
                <hr/><br/>
                <input type="submit" name="submit" value="Generar Reporte" title=""/>
            </td>
        </tr>
    </table>    
</form>