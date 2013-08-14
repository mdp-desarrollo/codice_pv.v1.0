<div id="page">
    <div id="arriba">
        <div class="contenido">
            <img src="views/images/titulo3.jpg">	    
        </div>

    </div>

    <div id="content"><a href="" class="back"></a>
<div class="menuWrapper bg1" id="menuWrapper">
<ul id="menu" class="menu">
	<li style="background-position: 0 0;" class="bg1" id="bg1"><a href="#">INICIO</a>
	<ul style="background-position: 0 250px;" class="sub1">
		<li style="display: none;"><a href="#">Pagina Principal</a></li>		
	</ul>
	</li>
	<li style="background-position: -249px 0px;" class="bg1" id="bg2"><a href="#">PROYECTOS</a>
	<ul style="background-position: 0 250px;" class="sub2">
		<li style="display: none;"><a href="#" title="Proyectos que actualmente se estan ejecutando en Inversion Publica">Inversion Pública</a></li>
		<li style="display: none;"><a href="#">Inversion Estrategica</a></li>
		<li style="display: none;"><a href="#">Recaudaciones</a></li>
	</ul>
	</li>
	<li style="background-position: -498px 0px;" class="bg1" id="bg3"><a href="#">CONTACTOS</a>
	<ul style="background-position: 0 250px;" class="sub3">
		<li style="display: none;"><a href="#">Submenu 1</a></li>
		<li style="display: none;"><a href="#">Submenu 2</a></li>
		<li style="display: none;"><a href="#">Submenu 3</a></li>
	</ul>
	</li>
	<li style="background-position: -747px 0px;" class="last bg1" id="bg4"><a href="#">MANUALES</a>
	<ul style="background-position: 0 250px;" class="sub4">
		<li style="display: none;"><a href="#">MANUAL DEL SISTEMA</a></li>
		<li style="display: none;"><a href="#">PRESENTACION DEL SISTEMA</a></li>
	</ul>
	</li>
</ul>
</div>
        <div id="main">
        <div class="contenido">
<div id="formulario">

		<fieldset><legend> &nbsp; Ingreso:</legend>
        <div id="carga" style="display: none;">Identificando Usuario....</div>
		<div id="err" style="display: none;" class="ui-state-highlight"><p><span style="float: left;" class="ui-icon ui-icon-alert"></span>Usuario y/o contraseña incorrectas</p></div>        
		<ul id="messageBox"></ul> 
		<form method="post" id="login" action="identificarse.php?controller=login&amp;action=identificarse">
		<p><span>Usuario: </span>
		<input type="text" size="30" style=" width:90%;margin-bottom:10px;  padding: .2em;" id="usuario" title="Ingrese su usuario" class="required text ui-widget-content ui-corner-all" name="usuario">
		<span>Contraseña: </span>
		<input type="password" size="30" style="width:90%; margin-bottom:10px; padding: .2em; " id="password" title="Ingrese su Contraseña" class="required text ui-widget-content ui-corner-all" name="password"></p>

<input type="submit" class="login ui-button ui-widget ui-state-default ui-corner-all" id="entrar" value="Entrar" role="button" aria-disabled="false">
</form>
</fieldset>
</div>   
<div class="text">
    	<h5>Bienvenido...</h5>
        <p>La Dirección General de Planificación del Ministerio de Obras Públicas, Servicios y Vivienda, le da la mas cordial bienvenida. Aqui podra consultar información referente a los proyectos del Ministerio y de las diferentes entidades dependientes y bajo tuición.</p>
    <p>
        <span><img width="101" height="62" src="views/images/transporte.jpg" alt="mantenimientox  "></span>
        <span><img width="101" height="62" src="views/images/caminos.jpg" alt="caminos"></span>
        <span><img width="101" height="62" src="views/images/telecentros.jpg" alt="telecentros"></span>
        <span><img width="101" height="62" src="views/images/viviendas.jpg" alt="viviendas"></span>
        <span><img width="101" height="62" src="views/images/doblevia.jpg" alt="caminos"></span>
        <span><img width="101" height="62" src="views/images/aeropuertos.jpg" alt="aeropuertos"></span>
       <br>
       <br>
       <br>
       <br>
       <br>
       
    </p>
    </div>
            
    </div>
</div>
<div id="abajo">
Copyright &copy; <a title="Programado por: Ivan Marcelo Chacolla Morochi" href="mailto:ivanmarceloch_hp49@hotmail.com">Sistemas 2010 </a> - <span style="color:#000;">Ministerio de Obras Públicas, Servicios y Vivienda</span>
<br>Página Web: <a title="Pagina Web" href="http://www.oopp.gob.bo">wwww.oopp.gob.bo </a>
</div>
</div>
</div>
<script src="views/js/jquery.bgpos.js" type="text/javascript"></script>
<script type="text/javascript">
            $(function() {
                /* position of the &lt;li&gt; that is currently shown */
                var current = 0;				
				var loaded  = 0;
				var item = 'bg1';
				for(var i = 1; i &lt;5; ++i)
					$('&lt;img /&gt;').load(function(){
						++loaded;
						if(loaded == 3){
				$("#bg1,#bg2,#bg3,#bg4").mouseover(					
						function(e){							
							var $this=$(this);							
							/* if we hover the current one, then don't do anything */							
							/* item is bg1 or bg2 or bg3, depending where we are hovering */
							 item = $(this).attr('id');											
							$(this).children('a').stop().animate({"margin-top":"280px"},200);							
							$(this).children('ul').stop().animate({backgroundPosition:"(0 0px)"},200,function(){
								$(this).children('li').fadeIn(100);							
							});
							//fondo									
							if($this.index() == current)
								return;							
							if(parseInt(current)&lt;$this.index()){
							$('#bg1,#bg2,#bg3,#bg4').animate({backgroundPosition:"(800px 0)"},0).removeClass('bg1 bg2 bg3 bg4').addClass(item);												
							move(1,item);
							}
							else{
							$('#bg1,#bg2,#bg3,#bg4').animate({backgroundPosition:"(-800px 0)"},0).removeClass('bg1 bg2 bg3 bg4').addClass(item);	
							move(0,item);	
							}
								
						});
				$("#bg1,#bg2,#bg3,#bg4").mouseout(
						//blur						
						function(){		
							current = $(this).index();
							$(this).children('a').stop().animate({"margin-top":"240px"},200);																	
							$(this).children('ul').stop().animate({backgroundPosition:"(0 250px)"},200,function(){
								$(this).children('li').hide();							
							});							
						});	
						//ocultamos los sub menus al inicio		
						$('#menu li ul li').hide();
						}
					}).attr('src', 'views/images/'+i+'.jpg');
                /*220 antofagasta*/                
                function move(dir,item){
                    if(dir){
                        $('#bg1').stop().animate({backgroundPosition:"(0 0)"},200);
                        $('#bg2').stop().animate({backgroundPosition:"(-249px 0)"},300);
                        $('#bg3').stop().animate({backgroundPosition:"(-498px 0)"},300);
                        $('#bg4').stop().animate({backgroundPosition:"(-747px 0)"},400,function(){
                        	$('#menuWrapper').removeClass('bg1 bg2 bg3 bg4').addClass(item);
                        });
                    }
                    else{
                        $('#bg1').stop().animate({backgroundPosition:"(0 0)"},400,function(){
                            $('#menuWrapper').removeClass('bg1 bg2 bg3 bg4').addClass(item);
                        });
                        $('#bg2').stop().animate({backgroundPosition:"(-249px 0)"},300);
                        $('#bg3').stop().animate({backgroundPosition:"(-498px 0)"},200);
                        $('#bg4').stop().animate({backgroundPosition:"(-747px 0)"},200);
                    }
                }
				//cargar pagina
				QueryLoader.init();
            });
        </script>   


<div class="QOverlay" style="position: fixed; top: 0px; left: 0px; width: 1440px; height: 766px; display: none;"><div class="QLoader" style="position: relative; top: 0px; width: 100%; overflow: hidden; display: block; height: 766px;"></div><div class="QAmt" style="position: relative; top: 50%; left: 50%; display: none;">100%</div></div></body>
<div id="formContainer">

    <h1>Contact Form</h1>		<form class="formGen" action="" method="post">
    	
		                
                <div class="formRow">
                
                <label for="field0">
                    Your name<span class="star">*</span>:                </label>
                                        <input type="text" class="textField required" id="field0" name="field0">
                                        
                </div>
                
                                
                <div class="formRow">
                
                <label for="field1">
                    Email<span class="star">*</span>:                </label>
                                        <input type="text" class="textField required email" id="field1" name="field1">
                                        
                </div>
                
                                
                <div class="formRow">
                
                <label for="field2">
                    Subject:                </label>
                                        
                        <select class="select" id="field2" name="field2" style="display: none;">
                        
                                                    	<option value="0">Please Choose</option>
                                                        	<option value="1">Business proposition</option>
                                                        	<option value="2">Partnership</option>
                                                        	<option value="3">General Inquiry</option>
                                                    
                        </select><span style="width: 138px; z-index: 1000;" class="selectContainer"><div class="selectBox">Please Choose</div><span></span><ul class="dropDown" style="display: none;"><li>Please Choose</li><li>Business proposition</li><li>Partnership</li><li>General Inquiry</li></ul></span>
                        
                                        
                </div>
                
                                
                <div class="formRow">
                
                <label for="field3">
                    Message<span class="star">*</span>:                </label>
                                        <textarea class="textArea required" cols="40" rows="5" id="field3" name="field3"></textarea>
                                        
                </div>
                
                                
                <div class="formRow">
                
                <label for="field4">
                    6 + 5 =                </label>
                                        <input type="text" class="textField required captcha" id="field4" name="field4">
                                        
                </div>
                
                        <div class="formRow">
           <input type="submit" id="submit" value="Submit Form" style="display: none;"><span class="button">Submit Form<span></span></span>
        </div>
		</form>

		  
</div>



<fieldset><legend> Sistema de Administracion de Correspondencia</legend>     
 <?php echo Form::open(URL::base().'admin'); ?>
    <p>
     <?php echo Form::label('usuario', 'Usuario: ');
     echo Form::input('usuario', '');?>
    </p>
    <p>
     <?php echo Form::label('password','Contrase&ntilde;a: ');
     echo Form::password('password','',array('id'=>'password')); ?>
    </p><hr/>
    <p>
     <?php echo Form::input('submit', 'Ingresar', array('type'=>'submit','id'=>'submit')); ?>
     </p>
<?php echo Form::close(); ?>
</fieldset>