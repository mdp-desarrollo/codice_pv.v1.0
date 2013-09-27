<script type="text/javascript">
$(function(){
    $('#replace').click(function(){ 
       $(this).hide();
       $('#file-word').fadeIn();
       $('#archivo').trigger('click');       
   });
    $('#cancelar').click(function(){ 
       $('#replace').show();
       $('#file-word').hide();       
   });
    
});
</script>
<style>
#file-word{ display: none;  }
*{ font-size: 13px; }
</style>

<?php 
$label_destinatario = 'Destinatario';
$label_Remitente = 'Remitente';

if($d->id_tipo==13){
    $label_destinatario = 'Autoriza el Viaje';
    $label_Remitente = 'Funcionario en Comisión';
}
 ?>

<h2 style="text-align: center;"><?php // echo strtoupper($d->id_tipo);?></h2>
<h2 style="text-align: center; color: #23599B;"><?php echo $d->cite_original;?></h2>
<h2 style="text-align: center;"><?php echo $d->nur;?></h2>
<hr/>
<table border="0">
    <tr>
        <td><b><?php echo $label_destinatario ?>:</b></td>
        <td colspan="2"><?php echo $d->nombre_destinatario;?><br/><b><?php echo $d->cargo_destinatario;?></b></td>
    </tr>
    <?php if(trim($d->nombre_via)!=''){ ?>
    <tr> 
        <td><b>Via:</b><br/> </td>
        <td colspan="2"><?php echo $d->nombre_via;?><br/><b><?php echo $d->cargo_via;?></b></td>
    </tr>
    <?php } ?>
    <tr> 
        <td><b><?php echo $label_Remitente ?>:</b><br/> </td>
        <td colspan="2"><?php echo $d->nombre_remitente;?><br/><b><?php echo $d->cargo_remitente;?></b></td>
    </tr>
    <tr> 
        <td><b>Fecha de Creación:</b><br/> </td>
        <td colspan="2"><?php echo Date::fecha($d->fecha_creacion);?></td>
    </tr>
    <?php
    echo Form::open('documentos/detalle/?id='.$d->id,array('id'=>'frmDerivar','enctype'=>'multipart/form-data'));
    echo Form::hidden('id_doc', $d->id);
    if($archivo->id){ ?>
    <tr> 
        <td><b>Archivo:</b><br/></td>
        <td colspan="2"><?php echo HTML::anchor('/descargar.php?id='.$archivo->id,substr($archivo->nombre_archivo,13));?><br/></td>
    </tr>    
    <?php }    
    echo Form::close();
    ?>
    <tr> <td><b>Referencia:</b><br/> </td>
     <td colspan="2"><?php echo $d->referencia;?></td>
 </tr>

 <tr><td colspan="3"><hr/></td></tr>
 <?php if(trim($d->contenido)!=''){ ?>
 <tr> <td><br/> </td>
    <td colspan="3">
        <div style="overflow:auto; width: 650px; height: 300px;">
            <?php echo $d->contenido;?>
        </div></td>
    </tr>
    <?php } ?>
    
    <?php if ($pvfucov->loaded()) { ?>
    <tr> 
        <td colspan="3">
            <table border="1" >
                <thead>
                    <tr>
                        <th style="text-align:center;">Origén</th>
                        <th style="text-align:center;">Destino</th>
                        <th style="text-align:center;">Fecha y Hora <br>Salida</th>
                        <th style="text-align:center;">Fecha y Hora <br>Retorno</th>
                        <th style="text-align:center;">Transporte</th>
                        <th style="text-align:center;">Viaticos</th>
                        <th style="text-align:center;">Desc. IVA</th> 
                        <th style="text-align:center;">Gastos<br>Repres.</th>

                    </tr>
                </thead>
                <?php
                function dia_literal($n) {
                    switch ($n) {
                        case 1: return 'Lun';
                        break;
                        case 2: return 'Mar';
                        break;
                        case 3: return 'Mie';
                        break;
                        case 4: return 'Jue';
                        break;
                        case 5: return 'Vie';
                        break;
                        case 6: return 'Sab';
                        break;
                        case 0: return 'Dom';
                        break;
                    }
                }

                $fi = date('Y-m-d', strtotime($pvfucov->fecha_salida));
                $ff = date('Y-m-d', strtotime($pvfucov->fecha_arribo));
                $hi = date('H:i:s', strtotime($pvfucov->fecha_salida));
                $hf = date('H:i:s', strtotime($pvfucov->fecha_arribo));
                $diai = dia_literal(date("w", strtotime($fi)));
                $diaf = dia_literal(date("w", strtotime($ff)));

                if ($pvfucov->cancelar == 'Hospedaje y alimentacion' || $pvfucov->cancelar == 'Hospedaje') {
                    $cancelar = "<b>Financiado por:</b><br>" . $pvfucov->financiador . "<br><br> * " . $pvfucov->cancelar;
                } else {
                    $cancelar = "* " . $pvfucov->cancelar;
                }

                $tipo_moneda="Bs.";
                if($pvfucov->tipo_moneda==1){
                    $tipo_moneda='$us.';
                }


                ?>
                <tbody>
                    <tr style="text-align:center">
                        <td><?php echo $pvfucov->origen ?></td>
                        <td><?php echo $pvfucov->destino ?></td>
                        <td><?php echo $diai . ' ' . $fi; ?> <br><?php echo $hi ?></td>
                        <td><?php echo $diaf . ' ' . $ff; ?> <br><?php echo $hf ?></td>
                        <td><?php echo $pvfucov->transporte ?></td>
                        <td><?php echo $cancelar ?></td>
                        <td><?php echo $pvfucov->impuesto ?></td>
                        <td><?php echo $pvfucov->representacion ?></td>

                    </tr>
                </tbody>
            </table>

            <table width="100%">                       
                <tr>
                    <td colspan="3" style="padding-left: 5px;"><b>% Viaticos: </b><?php echo $pvfucov->porcentaje_viatico ?> %</td>
                </tr>
                <tr>
                    <td colspan="3" style="padding-left: 5px;"><b>Viatico x Dia:</b> <?php echo $pvfucov->viatico_dia .' '. $tipo_moneda; ?> </td>
                </tr>     
                <tr>
                    <td colspan="3" style="padding-left: 5px;"><b>Descuento IVA 13 %:</b> <?php echo $pvfucov->gasto_imp .' '. $tipo_moneda; ?></td>
                </tr> 
                <tr>    
                    <td><b>TOTAL VIATICOS:</b> <?php echo $pvfucov->total_viatico .' '. $tipo_moneda; ?></td>
                    <td width="300"><b>GASTOS DE REPRESENTACIÓN:</b> <?php echo $pvfucov->gasto_representacion .' '. $tipo_moneda; ?></td>    
                    <td><b>TOTAL PASAJES:</b> <?php echo $pvfucov->total_pasaje .' '. $tipo_moneda; ?></td>
                </tr>
                <?php  if ($pvfucov->justificacion_finsem != '') {?> 
                <tr><td colspan="2" style="padding-left: 5px;"><br><b>Justificacion Fin de Semana:</b><br><?php echo $pvfucov->justificacion_finsem; ?></td></tr>
                <?php } ?>

                </table>
            </td>
        </tr>
        
        <tr><td colspan="3"><hr/></td></tr>
        <tr>
            <td colspan="3">
            <div style="width: 650px;">
                <br>
                <p style="text-align: center;"><b>POA</b></p>
                <table width="100%" border="1">
                    <!--<tr>
                        <td style="width: 25%;"><?php //echo Form::label('unidad_ejecutora', 'Unidad Ejecutora:', array('class' => 'form')); ?></td>
                        <td style="width: 15px"><?php //echo $ue_poa ?>
                            <?php // echo Form::input('unidadEjecutora',$ue_poa,array('size'=>'75','id'=>'unidadEjecutora','name'=>'unidadEjecutora')) ?>
                        </td>
                    </tr>-->
                    <tr>
                        <td><b>Objetivo de Gesti&oacute;n:</b>&nbsp;&nbsp;&nbsp;<?php echo $pvgestion->codigo?></td>
                    </tr>
                    <tr>                        
                        <td><?php echo $pvgestion->objetivo?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><b>Objetivo Espec&iacute;fico:</b>&nbsp;&nbsp;&nbsp;<?php echo $pvespecifico->codigo?></td>
                    </tr>
                    <tr>                        
                        <td><?php echo $pvespecifico->objetivo?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><b>Actividad:</b>&nbsp;&nbsp;&nbsp;<?php echo $pvactividad->codigo?></td>
                    </tr>
                    <tr>                        
                        <td><?php echo $pvactividad->actividad?></td>
                    </tr>
                </table>
            </div>
            </td>
        </tr>

        <tr><td colspan="3"><hr/></td></tr>
        <tr>
            <td colspan="3">
                <br>
                <p style="text-align: center;"><b>PRESUPUESTO</b></p>
                <?php echo $pvliquidacion;?>
            </td>
        </tr>
    <?php } ?>
    </table>
    <?php echo Form::hidden('id',$d->id,array('id'=>'id'));?>