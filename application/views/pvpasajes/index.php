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
        
        
    });//document.ready
</script>
<style>
    #file-word{ display: none;  }
    td{padding:5px;}    
</style>
<h2 class="subtitulo">Solicitudes de pasajes y viaticos<br/> <span>Lista de solicitudes autorizadas</span></h2>
<?php if(sizeof($autorizados)>0):?> 
<p style="margin: 5px auto;"> <b>Filtrar/Buscar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="40" /></p>
<table id="theTable" class="tablesorter" border="1px" >
    <thead>
        <tr>
            <th>Memor&aacute;ndum</th>
            <th>Hoja de Ruta</th>
            <th>Fecha Solicitud</th>
            <th>Fecha Salida</th>
            <th>Fecha Retorno</th>
            <th>Linea A&eacute;rea</th>
            <th>Boleto Salida</th>
            <th>Unidad Funcional</th>
            <th>Nombre Funcionario</th>
        </tr>
    </thead>    
    <tbody>
    <?php    
    foreach( $autorizados as $aut): ?>
        <tr>
            <td ><a href="/pyvpasajes/detalleautorizados/<?php echo $aut->id_memo;?>"><?php echo $aut->codigo;?></a></td>
            <td ><?php echo $aut->nur;?></td>
            <td ><?php echo $aut->fecha_creacion;?></td>
            <td ><?php echo $aut->fecha_salida;?></td>
            <td ><?php echo $aut->fecha_arribo;?></td>
            <td ><?php echo $aut->empresa;?></td>
            <td ><?php echo $aut->nro_boleto;?></td>
            <td ><?php echo $aut->oficina;?></td>
            <td ><?php echo $aut->nombre;?><br /><b><?php echo $aut->cargo;?></b></td>
        </tr>        
    <?php endforeach; ?>
   </tbody>   
</table>
<?php else: ?>
<div style="margin-top: 20px; padding: 10px;" class="info">
    <p><span style="float: left; margin-right: .3em;" class=""></span>    
     <strong>Info: </strong> <?php echo 'Usted no tiene Pasajes autorizados';?></p>    
</div>
<?php endif; ?>