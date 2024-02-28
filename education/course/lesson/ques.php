<? $ques = db::query("select * from ques where lesson_id = '$lesson_id' and user_id = $user_id"); ?>
<? if (!mysqli_num_rows($ques)): ?>
   <div class="lsb_i lsb_i_home">
      <div class="lsb_ic">
         <div class="lsb_ih">Пікір қалдыру:</div>
         <div class="form_im">
            <i class="fal fa-comment-lines form_icon"></i>
            <textarea class="form_txt inp_form"></textarea>
         </div>
         <div class="form_im">
            <div class="btn btn_cl btn_add_ques" data-cours-id="<?=$cours_id?>" data-pack-id="<?=$pack_id?>" data-lesson-id="<?=$lesson_id?>">Жіберу</div>
         </div>
      </div>
   </div>
<? else: ?>
   <div class="lsb_i_home">
      <div class="lsb_ic">
         <div class="lsb_ih">Cіздің жазбаларыңыз:</div>
         <? while ($ques_d = mysqli_fetch_array($ques)): ?>
            <div class="lsb_i_home_i">
               <p><?=$ques_d['txt']?></p>
            </div>
         <? endwhile ?>
      </div>
   </div>
<? endif ?>