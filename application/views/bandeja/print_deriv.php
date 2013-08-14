
<style type="text/css">
    table.tabla{border: 1px solid; width: 100%}
    .tabla td, .tabla th{border: 1px solid; padding:5px;}
    .tabla th{font-size: 12px; font-weight: bold; }
    div.preview{ border: 1px solid #1B5B97; display:block; width: 200px; padding: 5px; margin:5px  auto; clear: both; position: relative; }
    div.preview .print{  text-align:center; cursor: pointer;  border: 1px solid #111; display:block; width: 180px; height: 20px; padding: 5px; margin:5px; clear: both; position: relative; }
    div.preview .print:hover{ background: #efefef; }
    div.preview .selected{ background: #2B6EAD; color: #fff; border: 1px solid;}
</style>
<h2 class="subtitulo">Imprimir derivaci&oacute;n<br/><span>Imprimir correspondencia enviada</span></h2>
<div>
    <table class="tabla">
        <thead>
            <tr>
            <th>
                
            </th>
            <th>
                DOCUMENTO ORIGINAL
            </th>
            <th>
                PROVEIDO
            </th>
            <th>
                DERIVADO A
            </th>
            <th>
                FECHA Y HORA
            </th>
        </tr>
        </thead>
        <tbody>
            <?php $id=''; 
            foreach($derivado as $d):?>
            <tr>
                <td>
                    <?php echo $d['nur'];?>
                </td>
                <td>
                    <?php echo $d['codigo'];?>
                </td>
                <td>
                    <?php echo $d['proveido'];?>
                </td>
                <td>
                    <?php echo $d['a_oficina'];?><br/>
                    <?php echo $d['nombre_receptor'];?><br/>
                    <?php echo $d['cargo_receptor'];?>
                </td>
                <td>
                    <?php echo $d['fecha_emision']; $id=$d['id']?>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<br/>
<div class="preview">
    <?php for($i=0;$i<6;$i++):?>
    <a class="print" href="/print_deriv.php?id=<?php echo $id;?>&p=<?php echo $i;?>" target="_blank" >
        <?php  echo $i+1;?>
    </a>
    <?php endfor;?>
</div>

