<h2 class="subtitulo">Crear nuevo usuario<br/><span>PASO 1: ELIJA ENTIDAD A LA QUE PERTENECE</span></h2>
<?php 
    echo Form::open('/admin/user/nuevo/');
    echo Form::label('Elija Entidad');
    echo Form::select('entidad', $options, Arr::get($_GET, 'e',NULL));
    echo '<hr/>';
    echo Form::input('paso1','SIGUIENTE >>',Array('type'=>'submit','class'=>'uibutton'));
    echo form::close();
?>