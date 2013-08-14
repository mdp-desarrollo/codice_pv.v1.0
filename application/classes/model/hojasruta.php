<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Hojasruta extends ORM{
    protected $_table_names_plural = false;
    //protected $_sorting = array('fecha_publicacion' => 'DESC');
     
    //mis hojas de ruta creadas por un usuario
    public function hojasruta($id_user,$o,$i)
    {
     $sql="SELECT d.id as id_documento, d.codigo, d.nombre_destinatario, d.cargo_destinatario, d.referencia, d.nur, d.fecha_creacion,d.estado,p.proceso 
        FROM documentos d 
        INNER JOIN procesos p ON d.id_proceso=p.id        
        WHERE d.id_user='$id_user'
        AND d.original='1'
        ORDER BY d.fecha_creacion DESC
        LIMIT $o , $i"; //important
    return db::query(Database::SELECT, $sql)->execute();
    }
    
    public function imprimir($nur)
    {
    $sql="SELECT * FROM documentos d 
    INNER JOIN users u ON u.id=d.id_user 
    INNER JOIN oficinas o ON o.id=u.id_oficina
    INNER JOIN entidades e ON e.id=o.id_entidad 
    INNER JOIN procesos p ON d.id_proceso=p.id
    WHERE d.nur='$nur'
    AND d.original='1'";
    return $this->_db->query(Database::SELECT, $sql,TRUE);        
    }
    
}


?>
