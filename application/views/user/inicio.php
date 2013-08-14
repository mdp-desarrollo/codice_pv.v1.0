<script type="text/javascript">
    $(function(){
        var id=$('#user').val();
        if(id>0)
        {        
        $.ajax({
	            type: "POST",
	            data: { user : id },
	            url: "/ajax/pendientes",
	            dataType: "json",
	            success: function(data)
	            {                           
                        if(data)
                         {
                          $.each(data,function(i,item){
                               $('ul#pendientes').append('<li><a class="pendiente" href="/bandeja/pendientes/?id='+item.id+'" >'+item.nombre+'<br/><b>'+item.cargo+'</b><br/> Pendientes : <b>'+item.pendientes +'</b></a></li>');
//                               alert(item.nombre);                                                              
                          });    
                              
                         }
                         else
                         {
                            
                         }
	           },
                   error:function(){ }
          });
        }
//grafico
var Chart;		
				var options={
					chart: {
						renderTo: 'container',
						defaultSeriesType: 'column'
					},
					title: {
						text: 'Pendientes y archivados por Oficina'
					},
					subtitle: {
						text: ''
					},
					xAxis: {
                                            categories: [					
						],
                                                labels: {
                                            rotation: -45,
                                            align: 'right',
                                            style: {
                                                    font: 'normal 10px Verdana'
                                                    }
                                                }						
					},
					yAxis: {
						min: 0,
						title: {
							text: 'Unidades'
						}
					},
                                        credits:{
                                            enabled:false
                                        },
					tooltip: {
						formatter: function() {
							return ''+
								this.series.name +': '+ this.y;
						}
					},
					plotOptions: {
						column: {
							pointPadding: 0.2,
							borderWidth: 0
						}
					},
   // Respecto a la gráfica anterior la única diferencia es que ponemos mas valores por categoría.
				        series: []
				}                                 

                jQuery.getJSON('/ajax/pOficina', null, function(data) {
                //alert(data.copias);
                           // $.each(data, function(i,item){
                            options.series.push( {
                            name: 'Pendientes oficiales',
                            data: data.oficiales
                                });
                            options.series.push( {
                            name: 'Copias Pendientes',
                            data: data.copias
                                });
                            options.series.push( {
                            name: 'Archivados',
                            data: data.archivados
                                });
                            
                            options.xAxis.categories=data.names;
                            //	options.subtitle.text=item.title;
                            chart = new Highcharts.Chart(options);
                            });	      	      
        
        
    });
</script>

<div class="user">
    <h2 class="subtitulo">    
    <?php echo $user->nombre;?>
    <br/><span><?php echo $user->cargo;?> </span></h2>
    <br/>
</div>
<div style="float: left; width: 23%; padding: 10px; line-height: 20px;  border-right: 1px solid #ccc;  display: block;  ">
    <h1 style="font-size:24px; color:#78CA00; border-bottom: 3px solid #78CA00; ">Bandeja</h1>
<ul class="items">
    <?php foreach($estados as $k=>$v): ?>
    <li >
        <a href="/bandeja/<?php echo $v['accion'];?>" class="item<?php echo $k;?>"><?php echo $v['titulo'];?>
        <br/><span> Usted tiene <b> <?php echo $v['cantidad'] ?></b>
         <?php
        if($v['cantidad']>1)
        {
            echo $v['plural'];
        }
        else
        {
            echo $v['singular'];
        }
        ?> 
        </span>
        </a>                      
    </li>
<?php endforeach;?>
<ul>
</div>    
<div style="padding: 10px; width: 22%; float: left; line-height: 20px;  border-right: 1px solid #ccc; display: block;    ">
<h1 style="font-size:24px; color:#126B91; border-bottom: 3px solid #126B91; ">Documentos</h1>
<ul class="item_docs">
<?php foreach($tipos as $k=>$v):?>
    <li >
     <a href="/documento/tipo/<?php echo $v['id_tipo'];?>" >
     <?php echo $v['plural']; ?>
     <br/><span>
     <b><?php echo $v['cantidad']; ?></b> Documentos
     </span>
     </a>
    </li>
  <?php endforeach;?>
    <ul>
</div>

<div style="padding: 10px; width: 30%; float: left; line-height: 20px; display: block;  border-right: 1px solid #ccc;   ">
<h1 style="font-size:24px; color:#503374; border-bottom: 3px solid #503374; ">Estadisticas</h1>
    <div id="container" style="width:100%; height: 350px; margin: 0 auto;"></div>    
</div>
<div style="padding: 10px; width: 17%; float: left; line-height: 20px; display: block;   ">
<h1 style="font-size:24px; color:#AD521C; border-bottom: 3px solid #AD521C; ">Usuario</h1>
<ul class="items_data">
    <li >
        <a class="itemc" href="/user/changePass">Cambiar Contrase&ntilde;a<br/><span>Cambia su contrase&ntilde;a.</span></a>
    </li>
    <li >
     <a class="itemd" href="/user/changeData">Cambiar datos<br/>
     <span>
         Cambie su nombre, cargo o email.
     </span>
     </a>
    </li>
</ul>    
</div>


<div style="display: block; width: 100%; clear: both; "></div>
<?php if($user->dependencia==0):?>    
<input type="hidden" value="<?php echo $user->id;?>" id="user" />
<h1 style="font-size:24px; color:#272E41; padding-bottom: 5px;  border-bottom: 3px solid #272E41; ">Usuarios Dependientes</h1>

<div >
    <ul id="pendientes">
        
    </ul>
</div>
<?php else:?>
<input type="hidden" value="0" id="user" />
<?php endif;?>