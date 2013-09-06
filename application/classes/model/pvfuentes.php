<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Pvfuentes extends ORM{
    protected $_table_names_plural = false;

    public function lista()
    {
        $sql="SELECT * FROM pvfuentes where estado=1";
        return db::query(Database::SELECT, $sql)->execute();
    }
    
}
?>