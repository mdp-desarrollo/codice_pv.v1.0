$(document).ready(function(){
    /*
     * VARIABLES GLOBALES
    */
    //status de panel lateral: 1 ON (default), 0 OFF
    var status = 1;
    //selectores
    var toggler = $("#toggler");
    var lateral = $("#lateral");
    var content = $("#content");
    var lateralWidth = lateral.width() + "px";
    //dimensiones disponibles para elementos del panel
    var windowHeight = 0;
    var renderHeight = 0;
    var togglerHeight = 0;
    var windowWidth=0;
    /*
     * AL CARGAR EL DOCUMENTO
    */
    calculateDimensions();
    applyDimensions();
    /*
     * AL CAMBIAR DE TAMA�O LA VENTANA DEL NAVEGADOR
    */
    $(window).resize(function()
    {
        calculateDimensions();
        applyDimensions();
    });
    /*
     * AL HACER CLICK EN TOGGLER (PANEL LATERAL)
    */
    toggler.click(clickToggler);
    /*
     * FUNCIONES DE CONTROL DE ELEMENTOS DE INTERFAZ
    */
    // calculo de dimensiones disponibles
    function calculateDimensions()
    {
        windowWidth = document.documentElement.clientWidth; //alto disponible en ventana del explorador        
        windowWidth=(windowWidth - 165)  +"px";        
        windowHeight = document.documentElement.clientHeight; //alto disponible en ventana del explorador
        renderHeight = (windowHeight - 89 )  +"px";
        togglerHeight = (windowHeight - 89)  +"px";
        /* �De donde salen esos valores a restar? Pues de:
         * 51: #top: 40px de height, 10px de padding-top, y 1px de border-bottom
         * 40: #content h2: 40px de height
         * 31: #footer: 30px de height y 1px de border-top
        */
    }
    // aplicado de dimensiones disponibles
    function applyDimensions(){        
        content.css("height", renderHeight);
        content.css("width", windowWidth);
        toggler.css("height", togglerHeight);
    }
    // control de elemento lateral (toggler)
    function clickToggler()
    {        
        windowWidth = document.documentElement.clientWidth; //alto disponible en ventana del explorador        
        //ocultamos panel si esta mostrandose
        if(status ==1){
            lateral.hide();
            content.css("margin-left","0px");
            toggler.addClass("off");
            windowWidth=(windowWidth - 1)  +"px";
            status = 0;
        }
        //mostramos panel si esta oculto
        else{
            lateral.show();
            content.css("margin-left", lateralWidth);
            toggler.removeClass("off");
            windowWidth=(windowWidth - 165)  +"px";
            status = 1;
        }                
        content.css("width", windowWidth);        
    }
 
});