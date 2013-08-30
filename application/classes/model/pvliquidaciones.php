<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Pvliquidaciones extends ORM{
    protected $_table_names_plural = false;
    public function pptautorizados(){
        $sql = "select distinct memo.id id_memo, memo.codigo, memo.nur, memo.nombre_destinatario nombre, memo.cargo_destinatario cargo,
                liq.fecha_creacion, of.oficina, fcv.id id_fucov
                from documentos memo inner join pvfucovs fcv on memo.id = fcv.id_memo
                inner join pvliquidaciones liq on liq.id_fucov = fcv.id
                inner join oficinas of on of.id = memo.id_oficina
                where memo.fucov = 1 
                and fcv.id_memo <> 0
                and liq.etapa_proceso = 0";
        return $this->_db->query(Database::SELECT,$sql,TRUE);
    }
}
?>