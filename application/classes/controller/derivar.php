<?php
defined ( 'SYSPATH' ) or die ( 'Acceso denegado' );
class Controller_Derivar extends Controller_DefaultTemplate {
	public function action_index() {
		$auth = Auth::instance ();
		//si el usuario esta logeado entocnes mostramos el menu
		if ($auth->logged_in ()) {
			//cartas generadas
			$oData = New Model_data ();
			$documentos = $oData->documentos_agrupados ( $auth->get_user () );
			$this->template->title = 'Documentos Generados';
			$this->template->content = View::factory ( 'documentos/index' )->bind ( 'documentos', $documentos );
		}
	}
	public function action_hs() {
		$auth = Auth::instance ();
		if ($auth->logged_in ()) {
                        $n=Arr::get($_GET,'n','');
                        $s=Arr::get($_GET,'s','');                        
			$derivado = ORM::factory ( 'asignados', $n );
			if ($derivado) {
				if ($derivado->derivado&&$s=='') {
                                        //redireccionamos a :
					$this->request->redirect(URL::base().'seguimiento/hs/'.$n);
				} else {
					
					$documento = ORM::factory ( 'documentos' )->join ( 'procesos', 'INNER' )->on ( 'documentos.id_proceso', '=', 'procesos.id' )->where ( 'documentos.id_nuri', '=', $n )->find ();
					$acc = ORM::factory ( 'acciones' )->find_all ();
					$acciones = array ();
					foreach ( $acc as $a ) {
						$acciones [$a->id] = $a->accion;
					}
					$lista_derivacion = array ();
                                        
					$usuario = ORM::factory ( 'users', $auth->get_user () );
					//inmediato superior
					$superior = ORM::factory ( 'users', $usuario->superior );
					$lista_derivacion [$superior->id] = $superior->cargo . ' - ' . Text::limit_words ( $superior->nombre, 4, '' );
					//dependientes
					$dependientes = ORM::factory ( 'users' )->where ( 'superior', '=', $auth->get_user () )->find_all ();
					foreach ( $dependientes as $d ) {
						$lista_derivacion [$d->id] = $d->cargo . ' - ' . Text::limit_words ( $d->nombre, 4, '' );
					}
					//de la lista de derivacion
					$lista_db = ORM::factory ( 'users' )->join ( 'destinatarios', 'inner' )->on ( 'users.id', '=', 'destinatarios.id_destino' )->where ( 'destinatarios.id_usuario', '=', $auth->get_user () )->find_all ();
					foreach ( $lista_db as $l ) {
						$lista_derivacion [$l->id] = $l->cargo . ' - ' . Text::limit_words ( $l->nombre, 4, '' );
					}
					/*si se Envio datos mediante POST*/
					if ($_POST) {
                                                $id_archivo=0;
                                                $archivo_texto='';
                                                //verificamos si el archivo a subor cuenta on las validaciones respectivas 
						$post = Validation::factory ( $_FILES )
                                                        ->rule('archivo', 'Upload::not_empty')
                                                        ->rule('archivo', 'Upload::type', array(':value', array('jpg', 'png', 'gif','pdf', 'doc', 'docx', 'ppt', 'xls', 'xlsx')))
                                                        ->rule('archivo', 'Upload::size', array(':value', '2M'));
                                                       // ->rules ( 'archivo', array (array ('Upload::valid' ), array ('Upload::type', array (':value', array ('pdf', 'doc', 'docx', 'ppt', 'xls', 'xlsx' ) ) ), array ('Upload::size', array (':value', '5M' ) ) ) );
						//si pasa la validacion guardamamos 
						if ($post->check ()) {				
							$filename = upload::save ( $_FILES ['archivo'] );												
							$archivo = ORM::factory ( 'archivos' ); //intanciamos el modelo proveedor							
							$archivo->nombre_archivo = basename($filename);
							$archivo->extension = $_FILES ['archivo'] ['type'];
							$archivo->tamanio = $_FILES ['archivo'] ['size'];
							$archivo->id_user = $auth->get_user ();
							$archivo->fecha = time ();
							$archivo->save ();
							$id_archivo=$archivo->id;
							$archivo_texto=$archivo->nombre_archivo;
		
						} else {
							$error[]='Ocurrio un error el subir el archivo';
						}
						//$errors = $post->errors ( 'contenidos/add' );					
						$nur = Arr::get ( $_POST, 'nur', '' );
						$padre = Arr::get ( $_GET, 's', '' );
						$tipo = Arr::get ( $_POST, 'tipo', '' );
						$nombre = Arr::get ( $_POST, 'nombre', '' );
						$destino = Arr::get ( $_POST, 'destino', '' );
						$accion = Arr::get ( $_POST, 'accion', '' );
						$proveido = Arr::get ( $_POST, 'proveido', '' );
                                                $adjunto=  Arr::get($_POST, 'adjunto',array());
                                                $oDestino=  new Model_Oficinas();
                                                $oficina=$oDestino->oficina($destino);                                                
                                                $destinatario=explode('-', $lista_derivacion [$destino]); //array
                                                $accion_texto=$acciones[$accion];
                                                //array para derivacion
                                                //Creamos una intancia de la clase session
						$session = Session::instance ();                                                
                                                $arr = array ('tipo' => $tipo, 
                                                                    'nombre' => $nombre, 
                                                                    'cargo' => $session->get ( 'cargo' ), 
                                                                    'de_oficina' => $session->get ( 'oficina' ), 
                                                                    'destino' => $destino,
                                                                    'cargo'=>$destinatario[1],
                                                                    'destinatario'=>$destinatario[0],
                                                                    'a_oficina'=>$oficina->oficina,
                                                                    'accion' => $accion, 
                                                                    'accion_text'=>$accion_texto,
                                                                    'proveido' => $proveido,
                                                                    'adjunto' => $adjunto,
                                                                    'archivo' => $id_archivo,
                                                                    'archivo_texto' => $archivo_texto,
                                                                    'padre' => $padre,
                                                                    );
                                                
						//si existe ? la variable de session( derivar) 
						if (($session->get ( 'derivaciones' ))&&(array_key_exists($documento->id_nuri, $session->get('derivaciones')))) {
							$derivaciones = $session->get ( 'derivaciones' ); //contiene la derivacion
                                                        //contiene derivacion pendiente respecto al nuri
                                                        $derivarNuri=$derivaciones[$nur];
							//si enviamos una derivacion oficial verificacoms de que no exista ya una                
							$type = 0;
							if ($tipo == 1) {
								foreach ( $derivarNuri as $d ) {
									if ($d ['tipo'] == 1) {
										$type += 1;
										$errors[$nur] = 'Solo puede enviar un Oficial';
									}
								}
							}
							if ((! array_key_exists ( $destino, $derivarNuri )) && ($type == 0)) {								
                                                                
								$derivarNuri [$destino] = $arr;
                                                                $derivaciones[$nur]=$derivarNuri;
								$session->set ( 'derivaciones', $derivaciones );
							}
                                                        else{
                                                            $error['destinatario']='destinatario ya elejido';
                                                        }
						} 
                                            else {
                                                        $derivarNuri=array($destino=>$arr);
                                                        $derivaciones[$nur]=$derivarNuri;
							$session->set ( 'derivaciones', $derivaciones );
						}
					}
					
					//print_r($lista_db);
					$this->template->styles = array ('media/css/tablas.css' => 'screen','media/css/fcbk.css' => 'screen' );
                                        $this->template->scripts=array('media/js/jquery.fcbkcomplete.min.js');
					$this->template->content = View::factory ( 'user/derivar' )->bind ( 'options', $lista_derivacion )->bind ( 'documento', $documento )->bind ( 'acciones', $acciones )->bind('errors',$errors);
					
				}
			}
                        else{ }
		
		}
	}
//confirmar derivacion y mostrar seguimiento
        

}
?>
