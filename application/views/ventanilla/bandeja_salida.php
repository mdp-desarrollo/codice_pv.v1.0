<script type="text/javascript">
    
    $(function(){
         $("div#entrada .bandeja").each(function(){
            var t = $(this).text().toLowerCase(); //all row text
         $("<table class='indexColumn'></table>")
            .hide().text(t).appendTo(this);
            });//each tr
         $("#FilterTextBox").keyup(function(){
            var s = $(this).val().toLowerCase().split(" ");
            //show all rows.
        $("div#entrada .bandeja:hidden").show();
        $.each(s, function(){
        $("div#entrada .bandeja .indexColumn:not(:contains('"
          + this + "'))").parent().hide();
   });//each
 });//key up.      
$(window).scroll(function(){
       var y = $(window).scrollTop(); 
       if(y>=290)
       {
        $('#opciones').addClass('fixed');
       }
       else
       {
        $('#opciones').removeClass('fixed');
       }
 });  
//modal
$('a.poplight[href^=#]').click(function() {
    var id_nur=$(this).attr('id_nur');
    var id_seg=$(this).attr('id_seg');
    var nur=$(this).attr('nuri');
    $('#id_nur').val(id_nur);
    $('#id_seg').val(id_seg);    
    $('#nur').val(nur);    
    $('#aceptar').attr('href','/ventanilla/cancelar/'+id_seg);
    $('h3.mensaje').text('Cancelar la derivación HS : '+nur);
    //$('a#aceptar').attr('href','/bandeja/responder/'+id_nur);
    var popID = $(this).attr('rel'); //Get Popup Name
    var popURL = $(this).attr('href'); //Get Popup href to define size

    //Pull Query & Variables from href URL
    var query= popURL.split('?');
    var dim= query[1].split('&');
    var popWidth = dim[0].split('=')[1]; //Gets the first query string value

    //Fade in the Popup and add close button
    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) });//.prepend('<a href="#" class="close"><img src="/media/images/close.gif" class="btn_close" title="Close Window" alt="Close" /></a>');

    //Define margin for center alignment (vertical   horizontal) - we add 80px to the height/width to accomodate for the padding  and border width defined in the css
    var popMargTop = ($('#' + popID).height() + 80) / 2;
    var popMargLeft = ($('#' + popID).width() + 80) / 2;

    //Apply Margin to Popup
    $('#' + popID).css({
        'margin-top' : -popMargTop,
        'margin-left' : -popMargLeft
    });

    //Fade in Background
    $('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
    $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer - .css({'filter' : 'alpha(opacity=80)'}) is used to fix the IE Bug on fading transparencies 

    return false;
});

//Close Popups and Fade Layer
$('a.close, #fade, #cancelar').live('click', function() { //When clicking on the close or fade layer...
    $('#fade , .popup_block').fadeOut(function() {
        $('#fade, a.close').remove();  //fade them both out
    });
    return false;
});          
    });
</script>
<style type="text/css">
    #fade { /*--Transparent background layer--*/
	display: none; /*--hidden by default--*/
	background: #000;
	position: fixed; left: 0; top: 0;
	width: 100%; height: 100%;
	opacity: .40;
	z-index: 9999;
}
.popup_block{
	display: none; /*--hidden by default--*/
	background: #fff;
	padding: 0;
	border: 1px solid #F3F3F5;
	float: left;
	font-size: 1.2em;
	position: fixed;
	top: 50%; left: 50%;
	z-index: 99999;
	/*--CSS3 Box Shadows--*/
	-webkit-box-shadow: 0px 0px 20px #000;
	-moz-box-shadow: 0px 0px 20px #000;
	box-shadow: 0px 0px 20px #000;
	/*--CSS3 Rounded Corners--*/
/*	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;*/
}
/*img.btn_close {
	float: right;
	margin: -10px -10px 0 0;
}
/*--Making IE6 Understand Fixed Positioning--*/
*html #fade {
	position: absolute;
}
*html .popup_block {
	position: absolute;
}
    div#nuevo{display: none;   }
    #new {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
    #new span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}  
input[type="text"]{ line-height: 20px; height: 20px; font-size: 14px;}    
.fixed{
    margin-left:7px;
    position: fixed;
    top: 20px;    
}
</style>
<h2 class="subtitulo">Bandeja de salida:<br/><span>Correspondencia enviada que aun no fue recibida por el destinatario</span></h2>
<div id="popup_name" class="popup_block">  
    <table id="theTable">
        <thead>
            <tr>
                <th><h3 class="mensaje" style="padding-left:0;"></h3></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><br/>
                    Click en Aceptar para cancelar derivaci&oacute;n.
                    <br/>
                    <br/>                    
                </td>
            </tr>
            <tr>
                <td style="height:40px; text-align: right; ">
                    <a href="" id="aceptar" class="uiButton" id="aceptar" >Aceptar</a>
                    <a href="#" id="cancelar" class="uiButton" >Cancelar</a>
                </td>
            </tr>
            
        </tbody>
    </table>
    
</div>
<?php if(sizeof($entrada)>0){?>
<p style="margin: 5px auto;"> <b>Filtrar/Buscar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="40" />
</p>
<p style="float:right;"><a href="#">I</a></p>
<div id="entrada">
    <h2 style=" text-align: center; color: #3263A0; text-transform: uppercase; font-size: 10px;">Lista de correspondencia enviada</h2>
    
    <?php foreach($entrada as $s): ?>
<div class="bandeja">
    <table class="oficial<?php echo $s->oficial;?>">
        <tr class="header">
            <td width="85" align="center"><a href="/seguimiento/id/<?php echo $s->nur;?>"<b style="font-size:12px;"><?php  echo $s->nur?></b></a></td>
            <td colspan="2"><?php echo $s->a_oficina; ?></td>            
            <td class="derecha"><?php $fecha =  new Controller_myClass($s->fecha); echo $fecha->larga();?></td>
            <td><?php if($s->hijo==1):?><a href="/bandeja/agrupado/<?php echo $s->nur;?>"><img src="/media/images/docs.gif" title="Agrupado" align="right"/></a><?php endif;?></td>
         </tr>         
        <tr>
            <td valign="bottom"  rowspan="2" class="nur<?php echo $s->oficial;?>" ><br/><br/><br/></td>
            <td><?php echo $s->nombre_receptor; ?><br/><b><?php echo $s->cargo_receptor; ?></b></td>            
            <td> <?php echo $s->accion; ?></td>
            <td><b>Documento: </b> <?php echo $s->codigo; ?></td>
                <td align="right">
                    <a href="#?=300" rel="popup_name" title="Cancelar derivacion" class="poplight uiButton" nur="<?php echo $s->id;?>" id_nur="<?php echo $s->nur;?>" hs="<?php echo $s->nur;?>"  id_seg="<?php echo $s->id;?>" nuri="<?php echo $s->nur?>"><img src="/media/images/reestablecer.png" align="absmiddle"  /> C</a>
                    <a href="/ventanilla/printDeriv/<?php echo $s->id;?>" title="Imprimir" class="uiButton" nur="<?php echo $s->id;?>"><img src="/media/images/print.png" align="absmiddle"  /> P</a>                   
                </td>
        </tr>
        <tr>
            <td colspan="5"><b>Proveido: </b><?php echo $s->proveido;?></td>
        </tr>
    </table>    
</div>     
<?php endforeach;?>
<?php echo Form::hidden('accion', '', array('id'=>'accion'));?>                 
</div>

<?php } else { ?>
<div class="info"> 
<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
    <b>Bandeja Vacia!</b> Usted no tiene correspondencia pendiente.</p>
</div>
<?php } ?>
