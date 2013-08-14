<?php
$auth=  Auth::instance();
$usuario=ORM::factory('users');
$usuario->where('id','=',$auth->get_user())->find();
echo 'bienvenido !!! ';
echo $usuario->nombre;
$encryt=Encrypt::instance();
echo $data= $encryt->encode('mocosoftx');
echo $encryt->decode($data);
//ip del cliente
echo Request::$client_ip;
foreach ($results as $u) {
    echo $u['observaciones'];
    echo '<br/>';
  //  echo $u['f_derivacion'];
    
}
echo $page_links;
?>
