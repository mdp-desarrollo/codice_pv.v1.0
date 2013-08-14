<script type="text/javascript">
$(function(){
    $('#frmOficina').validate();
    $('#padre').change(function(){
        var id=$(this).val(); //id oficina
        var peticion = $.ajax({
	url:'../json/sigla',
	type:'POST',
	data: { id : id },
	success: function(sigla) { $('#sigla').val(sigla);}, //mostramos el error
	error: function() { alert('Se ha producido un error Inesperado'); }
	});
    });
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
    <?php echo Form::open(URL::base().'oficinas/add',array('id'=>'frmOficina'));?>
    <p>
        <?php echo Form::label('dependencia', 'Dependencia: ');?>
        <br/>
        <?php echo Form::select('padre',$options,HTML::chars(Arr::get($_POST, 'padre')),array('class'=>'required','id'=>'padre'));?>
    </p>
    <p>
        <?php echo Form::label('nombre', 'Nombre de la oficina: ');?>
        <br/>
        <?php echo Form::input('nombre', HTML::chars(Arr::get($_POST, 'nombre')),array('size'=>50,'class'=>'required'));?>
    </p>
    <p>
        <?php echo Form::label('sigla', 'Sigla: ');?>
        <br/>
        <?php echo Form::input('sigla', HTML::chars(Arr::get($_POST, 'sigla')),array('size'=>30,'class'=>'required','id'=>'sigla'));?>
    </p>
    <hr/>
    <p>
      <?php echo Form::submit('submit', 'Crear Oficina')?>
    </p>
    <?php echo Form::close();?>

</fieldset>
<?php
?>
