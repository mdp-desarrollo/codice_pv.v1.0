<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" xmlns:b="http://www.google.com/2005/gml/b" xmlns:data="http://www.google.com/2005/gml/data" xmlns:expr="http://www.google.com/2005/gml/expr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<!--[if IE]> <script> (function() { var html5 = ("abbr,article,aside,audio,canvas,datalist,details," + "figure,footer,header,hgroup,mark,menu,meter,nav,output," + "progress,section,time,video").split(','); for (var i = 0; i < html5.length; i++) { document.createElement(html5[i]); } })(); </script> <![endif]-->
<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="es" />
    <link rel="shortcut icon" href="/media/images/icon.png" />
    <title><?php echo $title;?></title>
    <meta name="keywords" content="<?php echo $meta_keywords;?>" />
    <meta name="description" content="<?php echo $meta_description;?>" />
    <meta name="copyright" content="<?php echo $meta_copywrite;?>" />
    <?php foreach($styles as $file => $type) { echo HTML::style($file, array('media' => $type)), "\n"; }?>
    <?php foreach($scripts as $file) { echo HTML::script($file, NULL, TRUE), "\n"; }?>
<!--[if lte IE 6]> <style type='text/css'> #lsidebar-wrapper{float:left;margin-left:5px;} #rsidebar-wrapper{float:right;margin-right:5px;} </style> <![endif]-->
<script type="text/javascript">
    //menu principal    
        $(function(){
            $('#frmlogin').validate();
            $('#usuario').focus();
        });
</script>
</head>
<body>
<div id="header">
<div class="limiter">

</div>
</div>
<div id="prime" >    
    <h3 style="margin: 0 auto; display: block; text-align: center;">Sistema Automatizado para el Manejo  de Correspondencia</h3>
    <div id="login">
    <div id="contact">
        <form method="post" action="/login" id="frmlogin" >     
                <p>
                   <h1>Ingreso al Sistema</h1>                   
                </p>                
                <?php echo Form::hidden('intentos', '0')?>
                <p style="margin-top: 10px;">
                    <?php echo Form::label('usuario', 'Usuario ');?>
                    <?php echo Form::input('usuario', NULL, array( 'title'=>'requerido','class'=>'required inplaceError','autocomplete'=>'off','id'=>'usuario'));?>
                </p>
                <p>                    
                    <?php echo Form::label('password','Contrase&ntilde;a ');
                          echo Form::password('password','',array('title'=>'requerido','id'=>'password','class'=>'inplaceError required','autocomplete'=>'off')); ?>                    					
                </p>                            
                <p class="submit">
                    <input id="send" type="submit" value="Entrar" name='submit'/>
		   <span id="success_message" class="success">¿Haz Olvidado tu contraseña?</span>
                </p>		
            </form>
        </div>
    </div>
</div>

    
<div id="secondary">
    Copyright © Sistemas 2011 - Ministerio de Desarrollo Productivo y Econom&iacute;a Plural <br/>
    ESTADO PLURINACIONAL DE BOLIVIA
</div>
<script type="text/javascript">
            $(function() {
             
                
				//cargar pagina
			//	QueryLoader.init();
            });
        </script>   
</body>
</html>