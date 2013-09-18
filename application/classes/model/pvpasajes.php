<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Pvpasajes extends ORM{
    protected $_table_names_plural = false;

    
    public function pasajesautorizados($id){
        /*$sql = "select memo.id id_memo, memo.codigo, memo.nur, memo.nombre_destinatario nombre, memo.cargo_destinatario cargo,fcv.fecha_salida, fcv.fecha_creacion, fcv.fecha_arribo, of.oficina
                from documentos memo
                inner join pvfucovs fcv on memo.id = fcv.id_memo
                inner join oficinas of on memo.id_oficina = of.id
                where memo.fucov = 1
                and fcv.id_memo <> 0
                and fcv.auto_pasaje = 1
                and of.id_entidad = $id
                ";*/
        $sql = "select fcv.id_memo id_memo, doc.codigo, doc.nur, doc.nombre_remitente nombre, doc.cargo_remitente cargo,fcv.fecha_salida, fcv.fecha_creacion, fcv.fecha_arribo, of.oficina
                from documentos doc
                inner join pvfucovs fcv on doc.id = fcv.id_documento
                inner join oficinas of on doc.id_oficina = of.id
                where doc.id_tipo = 13
                and fcv.id_memo <> 0
                and fcv.auto_pasaje = 1
                and of.id_entidad = $id";
        return $this->_db->query(Database::SELECT, $sql, TRUE);    
    }
    
    public function avanzada($entidad, $nombre, $numero, $oficina, $f1, $f2){
        $sql = "select distinct f.id_memo, d.codigo, d.nur, d.nombre_remitente nombre, d.cargo_remitente cargo, f.fecha_salida, f.fecha_arribo,  o.oficina, f.fecha_creacion
                from pvfucovs f 
                inner join documentos d on f.id_documento = d.id
                inner join oficinas o on d.id_oficina = o.id";
        if($numero != '')
            $sql .= " inner join pvpasajes p on f.id = p.id_fucov";
        $sql .=" where d.id_tipo = 13 and f.auto_pasaje = 1 ";
        if($entidad != '')
            $sql .= " and d.id_entidad = $entidad ";
        if($oficina != '')
            $sql .= " and d.id_oficina = $oficina ";
        if($numero != '')
            $sql .= " and p.nro_boleto = $numero ";
        if($f1 != '' && $f2 != '')
            $sql .= " and (f.fecha_salida between '$f1' and '$f2' or f.fecha_arribo between '$f1' and '$f2')";
        if($nombre != '')
            $sql .= " and d.nombre_remitente like '%$nombre%'";
        return $this->_db->query(Database::SELECT, $sql, TRUE);
    }
    /*
    public function consulta($entidad, $nombre, $numero, $oficina, $f1, $f2){
        $sql = "select distinct f.id_memo, d.codigo, d.nur, d.nombre_remitente nombre, d.cargo_remitente cargo, f.fecha_salida, f.fecha_arribo,  o.oficina, f.fecha_creacion
                from pvfucovs f 
                inner join documentos d on f.id_documento = d.id
                inner join pvpasajes p on f.id = p.id_fucov
                inner join oficinas o on d.id_oficina = o.id
                where d.id_tipo = 13 
                and f.auto_pasaje = 1 ";
        if($entidad != '')
            $sql .= "and d.id_entidad = $entidad ";
        if($oficina != '')
            $sql .= " and d.id_oficina = $oficina ";
        if($numero != '')
            $sql .= " and p.nro_boleto = $numero ";
        if($f1 != '' && $f2 != '')
            $sql .= " and (f.fecha_salida between '$f1' and '$f2' or f.fecha_arribo between '$f1' and '$f2')";
        if($nombre != '')
            $sql .= " and d.nombre_remitente like '%$nombre%'";
        //return DB::query(1, $sql)->execute();
        //return $this->_db->query(Database::SELECT, $sql, TRUE);    
        return $sql;
    }*/
}
?>
