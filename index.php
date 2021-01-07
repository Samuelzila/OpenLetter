<?php
include 'connexion.php';

//isRegistered
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

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>
index
</body>
</html>