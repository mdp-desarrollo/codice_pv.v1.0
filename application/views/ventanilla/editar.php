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
$('#btnword').click(function(){
        $('#word').val(1);
        return true

    });
$('#crear').click(function(){
        $('#word').val(0);
        return true
    });
});
</script>

<div id="documento">
             
</div>
<h2 class="subtitulo">Editar: <?php echo $documento->nur;?><br/><span>Recepcion de documentos externos</span></h2>
<a href="/ventanilla" class="uiButton uiButtonConfirm" title="Recepcionar otro documento" style="color:#fff;"><img src="/media/images/doc.png" align="absmiddle" alt="" /> RECEPCIONAR OTRO</a>
<a href="/print_hr.php?nur=<?php echo $documento->nur; ?>" class="uiButton" title="Imprimir hoja de ruta" ><img src="/media/images/printer.png" align="absmiddle" alt="" /> HOJA DE RUTA</a>
<a href="/hojaruta/derivar/?id_doc=<?php echo $documento->id; ?>" class="uiButton" title="Derivar a partir del documento, si ya esta derivado muestra el seguimiento" ><img src="/media/images/users.png" align="absmiddle" alt="" /> Derivar Doc</a>
<hr/>
<?php if(sizeof($error)>0):?>
<div class="error">
    <p><span style="float: left; margin-right: .3em;" class=""></span>
    <?php foreach($error as $k=>$v):?>
        <strong><?=$k?>: </strong> <?php echo $v;?></p>
    <?php endforeach;?>
</div>
<br/>
<?php endif;?>
<?php if(sizeof($info)>0):?>
<div class="info2">
    <p><span style="float: left; margin-right: .3em;" class=""></span>
    <?php foreach($info as $k=>$v):?>
        <strong><?=$k?>: </strong> <?php echo $v;?></p>
    <?php endforeach;?>
</div>
<br/>
<?php endif;?>
<div class="formulario">
<form action="" method="post" enctype="multipart/form-data" id="frmCreate">
<table width="100%">
<tr>
<td style=" border-right:1px dashed #ccc; padding-left: 5px;">
   <?php
echo Form::label('cite', 'Cite original:',array('class'=>'form'));
echo Form::input('cite',$documento->cite_original,array('id'=>'cite','size'=>40,'class'=>'required'));
?> 
  <?php
   echo Form::label('Destinatario', 'Destinatario:',array('class'=>'form'));
   echo Form::input('destinatario',$documento->nombre_destinatario,array('id'=>'destinatario','size'=>40,'class'=>'required'));
?>
<?php
   echo Form::label('cargodes', 'Cargo destinatario:',array('class'=>'form'));
   echo Form::input('cargodes',$documento->cargo_destinatario,array('id'=>'cargodes','size'=>40,'class'=>'required','title'=>'Ejemplo: Lo citado'));
?>
<?php
   echo Form::label('insituciondes', 'Institucion Destinatario:',array('class'=>'form'));
   echo Form::input('instituciondes',$documento->institucion_destinatario,array('id'=>'instituciondes','size'=>40,'class'=>'required'));
   ?>
</td>
<td style=" border-right:1px dashed #ccc; padding-left: 5px;">
 <?php
echo Form::label('fecha', 'Fecha del documento:',array('class'=>'form'));
echo Form::select('dia',$days,date('d',strtotime($documento->fecha_creacion)));
echo Form::select('mes',$months,date('m',strtotime($documento->fecha_creacion)));
echo Form::select('year',$years,date('Y',strtotime($documento->fecha_creacion)));
?>    
<?php
echo Form::label('remitente', 'Remitente:',array('class'=>'form'));
echo Form::input('remitente',$documento->nombre_remitente,array('id'=>'remitente','size'=>40,'class'=>'required'));
?>
<?php
echo Form::label('cargorem', 'Cargo Remitente:',array('class'=>'form'));
echo Form::input('cargorem',$documento->cargo_remitente,array('id'=>'cargorem','size'=>40,'class'=>'required'));
?>
<?php
   echo Form::label('institucionrem', 'Intitucion Remitente:',array('class'=>'form'));
   echo Form::input('institucionrem',$documento->institucion_remitente,array('id'=>'intitucionrem','size'=>40,'class'=>'required'));            
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
    <textarea id="descripcion" name="descripcion" style="width:500px;" class="required"><?php echo $documento->referencia;?></textarea>    
<br/>    
<br/>
</td>
</tr>
</table>
<table>
<tr>
   <!-- <td>        
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
       // echo Form::select('proceso',$procesos,'',array('id'=>'proceso','style'=>'width:240px;')); 
        ?>
    </td>
    -->
    <td>        
        <?php 
        echo Form::label('adjunto','Adjunto:');
        echo Form::input('adjunto',$documento->adjuntos,array('id'=>'adjunto','size'=>40)); 
        ?>
    </td>
    <td>
        <?php 
        echo Form::label('hojas','N° de hojas:');
        echo Form::input('hojas',$documento->hojas,array('id'=>'hojas')); 
        ?>
    </td>
</tr>
<tr>
    <td colspan="3"><br/></td>
</tr>
<tr>            
    <?php if(isset($archivo->id)):?>
    <td>
        <a href="/descargar.php?id=<?php echo $archivo->id;?>" style="color: #1C4781; text-decoration: underline;  "><?php echo substr($archivo->nombre_archivo,13);?></a>
        <input type="hidden" value="<?php echo $archivo->id;?>" name="id_archivo"/>    
    </td>
    <td colspan="2">        
        <label for="" style=" font-weight: bold; color:#333;">Cambiar documento escaneado (.pdf < 20M)</label>
        <input type="file" name="archivo"/>
    </td>
    <?php else:?>
    <td colspan="2">   
        <input type="hidden" value="0" name="id_archivo"/>
        <label for="" style=" font-weight: bold; color:#333;">Subir documento escaneado (.pdf < 20M)</label>
        <input type="file" name="archivo"/>
    </td>
    <?php endif;?>    
    
</tr>
<tr>
<td colspan="3">
<p>
<?php
echo '<hr/><br/>';
echo Form::input('submit', 'Modificar',array('type'=>'submit','class'=>'uiButton','id'=>'crear'));
echo '&nbsp;';
?>
    
</p>
</td>
<td></td>
</tr>
</table>
<br/>
</form>
</div>
