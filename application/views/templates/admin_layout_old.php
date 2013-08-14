<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<!--[if IE]> <script> (function() { var html5 = ("abbr,article,aside,audio,canvas,datalist,details," + "figure,footer,header,hgroup,mark,menu,meter,nav,output," + "progress,section,time,video").split(','); for (var i = 0; i < html5.length; i++) { document.createElement(html5[i]); } })(); </script> <![endif]-->
<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="es" />
    <link rel="shortcut icon" href="<?php echo url::base().'media/images/icon.png';?>" />
    <title><?php echo $title;?></title>
    <meta name="keywords" content="<?php echo $meta_keywords;?>" />
    <meta name="description" content="<?php echo $meta_description;?>" />
    <meta name="copyright" content="<?php echo $meta_copywrite;?>" />
    <?php foreach($styles as $file => $type) { echo HTML::style($file, array('media' => $type)), "\n"; }?>
    <?php foreach($scripts as $file) { echo HTML::script($file, NULL, TRUE), "\n"; }?>
    <script type="text/javascript">
        
       jQuery.ready(function() {
  jQuery('a.minibutton').bind({
    mousedown: function() {
      jQuery(this).addClass('mousedown');
    },
    blur: function() {
      jQuery(this).removeClass('mousedown');
    },
    mouseup: function() {
      jQuery(this).removeClass('mousedown');
    }
  });
  
  var badBrowser = (/MSIE ((5\.5)|6)/.test(navigator.userAgent) && navigator.platform == "Win32");
   if (badBrowser) {
     // get all pngs on page
     $('img[src$=.png]').each(function() {
       fixPng(this);
     });
   }

  
});
    </script>
    
</head>
<body >  
<div id="bgheader"><!-- BEGIN: header -->

</div>
<div id="header">
    <img alt="logo" src="/media/images/logo1.png" id="logo-product"/>	<div id="header-icons">
    <ul>
        <li><?php  $session=Session::instance(); $user=$session->get('auth_user'); echo $user->nombre; ?> |</li>
        <li><a onclick="" href="#"><img border="0" alt="Ayuda" src="/media/images/help.gif"> Ayuda</a> |</li>
        <li><a target="_self" href="/user/logout"><img border="0" alt="Cerrar sesión" src="/media/images/logout.gif"> Cerrar sesión</a></li>
    </ul>
   </div><!-- header-icons --> 
</div> 
<div id="menu">
    <ul class="typeface-js" id="nav">
        <?php echo $menutop;?>
    </ul>
  </div>   
<div id="flames">
<div id="main">       
    
<div id="content"> 
<table cellspacing="0" cellpadding="0" align="center" style="margin-left: 1px;">
    <tbody><tr>
      <td valign="top">
  <div id="menu-left">
    <ul>
        <?php echo $submenu;?>
    </ul>
  </div>
     </td>
        <td width="820" valign="top">
        <div id="page-content">                        
              <?php echo $content;?>  
        </div><!-- page_content -->
         </td> 
       </tr>
      </tbody></table>
  <div id="menu-left">
        
  </div>
  <div id="page-content">
        
  </div><!-- content -->
 </div><!-- main -->
<div id="footer">
<b>Copyright &copy; <a  href="mailto:ivanmarceloch_hp49@hotmail.com" title="Powered by Ivan Marcelo Chacolla M.">Sistemas 2011</a> </b> - Ministerio de Desarrollo Productivo y Econom&iacute;a Plural | Estado Plurinacional de Bolivia</div>     
</div>
    
</div>    
</body>
</html>
