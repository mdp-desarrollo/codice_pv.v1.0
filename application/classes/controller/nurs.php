<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_nurs extends Controller_DefaultTemplate{ 
    protected $user;
    protected $menus;
    public function before() {
        $auth =  Auth::instance();
        //si el usuario esta logeado entonces mostramos el menu
        if($auth->logged_in()){
            //menu top de acuerdo al nivel
            $session=Session::instance();
            $this->user=$session->get('auth_user');
            $oNivel=New Model_niveles();
            $this->menus=$oNivel->menus($this->user->nivel);                        
        parent::before();    
        $this->template->title = 'Hojas de ruta';
        }
        else{
            $this->request->redirect('login');
        }        
    }  
    public function after() 
    {        
        $this->template->menutop = View::factory('templates/menutop')->bind('menus',$this->menus)->set('controller', 'nurs');
        $oSM=New Model_menus();
        $submenus=$oSM->submenus('nurs');
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus',$submenus)->set('titulo','Hojas de ruta');        
        parent::after();
    }  
    //listar nuris generados por el usuario logeado
    public function action_index()
    {        
            $count=ORM::factory('documentos')->where('original','=',1)->and_where('id_user','=',$this->user->id)->count_all();
            $pagination = Pagination::factory(array(
  		'total_items'    => $count,
                'current_page'   => array('source' => 'query_string', 'key' => 'page'),
                'items_per_page' => 30,
                'view'           => 'pagination/floating',            
                ));  		  
            $results=ORM::factory('documentos')
                                   ->where('id_user','=',$this->user->id)
                                   ->and_where('id_tipo','=',6)                                   
                                   ->order_by('fecha_creacion','DESC')
                                   ->limit($pagination->items_per_page)
                                   ->offset($pagination->offset)
                                   ->find_all();           
            $page_links = $pagination->render();               
            $this->template->title     .= ' | Hojas de ruta creados por mi usuario';
            $this->template->styles=array('media/css/tablas.css'=>'all');
             $this->template->scripts    = array('media/js/jquery.tablesorter.min.js');
            $this->template->content=View::factory('nurs/index')
                                           ->bind('results', $results)
                                           ->bind('page_links', $page_links)
                                           ->bind('count', $count);
    }

}
?>
