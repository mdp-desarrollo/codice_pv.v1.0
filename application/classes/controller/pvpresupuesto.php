<?php

defined('SYSPATH') or die('Acceso denegado');

class Controller_Pvpresupuesto extends Controller_DefaultTemplate {

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
            $this->template->title = 'Presupuesto';
        } else {
            $url = substr($_SERVER['REQUEST_URI'], 1);
            $this->request->redirect('/login?url=' . $url);
        }
    }

    public function after() {
        $this->template->menutop = View::factory('templates/menutop')->bind('menus', $this->menus)->set('controller', 'pvpresupuesto');
        $oSM = New Model_menus();
        $submenus = $oSM->submenus('pvpresupuesto');
        $docs = FALSE;
        if ($this->user->nivel == 4) {
            $docs = TRUE;
        }
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus', $submenus)->bind('doc', $docs)->set('titulo', 'PRESUPUESTO');
        parent::after();
    }

    public function action_index($id = '') {
        $oAut = new Model_Pvliquidaciones();
        $aut = $oAut->pptautorizados();
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvpresupuesto/index')
                                        ->bind('autorizados', $aut)
                                        ;
        
    }
    
public function action_ejecucion($id = ''){
    $oPpt = new Model_Pvprogramaticas();
    $ppt = $oPpt->ejecucion();
    $this->template->styles = array('media/css/tablas.css' => 'all');
    $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
    $this->template->content = View::factory('pvpresupuesto/ejecucion')
                                    ->bind('presupuesto', $ppt)
                                    ;
}

public function action_saldopresupuesto($id = ''){
    $oPpt = new Model_Pyvprogramatica();
    $ppt = $oPpt->saldopresupuesto($id);
    $det = $oPpt->detallesaldopresupuesto($id);
    foreach ($det as $d)
        $detalle = $d;
    $pyvmenu = View::factory('pyv/templates/menus')->bind('menu', $this->pmenu)->set('titulo', 'PRESUPUESTO');
    $this->template->styles = array('media/css/tablas.css' => 'all');
    $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
    //$this->template->styles = array('media/css/tablas.css' => 'all','media/css/pyv/jquery-ui.css' => 'all');
    //$this->template->scripts = array('media/js/jquery.tablesorter.min.js','media/js/pyv/jquery-ui.js','media/js/pyv/jquery-1.9.1.js');
    $this->template->content = View::factory('pyv/presupuesto/saldopresupuesto')
                                    ->bind('presupuesto', $ppt)
                                    ->bind('detalle', $detalle)
                                    ->bind('menu', $pyvmenu)
                                    ->bind('id_programatica', $id)
                                    ;
}

public function action_certificados(){

}

public function action_detallecertificado($id){
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
            $liq = ORM::factory('pyvliquidacion')->where('id_fucov','=',$fucov->id)->find();
            $oFte = New Model_pyvprogramatica();
            $fte = $oFte->listadetallefuentes($liq->id_programatica);
            foreach ($fte as $ft) $fuente = $ft;
    //$this->template->scripts = array('media/js/jquery-ui-1.8.16.custom.min.js','media/js/jquery.timeentry.js');
            $pyvmenu = View::factory('pyv/templates/menus')->bind('menu', $this->pmenu)->set('titulo', 'PRESUPUESTO');
                        $this->template->content = View::factory('pyv/presupuesto/detallecertificado')
                                ->bind('memo', $memo)
                                ->bind('d', $documento)
                                //->bind('tipo', $tipo)
                                //->bind('archivo', $archivo)
                                //->bind('errors', $errors)
                                //->bind('mensajes', $mensajes)
                                ->bind('f',$fucov)
                                ->bind('pasaje',$pasaje)
                                ->bind('fuente',$fuente)                                
                                ->bind('liq',$liq)
                                ->bind('menu',$menu)
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

public function action_addsaldoppt($id = ''){
    $mensajes = array();
    $programatica = ORM::factory('pyvprogramatica')->where('id', '=', $id)->and_where('estado', '=', 1)->find();
    if ($programatica->loaded()) {
        if (isset($_POST['submit'])) {
            $ejecucion = ORM::factory('pyvejecucion');
            $ejecucion->inicial = $_POST['inicial'];
            $ejecucion->vigente = $_POST['vigente'];
            $ejecucion->preventivo = $_POST['preventivo'];
            $ejecucion->comprometido = $_POST['comprometido'];
            $ejecucion->devengado = $_POST['devengado'];
            $ejecucion->saldo_devengado = $_POST['saldoDevengado'];
            $ejecucion->pagado = $_POST['pagado'];
            $ejecucion->saldo_pagar = $_POST['saldoPagar'];
            $ejecucion->estado = 1;
            $ejecucion->gestion = $_POST['gestion'];
            $ejecucion->id_programatica = $id;
            $ejecucion->id_partida = $_POST['partidas'];
            $ejecucion->save();
            $this->request->redirect('pyvpresupuesto/saldopresupuesto/'.$id);
        }
        //$partida = ORM::factory('pyvpartidas')->where('estado','=',1)->find_all();
        //$partidas = array();
        $oPart = new Model_Pyvpartidas();
        $partida = $oPart->partidas_no_asignadas($id);
        foreach($partida as $p)
            $partidas[$p['id']] = $p['codigo'].' &nbsp;&nbsp;-&nbsp;&nbsp; '.$p['partida'];
        $oPpt = new Model_Pyvprogramatica();
        $ppt = $oPpt->saldopresupuesto($id);
        $det = $oPpt->detallesaldopresupuesto($id);
        foreach ($det as $d)
            $detalle = $d;
        $pyvmenu = View::factory('pyv/templates/menus')->bind('menu', $this->pmenu)->set('titulo', 'PRESUPUESTO');
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pyv/presupuesto/addsaldoppt')
                                        ->bind('presupuesto', $ppt)
                                        ->bind('detalle', $detalle)
                                        ->bind('menu', $pyvmenu)
                                        ->bind('id_programatica', $id)
                                        ->bind('partidas', $partidas);
                                        ;
    }
    else {
            $this->template->content = 'La categoria programatica no fue encontrada.';
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
