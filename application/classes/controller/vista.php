}<?php

defined('SYSPATH') or die('Acceso denegado');

class Controller_Vista extends Controller_MinimoTemplate {

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
            $this->template->title = 'Bandeja';
        } else {
            $url = substr($_SERVER['REQUEST_URI'], 1);
            $this->request->redirect('/login?url=' . $url);
        }
    }

    public function after() {
        $this->template->menutop = View::factory('templates/menutop')->bind('menus', $this->menus)->set('controller', 'bandeja');
        $oSM = New Model_menus();
        $submenus = $oSM->submenus('bandeja');
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus', $submenus)->set('titulo', 'Bandeja de Entrada');
        parent::after();
    }

//   public function action_index(){        
//        $cod=  Arr::get($_GET,'doc','x');                
//        $id_seg=  Arr::get($_GET,'id_seg',0);                
//        $documento=ORM::factory('documentos')
//                    ->where('cite_original','=',$cod)                    
//                    ->find();
//        if($documento->loaded()){
//            $seguimiento=ORM::factory('seguimiento')->where('id','=',$id_seg)->find();
//            if($seguimiento->derivado_a==$this->user->id || $seguimiento->derivado_por==$this->user->id || $this->user->prioridad==1)
//            {
//            $archivo=ORM::factory('archivos')->where('id_documento','=',$documento->id)->find();
//
//            $this->template->content=View::factory('documentos/vista')
//                                    ->bind('d',$documento)
//                                   ->bind('archivo', $archivo);
//            }            
//            else{
//                $this->template->content=View::factory('no_access');
//            }
//        }
//    }
    // MODIFICADO POR FREDDY
    public function action_index() {
        $cod = Arr::get($_GET, 'doc', 'x');
        $id_seg = Arr::get($_GET, 'id_seg', 0);
        $documento = ORM::factory('documentos')
                ->where('cite_original', '=', $cod)
                ->find();
        if ($documento->loaded()) {
            $oSeg = New Model_Seguimiento();

            $seguimiento = $oSeg->permisos_nur($id_seg, $this->user->id);

            $x = $seguimiento[0]['contador'];

            if ($x > 0) {
                $archivo = ORM::factory('archivos')->where('id_documento', '=', $documento->id)->find();

                $pvfucov = ORM::factory('pvfucovs')->where('id_documento', '=', $documento->id)->find();
                if ($pvfucov->loaded()) {
                    ///rodrigo-POA
                    $pvpoas = ORM::factory('pvpoas')->where('id_fucov','=',$pvfucov->id)->find();
                    $pvgestion = ORM::factory('pvogestiones')->where('id','=',$pvpoas->id_obj_gestion)->find();
                    $pvespecifico = ORM::factory('pvoespecificos')->where('id','=',$pvpoas->id_obj_esp)->find();
                    $pvactividad = ORM::factory('pvactividades')->where('id','=',$pvpoas->id_actividad)->find();
                    ///rodrigo-PPT
                    $cambio = ORM::factory('pvtipocambios')->find_all();
                    foreach($cambio as $c)
                        $tipo_cambio = $c;
                    $pvliquidacion = ORM::factory('pvliquidaciones')->where('id_fucov','=',$pvfucov->id)->find();
                    if(!$pvliquidacion->loaded()){//proceso autorizado por Presupuesto
                        $oPart = New Model_Pvprogramaticas();
                        $pvliquidacion = $oPart->pptdisponibleuser($pvfucov->id_programatica,$pvfucov->total_pasaje,$pvfucov->total_viatico,$pvfucov->id_tipoviaje,$pvfucov->gasto_representacion,$tipo_cambio->cambio_venta);
                    }
                    else{
                        $oPart = New Model_Pvprogramaticas();
                        $pvliquidacion = $oPart->pptliquidado($pvfucov->id,$pvfucov->total_pasaje,$pvfucov->total_viatico,$pvfucov->id_tipoviaje,$pvfucov->gasto_representacion,$tipo_cambio->cambio_venta);
                    }
                }
                $this->template->content = View::factory('documentos/vista')
                        ->bind('d', $documento)
                        ->bind('pvfucov', $pvfucov)
                        ->bind('archivo', $archivo)
                        ///rodrigo POA
                        ->bind('pvpoas', $pvpoas)
                        ->bind('pvgestion', $pvgestion)
                        ->bind('pvespecifico', $pvespecifico)
                        ->bind('pvactividad', $pvactividad)
                        ///PPT
                        ->bind('pvliquidacion', $pvliquidacion)
                        ;
            } else {
                $this->template->content = View::factory('no_access');
            }
        }
    }

}

?>
