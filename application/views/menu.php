<?php
$menu=array(
            'Inicio'=> array(0,'','active',true),
            'Productos' => array( 1, 'index','',false),
            'contactos' => array(2,'tienda','',false),
            'contactos' => array(2,'tienda','',false)
        );
?>
<ul class="sf-menu sf-js-enabled sf-shadow">
    <?php foreach($menu as $k=>$v):?>
    <?php //if($v[0]==0){ ?>
    <li class="<?php echo $v[2];?>"><?php echo HTML::anchor(URL::base().$v[1], $k); ?></li>
    <?php //}
     endforeach;?>
</ul>
