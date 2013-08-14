<h2 class="subtitulo">Detalle<br/><span>correspondencia agrupada</span></h2>
</hr>
<a href="/print_agrupado.php?nur=<?php echo $padre->nur;?>" class="uiButton" style="float: right;" target='_blank'><img src="/media/images/print.png" alt=""/>Imprimir</a>
<br/>
<h2 style="border-bottom: 1px dotted #999; padding-bottom: 4px;  " >Principal</h2>
<table id="theTable">
        <tr>
            <td>
               <a href="/seguimiento/?nur=<?php echo $padre->nur;?>"><?php echo $padre->nur;?></a>
            </td>
            <td>
                <?php echo $padre->codigo;?>
            </td>
             <td>
                <?php echo $padre->nombre_destinatario;?>
                <br/>
                <b><?php echo $padre->cargo_destinatario;?></b>
            </td>
            <td>
                <?php echo $padre->referencia;?>
            </td>           
        </tr>
</table>
<br/>
<br/>
<h2 style="border-bottom: 1px dotted #999; padding-bottom: 4px;  " >Agrupados</h2>
<table id="theTable">
<?php foreach($hijos as $h):?>
    <tr>
        <td>
            <a href="/seguimiento/?nur=<?php echo $h['nur'];?>"><?php echo $h['nur'];?></a>                        
        </td>
        <td>
            <?php echo $h['documento'];?>
        </td>
        <td>
            <?php echo $h['destinatario'];?>
            <br/><b><?php echo $h['cargo'];?></b>
        </td>
        <td>
            <?php echo $h['referencia'];?>
        </td>       
    </tr>
<?php endforeach;?>
</table>    
<?php // print_r($hijos); ?>
<div class="info" style="text-align:center;">
    <p><span style="float: left; margin-right: .3em;" class=""></span>    
      &larr;<a onclick="javascript:history.back(); return false;" href="#" style="font-weight: bold; text-decoration: underline;  " > Regresar<a/></p>    
</div>