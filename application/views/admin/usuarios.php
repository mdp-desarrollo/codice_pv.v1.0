<script type="text/javascript">
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
});//document.ready
</script>
<h2>Lista de Usuarios del Sistema</h2>
<hr class="azul"/>
<p style="margin: 5px auto;"> <b>Filtrar/Buscar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="40" /></p>
<br/>
<table id="theTable">
    <thead>
        <tr>
            <th>#</th>            
            <th>Usuario</th>                        
            <th>Nombre</th>
            <th>Cargo</th>
            <th>email</th>
            <th>Oficina</th>
            <th>email</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
<?php $i=1; foreach ($usuarios as $u):?>
        <tr>
            <td><?php echo $i; $i++;?></td>
            <td><?php echo $u->username;?></td>
            <td><?php echo $u->nombre;?></td>
            <td><?php echo $u->cargo;?></td>
            <td><?php echo $u->email;?></td>
            <td><?php echo $u->oficina;?></td>
            <td><?php echo $u->nivel;?></td>
            <td><?php echo HTML::anchor('admin/user/'.$u->id,'Detalle');?></td>
        </tr>
 <?php endforeach;?>
    </tbody>
</table>