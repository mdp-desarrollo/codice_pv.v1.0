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
                    7: { sorter:false}                    
                }
            });
 $("#FilterTextBox").focus();
});//document.ready
</script>
<h2 class="subtitulo">Hojas de Ruta Agrupados<br/> <span>Lista de Hojas de Ruta agrupados por mi usuario</span></h2>
<?php if($count>0):?> 

<p style="margin: 5px auto;"> <b>Filtrar/Buscar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="40" /></p>

<table id="theTable" class="tablesorter">
    <thead>
        <tr>
            <th>Hoja de Ruta</th>
            <th>Hoja de Ruta Principal</th>            
            <th>Documento Original</th>
            <th>Referencia</th>
            <th>Destinatario</th>
            <th>Fecha de Agrupación</th>                                
        </tr>
    </thead>
    <tbody>
        <?php foreach($result as $n):?>
        <tr>
            
            <td><a href="/seguimiento/?nur=<?php echo $n['hijo'];?>" title="Ver seguimiento del NUR <?php echo $n['hijo'] ?>" ><?php echo $n['hijo'] ?></a>                </td>            
            <td><a href="/seguimiento/?nur=<?php echo $n['padre'];?>" title="Ver seguimiento del NUR <?php echo $n['padre'] ?>" ><?php echo $n['padre'] ?></a>                </td>
            <td><b><?php echo $n['cite_original'];?></b></td>            
            <td><?php echo $n['referencia'];?></td>                        
            <td><?php echo $n['nombre_destinatario'];?><br/>
                <b><?php echo $n['cargo_destinatario']?></b></td>
            <td><?php echo Date::fecha_corta($n['fecha']);?></td>                       
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php echo $page_links; ?>
<?php else: ?>
<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all">
    <p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span>    
     <strong>Info: </strong> <?php echo 'Usted no tiene hojas de ruta creadas';?></p>    
</div>
<?php endif; ?>