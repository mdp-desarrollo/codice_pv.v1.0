<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Tipos extends ORM{
    protected $_table_names_plural = false;
    protected $_has_many=array(
        'documentos' => array(
           'model'=>'documentos',
            'foreign_key' => 'id_tipo'
        ),
        'tipo' =>array(
            'through' => 'tipo_oficina',
            'foreign_key' => 'id_tipo',
            'far_key' => 'id_oficina',
        ),
        'user'=>array(
            'model' =>'users',
            'through' => 'usertipo',
            'foreign_key' => 'id_tipo',
            'far_key' => 'id_user',
        ),
    );

//documentos que un usuario puede crear    
public function misTipos($id){
    $sql="SELECT t.id, t.tipo,t.action,t.plural,t.image,t.descripcion FROM tipos t 
        INNER JOIN usertipo u ON u.id_tipo=t.id
        WHERE u.id_user='$id'";
    return $this->_db->query(Database::SELECT, $sql,TRUE);
}    
    
}
?>
