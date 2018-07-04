<?php
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
		if(word_exists($conn,$_POST['word'])){
			$errors[] = 'The word you entered exist in trending.';
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
			//error to be shown.
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
<link href="https://fonts.googleapis.com/css?family=Noto+Serif" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/normalize.css" />
<link rel="stylesheet" type="text/css" href="css/demo.css" />
<link rel="stylesheet" type="text/css" href="css/component.css" />
<script src="js/modernizr.custom.js"></script>
<link href='https://fonts.googleapis.com/css?family=Playfair+Display:700|Raleway:500.700' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href='https://fonts.googleapis.com/css?family=Patrick+Hand+SC' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.5.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="css/icons.css" />
<style>
/* $hoverEasing: cubic-bezier(0.23, 1, 0.32, 1);
$returnEasing: cubic-bezier(0.445, 0.05, 0.55, 0.95); */

body {
  margin: 40px 0;
  font-family: "Raleway";
  font-size: 14px;
  font-weight: 500;
  -webkit-font-smoothing: antialiased;
}

 .title {
  font-family: "Raleway";
  font-size: 24px;
  font-weight: 700;
  color: #5D4037;
  text-align: center;
}


/*  html,body{
  height:100%;
}
body{
  text-align:center;
}
body:before{
  content:'';
  height:100%;
  display:inline-block;
  vertical-align:middle;
}  */
.fo{
	text-align:center;

}
.button{
  background:rgb(255, 234, 150);
  color:#000;
  border:none;
  position:relative;
  height:60px;
  font-size:1.6em;
  padding:0 2em;
  cursor:pointer;
  transition:800ms ease all;
  outline:none;
}
.button:hover{
  background:rgb(255,234, 150);;
  color:rgb(65, 131, 142);;
}
.button:before,.button:after{
  content:'';
  position:absolute;
  top:0;
  right:0;
  height:2px;
  width:0;
  background: #1AAB8A;
  transition:400ms ease all;
}
.button:after{
  right:inherit;
  top:inherit;
  left:0;
  bottom:0;
}
.button:hover:before,.button:hover:after{
  width:100%;
  transition:800ms ease all;
}





/*
p {
  line-height: 1.5em;
}

h1+p, p+p {
  margin-top: 10px;
}

.container {
  padding: 40px 80px;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.card-wrap {
  margin: 10px;
  transform: perspective(8900px);
  transform-style: preserve-3d;
  cursor: pointer;
  // background-color: #fff;

  &:hover {
    .card-info {
      transform: translateY(0);
    }
    .card-info p {
      opacity: 1;
    }
    .card-info, .card-info p {
      transition: 0.6s $hoverEasing;
    }
    .card-info:after {
      transition: 5s $hoverEasing;
      opacity: 1;
      transform: translateY(0);
    }
    .card-bg {
      transition:
        0.6s $hoverEasing,
        opacity 5s $hoverEasing;
      opacity: 0.8;
    }
    .card {
      transition:
        0.6s $hoverEasing,
        box-shadow 2s $hoverEasing;
      box-shadow:
        rgba(white, 0.2) 0 0 40px 5px,
        rgba(white, 1) 0 0 0 1px,
        rgba(black, 0.66) 0 30px 60px 0,
        inset #333 0 0 0 5px,
        inset white 0 0 0 6px;
    }
  }
}

.card {
  position: relative;
  flex: 0 0 240px;
  width: 240px;
  height: 320px;
  background-color: #333;
  overflow: hidden;
  border-radius: 10px;
  box-shadow:
    rgba(black, 0.66) 0 30px 60px 0,
    inset #333 0 0 0 5px,
    inset rgba(white, 0.5) 0 0 0 6px;
  transition: 1s $returnEasing;
}
.card-bg {
  opacity: 0.8;
  position: absolute;
  top: -20px; left: -20px;
  width: 120%;
  height: 120%;
  padding: 20px;
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  transition:
    1s $returnEasing,
    opacity 5s 1s $returnEasing;
  pointer-events: none;
}

.card-info {
  padding: 20px;
  position: absolute;
  bottom: 0;
  color: #fff;
  transform: translateY(40%);
  transition: 0.6s 1.6s cubic-bezier(0.215, 0.61, 0.355, 1);

  p {
    opacity: 0;
    text-shadow: rgba(black, 1) 0 2px 3px;
    transition: 0.6s 1.6s cubic-bezier(0.215, 0.61, 0.355, 1);
  }

  * {
    position: relative;
    z-index: 1;
  }

   	&:after {
    content: '';
    position: absolute;
    top: 0; left: 0;
    z-index: 0;
    width: 100%;
    height: 100%;
    background-image: linear-gradient(to bottom, transparent 0%, rgba(#000, 0.6) 100%);
    background-blend-mode: overlay;
    opacity: 0;
    transform: translateY(100%);
    transition: 6s 1s $returnEasing;
  }
}

.card-info h1 {
  font-family: "Playfair Display";
  font-size: 36px;
  font-weight: 700;
  text-shadow: rgba(black, 0.5) 0 10px 10px;
} */

.zoom {
    /* padding: 50px; */
    /* background-color: green; */
    transition: transform .2s; /* Animation */
    width: 200px;
    height: 200px;
    margin: 0 auto;
}

.zoom:hover {
    transform: scale(1.1); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}


#rcorners2 {
    border-radius: 25px;
    border: 2px solid #73AD21;
    padding: 20px;
    width: 78%;
    height: 150px;
}
</style>

<style>


.hovereffect {
  width: 100%;
  height: 100%;
  float: left;
  overflow: hidden;
  position: relative;
  text-align: center;
  cursor: default;
	margin: 0 0 50px 0;


}

.hovereffect .overlay {
  width: 100%;
  height: 100%;
  position: absolute;
  overflow: hidden;
  top: 0;
  left: 0;
  background-color: rgba(75,75,75,0.7);
  -webkit-transition: all 0.6s  cubic-bezier(0.88,-0.99, 0, 1.81);
  transition: all 0.6s  cubic-bezier(0.88,-0.99, 0, 1.81);
}

.hovereffect:hover .overlay {
  background-color: rgba(48, 152, 157, 0.4);
}

.hovereffect img {
  display: block;
  position: relative;
}

.hovereffect h2 {
  text-transform: uppercase;
  color: #fff;
  text-align: center;
  position: relative;
  font-size: 17px;
  padding: 10px;
  background: rgba(0, 0, 0, 0.6);
  -webkit-transform: translateY(45px);
  -ms-transform: translateY(45px);
  transform: translateY(45px);
  -webkit-transition: all 0.4s  cubic-bezier(0.88,-0.99, 0, 1.81);
  transition: all 0.4s  cubic-bezier(0.88,-0.99, 0, 1.81);
}

.hovereffect:hover h2 {
  -webkit-transform: translateY(5px);
  -ms-transform: translateY(5px);
  transform: translateY(50px);
}

.hovereffect a.info {
  display: inline-block;
  text-decoration: none;
  padding: 7px 14px;
  text-transform: uppercase;
  color: #fff;
  border: 1px solid #fff;
  background-color: transparent;
  opacity: 0;
  filter: alpha(opacity=0);
  -webkit-transform: scale(0);
  -ms-transform: scale(0);
  transform: scale(0);
  -webkit-transition: all 0.4s  cubic-bezier(0.88,-0.99, 0, 1.81);
  transition: all 0.4s  cubic-bezier(0.88,-0.99, 0, 1.81);
  font-weight: normal;
  margin: -52px 0 0 0;
  padding: 62px 100px;
}

.hovereffect:hover a.info {
  opacity: 1;
  filter: alpha(opacity=100);
  -webkit-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
}

.hovereffect a.info:hover {
  box-shadow: 0 0 5px #fff;
}

</style>

</head>

<body>

	<div id="loader-wrapper">
	  <div id="loader"></div>
	</div>

<div id="vs-container" class="vs-container">

	<div class="codrops-top clearfix">
		<span class="right"><a href="aboutus/index.html">About</a><a href="#section-4">Favourites</a><a href="logout.php"><span>Logout</span></a></span>
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
						<label>
						<li class="event">
							<input type="radio" name="tl-group" checked/>
							<label></label>
							<?php echo "<div class='thumb user-".$user_id."' style='background-image: url(".$user_image.");'>"; ?><span><?php echo $user_name; ?></span></div>
							<div class="content-perspective">
								<div class="content">
									<form method="post" action="index.php">
										<div class="content-inner black">
											<h3>
												<input type="text"  name="word" placeholder="New Word" style="border: none; border-color: transparent;background-color:#ffea96;align:left;">
											</h3>
											<h6><p class="meaning"><input type="text" size="75%" width="1000" name="meaning" placeholder="Meaning" style="border: none; border-color: transparent;background-color:#ffea96;"></p></h6>
										</div>
										<div class="content-inner">
											<h7><p class="example"><input type="text" size="95%" name="sentence" placeholder="Example" style="border: none; border-color: transparent;background-color:#ffea96;"></p></h7>
											<div class="fo">
													<input type="submit" name="submit" class="button" value="SUBMIT"></input>
											</div>

										</div>
										<!-- <input type="button" class="button" value="Hover me">Hover me !</input> -->
										<br><br>
									</form>
								</div>
							</div>
						</li>
						</label>
						<?php
							$sql = "select * from trending";
							$result=mysqli_query($conn,$sql);
							$rowcount_trending=mysqli_num_rows($result);
							for($x=$rowcount_trending;$x>0;$x=$x-1){
								$sql="SELECT * from trending where id ='".$x."'";
								$query=mysqli_query($conn,$sql)or die (mysqli_error($conn));
								$row=mysqli_fetch_array($query);
								$word=$row['word'];
								$meaning=$row['meaning'];
								$sentence=$row['sentence'];
								$no_of_likes=$row['no_of_likes'];

								$timeliner_id=$row['user_id'];
								$query2 = "SELECT name,images FROM users WHERE id='".$timeliner_id."'";
								$result2 = mysqli_query($conn,$query2) or die (mysqli_error($conn).$query2);
								$user2 = mysqli_fetch_array($result2);
								$timeliner_name = $user2['name'];
								$timeliner_image = $user2['images'];

								if($no_of_likes==0){
									$likes="";
								}else{
									$likes=$no_of_likes;
								}
								//check in fav table if user logged in exist with that particular word id if yes and status's value'  of one then give color code #F35186 else color code of #C0C1C3.
								$query3="SELECT * FROM fav WHERE user_id='".$user_id."' AND word_id='".$x."' AND table_id=0";
								$result3=mysqli_query($conn,$query3) or die (mysqli_error($conn));
								$cond ='';
								$result3count = mysqli_num_rows($result3);
								if($result3count>0){
									$fav_row=mysqli_fetch_array($result3);
									if($fav_row['status']==1){
										$color_code ='#F35186';
										$cond = '0';
									}else{
										$color_code='#C0C1C3';
										$cond = '1';
									}
								}else{
									$color_code='#C0C1C3';
									$cond = '1';
								}
								echo '<label><li class="event">
								<input type="radio" name="tl-group"/>
								<label></label>
								<style>
									.icoButton'.$x.'{
										color :'.$color_code.';
									}
								</style>
								<div class="thumb user-'.$timeliner_id.'" style="background-image: url('.$timeliner_image.'"><span>'.$timeliner_name.'</span></div>
								<div class="content-perspective">
									<div class="content">
										<div class="content-inner black">
											<h3>'.$word.'
											<div class="grid__item" >
												<button class="icobutton icobutton--heart like-btn icoButton'.$x.'" onclick="post('.$x.',0);" value="submit"><span class="fa fa-heart"></span><span class="icobutton__text icobutton__text--side">'.$likes.'</span></button>
											</div></h3>
											<p class="meaning">'.$meaning.'</p>
											</div>
											<div class="content-inner">
												<p class="example">'.$sentence.'<br><br></p>
											</div>
										</div>
									</div>
								</li></label>';
								echo "<script type='text/javascript'>
										function post(x,table_id){
											var user_id = ".$user_id.";
											var word_id = x;
											var table_id = table_id;
											$.post('core/server.php',{user_id:user_id,word_id:word_id,table_id:table_id},function(data){
													$('#result').html(data);
												});
										}
									</script>";
							}
						?>
					</ul>
				</div>
			</div>
		</section>
		<?php
			$d=date("d");
			$m=date("m");
			$da=intval($d);
			$mo=intval($m);
			$t= $da * $mo;
			$t = $t % 5;
			$sql = "SELECT id, word, meaning, sentence FROM dictionary where id=".$t."";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
		?>
		<section id="section-2">
			<div class="vs-content">
				<div class="col">
					<div class="wordOfTheWeak">
							<center>
								<div class="description">
									<h2 id="wo">
										<?php echo strtoupper($row["word"]);
										?>
									</h2>
									<div class="Meaning">
										<!-- <h4>Meaning</h4> -->
									  <div class="para1" id="me">
											<i><?php echo $row["meaning"]; ?></i>
										</div>
									</div>
                  					<div class="Usage">
										<!-- <h4>Usage</h4> -->
									  	<p class="para2" id="us">
											<?php echo $row["sentence"];
											?>
										</p>
									</div>
									<?php
									$y=$row['id'];
									$query4="SELECT * FROM fav WHERE user_id='".$user_id."' AND word_id='".$y."' AND  table_id=1";
									$result4=mysqli_query($conn,$query4) or die (mysqli_error($conn));
									$cond ='';
									$result4count = mysqli_num_rows($result3);
									if($result4count>0){
										$fav_row=mysqli_fetch_array($result3);
										if($fav_row['status']==1){
											$color_code ='#F35186';
											$cond = '0';
										}else{
											$color_code='#C0C1C3';
											$cond = '1';
										}
									}else{
										$color_code='#C0C1C3';
										$cond = '1';
									}
									echo '<style>
										.icoButton-i{
											color :'.$color_code.';
										}
									</style>';
									echo '<div class="grid__item" >
										<button class="icobutton icobutton--heart like-btn icoButton-i" onclick="postme('.$y.',1);" value="submit"><span class="fa fa-heart"></span><span class="icobutton__text icobutton__text--side"></span></button>
									</div>';
									echo "<script type='text/javascript'>
										function postme(x,table_id){
											var user_id = ".$user_id.";
											var word_id = x;
											var table_id = table_id;
											$.post('core/server.php',{user_id:user_id,word_id:word_id,table_id:table_id},function(data){
													$('#result').html(data);
												});
										}
									</script>"
									?>
								</div>
							</center>
						</div>
				</div>
			</div>
		</section>
		<section id="section-3">
			<div class="vs-content ">
				<div class="col">

					<h1 class="title">Your Favourites<br /><br /></h1>

											<?php
											$sql = "select * from fav";
											$result=mysqli_query($conn,$sql);

											$rowcount=mysqli_num_rows($result);

											for($x=$rowcount;$x>0;$x=$x-1){
												$query=mysqli_query($conn,"select * from fav where id =$x");
												$row=mysqli_fetch_array($query);
												$query_of_user = $row['user_id'];
												$current_status = $row['status'];
												if($query_of_user != $user_id) continue;
												if($current_status != 1) continue;
												$fav_word_id =$row['word_id'];

												$table_id = $row['table_id'];
												if($table_id==0){
												$query2 = "SELECT word,meaning,sentence FROM trending WHERE id='".$fav_word_id."'";
												$result2 = mysqli_query($conn,$query2) or die (mysqli_error($conn).$query2);
												$word2 = mysqli_fetch_array($result2);
												}
												else{
													$query2 = "SELECT word,meaning,sentence FROM dictionary WHERE id='".$fav_word_id."'";
													$result2 = mysqli_query($conn,$query2) or die (mysqli_error($conn).$query2);
													$word2 = mysqli_fetch_array($result2);

												}
												$link = 'https://picsum.photos/1430/300/?image=';
												$link .= rand(1,1000);
												$word = $word2['word'];
												$meaning = $word2['meaning'];
												$sentence = $word2['sentence'];
												echo '<div class="row">
																<div class="col-lg-12 col-md-4 col-sm-6 col-xs-12">
											    <div class="hovereffect zoom">
											        <img class="img-responsive" src="'.$link.'" alt="">
											        <div class="overlay">
											           <h2>'.$word.'</h2>
											           <a class="info" href="#">'.$meaning.'<br/>
																'.$sentence.'</a>
										         </div>
							</div></div>
							</div><br /><br /><br /><br />';
						}
						?>
					</div>
				</div>
			</div>
		</section>
	</div>

	<script src="js/classie.js"></script>
	<script src="js/hammer.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/mo.min.js"></script>
	<script >
		;(function(window) {

			'use strict';

			// taken from mo.js demos
			function isIOSSafari() {
				var userAgent;
				userAgent = window.navigator.userAgent;
				return userAgent.match(/iPad/i) || userAgent.match(/iPhone/i);
			};

			// taken from mo.js demos
			function isTouch() {
				var isIETouch;
				isIETouch = navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0;
				return [].indexOf.call(window, 'ontouchstart') >= 0 || isIETouch;
			};

			// taken from mo.js demos
			var isIOS = isIOSSafari(),
				clickHandler = isIOS || isTouch() ? 'touchstart' : 'click';

			function extend( a, b ) {
				for( var key in b ) {
					if( b.hasOwnProperty( key ) ) {
						a[key] = b[key];
					}
				}
				return a;
			}

			function Animocon(ell, options) {
				this.ell = ell;
				this.options = extend( {}, this.options );
				extend( this.options, options );

				this.checked = false;

				this.timeline = new mojs.Timeline();

				for(var i = 0, len = this.options.tweens.length; i < len; ++i) {
					this.timeline.add(this.options.tweens[i]);
				}

				var self = this;
				this.ell.addEventListener(clickHandler, function() {
					if( self.checked ) {
						self.options.onUnCheck();
					}
					else {
						self.options.onCheck();
						self.timeline.replay();
					}
					self.checked = !self.checked;
				});
			}

			Animocon.prototype.options = {
				tweens : [
					new mojs.Burst({})
				],
				onCheck : function() { return false; },
				onUnCheck : function() { return false; }
			};

			// grid items:
			var items = [].slice.call(document.querySelectorAll('div.grid__item'));
			/*icon 1*/
			function init() {
			<?php
			$order='0';
			for($x=$rowcount_trending+1;$x>0;$x--){
				$temp = $order;
				$order++;
				if ($cond == '1') {
					$string ="onCheck : function() {
						ell".$order.".style.color = '#F35186';
						ell".$order."counter.innerHTML = Number(ell".$order."counter.innerHTML) + 1;
					},
					onUnCheck : function() {
						ell".$order.".style.color = '#C0C1C3';
						var current = Number(ell".$order."counter.innerHTML);
						ell".$order."counter.innerHTML = current > 1 ? Number(ell".$order."counter.innerHTML) - 1 : '';
					}";
				}else{
					$string ="onCheck : function() {
						ell".$order.".style.color = '#C0C1C3';
						var current = Number(ell".$order."counter.innerHTML);
						ell".$order."counter.innerHTML = current > 1 ? Number(ell".$order."counter.innerHTML) - 1 : '';

						/*onchangedb(".$x.");*/
					},
					onUnCheck : function() {
						ell".$order.".style.color = '#F35186';
						ell".$order."counter.innerHTML = Number(ell".$order."counter.innerHTML) + 1;
						/*inchangedb(".$x.");*/
					}";
				}

				echo "
				var ell".$order." = items[".$temp."].querySelector('button.icobutton'), ell".$order."span = ell".$order.".querySelector('span'), ell".$order."counter = ell".$order.".querySelector('span.icobutton__text');
				new Animocon(ell".$order.", {
					tweens : [
						// ring animation
						new mojs.Shape({
							parent: ell".$order.",
							duration: 750,
							type: 'circle',
							radius: {0: 40},
							fill: 'transparent',
							stroke: '#F35186',
							strokeWidth: {35:0},
							opacity: 0.2,
							top: '45%',
							easing: mojs.easing.bezier(0, 1, 0.5, 1)
						}),
						new mojs.Shape({
							parent: ell".$order.",
							duration: 500,
							delay: 100,
							type: 'circle',
							radius: {0: 20},
							fill: 'transparent',
							stroke: '#F35186',
							strokeWidth: {5:0},
							opacity: 0.2,
							x : 40,
							y : -60,
							easing: mojs.easing.sin.out
						}),
						new mojs.Shape({
							parent: ell".$order.",
							duration: 500,
							delay: 180,
							type: 'circle',
							radius: {0: 10},
							fill: 'transparent',
							stroke: '#F35186',
							strokeWidth: {5:0},
							opacity: 0.5,
							x: -10,
							y: -80,
							isRunLess: true,
							easing: mojs.easing.sin.out
						}),
						new mojs.Shape({
							parent: ell".$order.",
							duration: 800,
							delay: 240,
							type: 'circle',
							radius: {0: 20},
							fill: 'transparent',
							stroke: '#F35186',
							strokeWidth: {5:0},
							opacity: 0.3,
							x: -70,
							y: -10,
							easing: mojs.easing.sin.out
						}),
						new mojs.Shape({
							parent: ell".$order.",
							duration: 800,
							delay: 240,
							type: 'circle',
							radius: {0: 20},
							fill: 'transparent',
							stroke: '#F35186',
							strokeWidth: {5:0},
							opacity: 0.4,
							x: 80,
							y: -50,
							easing: mojs.easing.sin.out
						}),
						new mojs.Shape({
							parent: ell".$order.",
							duration: 1000,
							delay: 300,
							type: 'circle',
							radius: {0: 15},
							fill: 'transparent',
							stroke: '#F35186',
							strokeWidth: {5:0},
							opacity: 0.2,
							x: 20,
							y: -100,
							easing: mojs.easing.sin.out
						}),
						new mojs.Shape({
							parent: ell".$order.",
							duration: 600,
							delay: 330,
							type: 'circle',
							radius: {0: 25},
							fill: 'transparent',
							stroke: '#F35186',
							strokeWidth: {5:0},
							opacity: 0.4,
							x: -40,
							y: -90,
							easing: mojs.easing.sin.out
						}),
						// icon scale animation
						new mojs.Tween({
							duration : 1200,
							easing: mojs.easing.ease.out,
							onUpdate: function(progress) {
								if(progress > 0.3) {
									var elasticOutProgress = mojs.easing.elastic.out(1.43*progress-0.43);
									ell".$order."span.style.WebkitTransform = ell".$order."span.style.transform = 'scale3d(' + elasticOutProgress + ',' + elasticOutProgress + ',1)';
								}
								else {
									ell".$order."span.style.WebkitTransform = ell".$order."span.style.transform = 'scale3d(0,0,1)';
								}
							}
						})
					],
					".$string."
				});
			";
		}

			?>
		}
			init();
		})(window);
	</script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</div>


<script>
// jQuery('#loader').fadeOut(2000);
// jQuery('#loader-wrapper').fadeOut(2000);


jQuery(document).ready(function() {
    jQuery('#loader').fadeOut(2000);
});


jQuery(document).ready(function() {
    jQuery('#loader-wrapper').fadeOut(2000);
});


</script>

</body>



</html>
