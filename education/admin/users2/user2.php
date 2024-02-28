<? include "../../../config/core.php";

	// 
	if (!$user_right) header('location: /education/');

	$users = db::query("select * from user where `right` is null order by ins_dt desc limit 50");

	
	// site setting
	$menu_name = 'users';
	// $site_set['header'] = 'user';
	// $site_set['footer'] = false;
	$site_set['ublock'] = true;
	$site_set['utop_nm'] = 'Оқушылар';
	$site_set['utop_bk'] = 'course/';
	$site_set['pmenu'] = true;

	$css = ['education/main', 'education/cours', 'education/item', 'education/auser'];
	$js = ['education/main', 'education/admin'];

	$date = new DateTime();
?>
<? include "../../block/header.php"; ?>


	<div class="">

		<div class="ucours_t ucours_t2">
			<div class="ucours_tm swiper swiper_catalog2">
				<div class="swiper-wrapper">
					<a class="swiper-slide ucours_tm_i ucours_tm_act" href="/u/admin/users">Барлығы (<?=mysqli_num_rows($user)?>)</a>
				</div>
				<div class="swiper-button-prev2 swiper-button-prev"><i class="fal fa-chevron-left"></i></div>
				<div class="swiper-button-next2 swiper-button-next"><i class="fal fa-chevron-right"></i></div>
			</div>
		</div>

		<br>

		<!-- list -->
		<div class="uc_u">
			<div class="uc_us">
				<div class="uc_usi"><i class="fal fa-search"></i></div>
				<div class="uc_usn">
					<input type="text" placeholder="Іздеуді қолданыңыз" class="user_search_in">
				</div>
			</div>
			<div class="uc_uh">
				<div class="uc_uh_right">Күйі</div>
				<div class="uc_uh_name">Аты-жөні</div>
				<div>Телефон / Почта</div>
				<div>Тіркелген күні</div>
				<div class="uc_uh_number">Курстар</div>
			</div>
			<div class="uc_uc">
				<?php if (mysqli_num_rows($users) != 0): ?>
					<?php while ($users_d = mysqli_fetch_assoc($users)): ?>
						<?php // $sub_rows = fun::sub_rows($user_d['id']); ?>
						<div class="uc_ui">
							<div class="uc_uil">
								<div class="uc_ui_right">
									<div class="form_im form_im_toggle <?=($users_d['locked']?'':'form_im_toggle_act')?>">
										<input type="checkbox" class="homework" data-val="" />
										<div class="form_im_toggle_btn cursor_none"></div>
									</div>
								</div>
								<div class="uc_uiln">
									<div class="uc_ui_icon lazy_img" data-src="/assets/img/users/<?=$users_d['logo']?>">
										<?=($users_d['logo']!=null?'':'<i class="fal fa-user"></i>')?>
									</div>
									<div class="uc_ui_name"><?=$users_d['name']?> <?=$users_d['surname']?></div>
									<div class="uc_ui_phone"><?=($users_d['phone'] != null?$users_d['phone']:$users_d['mail'])?></div>
								</div>
								<div class="uc_ui_ins_date"><?=$users_d['ins_date']?></div>
								<div class="uc_ui_number"><?//=fun::sub_rows($users_d['id'])?></div>
							</div>
							<div class="uc_uib">
								<div class="uc_uibo"><i class="fal fa-ellipsis-v"></i></div>
								<div class="uc_uibs">
									<div class="uc_uib_i pass_ress" data-id="<?=$users_d['id']?>" data-login="<?=($users_d['phone'] != null?$users_d['phone']:$user_d['mail'])?>">
										<div><i class="fal fa-user-lock"></i></div>
										<span>Кілт-сөзді қайта орнату</span>
									</div>
									<div class="uc_uib_i uc_uib_del cursor_none" data-title="" data-id="<?=$sub['id']?>">
										<div><i class="fal fa-trash-alt"></i></div>
										<span>Оқушыны өшіру</span>
									</div>
								</div>
							</div>
						</div>

					<?php endwhile ?>
				<?php else: ?>
					Ешкім жоқ
				<?php endif ?>
			</div>
		</div>

	</div>

<? include "../../block/footer.php"; ?>