    var tipo=0;
    var id_nuri;    
    var doc=0;
    var id_seg;
 $(function(){
     $('.archivo').click(function(){
         id_nuri=$(this).attr('id_nuri');
         var nuri=$(this).attr('nuri');
         $("#dialog-archivo").dialog({'title':'Archivar '+nuri, autoOpen: true});
     });    
     $('.responder').click(function(){
         id_nuri=$(this).attr('id_nuri');
         id_seg=$(this).attr('id_seg');
         var nuri=$(this).attr('nuri');
         $("#dialog-documento").dialog({'title':'Responder al nuri: '+nuri, autoOpen: true});
     });    
     $('#new').toggle(function(){
         $('#sfolder').css({'display':'none'});
         $('#nuevo').css({'display':'block'});
         $(this).text('Seleccionar');
         tipo=1;
     },
     function(){
         $('#sfolder').css({'display':'block'});
         $('#nuevo').css({'display':'none'});
         $(this).text('Nueva Carpeta');
         tipo=0;
     });
    $("#dialog-archivo").dialog({
			autoOpen: false,
			height: 150,
			width: 450,
			modal: true,
			buttons: {
                        'Archivar': function() {
                            var nueva_carpeta=$('#nueva').val();
                            if(tipo==1){                                
                                    if(nueva_carpeta.replace(/^\s+/g,'').replace(/\s+$/g,'')!=''){                                        
                                        alert('as');
                                    }
                                    else{
                                        alert('Esciba un nombre por favor.');
                                    }                                
                            }
                            else{
                                var carpeta=$('#archivos').val();                                
                                $.ajax({
                                    type: "POST",
                                    data: { carpeta : carpeta, id_nuri : id_nuri  },
                                    url: "/paperwork/ajax/archivar",
                                    dataType: "json",
                                    success: function(data)
                                    {                        
                                        $.each(data, function(x,item){
                                            alert(item);
                          
                                        });
                                    }
                                });
                            }
				},
				'Cancelar': function() {
					$(this).dialog('close');
				}
			}
			                       
	});
    $("#dialog-documento").dialog({
			autoOpen: false,
			height: 150,
			width: 450,
			modal: true,
			buttons: {
                        'Generar Respuesta': function() {                                
                            	//$(this).dialog('close');    
                                doc=$('#documento').val();                                
                                location.href="/hojaruta/respuesta/?id="+id_nuri+"&d="+doc+"&s="+id_seg;        
				},
				'Cancelar': function() {
					$(this).dialog('close');
				}
			}
			                       
	});
  });