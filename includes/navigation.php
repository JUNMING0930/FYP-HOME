<?php include("dataconnection.php")?>
<nav class="colorlib-nav" role="navigation">
			<div class="top-menu">
				<div class="container">
					<div class="row">
						<div class="col-sm-7 col-md-9">
							<div id="colorlib-logo"><a href="index.php">KNM SHOES</a></div>
						</div>
						<div class="col-sm-5 col-md-3">
			            <form action="categories.php" class="search-wrap" method="GET">
			               <div class="form-group">
			                  <input type="text" class="form-control search" placeholder="Search" name="search">
			                  <button class="btn btn-primary submit-search text-center" type="submit"><i class="icon-search"></i></button>
			               </div>
			            </form>
			         </div>
		         </div>
					<div class="row">
						<div class="col-sm-12 text-left menu-1">
							<ul>
								<li><a href="index.php">Home</a></li>
								<li class="has-dropdown">
									<a href="categories.php">Shop
									<i class="ion-ios-arrow-down" style="font-size: 10px;"></i></a>
									<ul class="dropdown">
									<?php
									$Category = "SELECT * FROM category WHERE Cate_Status = '1'";
									$Category_Query = mysqli_query($dataconnection,$Category);
									if(mysqli_num_rows($Category_Query) > 0)
									{
										foreach($Category_Query as $Items)
										{
											?>
												<li><a href="categories.php?cate=<?php echo $Items["Cate_Name"]?>"><?php echo $Items["Cate_Name"]?></a></li>
											<?php
										}
									}
									?>
									</ul>
								</li>
								<li class=""><a href="about.php">About</a></li>
								<li class="cart"><a href="cart.php"><i class="icon-shopping-cart"></i> Cart [<?php if(isset($_SESSION['Items'])) { $Items = $_SESSION['Items']; echo $Items; } else { echo "0" ;}?>]</a>
								
								<?php
								
								if(isset($_SESSION['ID']))
								{
									$User_ID= $_SESSION['ID'];
									$User_info = "SELECT * FROM user WHERE ID = '$User_ID'";
									$User_info_run = mysqli_query($userconnection,$User_info);
									$User = mysqli_fetch_array($User_info_run);
									?>
									<a href="order-history.php"><i class="icon-truck"></i> Order History</a>
									<a href="profile.php?id=<?php echo $User_ID?>">Welcome, <?php echo $User['User_First_Name']." ".$User['User_Last_Name']?> </a></li>
									<?php
								}
								else
								{
									?>
									<a href="login.php">Login/Sign up</a></li>
									<?php
								}
								
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="sale">
				<div class="container">
					<div class="row">
						<div class="col-sm-8 offset-sm-2 text-center">
							<div class="row">
								<div class="owl-carousel2">
									<div class="item">
										<div class="col">
											<h3><a href="#">We Provide Comfort and Best Shoes!</a></h3>
										</div>
									</div>
									<div class="item">
										<div class="col">
											<h3><a href="#">KNM SHOES designs, develops, markets and sells high quality footwear, apparel, and equipment, accessories and services</a></h3>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</nav>