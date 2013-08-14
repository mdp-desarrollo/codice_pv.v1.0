<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_generar extends Controller_DefaultTemplate{
    
    public function action_respuesta(){
        $auth =  Auth::instance();        
        if($auth->logged_in()){
        $session=  Session::instance();
        $user=$session->get('auth_user');
        $id=Arr::get($_GET, 'id',0);
        $id_tipo=Arr::get($_GET, 'd',0);
        $seguimiento=ORM::factory('seguimiento',$id);
        if($seguimiento->id){
            $tipo=  ORM::factory('tipos',$id_tipo);
            $oficina=  ORM::factory('oficinas',$user->id_oficina); //oficina a la que pertence el usuario
            //generamos un cite para el docuento
            $correlativo=ORM::factory('correlativo')
                                     ->where('id_oficina','=',$user->id_oficina)
                                     ->and_where('id_tipo','=',$id_tipo)
                                     ->find(); 
            if($correlativo->id_oficina!=0){
                $correlativo->correlativo=$correlativo->correlativo+1; //incrementamos en 1 el correlativo
                $correlativo->save();        
                $corr=substr('000'.$correlativo->correlativo,-4);
                $abre='';
                if($tipo->abreviatura!='')
                    $abre=$tipo->abreviatura.'/';
                $codigo= $abre.$oficina->sigla.'/'.date('Y').'-'.$corr;                
                //generamos el documento
                $documento=ORM::factory('documentos');
                $documento->id_user=$auth->get_user();
                $documento->codigo=$codigo;
                $documento->id_tipo=$id_tipo;
                $documento->nombreDestinatario=$seguimiento->nombre_emisor;
                $documento->cargoDestinatario=$seguimiento->cargo_emisor;
                $documento->fecha_creacion=time();
                $documento->save();
            }
            else{
                echo 'Error: no se pudo generar el documento';
            }
                
        }
        else{
        $this->template->content=View::factory('');    
        }        
       }
       else{
           $this->request->redirect('login');
       }
    }
    public function action_index(){

        $auth =  Auth::instance();
        //si el usuario esta logeado entocnes mostramos el menu
        if($auth->logged_in()){
            $oImagenes=  ORM::factory('imagenes');
            $imagenes=$oImagenes->where('id_usuario','=',$auth->get_user())->find_all();            
            $this->template->title   = 'Administrador del Sitio';
            $this->template->adminmenu=View::factory('admin/menu');
            $this->template->content = View::factory('documentos/listar')
                                        ->bind('imagenes',$imagenes);
        }                        
    }
    public function action_doc($tipo=''){
        $auth =  Auth::instance();
         if($auth->logged_in()){  
            $tipodocumento=  ORM::factory('tipodocumentos')->where('action','=',$tipo)->find();
            if($tipodocumento->id>0){
                if(isset($_POST['submit'])){                        
                        $codigo=$this->codigo_documento($tipodocumento->abreviatura,$auth->get_user());
                        $correlativo=ORM::factory('asignados');
                        $correlativo->codigo=$codigo;
                        $correlativo->id_user=$auth->get_user();
                        $correlativo->fecha=date('Y-m-d H:i:s');
                        $correlativo->save();
                        //guardamos en documentos
                        $documento =  ORM::factory('documentos'); //intanciamos el modelo documentos                        
                        $documento->idUsuario=$auth->get_user();
                        $documento->tipoDocumento=$tipodocumento->id;
                        $documento->codigo=$codigo;                        
                        $documento->citeOriginal=$codigo;                        
                        $documento->tituloDestinatario=$_POST['titulo'];
                        $documento->nombreDestinatario=$_POST['destinatario'];; //
                        $documento->cargoDestinatario=$_POST['cargo_des'];
                        $documento->institucionDestinatario=$_POST['institucion'];                                                
                        $documento->nombreRemitente=$_POST['remitente'];
                        $documento->cargoRemitente=$_POST['cargo_rem'];
                        $documento->institucionRemitente='';
                        $documento->moscaRemitente=$_POST['mosca'];
                        $documento->referencia=$_POST['referencia'];
                        $documento->contenido=$_POST['descripcion'];
                        $documento->fecha=  time(); //fecha y hora en formato int
                        $documento->adjuntos=$_POST['adjuntos'];                        
                        $documento->copias=$_POST['copias'];
                        $documento->nombreVia=$_POST['via'];                        
                        $documento->cargoVia=$_POST['cargovia'];
                        $documento->nroHojas=0;
                        $documento->save();
                        if($documento->id){
                        $this->request->redirect('documentos/d/'.$documento->id);                       
                        }
                        
                        
                }
                else
                {
                 $usuario=  ORM::factory('users',$auth->get_user());
                 $oVias=  new Model_data();
                 $vias=$oVias->vias($auth->get_user());
                 $superior=$oVias->superior($auth->get_user());                 
                 $this->template->scripts    = array('ckeditor/adapters/jquery.js','ckeditor/ckeditor.js');
                 $this->template->title      ='Generar '.$tipodocumento->documento;
                 $this->template->content    =View::factory('documentos/create')
                                                ->bind('usuario', $usuario)
                                                ->bind('documento', $tipodocumento)
                                                ->bind('superior', $superior)
                                                ->bind('vias', $vias);
                }
            }
            else{
               $this->template->content=View::factory('errors/404');    
            }
        }
        else
        {
          $this->request->redirect(URL::base().'login');  
        }
    }


    
    //nueva Carta
    public function action_carta(){        
        $auth =  Auth::instance();
        if($auth->logged_in()){                       
            if(isset($_POST['submit'])){                        
                        $codigo=$this->codigo_documento('',$auth->get_user());
                        $correlativo=ORM::factory('asignados');
                        $correlativo->codigo=$codigo;
                        $correlativo->id_usuario=$auth->get_user();
                        $correlativo->fecha=date('Y-m-d H:i:s');
                        $correlativo->save();
                        //guardamos en documentos
                        $documento =  ORM::factory('documentos'); //intanciamos el modelo proveedor                        
                        $documento->idUsuario=$auth->get_user();
                        $documento->tipoDocumento=7;
                        $documento->codigo=$codigo;                        
                        $documento->citeOriginal=$codigo;                        
                        $documento->tituloDestinatario=$_POST['titulo'];
                        $documento->nombreDestinatario=$_POST['destinatario'];; //tipo noticia
                        $documento->cargoDestinatario=$_POST['cargo_des'];
                        $documento->institucionDestinatario=$_POST['institucion'];                                                
                        $documento->nombreRemitente=$_POST['remitente'];
                        $documento->cargoRemitente=$_POST['cargo_rem'];
                        $documento->institucionRemitente='';
                        $documento->moscaRemitente=$_POST['mosca'];
                        $documento->referencia=$_POST['referencia'];
                        $documento->contenido=$_POST['descripcion'];
                        $documento->fecha=  time();
                        $documento->adjuntos=$_POST['adjuntos'];                        
                        $documento->copias=$_POST['copias'];
                        $documento->nroHojas=0;
                        $documento->save();
                        // $this->request->redirect('imagenes');                       
                        echo $correlativo->id;                        
                        echo '<br/>';
                        echo $codigo;
                        
                }
            else
            {
                 $usuario=  ORM::factory('users',$auth->get_user());
                 $this->template->scripts    = array('ckeditor/adapters/jquery.js','ckeditor/ckeditor.js');
                 $this->template->title      ='Crear Carta';
                 $this->template->content    =View::factory('formularios/add_carta')
                                                ->bind('usuario', $usuario);
            }
        }
        else {
          $this->template->title='subir imagenes';
          $this->template->content=View::factory('errors/user');
        }
    }
    public function action_editar_carta($c=''){        
        $auth =  Auth::instance();
        if($auth->logged_in()){                       
            if(isset($_POST['submit'])){
                        
                        $codigo=$this->codigo_documento('',$auth->get_user());
                        $correlativo=ORM::factory('asignados');
                        $correlativo->codigo=$codigo;
                        $correlativo->id_usuario=$auth->get_user();
                        $correlativo->fecha=date('Y-m-d H:i:s'); //fecha actual del servidor
                        $correlativo->save();                        
                        $documento =  ORM::factory('documentos');                        
                        $documento->codigo=$codigo;                        
                        $documento->cite_original=$codigo;
                        $documento->destinatario_titulo=$_POST['titulo'];
                        $documento->destinatario_nombres=$_POST['destinatario'];; //tipo noticia
                        $documento->destinatario_cargo=$_POST['cargo_des'];
                        $documento->destinatario_institucion=$_POST['institucion'];
                        $documento->autor=$auth->get_user();
                        $documento->referencia=$_POST['referencia'];
                        $documento->contenido=$_POST['descripcion'];
                        $documento->remitente_nombres=$_POST['remitente'];
                        $documento->remitente_cargo=$_POST['cargo_rem'];
                        $documento->mosca=$_POST['mosca'];
                        $documento->tipo_documento='CARTA';
                        $documento->adjuntos=$_POST['adjuntos'];
                        $documento->fecha=date('Y-m-d H:i:s');
                        $documento->copias=$_POST['copias'];
                        $documento->save();
                        // $this->request->redirect('imagenes');
                }
            else
            {
                if($c!=''){
                 $documento =  ORM::factory('documentos')->where('id','=',$c)
                                                         ->and_where('autor','=',$auth->get_user())
                                                         ->find(); //intanciamos el modelo proveedor                                             
                 $this->template->scripts    = array('ckeditor/adapters/jquery.js','ckeditor/ckeditor.js');
                 $this->template->title      ='Crear Carta';
                 $this->template->content    =View::factory('formularios/edit_carta')
                                                ->bind('documento', $documento);
                }
            }
        }
        else {
          $this->template->title='subir imagenes';
          $this->template->content=View::factory('errors/user');
        }
    }

    
    
    
    
    
    //obtener codigo para un documento
    public function codigo_documento($tipo='',$id=''){
        //obtenemos la sigla de la oficina
        $oficina=ORM::factory('oficinas')->join('users','INNER')
                                         ->on('oficinas.id','=','users.id_oficina')
                                         ->where('users.id','=',$id)
                                         ->find(); 
        if($tipo!='')  $codigo=$tipo.'/'.$oficina->sigla;  else   $codigo=$oficina->sigla;
        
        $correlativo=ORM::factory('correlativos')->where('codigo','=',$codigo)
                                                 ->and_where('gestion','=',date('Y'))->find(); 
        $correlativo->correlativo=$correlativo->correlativo+1; //incrementamos en 1 el correlativo
        $correlativo->save();
        $corr=substr('000'.$correlativo->correlativo,-4);
        $codigo.='/'.date('Y').'-'.$corr;
        return $codigo;        
    }
    
    
    
   
   
    public function action_descargar($id){
        //buscamos el documento
        $documento=ORM::factory('documentos')->where('id','=',$id)->find();
        $enlace = 'upload'.$documento->nombre_documento;
        header ("Content-Disposition: attachment; filename=".$documento->nombre_documento."\n\n");
        header ("Content-Type: ".$documento->extension);
        header ("Content-Length: ".filesize($enlace));
        readfile($enlace);
    }
    
}
?>
