<?php
#uncomment bellow to see error messages
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
try{
$conn = new PDO('mysql:host=127.0.0.1;dbname=OpenLetter','[Scratched Username]','[Scratched Password]');
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){$e->getMessage();}

session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
</head>
<body>

</body>
</html>