<?php
 defined('SYSPATH') or die('No direct script access.');

 class Controller_GridTemplate extends Controller_Template
  {
     public $template = 'templates/slickgrid';

     public function before()
      {
         // Run anything that need ot run before this.
         parent::before();

         if($this->auto_render)
          {
            // Initialize empty values
            $this->template->title            = '';
            $this->template->meta_keywords    = '';
            $this->template->meta_description = '';
            $this->template->meta_copywrite   = '';
            $this->template->header           = '';
            $this->template->content          = '';
            $this->template->footer           = '';
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
             $styles= array(
                 'assets/css/style.css'=>'all',
                 'assets/css/superfish.css'=>'screen',
                 'assets/css/thmmes/jquery-ui-1.8.1.custom.css'=>'screen',
                 'assets/css/slick.grid.css'=>'screen',
                 'assets/css/slick.pager.css'=>'screen',
                 'assets/css/slick.columnpicker.css',
                 'assets/css/examples.css'=>'screen'
                 );
             $scripts = array(
                 'assets/js/jquery-1.4.4.min.js',
                 'assets/js/jquery-ui-1.8.4.custom.min.js'
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