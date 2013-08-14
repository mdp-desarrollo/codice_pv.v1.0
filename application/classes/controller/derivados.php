<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_derivados extends Controller_DefaultTemplate{
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
        $this->template->title='Ventanilla';
        }
        else
        {
            $this->request->redirect('/login');
        }        
    }
 public function after() 
    {   
        $this->template->menutop = View::factory('templates/menutop')->bind('menus',$this->menus)->set('controller', 'derivados');
        $oSM=New Model_menus();
        $submenus=$oSM->submenus('derivados');
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus',$submenus)->set('titulo','Bandeja de Entrada');        
        parent::after();
    }  
   public function action_index()
    {
       $oSeg=New Model_Seguimiento();
            $entrada=$oSeg->enviados($this->user->id);                      
            $this->template->styles=array('media/css/tablas.css'=>'screen','media/css/modal.css'=>'screen');           
            $this->template->title     .= ' | Correspondencia enviada'; 
            $this->template->content=View::factory('bandeja/enviados')
                                    ->bind('entrada', $entrada); 
    }
}
?>
