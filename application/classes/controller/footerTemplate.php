<?php
 defined('SYSPATH') or die('No direct script access.');

 class Controller_footerTemplate extends Controller_Template
  {
     public $template = 'templates/bottom';
     public function before()
      {
         // Run anything that need ot run before this.
         parent::before();
         if($this->auto_render)
          {
            $this->template->styles           = array();
            $this->template->scripts          = array();   
            $this->template->menutop          = '';            
            $this->template->controller       = 'index';
            $this->template->document          ='';
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
                                              'media/css/style0.css'=>'screen',
                                              'media/css/jquery-ui-1.8.14.custom.css'=>'all'
                                              );
             $scripts                 = array(                                                                                              
                                              'media/js/jquery.jclock.js',
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