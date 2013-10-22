<script type="text/javascript">
$(function(){
    $('#fuente').change(function(){
        ajaxppt();
        ajaxdetalle();
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
            if(viaje > 2){
                var cambio = $('#tipo_cambio').val();
                viatico = (viatico * cambio).toFixed(2);
                pasaje = (pasaje * cambio).toFixed(2);
                gasto = (gasto * cambio).toFixed(2);
            } 
            $.ajax({
                type: "POST",
                data: { id: id, pasaje:pasaje, viatico:viatico, viaje:viaje, gasto:gasto},
                url: "/pvajax/pptdisponibleuser",
                dataType: "json",
                success: function(item)
                {
                    $(control).html(item);
                },
                error: $(control).html('Error')
                });
        }
        else
            control.html('NO HAY FUENTE DE FINANCIMIENTO SELECCIONADA.');
    }
    function ajaxdetalle()
    {
        var id = $('#fuente').val();
        if(id){
            $.ajax({
                type: "POST",
                data: { id: id},
                url: "/pvajax/pptdetalle",
                dataType: "json",
                success: function(item)
                {
                    $("#sigla").html(item.sigla);
                    $("#cod_da").html(item.codigo_da);
                    $("#cod_ue").html(item.codigo_ue);
                    $("#cod_programa").html(item.codigo_prog);
                    $("#cod_proyecto").html(item.codigo_proy);
                    $("#cod_actividad").html(item.codigo_act);
                    $("#cod_org").html(item.codigo_fte);
                    $("#cod_fte").html(item.codigo_org);
                    
                    $("#entidad").html(item.entidad);
                    $("#da").html(item.da);
                    $("#ue").html(item.ue);
                    $("#programa").html(item.programa);
                    $("#proyecto").html(item.proyecto);
                    $("#actividad").html(item.actividad);
                    $("#org").html(item.org);
                    $("#fte").html(item.fte);
                }
            });
        }
        else{
            $("#sigla,#cod_da,#cod_ue,#cod_programa,#cod_proyecto,#cod_actividad,#cod_fte,#cod_org").html('');
            $("#entidad,#da,#ue,#programa,#proyecto,#actividad,#org,#fte").html('');
        }
        //alert('detalle');
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
    TOTAL PASAJES: <?php echo Form::input('total_pasaje', $pvfucov->total_pasaje, array('id' => 'total_pasaje', 'size' => 8,'readonly')); echo $moneda; ?>&nbsp;&nbsp;&nbsp;
TOTAL VIATICOS: <?php echo Form::input('total_viatico', $pvfucov->total_viatico, array('id' => 'total_viatico', 'size' => 8,'readonly')); echo $moneda; ?>&nbsp;&nbsp;&nbsp;
GASTO REP: <?php echo Form::input('gasto_representacion', $pvfucov->gasto_representacion, array('id' => 'gasto_representacion', 'size' => 8,'readonly')); echo $moneda; ?>
<?php echo Form::hidden('id_tipoviaje', $pvfucov->id_tipoviaje, array('id' => 'id_tipoviaje'))?>
<?php echo Form::hidden('tipo_cambio', $tipo_cambio->cambio_venta, array('id' => 'tipo_cambio'))?>
    <form id="frmEditarFucov" action="/pvpresupuesto/editarfucov/<?php echo $pvfucov->id;?>" method="post">
        <div style="border-bottom: 1px solid #ccc; background: #F2F7FC; display: block; padding: 10px 0;   width: 100%;  ">
        <hr/>
            <fieldset>
                <table border ="0">
                    <tr>
                        <td colspan="4"><b>Fuentes de Financiamiento:</b><?php echo Form::select('fuente', $fuente, $pvfucov->id_programatica, array('id' => 'fuente', 'class' => 'required')) ?></td> 
                        <td><input type="submit" value="Actualizar Fucov" class="uibutton" name="submit" id="crear" title="Actualizar"/></td>
                    </tr>
                    <tr>
                        <td colspan="5"><b>Estructura Program&aacute;tica:</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Entidad:</td>
                        <td><div id="sigla"><?php echo $detallefuente->sigla?></div></td>
                        <td><div id="entidad"><?php echo $detallefuente->entidad?></div></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Direccion Administrativa:</td>
                        <td><div id="cod_da"><?php echo $detallefuente->codigo_da?></div></td>
                        <td><div id="da"><?php echo $detallefuente->da?></div></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Unidad Ejecutora:</td>
                        <td><div id="cod_ue"><?php echo $detallefuente->codigo_ue?></div></td>
                        <td><div id="ue"><?php echo $detallefuente->ue;?></div></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Programa:</td>
                        <td><div id="cod_programa"><?php echo $detallefuente->codigo_prog?></div></td>
                        <td><div id="programa"><?php echo $detallefuente->programa;?></div></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Proyecto:</td>
                        <td><div id="cod_proyecto"><?php echo $detallefuente->codigo_proy;?></div></td>
                        <td><div id="proyecto"><?php echo $detallefuente->proyecto;?></div></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Actividad:</td>
                        <td><div id="cod_actividad"><?php echo $detallefuente->codigo_act?></div></td>
                        <td><div id="actividad"><?php echo $detallefuente->actividad?></div></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Fuente:</td>
                        <td><div id="cod_fte"><?php echo $detallefuente->codigo_fte;?></div></td>
                        <td><div id="fte"><?php echo $detallefuente->fte;?></div></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Organismo:</td>
                        <td><div id="cod_org"><?php echo $detallefuente->codigo_org;?></div></td>
                        <td><div id="org"><?php echo $detallefuente->org;?></div></td>
                        <td></td>
                    </tr>
                </table>
            </fieldset>
        </div>
    </form>
    <div id="saldoppt"><?php echo $partidasgasto; ?></div>
    </div>
    <center>
        <a href="/pdf/certificacionppt.php?id=<?php echo $pvfucov->id_documento;?>&f=<?php echo $pvfucov->id?>" class="link pdf" target="_blank" title="Imprimir PDF" >PDF</a>
        <?php if($pvfucov->etapa_proceso == 2):?>
             <div id="msg4" class="info2"><b>!!!EL FUCOV NO FUE AUTORIZADO POR PLANIFICACION.</b></div>
        <?php endif;?>
        <?php if($pvfucov->etapa_proceso == 3):?>
        <a href="/pvpresupuesto/autorizarfucov/<?php echo $pvfucov->id; ?>" class="autorizar" title="Autorizar FUCOV" ><img src="/media/images/tick.png"/>Autorizar FUCOV</a>
        <?php endif;?>
        <?php if($pvfucov->etapa_proceso == 4):?>
            <a href="/hojaruta/derivar/?id_doc=<?php echo $pvfucov->id_memo; ?>" class="link derivar" title="Derivar a partir del documento, si ya esta derivado muestra el seguimiento" >Derivar</a>
        <?php endif;?>
    </center>
<br />
<br />
&nbsp;
