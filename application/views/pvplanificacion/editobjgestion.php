<script type="text/javascript">

$(function(){
    $('#frmCreate').validate();
});
</script>
<style>
    #file-word{ display: none;  }
    td{padding:5px;}    
</style>
<div style="width: 800px;"><h2 class="subtitulo">Obgetivos de Gesti&oacute;n<br/><span>Llene corresctamente los datos en el formulario</span></h2></div>
<table border="0">
    <tr>
        <td><b>Entidad:</b></td>
        <td><?php echo $entidad->entidad;?></td>
    </tr>
    <tr>
        <td><b>Unidad Ejecutora:</b></td>
        <td><?php echo $oficina->oficina;?></td>
    </tr>
</table>
<br />
<div class="formulario">
<br />
<h2>Adicionar Partida de Gasto a la Ejecucion presupuestaria</h2>
<form action="/pvplanificacion/editobjgestion/<?php echo $objetivo->id;?>" method="post" id="frmCreate">
<input type="hidden" id="id_oficina" name="id_oficina" value="<?php echo $oficina->id;?>" />
<table>
    <tr>
        <td><?php echo Form::label('codigo','Codigo')?></td>
        <td><?php echo Form::input('codigo',$objetivo->codigo,array('name'=>'codigo','id'=>'codigo','class'=>'required')) ?></td>
    </tr>
    <tr>
        <td><?php echo Form::label('objetivo','Objetivo de Gestion')?></td>
        <td><textarea id="objetivo" name="objetivo" class="required" rows="10"><?php echo $objetivo->objetivo;?></textarea></td>
    </tr>
</table>

<input type="submit" value="Modificar Objetivo" class="uibutton" name="submit" id="crear" title="Editar Objetivo de Gestion."  />
</form>
<div class="info" style="text-align:center;margin-top: 20px;">
    <p><span style="float: left; margin-right: .3em;" class=""></span>    
      &larr;<a onclick="javascript:history.back(); return false;" href="#" style="font-weight: bold; text-decoration: underline;  " > Regresar<a/></p>    
</div>
</div>