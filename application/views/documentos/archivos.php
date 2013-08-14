<script type="text/javascript">
$(function(){
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
 $("#theTable").tablesorter({sortList:[[0,1]], 
                widgets: ['zebra'],
                headers: {             
                    5: { sorter:false}
                }
            });
 //$('#theTable tbody tr:odd').addClass('odd');
 $('input').focus();
 
   
    
});//document.ready
</script>
<style type="text/css">
    td{margin: 0; padding-top: -5px;padding-bottom: -5px;}
    input[type="text"]{ line-height: 20px; height: 20px; font-size: 14px;}
    
 /*   tbody tr:hover{background: #FBFDFF;}*/
</style>
<h2 class="subtitulo">Archivos digitales<br/><span>Lista de archivos digitales subidos</span></h2>
<?php if(sizeof($results)>0){?>
<br/>
<p style="margin: 5px auto; font-size: 10px; font-weight: normal; "> FILTRAR/BUSCAR: <input type="text" id="FilterTextBox" name="FilterTextBox" size="40" />  
</span></p>
<table id="theTable" class="tablesorter">
    <thead>
        <tr>
            <th width="150">Archivo</th>            
            <th width="70">Tama&ntilde;o</th>
            <th width="70">tipo</th>                
            <th width="160">documento</th>
            <th width="285">Referencia</th>
            <th width="80">Hoja ruta</th>
            <th width="80">Fecha</th>
        </tr>
    </thead>
    
    <tbody>
    <?php
    $mes=0;
    $dia=0;
    $meses=array(1=>'Ene',2=>'Feb',3=>'Mar',4=>'Abr',5=>'May',6=>'Jun',7=>'Jul',8=>'Ago',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dic');
//    $meses=array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');
   // $dias=array(1=>'Lunes',2=>'Martes',3=>'Miercoles',4=>'Jueves',5=>'Viernes',6=>'Sabado',7=>'Domingo');
    foreach ($results as $d): ?>
        <tr>
            <td class="codigo" align="center">
                <a href="/descargar.php/?id=<?php echo $d['id'];?>" ><?php echo substr($d['nombre_archivo'],13);?></a>               
            </td>            
            <td ><?php echo number_format($d['tamanio']/1048576,2).' MB';?></td>
            <td><b><?php echo $d['tipo'];?></b>               </td>
            <td><a href="/documento/detalle/<?php echo $d['id_documento'];?>" ><?php echo $d['codigo'];?></a>               </td>
            <td ><?php echo $d['referencia'];?></td>                        
            <td style="text-align: right;" >
                <a href="/seguimiento/?nur=<?php echo $d['nur'];?>"><?php echo $d['nur'];?></a>            
            </td>
            <td><?php
            echo $d['fecha'];
                  /*  $mes=(int)date('m',strtotime($d->fecha_creacion));                       
                    $mes=$meses[$mes];                        
                    echo date('d',strtotime($d->fecha_creacion))."/$mes/".date('Y',strtotime($d->fecha_creacion));*/
                ?>
                <br/>
                <?php //echo ''.date('g:i:s A',strtotime($d->fecha_creacion))?>
              </td> 
                                    
        </tr>        
    <?php endforeach; ?>
   </tbody>
   <tfoot>
       <tr>
           <td colspan="5"><?php // echo $page_links; ?></td>
       </tr>
   </tfoot>
</table>


<?php } else { ?>
<div class="info">
<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
    <strong>Sin archivos! </strong> Usted no tiene ningun archivo digital subido al sistema.</p>
</div>
<?php }?>
