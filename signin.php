<?php
include 'connexion.php';

//Create Session variables
$mail = htmlspecialchars(strtolower($_POST['mail']));
$username = htmlspecialchars($_POST['username']);
$userid = htmlspecialchars($_POST['userid']);
$password = md5(htmlspecialchars($_POST['password']));
$passwordconfirm = md5(htmlspecialchars($_POST['passwordconfirm']));

$_SESSION['formmail'] = $mail;
$_SESSION['formuserid'] = $userid;
$_SESSION['formusername'] = $username;
$_SESSION['formpassword'] = $password;
$_SESSION['formpasswordconfirm'] = $passwordconfirm;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign In</title>
</head>
<body>
<form method="post">
	<div class="tooltip"><input type="text" name="username" placeholder="Name to display" value="<?php if(isset($_SESSION['formusername'])){echo $_SESSION['formusername'];}?>"><span class="tooltiptext">Name displayed to other users</span></div><br>
	<div class="tooltip"><input type="text" name="userid" placeholder="Your unique UserID" value="<?php if(isset($_SESSION['formuserid'])){echo $_SESSION['formuserid'];}?>"><span class="tooltiptext">ID used to find you and send friend requests</span></div><br>
	<div class="tooltip"><input type="email" name="mail" placeholder="e-mail" value="<?php if(isset($_SESSION['formmail'])){echo $_SESSION['formmail'];}?>"><span class="tooltiptext">Used to log in.</span></div><br>
	<input type="password" name="password" placeholder="Password"><br>
	<input type="password" name="passwordconfirm" placeholder="Confirm Password"><br>
	<input type="submit" name="submit" value="Sign In">
<?php
//Sign In
if (isset($_POST['submit'])) {
	if (!empty($_POST['mail']) && !empty($_POST['password']) && !empty($_POST['username']) && !empty($_POST['userid']) && !empty($_POST['passwordconfirm'])) {
		$mailtaken = $conn->query("SELECT COUNT(*) FROM user WHERE mail = '".$mail."'")->fetchColumn();
		if ($mailtaken != 0) {echo 'This e-mail is already taken.';}
		else{
			$useridtaken = $conn->query("SELECT COUNT(*) FROM user WHERE userid = '".$userid."'")->fetchColumn();
			if ($useridtaken != 0) {echo 'This UserID is already taken.';}
			else{
				if ($password == $passwordconfirm) {
					$conn->exec('INSERT INTO user (userid, mail, password, username) VALUES (\''.$userid.'\',\''.$mail.'\',\''.$password.'\',\''.$username.'\')');
					header('Location: login.php');
				}else{echo 'Make sure your passwords match.';}
			}
		}
	}else{echo "Please fill all entries.";}
}
?>
</form>
<a href="login.php">»Log In«</a>
</body>
</html>