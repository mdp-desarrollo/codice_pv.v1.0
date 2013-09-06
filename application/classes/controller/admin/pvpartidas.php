<?php

/**
 * Description of pvpartidas
 *
 * @author freddy velasco
 */
class Controller_Admin_Pvpartidas extends Controller_AdminTemplate {

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

    // lista de pvpartidas
    public function action_index() {
        $oPvpartidas = New Model_Pvpartidas();
        $pvpartidas = $oPvpartidas->lista();
        $this->template->title .=' | Partida';
        $this->template->content = View::factory('admin/lista_pvpartidas')
                ->bind('pvpartidas', $pvpartidas);
    }

    public function action_form($id = '') {
        
        $valor = ORM::factory('pvpartidas', $id);
        $this->template->title.=' | Crear Partida';
        $this->template->styles=array('media/css/jquery-ui-1.8.16.custom.css'=>'screen');
        $this->template->scripts=array('media/js/jquery-ui-1.8.16.custom.min.js');
        $this->template->content = View::factory('admin/add_pvpartida')
                ->bind('pvpartida', $valor)
                ->bind('error', $error)
                ->bind('info', $info);
        
    }
    
    public function action_save(){
        $info = array();
        if (isset($_POST['create'])) {
            $pvpartida = ORM::factory('pvpartidas',$_POST['id']);
            unset($_POST['id']);
            $pvpartida->codigo = $_POST['codigo'];
            $pvpartida->partida = $_POST['partida'];
            $pvpartida->descripcion = $_POST['descripcion'];
            $pvpartida->estado = 1;
            $pvpartida->save();
            if ($pvpartida->id) {
                $info['Exito!'] = 'Se creo correctamente el tipo cambio <b>' . $pvpartida->partida . '</b>';
            }
        }
        
        $this->request->redirect('admin/pvpartidas');
    }
    
    public function action_delete($id = ''){
        if($id){
        $pvpartida = ORM::Factory('pvpartidas', $id);
        $pvpartida->estado = 0;
        $pvpartida->save();    
        }
        
        $this->request->redirect('admin/pvpartidas');
    }

}

?>
