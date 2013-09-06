<?php

/**
 * Description of pvpptactividades
 *
 * @author freddy velasco
 */
class Controller_Admin_Pvpptactividades extends Controller_AdminTemplate {

    // protected $oficina;

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

    // lista de pvpptactividades
    public function action_index() {
        $oPvpptactividades = New Model_Pvpptactividades();
        $pvpptactividads = $oPvpptactividades->lista();
        $this->template->title .=' | Fuentes';
        $this->template->content = View::factory('admin/lista_pvpptactividades')
                ->bind('pvpptactividades', $pvpptactividads);
    }

    public function action_form($id = '') {
        
        $valor = ORM::factory('pvpptactividades', $id);
        $this->template->title.=' | Crear Presupuesto Actividad';
        $this->template->styles=array('media/css/jquery-ui-1.8.16.custom.css'=>'screen');
        $this->template->scripts=array('media/js/jquery-ui-1.8.16.custom.min.js');
        $this->template->content = View::factory('admin/add_pvpptactividad')
                ->bind('pvpptactividad', $valor)
                ->bind('error', $error)
                ->bind('info', $info);
        
    }
    
    public function action_save(){
        $info = array();
        if (isset($_POST['create'])) {
            $pvpptactividad = ORM::factory('pvpptactividades',$_POST['id']);
            unset($_POST['id']);
            $pvpptactividad->codigo = $_POST['codigo'];
            $pvpptactividad->actividad = $_POST['actividad'];
            $pvpptactividad->estado = 1;
            $pvpptactividad->save();
            if ($pvpptactividad->id) {
                $info['Exito!'] = 'Se creo correctamente la actividad <b>' . $pvpptactividad->codigo . '</b>';
            }
        }
        
        $this->request->redirect('admin/pvpptactividades');
    }
    
    public function action_delete($id = ''){
        if($id){
        $pvpptactividad = ORM::Factory('pvpptactividades', $id);
        $pvpptactividad->estado = 0;
        $pvpptactividad->save();    
        }
        
        $this->request->redirect('admin/pvpptactividades');
    }

}

?>
