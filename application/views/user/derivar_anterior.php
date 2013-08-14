<script type="text/javascript">
    function ajaxs(){
        $('#theTable tbody tr').remove();
        var nombre=$('#nombre').val();
        $('.copias').each(function(i){
            $c=$(this);
            if($c.attr('checked')){
                var s=$c.next().text();
                $('#theTable tbody').append('<tr><td>'+nombre+'</td><td>'+s+'</td><td>'+s+'</td></tr>');
                
            }
        });
        $.ajax({
	            type: "POST",
	            data: { },
	            url: "../../ajax/derivar",
	            dataType: "json",
	            success: function(data)
	            {                        
	               $.each(data, function(x,item){
                          $('#theTable tbody').append('<tr><td>'+item+'</td></tr>');
                          
                       });
	            }
          });
    }
$(function() {
   var $ui = $('#frmDerivacion');
$ui.find('.copias').bind('focus click',function(){ $ui.find('.sb_down').addClass('sb_up').removeClass('sb_down').andSelf().find('.sb_dropdown2').show();});
$ui.bind('mouseleave',function(){$ui.find('.sb_up').addClass('sb_down').removeClass('sb_up').andSelf().find('.sb_dropdown2').hide();});
$('#all').bind('click',function(){$(".copias").attr('checked',this.checked).attr('disabled',this.checked);});
$('#oficial').bind('change',function(){
    var ids=$(this).val(); 
    var id;
    $('.copias').each(function(i){
        var $ck=$(this);
        id=$ck.attr('id');
        if(id==ids){
            $ck.attr('disabled','disabled');
            $ck.removeAttr('checked');
        }
        else{
            $ck.removeAttr('disabled');
            }
    });
    $(':checkbox[id="'+id+']').attr('disabled','disabled');    
});
//$('#frmDerivar').validate();

$('#vista').click(function(){
 ajaxs();
return false;
});

});
</script>
<h2>Derivar Correspondencia<br/><span>Llene correctamente el siguiente formulario</span></h2>
<fieldset><legend>Formulario de Derivacion</legend>
    <?php echo Form::open(URL::base().'derivar/hs/'.$documento->id_nuri,array('id'=>'frmDerivar'));?>
<table style="width: 100%;">
    <thead>
        <tr>
            <th colspan="3"></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td rowspan="4" class="fondo_nur">
                <?php
                if(substr($documento->codigo, 1,1)=='I'){
                        //echo 'NURI';
                }else{}                
                       //  echo 'NUR';
                ?>
                <?php echo $documento->nuri;?>
                <?php echo Form::hidden('nombre',$documento->nombreRemitente,array('id'=>'nombre'));?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo Form::label('derivar', 'Documento:');?>
                <br/>
                <b><?php echo $documento->codigo;?></b>
            </td>
            <td>
                <?php echo Form::label('derivar', 'Derivar a :<span class="pasos">1</span>');?>
                <br/>
                <?php echo Form::select('oficial', $options, NULL, array('id'=>'oficial','class'=>'required'));?>
            </td>
        </tr>
        <tr>
            <td>                
                <?php echo Form::label('detinatario', 'Destinatario:')?>
                <br/>
                <?php echo $documento->nombreDestinatario;?>
                <br/>
                <b><?php echo $documento->cargoDestinatario;?></b>
            </td>
            <td rowspan="2">
                <?php echo Form::label('cc', 'CC:');?>
                <br/>
                <div id="cc">
                    <ul id="ccs" >
                        <?php foreach($options as $k=>$v):?>        
                          <li><input type="checkbox" value="<?php echo $k;?>"  name="cc[]" class="copias" id="<?php echo $k;?>"/><label class="lbc"><?php echo $v;?></label></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo Form::label('referencia', 'Referencia:');?>
                <br/>
                <?php echo $documento->referencia;?>
                
            </td>
        </tr>
       
            <td >
                <?php echo Form::label('accion','Acci&oacute;n: <span class="pasos">2</span>');?>
                <br/>
                <?php echo Form::select('accion', $acciones, NULL, array('class'=>'required')); ?>
            </td>
            <td colspan="2" >
                <?php echo Form::label('proveido', 'Proveido: <span class="pasos">3</span>');?>
                <br/>
                <?php echo Form::input('proveido', '', array('size'=>105,'class'=>'required'));?>
            </td>
        </tr>
    </tbody>
    <tfoot>
        
    </tfoot>
</table>
    <hr/>
    <?php echo Form::button('cancelar', 'Cancelar',array('class'=>'submitbutton'));?>

    
    <?php echo Form::button('submit', 'Derivar Documento<span class="pasos">5</span>',array('class'=>'submitbutton'));?>        
<?php echo Form::close();?>
</fieldset>
<?php echo Form::button('ccc', 'Vista Previa<span class="pasos">4</span>',array('class'=>'submitbutton','id'=>'vista_prevsia'));?>
<br/>
    <?php echo HTML::anchor('','vista previa',array('id'=>'vista'));?>
<table id="theTable">
    <thead>
        <tr>
            <th>Derivado por:</th> 
            <th>Derivado a:</th> 
            <th>Fecha:</th> 
            <th>Accion:</th> 
        </tr>
    </thead>  
    <tbody>
        
    </tbody>
</table>
<?php echo Request::current();?>