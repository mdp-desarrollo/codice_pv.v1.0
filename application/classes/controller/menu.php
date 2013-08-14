<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_Menu extends Controller_menutemplate{
    protected $user;
    protected $menus;
    public function before() {
        $auth =  Auth::instance();
        //si el usuario esta logeado entocnes mostramos el menu
        if($auth->logged_in()){
        //menu top de acuerdo al nivel
            $session=Session::instance();
            $this->user=$session->get('auth_user');
            $oNivel=New Model_niveles();
            $this->menus=$oNivel->menus($this->user->nivel);                        
        }
        parent::before();
    }
    public function after() {
        //esto es solo para document
        $oDoc=New Model_Tipos();
        $document=$oDoc->misTipos($this->user->id);
        $this->template->document=View::factory('templates/document')->bind('document',$document);
        parent::after();
    }
    public function action_index()
    {                          
         $auth =  Auth::instance();
        //si el usuario esta logeado entocnes mostramos el menu
        if($auth->logged_in()){
            //View::set_global('pass', $auth->hash_password('admin'));
            $user =  ORM::factory('users')->where('id','=',$auth->get_user())->find();  
            $session=Session::instance();
            $session->set('nombreUsuario',$user->nombre);   
        }
        //de lo contrario mostramos el formulario de ingreso
        else{
            $this->request->redirect(URL::base().'login');
            if(isset($_POST['submit'])){
                $validate = Validation::factory($this->request->post());
                $validate->rule('usuario', 'not_empty')
                         ->rule('password', 'not_empty');
                if ($validate->check())
                {
                    $user=$auth->login(Arr::get($_POST, 'usuario'),  Arr::get($_POST,'password'));
                    if ($user)
                        {
                            $this->request->redirect('index');
                        }
                    else
                       {   
                        Request::current()->redirect('login');
                        }                                
                }
            }
            $this->template->title   = 'Login';
            //$this->template->header  =  View::factory ('templates/menu');
            $this->template->content =  View::factory('admin/login');
        } 
 }
    public function action_page($page)
    {                  
         $auth =  Auth::instance();
        //si el usuario esta logeado entocnes mostramos el menu
        if($auth->logged_in()){ 
            //View::set_global('pass', $auth->hash_password('admin'));
            $user =  ORM::factory('users')->where('id','=',$auth->get_user())->find();
            $oCorr = new Model_data();
            $corr=$oCorr->no_recibidos($auth->get_user());
            //$this->template->header    = View::factory ('templates/menu')->bind('user', $user);
            //$this->template->content   = View::factory('admin/bienvenida')->bind('user', $user);            
      // Get the total count of records in the database
  /*	
        $count = DB::select(DB::expr('COUNT(*) AS mycount'))->from('users')->execute('alternate')->get('mycount');  		
      // Create an instance of Pagination class and set values
  	$pagination = Pagination::factory(array(
  		'total_items'    => $count,
  		'items_per_page' => 20,
                ));
  		
      // Load specific results for current page
  	$results = DB::select()->from('users')
  			->order_by('id','ASC')
  			->limit($pagination->items_per_page)
  			->offset($pagination->offset)->execute();              
      // Render the pagination links
  	$page_links = $pagination->render();
        */
        $count = DB::select(DB::expr('COUNT(*) AS mycount'))->from('seguimientos')->where('derivado_a', '=', $user->username)->execute('alternate')->get('mycount');  		
      // Create an instance of Pagination class and set values
  	$pagination = Pagination::factory(array(
  		'total_items'    => $count,
                'current_page'   => array('source' => 'query_string', 'key' => 'page'),
                'items_per_page' => 20,
                'view'           => 'pagination/floating',            
                ));  		
      // Load specific results for current page
  	$results = DB::select()->from('seguimientos')
                        ->where('derivado_a', '=', $user->username)
  			->order_by('derivado_por','ASC')
  			->limit($pagination->items_per_page)
  			->offset($pagination->offset)->execute()->as_array();;              
      // Render the pagination links
  	$page_links = $pagination->render();        
        $this->template->content   = View::factory('usuario/home')
                    ->bind('user', $user)
                    ->bind('results', $results)
                    ->bind('page_links', $page_links);
       }
        //de lo contrario mostramos el formulario de ingreso
        else{
            $this->request->redirect(URL::base().'login');
            if(isset($_POST['submit'])){
               $validate = Validation::factory($this->request->post());
                $validate->rule('usuario', 'not_empty')
                  ->rule('password', 'not_empty');
                if ($validate->check())
                {
                $auth->login(Arr::get($_POST, 'usuario'),  Arr::get($_POST,'password'));
                $this->request->redirect(URL::base());
                }
            }
            $this->template->title   = 'Login';
            //$this->template->header  =  View::factory ('templates/menu');
            $this->template->content =  View::factory('admin/login');
        } 
 }
}
?>
