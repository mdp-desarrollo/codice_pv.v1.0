<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Documentos extends ORM{
    protected $_table_names_plural = false;
    //un documento pertenece a un:
    protected $_belongs_to=array(
        'tipos' => array(
            'model' => 'tipos',
            'foreign_key' =>'id_tipo'
        ),
        'usuario'=>array(
            'model'=>'users',
            'foreign_key' => 'id_user'
        ),
    );
    //nuris - documentos
    protected $_has_many=array(
        'nurs' => array(
            'model'=>'nurs',
            'through' => 'nurs_documentos',
            'foreign_key' => 'id_documento',
            'far_key' => 'nur',
        ),
    );
    public function agrupados($id){
        $sql="SELECT id_tipo, COUNT(*) as n FROM documentos WHERE id_user='$id' GROUP BY id_tipo";
        return DB::query(1, $sql)->execute();
    }
    public function agrupaciones($id,$o,$i)
    {
        $sql="SELECT a.padre,a.hijo,a.fecha, d.cite_original,d.cargo_destinatario,d.nombre_destinatario,d.referencia FROM agrupaciones a
        INNER JOIN documentos d ON a.hijo=d.nur
        WHERE d.original=1
        AND a.id_user='$id'
        ORDER by a.fecha DESC
        LIMIT $o,$i";
        return DB::query(1, $sql)->execute();
    }
    
    //ultimos 10 documentos generados
    /*public function recientes($id){
      $sql="SELECT d.id,d.codigo,d.nombre_destinatario,d.cargo_destinatario,d.nombre_via,d.cargo_via,d.nombre_remitente,d.cargo_remitente,d.fecha_creacion,d.referencia,d.nur,t.tipo,d.estado
            FROM documentos d            
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id_user='$id'
            ORDER BY d.fecha_creacion DESC
            LIMIT 10";
         return $this->_db->query(1, $sql);
    }*/
    public function recientes($id){
      $sql="SELECT d.id,d.codigo,d.nombre_destinatario,d.cargo_destinatario,d.nombre_via,d.cargo_via,d.nombre_remitente,d.cargo_remitente,d.fecha_creacion,d.referencia,d.nur,t.tipo,d.estado,s.estado as seg_estado
            FROM documentos d            
            INNER JOIN tipos t ON t.id=d.id_tipo
	    LEFT JOIN seguimiento s ON d.nur=s.nur AND d.id_seguimiento=0 AND s.derivado_por='$id'
            WHERE d.id_user='$id' 
            ORDER BY d.fecha_creacion DESC
            LIMIT 10";
         return $this->_db->query(1, $sql);
    }
    //lista de documentos
    public function documentos(){
        $sql="SELECT c.id, c.titulo, c.nombre_documento, t.tipo
              FROM documentos c LEFT JOIN  tipos t ON c.id_tipo=t.id";
        return DB::query(1, $sql)->execute();
    }
    public function detalle($id,$user){
        $sql="SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='$id'
            AND d.id_user='$user'";
        return $this->_db->query(Database::SELECT, $sql, TRUE);
    }
    public function vista($codigo){
        $sql="SELECT d.id,d.codigo,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.codigo='$codigo'";
        return $this->_db->query(Database::SELECT, $sql, TRUE);
    }
    public function descripcion($nur){
        $sql="SELECT d.id as id_doc, d.codigo as documento, d.nombre_destinatario as destinatario, d.cargo_destinatario as cargo, d.referencia, d.nombre_remitente as remitente, d.cargo_remitente as cargo_r,
        h.fecha, a.codigo as nur,t.tipo, p.proceso FROM documentos d
        INNER JOIN hojasruta h ON h.id_documento=d.id
        INNER JOIN asignados a ON h.nur=a.id
        INNER JOIN tipos t ON t.id=d.id_tipo
        INNER JOIN procesos p ON p.id=h.id_proceso
        WHERE h.nur='$nur'
        and h.id_seguimiento='-1'";
        return $this->_db->query(Database::SELECT, $sql, TRUE);
    }
    public function documento($id,$id_user){
        $sql="SELECT d.id as id_doc, d.id_tipo, d.codigo as documento, d.nombreDestinatario as destinatario, d.cargoDestinatario as cargo, d.referencia, d.nombreRemitente as remitente, d.cargoRemitente as cargo_r,
      d.nombreVia,d.cargoVia,  h.fecha, a.codigo as nur,t.tipo, p.proceso FROM documentos d
        INNER JOIN hojasruta h ON h.id_documento=d.id
        INNER JOIN asignados a ON h.id_nur=a.id
        INNER JOIN tipos t ON t.id=d.id_tipo
        INNER JOIN procesos p ON p.id=h.id_proceso
        WHERE d.id='$id'       
        and d.id_user='$id_user'";
        return $this->_db->query(Database::SELECT, $sql, TRUE);                
    }
    public function externos($id_user,$o,$i)
    {
        $sql="SELECT d.id, d.codigo, d.citeOriginal, d.estado, d.nombreDestinatario,d.cargoDestinatario, d.institucionDestinatario, d.nombreRemitente,d.cargoRemitente,d.institucionRemitente, d.referencia,d.adjuntos, d.nroHojas, d.nur, d.id_nur,de.fecha, g.grupo,m.motivo,p.proceso FROM documentos d 
            INNER JOIN descripcion de ON d.id=de.id_documento
            INNER JOIN grupos g ON de.id_grupo=g.id
            INNER JOIN motivos m ON de.id_motivo=m.id
            INNER JOIN procesosx p ON de.id_proceso=p.id
            WHERE d.id_user='$id_user'
            AND d.id_tipo='6'             
            ORDER BY d.fecha_creacion DESC
            LIMIT $o,$i"; //6=documentos externos
        return db::query(Database::SELECT, $sql)->execute();
    }
    public function documentos_nuevos($id_user)
    {
        $sql="SELECT * FROM tipos t 
        WHERE t.id NOT IN (SELECT id_tipo FROM usertipo WHERE id_user='$id_user')
        and t.doc='0'";
        return $this->_db->query(database::SELECT, $sql, TRUE);
    }
    //busqueda
    public function contar($text,$entidad)
    {
        if($entidad==0)
        {    
        $sql="SELECT COUNT(*) as count  FROM documentos
        WHERE codigo like '%$text%'
        or nur like '%$text%'
        or referencia like '%$text%'";
        }
        else
        {
        $sql="SELECT COUNT(*) as count FROM documentos d,
        ( SELECT id  FROM documentos
        WHERE codigo like '%$text%'
        or nur like '%$text%'
        or referencia like '%$text%' ) as x
        WHERE x.id=d.id
        and d.id_entidad='$entidad'";   
        }
        return db::query(Database::SELECT, $sql)->execute();
    }
    public function contar2($where)
    {
        $sql="SELECT COUNT(*) as count  FROM documentos d ";
        $sql.=$where;
        return db::query(Database::SELECT, $sql)->execute();
    }
    public function buscar($text,$o,$i,$entidad)
    {
        if($entidad==0)
        {
        $sql="SELECT d.id, d.nur, d.cite_original, d.nombre_destinatario, d.cargo_destinatario, d.nombre_remitente,d.cargo_remitente,d.referencia,d.fecha_creacion, t.tipo        
        FROM documentos d INNER JOIN tipos t ON d.id_tipo=t.id
        WHERE d.cite_original like '%$text%'
        OR d.nur like '%$text%'
        OR d.referencia like '%$text%'
        LIMIT $o,$i";
        }
        else
        {
        $sql="SELECT d.id, d.nur, d.cite_original, d.nombre_destinatario, d.cargo_destinatario, d.nombre_remitente,d.cargo_remitente,d.referencia,d.fecha_creacion, x.tipo  
        FROM documentos d,( SELECT d.id,t.tipo      
        FROM documentos d INNER JOIN tipos t ON d.id_tipo=t.id
        WHERE d.cite_original like '%$text%'
        OR d.nur like '%$text%'
        OR d.referencia like '%$text%'        
        ) as x
        WHERE d.id=x.id
        AND  d.id_entidad='$entidad'
        LIMIT $o,$i";
        }
        return db::query(Database::SELECT, $sql)->execute();
        
    }
    //
    public function search($where,$o,$i)
    {
        $sql="SELECT d.id, d.nur, d.cite_original, d.nombre_destinatario, d.cargo_destinatario, d.nombre_remitente,d.cargo_remitente,d.referencia,d.fecha_creacion, t.tipo        
        FROM documentos d INNER JOIN tipos t ON d.id_tipo=t.id ";
        $sql.=$where." LIMIT $o,$i"; 
        return db::query(Database::SELECT, $sql)->execute();
        
    }
    public function pendiente_ventanilla($id_user)
    {
        $sql="SELECT d.id, d.cite_original, d.nur, d.nombre_destinatario,d.cargo_destinatario,d.institucion_destinatario,d.nombre_remitente,d.cargo_remitente,d.institucion_remitente,d.referencia,d.hojas,d.fecha_creacion,d.estado
            FROM documentos d 
            INNER JOIN descripcion de ON d.id=de.id_documento            
            WHERE d.id_user='$id_user'
            AND d.estado='0'";
        return db::query(Database::SELECT,$sql)->execute();
    }
    
    public function updateEstado($nur)
    {
        $sql="UPDATE documentos SET estado=1 WHERE nur='$nur'";
         return $this->_db->query(0, $sql);
    }
}
?>
