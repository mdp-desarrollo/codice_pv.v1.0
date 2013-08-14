<?php
defined('SYSPATH') or die ('no tiene acceso');
class Model_Articulos extends Kohana_Model{
    //lista de articulos json
    public function listar(){
        $sql="SELECT a.idArticulo,a.articulo, m.marca
            FROM articulos a LEFT JOIN marcas m ON a.idMarca=m.id";
        return $this->_db->query(Database::SELECT, $sql, FALSE)->as_array();
    }
    public function add(){

    }


    //lista de marcas por el rubro
    public function listarMarcas($id){
        $sql="SELECT id,idRubro,marca
            FROM marcas
            WHERE idRubro='$id'";
        return $this->_db->query(Database::SELECT, $sql,TRUE);
    }

}
?>
