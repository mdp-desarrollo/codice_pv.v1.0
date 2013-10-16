<?php defined('SYSPATH') or die ('no tiene acceso');
class Model_Pvpasajes extends ORM{
    protected $_table_names_plural = false;
    
    public function pasajesautorizados($id){
        $sql = "select fcv.id_memo id_memo, doc.codigo, doc.nur, doc.nombre_remitente nombre, doc.cargo_remitente cargo,fcv.fecha_salida, fcv.fecha_creacion, fcv.fecha_arribo, of.oficina, doc.id id_documento
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
        $sql = "select distinct f.id_memo, d.codigo, d.nur, d.nombre_remitente nombre, d.cargo_remitente cargo, f.fecha_salida, f.fecha_arribo,  o.oficina, f.fecha_creacion, d.id id_documento
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
            $sql .= " and p.nro_boleto = '$numero' ";
        if($f1 != '' && $f2 != '')
            $sql .= " and (f.fecha_salida between '$f1' and '$f2' or f.fecha_arribo between '$f1' and '$f2')";
        if($nombre != '')
            $sql .= " and d.nombre_remitente like '%$nombre%'";
        return $this->_db->query(Database::SELECT, $sql, TRUE);
    }
    
    public function informependiente($entidad){
        $sql = "select distinct f.id, f.id_memo, f.id_documento,  f.fecha_salida, f.fecha_arribo, o.oficina, d.nombre_remitente nombre, d.cargo_remitente cargo, d.nur, d.codigo, DATEDIFF( CURDATE(),f.fecha_arribo) dias
                from pvfucovs f
                inner join pvpoas p on f.id = p.id_fucov
		inner join pvliquidaciones l on f.id = l.id_fucov
                inner join documentos d on f.id_documento = d.id
                inner join oficinas o on d.id_oficina = o.id
		inner join documentos memo on f.id_memo = memo.id
                where memo.auto_informe = 0
		and f.auto_pasaje = 1
		and l.estado = 1
		and p.auto_poa = 1
                and d.id_entidad = $entidad
                and DATEDIFF( CURDATE(),f.fecha_arribo)>8";
        return $this->_db->query(Database::SELECT, $sql, TRUE);
    }
    
    public function pendienteavanzado($entidad, $nombre, $oficina, $f1, $f2){
        $sql = "select distinct f.id, f.id_memo, f.id_documento,  f.fecha_salida, f.fecha_arribo, o.oficina, d.nombre_remitente nombre, d.cargo_remitente cargo, d.nur, d.codigo, DATEDIFF( CURDATE(),f.fecha_arribo) dias
                from pvfucovs f
                inner join pvpoas p on f.id = p.id_fucov
		inner join pvliquidaciones l on f.id = l.id_fucov
                inner join documentos d on f.id_documento = d.id
                inner join oficinas o on d.id_oficina = o.id
		inner join documentos memo on f.id_memo = memo.id
                where memo.auto_informe = 0
		and f.auto_pasaje = 1
		and l.estado = 1
		and p.auto_poa = 1
                and d.id_entidad = $entidad
                and DATEDIFF( CURDATE(),f.fecha_arribo)>8 ";
        if($oficina != '')
            $sql .= " and d.id_oficina = $oficina ";
        if($f1 != '' && $f2 != '')
            $sql .= " and (f.fecha_salida between '$f1' and '$f2' or f.fecha_arribo between '$f1' and '$f2')";
        if($nombre != '')
            $sql .= " and d.nombre_remitente like '%$nombre%'";
        return $this->_db->query(Database::SELECT, $sql, TRUE);
    }
    
    public function descargo($id, $entidad){
        $sql = "select distinct d.id id_memo, d.id_user, d.nur, DATEDIFF( CURDATE(),f.fecha_arribo) dias
            from pvfucovs f
            inner join pvpoas p on f.id = p.id_fucov
            inner join pvliquidaciones l on f.id = l.id_fucov
            inner join documentos d on f.id_memo = d.id
            where f.auto_pasaje = 1
		and l.estado = 1
		and p.auto_poa = 1
                and d.id_entidad = $entidad
		and d.id = $id
                #and DATEDIFF( CURDATE(),f.fecha_arribo)<=8";
        return $this->_db->query(Database::SELECT, $sql, TRUE);
    }
            
}
?>