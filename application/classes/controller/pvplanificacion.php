<?php

defined('SYSPATH') or die('Acceso denegado');

class Controller_Pvplanificacion extends Controller_DefaultTemplate {

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
        $this->template->menutop = View::factory('templates/menutop')->bind('menus', $this->menus)->set('controller', 'pvplanificacion');
        $oSM = New Model_menus();
        $submenus = $oSM->submenus('pvplanificacion');
        $docs = FALSE;
        if ($this->user->nivel == 4) {
            $docs = TRUE;
        }
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus', $submenus)->bind('doc', $docs)->set('titulo', 'PLANIFICACION');
        parent::after();
    }

    public function action_index() {
        $this->request->redirect('pvplanificacion/lista');
        /*$oAut = new Model_Pvpoas();
        $autorizados = $oAut->listaautorizados($this->user->id, $this->user->id_entidad);//lista de solicitudes autorizadas
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvplanificacion/index')
                                        ->bind('autorizados', $autorizados)
                                        ;  */  
    }
    
    public  function action_lista(){
        $mensajes=array();
        $ofi = ORM::factory('oficinas')->where('id_entidad','=',$this->user->id_entidad)->find_all();
        $oficinas[''] = 'TODAS LAS OFICINAS';
        foreach($ofi as $o)
            $oficinas [$o->id] = $o->oficina;
        if(isset($_POST['submit']))
        {
            $fecha1=$_POST['fecha1'].' 00:00:00';
            $fecha2=$_POST['fecha2'].' 23:59:00';
            if(strtotime($fecha1)>strtotime($fecha2))
            {
                $fecha1=$_POST['fecha2'].' 23:59:00';
                $fecha2=$_POST['fecha1'].' 00:00:00';
            }
            $o_poas=New Model_Pvpoas();
            $results=$o_poas->avanzada($this->user->id, $this->user->id_entidad, $_POST['funcionario'],$_POST['oficina'],$fecha1,$fecha2);
            if(!sizeof($results)>0)
                $mensajes['No Encontrado!'] = 'La búsqueda no produjo resultados.';
            $this->template->styles = array('media/css/jquery-ui-1.8.16.custom.css' => 'screen', 'media/css/tablas.css' => 'screen');
            $this->template->scripts = array('tinymce/tinymce.min.js', 'media/js/jquery-ui-1.8.16.custom.min.js', 'media/js/jquery.timeentry.js','media/js/jquery.tablesorter.min.js'); ///
            $this->template->content=View::factory('pvplanificacion/lista')
                                        ->bind('autorizados',$results)
                                        ->bind('oficinas', $oficinas)
                    ->bind('mensajes', $mensajes)
                     ;
        }
        else{
            $oAut = new Model_Pvpoas();
            $autorizados = $oAut->listaautorizados($this->user->id, $this->user->id_entidad);//lista de solicitudes autorizadas
            $this->template->styles = array('media/css/jquery-ui-1.8.16.custom.css' => 'screen', 'media/css/tablas.css' => 'screen');
            $this->template->scripts = array('tinymce/tinymce.min.js', 'media/js/jquery-ui-1.8.16.custom.min.js', 'media/js/jquery.timeentry.js','media/js/jquery.tablesorter.min.js'); ///
            $this->template->content = View::factory('pvplanificacion/lista')
                ->bind('autorizados', $autorizados)
                ->bind('oficinas', $oficinas)
                    ->bind('mensajes', $mensajes)
                ;
        }
    }
    
    public function action_detalleautorizados($id = ''){
        $memo = ORM::factory('documentos',$id);
        $pvfucov = ORM::factory('pvfucovs')->where('id_memo','=',$id)->find();
        $pvpoas = ORM::factory('pvpoas')->where('id_fucov','=',$pvfucov->id)->find();
        $pvgestion = ORM::factory('pvogestiones',$pvpoas->id_obj_gestion);
        $pvespecifico = ORM::factory('pvoespecificos',$pvpoas->id_obj_esp);
        $pvactividad = ORM::factory('pvactividades',$pvpoas->id_actividad);
        $this->template->styles = array('media/css/jquery-ui-1.8.16.custom.css' => 'screen', 'media/css/tablas.css' => 'screen');
        $this->template->scripts = array('tinymce/tinymce.min.js', 'media/js/jquery-ui-1.8.16.custom.min.js', 'media/js/jquery.timeentry.js','media/js/jquery.tablesorter.min.js'); ///
        $this->template->content = View::factory('pvplanificacion/detalleautorizados')
                ->bind('memo',$memo)
                ->bind('pvfucov', $pvfucov)
                ->bind('pvpoas', $pvpoas)
                ->bind('pvgestion',$pvgestion)
                ->bind('pvespecifico',$pvespecifico)
                ->bind('pvactividad',$pvactividad)
                ;
    }
    
    public function action_unidades(){
        $oUnid = new Model_oficinas();
        $unidades = $oUnid->listaunidades($this->user->id_entidad);
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvplanificacion/listaunidades')
                                        ->bind('unidades', $unidades)
                                        ;
    }
    
    public function action_editarpoa($id = '') {
        $pvfucov = ORM::factory('pvfucovs')->where('id','=',$id)->find();
        if ($pvfucov->loaded()) {
            if($pvfucov->etapa_proceso <= 2){
                $pvpoas = ORM::factory('pvpoas')->where('id_fucov','=',$id)->find();
                $pvpoas->id_obj_gestion = $_POST['obj_gestion'];
                $pvpoas->id_obj_esp = $_POST['obj_esp'];
                $pvpoas->id_actividad = $_POST['actividad'];
                $pvpoas->fecha_modificacion = date('Y-m-d H:i:s');
                $pvpoas->save();
                $this->request->redirect('documento/detalle/'.$pvfucov->id_memo);
                }
            else
                $this->template->content = '<b>EL DOCUMENTO YA FUE AUTORIZADO Y NO SE PUEDE MODIFICAR.</b><div class="info" style="text-align:center;margin-top: 50px; width:800px">
                                        <p><span style="float: left; margin-right: .3em;" class=""></span>    
                                        &larr;<a onclick="javascript:history.back(); return false;" href="#" style="font-weight: bold; text-decoration: underline;  " > Regresar<a/></p></div>';
        }
        else
                $this->template->content = 'El FUCOV no existe';
    }
    
    public function action_autorizarfucov($id = '') {
        $pvfucov = ORM::factory('pvfucovs')->where('id','=',$id)->find();
        if ($pvfucov->loaded()) {
            $pvfucov->etapa_proceso = 3;
            $pvfucov->save();
            $pvpoas = ORM::factory('pvpoas')->where('id_fucov','=',$id)->find();
            if($pvpoas->loaded()){
                $pvpoas->auto_poa = 1;
                $pvpoas->fecha_certificacion = date('Y-m-d H:i:s');
                $pvpoas->id_user_auto = $this->user->id;
                $pvpoas->save();
                $this->request->redirect('documento/detalle/'.$pvfucov->id_memo);
            }
            else
                $this->template->content = 'No hay POA Asignado';
        }
    }
    
    public function action_objetivogestion($id = ''){
        $oficina = ORM::factory('oficinas')->where('id','=',$id)->find();
        $objetivos = ORM::factory('pvogestiones')->where('id_oficina','=',$id)->and_where('estado','=',1)->order_by('id','asc')->find_all();
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvplanificacion/listaogestion')
                                        ->bind('objetivos', $objetivos)
                                        ->bind('oficina', $oficina)
                                        ;
    }
    
    public function action_addobjgestion($id = ''){
        $mensajes=array();
        $oficina = ORM::factory('oficinas')->where('id','=',$id)->find();
        $entidad = ORM::factory('entidades')->where('id','=',$oficina->id_entidad)->find();
        if (isset($_POST['submit'])) {
            $objetivo = ORM::factory('pvogestiones');
            $objetivo->codigo = trim($_POST['codigo']);
            $objetivo->objetivo = trim($_POST['objetivo']);
            $objetivo->id_oficina = $id;
            $objetivo->estado = 1;
            $objetivo->save();
            //$this->request->redirect('pvplanificacion/objetivogestion/'.$id);
            $mensajes['Modificado!'] = 'El Objetivo se adiciono correctamente.';
        }
        //$objetivos = ORM::factory('pvogestiones')->where('id_oficina','=',$id)->find_all();
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvplanificacion/addobjgestion')
                                        //->bind('objetivos', $objetivos)
                                        ->bind('oficina', $oficina)
                                        ->bind('entidad', $entidad)
                                        ->bind('mensajes', $mensajes)
                                        ;
    }
    
    public function action_editobjgestion($id = ''){
        $objetivo = ORM::factory('pvogestiones')->where('id','=',$id)->find();
        if (isset($_POST['submit'])) {
            $objetivo->codigo = trim($_POST['codigo']);
            $objetivo->objetivo = trim($_POST['objetivo']);
            //$objetivo->id_oficina = $_POST['id_oficina'];
            $objetivo->save();
            $this->request->redirect('pvplanificacion/objetivogestion/'.$_POST['id_oficina']);
        }
        $oficina = ORM::factory('oficinas')->where('id','=',$objetivo->id_oficina)->find();
        $entidad = ORM::factory('entidades')->where('id','=',$oficina->id_entidad)->find();
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvplanificacion/editobjgestion')
                                        ->bind('objetivo', $objetivo)
                                        ->bind('oficina', $oficina)
                                        ->bind('entidad', $entidad)
                                        ;
    }
    
    public function action_eliminarobjgestion($id = ''){
        $objetivo = ORM::factory('pvogestiones')->where('id','=',$id)->find();
        if ($objetivo->loaded()) {
            $objetivo->estado = 0;
            $objetivo->save();
            $this->request->redirect('pvplanificacion/objetivogestion/'.$objetivo->id_oficina);
        }
        else{
            $this->template->content = 'El Objetivo No Existe.';
        }
    }
    
    public function action_objetivoespecifico($id = ''){
        $ogestion = ORM::factory('pvogestiones')->where('id','=',$id)->find();
        $especificos = ORM::factory('pvoespecificos')->where('id_obj_gestion','=',$id)->and_where('estado','=',1)->find_all();
        $oficina = ORM::factory('oficinas')->where('id','=',$ogestion->id_oficina)->find();
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvplanificacion/listaoespecificos')
                                        ->bind('objetivos', $especificos)
                                        ->bind('ogestion', $ogestion)
                                        ->bind('oficina', $oficina)
                                        ;
    }
    
    public function action_addobjespecifico($id = ''){
        $mensajes=array();
        if (isset($_POST['submit'])) {
            $objetivo = ORM::factory('pvoespecificos');
            $objetivo->codigo = trim($_POST['codigo']);
            $objetivo->objetivo = trim($_POST['objetivo']);
            $objetivo->id_obj_gestion = $id;
            $objetivo->estado = 1;
            $objetivo->save();
            $mensajes['Adidionado!'] = 'El Objetivo se adiciono correctamente.';
        }
        $ogestion = ORM::factory('pvogestiones')->where('id','=',$id)->find();
        $oficina = ORM::factory('oficinas')->where('id','=',$ogestion->id_oficina)->find();
        $entidad = ORM::factory('entidades')->where('id','=',$oficina->id_entidad)->find();
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvplanificacion/addobjespecifico')
                                        ->bind('ogestion', $ogestion)
                                        ->bind('oficina', $oficina)
                                        ->bind('entidad', $entidad)
                                        ->bind('mensajes', $mensajes)
                                        ;
    }
    
    public function action_editobjespecifico($id = ''){
        $oespecifico = ORM::factory('pvoespecificos')->where('id','=',$id)->find();
        if (isset($_POST['submit'])) {
            $oespecifico->codigo = trim($_POST['codigo']);
            $oespecifico->objetivo = trim($_POST['objetivo']);
            $oespecifico->save();
            $this->request->redirect('pvplanificacion/objetivoespecifico/'.$oespecifico->id_obj_gestion);
        }
        $ogestion = ORM::factory('pvogestiones')->where('id','=',$oespecifico->id_obj_gestion)->find();
        $oficina = ORM::factory('oficinas')->where('id','=',$ogestion->id_oficina)->find();
        $entidad = ORM::factory('entidades')->where('id','=',$oficina->id_entidad)->find();
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvplanificacion/editobjespecifico')
                                        ->bind('ogestion', $ogestion)
                                        ->bind('oespecifico', $oespecifico)
                                        ->bind('oficina', $oficina)
                                        ->bind('entidad', $entidad)
                                        ;
    }    
    
    public function action_eliminarobjesp($id = ''){
        $objetivo = ORM::factory('pvoespecificos')->where('id','=',$id)->find();
        if ($objetivo->loaded()) {
            $objetivo->estado = 0;
            $objetivo->save();
            $this->request->redirect('pvplanificacion/objetivoespecifico/'.$objetivo->id_obj_gestion);
        }
        else{
            $this->template->content = 'El Objetivo No Existe.';
        }
    }
    
    public function action_gestion(){
        //$oficina = ORM::factory('oficinas')->where('id','=',$id)->find();
        $entidad = ORM::factory('entidades')->where('id','=',$this->user->id_entidad)->find();
        $oGestion = new Model_Pvogestiones();        
        $ogestion = $oGestion->objetivosgestion($this->user->id_entidad);
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvplanificacion/objetivosgestion')
                                        ->bind('objetivos', $ogestion)
                                        ->bind('entidad', $entidad)
                                        ;
    }
    
    public function action_especificos(){
        $entidad = ORM::factory('entidades')->where('id','=',$this->user->id_entidad)->find();
        $oEspecifico = new Model_Pvoespecificos();
        $oespecifico = $oEspecifico->objetivosespecificos($this->user->id_entidad);
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvplanificacion/objetivosespecificos')
                                        ->bind('objetivos', $oespecifico)
                                        ->bind('entidad', $entidad)
                                        ;
    }
    
    public function action_listaactividades($id = ''){
        $oespecifico = ORM::factory('pvoespecificos')->where('id','=',$id)->and_where('estado','=',1)->find();
        $ogestion = ORM::factory('pvogestiones')->where('id','=',$oespecifico->id_obj_gestion)->find();
        $actividades = ORM::factory('pvactividades')->where('id_objespecifico','=',$oespecifico->id)->find_all();
        $oficina = ORM::factory('oficinas')->where('id','=',$ogestion->id_oficina)->find();
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvplanificacion/listaactividades')
                                        ->bind('objetivos', $actividades)
                                        ->bind('oespecifico', $oespecifico)
                                        ->bind('ogestion', $ogestion)
                                        ->bind('actividades', $actividades)
                                        ->bind('oficina', $oficina)
                                        ;
    }
    
    public function action_addactividad($id = ''){
        $mensajes=array();
        if (isset($_POST['submit'])) {
            $actividad = ORM::factory('pvactividades');
            $actividad->codigo = trim($_POST['codigo']);
            $actividad->actividad = trim($_POST['actividad']);
            $actividad->id_objespecifico = $id;
            $actividad->estado = 1;
            $actividad->save();
            $mensajes['Adidionado!'] = 'La Actividad se adiciono correctamente.';
        }
        $actividades = ORM::factory('pvactividades')->where('id_objespecifico','=',$id)->find_all();
        $oespecifico = ORM::factory('pvoespecificos')->where('id','=',$id)->and_where('estado','=',1)->find();
        $ogestion = ORM::factory('pvogestiones')->where('id','=',$oespecifico->id_obj_gestion)->find();
        $oficina = ORM::factory('oficinas')->where('id','=',$ogestion->id_oficina)->find();
        $entidad = ORM::factory('entidades')->where('id','=',$oficina->id_entidad)->find();
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvplanificacion/addactividad')
                ->bind('actividades', $actividades)                        
                ->bind('ogestion', $ogestion)
                ->bind('oespecifico', $oespecifico)
                ->bind('oficina', $oficina)
                ->bind('entidad', $entidad)
                ->bind('mensajes', $mensajes)
                                        ;
    }
    
    public function action_editactividad($id = ''){
        $mensajes = array();
        $actividad = ORM::factory('pvactividades')->where('id','=',$id)->find();
        if (isset($_POST['submit'])) {
            $actividad->codigo = trim($_POST['codigo']);
            $actividad->actividad = trim($_POST['actividad']);
            $actividad->save();
            $this->request->redirect('pvplanificacion/listaactividades/'.$actividad->id_objespecifico);
        }
        //$actividades = ORM::factory('pvactividades')->where('id_objespecifico','=',$id)->find_all();
        $oespecifico = ORM::factory('pvoespecificos')->where('id','=',$actividad->id_objespecifico)->and_where('estado','=',1)->find();
        $ogestion = ORM::factory('pvogestiones')->where('id','=',$oespecifico->id_obj_gestion)->find();
        $oficina = ORM::factory('oficinas')->where('id','=',$ogestion->id_oficina)->find();
        $entidad = ORM::factory('entidades')->where('id','=',$oficina->id_entidad)->find();
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('pvplanificacion/editactividad')
                ->bind('actividad', $actividad)
                ->bind('ogestion', $ogestion)
                ->bind('oespecifico', $oespecifico)
                ->bind('oficina', $oficina)
                ->bind('entidad', $entidad)
                ->bind('mensajes', $mensajes)
                ;
    }
}

?>
