<? include "../../config/core.php";

	// Қолданушыны тексеру
	if (!$user_right) header('location: /education/');

	// Курс деректері
	if (isset($_GET['id']) || $_GET['id'] != '') {
		$course_id = $_GET['id'];
		$course = db::query("select * from course where id = '$course_id'");
		if (mysqli_num_rows($course)) {
			$course_d = mysqli_fetch_assoc($course);			
			if ($course_d['info']) $course_d = array_merge($course_d, fun::course_info($course_d['id']));

			// Блок деректері
			$cblock = db::query("select * from course_block where course_id = '$course_id' order by number asc");

		} else header('location: /education/my/');
	} else header('location: /education/my/');


	// Сайттың баптаулары
	$menu_name = 'item';
	$site_set['utop_bk'] = 'my/list.php';
	$site_set['utop'] = $course_d['name_'.$lang];
	$site_set['autosize'] = true;
	$css = ['education/main', 'education/item'];
	$js = ['education/main', 'education/admin'];
?>
<? include "../block/header.php"; ?>

	<div class="uitem">

		<div class="uitem_c <?=(mysqli_num_rows($cblock) == 0?'uitem_c2':'')?>">
			<!-- Инфо -->
			<div class="uitemc_l">

				<? include "top.php"; ?>

				<div class="uitemci_ck">
					<div class="uitemci_cktr"><div class="lazy_img" data-src="/assets/uploads/course/<?=$course_d['img']?>"></div></div>
					<div class="uitemci_ckt">
						<div class="uitemci_cktl">
							<h1 class="uitemci_h"><?=$course_d['name_'.$lang]?></h1>
						</div>
					</div>
					<div class="uitemci_ckb"></div>
				</div>
				
			</div>

			<!-- lesson -->
			<div class="uc_list">
				<!-- <span>Сабақтардың тізімі:</span> -->
				<? if (mysqli_num_rows($cblock) != 0 ): ?>
					
					<div class="cours_ls">
						<? while ($block = mysqli_fetch_assoc($cblock)): ?>
							<?	$block_id = $block['id']; ?>
							<?	$item_d = db::query("select * from course_lesson where block_id = '$block_id' order by number asc"); ?>
							<? $pay_lesson_d = db::query("select * from course_pay_lesson where block_id = '$block_id' and user_id = '$user_id' and open = 1"); ?>
							
							<div class="coursls_cn">
								<? if ($block['view_name']): ?> 
									<div class="coursls_i coursls_b">
										<div class="coursls_ic">
											<div class="coursls_in"><?=$block['number']?> бөлім. <?=$block['name_'.$lang]?></div>
											<div class="coursls_ip">
												<? if ($block['item']): ?> <div class="coursls_ipi"><?=$block['item']?> сабақ</div> <? endif ?>
												<? if ($block['question']): ?> <div class="coursls_ipi"><?=$block['question']?> сұрақ</div> <? endif ?>
												<? if ($block['test']): ?> <div class="coursls_ipi"><?=$block['test']?> тест</div> <? endif ?>
												<? if ($block['assig']): ?> <div class="coursls_ipi"><?=$block['assig']?> тапсырма</div> <? endif ?>
											</div>
										</div>
										<div class="coursls_il2">
											<? if ($block['type'] != 'approval'): ?> <i class="fal fa-angle-down"></i>
											<? else: ?> <i class="far fa-lock"></i> <? endif ?>
										</div>
									</div>
								<? endif ?>

								<? if ((mysqli_num_rows($item_d) && !$block['type']) || (mysqli_num_rows($pay_lesson_d) && $block['type'] == 'approval')): ?>
									<? while ($item = mysqli_fetch_assoc($item_d)): ?>
										<? $lesson_id = $item['id']; ?>
										<? $pay_lesson_itd = db::query("select * from course_pay_lesson where lesson_id = '$lesson_id' and user_id = '$user_id' and open = 1"); ?>
										<? if (!$block['type'] || (mysqli_num_rows($pay_lesson_itd) && $block['type'] == 'approval')): ?>
											<a class="coursls_i" <?=($item['open']?'href="lesson/?id='.$item['id'].'"':'')?>>
												<div class="coursls_ic">
													<div class="coursls_in"><?=$item['number']?>. <?=$item['name_'.$lang]?></div>
												</div>
												<? if ($item['open']): ?> <div class="coursls_il"><i class="far fa-play"></i></div>
												<? else: ?> <div class="coursls_il coursls_il_lock"><i class="far fa-lock"></i></div> <? endif ?>
											</a>
										<? endif ?>
									<? endwhile ?>
								<? endif ?>

								<div class="coursls_i_rg">
									<div class="btn btn_k add_lesson_b" data-block-id="<?=$block_id?>">
										<i class="far fa-layer-plus"></i>
										<span>Сабақ қосу</span>
									</div>
								</div>

							</div>
						<? endwhile ?>
					</div>

					<div class="coursls_i_rg">
						<div class="btn btn_k add_block_b">
							<i class="far fa-layer-plus"></i>
							<span>Басқа бөлім қосу</span>
						</div>
					</div>

				<? else: ?>
					<div class="coursls_i_rg">
						<div class="btn btn_k add_block_b">
							<i class="far fa-layer-plus"></i>
							<span>Бөлімдерге бөлу</span>
						</div>
					</div>
					<div class="coursls_i_rg">
						<div class="btn btn_k add_lesson_b">
							<i class="far fa-layer-plus"></i>
							<span>Жай сабақтарды қосу</span>
						</div>
					</div>
				<? endif ?>
			</div>

		</div>
	</div>

<? include "../block/footer.php"; ?>

	<!-- lesson add -->
	<div class="pop_bl pop_bl2 lesson_add">
		<div class="pop_bl_a lesson_add_back"></div>
		<div class="pop_bl_c">
			<div class="head_c txt_c">
				<h5>Cабақты қосу</h5>
				<div class="btn btn_dd2 lesson_add_back"><i class="fal fa-times"></i></div>
			</div>
			<div class="pop_bl_cl">
				<div class="form_c">
					<div class="form_im">
						<div class="form_span">Cабақтың атауы:</div>
						<input type="text" class="form_txt lesson_name" placeholder="Атауын жазыңыз" data-lenght="2">
						<i class="far fa-text form_icon"></i>
					</div>
					<div class="form_im form_im_toggle">
						<div class="form_span">Сабақты ашып қою:</div>
						<input type="checkbox" class="lesson_open" data-val="1" />
						<div class="form_im_toggle_btn form_im_toggle_act"></div>
					</div>

					<div class="form_im form_im_toggle">
						<div class="form_span">Сабақты толықтыру:</div>
						<input type="checkbox" class="price_inp" data-val="" />
						<div class="form_im_toggle_btn lesson1_clc"></div>
					</div>
					<div class="lesson1_block">
						<div class="form_im">
							<div class="form_span">Видеосы: (Yotube)</div>
							<input type="url" class="form_txt lesson_youtube" placeholder="Сілтемесін салыңыз" data-lenght="1" />
							<i class="fal fa-play form_icon"></i>
						</div>
						<div class="form_im">
							<div class="form_span">Мәтіні:</div>
							<textarea type="text" class="form_im_comment_aut lesson_txt" rows="5" autocomplete="off" autocorrect="off" aria-label="Мәтінді жазыңыз .." placeholder="Мәтінді жазыңыз .." ></textarea>
							<script>autosize(document.querySelectorAll('.form_im_comment_aut'));</script>
						</div>
					</div>

					<div class="form_im form_im_bn">
						<div class="btn btn_lesson_add" data-course-id="<?=$course_id?>">Қосу</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- block add -->
	<div class="pop_bl pop_bl2 block_add">
		<div class="pop_bl_a block_add_back"></div>
		<div class="pop_bl_c">
			<div class="head_c txt_c">
				<h5>Бөлім қосу</h5>
				<div class="btn btn_dd2 block_add_back"><i class="fal fa-times"></i></div>
			</div>
			<div class="pop_bl_cl">
				<div class="form_c">
					<div class="form_im">
						<div class="form_span">Бөлімнің атауы:</div>
						<input type="text" class="form_txt block_name" placeholder="Атауын жазыңыз" data-lenght="2">
						<i class="far fa-text form_icon"></i>
					</div>

					<div class="form_im form_im_toggle">
						<div class="form_span">Информация жазу:</div>
						<input type="checkbox" class="info_inp" data-val="" />
						<div class="form_im_toggle_btn number1_clc"></div>
					</div>
					<div class="number1_block">
						<div class="form_im">
							<div class="form_span">Сабақ саны:</div>
							<input type="tel" class="form_im_txt fr_number block_item" placeholder="12" data-lenght="1" />
							<i class="fal fa-play form_icon"></i>
						</div>
						<div class="form_im">
							<div class="form_span">Тапсырма саны:</div>
							<input type="tel" class="form_im_txt fr_number block_assig" placeholder="3" data-lenght="1" />
							<i class="fal fa-scroll-old form_icon"></i>
						</div>
					</div>

					<div class="form_im form_im_bn">
						<div class="btn btn_block_add" data-course-id="<?=$course_id?>">Қосу</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- cours edit -->
	<div class="pop_bl pop_bl2 cours_edit_block">
		<div class="pop_bl_a cours_edit_back"></div>
		<div class="pop_bl_c">
			<div class="head_c">
				<h5>Cабақты қосу</h5>
				<div class="btn btn_dd2 cours_edit_back"><i class="fal fa-times"></i></div>
			</div>
			<div class="pop_bl_cl lazy_c">
				<div class="form_c">
					<div class="form_im">
						<div class="form_span">Курстың атауы:</div>
						<input type="text" class="form_txt cours_name" placeholder="Атауын жазыңыз" data-lenght="2" value="<?=$course_d['name_kz']?>" />
						<i class="fal fa-text form_icon"></i>
					</div>
					<div class="form_im">
						<div class="form_span">Доступ уақыты:</div>
						<input type="tel" class="form_txt fr_days cours_access" placeholder="60 күн" data-lenght="1" value="<?=$course_d['access']?>" />
						<i class="fal fa-calendar-alt form_icon"></i>
					</div>

					<div class="form_im">
						<div class="form_span">Курс фотосы:</div>
						<input type="file" class="cours_img file dsp_n" accept=".png, .jpeg, .jpg">
						<div class="form_im_img cours_img_add <?=($course_d['img']?'form_im_img2':'')?>" <?=($course_d['img']?'style="background-image: url(/assets/uploads/course/'.$course_d['img'].')"':'')?> data-txt="Фотоны жаңарту">Құрылғыдан таңдау</div>
					</div>

					<div class="form_im form_im_toggle">
						<div class="form_span">Бағасын жазу:</div>
						<input type="checkbox" class="price_inp" data-val="" />
						<div class="form_im_toggle_btn price1_clc <?=($course_d['price']||$course_d['price_sole']?'form_im_toggle_act':'')?>"></div>
					</div>
					<div class="price1_block <?=($course_d['price']||$course_d['price_sole']?'price1_block_act':'')?>">
						<div class="form_im">
							<div class="form_span">Бағасы:</div>
							<input type="tel" class="form_im_txt fr_price cours_price" placeholder="10.000 тг" data-lenght="1" value="<?=$course_d['price']?>" />
							<i class="fal fa-tenge form_icon"></i>
						</div>
						<div class="form_im">
							<div class="form_span">Жіңілдік бағасы:</div>
							<input type="tel" class="form_im_txt fr_price cours_price_sole" placeholder="10.000 тг" data-lenght="1" value="<?=$course_d['price_sole']?>" />
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
							<input type="tel" class="form_im_txt fr_number cours_item" placeholder="12" data-lenght="1" value="<?=$course_d['item']?>" />
							<i class="fal fa-play form_icon"></i>
						</div>
						<div class="form_im">
							<div class="form_span">Тапсырма саны:</div>
							<input type="tel" class="form_im_txt fr_number cours_assig" placeholder="3" data-lenght="1" value="<?=$course_d['assig']?>" />
							<i class="fal fa-scroll-old form_icon"></i>
						</div>
					</div>

					<div class="form_im form_im_bn"><div class="btn btn_cours_edit" data-cours-id="<?=$course_id?>"><i class="far fa-check"></i><span>Сақтау</span></div></div>
				</div>
			</div>
		</div>
	</div>