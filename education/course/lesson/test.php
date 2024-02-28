<? $test_id = $sql['test_id']; ?>
<? $test = db::query("select * from test_item where id = '$test_id'"); ?>
<? $test_d = mysqli_fetch_assoc($test); ?>
<? $test_answer = db::query("select * from test_answer where user_id = '$user_id' and test_id = '$test_id' and lesson_id = '$lesson_id'"); ?>
<? if (mysqli_num_rows($test_answer)): ?>
   <? $test_answer_d = mysqli_fetch_assoc($test_answer); ?>
   <div class="lsb_i <?=(($sql['number']>$sub_info_d['lesson_stage'] && $lesson_d['type']==1)?'dsp_n':'')?> <?=(($sql['number']<$sub_info_d['lesson_stage'])?'lsb_act':'')?>" data-number="<?=$sql['number']?>" data-type="<?=$sql['type']?>">
      <div class="lsb_ic">
         <div class="lsb_it_name"><?=$test_d['name']?></div>
         <div class="form_im">
            <div class="form_radio <?=($test_answer_d['v']==1?'form_radio_act':'')?> <?=($test_d['answer']==1?'form_radio_true':'')?> <?=(($test_answer_d['answer']==0 && $test_answer_d['v']==1)?'form_radio_false':'')?> "><?=$test_d['v1']?></div>
            <div class="form_radio <?=($test_answer_d['v']==2?'form_radio_act':'')?> <?=($test_d['answer']==2?'form_radio_true':'')?> <?=(($test_answer_d['answer']==0 && $test_answer_d['v']==2)?'form_radio_false':'')?> "><?=$test_d['v2']?></div>
         </div>
      </div>
   </div>
<? else: ?>
   <div class="lsb_i <?=(($sql['number']>$sub_info_d['lesson_stage'] && $lesson_d['type']==1)?'dsp_n':'')?> <?=(($sql['number']<$sub_info_d['lesson_stage'])?'lsb_act':'')?>" data-number="<?=$sql['number']?>" data-type="<?=$sql['type']?>">
      <div class="lsb_ic">
         <div class="lsb_it_name"><?=$test_d['name']?></div>
         <div class="form_im" data-sel="0" data-test-id="<?=$test_d['id']?>" data-lesson-id="<?=$lesson_id?>">
            <div class="form_radio rad1 <?=($test_d['answer']==1?'answer':'')?>" data-val="1"><?=$test_d['v1']?></div>
            <div class="form_radio rad1 <?=($test_d['answer']==2?'answer':'')?>"  data-val="2"><?=$test_d['v2']?></div>
         </div>
      </div>
   </div>
<? endif ?>