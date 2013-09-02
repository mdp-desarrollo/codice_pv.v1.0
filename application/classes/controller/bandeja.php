<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_Bandeja extends Controller_DefaultTemplate{
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
        $this->template->title='Bandeja';
        }
        else
        {
            $url= substr($_SERVER['REQUEST_URI'],1);
            $this->request->redirect('/login?url='.$url);
        }        
    }
 public function after() 
    {        
        $this->template->menutop = View::factory('templates/menutop')->bind('menus',$this->menus)->set('controller', 'bandeja');
        $oSM=New Model_menus();
        $submenus=$oSM->submenus('bandeja');
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus',$submenus)->set('titulo','Bandeja de Entrada');        
        parent::after();
    }  
    //listar nuris generados por el usuario logeado
    public function action_index()
    {        
            $oSeg=New Model_Seguimiento();
            $entrada=$oSeg->estado(1,$this->user->id);
//            $id_doc =0;
//            foreach ($entrada as $e) {
//                $id_doc = $e->id_doc;
//            }
//            
//            $archivos = ORM::factory('archivos')
//    ->where('id_documento', '=', $id_doc)
//    ->find_all();
            
            $this->template->styles=array('media/css/tablas.css'=>'all','media/css/modal.css'=>'screen');
            $this->template->title     .= ' | Entrada'; 
            $this->template->content=View::factory('bandeja/entrada')
                                    ->bind('norecibidos', $entrada);
                                    //->bind('archivos', $archivos);
    }
    public function action_doa()    
    {
        if($_POST){
            if($_POST['accion']==0) // 0 = archivar correspondencia
            {
               $carpetas=ORM::factory('carpetas')
                        ->where('nivel','=',$this->user->nivel)
                        ->find_all();
                $arrCarpetas=array();
                foreach($carpetas as $c)
                {
                    $arrCarpetas[$c->id]=$c->carpeta;
                }
                //nurs
                $nurs=array();
                $oSeg=New Model_Seguimiento();                
                foreach($_POST['id_seg'] as $k=>$v)
                {
                    $nur=$oSeg->nur($v);
                    $id=$nur[0]['id'];
                    $nurs[$id]=$nur[0]['nur'];
                }                
                $this->template->title.=' | Archivar correspondencia';
                $this->template->content=View::factory('bandeja/archivar')
                                         ->bind('options',$arrCarpetas)
                                         ->bind('nurs', $nurs);
            }
            elseif ($_POST['accion']==1)    // 1 = agrupar correspondencia
            {
                $oSeg=New Model_Seguimiento();                
                foreach($_POST['id_seg'] as $k=>$v)
                {
                    $nur=$oSeg->nur($v);
                    $id=$nur[0]['id'];
                    $nurs[$id]=$nur[0]['nur'];
                }
                
                $this->template->title.=' | Archivar correspondencia';
                $this->template->content=View::factory('bandeja/agrupar')                                         
                                         ->bind('nurs', $nurs);
            }
            elseif ($_POST['accion']==2) {  // 2= recepcionar correspondencia
             foreach($_POST['id_seg'] as $k=>$id)
                {
                    if($id!='')
                {
            $seguimiento=ORM::factory('seguimiento')->where('id','=',$id)->and_where('derivado_a','=',$this->user->id)->and_where('estado','=',1)->find();
            if($seguimiento->loaded()){
            $seguimiento->fecha_recepcion=date('Y-m-d H:i:s');
            $seguimiento->estado=2; //2=pendiente oficial
            $seguimiento->save();
            //guardamos en vitacora
            $this->save($this->user->id_entidad,$this->user->id, $this->user->nombre.' | <b>'.$this->user->cargo.'</b> Recepciono la hoja de ruta '.$seguimiento->nur);
            
            
            }
            else
            {
                $this->template->content='No se pudo recepcionar correspondencia.';                    
            }            
        }
        else{
            $this->template->content='No se pudo recepcionar correspondencia.';
        }

                }
                $this->request->redirect('./bandeja');
            //$this->request->redirect('bandeja?nur=1');




            }
        }        
    }
    //archivar correspondencia final
    public function action_agruparf()
    {
        if($_POST)
        {
                $principal=$_POST['principal'];
                $padre=ORM::factory('seguimiento',$principal);
                if($padre->loaded())
                {                            
                    foreach($_POST['seg'] as $k=>$v)
                    {
                        $hijo=ORM::factory('seguimiento',$v);
                        if($padre->nur!=$hijo->nur)
                        {
                            $agrupar=ORM::factory('agrupaciones');
                            $agrupar->padre=$padre->nur;
                            $agrupar->hijo=$hijo->nur;
                            $agrupar->id_seguimiento=$hijo->id;
                            $agrupar->id_user=$this->user->id;
                            $agrupar->nombre=$this->user->nombre;
                            $agrupar->cargo=$this->user->cargo;                            
                            $agrupar->fecha=date('Y-m-d H:i:s');
                            $agrupar->save(); 
                            if($agrupar->id>0) //si se agrupo! entonces cambiamos el estado del hijo
                            {
                                $hijo->estado=6;
                                $hijo->save();
                            }
                        }                     
                    }
                    //por le decimos al seguimiento del padre que tiene hijos jiji                    
                    $padre->hijo=1;
                    $padre->save();                    
                    $_POST=array(); 
                    $this->request->redirect('bandeja/agrupado?nur='.$padre->nur);
                }
        }        
    }
    //archivar correspondencia final
    public function action_archivarf()
    {
        if($_POST)
        {            
                foreach($_POST['seg'] as $k=>$v)
                {
                    $seg=ORM::factory('seguimiento',$v);
                    if($seg->loaded())
                    {                       
                        $carpeta=ORM::factory('archivados');
                        $carpeta->id_user=$this->user->id;
                        $carpeta->nur=$seg->nur;
                        $carpeta->id_carpeta=$_POST['carpeta_lista'];
                        $carpeta->fecha=date('Y-m-d H:i:s');
                        $carpeta->observaciones=$_POST['observaciones'];
                        $carpeta->save();
                        $seg->estado=10;
                        $seg->id_archivo=$carpeta->id;
                        $seg->save();
                    }
                }
                $_POST=array();            
            $this->request->redirect('bandeja/archivos');
        }        
    }
    
    
    //correlativo para un NURI -1=nuri / -2 = nur
    public function nuevo($type=-1)
    {
        $oCorrelativo=ORM::factory('correlativo')
                        ->where('id_tipo','=',$type)
                        ->find();
        $oCorrelativo->correlativo=$oCorrelativo->correlativo+1;
        $oCorrelativo->save();
        $codigo='000'.$oCorrelativo->correlativo;
        if($type==-1)
            $tipo='I/';
        else
            $tipo='';
        $codigo=$tipo.date('Y').'-'.substr($codigo, -4);
        return $codigo;
    }
 //nuris creados por el usuario
    public function action_listar()
    {
        $auth=Auth::instance();
        if($auth->logged_in()){
            $oNuri=New Model_Asignados();
            $count= $oNuri->count($auth->get_user());
            //$count2= $oNuri->count2($auth->get_user());           
            if($count){
              // echo $oNuri->count2($auth->get_user());
                $pagination = Pagination::factory(array(
  		'total_items'    => $count,
                'current_page'   => array('source' => 'query_string', 'key' => 'page'),
                'items_per_page' => 40,
                'view'           => 'pagination/floating',            
                ));  		                    
                 $result=$oNuri->nuris($auth->get_user(),$pagination->offset,$pagination->items_per_page);                                   
                 $page_links = $pagination->render();
                 $this->template->title='Hojas de Seguimiento';
                 $this->template->styles=array('media/css/tablas.css'=>'all');
                 $this->template->content=View::factory('nur/listar')
                                           ->bind('result', $result)
                                           ->bind('page_links', $page_links);
            }
            else{
                $this->template->content=View::factory('errors/general');
            }
        }
        else{
            $this->request->redirect('login');
        }
    }    
    /*Lista de pendientes*/   
    public function action_pendientes()
    {   $info=array();
        if(isset($_GET['id']))
        {
            $user=ORM::factory('users')
                    ->where('id','=',$_GET['id'])
                    ->and_where('superior','=',$this->user->id)
                    ->find();
            if($user->id)
            {
            $oSeg=New Model_Seguimiento();
            $entrada=$oSeg->pendiente($user->id);
            $carpetas=ORM::factory('carpetas')->where('id_oficina','=',$user->id_oficina)->find_all();
            $arrCarpetas=array();
            foreach($carpetas as $c)
            {
                $arrCarpetas[$c->id]=$c->carpeta;
            }
            $oDoc=New Model_Tipos();
            $documentos=$oDoc->misTipos($this->user->id);
            $options=array();
            foreach ($documentos as $d) 
            {
                $options[$d->id]=$d->tipo;
            }           
            $this->template->styles=array('media/css/tablas.css'=>'all','media/css/modal.css'=>'screen');           
            $this->template->title     .= ' | Pendientes '; 
            $this->template->content=View::factory('bandeja/lista_pendientes')
                                    ->bind('entrada', $entrada)
                                    ->bind('carpetas', $arrCarpetas)
                                    ->bind('user', $user)
                                    ->bind('options',$options);     
                
            }
            else
            {
                $this->template->content='No esta autorizado';
            }
        }    
        else
        {
            
//            $id_doc =0;
            $oSeg=New Model_Seguimiento();
            $entrada=$oSeg->pendiente($this->user->id);
//            foreach ($entrada as $e) {
//                $id_doc = $e->id_doc;
//            }
//            $archivos = ORM::factory('archivos')
//            ->where('id_documento', '=', $id_doc)
//            ->find_all();
            $carpetas=ORM::factory('carpetas')->where('id_oficina','=',$this->user->id_oficina)->find_all();
            $arrCarpetas=array();
            foreach($carpetas as $c)
            {
                $arrCarpetas[$c->id]=$c->carpeta;
            }
            $oDoc=New Model_Tipos();
            $documentos=$oDoc->misTipos($this->user->id);
            $options=array();
            foreach ($documentos as $d) 
            {
                $options[$d->id]=$d->tipo;
            }           
            $this->template->styles=array('media/css/tablas.css'=>'all','media/css/modal.css'=>'screen');           
            $this->template->title     .= ' | Pendientes'; 
            $this->template->content=View::factory('bandeja/pendientes')
                                    ->bind('entrada', $entrada)
                                    ->bind('carpetas', $arrCarpetas)
                                    ->bind('info', $info)
                                    ->bind('options',$options);     
        }
    }
    /*mis archivos*/   
    public function action_archivos()
    {
            $oCarpeta=New Model_Carpetas();
            $carpetas=$oCarpeta->archivadores($this->user->id);            
            $this->template->title.=' | Correspondencia archivada';
            $this->template->styles=array('media/css/tablas.css'=>'all'); 
            $this->template->content=View::factory('bandeja/archivadores')
                                    ->bind('carpetas', $carpetas);     
    }
    public function action_carpeta($id='')
    {
        $oArchivo=New Model_Archivados();
        $carpeta=$oArchivo->carpeta($id,$this->user->id);
        if(sizeof($carpeta)>0)
        {
            $user=$this->user;
            
            $this->template->styles=array('media/css/tablas.css'=>'all');
            $this->template->scripts    = array('media/js/jquery.tablesorter.min.js');
            $this->template->title.=' | '.$carpeta[0]['carpeta'];
            $this->template->content=View::factory('bandeja/carpeta')
                                        ->bind('carpeta',$carpeta)
                                        ->bind('user',$user);
        }
    }
    /*Lista de copias pendientes*/   
    public function action_copias()
    {
            $oSeg=New Model_Seguimiento();
            $entrada=$oSeg->estado(5,$this->user->id);            
            $oDoc=New Model_Tipos();
            $documentos=$oDoc->misTipos($this->user->id);
            $options=array();
            foreach ($documentos as $d) {
                $options[$d->id]=$d->tipo;
            }
           // echo sizeof($carpetas);
            $this->template->styles=array('media/css/tablas.css'=>'all');
           // $this->template->scripts=array('media/js/pendientes.js');
            $this->template->title     .= ' | Copias pendientes'; 
            $this->template->content=View::factory('bandeja/copias')
                                    ->bind('entrada', $entrada)
                                    ->bind('options',$options);     
    }
    public function action_recepcion()
    {        
            $oSeg=New Model_Seguimiento();
            $entrada=$oSeg->estado(1,$this->user->id);
            $this->template->styles=array('media/css/tablas.css'=>'all');
            $this->template->title     .= '<li><span>Entrada</span></li>'; 
            $this->template->content=View::factory('user/recepcionar')
                                    ->bind('norecibidos', $entrada);                    
    }
    public function action_recibir($id='')
    {        
        if($id!='')
        {
            $seguimiento=ORM::factory('seguimiento')->where('id','=',$id)->and_where('derivado_a','=',$this->user->id)->and_where('estado','=',1)->find();
            if($seguimiento->loaded()){
            $seguimiento->fecha_recepcion=date('Y-m-d H:i:s');
            $seguimiento->estado=2; //2=pendiente oficial
            $seguimiento->save();
            //guardamos en vitacora
            $this->save($this->user->id_entidad,$this->user->id, $this->user->nombre.' | <b>'.$this->user->cargo.'</b> Recepciono la hoja de ruta '.$seguimiento->nur);
            
            $this->request->redirect('./bandeja');
            }
            else
            {
                $this->template->content='No se pudo recepcionar correspondencia.';                    
            }            
        }
        else{
            $this->template->content='No se pudo recepcionar correspondencia.';
        }
    }  
    //detalle agrupado
    public function action_agrupado()
    {
        $nur=Arr::get($_GET,'nur');
        $hijos=array();
        $padre=ORM::factory('agrupaciones')->where('padre','=',$nur)->find_all();
        foreach($padre as $p)
        {                
                //obtenemos los hijos
                $hijo=ORM::factory('documentos')->where('nur','=',$p->hijo)->and_where('original','=',1)->find();
                if($hijo->loaded())
                {
                    $hijos[$hijo->nur]=array(
                     'id_nur'=>$hijo->nur,
                     'nur'=>$hijo->nur,
                     'documento'=>$hijo->codigo,
                     'referencia'=>$hijo->referencia,
                     'destinatario'=>$hijo->nombre_destinatario,
                     'cargo'=>$hijo->cargo_destinatario,
                    );                    
                }                
        }            
        if(sizeof($hijos)>0)
        {
            $padre=ORM::factory('documentos')->where('nur','=',$nur)->and_where('original','=',1)->find();
            $this->template->styles=array('media/css/tablas.css'=>'all');
            $this->template->content=View::factory('bandeja/agrupado')
                                        ->bind('hijos', $hijos)
                                        ->bind('padre', $padre);            
        }        
        else
        {
            $this->template->content='Error: el no agrupado !!!';
        }
    }
    public function action_desarchivar($id='')
    {
        $seguimiento=ORM::factory('seguimiento')->where('id','=',$id)->and_where('derivado_a','=',$this->user->id)->find();
        if($seguimiento->id)
        {
            //debemos eliminar de archivos
            $archivo=ORM::factory('archivados',array('id'=>$seguimiento->id_archivo));
            $archivo->delete();
            //cambiamos el estado a pendiente
            $seguimiento->estado=2;
            $seguimiento->id_archivo=0;
            $seguimiento->save();             
            $this->request->redirect('bandeja/pendientes');
        }
        else
        {
            $this->template->content=View::factory('acceso_denegado');
        }
    }
    //documentos enviados
    public function action_enviados()
    {
            $oSeg=New Model_Seguimiento();
            $entrada=$oSeg->enviados($this->user->id);                      
            $this->template->styles=array('media/css/tablas.css'=>'all','media/css/modal.css'=>'screen');           
            $this->template->title     .= ' | Correspondencia enviada'; 
            $this->template->content=View::factory('bandeja/enviados')
                                    ->bind('entrada', $entrada); 
    }
    //imprimir enviado
    public function action_printDeriv($id='')
    {
        $seg=ORM::factory('seguimiento',$id);
        if($seg->loaded())
        {
           if(($seg->derivado_por==$this->user->id)&&($seg->estado=='1'))
           {
               $oSeg=New Model_Seguimiento();
               $derivado=$oSeg->derivado($id);
               $this->template->content=View::factory('bandeja/print_deriv')
                                        ->bind('derivado',$derivado);               
           }
           else
           {
               echo 'no se puede';
           }
        }
    }    
    //imprimir enviado
    public function action_cancelar($id='')
    {
        $info=array();
        $seg=ORM::factory('seguimiento',array('id'=>$id));
        $nur=$seg->nur;
        if($seg->loaded())
        {
           if(($seg->derivado_por==$this->user->id)&&($seg->estado=='1'))
           {               
               $padre   = $seg->id_seguimiento; //si tiene seguimiento anterior?
               $oficial = $seg->oficial;
               $seg->delete();
               //si tiene seguimiento
               if($padre>0)
               {
                   $oSeg=New Model_Seguimiento();
                   $oSeg->delete_deriv($padre);
                   $seguimiento=ORM::factory('seguimiento',array('id'=>$padre));                   
                    if($seguimiento->oficial==2)
                        $seguimiento->oficial=1;                    
                    $seguimiento->estado=2; //pendiente                   
                    $seguimiento->save();
                    
                    // Modificado por Freddy
                    $documentos = ORM::factory('documentos')->where('nur','=',$nur)->and_where('estado','=','1')->and_where('id_seguimiento','=',$padre)->order_by('id', 'desc')->find();
                    if($documentos->loaded()){
                    // $documento=ORM::factory('documentos')->where('nur','=',$nur)->and_where('original','=',1)->find();
                    $documento=ORM::factory('documentos')->where('nur','=',$nur)->and_where('id','=',$documentos->id)->find();  //modificado por freddy    
                    $documento->estado=0;
                    $documento->save();
                    $info['info']='<b>Restaurado!: </b>La hoja de ruta fue restaurada, para volver derivar busque el documento <a href="/documento/editar/'.$documentos->id.'">'.$documentos->codigo.'</a>';
                    
                    } else {
                        $info['info']='<b>Restaurado!: </b>La hoja de ruta fue restauradoa a sus <a href="/bandeja/pendientes">pendientes</a>';
                    }       
                    $info['info']='<b>Restaurado!: </b>La hoja de ruta fue restauradoa a sus <a href="/bandeja/pendientes">pendientes</a>';
                    
               }
               //primera derivacion
               else 
               {
                   if($oficial==1)
                   {                    
                    $documento=ORM::factory('documentos')->where('nur','=',$nur)->and_where('original','=',1)->find();
                    $documento->estado=0;
                    $documento->save();
                    $info['info']='<b>Restaurado!: </b>La hoja de ruta fue restaurada, para volver derivar busque el documento <a href="/documento/editar/'.$documento->id.'">'.$documento->codigo.'</a>';
                   }
               }                           
           }
           else
           {
               $error['error']='<b>Error!: </b>La hoja de ruta ya fue recibida por el destinatario o usted no lo tenia en su bandeja de salida';
           }
        }
           $oSeg=New Model_Seguimiento();
            $entrada=$oSeg->enviados($this->user->id);                      
            $this->template->styles=array('media/css/tablas.css'=>'all','media/css/modal.css'=>'screen');           
            $this->template->title     .= ' | Correspondencia enviada'; 
            $this->template->content=View::factory('bandeja/enviados')
                                    ->bind('entrada', $entrada)
                                    ->bind('info', $info) 
                                    ->bind('error', $error); 
        
        
        
    }
    
    public function action_agrupados()
    {
        $count=ORM::factory('agrupaciones')->where('id_user','=',$this->user->id)->count_all();
            $pagination = Pagination::factory(array(
  		'total_items'    => $count,
                'current_page'   => array('source' => 'query_string', 'key' => 'page'),
                'items_per_page' => 50,
                'view'           => 'pagination/floating',            
                ));  		                                
        $page_links = $pagination->render();        
        $oDocumentos = New Model_Documentos();
        $agrupados=$oDocumentos->agrupaciones($this->user->id,$pagination->offset,$pagination->items_per_page);
        $this->template->title.='| Agrupados';
        $this->template->styles=array('media/css/tablas.css'=>'all','media/css/modal.css'=>'screen');
             $this->template->scripts    = array('media/js/jquery.tablesorter.min.js');
        $this->template->content=View::factory('bandeja/agrupados')
                                ->bind('result',$agrupados)
                                ->bind('count',$count)
                                ->bind('page_links',$page_links);
    }
    
    
    
}
?>
