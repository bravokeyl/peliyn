(function($){
	"use strict";
	$('.menu-item-type-custom a').smoothScroll();
	$('.wheelscroll').smoothScroll();
	$('.scroll-icon').smoothScroll();
	
	$('.menu-item-type-custom a').each(function(){
		var link = $(this).attr('href').split('#')[1];
		var li = $(this).attr("data-target",'#'+link);
	})
	$('.intro-slider').owlCarousel({
				paginationSpeed: 600,
				pagination: false,
				navigation: false,
				singleItem: true,
				slideSpeed: 600,
				autoPlay: 3000
	});
	$('.heightfull').height($(window).height());

	$(window).resize(function(){
		$('.heightfull').height($(window).height());
	});
	var service_item = $('.iconbox');

	service_item.mouseenter(function(){
		if (!(service_item.hasClass('service-opened'))) {
			$(this).addClass('js-hovered');
			service_item.filter(':not(.js-hovered)').addClass('js-fade');
		}
	});

	service_item.mouseleave(function(){
		if (!(service_item.hasClass('service-opened'))) {
			$(this).removeClass('js-hovered');
			service_item.removeClass('js-fade');
		}
	});

	$('body').scrollspy({
		target: '.navbar-custom',
		offset: 80
	});
	$('.testimonials-slider').owlCarousel({
			paginationSpeed: 600,
			pagination: true,
			navigation: false,
			singleItem: true,
			slideSpeed: 300,
			autoPlay: 5000
	});
	var parent = $("li").hasClass('menu-item-has-children');
	if(true == parent ) {
		$
	}
	$(document).ready(function() {
		$(window).scroll(function() {
				if ($(this).scrollTop() > 100) {
					$('.scroll-up').fadeIn();
				} else {
					$('.scroll-up').fadeOut();
				}
			});
	});

	$('a.popup-image').magnificPopup({
			type: 'image',
			image: {
				titleSrc: 'title',
				tError: 'The image could not be loaded.',
			}
		});

	$('a.gallery').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1]
		},
		image: {
			titleSrc: 'title',
			tError: 'The image could not be loaded.',
		}
	});
	
	var wow = new WOW({
			mobile: false
	});
	wow.init();
	$('.p-pag ul').addClass('pagination');
	
	$('.wpcf7-form-control').addClass('form-control');
	$('.wpcf7-submit').addClass('btn btn-custom-1');
	$('.menu-item-has-children').addClass('dropdown');
	$('.menu-item-has-children>a').addClass('dropdown-toggle');
	$('.menu-item-has-children>a').attr('data-toggle','dropdown');
	$('.sub-menu').addClass('dropdown-menu');
	$('.search-field').addClass('form-control');
	$('#comment').addClass('form-control cborder');
	$('#email').addClass('form-control cborder');
	$('#author').addClass('form-control cborder');
	$('#url').addClass('form-control cborder');
	$('.search-submit').addClass('btn');
	$('#submit').addClass('btn text-center');

})(jQuery);