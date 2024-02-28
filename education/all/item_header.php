<div class="uitemc_info">
   <div class="bl_c">
      <div class="uitemc_info_c">

         <div class="uitemci_r">
            <div class="lazy_img" data-src="/assets/img/cours/<?=$cours['img']?>"></div>
         </div>

         <div class="uitemci_l">

            <div class="uitemci_ll">
               <div class="uitemci_c"><?=$category['name']?></div>
               <h3 class="uitemci_h"><?=$cours['name']?></h3>
               <div class="uitemci_ad">
                  <div class="uitemci_ad_i lazy_img" data-src="/assets/img/users/<?=$autor['logo']?>"></div>
                  <div class="uitemci_ad_t"><?=$autor['name']?> <?=$autor['surname']?></div>
               </div>
            </div>

            <!-- <div class="itemci_ls">
               <div class="itemci_lsi">
                  <div class="itemci_lsic"><i class="far fa-clock"></i></div>
                  <div class="itemci_lsin">
                     <span>Сабақ уақыты</span>
                     <p>10 күн, 3 сағ.</p>
                  </div>
               </div>
               <div class="itemci_lsi">
                  <div class="itemci_lsic"><i class="far fa-users"></i></div>
                  <div class="itemci_lsin">
                     <span>Оқушылар</span>
                     <p>200+</p>
                  </div>
               </div>
            </div> -->
            
            <!-- <div class="uitemci_lr">
               <div class="bq3_ci_book <?=($bookmark?'bq3_ci_book_act':'')?>" data-id="<?=$cours['id']?>">
                  <div class="btn btn_back btn_dd">
                     <i class="far <?=($bookmark?'fas':'')?> fa-bookmark"></i>
                  </div>
               </div>
               <div class="uitemci_lri" data-id="<?=$cours['id']?>">
                  <div class="btn btn_back btn_dd">
                     <i class="far fa-paper-plane"></i>
                  </div>
               </div>
            </div> -->

         </div>

      </div>
   </div>
</div>


<?php if ($menu_name != 'lesson'): ?>
   <div class="uitemc_um">
      <div class="bl_c">
         <div class="uitemc_umc swiper swiper_catalog">
            <div class="swiper-wrapper">
               <!-- <a class="swiper-slide uitemc_umi <?=($pod_menu_name=='info'?'uitemc_umi_act':'')?>" href="/u/i/info.php?id=<?=$cours_id?>">Мәлімет</a> -->
   
               <a class="swiper-slide uitemc_umi <?=($pod_menu_name=='lesson'?'uitemc_umi_act':'')?>" href="/u/i/?id=<?=$cours_id?>">Сабақтар</a>
               <a class="swiper-slide uitemc_umi <?=($pod_menu_name=='reviews'?'uitemc_umi_act':'')?>" href="/u/i/reviews.php?id=<?=$cours_id?>">Пікірлер</a>

               <? if ($menu_name == 'item'): ?>
                  <?php if ((mysqli_num_rows($sub) == 1 && $user_right != 1) || (mysqli_num_rows($pack) == 1 && $user_right == 1)): ?>
                     <!-- <a class="swiper-slide uitemc_umi <?=($pod_menu_name=='lesson'?'uitemc_umi_act':'')?>" href="/u/i/?id=<?=$cours_id?>">Сабақтар</a> -->
                  <?php else: ?>
                     <!-- <a class="swiper-slide uitemc_umi <?=($pod_menu_name=='lesson'?'uitemc_umi_act':'')?>" href="/u/i/?id=<?=$cours_id?>">Пакеттер</a> -->
                  <?php endif ?>
               <? elseif ($menu_name == 'pack'): ?>
                  <!-- <a class="swiper-slide uitemc_umi <?=($pod_menu_name=='lesson'?'uitemc_umi_act':'')?>" href="/u/i/?id=<?=$cours_id?>">Сабақтар</a> -->
               <? endif ?>
   
               <!-- <a class="swiper-slide uitemc_umi <?=($pod_menu_name=='quiz'?'uitemc_umi_act':'')?>" href="/u/i/quiz.php?id=<?=$cours_id?>">Cұрақ-жауап</a> -->
   
               <?php if ($user_right == 1): ?>
                  <?php if ($cours['home_work']): ?>
                     <!-- <a class="swiper-slide uitemc_umi <?=($pod_menu_name=='work'?'uitemc_umi_act':'')?>" href="/u/i/ahomework.php?id=<?=$cours_id?>">Үй жұмысы</a> -->
                  <?php endif ?>
                  
                  <? if ($menu_name == 'item'): ?>
                     <a class="swiper-slide uitemc_umi <?=($pod_menu_name=='users'?'uitemc_umi_act':'')?>" href="/u/i/users.php?id=<?=$cours_id?>">Оқушылар</a>
                  <? elseif ($menu_name == 'pack'): ?>
                     <a class="swiper-slide uitemc_umi <?=($pod_menu_name=='users'?'uitemc_umi_act':'')?>" href="/u/p/users.php?id=<?=$pack_id?>">Оқушылар</a>
                  <? endif ?>
   
                  <!-- <a class="swiper-slide uitemc_umi <?=($pod_menu_name=='setting'?'uitemc_umi_act':'')?>" href="/u/i/setting.php?id=<?=$cours_id?>">Баптаулар</a> -->
                  <!-- <a class="swiper-slide uitemc_umi <?=($pod_menu_name=='analytics'?'uitemc_umi_act':'')?>" href="/u/i/analytics.php?id=<?=$cours_id?>">Аналитика</a> -->
               <?php endif ?>

            </div>
            <div class="swiper-button-prev1 swiper-button-prev"><i class="fal fa-chevron-left"></i></div>
            <div class="swiper-button-next1 swiper-button-next"><i class="fal fa-chevron-right"></i></div>
         </div>
      </div>
   </div>
<?php endif ?>