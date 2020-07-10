(function(w){

document.addEventListener('plusready',function(){
	console.log("Immersed-UserAgent: "+navigator.userAgent);
},false);

var immersed = 0;
var ms=(/Html5Plus\/.+\s\(.*(Immersed\/(\d+\.?\d*).*)\)/gi).exec(navigator.userAgent);
if(ms&&ms.length>=3){
	immersed=parseFloat(ms[2]);
}
w.immersed=immersed;


if(!immersed){
	return;
}

	$('.head').css('padding-top',immersed+'px');
	$('.public_back').css('padding-top',immersed+'px');
	$('.head_copy').css('padding-top',immersed+'px');
	$('.logodiv').css('padding-top',immersed+'px');
	$('.findmimatitle').css('padding-top',immersed+'px');
//alert(immersed);


})(window);