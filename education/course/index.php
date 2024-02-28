<? include "../../config/core.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: /education/');

	// Курс деректері
	if (isset($_GET['id']) || $_GET['id'] != '') {
		$course_id = $_GET['id'];
		$course = db::query("select * from course where id = '$course_id'");
		if (mysqli_num_rows($course)) {
			$course_d = mysqli_fetch_assoc($course);			
			if ($course_d['info']) $course_d = array_merge($course_d, fun::course_info($course_d['id']));
		} else header('location: /education/my/');
	} else header('location: /education/my/');

	// Жазылымды тексеру
	$buy = db::query("select * from course_pay where course_id = '$course_id' and user_id = '$user_id'");
	if (mysqli_num_rows($buy)) {
		$buy_d = mysqli_fetch_assoc($buy);
		if ($course_d['contract']) $contract = @$buy_d['$contract'];
	} else $buy = 0;


	// 
	$cblock = db::query("select * from course_block where course_id = '$course_id' order by number asc");

	
	// Сайттың баптаулары
	$menu_name = 'item';
	$site_set['utop_bk'] = ' ';
	$site_set['utop'] = $course_d['name_'.$lang];
	$site_set['autosize'] = true;
	$css = ['education/main', 'education/item'];
	$js = ['education/main'];
?>
<? include "../block/header.php"; ?>

	<div class="uitem">

		<div class="uitem_c <?=(mysqli_num_rows($cblock) == 0?'uitem_c2':'')?>">
			<!-- Инфо -->
			<div class="uitemc_l">

				<div class="uitemci_ck">
					<div class="uitemci_cktr"><div class="lazy_img" data-src="/assets/uploads/course/<?=$course_d['img']?>"></div></div>
					<div class="uitemci_ckt">
						<div class="uitemci_cktl">
							<h1 class="uitemci_h"><?=$course_d['name_'.$lang]?></h1>
						</div>
					</div>

					<div class="uitemci_ckb">
						<? if ($buy_d['view']) $precent = round(100 / ($course_d['item'] / $buy_d['view'])); ?>
						<div class="uitemci_ckb2">
							<div class="itemci_ls">
								<? if ($course_d['arh']): ?> <div class="itemci_lsi itemci_lsi_arh">Курс архивте</div> <? endif ?>
								<? if (@$course_d['item']): ?> <div class="itemci_lsi"><?=($buy_d['view']?$buy_d['view'].'/':'')?><?=$course_d['item']?> сабақ</div> <? endif ?>
								<? if (@$course_d['test']): ?> <div class="itemci_lsi"><?=$course_d['test']?> тест</div> <? endif ?>
								<? if (@$course_d['assig']): ?> <div class="itemci_lsi"><?=$course_d['assig']?> тапсырма</div> <? endif ?>
							</div>
							<? if ($buy_d['view']): ?> <div class=""><?=$precent?>%</div> <? endif ?>
						</div>
						<? if ($buy_d['view']): ?>
							<div class="uitemci_time_b">
								<div class="uitemci_time_b2" style="width:<?=$precent?>%"></div>
							</div>
						<? endif ?>
					</div>

					<? if ($buy && $buy_d['end_dt']): ?>
						<div class="uitemci_tt">
							<span>Доступ:</span>
							<? 
								if ($buy_d['ins_dt'] && $buy_d['end_dt']) {
									$result = intval((strtotime($buy_d['end_dt']) - strtotime(date("d.m.Y"))) / (60*60*24));
									$result2 = intval((strtotime($buy_d['end_dt']) - strtotime($buy_d['ins_dt'])) / (60*60*24)); 
									if ($result2 == $result) $precent = 0; elseif ($result > 0) $precent = round(100 / ($result2 / ($result2 - $result))); else $precent = 100;
								}
							?>
							<div class="uitemci_time">
								<div class="uitemci_time_t">
									<div class="">Басы: <?=date("d-m-Y", strtotime($buy_d['ins_dt']))?></div>
									<div class="">Соңы: <?=date("d-m-Y", strtotime($buy_d['end_dt']))?></div>
								</div>
								<div class="uitemci_time_t">
									<div class="">
										<? if ($result > 0): ?> Аяқталуына: <?=$result?> күн бар
										<? else: ?> Аяқталғанына: <?=abs($result)?> күн болды <? endif ?>
									</div>
									<div class=""><?=$precent?>%</div>
								</div>
								<div class="uitemci_time_b"><div class="uitemci_time_b2" style="width:<?=$precent?>%"></div></div>
							</div>
						</div>
					<? endif ?>
				</div>

				<!--  -->
				<div class=""></div>
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
							
							<? 
								if ($buy) {
									if ($course_d['open_type'] == 'block' && $course_d['open_days']) {
										$days = intval((strtotime(date("d.m.Y")) - strtotime($buy_d['ins_dt'])) / (60*60*24));
										$open_number = floor(($days + $course_d['open_days']) / $course_d['open_days']);
										if ($open_number > $block['number'] - $course_d['open_start']) $open = true; else $open = false;
									} else $open = true;
								} else $open = false;

								if (!mysqli_num_rows($pay_lesson_d) && $block['type'] == 'approval') $open = false;
								
								// echo $open;
							?>
							
							<div class="coursls_cn">
								<? if (mysqli_num_rows($cblock) != 1): ?>
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
											<? if ($open): ?> <i class="fal fa-angle-down"></i>
											<? else: ?> <i class="far fa-lock"></i> <? endif ?>
										</div>
									</div>
								<? endif ?>

								<? $number = 0; ?>
								<? if ((mysqli_num_rows($item_d) && !$block['type']) || (mysqli_num_rows($pay_lesson_d) && $block['type'] == 'approval')): ?>
									<? while ($item = mysqli_fetch_assoc($item_d)): ?>
										<? $lesson_id = $item['id']; ?>
										<? $pay_lesson_itd = db::query("select * from course_pay_lesson where lesson_id = '$lesson_id' and user_id = '$user_id' and open = 1"); ?>
										<? if (!$block['type'] || (mysqli_num_rows($pay_lesson_itd) && $block['type'] == 'approval')): ?>
											<? $number++; ?>
											<a class="coursls_i" <?=($item['open'] && $open?'href="lesson/?id='.$item['id'].'"':'')?>>
												<div class="coursls_ic">
													<div class="coursls_in"><?=$number?>. <?=$item['name_'.$lang]?></div>
												</div>
												<? if ($open): ?> 
													<div class="coursls_il <?=($item['open']?'':'coursls_il_lock')?>">
														<? if ($item['open']): ?> <i class="far fa-play"></i>
														<? else: ?> <i class="far fa-lock"></i> <? endif ?>
													</div>
												<? endif ?>
											</a>
										<? endif ?>
									<? endwhile ?>
								<? endif ?>

							</div>
						<? endwhile ?>
					</div>

				<? else: ?>

				<? endif ?>
			</div>

		</div>
	</div>

<? include "../block/footer.php"; ?>

	<? if (@$course_d['contract'] && @$buy_d['contract'] != 2): ?>
		<div class="pop_bl contract_block pop_bl_act" >
			<div class="pop_bl_a contract_back" ></div>
			<div class="pop_bl_c">
				<div class="head_c txt_c">
					<h5>Договор оферта</h5>
				</div>
				<div class="txt_c">
					<p class="contract_hh">Төмендегі келісім шартты қабылдамай <br> курсты бастай алмайсыз</p>
					<a class="contract_a" target="_blank" href="contract/<?=$course_d['contract']?>" data-id="<?=$buy_d['id']?>">
						<div class="contract_ghn">
							<div class="contract_ghnc"></div>
							<div class="btn btn_back3">Оқып шығу</div>
						</div>
					</a>
				</div>
				<div class="form_c">
					<div class="form_im form_im_bn">
						<div class="btn btn_contract_fg <?=(!$buy_d['contract']?'btn_grs':'')?> <?=($buy_d['contract']==1?'btn_contract_sel':'')?>" data-id="<?=$buy_d['id']?>">Оқып шықтым, қабылдаймын</div>
					</div>
				</div>
			</div>
		</div>
	<? endif ?>