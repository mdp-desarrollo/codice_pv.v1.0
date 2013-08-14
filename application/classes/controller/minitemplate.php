<?php
 defined('SYSPATH') or die('No direct script access.');
 
 class Controller_Minitemplate extends Controller_Template
  {
     public $template = 'templates/mini';
     public function before()
      {
         // Run anything that need ot run before this.
         parent::before();
         if($this->auto_render)
          {
            // Initialize empty values
            $this->template->title            = '';
            $this->template->content          = '';           
            $this->template->styles           = array();
            $this->template->scripts          = array();
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
                                              'media/css/style1.css'=>'all',
                                              'media/css/input.css'=>'screen',
                                              'media/css/tablas_admin.css'=>'all'
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
 }
?>