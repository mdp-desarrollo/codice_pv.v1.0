<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Seguimiento extends ORM{
    protected $_table_names_plural = false;
   //protected $_sorting = array('fecha_publicacion' => 'DESC');
   
   //function para insertar un seguimiento      
    public function insertSeguimiento($n,$oficial,$de,$nombre_de,$cargo_de,$para,$rem,$cargo_rem,$estado,$accion,$proveido,$adjunto,$de_oficina,$a_oficina,$padre){
        $seg=ORM::factory('seguimiento');
        $seg->nur=$n;        
        $seg->derivado_por=$de;
        $seg->padre=$padre;
        $seg->nombre_emisor=$nombre_de;
        $seg->cargo_emisor=$cargo_de;
        $seg->derivado_a=$para;
        $seg->nombre_receptor=$rem;
        $seg->cargo_receptor=$cargo_rem;
        $seg->fecha_emision=date('Y-m-d H:i:s');
        $seg->derivado_a=$para;
        $seg->nombre_receptor=$rem;
        $seg->cargo_receptor=$cargo_rem;
       // $seg->fecha_recepccion=date('00-00-00 00:00:00');
        $seg->estado=$estado;  // 1=no recibido
        $seg->accion=$accion;
        $seg->oficial=$oficial;
        $seg->proveido=$proveido;
        $seg->adjuntos=json_encode($adjunto);
        $seg->de_oficina=$de_oficina;
        $seg->a_oficina=$a_oficina;
        $seg->save();
        return $seg->id;
    }
    
    //estados
    public function estado_a($id_estado,$id_user){
        $sql="SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, n.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN nurs n ON n.id=s.nur
              INNER JOIN nurs_documentos nd ON nd.id_nur=s.nur
              INNER JOIN documentos d ON nd.id_documento=d.id
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='$id_estado'
              AND derivado_a='$id_user'
              AND d.original='1'"; //importante para saber cual es el documento original
          return $this->_db->query(Database::SELECT, $sql,TRUE);
    }    
    //estados mejorado en velocidad
    public function estado($id_estado,$id_user){
        $sql="SELECT s.id, s.padre,s.hijo,s.id_seguimiento,s.nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha,s.fecha_recepcion as fecha2, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos
             , d.codigo, d.nombre_destinatario, d.cargo_destinatario, p.proceso,d.referencia,d.id as id_doc,s.prioridad
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso
              WHERE s.estado='$id_estado'
              AND s.derivado_a='$id_user'
              AND d.original='1'
              ORDER BY s.fecha_emision DESC"; // important
        return $this->_db->query(Database::SELECT, $sql,TRUE);        
    }
    //estados mejorado en velocidad
    public function pendiente($id_user){
        $sql="SELECT s.id, s.padre,s.hijo,s.id_seguimiento,s.nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha,s.fecha_recepcion as fecha2, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos
             , d.codigo, d.nombre_destinatario, d.cargo_destinatario, p.proceso,d.referencia,d.id as id_doc,s.prioridad,d.fucov
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso
              WHERE s.estado=2
              AND s.derivado_a='$id_user'
              AND d.original='1'
              ORDER BY s.fecha_recepcion DESC"; // important
        return $this->_db->query(Database::SELECT, $sql,TRUE);        
    }
    //estados mejorado en velocidad
    public function enviados($id_user){
        $sql="SELECT s.id, s.padre,s.nur, s.nombre_receptor,s.cargo_receptor,s.a_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos
             ,d.id as id_documento, d.codigo, d.cite_original, d.nombre_destinatario, d.cargo_destinatario, p.proceso,d.referencia
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado=1
              AND s.derivado_por='$id_user'
              AND d.original=1 
              ORDER BY s.fecha_emision DESC"; // important
        return $this->_db->query(Database::SELECT, $sql,TRUE);        
    }
    public function seguimientox($id){
        $sql="SELECT *
            FROM seguimiento s
            INNER JOIN asignados a ON s.nur=a.id
            INNER JOIN acciones c ON s.accion=c.id
            INNER JOIN estados e ON s.estado=e.id
            WHERE s.nur='$id'";
        return $this->_db->query(Database::SELECT, $sql,TRUE);
    }
    public function seguimiento($id){
        $sql="SELECT s.id as id, s.padre,s.nur, s.derivado_por,s.derivado_a,s.nombre_emisor,s.nombre_receptor,s.cargo_emisor,s.cargo_receptor,s.de_oficina,s.a_oficina,s.fecha_emision,s.fecha_recepcion,
s.adjuntos, s.archivos, c.accion,e.id as id_estado,e.estado,s.oficial,s.hijo,s.proveido 
            FROM seguimiento s
            INNER JOIN acciones c ON s.accion=c.id
            INNER JOIN estados e ON s.estado=e.id
            WHERE s.nur='$id'
            ORDER BY s.id";
        return $this->_db->query(Database::SELECT, $sql,TRUE);
    }

    public function pendientes($id_user,$e){        
        
        $sql="SELECT s.id, s.padre,s.nombre_emisor,s.oficial,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha,s.proveido,h.id_nur, h.id_seguimiento, a.codigo as documento, d.codigo, p.proceso,c.accion,s.adjuntos
            FROM seguimiento s
	    INNER JOIN hojasruta h ON h.id_nur=s.nur
            INNER JOIN documentos d ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
			INNER JOIN acciones c ON s.accion=c.id      
	    INNER JOIN	procesos p ON p.id=h.id_proceso												
            WHERE s.estado='$e'
            and s.derivado_a='$id_user'
            and h.id_seguimiento='-1'
            ORDER BY s.fecha_emision DESC"; 
        return $this->_db->query(Database::SELECT, $sql,TRUE);        
    }
    public function carpetas($id_user){        
        $sql="SELECT id, carpeta FROM carpetas WHERE id_user='$id_user'";
        return db::query(Database::SELECT, $sql)->execute();
    }
    
    public function nuris($id_user){
        $sql="SELECT * FROM seguimiento s
        INNER JOIN nurs n ON s.nur=n.id
        INNER JOIN documentos d ON d.id_nur=s.nur
        WHERE n.original='$id_user'
        AND s.derivado_por='2'
        AND d.id_seguimiento='0'";
    }
    public function nur($id_seg)
    {
        $sql="SELECT s.id, s.nur FROM seguimiento s             
             WHERE s.id='$id_seg'";
        return db::query(Database::SELECT, $sql)->execute();
    }
    //cantidad de estados 
    public function estados($id_user)
    {
        $sql="SELECT e.id,e.plural, e.singular, COUNT(*) as n FROM seguimiento s
            INNER JOIN estados e ON s.estado=e.id
            WHERE s.derivado_a='$id_user'
            AND s.estado<>'4'
            GROUP BY s.estado";
        return db::query(Database::SELECT, $sql)->execute();
    }
    public function derivado($id_seguimiento)
    {
        $sql="SELECT s.id, n.nur,d.codigo,d.referencia,s.nombre_receptor,s.cargo_receptor,s.a_oficina,s.fecha_emision,s.proveido 
            FROM seguimiento s
            INNER JOIN nurs n ON s.nur=n.nur
            INNER JOIN users u ON s.derivado_a=u.id
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN documentos d ON d.nur=s.nur
            WHERE s.id='$id_seguimiento'
            and d.original='1'";
        return db::query(Database::SELECT, $sql)->execute();
    }
    public function delete_deriv($padre)
    {
        $sql="DELETE FROM seguimiento WHERE padre='$padre'";
        return db::query(Database::DELETE  , $sql)->execute();
    }
    public function delete_principal($id)
    {
        $sql="DELETE FROM seguimiento WHERE id= '$id'";
        return db::query(Database::DELETE  , $sql)->execute();
    }
    public function pendientes2($sql)
    {
            return db::query(Database::SELECT, $sql)->execute();
    }
    
    //MODIFICADO POR FREDDY
    public function permisos_nur($seg_id,$user_id)
    {
    $sql="SELECT COUNT(id) as contador FROM seguimiento WHERE nur= (SELECT nur FROM seguimiento WHERE id = '$seg_id' LIMIT 1) AND (derivado_por = $user_id OR derivado_a=$user_id)";
        return db::query(Database::SELECT, $sql)->execute();
    }
    
    //MODIFICADO POR FREDDY
    public function documento($seg_id,$nur)
    {
    $sql="SELECT id FROM seguimiento WHERE nur='$nur'  AND id>$seg_id ORDER BY id ASC LIMIT 1 ";
        return db::query(Database::SELECT, $sql)->execute();
    }
}
?>
