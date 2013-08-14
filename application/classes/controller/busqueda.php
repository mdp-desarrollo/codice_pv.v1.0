<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_Busqueda extends Controller_DefaultTemplate{
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
        $this->template->title='Busqueda ';
        }
        else
        {
            $url= substr($_SERVER['REQUEST_URI'],1);
            $this->request->redirect('/login?url='.$url);
        }        
    }
 public function after() 
    {        
        $this->template->menutop = View::factory('templates/menutop')->bind('menus',$this->menus)->set('controller', 'buscar');
        $oSM=New Model_menus();
        $submenus=$oSM->submenus('buscar');
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus',$submenus)->set('titulo','Busqueda');        
        parent::after();
    }  
    //listar nuris generados por el usuario logeado
    public function action_index()
    {
        if($_GET['buscar']){            
            $text=trim($_GET['txt_buscar']);
            if($text!='')
            {
            $entidad=$this->user->id_entidad;
            if($this->user->prioridad==1)
            $entidad=0;
            $oDocumento=New Model_Documentos();                        
            $count= $oDocumento->contar($text,$entidad);
            $count=$count[0]['count'];
            // Creamos una instancia de paginacion + configuracion
            $pagination = Pagination::factory(array(
  		'total_items'    => $count,
                'current_page'   => array('source' => 'query_string', 'key' => 'page'),
                'items_per_page' => 20,
                'view'           => 'pagination/floating',            
                ));  	
            $results=$oDocumento->buscar($text,$pagination->offset,$pagination->items_per_page,$entidad);            
            // Render the pagination links
            $page_links = $pagination->render();
            //tipos para los tabs       
            $this->template->title      = ' Resultados de la busqueda';                 
            $this->template->styles     = array('media/css/tablas.css'=>'screen');
            $this->template->scripts    = array('media/js/tablesort.min.js');
            $this->template->content    = View::factory('busqueda/result')                    
                    ->bind('results', $results)
                    ->bind('page_links', $page_links)
                    ->bind('count', $count)
                    ->bind('name',$text);    
            
            }
            else
            {
                $this->request->redirect('busqueda/buscar');                
            }
        }
                    
    }
    public function action_buscar()
    {
        $mensajes=array();
        if(isset($_GET['buscar']))
        {
            $text=$_GET['texto'];
            $where=" WHERE ";
            $campos= New ArrayIterator($_GET['campo']);
            foreach ($campos as $c)
            {
                $where.="d.".$c." LIKE '%$text%' OR ";
            }
            $where = substr($where,0,-3);            
            $oDocumento=New Model_Documentos();                        
            $count= $oDocumento->contar2($where);            
            $count=$count[0]['count'];
            if($count>0)
            {
                // Creamos una instancia de paginacion + configuracion
                $pagination = Pagination::factory(array(
  		'total_items'    => $count,
                'current_page'   => array('source' => 'query_string', 'key' => 'page'),
                'items_per_page' => 15,
                'view'           => 'pagination/floating',            
                ));  	
                $results=$oDocumento->search($where,$pagination->offset,$pagination->items_per_page);            
                // Render the pagination links
                $page_links = $pagination->render();                
                //tipos para los tabs       
                $this->template->title      = ' Resultados de la busqueda';                 
                $this->template->styles     = array('media/css/tablas.css'=>'screen');
                $this->template->scripts    = array('media/js/tablesort.min.js');
                $this->template->content    = View::factory('busqueda/result')                    
                    ->bind('results', $results)
                    ->bind('page_links', $page_links)
                    ->bind('count', $count)
                    ->bind('name',$text); 
            }
            else
            {
                $mensajes['Sin exito!: ']="No se encontro ningun resultado para <b>'$text'</b>.";
                $this->template->title      .='| formulario de busqueda';
                $this->template->content    = View::factory('busqueda/form_avanzada')
                                              ->bind('mensajes',$mensajes);
            }
        }
        else
        {
        $this->template->title      .='| formulario de busqueda';
        $this->template->content    = View::factory('busqueda/form_avanzada')
                                      ->bind('mensajes',$mensajes); 
        }
        
    }
}
?>
