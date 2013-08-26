<?php

defined('SYSPATH') or die('Acceso denegado');

class Controller_Pvpasajes extends Controller_DefaultTemplate {

    protected $user;
    protected $menus;

    public function before() {
        $auth = Auth::instance();
        //si el usuario esta logeado entocnes mostramos el menu
        if ($auth->logged_in()) {
            //menu top de acuerdo al nivel
            $session = Session::instance();
            $this->user = $session->get('auth_user');
            $oNivel = New Model_niveles();
            $this->menus = $oNivel->menus($this->user->nivel);
            parent::before();
            $this->template->title = 'Pasajes';
        } else {
            $url = substr($_SERVER['REQUEST_URI'], 1);
            $this->request->redirect('/login?url=' . $url);
        }
    }

    public function after() {
        $this->template->menutop = View::factory('templates/menutop')->bind('menus', $this->menus)->set('controller', 'pvpasajes');
        $oSM = New Model_menus();
        $submenus = $oSM->submenus('pvpasajes');
        $docs = FALSE;
        if ($this->user->nivel == 4) {
            $docs = TRUE;
        }
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus', $submenus)->bind('doc', $docs)->set('titulo', 'PASAJES');
        parent::after();
    }

    public function action_index($id = '') {
        $oAut = new Model_Pvpasajes();
        $autorizados = $oAut->pasajesautorizados();//lista de solicitudes autorizadas
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvpasajes/index')
                                        ->bind('autorizados', $autorizados)
                                        ;    
    }
    
    public function action_asignarpasaje($id = '') {
        $fucov = ORM::factory('pvfucovs')->where('id','=',$id)->find();
        if ($fucov->loaded()) {
            $pasajes = ORM::factory('pvpasajes');
            $pasajes->id_fucov = $id;
            $pasajes->transporte = $_POST['transporte'];
            $pasajes->empresa = $_POST['empresa'];
            $pasajes->nro_boleto = $_POST['nro_boleto'];
            //$pasajes->fecha_salida = strtotime($_POST['fechasalida'].' '.$_POST['horasalida']);
            //$pasajes->fecha_arribo = strtotime($_POST['fechaarribo'].' '.$_POST['horaarribo']);
            $fs = date('Y-m-d', strtotime(substr($_POST['fecha_salida'], 4, 10))) . ' ' . date('H:i:s', strtotime($_POST['hora_salida']));
            $fa = date('Y-m-d', strtotime(substr($_POST['fecha_arribo'], 4, 10))) . ' ' . date('H:i:s', strtotime($_POST['hora_arribo']));
            $pasajes->fecha_salida = $fs;
            $pasajes->fecha_arribo = $fa;
            $pasajes->costo = $_POST['costo'];
            $pasajes->origen = $_POST['origen'];
            $pasajes->destino = $_POST['destino'];
          //$pasajes->save();
         ///actualizar fucovs
            //if($pasajes->id){
                //$fucov->etapa_proceso = 2;
                //$fucov->save();
                $this->request->redirect('documento/detalle/'.$fucov->id_memo);
            //}
        }
        else
            $this->template->content = 'El FUCOV no existe';
    }
/*    
    public function action_autorizados(){
        
    }

    public function action_detalleautorizados($id){
        //id = id_memo
        $memo = ORM::factory('documentos')->where('id', '=', $id)->find();
            if ($memo->loaded()) {
            $fucov = ORM::factory('pyvfucov')->where('id_memo', '=', $id)->find();
            $documento = ORM::factory('documentos')->where('id','=', $fucov->id_documento)->find();
                if($fucov->loaded()){
                //$pasaje = ORM::factory('pyvpasajes')->where('id_fucov','=',$fucov->id);
                $oPsj = new Model_Pyvpasajes();
                $pas = $oPsj->pasaje_asignado($fucov->id);
                foreach ($pas as $p) $pasaje = $p; 
        //$this->template->scripts = array('media/js/jquery-ui-1.8.16.custom.min.js','media/js/jquery.timeentry.js');            
                            $this->template->content = View::factory('pyv/pasajes/detalleautorizados')
                                    ->bind('memo', $memo)
                                    ->bind('d', $documento)
                                    //->bind('tipo', $tipo)
                                    //->bind('archivo', $archivo)
                                    //->bind('errors', $errors)
                                    //->bind('mensajes', $mensajes)
                                    ->bind('f',$fucov)
                                    ->bind('pasaje',$pasaje)
                                    //->bind('estado_seguimiento',$estado)
                                    //->bind('nivel',$nivel)
                                    //->bind('user',$this->user)
                                    ;
                }
                else
                    $this->template->content = 'No hay FUCOV asignado';
            }
            else
            {
                $this->template->content = 'El Memor&aacute;ndum no existe';
            }
    }*/

}

?>
