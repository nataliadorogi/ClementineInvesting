<?php
	require 'db_manager.php';
?>

<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body>

	<form method="post" action="index.php">
		<input type="text" name="Email" value="" placeholder="Email">
		<input type="password" name="Password" value="" placeholder="Password">
		<input type="submit" name="commit" value="Login">
	</form>

</body>
</html>