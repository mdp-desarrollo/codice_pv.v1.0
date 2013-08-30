<?php

defined('SYSPATH') or die('Acceso denegado');

class Controller_Pvplanificacion extends Controller_DefaultTemplate {

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
        $this->template->menutop = View::factory('templates/menutop')->bind('menus', $this->menus)->set('controller', 'pvplanificacion');
        $oSM = New Model_menus();
        $submenus = $oSM->submenus('pvplanificacion');
        $docs = FALSE;
        if ($this->user->nivel == 4) {
            $docs = TRUE;
        }
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus', $submenus)->bind('doc', $docs)->set('titulo', 'PLANIFICACION');
        parent::after();
    }

    public function action_index() {
        $oAut = new Model_Pvpoas();
        $autorizados = $oAut->listaautorizados($this->user->id, $this->user->id_entidad);//lista de solicitudes autorizadas
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvplanificacion/index')
                                        ->bind('autorizados', $autorizados)
                                        ;    
    }
    
    public function action_poa(){
        $oUnid = new Model_oficinas();
        $unidades = $oUnid->listaunidades($this->user->id_entidad);
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvplanificacion/listaunidades')
                                        ->bind('unidades', $unidades)
                                        ;
    }
    
    public function action_editarpoa($id = '') {
        $pvfucov = ORM::factory('pvfucovs')->where('id','=',$id)->find();
        if($pvfucov->etapa_proceso == 3){
        $pvpoas = ORM::factory('pvpoas')->where('id_fucov','=',$id)->find();
            if ($pvpoas->loaded()) {
                $pvpoas->id_obj_gestion = $_POST['obj_gestion'];
                $pvpoas->id_obj_esp = $_POST['obj_esp'];
                $pvpoas->fecha_modificacion = date('Y-m-d H:i:s');
                $pvpoas->save();
                $this->request->redirect('documento/detalle/'.$pvfucov->id_memo);
            }
            else
                $this->template->content = 'El FUCOV no existe';
        }
        else
            $this->template->content = 'El FUCOV no se puede Modificar';
    }
    
    public function action_autorizarfucov($id = '') {
        $pvfucov = ORM::factory('pvfucovs')->where('id','=',$id)->find();
        if ($pvfucov->loaded()) {
            $pvfucov->etapa_proceso = 4;
            $pvfucov->save();
            $pvpoas = ORM::factory('pvpoas')->where('id_fucov','=',$id)->find();
            if($pvpoas->loaded()){
                $pvpoas->auto_poa = 1;
                $pvpoas->fecha_certificacion = date('Y-m-d H:i:s');
                $pvpoas->id_user_auto = $this->user->id;
                $pvpoas->save();
                $this->request->redirect('documento/detalle/'.$pvfucov->id_memo);
            }
            else
                $this->template->content = 'No hay POA Asignado';
        }
    }
    
    public function action_objetivogestion($id = ''){
        $oficina = ORM::factory('oficinas')->where('id','=',$id)->find();
        $objetivos = ORM::factory('pvogestiones')->where('id_oficina','=',$id)->and_where('estado','=',1)->find_all();
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvplanificacion/objgestion')
                                        ->bind('objetivos', $objetivos)
                                        ->bind('oficina', $oficina)
                                        ;
    }
    
    public function action_addobjgestion($id = ''){
        $oficina = ORM::factory('oficinas')->where('id','=',$id)->find();
        $entidad = ORM::factory('entidades')->where('id','=',$oficina->id_entidad)->find();
        if (isset($_POST['submit'])) {
            $objetivo = ORM::factory('pvogestiones');
            $objetivo->codigo = $_POST['codigo'];
            $objetivo->objetivo = utf8_encode($_POST['objetivo']);
            $objetivo->id_oficina = $id;
            $objetivo->estado = 1;
            $objetivo->save();
            $this->request->redirect('pvplanificacion/objetivogestion/'.$id);
        }
        //$objetivos = ORM::factory('pvogestiones')->where('id_oficina','=',$id)->find_all();
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvplanificacion/addobjgestion')
                                        //->bind('objetivos', $objetivos)
                                        ->bind('oficina', $oficina)
                                        ->bind('entidad', $entidad)
                                        ;
    }
    
    public function action_editobjgestion($id = ''){
        $objetivo = ORM::factory('pvogestiones')->where('id','=',$id)->find();
        if (isset($_POST['submit'])) {
            $objetivo->codigo = $_POST['codigo'];
            $objetivo->objetivo = utf8_encode($_POST['objetivo']);
            $objetivo->id_oficina = $_POST['id_oficina'];
            $objetivo->save();
            $this->request->redirect('pvplanificacion/objetivogestion/'.$_POST['id_oficina']);
        }
        //$objetivo = ORM::factory('pvogestiones')->where('id','=',$id)->find();
        $oficina = ORM::factory('oficinas')->where('id','=',$objetivo->id_oficina)->find();
        $entidad = ORM::factory('entidades')->where('id','=',$oficina->id_entidad)->find();
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvplanificacion/editobjgestion')
                                        ->bind('objetivo', $objetivo)
                                        ->bind('oficina', $oficina)
                                        ->bind('entidad', $entidad)
                                        ;
    }
}

?>
