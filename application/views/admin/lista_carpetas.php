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

// $("#delete_id").click(function(){
//     alert('hoal');
//        // return confirm("Esta seguro de eliminar el registro");
// });

});



</script>
<h2 class="subtitulo">Carpetas<br/><span>LISTA GENERAL DE CARPETAS</span></h2>
<p style="margin: 5px auto; font-size: 10px; font-weight: normal; "> FILTRAR/BUSCAR: <input type="text" id="FilterTextBox" name="FilterTextBox" size="40" />
</p>
<div style="float: right;"><a href="/admin/carpetas/form" class="uibutton">+ Nueva Carpeta</a></div>
<br/>
<br/>
<table id="theTable">
    <thead>
        <tr>
            <th> ID </th>
            <th> OFICINA </th>
            <th> CARPETA </th>
            <th> FECHA CREACION </th>
            <th> NIVEL </th>
            <th> </th>
            <th> </th>
        </tr>
    </thead>
    <tbody> 
    <?php foreach($carpetas as $o):?>
        <tr>
            <td><?php echo $o['id'];?></td>
            <td><?php echo $o['oficina']." | ".$o['sigla'];?></td>
            <td><?php echo $o['carpeta'];?></td>
            <td><?php echo $o['fecha_creacion'];?></td>
            <td><?php echo $o['nivel'];?></td>
            <td>
                <a href="/admin/carpetas/form/<?php echo $o['id'];?>"><img src="/media/images/16x16/Write.png" /></a>
            </td>
            <td>
                <a href="/admin/carpetas/delete/<?php echo $o['id'];?>" onclick="return confirm('Esta seguro de eliminar el registro')"><img src="/media/images/16x16/Cancel.png" /></a>
            </td>
        </tr>
    <?php endforeach;?>        
    </tbody>
</table>
