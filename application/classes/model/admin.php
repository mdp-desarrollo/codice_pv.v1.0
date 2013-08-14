<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Admin extends ORM{
    //protected $_table_names_plural = false;
    //protected $_sorting = array('fecha_publicacion' => 'DESC');
    
    //lista de usuarios excepto quien lo 
    public function usuarios($id){
        $sql="SELECT u.id, u.id_oficina, o.oficina, u.username, u.nombre, u.last_login,u.mosca,u.cargo,u.email,u.logins, u.fecha_creacion,u.genero,n.nivel FROM users u
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN niveles n ON u.nivel=n.id
            WHERE u.id <> '$id'";
        return $this->_db->query(Database::SELECT, $sql, TRUE);
    }
    
    
}
?>
