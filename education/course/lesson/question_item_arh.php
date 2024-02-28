<? if (mysqli_num_rows($question_answer_item)): ?>
   <? $question_answer_item_d = mysqli_fetch_assoc($question_answer_item); ?>
   <!-- <div class="question_cn">
      <span>Сіздің жауабыңыз:</span>
      <p> - <?=($question_answer_item_d['answer']==1?'ИЯ':'ЖОҚ')?></p>
   </div> -->
   <div class="form_im" data-sel="0" data-question-id="<?=$question_item_id?>" data-lesson-id="<?=$lesson_id?>" data-open-lesson-id="<?=$sql['txt']?>">
      <div class="form_radio question_56 <?=($question_answer_item_d['answer']==1?'form_radio_act':'')?>" data-val="1">ИЯ</div>
      <div class="form_radio question_56 <?=($question_answer_item_d['answer']==2?'form_radio_act':'')?>" data-val="2">ЖОҚ</div>
   </div>
<? else: ?>
   <div class="form_im" data-sel="0" data-question-id="<?=$question_item_id?>" data-lesson-id="<?=$lesson_id?>" data-open-lesson-id="<?=$sql['txt']?>">
      <div class="form_radio question_56" data-val="1">ИЯ</div>
      <div class="form_radio question_56" data-val="2">ЖОҚ</div>
   </div>
<? endif ?>