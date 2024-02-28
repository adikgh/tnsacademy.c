<? include "../../config/core.php"; ?>

   <!--  -->
   <? if (isset($_GET['view'])): ?>
		<? $id = strip_tags($_POST['id']); ?>
		<? $lesson_d = fun::lesson($id); ?>
		<? $course_d = fun::course($lesson_d['course_id']); ?>

        <div class="form_c">
            <div class="form_im">
               <div class="form_span">Cабақтың атауы:</div>
               <input type="text" class="form_txt lesson_edt_name" placeholder="Атауын жазыңыз" data-lenght="2" value="<?=$lesson_d['name_kz']?>">
               <i class="far fa-text form_icon"></i>
            </div>

            <? $li = db::query("select * from course_lesson_item where lesson_id = '$id' order by ins_dt desc"); ?>
            <? while ($li_d = mysqli_fetch_assoc($li)): ?>
               
                <? if ($li_d['type'] == 'video'): ?>
                    <div class="form_im">
                        <div class="form_span">Видеосы (<?=($li_d['number'])?>): (Yotube)</div>
                        <input type="url" class="form_txt lesson_edt_youtube" data-id="<?=$li_d['id']?>" placeholder="Сілтемесін салыңыз" data-lenght="1" value="<?=$li_d['txt']?>" />
                        <i class="fal fa-play form_icon"></i>
                    </div>
                <? elseif ($li_d['type'] == 'txt'): ?>
                    <div class="form_im">
                        <div class="form_span">Мәтіні (<?=($li_d['number'])?>):</div>
                        <textarea type="text" class="form_im_comment_aut lesson_edt_txt" data-id="<?=$li_d['id']?>" rows="5" autocomplete="off" autocorrect="off" aria-label="Мәтінді жазыңыз .." placeholder="Мәтінді жазыңыз .." >
                            <?=$li_d['txt']?>
                        </textarea>
                        <script>autosize(document.querySelectorAll('.form_im_comment_aut'));</script>
                    </div>
                <? endif ?>

            <? endwhile ?>

            <div class="form_im form_im_bn">
                <div class="btn btn_lesson_edit" data-id="<?=$id?>">Өңдеу</div>
            </div>
        </div>

		<? exit(); ?>
	<? endif ?>