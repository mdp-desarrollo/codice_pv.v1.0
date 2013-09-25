<script type="text/javascript">
function verificar(){
    var answer = confirm("Esta seguro de eliminar el Objetivo Especifico?.");
    if (answer)
        return true;
    else
        return false;   
}
$(function()
    {
        $("#theTable").tablesorter({sortList:[[2,1]], 
            widgets: ['zebra'],
            headers: {             
                5: { sorter:false}//,
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
<h2 class="subtitulo">OBJETIVOS ESPECIFICOS - <?php echo $oficina->oficina;?> <br/> <span>Lista de Objetivos Espec&iacute;ficos</span></h2>
<div style="width: 800px;"><b>OBJETIVO DE GESTION :</b> <?php echo $ogestion->codigo ?> <br /><?php echo $ogestion->objetivo;?></div>
<div style="float: right;"><a href="/pvplanificacion/addobjespecifico/<?php echo $ogestion->id;?>" >+ Adicionar Objetivo Espec&iacute;fico</a></div>
<?php if(sizeof($objetivos)>0):?> 
<p style="margin: 5px auto;"> <b>Filtrar/Buscar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="40" /></p>
<table id="theTable" class="tablesorter" border="1px" >
    <thead>
        <tr>
            <th>C&oacute;digo</th>
            <th>Objetivo</th>
            <th>Opciones</th>
        </tr>
    </thead>    
    <tbody>
    <?php    
    foreach( $objetivos as $obj): ?>
        <tr>
            <td ><a href="/pvplanificacion/listaactividades/<?php echo $obj->id;?>" title="Lista de Actividades" onclick="javascript: return true;" /><?php echo $obj->codigo;?></td>
            <td ><?php echo $obj->objetivo;?></td>
            <td><a href="/pvplanificacion/editobjespecifico/<?php echo $obj->id;?>" class="uibutton" title="Modificar Objetivo" ><img src="/media/images/edit.png"/> </a>
                <a href="/pvplanificacion/eliminarobjesp/<?php echo $obj->id;?>" class="uibutton" title="Eliminar Objetivo" onclick="javascript: return verificar();" ><img src="/media/images/delete.png"/> </a>
            </td>
        </tr>        
    <?php endforeach; ?>
   </tbody>   
</table>
<?php else: ?>
<div style="margin-top: 20px; padding: 10px;" class="info">
    <p><span style="float: left; margin-right: .3em;" class=""></span>    
     <strong>Info: </strong> <?php echo 'No Hay Objetivos Especificos Para El Objetivo de Gestion.';?></p>    
</div>
<?php endif; ?>
<div class="info" style="text-align:center;margin-top: 20px;">
    <p><span style="float: left; margin-right: .3em;" class=""></span>    
      &larr;<a href="/pvplanificacion/objetivogestion/<?php echo $oficina->id;?>" class="uibutton" title="Regresar" >Regresar</a></p>    
</div>
