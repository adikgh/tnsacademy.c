<? include "../../config/core.php";

	// 
	if(isset($_GET['add_item_photo'])) {
		$path = '../../assets/uploads/course/';
		$allow = array();
		$deny = array(
			'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 
			'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html', 
			'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi', 'exe'
		);
		$error = $success = '';
		$datetime = date('Ymd-His', time());

		if (!isset($_FILES['file'])) $error = 'Файлды жүктей алмады';
		else {
			$file = $_FILES['file'];
			if (!empty($file['error']) || empty($file['tmp_name'])) $error = 'Файлды жүктей алмады';
			elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) $error = 'Файлды жүктей алмады';
			else {
				$pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
				$name = mb_eregi_replace($pattern, '-', $file['name']);
				$name = mb_ereg_replace('[-]+', '-', $name);
				$parts = pathinfo($name);
				$name = $datetime.'-'.$name;

				if (empty($name) || empty($parts['extension'])) $error = 'Файлды жүктей алмады';
				elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) $error = 'Файлды жүктей алмады';
				elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) $error = 'Файлды жүктей алмады';
				else {
					if (move_uploaded_file($file['tmp_name'], $path . $name)) $success = '<p style="color: green">Файл «' . $name . '» успешно загружен.</p>';
					else $error = 'Файлды жүктей алмады';
				}
			}
		}
		
		if (!empty($error)) $error = '<p style="color:red">'.$error.'</p>';  
		
		$data = array(
			'error'   => $error,
			'success' => $success,
			'file' => $name,
		);
		
		header('Content-Type: application/json');
		echo json_encode($data, JSON_UNESCAPED_UNICODE);

		exit();
	}
	
	// 
	if(isset($_GET['item_add'])) {
		$name = @strip_tags($_POST['name']);
		$access = @strip_tags($_POST['access']);
		// $autor = @strip_tags($_POST['autor']);
		// $rates = @strip_tags($_POST['rates']);
		$img = @strip_tags($_POST['img']);
		$price = @strip_tags($_POST['price']);
		$price_sole = @strip_tags($_POST['price_sole']);
		$item = @strip_tags($_POST['item']);
		$assig = @strip_tags($_POST['assig']);
		$id = (mysqli_fetch_assoc(db::query("SELECT max(id) FROM `course`")))['max(id)'] + 1;
		$number = fun::course_next_number();

		$ins = db::query("INSERT INTO `course`(`id`, `number`, `name_kz`, `name_ru`) VALUES ('$id', '$number', '$name', '$name')");

		if ($access) $upd = db::query("UPDATE `course` SET `access`='$access' WHERE `id`='$id'");
		// if ($rates) $upd = db::query("UPDATE `course` SET `rates`='$rates' WHERE `id`='$id'");
		if ($img) $upd = db::query("UPDATE `course` SET `img`='$img' WHERE `id`='$id'");
		if ($price) $upd = db::query("UPDATE `course` SET `price`='$price' WHERE `id`='$id'");
		if ($price_sole) $upd = db::query("UPDATE `course` SET `price_sole`='$price_sole' WHERE `id`='$id'");
		if ($item || $assig) {
			$upd = db::query("UPDATE `course` SET `info`=1 WHERE `id`='$id'");
			$ins_info = db::query("INSERT INTO `course_info`(`course_id`) VALUES ('$id')");
			if ($item) $upd = db::query("UPDATE `course_info` SET `item`='$item' WHERE `course_id`='$id'");
			if ($assig) $upd = db::query("UPDATE `course_info` SET `assig`='$assig' WHERE `course_id`='$id'");
		}

		// echo $id;

		if ($ins) echo 'plus';
		exit();
	}

	// 
	if(isset($_GET['item_edit'])) {
		$id = @strip_tags($_POST['id']);
		$name = @strip_tags($_POST['name']);
		$access = @strip_tags($_POST['access']);
		$img = @strip_tags($_POST['img']);
		$price = @strip_tags($_POST['price']);
		$price_sole = @strip_tags($_POST['price_sole']);
		$item = @strip_tags($_POST['item']);
		$assig = @strip_tags($_POST['assig']);

		if ($name) $upd = db::query("UPDATE `course` SET `name_kz`='$name', `name_ru`='$name', `upd_dt`='$datetime' WHERE `id`='$id'");
		if ($access) $upd = db::query("UPDATE `course` SET `access`='$access', `upd_dt`='$datetime' WHERE `id`='$id'");
		if ($img) $upd = db::query("UPDATE `course` SET `img`='$img', `upd_dt`='$datetime' WHERE `id`='$id'");
		if ($price) $upd = db::query("UPDATE `course` SET `price`='$price', `upd_dt`='$datetime' WHERE `id`='$id'");
		if ($price_sole) $upd = db::query("UPDATE `course` SET `price_sole`='$price_sole', `upd_dt`='$datetime' WHERE `id`='$id'");
		if ($item || $assig) {
			$upd = db::query("UPDATE `course` SET `info`=1 WHERE `id`='$id'");
			if (mysqli_num_rows(db::query("SELECT * FROM `course_info` where course_id = '$id'")) == 0) $ins_info = db::query("INSERT INTO `cours_info`(`course_id`) VALUES ('$id')");
			if ($item) $upd = db::query("UPDATE `course_info` SET `item`='$item' WHERE `course_id`='$id'");
			if ($assig) $upd = db::query("UPDATE `course_info` SET `assig`='$assig' WHERE `course_id`='$id'");
		}

		echo 'plus';
		exit();
	}

	// 
	if(isset($_GET['cours_arh'])) {
		$id = @strip_tags($_POST['id']);
		$cours = fun::course($id);

		if (!$cours['arh']) $upd = db::query("UPDATE `course` SET `arh` = 1 WHERE `id` = '$id'");
		else $upd = db::query("UPDATE `course` SET `arh` = null WHERE `id` = '$id'");

		if ($upd) echo 'yes';
		exit();
	}

	// 
	if(isset($_GET['cours_del'])) {
		$id = strip_tags($_POST['id']);
		$del = db::query("DELETE FROM `course` WHERE `id` = '$id'");
		
		if ($del) echo 'yes';
		exit();
	}



	// 
	if(isset($_GET['block_add'])) {
		$name = @strip_tags($_POST['name']);
		$course_id = @strip_tags($_POST['course_id']);
		$item = @strip_tags($_POST['item']);
		$assig = @strip_tags($_POST['assig']);
		$number = fun::block_next_number($course_id);
		$id = (mysqli_fetch_assoc(db::query("SELECT max(id) FROM `course_block`")))['max(id)'] + 1;

		$ins = db::query("INSERT INTO `course_block`(`number`, `course_id`, `name_kz`, `name_ru`) VALUES ('$number', '$course_id', '$name', '$name')");

		if ($item) $upd = db::query("UPDATE `course_block` SET `item` = '$item' WHERE `id` = '$id'");
		if ($assig) $upd = db::query("UPDATE `course_block` SET `assig` = '$assig' WHERE `id` = '$id'");

		if ($ins) echo 'yes';
		exit();
	}


	// 
	if(isset($_GET['lesson_add'])) {
		$name = @strip_tags($_POST['name']);
		$course_id = @strip_tags($_POST['course_id']);
		$block_id = @strip_tags($_POST['block_id']);
		$open = @strip_tags($_POST['open']);
		$youtube = @strip_tags($_POST['youtube']);
		$txt = @strip_tags($_POST['txt']);
				
		if (!$block_id) {
			$course = fun::course($course_id);
			$cours_name_kz = $course['name_kz'];
			$cours_name_ru = $course['name_ru'];
			$block_id = (mysqli_fetch_assoc(db::query("SELECT max(id) FROM `course_block`")))['max(id)'] + 1;
			$ins_block = db::query("INSERT INTO `course_block`(`number`, `course_id`, `name_kz`, `name_ru`) VALUES (1, '$course_id', '$cours_name_kz', '$cours_name_ru')");
		}
		
		$id = (mysqli_fetch_assoc(db::query("SELECT max(id) FROM `course_lesson`")))['max(id)'] + 1;
		$number = fun::lesson_next_number($block_id);
		$ins = db::query("INSERT INTO `course_lesson`(`course_id`, `block_id`, `number`, `name_kz`, `name_ru`, `open`) VALUES ('$course_id', '$block_id', '$number', '$name', '$name', '$open')");


		if ($youtube) $ins_li = db::query("INSERT INTO `course_lesson_item`(`lesson_id`, `number`, `type`, `type_name`, `type_video`, `txt`) VALUES ('$id', 1, 'video', 'Видео сабақ', 'youtube', '$youtube')");
		if ($txt) $ins_li = db::query("INSERT INTO `course_lesson_item`(`lesson_id`, `number`, `type`, `txt`) VALUES ('$id', 2, 'txt', '$txt')");
		
		if ($ins) echo 'yes';
		exit();
	}


