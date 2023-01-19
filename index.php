<?php include("dataconnection.php");
$page_title = "Welcome to KNM Shoes";
?>
<?php include("includes/header.php") ?>
<!DOCTYPE HTML>
<html>
	<head>
	<title>KNM SHOES</title>
	</head>
	<body>
		
	<div class="colorlib-loader"></div>

		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(images/Background_1.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-sm-6 offset-sm-3 text-center slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">Unisex</h1>
					   					<h2 class="head-2">Sandals</h2>
					   					<h2 class="head-3">Collection</h2>
					   					<p class="category"><span>New trending shoes</span></p>
					   					<p><a href="categories.php?cate=SANDAL" class="btn btn-primary">Shop Sandal</a></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(images/Background_3.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-sm-6 offset-sm-3 text-center slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">Brand New</h1>
					   					<h2 class="head-2">Comfort</h2>
					   					<h2 class="head-3"><strong class="font-weight-bold">Sliders</strong> </h2>
					   					<p class="category"><span>Best Sliders</span></p>
					   					<p><a href="categories.php?cate=SLIDER" class="btn btn-primary">Shop Sliders</a></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(images/item-11.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-sm-6 offset-sm-3 text-center slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">Speed</h1>
					   					<h2 class="head-2">All Day Comfort</h2>
					   					<h2 class="head-3">SOFT FOAM+</h2>
					   					<p class="category"><span>Sport Shoes</span></p>
					   					<p><a href="categories.php?cate=SPORT%20SHOES" class="btn btn-primary">Shop Sport Shoes</a></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>
		<div class="colorlib-intro">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h2 class="intro">It started with a simple idea: Create quality, well-designed products that I wanted myself.</h2>
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-product">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
					<h3 class="intro">Latest Product</h3>
					</div>
					<?php
						$Product = "SELECT ID,Category_ID,Pro_Name,Pro_Price,Pro_Image FROM product ORDER BY ID DESC LIMIT 10";
						$Product_Run = mysqli_query($dataconnection,$Product);
						if(mysqli_num_rows($Product_Run) > 0)
							{
								?>
									<div class="colorlib-product">
										<div class="container">
											<div class="row row-pb-md">    
								<?php
								foreach($Product_Run as $Product_Items)
								{
									?>
												<div class="col-lg-3 mb-4 text-center">
													<div class="product-entry border">
														<a href="products.php?title=<?php echo $Product_Items['ID']?>" class="prod-img">
															<img src="../Admin/uploads/products/<?php echo $Product_Items['Pro_Image']?>" class="img-fluid" alt="Free html5 bootstrap 4 template">
														</a>
														<div class="desc">
															<h2><a href="products.php?title=<?php echo $Product_Items['ID']?>"><?php echo $Product_Items['Pro_Name']?></a></h2>
															<span class="price"><strong>RM  <?php echo $Product_Items['Pro_Price']?></strong></span>
														</div>
													</div>
												</div>
									<?php
								}
							}					   
					?>
					
				</div>
				<div class="row">
					<div class="col-md-12 text-center">
						<p><a href="categories.php" class="btn btn-primary btn-lg">Shop All Products</a></p>
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-partner">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
						<h2>Trusted Partners</h2>
					</div>
				</div>
				<div class="row">
					<div class="col partner-col text-center">
						<img src="images/brand-1.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
					</div>
					<div class="col partner-col text-center">
						<img src="images/brand-2.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
					</div>
					<div class="col partner-col text-center">
						<img src="images/brand-3.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
					</div>
					<div class="col partner-col text-center">
						<img src="images/brand-4.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
					</div>
					<div class="col partner-col text-center">
						<img src="images/brand-5.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
					</div>
				</div>
			</div>
		</div>


	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="ion-ios-arrow-up"></i></a>
	</div>
	
	<?php
	if(isset($_SESSION['message']))
	{
		$message = $_SESSION['message'];
		echo "<script>alert('$message')</script>";
		unset($_SESSION['message']);
	}
	?>

	</body>
</html>
<?php include("includes/footer.php")?>
<?php include("includes/scripts.php")?>
