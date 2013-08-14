<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Reportes extends ORM{
    protected $_table_names_plural = false;
    
    
    public function a_juridica()
    {
        $sql="SELECT DISTINCT s.codigo, s.derivado_por,s.derivado_a 
            FROM seguimientos s, usuarios u
            WHERE derivado_a='direccion.juridica'
            and f_derivacion BETWEEN '2011-10-01' AND '2011-11-28'
            and s.derivado_por=u.id_usuario
            and u.oficina NOT LIKE '%DAJ%'
            ";
        return db::query(Database::SELECT, $sql)->execute();
    }
    public function avanzado()
    {
        $sql="";
        return db::query(Database::SELECT, $sql)->execute();
    }
    public function recepcionado($oficina,$id_user,$fecha1,$fecha2)
    {
        $sql="SELECT s.nur,s.nombre_receptor,s.cargo_receptor,s.nombre_emisor,s.cargo_emisor,s.fecha_emision, s.fecha_recepcion,s.proveido,d.codigo FROM seguimiento s
        INNER JOIN documentos d ON s.nur=d.nur
        WHERE s.id_de_oficina='$oficina'
        AND s.derivado_a='$id_user'
        AND s.estado BETWEEN '2' and '4'   
        and d.original=1
        AND s.fecha_recepcion BETWEEN '$fecha1' AND '$fecha2'";
        return db::query(Database::SELECT, $sql)->execute();
    }
    public function recepcionado_all($id_user,$fecha1,$fecha2)
    {
        $sql="SELECT s.nur,s.nombre_receptor,s.cargo_receptor,s.nombre_emisor,s.cargo_emisor,s.fecha_emision, s.fecha_recepcion,s.proveido,d.codigo FROM seguimiento s
        INNER JOIN documentos d ON s.nur=d.nur
        WHERE s.derivado_a='$id_user'
        AND s.estado BETWEEN '2' and '4'   
        and d.original=1
        AND s.fecha_recepcion BETWEEN '$fecha1' AND '$fecha2'";
        return db::query(Database::SELECT, $sql)->execute();
    }
    public function enviado($oficina,$id_user,$fecha1,$fecha2)
    {
        $sql="SELECT s.nur,s.nombre_receptor,s.cargo_receptor,s.nombre_emisor,s.cargo_emisor,s.fecha_emision, s.fecha_recepcion,s.proveido,d.codigo,d.cite_original FROM seguimiento s
        INNER JOIN documentos d ON s.nur=d.nur
        WHERE s.id_a_oficina='$oficina'
        AND s.derivado_por='$id_user'
        AND s.estado BETWEEN '1' and '4'   
        and d.original=1
        AND s.fecha_emision BETWEEN '$fecha1' AND '$fecha2'";
        return db::query(Database::SELECT, $sql)->execute();
    }
    public function enviado_all($id_user,$fecha1,$fecha2)
    {
        $sql="SELECT s.nur,s.nombre_receptor,s.cargo_receptor,s.nombre_emisor,s.cargo_emisor,s.fecha_emision, s.fecha_recepcion,s.proveido,d.codigo,d.cite_original FROM seguimiento s
        INNER JOIN documentos d ON s.nur=d.nur
        WHERE s.derivado_por='$id_user'
        AND s.estado BETWEEN '1' and '4'   
        and d.original=1
        AND s.fecha_emision BETWEEN '$fecha1' AND '$fecha2'";
        return db::query(Database::SELECT, $sql)->execute();
    }
    //personalizado
    public function personal($oficina,$estado,$fecha1,$fecha2)
    {
        $sql="SELECT s.nur,s.nombre_receptor,s.cargo_receptor,s.nombre_emisor,s.cargo_emisor,s.fecha_emision, s.fecha_recepcion,s.proveido,d.codigo,d.cite_original FROM seguimiento s
        INNER JOIN documentos d ON s.nur=d.nur
        WHERE s.id_a_oficina='$oficina'        
        AND s.estado ='$estado'   
        and d.original='1'
        AND s.fecha_emision BETWEEN '$fecha1' AND '$fecha2'";
        return db::query(Database::SELECT, $sql)->execute();
    }
    public function v_recepcion($id_user,$fecha1,$fecha2)
    {
        $sql="SELECT d.nur,d.cite_original,d.nombre_destinatario,d.cargo_destinatario,d.nombre_remitente,d.cargo_remitente,d.referencia,d.adjuntos,d.fecha_creacion,d.hojas,d.estado
        FROM documentos d
        WHERE id_user='$id_user'
        AND d.original=1
        AND d.fecha_creacion BETWEEN '$fecha1' AND '$fecha2'";
        return db::query(Database::SELECT,$sql)->execute();
    }
    
    
}
?>
