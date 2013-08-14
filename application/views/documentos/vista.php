<script type="text/javascript">
    $(function(){
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
    *{ font-size: 13px; }
</style>
<h2 style="text-align: center;"><?php // echo strtoupper($d->id_tipo);?></h2>
<h2 style="text-align: center; color: #23599B;"><?php echo $d->cite_original;?></h2>
<h2 style="text-align: center;"><?php echo $d->nur;?></h2>
<hr/>
<table>
    <tr>
        <td><b>Destinatario:</b></td>
        <td colspan="2"><?php echo $d->nombre_destinatario;?><br/><b><?php echo $d->cargo_destinatario;?></b></td>
    </tr>
    <?php if(trim($d->nombre_via)!=''){ ?>
    <tr> 
        <td><b>Via:</b><br/> </td>
        <td colspan="2"><?php echo $d->nombre_via;?><br/><b><?php echo $d->cargo_via;?></b></td>
    </tr>
    <?php } ?>
    <tr> 
        <td><b>Remitente:</b><br/> </td>
        <td colspan="2"><?php echo $d->nombre_remitente;?><br/><b><?php echo $d->cargo_remitente;?></b></td>
    </tr>
    <tr> 
        <td><b>Fecha de Creacion:</b><br/> </td>
        <td colspan="2"><?php echo Date::fecha($d->fecha_creacion);?></td>
    </tr>
     <?php
     echo Form::open('documentos/detalle/?id='.$d->id,array('id'=>'frmDerivar','enctype'=>'multipart/form-data'));
     echo Form::hidden('id_doc', $d->id);
     if($archivo->id){ ?>
    <tr> 
        <td><b>Archivo:</b><br/></td>
        <td colspan="2"><?php echo HTML::anchor('/descargar.php?id='.$archivo->id,substr($archivo->nombre_archivo,13));?><br/></td>
    </tr>    
    <?php }    
    echo Form::close();
    ?>
    <tr> <td><b>Referencia:</b><br/> </td>
         <td colspan="2"><?php echo $d->referencia;?></td>
    </tr>
   
    <tr><td colspan="3"><hr/></td></tr>
    <?php if(trim($d->contenido)!=''){ ?>
    <tr> <td><br/> </td>
        <td colspan="3">
            <div style="overflow:auto; width: 650px; height: 300px;">
        <?php echo $d->contenido;?>
            </div></td>
    </tr>
    <?php } ?>
</table>
<?php echo Form::hidden('id',$d->id,array('id'=>'id'));?>