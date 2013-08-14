<?php
defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_content extends Controller_Minitemplate {    
    public function action_destinos($id='')
    {
        $o_destinatarios=New Model_Destinatarios();
        $destinos=$o_destinatarios->destinos_nuevos($id);        
        $this->template->content = View::factory('admin/lista_destinos')
                                    ->bind('destinos', $destinos);                 
    }
    //lista de documentos a adicionar
    public function action_documentos($id='')
    {
        $o_destinatarios=New Model_Documentos();
        $documentos=$o_destinatarios->documentos_nuevos($id);        
        $this->template->content = View::factory('admin/lista_documentos')
                                    ->bind('documentos', $documentos);                 
    }
    public function action_lista($id='')
    {
        $entidad=ORM::factory('entidades',array('id'=>$id));
        if($entidad->loaded())
        {
            $oficinas=$entidad->oficinas->find_all();
            $this->template->content=View::factory('/admin/oficinas')
                                    ->bind('oficinas', $oficinas);
        }
        else
        {
            $this->template->content='Error: No se encontro la entidad';
        }
        
    }
    public function action_addUser()
    {
        var_dump($_POST);
    }
 
}
?>
