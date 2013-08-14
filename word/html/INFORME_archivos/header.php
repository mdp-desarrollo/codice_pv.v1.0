<?php
include("../bd_info.php");
$conexion=conectar();
?>
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns:st1="urn:schemas-microsoft-com:office:smarttags"
xmlns="http://www.w3.org/TR/REC-html40">
<?php
$dato="INF/$ofi";
$barra="select * from correlativos where codigo = '$dato'";
$eje_barra=mysql_query($barra, $conexion);
$mat_barra=mysql_fetch_object($eje_barra);
$dat=$mat_barra->id_cor;
$cod=str_replace("$dato","","$codigo");
$codi="$dat$cod";
?>
<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 12">
<meta name=Originator content="Microsoft Word 12">
<link id=Main-File rel=Main-File href="../INFORME.htm">
<o:SmartTagType namespaceuri="urn:schemas-microsoft-com:office:smarttags"
 name="PersonName"/>
<!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="3074"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
</head>

<body lang=ES-TRAD link=blue vlink=purple>

<div style='mso-element:footnote-separator' id=fs>

<p class=MsoNormal><span lang=ES><span style='mso-special-character:footnote-separator'><![if !supportFootnotes]>

<hr align=left size=1 width="33%">

<![endif]></span></span></p>

</div>

<div style='mso-element:footnote-continuation-separator' id=fcs>

<p class=MsoNormal><span lang=ES><span style='mso-special-character:footnote-continuation-separator'><![if !supportFootnotes]>

<hr align=left size=1>

<![endif]></span></span></p>

</div>

<div style='mso-element:endnote-separator' id=es>

<p class=MsoNormal><span lang=ES><span style='mso-special-character:footnote-separator'><![if !supportFootnotes]>

<hr align=left size=1 width="33%">

<![endif]></span></span></p>

</div>

<div style='mso-element:endnote-continuation-separator' id=ecs>

<p class=MsoNormal><span lang=ES><span style='mso-special-character:footnote-continuation-separator'><![if !supportFootnotes]>

<hr align=left size=1>

<![endif]></span></span></p>

</div>

<div style='mso-element:header' id=h1>

<p class=MsoHeader align=center style='margin-left:-21.3pt;text-align:center;
tab-stops:center 212.6pt left 233.55pt center 250.3pt right 425.2pt'><span
lang=ES style='font-size:13.0pt'><!--[if gte vml 1]><v:shapetype id="_x0000_t75"
 coordsize="21600,21600" o:spt="75" o:preferrelative="t" path="m@4@5l@4@11@9@11@9@5xe"
 filled="f" stroked="f">
 <v:stroke joinstyle="miter"/>
 <v:formulas>
  <v:f eqn="if lineDrawn pixelLineWidth 0"/>
  <v:f eqn="sum @0 1 0"/>
  <v:f eqn="sum 0 0 @1"/>
  <v:f eqn="prod @2 1 2"/>
  <v:f eqn="prod @3 21600 pixelWidth"/>
  <v:f eqn="prod @3 21600 pixelHeight"/>
  <v:f eqn="sum @0 0 1"/>
  <v:f eqn="prod @6 1 2"/>
  <v:f eqn="prod @7 21600 pixelWidth"/>
  <v:f eqn="sum @8 21600 0"/>
  <v:f eqn="prod @7 21600 pixelHeight"/>
  <v:f eqn="sum @10 21600 0"/>
 </v:formulas>
 <v:path o:extrusionok="f" gradientshapeok="t" o:connecttype="rect"/>
 <o:lock v:ext="edit" aspectratio="t"/>
</v:shapetype><v:shape id="_x0000_i1025" type="#_x0000_t75" style='width:194.25pt;
 height:77.25pt'>
 <v:imagedata src="image001.jpg" o:title="image001"/>
</v:shape><![endif]--><span style='mso-no-proof:yes'><!--[if gte vml 1]><v:shapetype
 id="_x0000_t202" coordsize="21600,21600" o:spt="202" path="m,l,21600r21600,l21600,xe">
 <v:stroke joinstyle="miter"/>
 <v:path gradientshapeok="t" o:connecttype="rect"/>
</v:shapetype><v:shape id="_x0000_s1027" type="#_x0000_t202" style='position:absolute;
 left:0;text-align:left;margin-left:-54pt;margin-top:9.95pt;width:110.9pt;
 height:27pt;z-index:1;mso-position-horizontal-relative:text;
 mso-position-vertical-relative:text' filled="f" stroked="f">
 <v:textbox style='mso-next-textbox:#_x0000_s1027'>
  <![if !mso]>
  <table cellpadding=0 cellspacing=0 width="100%">
   <tr>
    <td><![endif]>
    <div>
    <p class=MsoNormal><span lang=ES style='mso-bidi-font-size:6.0pt'><o:p>&nbsp;</o:p></span></p>
    </div>
    <![if !mso]></td>
   </tr>
  </table>
  <![endif]></v:textbox>
</v:shape><![endif]--></span><o:p></o:p></span></p>

</div>

<div style='mso-element:footer' id=f1>

<p class=MsoHeader align=center style='margin-top:0cm;margin-right:63.75pt;
margin-bottom:0cm;margin-left:63.8pt;margin-bottom:.0001pt;text-align:center'><span
lang=ES style='font-size:10.0pt;color:gray'><o:p>&nbsp;</o:p></span><span lang=ES style='font-size:10.0pt;color:gray'><o:p></o:p></span><span style='font-size:8.0pt;font-family:Verdana'><!--[if gte vml 1]><v:shape id="_x0000_s1026"
 type="#_x0000_t75" style='position:absolute;left:0;text-align:left;
 margin-left:370.25pt;margin-top:718.2pt;width:120pt;height:5pt;z-index:-2;
 mso-position-horizontal-relative:text;mso-position-vertical-relative:page'>
 <v:imagedata src="test.php?nur=<?php echo $codi;?>" o:title="slogan"/>
 <w:wrap anchory="page"/>
</v:shape><![endif]--><o:p></o:p></span></p>

<div style='mso-element:para-border-div;border:none;border-top:solid windowtext 1.0pt;
mso-border-top-alt:solid windowtext .5pt;padding:1.0pt 0cm 0cm 0cm;margin-left:
-14.2pt;margin-right:0cm'>

<p class=MsoFooter align=center style='text-align:center;border:none;
mso-border-top-alt:solid windowtext .5pt;padding:0cm;mso-padding-alt:1.0pt 0cm 0cm 0cm'><i
style='mso-bidi-font-style:normal'><span lang=ES style='font-size:7.0pt;
mso-bidi-font-size:12.0pt;font-family:"Arial","sans-serif";color:#999999'>Av.
Mariscal Santa Cruz, Edificio Palacio de Comunicaciones Piso 20 – teléfonos (
2124935 – 40)<span style='mso-spacerun:yes'>  </span>-<span
style='mso-spacerun:yes'>  </span><u><o:p></o:p></u></span></i></p>

<p class=MsoFooter style='tab-stops:51.35pt center 212.6pt 221.0pt right 425.2pt;
border:none;mso-border-top-alt:solid windowtext .5pt;padding:0cm;mso-padding-alt:
1.0pt 0cm 0cm 0cm'><i style='mso-bidi-font-style:normal'><span lang=ES
style='font-size:7.0pt;mso-bidi-font-size:12.0pt;font-family:"Arial","sans-serif";
color:#999999'><span style='mso-tab-count:2'>                                                                                 </span></span></i><i
style='mso-bidi-font-style:normal'><span lang=EN-GB style='font-size:7.0pt;
mso-bidi-font-size:12.0pt;font-family:"Arial","sans-serif";color:#999999;
mso-ansi-language:EN-GB'> Casilla 1868<o:p></o:p></span></i></p>

<p class=MsoFooter align=center style='text-align:center;border:none;
mso-border-top-alt:solid windowtext .5pt;padding:0cm;mso-padding-alt:1.0pt 0cm 0cm 0cm'><st1:PersonName
ProductID="La Paz" w:st="on"><i style='mso-bidi-font-style:normal'><span
 lang=ES style='font-size:7.0pt;mso-bidi-font-size:12.0pt;font-family:"Arial","sans-serif";
 color:#999999'>La Paz</span></i></st1:PersonName><i style='mso-bidi-font-style:
normal'><span lang=ES style='font-size:7.0pt;mso-bidi-font-size:12.0pt;
font-family:"Arial","sans-serif";color:#999999'> - Bolivia<o:p></o:p></span></i></p>

</div>

<p class=MsoFooter><span lang=ES><o:p>&nbsp;</o:p></span></p>

</div>

</body>

</html>
