<?php

/**
 * Description of pvorganismos
 *
 * @author freddy velasco
 */
class Controller_Admin_Pvorganismos extends Controller_AdminTemplate {

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

    // lista de pvorganismos
    public function action_index() {
        $oPvorganismos = New Model_Pvorganismos();
        $pvorganismos = $oPvorganismos->lista();
        $this->template->title .=' | Fuentes';
        $this->template->content = View::factory('admin/lista_pvorganismos')
                ->bind('pvorganismos', $pvorganismos);
    }

    public function action_form($id = '') {
        
        $valor = ORM::factory('pvorganismos', $id);
        $this->template->title.=' | Crear Fuente';
        $this->template->styles=array('media/css/jquery-ui-1.8.16.custom.css'=>'screen');
        $this->template->scripts=array('media/js/jquery-ui-1.8.16.custom.min.js');
        $this->template->content = View::factory('admin/add_pvorganismo')
                ->bind('pvorganismo', $valor)
                ->bind('error', $error)
                ->bind('info', $info);
        
    }
    
    public function action_save(){
        $info = array();
        if (isset($_POST['create'])) {
            $pvorganismo = ORM::factory('pvorganismos',$_POST['id']);
            unset($_POST['id']);
            $pvorganismo->codigo = $_POST['codigo'];
            $pvorganismo->denominacion = $_POST['denominacion'];
            $pvorganismo->sigla = $_POST['sigla'];
            $pvorganismo->tipo = $_POST['tipo'];
            $pvorganismo->estado = 1;
            $pvorganismo->save();
            if ($pvorganismo->id) {
                $info['Exito!'] = 'Se creo correctamente la fuente <b>' . $pvorganismo->codigo . '</b>';
            }
        }
        
        $this->request->redirect('admin/pvorganismos');
    }
    
    public function action_delete($id = ''){
        if($id){
        $pvorganismo = ORM::Factory('pvorganismos', $id);
        $pvorganismo->estado = 0;
        $pvorganismo->save();    
        }
        
        $this->request->redirect('admin/pvorganismos');
    }

}

?>
