<?php

	header("Access-Control-Allow-Origin: *");

	$db_username = 'bd2a9e8a2f9d09';
	$db_password = '2cb06a98';
	$db_server = 'us-cdbr-iron-east-04.cleardb.net';
	$db_name = 'heroku_edb5053c7213f57';

	$mysqli = new mysqli($db_server, $db_username, $db_password, $db_name);

	function getDB() {
	    global $db_username, $db_password, $db_server, $db_name;

	    if (isset($mysqli) && $mysqli instanceof mysqli) {
	        if (!($mysqli->errno) && ($mysqli->ping()))
	            return $mysqli;
	    }

	    return ($mysqli = new mysqli($db_server, $db_username, $db_password, $db_name));
	}

	function sendMessage($GroupID, $Message, $SendTime, $Sender) {
		$mysqli = getDB();

		$insert = $mysqli->prepare("INSERT INTO messages (ID, GroupID, Message, SendTime, Sender) VALUES (?,?,?,?,?)");

		$insert->bind_param('iisss', $x=0, $GroupID, $Message, $SendTime, $Sender);
		$insert->execute();
	}

	// TODO MYSQL SHA1 for Password Encrption
	function addUser($firstname, $lastname, $email, $dateofbirth, $ssn, $username, $password) {
	    $mysqli = getDB();

	    $insert = $mysqli->prepare("INSERT INTO users (ID, FirstName, LastName, Email, DateOfBirth, SSN, Username, Password) VALUES (?,?,?,?,?,?,?,?)");

	    $insert->bind_param('isssssss', $x=0, $firstname, $lastname, $email, $dateofbirth, $ssn, $username, $password);
	    $insert->execute();
	}

	// function getUserByID($UserID) {
	// 	$mysqli = getDB();

	//    	$statement = $mysqli->prepare("SELECT * FROM users WHERE ID='$UserID'");
	//     $statement->execute();
	//     $result = $statement->get_result();
	//     $resultArray = $result->fetch_all(MYSQLI_NUM);

	//     return $resultArray;
	// }

	// function getUserByEmail($UserEmail) {
	// 	$mysqli = getDB();

	//    	$statement = $mysqli->prepare("SELECT * FROM users WHERE Email='$UserEmail'");
	//     $statement->execute();
	//     $result = $statement->get_result();
	//     $resultArray = $result->fetch_all(MYSQLI_NUM);

	//     return $resultArray;
	// }

	// function getUserByUserName($Username) {
	// 	$mysqli = getDB();

	//    	$statement = $mysqli->prepare("SELECT * FROM users WHERE Username='$Username'");
	//     $statement->execute();
	//     $result = $statement->get_result();
	//     $resultArray = $result->fetch_all(MYSQLI_NUM);

	//     return $resultArray;
	// }

	function getUser($Identifier, $Method) {
		$mysqli = getDB();

		switch ($Method) {
		    case 0: // By User ID
		        $statement = $mysqli->prepare("SELECT * FROM users WHERE ID='$Identifier'");
		        break;
		    case 1: // By Email Address
		        $statement = $mysqli->prepare("SELECT * FROM users WHERE Email='$Identifier'");
		        break;
		    case 2: // By Username
		        $statement = $mysqli->prepare("SELECT * FROM users WHERE Username='$Identifier'");
		        break;
		    default:
		        $statement = $mysqli->prepare("SELECT * FROM users WHERE Username='$Identifier'");
		}

		$statement->execute();
	    $result = $statement->get_result();
	    $resultArray = $result->fetch_all(MYSQLI_NUM);

	    return $resultArray;
	}

	function addGroup($name, $users) {
		$mysqli = getDB();

	    $insert = $mysqli->prepare("INSERT INTO groups (ID, Name, Users) VALUES (?,?,?)");

	    $insert->bind_param('iss', $x=0, $name, $users);
	    $insert->execute();
	}

	function getGroupsByUser($UserID) {
	    return explode(";", getUser($UserID)[0][8]);
	}

	// TODO get messages securely
	function getMessages($GroupID) {
		$mysqli = getDB();

	   	$statement = $mysqli->prepare("SELECT * FROM messages WHERE GroupID='$GroupID'");
	    $statement->execute();
	    $result = $statement->get_result();
	    $resultArray = $result->fetch_all(MYSQLI_NUM);

	    return $resultArray;
	}
?>