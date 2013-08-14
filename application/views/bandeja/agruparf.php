<script type="text/javascript">
$(function(){
   $('#nueva').click(function(){
       $('div#folder').removeClass('oculto');
       $('div#lista').addClass('oculto');
       $('#nc').focus();
   }); 
   $('#list').click(function(){
       $('div#folder').addClass('oculto');
       $('div#lista').removeClass('oculto');       
   }); 
   $('#btnLista').click(function(){
       $('input#tipo').val(1);
       return true;
   });
   $('#btnNuevo').click(function(){
       $('input#tipo').val(0);
       return true;
   });
});

</script>
<h2 class="subtitulo">Agrupar correspondencia<br/><span>Seleccione la hoja de ruta que sera la principal</span></h2>
<form method="post" action="/bandeja/agruparf" id="frmArchivar"> 
<table style="margin: 0 auto;">
<tr>
<td valign="top" style=" width: 250px; padding-right: 10px; border-right: 1px solid #ccc;border-left: 1px solid #ccc; font-size: 12px; text-align: center; " >
    Hojas de ruta a disponibles:
    <hr/><br/>
   
<ul>
<?php foreach($nurs as $k=>$v): ?>
<li>
    <?php echo $v;?>  
    <input type="radio" value="<?php  echo $k;?>" name="principal"/>    
    <input type="hidden" value="<?php echo $k;?>" name="seg[]"/>    
</li>
<?php endforeach;?>
</ul>
    <hr/><br/> 
<?php  echo Form::input('submit', '  Agrupar',array('type'=>'submit','class'=>'uiButton','id'=>'list')); ?>       
<input type="hidden" value="0" name="tipo" id="tipo"/> 
</td>
</tr>
</table>
</form>