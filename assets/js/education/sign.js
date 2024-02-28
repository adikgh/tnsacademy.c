$(document).ready(function() {



   // phone sms
   $('.phone_inp').on('input', function() {
      phone = $(this)
      if (phone.attr('data-sel') == 1) {
         $.ajax({
            url: "/education/get.php?phone_sms",
            type: "POST",
            dataType: "html",
            data: ({ phone: phone.attr('data-val') }),
            success: function(data){
               if (data == 'none') mess('Сіз базадан таппадым, мүмкін нөмірді қате жазған боларсыз')
               else if (data == 'yes') {
                  mess('Cізге код жібердім, кодты төменге жазып көріңіз')
                  $('.form_im_cd').removeClass('dsp_n')
                  $('.btn_sign_in span').html('Кіру')
               } else if (data == 'pass') {
                  $('.form_im_ps').removeClass('dsp_n')
                  $('.btn_sign_in span').html('Кіру')
               } else if (data == 'code') {
                  $('.form_im_cd').removeClass('dsp_n')
                  $('.btn_sign_in span').html('Кіру')
               }
               console.log(data);
            },
            beforeSend: function(){ },
            error: function(data){ console.log(data) }
         })
      }
   });

   // sign in
   $('.btn_sign_in').on('click', function() {
      btn = $(this); 
      phone = $('.phone'); 
      password = $('.password');
      code = $('.code');

      if ((password.attr('data-sel') != 1 && code.attr('data-sel') != 1) || phone.attr('data-sel') != 1) {
         if (phone.attr('data-sel') != 1) mess('Cіз телефон нөміріңізді жазбапсыз')
         else mess('Cіз кілт сөзді жазбапсыз')
      } else {
         $.ajax({
            url: "/education/get.php?login",
            type: "POST",
            dataType: "html",
            data: ({
               phone: phone.attr('data-val'),
               password: password.attr('data-val'),
               code: code.attr('data-val')
            }),
            beforeSend: function(){ },
            error: function(data){ console.log(data) },
            success: function(data){
               if (data == 'yes') location.reload();
               else if (data == 'none') mess('Сіз базадан таппадым, админге жазып көріңіз')
               else if (data == 'password') mess('Cіздің жазған құпия сөз, қайта жазып көріңіз')
               else if (data == 'code_add') mess('Cізге код жібердім, кодты қайта жазып көріңіз')
               console.log(data);
            },
         })
      }
   });


   // reset pass
   $('.btn_pass_reset').on('click', function() {
      phone = $('.phone')
      if (phone.attr('data-sel') != 1) mess('Cіз телефон нөміріңізді жазбапсыз')
      else {
         $.ajax({
            url: "/education/get.php?pass_reset",
            type: "POST",
            dataType: "html",
            data: ({ phone: phone.attr('data-val') }),
            success: function(data){
               if (data == 'none') mess('Сіз базадан таппадым, админге жазып көріңіз')
               if (data == 'yes') mess('Cізге код жібердім, кодты қайта жазып көріңіз')
               if (data == 'error') mess('Cзге смс кетпеді, админмен байланысып көріңіз')
               console.log(data);
            },
            beforeSend: function(){ },
            error: function(data){ console.log(data) }
         })
      }
   });








   // mail sl
   $('.mail_inp').on('input', function() {
      mail = $(this)
      if (mail.attr('data-sel') == 1) {
         $.ajax({
            url: "/education/get.php?mail_inp",
            type: "POST",
            dataType: "html",
            data: ({ mail: mail.attr('data-val') }),
            beforeSend: function(){ },
            error: function(data){ console.log(data) },
            success: function(data){
               // if (data == 'none') mess('Сіз базадан таппадым, мүмкін нөмірді қате жазған боларсыз')
               // else 
               if (data == 'yes') {
                  mess('Cізге код жібердім, кодты төменге жазып көріңіз')
                  $('.form_im_cd').removeClass('dsp_n')
                  $('.sign_mail span').html('Кіру')
               } else if (data == 'pass') {
                  $('.form_im_ps').removeClass('dsp_n')
                  $('.sign_mail span').html('Кіру')
               } else if (data == 'code') {
                  $('.form_im_cd').removeClass('dsp_n')
                  $('.sign_mail span').html('Кіру')
               }
               console.log(data);
            },
         })
      }
   });
   
   // sign in
   $('.sign_mail').on('click', function() {
      btn = $(this); 
      mail = $('.mail');
      password = $('.password');
      code = $('.code');

      if ((password.attr('data-sel') != 1 && code.attr('data-sel') != 1) || mail.attr('data-sel') != 1) {
         if (mail.attr('data-sel') != 1) mess('Cіз телефон нөміріңізді жазбапсыз')
         else mess('Cіз кілт сөзді жазбапсыз')
      } else {
         $.ajax({
            url: "/education/get.php?login_mail",
            type: "POST",
            dataType: "html",
            data: ({
               mail: mail.attr('data-val'),
               password: password.attr('data-val'),
               code: code.attr('data-val')
            }),
            beforeSend: function(){ },
            error: function(data){ console.log(data) },
            success: function(data){
               if (data == 'yes') location.reload();
               else if (data == 'none') mess('Сіз базадан таппадым, админге жазып көріңіз')
               else if (data == 'password') mess('Cіздің жазған құпия сөз, қайта жазып көріңіз')
               else if (data == 'code_add') mess('Cізге код жібердім, кодты қайта жазып көріңіз')
               console.log(data);
            },
         })
      }
   });



}) // end jquery