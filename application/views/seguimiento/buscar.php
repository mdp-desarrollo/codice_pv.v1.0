<script type="text/javascript">
    $(function(){
        $('#nur').focus(); 
    });
</script>
<style type="text/css">
    #nur{ line-height: 25px; font-size: 18px; height: 30px; font-weight: bold;   }
    #boton{ line-height: 25px;height: 35px;    }
</style>
<h2 class="subtitulo">Seguimiento <br/><span>INGRESE EL NUMERO DE NUR/NURI PARA VER EL SEGUIMIENTO</span></h2>
<!-- mostrar errores -->
<?php if(sizeof($errors)>0):?>
<div class="error">
    <p><span style="float: left; margin-right: .3em;" class=""></span>
    <?php foreach($errors as $k=>$v):?>
        <strong><?=$k?>: </strong> <?php echo $v;?></p>
    <?php endforeach;?>
</div>
<br/>
<?php endif;?>

<form action="/seguimiento/ver" method="post" >
<?php echo Form::input('nur', Arr::get($_POST,'nur',''), array('id'=>'nur'))?>
<?php echo Form::input('boton','Ver Seguimiento',array('type'=>'submit','id'=>'boton'));?>
</form>
        