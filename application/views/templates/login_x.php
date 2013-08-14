<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="Content-Language" content="es" />
    <link rel="shortcut icon" href="<?php echo url::base().'media/images/icon.png';?>" />
    <title><?php echo $title;?></title>
    <meta name="keywords" content="<?php echo $meta_keywords;?>" />
    <meta name="description" content="<?php echo $meta_description;?>" />
    <meta name="copyright" content="<?php echo $meta_copywrite;?>" />
    <?php foreach($styles as $file => $type) { echo HTML::style($file, array('media' => $type)), "\n"; }?>
    <?php foreach($scripts as $file) { echo HTML::script($file, NULL, TRUE), "\n"; }?>
</head>
<body>
<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
  <tbody>
      <?php if(isset($errors['login'])): ?>
      <tr height="30" id="error">
          <td bgcolor="#ffffff">
              <div style="background-color: #FDF4EF; border: 1px solid #890E0E; padding: 5px; font-size: 12px; font-family: Helvetica;   margin: 0 5px; text-align: center;  ">
                  <span><?php echo $errors['login'];?></span>
              </div>
          </td>
      </tr>
      <?php endif;?>
      <tr height="130">
       <td bgcolor="#ffffff"><div id="container_header"><div id="links"><a target="_blank" href="http://www.produccion.gob.bo">www.produccion.gob.bo</a> </div>
        <div style="width: 323px; padding: 20px; position: absolute; margin: 199px 0pt 0pt 380px;" class="rounded-panel">
          <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <form method="POST" action="" id="login" >
              <tbody><tr>
                <td style="padding: 20px 20px 0pt 0pt;" rowspan="7" colspan="1"><img width="100" height="172" src="/media/images/lock.png"/></td>
                <td colspan="2"><span style="color: rgb(255, 255, 255); font-size: 1.7em; font-family: Tahoma,Arial;">Ingreso</span></td>
              </tr>
              <tr>
                <td style="padding: 10px 0pt 4px;" colspan="2">
                <label for="userid" style="color: rgb(255, 255, 255); font-size: 0.85em; font-family: Tahoma,Arial,sans-serif; text-shadow: 0px 1px 1px rgb(0, 0, 0);">Usuario:</label></td>
              </tr>
              <tr>
                <td colspan="2">
			<input type="text" name="username" id="username" style="border: 1px solid rgb(51, 51, 51); padding: 4px; width: 190px; height: 17px;"/>
                </td>
              </tr>
              <tr>
                <td style="padding: 5px 0pt 4px;" colspan="2">
                    <label for="password" style="padding: 15px 0pt 2px; color: rgb(255, 255, 255); font-size: 0.85em; font-family: Tahoma,Arial,sans-serif; text-shadow: 0px 1px 1px rgb(0, 0, 0);">Contrase&ntilde;a:</label>
		</td>
              </tr>
              <tr>
                <td colspan="2">
		<input type="password" name="password" id="password" style="border: 1px solid rgb(51, 51, 51); padding: 4px; width: 190px; height: 17px;"/>
		</td>
              </tr>              
              <tr>                			  
                <td style="padding: 4px 0pt 0pt 0px;">
                  <input type="submit" name="submit" style="float: right; clear: both;" value="Ingresar" class="button"/>
                </td>
              </tr>                            
          </tbody>
          </form>
          </table>
        </div>
        <a target="_blank" href="http://www.produccion.gob.bo"><img width="224" height="94" border="0" alt="Sistema de Correspondencia" src="/media/images/logo.png"/></a></div></td>
  </tr>
  <tr height="350">
    <td class="dark"><div id="container_content">
            <h1 style="font-size: 38px; color:#fff;margin-bottom: 40px;">Quipus</h1>
        <div id="message">Sistema Integrado para el manejo de correspondencia. ingrese al sistema para revisar su bandeja.</div>
      </div>
    </td>
  </tr>
  <tr height="100%">
    <td valign="top" bgcolor="#ffffff"><div style="padding: 4px 20px 0pt 80px; height: 200px;" id="container_footer">&copy; Sistemas <?php echo date('Y');?> .Todos los derechos reservados.</div></td>
  </tr>
</tbody></table>
<script type="text/javascript">
$(function(){
    $("#username").focus();
   $('#error').mouseover(function(){ $(this).fadeOut('slow'); });
});
</script>
</body>
</html>
<html xmlns="http://www.w3.org/1999/xhtml"><head>




   <title>Alfresco » Iniciar sesión</title>
   <meta content="IE=Edge" http-equiv="X-UA-Compatible">

   <!-- Icons -->
   <link type="image/vnd.microsoft.icon" href="/share/res/favicon.ico" rel="shortcut icon">
   <link type="image/vnd.microsoft.icon" href="/share/res/favicon.ico" rel="icon">

   <!-- YUI -->
   <script src="/share/res/js/yui-common.js" type="text/javascript"></script>
   <script src="/share/res/js/bubbling.v2.1-min.js" type="text/javascript"></script>
   <script type="text/javascript">//&lt;![CDATA[
      YAHOO.Bubbling.unsubscribe = function(layer, handler, scope)
      {
         this.bubble[layer].unsubscribe(handler, scope);
      };
   //]]&gt;</script>

   <!-- Common i18n msg properties -->
   <script src="/share/service/messages.js?locale=es_ES" type="text/javascript"></script>

   <!-- Alfresco web framework constants -->
   <script type="text/javascript">//&lt;![CDATA[
      Alfresco.constants = Alfresco.constants || {};
      Alfresco.constants.DEBUG = false;
      Alfresco.constants.AUTOLOGGING = false;
      Alfresco.constants.PROXY_URI = window.location.protocol + "//" + window.location.host + "/share/proxy/alfresco/";
      Alfresco.constants.PROXY_URI_RELATIVE = "/share/proxy/alfresco/";
      Alfresco.constants.PROXY_FEED_URI = window.location.protocol + "//" + window.location.host + "/share/proxy/alfresco-feed/";
      Alfresco.constants.THEME = "default";
      Alfresco.constants.URL_CONTEXT = "/share/";
      Alfresco.constants.URL_RESCONTEXT = "/share/res/";
      Alfresco.constants.URL_PAGECONTEXT = "/share/page/";
      Alfresco.constants.URL_SERVICECONTEXT = "/share/service/";
      Alfresco.constants.URL_FEEDSERVICECONTEXT = "/share/feedservice/";
      Alfresco.constants.USERNAME = "guest";
      Alfresco.constants.SITE = "";
      Alfresco.constants.PAGEID = "";
      Alfresco.constants.PORTLET = false;
      Alfresco.constants.PORTLET_URL = unescape("");
      Alfresco.constants.JS_LOCALE = "es_ES";
   //]]&gt;</script>

   <!-- Alfresco web framework common resources -->
   <script src="/share/res/js/flash/AC_OETags-min.js" type="text/javascript"></script>
   <script src="/share/res/js/alfresco-min.js" type="text/javascript"></script>
   <script src="/share/res/modules/editors/tiny_mce/tiny_mce.js" type="text/javascript"></script>
   <script src="/share/res/modules/editors/tiny_mce-min.js" type="text/javascript"></script>
   <script src="/share/res/modules/editors/yui_editor-min.js" type="text/javascript"></script>
   <script src="/share/res/js/forms-runtime-min.js" type="text/javascript"></script>

   <!-- Share Constants -->
   <script type="text/javascript">//&lt;![CDATA[
      Alfresco.service.Preferences.FAVOURITE_DOCUMENTS = "org.alfresco.share.documents.favourites";
      Alfresco.service.Preferences.FAVOURITE_FOLDERS = "org.alfresco.share.folders.favourites";
      Alfresco.service.Preferences.FAVOURITE_SITES = "org.alfresco.share.sites.favourites";
      Alfresco.service.Preferences.IMAP_FAVOURITE_SITES = "org.alfresco.share.sites.imapFavourites";
      Alfresco.service.Preferences.COLLAPSED_TWISTERS = "org.alfresco.share.twisters.collapsed";
      Alfresco.service.Preferences.RULE_PROPERTY_SETTINGS = "org.alfresco.share.rule.properties";
      Alfresco.constants.URI_TEMPLATES =
      {
         "sitedashboardpage": "/site/{site}/dashboard",
         "sitepage": "/site/{site}/{pageid}",
         "userdashboardpage": "/user/{userid}/dashboard",
         "userpage": "/user/{userid}/{pageid}",
         "userprofilepage": "/user/{userid}/profile",
         "userdefaultpage": "/user/{pageid}",
         "consoletoolpage": "/console/{pageid}/{toolid}",
         "consolepage": "/console/{pageid}"
      };
      Alfresco.constants.HELP_PAGES =
      {
         "share-help": "http://docs.alfresco.com/4.0/topic/com.alfresco.enterprise.doc/topics/sh-uh-welcome.html",
         "share-tutorial": "http://docs.alfresco.com/4.0/topic/com.alfresco.enterprise.doc/concepts/gs-intro.html"
      };
      Alfresco.constants.HTML_EDITOR = 'tinyMCE';
   //]]&gt;</script>

   <!-- Share resources -->
   <script src="/share/res/js/share-min.js" type="text/javascript"></script>
   <script src="/share/res/js/lightbox-min.js" type="text/javascript"></script>

   <!-- Common stylesheets gathered to workaround IEBug KB262161 -->
   <style media="screen" type="text/css">
      @import "/share/res/css/yui-fonts-grids.css";
      @import "/share/res/yui/columnbrowser/assets/columnbrowser.css";
      @import "/share/res/yui/columnbrowser/assets/skins/default/columnbrowser-skin.css";
      @import "/share/res/yui/assets/skins/default/skin.css";
      @import "/share/res/css/base.css";
      @import "/share/res/css/yui-layout.css";
      @import "/share/res/themes/default/presentation.css";
   </style>


   <!-- Template Resources (nested content from < @templateHeader > call) -->
   <!-- Additional template resources -->

   <!-- Component Resources (from .get.head.ftl files) -->
   

   <!-- Template & Component Resources' stylesheets gathered to workaround IEBug KB262161 -->
   <style media="screen" type="text/css">
      @import "/share/res/themes/default/login.css";
   </style>

   <!-- MSIE CSS fix overrides -->
   <!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="/share/res/css/ie6.css" /><![endif]-->
   <!--[if IE 7]><link rel="stylesheet" type="text/css" href="/share/res/css/ie7.css" /><![endif]-->

   <!-- iPad CSS overrides -->
   <link href="/share/res/css/ipad.css" type="text/css" rel="stylesheet" media="only screen and (max-device-width: 1024px)">
</head><body class="yui-skin-default alfresco-share js" id="Share"><iframe id="_yuiResizeMonitor" title="Text Resize Monitor" tabindex="-1" role="presentation" style="position: absolute; visibility: visible; background-color: transparent; border-width: 0pt; width: 2em; height: 2em; left: 0pt; top: -33px;"></iframe><div id="overlay" style="display: none; position: absolute; top: 0pt; left: 0pt; z-index: 90; width: 100%;"><a href="#"><img src="/share/res/components/images/lightbox/loading.gif" id="loadingImage" style="position: absolute; z-index: 150;"></a></div><div id="lightbox" style="display: none; position: absolute; z-index: 100;"><a href="#" title="Click to close"><img id="lightboxImage"><img src="/share/res/components/images/lightbox/close.gif" id="closeButton" style="position: absolute; z-index: 200;"></a><div id="lightboxDetails"><div id="lightboxCaption" style="display: none;"></div><div id="keyboardMsg">press <a onclick="hideLightbox(); return false;" href="#"><kbd>x</kbd></a> to close</div></div></div><div class="login-panel yui-module yui-overlay" id="alflogin" style="visibility: visible; left: 447px; top: 72px; z-index: 2;">
      <div class="login-logo"></div>
      <form onsubmit="return alfLogin();" action="/share/page/dologin" method="post" accept-charset="UTF-8" id="loginform">
         <fieldset>
            <div style="padding-top: 96px;">
               <label for="username" id="txt-username">Nombre de usuario:</label>
            </div>
            <div style="padding-top: 4px;">
               <input type="text" value="" style="width: 200px;" maxlength="255" name="username" id="username">
            </div>
            <div style="padding-top: 12px;">
               <label for="password" id="txt-password">Contraseña:</label>
            </div>
            <div style="padding-top: 4px;">
               <input type="password" style="width: 200px;" maxlength="255" name="password" id="password">
            </div>
            <div style="padding-top: 16px;">
               <input type="submit" class="login-button" id="btn-login" value="Iniciar sesión">
            </div>
            <input type="hidden" value="/share/" name="success" id="success">
            <input type="hidden" value="/share/page/type/login?error=true" name="failure">
         </fieldset>
      </form>
      <div style="padding-top: 32px;">
         <span class="login-copyright">
            &copy; 2005-2011 Alfresco Software Inc. All rights reserved.
         </span>
      </div>
   </div>
   <div class="sticky-wrapper">
      <div id="doc3">
   
   
   <script type="text/javascript">//&lt;![CDATA[
   function alfLogin()
   {
      YAHOO.util.Dom.get("btn-login").setAttribute("disabled", true);
      return true;
   }
   
   YAHOO.util.Event.onContentReady("alflogin", function()
   {
      var Dom = YAHOO.util.Dom;
      
      // Prevent the Enter key from causing a double form submission
      var form = Dom.get("loginform");
      if (form)
      {
         // add the event to the form and make the scope of the handler this form.
         YAHOO.util.Event.addListener(form, "submit", this._submitInvoked, this, true);
         var fnStopEvent = function(id, keyEvent)
         {
            if (form.getAttribute("alflogin") == null)
            {
               form.setAttribute("alflogin", true);
            }
         }

         var enterListener = new YAHOO.util.KeyListener(form,
         {
            keys: YAHOO.util.KeyListener.KEY.ENTER
         }, fnStopEvent, "keydown");
         enterListener.enable();

         // set I18N labels
         Dom.get("txt-username").innerHTML = Alfresco.util.message("label.username") + ":";
         Dom.get("txt-password").innerHTML = Alfresco.util.message("label.password") + ":";
         Dom.get("btn-login").value = Alfresco.util.message("button.login");
      }
      
      // generate and display main login panel
      var panel = new YAHOO.widget.Overlay(YAHOO.util.Dom.get("alflogin"), 
      {
         modal: false,
         draggable: false, // NOTE: Don't change to "true"
         fixedcenter: YAHOO.env.ua.mobile === null,
         close: false,
         visible: true,
         iframe: false
      });
      panel.render(document.body);
      panel.center();
      
      Dom.get("success").value += window.location.hash;
      Dom.get("username").focus();
   });
   
   document.cookie="_alfTest=_alfTest"
   var cookieEnabled = (document.cookie.indexOf("_alfTest") != -1);
   

   if (cookieEnabled == false)
   {
      Alfresco.util.PopupManager.displayPrompt(
      {
         title: Alfresco.util.message("message.cookiesfailure"),
         text: Alfresco.util.message("message.cookieserror"),
         buttons: [
         {
            text: Alfresco.util.message("button.ok"),
            handler: function error_onOk()
            {
               this.destroy();
            },
            isDefault: false
         }]
      });
   }
   //]]&gt;</script>
      </div>
      <div class="sticky-push"></div>
   </div>
</body></html>