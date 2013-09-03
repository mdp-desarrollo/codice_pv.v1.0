<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Pvoespecificos extends ORM{
    protected $_table_names_plural = false;
    
    public function objetivosespecificos($id){
        $sql = "select oe.id, oe.objetivo, oe.codigo, ofi.oficina
                from pvoespecificos oe inner join pvogestiones og  on og.id = oe.id_obj_gestion
                inner join oficinas ofi on og.id_oficina = ofi.id
                where ofi.id_entidad = $id
                and oe.estado = 1";
        //return DB::query(1, $sql)->execute();
        return $this->_db->query(Database::SELECT, $sql, TRUE);    
    }
}
?>
