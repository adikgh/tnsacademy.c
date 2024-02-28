<? 

	class fun {
		
		function __construct() {}

		// course
		public static function course($id) {
			$sql = db::query("select * from course where id = '$id'");
			if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return null;
		}
		public static function course_info($id) {
			$sql = db::query("select * from course_info where course_id = '$id'");
			if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return null;
		}


		// pack
		public static function pack($id) {
			$sql = db::query("select * from course_pack where id = '$id'");
			$sql = mysqli_fetch_array($sql);
			return $sql['course_id'];
		}
		public static function pack_next_number($id) {
			$sql = db::query("select * from course_pack where course_id = '$id' order by number desc limit 1");
			if (mysqli_num_rows($sql)) return (mysqli_fetch_array($sql))['number'] + 1; else return 1;
		}


		// block
		public static function block($id) {
			$sql = db::query("select * from course_block where id = '$id'");
			$sql = mysqli_fetch_array($sql);
			return $sql['course_id'];
		}
		public static function block_next_number($id, $pid) {
			if ($pid) $sql = db::query("select * from course_block where pack_id = '$pid' order by number desc limit 1"); 
			else $sql = db::query("select * from course_block where course_id = '$id' order by number desc limit 1");
			if (mysqli_num_rows($sql)) return (mysqli_fetch_array($sql))['number'] + 1; else return 1;
		}


		// lesson
		public static function lesson($id) {
			$sql = db::query("select * from course_lesson where id = '$id'");
			$sql = mysqli_fetch_array($sql);
			return $sql;
		}
		public static function lesson_next_number($id) {
			$sql = db::query("select * from course_lesson where block_id = '$id' order by number desc limit 1");
			if (mysqli_num_rows($sql)) return (mysqli_fetch_array($sql))['number'] + 1; else return 1;
		}
		




		// pay
		public static function course_pay($id) {
			$sql = db::query("select * from course_pay where id = '$id'");
			$sql = mysqli_fetch_array($sql);
			return $sql;
		}
		public static function pay($id, $u_id) {
			$sql = db::query("select * from course_pay where course_id = '$id' and user_id = '$u_id'");
			if (mysqli_num_rows($sql)) return 1; else return 0;
		}
		// 
		public static function pay_lesson($id) {
			$user_id = core::$user_data['id'];
			$sql = db::query("select * from course_pay_lesson where pack_item_id = '$id' and user_id = '$user_id'");
			$sql = mysqli_fetch_array($sql);
			return $sql;
		}



		// user
		public static function user($id) {
			$sql = db::query("select * from user where id = '$id'");
			$sql = mysqli_fetch_array($sql);
			return $sql;
		}



		








		// mall send
		public static function send_mail($mail, $txt) {
			$from = "info@moldiracademy.kz";
			$subject = "Dr. Moldir";
			$headers = "From:" . $from. "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8";
			$mess = "<html>
							<head><title>$subject</title></head>
							<body>
								<div><b>$txt<b></div>
							</body>
						</html>";
			return mail($mail, $subject, $mess, $headers);
		}







		
		
	}