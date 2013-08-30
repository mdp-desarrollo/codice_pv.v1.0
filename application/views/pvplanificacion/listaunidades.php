<script type="text/javascript">

    $(function()
    {
        $("#theTable").tablesorter({sortList:[[1,1]], 
            widgets: ['zebra'],
            headers: {             
                //5: { sorter:false},
                //6: { sorter:false}
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
<h2 class="subtitulo">Programa Operativo Anual<br/> <span>Lista de unidades funcionales</span></h2>
<?php if(sizeof($unidades)>0):?> 
<p style="margin: 5px auto;"> <b>Filtrar/Buscar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="40" /></p>
<table id="theTable" class="tablesorter" border="1px" >
    <thead>
        <tr>
            <th>Unidad Funcional</th>
            <th>Entidad</th>
        </tr>
    </thead>    
    <tbody>
    <?php    
    foreach( $unidades as $uni): ?>
        <tr>
            <td ><a href="/pvplanificacion/objetivogestion/<?php echo $uni->id;?>"><?php echo $uni->oficina;?></a></td>
            <td ><?php echo $uni->entidad;?></td>            
        </tr>        
    <?php endforeach; ?>
   </tbody>   
</table>
<?php else: ?>
<div style="margin-top: 20px; padding: 10px;" class="info">
    <p><span style="float: left; margin-right: .3em;" class=""></span>    
     <strong>Info: </strong> <?php echo 'Usted no tiene Solicitudes autorizadas';?></p>    
</div>
<?php endif; ?>