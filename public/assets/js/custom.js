jQuery(document).ready(function($) {

	$('#custompagination').children('ul').addClass('custom-pagination');

	$('.flexslider').flexslider({
	    animation: "slide"
  	});

  	// ======= Scroll To Top Button (GoUp)===============//
	jQuery.goup({
	  containerColor: '#323232',
	  containerRadius: 0,
	  hideUnderWidth: 320,
	});

	//====== подсветка с кнопкой v.1 ========

	hljs.initHighlightingOnLoad();


	$('pre code').each(function(i, block) {
		hljs.addCopyButton(block);
	});


	// ==== FancyBox 3, Options for the "images" group
	$('[data-fancybox="images"]').fancybox({
		loop : true	
	});

});
