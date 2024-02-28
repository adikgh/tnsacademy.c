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
         <a class="btn btn_cl" href="/assets/uploads/lesson/<?=$sql['txt']?>" target="_blank"><i class="fal fa-folder-open"></i><span>Ашу</span></a>
         <a class="btn btn_cl" href="/assets/uploads/lesson/<?=$sql['txt']?>" download><i class="fal fa-cloud-download"></i><span>Жүктеп алу</span></a>
      </div>
   </div>
</div>