<?php
 defined('SYSPATH') or die('No direct script access.');

 class Controller_DefaultTemplate extends Controller_Template
  {
     public $template = 'templates/layout';
     public function before()
      {
         // Run anything that need ot run before this.
         parent::before();
         if($this->auto_render)
          {
            // Initialize empty values
            $this->template->title            = 'MDPyEP';
            $this->template->meta_keywords    = '';
            $this->template->meta_description = '';
            $this->template->meta_copywrite   = '';
            $this->template->header           = '';
            $this->template->content          = '';
            $this->template->menu             = '';
            $this->template->footer           = 'copyright Luis Freddy Velasco';
            $this->template->adminmenu        = '';
            $this->template->styles           = array();
            $this->template->scripts          = array();   
            $this->template->menutop          = '';            
            $this->template->submenu          = View::factory('user/menu');
            $this->template->controller       = 'index';            
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
                                              /*'media/css/style.css'=>'all',*/
                                              //'media/css/menu.css'=>'screen',
                                              'media/css/input.css'=>'screen',
                                              'media/css/print.css'=>'print',
                                              'media/css/main.css'=>'screen',
                                              //'media/css/menu_style.css'=>'screen',
                                              
                                              'media/css/style1.css'=>'screen',
                                              'media/css/reset.css'=>'screen'
                                              );
             $scripts                 = array(                                                                                              
                                           //   'media/js/tablesort.js',
                                           //m   'media/js/jPrint.js',                                                                                            
                                              //'media/js/scriptsearch.js',
                                              //'media/js/jquery-ui-1.8.14.custom.min.js',                                                             
                                              'media/js/jquery.validate.js',                                                             
                                              'media/js/main.js',                                                             
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