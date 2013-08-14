<?php
defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_ajax extends Controller {  
    // modificado por freddy
    public function action_addUser()
    {
        $id_user=$_POST['id'];        
        $destinos=explode(';',$_POST['destinos']);
        foreach($destinos as $k=>$v)
        {
            if($v!='')
            {
                $destino=ORM::factory('vias');
                $destino->id_usuario=$id_user;
                $destino->id_destinatario=$v;
                $destino->id_via=0;
                $destino->save();
            }
        }
    }
    
//    public function action_addUser()
//    {
//        $id_user=$_POST['id'];        
//        $destinos=explode(';',$_POST['destinos']);
//        foreach($destinos as $k=>$v)
//        {
//            if($v!='')
//            {
//                $destino=ORM::factory('destinatarios');
//                $destino->id_usuario=$id_user;
//                $destino->id_destino=$v;
//                $destino->save();
//            }
//        }
///*         $result='';
//         $o_destinos=New Model_Destinatarios();
//         $destinatarios=$o_destinos->destinos($id_user);
//         foreach($destinatarios as $d)
//         {
//             echo '<li> '.HTML::anchor('/admin/user/x_des/?id_user='.$id_user.'&id_destino='.$d->id,'[x]',array('class'=>'delDes')).' <span>'.$d->nombre.'</span> | '.$d->cargo. '</li>'; 
//         }      
//
// */
//    }
    
    
    
    public function action_addDoc()
    {
        $id_user=$_POST['id'];        
        $documentos=explode(';',$_POST['documentos']);
        foreach($documentos as $k=>$v)
        {
            if($v!='')
            {
                $user=ORM::factory('users',$id_user);
                $user->add('tipo',$v);                
                $user->save();
            }
        }
    }
}
?>
