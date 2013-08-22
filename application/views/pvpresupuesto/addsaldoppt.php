<script type="text/javascript">

$(function(){
    $("#inicial,#modificado,#vigente,#preventivo,#comprometido,#devengado,#saldoDevengado,#pagado,#saldoPagar,#gestion").keydown(function(event) {
        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 ||
            (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode >= 35 && event.keyCode <= 39) || (event.keyCode == 110 || event.keyCode == 190) ) {
                return;
            }
            else {
            
                if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) ) {
                    event.preventDefault();
                }
            }   
    });
    $('#frmCreate').validate();
});//document.ready
</script>
<style>
    #file-word{ display: none;  }
    td{padding:5px;}    
</style>
<h2 class="subtitulo">Estado de la Ejecuci&oacute;n Presupuestaria<br/><?php echo $detalle->unidad_funcional;?> <span>Lista de Partidas de Gastos</span></h2>
<table>
    <tr>
        <td>Entidad:</td>
        <td><?php echo $detalle->sigla;?></td>
        <td><?php echo $detalle->entidad;?></td>
    </tr>
    <tr>
        <td>DA:</td>
        <td><?php echo $detalle->codigo_da;?></td>
        <td><?php echo $detalle->da;?></td>
    </tr>
    <tr>
        <td>UE:</td>
        <td><?php echo $detalle->codigo_ue;?></td>
        <td><?php echo $detalle->ue;?></td>
    </tr>
    <tr>
        <td>Cat. Prog.:</td>
        <td><?php echo $detalle->codigo_prog.' &nbsp '.$detalle->codigo_proy.' &nbsp '.$detalle->codigo_act;?></td>
        <td><?php echo $detalle->actividad;?></td>
    </tr>
    <tr>
        <td>Fuente:</td>
        <td><?php echo $detalle->codigo_fte;?></td>
        <td><?php echo $detalle->fte;?></td>
    </tr>
    <tr>
        <td>Organismo:</td>
        <td><?php echo $detalle->codigo_org;?></td>
        <td><?php echo $detalle->org;?></td>
    </tr>
</table>
<br />
<h2>Adicionar Partida de Gasto a la Ejecucion presupuestaria</h2>
<form action="/pvpresupuesto/addsaldoppt/<?php echo $id_programatica;?>" method="post" id="frmCreate">
<table>
    <tr>
        <td><?php echo Form::label('partidas','Partida')?></td>
        <td><?php echo Form::select('partidas',$partidas,'',array('class'=>'required'));?></td>
    </tr>
    <tr>
        <td><?php echo Form::label('inicial','Presupuesto Inicial')?></td>
        <td><?php echo Form::input('inicial','0',array('name'=>'inicial','id'=>'inicial','class'=>'required')) ?></td>
    </tr>
    <tr>
        <td><?php echo Form::label('modificado','Modificado')?></td>
        <td><?php echo Form::input('modificado','0',array('name'=>'modificado','id'=>'modificado','class'=>'required')) ?></td>
    </tr>
    <tr>
        <td><?php echo Form::label('vigente','Vigente')?></td>
        <td><?php echo Form::input('vigente','0',array('name'=>'vigente','id'=>'vigente','class'=>'required')) ?></td>
    </tr>
    <tr>
        <td><?php echo Form::label('preventivo','Preventivo')?></td>
        <td><?php echo Form::input('preventivo','0',array('name'=>'preventivo','id'=>'preventivo','class'=>'required')) ?></td>
    </tr>
    <tr>
        <td><?php echo Form::label('comprometido','Comprometido')?></td>
        <td><?php echo Form::input('comprometido','0',array('name'=>'comprometido','id'=>'comprometido','class'=>'required')) ?></td>
    </tr>
    <tr>
        <td><?php echo Form::label('devengado','Devengado')?></td>
        <td><?php echo Form::input('devengado','0',array('name'=>'devengado','id'=>'devengado','class'=>'required')) ?></td>
    </tr>
    <tr>
        <td><?php echo Form::label('saldoDevengado','Saldo Devengado')?></td>
        <td><?php echo Form::input('saldoDevengado','0',array('name'=>'saldoDevengado','id'=>'saldoDevengado','class'=>'required')) ?></td>
    </tr>
    <tr>
        <td><?php echo Form::label('pagado','Pagado')?></td>
        <td><?php echo Form::input('pagado','0',array('name'=>'pagado','id'=>'pagado','class'=>'required')) ?></td>
    </tr>
    <tr>
        <td><?php echo Form::label('saldoPagar','Saldo Pagar')?></td>
        <td><?php echo Form::input('saldoPagar','0',array('name'=>'saldoPagar','id'=>'saldoPagar','class'=>'required')) ?></td>
    </tr>
    <tr>
        <td><?php echo Form::label('gestion','Gesti&oacute;n')?></td>
        <td><?php echo Form::select('gestion',array('2013'=>'2013','2014'=>'2014'),'',array('name'=>'saldoPagar','id'=>'saldoPagar','class'=>'required')) ?></td>
    </tr>
</table>
<input type="submit" value="Adicionar" class="uibutton" name="submit" id="crear" title="Crear Ejecuci&oacute;n Presupuestaria."  />
</form>