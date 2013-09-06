<?php

/**
 * Description of pvproyectos
 *
 * @author freddy velasco
 */
class Controller_Admin_Pvproyectos extends Controller_AdminTemplate {

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

    // lista de pvproyectos
    public function action_index() {
        $oPvproyectos = New Model_Pvproyectos();
        $pvproyectos = $oPvproyectos->lista();
        $this->template->title .=' | Fuentes';
        $this->template->content = View::factory('admin/lista_pvproyectos')
                ->bind('pvproyectos', $pvproyectos);
    }

    public function action_form($id = '') {
        
        $valor = ORM::factory('pvproyectos', $id);
        $this->template->title.=' | Crear Proyecto';
        $this->template->styles=array('media/css/jquery-ui-1.8.16.custom.css'=>'screen');
        $this->template->scripts=array('media/js/jquery-ui-1.8.16.custom.min.js');
        $this->template->content = View::factory('admin/add_pvproyecto')
                ->bind('pvproyecto', $valor)
                ->bind('error', $error)
                ->bind('info', $info);
        
    }
    
    public function action_save(){
        $info = array();
        if (isset($_POST['create'])) {
            $pvproyecto = ORM::factory('pvproyectos',$_POST['id']);
            unset($_POST['id']);
            $pvproyecto->codigo = $_POST['codigo'];
            $pvproyecto->proyecto = $_POST['proyecto'];
            $pvproyecto->estado = 1;
            $pvproyecto->save();
            if ($pvproyecto->id) {
                $info['Exito!'] = 'Se creo correctamente el proyecto <b>' . $pvproyecto->codigo . '</b>';
            }
        }
        
        $this->request->redirect('admin/pvproyectos');
    }
    
    public function action_delete($id = ''){
        if($id){
        $pvproyecto = ORM::Factory('pvproyectos', $id);
        $pvproyecto->estado = 0;
        $pvproyecto->save();    
        }
        
        $this->request->redirect('admin/pvproyectos');
    }

}

?>
