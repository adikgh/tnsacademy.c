<? include "../../../config/core.php";

   // time
	$ins_dt = $datetime;
	$end_dt = date('Y-m-d H:i:s', strtotime("$datetime +2 month"));

	// add user
	if(isset($_GET['add_user'])) {
		$phone = strip_tags($_POST['phone']);
		$cours_id = strip_tags($_POST['cours_id']);
		
		$cours = fun::course($cours_id);
		$cours_name = $cours['name_'.$lang];
		$days = $cours['access'];
		$end_dt = date('Y-m-d H:i:s', strtotime("$datetime +$days day"));
		$mess = "Cізге $cours_name курсына доступ ашылды. Сілтеме: https://moldiracademy.kz/?c=$cours_id";
		$mess2 = "Cізге $cours_name курсына доступ ашылды.\nТіркелген нөміріңіз: $phone\nСілтеме: https://moldiracademy.kz/?c=$cours_id";

		$user = db::query("SELECT * FROM `user` WHERE phone = '$phone'");
		if (mysqli_num_rows($user)) {
			$user_d = mysqli_fetch_assoc($user);
			$user_id = $user_d['id'];
			$code = $user_d['code'];
			$sub = db::query("SELECT * FROM `course_pay` WHERE user_id = '$user_id' and course_id = '$cours_id'");
			if (mysqli_num_rows($sub) == 0) {
				if (get_balance() > 50) $sms_send = list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess, 0, 0, 0, 0, false);
				if ($sms_send[1] <= 4 || get_balance() > 50) {
					$ins = db::query("INSERT INTO `course_pay`(`course_id`, `user_id`, `end_dt`) VALUES ('$cours_id', '$user_id', '$end_dt')");
					if ($ins) echo 'add'; else echo 'error';
				} else echo 'error';
			} else echo 'yes';
		} else {
			if (get_balance() > 50) $user_ins = db::query("INSERT INTO `user`(`phone`) VALUES ('$phone')");
			else $user_ins = db::query("INSERT INTO `user`(`phone`, `password`) VALUES ('$phone', '123456')");
			if ($user_ins) {
				$user_d = mysqli_fetch_assoc(db::query("SELECT * FROM `user` WHERE phone = '$phone'"));
				$user_id = $user_d['id'];
				if (get_balance() > 50) $sms_send = list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess2, 0, 0, 0, 0, false);
				if ($sms_send[1] <= 4 || get_balance() > 50) {
					$ins = db::query("INSERT INTO `course_pay`(`course_id`, `user_id`, `end_dt`) VALUES ('$cours_id', '$user_id', '$end_dt')");
					if ($ins) echo 'add'; else echo 'error';
				} else echo 'error';
			} else echo 'error';
		}
		exit();
	}

	// add user mail
	if(isset($_GET['add_mail'])) {
		$mail = strip_tags($_POST['mail']);
		$cours_id = strip_tags($_POST['cours_id']);
		
		$cours = fun::course($cours_id);
		$cours_name = $cours['name_'.$lang];
		$days = $cours['access'];
		$end_dt = date('Y-m-d H:i:s', strtotime("$datetime +$days day"));
		$mess = "Cізге $cours_name курсына доступ ашылды. Сілтеме: https://moldiracademy.kz/?c=$cours_id";
		$mess2 = "Cізге $cours_name курсына доступ ашылды.\nТіркелген почтаңыз: $phone\nСілтеме: https://moldiracademy.kz/?c=$cours_id";

		$user = db::query("SELECT * FROM `user` WHERE mail = '$mail'");
		if (mysqli_num_rows($user) != 0) {
			$user_d = mysqli_fetch_assoc($user);
			$user_id = $user_d['id'];
			$code = $user_d['code'];

			$sub = db::query("SELECT * FROM `course_pay` WHERE user_id = '$user_id' and course_id = '$cours_id'");
			if (mysqli_num_rows($sub) == 0) {
				db::query("INSERT INTO `course_pay`(`course_id`, `user_id`, `end_dt`) VALUES ('$cours_id', '$user_id', '$end_dt')");
				fun::send_mail($mail, $mess);
				echo 'add';
			} else echo 'yes';
		} else {
			$sql = db::query("INSERT INTO `user`(`mail`) VALUES ('$mail')");
			if ($sql) {
				$user_d = mysqli_fetch_assoc(db::query("SELECT * FROM `user` WHERE mail = '$mail'"));
				$user_id = $user_d['id'];
				db::query("INSERT INTO `course_pay`(`course_id`, `user_id`, `end_dt`) VALUES ('$cours_id', '$user_id', '$end_dt')");
				fun::send_mail($mail, $mess2);
				echo 'add';
			}
		}
		exit();
	}


	// user delete
	if(isset($_GET['user_del'])) {
		$id = strip_tags($_POST['id']);
		$sub = db::query("delete FROM `course_pay` WHERE id = '$id'");
		echo 'yes';
		exit();
	}

	// user_access_on
	if(isset($_GET['user_access_on'])) {
		$id = strip_tags($_POST['id']);
		$sub = db::query("UPDATE `course_pay` SET `status_id`='1' WHERE id = '$id'");
		echo 'yes';
		exit();
	}

	// pass_resert
	if(isset($_GET['pass_resert'])) {

		$id = strip_tags($_POST['id']);

		$ubd = db::query("UPDATE `user` SET `password` = '123456' WHERE id = '$id'");
		if ($ubd) echo 'yes'; else echo 'error';

		exit();
	}



	// sms_send
	if(isset($_GET['sms_send'])) {

		$id = strip_tags($_POST['id']);
		
		$sub_d = fun::course_pay($id);
		$ud = fun::user($sub_d['user_id']);
		$phone = $ud['phone'];
		
		$course_d = fun::course($sub_d['course_id']);
		$course_id = $sub_d['course_id'];
		$course_name = $course_d['name_kz'];

		$mess = "Cізге $course_name курсына доступ ашылды.\nТіркелген нөміріңіз: $phone\nСілтеме: https://moldiracademy.kz/?c=$course_id";

		$sms_send = list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess, 0, 0, 0, 0, false);
		if ($sms_send[1] <= 4 || get_balance() > 50) echo 'yes'; else echo 'error';

		exit();
	}


	// sms_send_all
	// if(isset($_GET['sms_send_all'])) {

	// 	$cours_id = strip_tags($_POST['cours_id']);
	// 	$sub = db::query("SELECT * FROM `cours_sub` WHERE cours_id = '$cours_id'");
	// 	while ($sub_date = mysqli_fetch_assoc($sub)) {

	// 		$user_id = $sub_date['user_id'];
	// 		$user = db::query("SELECT * FROM `user` WHERE id = '$user_id'");
	// 		$user_date = mysqli_fetch_assoc($user);
	// 		$phone = $user_date['phone'];
	// 		$code = $user_date['code'];
	
	// 		$mess = "Иммунити курсы.\nТексеру коды: $code\nСілтеме: https://aruacademy.kz/?c=$cours_id";
	// 		list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess, 0, 0, 0, 0, false);

	// 	}
	// 	echo 'yes';

	// 	exit();
	// }