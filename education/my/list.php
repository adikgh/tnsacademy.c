<? include "../../config/core.php";

	// Қолданушыны тексеру
	if (!$user_right) header('location: /education/');

	// course 
	$cours = db::query("select * from course where arh is null ORDER BY ins_dt DESC");
	$cours_arh = db::query("select * from course where arh = 1 ORDER BY ins_dt DESC");


	// Сайттың баптаулары
	$menu_name = 'list';
	$site_set['pmenu'] = true;
	$css = ['education/main', 'education/cours'];
	$js = ['education/main', 'education/admin'];
?>
<? include "../block/header.php"; ?>

	<div class="ucours">

		<div class="head_c">
        	<h4>Курстар</h4>
		</div>

		<div class="uc_d">
			<div class="uc_di bq3_ci_rg cours_add_pop">
				<i class="fal fa-plus"></i>
				<span>Курс қосу</span>
			</div>

			<? while($cours_d = mysqli_fetch_assoc($cours)): ?>
				<? $cours_id = $cours_d['id']; ?>
				<? if ($cours_d['info']) $cours_d = array_merge($cours_d, fun::course_info($cours_d['id'])); ?>
				<a class="uc_di" href="../course/admin.php?id=<?=$cours_id?>">
					<div class="bq_ci_img"><div class="lazy_img" data-src="/assets/uploads/course/<?=$cours_d['img']?>"></div></div>
					<div class="uc_dit">
						<div class="bq_ci_info"><div class="bq_cih"><?=$cours_d['name_'.$lang]?></div></div>
					</div>
				</a>
			<? endwhile ?>
		</div>

	</div>


	<br><br><br>

	<? if (mysqli_num_rows($cours_arh)): ?>
		<div class="ucours">
			<div class="head_c">
				<h4>Архивте</h4>
			</div>

			<div class="uc_d">
				<? while($cours_d = mysqli_fetch_assoc($cours_arh)): ?>
					<? $cours_id = $cours_d['id']; ?>
					<? if ($cours_d['info']) $cours_d = array_merge($cours_d, fun::course_info($cours_d['id'])); ?>
					<a class="uc_di" href="../course/admin.php?id=<?=$cours_id?>">
						<div class="bq_ci_img"><div class="lazy_img" data-src="/assets/uploads/course/<?=$cours_d['img']?>"></div></div>
						<div class="uc_dit">
							<div class="bq_ci_info"><div class="bq_cih"><?=$cours_d['name_'.$lang]?></div></div>
						</div>
					</a>
				<? endwhile ?>
			</div>

		</div>
	<? endif ?>


<? include "../block/footer.php"; ?>

	<!-- cours add -->
	<div class="pop_bl pop_bl2 cours_add_block">
		<div class="pop_bl_a cours_add_back"></div>
		<div class="pop_bl_c">
			<div class="head_c">
				<h5>Cабақты қосу</h5>
				<div class="btn btn_dd2 cours_add_back"><i class="fal fa-times"></i></div>
			</div>
			<div class="pop_bl_cl">
				<div class="form_c">
					<div class="form_im">
						<div class="form_span">Курстың атауы:</div>
						<input type="text" class="form_txt cours_name" placeholder="Атауын жазыңыз" data-lenght="2" />
						<i class="fal fa-text form_icon"></i>
					</div>
					<div class="form_im">
						<div class="form_span">Доступ уақыты (айды күндермен):</div>
						<input type="tel" class="form_txt fr_days cours_access" placeholder="60 күн" data-lenght="1" />
						<i class="fal fa-calendar-alt form_icon"></i>
					</div>
					<div class="form_im">
						<div class="form_span">Тариф саны (егер бар болса):</div>
						<input type="tel" class="form_txt fr_number cours_rates" placeholder="1" data-lenght="1" />
						<i class="fal fa-calendar-alt form_icon"></i>
					</div>

					<div class="form_im">
						<div class="form_span">Курс фотосы:</div>
						<input type="file" class="cours_img file dsp_n" accept=".png, .jpeg, .jpg">
						<div class="form_im_img lazy_img cours_img_add" data-txt="Фотоны жаңарту">Құрылғыдан таңдау</div>
					</div>

					<div class="form_im form_im_toggle">
						<div class="form_span">Бағасын жазу:</div>
						<input type="checkbox" class="price_inp" data-val="" />
						<div class="form_im_toggle_btn price1_clc"></div>
					</div>
					<div class="price1_block">
						<div class="form_im">
							<div class="form_span">Бағасы:</div>
							<input type="tel" class="form_im_txt fr_price cours_price" placeholder="10.000 тг" data-lenght="1" />
							<i class="fal fa-tenge form_icon"></i>
						</div>
						<div class="form_im">
							<div class="form_span">Жіңілдік бағасы:</div>
							<input type="tel" class="form_im_txt fr_price cours_price_sole" placeholder="10.000 тг" data-lenght="1" />
							<i class="fal fa-tenge form_icon"></i>
						</div>
					</div>

					<div class="form_im form_im_toggle">
						<div class="form_span">Информация жазу:</div>
						<input type="checkbox" class="info_inp" data-val="" />
						<div class="form_im_toggle_btn number1_clc"></div>
					</div>
					<div class="number1_block">
						<div class="form_im">
							<div class="form_span">Сабақ саны:</div>
							<input type="tel" class="form_im_txt fr_number cours_item" placeholder="12" data-lenght="1" />
							<i class="fal fa-play form_icon"></i>
						</div>
						<div class="form_im">
							<div class="form_span">Тапсырма саны:</div>
							<input type="tel" class="form_im_txt fr_number cours_assig" placeholder="3" data-lenght="1" />
							<i class="fal fa-scroll-old form_icon"></i>
						</div>
					</div>

					<div class="form_im form_im_bn">
						<div class="btn btn_item_add"><i class="far fa-check"></i><span>Сақтау</span></div>
					</div>
				</div>
			</div>
		</div>
	</div>