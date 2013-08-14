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
<script type="text/javascript">
$(function(){
   $("#username").focus();
   $('#close').click(function(){ $('#error').fadeOut('slow'); });
});
</script>
</head>
    <body>
  <table cellspacing="0" cellpadding="0" border="0" id="error"
         style="background-color: #FFF9C7; font-weight: bold; border: none; padding: 0; font-size: 12px; font-family: Helvetica;   
         margin: 0 auto; text-align: center; width:600px; ">
  <tbody>
      <?php if(isset($errors['login'])): ?>
      <tr height="30" >
          <td>
              <div >
                  <span><?php echo $errors['login'];?></span>
              </div>
          </td>
          <td width="5"><a href="#" id="close" title="cerrar" style="display: block;">[X]</a></td>
      </tr>
      <?php endif;?>
  </tbody>
        </table>
        <!--<div id="logo-entidad"><img src="/media/images/logo.jpg" width="220" style="padding: 4px; border: 1px solid #ccc; background: #efefef;"/></div>-->
        <div class="login-panel">
          <div class="login-logo"></div>
        <form action="" method="post" accept-charset="UTF-8" id="loginform">
         <fieldset>
            <div style="padding-top: 96px;">
               <label for="username" id="txt-username">Nombre de usuario:</label>
            </div>
            <div style="padding-top: 4px;">
               <input type="text" value="" style="width: 200px;" maxlength="255" name="username" id="username"/>
            </div>
            <div style="padding-top: 12px;">
               <label for="password" id="txt-password">Contraseña:</label>
            </div>
            <div style="padding-top: 4px;">
               <input type="password" style="width: 200px;" maxlength="255" name="password" id="password"/>
            </div>
            <div style="padding-top: 16px;">
               <input type="submit" class="login-button" id="submit" name="submit" value="Ingresar"/>
            </div>            
         </fieldset>
      </form>
      <div style="padding-top: 10px;">
         <span class="login-copyright">
            &copy; Sistemas 2011 | MDPyEP. Todos los derechos reservados.
         </span>
      </div>
   </div>
</body></html>