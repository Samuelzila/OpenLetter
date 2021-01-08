<?php
include 'connexion.php';


?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign In</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
signin
<form method="post">
	<div class="tooltip"><input type="text" name="username" placeholder="Name to display"><span class="tooltiptext">Name displayed to other users</span></div><br>
	<div class="tooltip"><input type="text" name="userid" placeholder="Your unique UserID"><span class="tooltiptext">ID used to find you and send friend requests</span></div><br>
	<input type="email" name="mail" placeholder="e-mail"><br>
	<input type="password" name="password" placeholder="Password"><br>
	<input type="password" name="passwordconfirm" placeholder="Confirm Password"><br>
	<input type="submit" name="submit" value="Sign In">
<?php
//Sign In
if (isset($_POST['submit'])) {
	if (!empty($_POST['mail']) && !empty($_POST['password']) && !empty($_POST['username']) && !empty($_POST['userid']) && !empty($_POST['passwordconfirm'])) {
		$mailtaken = $conn->query("SELECT COUNT(*) FROM user WHERE mail = '".$_POST['mail']."'")->fetchColumn();
		if ($mailtaken != 0) {echo 'This e-mail is already taken.';}
		else{
			$useridtaken = $conn->query("SELECT COUNT(*) FROM user WHERE userid = '".$_POST['userid']."'")->fetchColumn();
			if ($useridtaken != 0) {echo 'This UserID is already taken.';}
			else{
				if ($_POST['password'] == $_POST['passwordconfirm']) {
					#proceed
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