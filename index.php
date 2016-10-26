<?php
	require("db_manager.php");
?>

<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="js/main.js"></script> <!-- Resource jQuery -->

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> -->

	<link rel="stylesheet" href="css/carousel-style.css">

	<!-- Bootstrap JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<link href='http://fonts.googleapis.com/css?family=Droid+Serif|Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>APAH Timeline</title>
</head>
<body>
	<header>
		<h1>APAH Timeline</h1>
	</header>

	<?php
		$sections = $mysqli->query("SELECT * FROM sections")->fetch_all(MYSQLI_ASSOC);
		usort($sections, function($a, $b) {
			return $a["date"] - $b["date"];
		});

		for ($i = 0; $i < count($sections); $i++) {
			$row = $sections[$i];
			$section = $row["name"];
			$section_comments = $row["comments"];
			$section_date = $row["date"];
			$modal_id = 'modal' . $i;
			$carousel_id = 'carousel' . $i;

			$works = $mysqli->query("SELECT * FROM works WHERE section='$section'")->fetch_all(MYSQLI_ASSOC);
			usort($works, function($a, $b) {
				return $a["date"] - $b["date"];
			});
	?>	

		<section id="cd-timeline" class="cd-container">
			<div class="cd-timeline-block">
				<div class="cd-timeline-img cd-picture">
					<img src="img/cd-icon-picture.svg" alt="Picture">
				</div> <!-- cd-timeline-img -->

				<div class="cd-timeline-content">
					<h2><?php echo $section; ?></h2>
					<p><?php echo $section_comments; ?></p>
					<a href="#0" class="cd-read-more" data-toggle='modal' <?php echo "data-target='#$modal_id'"?>>See works</a>
					<span class="cd-date"> <?php
						echo $section_date >= 0 ? number_format($section_date) . " CE" : number_format(-$section_date) . " BCE";
					?>
					</span>
				</div> <!-- cd-timeline-content -->
			</div> <!-- cd-timeline-block -->

		</section> <!-- cd-timeline -->

		<!-- modals  -->
		<div class="modal fade" role="dialog" <?php echo "id=$modal_id"; ?>>
			<div class="modal-dialog modal-lg">
			    <!-- Modal content-->
			    <div class="modal-content">
				    <div class="modal-body">
				    	<div class="carousel slide" data-ride="carousel" <?php echo "id='$carousel_id'";?>>
				    		<!-- Wrapper for slides -->
					        <div class="carousel-inner" role="listbox">
					    		<?php 
						    		for ($j = 0; $j < count($works); $j++) {

									$work = $works[$j];
									$title = $work["title"];
									$artist = $work["artist"];
									$culture = $work["culture"];
									$date_display = $work["date_display"];
									$comments = $work["comments"];
									$image = $work["image"];
									$image = "'$image'";
									$active = $j == 0 ? 'active' : '';
								?>
						        
						            <div <?php echo "class='item $active'"?>>
						            	<div style="width: 800px; height: 600px; overflow: hidden">
						                	<img style="width: auto; heigh: auto; max-width: 800px; max-height: 600px;" src=<?php echo $image?>>
						                </div>
						                <div class="carousel-caption">
						                    <h3><?php echo $title; ?></h3>
						                    <h6><?php echo $artist; ?></h6>
						                    <h6><?php echo $culture; ?></h6>
						                    <h6><?php echo $date_display; ?></h6>
						                    <p><?php echo $comments; ?></p>
						                </div>
						            </div>
						        <?php // end works loop
						    	}
						    	?>
					        </div>
					        <!-- Left and right controls -->
					        <a class="left carousel-control" role="button" data-slide="prev" <?php echo "href='#"."$carousel_id'";?>>
					            <span class="fa fa-angle-left" aria-hidden="true"></span>
					            <span class="sr-only">Previous</span>
					        </a>
					        <a class="right carousel-control" role="button" data-slide="next" <?php echo "href='#"."$carousel_id'";?>>
					            <span class="fa fa-angle-right" aria-hidden="true"></span>
					            <span class="sr-only">Next</span>
					        </a>
					        <ol class="carousel-indicators">
					        	<?php
					    		for ($j = 0; $j < count($works); $j++) {
					    			$active = $j == 0 ? 'active' : '';
					            	echo "<li data-target='#$carousel_id' data-slide-to='$j' class='$active'></li>";
					        	}
					        	?>
					        </ol>
					    </div>
				    </div>
				    <div class="modal-footer">
				    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				    </div>
				</div>
			</div>
		</div>

	<?php // end sections loop
	}
	?>

</body>
</html>