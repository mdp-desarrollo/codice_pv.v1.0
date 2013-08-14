<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" xmlns:b="http://www.google.com/2005/gml/b" xmlns:data="http://www.google.com/2005/gml/data" xmlns:expr="http://www.google.com/2005/gml/expr">
<head>
<meta content='chrome=1' http-equiv='X-UA-Compatible' />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<!--[if IE]> <script> (function() { var html5 = ("abbr,article,aside,audio,canvas,datalist,details," + "figure,footer,header,hgroup,mark,menu,meter,nav,output," + "progress,section,time,video").split(','); for (var i = 0; i < html5.length; i++) { document.createElement(html5[i]); } })(); </script> <![endif]-->  
    <?php foreach($styles as $file => $type) { echo HTML::style($file, array('media' => $type)), "\n"; }?>
    <?php foreach($scripts as $file) { echo HTML::script($file, NULL, TRUE), "\n"; }?>
<script type="text/javascript">
$(function(){
});
</script>
<style>
    #title{
         background: url("/media/images/fondo_tabla.png") repeat-x scroll 0 0 transparent;
         line-height: 30px;
         padding: 0;
         color: #38455E;
         border-bottom: 1px solid #DFE5E9;
         border-left: 1px solid #DFE5E9;
         font-weight: normal;
         font-size: 12px;
    }
              
.breadcrumbs {
    border-bottom: 2px solid #6B81A1;
    background: #fff;
    padding-left: 0px;
    float: left;
    font-size: 12px;
    line-height: 30px;
    list-style: none outside none;
    width: 100%;
}
.breadcrumbs li {
    background: url("/media/images/store-header-footer-sprite.png") no-repeat scroll -90px -54px transparent;
    float: left;
    padding: 0 2px 0 10px;
}
.breadcrumbs li a.home {
    background: url("/media/images/store-header-footer-sprite.png") no-repeat scroll 9px -52px transparent;
    height: 0;
    overflow: hidden;
    padding: 28px 0 0;
    width: 34px;
    display: block;
}
.breadcrumbs li:first-child {
    background: url("/media/images/store-header-footer-sprite.png") no-repeat scroll -56px -54px transparent;
    padding-left: 0;
    padding-right: 12px;
}
.breadcrumbs li:first-child + li {
    background-position: -9999px -9999px;
    padding-left: 0;
}
</style>
</head>
  <body>        
      <div id="title">
        <ol class="breadcrumbs">
	<li>
		<a href="/user" class="home">INCIO</a>
	</li>
        <?php echo $title;?>         
        </ol>
       </div>
                
        <div id="main">
       <?php echo $content;?>                    
    </div>
  </body>
</html>