<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Destinatarios extends ORM{
    protected $_table_names_plural = false;
/*
    protected $_has_many=array(
        'user'=>array(
          'model'=>'users',
          'through' => 'destinatarios',
          'foreign_key'=>'id_usuario',
          'fair_key'=>'id_destino'  
        ),
    );
*/
    //function destinos para un usario
    /*public function destinos($id_user)
    {
        $sql="SELECT u.id,u.nombre,u.cargo,u.genero,o.oficina,e.entidad FROM destinatarios d 
            INNER JOIN users u ON u.id=d.id_destino
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN entidades e ON e.id=o.id_entidad
            WHERE d.id_usuario='$id_user'";
        return $this->_db->query(database::SELECT, $sql, TRUE);
    }
    */
    //function destinos para un usario  MODIFICA POR FREDDY
    public function destinos($id_user)
    {
        $sql="SELECT u.id,u.nombre,u.cargo,u.genero,o.oficina,e.entidad 
            FROM vias d 
            INNER JOIN users u ON u.id=d.id_destinatario
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN entidades e ON e.id=o.id_entidad
            WHERE d.id_usuario='$id_user'";
        return $this->_db->query(database::SELECT, $sql, TRUE);
    }
    
    public function dependientes($id_user)
    {
        $sql="SELECT u.id,u.nombre,u.cargo,u.genero,o.oficina,e.entidad FROM users u             
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN entidades e ON e.id=o.id_entidad
            WHERE u.superior='$id_user'";
        return DB::query(1, $sql)->execute();
    }
    public function superior($id_user)
    {
        $sql="SELECT u.id,u.nombre,u.cargo,u.genero,o.oficina,e.entidad 
            FROM users u             
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN entidades e ON e.id=o.id_entidad
            WHERE u.id='$id_user'";
        return DB::query(1, $sql)->execute();
    }
    /*public function destinos_nuevos($id_user)
    {
        $sql="SELECT u.id,e.sigla,o.oficina,u.nombre,u.cargo FROM users u 
            INNER JOIN oficinas o ON o.id=u.id_oficina
            INNER JOIN entidades e ON o.id_entidad=e.id
            WHERE u.id NOT IN (SELECT id_destino FROM destinatarios WHERE id_usuario='$id_user')
            AND u.habilitado='1'
            AND u.id <> '$id_user'";      
        return $this->_db->query(database::SELECT, $sql, TRUE);
    }*/
    
    // modificado por freddy
    public function destinos_nuevos($id_user)
    {
        $sql="SELECT u.id,e.sigla,o.oficina,u.nombre,u.cargo FROM users u 
            INNER JOIN oficinas o ON o.id=u.id_oficina
            INNER JOIN entidades e ON o.id_entidad=e.id
            WHERE u.id NOT IN (SELECT id_destinatario FROM vias WHERE id_usuario='$id_user')
            AND u.habilitado='1'
            AND u.id <> '$id_user'";      
        return $this->_db->query(database::SELECT, $sql, TRUE);
    }
    
    public function delete_des($id_usuario,$id_destinatario)
    {
        $sql="DELETE FROM vias WHERE id_usuario = $id_usuario AND id_destinatario = $id_destinatario";
        DB::query(0, $sql)->execute();
    }
}
?>
