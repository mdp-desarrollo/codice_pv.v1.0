<?php
defined('SYSPATH') or die('Acceso denegado');
//clase que no utiliza templates
class Controller_otros extends Controller_Mintemplate{
    //lista de las noticias 
    public function action_noticias(){
        $noticias=  New Model_data();
        $notis=$noticias->noticias();     
        //$noticias=ORM::factory('comunicados')->where('tipo','=','1')->find_all()->as_array();
        echo json_encode($notis);
    }
   public function action_imagenes(){
        $auth =  Auth::instance();
        //si el usuario esta logeado entocnes mostramos el menu
        if($auth->logged_in()){
            $oImagenes=  ORM::factory('imagenes');
            $imagenes=$oImagenes->where('id_usuario','=',$auth->get_user())->find_all();
            $this->template->title='Insertar imagenes al contenido';
            $this->template->content=View::factory('imagenes/insertar')
                                        ->bind('imagenes',$imagenes);
        }
    }
   public function action_imagenes2(){
        $auth =  Auth::instance();
        //si el usuario esta logeado entocnes mostramos el menu
        if($auth->logged_in()){
            $oImagenes=  ORM::factory('imagenes');
            $imagenes=$oImagenes->where('id_usuario','=',$auth->get_user())->find_all();
            $this->template->title='Insertar imagenes al contenido';
            $this->template->content=View::factory('imagenes/insertar2')
                                        ->bind('imagenes',$imagenes);
        }
    }
   public function action_subirImagen(){
        $auth =  Auth::instance();
        //si el usuario esta logeado entocnes mostramos el menu
        if($auth->logged_in()){            
            $this->template->content=View::factory('imagenes/add');
        }
    }
   }
?>
