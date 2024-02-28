$(document).ready(function() {

	// 
	$('.lazy_logo').lazy({effect:"fadeIn",effectTime:200,threshold:0})
	$('.lazy_img').lazy({effect:"fadeIn",effectTime:300,threshold:0})
	$('.lazy_bag').lazy({effect:"fadeIn",effectTime:500,threshold:0})
	$('.lazy_c .lazy_img').lazy({
		effect: "fadeIn",
		effectTime: 100,
		threshold: 0,
		appendScroll: $('.lazy_c'),
	})



	// 
	$('.menu_bars_clc').on('click', function() {
		$(this).parent().toggleClass('menu_act');
	})
	$('.usmenu_bars_clc').on('click', function() {
		$(this).parent().toggleClass('menu_act');
		$('.ub1_r').toggleClass('ub1_r_act');
	})


	// скрол
	let scroll = $(window).scrollTop()
	if (scroll > 80) $('.header').addClass('header_fix')
  	else $('.header').removeClass('header_fix')
	if (scroll > 600) $('.posmz').addClass('posmz_act')
   else $('.posmz').removeClass('posmz_act')
	$(window).scroll(function() {
		scroll = $(window).scrollTop()
		if (scroll > 80) $('.header').addClass('header_fix')
		else $('.header').removeClass('header_fix')
		if (scroll > 600) $('.posmz').addClass('posmz_act')
		else $('.posmz').removeClass('posmz_act')
	})


	// на верх
	$('.clc_top').on('click',function(){$('body,html').animate({scrollTop:0},500)})







	// mask form
	$('.fr_code').mask('0000');
	$('.fr_age').mask('00');
	$('.fr_number').mask('# ##0', {reverse: true});
	$('.fr_days').mask('000 күн', {reverse: true});
	$('.fr_price').mask('#.##0 тг', {reverse: true});
	$('.fr_phone').mask('8 (000) 000-00-00');
	$('.fr_phone2').mask('+7 (000) 000-00-00');
	$('.fr_metrika').mask('00 000 000');
	$('.fr_pixel').mask('000 000 000 000 000');
	

	//
	$('input[type*="text"], input[type*="password"]').on('input', function() {
		$(this).attr('data-val', $(this).val())
		if ($(this).attr('data-lenght') <= $(this).val().length) {
			$(this).attr('data-sel', 1);
		} else {$(this).attr('data-sel',0)}
	});
	$('input[type*="tel"]').on('input', function() {
		var val = $(this).val().replace(/_/g, '').replace(/ /g, '').replace(/-/g, '').replace(/\(/g, '').replace(/\)/g, '').replace(/\+/g, '').replace(/тг/g, '').replace(/күн/g, '').replace(/\./g, '')
		$(this).attr('data-val', val)
		if ($(this).attr('data-lenght') <= val.length) {
			$(this).attr('data-sel', 1);
		} else {$(this).attr('data-sel',0)}
	});
	$('input[type*="url"]').on('input', function(){
		val = $(this).val().replace('https://', '').replace('www.', '').replace('youtube.com/watch?v=', '').replace('youtu.be/', '').replace(/\&.*/, '');
		$(this).attr('data-val', val);
	})

	//
	$('.form_icon_pass').on('click', function() {
		if ($(this).siblings('.password').attr('data-eye') == 0) {
			$(this).siblings('.password').attr('type', 'text')
			$(this).siblings('.password').attr('data-eye', '1')
			$(this).addClass('fa-eye')
			$(this).removeClass('fa-eye-slash')
		} else {
			$(this).siblings('.password').attr('type', 'password')
			$(this).siblings('.password').attr('data-eye', '0')
			$(this).removeClass('fa-eye')
			$(this).addClass('fa-eye-slash')
		}
	})


	// 
	$('.sel_clc').click(function() {
		if ($(this).hasClass('form_sel_act') == false) {
			$('.sel_clc').removeClass('form_sel_act')
			$(this).addClass('form_sel_act')
		} else $(this).removeClass('form_sel_act')
	});
	$('.sel_clc_i .form_im_seli').click(function() {
		$(this).parent().siblings('.sel_clc').attr('data-val', $(this).attr('data-val'))
		$(this).parent().siblings('.sel_clc').html($(this).html())
		$(this).parent().siblings('.sel_clc').removeClass('form_sel_act')
	});

	// 
	$('.form_im_toggle_btn').click(function() { 
		if ($(this).hasClass('form_im_toggle_act') == true) $(this).siblings('input').attr('data-val', 0)
		else $(this).siblings('input').attr('data-val', 1)
		$(this).toggleClass('form_im_toggle_act')
	});




	// form - input 
	// lenght
	// $('.form_im input[type*="tel"]').on('input', function(){
	// 	$(this).parent().removeClass('form_pust');
	// 	in_rez = $(this).val().replace(/ /g, '').replace(/\+/g, '').replace(/\)/g, '').replace(/\(/g, '').replace(/-/g, '').replace(/_/g, '')
	// 	if ($(this).attr('data-pr') == '1' && in_rez.length < $(this).attr('data-lenght')) {
	// 		$(this).parent().removeClass('form_pr_y')
	// 		$(this).parent().addClass('form_pr_n')
	// 	} else if (in_rez.length < $(this).attr('data-lenght')) {
	// 		$(this).parent().removeClass('form_pr_y')
	// 	} else {
	// 		$(this).parent().removeClass('form_pr_n')
	// 		$(this).parent().removeClass('form_pr_nm')
	// 		$(this).parent().addClass('form_pr_y')
	// 		$(this).attr('data-pr', '1')
	// 	}
	// })
	// $('.form_im input[type*="text"], input[type*="password"]').on('input', function(){
	// 	$(this).parent().removeClass('form_pust');
	// 	if ($(this).attr('data-pr') == '1' && $(this).val().length <= $(this).attr('data-lenght')) {
	// 		$(this).parent().removeClass('form_pr_y')
	// 		$(this).parent().addClass('form_pr_n')
	// 	} else if ($(this).val().length <= $(this).attr('data-lenght')) {
	// 		$(this).parent().removeClass('form_pr_y')
	// 	} else {
	// 		$(this).parent().removeClass('form_pr_n')
	// 		$(this).parent().removeClass('form_pr_nm')
	// 		$(this).parent().addClass('form_pr_y')
	// 		$(this).attr('data-pr', '1')
	// 	}
	// })

	// // 
	// $('.form_cn input').focus(function() {
	// 	$(this).parent().addClass('form_act');
	// });
	// $('.form_cn input').blur(function(){
	// 	if ($(this).val().length <= 0) {
	// 		$(this).parent().removeClass('form_act');
	// 	}
	// })
	// $('.form_cn input').on('input', function(){
	// 	$(this).parent().removeClass('form_pust');
	// 	$('.form_sms').parent().addClass('dsp_n');
	// })





	//
	$('.bli_setib1').on('click', function() {
		$('.bl_item').removeClass('bl_item_ac')
		$(this).parents('.bl_item').addClass('bl_item_ac')
	})








	// СМС
	$('.disb_zab').click(function(){
		$('.fr').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
	})
	$('.zabr_back').click(function(){
		$('.fr').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})

	$('.orderSend').on('click', function() {
		var name = $(this).parent().siblings().children('.name')
		var phone = $(this).parent().siblings().children('.phone')
		if (name.attr('data-pr') != 1 || phone.attr('data-pr') != 1) { mess('Введите свой данный') }
		else {
			$.ajax({
				url: "/send/?mess",
				type: "POST",
				dataType: "html",
				data: ({name: name.val(), phone: phone.val()}),
				success: function(data){
					if (data == 'yes') { 
						mess('Сәтті жіберілді')
					} else {
						mess('Қайта кіріуіңізді сұраймын!')
					}
				},
				beforeSend: function(){ mess('Отправка..') },
				error: function(data){ mess('Ошибка..') }
			})
		}
	})
	




	// var swiper = new Swiper(".swiper_catalog", {
	// 	slidesPerView: "auto",
	// 	navigation: {
	// 	  nextEl: ".swiper-button-next1",
	// 	  prevEl: ".swiper-button-prev1",
	// 	},
	// });














	

	// var slide_min = new Swiper('.slide_min', {
 //      	slidesPerView: 'auto',
 //      	pagination: {
	//         el: '.slide_min_pag',
	//         type: 'progressbar',
	// 	},
 //    });
 //    var slide_max = new Swiper('.slide_max', {
 //      	slidesPerView: 'auto',
 //      	pagination: {
	//         el: '.slide_max_pag',
	//         type: 'progressbar',
	// 	},
	// 	navigation: {
	// 		nextEl: '.slide_max_next',
	// 		prevEl: '.slide_max_prev',
	// 	},
 //    });
 //    var home_cours_cat_c = new Swiper('.home_cours_cat_c', {
 //      	slidesPerView: 'auto',
 //      	pagination: {
	//         el: '.home_cours_cat_c_pag',
	//         type: 'progressbar',
	// 	},
 //    });



	// var galleryThumbs = new Swiper('.gallery-thumbs', {
	//     slidesPerView: 'auto',
	//     freeMode: true,
	//     watchSlidesVisibility: true,
	//     watchSlidesProgress: true,
 //    });
 //    var galleryTop = new Swiper('.gallery-top', {
 //    	autoHeight: true,
	// 	loop:true,
 //      	thumbs: { swiper: galleryThumbs }
 //    });


    // кaрусел
	// var galleryThumbs = new Swiper('.gallery-thumbs', {
	// 	loop:true,
	// 	slidesPerView: 3,
	// 	allowTouchMove: false,
	// 	freeMode: true,
	// 	watchSlidesVisibility: true,
	// 	watchSlidesProgress: true,
	// 	breakpoints: {
	//         360: {
	//           	slidesPerView: 2,
	// 			allowTouchMove: true,
	//         },
	//     }
	// })
	// var galleryTop = new Swiper('.gallery-top', {
	// 	autoplay: {
	//     	delay: 5000,
	//   	},
	//   	speed: 500,
	// 	loop:true,
	// 	navigation: {
	// 		nextEl: '.swiper-button-next',
	// 		prevEl: '.swiper-button-prev',
	// 	},
	// 	thumbs: {
	// 		swiper: galleryThumbs,
	// 	},
	// })





	$('.bq_cipcni').on('click', function () { 
		$(this).siblings('.bq_cipcni').removeClass('bq_cipcni_act');
		$(this).addClass('bq_cipcni_act');
		$(this).parent().siblings('p').html($(this).attr('data-price'))
	})

	$('.btn_ukl').click(function (e) { 
      e.preventDefault();
      $('.oko').addClass('oko_act')
   });
   $('.oko_close').click(function (e) { 
      e.preventDefault();
      $('.oko').removeClass('oko_act')
   });






})