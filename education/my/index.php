<? include "../../config/core.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: /education/');
	if ($user_right) header('location: /education/list.php');
	if (!$user['open']) $ubd = db::query("UPDATE `user` SET `open` = 1 WHERE id = '$user_id'");

	// Cours 
	$pay_course = db::query("select * from course_pay where user_id = '$user_id' ORDER BY ins_dt DESC");


	// Сайттың баптаулары
	$menu_name = 'my';
	$css = ['education/main', 'education/cours'];
	$js = ['education/main']; if ($user_right) $js = ['education/main', 'education/admin'];
?>
<? include "../block/header.php"; ?>

	<div class="ucours">

		<? include "tabs.php"; ?>

		<div class="uc_d">
			<? while($pay_course_d = mysqli_fetch_assoc($pay_course)): ?>
				<? $course_id = $pay_course_d['course_id']; ?>
				<? $course_d = fun::course($course_id); ?>
				<? if ($course_d['info']) $course_d = array_merge($course_d, fun::course_info($course_d['id'])); ?>
				<a class="uc_di" href="../course/?id=<?=$course_id?>">
					<div class="bq_ci_img"><div class="lazy_img" data-src="/assets/uploads/course/<?=$course_d['img']?>"></div></div>
					<div class="uc_dit">
						<div class="bq_ci_info"><div class="bq_cih"><?=$course_d['name_'.$lang]?></div></div>
						<div class="uc_dib">
							<? if ($course_d['info']): ?>
								<? if ($pay_course_d['view']) $precent = round(100 / ($course_d['item'] / $pay_course_d['view'])); ?>
								<div class="uc_dib_ckb">
									<div class="uc_dib_ckb2">
										<div class="itemci_ls">
											<? if ($course_d['item']): ?> <div class="itemci_lsi"><?=($pay_course_d['view']?$pay_course_d['view'].'/':'')?><?=$course_d['item']?> сабақ</div> <? endif ?>
											<? if ($course_d['test']): ?> <div class="itemci_lsi"><?=$course_d['test']?> тест</div> <? endif ?>
											<? if ($course_d['assig']): ?> <div class="itemci_lsi"><?=$course_d['assig']?> тапсырма</div> <? endif ?>
										</div>
										<? if ($pay_course_d['view']): ?> <div class="itemci_lsr"><?=$precent?>%</div> <? endif ?>
									</div>
									<? if ($pay_course_d['view']): ?>
										<div class="uitemci_time_b">
											<div class="uitemci_time_b2" style="width:<?=$precent?>%"></div>
										</div>
									<? endif ?>
								</div>
								<? if (!$pay_course_d['view']): ?>
									<div class="bq_ci_btn">
										<div class="btn btn_grs btn_dd">
											<i class="fal fa-long-arrow-right"></i>
										</div>
									</div>
								<? endif ?>
							<? else: ?>
								<div class="bq_ci_btn">
									<div class="btn btn_grs">
										<span>Сабақты бастау</span>
										<i class="fal fa-long-arrow-right"></i>
									</div>
								</div>
							<? endif ?>
						</div>
					</div>
				</a>
			<? endwhile ?>
		</div>

	</div>

<? include "../block/footer.php"; ?>