<h2><?php echo $user->cargo;?></h2>
<hr class="azul"/>
<fieldset>
    <legend>Descripcion Usuario:</legend>
<table>
    <tr>
        <td><b>Usuario:</b></td>
        <td><?php echo Form::input('username',$user->username,array('size'=>50))?></td>
    </tr>
    <tr>
        <td><b>Nombre del Funcionario:</b></td>
        <td><?php echo Form::input('nombre',$user->nombre,array('size'=>50))?> Mosca: <?php echo Form::input('mosca',$user->mosca,array('size'=>6))?></td>
    </tr>
    <tr>
        <td><b>Genero:</b></td>
        <td><?php echo Form::select('genero', array('hombre'=>'hombre','mujer'=>'mujer'), $user->genero)?></td>
    </tr>
    <tr>
        <td><b>Email:</b></td>
        <td><?php echo Form::input('username',$user->email,array('size'=>50))?></td>
    </tr>
    <tr>
        <td><b>Oficina:</b></td>
        <td><?php 
        $options=array();
        foreach ($oficinas as $o){
            $options[$o->id]=$o->oficina;
        }
        echo Form::select('oficina',$options,$user->id_oficina)?></td>
    </tr>
</table>
</fieldset>
<br/>
<fieldset>
    <legend>Privilegios:</legend>
<table>    
    <tr>
        <td><b>Tipo de Usuario:</b></td>
        <td><?php 
        $options=array();
        foreach ($niveles as $n){
            $options[$n->id]=$n->nivel;
        }
        echo Form::select('nivel',$options,$user->nivel)?></td>
    </tr>    
    <tr>
        <td><b>Documentos <br/>que puede generar<br/> este cargo:</b></td>
        <td><?php 
        //todos los tipos que puede crear
        $arrTipos=array();
        foreach ($menus as $m){
            $arrTipos[$m->id_tipo]=$m->id_user;
        }
        //ahora recoremos todos los tipos de documentos 
        $options=array();
        foreach ($tipos as $t){            
            if(array_key_exists($t->id, $arrTipos)){                
                echo Form::checkbox($t->tipo, $t->id, TRUE);
            }
            else{
                echo Form::checkbox($t->tipo, $t->id, FALSE);
            }
            echo '<label>'.$t->tipo.'</label>';
            echo '<br/>';
        }
        ?>
        </td>
    </tr>

</table>    
</fieldset>

<?php ?>
