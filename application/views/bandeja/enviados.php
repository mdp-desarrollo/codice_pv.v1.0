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
            });//each--
        });//key up.      
        //modal
        $('a.poplight[href^=#]').click(function() {
            var id_nur=$(this).attr('id_nur');
            var id_seg=$(this).attr('id_seg');
            var nur=$(this).attr('nuri');
            $('#id_nur').val(id_nur);
            $('#id_seg').val(id_seg);    
            $('#nur').val(nur);    
            $('#aceptar').attr('href','/bandeja/cancelar/'+id_seg);
            $('h3.mensaje').text('Cancelar derivación, HR : '+nur);
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
        //imprimir
        //archivo y pendientes
        $('.sel').bind('click',function(){
            var count=$('input:checked').length; 
            if(count==0){
                $('#print_enviados').addClass('oculto');       
            }
            else
            {
                var nurs='';
                $('input:checked').each(function(){ 
                    if($(this).is(':checked')) 
                    {              
                        nurs=nurs+"<br/>- "+$(this).attr('rel')+'<hr />'; 
                    }
                });
                $('#selecciones2').html(nurs);
                $('#print_enviados').removeClass('oculto');               
            }
        });

        $('#print_hr').click(function(){
            $('#frmprint').attr("target","_blank");
            $('#frmprint').submit();
            return false;
        });

    });
</script>
<h2 class="subtitulo">Enviados:<br/><span>Correspondencia enviada que aun no fue recibida por el destinatario</span></h2>
<div id="popup_name" class="popup_block">  
    <table>
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
<?php if (sizeof($entrada) > 0) { ?>
    <p style="margin: 5px auto;"> <b>Filtrar/Buscar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="40" />
    </p>
    <p style="float:right;"><a href="#">I</a></p>
    <?php if (isset($info['info']) > 0): ?>
        <div style="margin-top: 20px; padding: .7em;" class="info">
            <p><span style="float: left; margin-right: .3em;" class="ui-icon-info"></span>
                <?php echo $info['info']; ?>
            </p>
        </div>
    <?php endif; ?>

    <?php if (isset($error['error'])): ?>
        <div style="margin-top: 20px; padding:10px;" class="error">
            <p><span style="float: left; margin-right: .3em;" class="ui-icon-alert"></span>
                <?php echo $error['error']; ?>
            </p>
        </div>
    <?php endif; ?>

    <div id="entrada">
        <h2 style=" text-align: center; color: #3263A0; text-transform: uppercase; font-size: 10px;">Lista de correspondencia enviada</h2>
        <form method="post" action="/print_enviados.php" id="frmprint">    
            <?php foreach ($entrada as $s): ?>
                <div class="bandeja tipo<?php echo $s->oficial; ?>" style="display:inline-block;">
                    <table class="oficial<?php echo $s->oficial; ?>">
                        <tr>
                            <td width="150" align="center" valign="top" class="nur<?php echo $s->oficial; ?>">
                                <input type="checkbox" name="id_seg[]" value="<?php echo $s->id; ?>" rel="<?php echo $s->nur; ?>"  class="sel"/><br/>
                                <div class="oficial<?php echo $s->oficial; ?>"> 					
                                </div>				
                            </td>
                            <td width="50%" colspan="2" valign="top">
                                <div>
                                    <h2 class="referencia"><a href="/documento/detalle/<?php echo $s->id_documento ?>"style="color:#366FB0;"><?php echo $s->referencia; ?></a></h2>
                                    <span class="oficina">Derivado a: <b><?php echo $s->a_oficina; ?></b><span><br/>
                                            <span class="remite">Destinatario: </span><span style="color:#444;"><?php echo $s->nombre_receptor; ?></span> | <b><?php echo $s->cargo_receptor; ?></b><br/>
                                            <span class="accion"><?php echo $s->accion; ?></span><br/>                                
                                            <br/> 				
                                            </div>
                                            </td>            
                                            <td class="derecha" valign="top">
                                                <div>
                                                    <span><?php echo Date::fecha($s->fecha); ?></span><br/><br/>
                                                    <span><b>Proveido: </b><?php echo $s->proveido; ?></span>
                                                </div>
                                            </td>            
                                            </tr>
                                            <tr>
                                                <td width="150" align="center">
                                                    <a href="/seguimiento/?nur=<?php echo $s->nur; ?>" style="font-size:14px;  font-weight: 300; "><?php echo $s->nur ?></a>
                                                </td>
                                                <td colspan="2">
                                                    <span class="opciones">
                                                        <a href="#?=300" rel="popup_name" title="Cancelar derivacion" class="poplight uiButton" nur="<?php echo $s->id; ?>" id_nur="<?php echo $s->nur; ?>" hs="<?php echo $s->nur; ?>"  id_seg="<?php echo $s->id; ?>" nuri="<?php echo $s->nur ?>">Cancelar derivacion</a>
                                                        <a href="/bandeja/printDeriv/<?php echo $s->id; ?>" title="Imprimir" class="uiButton" nur="<?php echo $s->id; ?>"><img src="/media/images/print.png" align="absmiddle"  /> Imprimir</a>                                       
                                                    </span>
                                                </td>
                                            </tr>
                                            </table>    
                                            </div>     
                                        <?php endforeach; ?>
                                        </form>        
                                        <?php echo Form::hidden('accion', '', array('id' => 'accion')); ?>                 
                                        </div>

                                    <?php } else { ?>
                                        <div class="info"> 
                                            <p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
                                                <b>Bandeja Vacia!</b> Usted no tiene correspondencia pendiente.</p>
                                        </div>
                                    <?php } ?>
