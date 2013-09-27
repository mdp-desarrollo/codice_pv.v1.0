<script type="text/javascript">

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
    });          
}

$(function(){
    $('#programa').change(function(){
        var id = $('#programa').val();
        if(id == 0){
            $('#proyecto').html('');
            $('#actividad').html('');
            }
        else{
            var act = 'proyectoppt';
            var ctrl = $('#proyecto');
            ajaxs(id, act, ctrl);
            act = 'actividadppt';
            ctrl = $('#actividad');
            ajaxs(id, act, ctrl);
            //alert(id);
        }
    });
    
    $('#frmCreate').validate();
});
</script>
<style>
    #file-word{ display: none;  }
    td{padding:5px;}    
</style>
<h2 class="subtitulo">Ejecuci&oacute;n Presupuestaria:<br/> <span>Seleccione los datos en el formulario.</span></h2>
<form action="/pvpresupuesto/addejecucionppt/" method="post" id="frmCreate">
<table border="0px">
    <tr>
        <td>Entidad:</td>
        <td><?php echo $entidad;?></td>
    </tr>
    <tr>
        <td>Oficina:</td>
        <td><?php echo Form::select('oficina',$oficina);?></td>
    </tr>
    <tr>
        <td>DA:</td>
        <td><?php echo Form::select('da',$da);?></td>
    </tr>
    <tr>
        <td>UE:</td>
        <td><?php echo Form::select ('ue',$ue);?></td>
    </tr>
    <tr>
        <td>Programa:</td>
        <td><?php echo Form::select('programa',$programa,'',array('id'=>'programa','name'=>'programa','class'=>'required'));?>
        </td>
    </tr>
    <tr>
        <td>Proyecto:</td>
        <td><?php echo Form::select('proyecto',NULL,'',array('id'=>'proyecto','name'=>'proyecto','class'=>'required'));?></td>
    </tr>
    <tr>
        <td>Actividad:</td>
        <td><?php echo Form::select('actividad',NULL,'',array('id'=>'actividad','name'=>'actividad','class'=>'required'));?></td>
    </tr>
    <tr>
        <td>Fuente:</td>
        <td><?php echo Form::select('fuente',$fuente);?></td>
    </tr>
    <tr>
        <td>Organismo:</td>
        <td><?php echo Form::select('organismo',$organismo);?></td>
    </tr>
    <tr>
        <td>Gesti&oacute;n:</td>
        <td><?php echo Form::select('gestion',array('2013'=>'2013','2014'=>'2014'),'2013');?></td>
    </tr>
</table>
<br />

<input type="submit" value="Adicionar" class="uibutton" name="submit" id="crear" title="Crear Ejecuci&oacute;n Presupuestaria."  />
</form>