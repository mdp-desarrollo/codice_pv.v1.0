<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Imagenes extends ORM{
    protected $_table_names_plural = false;
    protected $_sorting = array('fecha_subida' => 'DESC');
}
?>
