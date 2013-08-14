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
 $('#theTable tbody tr:odd').addClass('odd');
 $('input').focus();
});//document.ready
</script>
<style type="text/css">
    td{margin: 0; padding-top: -5px;padding-bottom: -5px;}
    input[type="text"]{ line-height: 20px; height: 20px; font-size: 14px;}
 /*   tbody tr:hover{background: #FBFDFF;}*/
</style>
<h2 class="subtitulo">Lista Pendiente<br/><span>Lista de documentos que fueron recepcionados y que no se derivo</span></h2>
<?php if(sizeof($pendientes)>0){?>
<br/>
<p style="margin: 5px auto; font-size: 10px; font-weight: normal; "> FILTRAR/BUSCAR: <input type="text" id="FilterTextBox" name="FilterTextBox" size="40" />
<span style="float:right; padding-right: 5px;">
    <a href="/ventanilla" class="uibutton">Recepcionar otro</a>
</span>
</p>
<table id="theTable">
    <thead>
        <tr>
            <th width="70">Hoja Ruta</th>            
            <th width="100">Cite</th>            
            <th width="320">Destinatario</th>
            <th width="320">Remitente</th>
            <th width="300">Referencia</th>    
            <th width="50">Fecha</th>
            <th width="80">Accion</th>

        </tr>
    </thead>
    
    <tbody>
    <?php
    $mes=0;
    $dia=0;
 $meses=array(1=>'Ene',2=>'Feb',3=>'Mar',4=>'Abr',5=>'May',6=>'Jun',7=>'Jul',8=>'Ago',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dic');
//    $meses=array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');
   // $dias=array(1=>'Lunes',2=>'Martes',3=>'Miercoles',4=>'Jueves',5=>'Viernes',6=>'Sabado',7=>'Domingo');
    foreach ($pendientes as $d): ?>
        <tr>
            <td style="text-align: right;" >
                <a href="/hojaruta/derivar/?id_doc=<?php echo $d['id'];?>"><?php echo $d['nur'];?></a>            
            </td>
            <td class="codigo" align="center">
                <a href="/documento/detalle/?id=<?php echo $d['id'];?>" ><?php echo $d['cite_original'];?></a>               
            </td>
            <td>
                <?php echo $d['nombre_destinatario'];?><br/><b><?php echo $d['cargo_destinatario'];?><br/><?php echo $d['institucion_destinatario'];?></b>
            </td>
            <td>
                <b><?php echo $d['nombre_remitente'];?></b><br/><?php echo $d['cargo_remitente'];?>
            </td>
            <td ><?php echo $d['referencia'];?></td>
            <td><?php
                    $mes=(int)date('m',strtotime($d['fecha_creacion']));                       
                    $mes=$meses[$mes];                        
                    echo date('d',strtotime($d['fecha_creacion']))."/$mes/".date('Y');
                ?>
                <br/>                
                </td> 
            <td style="text-align: right;" >
                <a href="/ventanilla/editar/<?php echo $d['id'];?>" title="Editar documento" ><img src="/media/images/edit.png"/></a>              
                <a href="/hojaruta/derivar/?id_doc=<?php echo $d['id'];?>" title="Derivar" ><img src="/media/images/derivar.png"/></a>            
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
    <strong>Info! </strong> No tiene documentos.</p>
</div>
    <?php }?>
