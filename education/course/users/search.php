<? include "../../../config/core.php"; ?>

   <!--  -->
   <? if (isset($_GET['user_search'])): ?>
		<? $search = strip_tags($_POST['result']); ?>
		<? $cours_id = strip_tags($_POST['id']); ?>

		<? $user = db::query("select * from user where (phone like '%$search%') or (mail like '%$search%') or (name like '%$search%') or (surname like '%$search%') order by ins_dt desc"); ?>
      <? while ($user_d = mysqli_fetch_assoc($user)): ?>
         <? $userd_id = $user_d['id']; ?>
         <? $sub = db::query("select * from course_pay where course_id = '$cours_id' and user_id = '$userd_id'"); ?>
         <? if (mysqli_num_rows($sub) > 0 && $number < 50): ?>
            <? $sub_d = mysqli_fetch_assoc($sub); ?>
            <? $number++; ?>

            <div class="uc_ui">
               <div class="uc_uil">
                  <div class="uc_ui_number"><?=$number?></div>
                  <div class="uc_ui_right">
                     <div class="form_im form_im_toggle">
                        <input type="checkbox" class="homework" data-val="" />
                        <div class="form_im_toggle_btn <?=($user_d['locked']?'':'form_im_toggle_act')?>"></div>
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
                     <?	if (($access - $result) < 0) $precent = 0; elseif (($access - $result) < $access) $precent = round(100 / ($access / ($access - $result))); else $precent = 100; ?>
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
         <? endif ?>
      <? endwhile ?>
		<? exit(); ?>
	<? endif ?>