<script type="text/javascript">
$(function()
{
//modal
$('a.poplight[href^=#]').click(function() 
{
    var id_nur=$(this).attr('id_nur');
    var id_seg=$(this).attr('id_seg');
    var nur=$(this).attr('nuri');
    $('#id_nur').val(id_nur);
    $('#id_seg').val(id_seg);    
    $('#nur').val(nur);        
    $('h3.mensaje').text('CREAR DOCUMENTO Y ENLAZAR AL NUR : '+nur);
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
    $('body').append('<div id="fade"></div>'); 
    $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); 
    return false;
});

//Close Popups and Fade Layer
$('a.close, #fade, #cancelar').live('click', function(){ //When clicking on the close or fade layer...
    $('#fade , .popup_block').fadeOut(function() 
    {
        $('#fade, a.close').remove();  //fade them both out
    });
    return false;
}); 
//add index column with all content.
 $("table#theTable tbody tr:has(td)").each(function(){
   var t = $(this).text().toLowerCase(); //all row text
   $("<td class='indexColumn'></td>")
    .hide().text(t).appendTo(this);
 });//each tr
 $("#FilterTextBox").keyup(function(){
   var s = $(this).val().toLowerCase().split(" ");
   //show all rows.
   $("#theTable tbody tr:hidden").show();
   $.each(s, function(){
        $("#theTable tbody tr:visible .indexColumn:not(:contains('"
          + this + "'))").parent().hide();
   });//each
 });//key up.
 //zebra
 //zebra
 $("#theTable").tablesorter({sortList:[[0,1]], 
                widgets: ['zebra'],
                headers: {             
                    5: { sorter:false},
                    6: { sorter:false}
                }
            });
 $("#FilterTextBox").focus();
});//document.ready
</script>
<h2 class="subtitulo">Hojas de ruta<br/> <span>Lista de Hojas de Ruta creados por mi usuario</span></h2>
<div id="popup_name" class="popup_block">  
    <form method="post" action="/hojaruta/generar_doc">    
    <table>
        <thead>
            <tr>
                <th><h3 class="mensaje" style="padding-left:0;"></h3></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style=" height: 50px; ">
                <?php
                echo 'CREAR DOCUMENTO: ';
                echo Form::select('documento',$options,NULL,array('id'=>'documento')); 
                echo Form::hidden('id_seg',0,array('id'=>'id_seg'));
               // echo Form::hidden('id_nur','',array('id'=>'id_nur'));
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
   </form>
</div>
<?php if($count>0):?> 

<p style="margin: 5px auto;"> <b>Filtrar/Buscar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="40" /></p>

<table id="theTable" class="tablesorter">
    <thead>
        <tr>
            <th width="90">HOJA RUTA</th>
            <th width="85">Proceso</th>            
            <th>cite Original</th>
            <th>Destinatario</th>
            <th>Referencia</th>            
            <th class="noprint"  >Estado</th>
            <th class="noprint"  ></th>            
        </tr>
    </thead>
    <tbody>
        <?php foreach($result as $n):?>
        <tr>
            <td><a href="/seguimiento/?nur=<?php echo $n['nur']?>"><?php echo $n['nur'];?></a></td>
            <td><?php echo $n['proceso'];?></td>            
            <td><b><?php echo $n['codigo'];?></b></td>                        
            <td><?php echo $n['nombre_destinatario'];?><br/><b><?php echo $n['cargo_destinatario'];?></b></td>
            <td><?php echo $n['referencia'];?></td>                       
            <td align="center" width="50" class="noprint"  >
                <?php if($n['estado']):?>
                <a href="/seguimiento/?nur=<?php echo $n['nur'];?>" title="Ver seguimiento del NUR <?php echo $n['nur'] ?>" >Derivado</a>                
                <?php else: ?>
                <a href="/hojaruta/derivar/?id_doc=<?php echo $n['id_documento'];?>" title="Derivar <?php echo $n['nur'] ?>" ><img src="/media/images/deriv.png"/></a>
                <a href="#?w=350" class="poplight" rel="popup_name" title="Crear documento a partir del NUR <?php echo $n['nur'];?>" id_nur="<?php echo $n['id_documento'];?>" id_seg="0" nuri="<?php echo $n['nur'];?>"><img src="/media/images/kword_kwd.png" /></a>  
                <?php endif;?>                
            </td>        
            <td class="noprint">
                <a href="/print_hr.php?nur=<?php echo $n['nur'];?>" title="Imprimir <?php echo $n['nur'] ?>" ><img src="/media/images/printer.png"/> </a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php echo $page_links; ?>
<?php else: ?>
<div class="info">
    <p><span style="float: left; margin-right: .3em;" class=""></span>
        <strong>Info: </strong> <?php echo 'Usted aun no creo ninguna hoja de ruta. ';?> &larr;<a onclick="javascript:history.back(); return false;" href="#" style="font-weight: bold; text-decoration: underline;  " > Regresar</a></p>       
</div>
<?php endif; ?>