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
<h2 class="subtitulo">Pendientes: <?php echo  $user->nombre;?> | <b><?php echo $user->cargo;?></b><br/><span>Correspondencia pendiente </span></h2>
<div id="popup_name" class="popup_block">  
    <form method="post" action="/hojaruta/responder">    
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
                echo Form::select('documento',$options,NULL,array('id'=>'documento')); 
                echo Form::hidden('id_seg','',array('id'=>'id_seg'));
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


<?php if(sizeof($entrada)>0){?>
<p style="margin: 5px auto;"> <b>Filtrar: </b><input type="text" id="FilterTextBox" name="FilterTextBox" size="40" />
     <span ><i>Ordenar por: </i></span> <a href="#" class="link2" id="hojaruta">Hoja Ruta</a>
    | <a href="#" class="link2" id="fecha">Fecha</a>
    | <a href="#" class="link2" id="oficina">Oficina</a>
    | <a href="#" class="link2" id="proceso">Proceso</a>
    <select id="tipoCorr">
        <option value="">Oficial y copia</option>
        <option value="tipo1">Oficiales</option>
        <option value="tipo0">Copias</option>
    </select>
</p>
<div id="entrada">    
    <h2 style="text-align: center; color: #3263A0; ">Lista de correspondencia pendiente</h2>
    <form action="/bandeja/doa" method="post" id="doa" >
    <?php foreach($entrada as $s): ?>
<div class="bandeja tipo<?php echo $s->oficial;?>" style="display:inline-block;" oficina="<?php echo $s->de_oficina?>" proceso="<?php echo $s->referencia?>"  fecha="<?php echo $s->fecha;?>" hojaruta="<?php echo $s->nur;?>">
    <table class="oficial<?php echo $s->oficial;?>">
        <tr>
            <td width="88" align="center" valign="top" class="nur<?php echo $s->oficial;?>">
				<div class="oficial<?php echo $s->oficial;?>">				 					
				<span class="prioridad<?php echo $s->prioridad;?>"></span></div>				
			</td>
            <td width="50%" colspan="2" valign="top">
				<div>
				<h2 class="referencia"><a href="/documento/detalle/<?php echo $s->id_doc?>" style="color:#366FB0;line-height: 22px;  "><?php echo $s->referencia; ?></a></h2>
				<span class="oficina">Procedencia: <b><?php echo $s->de_oficina;?></b><span><br/>
                                        <span class="remite">Remite: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $s->nombre_emisor; ?> | <b><?php echo $s->cargo_emisor; ?></b></span><br/>
				<span class="accion"><?php echo $s->accion;?></span><br/>                                
				<br/> 				
                                </div>
			</td>            
            <td class="derecha" valign="top">
                                <div>
                                    <span><b>F.Recepción: </b><?php echo Date::fecha($s->fecha2);?></span><br/><br/>
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
             <td width="88">
                 <a href="/seguimiento/?nur=<?php echo $s->nur;?>" class="nur<?php echo $s->oficial;?>"><?php  echo $s->nur?></a>
             </td>
             <td colspan="2">                
<?php  $segundos=(time()-strtotime($s->fecha2)); ?>
<?php $dias=floor((($segundos/3600)/24)); 
switch ($dias) {
                            case 0:
                            $color=0;
                            break;
                            case 1:
                            $color=1;
                            break;
                            case 2:
                            $color=2;
                            break;
                            default:
                           $color=2;  
                            break;
                        }
?>
                 <span class="dias dias<?php echo $color;?>">  
<?php echo $dias;?>
             días</span></td>
         </tr>
    </table>    
 </div> 
<?php endforeach;?>
<?php echo Form::hidden('accion', '', array('id'=>'accion'));?>          
</form>        
</div>

<?php } else { ?>
<div class="info"> 
<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
    <b>Bandeja Vacia!</b> No tiene correspondencia pendiente.</p>
</div>
<?php } ?>
