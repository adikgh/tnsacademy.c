<? include "../../config/core.php";

   // http://moldirac.c/education/course/copy.php?id=8

	if (isset($_GET['id']) || $_GET['id'] != '') {
		$course_id = $_GET['id'];
		$course = db::query("select * from course where id = '$course_id'");
		if (mysqli_num_rows($course)) {
			$course_d = mysqli_fetch_assoc($course);

         $new_course_id = (mysqli_fetch_assoc(db::query("SELECT max(id) FROM `course`")))['max(id)'] + 1;
         $ncourse_number = (mysqli_fetch_assoc(db::query("SELECT max(number) FROM `course`")))['max(number)'] + 1;
         $ncourse_name = $course_d['name_kz'].' - көшірме';
         $ncourse_access = $course_d['access'];
         $ncourse_price = $course_d['price'];
         $ncourse_price_sole = $course_d['price_sole'];
         $ncourse_img = $course_d['img'];
         $ncourse_open_type = $course_d['open_type'];
         $ncourse_open_days = $course_d['open_days'];
         $ncourse_open_start = $course_d['open_start'];
         // $ncourse_info = $course_d['info'];
         
         $ins_item = db::query("INSERT INTO `course`(`id`, `number`, `name_kz`, `access`) VALUES ('$new_course_id', '$ncourse_number', '$ncourse_name', '$ncourse_access')");
         if ($ncourse_price) $upd_item = db::query("UPDATE `course` SET `price` = '$ncourse_price' WHERE id = '$new_block_id'");
         if ($ncourse_price_sole) $upd_item = db::query("UPDATE `course` SET `price_sole` = '$ncourse_price_sole' WHERE id = '$new_course_id'");
         if ($ncourse_img) $upd_item = db::query("UPDATE `course` SET `img` = '$ncourse_img' WHERE id = '$new_course_id'");
         if ($ncourse_open_type) $upd_item = db::query("UPDATE `course` SET `open_type` = '$ncourse_open_type' WHERE id = '$new_course_id'");
         if ($ncourse_open_days) $upd_item = db::query("UPDATE `course` SET `open_days` = '$ncourse_open_days' WHERE id = '$new_course_id'");
         if ($ncourse_open_start) $upd_item = db::query("UPDATE `course` SET `open_start` = '$ncourse_open_start' WHERE id = '$new_course_id'");
         // if ($ncourse_info) $upd_item = db::query("UPDATE `course` SET `info` = '$ncourse_info' WHERE id = '$new_course_id'");

			// if ($course_d['info']) $course_info = fun::course_info($course_d['id']);

         $block = db::query("select * from course_block where course_id = '$course_id' order by number asc");
         if (mysqli_num_rows($block)) {
            while ($block_d = mysqli_fetch_assoc($block)) {
               $block_id = $block_d['id'];

               $new_block_id = (mysqli_fetch_assoc(db::query("SELECT max(id) FROM `course_block`")))['max(id)'] + 1;
               $nblock_number = $block_d['number'];
               $nblock_name = $block_d['name_kz'];
               $nblock_type = $block_d['type'];
               $nblock_item = $block_d['item'];
               $nblock_question = $block_d['question'];

               $ins_item = db::query("INSERT INTO `course_block`(`id`, `course_id`, `number`, `name_kz`) VALUES ('$new_block_id', '$new_course_id', '$nblock_number', '$nblock_name')");
               if ($nblock_type) $upd_item = db::query("UPDATE `course_block` SET `type` = '$nblock_type' WHERE id = '$new_block_id'");
               if ($nblock_item) $upd_item = db::query("UPDATE `course_block` SET `item` = '$nblock_item' WHERE id = '$new_block_id'");
               if ($nblock_question) $upd_item = db::query("UPDATE `course_block` SET `question` = '$nblock_question' WHERE id = '$new_block_id'");

               $lesson = db::query("select * from course_lesson where block_id = '$block_id' order by number asc");
               if (mysqli_num_rows($lesson)) {
                  while ($lesson_d = mysqli_fetch_assoc($lesson)) {
                     $lesson_id = $lesson_d['id'];

                     $new_lesson_id = (mysqli_fetch_assoc(db::query("SELECT max(id) FROM `course_lesson`")))['max(id)'] + 1;
                     $nlesson_number = $lesson_d['number'];
                     $nlesson_name = $lesson_d['name_kz'];
                     $nlesson_open = $lesson_d['open'];
                     $nlesson_arh = $lesson_d['arh'];

                     $ins_item = db::query("INSERT INTO `course_lesson`(`id`, `course_id`, `block_id`, `number`, `name_kz`) VALUES ('$new_lesson_id', '$new_course_id', '$new_block_id', '$nlesson_number', '$nlesson_name')");
                     if ($nlesson_open) $upd_item = db::query("UPDATE `course_lesson` SET `open` = '$nlesson_open' WHERE id = '$new_lesson_id'");
                     if ($nlesson_arh) $upd_item = db::query("UPDATE `course_lesson` SET `arh` = '$nlesson_arh' WHERE id = '$new_lesson_id'");

                     $item = db::query("select * from course_lesson_item where lesson_id = '$lesson_id' order by number asc");
                     if (mysqli_num_rows($item)) {
                        while ($item_d = mysqli_fetch_assoc($item)) {

                           $new_item_id = (mysqli_fetch_assoc(db::query("SELECT max(id) FROM `course_lesson_item`")))['max(id)'] + 1;
                           $nitem_number = $item_d['number'];
                           $nitem_type = $item_d['type'];
                           $nitem_type_name = $item_d['type_name'];
                           $nitem_type_video = $item_d['type_video'];
                           $nitem_txt = $item_d['txt'];
                           $nitem_question_id = $item_d['question_id'];
                           $nitem_question_item_id = $item_d['question_item_id'];

                           $ins_item = db::query("INSERT INTO `course_lesson_item`(`id`, `lesson_id`, `number`, `type`) VALUES ('$new_item_id', '$new_lesson_id', '$nitem_number', '$nitem_type')");
                           if ($nitem_type_name) $upd_item = db::query("UPDATE `course_lesson_item` SET `type_name` = '$nitem_type_name' WHERE id = '$new_item_id'");
                           if ($nitem_type_video) $upd_item = db::query("UPDATE `course_lesson_item` SET `type_video` = '$nitem_type_video' WHERE id = '$new_item_id'");
                           if ($nitem_txt) $upd_item = db::query("UPDATE `course_lesson_item` SET `txt` = '$nitem_txt' WHERE id = '$new_item_id'");
                           if ($nitem_question_id) $upd_item = db::query("UPDATE `course_lesson_item` SET `question_id` = '$nitem_question_id' WHERE id = '$new_item_id'");
                           if ($nitem_question_item_id) $upd_item = db::query("UPDATE `course_lesson_item` SET `question_item_id` = '$nitem_question_item_id' WHERE id = '$new_item_id'");

                        }
                     }

                  }
               }

            }
         }
         
		}
	}