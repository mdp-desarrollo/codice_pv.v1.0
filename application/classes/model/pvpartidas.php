<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Pvpartidas extends ORM{
    protected $_table_names_plural = false;
    
    public function partidas_no_asignadas($id){        
         $sql="select id, codigo, partida from pvpartidas where id not in(select id_partida from pvejecuciones where id_programatica = $id and estado = 1)";
        return DB::query(1, $sql)->execute();
        //  return $this->_db->query(Database::SELECT, $sql, TRUE);    
    }

    public function lista()
    {
        $sql="SELECT * FROM pvpartidas where estado=1";
        return db::query(Database::SELECT, $sql)->execute();
    }
}
?>