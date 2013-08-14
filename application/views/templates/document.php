<?php foreach($document as $s): ?>
    <li><?php echo HTML::anchor('documentos/listar/'.$s->id,html::image('media/images/'.$s->image,array('align'=>'absmiddle')).' '.$s->plural,array('title'=>'','onclick'=>'this.blur();','target'=>'main'));?></li>
<?php endforeach;?>