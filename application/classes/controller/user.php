<?php
defined('SYSPATH') or die('No direct script access.');
 
class Controller_User extends Controller_DefaultTemplate {
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
            $this->template->title='Usuario';
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
        $submenus=$oSM->submenus('user');
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus',$submenus)->set('titulo','Menu Usuario');        
        parent::after();
    }  
    
    public function action_index()
    {
        $this->template->content = View::factory('user/info')
            ->bind('user', $user);         
        // Cargamos la informacion del usuario
        $user = Auth::instance()->get_user();         
        // if a user is not logged in, redirect to login page
        if (!$user)
        {
            Request::current()->redirect('login');
        }
    }
    public function action_changePass()
    {
        $errors=array();
        $info=array();
        if($_POST)
        {
            
            $auth=Auth::instance();
            $pass_old=$auth->hash_password($_POST['pass_old']);
            if($pass_old==$this->user->password) //verificamos que el password anterior coincida
            {
                if($_POST['pass_new']==$_POST['pass_new2'])
                {
                    $user=ORM::factory('users',array('id'=>$this->user->id));
                    if($user->loaded())
                    {
                        $user->password=$auth->hash_password($_POST['pass_new']);
                        $user->save();                        
                        $info[]='Su contraseña fue  cambiado correctamente';
                        //vitacora
                        $this->save($this->user->id_entidad,$this->user->id, $this->user->nombre.' <b>'.$this->user->cargo.'</b> Cambio su contrase&ntilde;'); 
                    }
                }
                else
                {
                    $errors[]='Las contraseñas no coinciden';
                }                
            }
            else
            {
                $errors[]='La contraseña anterior es incorrecta';
            }
        }
        $user=$this->user;
        $this->template->content=View::factory('user/change_pass')
                                ->bind('user', $user)
                                ->bind('errors', $errors)
                                ->bind('info', $info);
                
    }
    public function action_changeData()
    {
        $errors=array();
        $info=array();
        if($_POST)
        {

                 $user=ORM::factory('users',array('id'=>$this->user->id));
                 if($user->loaded())
                 {
                        $user->nombre=$_POST['nombre'];
                        $user->cargo=$_POST['cargo'];
                        $user->mosca=$_POST['mosca'];
                        $user->email=$_POST['email'];
                        $user->genero=$_POST['genero'];
                        $user->save();                        
                        $info[]='Sus datos fueron cambiados correctamente';
                 }
                else
                {
                    $errors[]='Ocurrio un error, vuelva a inentarlo';
                }                

        }
        $user=$this->user;
        $this->template->content=View::factory('user/change_data')
                                ->bind('user', $user)
                                ->bind('errors', $errors)
                                ->bind('info', $info);
                
    }
    public function action_nuevo(){
        $entidades=ORM::factory('entidades')->find_all();
        $options=array();
        foreach($entidades as $e)
        {
            $options[$e->id]=$e->entidad;
        }
        $this->template->content=View::factory('admin/nuevo1')
                                 ->bind('options',$options);                
    }
    public function action_create()
    {
                 $oficinas=ORM::factory('oficinas')->find_all();
                 $options=array(''=>'Seleccione oficina...');
                 foreach ($oficinas as $o){
                     $options[$o->id]=$o->oficina;
                 }
                 //options cargos
                 $opCargos='';
                 $cargos=ORM::factory('users')->find_all();
                 foreach ($cargos as $c){
                     $opCargos.='<option value="'.$c->id.'" class="'.$c->id_oficina.'">'.$c->cargo.' - '.$c->nombre.'</options>';
                 }
                 $this->template->content=View::factory('user/create')
                                          ->bind('options', $options)
                                          ->bind('opCargos', $opCargos)
                                          ->bind('message', $message)
                                          ->bind('errors', $errors);
              
       /* $oficinas=ORM::factory('oficinas')->find_all();
        $this->template->content = View::factory('user/create')
            ->bind('errors', $errors)
            ->bind('message', $message)
            ->bind('oficinas',$oficinas);*/
             
        if ($_POST)
        {          
            try {
         
                // Create the user using form values
                $user = ORM::factory('user')->create_user($_POST, array(
                    'username',
                    'password',
                    'email',
                    'id_oficina',
                    'mosca',
                    'cargo',
                    'nombre',
                    'superior'
                    
                ));
                 
                // Grant user login role
                $user->add('roles', ORM::factory('role', array('name' => 'login')));
                 
                // Reset values so form is not sticky
                $_POST = array();
                 
                // Set success message
                $message = "You have added user '{$user->username}' to the database";
                 
            } catch (ORM_Validation_Exception $e) {
                 
                // Set failure message
                $message = 'There were errors, please see form below.';
                 
                // Set errors using custom messages
                $errors = $e->errors('models');
            }
        }
    }
     
    public function action_login()
    {
        $this->template->content = View::factory('user/login')
            ->bind('errors', $errors)
            ->bind('message', $message);
             
        if ($_POST)
        {
            // Attempt to login user
            $remember = array_key_exists('remember', $_POST);
            $user = Auth::instance()->login($_POST['username'], $_POST['password'], $remember);
             
            // If successful, redirect user
            if ($user)
            {
                Request::current()->redirect('user/index');
            }
            else
            {
                $message = 'Error de acceso';
            }
        }
    }
     
    public function action_logout()
    {
       //vitacora
       $this->save($this->user->id_entidad,$this->user->id, $this->user->nombre.' <b>'.$this->user->cargo.'</b> salio al sistema'); 
        // Log user out
        Auth::instance()->logout();        
        //header('Location: ../');
        // Redirect to login page
        Request::current()->redirect('');
    }
    public function action_list($id=''){
        $auth=Auth::instance();
        if($auth->logged_in()){
            /*$oData=new Model_data();
            $usuarios=$oData->usuarios($id);
             * */
            $usuarios=ORM::factory('users')->where('id_oficina','=',$id)->find_all();
            $this->template->content=View::factory('user/list')->bind('usuarios', $usuarios);
        }
    }
    //lista de usuarios
    public function action_listar(){
        $auth=Auth::instance();
        if($auth->logged_in()){
            $user=  ORM::factory('users',$auth->get_user());
            if($user->nivel==3){
            $oficina=  ORM::factory('oficinas',27);
            $usuarios=ORM::factory('users')->where('id_oficina','=',27)->find_all();
            $this->template->menu=  View::factory('admin/menu');
            $this->template->content=View::factory('user/list')->bind('usuarios', $usuarios)
                                    ->bind('oficina', $oficina);
            }
            else{
                $this->template->content=View::factory('errors/user');
            }
        }
    }
public function action_info()
{
    
    $oficina=ORM::factory('oficinas',$this->user->id_oficina);
    $oficina=$oficina->oficina;
    $user=$this->user;
    $this->template->title=$this->user->nombre;
    $this->template->content=View::factory('user/info')
                            ->bind('user',$user)
                            ->bind('oficina',$oficina);
                                
}

}
?>
