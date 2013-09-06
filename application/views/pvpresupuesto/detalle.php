<script type="text/javascript">
$(function(){
    $('#fuente').change(function(){
        ajaxppt();
    });
    function ajaxppt()
    {
        var id = $('#fuente').val();
        control = $('#saldoppt');
        if(id){
            var pasaje = $('#total_pasaje').val();
            var viatico = $('#total_viatico').val();
            var viaje = $('#id_tipoviaje').val();
            var gasto = $('#gasto_representacion').val();
            $.ajax({
                type: "POST",
                data: { id: id, pasaje:pasaje, viatico:viatico, viaje:viaje, gasto:gasto},
                url: "/pvajax/pptdisponibleuser",
                dataType: "json",
                success: function(item)
                {
                    $(control).html(item);
                },
                error: $(control).html('Error'),
                });
        }
        else
            control.html('NO HAY FUENTE DE FINANCIMIENTO SELECCIONADA.');
    }
    
    $('#frmEditarFucov').validate();
    $('.autorizar').live('click', function() {
        var answer = confirm("Esta seguro de Autorizar el FUCOV? ")
        if (answer)
            return true;
        return false;
});
});
</script>
<?php 
    if($pvfucov->tipo_moneda == '0')
        $moneda = 'Bs.';
    else
        $moneda = '$us.';
?>
<input type="hidden" id="id_fucov" value="<?php echo $pvfucov->id;?>" />
<h2 style="text-align: center;"> PRESUPUESTO</h2>
        <div class="formulario">
TOTAL PASAJES: <?php echo Form::input('total_pasaje', $pvfucov->total_pasaje, array('id' => 'total_pasaje', 'size' => 8,'readonly')); echo $moneda; ?><br />
TOTAL VIATICOS: <?php echo Form::input('total_viatico', $pvfucov->total_viatico, array('id' => 'total_viatico', 'size' => 8,'readonly')); echo $moneda; ?><br />
GASTO REP: <?php echo Form::input('gasto_representacion', $pvfucov->gasto_representacion, array('id' => 'gasto_representacion', 'size' => 8,'readonly')); echo $moneda; ?><br />
<?php echo Form::hidden('id_tipoviaje', $pvfucov->id_tipoviaje, array('id' => 'id_tipoviaje', 'size' => 8,'readonly'))?><br />
    <form id="frmEditarFucov" action="/pvpresupuesto/editarfucov/<?php echo $pvfucov->id;?>" method="post">
        <div style="border-bottom: 1px solid #ccc; background: #F2F7FC; display: block; padding: 10px 0;   width: 100%;  ">
        <hr/>
            <fieldset>
                <table>
                    <tr>
                        <td>Fuentes de Financiamiento:<?php echo Form::select('fuente', $fuente, $pvfucov->id_programatica, array('id' => 'fuente', 'class' => 'required')) ?></td> 
                        <td><input type="submit" value="Actualizar Fucov" class="uibutton" name="submit" id="crear" title="Actualizar"/></td>
                    </tr>
                </table>
            </fieldset>
        </div>
    </form>
    <div id="saldoppt"><?php echo $partidasgasto; ?></div>
        </div>
    <a href="/pdf/certificacionppt.php?id=<?php echo $pvfucov->id_documento;?>&f=<?php echo $pvfucov->id?>" class="link pdf" target="_blank" title="Imprimir PDF" >PDF</a>
    <?php if($pvfucov->etapa_proceso == 2):?>
         <div id="msg4" class="info2"><b>!!!EL FUCOV NO FUE AUTORIZADO POR PLANIFICACION.</b></div>
    <?php endif;?>
    <?php if($pvfucov->etapa_proceso == 3):?>
    <a href="/pvpresupuesto/autorizarfucov/<?php echo $pvfucov->id; ?>" class="autorizar" title="Autorizar FUCOV" >Autorizar FUCOV</a>
    <?php endif;?>
    <?php if($pvfucov->etapa_proceso == 4):?>
        <a href="/hojaruta/derivar/?id_doc=<?php echo $pvfucov->id_memo; ?>" class="link derivar" title="Derivar a partir del documento, si ya esta derivado muestra el seguimiento" >Derivar</a>
    <?php endif;?>
<br />
<br />
&nbsp;
