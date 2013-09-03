<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Pvajax extends Controller {
    public function action_proyectoppt()
    {   
        $id = $_POST['id'];
        $proyecto = ORM::factory('pvproyectos')->where('id_programa','=',$id)->and_where('estado','=',1)->find_all();
        $obj = '<option value = "0" selected>0000</option>';
        if($proyecto->count() > 0)
        {
            //$obj = '';
            foreach($proyecto as $p){
                $obj = $obj.'<option value="'.$p->id.'">'.$p->codigo.' - '.$p->proyecto.'</option>';
            }
        }
        /*else
        {
            $obj = '<option value = "0" selected>0000</option>';
        }*/
        echo json_encode($obj);
    }
    
    public function action_actividadppt()
    {   
        $id = $_POST['id'];
        $actividad = ORM::factory('pvpptactividades')->where('id_programa','=',$id)->and_where('estado','=',1)->find_all();
        $obj = '<option value = "0" selected>000</option>';
        
        if($actividad->count() > 0)
        {
            foreach($actividad as $a){
                $obj = $obj.'<option value="'.$a->id.'">'.$a->codigo.' - '.$a->actividad.'</option>';
            }
        }
        echo json_encode($obj);
    }

public function action_detobjgestion()
    {       
        $id = $_POST['id'];
        $objetivo = ORM::factory('pvogestiones')->where('id','=',$id)->find();
        $desc = $objetivo->objetivo;
        echo json_encode($desc);
    }

public function action_objespecifico()
    {       
        $id = $_POST['id'];
        $objetivo = ORM::factory('pvoespecificos')->where('id_obj_gestion','=',$id)->find_all();
        $obj = '<option value = "" selected>Seleccione Objetivo Especifico</option>';
        foreach($objetivo as $o){
            $obj = $obj.'<option value="'.$o->id.'">'.$o->codigo.'</option>';
        }        
        echo json_encode($obj);
    }
    
public function action_detobjespecifico()
    {       
        $id = $_POST['id'];
        $objetivo = ORM::factory('pvoespecificos')->where('id','=',$id)->find();
        $desc = $objetivo->objetivo;
        echo json_encode($desc);
    }

public function action_pptdisponibleuser()
    {
        $id = $_POST['id'];
        $pasaje = $_POST['pasaje'];
        $viatico = $_POST['viatico'];
        $viaje = $_POST['viaje'];
        $gasto = $_POST['gasto'];
        
        $oDisp = new Model_Pvprogramaticas();
        $disp = $oDisp->saldopresupuesto($id);
        $result = "<table class=\"classy\" border=\"1px\"><thead><th>C&oacute;digo</th><th>Partida</th><th>Saldo Disponible</th><th>Solicitado (Bs.)</th><th>Nuevo Saldo</th></thead><tbody>";
        foreach($disp as $d)
        {
            if( $viaje == 1 || $viaje == 2){
                if( $d['codigo'] == '22110')///pasaje al interio del pais
                    $result .= "<tr><td>".$d['codigo']."</td><td>".$d['partida']."</td><td>".$d['saldo_devengado']."</td><td>".$pasaje."</td><td>".($d['saldo_devengado'] - $pasaje)."</td></tr>";
                if( $d['codigo'] == '22210')///viatico al interior
                    $result .= "<tr><td>".$d['codigo']."</td><td>".$d['partida']."</td><td>".$d['saldo_devengado']."</td><td>".$viatico."</td><td>".($d['saldo_devengado'] - $viatico)."</td></tr>";
            }
            else
            {
                if( $d['codigo'] == '22120')///pasaje al exterior
                    $result .= "<tr><td>".$d['codigo']."</td><td>".$d['partida']."</td><td>".$d['saldo_devengado']."</td><td>".$pasaje."</td><td>".($d['saldo_devengado'] - $pasaje)."</td></tr>";
                if( $d['codigo'] == '22220')///viaticos al exterior
                    $result .= "<tr><td>".$d['codigo']."</td><td>".$d['partida']."</td><td>".$d['saldo_devengado']."</td><td>".$viatico."</td><td>".($d['saldo_devengado'] - $viatico)."</td></tr>";
                if( $d['codigo'] == '26910')///gastos de representacion
                    $result .= "<tr><td>".$d['codigo']."</td><td>".$d['partida']."</td><td>".$d['saldo_devengado']."</td><td>".$gasto."</td><td>".($d['saldo_devengado'] - $gasto)."</td></tr>";
            }
        }
        $result .= "</tbody></table>";
        echo json_encode($result);
    }
    
    public function action_feriados()
    {
        $f1 = $_POST['fecha1'];
        $f2 = $_POST['fecha2'];
        $oFer = new Model_Pvferiados();
        $fer = $oFer->feriados($f1, $f2);
        $obj = '';
        foreach($fer as $f)            
            $obj = $obj.' '.$f['detalle'].': '.date("d-m-Y",strtotime($f['fecha']));        
        echo json_encode($obj);     
    }

/*

public function action_adicionpasaje()
    {   
        $id_fucov = $_POST['id_fucov'];
        $origen = $_POST['origen'];
        $destino = $_POST['destino'];
        $fecha_salida = $_POST['fecha_salida'];
        $fecha_arribo = $_POST['fecha_arribo'];
        $transporte = $_POST['transporte'];
        $nro_boleto = $_POST['nro_boleto'];
        $costo = $_POST['costo'];
        $empresa = $_POST['empresa'];
        
        $pasajes = ORM::factory('pvpasajes');
        $pasajes->id_fucov = $id_fucov;
        $pasajes->origen = $origen;
        $pasajes->destino = $destino;
        $pasajes->fecha_salida = $fecha_salida;
        $pasajes->fecha_arribo = $fecha_salida;
        $pasajes->transporte = $transporte;
        $pasajes->nro_boleto = $nro_boleto;
        $pasajes->costo = $costo;
        $pasajes->empresa = $empresa;
        $pasajes->etapa_proceso = 0;
        $pasajes->save();
        if($pasajes->id)
        {
            $obj = "<table class = \"classy\">
                        <thead>
                            <th>TRAMO</th>
                            <th>ORIGEN</th>
                            <th>DESTINO</th>
                            <th>FECHA Y HORA<br /> DE SALIDA</th>
                            <th>FECHA Y HORA<br /> DE ARRIBO</th>
                            <th>TRANSPORTE</th>
                            <th>N. BOLETO</th>
                            <th>COSTO</th>
                            <th>EMPRESA</th>
                        </thead>
                    ";
            $pasajes=ORM::factory('pvpasajes')->where('id_fucov','=',$id_fucov)->find_all();
            $c = 1;
            foreach($pasajes as $p):
                $obj .= "<tbody>
                    <tr>
                        <td>".$c."</td>
                        <td>".$p->origen."</td>
                        <td>".$p->destino."</td>
                        <td>".$p->fecha_salida."</td>
                        <td>".$p->fecha_arribo."</td>
                        <td>".$p->transporte."</td>
                        <td>".$p->nro_boleto."</td>
                        <td>".$p->costo."</td>
                        <td>".$p->empresa."</td>
                    </tr>";
                $c++;
            endforeach;
            $obj .='</tbody></table>';
        }
        else
        {
            $obj = "<b>No se pudo guardar.</b>";
            $obj = "3";
        }
        echo json_encode($obj);
    }

public function action_pptdisponible()
    {
        $id = $_POST['id'];
        $oDisp = new Model_Pvprogramaticas();
        $disp = $oDisp->saldopresupuesto($id);
        $result = "<table border=\"1px\"><tr><td>C&oacute;digo</td><td>Partida</td><td>Vigente</td><td>Preventivo</td><td>Comprometido</td><td>Devengado</td><td>Saldo Disponible</td></tr>";
        foreach($disp as $d)
            //$result .= "<tr><td>".$d['codigo']."</td><td>".$d['partida']."</td><td>".$d['vigente']."</td><td>".$d['preventivo']."</td><td>".$d['comprometido']."</td><td>".$d['devengado']."</td>";
            $result .= "<tr><td>".$d['codigo']."</td><td>".$d['partida']."</td><td>".$d['vigente']."</td><td>".$d['preventivo']."</td><td>".$d['comprometido']."</td><td>".$d['devengado']."</td><td>".$d['saldo_devengado']."</td></tr>";
        $result .= "</table>";
        echo json_encode($result);
    }

public function action_paisorigen()
    {
        $id = $_POST['id'];
        $oPais = new Model_Pyvpais();
        $pais = $oPais->paisorigen($id);
        $obj = '';//'<option value = "" selected></option>';
        foreach($pais as $p){
            if( $p['pais'] == 'BOLIVIA' )
                $obj = $obj.'<option value="'.$p['id'].'" selected>'.$p['pais'].'</option>';
            else
                $obj = $obj.'<option value="'.$p['id'].'">'.$p['pais'].'</option>';
        }
        echo json_encode($obj);
    }



public function action_categoriazona()
    {       
        $id_zona = $_POST['id_zona'];
        $id_cat = $_POST['id_cat'];
        $viaticos = ORM::factory('pyvcategoriazona')->where('id_categoria','=',$id_cat)->and_where('id_zona','=',$id_zona)->find();
        $result=array (
                    'viatico'=>$viaticos->viatico,
                    'moneda'=>$viaticos->moneda                    
                );
        //echo json_encode($result);
        //$s = $viaticos->viatico;
        //$s = '<b>NADA</b>';
        //echo json_encode($s);
        echo json_encode($result);
        
    }
public function action_cargouser()
    {       
        $id_user = $_POST['id'];
        $user = ORM::factory('users')->where('id','=',$id_user)->find();
        $result=array (
                    'cargo'=>$user->cargo
                );
        //echo json_encode($result);
        echo json_encode($user->cargo);
    }    
    

*/
}