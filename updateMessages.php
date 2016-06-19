<?php

require 'db_manager.php';
// TODO: Security 
echo json_encode(getMessages($_POST["Group"]));

?>