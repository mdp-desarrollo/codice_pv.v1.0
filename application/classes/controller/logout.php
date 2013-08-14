<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_Bandeja extends Controller_DefaultTemplate{
    protected $user;
    protected $menus;
    public function before() {
        $auth =  Auth::instance();
        //si el usuario esta logeado entnoces mostramos el menu
        if($auth->logged_in()){
        //menu top de acuerdo al nivel
            $session=Session::instance();
            $this->user=$session->get('auth_user');
            $oNivel=New Model_niveles();
            $this->menus=$oNivel->menus($this->user->nivel);
        parent::before();
        $this->template->title='<li><span>Su session finalizo.</span></li>';
        }
        else{
            $this->request->redirect('/logout');
        }
        
    }         
    //listar nuris generados por el usuario logeado
    public function action_index(){                     
            $this->template->content=View::factory('user/logout');
    }
    
}
?>
