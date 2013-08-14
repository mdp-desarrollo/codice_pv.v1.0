<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_articulos extends Controller_DefaultTemplate{
  /*  protected $oArticulo;
    public function  __construct() {
        $this->oArticulo=new Model_Articulos();
    }*/
    protected $session;
    public function action_index(){
        $oArticulo=new Model_Articulos();
        $articulos=$oArticulo->listar();
        foreach ($articulos as $a) {
            echo $a['articulo'].'<br/>';
        }
        echo json_encode($articulos);
        //iniciamos una session
        $session = Session::instance();
        $session->set('usuario', 'ivan marcelo');
    }
    public function action_add(){
        
        $ko3_inner               = array();
        $ko3                     = array();
        $ko3['frmInit']   = Form::open(URL::base().'articulos/add');
        $ko3['lblNombre'] = Form::label('nombre', 'Nombre');
        $ko3['txtNombre'] = Form::input('nombre', '', array('id'=>'nombre','class'=>'required','size'=>'40'));
        $rubros = ORM::factory('rubros')->where('eliminado','=',0)->find_all();//rubros
        $marcas = ORM::factory('marcas')->find_all();//marcas
        $proveedores=ORM::factory('proveedores')->find_all();//proveedores
        $monedas=ORM::factory('monedas')->find_all();//monedas
        $presentaciones=ORM::factory('presentaciones')->find_all(); //presentaciones
        $unidades=  ORM::factory('unidades')->find_all(); //unidades
        $ubicaciones=ORM::factory('ubicaciones')->find_all(); //ubicaciones
        
        //$ko3['form']=html::image('assets/images/logo.jpg',array('title'=>'logo'));
        $this->template->title   = 'Articulos - add';
        View::set_global('x', 'This is a global variable');
        $ko3_inner['content']    = 'We have more data';
        $ko3['content']          = '';
        $ko3['ko3_inner']        = View::factory('blocks/ko3_inner', $ko3_inner)
                                 ->render();
        //$productos['producto']=  ORM::factory('productos')->find_all();
        //$ko3['content']=View::factory('proyectos/listar',$productos)->render();
        $this->template->header=View::factory('menu',$ko3_inner)->render();
        $this->template->content = View::factory('articulo/add',$ko3)
                                    ->set('rubros', $rubros)
                                    ->set('marcas', $marcas)
                                    ->set('proveedores',$proveedores)
                                    ->set('monedas',$monedas)
                                    ->set('presentaciones',$presentaciones)
                                    ->set('unidades',$unidades)
                                    ->set('ubicaciones',$ubicaciones);

    }
}
?>
