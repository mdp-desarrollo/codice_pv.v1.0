<script type="text/javascript">
    $(function(){
    
     var config={
        toolbar : [ ['SelectAll','Copy']]
        }
        $('#descripcion,textarea').ckeditor(config);   
               
    $('#replace').click(function(){ 
        $(this).hide();
       $('#file-word').fadeIn();
       $('#archivo').trigger('click');       
    });
    $('#cancelar').click(function(){ 
       $('#replace').show();
       $('#file-word').hide();       
    });   
});
</script>
<style>
    #file-word{ display: none;  }
    td{border-bottom: 1px solid #f0f0f0; padding:5px 0;}    
</style>
<h2 class="subtitulo">Descripción<br/><span>descripcion general del documento</span></h2>
<div id="formulario" >
<a href="/documento/editar/<?php echo $d->id; ?>" class="uibutton" title="Editar documento"><img src="/media/images/edit-doc.png" align="absmiddle" /> Editar documento</a>
<a href="/export.php?id=<?php echo $d->id; ?>" class="uibutton" target="_blank" title="Imprimir documento" ><img src="/media/images/print.png"/> Imprimir</a>
<a href="/hojaruta/deriv/?nur=<?php echo $d->nur; ?>" class="uibutton" title="Derivar a partir del documento, si ya esta derivado muestra el seguiemiento" ><img src="/media/images/derivar-doc.png"/> Derivar</a>
<a href="/word/carta.php?id=<?php echo $d->nur; ?>" class="uibutton" title="Enviar a un documento word" ><img src="/media/images/word07.gif"/> Enviar a Word</a>
<div style="text-align:center; margin: 5px 0; border-bottom: 1px solid #ccc;">
</div>
<?php if(sizeof($mensajes)>0):?>
<div style="margin-top: 20px; padding: 0 .7em;" class="message">
    <p><span style="float: left; margin-right: .3em;" class="ui-icon-info"></span>
    <?php foreach($mensajes as $k=>$v):?>
        <strong><?=$k?>: </strong> <?php echo $v;?></p>
    <?php endforeach;?>
</div>
<?php endif;?>

<?php if(sizeof($errors)>0):?>
<div style="margin-top: 20px; padding:10px;" class="error">
    <p><span style="float: left; margin-right: .3em;" class="ui-icon-alert"></span>
    <?php foreach($errors as $k=>$v):?>
        <strong><?=$k?>: </strong> <?php echo $v;?></p>
    <?php endforeach;?>
</div>
<?php endif;?>
<table id="theTable">
    <tbody>
        <tr>
            <td colspan="2">
        <h2><?php echo strtoupper($tipo);?></h2>
        <h2 style="color: #23599B;"><?php echo $d->cite_original;?></h2>
        <h2><?php echo $d->nur;?></h2>
            </td>
        </tr>
    <tr>
        <td><b>DESTINATARIO: </b></td>
        <td colspan="2"> <?php echo $d->nombre_destinatario;?><br/><b><?php echo $d->cargo_destinatario;?></b></td>
    </tr>
    <?php if(trim($d->nombre_via)!=''){ ?>
    <tr> 
        <td><b>VIA: </b><br/> </td>
        <td colspan="2"><?php echo $d->nombre_via;?><br/><b><?php echo $d->cargo_via;?></b></td>
    </tr>
    <?php } ?>
    <tr> 
        <td><b>REMITENTE: </b><br/> </td>
        <td colspan="2"><?php echo $d->nombre_remitente;?><br/><b><?php echo $d->cargo_remitente;?></b></td>
    </tr>
    <tr> 
        <td><b>FECHA DE CREACI&Oacute;N: </b><br/> </td>
        <td colspan="2"><?php
        $fecha=New controller_myClass($d->fecha_creacion);
       echo $fecha->larga();?></td>
    </tr>
     <?php
     echo Form::open('documentos/detalle/?id='.$d->id,array('id'=>'frmDerivar','enctype'=>'multipart/form-data'));
     echo Form::hidden('id_doc', $d->id);
     foreach($archivo as $a){ ?>
    <tr> 
        <td><b>ARCHIVO:</b><br/></td>
        <td colspan="2"><?php echo HTML::anchor('/descargar.php?id='.$a->id,substr($a->nombre_archivo,13));?><br/></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo HTML::anchor('#',  HTML::image('media/images/archive.png').' REEMPLAZAR DOC',array('id'=>'replace'));?>
            <div id="file-word">
            &nbsp;&nbsp;<label>Reemplazar archivo </label>(word/pdf)<br/>&nbsp;&nbsp;<?php echo Form::file('archivo', array('id'=>'archivo')) ;?>
            <?php echo Form::submit('rem', 'Reemplazar');?>
            <?php echo Form::input('cancelar', 'Cancelar',array('id'=>'cancelar','type'=>'button'));?>
            </div>
        </td>
    </tr>
    
    
    <?php  ?>
    <tr>
        <td></td>
        <td><?php echo HTML::anchor('#',  HTML::image('media/images/archive.png').' Adjuntar Archivo',array('id'=>'replace'));?>
            <div id="file-word">
            &nbsp;&nbsp;<label>Reemplazar archivo </label>(word/pdf)<br/>&nbsp;&nbsp;<?php echo Form::file('archivo', array('id'=>'archivo')) ;?>
            <?php echo Form::submit('rem', 'Adjuntar Archivo');?>
            <?php echo Form::input('cancelar', 'Cancelar',array('id'=>'cancelar','type'=>'button'));?>
            </div>
        </td>
    </tr>    
    <?php }    
    echo Form::close();
    ?>
    <tr> <td><b>REFERENCIA:</b><br/> </td>
         <td colspan="2"><?php echo $d->referencia;?></td>
    </tr>
   
    <tr><td colspan="3"></td></tr>
    <?php if(trim($d->contenido)!=''){ ?>
    <tr> <td></td>
        <td colspan="3">
            <div style="overflow:auto; width: 670px;">
           <?php echo Form::textarea('descripcion',$d->contenido,array('id'=>'descripcion'));?>
            </div>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo Form::hidden('id',$d->id,array('id'=>'id'));?>
</div>