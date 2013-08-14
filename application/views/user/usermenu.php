<?php 
     $home=HTML::image('media/images/logo.png',array('height'=>80));
   //echo HTML::anchor(URL::base(),$home);?>
 <div class="inner-border">
  <div id="perfil">
  <span class="negro"><?php echo $menu;?></span>
  </div>
 </div>
 <ul class="menu-correo">
    <?php foreach($submenus as $s): ?>
    <li><?php echo HTML::anchor($s->controlador.'/'.$accion,$s->submenu,array('title'=>$s->descripcion));?></li>
    <?php endforeach;?>
</ul>
<hr/>