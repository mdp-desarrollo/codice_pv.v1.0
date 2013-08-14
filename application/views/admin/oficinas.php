<script>
$(function(){
    $('#id_entidad').change(function(){
        var id=$(this).val();
        location.href='/admin/oficinas/lista/'+id;
    });
});
</script>
<h2 class="subtitulo"><?php echo $entidad; ?><br/><span>LISTA DE OFICINAS</span></h2>
<?php echo Form::select('id_entidad', $options,$id_entidad,array('id'=>'id_entidad'));?>
<div style="float: right;"><a class="uibutton" href="/admin/oficinas/create/<?php echo $id_entidad;?>">+ Nueva Oficina</a></div>
<br/>
<br/>
<table id="theTable">
    <thead>
        <tr>
            <th>
                ID
            </th>
            <th>
                OFICINA
            </th>
            <th>
                OPCIONES
            </th>
        </tr>
    </thead>
    <tbody> 
    <?php foreach($oficinas as $o):?>
        <tr>
            <td>
                <?php echo $o->id;?>
            </td>
            <td>
                <a href="/admin/user/lista/<?php echo $o->id;?>"><?php echo $o->oficina;?></a>
            </td>
            <td>
                <a href="/admin/user/lista/<?php echo $o->id;?>"><img src="/media/images/16x16/Write.png" /></a>
            </td>
        </tr>
    <?php endforeach;?>        
    </tbody>
</table>
