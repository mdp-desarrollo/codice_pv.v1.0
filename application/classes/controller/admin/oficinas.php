}<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Oficinas extends Controller_AdminTemplate {

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
            // $this->template->title='<li>'.html::anchor('admin','Bandeja').'</li>';
        } else {
            $this->request->redirect('/login');
        }
    }

    public function after() {
        $this->template->menutop = View::factory('templates/menutop')->bind('menus', $this->menus)->set('controller', 'index');
        $oSM = New Model_menus();
        $submenus = $oSM->submenus('admin');
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus', $submenus)->set('titulo', 'Administrar');
        parent::after();
    }

    // lista de oficinas
    public function action_index() {
        $oOficina = New Model_Oficinas();
        $oficinas = $oOficina->lista_oficinas();
        $this->template->title.=' | Oficinas';
        $this->template->content = View::factory('admin/lista_oficinas')
                ->bind('oficinas', $oficinas);
    }

    public function action_lista($id = '') {
        $entidad = ORM::factory('entidades', array('id' => $id));
        if ($entidad->loaded()) {
            $nombre_entidad = $entidad->entidad;
            $options = array();
            $entidades = ORM::factory('entidades')->find_all();
            foreach ($entidades as $e) {
                $options[$e->id] = $e->entidad;
            }
            $oficinas = $entidad->oficinas->find_all();
            $this->template->content = View::factory('admin/oficinas')
                    ->bind('oficinas', $oficinas)
                    ->bind('options', $options)
                    ->bind('id_entidad', $id)
                    ->bind('entidad', $nombre_entidad);
        } else {
            $this->template->content = 'Error: No se encontro la entidad';
        }
    }

    public function action_nuevo() {
        $entidades = ORM::factory('entidades')->find_all();
        $options = array();
        foreach ($entidades as $e) {
            $options[$e->id] = $e->entidad;
        }
        if ($_POST) {
            $this->request->redirect('/admin/user/create/' . $_POST['entidad']);
        }
        $this->template->content = View::factory('admin/nuevo1')
                ->bind('options', $options);
    }

    public function action_create($id = '') {
        $error = array();
        $info = array();
        if (isset($_POST['create'])) {
            $id = $_POST['entidad'];
            $sigla = ORM::factory('oficinas')->where('sigla', '=', $_POST['sigla'])->find();
            if ($sigla->loaded()) {
                $error['Error'] = 'Ya existe una oficina con la sigla <b>' . $_POST['sigla'] . '</b>, escriba otra por favor.';
            } else {
                $oficina = ORM::factory('oficinas');
                $oficina->id_entidad = $_POST['entidad'];
                $oficina->oficina = trim($_POST['oficina']);
                $oficina->sigla = trim($_POST['sigla']);
                $oficina->padre = $_POST['padre'];
                $oficina->save();
                if ($oficina->id) {
                    //ahora guardamos por defecto el cite para los tipos de documentos
                    $tipos = ORM::factory('tipos')->where('doc', '=', 0)->find_all();
                    foreach ($tipos as $t) {
                        $correlativo = ORM::factory('correlativo');
                        $correlativo->id_oficina = $oficina->id;
                        $correlativo->id_tipo = $t->id;
                        $correlativo->id_entidad = $id;
                        $correlativo->save();
                    }
                    $info['Exito!'] = 'Se creo correctamente la oficina <b>' . $oficina->oficina . '</b>';
                    $_POST = array();
                }
            }
        }
        $entidad = ORM::factory('entidades', array('id' => $id));
        if ($entidad->loaded()) {
            $options = array();
            $oficinas = ORM::factory('oficinas')->where('id_entidad', '=', $entidad->id)->find_all();
            foreach ($oficinas as $o) {
                $options[$o->id] = $o->oficina . ' | ' . $o->sigla;
            }
            if (sizeof($options) == 0) {
                $options[0] = 'Oficina Principal';
            }
            $this->template->title.=' | Crear Oficina';
            $this->template->content = View::factory('admin/add_oficina')
                    ->bind('options', $options)
                    ->bind('entidad', $entidad)
                    ->bind('error', $error)
                    ->bind('info', $info);
        }
    }

    public function action_oficinas($id = '') {
        $auth = Auth::instance();
        if ($auth->logged_in()) {
            /* $oData=new Model_data();
              $usuarios=$oData->usuarios($id);
             * */
            $usuarios = ORM::factory('users')->where('id_oficina', '=', $id)->find_all();
            $this->template->content = View::factory('user/list')->bind('usuarios', $usuarios);
        }
    }

    //lista de usuarios
    public function action_listar() {
        $auth = Auth::instance();
        if ($auth->logged_in()) {
            $user = ORM::factory('users', $auth->get_user());
            $oficina = ORM::factory('oficinas', 27);
            $usuarios = ORM::factory('users')->where('id_oficina', '=', 27)->find_all();
            $this->template->menu = View::factory('admin/menu');
            $this->template->content = View::factory('user/list')->bind('usuarios', $usuarios)
                    ->bind('oficina', $oficina);
        }
    }

    public function action_listado() {

        $this->lista = '<ul id="entidad">';
        // echo '<ul>';

        $this->listar(1, 'Despacho Ministerial', 'MDPyEP');
        //   echo '</ul>';
        $this->lista.='</ul>';
        $config = array();
        //$config=  ORM::factory('configuracion',1);
        $this->template->menu = View::factory('admin/menu');
        $this->template->content = View::factory('oficina/lista')
                ->bind('lista', $this->lista)
                ->bind('config', $config);
    }

    public function listar($id, $oficina, $sigla) {
        $h = ORM::factory('oficinas')->where('padre', '=', $id)->count_all();
        //echo '<li>'.$oficina;       
        $this->lista.='<li class="oficina">' . HTML::anchor('admin/user/lista/' . $id, $oficina . ' | ' . $sigla);
        if ($h > 0) {
            //echo '<ul>';
            $this->lista.='<ul>';
            $hijos = ORM::factory('oficinas')->where('padre', '=', $id)->find_all();
            foreach ($hijos as $hijo) {
                $oficina = $hijo->oficina;
                $this->listar($hijo->id, $oficina, $hijo->sigla);
            }
            $this->lista.='</ul>';
            // echo '</ul>';
        } else {
            $this->lista.='</li>';
            //   echo '</li>';
        }
    }

}

?>
