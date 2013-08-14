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
<h2 class="subtitulo">Archivar correspondencia<br/><span>Seleccione la carpeta o cree una nueva</span></h2>
<form method="post" action="/bandeja/archivarf" id="frmArchivar"> 
<table>
<tr>
<td valign="top" style="padding-right: 10px; border-right: 1px solid #ccc;" >
    Hojas de ruta a archivar:
    <hr/><br/>   
<ul>
<?php foreach($nurs as $k=>$v): ?>
<li>
    <?php echo $v;?>
    <input type="hidden" value="<?php echo $k;?>" name="seg[]"/>    
</li>
<?php endforeach;?>
</ul>
</td>

<td valign="top" style="padding-left: 10px; padding-right: 10px; ">
    Nombre de la carpeta:<hr/><br/>
    <?php if(sizeof($options)>0){?>
    <div id="lista">
     <?php  echo Form::select('carpeta_lista', $options); ?>
     <br/><br/>
     <textarea name="observaciones" style="width:300px;" ROWS="2"></textarea>
     <br/>
                 
    </div>
    <?php } ?>
    <input type="hidden" value="0" name="tipo" id="tipo"/> 
</td>
</tr>
<tr>
    <td></td>
    <td colspan="2" style="float: left; padding-left: 10px; ">
    <?php  echo Form::input('submit', 'Archivar',array('type'=>'submit','class'=>'uiButton','id'=>'btnLista')); ?> 
    </td>    
</tr>
</table>
</form>