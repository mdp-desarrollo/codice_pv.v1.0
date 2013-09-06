<script type="text/javascript">
$(function(){
    $("#frm").validate();
});
</script>

<h2 class="subtitulo">Crear una nueva fuente<br/><span>Llene correctamente los datos del formulario</span></h2>
<?php //if($mensaje!='') echo "Se creo corectamente la carpeta $mensaje"; ?>
<?php if(sizeof($error)>0): ?>
<ul>
    <?php foreach($error as $e):?>
    <li><?php echo $e?></li>
    <?php endforeach;?>
</ul>
<?php endif;?>
<?php if(sizeof($info)>0):?>
<div class="info">
    <p><span style="float: left; margin-right: .3em;" class=""></span>
    <?php foreach($info as $k=>$v):?>
        <strong><?=$k?>: </strong> <?php echo $v;?></p>
    <?php endforeach;?>   
</div>
 <?php endif;?>
<form method="post" action="/admin/pvorganismos/save" id="frm">
    <?php     
    echo Form::hidden('id',$pvorganismo->id);
    ?>
    <table>
        <tr>
            <td><?php echo Form::label('Codigo');?></td>
            <td><?php echo Form::input('codigo',$pvorganismo->codigo,array('class'=>'required number'));?></td>
        </tr>
        <tr>
            <td><?php echo Form::label('Denominacion');?></td>
            <td><?php echo Form::input('denominacion',$pvorganismo->denominacion,array('class'=>'required'));?></td>
        </tr>
        <tr>
            <td><?php echo Form::label('Sigla');?></td>
            <td><?php echo Form::input('sigla',$pvorganismo->sigla,array('class'=>'required'));?></td>
        </tr>
        <tr>
            <td><?php echo Form::label('Tipo');?></td>
            <td><?php echo Form::input('tipo',$pvorganismo->tipo,array('class'=>'required'));?></td>
        </tr>
    </table>
<hr/>
<br/>
<input type="submit" value="Guardar" name="create" class="uibutton" />
</form>    