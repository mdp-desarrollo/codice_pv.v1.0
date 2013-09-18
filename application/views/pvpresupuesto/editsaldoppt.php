<script type="text/javascript">
$(function(){
    $("#inicial, #modificado, #vigente, #preventivo, #comprometido,#devengado, #saldoDevengado,#pagado,#saldoPagar").keydown(function(event) {
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
<?php ?>
<h2 class="subtitulo">Estado de la Ejecuci&oacute;n Presupuestaria<br/><?php echo $detalle->unidad_funcional;?> <br /><span>Lista de Partidas de Gastos</span></h2>
<table>
    <tr>
        <td style="width: 20%"><b>Entidad:</b></td>
        <td style="width: 20%;"><?php echo $detalle->sigla;?></td>
        <td><?php echo $detalle->entidad;?></td>
    </tr>
    <tr>
        <td><b>Direccion Administrativa:</b></td>
        <td><?php echo $detalle->codigo_da;?></td>
        <td><?php echo $detalle->da;?></td>
    </tr>
    <tr>
        <td><b>Unidad Ejecutora:</b></td>
        <td><?php echo $detalle->codigo_ue;?></td>
        <td><?php echo $detalle->ue;?></td>
    </tr>
    <tr>
        <td><b>Categoria Programatica:</b></td>
        <td><?php echo $detalle->codigo_prog.' &nbsp '.$detalle->codigo_proy.' &nbsp '.$detalle->codigo_act;?></td>
        <td><?php echo $detalle->actividad;?></td>
    </tr>
    <tr>
        <td><b>Fuente:</b></td>
        <td><?php echo $detalle->codigo_fte;?></td>
        <td><?php echo $detalle->fte;?></td>
    </tr>
    <tr>
        <td><b>Organismo:</b></td>
        <td><?php echo $detalle->codigo_org;?></td>
        <td><?php echo $detalle->org;?></td>
    </tr>
</table><?php ?>
<br />
<h2>Modificar Partida de Gasto a la Ejecucion presupuestaria</h2>
<div style="border-bottom: 1px solid #ccc; background: #F2F7FC; display: block; padding: 10px 0;   width: 800px;  ">
<?php if (sizeof($mensajes) > 0): ?>
                    <div class="info">
                        <p><span style="float: left; margin-right: .3em;" class="ui-icon-info"></span>
                            <?php foreach ($mensajes as $k => $v): ?>
                                <strong><?= $k ?>: </strong> <?php echo $v; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?> 
<form action="/pvpresupuesto/editsaldoppt/<?php echo $ejecucion->id;?>" method="post" id="frmCreate">
<table class="classy" border="1">
    <tr>
        <thead>
            <th style="width: 25%;">Detalle</th>
            <th style="width: 25%;">Saldo Actual</th>
            <th style="width: 25%;">Nuevo saldo:</th>
        </thead>
    </tr>
    <tr>
        <td><?php echo Form::label('inicial','Presupuesto Inicial')?></td>
        <td><?php echo $ejecucion->inicial?></td>
        <td><?php echo Form::input('inicial',$ejecucion->inicial,array('name'=>'inicial','id'=>'inicial','class'=>'required')) ?></td>
        
    </tr>
    <tr>
        <td><?php echo Form::label('modificado','Modificado')?></td>
        <td><?php echo $ejecucion->modificado?></td>
        <td><?php echo Form::input('modificado',$ejecucion->modificado,array('name'=>'modificado','id'=>'modificado','class'=>'required')) ?></td>
    </tr>
    <tr>
        <td><?php echo Form::label('vigente','Vigente')?></td>
        <td><?php echo $ejecucion->vigente?></td>
        <td><?php echo Form::input('vigente',$ejecucion->vigente,array('name'=>'vigente','id'=>'vigente'))?></td>
    </tr>
    <tr>
        <td><?php echo Form::label('preventivo','Preventivo')?></td>
        <td><?php echo $ejecucion->preventivo?></td>
        <td><?php echo Form::input('preventivo',$ejecucion->preventivo,array('name'=>'preventivo','id'=>'preventivo','class'=>'required')) ?></td>
        
    </tr>
    <tr>
        <td><?php echo Form::label('comprometido','Comprometido')?></td>
        <td><?php echo $ejecucion->comprometido?></td>
        <td><?php echo Form::input('comprometido',$ejecucion->comprometido,array('name'=>'comprometido','id'=>'comprometido','class'=>'required')) ?></td>
    </tr>
    <tr>
        <td><?php echo Form::label('devengado','Devengado')?></td>
        <td><?php echo $ejecucion->devengado?></td>
        <td><?php echo Form::input('devengado',$ejecucion->devengado,array('name'=>'devengado','id'=>'devengado','class'=>'required')) ?></td>
    </tr>
    <tr>
        <td><?php echo Form::label('saldoDevengado','Saldo Devengado')?></td>
        <td><?php echo $ejecucion->saldo_devengado?></td>
        <td><?php echo Form::input('saldoDevengado',$ejecucion->saldo_devengado,array('name'=>'saldoDevengado','id'=>'saldoDevengado','class'=>'required')) ?></td>
    </tr>
    <tr>
        <td><?php echo Form::label('pagado','Pagado')?></td>
        <td><?php echo $ejecucion->pagado?></td>
        <td><?php echo Form::input('pagado',$ejecucion->pagado,array('name'=>'pagado','id'=>'pagado','class'=>'required')) ?></td>
    </tr>
    <tr>
        <td><?php echo Form::label('saldoPagar','Saldo Pagar')?></td>
        <td><?php echo $ejecucion->saldo_pagar?></td>
        <td><?php echo Form::input('saldoPagar',$ejecucion->saldo_pagar,array('name'=>'saldoPagar','id'=>'saldoPagar','class'=>'required')) ?></td>
    </tr>
    <tr>
        <td><?php echo Form::label('gestion','Gesti&oacute;n')?></td>
        <td><?php echo Form::select('gestion',array('2013'=>'2013','2014'=>'2014'),'',array('name'=>'saldoPagar','id'=>'saldoPagar','class'=>'required')) ?></td>
        <td></td>
    </tr>
</table>
<input type="submit" value="Modificar" class="uibutton" name="submit" id="crear" title="Modificar Saldo Presupuesto."  />
</form>
</div>