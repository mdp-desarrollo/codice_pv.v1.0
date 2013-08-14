<?php
defined('SYSPATH') or die ('no tiene acceso');
class Model_data extends Kohana_Model{
    //usuarios por oficina
    public function usuarios($id){
        $sql="SELECT u.id,u.username,u.nombre, u.email,c.cargo from users u
            left JOIN cargos c 	ON u.id_cargo=c.id
            WHERE u.id_oficina='$id'";
        return DB::query(1, $sql)->execute()->as_array();
    }
    //destinatario y vias para informes del usuario 'id'
    public function vias($id){
        $sql="SELECT u.id as id_d, u.nombre,u.cargo,w.id as id_v, w.nombre as via, w.cargo as cargo_via,u.genero from users u 
             INNER JOIN vias v ON v.id_destinatario=u.id
             LEFT JOIN users w ON v.id_via=w.id
             WHERE v.id_usuario='$id'";
        return DB::query(1, $sql)->execute();
    }
    //codigo de freddy
    public function destinatarios($id){
        $sql="SELECT DISTINCT u.id,u.cargo,u.nombre,u.genero
                FROM destinatarios AS des
                INNER JOIN users AS u ON des.id_destino = u.id
                WHERE des.id_usuario ='$id'";
        return DB::query(1, $sql)->execute();
    }
    //
    public function superior($id){
        $sql="SELECT w.id,w.cargo,w.nombre,w.genero FROM users u
              INNER JOIN users w ON u.superior=w.id
              WHERE u.id='$id'";
        return DB::query(1, $sql)->execute();
    }
    public function dependientes($id){
        $sql="SELECT w.id,w.cargo,w.nombre,w.genero FROM users u
              INNER JOIN users w ON w.superior=u.id
              WHERE w.superior='$id'";
        return DB::query(1, $sql)->execute();
    }
    //docuemtos 
    

    public function no_recibidos($id){}
    //lista de articulos json
    public function noticias(){
        $sql="SELECT n.id,n.titulo, n.descripcion
            FROM comunicados n
            WHERE n.tipo = '1'";
        return  DB::select()->from('comunicados')->where('tipo', '=', 1)->execute()->as_array();        
    }
    //pendientes oficiales
    public function page($r,$o,$u){
        $sql="SELECT s.codigo, s.f_derivacion as fecha, u.nombre,a.nombre,u.cargo,s.oficial,h.codigo as documento,d.referencia,d.autor  FROM seguimientos s
              INNER JOIN users u ON s.derivado_a=u.username
              INNER JOIN areas a ON a.id=u.id_area
              INNER JOIN hojas_ruta h ON h.nur=s.codigo
              INNER JOIN documentos d ON d.codigo=h.codigo
            WHERE s.estado='2'
            AND s.derivado_a='$u'
            ORDER BY s.f_derivacion DESC
            LIMIT $r,$o";
        return DB::query(1, $sql)->execute();
    }


    //lista de marcas por el rubro
    public function listarMarcas($id){
        $sql="SELECT id,idRubro,marca
            FROM marcas
            WHERE idRubro='$id'";
        return Db::query(Database::SELECT, $sql);
        return $this->_db->query(Database::SELECT, $sql,TRUE);
    }

}
?>
