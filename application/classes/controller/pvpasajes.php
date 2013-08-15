<?php

defined('SYSPATH') or die('Acceso denegado');

class Controller_Pvpasajes extends Controller_DefaultTemplate {

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
            $this->template->title = 'Pasajes';
        } else {
            $url = substr($_SERVER['REQUEST_URI'], 1);
            $this->request->redirect('/login?url=' . $url);
        }
    }

    public function after() {
        $this->template->menutop = View::factory('templates/menutop')->bind('menus', $this->menus)->set('controller', 'pvpasajes');
        $oSM = New Model_menus();
        $submenus = $oSM->submenus('pvpasajes');
        $docs = FALSE;
        if ($this->user->nivel == 4) {
            $docs = TRUE;
        }
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus', $submenus)->bind('doc', $docs)->set('titulo', 'PASAJES');
        parent::after();
    }

    public function action_index($id = '') {
        $oAut = new Model_Pvpasajes();
        $autorizados = $oAut->pasajesautorizados();//lista de solicitudes autorizadas
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvpasajes/index')
                                        ->bind('autorizados', $autorizados)
                                        ;    
    }
    
public function action_autorizados(){
    
}

public function action_detalleautorizados($id){
    //id = id_memo
    $memo = ORM::factory('documentos')->where('id', '=', $id)->find();
        if ($memo->loaded()) {
        $fucov = ORM::factory('pyvfucov')->where('id_memo', '=', $id)->find();
        $documento = ORM::factory('documentos')->where('id','=', $fucov->id_documento)->find();
            if($fucov->loaded()){
            //$pasaje = ORM::factory('pyvpasajes')->where('id_fucov','=',$fucov->id);
            $oPsj = new Model_Pyvpasajes();
            $pas = $oPsj->pasaje_asignado($fucov->id);
            foreach ($pas as $p) $pasaje = $p; 
    //$this->template->scripts = array('media/js/jquery-ui-1.8.16.custom.min.js','media/js/jquery.timeentry.js');            
                        $this->template->content = View::factory('pyv/pasajes/detalleautorizados')
                                ->bind('memo', $memo)
                                ->bind('d', $documento)
                                //->bind('tipo', $tipo)
                                //->bind('archivo', $archivo)
                                //->bind('errors', $errors)
                                //->bind('mensajes', $mensajes)
                                ->bind('f',$fucov)
                                ->bind('pasaje',$pasaje)
                                //->bind('estado_seguimiento',$estado)
                                //->bind('nivel',$nivel)
                                //->bind('user',$this->user)
                                ;
            }
            else
                $this->template->content = 'No hay FUCOV asignado';
        }
        else
        {
            $this->template->content = 'El Memor&aacute;ndum no existe';
        }
}

/*    
public function action_autorizappt($id = '') {
        $fucov = ORM::factory('pyvfucov')->where('id','=',$id)->find();
        $liquidacion = ORM::factory('pyvliquidacion')->where('id_fucov','=',$id)->find();        
        if ($liquidacion->loaded() && $fucov->loaded()) {
            if( ($fucov->etapa_proceso == 2  || $fucov->etapa_proceso == 3 ) ){
            $liquidacion->etapa_proceso = 1;
            $liquidacion->fecha_liquidacion = date('Y-m-d H:i:s');
            //$liquidacion->cod_cat_programatica = $_POST['fuente'];
            //ides: unidad_funcional,  direccion_administrativa, unidad_ejecutora, id_organismo, id_fuente, id_categoria_programatica            
            $fuente = $_POST['fuente'];
            $ides = explode("-", $fuente);
                $id_unidad_funcional = $ides[0];
                $id_dir_admin = $ides[1];
                $id_unidad_ejec = $ides[2];
                $id_organismo = $ides[3];
                $id_fuente = $ides[4];
                $id_cat_programatica = $ides[5];
            $liquidacion->id_unidad_funcional = $id_unidad_funcional;
            $liquidacion->id_da = $id_dir_admin;
            $liquidacion->id_ue = $id_unidad_ejec;
            $liquidacion->id_organismo = $id_organismo;
            $liquidacion->id_fuente = $id_fuente;
            $liquidacion->id_cat_prog = $id_cat_programatica;
            
            $liquidacion->save();
            
            $fucov->etapa_proceso = 3;
            $fucov->save();
            $this->request->redirect('pyv/detalle/'.$_POST['idMemo']);
            
        }
        else
            $this->template->content = 'El documento no se puede modificar';    
    }
    else
        $this->template->content = 'El documento no existe';
}
*/
}

?>
