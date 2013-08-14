<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Asignados extends ORM{
    protected $_table_names_plural = false;
    //protected $_sorting = array('fecha_publicacion' => 'DESC');
       
    public function count($id)
    {
        return ORM::factory('nurs')->where('id_user','=',$id)->count_all();        
    }    
    public function nurs($id_user,$o,$i){
        $sql="SELECT * FROM nurs n
        INNER JOIN nurs_documentos  nd on n.id=nd.id_nur
        INNER JOIN documentos d ON d.id=nd.id_documento
        INNER JOIN procesos p ON p.id=d.id_proceso
        WHERE n.id_user='$id_user' 
        AND n.original='1'
        ORDER BY n.fecha_creacion DESC
        LIMIT $o , $i";
        return $this->_db->query(Database::SELECT, $sql,FALSE);
        
    }
    public function nuris($id,$o,$i){
        $sql="SELECT a.id as id_nur,a.codigo as nur, a.derivado, h.id,h.id_seguimiento,d.id as id_documento,d.codigo,d.nombreDestinatario, d.cargoDestinatario, d.referencia,p.proceso  
        FROM asignados a
        INNER JOIN hojasruta h ON h.id_nur=a.id
        INNER JOIN documentos d ON d.id=h.id_documento
        INNER JOIN procesos p ON p.id=h.id_proceso
        WHERE a.id_user=$id
        AND h.id_seguimiento='-1'
        ORDER BY a.fecha_creacion DESC
        LIMIT $o , $i";
        return $this->_db->query(Database::SELECT, $sql,FALSE);
        
    }
    public function nur($id_nur,$id_user){
        $sql="SELECT a.id as id_nur,a.codigo as nur,h.id,h.id_seguimiento,d.id as id_documento,d.codigo,d.nombreDestinatario, d.cargoDestinatario, d.referencia,p.proceso  FROM asignados a
        INNER JOIN hojasruta h ON h.id_nur=a.id
        INNER JOIN documentos d ON d.id=h.id_documento
        INNER JOIN procesos p ON p.id=h.id_proceso
        WHERE a.id='$id_nur'
        AND a.id_user='$id_user'";       
        return DB::query(Database::SELECT, $sql)->execute()->as_array();
    }
    
    public function count2(){
        $sql="SELECT COUNT(*) FROM asignados WHERE id_user='$id'";
        return db::query(Database::SELECT, $sql)->execute();
    }
    
    
    
}
?>
