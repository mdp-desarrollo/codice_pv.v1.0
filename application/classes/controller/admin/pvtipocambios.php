<?php

/**
 * Description of pvtipocambios
 *
 * @author freddy velasco
 */
class Controller_Admin_Pvtipocambios extends Controller_AdminTemplate {

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

    // lista de pvtipocambios
    public function action_index() {
        $oPvtipocambios = New Model_Pvtipocambios();
        $pvtipocambios = $oPvtipocambios->lista();
        $this->template->title .=' | Tipo de Cambio';
        $this->template->content = View::factory('admin/lista_pvtipocambios')
                ->bind('pvtipocambios', $pvtipocambios);
    }
    
    public function action_form($id = '') {
        
        $valor = ORM::factory('pvtipocambios', $id);
        $this->template->title.=' | Crear Tipo Cambio';
        $this->template->styles=array('media/css/jquery-ui-1.8.16.custom.css'=>'screen');
        $this->template->scripts=array('media/js/jquery-ui-1.8.16.custom.min.js');
        $this->template->content = View::factory('admin/add_pvtipocambio')
                ->bind('pvtipocambio', $valor)
                ->bind('error', $error)
                ->bind('info', $info);
        
    }
    
    public function action_save(){
        $info = array();
        if (isset($_POST['create'])) {
            $pvtipocambio = ORM::factory('pvtipocambios',$_POST['id']);
            unset($_POST['id']);
            $pvtipocambio->fecha = $_POST['fecha'];
            $pvtipocambio->cambio_venta = $_POST['cambio_venta'];
            $pvtipocambio->cambio_compra = $_POST['cambio_compra'];
            $pvtipocambio->fecha_creacion = date("Y-m-d H:i:s");
            $pvtipocambio->fecha_modificacion = date("Y-m-d H:i:s");
            $pvtipocambio->save();
            if ($pvtipocambio->id) {
                $info['Exito!'] = 'Se creo correctamente el tipo cambio <b>' . $pvtipocambio->cambio_venta . '</b>';
            }
        }
        
        $this->request->redirect('admin/pvtipocambios');
    }
    
    public function action_delete($id = ''){
        if($id){
        ORM::Factory('pvtipocambios', $id)->delete();    
        }
        
        $this->request->redirect('admin/pvtipocambios');
    }

}

?>
