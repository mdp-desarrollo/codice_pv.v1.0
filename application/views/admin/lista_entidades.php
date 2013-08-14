<h2 class="subtitulo">Entidades<br/><span>LISTA DE ENTIDADES</span></h2>
<a href="/admin/entidades/add" class="uibutton">+ Nueva Entidad</a>
<br/>
<br/>
<table id="theTable">
    <thead>
        <tr>
            <th>
                id
            </th>
            <th>
                Sigla
            </th>
            <th>
                entidad
            </th>
            <th>
                estado
            </th>
            <th>
                opciones
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($entidades as $e): ?>
        <tr>
            <td>
               <?php echo $e->id;?> 
            </td>
            <td>
               <a href="/admin/oficinas/lista/<?php echo $e->id;?>"><?php echo $e->sigla;?></a> 
            </td>
            <td>
               <a href="/admin/oficinas/lista/<?php echo $e->id;?>"><?php echo $e->entidad;?></a> 
            </td>
            <td>
               <?php
                    $checked=TRUE;
                    if($e->estado==0)
                          $checked=FALSE;
                    echo Form::checkbox('estado', $e->estado, $checked);
                ?> 
            </td>
            <td>
                <a href="/admin/oficinas/edit/<?php echo $e->id;?>">Edit</a>               
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php ?>
