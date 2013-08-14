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
    if(count==0){
       $('#opciones_recepcionar').addClass('oculto');       
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
        $('#seleciones_recepcionar').html(nurs);
        $('#opciones_recepcionar').removeClass('oculto');               
    }
});

$('a#recepcionar').click(function(){
   
    var nurs='';
        $('input:checked').each(function(){ 
        if($(this).is(':checked')) 
        {              
            nurs=nurs+"\n * "+$(this).attr('rel'); 
        }
        });
        $('#accion').val('2');
        var answer = confirm("Esta seguro de realizar la recepcion de los siquientes documentos:"+nurs)
    if (answer){
        $('form#doa').submit();
    }
   
   
}); 
//modal
$('a.poplight[href^=#]').click(function() {
    var nur=$(this).attr('nur');
    var hs=$(this).attr('hs');
    $('h3.mensaje').text('Recibir la hoja de ruta : '+hs);
    $('a#aceptar').attr('href','/bandeja/recibir/'+nur);
    var popID = $(this).attr('rel'); //Get Popup Name
    var popURL = $(this).attr('href'); //Get Popup href to define size

    //Pull Query & Variables from href URL
    var query= popURL.split('?');
    var dim= query[1].split('&');
    var popWidth = dim[0].split('=')[1]; //Gets the first query string value

    //Fade in the Popup and add close button
    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) });//.prepend('<a href="#" class="close"><img src="/media/images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>');

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
               $('div#entrada').append(row); 
            });
            return false;
});    
    });
</script>
<h2 class="subtitulo">Bandeja de Entrada:<br/><span>Correspondencia para recepcionar</span></h2>
<div id="popup_name" class="popup_block">  
    <table>
        <thead>
            <tr>
                <th><h3 class="mensaje"></h3></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><br/>
                    Haga click en [Aceptar] para recibir correspondencia.
                    <br/>
                    <br/>                    
                </td>
            </tr>
            <tr>
                <td style="height:40px; text-align: right; ">
                    <a href="" id="aceptar" class="uiButton" >Aceptar</a>
                    <a href="#" id="cancelar" class="uiButton" >Cancelar</a>
                </td>
            </tr>            
        </tbody>
    </table>
</div>

<?php if(sizeof($norecibidos)){?>
<p style="margin: 5px auto;"> <b>Filtrar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="40" />
    <span ><i>Ordenar por: </i></span> <a href="#" class="link2" id="hojaruta">Hoja Ruta</a>
    | <a href="#" class="link2" id="fecha">Fecha</a>
    | <a href="#" class="link2" id="oficina">Oficina</a>
    | <a href="#" class="link2" id="proceso">Proceso</a>
<span style="float:right;"><input type="hidden" id="hoja_ruta" name="hoja_ruta" size="12" /></span>
</p>
<div id="entrada">
    <h2 style="text-align: center; ">Lista de correspondencia para recepcionar</h2>
    <br/>
<form action="/bandeja/doa" method="post" id="doa" >    
<?php foreach($norecibidos as $s): ?>
<div class="bandeja tipo<?php echo $s->oficial;?>" style="display:inline-block;" oficina="<?php echo $s->de_oficina?>" proceso="<?php echo $s->referencia?>"  fecha="<?php echo $s->fecha;?>" hojaruta="<?php echo $s->nur;?>" >
    <table class="oficial<?php echo $s->oficial;?>">
        <tr>
            <td width="150" align="center" valign="top" class="nur<?php echo $s->oficial;?>">
                <div class="oficial<?php echo $s->oficial;?>">
                <input type="checkbox" name="id_seg[]" value="<?php echo $s->id;?>" rel="<?php echo $s->nur;?>"  class="sel"/>
                <span class="prioridad<?php echo $s->prioridad;?>"></span></div>                
            </td>


            <td width="50%" colspan="2" valign="top">
				<div>

				<h2 class="referencia"><a href="/documento/detalle/<?php echo $s->id_doc?>"style="color:#366FB0;"><?php echo $s->referencia; ?></a></h2>
                <span class="oficina">Procedencia: <b><?php echo $s->de_oficina;?></b><span><br/>
				<span class="remite">Remite: <?php echo $s->nombre_emisor; ?> | <b><?php echo $s->cargo_emisor; ?></b></span><br/>
				<span class="accion"><?php echo $s->accion;?></span><br/>
                                <br/> 				
                                </div>
			</td>            
            <td class="derecha" valign="top">
                                <div>
                                    <span><?php echo Date::fecha($s->fecha);?></span><br/><br/>
                                    <span><b>Proveido: </b><?php echo $s->proveido;?></span><br/>
                                    <span><b>Archivo Adj.: </b>
                                        <?php 
                                                $archivos = ORM::factory('archivos')
                                                ->where('id_documento', '=', $s->id_doc)
                                                ->find_all();
                                                foreach ($archivos as $a) { ?>
                                        <br><a href="/descargar.php?id=<?php echo $a->id;?>" style="color: #1C4781; text-decoration: underline;  " target="_blank"><?php echo substr($a->nombre_archivo,13);?></a>            
                                             <?php   } ?>
                                    </span>
                                    
                                </div>
            </td>            
         </tr>
         <tr>
             <td width="150" align="center">
                 <a href="/seguimiento/?nur=<?php echo $s->nur;?>" class="nur<?php echo $s->oficial;?>"><?php  echo $s->nur?></a>
             </td>
             <td colspan="2">
                <span class="opciones">
                                    <a href="#?=350" rel="popup_name" title="Recibir" class="poplight link recepcion" nur="<?php echo $s->id;?>" hs="<?php echo $s->nur;?>">Recepcionar</a>
                                  <?php if($s->hijo==1):?> | <a href="/bandeja/agrupado/?nur=<?php echo $s->nur;?>" ><img src="/media/images/docs.gif" title="Agrupado"/>Agrupado</a><?php endif;?>
                </span>
             </td>
         </tr>
    </table>    
 </div> 
<?php endforeach;?>
<?php echo Form::hidden('accion', '', array('id'=>'accion'));?> 
</form>
</div>
<?php } 
else{ ?>
<div class="info"> 
<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
    <b>Bandeja Vacia!</b> Usted no tiene Correspondencia que recepcionar.</p>
</div>
<?php }?>
