<?php $page_title = "Checkout"?>
<?php include("dataconnection.php");?>
<?php include("includes/header.php") ?>
<!DOCTYPE HTML>
<html>
	<head>
	<title>Checkout</title>
	</head>
	<body>
		
	<div class="colorlib-loader"></div>


		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="index.php">Home</a></span> / <span>Checkout</span></p>
					</div>
				</div>
			</div>
		</div>


		<div class="colorlib-product">
			<div class="container">
				<div class="row row-pb-lg">
					<div class="col-sm-10 offset-md-1">
						<div class="process-wrap">
							<div class="process text-center active">
								<p><span>01</span></p>
								<h3>Shopping Cart</h3>
							</div>
							<div class="process text-center active">
								<p><span>02</span></p>
								<h3>Checkout</h3>
							</div>
							<div class="process text-center">
								<p><span>03</span></p>
								<h3>Order Complete</h3>
							</div>
						</div>
					</div>
				</div>
		<?php
			if(isset($_SESSION['ID']))
			{
			$ID = $_SESSION['ID'];
			$User_Info = "SELECT * FROM user WHERE ID = '$ID'";
			$User_Info_run = mysqli_query($userconnection,$User_Info);
			if(mysqli_num_rows($User_Info_run) > 0)
			{
				$User = mysqli_fetch_array($User_Info_run);
			}
		?>
        <form action="cartcode.php" method="POST">
				<div class="row">
					<div class="col-lg-8">
							<h2>Billing Details</h2>
								<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="hidden" name="user_id" value="<?php echo $ID?>">
										<label style="color:black;font-weight:bold" for="fname">First Name</label>
										<input style="font-weight:bold"  type="text" name="fname" class="form-control" placeholder="Your firstname" value=<?php echo $User['User_First_Name']?> required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label style="color:black;font-weight:bold" for="lname">Last Name</label>
										<input style="font-weight:bold"  type="text" name="lname" class="form-control" placeholder="Your lastname" value=<?php echo $User['User_Last_Name']?> required>
									</div>
                  </div>

			               <div class="col-md-12">
									      <div class="form-group">
										        <label style="color:black;font-weight:bold" for="adress">Address</label>
			                    	<textarea rows="3" style="font-weight:bold" name="address" class="form-control" placeholder="Enter Your Address" required><?php echo $User['User_Address']?></textarea>
			                  </div>
			               </div>
							
								<div class="col-md-6">
									<div class="form-group">
										<label style="color:black;font-weight:bold" for="email">E-mail Address</label>
										<input style="font-weight:bold" type="email" readonly name="email" class="form-control" placeholder="Your Email" value=<?php echo $User['User_Email']?>  required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label style="color:black;font-weight:bold" for="Phone">Phone Number</label>
										<input style="font-weight:bold" type="text" readonly name="phone" class="form-control" placeholder="Your Phone Number" value=<?php echo $User['User_Phone']?> required>
									</div>
                  </div>
		               </div>
					</div>
          <?php
                        if(isset($_POST['total']))
                        {
                          $total = $_POST['total'];
                          $gtotal = $total + 10;
          ?>              
					<div class="col-lg-4">
						<div class="row">
							<div class="col-md-12">
								<div class="cart-detail">
									<h2>Order Summary</h2>
									<ul>
									<?php
									$Cart_Info = "SELECT * FROM cart";
									$Cart_Info_Run = mysqli_query($userconnection,$Cart_Info);
									if(mysqli_num_rows($Cart_Info_Run) > 0)
									{
										foreach($Cart_Info_Run as $Cart)
										{
											$Pro_ID = $Cart['product_id'];
											$Product = "SELECT * FROM product WHERE ID='$Pro_ID'";
											$Product_Run = mysqli_query($dataconnection,$Product);
											if(mysqli_num_rows($Product_Run) > 0)
											{
												$Pro_Row = mysqli_fetch_array($Product_Run);
												$Pro_Total = $Cart['qty'] * $Pro_Row['Pro_Price'];
											}
											?>
												<li><span><?php echo $Cart['qty']?>x <?php echo $Pro_Row['Pro_Name']?></span><span>RM <?php echo $Pro_Total?></span></li>
											<?php
										}
									}
									?>
									
										<li>
											<span>Subtotal</span> <span>RM <?php echo $total?></span>
										</li>
										<li><span>Shipping</span> <span>RM 10</span></li>
                    <?php

                    ?>
										<li><span>Order Total</span> <span>RM <?php echo $gtotal?></span></li>
									</ul>
								</div>
						   </div>

						   <div class="w-100"></div>

						  <div class="col-md-12">
								<div class="cart-detail">
									<h2>Payment Method</h2>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" value="COD" required> Cash On Delivery</label>
											</div>
										</div>
									</div>
                  					<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" value="Credit/Debit"> Credit/Debit Card </label>
											</div>
										</div>
									</div>
									</div>
								</div>
							</div>
						</div>
						
							

              <input type="hidden" name="gtotal" value="<?php echo $gtotal?>">
              <input type="submit" name="placeorderbtn" value="Place Order" class="btn btn-primary">
					</div>
				</div>
			</div>
		</div>	
    </form>
<?php

                        }
                        ?>
	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="ion-ios-arrow-up"></i></a>
	</div>
	<?php
					}	
	?>				
	</body>
</html>
<?php include("includes/footer.php")?>
<?php include("includes/scripts.php")?>