<script type="text/javascript">
$(function(){
    $('a#adicionar').click(function(){      
        var val= '';
        $(':checked').each(function(i){          
            val=val+$(this).val()+';';	            
        });
        if(val!='')
        {           
        window.returnValue = val;
	window.close();
        }
        else
        {
                alert('Seleccione al menos un usuario.');
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
 //por defecto ubicamos el foco en buscar
  $('#FilterTextBox').focus();
});
</script>
<h2 class="subtitulo">Documentos <br/><span>]Lista de documentos a ser añadidos</span></h2>
<p style="margin: 5px auto;"> <b>Filtrar/Buscar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="40" /></p>
<a href="#" class="uibutton" id="adicionar">+ Adicionar</a>
<br/>
<br/>
<table id="theTable">
    <thead>
        <tr>
            <th>
                id
            </th>
            <th>
                tipo
            </th>
            <th>
                descripcion
            </th>                        
        </tr>
    </thead>
    <tbody>
        <?php foreach($documentos as $e): ?>
        <tr>
            <td>
               <?php echo Form::checkbox('s', $e->id,FALSE,array('class'=>'check'));?> 
            </td>
            <td>
               <?php echo $e->tipo;?> 
            </td>            
            <td>
               <?php echo $e->descripcion;?>              
            </td>                        
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php ?>
