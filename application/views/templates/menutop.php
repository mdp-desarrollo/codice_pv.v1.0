<?php foreach($menus as $m):?>    
  <?php if($controller==$m->controlador){?>
   <li id="active">
  <?php }else{ ?>
   <li>   
  <?php }?>     
       <a href="/<?php echo $m->controlador;?>" title="<?php echo $m->descripcion;?>"><span style="display: block;"><?php  echo $m->menu;?></span><?php  echo $m->descripcion;?></a>
      <?php // echo HTML::anchor($m->controlador,html::image($m->logo).'<br>'.$m->menu,array('title'=>$m->descripcion));?>
      <?php // echo HTML::anchor($m->controlador,$m->menu,array('title'=>$m->descripcion));?>
  
    </li>
<?php endforeach;?>
