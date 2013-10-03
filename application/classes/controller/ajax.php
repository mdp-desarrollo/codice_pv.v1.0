<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller {

    public function action_derivar() {
        if ($_POST) {
            $tipo = $_POST['tipo'];
            $oficial = $_POST['oficial'];
            $id_seg = $_POST['id_seg'];
            $destino = $_POST['destino'];
            $accion = $_POST['accion'];
            $proveido = strtoupper($_POST['proveido']);
            $nur = $_POST['nur'];
            $user = $_POST['user'];
            $id_doc = $_POST['document'];
            $hijo = $_POST['hijo'];
            $prioridad = $_POST['urgente'];
            $session = Session::instance();
            if ($session->get('destino')) {
                $usuario = $session->get('destino');
                //verificamos que el usuario no estee en destinatarios ya enviados
                if (array_key_exists($destino, $session->get('destino'))) {
                    $error = array('error' => 'Ya se envio la hoja de ruta: ' . $nur . ' al usuario.');
                    echo json_encode($error);
                    exit;
                }
                //verificamos que solo se envie un oficial
                if (isset($usuario['oficial'])) {
                    if ($usuario['oficial'] == $oficial) {
                        $error = array('error' => 'Solo puede enviar un oficial');
                        //$session->delete('destino');
                        echo json_encode($error);
                        exit;
                    }
                }
            }
            $usuario[$destino] = $destino;

            if ($oficial > 0)
                $usuario['oficial'] = $oficial;

            $session->set('destino', $usuario);

            $adjunto = $_POST['adjunto'];
            if ($adjunto == 0)
                $adjunto = json_encode(array());
            else
                $adjunto = json_encode($adjunto);

            $destino = ORM::factory('users', $destino);
            $oficina_destino = ORM::factory('oficinas', $destino->id_oficina);
            $remite = ORM::factory('users', $user);
            $oficina_remite = ORM::factory('oficinas', $remite->id_oficina);

            // modificado por freddy
            if ($id_seg < 1) {
                $documentos = ORM::factory('documentos')->where('id', '=', $id_doc)->find();
                if ($documentos->loaded()) {
//                    if (($documentos->id_seguimiento > 0) && ($oficial == $tipo)) {
//                        $seguimiento_actual = ORM::factory('seguimiento')
//                                ->where('id', '=', $documentos->id_seguimiento)
//                                ->find();
//                        $seguimiento_actual->estado = 4;
//                        if ($seguimiento_actual->oficial == 1) {
//                            $seguimiento_actual->oficial = 2;
//                        }
//                        $seguimiento_actual->save();
//                    }
                    $id_seg = $documentos->id_seguimiento;
                }
            }
            //////////////////////

            $seguimiento = ORM::factory('seguimiento');
            if (($id_seg > 0) && ($oficial == $tipo)) {
                $seguimiento_actual = ORM::factory('seguimiento')
                        ->where('id', '=', $id_seg)
                        ->find();
                $seguimiento_actual->estado = 4;
                if ($seguimiento_actual->oficial == 1) {
                    $seguimiento_actual->oficial = 2;
                }
                $seguimiento_actual->save();
                //incrementado por freddy
                if (isset($usuario['oficial'])) {
                    $documento = ORM::factory('documentos', $id_doc);
                    $documento->estado = 1;
                    $documento->save();
                }
            } else {
                if (isset($usuario['oficial'])) {
                    $documento = ORM::factory('documentos', $id_doc);
                    $documento->estado = 1;
                    $documento->save();
                }
            }
            $seguimiento->id_seguimiento = $id_seg;
            $seguimiento->nur = $nur;
            $seguimiento->derivado_por = $remite->id;
            $seguimiento->nombre_emisor = $remite->nombre;
            $seguimiento->cargo_emisor = $remite->cargo;
            $seguimiento->fecha_emision = date('Y-m-d H:i:s');
            $seguimiento->derivado_a = $destino->id;
            $seguimiento->nombre_receptor = $destino->nombre;
            $seguimiento->cargo_receptor = $destino->cargo;
            $seguimiento->estado = 1;
            $seguimiento->accion = $accion;
            $seguimiento->oficial = $oficial;
            $seguimiento->hijo = $hijo;
            $seguimiento->proveido = $proveido;
            $seguimiento->adjuntos = $adjunto;
            $seguimiento->de_oficina = $oficina_remite->oficina;
            $seguimiento->a_oficina = $oficina_destino->oficina;
            $seguimiento->id_de_oficina = $oficina_remite->id;
            $seguimiento->id_a_oficina = $oficina_destino->id;
            $seguimiento->prioridad = $prioridad;
            $seguimiento->save();

            $result = array(
                'id' => $seguimiento->id,
                'remite_nombre' => $seguimiento->nombre_emisor,
                'remite_cargo' => $seguimiento->cargo_emisor,
                'de_oficina' => $seguimiento->de_oficina,
                'receptor_nombre' => $seguimiento->nombre_receptor,
                'receptor_cargo' => $seguimiento->cargo_receptor,
                'a_oficina' => $seguimiento->a_oficina,
                'proveido' => $seguimiento->proveido,
                'oficial' => $seguimiento->oficial,
                'id_destino' => $seguimiento->derivado_a,
                'adjunto' => json_decode($seguimiento->adjuntos),
            );
            if (!$oficial)
                $oficial = 'Copia'; else
                $oficial = 'Oficial';
            //guardamo vitacora
            $this->save($remite->id_entidad, $seguimiento->derivado_por, $seguimiento->nombre_emisor . ' | <b>' . $seguimiento->cargo_emisor . '</b> Deriva la Hoja de Ruta ' . $seguimiento->nur . '(' . $oficial . ') a ' . $seguimiento->nombre_receptor . ' | <b>' . $seguimiento->cargo_receptor . '</b>');

            echo json_encode($result);
        }
    }

    public function action_eliminar() {
        $id_seg = $_POST['id'];
        $id_destino = $_POST['destino'];
        $oficial = $_POST['oficial'];
        $id_doc = $_POST['document'];
        $session = Session::instance();
        $usuario = $session->get('destino');
        unset($usuario[$id_destino]);
        //verificamos si se borro algun oficial
        if ($oficial == 1)
            unset($usuario['oficial']);
        $session->set('destino', $usuario);
        /* quitar el seguimiento */
        $seguimiento = ORM::factory('seguimiento', $id_seg);
        if ($seguimiento->loaded()) {
            if (sizeof($usuario) == 0) {
                if ($seguimiento->id_seguimiento > 0) { //si tienes seguimieto previo el nur debe volver a pendientes
                    $seg_anterior = ORM::factory('seguimiento', $seguimiento->id_seguimiento);
                    if ($seg_anterior->oficial == 2)
                        $seg_anterior->oficial = 1;
                    $seg_anterior->estado = 2;
                    $seg_anterior->save();
                }
                else {        //si no tiene seguimiento, fue la primera derivacion, entonces el documento debe cambiar el estado
                    $documento = ORM::factory('documentos', $id_doc);
                    if ($documento->loaded()) {
                        $documento->estado = 0;
                        $documento->save();
                    }
                }
            }
            //vitacora
            if (!$seguimiento->oficial)
                $oficial = 'Copia'; else
                $oficial = 'Oficial';
            $this->save(0, $seguimiento->derivado_por, $seguimiento->nombre_emisor . ' | <b>' . $seguimiento->cargo_emisor . '</b> Cancela derivacion de la Hoja de Ruta ' . $seguimiento->nur . '(' . $oficial . ') a ' . $seguimiento->nombre_receptor);
            $seguimiento->delete();
        }

        //si no hay usuarios que derivar verificamos el estado de la derivacion

        echo json_encode($usuario);
    }

    //LISTA DE DOCUMENTOS CREADOS 
    public function action_documentos() {
        $auth = Auth::instance();
        if ($auth->logged_in()) {
            $documentos = ORM::factory('documentos')
                    ->where('id_user', '=', $auth->get_user())
                    ->find_all();
            $doc = array();
            foreach ($documentos as $d) {
                $doc[] = array('key' => $d->codigo, 'value' => $d->codigo);
            }
            echo json_encode($doc);
        }
    }

    //archivar documento
    public function action_archivar() {
        $auth = Auth::instance();
        if ($auth->logged_in()) {
            $oArch = New Model_Archivados();
            $a = $oArch->archivar($_POST['id_nuri'], $auth->get_user(), $_POST['carpeta'], date('Y-m-d H:i:s'));
            if ($a) {
                echo json_encode(array('La hoja de Seguimiento fue almacenada correctamente'));
            } else {
                echo json_encode(array('Hubo un error al guardar en archivos'));
            }
        }
    }

    //imprimir una hoja de seguimiento
    public function action_print_hs() {
        $hs = $_POST['nur'];
        $aNur = array();
        $nur = ORM::factory('nurs')->where('nur', '=', $hs)->count_all();
        if ($nur > 0) {
            $aNur['nur'] = $nur;
        } else {
            $aNur['nur'] = 0;
        }
        echo json_encode($aNur);
    }

    //verificamos el usuario unico
    public function action_username() {
        $username = Arr::get($_POST, 'username', '');
        $myuser = ORM::factory('users', array('username' => $username));
        $res = 0;
        if ($myuser->loaded()) {
            $res = 1;
        }
        echo json_encode(array('result' => $res));
    }

    //verificamos un email unico
    public function action_emailunique() {
        $email = Arr::get($_POST, 'email', '');

        $myuser = new Model_Myuser();
        $res = $myuser->username_unique($email);

        echo json_encode(array('result' => $res));
    }

    //verificamos un email unico
    public function action_email() {
        $email = Arr::get($_POST, 'email', '');
        $myuser = ORM::factory('users', array('email' => $email));
        $res = 0;
        if ($myuser->loaded()) {
            $res = 1;
        }
        echo json_encode(array('result' => $res));
    }

    public function action_checkOldPass() {
        $oldpass = Arr::get($_POST, 'oldpass', '');

        $myuser = new Model_Myuser();
        $res = $myuser->checkOldPass($oldpass);

        echo json_encode(array('result' => $res));
    }

    /*     * *********************REPORTES*********************** */

    public function action_pOficina() {
        $auth = Auth::instance();
        if ($auth->logged_in()) {
            $session = Session::instance();
            $user = $session->get('auth_user');
            //usuarios que pertences a mi oficina  
            $users = ORM::factory('users')->where('id_oficina', '=', $user->id_oficina)->or_where('superior', '=', $user->id)->find_all();
            $oficiales = array();
            $copias = array();
            $usuarios = array();
            $archivados = array();
            foreach ($users as $u) {
                $oficial = ORM::factory('seguimiento')->where('derivado_a', '=', $u->id)->and_where('estado', '=', 2)->and_where('oficial', '=', 1)->count_all();
                $copia = ORM::factory('seguimiento')->where('derivado_a', '=', $u->id)->and_where('estado', '=', 2)->and_where('oficial', '=', 0)->count_all();
                $archivado = ORM::factory('seguimiento')->where('derivado_a', '=', $u->id)->and_where('estado', '=', 10)->count_all();
                array_push($oficiales, (int) $oficial);
                array_push($copias, (int) $copia);
                array_push($usuarios, $u->nombre);
                array_push($archivados, (int) $archivado);
            }
            $pendientes = array(
                'oficiales' => array_values($oficiales),
                'copias' => array_values($copias),
                'archivados' => array_values($archivados),
                'names' => array_values($usuarios),
            );
            echo json_encode($pendientes);
        }
    }

#******* pendientes por oficinas ***********        

    public function action_pOficinas() {
        $auth = Auth::instance();
        if ($auth->logged_in()) {
            $session = Session::instance();
            $user = $session->get('auth_user');
            //usuarios que pertences a mi oficina  
            $oficina = ORM::factory('oficinas', $user->id_oficina);
            $oficinas = ORM::factory('oficinas')->where('id_entidad', '=', $oficina->id_entidad)->find_all();
            $oficiales = array();
            $copias = array();
            $usuarios = array();
            $archivados = array();
            foreach ($oficinas as $u) {
                $oficial = ORM::factory('seguimiento')->where('id_a_oficina', '=', $u->id)->and_where('estado', '=', 2)->and_where('oficial', '=', 1)->count_all();
                $copia = ORM::factory('seguimiento')->where('id_a_oficina', '=', $u->id)->and_where('estado', '=', 2)->and_where('oficial', '=', 0)->count_all();
                $archivado = ORM::factory('seguimiento')->where('id_a_oficina', '=', $u->id)->and_where('estado', '=', 10)->count_all();
                array_push($oficiales, (int) $oficial);
                array_push($copias, (int) $copia);
                array_push($usuarios, $u->oficina);
                array_push($archivados, (int) $archivado);
            }
            $pendientes = array(
                'oficiales' => array_values($oficiales),
                'copias' => array_values($copias),
                'archivados' => array_values($archivados),
                'names' => array_values($usuarios),
            );
            echo json_encode($pendientes);
        }
    }

    public function action_vercite() {
        if ($_POST) {
            $a_documento = array();
            $cite = trim($_POST['cite']);
            $oficina = trim($_POST['oficina']);
            if ($cite == '' || $cite == 'S/C') {
                echo json_encode($a_documento);
            } else {
                $documento = ORM::factory('documentos')
                        ->where('cite_original', '=', $cite)
                        ->and_where('id_oficina', '=', $oficina)
                        ->find();
                if ($documento->loaded()) {
                    $a_documento['error'] = 'El documento ya fue recpecionado en fecha: ' . $documento->fecha_creacion . ' y tiene HOJA DE RUTA ' . $documento->nur;
                }
                echo json_encode($a_documento);
            }
        }
    }

    public function action_pendientes() {
        $id = $_POST['user'];
        $usuarios = ORM::factory('users')
                ->where('superior', '=', $id)
                ->and_where('habilitado', '=', 1)
                ->find_all();
        $data = array();
        $sql = "SELECT u.id, u.nombre,u.cargo,COUNT(*) as  pendientes FROM users u
    INNER JOIN seguimiento s ON s.derivado_a=u.id
    WHERE s.estado='2'
    AND s.derivado_a IN ( ";
        foreach ($usuarios as $u):
            $data[$u->id] = array(
                'id' => $u->id,
                'nombre' => $u->nombre,
                'pendientes' => 0,
                'cargo' => $u->cargo
            );
            $sql.=$u->id . ", ";
        endforeach;
        $sql = substr($sql, 0, -2);
        $sql.=" ) GROUP BY u.id";
        $mSeg = New Model_Seguimiento();
        $pendientes = $mSeg->pendientes2($sql);
        foreach ($pendientes as $p):
            $data[$p['id']] = array(
                'id' => $p['id'],
                'nombre' => $p['nombre'],
                'pendientes' => $p['pendientes'],
                'cargo' => $p['cargo']
            );
        endforeach;
        echo json_encode($data);
    }

    public function save($entidad, $user, $accion) {
        $vitacora = ORM::factory('vitacora');
        $vitacora->id_usuario = $user;
        $vitacora->id_entidad = $entidad;
        $vitacora->fecha_hora = date('Y-m-d H:i:s');
        $vitacora->accion_realizada = $accion;
        $vitacora->ip_usuario = Request::$client_ip;
        $vitacora->save();
    }

    //////////Modificado por Freddy/////////////
    public function action_getmonto() {
        $id_tv = $_POST['id_tv'];
        $id_ca = $_POST['id_ca'];
        $pvcategoriatipo = new Model_Pvcategoriatipos();
        
        $sql='SELECT monto,moneda FROM pvcategoriatipos WHERE id_categoria='.$id_ca.' AND id_tipoviaje='.$id_tv.' AND estado=1';
        $resp = $pvcategoriatipo->getmonto($sql);
        foreach ($resp as $v) {
            $resul = array(
                'monto' => $v['monto'],
                'moneda' => $v['moneda']
            );
        }
        echo json_encode($resul);
    }
    
    public function action_docfucov() {
        $id_doc = $_POST['id_doc'];
        $pvfucov = new Model_Pvfucovs();
        
        $sql="SELECT id FROM pvfucovs WHERE id_memo=$id_doc";
        $resp = $pvfucov->memofucov($sql);
        $resul= array();
        foreach ($resp as $value) {
            $resul = array('id'=>$value['id']);
        }
        echo json_encode($resul);
    }
    ///////////////end///////////////////////
}