<script type="text/javascript">
			var Chart;
			// On document ready, call visualize on the datatable.
			$(document).ready(function() {			
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
	      //alert(options.series);
                    $("#imprime").click(function(){
            window.print();
            return false;
        });
			});
</script>

<h2 class="subtitulo">Pendientes por oficina<br/><span>Lista de pendientes por usuario</span>
<p style="float: right; margin-top: -15px;"><a href="javascript:void(0)" id="imprime" class="uibutton print" title="imprimir"><img src="/media/images/print.png" align="absmiddle" alt=""/>Imprimir</a></p>
</h2>
<div id="oficina" style="font-size: 16px; text-align: center;"><?php echo $oficina->oficina;?>
</div>

<div id="container" style="width:100%; height: 600px; margin: 0 auto;"></div>
<br/>
<table id="theTable">
    <thead>
        <tr>
            <th>Funcionario</th>            
            <th>Pendiente oficial</th>
            <th>Pendiente copia</th>
            <th>Archivado</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach ($pendientes as $p):?>
        <tr>            
            <td><?php echo $p['nombre']?>
            <br/><b><?php echo $p['cargo']?></b></td>
            <td><?php echo $p['oficial']?></td>            
            <td><?php echo $p['copia']?></td>            
            <td><?php echo $p['archivado']?></td>            
        </tr>
        <?php $i++; endforeach;?>
    </tbody>
</table>

