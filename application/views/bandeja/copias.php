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
        
   //eventos
 $('.archivo').click(function(){
         id_nuri=$(this).attr('id_nuri');
         var nuri=$(this).attr('nuri');
         $("#dialog-archivo").dialog({'title':'Archivar '+nuri, autoOpen: true});
     });    
     $('.responde2r').click(function(){
         id_nuri=$(this).attr('id_nuri');
         id_seg=$(this).attr('id_seg');
         var nuri=$(this).attr('nuri');
         alert('recibir');
         $("#dialog-documento").dialog({'title':'Responder al nuri: '+nuri, autoOpen: true});
     });    
     $('#new').toggle(function(){
         $('#sfolder').css({'display':'none'});
         $('#nuevo').css({'display':'block'});
         $(this).text('Seleccionar');
         tipo=1;
     },
     function(){
         $('#sfolder').css({'display':'block'});
         $('#nuevo').css({'display':'none'});
         $(this).text('Nueva Carpeta');
         tipo=0;
     });
   
//modal
$('a.poplight[href^=#]').click(function() {
    var id_nur=$(this).attr('id_nur');
    var id_seg=$(this).attr('id_seg');
    var nur=$(this).attr('nuri');
    $('#id_nur').val(id_nur);
    $('#id_seg').val(id_seg);    
    $('#nur').val(nur);    
    
    $('h3.mensaje').text('Responder a la hoja de ruta : '+nur);
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
input[type="text"]{line-height: 20px; height: 20px; font-size: 14px;}    
</style>
<h2 class="subtitulo">Pendientes:<br/><span>Correspondencia pendiente </span></h2>
<div id="popup_name" class="popup_block">  
    <?php echo Form::open('hojaruta/responder');?>
    <table id="theTable">
        <thead>
            <tr>
                <th><h3 class="mensaje" style="padding-left:0;"></h3></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style=" height: 50px; ">
                <?php
                echo 'RESPONDER CON: ';
                echo Form::select('documento',$options,NULL,array('id'=>'documento')); 
                echo Form::hidden('id_seg','',array('id'=>'id_seg'));
                echo Form::hidden('id_nur','',array('id'=>'id_nur'));
                echo Form::hidden('nur','',array('id'=>'nur'));
                ?>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td style="height:40px; text-align: right; ">
                    <?php echo Form::submit('aceptar', 'Aceptar', array()); ?>
                    <?php echo Form::input('cancelar', 'Cancelar', array('id'=>'cancelar','type'=>'submit')); ?>
                </td>
            </tr>
        </tfoot>
    </table>
    <?php echo Form::close();?>
</div>


<?php if(sizeof($entrada)>0){?>
<p style="margin: 5px auto;"> <b>Filtrar/Buscar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="40" />
</p>
<div id="entrada">
    <h2 style=" text-align: center; color: #3263A0; text-transform: uppercase; font-size: 10px;">Lista de correspondencia pendiente</h2>
<?php foreach($entrada as $s): ?>
<div class="bandeja">
    <table class="oficial<?php echo $s->oficial;?>">
        <tr class="header">
            <td width="80" align="center"><b><?php echo form::checkbox('archivar',$s->id)?></b></td>
            <td><?php echo $s->de_oficina; ?></td>
            <td><?php echo $s->proceso; ?></td>            
            <td colspan="2"><?php $fecha =  new Controller_myClass($s->fecha); echo $fecha->larga();?></td>
         </tr>         
        <tr>
            <td  rowspan="2" class="nur<?php echo $s->oficial;?>" ><br/><br/><br/><a href="/seguimiento/id/<?php echo $s->id_nur;?>"<b style="font-size:12px;"><?php  echo $s->nur?></b></a></td>
            <td><?php echo $s->nombre_emisor; ?><br/><b><?php echo $s->cargo_emisor; ?></b></td>            
            <td> <?php echo $s->accion; ?></td>
            <td><b>Documento: </b> <?php echo $s->codigo; ?></td>
                <td align="right">
                    <a href="#?w=350" class="poplight" rel="popup_name" title="Responder al nuri <?php echo $s->nur;?>" id_nur="<?php echo $s->id_doc;?>" id_seg="<?php echo $s->id;?>" nuri="<?php echo $s->nur?>"><img src="/media/images/24/outbox.png" /></a>  
                    <a href="/hojaruta/derivar/?id_doc=<?php echo $s->id_doc;?>" title="Derivar" id_nur="<?php echo $s->id_doc;?>" id_seg="<?php echo $s->id;?>" nuri="<?php echo $s->nur?>"><img src="/media/images/document--arrow.png" /></a>  
                    <a href="/hojaruta/archivar/<?php echo $s->id;?>" title="Archivar hoja de ruta" ><img src="/media/images/folders.jpg" /></a>                  
                </td>
        </tr>
        <tr>
            <td colspan="5"><b>Proveido: </b><?php echo $s->proveido;?></td>
        </tr>
    </table>
    
</div>
<?php endforeach;?>
</div>

<?php } else { ?>
<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
    <strong>Bandeja Vacia!</strong> Usted no tiene correspondencia pendiente.</p>
</div>
<?php } ?>
