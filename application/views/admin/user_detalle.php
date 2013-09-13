<script type="text/javascript">
 $(function(){
     $('#addDes').click(function(){
        var id_user=$(this).attr('rel');
	var left=screen.availWidth;
	var top=screen.availHeight;
	left=(left-800)/2;
	top=(top-500)/2;
	var res=window.showModalDialog("/admin/content/destinos/"+id_user,"","center:0;dialogWidth:750px;dialogHeight:450px;scroll=yes;resizable=yes;status=yes;"+"dialogLeft:"+left+"px;dialogTop:"+top+"px");
        if(res!=null)
            {
                $("#destinatarios").addClass('loading');
                $.ajax({                    
	            type: "POST",
	            data: { destinos : res, id : id_user },
	            url: "/admin/ajax/addUser",
	           // dataType: "html",
	            success: function(data)
	            {                                                    
	             location.reload(true);              
	            }
                });                
            }        
        });
     $('#addDoc').click(function(){
        var id_user=$(this).attr('rel');
	var left=screen.availWidth;
	var top=screen.availHeight;
	left=(left-800)/2;
	top=(top-500)/2;
	var res=window.showModalDialog("/admin/content/documentos/"+id_user,"","center:0;dialogWidth:750px;dialogHeight:450px;scroll=yes;resizable=yes;status=yes;"+"dialogLeft:"+left+"px;dialogTop:"+top+"px");
        if(res!=null)
            {
                $("#documentos").addClass('loading');
                $.ajax({                    
	            type: "POST",
	            data: { documentos : res, id : id_user },
	            url: "/admin/ajax/addDoc",
	           // dataType: "html",
	            success: function(data)
	            {                                                    
	             location.reload(true);              
	            }
                });                
            }        
        });
     //quitar doc
     $('a.delDoc').click(function(){
         var tipo=$(this).attr('rel');
         if(confirm('Esta usted seguro de eliminar el tipo : '+tipo))
         {
             return true;
         }
         else{
             return false;
         }
         return false;
     });
     //quitar destinatario
     $('a.delDes').click(function()
     {
         var nombre=$(this).attr('rel');
         if(confirm("Esta usted seguro de quitar de la lista a: \n"+nombre)){
             return true;
         }
         else{             
             return false;
         }
         
     });
 });
</script>
    
<style type="text/css">
    label{color: #666; font-size: 12px; width: 140px;  float: left;   }
</style>
<h2 class="subtitulo"><?php echo $user->nombre;?><br/><span>DESCRIPCION DEL USUARIO</span></h2>
<div id="usuario">
    <p >
        <h2 style="text-align:center;"><?php echo $oficina->oficina;?></h2>
    </p>
    <hr/>
    <form action="/admin/user/update" method="post">
    <p>
        <input type="hidden" name="user_id" value="<?php echo $user->id;?>" />
        <?php
         $attributes['readonly'] = 'readonly';
         $attributes['size'] = 60;
        
        echo form::label('username');
        echo Form::input('username',$user->username,$attributes);
        ?>
    </p>
    <p>
        <?php
        echo form::label('nombre');
        echo Form::input('nombre',$user->nombre,array('size'=>60));
        echo Form::input('mosca',$user->mosca,array('size'=>5));
        ?>
    </p>
    <p>
        <?php
        echo Form::label('Cargo');
        echo Form::input('cargo',$user->cargo,array('size'=>60));
        ?>
    </p>    
    <p>
        <?php
        echo Form::label('Email:');
        echo Form::input('email',$user->email,array('size'=>60));
        ?>
    </p> 

<p>
        <?php
        echo Form::label('Categoria');
        echo Form::select('id_categoria', $pvcategoria,$user->id_categoria,array('id'=>'categoria'));
        ?>
    </p>

    <p>
        <?php
        echo Form::label('prioridad');
        echo Form::select('dependencia',array(0=>'Jefe',1=>'Dependiente'),$user->dependencia);
        ?>
    </p>    
    <hr/>
    <p>
        <?php        
        echo Form::submit('modificar','Modificar datos',array('class'=>'uibutton'));
        ?>
    </p>    
    </form>
</div>
<div id="documentos">
    <h2>Documentos Permitidos</h2>
    <hr/>
    <ul>
     <?php foreach ($documentos as $d):?>
        <li><a href="/admin/user/x_doc/?id_tipo=<?php echo $d->id;?>&id_user=<?php echo $user->id;?>" rel="<?php echo $d->tipo;?>" class="delDoc">[X]</a>
          <?php echo $d->tipo; ?>  
        </li>                   
     <?php endforeach; ?>   
    </ul>
    <hr/>
    <?php echo Form::input('addDoc','+ Adicionar',array('class'=>'uibutton','id'=>'addDoc','type'=>'button','rel'=>$user->id));?>
</div>
<div id="destinatarios">
    <h2>Destinatarios Permitidos</h2>
    <hr/>
    <ul>
     <?php foreach ($destinatarios as $d):?>
        <li><a href="/admin/user/x_des/?id_des=<?php echo $d->id;?>&id_user=<?php echo $user->id;?>" class="delDes" rel="<?php echo $d->nombre;?>" >[x]</a>
            <span><?php echo $d->nombre; ?></span> |   
          <?php echo $d->cargo; ?>  
        </li>                   
     <?php endforeach; ?>   
    </ul>
    <hr/>
    <br/>
    <?php echo Form::input('addDes','+ Adicionar',array('class'=>'uibutton','type'=>'button','id'=>'addDes','rel'=>$user->id));?>
    
</div>
<?php echo '';?>