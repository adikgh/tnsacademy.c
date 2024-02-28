<div class="lsb_i <?=(($sql['number']>$sub_info_d['lesson_stage'] && $lesson_d['type']==1)?'dsp_n':'')?> <?=(($sql['number']<$sub_info_d['lesson_stage'])?'lsb_act':'')?>" data-number="<?=$sql['number']?>" data-type="<?=$sql['type']?>">
   <div class="lsb_ic">
      <div class="lsb_i2">
         <div class="lsb_i2_l"><?=$sql['icon']?></div>
         <div class="lsb_i2_r">
            <div class="lsb_ih2"><span><?=$sql['type_name']?>:</span></div>
            <div class="lsb_ih3"><?=$sql['txt']?></div>
         </div>
      </div>
      <div class="lsb_i3">
         <a class="btn btn_cl" href="<?=$sql['txt']?>" target="_blank"><span>Қосылу</span><i class="fal fa-long-arrow-right"></i></a>
      </div>
   </div>
</div>