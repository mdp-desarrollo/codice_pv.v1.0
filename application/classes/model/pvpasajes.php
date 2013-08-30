<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Pvpasajes extends ORM{
    protected $_table_names_plural = false;

    
    public function pasajesautorizados(){
        $sql = "select memo.id id_memo, memo.codigo, memo.nur, memo.nombre_destinatario nombre, memo.cargo_destinatario cargo,fcv.fecha_salida, fcv.fecha_creacion, fcv.fecha_arribo, of.oficina
                from documentos memo
                inner join pvfucovs fcv on memo.id = fcv.id_memo
                inner join oficinas of on memo.id_oficina = of.id
                where memo.fucov = 1
                and fcv.id_memo <> 0
                and fcv.auto_pasaje = 1
                ";
        //return DB::query(1, $sql)->execute();
        return $this->_db->query(Database::SELECT, $sql, TRUE);    
    }
}
?>
