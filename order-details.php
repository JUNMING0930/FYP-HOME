<?php $page_title = "Order Details"?>
<?php include("dataconnection.php");?>
<?php include("includes/header.php") ?>
<!DOCTYPE HTML>
<html>
	<head>
	<title>Cart</title>
	</head>
	<body>
		


		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="index.php">Home</a></span> / <span> Order Details</span></p>
					</div>
				</div>
			</div>
		</div>


		<div class="colorlib-product">
			<div class="container">
					<h2>Order Details</h2>
				<table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Size</th>
                      <th>Unit Price</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                       $ptotal = 0;
                       $gtotal = 0;
                       $Order_ID = $_GET['id'];
                       $Order = "SELECT * FROM orders_details WHERE Order_ID = '$Order_ID'";
                       $Order_Run = mysqli_query($userconnection,$Order);
                       if(mysqli_num_rows($Order_Run) > 0)
                       {
                          foreach ($Order_Run as $items) 
                          {
                            $Product_ID = $items['Product_ID'];
                            $Product = "SELECT * FROM product WHERE ID = '$Product_ID'";
                            $Product_Run = mysqli_query($dataconnection,$Product);
                            $Pro_Row = mysqli_fetch_array($Product_Run);
                            $ptotal = $Pro_Row['Pro_Price'] * $items['Order_Quantity'];
                            $gtotal += $ptotal;
                            ?>
                            <tr>
                              <td><?php echo $Pro_Row['Pro_Name'];?></td>
                              <td><?php echo $items['Order_Quantity'];?></td>
                              <td><?php echo $items['Order_Size']?></td>
                              <td>RM <?php echo $Pro_Row['Pro_Price']?>
                              <td>RM <?php echo $ptotal?>
                              </td>
                            </tr>
                            <?php
                          }
                       }
                    ?>
                <tr>
                    <td colspan="4" style="text-align:right"><strong>Grand Total</strong></td>
                    <td>RM <?php echo $gtotal?></td>
                </tr>
                <?php
                    $Orders = "SELECT * FROM orders WHERE id = '$Order_ID' LIMIT 1";
                    $Orders_Run = mysqli_query($userconnection,$Orders);   
                    $Orders_Row = mysqli_fetch_array($Orders_Run);
                ?>
                <tr>
                    <td><strong>Shipping Address</strong></td>
                    <td colspan="4" ><?php echo $Orders_Row['address']?></td>
                </tr>
                <tr>
                    <td><strong>Phone Number</strong></td>
                    <td colspan="4" ><?php echo $Orders_Row['phone']?></td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td colspan="4" ><?php echo $Orders_Row['email']?></td>
                </tr>
                <tr>
                    <td><strong>Status</strong></td>
                    <td colspan="4" >
                    <?php
                    if($Orders_Row['Status'] == 0)
                    {
                        echo "Packaging";
                    }
                    else if($Orders_Row['Status'] == 1)
                    {
                      echo "Shipping";
                    }
                    else if($Orders_Row['Status'] == 2)
                    {
                      echo "Delivered";
                    }
                    else if($Orders_Row['Status'] == 3)
                    {
                      echo "Canceled";
                    }
                    ?>
                    </td>
                </tr>
                </tbody>
                </table>
			</div>
		</div>


	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="ion-ios-arrow-up"></i></a>
	</div>
	</body>
</html>
<?php include("includes/footer.php")?>
<?php include("includes/scripts.php")?>