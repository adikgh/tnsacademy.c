<? include "config/core.php";

	if (isset($_GET['c'])) header('location: /education/sign.php?id='.$_GET['c']);
	else header('location: /education/');

	$site_name = 'home';
?>
<? include "block/header.php"; ?>



<? include "block/footer.php"; ?>