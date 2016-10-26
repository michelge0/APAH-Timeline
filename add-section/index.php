<?php

	require("../db_manager.php");

	if (isset($_POST["name"])) {
		
		$name = $_POST["name"];
		$date = $_POST["date"];
		$comments = $_POST["comments"];

		// $mysqli = getDB();
		$mysqli->query("INSERT INTO sections (name, date, comments)
						VALUES ('$name', $date, '$comments')") or die($mysqli->error);
		echo "Done!";

	} else {
		echo "Form not submitted!";
	}

?>

<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<title>Add Section</title>
</head>

<body>

<form action="" method="post">
	<label>Name</label> <input name="name"> <br>
	<label>Date</label> <input name="date"> <br>
	<label>Comments</label> <textarea cols="30" rows="5" name="comments"></textarea> <br>
	<input type="submit" value="Submit">
</form>

</body>
</html>