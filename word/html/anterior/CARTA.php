<?php
header("Content-type: application/msword");
header("Content-Disposition: attachment; filename=carta.doc");
	//header("Content-type: application/msword");
?>
<html>
<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 12">
<meta name=Originator content="Microsoft Word 12">
<link rel=File-List href="CARTA_archivos/filelist.xml">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
w\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<?php
require_once('dbclass.php');
$dbh=New db();
$id=$_GET['id'];
$stmt = $dbh->prepare("SELECT * FROM documentos WHERE id='$id'");        
$stmt->execute();        
while ($res = $stmt->fetch(PDO::FETCH_OBJ)) {       
$codigo=$res->codigo;
$oficina=$res->id_oficina;
$nur=$res->nur;
$tama='aa';
$membrete='';
?>
<title><? echo $codigo; ?></title>
<o:SmartTagType namespaceuri="urn:schemas-microsoft-com:office:smarttags"
 name="PersonName"/>
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>WinuE</o:Author>
  <o:LastAuthor>WinuE</o:LastAuthor>
  <o:Revision>2</o:Revision>
  <o:TotalTime>4</o:TotalTime>
  <o:LastPrinted>2009-06-04T15:10:00Z</o:LastPrinted>
  <o:Created>2009-08-03T21:22:00Z</o:Created>
  <o:LastSaved>2009-08-03T21:22:00Z</o:LastSaved>
  <o:Pages>1</o:Pages>
  <o:Words>125</o:Words>
  <o:Characters>690</o:Characters>
  <o:Company>Windows uE</o:Company>
  <o:Lines>5</o:Lines>
  <o:Paragraphs>1</o:Paragraphs>
  <o:CharactersWithSpaces>814</o:CharactersWithSpaces>
  <o:Version>12.00</o:Version>
 </o:DocumentProperties>
</xml><![endif]-->

<!--<link rel=themeData href="CARTA_archivos/themedata.thmx">
<link rel=colorSchemeMapping href="CARTA_archivos/colorschememapping.xml">--!>

<!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:TrackMoves>false</w:TrackMoves>
  <w:TrackFormatting/>
  <w:HyphenationZone>21</w:HyphenationZone>
  <w:PunctuationKerning/>
  <w:ValidateAgainstSchemas/>
  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>
  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
  <w:DoNotPromoteQF/>
  <w:LidThemeOther>ES-TRAD</w:LidThemeOther>
  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>
  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>
  <w:Compatibility>
   <w:BreakWrappedTables/>
   <w:SnapToGridInCell/>
   <w:WrapTextWithPunct/>
   <w:UseAsianBreakRules/>
   <w:DontGrowAutofit/>
   <w:DontUseIndentAsNumberingTabStop/>
   <w:FELineBreak11/>
   <w:WW11IndentRules/>
   <w:DontAutofitConstrainedTables/>
   <w:AutofitLikeWW11/>
   <w:HangulWidthLikeWW11/>
   <w:UseNormalStyleForList/>
  </w:Compatibility>
  <w:BrowserLevel>MicrosoftInternetExplorer4</w:BrowserLevel>
  <m:mathPr>
   <m:mathFont m:val="Cambria Math"/>
   <m:brkBin m:val="before"/>
   <m:brkBinSub m:val="&#45;-"/>
   <m:smallFrac m:val="off"/>
   <m:dispDef/>
   <m:lMargin m:val="0"/>
   <m:rMargin m:val="0"/>
   <m:defJc m:val="centerGroup"/>
   <m:wrapIndent m:val="1440"/>
   <m:intLim m:val="subSup"/>
   <m:naryLim m:val="undOvr"/>
  </m:mathPr></w:WordDocument>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="false"
  DefSemiHidden="false" DefQFormat="false" LatentStyleCount="267">
  <w:LsdException Locked="false" QFormat="true" Name="Normal"/>
  <w:LsdException Locked="false" QFormat="true" Name="heading 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 7"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 8"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 9"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="caption"/>
  <w:LsdException Locked="false" QFormat="true" Name="Title"/>
  <w:LsdException Locked="false" QFormat="true" Name="Subtitle"/>
  <w:LsdException Locked="false" Priority="22" QFormat="true" Name="Strong"/>
  <w:LsdException Locked="false" QFormat="true" Name="Emphasis"/>
  <w:LsdException Locked="false" Priority="99" SemiHidden="true"
   Name="Placeholder Text"/>
  <w:LsdException Locked="false" Priority="1" QFormat="true" Name="No Spacing"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 1"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="99" SemiHidden="true" Name="Revision"/>
  <w:LsdException Locked="false" Priority="34" QFormat="true"
   Name="List Paragraph"/>
  <w:LsdException Locked="false" Priority="29" QFormat="true" Name="Quote"/>
  <w:LsdException Locked="false" Priority="30" QFormat="true"
   Name="Intense Quote"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 1"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 1"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 2"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 2"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 2"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 3"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 3"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 3"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 4"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 4"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 4"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 5"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 5"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 5"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 6"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 6"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 6"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="19" QFormat="true"
   Name="Subtle Emphasis"/>
  <w:LsdException Locked="false" Priority="21" QFormat="true"
   Name="Intense Emphasis"/>
  <w:LsdException Locked="false" Priority="31" QFormat="true"
   Name="Subtle Reference"/>
  <w:LsdException Locked="false" Priority="32" QFormat="true"
   Name="Intense Reference"/>
  <w:LsdException Locked="false" Priority="33" QFormat="true" Name="Book Title"/>
  <w:LsdException Locked="false" Priority="37" SemiHidden="true"
   UnhideWhenUsed="true" Name="Bibliography"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="TOC Heading"/>
 </w:LatentStyles>
</xml><![endif]--><!--[if !mso]><object
 classid="clsid:38481807-CA0E-42D2-BF39-B33AF135CC4D" id=ieooui></object>
<style>
st1\:*{behavior:url(#ieooui) }
</style>
<![endif]-->
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Wingdings;
	panose-1:5 0 0 0 0 0 0 0 0 0;
	mso-font-charset:2;
	mso-generic-font-family:auto;
	mso-font-format:other;
	mso-font-pitch:variable;
	mso-font-signature:0 268435456 0 0 -2147483648 0;}
@font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:-1610611985 1107304683 0 0 159 0;}
@font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:1627400839 -2147483648 8 0 66047 0;}
@font-face
	{font-family:Verdana;
	panose-1:2 11 6 4 3 5 4 4 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:536871559 0 0 0 415 0;}
@font-face
	{font-family:"Book Antiqua";
	panose-1:2 4 6 2 5 3 5 3 3 4;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:647 0 0 0 159 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:"Times New Roman";
	mso-ansi-language:ES;
	mso-fareast-language:ES;}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{mso-style-unhide:no;
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	tab-stops:center 212.6pt right 426.2pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:"Times New Roman";
	mso-ansi-language:ES;
	mso-fareast-language:ES;}
p.MsoFooter, li.MsoFooter, div.MsoFooter
	{mso-style-unhide:no;
	margin:0cm;
	margin-bottom:.0001pt;
        margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:14.2pt;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	tab-stops:center 212.6pt right 426.2pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:"Times New Roman";
	mso-ansi-language:ES;
	mso-fareast-language:ES;}
p.MsoBodyTextIndent, li.MsoBodyTextIndent, div.MsoBodyTextIndent
	{mso-style-unhide:no;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:14.2pt;
	margin-bottom:.0001pt;
	text-align:justify;
	mso-pagination:widow-orphan;
	tab-stops:16.0cm;
	font-size:10.0pt;
	font-family:"Tahoma","sans-serif";
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-language:ES;}
a:link, span.MsoHyperlink
	{mso-style-unhide:no;
	color:blue;
	text-decoration:underline;
	text-underline:single;}
a:visited, span.MsoHyperlinkFollowed
	{mso-style-unhide:no;
	color:purple;
	mso-themecolor:followedhyperlink;
	text-decoration:underline;
	text-underline:single;}
 /* Page Definitions */
 @page
	{mso-footnote-separator:url("http://paperwork.localhost/word/CARTA_archivos/header.php?codigo=<?=$codigo?>&nur=<?=$nur;?>&ofi=<?php echo $oficina;?>") fs;
	mso-footnote-continuation-separator:url("http://paperwork.localhost/word/CARTA_archivos/header.php?codigo=<?=$codigo?>&nur=<?=$nur;?>&ofi=<?php echo $oficina;?>") fcs;
	mso-endnote-separator:url("http://paperwork.localhost/word/CARTA_archivos/header.php?codigo=<?=$codigo?>&nur=<?=$nur;?>&ofi=<?php echo $oficina;?>") es;
	mso-endnote-continuation-separator:url("http://paperwork.localhost/word/CARTA_archivos/header.php?codigo=<?=$codigo?>&nur=<?=$nur;?>&ofi=<?php echo $oficina;?>") ecs;}
@page Section1
{size:612.1pt 795.1pt;
	margin:2.5cm 2.5cm 2.5cm 3.0cm;
	mso-header-margin:.5cm;
	mso-footer-margin:.5cm;	
	mso-header:url("http://paperwork.localhost/word/CARTA_archivos/header.php?codigo=<?=$codigo?>&nur=<?php echo $nur;?>&ofi=<?php echo $oficina;?>") h1;
	mso-footer:url("http://paperwork.localhost/word/CARTA_archivos/header.php?codigo=<?=$codigo?>&nur=<?php echo $nur;?>&ofi=<?php echo $oficina;?>") f1;
	mso-paper-source:0;}
div.Section1
	{page:Section1;}
 /* List Definitions */
 @list l0
	{mso-list-id:104739217;
	mso-list-type:hybrid;
	mso-list-template-ids:1765423982 67764225 67764227 67764229 67764225 67764227 67764229 67764225 67764227 67764229;}
@list l0:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l1
	{mso-list-id:504980527;
	mso-list-type:hybrid;
	mso-list-template-ids:869046736 67764225 67764227 67764229 67764225 67764227 67764229 67764225 67764227 67764229;}
@list l1:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:63.0pt;
	mso-level-number-position:left;
	margin-left:63.0pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l2
	{mso-list-id:573514221;
	mso-list-type:hybrid;
	mso-list-template-ids:1813919432 67764225 67764227 67764229 67764225 67764227 67764229 67764225 67764227 67764229;}
@list l2:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:63.0pt;
	mso-level-number-position:left;
	margin-left:63.0pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l3
	{mso-list-id:883057570;
	mso-list-type:hybrid;
	mso-list-template-ids:-759267432 -872367158 201981977 201981979 201981967 201981977 201981979 201981967 201981977 201981979;}
@list l3:level1
	{mso-level-start-at:29;
	mso-level-number-format:alpha-lower;
	mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l4
	{mso-list-id:1277173557;
	mso-list-type:hybrid;
	mso-list-template-ids:1401326406 67764239 67764249 67764251 67764239 67764249 67764251 67764239 67764249 67764251;}
@list l4:level1
	{mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
ol
	{margin-bottom:0cm;}
ul
	{margin-bottom:0cm;}
-->
</style>
<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:"Tabla normal";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-unhide:no;
	mso-style-parent:"";
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Times New Roman","serif";}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="3074"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="2"/>
 </o:shapelayout></xml><![endif]-->
</head>

<body lang=ES-TRAD link=blue vlink=purple style='tab-interval:35.4pt'>

<div class=Section1>

<p class=MsoNormal><span lang=ES style='font-size:10.0pt;mso-bidi-font-size:
12.0pt;font-family:"Verdana","sans-serif"'><?php if ($regional='OR'){
	$regional=substr($oficina,2,$tama-1);
	if ($regional=='SC')
		echo"Santa Cruz, ";
	if ($regional=='BN')
		echo"Beni, ";
	if ($regional=='CB')
		echo"Cochabamba, ";
	if ($regional=='CH')
		echo"Chuquisaca, ";
	if ($regional=='LP')
		echo"La Paz, ";
	if ($regional=='OR')
		echo"Oruro, ";
	if ($regional=='PD')
		echo"Pando, ";
	if ($regional=='PT')
		echo"Potos�, ";
	if ($regional=='TJ')
		echo"Tarija, ";
	if ($regional=='SR')
		echo"San Ram�n, ";
}else{
	echo "La Paz, ";
}
?><?
	//$fecha= DevolverFecha ($res->fecha, $in=0, $id=1, $im=1, $ia=1, $ih=0, $imin=0, $largo=1, $carfecha = '-', $orden = 2);
echo $res->fecha_creacion;
   
?></span></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span lang=ES
style='font-size:10.0pt;mso-bidi-font-size:12.0pt;font-family:"Verdana","sans-serif"'><? echo $res->codigo; ?></span></b></p>

<p class=MsoNormal><span lang=ES style='font-size:10.0pt;mso-bidi-font-size:
12.0pt;font-family:"Verdana","sans-serif";color:silver'>&nbsp;</span></p>

<p class=MsoNormal><span lang=ES style='font-size:10.0pt;mso-bidi-font-size:
12.0pt;font-family:"Verdana","sans-serif";color:silver'>&nbsp;</span></p>

<p class=MsoNormal><span lang=ES style='font-size:10.0pt;mso-bidi-font-size:
12.0pt;font-family:"Verdana","sans-serif";color:silver'>&nbsp;</span></p>

<p class=MsoNormal><span lang=ES style='font-size:10.0pt;mso-bidi-font-size:
12.0pt;font-family:"Verdana","sans-serif";color:silver'>&nbsp;</span></p>

<p class=MsoNormal><span lang=ES style='font-size:10.0pt;mso-bidi-font-size:
12.0pt;font-family:"Verdana","sans-serif";color:silver'>&nbsp;</span></p>

<p class=MsoNormal><span lang=ES style='font-size:10.0pt;mso-bidi-font-size:
12.0pt;font-family:"Verdana","sans-serif"'><?php echo $res->titulo;?></span></p>

<p class=MsoNormal><span lang=ES style='font-size:10.0pt;mso-bidi-font-size:
12.0pt;font-family:"Verdana","sans-serif"'><? echo $res->nombre_destinatario; ?></span></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span lang=ES
style='font-size:10.0pt;mso-bidi-font-size:12.0pt;font-family:"Verdana","sans-serif"'><? echo $res->cargo_destinatario; ?></span></b></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span lang=ES
style='font-size:10.0pt;mso-bidi-font-size:12.0pt;font-family:"Verdana","sans-serif"'><? echo $res->institucion_destinatario; ?></span></b></p>

<p class=MsoNormal><span lang=ES style='font-size:10.0pt;mso-bidi-font-size:
12.0pt;font-family:"Verdana","sans-serif"'>Presente.- </span></p>

<p class=MsoNormal><span lang=ES><br>
</span><span lang=ES style='font-size:10.0pt;mso-bidi-font-size:12.0pt;
font-family:"Verdana","sans-serif"'>REF.:<span style='mso-tab-count:1'></span><strong><u><span
style='font-family:"Verdana","sans-serif"'><? echo $res->referencia; ?></span></u></strong></span></p>

<p class=MsoNormal align=right style='text-align:right'><span lang=ES
style='font-size:10.0pt;mso-bidi-font-size:12.0pt;font-family:"Verdana","sans-serif";
color:silver'>&nbsp;</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
10.0pt;font-family:"Verdana","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
10.0pt;font-family:"Verdana","sans-serif"'><? echo $res->contenido; ?></span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
10.0pt;font-family:"Verdana","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=ES><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
10.0pt;mso-bidi-font-size:12.0pt;font-family:"Verdana","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
10.0pt;mso-bidi-font-size:12.0pt;font-family:"Verdana","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
10.0pt;mso-bidi-font-size:12.0pt;font-family:"Verdana","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
10.0pt;mso-bidi-font-size:12.0pt;font-family:"Verdana","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
10.0pt;mso-bidi-font-size:12.0pt;font-family:"Verdana","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
10.0pt;mso-bidi-font-size:12.0pt;font-family:"Verdana","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
10.0pt;mso-bidi-font-size:12.0pt;font-family:"Verdana","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
10.0pt;mso-bidi-font-size:12.0pt;font-family:"Verdana","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
10.0pt;mso-bidi-font-size:12.0pt;font-family:"Verdana","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
10.0pt;mso-bidi-font-size:12.0pt;font-family:"Verdana","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
10.0pt;mso-bidi-font-size:12.0pt;font-family:"Verdana","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=ES
style='font-size:10.0pt;mso-bidi-font-size:12.0pt;font-family:"Verdana","sans-serif"'><? echo $res->nombre_remitente; ?></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=ES style='font-size:10.0pt;mso-bidi-font-size:12.0pt;
font-family:"Verdana","sans-serif"'><? echo $res->cargo_remitente; ?></span></b></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
10.0pt;mso-bidi-font-size:12.0pt;font-family:"Verdana","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span lang=ES style='font-size:10.0pt;mso-bidi-font-size:
12.0pt;font-family:"Verdana","sans-serif"'>&nbsp;</span></p>
<?
if ($res->adjuntos) 
{
?>
<p class=MsoNormal><span lang=EN-GB style='font-size:6.0pt;font-family:"Verdana","sans-serif";
mso-ansi-language:EN-GB'>Adj.: <? echo $res->adjuntos; ?></span></p>
<? } ?>
<? if ($res->copias) { ?>
<p class=MsoNormal><span lang=EN-GB style='font-size:6.0pt;font-family:"Verdana","sans-serif";
mso-ansi-language:EN-GB'>cc.: <? echo $res->copias; ?></span></p>
<? } ?>
<p class=MsoNormal><span lang=EN-GB style='font-size:6.0pt;font-family:"Verdana","sans-serif";
mso-ansi-language:EN-GB'><? // echo $res->mosca; ?></span><span lang=ES style='font-size:8.0pt;
font-family:"Arial","sans-serif"'><o:p></o:p></span></p>

</div>

</body>
<?php } ?>
</html>
