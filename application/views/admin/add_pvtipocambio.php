<script type="text/javascript">
$(function(){
    $("#frm").validate();

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
        $("#fecha").datepicker(pickerOpts,$.datepicker.regional['es']);        

    });


</script>

<h2 class="subtitulo">Crear un nuevo tipo cambio<br/><span>Llene correctamente los datos del formulario</span></h2>
<?php //if($mensaje!='') echo "Se creo corectamente la carpeta $mensaje"; ?>
<?php if(sizeof($error)>0): ?>
    <ul>
        <?php foreach($error as $e):?>
        <li><?php echo $e?></li>
    <?php endforeach;?>
</ul>
<?php endif;?>
<?php if(sizeof($info)>0):?>
    <div class="info">
        <p><span style="float: left; margin-right: .3em;" class=""></span>
            <?php foreach($info as $k=>$v):?>
            <strong><?=$k?>: </strong> <?php echo $v;?></p>
        <?php endforeach;?>   
    </div>
<?php endif;?>
<form method="post" action="/admin/pvtipocambios/save" id="frm">
    <?php     
    echo Form::hidden('id',$pvtipocambio->id);
    ?>
    <table>
        <tr>
            <td><?php echo Form::label('Fecha');?></td>
            <td><?php echo Form::input('fecha',$pvtipocambio->fecha,array('class'=>'required','id'=>'fecha'));?></td>
        </tr>
        <tr>
            <td><?php echo Form::label('Venta');?></td>
            <td><?php echo Form::input('cambio_venta',$pvtipocambio->cambio_venta,array('class'=>'required'));?></td>
        </tr>
        <tr>
            <td><?php echo Form::label('Compra');?></td>
            <td><?php echo Form::input('cambio_compra',$pvtipocambio->cambio_compra,array('class'=>'required number'));?></td>
        </tr>
    </table>
    <hr/>
    <br/>
    <input type="submit" value="Guardar tipo cambio" name="create" class="uibutton" />
</form>    