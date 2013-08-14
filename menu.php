<div id="tocText"></div>
<div id="topbar">
<div id="topbar-container">
<div id="statusbar"><span id="buildText"></span> <span id="workText"></span></div>

<div id="supplementalNav"><img src="views/images/user.gif"  align="absmiddle" />
<span></span>
|
<a href="main.php?controller=usuario&action=cambiarPassword"  title="Cambiar mi contrase&ntilde;a" target="main" id=""><img src="views/images/keys.gif"  align="absmiddle" /> Cambiar Contrase&ntilde;a</a> |
<a href="index.php?a=9"   target="main" title="Ayuda" ><img src="views/images/help.gif"  align="absmiddle" /> Ayuda </a> |
<?php echo html::anchor('./login','Salir',array('title'=>'Salir del Sistema'));?><img src="views/images/Shutdown.gif"  align="absmiddle" /></img> Salir | <span title="by Ivan Marcelo Ch. - ivanmarceloch_hp49@hotmail.com">1.0</span>
<!-- close #supplementalNav --></div>
</div>
</div>
<form name="menuForm" action="l4mnu.php" class="clear">
<div id="Navcontainer">
<div id="divNav">
<ul id="nav">
	<li id="limenu3" class="active"><a href="#menu3"
		onclick="new NavToggle(this); return false;">Inicio</a>
	<ul class="subnav" id="menu3">
		<li><a onclick="this.blur();" href="main.php?controller=usuario&action=bienvenida" title="Inicio" class="tipsy" target="main"><img src="views/images/gohome.png" width="24" height="24"	align="middle"></img> <br />Pag. Principal</a></li>
	</ul>
	</li>
	<li id="limenu5"><a href="#menu5" onclick="new NavToggle(this); return false;">Proyectos</a>
        <ul class="subnav" id="menu5">
        <li title="CREAR NUEVO PROYECTO"><a onclick="this.blur();"   href="main.php?controller=proyecto&action=nuevoProyecto"  target="main"><img src="views/images/nuevo.png"  align="absmiddle" /></img><br />Nuevo Proyecto</a></li>
        <li title="LISTAR TODOS LOS PROYECTOS VIGENTES Y EN EJECUCION"><a onclick="this.blur();"   href="main.php?controller=proyecto&action=listaproyectos"  target="main"><img src="views/images/lista.png"  align="absmiddle" /></img><br />Proyectos Vigentes</a></li>
        <li title="LISTAR TODOS LOS PROYECTOS CONCLUIDOS"><a onclick="this.blur();"   href="main.php?controller=proyecto&action=listaproyectosTerminados"  target="main"><img src="views/images/kfm.png"  align="absmiddle" /></img><br />Proyectos Concluidos</a></li>
        <li title="BUSCAR UN PROYECTO EN ESPECIFICO"><a onclick="this.blur();"   href="main.php?controller=proyecto&action=frmBuscarProyecto"  target="main"><img src="views/images/add2.png"  align="absmiddle" /></img><br />Buscar un Proyecto</a></li>
	</ul>
	</li>
	<li id="limenu2"><a href="#menu2" onclick="new NavToggle(this); return false;">Administraci&oacute;n</a>
	<ul class="subnav" id="menu2">
    <li><a onclick="this.blur();" href="main.php?controller=proyecto&action=listarProyectos" title="Lista todos los Proyectos" target="main"><img src="views/images/proyectos.gif" align="absmiddle" /></img><br />Proyectos</a></li>
		<li><a onclick="this.blur();" href="main.php?controller=entidad&action=index" target="main"><img src="views/images/entidades.gif" align="absmiddle" /></img><br />Entidades</a></li>
		<li><a onclick="this.blur();" href="main.php?controller=unidad&action=index" target="main"><img src="views/images/calendar.gif" align="absmiddle" /></img><br />Unidades</a></li>
		<li><a onclick="this.blur();" href="main.php?controller=financiadores&action=index" target="main"><img src="views/images/fin.gif" align="absmiddle" /></img><br />Financiadores</a></li>
		<li><a onclick="this.blur();" href="main.php?controller=prioridades&action=index" target="main"><img src="views/images/folder2.gif" align="absmiddle" /></img><br />Prioridades</a></li>
		<li><a onclick="this.blur();" href="main.php?controller=proyecto&action=listarProyectos" target="main"><img src="views/images/folder_desktop.gif" align="absmiddle" /></img><br />fases</a></li>

	</ul>
	</li>
	<li id="limenu1-1"><a href="#menu1-1"
		onclick="new NavToggle(this); return false;">Herramientas</a>
	<ul class="subnav" id="menu1-1">
		<li><a onclick="this.blur();" href="main.php?controller=usuario&action=editarConfig" target="main"><img src="views/images/conf.png" align="middle"></img><br />Configuraci&oacute;n</a></li>
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


	</ul>
	</li>
</ul>
</div>
</div>
</form>