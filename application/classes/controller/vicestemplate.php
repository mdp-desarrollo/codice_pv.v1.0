<?php
 defined('SYSPATH') or die('No direct script access.');

 class Controller_vicesTemplate extends Controller_Template
  {
     public $template = 'templates/layout_vices';
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
            $this->template->footer           = 'copyright Ivan Marcelo Chacolla';
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
                                             // 'media/css/menu.css'=>'screen',
                                              'media/css/style1.css'=>'all',
                                              'media/css/reset.css'=>'screen'
                                              );
             $scripts                 = array(                                                                                              
                                              'media/js/tablesort.js',
                                              'media/js/jquery.pngFix.js',                                              
                                             // 'media/js/scriptsearch.js',
                                             // 'media/js/jquery-ui-1.8.14.custom.min.js',                                                             
                                              'media/js/jquery.validate.js',                                                             
                                              'media/js/jquery-1.6.4.min.js'
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