<script>
$(function(){
 
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
 $('#theTable tbody tr:odd').addClass('odd');
 $('input').focus();

});



</script>
<h2 class="subtitulo">Lista de Tipo Cambios<br/><span>LISTA GENERAL DE TIPO CAMBIO</span></h2>
<p style="margin: 5px auto; font-size: 10px; font-weight: normal; "> FILTRAR/BUSCAR: <input type="text" id="FilterTextBox" name="FilterTextBox" size="40" />
</p>
<div style="float: right;"><a href="/admin/pvtipocambios/form" class="uibutton">+ Nuevo Tipo Cambio</a></div>
<br/>
<br/>
<table id="theTable">
    <thead>
        <tr>
            <th> ID </th>
            <th> FECHA </th>
            <th> VENTA </th>
            <th> COMPRA </th>
            <th> </th>
            <th> </th>
        </tr>
    </thead>
    <tbody> 
    <?php foreach($pvtipocambios as $o):?>
        <tr>
            <td><?php echo $o['id'];?></td>
            <td><?php echo $o['fecha'];?></td>
            <td><?php echo $o['cambio_venta'];?></td>
            <td><?php echo $o['cambio_compra'];?></td>
            <td>
                <a href="/admin/pvtipocambios/form/<?php echo $o['id'];?>"><img src="/media/images/16x16/Write.png" /></a>
            </td>
            <td>
                <a href="/admin/pvtipocambios/delete/<?php echo $o['id'];?>" onclick="return confirm('Esta seguro de eliminar el registro')"><img src="/media/images/16x16/Cancel.png" /></a>
            </td>
        </tr>
    <?php endforeach;?>        
    </tbody>
</table>
