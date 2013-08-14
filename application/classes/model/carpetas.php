<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Carpetas extends ORM{
    protected $_table_names_plural = false;
    protected $_sorting = array('carpeta' => 'ASC');   
    
    protected $_belogn_to=array(
        'oficinas'=>array(
            'model'=>'oficinas',
            'foreign_key'=>'id_carpeta'
        )
    );
    
    public function archivadores($id_user)
    {
        $sql="SELECT c.id,c.carpeta, COUNT(c.carpeta) as cc 
        FROM archivados a 
        INNER JOIN carpetas c ON a.id_carpeta=c.id
        WHERE a.id_user='$id_user'
        GROUP BY c.id
        ORDER BY c.carpeta";
        return $this->_db->query(Database::SELECT,$sql,TRUE);
    }
    
    public function lista_carpetas()
    {
        $sql="SELECT car.id,car.carpeta,car.fecha_creacion,car.nivel,ofi.sigla,ofi.oficina
FROM carpetas AS car LEFT JOIN oficinas AS ofi ON car.id_oficina = ofi.id";
        return db::query(Database::SELECT, $sql)->execute();
    }
}
?>