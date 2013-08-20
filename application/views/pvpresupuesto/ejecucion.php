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

<br />
<h2 class="subtitulo">Ejecuci&oacute;n Presupuestaria<br/> <span>Lista de Fuentes de Financiamiento</span></h2>
<?php if(sizeof($presupuesto)>0):?>
<p style="margin: 5px auto;"> <b>Filtrar/Buscar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="40" /></p>
<div style="float: right;"><a href="/pvpresupuesto/addejecucionppt/" >+ Adicionar</a></div>
<table id="theTable" class="tablesorter" border="1px" >
    <thead>
        <tr>
            <th width="300">Unidad Funcional</th>
            <th>Gestion</th>
            <th>Entidad</th>
            <th>D.A.</th>    
            <th>U.E</th>
            <th>Programa</th>
            <th>Proyecto</th>
            <th>Actividad</th>
            <th>Fuente</th>
            <th>Organismo</th>
        </tr>
    </thead>    
    <tbody>
    <?php    
    foreach( $presupuesto as $ppt): ?>
        <tr>
            <td ><a href="/pvpresupuesto/saldopresupuesto/<?php echo $ppt['id'];?>"><?php echo $ppt['oficina'];?></a></td>
            <td ><?php echo $ppt['gestion'];?></td>
            <td ><?php echo $ppt['codigo_entidad'];?></td>
            <td ><?php echo $ppt['codigo_da'];?></td>
            <td ><?php echo $ppt['codigo_ue'];?></td>
            <td ><?php echo $ppt['codigo_prog'];?></td>
            <td ><?php echo $ppt['codigo_proy'];?></td>
            <td ><?php echo $ppt['codigo_act'].' - '.$ppt['actividad'];?></td>
            <td ><?php echo $ppt['codigo_fte'].' '.$ppt['sigla_fte'];;?></td>
            <td ><?php echo $ppt['codigo_org'].' '.$ppt['sigla_org'];?></td>
        </tr>        
    <?php endforeach; ?>
   </tbody>   
</table>
<?php else: ?>
<div style="margin-top: 20px; padding: 10px;" class="info">
    <p><span style="float: left; margin-right: .3em;" class=""></span>    
     <strong>Info: </strong> <?php echo 'No hay Fuentes de Financiamiento';?></p>    
</div>
<?php endif; ?>