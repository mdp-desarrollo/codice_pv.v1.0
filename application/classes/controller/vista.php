<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_Vista extends Controller_MinimoTemplate{
    protected $user;
    protected $menus;
    public function before() 
    {
        $auth =  Auth::instance();
        //si el usuario esta logeado entocnes mostramos el menu
        if($auth->logged_in())
        {
        //menu top de acuerdo al nivel
            $session=Session::instance();
            $this->user=$session->get('auth_user');
            $oNivel=New Model_niveles();
            $this->menus=$oNivel->menus($this->user->nivel);
        parent::before();
        $this->template->title='Bandeja';
        }
        else
        {
            $url= substr($_SERVER['REQUEST_URI'],1);
            $this->request->redirect('/login?url='.$url);
        }        
}
 public function after() 
    {
        $this->template->menutop = View::factory('templates/menutop')->bind('menus',$this->menus)->set('controller', 'bandeja');
        $oSM=New Model_menus();
        $submenus=$oSM->submenus('bandeja');
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus',$submenus)->set('titulo','Bandeja de Entrada');        
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
    public function action_index(){        
        $cod=  Arr::get($_GET,'doc','x');                
        $id_seg=  Arr::get($_GET,'id_seg',0);                
        $documento=ORM::factory('documentos')
                    ->where('cite_original','=',$cod)                    
                    ->find();
        if($documento->loaded()){
            $oSeg=New Model_Seguimiento();
            
            $seguimiento=$oSeg->permisos_nur($id_seg,$this->user->id);
            
            $x=$seguimiento[0]['contador'];
            
            if($x>0)
            {
            $archivo=ORM::factory('archivos')->where('id_documento','=',$documento->id)->find();

            $this->template->content=View::factory('documentos/vista')
                                    ->bind('d',$documento)
                                   ->bind('archivo', $archivo);
            }            
            else{
                $this->template->content=View::factory('no_access');
            }
        }
    }
}
?>
