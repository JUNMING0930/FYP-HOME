<?php include("dataconnection.php");?>
<?php $page_title = "Card Payment"?>
<?php include("includes/header.php") ?>
<!DOCTYPE HTML>
<html>
	<head>
	<title>Welcome to KNM Shoes</title>
	</head>
	<body>
		
	<div class="colorlib-loader"></div>
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="index.php">Home</a></span> / <span>Payment</span></p>
					</div>
				</div>
			</div>
		</div>


		<div id="colorlib-contact">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="contact-wrap">
							<h3>Credit/Debit Card</h3>
							<form action="cartcode.php" class="contact-form" method="POST">
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<input type="hidden" name="fname" value=<?php echo $_GET['fname']?>>
											<input type="hidden" name="lname" value=<?php echo $_GET['lname']?>>
											<input type="hidden" name="email" value=<?php echo $_GET['Email']?>>
											<input type="hidden" name="phone" value=<?php echo $_GET['Phone']?>>
											<input type="hidden" name="gtotal" value=<?php echo $_GET['Total']?>>
											<textarea name="address" hidden><?php echo $_GET['Address']?></textarea>
											<label for="name">Name On Card*</label>
											<input type="text" required id="name" name="name" class="form-control" placeholder="Name" onchange="check1()">
											<span id="nameerror" style="color:Red;text-align:center;"></span>
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group">
											<label for="">Card Number*</label>
											<input type="text" required id="number" name="number" class="form-control" placeholder="Number" onchange="check2()" maxlength="16" size="16">
											<span id="numbererror" style="color: Red;text-align: center;"></span>
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-3">
										<div class="form-group">
											<label for="subject">Expiry Date</label>
                                            <span class="expiration">
                                            <input type="text"  style="height:45px;border:none" required name="month" placeholder="MM" maxlength="2" size="2" />
                                            <span>/</span>
                                            <input type="text"  style="height:45px;border:none" required name="year" placeholder="YY"  maxlength="2" size="2" />
                                            </span>
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-3">
										<div class="form-group">
											<label for="subject">CVV</label>
											<input type="password"  maxlength="3" style="height:45px" required id="CVV" name="CVV" class="form-control" placeholder="CVV"  onchange="check3()">
											<span id="cvverror" style="color: Red;text-align: center;"></span>
										</div>
									</div>
				
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<button type="submit" name="paymentcardbtn" class="btn btn-primary">Proceed
										</div>
									</div>
								</div>
							</form>		
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	if(isset($_SESSION['message']))
	{
		$message = $_SESSION['message'];
		echo "<script>alert('$message')</script>";
		unset($_SESSION['message']);
	}
	?>
	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="ion-ios-arrow-up"></i></a>
	</div>
	
	<script >
		function check1()
		{
			var name = document.getElementById("name").value;
			var res = /^[a-zA-Z]+$/;
			if(res.test(name))
			{
				document.getElementById("nameerror").innerHTML = "";
			} 
			else
			{
				document.getElementById("nameerror").innerHTML = "Please Enter Valid Name";
			}
			
		}
	function check2()
		{
			var number = document.getElementById("number").value;
			var num = /^[0-9]{16}+$/;
			if(num.test(number))
			{
				document.getElementById("numbererror").innerHTML = "";
			} 
			else
			{
				document.getElementById("numbererror").innerHTML = "Please Enter Valid Card Number";
			}
		}
		function check3()
		{
			var cvv = document.getElementById("CVV").value;
            var cv = /^[0-9]{3}+$/;
            if(cv.test(cvv))
			{
				document.getElementById("cvverror").innerHTML = "";
			} 
			else
			{
				document.getElementById("cvverror").innerHTML = "Please Enter Valid CVV";
			}
		}
		
	</script>
	</body>
</html>

<?php include("includes/footer.php")?>
<?php include("includes/scripts.php")?>