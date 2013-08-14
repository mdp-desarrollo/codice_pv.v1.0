<script type="text/javascript">
    $(function(){
        $('#imprimir,#aprint').click(function(){
            var hs=$('#hr').val().replace(/^\s+|\s+$/g, "");;            
            if(hs=="")
            {
                alert('Escriba la hoja de ruta por favor');
                return false;
            }
            else
            {    
            $.ajax({
	            type: "POST",
	            data: { nur : hs },
	            url: "/ajax/print_hs",
	            dataType: "json",
	            success: function(data)
	            {                    
                        if(data.id_nur>0)
                        {
                             window.location.href='/print_hr.php?id='+data.id_nur;
                            
                        }    
                        else
                        {
                            alert('La hoja de ruta '+hs+' no existe');
                        }                        
	            }
                    });                
            }                          
        });
        $('#hr').focus();
   }); 
</script>
<h2 class="subtitulo">Imprimir hoja de ruta<br/><span>a continuaci&oacute;n escriba la hoja de ruta y presione imprimir</span></h2>
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
<form action="" method="post" >
<?php echo Form::input('nur', Arr::get($_POST,'nur',''), array('id'=>'nur'))?>
<?php echo Form::input('boton','Imprimir hoja de ruta',array('type'=>'submit','id'=>'boton'));?>
</form>