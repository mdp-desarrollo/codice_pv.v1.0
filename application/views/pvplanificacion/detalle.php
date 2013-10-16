<script type="text/javascript">
$(function(){
$('#obj_gestion').change(function(){
            var id = $('#obj_gestion').val();
            $('#det_obj_gestion').html('');
            $('#obj_esp').html('');
            $('#det_obj_esp').html('');
            $('#actividad').html('');
            $('#det_act').html('');
            var act = 'detobjgestion';///detalle del Objetivo de Gestion 
            var ctr = $('#det_obj_gestion');
            ajaxs(id, act, ctr);
            act = 'objespecifico';
            ctr = $('#obj_esp');
            ajaxs(id, act, ctr);
        });
        $('#obj_esp').change(function(){
            var id = $('#obj_esp').val();
            $('#det_obj_esp').html('');
            $('#actividad').html('');
            $('#det_act').html('');
            var act = 'detobjespecifico';///detalle del Objetivo Especifico 
            var ctr = $('#det_obj_esp');
            ajaxs(id, act, ctr);
            act = 'actividad';///actividades 
            ctr = $('#actividad');
            ajaxs(id, act, ctr);
            
        });
        $('#actividad').change(function(){
            var id = $('#actividad').val();
            $('#det_act').html('');
            var act = 'detactividad';///detalle del Objetivo Especifico 
            var ctr = $('#det_act');
            ajaxs(id, act, ctr);
            
        });
        
        function ajaxs(id, accion, control)
        {        
            $.ajax({
                type: "POST",
                data: { id: id},
                url: "/pvajax/"+accion,
                dataType: "json",
                success: function(item)
                {
                    $(control).html(item);
                },
                error: $(control).html(''),
            });
        }
$('#frmEditarpoa').validate();
$('.autorizar').live('click', function() {
        var answer = confirm("Esta seguro de Autorizar el FUCOV? ")
        if (answer)
            return true;
        return false;
});
});
</script>
<?php 
?>
    <div class="formulario" style="padding: 20px 0;">        
        <div style="border-bottom: 1px solid #ccc; background: #F2F7FC; display: block; padding: 0px 0;   width: 100%;  ">
            <h2 style="text-align:center;">Certificaci&oacute;n POA </h2><hr/><hr />
            <form action="/pvplanificacion/editarpoa/<?php echo $pvfucov->id; ?>" method="post" id="frmEditarpoa" >
            <fieldset>
                    <table width="100%" border="0px">
                        <tr>
                            <td><?php echo Form::label('unidad_ejecutora', 'Unidad Ejecutora POA:', array('class' => 'form')); ?></td>
                            <td><?php echo $ue_poa->oficina ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo Form::label('obj_gestion', 'C&oacute;digo Objetivo de Gesti&oacute;n:', array('class' => 'form')); ?></td>
                            <td><?php echo Form::select('obj_gestion', $obj_gestion, $pvpoas->id_obj_gestion, array('class' => 'form', 'name' => 'obj_gestion', 'id' => 'obj_gestion', 'class' => 'required')); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo Form::label('detalle_obj_gestion', 'Detalle Objetivo de Gesti&oacute;n:', array('class' => 'form')); ?></td>
                            <td><br />
                                <textarea name="det_obj_gestion" id="det_obj_gestion" style="width: 600px;" readonly rows="5" ><?php echo $det_obj_gestion; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo Form::label('obj_esp', 'C&oacute;digo Objetivo Espec&iacute;fico:', array('class' => 'form')); ?></td>
                            <td><?php echo Form::select('obj_esp', $obj_esp, $pvpoas->id_obj_esp, array('class' => 'form', 'class' => 'required', 'id' => 'obj_esp', 'name' => 'obj_esp')); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo Form::label('det_obj_esp', 'Detalle Objetivo Espec&iacutefico:', array('class' => 'form')); ?></td>
                            <td><textarea name="det_obj_esp" id="det_obj_esp" style="width: 600px;" readonly rows="5" ><?php echo $det_obj_esp; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><b><?php echo Form::label('actividad', 'C&oacute;digo Actividad', array('class' => 'form')); ?></b></td>
                            <td><?php echo Form::select('actividad', $actividad, $pvpoas->id_actividad, array('class' => 'form', 'class' => 'required', 'id' => 'actividad', 'name' => 'actividad')); ?></td>
                        </tr>
                        <tr>
                            <td><b><?php echo Form::label('det_act', 'Detalle:', array('class' => 'form')); ?></b></td>
                            <td><br />
                                <textarea name="det_act" id="det_act" style="width: 600px;" readonly rows="5" ><?php echo $det_act; ?></textarea>
                            </td>
                        </tr>
                    </table>
            </fieldset>
            <div style="text-align: center;"> <input type="submit" name="documento" value="Modificar documento" class="uibutton" /></div>
            </form>
        </div>
    <center>
        <a href="/pdf/certificacionpoa.php?id=<?php echo $pvfucov->id_documento;?>&f=<?php echo $pvfucov->id?>" class="link pdf" target="_blank" title="Imprimir PDF" >imprimir Certificado</a>
        <?php if($pvfucov->etapa_proceso == 1):?>
             <div id="msg4" class="info2"><b>!!!EL FUCOV NO FUE AUTORIZADO POR PASAJES Y VIATICOS.</b></div>
        <?php endif;?>
                <?php if($pvfucov->etapa_proceso == 2):?>
        <a href="/pvplanificacion/autorizarfucov/<?php echo $pvfucov->id; ?>" class="autorizar" title="Autorizar FUCOV" ><img src="/media/images/tick.png"/>Autorizar FUCOV</a>
        <?php endif;?>
        <?php if($pvfucov->etapa_proceso == 3):?>
            <a href="/hojaruta/derivar/?id_doc=<?php echo $pvfucov->id_memo; ?>" class="link derivar" title="Derivar a partir del documento, si ya esta derivado muestra el seguimiento" >Derivar</a>
        <?php endif;?>
        <br />
    </center>
    </div>


