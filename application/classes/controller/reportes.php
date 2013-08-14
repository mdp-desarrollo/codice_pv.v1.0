<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_Reportes extends Controller_DefaultTemplate{
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
        $this->template->title='Reportes ';
        }
        else{
            $url= substr($_SERVER['REQUEST_URI'],1);
            $this->request->redirect('/login?url='.$url);
        }        
    }
    public function after() 
    {
        $this->template->menutop = View::factory('templates/menutop')->bind('menus',$this->menus)->set('controller', 'reportes');
        $oSM=New Model_menus();
        $submenus=$oSM->submenus('reportes');
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus',$submenus)->set('titulo','Menu de reportes');        
        parent::after();
    }      
    public function action_index()
    {
        $this->request->redirect('reportes/personal');
            $lista_reportes=ORM::factory('reportes')->where('dependencia','>=',$this->user->dependencia)->find_all();
            //$reportes=ORM::factory('reportes');
            $this->template->styles=array('media/css/tablas.css'=>'screen');
            $this->template->title     .= ' | Reportes'; 
            $this->template->content=View::factory('reportes/index') 
                                            ->bind('lista',$lista_reportes); 
    }
    //pendientes oficina
    public function action_pendientes_oficina()
    {
        if($this->user->dependencia==0)
        {
          //usuarios que pertences a mi oficina  
          $users=ORM::factory('users')->where('id_oficina','=',$this->user->id_oficina)->or_where('superior','=',$this->user->id)->find_all();
          $pendientes=array();
          foreach($users as $u)
          {
              $oficial=ORM::factory('seguimiento')->where('derivado_a','=',$u->id)->and_where('estado','=',2)->and_where('oficial','=',1)->count_all();
              $copia=ORM::factory('seguimiento')->where('derivado_a','=',$u->id)->and_where('estado','=',2)->and_where('oficial','=',0)->count_all();
              $archivado=ORM::factory('seguimiento')->where('derivado_a','=',$u->id)->and_where('estado','=',10)->count_all();
              $pendientes[]=array(                  
                  'nombre'=>$u->nombre,
                  'cargo'=>$u->cargo,
                  'id'=>$u->id,                  
                  'oficial'=>$oficial,
                  'copia'=>$copia,
                  'archivado'=>$archivado
              );
          }          
          $oficina=ORM::factory('oficinas',$this->user->id_oficina);
          $this->template->title.='| Pendientes Oficina';
          $this->template->scripts=array('media/Highcharts/js/highcharts.js',
                                         'media/Highcharts/js/modules/exporting.js');
          $this->template->styles=array('media/css/tablas.css'=>'screen');
          $this->template->content=View::factory('reportes/pendientes_oficina')
                                    ->bind('pendientes', $pendientes)
                                    ->bind('oficina', $oficina);
          //var_dump($pendientes);
        }               
    }
    
    public function action_entidad()
    {
        $oEntidad=ORM::factory('entidades')->find_all();
        $entidades=array();
        foreach($oEntidad as $e)
        {
            $entidades[$e->id]=$e->entidad;
        }
        $this->template->content=View::factory('reportes/form_entidades')
                        ->bind('entidades',$entidades);
    }
    //pendientes oficina
    public function action_general()
    {
        if($this->user->dependencia==0)
        {
          //usuarios que pertences a mi oficina  
          $oficina=ORM::factory('oficinas',$this->user->id_oficina);
          $entidad=ORM::factory('entidades',$oficina->id_entidad);
          $oficinas=ORM::factory('oficinas')->where('id_entidad','=',$oficina->id_entidad)->find_all();          
          $pendientes=array();
          foreach($oficinas as $u)
          {
              $oficial=ORM::factory('seguimiento')->where('id_a_oficina','=',$u->id)->and_where('estado','=',2)->and_where('oficial','=',1)->count_all();
              $copia=ORM::factory('seguimiento')->where('id_a_oficina','=',$u->id)->and_where('estado','=',2)->and_where('oficial','=',0)->count_all();
              $archivado=ORM::factory('seguimiento')->where('id_a_oficina','=',$u->id)->and_where('estado','=',10)->count_all();
              $pendientes[]=array(                  
                  'nombre'=>$u->oficina,
                  'cargo'=>$u->sigla,
                  'id'=>$u->id,                  
                  'oficial'=>$oficial,
                  'copia'=>$copia,
                  'archivado'=>$archivado
              );
          }          
          $this->template->scripts=array('media/Highcharts/js/highcharts.js',
                                         'media/Highcharts/js/modules/exporting.js');
          $this->template->styles=array('media/css/tablas.css'=>'screen');
          $this->template->content=View::factory('reportes/pendientes_oficinas')
                                    ->bind('pendientes', $pendientes)
                                    ->bind('entidad', $entidad)
                                    ->bind('oficina', $oficina);
          //var_dump($pendientes);
        }               
    }
    
    
    
    
    public function action_personalizado()
    {
        if(isset($_POST['submit']))
        {
            var_dump($_POST);
        }
        $o_oficinas=ORM::factory('oficinas')->find_all();
        $oficinas=array();
        foreach($o_oficinas as $e)
        {
            $oficinas[$e->id]=$e->oficina;
        }
        $o_estados=ORM::factory('estados')->find_all();
        $estados=array();
        foreach($o_estados as $e)
        {
            $estados[$e->id]=$e->estado;
        }
        $this->template->title.='| Reporte perzonalizado';
        $this->template->styles=array('media/css/jquery-ui-1.8.16.custom.css'=>'screen');
        $this->template->scripts=array('media/js/jquery-ui-1.8.16.custom.min.js');
        $this->template->content=View::factory('reportes/avanzado')
                                ->bind('estados',$estados)
                                ->bind('oficinas',$oficinas);
    }        
    public function action_recepcionada()
    {
        if(isset($_POST['submit']))
        {
            $fecha1=$_POST['fecha1'].' 00:00:00';
            $fecha2=$_POST['fecha2'].' 23:59:00';            
            if(strtotime($fecha1)>strtotime($fecha1))
            {   
                $fecha1=$_POST['fecha2'].' 23:59:00';
                $fecha2=$_POST['fecha1'].' 00:00:00';
            }
            $o_reporte=New Model_Reportes();            
            if($_POST['oficina']>0)
            {
                $oficina=ORM::factory('oficinas',$_POST['oficina']);
                $oficina=$oficina->oficina;
                $results=$o_reporte->recepcionado($_POST['oficina'],$this->user->id,$_POST['fecha1'].' 00:00:00',$_POST['fecha2'].' 23:00:00');
            }
            else
            {
                $oficina='Todas las oficinas';
                $results=$o_reporte->recepcionado_all($this->user->id,$_POST['fecha1'].' 00:00:00',$_POST['fecha2'].' 23:00:00');
            }
            $this->template->styles=array('media/css/tablas.css'=>'screen');
            $this->template->content=View::factory('reportes/vista')
                                        ->bind('results',$results)
                                        ->bind('oficina',$oficina)
                                        ->bind('fecha1',$fecha1)
                                        ->bind('fecha2',$fecha2);                       
        }
        else
        {
        $oficinas=$this->oficinas();
        $fecha_inicio=date('Y-m-d');
        $this->template->title.='| correspondencia recibida';
        $this->template->styles=array('media/css/jquery-ui-1.8.16.custom.css'=>'screen');
        $this->template->scripts=array('media/js/jquery-ui-1.8.16.custom.min.js');
        $this->template->content=View::factory('reportes/recepcionada')
                                ->bind('fecha_inicio',$fecha_inicio)
                                ->bind('oficinas',$oficinas);
        }
    }        
    public function action_enviada()
    {
        if(isset($_POST['submit']))
        {
            $fecha1=$_POST['fecha1'].' 00:00:00';
            $fecha2=$_POST['fecha2'].' 23:59:00';            
            if(strtotime($fecha1)>strtotime($fecha2))
            {   
                $fecha1=$_POST['fecha2'].' 23:59:00';
                $fecha2=$_POST['fecha1'].' 00:00:00';
            }
            $o_reporte=New Model_Reportes();            
            if($_POST['oficina']>0)
            {
                $oficina=ORM::factory('oficinas',$_POST['oficina']);
                $id_oficina=$oficina->id;
                $oficina=$oficina->oficina;                
                $results=$o_reporte->enviado($_POST['oficina'],$this->user->id,$fecha1,$fecha2);
            }
            else
            {
                $oficina='Todas las oficinas';
                $id_oficina=0;
                $results=$o_reporte->enviado_all($this->user->id,$fecha1,$fecha2);
            }
            $id_user=$this->user->id;
            $this->template->styles=array('media/css/tablas.css'=>'screen');
            $this->template->content=View::factory('reportes/vista2')
                                        ->bind('results',$results)
                                        ->bind('oficina',$oficina)
                                        ->bind('id_oficina',$id_oficina)
                                        ->bind('id_user',$id_user)
                                        ->bind('fecha1',$fecha1)
                                        ->bind('fecha2',$fecha2);                       
        }
        else
        {
        $oficinas=$this->oficinas();
        //$fecha_inicio=date('Y-m-d',$this->user->fecha_creacion);
        $fecha_inicio=date('Y-m-d');
        $this->template->title.='| Correspondencia enviada';
        $this->template->styles=array('media/css/jquery-ui-1.8.16.custom.css'=>'screen');
        $this->template->scripts=array('media/js/jquery-ui-1.8.16.custom.min.js');
        $this->template->content=View::factory('reportes/enviada')
                                ->bind('fecha_inicio',$fecha_inicio)
                                ->bind('oficinas',$oficinas);
        }
    }        
    public function action_personal()
    {
        if(isset($_POST['submit']))
        {            
            $fecha1=$_POST['fecha1'].' 00:00:00';
            $fecha2=$_POST['fecha2'].' 23:59:00';            
            if(strtotime($fecha1)>strtotime($fecha2))
            {   
                $fecha1=$_POST['fecha2'].' 23:59:00';
                $fecha2=$_POST['fecha1'].' 00:00:00';
            }
             $o_reporte=New Model_Reportes();            
             $oficina=ORM::factory('oficinas',$_POST['oficina']);
             $id_oficina=$oficina->id;
             $oficina=$oficina->oficina;             
             $id_estado=$_POST['estado'];
             $estado=ORM::factory('estados',$id_estado);
             $results=$o_reporte->personal($_POST['oficina'],$_POST['estado'],$fecha1,$fecha2);            
             $this->template->styles=array('media/css/tablas.css'=>'screen');
             $this->template->content=View::factory('reportes/vista3')
                                        ->bind('results',$results)
                                        ->bind('oficina',$oficina)
                                        ->bind('id_oficina',$id_oficina)
                                        ->bind('estado',$estado)
                                        ->bind('fecha1',$fecha1)
                                        ->bind('fecha2',$fecha2);   
        }
        else
        {
        $oficinas=array();
        $oficina=ORM::factory('oficinas',$this->user->id_oficina);
        $oficinas[$oficina->id]=$oficina->oficina;
        $o_oficinas=ORM::factory('oficinas')->where('padre','=',$this->user->id_oficina)->find_all();
        
        foreach($o_oficinas as $e)
        {
            $oficinas[$e->id]=$e->oficina;
        }
        
        $o_estados=ORM::factory('estados')->find_all();
        $estados=array();
        foreach($o_estados as $e)
        {
            $estados[$e->id]=$e->estado;
        }
        $this->template->title.='| Reporte perzonalizado';
        $this->template->styles=array('media/css/jquery-ui-1.8.16.custom.css'=>'screen');
        $this->template->scripts=array('media/js/jquery-ui-1.8.16.custom.min.js');
        $this->template->content=View::factory('reportes/avanzado')
                                ->bind('estados',$estados)
                                ->bind('oficinas',$oficinas);
        }
    }                  
    //options oficinas 
    public function oficinas()
    {
        $o_oficinas=ORM::factory('oficinas')->find_all();
        $oficinas=array(0=>'Todos');
        foreach($o_oficinas as $e)
        {
            $oficinas[$e->id]=$e->oficina;            
        }
        return $oficinas;
    }    
    
}
?>
