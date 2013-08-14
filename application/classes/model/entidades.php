<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_entidades extends ORM{
    protected $_table_names_plural = false;
    protected $_sorting=array('entidad'=>'ASC');
    //7una ofician tiene varios funcionarios (usuarios)
    protected $_has_many=array(
//        'oficina' =>array(
//            'model'=>'oficinas',
//            'through' => 'entidades_oficinas',
//            'foreign_key' => 'id_oficina',
//            'far_key' => 'id_entidad',
//        ),
        'oficinas'=>array(
            'model'=>'oficinas',
            'foreign_key' => 'id_entidad',
        ),
    );
}
?>
