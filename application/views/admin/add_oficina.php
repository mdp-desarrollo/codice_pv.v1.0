<script type="text/javascript">
    $(function(){
        $("#frmOficina").validate();
    
        $('#padre').change(function()
        {
            var sigla=$(this).find('option:selected').text().split('|'); 
            $('#sigla').val(sigla[1]+'/').focus();
        });
    });
</script>
<h2 class="subtitulo">Crear oficina<br/><span>llene correctamente los datos del formulario</span></h2>
<?php if (sizeof($error) > 0): ?>
    <div class="error">
        <p><span style="float: left; margin-right: .3em;" class=""></span>
            <?php foreach ($error as $k => $v): ?>
                <strong><?= $k ?>: </strong> <?php echo $v; ?></p>
        <?php endforeach; ?>   
    </div>
<?php endif; ?>
<?php if (sizeof($info) > 0): ?>
    <div class="info">
        <p><span style="float: left; margin-right: .3em;" class=""></span>
            <?php foreach ($info as $k => $v): ?>
                <strong><?= $k ?>: </strong> <?php echo $v; ?></p>
        <?php endforeach; ?>   
    </div>
<?php endif; ?>
<form action="" method="post" id="frmOficina">
    <table width="100%" >
        <tr>
            <td>Entidad:</td>
            <td width="600" ><?php echo $entidad->entidad; ?></td>
        </tr>
        <tr>
            <td>Depende de:</td>
            <td><?php echo Form::select('padre', $options, HTML::chars(Arr::get($_POST, 'oficina', NULL)), array('id' => 'padre')); ?></td>
        </tr>
        <tr>
            <td>Nombre de la Oficina:</td>
            <td><?php echo Form::input('oficina', HTML::chars(Arr::get($_POST, 'oficina')),array('class'=>'required')); ?></td>
            <?php echo Form::hidden('entidad', $entidad->id); ?></td>
        </tr>
        <tr>
            <td>Sigla:</td>
            <td><?php echo Form::input('sigla', HTML::chars(Arr::get($_POST, 'sigla')), array('id' => 'sigla','class'=>'required')); ?></td>
        </tr>
        <tr>
            <td colspan="2">
                <hr/>
                <br/>
                <input type="submit" name="create" value="Crear Oficina" class="uibutton" />
            </td>
        </tr>
    </table>
    <?php ?>

</form>
