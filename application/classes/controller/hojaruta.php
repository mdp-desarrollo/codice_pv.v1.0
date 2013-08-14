<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_Hojaruta extends Controller_DefaultTemplate{
    protected $user;
    protected $menus;
    public function before() {
        $auth =  Auth::instance();
        //si el usuario esta logeado entonces mostramos el menu
        if($auth->logged_in()){
            //menu top de acuerdo al nivel
            $session=Session::instance();
            $this->user=$session->get('auth_user');
            $oNivel=New Model_niveles();
            $this->menus=$oNivel->menus($this->user->nivel);                        
        parent::before();    
        $this->template->title = 'Hojas de ruta';
        }
        else{
            $url= substr($_SERVER['REQUEST_URI'],1);
            $this->request->redirect('/login?url='.$url);
        }        
    }  
    public function after() 
    {        
        $this->template->menutop = View::factory('templates/menutop')->bind('menus',$this->menus)->set('controller', 'hojaruta');
        $oSM=New Model_menus();
        $submenus=$oSM->submenus('hojaruta');
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus',$submenus)->set('titulo','Hojas de ruta');        
        parent::after();
    }  
    //listar nuris generados por el usuario logeado
    public function action_index()
    {        
            $count=ORM::factory('documentos')->where('original','=',1)->and_where('id_user','=',$this->user->id)->count_all();
            $pagination = Pagination::factory(array(
  		'total_items'    => $count,
                'current_page'   => array('source' => 'query_string', 'key' => 'page'),
                'items_per_page' => 50,
                'view'           => 'pagination/floating',            
                ));  		                    
            $oNur=New Model_Hojasruta();            
            $result=$oNur->hojasruta($this->user->id,$pagination->offset,$pagination->items_per_page);                                   
            $page_links = $pagination->render();
             $oDoc=New Model_Tipos();
            $documentos=$oDoc->misTipos($this->user->id);
            $options=array();
            foreach ($documentos as $d) 
            {
                $options[$d->id]=$d->tipo;
            }   
            $this->template->title     .= ' | Lista de HR creadas';
            $this->template->styles=array('media/css/tablas.css'=>'all','media/css/modal.css'=>'screen');
             $this->template->scripts    = array('media/js/jquery.tablesorter.min.js');
            $this->template->content=View::factory('hojaruta/index')
                                           ->bind('result', $result)
                                           ->bind('page_links', $page_links)
                                           ->bind('count', $count)
                                           ->bind('options', $options);
    }
 
/* Function que me permite generar una respuesta 
 * 
 * 
 * 
 */    
  public function action_responder(){
      if($_POST['aceptar']){
          $id_seg=Arr::get($_POST, 'id_seg');
          $nur=Arr::get($_POST, 'nur');
          $id_tipo=Arr::get($_POST, 'documento');
          
          $seguimiento=ORM::factory('seguimiento',$id_seg);
            if($seguimiento->loaded()){                
                $tipo=  ORM::factory('tipos',$id_tipo);
                $oOficina = New Model_Oficinas();    
                        $correlativo=$oOficina->correlativo($this->user->id_oficina, $tipo->id);
                        $abre=$oOficina->tipo($tipo->id);
                        $sigla=$oOficina->sigla($this->user->id_oficina);
                             if($abre!='') $abre=$abre.'/';
                        $codigo=$abre.$sigla.' Nº '.$correlativo.'/'.date('Y');                
                //obtenemos el id_proceso del documento original
                $proceso=ORM::factory('documentos')->where('nur','=',$nur)->and_where('original','=',1)->find();
                
                //Modificado por freddy
                $odoc= new Model_Documentos();
                $odoc->updateEstado($nur);
                /////////////////////////////////////////////
                //generamos el documento
                $documento=ORM::factory('documentos');
                $documento->id_user=$this->user->id;
                $documento->codigo=$codigo;
                $documento->cite_original=$codigo;
                $documento->id_tipo=$id_tipo;
                $documento->nombre_destinatario=$seguimiento->nombre_emisor;
                $documento->cargo_destinatario=$seguimiento->cargo_emisor;
                $documento->nombre_remitente=$this->user->nombre;
                $documento->cargo_remitente=$this->user->cargo;
                $documento->fecha_creacion=date('Y-m-d H:i:s');
                $documento->nur=$nur;
                $documento->id_seguimiento=$id_seg;                
                $documento->original=0; //important !!                
                $documento->id_proceso=$proceso->id_proceso;
                $documento->id_oficina=$this->user->id_oficina;
                $documento->id_entidad=$this->user->id_entidad;
                $documento->save();
                if($documento->id){                                                                        
                                    //cazamos al documento con el nur asignado
                                    $rs=$documento->has('nurs', $nur);
                                    $documento->add('nurs', $nur);                                                                       
                                    $_POST=array();
                                    $this->request->redirect('documento/editar/'.$documento->id);
                 }
            }
            else{
                echo 'Error: no se pudo generar el documento';
            }                
        }
        else{
        $this->template->content=View::factory('');    
        }      
  }             
  public function action_generar_doc(){
      if($_POST['aceptar'])
          {          
          $nur=Arr::get($_POST, 'nur');
          $id_tipo=Arr::get($_POST, 'documento');
          $tipo=  ORM::factory('tipos',$id_tipo);
          $oOficina = New Model_Oficinas();    
          $correlativo=$oOficina->correlativo($this->user->id_oficina, $tipo->id);
          $abre=$oOficina->tipo($tipo->id);
          $sigla=$oOficina->sigla($this->user->id_oficina);
          if($abre!='') $abre=$abre.'/';
            $codigo=$abre.$sigla.' Nº '.$correlativo.'/'.date('Y');                
                //obtenemos el id_proceso del documento original
          $proceso=ORM::factory('documentos')->where('nur','=',$nur)->and_where('original','=',1)->find();
                //generamos el documento
                $documento=ORM::factory('documentos');
                $documento->id_user=$this->user->id;
                $documento->codigo=$codigo;
                $documento->cite_original=$codigo;
                $documento->id_tipo=$id_tipo;
                $documento->fecha_creacion=date('Y-m-d H:i:s');
                $documento->nur=$nur;
                $documento->id_seguimiento=0;                
                $documento->original=0; //important !!                
                $documento->id_proceso=$proceso->id;
                $documento->id_oficina=$this->user->id_oficina;
                $documento->save();
                if($documento->id){                                                                        
                       //cazamos al documento con el nur asignado
                       $rs=$documento->has('nurs', $nur);
                       $documento->add('nurs', $nur);                                                                       
                       $_POST=array();
                       $this->request->redirect('documento/editar/'.$documento->id);
                 }                            
        }
        else{
        $this->template->content=View::factory('');    
        }      
  }             
    //asignar nur o nuri
    public function action_asignar($id=''){
        $auth =  Auth::instance();
         if($auth->logged_in()){
            //propiedades del documento
             $documento    = ORM::factory('documentos')                                  
                                  ->where('id','=',$id)
                                  ->and_where('id_user','=',$this->user->id)
                                  ->find();
             if($documento){
                 //si fue enviado por metodo post entonces lo guardamos
                 if($_POST){
                     //generamos el codigo del correlativo
                     $codigo=$this->nuevo(-1);
                     //asignamos
                     $nuri=ORM::factory('asignados');
                     $nuri->codigo=$codigo;
                     $nuri->id_user=$this->user->id;
                     $nuri->fecha_creacion=date('Y-m-d H:i:s');
                     $nuri->tipo_id=-1;
                     $nuri->save();
                     //actualizamos propiedades del docuemtno
                                          
                     $documento->id_nuri=$nuri->id;
                     $documento->nuri=$codigo;
                     $documento->id_proceso=$_POST['proceso'];
                     $documento->save();
                     //enviamos al formulario de derivacion
                     $this->request->redirect(URL::base().'derivar/hs/?n='.$documento->id_nuri);
                 }
                    $procesos=ORM::factory('procesos')->find_all();
                    $arrP=array(''=>'');
                    foreach($procesos as $p){
                        $arrP[$p->id]=$p->proceso;
                    }
                    $this->template->content=View::factory('nur/create')
                                                ->bind('procesos',$arrP)
                                                ->bind('documento',$documento);
             }
             else
             {
                 $mensaje='Usted no puede modificar/asignar documentos de otras personas';
                 $this->template->content=View::factory('errors/general')
                                                ->bind('mensaje', $mensaje);
             }

         }
         else{
             $this->request->redirect(URL::base().'login'); 
         }        
    }
    //correlativo para un NURI -1=nuri / -2 = nur
    public function nuevo($type=-1){
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
    public function action_listar(){
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
                 $this->template->styles=array('media/css/tablas.css'=>'screen');
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
   //nueva function para derivar
    public function action_derivar()
    {
        $id=Arr::get($_GET,'id_doc',0);        
        $documento=ORM::factory('documentos')
                        ->where('id','=',$id)
                        //->and_where('original','=',1)
                        ->find();
        $nur = $documento->nur;
        if($documento->loaded())
        {           
                $session=  Session::instance();
                $session->delete('destino');
                
                $proceso=ORM::factory('procesos',$documento->id_proceso);
                $errors=array();
                $user=$this->user;
                if($documento->estado==0)
                {
                    $acciones=$this->acciones();
                    $destinatarios=$this->destinatarios($this->user->id,$this->user->superior);
                    $id_seguimiento=0;
                    $oficial=1;
                    $hijo=0;                    
                    $this->template->title.=' | Derivar';
                    $this->template->styles = array ('media/css/tablas.css' => 'screen','media/css/fcbk.css' => 'screen','media/css/modal.css' => 'screen' );
                    $this->template->scripts=array('media/js/jquery.fcbkcomplete.min.js');
                    $this->template->content=View::factory('hojaruta/frm_derivacion')
                                        ->bind('documento',$documento)
                                        ->bind('acciones',$acciones)
                                        ->bind('destinatarios',$destinatarios)
                                        ->bind('id_seguimiento',$id_seguimientos)
                                        ->bind('oficial',$oficial)
                                        ->bind('hijo',$hijo)
                                        ->bind('proceso',$proceso)
                                        ->bind('errors',$errors)
                                        ->bind('user',$user);
                }
                else
                {
                    //verificamos que la hora de ruta esta en sus pendientes
                    $pendiente=ORM::factory('seguimiento')
                                ->where('nur','=',$nur)
                                ->and_where('derivado_a','=',$this->user->id)
                                ->and_where('estado','=',2)
                                ->find();
                    if($pendiente->loaded())
                    {

                        $acciones=$this->acciones();
                        $destinatarios=$this->destinatarios($this->user->id,$this->user->superior);
                        $id_seguimiento=$pendiente->id;
                        $oficial=$pendiente->oficial;
                        $hijo=$pendiente->hijo;
                        
                        $this->template->title.=' | Derivar';
                        $this->template->styles = array ('media/css/tablas.css' => 'screen','media/css/fcbk.css' => 'screen','media/css/modal.css' => 'screen' );
                        $this->template->scripts=array('media/js/jquery.fcbkcomplete.min.js');
                        $this->template->content=View::factory('hojaruta/frm_derivacion')
                                        ->bind('documento',$documento)
                                        ->bind('acciones',$acciones)
                                        ->bind('destinatarios',$destinatarios)
                                        ->bind('id_seguimiento',$id_seguimiento)
                                        ->bind('oficial',$oficial)
                                        ->bind('hijo',$hijo)
                                        ->bind('proceso',$proceso)
                                        ->bind('user',$user)
                                        ->bind('errors',$errors);
                    }
                    else
                    {
                        $this->request->redirect('seguimiento/?nur='.$nur);
                    }
                }            
        }
        else
        {
            $this->template->content='Nur inexistente';                                    
        }
    }
    //imprimir
    public function action_imprimir()
    {
       $this->template->title.=' | imprimir';
       $this->template->content=View::factory('hojaruta/imprimir'); 
    }
    /***/
    public function acciones()
    {
        $acciones=array();
        $acc = ORM::factory ( 'acciones' )->find_all ();        
        foreach ( $acc as $a ) 
        {
            $acciones [$a->id] = $a->accion;         
        }                
        return $acciones;
    }
    public function destinatarios($id_user,$id_superior)
    {
        
        $lista_derivacion = array ();
        $oDestino=New Model_Destinatarios();
        //dependientes
        $lista_destinos=$oDestino->dependientes($id_user);
        foreach ( $lista_destinos as $l ) 
        {
          $lista_derivacion [$l['id']] = $l['oficina'] . ' - ' . Text::limit_words ( $l['nombre'], 6, '' );
        }
        //superior
        $lista_destinos=$oDestino->superior($id_superior);
        foreach ( $lista_destinos as $l ) 
        {
          $lista_derivacion [$l['id']] = $l['oficina'] . ' - ' . Text::limit_words ( $l['nombre'], 6, '' );
        }
        
        $lista_destinos=$oDestino->destinos($id_user);
        foreach ( $lista_destinos as $l ) 
        {
            if(!array_key_exists($l->id, $lista_derivacion))
                $lista_derivacion [$l->id] = $l->oficina . ' - ' . Text::limit_words ( $l->nombre, 6, '' );
        } 
        
        //print_r($lista_destinos);
        //sort($lista_derivacion, true);
        //sort($lista_derivacion);
        return $lista_derivacion;
    }
}
?>
