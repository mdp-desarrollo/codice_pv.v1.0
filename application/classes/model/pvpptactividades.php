<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Pvpptactividades extends ORM{
    protected $_table_names_plural = false;

    public function lista()
    {
        $sql="SELECT * FROM pvpptactividades where estado=1";
        return db::query(Database::SELECT, $sql)->execute();
    }

}
?>
