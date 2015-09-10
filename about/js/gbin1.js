$(function(){



	$('#webcam').photobooth().on("image",function( event, dataUrl ){	
		$('.nopic').hide();
		$( "#pictures" ).append( '<img src="' + dataUrl + '" >');
	});
	
	if(!$('#webcam').data('photobooth').isSupported){
		alert('HTML5 webcam is not supported by your browser, please use latest firefox, opera or chrome!');
	}	
	
});