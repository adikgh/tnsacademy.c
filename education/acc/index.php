<? include "../../config/core.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: /education/');

	// Сайттың баптаулары
	$menu_name = 'user';
	$site_set['footer'] = false;
	$site_set['utop'] = 'Жеке деректер';
	$site_set['utop_bk'] = '/my';
	$site_set['utopu'] = false;
	$css = ['education/main', 'education/uacc'];
	$js = ['education/main']; if ($user_right) $js = ['education/main', 'education/admin'];
?>
<? include "../block/header.php"; ?>

	<div class="up">

		<div class="up_top">
			<div class="up_lg">
				<div class="up_logo">
					<div class="up_logo_c lazy_img" data-src="/assets/uploads/users/<?=$user['img']?>">
						<?=($user['img']?'':'<i class="fal fa-user"></i>')?>
					</div>
				</div>
				<!-- <div class="up_logo_upd"><i class="fal fa-camera"></i></div> -->
			</div>
			<div class="up_inf">
				<div class="up_name"><?=$user['name']?> <?=$user['surname']?></div>
				<div class="up_phone"><?=substr($user['phone'],0,1).' ('.substr($user['phone'],1,3).') '.substr($user['phone'],4,3).'-'.substr($user['phone'],7,2).'-'.substr($user['phone'],9)?></div>
			</div>
		</div>

		<div class="up_c">
			<div class="up_lt">
				<div class="up_li user_edit_pop">
					<div class="menu_cin"><i class="fal fa-user-circle"></i></div>
					<div class="menu_cih">Жеке деректер</div>
				</div>
				<div class="up_li user_ph_pop">
					<div class="menu_cin"><i class="fal fa-mobile"></i></div>
					<div class="menu_cih">Телефон номерім</div>
				</div>
				<? if ($user_right): ?>
					<div class="up_li company_edit_pop">
						<div class="menu_cin"><i class="fal fa-cog"></i></div>
						<div class="menu_cih">Бағдарлама баптауы</div>
					</div>
				<? endif ?>
				<!-- <a class="up_li" href="">
					<div class="menu_cin"><i class="far fa-cog"></i></div>
					<div class="menu_cih">Баптаулар</div>
				</a> -->
			</div>

			<!-- <div class="up_lt">
				<a class="up_li" href="#">
					<div class="menu_cin"><i class="fal fa-question-circle"></i></div>
					<div class="menu_cih">Жиі қойылатын сұрақтар</div>
				</a>
				<a class="up_li" href="#">
					<div class="menu_cin"><i class="fal fa-comment-dots"></i></div>
					<div class="menu_cih">Көмек</div>
				</a>
			</div> -->
			
			<div class="up_lt">
				<? if ($site['whatsapp']): ?>
					<a class="up_li" href="https://wa.me/<?=$site['whatsapp']?>">
						<div class="menu_cin"><i class="fal fa-comment-dots"></i></div>
						<div class="menu_cih">Көмек (Whatsapp)</div>
					</a>
				<? endif ?>
				<a class="up_li" href="#">
					<div class="menu_cin"><i class="fal fa-award"></i></div>
					<div class="menu_cih">Академия жайлы</div>
				</a>
				<a class="up_li" href="#/education/all/offer.php">
					<div class="menu_cin"><i class="fal fa-users-cog"></i></div>
					<div class="menu_cih">Қолдану ережелері</div>
				</a>
				<a class="up_li" href="#/education/all/privacy.php">
					<div class="menu_cin"><i class="fal fa-users-cog"></i></div>
					<div class="menu_cih">Авторлық құқық</div>
				</a>
			</div>

			<div class="up_exit">
				<a class="btn btn_red_cl" href="/education/exit.php">
					<i class="far fa-sign-out"></i>
					<span>Шығу</span>
				</a>
			</div>
		</div>
		<div class="up_cg">
			<a href="https://gprog.kz" target="_blank" class="gprog_bl">
				<span>#gprog-та</span>
				<div class="gprog_heart"><i class="fas fa-heart"></i></div>
				<span>жасалған</span>
				<div class="gprog_ab">
					<div class="gprog_lg"><div class="lazy_img" data-src="https://gprog.kz/assets/img/logo/logo_tr_1200.png"></div></div>
					<div class="gprog_h">G prog</div>
					<div class="gprog_p">digital cіздің<br>бизнесіңізге</div>
				</div>
			</a>
		</div>
	</div>

<? include "../block/footer.php"; ?>