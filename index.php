<?php

require 'db_manager.php';

if(!isset($_POST["Email"]) || !isset($_POST["Password"])) {
	header('Location: login.php'); 
	exit();
} else {
	if(!validateUser($_POST["Email"], $_POST["Password"])) {
		header('Location: login.php'); 
		exit();
	}
}


echo "Clementine <pre>";
var_dump(getMessages(1));
?>

<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>

<h1> WOW </h1>

</body>
</html>