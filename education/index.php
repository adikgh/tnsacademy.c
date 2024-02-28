<? include "../config/core.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: sign.php');
	else {
		if ($user_right) header('location: my/list.php');
		else header('location: my/');
	}