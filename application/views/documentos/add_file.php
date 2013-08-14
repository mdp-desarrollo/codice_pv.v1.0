<h2 class="subtitulo">Subir archivo digital<br/><span>Escoja los archivos y luego presione subir.</span></h2>
<form method="post" enctype="multipart/form-data" action="" >
<?php for($i=1;$i<5;$i++):?>
<?php echo Form::file('archivo[]')?><br/>    
<?php endfor;?>
<input type="submit" name="submit" value="subir"/>
</form>
