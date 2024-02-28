<div class="">
   <? $home_work = db::query("select * from home_work where lesson_id = '$lesson_id' and user_id = $user_id"); ?>
   <? if (!mysqli_num_rows($home_work)): ?>
      <div class="lsbi_home <?=(($data_number>$sub_info_d['lesson_stage'] && $lesson_d['type']==1)?'dsp_n':'')?>" data-number="<?=$data_number?>" data-type="home_work">
         <div class="lsbi_home_head">Үй жұмысын орындау:</div>
         <div class="lsbi_homec">
            <div class="form_im">
               <i class="fal fa-comment-lines form_icon"></i>
               <textarea class="form_txt inp_hm"></textarea>
            </div>
            <div class="form_im">
               <div class="btn btn_cm btn_hw" data-cours-id="<?=$cours_id?>" data-pack-id="<?=$pack_id?>" data-lesson-id="<?=$lesson_id?>">Жіберу</div>
            </div>
         </div>
      </div>
   <? else: ?>
      <? $home_work_d = mysqli_fetch_array($home_work); $work_id = $home_work_d['id']; ?>
      <? $works = db::query("select * from home_work_item where work_id = '$work_id'"); ?>
      <div class="lsb_i_home">
         <div class="lsb_ic">
            <div class="lsb_ih">Cіздің үй жұмыстарыңыз:</div>
            <? while ($works_d = mysqli_fetch_array($works)): ?>
               <div class="lsb_i_home_i">
                  <p><?=$works_d['txt']?></p>
               </div>
            <? endwhile ?>
         </div>
      </div>

      <br><br><br><br>
   <? endif ?>
</div>