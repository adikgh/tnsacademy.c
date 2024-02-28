<? include "../../config/core.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: /education/');
	if (!$user['open']) $ubd = db::query("UPDATE `user` SET `open` = 1 WHERE id = '$user_id'");

	// Cours 
	$cours = db::query("select * from course where arh is null ORDER BY ins_dt DESC");


	// Сайттың баптаулары
	$menu_name = 'all';
	$css = ['education/main', 'education/cours'];
	$js = ['education/main']; if ($user_right) $js = ['education/main', 'education/admin'];
?>
<? include "../block/header.php"; ?>

	<div class="ucours">

		<? include "tabs.php"; ?>

		<div class="uc_d">
			<? while($cours_d = mysqli_fetch_assoc($cours)): ?>
				<? $cours_id = $cours_d['id']; ?>
				<? if ($cours_d['info']) $cours_d = array_merge($cours_d, fun::course_info($cours_d['id'])); ?>
				<?	$sub = db::query("select * from course_pay where course_id = '$cours_id' and user_id = '$user_id'"); ?>
            <? if (mysqli_num_rows($sub)) $sub_i = mysqli_fetch_assoc($sub); else $sub_i = null; ?>
            <a class="uc_di" href="../course/?id=<?=$cours_id?>">
               <div class="bq_ci_img"><div class="lazy_img" data-src="/assets/uploads/course/<?=$cours_d['img']?>"></div></div>
               <div class="uc_dit">
                  <div class="bq_ci_info">
                     <div class="bq_cih"><?=$cours_d['name_'.$lang]?></div>
                  </div>
                  <div class="uc_dib">
                     <? if (mysqli_num_rows($sub)): ?>
                        <? if ($cours_d['info']): ?>
                           <? if ($sub_i['view']) $precent = round(100 / ($cours_d['item'] / $sub_i['view'])); ?>
                           <div class="uc_dib_ckb">
                              <div class="uc_dib_ckb2">
                                 <div class="itemci_ls">
                                    <? if ($cours_d['arh']): ?> <div class="itemci_lsi itemci_lsi_arh">Курс архивте</div> <? endif ?>
                                    <? if ($cours_d['item']): ?> <div class="itemci_lsi"><?=($sub_i['view']?$sub_i['view'].'/':'')?><?=$cours_d['item']?> сабақ</div> <? endif ?>
                                    <? if ($cours_d['test']): ?> <div class="itemci_lsi"><?=$cours_d['test']?> тест</div> <? endif ?>
                                    <? if ($cours_d['assig']): ?> <div class="itemci_lsi"><?=$cours_d['assig']?> тапсырма</div> <? endif ?>
                                 </div>
                                 <? if ($sub_i['view']): ?> <div class="itemci_lsr"><?=$precent?>%</div> <? endif ?>
                              </div>
                              <? if ($sub_i['view']): ?>
                                 <div class="uitemci_time_b">
                                    <div class="uitemci_time_b2" style="width:<?=$precent?>%"></div>
                                 </div>
                              <? endif ?>
                           </div>
                           <? if (!$sub_i['view']): ?>
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
                     <? else: ?>
                        <? if ($cours_d['price'] || $cours_d['price_sole']): ?>
                           <div class="bq_price">
                              <? if ($cours_d['price_sole']): ?> <p class="fr_price"><?=$cours_d['price_sole']?></p> <? endif ?>
                              <div class="fr_price"><?=$cours_d['price']?></div>
                           </div>
                           <div class="bq_ci_btn">
                              <div class="btn btn_clm btn_dd">
                                 <i class="fal fa-long-arrow-right"></i>
                              </div>
                           </div>
                        <? else: ?>
                           <div class="bq_ci_btn">
                              <div class="btn btn_clm">
                                 <span>Сатып алу</span>
                              </div>
                           </div>
                        <? endif ?>
                     <? endif ?>
                  </div>
               </div>
               <!-- <? if (!$sub_i['view']): ?> <div class="bq_ci_btn"><div class="btn btn_gr btn_dd"><i class="fal fa-long-arrow-right"></i></div></div> <? endif ?> -->
            </a>
			<? endwhile ?>
		</div>

	</div>

<? include "../block/footer.php"; ?>