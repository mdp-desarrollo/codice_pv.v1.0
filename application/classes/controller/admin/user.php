<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_User extends Controller_AdminTemplate {

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

    //
    public function action_index() {
        // $entidades=ORM::factory('entidades')->find_all();
        // $this->template->content = View::factory('admin/lista_entidades')
        //                             ->('entidades',$entidades);

        $this->template->content = View::factory('admin/bienvenida');
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

    //crear un nuevo usuario mediante 'id_oficina'
    public function action_create($id = 0) {
        $oficina = ORM::factory('oficinas', array('id' => $id));
        $_POST['fecha_creacion'] = date("Y-m-d H:i:s");
        if ($oficina->loaded()) {
            $entidad = ORM::factory('entidades',array('id'=>$oficina->id_entidad ));
            //$entidad = $oficina->entidad->find();
            $roles = ORM::factory('niveles')->find_all();
            $options = array();
            foreach ($roles as $o) {
                $options[$o->id] = $o->nivel;
            }
            //Modificado por freddy
            $pvcategoria = ORM::factory('pvcategorias')->find_all();
            $opt_categorias = array();
            foreach ($pvcategoria as $o) {
                $opt_categorias[$o->id] = $o->categoria;
            }


            $superiores = ORM::factory('users')
                    ->where('id_oficina', '=', $id)
                    ->and_where('dependencia', '=', 0)
                    ->find_all();
            $jefes = array(0 => '');
            foreach ($superiores as $s):
                $jefes[$s->id] = $s->nombre;
            endforeach;
            $this->template->title = '' . $entidad->entidad;
            $this->template->content = View::factory('user/create')
                    ->bind('options', $options)
                    ->bind('message', $message)
                    ->bind('errors', $errors)
                    ->bind('oficina', $oficina)
                    ->bind('pvcategoria', $opt_categorias)
                    ->bind('jefes', $jefes)
                    ->bind('entidad', $entidad);
            if ($_POST) {
                try {

                    // Create the user using form values
                    $user = ORM::factory('user')->create_user($_POST, array(
                        'username',
                        'password',
                        'email',
                        'id_oficina',
                        'mosca',
                        'cargo',
                        'nombre',
                        'nivel',
                        'genero',
                        'superior',
                        'dependencia',
                        'id_entidad',
                        'fecha_creacion',
                        'id_categoria',
                            ));


                    // Grant user login role
                    $user->add('roles', 1);
                    //tipos
                    $user = ORM::factory('users', $user->id);
                    $user->add('tipo', 3);
                    $user->add('tipo', 4);
                    $user->add('tipo', 5);
                    // Reset values so form is not sticky
                    $_POST = array();

                    // Set success message
                    $message = "Se creo el usuario '{$user->username}' correctamente";
                } catch (ORM_Validation_Exception $e) {

                    // Set failure message
                    $message = 'Usted tiene errores en el formulario revise por favor.';
                    // Set errors using custom messages
                    //$errors = $e->errors('models');
                }
            }
        }
    }

//    //lista de usuarios por oficina
//    public function action_lista($id = '') {
//        $oficina = ORM::factory('oficinas', array('id' => $id));
//        if ($oficina->loaded()) {
//            $nombre_oficina = $oficina->oficina;
//            $users = $oficina->users->find_all();
//            $entidad = $oficina->entidad->find();  //vemos a entidad pertence la oficina (id_entidad)            
//            $o_entidad = ORM::factory('entidades', $entidad);
//            $oficinas = $o_entidad->oficinas->find_all();
//            $options = array();
//            foreach ($oficinas as $o) {
//                $options[$o->id] = $o->oficina;
//            }
//            $this->template->content = View::factory('admin/lista_usuarios')
//                    ->bind('users', $users)
//                    ->bind('oficina', $nombre_oficina)
//                    ->bind('id_oficina', $id)
//                    ->bind('users', $users)
//                    ->bind('options', $options)
//                    ->bind('entidad', $o_entidad)
//                    ->bind('id_entidad', $entidad);
//        } else {
//            $this->template->content = 'Oficina no encontrada';
//        }
//    }
    
    public function action_lista($id = '') {
        $oficina = ORM::factory('oficinas', array('id' => $id));
        if ($oficina->loaded()) {
            $nombre_oficina = $oficina->oficina;
            $options = array();
            $oficinas = ORM::factory('oficinas')->find_all();
            foreach ($oficinas as $e) {
                $options[$e->id] = $e->oficina;
            }   
            $entidad = ORM::factory('entidades',array('id'=>$oficina->id_entidad ));
            $users = $oficina->users->find_all();
            $this->template->content = View::factory('admin/lista_usuarios')
                    ->bind('users', $users)
                    ->bind('options', $options)
                    ->bind('id_oficina', $id)
                    ->bind('entidad', $entidad)
                    ->bind('oficina', $nombre_oficina);
        } else {
            $this->template->content = 'Error: No se encontro la oficina';
        }
    }

    //detalle del usuario
    public function action_detalle($id = '') {
        $user = ORM::factory('users', array('id' => $id));
        if ($user->loaded()) {
            //Modificado por freddy
            $pvcategoria = ORM::factory('pvcategorias')->find_all();
            $opt_categorias = array();
            foreach ($pvcategoria as $o) {
                $opt_categorias[$o->id] = $o->categoria;
            }


            $documentos = $user->tipo->find_all();
            $oficina = ORM::factory('oficinas', $user->id_oficina);
            $o_destinos = New Model_Destinatarios();
            $destinatarios = $o_destinos->destinos($user->id);
            $this->template->content = View::factory('admin/user_detalle')
                    ->bind('documentos', $documentos)
                    ->bind('destinatarios', $destinatarios)
                    ->bind('user', $user)
                    ->bind('pvcategoria', $opt_categorias)
                    ->bind('oficina', $oficina);
        } else {
            $this->template->content = 'Usuario inexistente';
        }
    }

    //eliminar un destinanario

//    public function action_x_des() {
//        $id_usuario = Arr::get($_GET, 'id_user', '');
//        $id_destino = Arr::get($_GET, 'id_des', '');
//        if (($id_destino != '') && ($id_usuario != '')) {
//            $destino = ORM::factory('vias')
//                    ->where('id_usuario', '=', $id_usuario)
//                    ->and_where('id_destinatario', '=', $id_destino)
//                    ->find();
//
//            $destino->delete();
//        }
//        $this->request->redirect('/admin/user/detalle/' . $id_usuario);
//    }
    // modificado por freddy
    public function action_x_des() {
        $id_usuario = Arr::get($_GET, 'id_user', '');
        $id_destino = Arr::get($_GET, 'id_des', '');
        if (($id_destino != '') && ($id_usuario != '')) {
            $o_destinos = New Model_Destinatarios();
            $o_destinos->delete_des($id_usuario,$id_destino);
        }
        $this->request->redirect('/admin/user/detalle/' . $id_usuario);
    }

    public function action_x_doc() {
        $id_usuario = Arr::get($_GET, 'id_user', '');
        $id_tipo = Arr::get($_GET, 'id_tipo', '');
        if (($id_tipo != '') && ($id_usuario != '')) {
            $user = ORM::factory('users', array('id' => $id_usuario));
            if ($user->has('tipo', $id_tipo))
                $user->remove('tipo', $id_tipo);
        }
        $this->request->redirect('/admin/user/detalle/' . $id_usuario);
    }

    //actualizar datos del usuario
    public function action_update() {
        if ($_POST) {
            $usuario = ORM::factory('users', array('id' => $_POST['user_id']));
            if ($usuario->loaded()) {
                $usuario->nombre = html::chars($_POST['nombre']);
                $usuario->cargo = html::chars($_POST['cargo']);
                $usuario->email = html::chars($_POST['email']);
                $usuario->dependencia = html::chars($_POST['dependencia']);
                $usuario->mosca = html::chars($_POST['mosca']);
                $usuario->id_categoria = html::chars($_POST['id_categoria']);
                $usuario->save();
                $this->request->redirect('/admin/user/detalle/' . $usuario->id);
            }
        }
    }

    public function action_list() {
        $usuarios = array();
        $oficinas = ORM::factory('oficinas')->find_all();
        foreach ($oficinas as $o) {
            $users = $o->users->find_all();
            foreach ($users as $u) {
                $usuarios[$u->id] = array(
                    'id_user' => $u->id,
                    'nombre' => $u->nombre,
                    'cargo' => $u->cargo,
                    'oficina' => $o->oficina,
                    'username' => $u->username,
                );
            }
        }
        //$users=ORM::factory('users')->where('id','<>',$this->user->id)->find_all();
        $this->template->content = View::factory('admin/users')
                ->bind('users', $usuarios);
    }

    public function action_login() {
        $this->template->content = View::factory('user/login')
                ->bind('errors', $errors)
                ->bind('message', $message);

        if ($_POST) {
            // Attempt to login user
            $remember = array_key_exists('remember', $_POST);
            $user = Auth::instance()->login($_POST['username'], $_POST['password'], $remember);

            // If successful, redirect user
            if ($user) {
                Request::current()->redirect('user/index');
            } else {
                $message = 'Error de acceso';
            }
        }
    }

    public function action_logout() {
        // Log user out
        Auth::instance()->logout();
        //header('Location: ../');
        // Redirect to login page
        Request::current()->redirect('');
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
            if ($user->nivel == 3) {
                $oficina = ORM::factory('oficinas', 27);
                $usuarios = ORM::factory('users')->where('id_oficina', '=', 27)->find_all();
                $this->template->menu = View::factory('admin/menu');
                $this->template->content = View::factory('user/list')->bind('usuarios', $usuarios)
                        ->bind('oficina', $oficina);
            } else {
                $this->template->content = View::factory('errors/user');
            }
        }
    }

}

?>
