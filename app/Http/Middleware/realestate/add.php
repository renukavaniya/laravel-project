
<?php
	$msg = "";
	// if upload button is pressed
	if (isset($_POST['upload']))
	{
		//the path to store the uploaded image
		$target = "images/" .basename($_FILES['image']['name']);
		//connect to the database
	   $con = mysqli_connect("localhost", "root","","realestate");
	   //get all the submitted data from the form
	   $image = $_FILES['image']['name'];
	   $text = $_POST['text'];
	   
	   $sql = "INSERT INTO images (image,text) VALUES ('$image', '$text')";
	   mysqli_query($con,$sql); // store submitted data into the database table : images
	   
	   //now let's move  the uploaded image into the folder :images
	    if(move_uploaded_file($_FILES['image']['tmp_name'], $target))
		{
			$msg = "Image Uploaded Successfuly";
		}
		else
		{
			$msg ="There was a problem uploading image";
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
			body {
  margin: 0;
  padding: 0;
  background-color: #17a2b8;
  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 320px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
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
							<ul class="list">
								<li><a href="123456789">123456789</a></li>
								<li><a href="#">Sell / Rent Property</a></li>
								<li><a href="#">login / register</a></li>
							</ul>
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
								<li><a href="index.php#property">Property</a></li>
								<li><a href="index.php#contact">Contact</a></li>
								<li><a href="generic.php#Login">Login</a></li>
								
						    </ul>
						  </div>						
					</div>
				</nav>
			</header>
		<!-- End Header Area -->
				<!-- End city Area -->			


				<!-- Start Generic Area -->
				
				<section class="about-generic-area pb-100 ">
					<div class="container border-top-generic">
						<h3 class="about-title mb-30"></h3>
						<div class="row">
							<div class="col-md-12">
								 <div id="login">
        <h3 class="text-center text-white pt-5">Add Property</h3>
		
		

        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
				
				<?php
						$con = mysqli_connect("localhost","root","","realestate");
						$sql = "SELECT * FROM images";
						$result = mysqli_query($con,$sql);
						while ($row = mysqli_fetch_array($result))
						{
							echo "<div id= 'img_div'>";
								echo "<img src='images/".$row['image']."'>";
								echo "<p>" .$row['text']."</p>";
							echo "</div>";
						}
					
					?>
					
				
                   <div class="main-login main-center">
					
					
					
                      <form class="form-horizontal" method="post" action="register.php">
						 <h3 class="text-center text-info">Add Property</h3>
						 
						
								<div class="form-group">
						<label>Property Title <span class="text-danger">*</span></label>
						<input type="text" name=" title" class="form-control" placeholder="Enter Full Name">
					</div>
					
						<div class="form-group">
						<label>Property Description <span class="text-danger">*</span></label>
						<textarea class="form-control" name="desc" rows="4"></textarea>
					</div>
					
						
								<div class="row">
					<div class="form-group col-md-4">
						<label>Type <span class="text-danger">*</span></label>
						<select class="form-control" id="type">
							<option>Select Type</option>
							<option>Type 1</option>
							<option>Type 2</option>
							<option>Type 3</option>
						</select>
					</div>
					
					<div class="form-group col-md-4">
						<label>Location <span class="text-danger">*</span></label>
						<input type="text" name="location" class="form-control" placeholder="Enter Location">
					</div>
					
					<div class="form-group col-md-4">
						<label>Area <span class="text-danger">*</span></label>
						<input type="text"  name=""class="form-control" placeholder="Enter AreaS">
					</div>
					</div>
					
				
						<div class="row">
					<div class="form-group col-md-4">
						<label>Bedrooms <span class="text-danger">*</span></label>
						<input type="text" name="bed" class="form-control" placeholder="Enter Bedrooms">
					</div>
					<div class="form-group col-md-4">
						<label>Bathrooms <span class="text-danger">*</span></label>
						<input type="text" name="bath" class="form-control" placeholder="Enter Bathrooms">
					</div>
					<div class="form-group col-md-4">
						<label>Size <span class="text-danger">*</span></label>
						<input type="text"  name=""class="form-control" placeholder="Enter Size">
					</div>
					</div>
					
					<div class="row">
					
					<div class="form-group col-md-6">
						<label>Sale/Rent Price <span class="text-danger">*</span></label>
						<input type="text" class="form-control" placeholder="sq ft">
					</div>
					<div class="form-group col-md-6">
						<label>Property Id <span class="text-danger">*</span></label>
						<input type="text" class="form-control" placeholder="sq ft">
					</div>
					</div>
					
					<input type="hidden" name="size" value="1000">
                            <div >
                               <!-- <label for="username" class="text-info">Username:</label><br> -->
                                <input type="file" name="image" id="image" >
                            </div>
							<br>
								<div class="row">
					<div class="form-group col-md-6">
						<label>State <span class="text-danger">*</span></label>
						<input type="text" class="form-control" placeholder="Enter State">
					</div>
					<div class="form-group col-md-6">
						<label>Zip/Postal Code <span class="text-danger">*</span></label>
						<input type="text" class="form-control" placeholder="Enter Zip/Postal">
					</div>
										</div>
					
				
				
				
						<div class="form-group ">
							<button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="register_btn">Add Property</button>
						</div>
						
					</form>
				
                    </div>
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

											<form target="_blank" novalidate="true" action=
											"https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">

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