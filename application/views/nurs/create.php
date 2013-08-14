<h2 style="border-bottom: 1px dotted #ccc;">Crear NURI a partir del documento : <?php echo $documento->codigo;?><BR/><span>A continuacion elija el proceso para generar un nuevo NURI</span></h2>

<label>Rerefencia:</label>
<?php echo $documento->referencia;?>
<fieldset>
    <legend>Formulario para crear un NURI</legend>
    <h2></h2>
    <?php echo Form::open(URL::base().'nur/asignar/'.$documento->id);?>
    <table>
        <tr>
            <td><?php echo Form::label('proceso', 'Elija el proceso:')?></td>
            <td>                                
                <?php echo Form::hidden('id', $documento->id);?>
                <?php echo Form::select('proceso',$procesos);?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?php echo Form::submit('submit', 'Crear NURI', array('class'=>'submitbutton'))?>                
                
            </td>
        </tr>
    </table>
    <?php echo Form::close();?>
</fieldset>
<?php
?>
