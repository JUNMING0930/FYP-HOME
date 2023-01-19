<?php include("dataconnection.php");?>
<?php
    if(isset($_GET["cate"]))
    {
        $Cate_Name = $_GET["cate"];
        $page_title = $Cate_Name;
        include("includes/header.php")
?>
		<div class="breadcrumbs-two">
			<div class="container">
				<div class="row mb-2">
					<div class="col">
                        <h2 style ="font-size:60px"><?php echo $Cate_Name?></h2>
                        <form action="categories.php?cate=<?php echo $Cate_Name?>" method="POST">
                        <h5><label for="">Sort By:</label>
                        <select name="sort">
                        <?php
                                if(isset($_POST['sort']))
                                {
                                    $Sort = $_POST['sort'];
                                    switch($Sort)
                                    {
                                        case 'PHL' :
                                        ?>      
                                        <option value="">No Sorting</option>
                                        <option value="PHL" selected><a href="sorting.php">Price: High To Low</a></option>
                                        <option value="PLH">Price: Low To High</option>
                                        <option value="NA">Name : A-Z</option>
                                        <option value="ND">Name : Z-A</option>
                                        <?php              
                                        break;
                                        case 'PLH' :
                                        ?>      
                                        <option value="">No Sorting</option>
                                        <option value="PHL"><a href="sorting.php">Price: High To Low</a></option>
                                        <option value="PLH" selected>Price: Low To High</option>
                                        <option value="NA">Name : A-Z</option>
                                        <option value="ND">Name : Z-A</option>
                                        <?php         
                                                    
                                        break;
                                        case 'NA' :
                                        ?>      
                                        <option value="">No Sorting</option>
                                        <option value="PHL"><a href="sorting.php">Price: High To Low</a></option>
                                        <option value="PLH">Price: Low To High</option>
                                        <option value="NA" selected>Name : A-Z</option>
                                        <option value="ND">Name : Z-A</option>
                                        <?php     
                                        
                                        break;
                                        case 'ND' :
                                        ?>      
                                        <option value="">No Sorting</option>
                                        <option value="PHL"><a href="sorting.php">Price: High To Low</a></option>
                                        <option value="PLH">Price: Low To High</option>
                                        <option value="NA">Name : A-Z</option>
                                        <option value="ND" selected>Name : Z-A</option>
                                        <?php         
                                        
                                        break;               
                                        case '' :   
                                        ?>      
                                        <option value="" selected>No Sorting</option>
                                        <option value="PHL" ><a href="sorting.php">Price: High To Low</a></option>
                                        <option value="PLH">Price: Low To High</option>
                                        <option value="NA">Name : A-Z</option>
                                        <option value="ND">Name : Z-A</option>
                                        <?php              
                                        break;
                                    }
                                }
                                else
                                {
                                    ?>      
                                        <option value="">No Sorting</option>
                                        <option value="PHL"><a href="sorting.php">Price: High To Low</a></option>
                                        <option value="PLH">Price: Low To High</option>
                                        <option value="NA">Name : A-Z</option>
                                        <option value="ND">Name : Z-A</option>
                                        <?php   
                                }
                            ?>
                        </select>
                        <button type="submit" class="btn btn-secondary" >sort</button>
                        </form>
                        </h5>
                            <?php
                                $Category = "SELECT ID,Cate_Name FROM category WHERE Cate_Name = '$Cate_Name' AND Cate_Status = '1' ";
                                $Category_Run = mysqli_query($dataconnection,$Category);

                                if(mysqli_num_rows($Category_Run) >0 )
                                {
                                    $Category_Items = mysqli_fetch_array($Category_Run);
                                    $Category_ID = $Category_Items['ID'];
                                    if(isset($_POST['sort']))
                                    {
                                        $Sort = $_POST['sort'];
                                        switch($Sort)
                                        {
                                            case 'PHL' : $Product = "SELECT ID,Category_ID,Pro_Name,Pro_Price,Pro_Image FROM product WHERE Category_ID = '$Category_ID' AND Pro_Status = '1' ORDER BY Pro_Price DESC";
                                                         $Product_Run = mysqli_query($dataconnection,$Product);
                                                         break;
                                            case 'PLH' : $Product = "SELECT ID,Category_ID,Pro_Name,Pro_Price,Pro_Image FROM product WHERE Category_ID = '$Category_ID' AND Pro_Status = '1' ORDER BY Pro_Price ASC";
                                                         $Product_Run = mysqli_query($dataconnection,$Product);
                                                         break;
                                            case 'NA' : $Product = "SELECT ID,Category_ID,Pro_Name,Pro_Price,Pro_Image FROM product WHERE Category_ID = '$Category_ID' AND Pro_Status = '1' ORDER BY Pro_Name ASC";
                                                        $Product_Run = mysqli_query($dataconnection,$Product);
                                                         break;
                                            case 'ND' : $Product = "SELECT ID,Category_ID,Pro_Name,Pro_Price,Pro_Image FROM product WHERE Category_ID = '$Category_ID' AND Pro_Status = '1' ORDER BY Pro_Name DESC";
                                                        $Product_Run = mysqli_query($dataconnection,$Product);
                                                        break;                
                                            case '' :  $Product = "SELECT ID,Category_ID,Pro_Name,Pro_Price,Pro_Image FROM product WHERE Category_ID = '$Category_ID' AND Pro_Status = '1' ";
                                                       $Product_Run = mysqli_query($dataconnection,$Product);                               
                                        }
                                    }
                                    else
                                    {
                                        $Product = "SELECT ID,Category_ID,Pro_Name,Pro_Price,Pro_Image FROM product WHERE Category_ID = '$Category_ID' AND Pro_Status = '1'";
                                        $Product_Run = mysqli_query($dataconnection,$Product);
                                    }
                                    if(mysqli_num_rows($Product_Run) > 0)
                                    {
                                        ?>
                                                <div class="row">
                                                    <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                                                        <h2>View All Products</h2>
                                                    </div>
                                                </div>
                    </div>
                </div>    
            </div>
        </div>
        <div class="colorlib-product">
            <div class="container">
                <div class="row">
                        <div class="col">
                            <div class="row row-pb-md">    
                                        <?php
                                        foreach($Product_Run as $Product_Items)
                                        {
                                            ?>
                                                        <div class="col-lg-3 mb-4 text-center">
                                                            <div class="product-entry border">
                                                                <a href="products.php?title=<?php echo $Product_Items['ID']?>" class="prod-img">
                                                                    <img src="../Admin/uploads/products/<?php echo $Product_Items['Pro_Image']?>" class="img-fluid">
                                                                </a>
                                                                <div class="desc">
                                                                    <h2><a href="products.php?title=<?php echo $Product_Items['ID']?>"><?php echo $Product_Items['Pro_Name']?></a></h2>
                                                                    <span class="price"><strong>RM  <?php echo $Product_Items['Pro_Price'];?></strong></span>
                                                                </div>
                                                            </div>
                                                        </div>                
                                            <?php            
                                        }
                                    ?>
                            </div>
                        </div>
                    </div>                
                </div>                     
            </div>
        </div>                         
<?php
                                    }
                                }
    }
    else if(isset($_GET['search']))
    {
        $keyword = $_GET['search'];
        $page_title = "Products";
        include("includes/header.php");
        ?>
        <div class="breadcrumbs-two">
            <div class="container">
				<div class="row mb-2">
                    <div class="col">    
                        <h2 style ="font-size:60px">Search Result : <?php echo $keyword?></h2>
                        <form action="categories.php?search=<?php echo $keyword?>" method="POST">
                        <h5><label for="">Sort By:</label>
                        <select name="sort">
                        <?php
                                if(isset($_POST['sort']))
                                {
                                    $Sort = $_POST['sort'];
                                    switch($Sort)
                                    {
                                        case 'PHL' :
                                        ?>      
                                        <option value="">No Sorting</option>
                                        <option value="PHL" selected><a href="sorting.php">Price: High To Low</a></option>
                                        <option value="PLH">Price: Low To High</option>
                                        <option value="NA">Name : A-Z</option>
                                        <option value="ND">Name : Z-A</option>
                                        <?php              
                                        break;
                                        case 'PLH' :
                                        ?>      
                                        <option value="">No Sorting</option>
                                        <option value="PHL"><a href="sorting.php">Price: High To Low</a></option>
                                        <option value="PLH" selected>Price: Low To High</option>
                                        <option value="NA">Name : A-Z</option>
                                        <option value="ND">Name : Z-A</option>
                                        <?php         
                                                    
                                        break;
                                        case 'NA' :
                                        ?>      
                                        <option value="">No Sorting</option>
                                        <option value="PHL" ><a href="sorting.php">Price: High To Low</a></option>
                                        <option value="PLH">Price: Low To High</option>
                                        <option value="NA" selected>Name : A-Z</option>
                                        <option value="ND">Name : Z-A</option>
                                        <?php     
                                        
                                        break;
                                        case 'ND' :
                                        ?>      
                                        <option value="">No Sorting</option>
                                        <option value="PHL" ><a href="sorting.php">Price: High To Low</a></option>
                                        <option value="PLH">Price: Low To High</option>
                                        <option value="NA">Name : A-Z</option>
                                        <option value="ND" selected>Name : Z-A</option>
                                        <?php         
                                        
                                        break;               
                                        case '' :   
                                        ?>      
                                        <option value="" selected>No Sorting</option>
                                        <option value="PHL" ><a href="sorting.php">Price: High To Low</a></option>
                                        <option value="PLH">Price: Low To High</option>
                                        <option value="NA">Name : A-Z</option>
                                        <option value="ND">Name : Z-A</option>
                                        <?php              
                                        break;
                                    }
                                }
                                else
                                {
                                    ?>      
                                        <option value="">No Sorting</option>
                                        <option value="PHL"><a href="sorting.php">Price: High To Low</a></option>
                                        <option value="PLH">Price: Low To High</option>
                                        <option value="NA">Name : A-Z</option>
                                        <option value="ND">Name : Z-A</option>
                                        <?php   
                                }
                            ?>
                        </select>
                        <button type="submit" class="btn btn-secondary" >sort</button>
                        </form>
                        </h5>
                        <?php
                            if(isset($_POST['sort']))
                            {
                                $Sort = $_POST['sort'];
                                switch($Sort)
                                {
                                    case 'PHL' : $Product = "SELECT product.* FROM product,category WHERE product.Pro_Status = '1' AND category.Cate_Status='1' AND product.Category_ID = category.ID AND product.Pro_Name LIKE '$keyword%' ORDER BY product.Pro_Price DESC";
                                                 $Product_Run = mysqli_query($dataconnection,$Product);
                                                 break;
                                    case 'PLH' : $Product = "SELECT product.* FROM product,category WHERE product.Pro_Status = '1' AND category.Cate_Status='1' AND product.Category_ID = category.ID AND product.Pro_Name LIKE '$keyword%' ORDER BY product.Pro_Price ASC";
                                                 $Product_Run = mysqli_query($dataconnection,$Product);
                                                 break;
                                    case 'NA' : $Product = "SELECT product.* FROM product,category WHERE product.Pro_Status = '1' AND category.Cate_Status='1' AND product.Category_ID = category.ID AND product.Pro_Name LIKE '$keyword%' ORDER BY product.Pro_Name ASC";
                                    $Product_Run = mysqli_query($dataconnection,$Product);
                                                 break;
                                    case 'ND' : $Product = "SELECT product.* FROM product,category WHERE product.Pro_Status = '1' AND category.Cate_Status='1' AND product.Category_ID = category.ID AND product.Pro_Name LIKE '$keyword%' ORDER BY product.Pro_Name DESC";
                                    $Product_Run = mysqli_query($dataconnection,$Product);
                                                 break;               
                                    case '' :  $Product = "SELECT product.* FROM product,category WHERE product.Pro_Status = '1' AND category.Cate_Status='1' AND product.Category_ID = category.ID AND product.Pro_Name LIKE '$keyword%' ";
                                               $Product_Run = mysqli_query($dataconnection,$Product);   
                                                  break;                            
                                }
                            }    
                            else
                            {
							$Product = "SELECT product.* FROM product,category WHERE product.Pro_Status = '1' AND category.Cate_Status='1' AND product.Category_ID = category.ID AND product.Pro_Name LIKE '$keyword%'";
							$Product_Run = mysqli_query($dataconnection,$Product);
                            }
							if(mysqli_num_rows($Product_Run) > 0)
                            {
                                        ?>
                                                    <div class="row">
                                                        <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                                                            <h2>View All Products</h2>
                                                        </div>
                                                    </div>
                    </div>                
                </div>                        
            </div>    
        </div>     
        <div class="colorlib-product">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="row row-pb-md">
                                        <?php
                                        foreach($Product_Run as $Product_Items)
                                        {
                                            ?>
                                                        <div class=" col-lg-3 mb-4 text-center">
                                                            <div class="product-entry border">
                                                                <a href="products.php?title=<?php echo $Product_Items['ID']?>" class="prod-img">
                                                                    <img src="../Admin/uploads/products/<?php echo $Product_Items['Pro_Image']?>" class="img-fluid">
                                                                </a>
                                                                <div class="desc">
                                                                    <h2><a href="products.php?title=<?php echo $Product_Items['ID']?>"><?php echo $Product_Items['Pro_Name']?></a></h2>
                                                                    <span class="price"><strong>RM  <?php echo $Product_Items['Pro_Price']?></strong></span>
                                                                </div>
                                                            </div>
                                                        </div>     
                                            <?php            
                                        }
                                        ?>
                        </div>
                    </div>
                </div>
            </div>                            
        </div>                      
<?php      
                                    }
                                    else
                                    {
                                        ?>
                                                    <div class="row">
                                                        <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                                                            <h2>No Product Found!</h2>
                                                        </div>
                                                    </div>
                                        <?php
                                    }
    }
	else
	{        
        $page_title = "All Products";
        include("includes/header.php");
?>
        <div class="breadcrumbs-two">
            <div class="container">
				<div class="row mb-2">
                    <div class="col">    
                        <h2 style ="font-size:60px"><?php echo $page_title?></h2>
                        <form action="categories.php" method="POST">
                        <h5><label for="">Sort By:</label>
                        <select name="sort">
                            <?php
                                if(isset($_POST['sort']))
                                {
                                    $Sort = $_POST['sort'];
                                    switch($Sort)
                                    {
                                        case 'PHL' :
                                        ?>      
                                        <option value="">No Sorting</option>
                                        <option value="PHL" selected><a href="sorting.php">Price: High To Low</a></option>
                                        <option value="PLH">Price: Low To High</option>
                                        <option value="NA">Name : A-Z</option>
                                        <option value="ND">Name : Z-A</option>
                                        <?php              
                                        break;
                                        case 'PLH' :
                                        ?>      
                                        <option value="">No Sorting</option>
                                        <option value="PHL"><a href="sorting.php">Price: High To Low</a></option>
                                        <option value="PLH" selected>Price: Low To High</option>
                                        <option value="NA">Name : A-Z</option>
                                        <option value="ND">Name : Z-A</option>
                                        <?php         
                                                    
                                        break;
                                        case 'NA' :
                                        ?>      
                                        <option value="">No Sorting</option>
                                        <option value="PHL" ><a href="sorting.php">Price: High To Low</a></option>
                                        <option value="PLH">Price: Low To High</option>
                                        <option value="NA" selected>Name : A-Z</option>
                                        <option value="ND">Name : Z-A</option>
                                        <?php     
                                        
                                        break;
                                        case 'ND' :
                                        ?>      
                                        <option value="">No Sorting</option>
                                        <option value="PHL"><a href="sorting.php">Price: High To Low</a></option>
                                        <option value="PLH">Price: Low To High</option>
                                        <option value="NA">Name : A-Z</option>
                                        <option value="ND" selected>Name : Z-A</option>
                                        <?php         
                                        
                                        break;               
                                        case '' :   
                                        ?>      
                                        <option value="" selected>No Sorting</option>
                                        <option value="PHL" ><a href="sorting.php">Price: High To Low</a></option>
                                        <option value="PLH">Price: Low To High</option>
                                        <option value="NA">Name : A-Z</option>
                                        <option value="ND">Name : Z-A</option>
                                        <?php              
                                        break;
                                    }
                                }
                                else
                                {
                                    ?>      
                                        <option value="">No Sorting</option>
                                        <option value="PHL"><a href="sorting.php">Price: High To Low</a></option>
                                        <option value="PLH">Price: Low To High</option>
                                        <option value="NA">Name : A-Z</option>
                                        <option value="ND">Name : Z-A</option>
                                        <?php   
                                }
                            ?>
                        </select>
                        <button type="submit" class="btn btn-secondary" >sort</button>
                        </form>
                        </h5>
                        <?php
                            if(isset($_POST['sort']))
                            {
                                $Sort = $_POST['sort'];
                                switch($Sort)
                                {
                                    case 'PHL' : $Product = "SELECT product.* FROM product,category WHERE product.Pro_Status = '1' AND category.Cate_Status='1' AND product.Category_ID = category.ID ORDER BY product.Pro_Price DESC";
                                                $Product_Run = mysqli_query($dataconnection,$Product);
                                                break;
                                    case 'PLH' : $Product = "SELECT product.* FROM product,category WHERE product.Pro_Status = '1' AND category.Cate_Status='1' AND product.Category_ID = category.ID ORDER BY product.Pro_Price ASC";
                                                $Product_Run = mysqli_query($dataconnection,$Product);
                                                break;
                                    case 'NA' : $Product = "SELECT product.* FROM product,category WHERE product.Pro_Status = '1' AND category.Cate_Status='1' AND product.Category_ID = category.ID ORDER BY product.Pro_Name ASC";
                                                 $Product_Run = mysqli_query($dataconnection,$Product);
                                                break;
                                    case 'ND' : $Product = "SELECT product.* FROM product,category WHERE product.Pro_Status = '1' AND category.Cate_Status='1' AND product.Category_ID = category.ID ORDER BY product.Pro_Name DESC";
                                                $Product_Run = mysqli_query($dataconnection,$Product);
                                                break;               
                                    case '' :  $Product = "SELECT product.* FROM product,category WHERE product.Pro_Status = '1' AND category.Cate_Status='1' AND product.Category_ID = category.ID ";
                                                $Product_Run = mysqli_query($dataconnection,$Product);   
                                                break;                            
                                }
                            }    
                            else
                            {
                                $Product = "SELECT product.* FROM product,category WHERE product.Pro_Status = '1' AND category.Cate_Status='1' AND product.Category_ID = category.ID";
                                $Product_Run = mysqli_query($dataconnection,$Product);
                            }
							if(mysqli_num_rows($Product_Run) > 0)
                            {
                                        ?>
                                                    <div class="row">
                                                        <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                                                            <h2>View All Products</h2>
                                                        </div>
                                                    </div>
                    </div>                
                </div>                        
            </div>    
        </div>     
        <div class="colorlib-product">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="row row-pb-md">
                                        <?php
                                        foreach($Product_Run as $Product_Items)
                                        {
                                            ?>
                                                        <div class=" col-lg-3 mb-4 text-center">
                                                            <div class="product-entry border">
                                                                <a href="products.php?title=<?php echo $Product_Items['ID']?>" class="prod-img">
                                                                    <img src="../Admin/uploads/products/<?php echo $Product_Items['Pro_Image']?>" class="img-fluid">
                                                                </a>
                                                                <div class="desc">
                                                                    <h2><a href="products.php?title=<?php echo $Product_Items['ID']?>"><?php echo $Product_Items['Pro_Name']?></a></h2>
                                                                    <span class="price"><strong>RM  <?php echo $Product_Items['Pro_Price']?></strong></span>
                                                                </div>
                                                            </div>
                                                        </div>     
                                            <?php            
                                        }
                                        ?>
                        </div>
                    </div>
                </div>
            </div>                            
        </div>                      
<?php      
                                    }

	}
                            ?>


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
	

	</body>

<?php include("includes/footer.php")?>
<?php include("includes/scripts.php")?>
