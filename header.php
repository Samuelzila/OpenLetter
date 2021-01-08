<?php
//isLoggedIn
if (isset($_COOKIE['mail']) && isset($_COOKIE['password'])) {
	$isRegistered = $conn->query("SELECT COUNT(*) FROM user WHERE mail = '".$_COOKIE['mail']."' AND password = '".$_COOKIE['password']."'")->fetchColumn();
	if ($isRegistered == 0) {
		header('Location: login.php');
	}
}elseif (isset($_SESSION['mail']) && isset($_SESSION['password'])) {
	$isRegistered = $conn->query("SELECT COUNT(*) FROM user WHERE mail = '".$_SESSION['mail']."' AND password = '".$_SESSION['password']."'")->fetchColumn();
	if ($isRegistered == 0) {
		header('Location: login.php');
	}
}else{header('Location: login.php');}

//Log Out
if (isset($_POST['logout'])) {
	session_unset();
	session_destroy();
	setcookie('mail','unsetting',time()-1);
	setcookie('password','unsetting',time()-1);
	header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<!--Log Out button-->
<form method="post"><input type="submit" name="logout" value="Log Out"></form>
</body>
</html>
