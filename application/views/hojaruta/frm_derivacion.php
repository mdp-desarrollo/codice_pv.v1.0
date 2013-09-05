<script type="text/javascript">
function visible(text)
{  
    //Fade in Background
    $('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
    $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer - .css({'filter' : 'alpha(opacity=80)'}) is used to fix the IE Bug on fading transparencies 
    $('#loading').css({'filter' : 'alpha(opacity=80)'}).fadeIn().append('<span>').html('<img src="/media/images/load-indicator.gif" align="absmiddle" alt="" /> '+text);
}
function ocultar()
{
    $('#fade , #loading').fadeOut(function() {
        $('#fade, a.close').remove();  //fade them both out
    });
}

//adicionar un destinatario
function ajaxs(oficial)
{
        //$('#theTable tbody tr').remove();
        var hijo=$('#hijo').val();
        var destinatario=$('#destino').val();        
        var accion=$('#accion').val();        
        var accion_texto=$('#accion option:selected').text();
        var proveido=$('#proveido').val();                
        var user=$('#user').val();                                 
        var adjunto=$('#adjunto').val();  
        var id_seg=$('#id_seg').val();  
        var estado=$('#estado').val();  
        var document=$('#document').val();  
        var adjunto=$('#adjunto').val();
        var tipo=$('#oficial').val();
        
        var id_tipo=$('#id_tipo').val();
        if(id_tipo==5 && oficial==2){
            destinatario = 119;     // usuario creado, como usuario externo
            oficial=1;
        }

        var urgente=$('input:checkbox#urgente').attr('checked');
        if(urgente==undefined)
            urgente=0;
        else
            urgente=1;
        if(adjunto==null)
          {adjunto=0;}
        var nur=$('#nur').val();        
        if(proveido){
        visible('Derivando...');
        $.ajax({
	            type: "POST",
	            data: { tipo: tipo, oficial:oficial, destino: destinatario, adjunto : adjunto, document: document, nur : nur, accion: accion, proveido: proveido, hijo: hijo, user: user, adjunto:adjunto,id_seg:id_seg,estado:estado,urgente:urgente },
	            url: "/ajax/derivar",
	            dataType: "json",
	            success: function(item)
	            {   
                        ocultar();
                        if(item.id)
                            {
                                var adjunto='';
                               $.each(item.adjunto,function(k,v){
                                   adjunto=adjunto+v+"<br/>";
                               });
                               if(item.oficial=="0")
                                {    
                                    
                                //<img src="../../media/images/delete.png" width="16" height="16" alt="Quitar destinatario" style="cursor: pointer" id="'+item.id+'" destino="'+item.id_destino+'" oficial="'+item.oficial+'"/>                         
                                $('#theTable tbody').append('<tr class="oficial0"><td rowspan="2" ><input type="checkbox" title="Quitar destinatario" id="'+item.id+'" destino="'+item.id_destino+'" oficial="'+item.oficial+'"/></td><td rowspan="2"><b>COPIA</b></td><td>'+item.receptor_nombre+'<br/><b>'+item.receptor_cargo+'</b></td><td>'+accion_texto+'<br/></td><td><b>'+adjunto+'</b></td></tr><tr class="oficial0"><td colspan="3"><b>Proveido: </b>'+item.proveido+'</td></tr>');
                                }
                                else
                                {
                                $('#theTable tbody').append('<tr class="oficial1"><td rowspan="2" ><input type="checkbox" title="Quitar destinatario" id="'+item.id+'" destino="'+item.id_destino+'" oficial="'+item.oficial+'"/></td><td rowspan="2"><b>OFICIAL</b></td><td>'+item.receptor_nombre+'<br/><b>'+item.receptor_cargo+'</b></td><td>'+accion_texto+'<br/></td><td><b>'+adjunto+'</b></td></tr><tr class="oficial1"><td colspan="3" ><b>Proveido: </b>'+item.proveido+'</td></tr>');
                                }
                            }
                         else
                         {
                         ocultar();
                         alert(item.error);                         
                         }
	           },
                   error:function(){ ocultar();}
          });
          }else{alert("Ingrese Proveido..."); $("#proveido").focus();}
    } 
    
$(function() {
$('body').append(
        $('<div>').attr('id', 'loading').addClass('loading').css({
	         position: 'absolute',
	         display: 'none',
	         top: '48%',                 
		 left: '48%',
                 background: '#ffffff'
		})
            );

$('#imprimir').click(function(){
   visible();
   ocultar();
   return false;
});
$('#frmDerivar').validate();
$('#dOficial').bind('click',function(){
    ajaxs(1);
    return false;
});
$('#dCopia').bind('click',function(){
    ajaxs(0);
    return false;
});
$('#dExterna').bind('click',function(){
            if (confirm('Esta Seguro de Realizar la Derivacion Externa ?')) {
                ajaxs(2);
                return false;
            }
        });
$("#adjunto").fcbkcomplete({
    json_url: "/ajax/documentos",
                    addontab: true,                   
                    maxitems: 5,
                    height: 5,
                    cache: true
   });
   
$('table#theTable :checkbox').live("click",function(){        
       var $this=$(this);
       var id=$this.attr('id');
       var destino=$this.attr('destino');
       var oficial=$this.attr('oficial');
       var document=$('#document').val(); 
       visible('Quitando destinatario...');
        $.ajax({
	            type: "POST",
	            data: { id: id, destino: destino,oficial:oficial,document : document },
	            url: "/ajax/eliminar",
	            dataType: "json",
	            success: function(item)
	            {   
                        ocultar();                        
	           },
                   error:function(){ ocultar();}
          });
       $this.parent('td').parent('tr').next().remove();
       $this.parent('td').parent('tr').remove();  
       return false;
       //var $this=$(this).find('input:checkbox');
     //  var id=$this.attr('id');       
      // alert('hola');   
   });
   
//eliminar
$('#eliminar').click(function(){
	var len=0;
	var destinatarios=[];
	var valor;
	$('#theTable tbody tr').each(function(index,domEle){
		var checked=$(this).find('input:checkbox').attr('checked');
		if(checked){				
                    valor=$(this).find('input:checkbox').attr('id');
                    destinatarios[len]=valor;
                    len++;
                    }			 													
		});
		if(len>0)
                {					
			alert(destinatarios)
		}
		else{
			alert("Seleccione un destinatario por favor.");
                    }			
  });
    $.getJSON("http://jsonip.appspot.com?callback=?",function(data){
//    alert( "Your ip: " + data.ip);
});
});
</script>

<style type="text/css">
    table tr td {padding: 2px;}
   input[type="checkbox"]{cursor:pointer; border: 2px solid #DC5526;  }
   div.loading{border: 5px solid #666; background-color: #fff; padding: 10px;}
</style>
<div style="width: 100%;">
 <h2 class="subtitulo"><?php echo $documento->referencia;?><br/><span>formulario de derivacion:</span></h2>   
<div id="derivacion">
<!-- mostrar errores -->
<?php if(sizeof($errors)>0):?>
<div class="error">
    <p><span style="float: left; margin-right: .3em;" class=""></span>
    <?php foreach($errors as $k=>$v):?>
        <strong><?=$k?>: </strong> <?php echo $v;?></p>
    <?php endforeach;?>
</div>
<br/>
<?php endif;?>
<form action="/hojaruta/derivando/?nur=<?php echo $documento->nur;?>" method="post" id="frmDerivar">
<input type="hidden" value="<?php echo $hijo;?>" name="hijo" id="hijo"/>
<input type="hidden" value="<?php echo $documento->nur;?>" name="nur" id="nur"/>
<input type="hidden" value="<?php echo $id_seguimiento;?>" name="id_seg" id="id_seg"/>
<input type="hidden" value="<?php echo $oficial;?>" name="oficial" id="oficial" />
<input type="hidden" value="<?php echo $documento->estado;?>" name="estado" id="estado"/>
<input type="hidden" value="<?php echo $user->id;?>" name="user" id="user"/>
<input type="hidden" value="<?php echo $documento->id;?>" name="document" id="document"/>
<input type="hidden" value="<?php echo $documento->id_tipo;?>" name="id_tipo" id="id_tipo"/>
<fieldset>
    <div style="height:3px; background:#184D9C; "></div>

<table style="width: 100%;">
    <tbody>                                                       
        <tr>                   
            <td>                
                <?php echo Form::label('nur', 'Hoja de Ruta:');?>
                <h2><?php echo $documento->nur;?></h2>
            </td>
            <td>    
                <?php echo Form::label('derivar', 'Cite:');?>                
                <h2><?php echo $documento->cite_original;?></h2>
            </td>
        </tr>                        
        <tr>
            <td colspan="2">                
                <?php echo Form::label('detinatario', 'Destinatario:')?>                            
                <h2>
                <?php echo $documento->nombre_destinatario;?> | <?php echo $documento->cargo_destinatario;?>
                </h2>
            </td>
        </tr>                
        <tr>
            <td colspan="2">                
                <?php echo Form::label('detinatario', 'Remitente:')?>                            
                <h2>
                <?php echo $documento->nombre_remitente;?> | <?php echo $documento->cargo_remitente;?>
                </h2>
            </td>
        </tr>                
    </tbody>
</table>
    <div style="height:3px; background:#184D9C; "></div>  
    <div style="width:100%; background-color: #F2F7FC; ">        
    <table style="width:700px;">
        <tbody>
         <tr>
             <td colspan="2">
                <?php echo Form::label('derivar', 'Derivar a :');?>             
                <?php echo Form::select('destino', $destinatarios, $user_id->id, array('id'=>'destino','class'=>'required','style'=>'width:560px;'));?>
                <input type="checkbox" value="1" id="urgente" /> Urgente
                
             </td>                        
         </tr>
         <tr>
             <td >
                <?php echo Form::label('accion','Accion');?>
                <?php echo Form::select('accion', $acciones, Arr::get($_POST,'accion',NULL), array('class'=>'required','id'=>'accion','style'=>'width:250px;')); ?>
            </td>                      
            <td>
                <?php echo Form::label('Adjunto', 'Adjunto: ');?>
                <select id="adjunto" name="adjunto">                                    
                </select>
            </td>
         </tr>
         <tr>
            <td colspan="2">
                <?php echo Form::label('proveido', 'Proveido');?>                            
                <?php echo Form::textarea('proveido', Arr::get($_POST,'proveido',''), array('COLS'=>12,'rows'=>1,'class'=>'required','id'=>'proveido','style'=>'width:645px;'));?>
            </td>                                    
        </tr>        
    </tbody>
    </table>
    <table style=" width:100%; ">
        <tr>            
            <td colspan="2">                
                <?php if($oficial!=0): ?>                
                <a href="#"   id="dOficial" class="uiButton uiButtonConfirm"><img src="/media/images/derivar.png" alt="" align="absmiddle"/> Derivar Oficial</a>
               <?php endif;?>
                <a href="#" id="dCopia" class="uiButton"><img src="/media/images/derivar.png" alt="" align="absmiddle"/> Derivar Copia</a>
                <?php if($documento->id_tipo == 5):?>
                <a href="#" id="dExterna" class="uiButton"><img src="/media/images/derivar.png" alt="" align="absmiddle"/> Derivaci&oacute;n Externa</a>
                <?php endif;?>
            </td>
            <td align="right">                
                <?php //if($documento->estado==0):?>
                <a href="/print_hr.php?nur=<?php echo $documento->nur;?>" target="_blank" class="uiButton"><img src="/media/images/printer.png" alt="" align="absmiddle"/> Imprimir HR</a>                
                <?php //endif;?>
            </td>
        </tr>
</table>
    </div>
    <?php echo Form::hidden('tipo','',array('id'=>'tipo'));?>
</fieldset>
</form>
 
<table id="theTable">
    <thead>
        <tr>
            <th width="10">Eliminar</th> 
            <th>Oficial</th>             
            <th>Derivado a:</th>             
            <th>Accion:</th> 
            <th>Adjunto:</th> 
        </tr>
    </thead>  
    <tbody>
       
    </tbody>
</table>
<br>
<br>
<div class="info" style="text-align:center;">
    <p><span style="float: left; margin-right: .3em;" class=""></span>    
      &larr;<a onclick="javascript:history.back(); return false;" href="#" style="font-weight: bold; text-decoration: underline;  " > Regresar<a/></p>    
</div>
</div>
</div>