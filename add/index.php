<?php

	require("../db_manager.php");

	if (isset($_POST["title"])) {
		
		$title = $_POST["title"];
		$image = $_POST["image"];
		$artist = $_POST["artist"];
		$culture = $_POST["culture"];
		$date_display = $_POST["date_display"];
		$date = $_POST["date"];
		$comments = $_POST["comments"];

		$section = $_POST["section"];

		// $mysqli = getDB();
		$mysqli->query("INSERT INTO works (title, image, artist, culture, date_display, date, comments, section)
						VALUES ('$title', '$image', '$artist', '$culture', '$date_display', $date, '$comments', '$section')") or die($mysqli->error);
		echo "Got here at least";

	} else {
		echo "Something went wrong";
	}

?>

<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<title>Add Art</title>
</head>

<body>

<form action="" method="post">
	<label>Title</label> <input name="title"> <br>
	<label>Image URL</label> <input name="image"> <br>
	<label>Artist</label> <input name="artist"> <br>
	<label>Culture</label> <input name="culture"> <br>
	<label>Date Display</label> <input name="date_display"> <br>
	<label>Date</label> <input name="date"> <br>
	<label>Comments</label> <textarea cols="30" rows="5" name="comments"></textarea> <br>
	<label>Section</label> <input name="section"> <br>
	<input type="submit" value="Submit">
</form>

</body>
</html>