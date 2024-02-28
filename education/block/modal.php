<!--  -->
<div class="bl_mess"><div class="bl_mess_sam"></div></div>


<!-- phone -->
<? if ($site_set['cl_wh']): ?>
	<a target="_blank" href="https://wa.me/<?=$site['whatsapp']?>">
		<div type="button" class="callback-bt">
		   <i class="fab fa-whatsapp"></i>
		</div>
	</a>
<? endif ?>


<!-- user edit -->
<? if ($user_id): ?>
	<div class="pop_bl pop_bl2 user_edit_block">
		<div class="pop_bl_a user_edit_back"></div>
		<div class="pop_bl_c">
			<div class="head_c">
				<h5>Жеке деректер</h5>
				<div class="btn btn_dd2 user_edit_back"><i class="fal fa-times"></i></div>
			</div>
			<div class="pop_bl_cl">
				<div class="form_c">
					<div class="form_im">
					<div class="form_span">Есіміңіз:</div>
                  	<input type="text" class="form_txt user_name" placeholder="Есіміңізді жазыңыз" data-lenght="2" value="<?=$user['name']?>" />
					<i class="fal fa-text form_icon"></i>
               </div>
				<div class="form_im">
					<div class="form_span">Тегіңіз:</div>
					<input type="text" class="form_txt user_surname" placeholder="Тегіңізді жазыңыз" data-lenght="2" value="<?=$user['surname']?>" />
					<i class="fal fa-text form_icon"></i>
               </div>
               <div class="form_im">
					<div class="form_span">Жеке фотоңыз:</div>
					<input type="file" class="user_img file dsp_n" accept=".png, .jpeg, .jpg">
					<div class="form_im_img user_img_add <?=($user['img']?'form_im_img2':'')?>" <?=($user['img']?'style="background-image: url(/assets/uploads/users/'.$user['img'].')"':'')?> data-txt="Фотоны жаңарту">Құрылғыдан таңдау</div>
				</div>

               <div class="form_im">
                  	<div class="form_span">Құпия кодыңыз:</div>
                  	<input type="tel" class="form_im_txt fr_code user_code" placeholder="0000" data-lenght="4" value="<?=$user['code']?>" />
                  	<i class="fal fa-lock-alt form_icon"></i>
               </div>

				<div class="form_im form_im_bn"><div class="btn btn_user_edit"><i class="far fa-check"></i><span>Сақтау</span></div></div>
				</div>
			</div>
		</div>
	</div>

   <!-- user edit -->
	<div class="pop_bl pop_bl2 user_ph_block">
		<div class="pop_bl_a user_ph_back"></div>
		<div class="pop_bl_c">
			<div class="head_c">
				<h5>Телефон нөмерді жаңарту</h5>
				<div class="btn btn_dd2 user_ph_back"><i class="fal fa-times"></i></div>
			</div>
			<div class="pop_bl_cl">
				<div class="form_c">
               <div class="form_im">
						<div class="form_span">Телефон нөміріңіз:</div>
                  <input type="text" class="form_im_txt fr_phone user_phone" placeholder="8 (000) 000-00-00" data-lenght="6" value="<?=$user['phone']?>" />
						<i class="fal fa-user-graduate form_icon"></i>
					</div>
               <div class="form_im">
                  <div class="form_span">Растау коды:</div>
                  <input type="tel" class="form_im_txt fr_code new_code" placeholder="0000" data-lenght="4" />
                  <i class="fal fa-lock-alt form_icon"></i>
               </div>
					<div class="form_im form_im_bn"><div class="btn btn_user_ph"><i class="far fa-check"></i><span>Сақтау</span></div></div>
				</div>
			</div>
		</div>
	</div>
<? endif ?>


<!-- company setting edit -->
<? if ($user_right): ?>
	<div class="pop_bl pop_bl2 company_edit_block">
		<div class="pop_bl_a company_edit_back"></div>
		<div class="pop_bl_c">
			<div class="head_c">
				<h5>Бағдарлама баптауы</h5>
				<div class="btn btn_dd2 company_edit_back"><i class="fal fa-times"></i></div>
			</div>
			<div class="pop_bl_cl">
				<div class="form_c">
					<div class="form_im">
						<div class="form_span">Атауы:</div>
                  <input type="text" class="form_txt company_name" placeholder="Есіміңізді жазыңыз" data-lenght="2" value="<?=$site['name']?>" />
						<i class="fal fa-text form_icon"></i>
               </div>
               <div class="form_im">
						<div class="form_span">Телефон нөмір:</div>
                  <input type="tel" class="form_im_txt fr_phone2 company_phone" placeholder="+7 (000) 000-00-00" data-lenght="11" value="<?=$site['phone_view']?>" />
						<i class="fal fa-phone-alt form_icon"></i>
					</div>
               <div class="form_im">
						<div class="form_span">Whatsapp нөмір:</div>
                  <input type="tel" class="form_im_txt fr_phone2 company_whatsapp" placeholder="7 (000) 000-00-00" data-lenght="11" value="<?=$site['whatsapp_view']?>" />
						<i class="fab fa-whatsapp form_icon"></i>
					</div>
               <div class="form_im">
						<div class="form_span">Instagram (account):</div>
                  <input type="text" class="form_im_txt company_instagram" placeholder="@user" data-lenght="2" value="<?=$site['instagram']?>" />
						<i class="fab fa-instagram form_icon"></i>
					</div>
               <div class="form_im">
						<div class="form_span">Telegram (account):</div>
                  <input type="text" class="form_im_txt company_telegram" placeholder="@user" data-lenght="2" value="<?=$site['telegram']?>" />
                  <i class="fab fa-telegram-plane form_icon"></i>
					</div>
               <div class="form_im">
						<div class="form_span">Youtube (account):</div>
                  <input type="text" class="form_im_txt company_youtube" placeholder="@user" data-lenght="2" value="<?=$site['youtube']?>" />
						<i class="fab fa-youtube form_icon"></i>
					</div>
               <div class="form_im">
						<div class="form_span">Yandex Metrika (code):</div>
                  <input type="tel" class="form_im_txt fr_metrika company_metrika" placeholder="00 000 000" data-lenght="8" value="<?=$site['metrika']?>" />
						<i class="fab fa-yandex form_icon"></i>
					</div>
               <div class="form_im">
						<div class="form_span">Facebook Pixel (code):</div>
                  <input type="tel" class="form_im_txt fr_pixel company_pixel" placeholder="000 000 000 000 000" data-lenght="15" value="<?=$site['pixel']?>" />
                  <i class="fab fa-facebook-f form_icon"></i>
					</div>

					<div class="form_im form_im_bn"><div class="btn btn_company_edit"><i class="far fa-check"></i><span>Сақтау</span></div></div>
				</div>
			</div>
		</div>
	</div>
<? endif ?>