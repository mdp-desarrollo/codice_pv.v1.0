<?php

defined('SYSPATH') or die('no tiene acceso');

//descripcion del modelo productos
class Model_nurs extends ORM {

    protected $_table_names_plural = false;
    //7una ofician tiene varios funcionarios (usuarios)
    protected $_has_many = array(
        'documentos' => array(
            'model' => 'documentos',
            'through' => 'nurs_documentos',
            'foreign_key' => 'nur',
            'far_key' => 'id_documento',
        ),
    );

    //generar un correlativo
    public function correlativo($id_tipo, $a, $id_entidad) {
        $result = ORM::factory('correlativo')
                ->where('id_tipo', '=', $id_tipo)
                ->and_where('id_entidad', '=', $id_entidad)
                ->find();

        //si existe el tipo para la entidad entonces 
        if ($result->id) {
            $result->correlativo=$result->correlativo+1;        
            //$result->correlativo = $result->correlativo;
            $result->save();
            $codigo = $a . date('Y') . '-' . substr('0000' . $result->correlativo, -5);
            return $codigo;
        } else {
            //agregamos uno nuevo            
            $result->id_tipo = $id_tipo;
            $result->id_entidad = $id_entidad;
            $result->save();

            $result->correlativo = $result->correlativo + 1;
            $result->save();
            $codigo = $a . date('Y') . '-' . substr('0000' . $result->correlativo, -5);
            return $codigo;
        }
    }

    //codigo de freddy
    public function correlativo_nur($a, $id_entidad) {

        $sql = "SELECT SUM(correlativo) as correlativo FROM correlativo WHERE id_entidad = '$id_entidad' AND id_oficina <> 0";
        $result = DB::query(Database::SELECT, $sql)->execute()->as_array();

        //si existe el tipo para la entidad entonces 
        if ($result) {
            $codigo = $a . date('Y') . '-' . substr('0000' . $result[0]['correlativo'], -5);
            return $codigo;
        } else {
            $codigo = $a . date('Y') . '-' . 10000;
            return $codigo;
        }
    }

    //function para asignar un nur
    public function asignarNur($codigo, $id_user, $username = '') {
        $nur = ORM::factory('nurs');
        $nur->nur = $codigo;
        $nur->id_user = $id_user;
        $nur->fecha_creacion = date('Y-m-d H:i:s');
        $nur->username = $username;
        $nur->save();
        return $nur->nur;
    }

    public function oficina($id) {
        $results = ORM::factory("oficinas")
                ->join('users', 'INNER')
                ->on("users.id_oficina", "=", "oficinas.id")
                ->where("users.id", "=", $id)
                ->find();
        return $results;
    }

}

?>
