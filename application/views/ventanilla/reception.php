<?php ?>
<script type="text/javascript">    
$(function(){        
//incluir destinatario
$('#frmCreate').validate();
$('a.destino').click(function(){
    var nombre=$(this).attr('nombre');   
    var cargo=$(this).attr('cargo');   
    var via=$(this).attr('institucion');    
    $('#destinatario').val(nombre);
    $('#cargodes').val(cargo);
    $('#instituciondes').val(via);    
    $('#referencia').focus();
    return false;
    });
    //Verificación de correspondencia
    $('#cite').bind('blur',function(){
        
        var cite= $(this).val();
        if(cite=='')
        {
            $('#cite').val('S/C');
        }
        var oficina= $('#oficina').val();
        $.ajax({
	            type: "POST",
	            data: { cite : cite, oficina : oficina},
	            url: "/ajax/vercite",
	            dataType: "json",
	            success: function(item)
	            {                           
                        if(item.error)
                         {
                               alert(item.error);
                               $('#cite').addClass('err').focus();
                               //$('input#crear').attr({'disabled':'disabled'});
                               
                         }
                         else
                         {
                             $('#cite').removeClass('err');
                               $('input#crear').removeAttr('disabled');                         
                         }
	           },
                   error:function(){ }
          });
    });
    $('#cite').focus();
});
</script>
<style>
    input.err{border: 1px solid #D61010;}
</style>
<h2 class="subtitulo">Formulario de Recepci&oacute;n<br/><span>Recepci&oacute;n de documentos externos</span></h2>
<div class="formulario">
<form action="" method="post" enctype="multipart/form-data" id="frmCreate">
<table width="100%">
<tr>
<td style=" border-right:1px dashed #ccc; padding-left: 5px;">
   <?php
echo Form::label('cite', 'Cite original:',array('class'=>'form'));
echo Form::input('cite',Arr::get($_POST,'cite',''),array('id'=>'cite','size'=>40,'class'=>'required'));
?> 
    <input type="hidden" name="entidad" id="oficina" value="<?php echo $oficina;?>" />
  <?php
   echo Form::label('Destinatario', 'Destinatario:',array('class'=>'form'));
   echo Form::input('destinatario',Arr::get($_POST,'destinatario',''),array('id'=>'destinatario','size'=>40,'class'=>'required'));
?>
<?php
   echo Form::label('cargodes', 'Cargo destinatario:',array('class'=>'form'));
   echo Form::input('cargodes',Arr::get($_POST,'cargodes',''),array('id'=>'cargodes','size'=>40,'class'=>'required','title'=>'Ejemplo: Lo citado'));
?>
<?php
   echo Form::label('insituciondes', 'Institucion Destinatario:',array('class'=>'form'));
   echo Form::input('instituciondes',Arr::get($_POST,'instituciondes',''),array('id'=>'instituciondes','size'=>40,'class'=>'required'));
   ?>
</td>
<td style=" border-right:1px dashed #ccc; padding-left: 5px;">
 <?php
echo Form::label('fecha', 'Fecha del documento:',array('class'=>'form'));
echo Form::select('dia',$days,date('d'));
echo Form::select('mes',$months,date('m'));
echo Form::select('year',$years,date('Y'));
?>    
<?php
echo Form::label('remitente', 'Remitente:',array('class'=>'form'));
echo Form::input('remitente','',array('id'=>'remitente','size'=>40,'class'=>'required'));
?>
<?php
echo Form::label('cargorem', 'Cargo Remitente:',array('class'=>'form'));
echo Form::input('cargorem','',array('id'=>'cargorem','size'=>40,'class'=>'required'));
?>
<?php
   echo Form::label('institucionrem', 'Institucion Remitente:',array('class'=>'form'));
   echo Form::input('institucionrem','',array('id'=>'intitucionrem','size'=>40,'class'=>'required'));            
?>     
</td>

<td rowspan="2" style="padding-left: 5px;">
    <?php echo Form::label('dest','Destinatarios:');?>
    <div id="vias">
        <ul>
            <?php foreach($destinos  as $d): ?>
            <li class="<?php echo $d->genero?>"><?php echo HTML::anchor('#',$d->nombre,array('class'=>'destino','nombre'=>$d->nombre,'title'=>$d->cargo,'cargo'=>$d->cargo,'institucion'=>$d->entidad));?></li>
            <?php endforeach; ?>            
        </ul>
    </div>
</td>
</tr>
<tr>
<td colspan="2" style="padding-left: 5px;">
<?php
echo Form::label('referencia', 'Referencia:',array('class'=>'form'));
?> 
    <textarea id="descripcion" name="descripcion" style="width:500px;" class="required"></textarea>    
<br/>    
<br/>
</td>
</tr>
</table>
<table>
<tr>
    <!--<td>      
        <?php 
       // echo Form::label('grupo','Grupo Remitente:');
       // echo Form::select('grupo',$grupos,'',array('id'=>'grupo','style'=>'width:240px;')); 
        ?>
    </td>
    -->
    <td>
        <?php 
        echo Form::label('motivo','Motivo:');
        echo Form::select('motivo',$motivos,'',array('id'=>'motivo','style'=>'width:240px;')); 
        ?>
    </td>
    <!--<td>
        <?php 
       // echo Form::label('proceso','Proceso:');
      //  echo Form::select('proceso',$procesos,'',array('id'=>'proceso','style'=>'width:240px;')); 
        ?>
    </td>
    -->
    <td>
        <?php 
        echo Form::label('adjunto','Adjunto:');
        echo Form::input('adjunto','',array('id'=>'adjunto','size'=>40)); 
        ?>
    </td>
    <td>
        <?php 
        echo Form::label('hojas','N° de hojas:');
        echo Form::input('hojas','',array('id'=>'hojas')); 
        ?>
    </td>
</tr>
<tr>
    <td colspan="3"><br/></td>
</tr>
<tr>
<td colspan="3" >
<p>
<?php
echo '<hr/><br/>';
echo Form::input('submit', 'Recepcionar Documento',array('type'=>'submit','class'=>'uiButton','id'=>'crear'));
echo '&nbsp;';
?>    
</p>
</td>
<td></td>
</tr>
<!--
<tr>        
    <td colspan="3">
        <div style="border: 1px solid #ccc; padding:5px; margin-top: 15px">
        <label for="" style=" font-weight: bold; color:#111; ">Archivo digital (.pdf < 20M)</label>
        <input type="file" name="archivo"/>
        </div>
    </td>
</tr>
-->
</table>
<br/>
</form>
</div>
