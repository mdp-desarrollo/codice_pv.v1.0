<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Pvcategoriatipos extends ORM{
    protected $_table_names_plural = false;
    protected $_sorting=array('id'=>'ASC');

    public function getmonto($sql)
    {
            return db::query(Database::SELECT, $sql)->execute();
            
    }
}
?>
