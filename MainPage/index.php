<?php
	// session_start();
	// $username = $_SESSION['username'];
	include('core/init.inc.php');
	if(isset($_POST['submit'])){

		$word =  mysqli_real_escape_string($conn,stripcslashes($_POST['word']));
		$meaning =  mysqli_real_escape_string($conn,stripcslashes($_POST['meaning']));
		$sentence =  mysqli_real_escape_string($conn,stripcslashes($_POST['sentence']));

		$errors = array();
		if(empty($_POST['word'])){
			$errors[] = 'The word cannot be empty.';
		}
		if(empty($_POST['meaning'])){
			$errors[] = 'The meaning cannot be empty.';
		}
		if(empty($_POST['sentence'])){
			$errors[] = 'The example cannot be empty.';
		}
		if(empty($errors)){
			$bool = mysqli_query($conn,"INSERT INTO `trending` (`word`, `meaning`, `sentence`, `user_id`, `no_of_likes`) VALUES ('".$word."','".$meaning."','".$sentence."','".$user_id."','0')") or die(mysqli_error($conn));
			if($bool){
				$_SESSION['username'] = $username;
				header("location: index.php");
				exit;
			}else{
				echo "Failed to Insert";
			}
		}else{
			var_dump($errors);
		}
	}
?>

<!DOCTYPE html>
<html lang="en" class="no-js">



<head>


<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Lex-icon</title>

<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:300|Quicksand:500" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/normalize.css" />
<link rel="stylesheet" type="text/css" href="css/demo.css" />
<link rel="stylesheet" type="text/css" href="css/component.css" />
<script src="js/modernizr.custom.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />


</head>



<body>


<div id="vs-container" class="vs-container">

	<div class="codrops-top clearfix">
		<span class="right"><a href="#section-5">About</a><a href="#section-4">Favourites</a><a href="logout.php"><span>Logout</span></a></span>
	</div>

	<header class="vs-header">
		<h1>Lex-icon </h1>
		<ul class="vs-nav">
			<li><a href="#section-1">Trending</a></li>
			<li><a href="#section-2">Word Of the Day</a></li>
			<li><a href="#section-3">Favourites</a></li>
			<!-- <li><a href="#section-4">About</a></li> -->
		</ul>
	</header>

	<div class="vs-wrapper">
		<section id="section-1">
			<div class="vs-content">
				<div class="col">
					<ul class="timeline">
						<li class="event">
							<input type="radio" name="tl-group" checked/>
							<label></label>
							<div class="thumb user-4"><span>AJAY</span></div>
							<div class="content-perspective">
								<div class="content">
									<form method="post" action="index.php">
										<div class="content-inner black">
											<h3>
												<input type="text" name="word" placeholder="write your Word" style="border: none; border-color: transparent;">
											</h3>
											<p class="meaning"><input type="text" name="meaning" placeholder="Meaning" style="border: none; border-color: transparent;"></p>
										</div>
										<div class="content-inner">
											<p class="example"><input type="text" name="sentence" placeholder="example" style="border: none; border-color: transparent;"></p>
										</div>
										<input type="submit" name="submit">
										<br><br>	
									</form>
								</div>
							</div>
						</li>
						<li class="event">
							<input type="radio" name="tl-group"/>
							<label></label>
							<div class="thumb user-3"><span>RICKY</span></div>
							<div class="content-perspective">
								<div class="content">
									<div class="content-inner black">
										<h3>dichotomy
												<img src="images/audio_button.jpeg" >
										</h3>
										<p class="meaning">a division or contrast between two things that are or are represented as being opposed or entirely different.</p>
									</div>
									<div class="content-inner">
										<p class="example">a division or contrast between two things that are or are represented as being opposed or entirely different.<br><br></p>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</section>
		<section id="section-2">
			<div class="vs-content">
				<div class="col">
					<div class="wordOfTheWeak">
							<center>
								<div class="description">
									<h2>Word</h2>
									<div class="Meaning">
										<!-- <h4>Meaning</h4> -->
										<div class="para1">Meaning.</div>
									</div>
								
									<div class="Usage">
										<!-- <h4>Usage</h4> -->
										<p class="para2">usage</p>
									</div>

									<div class="Pronunciation">
										<!-- <h4>Pronunciation</h4> -->
										<p class="para3">pronunciation</p>		

									</div>
								</div>
							</center>
						</div>
				</div>
			</div>
		</section>
		<!-- <section id="section-3">
			<div class="vs-content">
				<div class="col">

				</div>
			</div>
		</section> -->
		<section id="section-4">
			<div class="vs-content">
				<div class="col">
					content of about
				</div>
			</div>
		</section>
	</div>

	<script src="js/classie.js"></script>
	<script src="js/hammer.min.js"></script>
	<script src="js/main.js"></script>

</div>


</body>



</html>
