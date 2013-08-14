<?php
defined('SYSPATH') or die ('no tiene acceso');
class Model_Usuario extends Kohana_Model{
    //lista de articulos json
    public function login(){
        $sql="SELECT u.id, u.usuario, u,nombre, r. a.idArticulo,a.articulo, m.marca
            FROM articulos a LEFT JOIN marcas m ON a.idMarca=m.id";
        return $this->_db->query(Database::SELECT, $sql, FALSE)->as_array();
    }
    public function add(){

    }


    //lista de roles de un usuario determinado
    public function roles($id){
        $sql="SELECT id,rol,marca
            FROM marcas
            WHERE idRubro='$id'";
        return $this->_db->query(Database::SELECT, $sql,TRUE);
    }

}
?>
