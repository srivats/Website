/* Author:

*/

$(document).ready(function ($) {
    $('#services-tabs a[href="#website-design"]').tab('show');    

    $('.image-carousel').carousel({
  		interval: 2000
	});
	$('.testimonials-carousel').carousel({
  		interval: 2000
	});
	$(".single-post a:has(img)").fancybox();
	

});
hljs.initHighlightingOnLoad();