<h2 class="subtitulo">Reportes<br/><span>Lista de reportes disponibles</span></h2>
<ul>
    <?php foreach($lista as $l):?>
    <li>
        <a href="/reportes/<?php echo $l->accion;?>"><span><?php echo $l->nombre;?></span></a>
    </li>
    <?php endforeach;?>
</ul>
<?php ?>
