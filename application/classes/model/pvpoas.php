<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Pvpoas extends ORM{
    protected $_table_names_plural = false;
    
    /*public function listaautorizados($id_user, $id_entidad){
        $sql = "select memo.id id_memo, memo.codigo, memo.nur, memo.nombre_destinatario nombre, memo.cargo_destinatario cargo,
                poa.fecha_certificacion, ofi.oficina, fcv.id id_fucov, fcv.id_documento
                from documentos memo
                inner join pvfucovs fcv on fcv.id_memo = memo.id
                inner join pvpoas poa on fcv.id = poa.id_fucov
                inner join documentos doc on fcv.id_documento = doc.id
                inner join oficinas ofi on doc.id_oficina = ofi.id
                where memo.fucov = 1
                and fcv.id_memo <> 0
                and poa.fecha_certificacion <> ''
                and poa.auto_poa = 1
                and doc.id_tipo = 13
               #and poa.id_user_auto = $id_user
                and doc.id_entidad = $id_entidad";
        //return DB::query(1, $sql)->execute();
        return $this->_db->query(Database::SELECT, $sql, TRUE);    
    }*/
    public function listaautorizados($id_user, $id_entidad){
        $sql = "select fcv.id_memo, doc.codigo, doc.nur, doc.nombre_remitente nombre, doc.cargo_remitente cargo,
                poa.fecha_certificacion, ofi.oficina, fcv.id id_fucov, fcv.id_documento
                from documentos doc
                inner join pvfucovs fcv on fcv.id_documento = doc.id
                inner join pvpoas poa on fcv.id = poa.id_fucov
                inner join oficinas ofi on doc.id_oficina = ofi.id
                where poa.fecha_certificacion <> '' and poa.auto_poa = 1
                and doc.id_tipo = 13
               #and poa.id_user_auto = $id_user
                and doc.id_entidad = $id_entidad";
        //return DB::query(1, $sql)->execute();
        return $this->_db->query(Database::SELECT, $sql, TRUE);    
    }
    
    public function avanzada($id_user,$entidad, $nombre, $oficina, $f1, $f2){
        $sql = "select fcv.id_memo, doc.codigo, doc.nur, doc.nombre_remitente nombre, doc.cargo_remitente cargo,
                poa.fecha_certificacion, ofi.oficina, fcv.id id_fucov, fcv.id_documento
                from documentos doc
                inner join pvfucovs fcv on fcv.id_documento = doc.id
                inner join pvpoas poa on fcv.id = poa.id_fucov
                inner join oficinas ofi on doc.id_oficina = ofi.id
                where poa.fecha_certificacion <> '' and poa.auto_poa = 1
                and doc.id_tipo = 13
               #and poa.id_user_auto = $id_user
                and doc.id_entidad = $entidad";
        if($oficina != '')
            $sql .= " and doc.id_oficina = '$oficina' ";
        if($f1 != '' && $f2 != '')
            $sql .= " and (poa.fecha_certificacion between '$f1' and '$f2')";
        if($nombre != '')
            $sql .= " and doc.nombre_remitente like '%$nombre%'";
        return $this->_db->query(Database::SELECT, $sql, TRUE);
        //return $sql;
    }
}
?>
