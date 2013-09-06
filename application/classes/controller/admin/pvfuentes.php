<?php

/**
 * Description of pvfuentes
 *
 * @author freddy velasco
 */
class Controller_Admin_Pvfuentes extends Controller_AdminTemplate {

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

    // lista de pvfuentes
    public function action_index() {
        $oPvfuentes = New Model_Pvfuentes();
        $pvfuentes = $oPvfuentes->lista();
        $this->template->title .=' | Fuentes';
        $this->template->content = View::factory('admin/lista_pvfuentes')
                ->bind('pvfuentes', $pvfuentes);
    }

    public function action_form($id = '') {
        
        $valor = ORM::factory('pvfuentes', $id);
        $this->template->title.=' | Crear Fuente';
        $this->template->styles=array('media/css/jquery-ui-1.8.16.custom.css'=>'screen');
        $this->template->scripts=array('media/js/jquery-ui-1.8.16.custom.min.js');
        $this->template->content = View::factory('admin/add_pvfuente')
                ->bind('pvfuente', $valor)
                ->bind('error', $error)
                ->bind('info', $info);
        
    }
    
    public function action_save(){
        $info = array();
        if (isset($_POST['create'])) {
            $pvfuente = ORM::factory('pvfuentes',$_POST['id']);
            unset($_POST['id']);
            $pvfuente->codigo = $_POST['codigo'];
            $pvfuente->denominacion = $_POST['denominacion'];
            $pvfuente->sigla = $_POST['sigla'];
            $pvfuente->tipo = $_POST['tipo'];
            $pvfuente->estado = 1;
            $pvfuente->save();
            if ($pvfuente->id) {
                $info['Exito!'] = 'Se creo correctamente la fuente <b>' . $pvfuente->codigo . '</b>';
            }
        }
        
        $this->request->redirect('admin/pvfuentes');
    }
    
    public function action_delete($id = ''){
        if($id){
        $pvfuente = ORM::Factory('pvfuentes', $id);
        $pvfuente->estado = 0;
        $pvfuente->save();    
        }
        
        $this->request->redirect('admin/pvfuentes');
    }

}

?>
