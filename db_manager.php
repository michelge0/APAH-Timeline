<?php

$db_server = "us-cdbr-iron-east-04.cleardb.net";
$db_username = "bdb05ffed14c57";
$db_password = "948475e4";
$db_name = "heroku_0b5451d6fe6127e";

$mysqli = new mysqli($db_server, $db_username, $db_password, $db_name);

// function getDB()
// {
// 	global $db_username, $db_password, $db_server, $db_name;

// 	if (isset($mysqli) && $mysqli instanceof mysqli) {
// 		if (!($mysqli->errno) && ($mysqli->ping()))
// 			return $mysqli;
// 	}

// 	return ($mysqli = new mysqli($db_server, $db_username, $db_password, $db_name));
// }

?>