<script type="text/javascript">

    $(function()
    {
        $("#theTable").tablesorter({sortList:[[3,1]], 
            widgets: ['zebra'],
            headers: {             
                5: { sorter:false},
                6: { sorter:false}
            }
        });
        
        //add index column with all content.
 $("table#theTable tbody tr:has(td)").each(function(){
   var t = $(this).text().toLowerCase(); //all row text
   $("<td class='indexColumn'></td>")
    .hide().text(t).appendTo(this);
 });//each tr

        
        $("#FilterTextBox").keyup(function(){
            var s = $(this).val().toLowerCase().split(" ");
            //show all rows.
            $("#theTable tbody tr:hidden").show();
            $.each(s, function(){
                $("#theTable tbody tr:visible .indexColumn:not(:contains('"
                    + this + "'))").parent().hide();
            });//each
        });//key up.
        //zebra
        
        $("#FilterTextBox").focus();
        
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
        
    });//document.ready
</script>
<style>
    #file-word{ display: none;  }
    td{padding:5px;}    
</style>
<br />
<h2 class="subtitulo">Solicitudes de pasajes y viaticos<br/> <span>Lista de solicitudes autorizadas</span></h2>
<?php if(sizeof($autorizados)>0):?> 

<div id="buscador">
B&uacute;squeda Avanzada
    <form action="" method="post">
    <table border="0">
        <tr>
            <td>Funcionario: </td>
            <td colspan="4">
               <?php echo Form::input('funcionario',NULL,array('id'=>'funcionario'));?>
            </td>
        </tr>
        <td>Oficina: </td>
            <td colspan="4">
               <?php echo Form::select('oficina',$oficinas);?>
        </td>
        <tr>
            <td>De fecha:</td>
            <td><input type="text" name="fecha1" id="fecha1" value="<?php echo date('Y-m-01');?>"/></td>
            <td>A fecha:</td>
            <td colspan="2"><input type="text" name="fecha2" id="fecha2" value="<?php echo date('Y-m-d');?>" /></td>
            <td><input type="submit" name="submit" value="Buscar"/></td>
        </tr>
    </table>
</form>
    <hr />
</div>

<p style="margin: 5px auto;"> <b>Filtrar/Buscar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="40" /></p>
<table id="theTable" class="tablesorter" border="1px" >
    <thead>
        <tr>
            <th>Hoja de Ruta</th>
            <th>Detalle</th>
            <th>Fecha Solicitud</th>
            <th>Unidad Funcional</th>
            <th>Nombre Funcionario</th>
            <th>Acci&oacute;n</th>
        </tr>
    </thead>    
    <tbody>
    <?php    
    foreach( $autorizados as $aut): ?>
        <tr>
            <!--<td ><a href="/documento/detalle/<?php echo $aut->id_memo;?>"><?php echo $aut->codigo;?></a></td>
            <td ><?php echo $aut->nur;?></td>-->
            <td ><a href="/seguimiento/?nur=<?php echo $aut->nur;?>"><?php echo $aut->nur;?></a></td>
            <td ><a href="/pvpresupuesto/detalleautorizados/<?php echo $aut->id_memo;?>"><?php echo $aut->codigo;?></a></td>
            <td ><?php echo $aut->fecha_creacion;?></td>
            <td ><?php echo $aut->oficina;?></td>
            <td ><?php echo $aut->nombre;?><br /><b><?php echo $aut->cargo;?></b></td>
            <td><a href="../../pdf/certificacionppt.php?id=<?php echo $aut->id_memo.'&f='.$aut->id_fucov;?>" class="uibutton" target="_blank" title="Imprimir Certificado" ><img src="/media/images/print.png"/> Imprimir </a></td>
        </tr>        
    <?php endforeach; ?>
   </tbody>   
</table>
<?php else: ?>
<div style="margin-top: 20px; padding: 10px;" class="info">
    <p><span style="float: left; margin-right: .3em;" class=""></span>    
     <strong>Info: </strong> <?php echo 'Usted no tiene Solicitudes Certificadas';?></p>    
</div>
<?php endif; ?>