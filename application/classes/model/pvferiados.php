<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Pvferiados extends ORM{
    protected $_table_names_plural = false;    
    public function feriados($f1, $f2){
        $sql = "select * from pvferiados where fecha >= '$f1' and fecha <= '$f2'";
        return DB::query(1, $sql)->execute();        
    }
}
?>
