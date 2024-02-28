<? $question_item_id = $sql['question_item_id']; ?>
<? $question_item = db::query("select * from question_item where id = '$question_item_id'"); ?>
<? $question_item_d = mysqli_fetch_assoc($question_item); ?>

<? $question_answer_item = db::query("select * from question_answer_item where user_id = '$user_id' and question_item_id = '$question_item_id' and lesson_id = $lesson_id"); ?>
<div class="lsb_i " data-number="<?=$sql['number']?>" data-type="<?=$sql['type']?>">
   <div class="lsb_ic">
      <div class="lsb_it_name"><?=$question_item_d['name']?></div>

      <? if (mysqli_num_rows($question_answer_item)): ?>
         <? $question_answer_item_d = mysqli_fetch_assoc($question_answer_item); ?>
      <? endif ?>

      <div class="form_c">
         <div class="form_im form_btn">
            <div class="form_btn_c" data-question-id="<?=$question_item_id?>" data-lesson-id="<?=$lesson_id?>" data-open-lesson-id="<?=$sql['txt']?>">
               <div class="form_btn_i question_56 <?=($question_answer_item_d['answer']==1?'form_btn_act':'')?>" data-val="1">
                  <i class="fal fa-check-circle"></i>
                  <span>ИЯ</span>
               </div>
               <div class="form_btn_i question_56 <?=($question_answer_item_d['answer']==2?'form_btn_act':'')?>" data-val="2">
                  <i class="fal fa-times-circle"></i>
                  <span>ЖОК</span>
               </div>
            </div>
         </div>
      </div>


   </div>
</div>