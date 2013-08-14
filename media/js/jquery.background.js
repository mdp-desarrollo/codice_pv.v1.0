// JavaScript Document
    jQuery.fn.extend({  
           fijarTexto: function(texto,activeColor,disabledColor){  
                /*Recorre todos los elementos encapsulados*/  
                this.each(function(){  
                    /*Aquí se cambia el contexto, por lo que 'this' se refiere al elemento 
                    DOM por el que se está pasando*/  
                    var $this = jQuery(this); //Convertimos a jQuery  
                    /*Esto es para la primera vez*/  
                    $this.css("color",disabledColor).val(texto);  
                  /*Cuando recibe el foco, si está el texto por defecto, lo borra y cambia el color*/  
                  $this.focus(function(){  
                      if($this.val() == texto){  
                           $this.val("").css("color",activeColor);  
                       }  
                   });  
                   /*Cuando pierde el foco, si está vacío, pone el texto por defecto y cambia el color*/  
                   $this.blur(function(){  
                      if(jQuery.trim($this.val()).length==0){  
                          $this.css("color",disabledColor).val(texto);  
                      }  
                   });  
               });  
          }  
   });  