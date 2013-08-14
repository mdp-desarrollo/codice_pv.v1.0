<script type="text/javascript">
$(function(){
    $('#frmOficina').validate();

    $('#oficina').change(function(){
        var d=$(this).val(); //id oficina
        var id=$(this).attr('id'); //el id
	$('#superior option').hide();
	$('#superior option').each(function(index,domEle){
	if($(this).attr('class')==d){
	$(this).show();
	}
	});
	$('#superior option:visible:first').attr('selected','selected');

    });
    $('#oficina').trigger('change');
});
</script>


<h2 style="border-bottom: 1px dotted #ccc;">Crear una Oficina<br/><span>LLene correctamente los datos del siguiente formulario</span></h2>
<?php if ($message) : ?>
    <h3 class="message">
        <?php echo $message; ?>
    </h3>
<?php endif; ?>

<fieldset>
    <legend>Formulario de creación: </legend>
    <?php echo Form::open(URL::base().'cargo/add',array('id'=>'frmOficina'));?>
    <p>
        <?php echo Form::label('oficina', 'Oficina: ');?>
        <br/>
        <?php echo Form::select('oficina',$options,HTML::chars(Arr::get($_POST, 'oficina')),array('class'=>'required','id'=>'oficina'));?>
    </p>
    <p>
        <?php echo Form::label('superior', 'Superior: ');?>
        <br/>
        <select name="superior" id="superior">
            <?php echo $opCargos; ?>
        </select>

    </p>
    <p>
        <?php echo Form::label('cargo', 'Nombre de la oficina: ');?>
        <br/>
        <?php echo Form::input('cargo', HTML::chars(Arr::get($_POST, 'cargo')),array('size'=>60,'class'=>'required'));?>
    </p>
    <hr/>
    <p>
      <?php echo Form::submit('submit', 'Crear Oficina')?>
    </p>
    <?php echo Form::close();?>

</fieldset>
<?php
?>
