	// sign in
	$('.btn_sign_up').on('click', function() {

		// else if ($(this).attr('data-type') == 'reset-pass') {
		// 	$('.code input').each(function(){code_sum += $(this).attr('data-val')})
		// 	if (code.attr('data-sel') != 1) {
		// 		mess('Cіз сандарды жазбапсыз')
		// 	} else {
		// 		$.ajax({
		// 			url: "/user/get.php?code",
		// 			type: "POST",
		// 			dataType: "html",
		// 			data: ({login: login.attr('data-val'), code: code.attr('data-val')}),
		// 			success: function(data){
		// 				if (data == 'yes') {
		// 					$(location).attr('href', '/user/sign_reset.php');
		// 				} else if (data == 'none') {
		// 					mess('Cіз жазған код қате, қайта жазып көріңіз')
		// 				} else {console.log(data)}
		// 				console.log(data);
		// 			},
		// 			beforeSend: function(){},
		// 			error: function(data){console.log(data)}
		// 		})
		// 	}
		// }

		

		// form
		this_btn = $(this)
		login = $('.login')
		code = $('.code')

		// 
		if ($(this).attr('data-type') == 'login') {
			if (login.attr('data-sel') != 1) mess('Cіз телефен номеріңізді жазбапсыз')
			else {
				$.ajax({
					url: "/user/get.php?login",
					type: "POST",
					dataType: "html",
					data: ({login: login.attr('data-val')}),
					success: function(data){
						if (data == 'code') {
							code.parent().removeClass('dsp_n')
							this_btn.attr('data-type', 'code')
						} else if (data == 'none') mess('Cіз базада тіркелмегенсіз, біздің курстарымызды қарай аласыз!')
						console.log(data);
					},
					beforeSend: function(){},
					error: function(data){console.log(data)}
				})
			}
		} else if ($(this).attr('data-type') == 'code') {
			if (code.attr('data-sel') != 1) mess('Cіз сандарды жазбапсыз')
			else {
				$.ajax({
					url: "/user/get.php?code",
					type: "POST",
					dataType: "html",
					data: ({
						login: login.attr('data-val'),
						code: code.attr('data-val')
					}),
					success: function(data){
						if (data == 'yes') $(location).attr('href', '/user/sign_up2.php');
						else if (data == 'none') mess('Cіз жазған код қате, қайта жазып көріңіз')
						console.log(data);
					},
					beforeSend: function(){},
					error: function(data){console.log(data)}
				})
			}
		}
	});


	
	// sign up
	$('.btn_sign_up2').on('click', function() {

		this_btn = $(this)
		name_d = $('.name')
		password = $('.password')
		
		if (name_d.attr('data-sel') != 1 || password.attr('data-sel') != 1) {
			mess('Форманы толық толтырыңыз')
		} else {
			$.ajax({
				url: "/user/get.php?sign_up",
				type: "POST",
				dataType: "html",
				data: ({name:name_d.attr('data-val'), password:password.attr('data-val')}),
				success: function(data){
					if (data == 'yes') {
						location.reload();
					} else {console.log(data)}
					console.log(data);
				},
				beforeSend: function(){},
				error: function(data){console.log(data)}
			})
		}
	});



	
	// sign up
	$('.btn_sign_reset').on('click', function() {

		this_btn = $(this)
		password = $('.password')
		
		if (password.attr('data-sel') != 1) mess('Құпия сөзді жазыңыз')
		else {
			$.ajax({
				url: "/user/get.php?sign_reset",
				type: "POST",
				dataType: "html",
				data: ({password:password.attr('data-val')}),
				success: function(data){
					if (data == 'yes') {
						location.reload();
					} else {console.log(data)}
					console.log(data);
				},
				beforeSend: function(){},
				error: function(data){console.log(data)}
			})
		}
	});










		// bookmark
		$('.bq3_ci_book').on('click', function() {
			var btn = $(this)
			if (btn.hasClass('bq3_ci_book_act') == false) { 
				btn.addClass('bq3_ci_book_act')
				$.ajax({
					url: "/user/get.php?bookmark_plus",
					type: "POST",
					dataType: "html",
					data: ({ cours_id: btn.attr('data-id') }),
					success: function(data){ 
						if (data=='yes') {
							mess('Сақтаулыға сақталынды')
							btn.children('.btn').children('i').addClass('fas')
						}
					},
					beforeSend: function(){ },
					error: function(data){ mess('Ошибка..') }
				})
			} else {
				btn.removeClass('bq3_ci_book_act')
				btn.children('.btn').children('i').removeClass('fas')
				$.ajax({
					url: "/user/get.php?bookmark_del",
					type: "POST",
					dataType: "html",
					data: ({ cours_id: btn.attr('data-id') }),
					success: function(data){ 
						mess('Сақтаулыдан алып тасталынды')
						if (data=='yes') {if (btn.hasClass('bq3_ci_book_act2')==true) btn.parent().remove()}
						if (data=='none') { 
							$('.bookmark_nn').removeClass('dsp_n')
							if (btn.hasClass('bq3_ci_book_act2')==true) btn.parent().parent().remove()
						}
						console.log(data);
					},
					beforeSend: function(){ },
					error: function(data){ mess('Ошибка..') }
				})
	
			}
		})



		








	$('.form_im_btn_clc .form_im_btn_i').click(function(){
		if ($(this).hasClass('form_im_btn_act') == false) {
			$(this).siblings('.form_im_btn_i').removeClass('form_im_btn_act')
			$(this).addClass('form_im_btn_act')
			$(this).parent().attr('data-val', $(this).attr('data-val'))
		}
	})





	// 
	$('.rad1').on('click', function () { 
		if ($(this).parent().attr('data-sel') == 0) {
			$(this).addClass('form_radio_act')
			$(this).parent().attr('data-sel', 1)

			if ($(this).hasClass('answer') == true) {
				$(this).addClass('form_radio_true');
				var answer = 1;
				mess('Сіздің жауабыңыз дұрыс');
			} else {
				$(this).addClass('form_radio_false');
				$(this).siblings('.answer').addClass('form_radio_true');
				var answer = 0;
				mess('Сіздің жауабыңыз қате, талқылауды қараңыз');
			}

			$.ajax({
				url: "/user/get.php?test_answer",
				type: "POST",
				dataType: "html",
				data: ({ 
					answer: answer, 
					v: $(this).attr('data-val'), 
					test_id: $(this).parent().attr('data-test-id'), 
					lesson_id: $(this).parent().attr('data-lesson-id') 
				}),
				success: function(data){ },
				beforeSend: function(){ },
				error: function(data){ }
			})

		}
	})


	$('.lsb_it1 .lsb_i').on('click', function () {
		if ($(this).hasClass('lsb_act') != true) {
			var nm = Number($(this).attr('data-number')) + 1;
			var cls = '.lsb_i[data-number="' + nm + '"]';
			$(cls).removeClass('dsp_n');
			$(this).addClass('lsb_act');
	
			$.ajax({
				url: "/user/get.php?sub_info_upd",
				type: "POST",
				dataType: "html",
				data: ({ lesson_id: $(this).parent().attr('data-lesson-id'), nm: nm }),
				success: function(data){ },
				beforeSend: function(){ },
				error: function(data){ }
			})
		}
	})

	$('.btn_hw').on('click', function () {

		btn = $(this)
		inp_hm = $('.inp_hm')

		if (inp_hm.val() != '') {
			$.ajax({
				url: "/user/get.php?home_work",
				type: "POST",
				dataType: "html",
				data: ({ 
					cours_id: btn.attr('data-cours-id'), 
					pack_id: btn.attr('data-pack-id'), 
					lesson_id: btn.attr('data-lesson-id'), 
					inp_hm: inp_hm.val()
				}),
				success: function(data){ 
					if (data == 'yes') { location.reload(); }
					console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		} else { mess('Жазуды ұмыттыңыз') }
	})



	$('.btn_rev').on('click', function () {

		btn = $(this)
		inp_rev = $('.inp_rev')

		if (inp_rev.val() != '') {
			$.ajax({
				url: "/user/get.php?rev_add",
				type: "POST",
				dataType: "html",
				data: ({ 
					cours_id: btn.attr('data-cours-id'), 
					inp_rev: inp_rev.val()
				}),
				success: function(data){ 
					if (data == 'yes') { location.reload(); }
					console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		} else { mess('Жазуды ұмыттыңыз') }
	})


	// 
	$('.btn_add_ques').on('click', function () {

		btn = $(this)
		txt = $('.inp_form')

		if (txt.val() != '') {
			$.ajax({
				url: "/user/get.php?add_ques",
				type: "POST",
				dataType: "html",
				data: ({ 
					cours_id: btn.attr('data-cours-id'), 
					pack_id: btn.attr('data-pack-id'), 
					lesson_id: btn.attr('data-lesson-id'), 
					txt: txt.val()
				}),
				success: function(data){ 
					if (data == 'yes') { location.reload(); }
					console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		} else { mess('Жазуды ұмыттыңыз') }
	})


	// 
	$('.rad2').on('click', function () { 
		if ($(this).parent().attr('data-sel') == 0) {
			$(this).addClass('form_radio_act form_radio_true')
			$(this).parent().children('.rad2').removeClass('form_radio_false')
			$(this).parent().attr('data-sel', 1)

			san = Number($(this).parent().parent().siblings('.btn').attr('data-ball'))
			san = san + Number($(this).attr('data-ball'))
			$(this).parent().parent().siblings('.btn').attr('data-ball', san)
		}
	})

	$('.rad2_btn').on('click', function () { 
		san2 = 0
		$(this).siblings('.lsb_icm').children('.form_im').each(function () { 
			if ($(this).attr('data-sel') == 0) { 
				mess('Тест толық орындаңыз')
				$(this).children('.rad2').addClass('form_radio_false')
			} else san2++
		})
		if (san2 == $(this).attr('data-number')){
			$(this).siblings('.otv_rad2').removeClass('dsp_n')
			if ($(this).attr('data-min') <= $(this).attr('data-ball')) $(this).siblings('.otv_rad2').children('.v1').removeClass('dsp_n')
			if ($(this).attr('data-max') >= $(this).attr('data-ball')) $(this).siblings('.otv_rad2').children('.v2').removeClass('dsp_n')
		}
	})



