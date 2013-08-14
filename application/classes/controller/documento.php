<?php

defined('SYSPATH') or die('Acceso denegado');

class Controller_documento extends Controller_DefaultTemplate {

    protected $user;
    protected $menus;

    public function before() {
        $auth = Auth::instance();
        //si el usuario esta logeado entocnes mostramos el menu
        if ($auth->logged_in()) {
            //menu top de acuerdo al nivel
            $session = Session::instance();
            $this->user = $session->get('auth_user');
            $oNivel = New Model_niveles();
            $this->menus = $oNivel->menus($this->user->nivel);
            parent::before();
            $this->template->title = 'Documentos';
        } else {
            $url = substr($_SERVER['REQUEST_URI'], 1);
            $this->request->redirect('/login?url=' . $url);
        }
    }

    public function after() {
        $this->template->menutop = View::factory('templates/menutop')->bind('menus', $this->menus)->set('controller', 'documento');
        $oSM = New Model_menus();
        $submenus = $oSM->submenus('documento');
        $docs = FALSE;
        if ($this->user->nivel == 4) {
            $docs = TRUE;
        }
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus', $submenus)->bind('doc', $docs)->set('titulo', 'DOCUMENTOS');
        parent::after();
    }

    public function action_index($id = '') {
        //$url = Cookie::set('url',Request::detect_uri());
        $oTipo = New Model_Tipos();
        $mistipos = $oTipo->misTipos($this->user->id);
        $oDoc = New Model_documentos();
        $documentos = $oDoc->agrupados($this->user->id);
        if (sizeof($documentos) > 0) {
            $recientes = $oDoc->recientes($this->user->id);
            $tipos = array();
            $arrTipos = ORM::factory('tipos')->where('doc', '=', '0')->find_all();
            foreach ($arrTipos as $t) {
                $tipos[$t->id] = $t->plural;
            }
            $this->template->styles = array('media/css/tablas.css' => 'all');
            $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
            $this->template->title .= ' | Documentos Generados';
            $this->template->content = View::factory('documentos/index')
                    ->bind('documentos', $documentos)
                    ->bind('tipos', $tipos)
                    ->bind('mistipos', $mistipos)
                    ->bind('recientes', $recientes);
        } else {
            $this->request->redirect('/documento/nuevo');
        }
    }

    public function action_crear($t = '') {
        $tipo = ORM::factory('tipos', array('action' => $t));
        if ($tipo->loaded()) {
            if (isset($_POST['submit'])) {
                $oOficina = New Model_Oficinas();
                $correlativo = $oOficina->correlativo($this->user->id_oficina, $tipo->id);
                $abre = $oOficina->tipo($tipo->id);
                $sigla = $oOficina->sigla($this->user->id_oficina);
                if ($abre != '')
                    $abre = $abre . '/';
                $codigo = $abre . $sigla . ' Nº ' . $correlativo . '/' . date('Y');
                //ahora creamos el documento
                $documento = ORM::factory('documentos'); //intanciamos el modelo documentos                        
                $documento->id_user = $this->user->id;
                $documento->id_tipo = $tipo->id;
                $documento->id_proceso = $_POST['proceso'];
                $documento->id_oficina = $this->user->id_oficina;
                $documento->codigo = $codigo;
                $documento->cite_original = $codigo;
                $documento->nombre_destinatario = $_POST['destinatario']; //
                $documento->cargo_destinatario = $_POST['cargo_des'];
                $documento->institucion_destinatario = $_POST['institucion_des'];
                $documento->nombre_remitente = $_POST['remitente'];
                $documento->cargo_remitente = $_POST['cargo_rem'];
                $documento->mosca_remitente = $_POST['mosca'];
                $documento->referencia = strtoupper($_POST['referencia']);
                $documento->contenido = $_POST['descripcion'];
                $documento->fecha_creacion = date('Y-m-d H:i:s');
                $documento->adjuntos = $_POST['adjuntos'];
                $documento->copias = $_POST['copias'];
                $documento->nombre_via = $_POST['via'];
                $documento->cargo_via = $_POST['cargovia'];
                $documento->titulo = $_POST['titulo'];
                $documento->id_entidad = $this->user->id_entidad;
                $documento->save();
                //si se creo el documento entonces
                if ($documento->id) {
                    //generamos la hoja de ruta a partir de la entidad
                    $entidad = ORM::factory('entidades', $this->user->id_entidad);
                    $oNur = New Model_nurs();
                    //$nur=$oNur->correlativo($tipo->id, $entidad->sigla.'/',$this->user->id_entidad);   
                    //codigo Freddy
                    $nur = $oNur->correlativo_nur($entidad->sigla . '/', $this->user->id_entidad);

                    $nur_asignado = $oNur->asignarNur($nur, $this->user->id, $this->user->nombre);
                    $documento->nur = $nur;
                    $documento->save();
                    //cazamos al documento con el nur asignado
                    $rs = $documento->has('nurs', $nur_asignado);
                    $documento->add('nurs', $nur_asignado);
                    $_POST = array();
                    $this->request->redirect('documento/editar/' . $documento->id);
                }
            }
        }
        $oVias = new Model_data();
        $destinatarios = $oVias->vias($this->user->id);
        //$destinatarios=$oVias->destinatarios($this->user->id);
        $superior = $oVias->superior($this->user->id);
        $dependientes = $oVias->dependientes($this->user->id);
        $procesos = ORM::factory('procesos')->find_all();
        $options = array();
        foreach ($procesos as $p) {
            $options[$p->id] = $p->proceso;
        }
        //$this->template->scripts = array('ckeditor/adapters/jquery.js', 'ckeditor/ckeditor.js');
        $this->template->scripts = array('tinymce/tinymce.min.js');
        $this->template->title .= ' | Crear ' . $tipo->tipo;
        if ($t == 'circular') {
            $oficina = ORM::factory('oficinas')->where('id', '=', $this->user->id_oficina)->find();
            $entidad = ORM::factory('entidades')->where('id', '=', $oficina->id_entidad)->find();
            $oficinas = ORM::factory('oficinas')->where('id_entidad', '=', $entidad->id)->find_all();
            $this->template->content = View::factory('documentos/crear_circular')
                    ->bind('options', $options)
                    ->bind('user', $this->user)
                    ->bind('documento', $tipo)
                    ->bind('superior', $superior)
                    ->bind('dependientes', $dependientes)
                    ->bind('oficinas', $oficinas)
                    ->bind('tipo', $tipo)
                    ->bind('destinatarios', $destinatarios);
        } else {

            $this->template->content = View::factory('documentos/create')
                    ->bind('options', $options)
                    ->bind('user', $this->user)
                    ->bind('documento', $tipo)
                    ->bind('superior', $superior)
                    ->bind('dependientes', $dependientes)
                    ->bind('tipo', $tipo)
                    ->bind('destinatarios', $destinatarios);
        }
    }

    public function action_vista() {
        $codigo = $_GET['doc'];
        $mensajes = array();
        $errors = array();
        $documento = ORM::factory('documentos')
                ->where('codigo', '=', $codigo)
                //->and_where('id_user','=',$this->user->id)
                ->find();
        if ($documento->loaded()) {
            $tipo = $documento->tipos->action;
            //archivo
            // $archivo=ORM::factory('archivos')
            //         ->where('id_documento','=',$id)
            //        ->find();
            //tipo
            //$tipo=  ORM::factory('tipos',$documento->id_tipo);                    
            $this->template->title .= ' | ' . $documento->codigo;
            $this->template->content = View::factory('documentos/vista_2')
                    ->bind('d', $documento)
                    ->bind('tipo', $tipo)
                    //->bind('archivo', $archivo)
                    ->bind('errors', $errors)
                    ->bind('mensajes', $mensajes);
        } else {
            $this->template->content = 'El documento no existe';
        }
    }

    public function action_detalle($id = 0) {
        $mensajes = array();
        $errors = array();
        //Subir documento para adjuntar
        if ($_POST) {
            $id_documento = Arr::get($_POST, 'id_doc', '');
            $post = Validation::factory($_FILES)
                    ->rule('archivo', 'Upload::not_empty')
                    ->rule('archivo', 'Upload::type', array(':value', array('docx', 'doc', 'pdf')))
                    ->rule('archivo', 'Upload::size', array(':value', '5M'));
            //si pasa la validacion guardamamos 
            if ($post->check()) {
                $filename = upload::save($_FILES ['archivo']);
                $archivo = ORM::factory('archivos')->where('id_documento', '=', $id_documento)->find(); //intanciamos el modelo proveedor							
                $archivo->nombre_archivo = basename($filename);
                $archivo->extension = $_FILES ['archivo'] ['type'];
                $archivo->tamanio = $_FILES ['archivo'] ['size'];
                $archivo->id_user = $this->user->id;
                $archivo->id_documento = $id_documento;
                $archivo->fecha = time();
                $archivo->save();
                $mensajes['Archivo'] = 'Su archivo de  guardado satisfactoriamente';
            } else {
                $errors['Subir Archivo'] = 'El archivo debe de ser en formato word y de tamaño menor a 5M';
            }
        }
        $documento = ORM::factory('documentos')->where('id', '=', $id)->find();
        if ($documento->loaded()) {
            $ok = true;
            if ($documento->estado == 1) { //si esta derivado entonces el documento solo pueden ver aquellos quienes intevienen en el seguimiento
                $ok = false;
                $seguimiento = ORM::factory('seguimiento')
                        ->where('nur', '=', $documento->nur)
                        ->find_all();
                foreach ($seguimiento as $s) {
                    if (($s->derivado_a == $this->user->id) || ($s->derivado_por == $this->user->id) || $this->user->prioridad == 1)
                        $ok = true;
                }
            }
            if ($ok) {
                $tipo = $documento->tipos->action;
                //archivo
                $archivo = ORM::factory('archivos')->where('id_documento', '=', $id)->find_all();
                $this->template->scripts = array('ckeditor/adapters/jquery.js', 'ckeditor/ckeditor.js');
                $this->template->title .= ' | ' . $documento->codigo;
                $this->template->content = View::factory('documentos/detalle')
                        ->bind('d', $documento)
                        ->bind('tipo', $tipo)
                        ->bind('archivo', $archivo)
                        ->bind('errors', $errors)
                        ->bind('mensajes', $mensajes);
            } else {
                $this->template->content = View::factory('no_access');
            }
        } else {
            $this->template->content = 'El documento no existe';
        }
    }

    public function generar_codigo($tip, $abre, $id) {
        //obtenemos la sigla de la oficina
        $oficina = ORM::factory('oficinas', $id);
        if ($oficina) {
            $correlativo = ORM::factory('correlativo')->where('id_oficina', '=', $id)
                    ->and_where('id_tipo', '=', $tip)
                    ->find();
            if ($correlativo->loaded()) {
                $correlativo->correlativo = $correlativo->correlativo + 1; //incrementamos en 1 el correlativo
                $correlativo->save();
                $corr = substr('000' . $correlativo->correlativo, -4);
                if ($abre != '')
                    $abre.='/';
                return $abre . $oficina->sigla . '/' . date('Y') . '-' . $corr;
                //return $codigo;
            }
        }
    }

// lista de documentos segun el tipo    
    public function action_tipo($t = '') {
        $tipo = ORM::factory('tipos', array('id' => $t));
        $count = $tipo->documentos->where('id_user', '=', $this->user->id)->and_where('id_tipo', '=', $tipo->id)->count_all();
        // Creamos una instancia de paginacion + configuracion
        $pagination = Pagination::factory(array(
                    'total_items' => $count,
                    'current_page' => array('source' => 'query_string', 'key' => 'page'),
                    'items_per_page' => 15,
                    'view' => 'pagination/floating',
                ));
        $results = $tipo->documentos
                ->where('id_user', '=', $this->user->id)
                ->and_where('id_tipo', '=', $tipo->id)
                ->order_by('fecha_creacion', 'DESC')
                ->limit($pagination->items_per_page)
                ->offset($pagination->offset)
                ->find_all();
        // Render the pagination links
        $page_links = $pagination->render();
        //tipos para los tabs       
        $this->template->title .= ' | ' . $tipo->plural;
        $this->template->styles = array('media/css/tablas.css' => 'screen');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->content = View::factory('documentos/listar')
                ->bind('results', $results)
                ->bind('page_links', $page_links)
                ->bind('tipo', $tipo);
    }

    /*
     * function para editar un documento
     * 
     */

    public function action_editar($id = '') {
        $mensajes = array();
        $documento = ORM::factory('documentos')->where('id', '=', $id)->and_where('id_user', '=', $this->user->id)->find();
        if ($documento->loaded()) {
            //si se envia los datos modificados entonces guardamamos
            if (isset($_POST['referencia'])) {
                $documento->nombre_destinatario = $_POST['destinatario'];
                ; //
                $documento->cargo_destinatario = $_POST['cargo_des'];
                $documento->institucion_destinatario = $_POST['institucion_des'];
                $documento->nombre_remitente = $_POST['remitente'];
                $documento->cargo_remitente = $_POST['cargo_rem'];
                $documento->mosca_remitente = $_POST['mosca'];
                $documento->referencia = strtoupper($_POST['referencia']);
                $documento->contenido = $_POST['descripcion'];
//                   $documento->fecha_creacion=  time(); //fecha y hora en formato int
                $documento->adjuntos = $_POST['adjuntos'];
                $documento->copias = $_POST['copias'];
                $documento->nombre_via = $_POST['via'];
                $documento->cargo_via = $_POST['cargovia'];
                $documento->titulo = $_POST['titulo'];
                $documento->id_proceso = $_POST['proceso'];
                $documento->save();
                $mensajes['Modificado!'] = 'El documento se modifico correctamente.';
            }
            if (isset($_POST['adjuntar'])) {

                $path = 'archivos/' . date('Y_m');
                if (!is_dir($path)) {
                    // Creates the directory 
                    if (!mkdir($path, 0777, TRUE)) {
                        // On failure, throws an error 
                        throw new Exception("No se puedo crear el directorio!");
                        exit;
                    }
                }
                $filename = upload::save($_FILES ['archivo'], NULL, $path);
                if ($_FILES ['archivo']['name'] != '') {
                    $archivo = ORM::factory('archivos'); //intanciamos el modelo proveedor							                
                    $archivo->nombre_archivo = basename($filename);
                    $archivo->extension = $_FILES ['archivo'] ['type'];
                    $archivo->tamanio = $_FILES ['archivo'] ['size'];
                    $archivo->id_user = $this->user->id;
                    $archivo->id_documento = $_POST['id_doc'];
                    $archivo->sub_directorio = date('Y_m');
                    $archivo->fecha = date('Y-m-d H:i:s');
                    $archivo->save();
                    if ($archivo->id > 0)
                        $_POST = array();
                }
            }
            $oficina = ORM::factory('oficinas', $this->user->id_oficina);

            $oVias = new Model_data();
            $vias = $oVias->vias($this->user->id);
            $superior = $oVias->superior($this->user->id);
            //$destinatarios=$oVias->destinatarios($this->user->id);
            $tipo = ORM::factory('tipos', $documento->id_tipo);
            $archivos = ORM::factory('archivos')->where('id_documento', '=', $id)->and_where('estado', '=', 1)->find_all();
            $procesos = ORM::factory('procesos')->find_all();
            $options = array();
            foreach ($procesos as $p) {
                $options[$p->id] = $p->proceso;
            }
            $this->template->title .= ' | ' . $documento->codigo;
            $this->template->styles = array('media/css/tablas.css' => 'screen');
            //$this->template->scripts = array('ckeditor/adapters/jquery.js', 'ckeditor/ckeditor.js', 'media/js/jquery.si.js');
            $this->template->scripts = array('tinymce/tinymce.min.js');

            if ($tipo->tipo == 'Circular') {
                $oficina = ORM::factory('oficinas')->where('id', '=', $this->user->id_oficina)->find();
                $entidad = ORM::factory('entidades')->where('id', '=', $oficina->id_entidad)->find();
                $oficinas = ORM::factory('oficinas')->where('id_entidad', '=', $entidad->id)->find_all();
                $this->template->content = View::factory('documentos/edit_circular')
                        ->bind('documento', $documento)
                        ->bind('options', $options)
                        ->bind('mensajes', $mensajes)
                        ->bind('user', $this->user)
                        //->bind('documento', $tipo)
                        ->bind('superior', $superior)
                        ->bind('dependientes', $dependientes)
                        ->bind('oficinas', $oficinas)
                        ->bind('tipo', $tipo)
                        ->bind('archivos', $archivos)
                        ->bind('destinatarios', $destinatarios);
            } else {
                $this->template->content = View::factory('documentos/edit')
                        ->bind('documento', $documento)
                        ->bind('archivos', $archivos)
                        ->bind('tipo', $tipo)
                        ->bind('superior', $superior)
                        ->bind('vias', $vias)
                        ->bind('user', $this->user)
                        ->bind('options', $options)
                        ->bind('mensajes', $mensajes)
                        ->bind('archivos', $archivos)
                        ->bind('destinatarios', $destinatarios);
            }
        } else {
            $this->template->content = 'Solo puede editar documentos creados por su usuario ';
        }
    }

    public function action_nuevo() {
        $oDoc = New Model_Tipos();
        $documentos = $oDoc->misTipos($this->user->id);
        $this->template->title.= ' | Crear documento';
        $this->template->content = View::factory('documentos/nuevo')
                ->bind('documentos', $documentos);
    }

    public function action_add_file() {
        if ($_POST) {
            for ($i = 0; $i < count($_FILES ['archivo']) - 1; $i++) {
                echo $_FILES ['archivo']['name'][$i];
            }
            var_dump($_FILES);
            /* $filename = upload::save ( $_FILES ['archivo'],NULL,'archivo/'.date('Y_m') );												
              $archivo = ORM::factory ( 'archivos' ); //intanciamos el modelo proveedor
              $archivo->nombre_archivo = basename($filename);
              $archivo->extension = $_FILES ['archivo'] ['type'];
              $archivo->tamanio = $_FILES ['archivo'] ['size'];
              $archivo->id_user = $this->user->id;
              $archivo->id_documento = $documento->id;
              $archivo->sub_directorio = date('Y').'/';
              $archivo->fecha = date('Y-m-d H:i:s');
              $archivo->save ();
             * 
             */
        }
        $this->template->content = View::factory('documentos/add_file');
    }

    public function action_archivos() {
        $oArchivo = New Model_archivos();
        $archivo = $oArchivo->listar($this->user->id);
        $this->template->styles = array('media/css/tablas.css' => 'all');
        $this->template->scripts = array('media/js/jquery.tablesorter.min.js');
        $this->template->title .= ' | Archivos Digitales';
        $this->template->content = View::factory('documentos/archivos')
                ->bind('results', $archivo);
    }

}

?>
