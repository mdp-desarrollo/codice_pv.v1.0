<?
	include ("funciones.php");
?>
<html>
<head>
<title>DOCUMENTOS</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
@import url(assets/css/principal.css);
.style1 {font-size: xx-large}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function saltar () {
 z = document.form1;
z.action= "<? echo $tipo_documento; ?>.php";
z.codigo.value= "<? echo $codigo; ?>";
z.submit();
}
//-->
</script>
</head>
<body onLoad="saltar()">
<form name="form1" method="post" action="">
 <input name="codigo" type="hidden" id="codigo" value="">
 <input name="membrete" type="hidden" id="membrete" value="<?=$membrete?>">
</form>
<div align="center" class="style1">Generando documento para:<br> 
 <strong>
 <?
	echo $codigo;
?> 
 </strong></div>
</body>
</html>
