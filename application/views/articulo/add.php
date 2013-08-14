<div class="post hentry">
<div class="posttop">
    <h2 class="posttitle"><a rel="external nofollow" target="_blank" href="">Lista de Productos:</a></h2>
<div class="postmetatop"><?php echo date('d M Y')?> </div><!-- /postmetatop -->
</div><!-- /posttop -->

<div class="postcontent">
<form action="<?php echo URL::base().'articulos/guardar';?>" method="post" id="nuevo">
<table class="nuevo">
<tr>
<td><label>ARTICULO: </label></td>
<td colspan="5"><input name="nombre" id="nombre" type="text" class="required" size="110" title="(*)" /></td>
</tr>

<tr>
<td><label>DESCRIPCION: </label></td>
<td colspan="4" ><textarea name="detalle" cols="70" id="detalle" class="jquery_ckeditor" rows="4" title="(*)" ></textarea></td>
<td align="right" colspan="4" >
<img src="../images/sinfoto.png" width="200" height="200" id="urlImagen" alt="" /><br/>
<a href="#" id="cambiarImagen">Cambiar Imagen</a></td>
</tr>

<tr>
<td><label>RUBRO:</label></td>
<td><select title="(*)" name="rubro" id="rubro" class="required" >
<?php foreach ($rubros as $r):?>
<option value="<?php echo $r->id;?>"><?php echo $r->rubro;?></option>
<?php endforeach;?>
</select></td>
</tr>

<tr>
<td><label>MARCA:</label></td>
<td><select name="marca" id="marca" class="required" title="(*)" >
<option value=""></option>
<?php foreach($marcas as $m): ?>
<option class="<?php echo $m->idRubro; ?>" alt="<?php echo $m->ganancia; ?>" value="<?php echo $m->id;?>"><?php echo $m->marca;?></option>
<?php endforeach;?>
</select></td>

<td><label>PROVEEDOR:</label></td>
<td ><select title="(*)" name="proveedor" id="proveedor" class="required" >
<option value=""></option>
<?php foreach($proveedores as $p): ?>
<option class="<?php echo $m->idRubro; ?>" value="<?php echo $p->id;?>"><?php echo $p->proveedor;?></option>
<?php endforeach;?>
</select></td>
</tr>
<tr>
    <td><label>PRESENTAC&Oacute;XN:</label></td>
    <td>
        <select title="(*)" name="presentacion" id="presentacion" class="required" >
        <?php foreach($presentaciones as $p): ?>
        <option class="<?php echo $p->idRubro; ?>" value="<?php echo $p->id;?>"><?php echo $p->presentacion;?></option>
        <?php endforeach;?>
        </select> &nbsp; X <input type="text" name="unidadesCaja" id="ünidadesCaja" value="1" size="5" />&nbsp; <select title="(*)" name="unidad" id="unidad" class="required" >
<option value="0">Seleccione..</option>
<?php foreach($unidades as $u): ?>
<option class="<?php echo $u->idRubro;?>" value="<?php echo $u->id;?>"><?php echo $u->unidad;?></option>
<?php endforeach;?>
</select>
    </td>
<td><label>STOCK MINIMO: </label ></td>
<td><input name="stockMinimo" id="stockMinimo" size="4" value="0" class="required number monto "  /></td>
</tr>

<tr>
<td><label>PRECIO DE COMPRA UNITARIO:</label></td>
<td><input type="text" name="precioCompra" id="precioCompra" size="10" class="required  number monto" title="Costo de compra del articulo"  />
<select name="moneda" id="moneda" class="required  "  >
<?php foreach($monedas as $m): ?>
<option value="<?php echo $m->id;?>"><?php echo $m->abreviatura;?></option>
<?php endforeach;?>
</select></td>

<td><label>GANACIA(%):</label></td><td><input type="text" name="ganancia" id="ganancia" value="30" size="5" class="required number monto" title="% de ganancia"  /></td>
</tr>
<tr>
    <td><label>IVA(%): </label></td><td><input name="iva" id="iva" value="13" size="10" class="required number monto" /></td>
<td><label>UBICACION FISICA: </label></td>
<td>
    <select name="ubicacion" id="ubicacion" class="required"  >
    <?php foreach($ubicaciones as $u): ?>
    <option value="<?php echo $u->id;?>"><?php echo $u->ubicacion;?></option>
    <?php endforeach;?>
    </select>
</td>
</tr>
<input type="hidden" name="urlFoto" id="urlFoto" value="../images/sinfoto.png" />
</table><hr/>
<label></label><input type="submit" class="boton" value="Crear Proyecto"><input type="reset" value="Resetear Campos" class="boton">
</form>
</div>
</div>

<p style="margin: 0cm 0cm 0pt" class="MsoNormal"><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES" lang="ES">De mi consideraci&oacute;n:</span><o:p></o:p></p>
<p style="text-align: justify; margin: 0cm 0cm 0pt" class="MsoNormal"><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES" lang="ES">&nbsp;</span><o:p></o:p></p>
<p style="margin: 0cm 0cm 0pt" class="MsoNormal"><strong><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-bidi-font-weight: normal; mso-fareast-language: ES-BO" lang="ES">ANTECEDENTES</span></strong><o:p></o:p></p>
<p style="margin: 0cm 0cm 0pt" class="MsoNormal"><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-fareast-language: ES-BO" lang="ES">&nbsp;</span><o:p></o:p></p>
<p style="text-align: justify; margin: 0cm 0cm 0pt" class="MsoNormal"><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-fareast-language: ES-BO" lang="ES">Hoja de Seguimiento Interno <strong><span style="font-family: Verdana; mso-bidi-font-weight: normal">NURI I/2011-01625</span></strong>, mediante la cual. el Lic. Ariel Zabala David, Director General de Planificaci&oacute;n,&nbsp;solicita la contrataci&oacute;n &nbsp;de consultor en l&iacute;nea como <strong><span style="font-family: Verdana; mso-bidi-font-weight: normal">&ldquo;Consultor en L&iacute;nea - Analista de Sistemas de Informaci&oacute;n Geogr&aacute;fica (SIG) y Teledetecci&oacute;n para el Desarrollo del SITAP&nbsp;&quot;</span></strong>. La solicitud se encuentra respaldada con nota interna NI/MDP/DPL/2011-0046 y t&eacute;rminos de referencia,<span style="mso-spacerun: yes">&nbsp; </span>los cuales fueron remitidos a <st1:personname w:st="on" productid="la Unidad">la Unidad</st1:personname> de Recursos Humanos para la elaboraci&oacute;n de la equivalencia salarial.</span><o:p></o:p></p>
<p style="text-align: justify; margin: 0cm 0cm 0pt" class="MsoNormal"><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES" lang="ES">&nbsp;</span><o:p></o:p></p>
<p style="text-align: justify; margin: 0cm 0cm 0pt" class="MsoNormal"><strong><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-bidi-font-weight: normal; mso-fareast-language: ES-BO" lang="ES">ANALISIS</span></strong></p>
<p style="text-align: justify; margin: 0cm 0cm 0pt" class="MsoNormal"><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-fareast-language: ES-BO" lang="ES">&nbsp;</span><o:p></o:p></p>
<p style="text-align: justify; margin: 0cm 0cm 0pt" class="MsoNormal"><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-fareast-language: ES-BO" lang="ES">Para establecer la viabilidad de la solicitud, se examin&oacute;&nbsp;<strong><span style="font-family: Verdana; mso-bidi-font-weight: normal">&quot;La&nbsp;Escala&nbsp;&nbsp; de Equivalencias Salariales para Consultorias Individuales del Ministerio de Desarrollo Productivo y Econom&iacute;a Plural&quot;</span></strong> aprobada seg&uacute;n Resoluci&oacute;n Ministerial <strong><span style="font-family: Verdana; mso-bidi-font-weight: normal">MDPyEP/DESPACHO/No.171/2009</span></strong>.</span><o:p></o:p></p>
<p style="text-align: justify; margin: 0cm 0cm 0pt" class="MsoNormal"><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES" lang="ES">&nbsp;</span><o:p></o:p></p>
<p style="text-align: justify; margin: 0cm 0cm 0pt" class="MsoNormal"><strong><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-bidi-font-weight: normal; mso-fareast-language: ES-BO" lang="ES">CONCLUSION</span></strong><o:p></o:p></p>
<p style="text-align: justify; margin: 0cm 0cm 0pt" class="MsoNormal"><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-fareast-language: ES-BO" lang="ES">&nbsp;</span><o:p></o:p></p>
<p style="text-align: justify; margin: 0cm 0cm 0pt" class="MsoNormal"><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-fareast-language: ES-BO" lang="ES">De la revisi&oacute;n de <st1:personname w:st="on" productid="la Escala">la Escala</st1:personname>&nbsp; salarial del Ministerio de Desarrollo Productivo y Econom&iacute;a Plural, se tiene el siguiente cuadro, para su consideraci&oacute;n:&nbsp;</span><o:p></o:p></p>
<p style="text-align: justify; margin: 0cm 0cm 0pt" class="MsoNormal"><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-fareast-language: ES-BO" lang="ES">&nbsp;</span><o:p></o:p></p>
<p style="text-align: justify; margin: 0cm 0cm 0pt" class="MsoNormal"><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-fareast-language: ES-BO" lang="ES">&nbsp;</span><o:p></o:p></p>
<table style="margin: auto auto auto 10.6pt; width: 479.65pt; border-collapse: collapse; mso-yfti-tbllook: 1184; mso-padding-alt: 0cm 0cm 0cm 0cm" class="MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="640">
    <tbody>
        <tr style="height: 15.3pt; mso-yfti-irow: 0; mso-yfti-firstrow: yes">
            <td style="border-bottom: windowtext 1pt solid; border-left: windowtext 1pt solid; padding-bottom: 0cm; background-color: transparent; padding-left: 3.5pt; width: 98pt; padding-right: 3.5pt; height: 15.3pt; border-top: windowtext 1pt solid; border-right: windowtext 1pt solid; padding-top: 0cm" valign="top" width="131">
            <p style="text-align: justify; margin: 0cm 0cm 0pt; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto" class="MsoNormal"><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-fareast-language: ES-BO" lang="ES">&nbsp;</span><strong><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-bidi-font-weight: normal" lang="ES">NURI - MONTO (BS.)</span></strong><o:p></o:p></p>
            </td>
            <td style="border-bottom: windowtext 1pt solid; border-left: #d4d0c8; padding-bottom: 0cm; background-color: transparent; padding-left: 3.5pt; width: 195.65pt; padding-right: 3.5pt; height: 15.3pt; border-top: windowtext 1pt solid; border-right: windowtext 1pt solid; padding-top: 0cm" valign="top" width="261">
            <p style="text-align: center; margin: 0cm 0cm 0pt; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto" class="MsoNormal" align="center"><strong><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-bidi-font-weight: normal" lang="ES">CARGO</span></strong><o:p></o:p></p>
            </td>
            <td style="border-bottom: windowtext 1pt solid; border-left: #d4d0c8; padding-bottom: 0cm; background-color: transparent; padding-left: 3.5pt; width: 186pt; padding-right: 3.5pt; height: 15.3pt; border-top: windowtext 1pt solid; border-right: windowtext 1pt solid; padding-top: 0cm" valign="top" width="248">
            <p style="text-align: justify; margin: 0cm 0cm 0pt; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto" class="MsoNormal"><strong><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-bidi-font-weight: normal" lang="ES">OBSERVACIONES</span></strong><o:p></o:p></p>
            </td>
        </tr>
        <tr style="height: 15.3pt; mso-yfti-irow: 1; mso-yfti-lastrow: yes">
            <td style="border-bottom: windowtext 1pt solid; border-left: windowtext 1pt solid; padding-bottom: 0cm; background-color: transparent; padding-left: 3.5pt; width: 98pt; padding-right: 3.5pt; height: 15.3pt; border-top: #d4d0c8; border-right: windowtext 1pt solid; padding-top: 0cm" valign="top" width="131">
            <p style="text-align: justify; margin: 0cm 0cm 0pt; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto" class="MsoNormal"><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-fareast-language: ES-BO" lang="ES">&nbsp;</span><strong><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-bidi-font-weight: normal" lang="ES">NURI</span></strong><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-fareast-language: ES-BO" lang="ES">&nbsp;I/2011-001625</span></p>
            <p style="text-align: justify; margin: 0cm 0cm 0pt; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto" class="MsoNormal"><strong><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-bidi-font-weight: normal" lang="ES">MONTO </span></strong><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-fareast-language: ES-BO" lang="ES">Bs. 9000.-</span><o:p></o:p></p>
            </td>
            <td style="border-bottom: windowtext 1pt solid; border-left: #d4d0c8; padding-bottom: 0cm; background-color: transparent; padding-left: 3.5pt; width: 195.65pt; padding-right: 3.5pt; height: 15.3pt; border-top: #d4d0c8; border-right: windowtext 1pt solid; padding-top: 0cm" valign="top" width="261">
            <p style="text-align: justify; margin: 0cm 0cm 0pt; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto" class="MsoNormal"><strong><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-fareast-language: ES-BO" lang="ES">&quot;&nbsp;&nbsp;Consultor en L&iacute;nea -&nbsp;&nbsp;&nbsp;Analista de Sistemas de Informaci&oacute;n Geogr&aacute;fica (SIG) y Teledetecci&oacute;n para el Desarrollo del SITAP&nbsp;</span></strong><strong><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-bidi-font-weight: normal; mso-fareast-language: ES-BO" lang="ES">&nbsp;&rdquo;</span></strong><o:p></o:p></p>
            </td>
            <td style="border-bottom: windowtext 1pt solid; border-left: #d4d0c8; padding-bottom: 0cm; background-color: transparent; padding-left: 3.5pt; width: 186pt; padding-right: 3.5pt; height: 15.3pt; border-top: #d4d0c8; border-right: windowtext 1pt solid; padding-top: 0cm" valign="top" width="248">
            <p style="text-align: justify; margin: 0cm 0cm 0pt; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto" class="MsoNormal"><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-fareast-language: ES-BO" lang="ES">- El Monto de la consultor&iacute;a&nbsp;se&nbsp;&nbsp; encuentra dentro&nbsp; <st1:personname w:st="on" productid="la Escala">la Escala</st1:personname>&nbsp;Salarial aprobada por el MDPyEP.</span><o:p></o:p></p>
            </td>
        </tr>
    </tbody>
</table>
<p style="text-align: justify; margin: 0cm 0cm 0pt" class="MsoNormal"><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-fareast-language: ES-BO" lang="ES">&nbsp;</span><o:p></o:p></p>
<p style="text-align: justify; margin: 0cm 0cm 0pt" class="MsoNormal"><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-fareast-language: ES-BO" lang="ES">&nbsp;</span><o:p></o:p></p>
<p style="text-align: justify; margin: 0cm 0cm 0pt" class="MsoNormal"><span style="font-family: Verdana; font-size: 10pt; mso-ansi-language: ES; mso-fareast-language: ES-BO" lang="ES">Con este motivo, saludo a usted, atentamente.</span><o:p></o:p></p>
<p style="margin: 0cm 0cm 0pt" class="MsoNormal"><o:p><font size="3" face="Times New Roman">&nbsp;</font></o:p></p>