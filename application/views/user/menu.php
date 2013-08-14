<?php 
     $home=HTML::image('media/images/logo.png',array('height'=>80));
   //echo HTML::anchor(URL::base(),$home);?>

                    <div class="inner-border">
                        <div id="perfil">
                            <span class="negro">Bandeja </span><span class="gris">de Entrada</span>
                    </div>
                    </div>
                    <ul class="menu-correo">
                        <li><?php echo HTML::anchor('entrada/bandeja','<span class="recepcion icon">No Recibidos</span>');?></li>
                        <li><?php echo HTML::anchor('entrada/bandeja','<span class="pendientes icon">Pendientes</span>');?></li>
                        <li><?php echo HTML::anchor('entrada/bandeja','<span class="archivos icon">Archivados</span>');?></li>
                        <li><?php echo HTML::anchor('entrada/bandeja','<span class="observado icon">Observados</span>');?></li>                        
                    </ul>
                    <div class="separador"></div>
                    <div class="inner-border">
                        <div id="perfil">
                        <span class="negro">Crear </span><span class="gris">Documento</span>                           
                    </div>
                    </div>
                    <ul class="menu-correo">                                           
                        <li><?php echo HTML::anchor('documento/crear/nota','<span class="nota icon">Nota Interna</span>');?></li>
                        <li><?php echo HTML::anchor('documento/crear/informe','<span class="informe icon">Informe</span>');?></li>
                        <li><?php echo HTML::anchor('documento/crear/carta','<span class="carta icon">Carta</span>');?></li>
                        <li><?php echo HTML::anchor('documento/crear/circular','<span class="circular icon">Circular</span>');?></li>
                        <li><?php echo HTML::anchor('documento/crear/memo','<span class="memo icon">Memorandum</span>');?></li>
                    </ul>                  
                    <div class="inner-border">
                        <div id="perfil">
                        <span class="negro">Generados </span> <span class="gris"></span>                          
                    </div>
                    </div>
                    <ul class="menu-correo">                                           
                        <li><?php echo HTML::anchor('hs/listar','<span class="hr icon">Hojas de ruta</span>',array('title'=>'Hojas de ruta creadas por mi usuario Internas y Externas'));?></li>
                        <li><?php echo HTML::anchor('nur/listar','<span class="nur icon">NUR(I)s</span>');?></li>
                        <li><?php echo HTML::anchor('documento','<span class="documento icon">Documentos</span>');?></li>                                                                    
                    </ul>
<hr/>