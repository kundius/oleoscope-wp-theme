document.addEventListener("DOMContentLoaded", () => {
	const menu = new Mmenu("#main-menu", {
		"slidingSubmenus": false,
		"extensions": ["pagedim-black"],
		"navbar": [{
			"add": false
		}],
		"navbars": [{
			"position": "top",
			"content": document.getElementById('header-user-reg').innerHTML
		}, {
			"position": "bottom",
			"content": '<ul>' + document.getElementById('social-menu-header').innerHTML + '</ul>'
		}],
		"onClick": [{
			"close": true
		}]
	}, {
		offCanvas: {
			clone: true
		}
	});
	let api = menu.API;
	const recallButtons = document.querySelectorAll(".recall-button");
	Array.from(recallButtons).forEach(link => {
		link.addEventListener('click', function(event) {
			menu.API.close();
		});
	});
});
$(document).ready(function() {
	$('.download-notice').click(function() {
		$('.popup-notice').fadeIn();
	});
	$('.popup-notice__button-close').click(function() {
		$('.popup-notice').fadeOut();
	});
	$(".fancybox-chart").fancybox({
		type: "iframe",
		toolbar: false,
		smallBtn: true,
		iframe: {
			preload: false,
			attr: {
				scrolling: "auto"
			}
		}
	})
	$('.popular-blocks').slick({
		dots: false,
		infinite: false,
		speed: 300,
		slidesToShow: 4,
		slidesToScroll: 4,
		responsive: [{
			breakpoint: 1024,
			settings: {
				slidesToShow: 3,
				slidesToScroll: 3,
				infinite: true,
				dots: true
			}
		}, {
			breakpoint: 600,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 2
			}
		}, {
			breakpoint: 480,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			}
		}]
	});
	$('.featured-blocks-big').slick({
		arrows: false,
		dots: true,
		infinite: true,
		speed: 500,
		fade: true,
		cssEase: 'linear',
		autoplay: true,
		autoplaySpeed: 5000,
	});
	var headerHeight = 0 + $('.main-header').height(),
		mProductsOfsetTop = 40,
		scrollBtn = $('.scroll-to-top');
	$(window).scroll(function() {
		var scrollTop = $(window).scrollTop(),
			diff = (scrollTop + headerHeight) - mProductsOfsetTop;
		if (scrollTop > 300) {
			scrollBtn.fadeIn('slow');
		} else {
			scrollBtn.fadeOut('fast');
		};
	});
	scrollBtn.click((e) => {
		e.preventDefault();
		$('html, body').animate({
			scrollTop: 0
		}, 'slow');
	});
	$('#price-table-filter').on('keyup', function() {
		let value = $(this).val().toLowerCase();
		$('#price-table tr').filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});
});