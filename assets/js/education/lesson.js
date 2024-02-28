$(document).ready(function() {


	$('.question_56').click(function(){
		if ($(this).hasClass('form_btn_act') == false) {
			$('.question_56').removeClass('form_btn_act');
			$(this).addClass('form_btn_act');
		}
	})

   // 
	$('.question_56').on('click', function () { 
		$.ajax({
			url: "/education/course/lesson/get.php?question_56",
			type: "POST",
			dataType: "html",
			data: ({ 
				answer: $(this).attr('data-val'),
				question_id: $(this).parent().attr('data-question-id'),
				lesson_id: $(this).parent().attr('data-lesson-id'),
				open_lesson_id: $(this).parent().attr('data-open-lesson-id'),
			}),
			beforeSend: function(){ },
			error: function(data){ },
			success: function(data){
				console.log(data);
			}
		})
	})












	























}) // end jquery