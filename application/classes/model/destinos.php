<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_destinos extends ORM{
    protected $table_name='users';
    protected $_table_names_plural = false;
    
    protected $_has_many=array(
        'user'=>array(
          'model'=>'users',
          'through' => 'destinatarios',
          'foreign_key'=>'id_usuario',
          'fair_key'=>'id_destino'  
        ),
    );

    //function destinos para un usario
    public function destinos($id_user)
    {
        $sql="SELECT u.id,u.nombre,u.cargo,u.genero,o.oficina,e.entidad FROM destinatarios d 
            INNER JOIN users u ON u.id=d.id_destino
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN entidades e ON e.id=o.id_entidad
            WHERE d.id_usuario='$id_user'";
        return $this->_db->query(database::SELECT, $sql, TRUE);
    }
    
}
?>
