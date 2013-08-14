<?php

defined('SYSPATH') or die('Acceso denegado');

class Controller_index extends Controller_IndexTemplate {

    protected $user;
    protected $menus;

    public function before() {
        parent::before();
        $auth = Auth::instance();
        //si el usuario esta logeado entonces mostramos el menu
        if ($auth->logged_in()) {
            //menu top de acuerdo al nivel
            $session = Session::instance();
            $this->user = $session->get('auth_user');
            $oNivel = New Model_niveles();
            $this->menus = $oNivel->menus($this->user->nivel);
        } else {
            $this->request->redirect('/login');
        }
    }

    public function after() {
        $this->template->menutop = View::factory('templates/menutop')->bind('menus', $this->menus)->set('controller', 'index');
        $oSM = New Model_menus();
        $submenus = $oSM->submenus('index');
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus', $submenus)->set('titulo', 'Pagina de Inicio');
        parent::after();
    }

    public function action_index() {
        if ($this->user->nivel == 4) {
            $user = ORM::factory('users', array('id' => $this->user->id));
            $oficina = $user->oficina->oficina;
            $recepcionados = ORM::factory('documentos')->where('id_user', '=', $this->user->id)->count_all();
//            $derivados = ORM::factory('documentos')->where('id_user', '=', $this->user->id)
//                    ->and_where('estado', '=', 1)
//                    ->count_all();
            $derivados = ORM::factory('documentos')
                    ->join('seguimiento', 'INNER')
                    ->on('documentos.nur', '=', 'seguimiento.nur')
                    ->where('seguimiento.estado', '>', '0')
                    ->and_where('seguimiento.derivado_por', '=', $this->user->id)
                    ->and_where('seguimiento.id_seguimiento', '=', '0')
                    ->and_where('documentos.original', '=', '1')
                    ->count_all();

            $pendientes = ORM::factory('documentos')->where('id_user', '=', $this->user->id)
                    ->and_where('estado', '=', 0)
                    ->count_all();


            $this->template->title = 'Ventanilla | Inicio';
            $this->template->styles = array('media/css/tablas.css' => 'screen');
            $this->template->content = View::factory('ventanilla/menu')
                    ->bind('user', $user)
                    ->bind('oficina', $oficina)
                    ->bind('pendientes', $pendientes)
                    ->bind('recepcionados', $recepcionados)
                    ->bind('derivados', $derivados);
        } else {
            $estados = array(
                1 => array(
                    'titulo' => 'Entrada',
                    'plural' => ' tramites que le fueron derivados',
                    'singular' => ' tramites que le fueron derivados',
                    'accion' => '',
                    'cantidad' => 0
                ),
                2 => array(
                    'titulo' => 'Pendientes',
                    'plural' => 'correspondencias pendientes ',
                    'singular' => 'correspondecia pendiente',
                    'accion' => 'pendientes',
                    'cantidad' => 0
                ),
                10 => array(
                    'titulo' => 'Archivados',
                    'plural' => ' Correspondencias Archivadas',
                    'singular' => 'correspondencia archivada',
                    'accion' => 'archivos',
                    'cantidad' => 0
                ),
                6 => array(
                    'titulo' => 'Agrupados',
                    'plural' => 'Agrupados',
                    'singular' => 'agrupado',
                    'accion' => 'agrupados',
                    'cantidad' => 0
                ),
            );
            $oSeg = New Model_Seguimiento();
            $nEstados = $oSeg->estados($this->user->id);
            foreach ($nEstados as $v) {
                $estados[$v['id']]['cantidad'] = $v['n'];
            }
            $carpetas = ORM::factory('carpetas', array('id_oficina' => $this->user->id_oficina));
            //pagina de inicio        
            $usuario = array();
            $id = $this->user->id;
            $user = ORM::factory('users', array('id' => $id));
            $oficina = $user->oficina->oficina;
            $aTipos = array();
            $tipos = $user->tipo->find_all();
            foreach ($tipos as $t) {
                $aTipos[$t->id] = array(
                    'tipo' => $t->tipo,
                    'cantidad' => 0,
                    'plural' => $t->plural,
                    'id_tipo' => $t->id,
                );
            }
            $oDoc = New Model_documentos();
            $documentos = $oDoc->agrupados($this->user->id);
            foreach ($documentos as $d) {
                $aTipos[$d['id_tipo']]['cantidad'] = $d['n'];
            }
            $this->template->title .=' | Inicio';
            $this->template->scripts = array('media/Highcharts/js/highcharts.js',
                'media/Highcharts/js/modules/exporting.js');

            $this->template->content = View::factory('user/inicio')
                    ->bind('user', $user)
                    ->bind('oficina', $oficina)
                    ->bind('estados', $estados)
                    ->bind('carpetas', $carpetas)
                    ->bind('tipos', $aTipos);
        }
    }

    public function action_buscar() {
        $this->request->redirect('busqueda/buscar');
    }

}

?>
