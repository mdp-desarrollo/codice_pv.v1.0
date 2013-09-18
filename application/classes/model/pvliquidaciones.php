<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Pvliquidaciones extends ORM{
    protected $_table_names_plural = false;
    /*public function pptautorizados($id){
        $sql = "select distinct memo.id id_memo, memo.codigo, memo.nur, memo.nombre_destinatario nombre, memo.cargo_destinatario cargo,
                liq.fecha_creacion, of.oficina, fcv.id id_fucov
                from documentos memo inner join pvfucovs fcv on memo.id = fcv.id_memo
                inner join pvliquidaciones liq on liq.id_fucov = fcv.id
                inner join oficinas of on of.id = memo.id_oficina
                where memo.fucov = 1 
                and fcv.id_memo <> 0
                and of.id_entidad = $id";
        return $this->_db->query(Database::SELECT,$sql,TRUE);
    }*/
    
    public function pptautorizados($id){
        $sql = "select DISTINCT fcv.id_memo id_memo, doc.codigo, doc.nur, doc.nombre_remitente nombre, doc.cargo_remitente cargo, liq.fecha_creacion, of.oficina, fcv.id id_fucov 
                from documentos doc 
                inner join pvfucovs fcv on doc.id = fcv.id_documento
                inner join pvliquidaciones liq on liq.id_fucov = fcv.id
                inner join oficinas of on of.id = doc.id_oficina
                where doc.id_tipo = 13
                and of.id_entidad = $id";
        return $this->_db->query(Database::SELECT,$sql,TRUE);
    }
    
    public function avanzada($entidad, $nombre, $oficina, $f1, $f2){
        $sql = "select DISTINCT fcv.id_memo id_memo, doc.codigo, doc.nur, doc.nombre_remitente nombre, doc.cargo_remitente cargo,liq.fecha_creacion, of.oficina, fcv.id id_fucov 
                from documentos doc 
                inner join pvfucovs fcv on doc.id = fcv.id_documento
                inner join pvliquidaciones liq on liq.id_fucov = fcv.id
                inner join oficinas of on of.id = doc.id_oficina
                where doc.id_tipo = 13
                and of.id_entidad = $entidad";
        if($oficina != '')
            $sql .= " and doc.id_oficina = '$oficina' ";
        if($f1 != '' && $f2 != '')
            $sql .= " and (liq.fecha_creacion between '$f1' and '$f2')";
        if($nombre != '')
            $sql .= " and doc.nombre_remitente like '%$nombre%'";
        return $this->_db->query(Database::SELECT, $sql, TRUE);
        //return $sql;
    }
}
?>