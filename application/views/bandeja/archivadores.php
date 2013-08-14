<h2 class="subtitulo">Archivados<br/><span>Lista de carpetas</span></h2>
<?php if(sizeof($carpetas)>0){?>
<ul id="folders">
<?php foreach($carpetas as $c):?>
    <li>
        <a href="/bandeja/carpeta/<?php echo $c->id;?>"><span style="font-size: 14px;"><?php echo $c->carpeta;?></span></a>
        <b><?php echo $c->cc;?></b>
        <?php
        if($c->cc>1)
        {  
            echo ' Tramites archivados';
        }
        else
        {
            echo ' Tramite archivado';
        }
        ?>
    </li>

<?php endforeach;?>    
</ul>
<?php }else{?>
<div class="info">
    <b>Vacio!</b> Usted no tiene correspondencia archivada.
</div>
<?php } ?>

