<script type="text/javascript">
 $(function(){
     $('#buscar').click(function(){
        var errors='';
        var l=$('input[type=checkbox]:checked').length;
        var texto=$('#texto').val();
        if(l==0)
          {
                errors+="Debe de elegir un campo.\n";                
          }
        if($.trim(texto)=='')
          {
                errors+="Escriba texto por favor";
          }
        if((l==0)||($.trim(texto)==''))
          {
              alert(errors);
            return false;        
          }
        else{
            return true;
        }
     })
     $('#texto').focus();   
 });
</script>
<h2 class="subtitulo">Formulario de Busqueda <br/><span>realizar busqueda en la base de datos</span></h2>
<?php ?>
<?php if(sizeof($mensajes)>0):?>
    <div class="message">
        <?php foreach($mensajes as $k=>$v):?>
        <p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
        <b><?php echo $k;?></b> <?php echo $v;?></p>
        <?php endforeach;?>
    </div>
<?php endif;?>


<div style="width: 550px; margin: 0 auto; border: 1px dotted #063765; padding: 40px; background: #EFF4FB;" >
    
<form action="" method="get">
    <table style="width: 100%;" >
        <tbody>
            <tr>                
                <td colspan="5"><input type="text" id="texto" name="texto"  value="<?php echo Arr::get($_GET,'texto','') ?>" style="line-height: 25px; height: 35px; padding: 5px;  font-size: 14px; width: 450px; " class="curved" /></td>                
                <td><input type="submit" name="buscar" id="buscar" value="Buscar" class="uibutton" style="line-height: 25px; height: 30px;" /></td>
            </tr>
            <tr>
                <td><br/></td>
            </tr>
            <tr>                
                <td><input type="checkbox" name="campo[]" value="nur" checked="checked"/><span class="sp"> Hoja de ruta </span></td>
                <td> | <input type="checkbox" name="campo[]" value="cite_original" checked="checked"/><span class="sp"> Cite documento </span></td>
                <td> | <input type="checkbox" name="campo[]" value="nombre_destinatario" checked="checked" /><span class="sp"> Destinatario </span></td>
                <td> | <input type="checkbox" name="campo[]" value="nombre_remitente" checked="checked"/><span class="sp"> Remitente </span></td>
                <td> | <input type="checkbox" name="campo[]" value="referencia" checked="checked" /><span class="sp"> Referencia </span></td>                
            </tr>
        </tbody>
    </table>
</form>
</div>
