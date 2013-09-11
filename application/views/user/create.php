<script type="text/javascript">
$(function(){
    var pass1=$("#password").val();
    var pass2=$("#password_confirm").val();
    $("#frmUsuario").validate();
    //verificar usuario
    $('#username').blur(function(){    
    var username=$('#username').val();
    $.ajax({
	            type: "POST",
	            data: { username : username },
	            url: "/ajax/username",
	            dataType: "json",
	            success: function(data)
	            {   
                        if(data.result==1)
                            {
                                alert("El usuario '"+username+"' ya existe en la BD, elija otro por favor.");
                                $('#username').focus();
                            }                                 
	            }
          });
    });
    
        $('#email').blur(function(){
        var email=$('#email').val();
        $.ajax({
	            type: "POST",
	            data: { email : email },
	            url: "/ajax/email",
	            dataType: "json",
	            success: function(data)
	            {                      
                        if(data.result==1)
                            {
                                alert("El email '"+email+"' ya existe en la BD, elija otro por favor.");
                                $('#email').focus();
                            }                                 
	            }
          });
    });
    
//    $('#email').blur(function(){
//        var username=$('#email').val();
//        $.ajax({
//	            type: "POST",
//	            data: { username : username },
//	            url: "/ajax/email",
//	            dataType: "json",
//	            success: function(data)
//	            {                      
//                        $.each(data, function(x,item){
//                            $('#email_error').val(item);
//                        });                        
//	            }
//          });
//    });
});
</script>

<h2 class="subtitulo">Crear usuario<br/><span>paso 2: llene correctamente el formulario</span></h2>
<?php if ($message) : ?>
    <h3 class="message">
        <?php echo $message; ?>
    </h3>
<?php endif; ?>
<?php echo Form::open('/admin/user/create/'.$oficina->id,array('id'=>'frmUsuario')); ?>
<?php echo Form::hidden('id_oficina', $oficina->id);?>
<?php echo Form::hidden('id_entidad', $oficina->id_entidad);?>
<?php echo Form::hidden('user_error', 0,array('id'=>'user_error'));?>
<table id="form">
<tr>
    <td>
    <?php echo Form::label('Entidad'); ?>    
    </td>
    <td>
    <?php echo $entidad->entidad; ?>
    </td>
</tr>
<tr>
    <td>
    <?php echo Form::label('Oficina');?>
    </td>
    <td>
    <?php echo $oficina->oficina;?>    
    </td>
    
</tr>
<tr>
    <td>
     <?php echo Form::label('rol','Rol:');?>   
    </td>
    <td>
    <?php echo Form::select('nivel', $options,HTML::chars(Arr::get($_POST, 'nivel')),array('id'=>'nivel'));?>    
    <span class="error">
    <?php echo Arr::get($errors, 'oficina'); ?>
    </span>
    </td>
</tr>
<tr>
    <td>
     <?php echo Form::label('superior','Superior:');?>   
    </td>
    <td>
    <?php echo Form::select('superior', $jefes,HTML::chars(Arr::get($_POST, 'superior',0)),array('id'=>'superior'));?>    
    <span class="error">
    <?php // echo Arr::get($errors, 'oficina'); ?>
    </span>
    </td>
</tr>
<tr>
    <td>
    <?php echo Form::label('nombre', 'Nombre Completo:'); ?>                    
    </td>
    <td>
    <?php echo Form::input('nombre', HTML::chars(Arr::get($_POST, 'nombre')),array('size'=>70,'class'=>'required')); ?>
    </td>
</tr>
<tr>
    <td>
    <?php echo Form::label('genero', 'Genero:'); ?>    
    </td>
    <td>
    <?php echo Form::select('genero',array('hombre'=>'Hombre','mujer'=>'Mujer'), HTML::chars(Arr::get($_POST, 'genero'))); ?>
    Mosca: <?php echo Form::input('mosca', HTML::chars(Arr::get($_POST, 'mosca'))); ?>
    <span class="error">
       <?php echo Arr::get($errors, 'mosca'); ?>
    </span>    
    </td>
</tr>
<tr>
    <td>
    <?php echo Form::label('cargo', 'Cargo:'); ?>
    </td>
    <td>
    <?php echo Form::input('cargo', HTML::chars(Arr::get($_POST, 'cargo')),array('size'=>70,'class'=>'required')); ?>
    <span class="error">
    <?php echo Arr::get($errors, 'cargo'); ?>
    </span>    
    </td>
</tr>
<tr>
    <td>
    <?php echo Form::label('email', 'Direcci&oacute;n Email:'); ?>    
    </td>
    <td>
    <?php echo Form::input('email', HTML::chars(Arr::get($_POST, 'email')),array('size'=>70,'id'=>'email','class'=>'required email')); ?>
    <span class="error">
       <?php echo Arr::get($errors, 'email'); ?>
    </span>    
    </td>
</tr>
<tr>
    <td>
    <?php echo Form::label('categoria', 'Categoria: ');?>    
    </td>
    <td>
    <?php echo Form::select('id_categoria', $pvcategoria,HTML::chars(Arr::get($_POST, 'categoria|')),array('id'=>'categoria'));?>              
    </td>
</tr>
<tr>
    <td>
    <?php echo Form::label('superior', 'Superior: ');?>    
    </td>
    <td>
    <?php echo Form::select('dependencia', array(0=>'Jefe de Oficina',1=>'Dependiente'), NULL); ?>                   
    </td>
</tr>
<tr>
    <td>
    <?php echo Form::label('username', 'Usuario:'); ?>    
    </td>
    <td>
    <?php echo Form::input('username', HTML::chars(Arr::get($_POST, 'username')),array('id'=>'username','class'=>'required')); ?>
    <span id="userDisp"></span>
    <span class="error">
        <?php echo Arr::get($errors, 'username'); ?>
    </span>    
    </td>
</tr>
<tr>
    <td>
    <?php echo Form::label('password', 'Contrase&ntilde;a:'); ?>    
    </td>
    <td>
    <?php echo Form::password('password','',array('id'=>'password','minlength'=>6,'class'=>'required')); ?>
    <span class="error">
    <?php echo Arr::get($errors, 'password'); ?>
    </span>    
    </td>
</tr>
<tr>
    <td>
    <?php echo Form::label('password_confirm', 'Confirmar Contrase&ntilde;a:'); ?>    
    </td>
    <td>
    <?php echo Form::password('password_confirm','',array('id'=>'password_confirm','equalTo'=>"#password")); ?>
    <span class="error">
    <?php echo Arr::path($errors, '_external.password_confirm'); ?>
    </span>    
    </td>
</tr>
<tr>
    <td colspan="2" align="center">
    <hr/>
    </td>    
</tr>
<tr>
    <td colspan="2" align="center">
    <br/>
    <?php echo Form::input('create', 'Crear usuario',array( 'type'=>'submit', 'class'=>'uibutton')); ?>    
    </td>    
</tr>
</table>    
<?php echo Form::close(); ?>
