<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  lang="es" xml:lang="es">
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
    </script>    
</head>
<body>
    <div id="top">
        <div id="modx-topbar">
            <div id="modx-site-name">
            Codice
            <span class="modx-version">Correspondencia Digital Centralizada</span>
            </div>
            <div id="modx-logo">
                <div id="find">
                    <form action="/busqueda" method="GET">           
                        <input type="text" name="txt_buscar" class="txt_buscar" style="line-height: 20px; height: 25px; font-size: 13px; width: 200px;" />
                        <input type="submit" name="buscar" value="Buscar" class="uibutton" style="line-height: 20px; height: 30px;" />
                    </form>
                </div>
            </div>            
        </div>
        <div id="modx-navbar">
        <div id="rightlogin">
        <span>
            <b id="modx-login-user" title="<?php $session=Session::instance(); echo strtoupper($session->get('entidad')) ?>"><?php  $session=Session::instance(); echo $session->get('sigla'); ?></b>&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
            <a href="/user/logout" title="Salir del sistema" class="modx-logout">Salir</a>
            <a href="/user/info" title="Informaci&oacute;n de Usuario" id="modx-login-user"><?php  $session=Session::instance(); $user=$session->get('auth_user'); echo $user->nombre; ?></a>
        </span>
        </div>
        <div id="modx-topnav-div">
            <div id="menu">
    <ul id="nav" class="typeface-js">
     <?php echo $menutop;?>
    </ul>
  </div>
    </div>    
        </div>
    </div>
    <div id="lateral">
            <div id="menu-left">
                <ul>
                    <?php echo $submenu;?>
                </ul>      
              </div>
            <div id="opciones" class="oculto archive">
            <ul>
                <li>
                    <a href="#" id="group" ><img src="/media/images/group.gif" align="absmiddle"  /> Agrupar</a>         
                </li>
                <li>
              <a href="#" id="archive" ><img src="/media/images/folders.jpg" align="absmiddle"   /> Archivar</a>         
                </li>
            </ul>
            <div id="seleciones" ></div>
            </div>

            <!-- Codigo Freddy -->
            <div id="opciones_recepcionar" class="oculto archive">
            <ul>
                <li>
                    <a href="#" id="recepcionar" ><img src="/media/images/group.gif" align="absmiddle"  /> Recepcionar</a>         
                </li>
            </ul>
            <div id="seleciones_recepcionar" ></div>
            </div>
            <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxx -->
        
            <div id="print_enviados" class="oculto archive">
            <ul>
                <li>
                    <a href="#" id="print_hr"><img src="/media/images/group.png" align="absmiddle"  /><b> Generar PDF</b></a>         
                </li>                
             </ul>
            <div id="selecciones2" ></div>
            </div> 
        </div>
        
        <div id="content">                        
            <a id="toggler"></a>
            <div id="render">
                <?php echo $content;?>
                <div style="clear: both; display: block;margin: 5px 0; height: 10px;  ">                    
                </div>
            </div>
        </div>
</body>
</html>