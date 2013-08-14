<div id="pendientes">
    <h1>Documentos Pendientes</h1>
<?php foreach ($results as $p):?>    
    <table class="pendientes">
        <thead>
            <tr>
                <th>NUR</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="2"><?php echo $p['codigo']?></td><td></td><td></td>
            </tr>
            <tr>
                <td><?php echo $p['autor']?></td><td><?php echo $p['referencia']?></td><td><?php echo $p['documento']?></td><td><?php echo $p['fecha']?></td><td></td>
            </tr>
        </tbody>
    </table>
<?php endforeach;?>    
</div>
<?php echo $items; ?>
<?php echo $page_links; ?>

