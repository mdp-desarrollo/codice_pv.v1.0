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

        //archivo y pendientes
        $('.sel').bind('click',function(){
            var count=$('input:checked').length;
            //alert(count); 
            if(count==0){
                $('#opciones').addClass('oculto');       
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
                $('#seleciones').html(nurs);
                $('#opciones').removeClass('oculto');               
            }
        });

        //modal
        $('a.poplight[href^=#]').click(function() {
            var id_nur=$(this).attr('id_nur');
            var id_seg=$(this).attr('id_seg');
            var id_documento=$(this).attr('id_documento');
            var fucov=$(this).attr('fucov');
            var nur=$(this).attr('nuri');
            $('#id_nur').val(id_nur);
            $('#id_seg').val(id_seg);
            $('#id_documento').val(id_documento);
            $('#fucov').val(fucov);
            $('#nur').val(nur);
    
    
            $('h3.mensaje').text('Generar respuesta a: '+nur);
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
        
 
        //esto se se refresca la pagina
        var count=$('input:checked').length; 
        if(count==0){
            $('#opciones').addClass('oculto');    
        }
        else
        {
            var nurs='';
            $('input:checked').each(function(){ 
                if($(this).is(':checked')) 
                {              
                    nurs=nurs+"\n"+$(this).attr('rel'); 
                }
            });
            $('#seleciones').html(nurs);
            $('#opciones').removeClass('oculto');       
        
        }
        $('a#archive').click(function(){
            $('#accion').val('0');
            $('form#doa').submit();
        });      
        $('a#group').click(function(){
            $('#accion').val('1');
            var count=$('input:checked').length;
            if(count>1)
                $('form#doa').submit();
            else
            {
                alert('Para poder agrupar debe de seleccionar por lo menos 2 hojas de ruta');
                return false;
            }
        });      

        $('#tipoCorr').change(function(){
            var tipo = $(this).val();
            if(tipo!='')
            {
                $('.bandeja').hide();
                $('.'+tipo).fadeIn();
            }
            else
                $('.bandeja').show();
        });

        //modificado por freddy
//        $('#form_respuesta').submit(function() {
//            var id_tipo = $("#documento").val();
//            if(id_tipo==13){
//                var id_documento = $("#id_documento").val();
//                $.ajax({
//                    type: "POST",
//                    data: { id_doc: id_documento},
//                    url: "/ajax/docfucov",
//                    dataType: "json",
//                    success: function(item)
//                    {
//                        if(item)
//                        {
//                            alert('El documento ya fue respondido con un fucov');
//                            return false;
//                        }else{
//                            return false;
//                        }
//                    }
//                });
//                return false;
//            }else{
//                //$('#form_respuesta').submit();
//                return false;
//            }
//
//        });
        
        var copia=$('.tipo0').size();
        var oficial=$('.tipo1').size();
        //alert(copia+':'+oficial);
        $('a.link2').click(function(){
            $this=$(this);
            var criterio=$this.attr('id');
            if($this.is('.asc'))
            {              
                $this.removeClass('asc');
                $this.addClass('desc');
                var sortdir=-1;
            }
            else
            {
      
                $this.addClass('asc');
                $this.removeClass('desc');
                var sortdir=1;      
            }
            $(this).siblings().removeClass('asc');
            $(this).siblings().removeClass('desc');
            //sort
            var nurs=$('div.bandeja').get();
            nurs.sort(function(a,b){
                var val1=$(a).attr(''+criterio).toUpperCase(); 
                var val2=$(b).attr(''+criterio).toUpperCase(); 
                return (val1<val2) ? -sortdir : (val1>val2) ? sortdir : 0;
            });
            $.each(nurs, function(index,row){
                $('form#doa').append(row); 
            });
            return false;
        });    
    });
</script>
<h2 class="subtitulo">Pendientes:<br/><span>Correspondencia pendiente </span></h2>
<div id="popup_name" class="popup_block">  
    <form method="post" action="/hojaruta/responder" id="form_respuesta">    
        <table class="classy">
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
                        echo Form::select('documento', $options, NULL, array('id' => 'documento'));
                        echo Form::hidden('id_seg', '', array('id' => 'id_seg'));
                        echo Form::hidden('id_documento', '', array('id' => 'id_documento'));
                        echo Form::hidden('fucov', '', array('id' => 'fucov'));
                        echo Form::hidden('nur', '', array('id' => 'nur'));
                        ?>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td style="height:40px; text-align: right; ">
                        <?php echo Form::submit('aceptar', 'Aceptar', array()); ?>
                        <?php echo Form::input('cancelar', 'Cancelar', array('id' => 'cancelar', 'type' => 'submit')); ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>
</div>

<?php if (isset($info['info']) > 0): ?>
        <div style="margin-top: 20px; padding: .7em;" class="info">
            <p><span style="float: left; margin-right: .3em;" class="ui-icon-info"></span>
                <?php echo $info['info']; ?>
            </p>
        </div>
    <?php endif; ?>

<?php if (sizeof($entrada) > 0) { ?>
    <p style="margin: 5px auto;"> <b>Filtrar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="30" />
        <span ><i>Ordenar por: </i></span> <a href="#" class="link2" id="hojaruta">Hoja Ruta</a>
        | <a href="#" class="link2" id="fecha">Fecha</a>
        | <a href="#" class="link2" id="oficina">Oficina</a>
        | <a href="#" class="link2" id="proceso">Proceso</a>
        <i> Mostrar: </i>
        <select id="tipoCorr">
            <option value="">Oficial y copia</option>
            <option value="tipo1">Oficiales</option>
            <option value="tipo0">Copias</option>
        </select>
    </p>
    <div id="entrada">    
        <h2 style="text-align: center; color: #3263A0; ">Lista de correspondencia pendiente</h2>
        <form action="/bandeja/doa" method="post" id="doa" >
            <?php foreach ($entrada as $s): ?>
                <div class="bandeja tipo<?php echo $s->oficial; ?>" style="display:inline-block;" oficina="<?php echo $s->de_oficina ?>" proceso="<?php echo $s->referencia ?>"  fecha="<?php echo $s->fecha; ?>" hojaruta="<?php echo $s->nur; ?>">
                    <table class="oficial<?php echo $s->oficial; ?>">
                        <tr>
                            <td width="150" align="center" valign="top" class="nur<?php echo $s->oficial; ?>">
                                <div class="oficial<?php echo $s->oficial; ?>">
                                    <input type="checkbox" name="id_seg[]" value="<?php echo $s->id; ?>" rel="<?php echo $s->nur; ?>"  class="sel"/>
                                    <span class="prioridad<?php echo $s->prioridad; ?>"></span></div>				
                            </td>
                            <td width="50%" colspan="2" valign="top">
                                <div>
                                    <h2 class="referencia"><a href="/documento/detalle/<?php echo $s->id_doc ?>" style="color:#366FB0;line-height: 22px;  "><?php echo $s->referencia; ?></a></h2>
                                    <span class="oficina">Procedencia: <b><?php echo $s->de_oficina; ?></b><span><br/>
                                            <span class="remite">Remite: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $s->nombre_emisor; ?> | <b><?php echo $s->cargo_emisor; ?></b></span><br/>
                                            <span class="accion"><?php echo $s->accion; ?></span><br/>                                
                                            <br/> 				
                                            </div>
                                            </td>            
                                            <td class="derecha" valign="top">
                                                <div>
                                                    <span><b>F.Recepción: </b><?php echo Date::fecha($s->fecha2); ?></span><br/><br/>
                                                    <span><b>Proveido: </b><?php echo $s->proveido; ?></span><br/>
                                                    <span><b>Archivo Adj.: </b>
                                                        <?php
                                                        $archivos = ORM::factory('archivos')
                                                                ->where('id_documento', '=', $s->id_doc)
                                                                ->find_all();
                                                        foreach ($archivos as $a) {
                                                            ?>
                                                            <br><a href="/descargar.php?id=<?php echo $a->id; ?>" style="color: #1C4781; text-decoration: underline;  " target="_blank"><?php echo substr($a->nombre_archivo, 13); ?></a>            
        <?php } ?>
                                                    </span>
                                                </div>
                                            </td>            
                                            </tr>
                                            <tr>
                                                <td width="150" align="center">
                                                    <a href="/seguimiento/?nur=<?php echo $s->nur; ?>" class="nur<?php echo $s->oficial; ?>"><?php echo $s->nur ?></a>
                                                </td>
                                                <td colspan="2">
                                                    <span class="opciones">
                                                        <a href="#?w=350" class="poplight link respuesta" rel="popup_name" title="Responder a la hoja de ruta <?php echo $s->nur; ?>" id_nur="<?php echo $s->nur; ?>" id_documento="<?php echo $s->id_doc; ?>" fucov="<?php echo $s->fucov; ?>" id_seg="<?php echo $s->id; ?>" nuri="<?php echo $s->nur ?>">Generar respuesta </a>
                                                        | <a href="/hojaruta/derivar/?id_doc=<?php echo $s->id_doc; ?>" class="link derivar " title="Derivar " id_nur="<?php echo $s->nur; ?>" id_seg="<?php echo $s->id; ?>" nuri="<?php echo $s->nur ?>">Derivar</a> 
        <?php if ($s->hijo == 1): ?> |  <a href="/bandeja/agrupado/?nur=<?php echo $s->nur; ?>" class="link agrupado">Agrupado</a><?php endif; ?>

                                                    </span>
                                                </td>
                                                <td>
                                                    <?php $segundos = (time() - strtotime($s->fecha2)); ?>
                                                    <?php
                                                    $dias = floor((($segundos / 3600) / 24));
                                                    switch ($dias) {
                                                        case 0:
                                                            $color = 0;
                                                            break;
                                                        case 1:
                                                            $color = 1;
                                                            break;
                                                        case 2:
                                                            $color = 2;
                                                            break;
                                                        default:
                                                            $color = 2;
                                                            break;
                                                    }
                                                    ?>
                                                    <span class="dias dias<?php echo $color; ?>">  
        <?php echo $dias; ?>
                                                        días</span></td>
                                            </tr>
                                            </table>    
                                            </div> 
    <?php endforeach; ?>
                                        <?php echo Form::hidden('accion', '', array('id' => 'accion')); ?>          
                                        </form>        
                                        </div>

<?php } else { ?>
                                        <div class="info"> 
                                            <p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
                                                <b>Bandeja Vacia!</b> Usted no tiene correspondencia pendiente.</p>
                                        </div>
<?php } ?>
