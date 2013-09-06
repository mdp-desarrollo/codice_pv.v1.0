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
<h2 class="subtitulo">Organismos<br/><span>LISTA GENERAL DE ORGANISMOS</span></h2>
<p style="margin: 5px auto; font-size: 10px; font-weight: normal; "> FILTRAR/BUSCAR: <input type="text" id="FilterTextBox" name="FilterTextBox" size="40" />
</p>
<div style="float: right;"><a href="/admin/pvorganismos/form" class="uibutton">+ Nuevo Organismo</a></div>
<br/>
<br/>
<table id="theTable">
    <thead>
        <tr>
            <th> ID </th>
            <th> CODIGO </th>
            <th> DENOMINACIÓN </th>
            <th> SIGLA </th>
            <th> TIPO </th>
            <th> </th>
            <th> </th>
        </tr>
    </thead>
    <tbody> 
    <?php foreach($pvorganismos as $o):?>
        <tr>
            <td><?php echo $o['id'];?></td>
            <td><?php echo $o['codigo'];?></td>
            <td><?php echo $o['denominacion'];?></td>
            <td><?php echo $o['sigla'];?></td>
            <td><?php echo $o['tipo'];?></td>
            <td>
                <a href="/admin/pvorganismos/form/<?php echo $o['id'];?>"><img src="/media/images/16x16/Write.png" /></a>
            </td>
            <td>
                <a href="/admin/pvorganismos/delete/<?php echo $o['id'];?>" onclick="return confirm('Esta seguro de eliminar el registro')"><img src="/media/images/16x16/Cancel.png" /></a>
            </td>
        </tr>
    <?php endforeach;?>        
    </tbody>
</table>
