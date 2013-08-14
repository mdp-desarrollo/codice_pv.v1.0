<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_Seguimiento extends Controller_DefaultTemplate{
    protected $user;
    protected $menus;
    public function before() 
    {
        $auth =  Auth::instance();
        //si el usuario esta logeado entocnes mostramos el menu
        if($auth->logged_in())
        {
        //menu top de acuerdo al nivel
            $session=Session::instance();
            $this->user=$session->get('auth_user');
            $oNivel=New Model_niveles();
            $this->menus=$oNivel->menus($this->user->nivel);
        parent::before();        
        }
        else
        {
            $this->request->redirect('/login');
        }        
}
 public function after() 
    {
        $this->template->menutop = View::factory('templates/menutop')->bind('menus',$this->menus)->set('controller', 'seguimiento');
        $oSM=New Model_menus();
        $submenus=$oSM->submenus('seguimiento');        
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus',$submenus)->set('titulo','Seguimiento');        
        parent::after();
    }  
    //listar nuris generados por el usuario logeado
public function action_ver()
    {     
        $errors=array();
            $results = ORM::factory('seguimiento')
                     ->where('derivado_por','=',$this->user->id)
                     ->order_by('fecha_emision', 'DESC')
                     ->limit(20)
                     ->find_all();
            $this->template->scripts    = array('media/js/jquery.tablesorter.min.js');
            $this->template->styles=array('media/css/tablas.css'=>'screen');
            $this->template->title     = 'Seguimiento'; 
            $this->template->content=View::factory('seguimiento/ver')
                                    ->bind('results', $results)
                                    ->bind('errors', $errors); 
    }
public function action_ver_antes()
    {     
        $errors=array();
            if(isset($_POST['boton']))
            {
              $hs=trim($_POST['nur']);
              if($hs=='')
              {
                  $errors['Error']='Ingrese NUR/NURI por favor.';
              }
              else
              {
                $nur=ORM::factory('nurs')->where('nur','=',$hs)->count_all();              
                if($nur>0)
                {
                    $this->request->redirect('seguimiento/?nur='.$hs);   
                }
                else
                {
                  $errors['Error']='NUR/NURI inexistente';
                }
              }
            }
            $oSeg=New Model_Seguimiento();
            $entrada=$oSeg->estado(1,$this->user->id);
            $this->template->styles=array('media/css/tablas.css'=>'screen');
            $this->template->title     = 'Seguimiento'; 
            $this->template->content=View::factory('seguimiento/buscar')
                                    ->bind('nurs', $nurs)
                                    ->bind('errors', $errors); 
    }
public function action_id(){
    $id=Arr::get($_POST,'nur','');
        if($id!=''){
            //obtenemos el documento ligado al nur                                     
             $documento=ORM::factory('documentos')->where('nur','=',$id)->and_where('original','=',1)->find();
             $tipo=ORM::factory('tipos',$documento->id_tipo);
             $proceso=ORM::factory('procesos',$documento->id_proceso);
             $detalle=array(
                 'nur'=>$nur->nur,
                 'fecha'=>$nur->fecha_creacion,
                 'codigo'=>$documento->codigo,
                 'tipo'=>$tipo->tipo,
                 'proceso'=>$proceso->proceso,
                 'referencia'=>$documento->referencia,
                 'remitente'=>$documento->nombreRemitente,
                 'cargo_remitente'=>$documento->cargoRemitente,
                 'destinatario'=>$documento->nombreDestinatario,
                 'cargo_destinatario'=>$documento->cargoDestinatario,
                 'adjunto'=>$documento->adjuntos,                 
             );
            $archivo=ORM::factory('archivos')
                        ->where('id_documento','=',$documento->id)                                
                        ->find_all();
              //$seguimiento=ORM::factory('seguimiento')->where('nur','=',$id)->find_all();            
            $oSeg=New Model_Seguimiento();
            $seguimiento=$oSeg->seguimiento($id);
            //descripcion del documento
            $oDoc=New Model_Documentos();
            $documento=$oDoc->descripcion($id);            
            //$documento=$documento[0];      
            $this->template->title='Seguimiento a la hoja de ruta : '.$detalle['nur'];
            $this->template->styles=array('media/css/tablas.css'=>'screen');
            $this->template->content=View::factory('hojaruta/seguimiento')
                                            ->bind('seguimiento',$seguimiento)
                                            ->bind('detalle',$detalle)
                                            ->bind('archivo',$archivo);                
        }
        else{
            $this->template->content='Error!!!';
        }
            
    }
public function action_index()
    {            
            $id=Arr::get($_GET,'nur','');
            if($id!=''){   
            //obtenemos el documento ligado al nur                                     
             $documento=ORM::factory('documentos')->where('nur','=',$id)->and_where('original','=',1)->find();
             $tipo=ORM::factory('tipos',$documento->id_tipo);
             $proceso=ORM::factory('procesos',$documento->id_proceso);
             $detalle=array(
                 'nur'=>$id,
                 'fecha'=>$documento->fecha_creacion,
                 'codigo'=>$documento->cite_original,
                 'id_documento'=>$documento->id,
                 'tipo'=>$tipo->tipo,
                 'proceso'=>$proceso->proceso,
                 'referencia'=>$documento->referencia,
                 'remitente'=>$documento->nombre_remitente,
                 'cargo_remitente'=>$documento->cargo_remitente,
                 'destinatario'=>$documento->nombre_destinatario,
                 'cargo_destinatario'=>$documento->cargo_destinatario,
                 'adjunto'=>$documento->adjuntos,                 
             );
            $archivo=ORM::factory('archivos')
                        ->where('id_documento','=',$documento->id)                                
                        ->find_all();
              //$seguimiento=ORM::factory('seguimiento')->where('nur','=',$id)->find_all();            
            $oSeg=New Model_Seguimiento();
            $seguimiento=$oSeg->seguimiento($id);     
            //agrupaciones
            $agrupado=ORM::factory('agrupaciones')->where('hijo','=',$id)->find();
            //$documento=$documento[0];      
            $this->template->title='Seguimiento a la hoja de ruta : '.$detalle['nur'];
            $this->template->styles=array('media/css/tablas.css'=>'screen');
            $this->template->content=View::factory('hojaruta/seguimiento')
                                            ->bind('seguimiento',$seguimiento)
                                            ->bind('detalle',$detalle)
                                            ->bind('archivo',$archivo)                
                                            ->bind('agrupado',$agrupado);                
            
            //var_dump($seguimiento);
        }
        else{
            $this->request->redirect('seguimiento/ver');
        }
            
    }
}
?>
