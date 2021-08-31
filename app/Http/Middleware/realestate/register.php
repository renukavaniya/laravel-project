	<?php
		include_once 'config.php';
		session_start();
		
		//connect to database
		$con = mysqli_connect("localhost","root","","realestate");
		
		if (isset($_POST['register_btn'])){
			
			$username = mysqli_real_escape_string($con,$_POST['username']);
			$email = mysqli_real_escape_string($con,$_POST['email']);
			$password = mysqli_real_escape_string($con,$_POST['password']);
			$password2 = mysqli_real_escape_string($con,$_POST['password2']);
			
			if ($password = $password2)
			{
				//create user
				$password = md5($password);
				$sql = "INSERT INTO users(username,email,password) VALUES ('$username','$email','$password')";
				mysqli_query($con,$sql);
				$_SESSION['message']="You are now logged in";
				$_SESSION['username']=$username;
				header("location:generic.php"); //redirect home page
			}else
			{
				$_SESSION['message']="The two password do not match";
			}
		}
		
?>
	
	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/elements/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="CodePixar">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Homeslea</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/nice-select.css">
		    <link rel="stylesheet" href="css/ion.rangeSlider.css" />
		    <link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/main.css">
			<style>
			
			
			body, html{
			
     height: 100%;
 	background-repeat: no-repeat;
 	background-color: #d3d3d3;
 	font-family: 'Oxygen', sans-serif;
}

.main{
 	margin-top: 70px;
}

h1.title { 
	font-size: 50px;
	font-family: 'Passion One', cursive; 
	font-weight: 400; 
}

hr{
	width: 10%;
	color: #fff;
}

.form-group{
	margin-bottom: 15px;
}

label{
	margin-bottom: 15px;
}

input,
input::-webkit-input-placeholder {
    font-size: 11px;
    padding-top: 3px;
}

.main-login{
 	background-color: #fff;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);

}

.main-center{
 	margin-top: 30px;
 	margin: 0 auto;
 	max-width: 330px;
    padding: 40px 40px;

}

.login-button{
	margin-top: 5px;
}

.login-register{
	font-size: 11px;
	text-align: center;
}

			</style>
			
		</head>
		<body>

			<section class="generic-banner relative">
			<!-- Start Header Area -->
			<header class="default-header">
				<div class="menutop-wrap">
					<div class="menu-top container">
						<div class="d-flex justify-content-end align-items-center">
						<!--	<ul class="list">
								<li><a href="123456789">123456789</a></li>
								<li><a href="#">Sell / Rent Property</a></li>
								<li><a href="#">login / register</a></li>
							</ul> -->
						</div>
					</div>					
				</div>

				<nav class="navbar navbar-expand-lg  navbar-light bg-light">
					<div class="container">
						  <a class="navbar-brand" href="index.html">
						  	<img src="img/logo.png" alt="">
						  </a>
						  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						    <span class="navbar-toggler-icon"></span>
						  </button>

						  <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
						    <ul class="navbar-nav">
								<li><a href="index.php#home">Home</a></li>
								<li><a href="index.php#service">Service</a></li>
								<li><a href="property.php#property">Property</a></li>
								<li><a href="contact.php#contact">Contact</a></li>
								<li><a href="generic.php#Login">Login</a></li>
								
						    </ul>
						  </div>						
					</div>
				</nav>
			</header>
		<!-- End Header Area -->
				<!-- End city Area -->			


				<!-- Start Generic Area -->
				
				<section class="about-generic-area pb-100 " >
					<div class="container border-top-generic">
						<h3 class="about-title mb-30"></h3>
						<div class="row">
							<div class="col-md-12">
								 <div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		
	               		<hr />
	               	</div>
	            </div> 
				<div class="main-login main-center">
				<?php 
						if (isset($_SESSION['message']))
						{
							echo "<div id='error_msg'>".$_SESSION['message']."</div>";
						    unset($_SESSION['message']);
							
						}
						
						?>
						
				
					<form class="form-horizontal" method="post" action="register.php">
						 <h3 class="text-center text-info">Register</h3>
						 
						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Username</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="username" id="username"  placeholder="Enter your Username"required=""/>
								</div>
							</div>
						</div>


						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Your Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"required=""  pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" />
								</div>
							</div>
						</div>

						
						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"required=""/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password2" class="cols-sm-2 control-label">Confirm Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password2" id="password2"  placeholder="Confirm your Password"/required="">
								</div>
							</div>
						</div> 
						
					

						<div class="form-group ">
							<button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="register_btn">Register</button>
						</div>
						<div id="login-register">
				            <a href="generic.php">Login</a>
				         </div>
					</form>
				</div>
			</div>
		</div>

							</div>
						</div>
					</div>
				</section>
				<!-- End Generic Start -->		
	
				<!-- start footer Area -->		
				<footer class="footer-area section-gap">
					<div class="container">
						<div class="row">
							<div class="col-lg-3  col-md-6 col-sm-6">
								<div class="single-footer-widget">
									<h6>About Us</h6>
									<p>
										customer can buy and sell peroperty over here.
									</p>
								</div>
							</div>
							<div class="col-lg-3  col-md-6 col-sm-6">
								<div class="single-footer-widget">
									<h6>Newsletter</h6>
									<p>Stay update with our latest</p>
									<div class="" id="mc_embed_signup">

											<form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">

											<div class="d-flex flex-row">

												<input class="form-control" name="EMAIL" placeholder="Enter Email" onFocus="this.placeholder = ''" onBlur="this.placeholder = 'Enter Email '" required="" type="email">


					                            	<button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
					                            	<div style="position: absolute; left: -5000px;">
														<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
													</div>
					                          	
												<!-- <div class="col-lg-4 col-md-4">
													<button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
												</div>  -->
											</div>		
											<div class="info"></div>
											</form>
									</div>
									</div>
							</div>						
							<div class="col-lg-3  col-md-6 col-sm-6">
								<div class="single-footer-widget mail-chimp">
									<h6 class="mb-20">Instragram Feed</h6>
									<ul class="instafeed d-flex flex-wrap">
										<li><img src="img/i1.jpg" alt=""></li>
										<li><img src="img/i2.jpg" alt=""></li>
										<li><img src="img/i3.jpg" alt=""></li>
										<li><img src="img/i4.jpg" alt=""></li>
										<li><img src="img/i5.jpg" alt=""></li>
										<li><img src="img/i6.jpg" alt=""></li>
										<li><img src="img/i7.jpg" alt=""></li>
										<li><img src="img/i8.jpg" alt=""></li>
									</ul>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 col-sm-6">
								<div class="single-footer-widget">
									<h6>Follow Us</h6>
									<p>Let us be social</p>
									<div class="footer-social d-flex align-items-center">
										<a href="#"><i class="fa fa-facebook"></i></a>
										<a href="#"><i class="fa fa-twitter"></i></a>
										<a href="#"><i class="fa fa-dribbble"></i></a>
										<a href="#"><i class="fa fa-behance"></i></a>
									</div>
								</div>
							</div>							
						</div>
						<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						
						</div>
					</div>
				</footer>	
				<!-- End footer Area -->		
			</div>
			<script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
			<script src="js/vendor/bootstrap.min.js"></script>
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.nice-select.min.js"></script>
			<script src="js/jquery.sticky.js"></script>
			<script src="js/ion.rangeSlider.js"></script>
			<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>
			<script src="js/main.js"></script>	
	</body>
</html>