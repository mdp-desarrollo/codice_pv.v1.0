<?php ?>
<script type="text/javascript">    
$(function(){        
//incluir destinatario
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
    
$('#crear').click(function(){        
        return true
    });
});
</script>

<div id="documento">
             
</div>
<h2 class="subtitulo">Formulario de Recepci&oacute;n<br/><span>Recepcion de documentos externos</span></h2>
<div id="formulario">
<?php echo Form::open('/documentos/recepcion/', array('enctype' => 'multipart/form-data','id'=>'frmCreate')); ?>    
<table width="100%">
<tr>
<td style=" border-right:1px dashed #ccc; padding-left: 5px;">
   <?php
echo Form::label('cite', 'Cite original:',array('class'=>'form'));
echo Form::input('cite','',array('id'=>'cite','size'=>40,'class'=>'required'));
?> 
  <?php
   echo Form::label('Destinatario', 'Destinatario:',array('class'=>'form'));
   echo Form::input('destinatario','',array('id'=>'destinatario','size'=>40,'class'=>'required'));
?>
<?php
   echo Form::label('cargodes', 'Cargo destinatario:',array('class'=>'form'));
   echo Form::input('cargodes','',array('id'=>'cargodes','size'=>40,'class'=>'required','title'=>'Ejemplo: Lo citado'));
?>
<?php
   echo Form::label('insituciondes', 'Institucion Destinatario:',array('class'=>'form'));
   echo Form::input('instituciondes','',array('id'=>'instituciondes','size'=>40,'class'=>'required'));
            ?>
</td>
<td style=" border-right:1px dashed #ccc; padding-left: 5px;">
 <?php
echo Form::label('fecha', 'Fecha:',array('class'=>'form'));
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
   echo Form::label('intitucion', 'Intitucion Remitente:',array('class'=>'form'));
   echo Form::input('intitucion Remitente','',array('id'=>'intitucionrem','size'=>40,'class'=>'required'));            
?>     
</td>

<?php // if($documento->via>0){  ?>
<?php if(sizeof($destinos)>0){  ?>
<td style="padding-left: 5px;">
    <?php echo Form::label('dest','Destinatarios:');?>
    <div id="vias">
        <ul>
            <?php foreach($destinos  as $d): ?>
            <li class="<?php echo $d->genero?>"><?php echo HTML::anchor('#',$d->nombre,array('class'=>'destino','nombre'=>$d->nombre,'title'=>$d->cargo,'cargo'=>$d->cargo,'institucion'=>$d->entidad));?></li>
            <?php endforeach; ?>            
        </ul>
    </div>
</td>
<?php 
}
?>
</tr>

<tr>
<td colspan="3" style="padding-left: 5px;">
<?php
echo Form::label('referencia', 'Referencia:',array('class'=>'form'));
echo Form::textarea('descripcion','',array('id'=>'descripcion','cols'=>50,'rows'=>4));
?> 
<br/>    
<br/>
</td>
</tr>
<tr>
    <td>        
        <?php 
        echo Form::label('grupo','Grupo Remitente:');
        echo Form::select('grupo',$grupos,'',array('id'=>'grupo','style'=>'width:240px;')); 
        ?>
    </td>
    <td>
        <?php 
        echo Form::label('motivo','Motivo:');
        echo Form::select('motivo',$motivos,'',array('id'=>'motivo','style'=>'width:240px;')); 
        ?>
    </td>
</tr>
<tr>
    <td colspan="2">
        <?php 
        echo Form::label('proceso','Proceso:');
        echo Form::select('proceso',$procesos,'',array('id'=>'proceso','style'=>'width:240px;')); 
        ?>
    </td>
</tr>
<tr>
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
<td colspan="3">
<p>
<?php
echo '<hr/><br/>';
echo Form::input('submit', 'Crear Documento',array('type'=>'submit','class'=>'uiButton','id'=>'crear'));
echo '&nbsp;';
echo Form::input('reset', 'Resetear Campos', array('type'=>'reset','class'=>'uiButton'));
echo Form::close(); //fin del formulario
?>    
</p>
</td>
<td></td>
</tr>
</table>
<br/>

</div>
