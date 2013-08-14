$(function(){
$.fn.printArea = function(options)
{
defaults={ area: 'body' };
var options = $.extend(defaults, options);
return this.each(function(){
	$(this).bind('click', init);
});
function init(ev){
	ev.preventDefault();
	var iframe=document.createElement('IFRAME');
	var doc=null;
	$(iframe).attr('style','position:absolute;width:0px;height:0px;left:-500px;top:-500px;');
	document.body.appendChild(iframe);
	doc=iframe.contentWindow.document;
	var links=window.document.getElementsByTagName('link');
	for(var i=0;i<links.length;i++)
		if(links[i].rel.toLowerCase()=='stylesheet')
		doc.write('<link type="text/css" rel="stylesheet" href="'+links[i].href+'"></link>');
		doc.write('<div class="'+$(options.area).attr("class")+'">'+$(options.area).html()+'</div>');
		doc.close();
		iframe.contentWindow.focus();
		iframe.contentWindow.print();
		doc.write("");
		document.body.removeChild(iframe);
}
}
})(jquery);