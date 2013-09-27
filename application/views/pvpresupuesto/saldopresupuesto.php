<script type="text/javascript">

$(function(){
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
<h2 class="subtitulo">Estado de la Ejecuci&oacute;n Presupuestaria<br/><?php echo $detalle->unidad_funcional;?><br /> <span>Lista de Partidas de Gastos</span></h2>
<table>
    <tr>
        <td>Entidad:</td>
        <td><?php echo $detalle->sigla;?></td>
        <td><?php echo $detalle->entidad;?></td>
    </tr>
    <tr>
        <td>DA:</td>
        <td><?php echo $detalle->codigo_da;?></td>
        <td><?php echo $detalle->da;?></td>
    </tr>
    <tr>
        <td>UE:</td>
        <td><?php echo $detalle->codigo_ue;?></td>
        <td><?php echo $detalle->ue;?></td>
    </tr>
    <tr>
        <td>Cat. Prog.:</td>
        <td><?php echo $detalle->codigo_prog.' &nbsp '.$detalle->codigo_proy.' &nbsp '.$detalle->codigo_act;?></td>
        <td><?php echo $detalle->actividad;?></td>
    </tr>
    <tr>
        <td>Fuente:</td>
        <td><?php echo $detalle->codigo_fte;?></td>
        <td><?php echo $detalle->fte;?></td>
    </tr>
    <tr>
        <td>Organismo:</td>
        <td><?php echo $detalle->codigo_org;?></td>
        <td><?php echo $detalle->org;?></td>
    </tr>
</table>
<br /><div style="float: right;"><a href="/pvpresupuesto/addsaldoppt/<?php echo $id_programatica;?>" >+ Adicionar Partida</a></div>
<?php if(sizeof($presupuesto)>0):?>
<p style="margin: 5px auto;"> <b>Filtrar/Buscar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="40" /></p>

<table id="theTable" class="tablesorter" border="1px" >
    <thead>
        <tr>
            <th>Cod. Partida</th>
            <th>Partida</th>
            <th>Inicial</th>
            <th>Modificado</th>
            <th>Vigente</th>
            <th>Preventivo</th>
            <th>Comprometido</th>
            <th>Devengado</th>
            <th>Saldo Devengado</th>
            <th>Pagado</th>
            <th>Saldo Pagar</th>
            <th>Opciones</th>
        </tr>
    </thead>    
    <tbody>
    <?php 
    foreach( $presupuesto as $ppt): ?>
        <tr>
            <td ><?php echo $ppt['codigo'];?></a></td>
            <td ><?php echo $ppt['partida'];?></td>
            <td ><?php echo $ppt['inicial'];?></td>
            <td ><?php echo $ppt['modificado'];?></td>
            <td ><?php echo $ppt['vigente'];?></td>
            <td ><?php echo $ppt['preventivo'];?></td>
            <td ><?php echo $ppt['comprometido'];?></td>
            <td ><?php echo $ppt['devengado'];?></td>
            <td ><?php echo $ppt['saldo_devengado'];?></td>
            <td ><?php echo $ppt['pagado'];?></td>
            <td ><?php echo $ppt['saldo_pagar'];?></td>
            <td ><a href="/pvpresupuesto/movimiento/<?php echo $ppt['id'];?>" class="uibutton" title="Movimiento Saldo" ><img src="/media/images/reprogramar.png"/></a>&nbsp;&nbsp;&nbsp;
                    <a href="/pvpresupuesto/editsaldoppt/<?php echo $ppt['id'];?>" class="uibutton" title="Editar" ><img src="/media/images/edit.png"/> </a></td>
        </tr>        
    <?php endforeach; ?>
   </tbody>   
</table>
<?php else: ?>
<div style="margin-top: 20px; padding: 10px;" class="info">
    <p><span style="float: left; margin-right: .3em;" class=""></span>    
     <strong>Info: </strong> <?php echo 'No hay partidas Relacionadas';?></p>    
</div>
<?php endif; ?>