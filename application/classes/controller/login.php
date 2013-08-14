<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_login extends Controller_Mintemplate{
    public function action_index()
    {        
        $errors=array();
        $auth =  Auth::instance();
        //si el usuario esta logeado entonces mostramos el menu
        if($auth->logged_in())
        {
            //si el usuario es un administrador entonces redireccionamos al menu administador
            $session=Session::instance();
            $user=$session->get('auth_user');
            if($user->nivel==5)
            {
                $this->request->redirect('admin');
            }
            else 
            {
                $this->request->redirect('index');
            }  
        }
        //de lo contrario mostramos el formulario de ingreso
        else{
            
            if(isset($_POST['submit']))
             {
                $validate = Validation::factory($this->request->post());
                $validate->rule('username', 'not_empty')
                         ->rule('password', 'not_empty');
                if ($validate->check())
                {
                $user=$auth->login(html::chars($_POST['username']),  html::chars($_POST['password']));
                if($user)
                    {
                    $usuario=  ORM::factory('users',$auth->get_user());
                    $session=Session::instance();
                    $session->set('username',$usuario->nombre);
                    $session->set('username',$usuario->username);
                    $session->set('cargo',$usuario->cargo);
                    $session->set('super',$usuario->super);
                    
                    $entidad = ORM::factory('entidades', $usuario->id_entidad);
                    $session->set('entidad',$entidad->entidad);
                    $session->set('sigla',$entidad->sigla);
                    //vitacora
                    $this->save($usuario->id_entidad,$usuario->id, $usuario->nombre.' <b>'.$usuario->cargo.'</b> ingresó al sistema');
                    
                    if($usuario->nivel==5)                    
                        $this->request->redirect('admin');                    
                    else
                       {
                        if(isset($_GET['url']))
                         $this->request->redirect($_GET['url']);
                        else
                         $this->request->redirect('index');                           
                       }
                    }
                else
                   {
                    $this->template->errors['login']='Usuario y/o contrase&ntilde;a incorrectos';    
                    }                  
                }
                else
                {
                    $this->template->errors['login']='Ingrese usuario y contrase&ntilde;a';
                }
            }                        
        }
        $this->template->title   .= ' | Ingreso';
        $this->template->content = View::factory('templates/login');
    }
   
}
?>
