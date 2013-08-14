<div class="user">
    <h2 class="subtitulo">    
    <?php echo $user->nombre;?>
    <br/><span><?php echo $user->cargo;?> </span></h2>
    <br/>
</div>
<div style="float: left; width: 45%; padding: 10px;  border-right: 1px solid #ccc; ">
    <h1 style="font-size:24px; color:#126B91; border-bottom: 3px solid #126B91; line-height: 30px; ">Correspondencia</h1>
<ul class="items">
    <li>
         <a class="item1" href="/ventanilla/listar">Recepcionados: <?php echo $recepcionados; ?><br/><span> Correspondencia recepcionada por mi usuario.</b>
        </span></a>                        
    </li>
    <li >
         <a class="itemd"href="/derivados">Derivados: <?php echo $derivados; ?>
         <br/><span> Correspondencia derivada </span>
         </a>
                        
    </li>
    <li class="item">
         <a class="item2" href="/ventanilla/pendientes">Pendientes: <?php echo $pendientes; ?>
        <br/><span> Correspondencia por derivar </span>                
        </a>
    </li>
<ul>
</div>    
<div style="padding: 10px; width: 45%; float: left;  ">
<h1 style="font-size:24px; color:#96D92D; border-bottom: 3px solid #96D92D; line-height: 30px; ">Usuario</h1>
<ul class="items_data">
    <li >
        <a class="itemc" href="/user/changePass">Cambiar Contrase&ntilde;a<br/><span>Cambia su contrase&ntilde;a de acceso al sistema.</spanp></a>
    </li>
    <li >
     <a class="itemd" href="/user/changeData">Cambiar mis datos <br/><span>
         Cambie su nombre, cargo o email de contacto.
     </span></a>     
    </li>
</ul>

   
    
</div>
<div style="display: block; width: 100%; clear: both; "></div>
<pre>
<?php //var_dump($tipos);?>
</pre>
