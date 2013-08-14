<?php
 defined('SYSPATH') or die('No direct script access.');
 
 class Controller_Mintemplate extends Controller_Template
  {
     public $template = 'templates/login';
     public function before()
      {
         // Run anything that need ot run before this.
         parent::before();
         if($this->auto_render)
          {
            // Initialize empty values
            $this->template->title            = 'Codice';
            $this->template->meta_keywords    = '';
            $this->template->meta_description = '';
            $this->template->meta_copywrite   = '';
            $this->template->header           = '';
            $this->template->content          = '';
            $this->template->footer           = 'copyright Ivan Marcelo Chacolla';
            $this->template->styles           = array();
            $this->template->scripts          = array();
            $this->template->errors           = array();
          }
      }

     /**
      * Fill in default values for our properties before rendering the output.
      */
     public function after()
      {
         if($this->auto_render)
          {
             // Define defaults
             $styles                  = array(                                              
                                              'media/css/login.css'=>'screen',
                                              'media/css/input.css'=>'screen'
                                              );
             $scripts                 = array(                                              
                                              'media/js/jquery-1.6.1.min.js'
                                              );
             // Add defaults to template variables.
             $this->template->styles  = array_reverse(array_merge($this->template->styles, $styles));
             $this->template->scripts = array_reverse(array_merge($this->template->scripts, $scripts));
           }
         // Run anything that needs to run after this.
         parent::after();
      }
   public function save($entidad,$user,$accion)
	{
		$vitacora=ORM::factory('vitacora');                
                $vitacora->id_entidad=$entidad;
                $vitacora->id_usuario=$user;
                $vitacora->fecha_hora=date('Y-m-d H:i:s');
                $vitacora->accion_realizada=$accion;
                $vitacora->ip_usuario= Request::$client_ip;                         
                $vitacora->save();
	}   
 }
?>