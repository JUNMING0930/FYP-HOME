<?php include("dataconnection.php");?>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
<?php
if(isset($_GET['title']))
{
	$Title = $_GET['title'];
	$page_pro = "SELECT Pro_Name FROM product WHERE ID = '$Title'";
	$page_pro_run = mysqli_query($dataconnection,$page_pro);
	if(mysqli_num_rows($page_pro_run) > 0)
	{
		$page_name = mysqli_fetch_array($page_pro_run);
		$page_title = $page_name['Pro_Name'];
	}
 include("includes/header.php") ?>
	<body>

        <?php
				$Product = "SELECT ID,Category_ID,Pro_Name,Pro_Description,Pro_Price,Pro_Image FROM product WHERE ID = '$Title'";
				$Product_query = mysqli_query($dataconnection,$Product);
				if(mysqli_num_rows($Product_query)>0)
				{
					$Data = mysqli_fetch_array($Product_query);
					$Category_ID = $Data['Category_ID'];
					$Category = "SELECT Cate_Name FROM category WHERE ID = '$Category_ID'";
					$Category_Run = mysqli_query($dataconnection,$Category);
					if(mysqli_num_rows($Category_Run)>0)
					{
						$Cate = mysqli_fetch_array($Category_Run);
					}
					?>
					<div class="colorlib-product">
						<div class="container">
							<div class="row row-pb-lg product-detail-wrap">
								<div class="col-sm-8">
										<div class="item">
											<div class="product-entry border">
												<a href="#" class="prod-img">
													<img src="../Admin/uploads/products/<?php echo $Data['Pro_Image']?>"  height="900px" width="750px">
												</a>
											</div>
										</div>
								</div>
								<div class="col-sm-4">
							<div class="product-desc">
							<h3 style="font-size:36px"><?php echo $Data['Pro_Name']?></h3>
							<p> <strong><?php echo $Cate['Cate_Name'] ?></strong></p>
							<p class="price">
								<span><strong>RM <?PHP echo $Data['Pro_Price']?></strong></span> 
							</p>
							
							
							<div class="size-wrap">
								<div class="block-26 mb-2">
									<h4 style="font-size:18px">Select Size (EU)</h4>
				               <ul>
				                  
				            	
							<?php
								$Available_Size = "SELECT stock.Product_ID AS Pid,stock.Product_Size AS Pro_Size FROM stock,size WHERE stock.Product_Size = size.EUsize AND stock.Product_ID = '$Title' AND stock.Product_Quantity > 0" ;
								$Available_Size_run = mysqli_query($dataconnection,$Available_Size);
								if(mysqli_num_rows($Available_Size_run) > 0)
								{
									$Size = "SELECT * FROM size";
									$Size_Run = mysqli_query($dataconnection,$Size);
									if(mysqli_num_rows($Size_Run)>0)
									{
										foreach ($Size_Run AS $Size_Row) 
										{
											foreach($Available_Size_run as $Available_Size_array)
											{
												if($Size_Row['EUsize'] == $Available_Size_array['Pro_Size'])
												{		
													{
														?>
														<li><a href="products.php?title=<?php echo $Title?>&size=<?php echo $Available_Size_array['Pro_Size']?>" style="color:black"><?php echo $Available_Size_array['Pro_Size']?></a></li>
														<?php
													}
												}
											}
										}
									}
								}
								else
								{
									echo "The Product Temporaly Out of Stock";
								}
								
							?>
							</ul>
							</div>
				            <?php
								if(isset($_GET['size']))
								{
									$Selected_Size = $_GET['size'];
									$Selected = "SELECT Product_Quantity FROM stock WHERE Product_Size = '$Selected_Size' AND Product_ID='$Title'";
									$Selected_run = mysqli_query($dataconnection,$Selected);
									if(mysqli_num_rows($Selected_run)>0)
									{
										$Quantity = mysqli_fetch_array($Selected_run);
										if($Quantity['Product_Quantity']>=10)
										{
											?>
											<p><h3>Size <?php echo $Selected_Size?> : <strong><?php echo $Quantity['Product_Quantity']?></strong> in stock </h3></p>
											<?php
										}
										else
										{
											?>
											<p><h3>Size <?php echo $Selected_Size?> : Just <strong> <?php echo $Quantity['Product_Quantity']?></strong> in stock</h3></p>
											<?php
										}
									}
								}
								?>
							<table class="table table-bordered table-striped">
                       	 	<thead>
                            <tr>
                                <th>EU Size</th>
                                <th>Centimeters</th>
                            </tr>    
                        	</thead>
                        	<tbody>
							<?php
								$Size_Details = "SELECT * FROM size";
								$Size_Details_Run = mysqli_query($dataconnection,$Size_Details);
								if(mysqli_num_rows($Size_Details_Run) > 0)
								{
									foreach($Size_Details_Run as $Details)
									{
										?>
										<tr>
										<td><?php echo $Details['EUsize']?></td>
										<td><?php echo $Details['CMsize']?> cm</td>
										</tr>
										<?php
									}
								}
							?>
							</tbody>
							</table>			
							</div>	
							<form action="cartcode.php" method="POST">	
                     <div class="input-group mb-4">
						<?php
						if(isset($_GET['size']))
						{
							?>
							<strong>Quantity :  &nbsp</strong>
							<input type="number" class="pqty" onKeyDown="return false" name="quantity" class="form-control input-number" value="1" min="1" max="<?php echo $Quantity['Product_Quantity']?>">
							<?php
						}
						?>	
                  	</div>
                  	<div class="row">
						<p> 
						<?php
						if(isset($_SESSION['Msg']))
						{
							$message = $_SESSION['Msg'];
							echo "<script>alert('$message')</script>";
							unset($_SESSION['Msg']);
						}
						?>
						</p>
						<?php
						if(isset($_GET['size']))
						{
							?>
							<input type="hidden" name="pid" value="<?= $Data['ID'] ?>">
							<input type="hidden" name="pname" value="<?= $Data['Pro_Name'] ?>">
							<input type="hidden" name="pprice" value="<?= $Data['Pro_Price'] ?>">
							<input type="hidden" name="pimage" value="<?= $Data['Pro_Image'] ?>">
							<input type="hidden" name="psize" value="<?php echo $_GET['size']?>">
							<?php
						}
						else
						{
							?>
								<input type="hidden" name="pid" value="<?= $Data['ID'] ?>">
							<?php
						}
						?>
						<?php
						if(isset($_GET['size']))
						{
							?>
							<div class="col-sm-12 text-center">
							<button class="btn btn-info btn-block" name="addItemBtn">Add to cart</button>
								  </div>
							  </div>
						  	</div>
						  <?php
						}
						else
						{
							?>
							<div class="col-sm-12 text-center">
							<br>
								  </div>
							  </div>
						  	</div>
							<?php
						}
						?>
	                  	
					</div>
						</form>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-md-12 pills">
								<div class="bd-example bd-example-tabs">
								  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

								    <li class="nav-item">
								      <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Description</a>
								    </li>
								  </ul>

								  <div class="tab-content" id="pills-tabContent">
								  	<div class="tab-pane border fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
								    	<p><?php echo $Data['Pro_Description']?></p>	
								    </div>
								  </div>
								</div>
				         </div>
						</div>
					</div>
				</div>
			</div>
		</div>
					<div class="gototop js-top">
					<a href="#" class="js-gotop"><i class="ion-ios-arrow-up"></i></a>
					</div>			
					<?php				
				}
				else
				{
				echo ' error ';
				}
			}
			else
			{
				echo ' error ';
			}
        ?>
								
<?php /*							
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>				
	

	<script type="text/javascript">
  	$(document).ready(function() {

    // Send product details in the server
    $(".addItemBtn").click(function(e) {
      var $form = $(this).closest(".form-submit");
      var pid = $form.find(".pid").val();
      var pname = $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();
      var pimage = $form.find(".pimage").val();
      var pqty = $form.find(".pqty").val();
      $.ajax
	  (
	{
        url: 'action.php',
        method: 'post',
        data: {
          pid: pid,
          pname: pname,
          pprice: pprice,
          pqty: pqty,
          pimage: pimage,
        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);
          load_cart_item_number();
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
*/
?>
	</body>

<?php include("includes/footer.php")?>
<?php include("includes/scripts.php")?>

