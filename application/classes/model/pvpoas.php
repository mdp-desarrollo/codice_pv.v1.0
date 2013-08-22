<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Pvpoas extends ORM{
    protected $_table_names_plural = false;
    protected $_sorting=array('id_fucov'=>'ASC');
    //un pvfucovs pertenece a un solo documento
    protected $_belogn_to=array(
        'pvfucovs'=>array(
            'model'=>'pvfucovs',
            'foreign_key'=>'id_fucov'
        )
    );
}
?>
