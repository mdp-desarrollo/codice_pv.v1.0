<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Menus extends ORM{
    protected $_table_names_plural = false;
    //protected $_sorting = array('fecha_publicacion' => 'DESC');
    public function submenus($c){
        $sql="SELECT * FROM menus m
        INNER JOIN submenus s ON s.id_menu=m.id
        WHERE m.controlador='$c'";
        return $this->_db->query(Database::SELECT,$sql,TRUE);
    }
}
?>
