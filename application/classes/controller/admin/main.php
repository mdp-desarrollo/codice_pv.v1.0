<?php
defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Main extends Controller_AdminTemplate {
    protected $user;
    protected $menus;
    public function before() {
        $auth =  Auth::instance();
        //si el usuario esta logeado entocnes mostramos el menu
        if($auth->logged_in()){
        //menu top de acuerdo al nivel
            $session=Session::instance();
            $this->user=$session->get('auth_user');
            if($this->user->nivel!=5)
                    $this->request->redirect('user/logout');
            $oNivel=New Model_niveles();
            $this->menus=$oNivel->menus($this->user->nivel);
        parent::before();
       // $this->template->title='<li>'.html::anchor('admin','Bandeja').'</li>';
        }
        else{
            $this->request->redirect('/login');
        }
        
}
 public function after() {
        $this->template->menutop = View::factory('templates/menutop')->bind('menus',$this->menus)->set('controller', 'index');
        $oSM=New Model_menus();
        $submenus=$oSM->submenus('admin');
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus',$submenus)->set('titulo','Administrar');
        parent::after();
    }  
    // lista de oficinas
    public function action_index()
    {
        $entidades=ORM::factory('entidades')->count_all();
        $entidades=ORM::factory('entidades')->find_all();
        $this->template->content = View::factory('admin/lista_entidades')
                                    ->bind('entidades', $entidades);                 
    }
    public function action_lista($id='')
    {
        $entidad=ORM::factory('entidades',array('id'=>$id));
        if($entidad->loaded())
        {
            $oficinas=$entidad->oficinas->find_all();
            $this->template->content=View::factory('/admin/oficinas')
                                    ->bind('oficinas', $oficinas);
        }
        else
        {
            $this->template->content='Error: No se encontro la entidad';
        }
        
    }
 
}
?>
