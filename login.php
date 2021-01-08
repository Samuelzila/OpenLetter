<?php
include 'connexion.php';

function cookieCreate(){
	setcookie('mail',$_POST['mail'], time() + 86400 *30);
	setcookie('password',$_POST['password'], time() + 86400 *30);
}

//already logged in ?
if (isset($_COOKIE['mail']) && isset($_COOKIE['password'])) {
	$userexist = $conn->query("SELECT COUNT(*) FROM user WHERE mail = '".$_COOKIE['mail']."' AND password = '".$_COOKIE['password']."'")->fetchColumn();
	if ($userexist == 1) {
		header('Location: index.php');
	}
}elseif (isset($_SESSION['mail']) && isset($_SESSION['password'])) {
	$userexist = $conn->query("SELECT COUNT(*) FROM user WHERE mail = '".$_SESSION['mail']."' AND password = '".$_SESSION['password']."'")->fetchColumn();
	if ($userexist == 1) {
		header('Location: index.php');
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
</head>
<body>
login
<form method="post">
	<input type="text" name="mail" placeholder="e-mail">
	<input type="password" name="password" placeholder="Password">
	<input type="submit" name="submit" value="Log in">
	<input type="checkbox" name="remember">
	<label for="remember">Remember me</label>
<?php
//Log in
if (isset($_POST['submit'])) {
	if (!empty($_POST['mail']) && !empty($_POST['password'])) {
		$userexist = $conn->query("SELECT COUNT(*) FROM user WHERE mail = '".$_POST['mail']."' AND password = '".$_POST['password']."'")->fetchColumn();
		if ($userexist == 1) {
			if (isset($_POST['remember'])){
				cookieCreate();
			}else{
				$_SESSION['mail'] = $_POST['mail'];
				$_SESSION['password'] = $_POST['password'];
			}
			header('Location: index.php');
		}else{echo 'Wrong e-mail or password.';}
	}else{echo "Please fill all entries.";}
}
?>
</form>
<a href="signin.php">»Sign In«</a>
</body>
</html>