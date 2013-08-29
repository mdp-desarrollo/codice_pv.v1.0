<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Pvcomisiones extends ORM{
    protected $_table_names_plural = false;
    //un pvcomisiones tiene un solo documento
    protected $_belogn_to=array(
        'documentos'=>array(
            'model'=>'documentos',
            'foreign_key'=>'id_documento'
        )
    );
    
}
?>
