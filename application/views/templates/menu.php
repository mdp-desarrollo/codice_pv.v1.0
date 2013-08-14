<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<?php foreach($styles as $file => $type) { echo HTML::style($file, array('media' => $type)), "\n"; }?>
<?php foreach($scripts as $file) { echo HTML::script($file, NULL, TRUE), "\n"; }?>
<script type="text/javascript">
function NavToggle(element) {
	// This gives the active tab its look
	var navid = $('#nav');
	var navs = $('li');
	var navsCount = navs.length;
	for(j = 0; j < navsCount; j++) {
		active = (navs[j].id == element.parentNode.id) ? "active" : "";
		navs[j].className = active;
	}
	// remove focus from top nav
	if(element) element.blur();
}
</script>
<style type="text/css">
.activenav{
	color: #000;
	background-color:green;
	background-image: url(/media/images/misc/longbarbg2.png);
	-moz-border-radius: 6px;
	font-weight:bold;
}	
	</style>	
	
</head>

<body id="topMenu" class="ltr">

<div id="tocText"></div>
<div id="topbar">
<div id="topbar-container">
<div id="statusbar"><span id="buildText"></span> <span id="workText"></span></div>
<div id="supplementalNav"><img src="/media/images/user.png"  align="absmiddle" /><?php echo $_SESSION ['usuario'];?> |
<a href="/user/change"  title="Cambiar mi contrase&ntilde;a" target="main" id="">Cambiar Contrase&ntilde;a | 
<a href="/help"   target="main" title="Ayuda" > Ayuda </a> | 
<a href="/user/logout"  title="Cerrar" target="_top"> Cerrar Sesi&oacute;n</a> | <span title="by Ivan Marcelo Ch. - ivanmarceloch_hp49@hotmail.com">1.0</span>
</div>
</div>
</div>

<form name="menuForm" action="l4mnu.php" class="clear">
<div id="Navcontainer">
<div id="divNav">
<ul id="nav">
	<li id="limenu3" class="active"><a href="#menu3"
		onclick="new NavToggle(this); return false;">Inicio</a>
	<ul class="subnav" id="menu3">
		<li><a onclick="this.blur();" href="/user" title="Inicio" class="tipsy" target="main"><img src="/media/images/gohome.png" width="24" height="24"	align="middle"></img> <br />Pag. Principal</a></li>		
	</ul>
	</li>
	<li id="limenu5"><a href="#menu5" onclick="new NavToggle(this); return false;">Bandeja</a>
        <ul class="subnav" id="menu5">        
        <li title="Bandeja de entrada"><a onclick="this.blur();"   href="/bandeja"  target="main"><img src="/media/images/mail_receive.png"  align="absmiddle" /> Bandeja de Entrada</a></li>
        <li title="Mis pendientes"><a onclick="this.blur();"   href="/bandeja/pendientes"  target="main"><img src="views/images/nuevo.png"  align="absmiddle" /> Pendientes</a></li>
        <li title="Bandeja de entrada"><a onclick="this.blur();"   href="/bandeja/salida"  target="main"><img src="views/images/nuevo.png"  align="absmiddle" /> Bandeja de Salida</a></li>
        <li title="Bandeja de entrada"><a onclick="this.blur();"   href="/bandeja"  target="main"><img src="views/images/nuevo.png"  align="absmiddle" /><br />Archivos</a></li>
        </ul>
	</li>
	<li id="limenu2"><a href="#menu2" onclick="new NavToggle(this); return false;">Documentos</a>
	<ul class="subnav" id="menu2">
            <li><a onclick="this.blur();" href="/documentos/nuevo" title="Crear un documento nuevo" target="main"><img src="/media/images/doc.png" align="absmiddle" /><br/>Crear documento</a></li>        
            <li><a onclick="this.blur();" href="/documentos" title="Documentos creados recientemente" target="main"><img src="views/images/proyectos.gif" align="absmiddle" />Recientes</a></li>        
            <?php echo $document;?>                
	</ul>
	</li>
	<li id="limenu1-1"><a href="#menu1-1"
		onclick="new NavToggle(this); return false;">Hojas de Ruta</a>
	<ul class="subnav" id="menu1-1">				
		<li><a onclick="this.blur();" href="/hojaruta" target="main"><img src="/media/images/hr.png" align="absmiddle"/> Listar</a></li>
		<li><a onclick="this.blur();" href="/hojaruta" target="main"><img src="/media/images/conf.png" align="middle"/><br />Configuraci&oacute;n</a></li>
	</ul>
	</li>
	<li id="limenu1-2"><a href="#menu1-2" onclick="new NavToggle(this); return false;">Reportes</a>
	<ul class="subnav" id="menu1-2">
		<li title="PROGRAMADO VS. EJECUTADO DE LAS ENTIDADES BAJO TUISION"><a onclick="this.blur();" href="main.php?controller=reportes&action=programadoEjecutado"  target="main"><img src="views/images/report.png" align="absmiddle"></img><br />Programado-Ejecutado</a></li>
		<li title="PROGRAMADO VS. EJECUTADO POR ENTIDAD"><a onclick="this.blur();" href="main.php?controller=reportes&action=programadoEjecutadoEntidad"  target="main"><img src="views/images/report2.png" align="absmiddle"></img><br />Prg vs Eje/Entidad</a></li>
		<li title="INVERSION Y TRANFERENCIAS" ><a onclick="this.blur();" href="main.php?controller=reportes&action=invTransForm" target="main"><img src="views/images/report3.png" align="absmiddle"></img><br />Inv. y Trans</a></li>
		<li title="PROYECTOS CLASIFICADOS" ><a onclick="this.blur();" href="main.php?controller=reportes&action=formProyClasificado" target="main"><img src="views/images/report3.png" align="absmiddle"></img><br />Proyectos Clasificados</a></li>		
		<li title="PROYECTOS POR TERRITORIO DEPARTAMENTAL - PROVINCIAL - MUNICIPAL" ><a onclick="this.blur();" href="main.php?controller=reportes&action=reporteTerritorio" target="main"><img src="views/images/report3.png" align="absmiddle"></img><br />Por Territorio</a></li>
		<li title="PROYECTOS POR TERRITORIO" ><a onclick="this.blur();" href="main.php?controller=reportes&action=generarReporteProyecto" target="main"><img src="views/images/report3.png" align="absmiddle"></img><br />Por Proyecto</a></li>
                <li title="PROGRAMACION POR GESTION" ><a onclick="this.blur();" href="main.php?controller=reportes&action=programaciones" target="main"><img src="views/images/report3.png" align="absmiddle"></img><br />Programaciones</a></li>
		
	
	</ul>
	</li>
</ul>
</div>
</div>
</form>

<!-- can't find a better name :) should always be fixed -->
<div id="menuSplitter"></div>

</body>
</html>