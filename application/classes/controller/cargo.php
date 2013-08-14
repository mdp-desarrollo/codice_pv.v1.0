<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_cargo extends Controller_DefaultTemplate{
    public $lista='';
    public function action_index(){
        $auth =  Auth::instance();
        //si el usuario esta logeado entocnes mostramos el menu
        if($auth->logged_in()){
            //cartas generadas
            $oData=New Model_data();
            $documentos=$oData->documentos_agrupados($auth->get_user());
            $this->template->title   = 'Documentos Generados';
            $this->template->content = View::factory('documentos/index')
                                        ->bind('documentos',$documentos);
        }                        
    }
    //action para adicionar una nueva oficina
   public function action_add()
    {
       $auth =Auth::instance();
       if($auth->logged_in()){
           $user=ORM::factory('users',$auth->get_user());
            if($user->nivel==3) //nivel 3 administrador del sistema
            {
                 $oficinas=ORM::factory('oficinas')->find_all();
                 $options=array(''=>'Seleccione oficina...');
                 foreach ($oficinas as $o){
                     $options[$o->id]=$o->nombre;
                 }
                 //options cargos
                 $opCargos='';
                 $cargos=ORM::factory('cargos')->find_all();
                 foreach ($cargos as $c){
                     $opCargos.='<option value="'.$c->id.'" class="'.$c->oficina.'">'.$c->cargo.'</options>';
                 }
                 $this->template->content=View::factory('user/create')
                                          ->bind('options', $options)
                                          ->bind('opCargos', $opCargos)
                                          ->bind('message', $message);
              if ($_POST)
                {
                try {                   
                    // Create the user using form values
                    $cargo = ORM::factory('cargos');
                    $cargo->superior=$_POST['superior'];
                    $cargo->cargo=trim($_POST['cargo']);
                    $cargo->oficina=$_POST['oficina'];
                    $cargo->save();
                    $_POST = array();
                    // Set success message
                    $message = "Tu registraste a '{$cargo->cargo}' como nueva oficina";
                    } catch (ORM_Validation_Exception $e) {
                    // Set failure message
                    $message = 'There were errors, please see form below.';
                    // Set errors using custom messages
                    $errors = $e->errors('models');
                     }
                } //fin if POST
            }
            else
             {
             $this->template->content=View::factory('errors/user');
             }  
       }
   }
   public function action_lista(){
       $auth =Auth::instance();
       if($auth->logged_in()){
            $this->lista='<ul>';
           // echo '<ul>';
            $this->listar(1,'Despacho Ministerial');
         //   echo '</ul>';
            $this->lista.='</ul>';
            $config=  ORM::factory('configuracion',1);
            $this->template->content   = View::factory('oficina/lista')
                                        ->bind('lista', $this->lista)
                                        ->bind('config', $config);
       }
   }
   
   public function listar($id,$oficina){
       $h=ORM::factory('oficinas')->where('padre','=',$id)->count_all();              
       //echo '<li>'.$oficina;
        $this->lista.='<li class="oficina">'.HTML::anchor('oficinas/list/'.$id,$oficina);
       if($h>0){
       //echo '<ul>';
       $this->lista.='<ul>';
       $hijos=ORM::factory('oficinas')->where('padre','=',$id)->find_all();
        foreach($hijos as $hijo){
                  $oficina=$hijo->nombre;
                  $this->listar($hijo->id,$oficina);
         }
         $this->lista.='</ul>';
       // echo '</ul>';
       }
        else{
            $this->lista.='</li>';
         //   echo '</li>';
        }
   }
   public function action_list($id=''){
        $auth=Auth::instance();
        if($auth->logged_in()){
            $oficina=  ORM::factory('oficinas',$id);
            $oData=new Model_data();
            $usuarios=$oData->usuarios($id);
            //$usuarios=ORM::factory('users')->where('id_oficina','=',$id)->find_all();
            $this->template->content=View::factory('user/list')->bind('usuarios', $usuarios)
                ->bind('oficina', $oficina);
        }
    }
}
?>
