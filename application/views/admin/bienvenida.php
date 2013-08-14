<?php   
$auth=  Auth::instance();
$usuario=ORM::factory('users');
$usuario->where('id','=',$auth->get_user())->find();
echo 'bienvenido !!! ';
echo $usuario->username;
//echo $pass;    
?>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
asdaskldjklasjdklas
<br/>
<br/>
asdasdjklaskldjklasjld
<br/>
<br/>
<br/>
<br/>
<br/>