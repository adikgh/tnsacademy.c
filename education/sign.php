<? include "../config/core.php";

	// link
	if ($user_id && isset($_GET['id'])) header('location: course/?id='.$_GET['id']);
	elseif ($user_right) header('location: my/list.php');
	elseif ($user_id) header('location: my/');

	// site setting
	$menu_name = 'sign_in';
	$site_set['header'] = false;
	$site_set['footer'] = false;
	$site_set['cl_wh'] = true;
	$css = ['education/main', 'education/sign'];
	$js = ['education/main', 'education/sign'];
?>
<? include "block/header.php"; ?>

	<div class="u_sign">
		
		<div class="u_sign_logo">
			<!-- <div class="u_sign_logo_l lazy_img" data-src="/assets/img/logo/logo_bl.png"></div> -->
			<div class="u_sign_logo_r"><?=$site['name']?></div>
		</div>

		<div class="usign_c">

			<div class="">
				<!-- <div class="usign_img">
					<div class="lazy_img" data-src="/assets/img/icons/waving-hand_1f44b.png"></div>
				</div> -->
				<h3 class="usign_h">Платформаға кіру</h3>
				<!-- <p class="usign_p">Сізге доступ берілген номер мен <br> код арқылы кіресіз</p> -->
			</div>

			<div class="usign_cn">

				<div class="form_c usign_f">
					<!-- <div class="uitemc_um uitemc_um2">
						<div class="uitemc_umi uitemc_umi_act" href="../my/">Телефон</div>
						<div class="uitemc_umi " href="all.php">Почта</div>
					</div> -->
					<div class="form_im form_im_ph">
						<input type="tel" class="form_txt fr_phone phone phone_inp" placeholder="8 (000) 000-00-00" data-lenght="11" data-sel="0" />
						<i class="fal fa-user form_icon"></i>
					</div>
					<div class="form_im form_im_ps">
						<input type="password" class="form_txt password" placeholder="Құпия сөз" data-lenght="4" data-sel="0" />
						<i class="fal fa-lock-alt form_icon"></i>
						<i class="fal fa-eye-slash form_icon_pass"></i>
					</div>
					<div class="form_im form_im_cd dsp_n">
						<input type="tel" class="form_txt fr_code code" placeholder="0000" data-lenght="4" data-sel="0" />
						<i class="fal fa-lock-alt form_icon"></i>
					</div>
					<!-- <div class="si_blc_bn">
						<div class="form_im cn_reset">
							<div class="btn btn_back3 btn_pass_reset">Код есімде емес?</div>
						</div>
						<div class="form_im cn_reset_time dsp_n">
							<div class="btn btn_back3 btn_in_pass_reset" data-clc="Код қайта жіберу?">60</div>
						</div>
					</div> -->
					<div class="form_im">
						<button class="btn btn_sign_in">Кіру</button>
					</div>
				</div>

				<div class="txt_c">
					<a href="sign_mail.php" class="btn btn_back3 ">Почта арқылы кіру</a>
				</div>

			</div>

		</div>
	</div>

<? include "block/footer.php"; ?>