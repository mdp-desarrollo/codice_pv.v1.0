<h2 class="subtitulo">Informacion del usuario "<?php echo $user->username; ?>"<br/><span>a continuacion se detalla informacion referente a este usuario</span></h2>

<ul class="info">    
    <li><b>Oficina: </b><?php echo $oficina; ?></li>
    <li><b>Nombre: </b><?php echo $user->nombre; ?></li>
    <li><b>Cargo: </b><?php echo $user->cargo; ?></li>    
    <li><b>Email: </b><?php echo $user->email; ?></li>
    <li><b>Hora de Ingreso: </b><?php echo Date::fuzzy_span($user->last_login); ?>
    <?php $fecha=Date::span($user->last_login); 
        echo '(<b>'. date('H:i:s d-m-Y',$user->last_login).'</b>)';
    ?></li>
    <li>Numero de ingresos al sistema: <?php echo $user->logins; ?></li>
    
</ul>

