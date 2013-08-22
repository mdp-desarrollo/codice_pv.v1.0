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
        $actividad = ORM::factory('pvactividadppt')->where('id_programa','=',$id)->and_where('estado','=',1)->find_all();
        $obj = '<option value = "0" selected>000</option>';
        
        if($actividad->count() > 0)
        {
            //$obj = '';
            foreach($actividad as $a){
                $obj = $obj.'<option value="'.$a->id.'">'.$a->codigo.' - '.$a->actividad.'</option>';
            }
        }
        /*else
        {
            $obj = '<option value = "0" selected>000</option>';
        }*/
        echo json_encode($obj);
    }
/*    
public function action_codobjetivoespecifico()
    {       
        $id = $_POST['id'];
        $objetivo = ORM::factory('pyvobjetivoespecifico')->where('id_obj_gestion','=',$id)->find_all();
        $obj = '<option value = "" selected></option>';
        foreach($objetivo as $o){
            $obj = $obj.'<option value="'.$o->id.'">'.$o->cod_objetivo_especifico.'</option>';
        }        
        echo json_encode($obj);
    }
    
public function action_descobjetivogestion()
    {       
        $id = $_POST['id'];
        $objetivo = ORM::factory('pyvobjetivogestion')->where('id','=',$id)->find();
        $desc = $objetivo->objetivo_gestion;
        echo json_encode($desc);
    }
public function action_descobjetivoespecifico()
    {       
        $id = $_POST['id'];
        $objetivo = ORM::factory('pyvobjetivoespecifico')->where('id','=',$id)->find();
        $desc = $objetivo->objetivo_especifico;
        echo json_encode($desc);
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

public function action_feriados()
    {
        $f1 = $_POST['fecha1'];
        $f2 = $_POST['fecha2'];
        $oFer = new Model_Pyvferiados();
        $fer = $oFer->feriados($f1, $f2);
        $obj = '';
        foreach($fer as $f)            
            $obj = $obj.' '.$f['detalle'].': '.date("d-m-Y",strtotime($f['fecha']));        
        echo json_encode($obj);
        //echo json_encode($fer);
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
    
public function action_pptdisponible()
    {
        $id = $_POST['id'];
        $oDisp = new Model_Pyvprogramatica();
        $disp = $oDisp->saldopresupuesto($id);
        $result = "<table border=\"1px\"><tr><td>C&oacute;digo</td><td>Partida</td><td>Vigente</td><td>Preventivo</td><td>Comprometido</td><td>Devengado</td><td>Saldo Disponible</td></tr>";
        foreach($disp as $d)
            //$result .= "<tr><td>".$d['codigo']."</td><td>".$d['partida']."</td><td>".$d['vigente']."</td><td>".$d['preventivo']."</td><td>".$d['comprometido']."</td><td>".$d['devengado']."</td>";
        $result .= "<tr><td>".$d['codigo']."</td><td>".$d['partida']."</td><td>".$d['vigente']."</td><td>".$d['preventivo']."</td><td>".$d['comprometido']."</td><td>".$d['devengado']."</td><td>".$d['saldo_devengado']."</td></tr>";
        $result .= "</table>";
        echo json_encode($result);
    }
*/
}