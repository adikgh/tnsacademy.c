<? include "../../../config/core.php";
	
	// Қолданушыны тексеру
	if (!$user_right) header('location: /education/');

	// Курс деректері
	if (isset($_GET['id']) || $_GET['id'] != '') {
		$course_id = $_GET['id'];
		$course_d = fun::course($course_id);
		if (!$course_d) header('location: /education/my/list.php');
	} else header('location: /education/my/list.php');


	// filter user all
	if (@$_GET['on'] == 1) $cours_sub_all = db::query("select * from course_pay where course_id = '$course_id' and off is null");
	elseif (@$_GET['off'] == 1) $cours_sub_all = db::query("select * from course_pay where course_id = '$course_id' and off is not null");
	else $cours_sub_all = db::query("select * from course_pay where course_id = '$course_id'");
	$page_result = mysqli_num_rows($cours_sub_all);

	// page number
	$page = 1; if (@$_GET['page'] && is_int(intval($_GET['page']))) $page = $_GET['page'];
	$page_age = 50;
	$page_all = ceil($page_result / $page_age);
	if ($page > $page_all && $page_all != 0) $page = $page_all;
	$page_start = ($page - 1) * $page_age;
	$number = $page_start;

	// filter cours
	if (@$_GET['on'] == 1) $cours_sub = db::query("select * from course_pay where course_id = '$course_id' and off is null order by ins_dt desc limit $page_start, $page_age");
	elseif (@$_GET['off'] == 1) $cours_sub = db::query("select * from course_pay where course_id = '$course_id' and off is not null order by ins_dt desc limit $page_start, $page_age");
	else $cours_sub = db::query("select * from course_pay where course_id = '$course_id' order by ins_dt desc limit $page_start, $page_age");


	// Сайттың баптаулары
	$menu_name = 'item';
	$pod_menu_name = 'users';
	$site_set['swiper'] = true;
	$site_set['utop'] = $course_d['name_'.$lang].' - оқушылар';
	$site_set['utop_bk'] = 'course/admin.php?id='.$course_id;
	$css = ['education/main', 'education/item', 'education/auser'];
	$js = ['education/main', 'education/admin', 'education/auser'];
?>
<? include "../../block/header.php"; ?>

	<div class="uitem">

		<? include "../top.php"; ?>

		<div class="uitem_c2">

			<!--  -->
			<div class="ucours_t">
				<!-- <div class="swiper ucours_ts">
					<div class="swiper-wrapper">
						<a class="swiper-slide ucours_ti <?=($_GET['on']!=1&&$_GET['off']!=1?'ucours_tm_act':'')?>" href="/user/item/users/?id=<?=$course_id?>">Барлығы <?=($_GET['on']!=1&&$_GET['off']!=1?'('.$page_result.')':'')?></a>
						<a class="swiper-slide ucours_ti <?=($_GET['on']==1?'ucours_tm_act':'')?>" href="/user/item/users/?id=<?=$course_id?>&on=1">Қосулы <?=($_GET['on']==1?'('.$page_result.')':'')?></a>
						<a class="swiper-slide ucours_ti <?=($_GET['off']==1?'ucours_tm_act':'')?>" href="/user/item/users/?id=<?=$course_id?>&off=1">Жабық <?=($_GET['off']==1?'('.$page_result.')':'')?></a>
					</div>
					<div class="swiper-button-next ucours_tnext"><i class="fal fa-chevron-right"></i></div>
				</div> -->
				<div class="ucours_tb">
					<div class="btn add_user_btn">
						<i class="far fa-user-plus"></i>
						<span>Оқушыны қосу</span>
					</div>
				</div>
			</div>


			<!-- list -->
			<? if ($page_result != 0): ?>
				<div class="uc_u">
					<div class="uc_us">
						<div class="uc_usn form_im">
							<input type="text" class="form_im_txt cours_user_search_in" placeholder="Іздеуді қолданыңыз" data-id="<?=$course_id?>" />
							<i class="fal fa-search form_icon"></i>
						</div>
					</div>
					<div class="uc_uh">
						<div class="uc_uh_number">#</div>
						<div class="uc_uh_right">Күйі</div>
						<div class="uc_uh_3f">Аты-жөні</div>
						<div class="uc_uh_3f">Тіркелген күні</div>
						<div class="uc_uh_3f">Статус</div>
					</div>
					<div class="uc_uc">
						<? while ($sub_d = mysqli_fetch_assoc($cours_sub)): ?>
							<? $user_d = fun::user($sub_d['user_id']); ?>
							<? $number++; ?>

							<div class="uc_ui">
								<div class="uc_uil">

									<div class="uc_ui_number"><?=$number?></div>

									<div class="uc_ui_right">
										<div class="form_im form_im_toggle">
											<input type="checkbox" class="homework" data-val="" />
											<div class="form_im_toggle_btn <?=(@$user_d['locked']?'':'form_im_toggle_act')?>"></div>
										</div>
									</div>

									<div class="uc_uiln">
										<div class="uc_ui_icon lazy_img" data-src="/assets/uploads/users/<?=$user_d['img']?>"><?=($user_d['img']!=null?'':'<i class="fal fa-user"></i>')?></div>
										<div class="uc_uinu">
											<div class="uc_ui_name"><?=$user_d['name']?> <?=$user_d['surname']?></div>
											<div class="uc_ui_phone"><?=($user_d['phone'] != null?$user_d['phone']:$user_d['mail'])?></div>
										</div>
									</div>

									<? if ($sub_d['ins_dt'] != null && $sub_d['end_dt'] != null):?>
										<? $result = intval((strtotime($sub_d['end_dt']) - strtotime(date("d.m.Y"))) / (60*60*24)); ?>
										<? $access = intval((strtotime($sub_d['end_dt']) - strtotime($sub_d['ins_dt'])) / (60*60*24)); ?>
										<?	if ($access == $result) $precent = 0; elseif ($result > 0) $precent = round(100 / ($access / ($access - $result))); else $precent = 100; ?>
									<? endif ?>
									<div class="uc_uin_date">
										<div class="uc_uin_datec">
											<? if ($sub_d['end_dt'] != null): ?>
												<div class="uc_uin_date_u">
													<div class=""> <? if ($result > 0): ?><?=$result?> күн қалды <? else: ?>Аяқталды<? endif ?> </div>
													<div class=""><?=$precent?>%</div>
												</div>
												<div class="uc_uin_date_i"><span style="width:<?=$precent?>%"></span></div>
											<? else: ?><div class="uc_uin_date_u">Шексіз</div><? endif ?>
										</div>
									</div>

									<div class="uc_ui_3f">
										<? if (!$user_d['open']): ?> Платформаға кірмеген 
										<? elseif (!$sub_d['view']): ?> Курсты ашпаған
										<? else: ?> Курсты оқып жатыр <? endif ?>
									</div>

								</div>
								<div class="uc_uib">
									<div class="uc_uibo"><i class="fal fa-ellipsis-v"></i></div>
									<div class="menu_c uc_uibs">
										<div class="menu_ci pass_resert" data-title2="" data-id="<?=$sub_d['user_id']?>">
											<div class="menu_cin"><i class="fal fa-key"></i></div>
											<div class="menu_cih">Кілт сөзді алу</div>
										</div>
										<!-- <div class="menu_ci" data-title2="Доступ уақытын ауыстыру">
											<div class="menu_cin"><i class="fal fa-calendar-alt"></i></div>
											<div class="menu_cih">Доступ уақыты</div>
										</div> -->
										<div class="menu_ci sms_send" data-title2="Смс қайта жіберу" data-id="<?=$sub_d['id']?>">
											<div class="menu_cin"><i class="fal fa-paper-plane"></i></div>
											<div class="menu_cih">СМС қайта жіберу</div>
										</div>
										<div class="menu_ci user_del" data-title2="Оқушыны өшіру" data-id="<?=$sub_d['id']?>">
											<div class="menu_cin"><i class="fal fa-trash-alt"></i></div>
											<div class="menu_cih">Оқушыны өшіру</div>
										</div>
									</div>
								</div>
							</div>
						<? endwhile ?>
					</div>
				</div>

				<? if ($page_all > 1): ?>
					<div class="uc_p">
						<? if ($page > 1): ?> <a class="uc_pi" href="/education/course/users/?id=<?=$course_id?>&page=<?=$page-1?>"><i class="fal fa-long-arrow-left"></i></a> <? endif ?>
						<a class="uc_pi <?=($page==1?'uc_pi_act':'')?>" href="/education/course/users/?id=<?=$course_id?>&page=1">1</a>
						<? for ($pg = 2; $pg < $page_all; $pg++): ?>
							<? if ($pg == $page - 1): ?>
								<? if ($page - 1 != 2): ?> <div class="uc_pi uc_pi_disp">...</div> <? endif ?>
								<a class="uc_pi <?=($page==$pg?'uc_pi_act':'')?>" href="/education/course/users/?id=<?=$course_id?>&page=<?=$pg?>"><?=$pg?></a>
							<? endif ?>
							<? if ($pg == $page): ?> <a class="uc_pi <?=($page==$pg?'uc_pi_act':'')?>" href="/user/item/users/?id=<?=$course_id?>&page=<?=$pg?>"><?=$pg?></a> <? endif ?>
							<? if ($pg == $page + 1): ?>
								<a class="uc_pi <?=($page==$pg?'uc_pi_act':'')?>" href="/education/course/users/?id=<?=$course_id?>&page=<?=$pg?>"><?=$pg?></a>
								<? if ($page + 1 != $page_all - 1): ?> <div class="uc_pi uc_pi_disp">...</div> <? endif ?>
							<? endif ?>
						<? endfor ?>
						<a class="uc_pi <?=($page==$page_all?'uc_pi_act':'')?>" href="/education/course/users/?id=<?=$course_id?>&page=<?=$page_all?>"><?=$page_all?></a>
						<? if ($page < $page_all): ?> <a class="uc_pi" href="/education/course/users/?id=<?=$course_id?>&page=<?=$page+1?>"><i class="fal fa-long-arrow-right"></i></a> <? endif ?>
					</div>
				<? endif ?>
				
			<? else: ?>
				Ешкім жоқ
			<? endif ?>
		</div>
	</div>

<? include "../../block/footer.php"; ?>

	<!-- user plus -->
	<div class="pop_bl add_user">
		<div class="pop_bl_a add_user_back"></div>
		<div class="pop_bl_c">
			<div class="head_c txt_c">
				<h4>Оқушыны қосу</h4>
				<p>Номерін немесе почтасын жазыңыз<br>доступ ашылады</p>
			</div>
			<div class="form_c">
				<div class="form_im form_btn">
					<div class="form_span">Доступ түрі:</div>
					<div class="form_btn_c">
						<div class="form_btn_i form_btn_act"><i class="fal fa-mobile"></i><span>Телефон</span></div>
						<div class="form_btn_i"><i class="fal fa-at"></i><span>Почта</span></div>
					</div>
				</div>

				<div class="form_im cn_phone">
					<input type="tel" class="form_im_txt phone fr_phone" placeholder="8 (000) 000-00-00" data-lenght="11">
					<i class="far fa-mobile form_icon"></i>
				</div>
				<? if (get_balance() < 50): ?>
					<div class="form_im cn_phone">
						<div class="form_span" style="color:var(--cm)">SMS уақытша жұмыс жасамайды</div>
					</div>
				<? endif ?>


				<div class="form_im cn_mail dsp_n">
					<input type="text" class="form_im_txt mail" placeholder="Почта" data-lenght="6">
					<i class="far fa-at form_icon"></i>
				</div>
				<div class="form_im form_im_bn">
					<div class="btn add_user_send" data-cours-id="<?=$course_id?>">
						<span>Қосу</span>
					</div>
				</div>
			</div>
		</div>
	</div>