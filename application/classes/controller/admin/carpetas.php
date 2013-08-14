<?php

/**
 * Description of carpetas
 *
 * @author freddy velasco
 */
class Controller_Admin_Carpetas extends Controller_AdminTemplate {

    protected $oficina;

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

    // lista de carpetas
    public function action_index() {
        $oCarpetas = New Model_Carpetas();
        $carpetas = $oCarpetas->lista_carpetas();
        $this->template->title.=' | Carpetas';
        $this->template->content = View::factory('admin/lista_carpetas')
                ->bind('carpetas', $carpetas);
    }
    
    public function action_form($id = '') {
        $options = array();
        $oficinas = ORM::factory('oficinas')->find_all();
        foreach ($oficinas as $o) {
            $options[$o->id] = $o->oficina . ' | ' . $o->sigla;
        }
        $valor = ORM::factory('carpetas', $id);
        $this->template->title.=' | Crear Carpeta';
        $this->template->content = View::factory('admin/add_carpeta')
                ->bind('options', $options)
                ->bind('carpeta', $valor)
                ->bind('error', $error)
                ->bind('info', $info);
        
    }
    
    public function action_save(){
        //echo "todo esta bien";
        //$error = array();
        $info = array();
        if (isset($_POST['create'])) {
            $carpeta = ORM::factory('carpetas',$_POST['id']);
            unset($_POST['id']);
            $carpeta->id_oficina = $_POST['id_oficina'];
            $carpeta->carpeta = $_POST['carpeta'];
            $carpeta->fecha_creacion = date("Y-m-d H:i:s");
            $carpeta->nivel = $_POST['nivel'];
            $carpeta->save();
            if ($carpeta->id) {
                //ahora guardamos por defecto el cite para los tipos de documentos
                $info['Exito!'] = 'Se creo correctamente la carpeta <b>' . $carpeta->carpeta . '</b>';
                //$_POST = array();
            }
        }
        
        $this->request->redirect('admin/carpetas');
    }
    
    public function action_delete($id = ''){
        if($id){
        ORM::Factory('carpetas', $id)->delete();    
        }
        
        $this->request->redirect('admin/carpetas');
    }

//    public function action_create() {
//        $error = array();
//        $info = array();
//        if (isset($_POST['create'])) {
//            $carpeta = ORM::factory('carpetas');
//            $carpeta->id_oficina = $_POST['id_oficina'];
//            $carpeta->carpeta = $_POST['carpeta'];
//            $carpeta->fecha_creacion = date("Y-m-d H:i:s");
//            $carpeta->nivel = $_POST['nivel'];
//            $carpeta->save();
//            if ($carpeta->id) {
//                //ahora guardamos por defecto el cite para los tipos de documentos
//                $info['Exito!'] = 'Se creo correctamente la carpeta <b>' . $carpeta->carpeta . '</b>';
//                $_POST = array();
//            }
//        }
//        $options = array();
//        $oficinas = ORM::factory('oficinas')->find_all();
//        foreach ($oficinas as $o) {
//            $options[$o->id] = $o->oficina . ' | ' . $o->sigla;
//        }
//        $this->template->title.=' | Crear Carpeta';
//        $this->template->content = View::factory('admin/add_carpeta')
//                ->bind('options', $options)
//                ->bind('error', $error)
//                ->bind('info', $info);
//    }
//
//    public function action_edit($id) {
//        $error = array();
//        $info = array();
//        $carpeta = ORM::factory('carpetas', array('id' => $id));
//        if ($carpeta->loaded()) {
//            $options = array();
//            $oficinas = ORM::factory('oficinas')->find_all();
//            foreach ($oficinas as $o) {
//                $options[$o->id] = $o->oficina . ' | ' . $o->sigla;
//            }
//            $this->template->title.=' | Editar Carpeta';
//            $this->template->content = View::factory('admin/add_carpeta')
//                    ->bind('options', $options)
//                    ->bind('carpeta', $carpeta)
//                    ->bind('error', $error)
//                    ->bind('info', $info);
//        } else {
//            $this->template->content = 'registro no existe';
//        }
//    }

}

?>
