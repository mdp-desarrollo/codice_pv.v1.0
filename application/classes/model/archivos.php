<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Archivos extends ORM{
    protected $_table_names_plural = false;
    //protected $_sorting = array('fecha_publicacion' => 'DESC');
    public function listar($id_user)
    {
        $sql="SELECT a.id,d.id as id_documento,d.codigo,a.fecha, t.tipo,d.nur,d.referencia,a.tamanio,a.nombre_archivo  
                FROM archivos a INNER JOIN documentos d ON a.id_documento=d.id
                INNER JOIN tipos t ON d.id_tipo=t.id
                WHERE a.id_user='$id_user'
                AND a.estado='1'
                ORDER BY 	a.fecha DESC";
        return db::query(Database::SELECT, $sql)->execute();
    }
}
?>
