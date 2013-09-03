<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Pvogestiones extends ORM{
    protected $_table_names_plural = false;
    
    public function objetivosgestion($id){
        $sql = "select og.id, og.codigo, og.objetivo, ofi.oficina
                from pvogestiones og inner join oficinas ofi on og.id_oficina = ofi.id
                where og.estado = 1
                and ofi.id_entidad = $id";
        //return DB::query(1, $sql)->execute();
        return $this->_db->query(Database::SELECT, $sql, TRUE);    
    }
}
?>
