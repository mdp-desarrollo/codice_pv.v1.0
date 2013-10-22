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
        } else 
{            $url = substr($_SERVER['REQUEST_URI'], 1);
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
                
                $contenido = $_POST['descripcion'];
                if (isset($_POST['fucov'])) {
                    $contenido = '<p style="text-align: justify;">Por medio del presente Memorándum se ordena a su persona trasladarse desde: La ciudad ' . $_POST['origen'] . ' hasta la ciudad ' . $_POST['destino'] . ' con el objetivo de asistir a ' . $_POST['detalle_comision'] . '. Desde el ' . $_POST['fecha_inicio'] . ' a Hrs. ' . $_POST['hora_inicio'] . ' hasta el ' . $_POST['fecha_fin'] . ' a Hrs. ' . $_POST['hora_fin'] .'.</p>    
                        <p></p>
                        <p style="text-align: justify;">Sírvase tramitar ante la Dirección General de Asuntos Administrativos la asignación de pasajes y viáticos de acuerdo a escala autorizada para lo cual su persona deberá coordinar la elaboración del FUCOV. Una vez completada la comisión sírvase hacer llegar el informe de descargo dentro de los próximos 8 días hábiles de concluída la comisión de acuerdo al artículo 25 del reglamento de Pasajes y Viáticos del Ministerio de Desarrollo Productivo y Economía Plural.</p>
                        <p></p>
                        <p style="text-align: justify;">Saludo a usted atentamente. </p>';
                    // if ($_POST['observacion']) {
                    //     $contenido.= $_POST['observacion'];
                    // }
                }
                
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
                $documento->contenido = $contenido;
                $documento->fecha_creacion = date('Y-m-d H:i:s');
                $documento->adjuntos = $_POST['adjuntos'];
                $documento->copias = $_POST['copias'];
                $documento->nombre_via = $_POST['via'];
                $documento->cargo_via = $_POST['cargovia'];
                $documento->titulo = $_POST['titulo'];
                $documento->id_entidad = $this->user->id_entidad;
                if (isset($_POST['fucov']))
                    $documento->fucov = 1;
                else
                    $documento->fucov = 0;

                $documento->save();
                //si se creo el documento entonces
                if ($documento->id) {

                    //Modificado por Freddy Velasco
                    if (isset($_POST['fucov'])) {
                        $fi = date('Y-m-d', strtotime(substr($_POST['fecha_inicio'], 4, 10))) . ' ' . date('H:i:s', strtotime($_POST['hora_inicio']));
                        $ff = date('Y-m-d', strtotime(substr($_POST['fecha_fin'], 4, 10))) . ' ' . date('H:i:s', strtotime($_POST['hora_fin']));
                        $pvcomision = ORM::factory('pvcomisiones');
                        $pvcomision->id_documento = $documento->id;
                        $pvcomision->detalle_comision = $_POST['detalle_comision'];
                        $pvcomision->origen = $_POST['origen'];
                        $pvcomision->destino = $_POST['destino'];
                        $pvcomision->fecha_inicio = $fi;
                        $pvcomision->fecha_fin = $ff;
                        $pvcomision->observacion = $_POST['observacion'];
                        $pvcomision->estado = 1;
                        $pvcomision->save();
                    }
                    ///////////end//////////////////
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
        //$this->template->scripts = array('tinymce/tinymce.min.js');
        $this->template->styles = array('media/css/jquery-ui-1.8.16.custom.css' => 'screen');
        $this->template->scripts = array('tinymce/tinymce.min.js', 'media/js/jquery-ui-1.8.16.custom.min.js', 'media/js/jquery.timeentry.js'); ///
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
            $estado = 0;
            if ($documento->estado == 1) { //si esta derivado entonces el documento solo pueden ver aquellos quienes intevienen en el seguimiento
                $ok = false;
                $seguimiento = ORM::factory('seguimiento')
                        ->where('nur', '=', $documento->nur)
                        ->find_all();
                foreach ($seguimiento as $s) {
                    if (($s->derivado_a == $this->user->id) || ($s->derivado_por == $this->user->id) || $this->user->prioridad == 1)
                        $ok = true;
                    ///rodrigo, estado=recibido => mostrar el detallepv 210813
                    if ($s->derivado_a == $this->user->id)
                        $estado = $s->estado;
                    ///210813
                }
            }
            if ($ok) {
                $tipo = $documento->tipos->action;
                //archivo
                $archivo = ORM::factory('archivos')->where('id_documento', '=', $id)->find_all();
                // Modificado por freddy
                $pvcomision = array();
                if ($documento->fucov == 1) {
                    $pvcomision = ORM::factory('pvcomisiones')->where('id_documento','=',$id)->find();
                }
                /////////////////
                ///rodrigo detallepasajes, 210813
                $detallepv = $this->pvmodificar($id, $estado);
                $this->template->scripts = array('tinymce/tinymce.min.js', 'media/js/jquery-ui-1.8.16.custom.min.js', 'media/js/jquery.timeentry.js');
                $this->template->styles = array('media/css/jquery-ui-1.8.16.custom.css' => 'screen', 'media/css/tablas.css' => 'screen');
                ///210813
                $this->template->title .= ' | ' . $documento->codigo;
                $this->template->content = View::factory('documentos/detalle')
                        ->bind('d', $documento)
                        ->bind('tipo', $tipo)
                        ->bind('archivo', $archivo)
                        ->bind('errors', $errors)
                        ->bind('mensajes', $mensajes)
                        ->bind('pvcomision', $pvcomision)
                        ->bind('detallepv', $detallepv);
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

                $contenido = $_POST['descripcion'];
                if (isset($_POST['fucov'])) {
                    $contenido = '<p style="text-align: justify;">Por medio del presente Memorándum se ordena a su persona trasladarse desde: La ciudad ' . $_POST['origen'] . ' hasta la ciudad ' . $_POST['destino'] . ' con el objetivo de asistir a ' . $_POST['detalle_comision'] . '. Desde el ' . $_POST['fecha_inicio'] . ' a Hrs. ' . $_POST['hora_inicio'] . ' hasta el ' . $_POST['fecha_fin'] . ' a Hrs. ' . $_POST['hora_fin'] .'.</p>    
                        <br>
                        <p style="text-align: justify;">Sírvase tramitar ante la Dirección General de Asuntos Administrativos la asignación de pasajes y viáticos de acuerdo a escala autorizada para los cual su persona deberá coordinar la elaboración del FUCOV. Una vez completada la comisión sírvase hacer llegar el informe de descargo dentro de los próximos 8 días hábiles de concluída la comisión de acuerdo al artículo 25 del reglamento de Pasajes y viáticos del Ministerio de Desarrollo Productivo y Economía Plural. </p> 
                        <br>
                        <p style="text-align: justify;">Saludo a usted atentamente. </p>';
                    // if ($_POST['observacion']) {
                    //     $contenido.= $_POST['observacion'];
                    // }
                }

                $documento->nombre_destinatario = $_POST['destinatario'];
                $documento->cargo_destinatario = $_POST['cargo_des'];
                $documento->institucion_destinatario = $_POST['institucion_des'];
                $documento->nombre_remitente = $_POST['remitente'];
                $documento->cargo_remitente = $_POST['cargo_rem'];
                $documento->mosca_remitente = $_POST['mosca'];
                $documento->referencia = strtoupper($_POST['referencia']);
                $documento->contenido = $contenido;
//                   $documento->fecha_creacion=  time(); //fecha y hora en formato int
                $documento->adjuntos = $_POST['adjuntos'];
                $documento->copias = $_POST['copias'];
                $documento->nombre_via = $_POST['via'];
                $documento->cargo_via = $_POST['cargovia'];
                $documento->titulo = $_POST['titulo'];
                $documento->id_proceso = $_POST['proceso'];
                if (isset($_POST['fucov']))
                    $documento->fucov = 1;
                else
                    $documento->fucov = 0;
                $documento->save();

                //Modificado por Freddy Velasco
                // cuando se crea un memoramdum
                if (isset($_POST['fucov'])) {
                    $fi = date('Y-m-d', strtotime(substr($_POST['fecha_inicio'], 4, 10))) . ' ' . date('H:i:s', strtotime($_POST['hora_inicio']));
                    $ff = date('Y-m-d', strtotime(substr($_POST['fecha_fin'], 4, 10))) . ' ' . date('H:i:s', strtotime($_POST['hora_fin']));
                    $pvcomision = ORM::factory('pvcomisiones')->where('id_documento', '=', $id)->find();
                    //$pvcomision->id_documento = $documento->id;
                    $pvcomision->detalle_comision = $_POST['detalle_comision'];
                    $pvcomision->origen = $_POST['origen'];
                    $pvcomision->destino = $_POST['destino'];
                    $pvcomision->fecha_inicio = $fi;
                    $pvcomision->fecha_fin = $ff;
                    $pvcomision->observacion = $_POST['observacion'];
                    //$pvcomision->estado = 1;
                    $pvcomision->save();
                }

                //cuando se edita un fucov
                $pvfucov = ORM::factory('pvfucovs')->where('id_documento', '=', $id)->find();
                if ($pvfucov->loaded()) {
                    $fi = date('Y-m-d', strtotime(substr($_POST['fecha_salida'], 4, 10))) . ' ' . date('H:i:s', strtotime($_POST['hora_salida']));
                    $ff = date('Y-m-d', strtotime(substr($_POST['fecha_arribo'], 4, 10))) . ' ' . date('H:i:s', strtotime($_POST['hora_arribo']));
                    $pvfucov = ORM::factory('pvfucovs')->where('id_documento', '=', $id)->find();
                    $pvfucov->origen = $_POST['origen'];
                    $pvfucov->destino = $_POST['destino'];
                    $pvfucov->fecha_salida = $fi;
                    $pvfucov->fecha_arribo = $ff;
                    $pvfucov->cancelar = $_POST['cancelar'];
                    $pvfucov->porcentaje_viatico = $_POST['porcentaje_viatico'];
                    $pvfucov->financiador = $_POST['financiador'];
                    $pvfucov->transporte = $_POST['transporte'];
                    $pvfucov->representacion = $_POST['representacion'];
                    $pvfucov->gasto_representacion = $_POST['gasto_representacion'];
                    $pvfucov->impuesto = $_POST['impuesto'];
                    $pvfucov->gasto_imp = $_POST['gasto_imp'];
                    $pvfucov->justificacion_finsem = $_POST['justificacion_finsem'];
                    $pvfucov->total_viatico = $_POST['total_viatico'];
                    $pvfucov->total_pasaje = $_POST['total_pasaje'];
                    $pvfucov->id_categoria = $_POST['id_categoria'];
                    $pvfucov->id_tipoviaje = $_POST['id_tipoviaje'];
                    $pvfucov->etapa_proceso = 1;
                    $pvfucov->tipo_cambio = $_POST['tipo_cambio'];
                    $pvfucov->tipo_moneda = $_POST['tipo_moneda'];
                    $pvfucov->viatico_dia = $_POST['viatico_dia'];
                    $pvfucov->id_programatica = $_POST['fuente']; ///rodrigo
                    $pvfucov->save();
                    /// rodrigo -modificar POA 260813
                    $pvpoas = ORM::factory('pvpoas')->where('id_fucov', '=', $pvfucov->id)->find();
                    $pvpoas->fecha_modificacion = date('Y-m-d H:i:s');
                    $pvpoas->id_obj_gestion = $_POST['obj_gestion'];
                    $pvpoas->id_obj_esp = $_POST['obj_esp'];
                    $pvpoas->id_actividad = $_POST['actividad'];
                    $pvpoas->save();
                    ///
                }
                ///////////end//////////////////

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
            //$oficina = ORM::factory('oficinas', $this->user->id_oficina);

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
            $this->template->scripts = array('tinymce/tinymce.min.js');
            $this->template->styles = array('media/css/jquery-ui-1.8.16.custom.css' => 'screen', 'media/css/tablas.css' => 'screen');
            $this->template->scripts = array('tinymce/tinymce.min.js', 'media/js/jquery-ui-1.8.16.custom.min.js', 'media/js/jquery.timeentry.js'); ///

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
            } else if ($tipo->tipo == 'FUCOV') {
                $pvcomision = ORM::factory('pvcomisiones')->where('id_documento', '=', $documento->id)->find();
                $pvfucov = ORM::factory('pvfucovs')->where('id_documento', '=', $documento->id)->find();
                $pvtipoviaje = ORM::factory('pvtipoviajes')->where('estado', '=', '1')->find_all();
                $opt_tv = array();
                $opt_tv[''] = "(Seleccionar)";
                foreach ($pvtipoviaje as $tv) {
                    $opt_tv[$tv->id] = $tv->tipoviaje;
                }

                ///rodrigo 260813, Unidad Ejecutora POA para el usuario
                $cambio = ORM::factory('pvtipocambios')->find_all();
                foreach($cambio as $c)
                    $tipo_cambio = $c->cambio_venta;
                $uEjepoa = New Model_oficinas();
                $uejecutorapoa = $uEjepoa->uejecutorapoa($this->user->id_oficina); ///buscar la unidad ejecutora POA y PPT para la oficina de este usuario
                $uejecutorappt = $uEjepoa->uejecutorappt($this->user->id_oficina);
                $oFuente = New Model_Pvprogramaticas(); ///fuentes de financiamiento
                $fte = $oFuente->listafuentesuser($uejecutorappt->id);
                $fuente[''] = 'Seleccione Una Fuente de Financiamiento';
                foreach ($fte as $f){$fuente[$f->id] = $f->actividad;}
                
                $ogestion = ORM::factory('pvogestiones')->where('id_oficina','=',$uejecutorapoa->id)->and_where('estado','=',1)->find_all();///objetivos de gestion
                $objgestion[''] = 'Seleccione Objetivo de Gestion';
                foreach ($ogestion as $og){$objgestion[$og->id] = $og->codigo;}

                $pvpoas = ORM::factory('pvpoas')->where('id_fucov', '=', $pvfucov->id)->find();
                $objespecifico[''] = 'Seleccione Objetivo Especifico';
                $actividad[''] = 'Seleccione la Actividad';
                $partidasgasto = '';
                if ($pvpoas->id_obj_gestion) {
                    $det = ORM::factory('pvogestiones')->where('id', '=', $pvpoas->id_obj_gestion)->find(); ///Detalle Objetivo de Gestion
                    $detallegestion = $det->objetivo;
                    $oesp = ORM::factory('pvoespecificos')->where('id_obj_gestion', '=', $pvpoas->id_obj_gestion)->find_all(); ///objetivo especifico
                    foreach ($oesp as $oe) {
                        $objespecifico[$oe->id] = $oe->codigo;
                        if ($oe->id == $pvpoas->id_obj_esp)
                            $detalleespecifico = $oe->objetivo;
                    }
                    $act = ORM::factory('pvactividades')->where('id_objespecifico', '=', $pvpoas->id_obj_esp)->find_all(); ///actividades del POA
                    foreach ($act as $a) {
                        $actividad[$a->id] = $a->codigo;
                        if ($a->id == $pvpoas->id_actividad)
                            $detalleactividad = $a->actividad;
                    }
                    $oPart = New Model_Pvprogramaticas();
                    $partidasgasto = $oPart->pptdisponibleuser($pvfucov->id_programatica, $pvfucov->total_pasaje, $pvfucov->total_viatico, $pvfucov->id_tipoviaje, $pvfucov->gasto_representacion,$tipo_cambio);//mostrar las partidas presupuestarias almacenadas
                }
                /// fin 260813/

                $this->template->content = View::factory('documentos/edit_fucov')
                        ->bind('documento', $documento)
                        ->bind('archivos', $archivos)
                        ->bind('tipo', $tipo)
                        ->bind('superior', $superior)
                        ->bind('vias', $vias)
                        ->bind('user', $this->user)
                        ->bind('mensajes', $mensajes)
                        ->bind('archivos', $archivos)
                        ->bind('destinatarios', $destinatarios)
                        ->bind('opt_tv', $opt_tv)
                        ->bind('pvfucov', $pvfucov)
                        ///rodrigo-POA
                        ->bind('uejecutorapoa', $uejecutorapoa)
                        ->bind('uejecutorappt', $uejecutorappt)
                        ->bind('fuente', $fuente)
                        ->bind('pvpoas', $pvpoas)
                        ->bind('obj_gestion', $objgestion)//ista de objetivos de gestion para la oficina
                        ->bind('obj_esp', $objespecifico)
                        ->bind('actividad', $actividad)
                        ->bind('det_obj_gestion', $detallegestion)//detalle del objetivo de gestion
                        ->bind('det_obj_esp', $detalleespecifico)
                        ->bind('det_act', $detalleactividad)
                        ->bind('partidasgasto', $partidasgasto)
                        ->bind('tipo_cambio', $tipo_cambio)
                ;
                ///POA
            } else {
                $pvcomision = ORM::factory('pvcomisiones')->where('id_documento', '=', $documento->id)->find();
                $this->template->content = View::factory('documentos/edit')
                        ->bind('documento', $documento)
                        ->Bind('archivos', $archivos)
                        ->bind('tipo', $tipo)
                        ->bind('superior', $superior)
                        ->bind('vias', $vias)
                        ->bind('user', $this->user)
                        ->bind('options', $options)
                        ->bind('mensajes', $mensajes)
                        ->bind('archivos', $archivos)
                        ->bind('destinatarios', $destinatarios)
                        ->bind('pvcomision', $pvcomision);
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

    ///rodrigo(opciones por usuario) 210813
    public function pvmodificar($id, $estado) {
        $detallepv = '';
        $memo = ORM::factory('documentos')->where('id', '=', $id)->and_where('fucov','=',1)->find();
        if ($estado == 2 && $memo->loaded()) {
            $pvfucov = ORM::factory('pvfucovs')->where('id_memo', '=', $id)->find();
            $documento = ORM::factory('documentos')->where('id','=',$pvfucov->id_documento)->and_where('id_tipo','=',13)->find();
            //$oficina = ORM::factory('oficinas')->where('id', '=', $memo->id_oficina)->find();///oficina del usuario solicintante
            $cambio = ORM::factory('pvtipocambios')->find_all();
            foreach($cambio as $c)
                 $tipo_cambio = $c;
            if ($pvfucov->loaded()) {
                $nivel = $this->user->nivel;
                switch ($nivel) {
                    case 6://pasajes y viaticos
                        $pasajes = ORM::factory('pvpasajes')->where('id_fucov', '=', $pvfucov->id)->order_by('id', 'asc')->find_all();
                        $detallepv = View::factory('pvpasajes/detalle')
                                ->bind('pvfucov', $pvfucov)
                                ->bind('estado', $estado)
                                ->bind('pasajes', $pasajes)
                                ->bind('tipo_cambio', $tipo_cambio)
                        ;
                        break;
                    case 7:///presupuesto
                        $uEjepoa = New Model_oficinas();                
                        $uejecutorappt = $uEjepoa->uejecutorappt($this->user->id_oficina);///buscar unidad ejecutora del PPT
                        $oFuente = New Model_Pvprogramaticas();
                        $fte = $oFuente->listafuentesppt($uejecutorappt->id, $this->user->id_entidad); ///fuente por oficina + dgga en caso del MDP
                        $fuente = array();
                        $fuente[''] = 'Seleccione Una Fuente de Financiamiento';
                        foreach ($fte as $f)
                            $fuente[$f->id] = $f->actividad;
                        $oPart = New Model_Pvprogramaticas();
                        $pvliquidacion = ORM::factory('pvliquidaciones')->where('id_fucov','=',$pvfucov->id)->find();
                        if($pvliquidacion->loaded()){
                            $oPart = New Model_Pvprogramaticas();
                            $pvliquidacion = $oPart->pptliquidado($pvfucov->id,$pvfucov->total_pasaje,$pvfucov->total_viatico,$pvfucov->id_tipoviaje,$pvfucov->gasto_representacion,$tipo_cambio->cambio_venta);
                        }
                        else{
                            $oPart = New Model_Pvprogramaticas();
                            $pvliquidacion = $oPart->pptdisponibleuser($pvfucov->id_programatica,$pvfucov->total_pasaje,$pvfucov->total_viatico,$pvfucov->id_tipoviaje,$pvfucov->gasto_representacion,$tipo_cambio->cambio_venta);
                        }
                        ///detalle de la fuente presupuestaria
                        $det = $oFuente->detallesaldopresupuesto($pvfucov->id_programatica);
                        foreach ($det as $d)
                            $detallefuente = $d;
                        $detallepv = View::factory('pvpresupuesto/detalle')
                                ->bind('pvfucov', $pvfucov)
                                ->bind('estado', $estado)
                                ->bind('fuente', $fuente)
                                ->bind('partidasgasto', $pvliquidacion)
                                ->bind('detallefuente', $detallefuente)
                                ->bind('tipo_cambio', $tipo_cambio)
                        ;
                        break;
                    case 8:///Planificacion
                        $pvpoas = ORM::factory('pvpoas')->where('id_fucov', '=', $pvfucov->id)->find();
                        $uEjepoa = New Model_oficinas();
                        $uejecutorapoa = $uEjepoa->uejecutorapoa($documento->id_oficina);
                        $obj_gest = ORM::factory('pvogestiones')->where('id_oficina', '=', $uejecutorapoa->id)->and_where('estado', '=', 1)->find_all();
                        foreach ($obj_gest as $g) {
                            $ogestion[$g->id] = $g->codigo;
                            if ($g->id == $pvpoas->id_obj_gestion) {
                                $det_obj_gestion = $g->objetivo;
                            }
                        }
                        $oesp = ORM::factory('pvoespecificos')->where('id_obj_gestion', '=', $pvpoas->id_obj_gestion)->and_where('estado', '=', 1)->find_all();
                        $det_obj_esp = '';
                        foreach ($oesp as $e) {
                            $oespecifico[$e->id] = $e->codigo;
                            if ($e->id == $pvpoas->id_obj_esp) {
                                $det_obj_esp = $e->objetivo;
                            }
                        }
                        $act = ORM::factory('pvactividades')->where('id_objespecifico', '=', $pvpoas->id_obj_esp)->and_where('estado', '=', 1)->find_all();
                        $det_actividad = '';
                        foreach ($act as $a) {
                            $actividad[$a->id] = $a->codigo;
                            if ($a->id == $pvpoas->id_actividad) {
                                $det_actividad = $a->actividad;
                            }
                        }
                        $detallepv = View::factory('pvplanificacion/detalle')
                                ->bind('pvfucov', $pvfucov)
                                ->bind('estado', $estado)
                                ->bind('pvpoas', $pvpoas)
                                ->bind('obj_gestion', $ogestion)
                                ->bind('det_obj_gestion', $det_obj_gestion)
                                ->bind('obj_esp', $oespecifico)
                                ->bind('det_obj_esp', $det_obj_esp)
                                ->bind('actividad', $actividad)
                                ->bind('det_act', $det_actividad)
                                ->bind('ue_poa', $uejecutorapoa)
                        ;
                        break;
                    default:///verificar si presento informe de descargo
                        if($this->user->id == $memo->id_user){///preguntar si este usuario creó el memorandum
                            $oDesc = new Model_Pvpasajes();
                            $desc = $oDesc->descargo($id, $this->user->id_entidad);
                            $descargo = array();
                            foreach ($desc as $d)
                                $descargo = $d;///mostrar detalle del ultimo informe de descargo generado
                            if($descargo){
                                $doc = ORM::factory('documentos')
                                        ->where('id_entidad','=',$this->user->id_entidad)
                                        ->and_where('id_proceso','=',18)
                                        ->and_where('id_tipo','=',3)
                                        ->and_where('nur','=',$descargo->nur)
                                        ->find_all();
                                foreach ($doc as $d)
                                    $documento = $d;
                                $tipo = ORM::factory('tipos',$documento->id_tipo);
                                $detallepv = View::factory('pvpasajes/detalleinforme')
                                    ->bind('d', $documento)
                                    ->bind('tipo', $tipo)
                                    ->bind('memo', $memo)
                                    ->bind('descargo', $descargo)
                                        ;
                            }
                        }
                }
            }
        }
        return $detallepv;
    }

    ///210813
}

?>
