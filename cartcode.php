<?php
session_start();
include("dataconnection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor\autoload.php';
?>


<?php
function send_receipt($Order_ID,$FName,$LName,$Email,$Phone,$Address,$Total,$Payment_Method)
{
    if($Payment_Method == 'COD')
    {
        $Payby = "Cash On Delivery";
    }
    else
    {
        $Payby = "Credit/Debit Card";
    }
    
   

    $mail = new PHPMailer(TRUE);
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = "smtp.gmail.com";                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

    $mail->Username   = "KNMSHOES123@gmail.com";                     //SMTP username
    $mail->Password   = "gxqeorbhbyhdxmkj";                               //SMTP password
    $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom("KNMSHOES123@gmail.com", "KNM_SHOES");
    $mail->addAddress($Email);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Payment Summary';
    $mail->Body    = "<h2>Thanks For Purchasing In KNM SHOES!$FName $LName</h2>
                      <h3>Your Email : $Email</h3>
                      <h3>Phone : $Phone </h3>
                      <h3>Shipping Address : $Address </h3>
                      <h3>Total Price : RM $Total</h3>
                      <h3>Pay by : $Payby </h3>
                      <br/><br/>
                      ";
    $mail->send();                                
}

if(isset($_POST['addItemBtn']))
{
    $Pro_ID = $_POST['pid'];
    if(isset($_POST['psize']))
    {
        $Product = "SELECT * FROM product WHERE ID='$Pro_ID'";
        $Product_Run = mysqli_query($dataconnection,$Product);
        if(mysqli_num_rows($Product_Run) > 0)
        {
            $row = mysqli_fetch_array($Product_Run); 
            $Name = $row['Pro_Name'];
            $Price = $row['Pro_Price'];
            $Image = $row['Pro_Image'];
            $Quantity = $_POST['quantity'];
            $Size = $_POST['psize'];
            $Total = $Price * $Quantity;
            $Check_Cart = "SELECT * FROM cart WHERE product_id='$Pro_ID' AND size='$Size' ";
            $Check_Cart_Run = mysqli_query($userconnection,$Check_Cart);
            if(mysqli_num_rows($Check_Cart_Run) > 0)
            {
                $Cart = mysqli_fetch_array($Check_Cart_Run);
                $New_qtty = $Cart['qty'] + $Quantity;
                $Check_qtty = "SELECT * FROM stock WHERE Product_ID = '$Pro_ID' AND $Size";
                $Check_qtty_run = mysqli_query($dataconnection,$Check_qtty);
                $Stock_qtty = mysqli_fetch_array($Check_qtty_run);
                if($New_qtty > $Stock_qtty['Product_Quantity'])
                {
                    $_SESSION['Msg'] = "The product had exceeded current stock!";
                    header("location: products.php?title=$Pro_ID");
                }
                else
                {
                    $query = "UPDATE cart SET qty = $New_qtty WHERE product_id='$Pro_ID' AND size='$Size'";
                    $query_run = mysqli_query($userconnection,$query);
                    if($query_run)
                    {
                        $_SESSION['Msg'] = "The product had been added to the cart!";
                        header("location: products.php?title=$Pro_ID");    
                    }
                    else
                    {
                        header("location: products.php?title=$Pro_ID");    
                    }
                }
            }
            else
            {
                $query = "INSERT INTO cart (product_id,qty,size,total_price) VALUES ('$Pro_ID','$Quantity','$Size','$Total')";
                $query_run = mysqli_query($userconnection,$query);
        
                if($query_run)
                {
                    $_SESSION['Msg'] = "The product had been added to the cart!";
                    header("location: products.php?title=$Pro_ID");    
                }
                else
                {
                    header("location: products.php?title=$Pro_ID");    
                }
            }
            
        }
        else
        {
            $_SESSION['Msg'] = "The product is unvailable!";
            header("location: categories.php");
        }
        
    }
    else
    {
        $_SESSION['Msg'] = "Please Select Size Before Add to Cart!";
        header("location: products.php?title=$Pro_ID");    
    }
    

   
}

// Set total price of the product in the cart table
else if (isset($_POST['qty'])) {
  $qty = $_POST['qty'];
  $pid = $_POST['pid'];
  $pprice = $_POST['pprice'];

  $tprice = $qty * $pprice;

  $Change = "UPDATE cart SET qty='$qty',total_price = '$tprice' WHERE id = '$pid'" ;
  $Change_Run = mysqli_query($userconnection,$Change);
  
}
else if(isset($_POST['deleteItemBtn']))
{
    $Pro_ID = $_POST['pro_id'];
    $query = "DELETE FROM cart WHERE id = '$Pro_ID' ";
    $query_run = mysqli_query($userconnection,$query);

    if($query_run)
    {
        $_SESSION['Msg'] = "The product had been deleted from the cart!";
        header("location: cart.php");    
    }
}

else if(isset($_POST['placeorderbtn']))
{
    $User_ID = $_POST['user_id'];
    $FName = $_POST['fname'];
    $LName = $_POST['lname'];
    $Email = $_POST['email'];
    $Phone = $_POST['phone'];
    $Total = $_POST['gtotal'];
    $Address = $_POST['address'];
    $Payment_Method = $_POST['optradio'];
    if($Payment_Method == "Credit/Debit")
    {
        header("Location: card-payment.php?fname=$FName&lname=$LName&Email=$Email&Phone=$Phone&Total=$Total&Address=$Address");
    }
    else
    {
        $Order = "INSERT INTO orders (user_id,fname,lname,email,phone,address,amount_paid,Status,payment_method) VALUES ('$User_ID','$FName','$LName','$Email','$Phone','$Address','$Total','0','$Payment_Method')";
        $Order_Run = mysqli_query($userconnection,$Order);
        if($Order_Run)
        {
            $Order_ID = mysqli_insert_id($userconnection);
            $Product = "SELECT * FROM cart";
            $Product_run = mysqli_query($userconnection,$Product);
            if(mysqli_num_rows($Product_run) > 0)
            {
                foreach($Product_run as $data)
                {
                    $Size = $data['size'];
                    $Quantity = $data['qty'];
                    $Pro_ID = $data['product_id'];
                    $Pro = "SELECT * FROM product WHERE ID = '$Pro_ID'";
                    $Pro_Run = mysqli_query($dataconnection,$Pro);
                    if(mysqli_num_rows($Pro_Run)>0)
                    {   
                        $Order_Details = "INSERT INTO orders_details (Product_ID,Order_ID,Order_Size,Order_Quantity) VALUES ('$Pro_ID','$Order_ID','$Size','$Quantity')";
                        $Order_Details_Run = mysqli_query($userconnection,$Order_Details);
                        $Get_Stock = "SELECT * FROM stock WHERE Product_ID = '$Pro_ID' AND Product_Size ='$Size'";
                        $Get_Stock_Run = mysqli_query($dataconnection,$Get_Stock);
                        if(mysqli_num_rows($Get_Stock_Run)>0)
                        {
                            $Stock_Row = mysqli_fetch_array($Get_Stock_Run);
                            $qtty = $Stock_Row['Product_Quantity'];
                            $deduct_stock = $qtty - $Quantity;
                            $Update_Stock = "UPDATE stock SET Product_Quantity='$deduct_stock' WHERE Product_ID='$Pro_ID' AND Product_Size='$Size'";
                            $Update_Stock_Run = mysqli_query($dataconnection,$Update_Stock);   
                        }
                    } 
                }
            }
        }
        send_receipt($Order_ID,$FName,$LName,$Email,$Phone,$Address,$Total,$Payment_Method);
        $clear_cart = "TRUNCATE TABLE cart";
        $clear_cart_run = mysqli_query($userconnection,$clear_cart);
        $_SESSION['Items'] = "0";
        $_SESSION['message'] = "Order Placed Successfully!";
        header("Location: order-complete.php");
    }
       
}
else if(isset($_POST['paymentcardbtn']))
    {
        $FName = $_POST['fname'];
        $LName = $_POST['lname'];
        $Email = $_POST['email'];
        $Phone = $_POST['phone'];
        $Total = $_POST['gtotal'];
        $Address = $_POST['address'];
        $Payment_Method = 'Credit/Debit';
        $User_ID = $_SESSIONI['D'];
        $Card_Name = $_POST['name'];
        $Card_Number = $_POST['number'];
        $Card_Month = $_POST['month'];
        $Card_Year = $_POST['year'];
        $Card_CVV = $_POST['CVV'];
        $Check_Card = "SELECT * FROM card";
        $Check_Card_Run = mysqli_query($userconnection,$Check_Card);
        $Card_Details = mysqli_fetch_array($Check_Card_Run);

        if(!preg_match("/^[a-zA-Z]+ [a-zA-Z]+ [a-zA-Z]+$/",$Card_Name) || $Card_Details['Card_Name'] != $Card_Name)
        {
            $_SESSION['message'] = "Invalid Name on Card!";
            header("Location: card-payment.php?fname=$FName&lname=$LName&Email=$Email&Phone=$Phone&Total=$Total&Address=$Address");
        }
        else if(!preg_match("/^[0-9]{16}+$/",$Card_Number) || $Card_Details['Card_Number'] != $Card_Number)
        {
            $_SESSION['message'] = "Invalid Card Number!";
            header("Location: card-payment.php?fname=$FName&lname=$LName&Email=$Email&Phone=$Phone&Total=$Total&Address=$Address");
        }
        else if($Card_Month <0 || $Card_Year<0 || $Card_Month > 12 || $Card_Year < 23)
        {
            $_SESSION['message'] = "Invalid Expiry Date!";
            header("Location: card-payment.php?fname=$FName&lname=$LName&Email=$Email&Phone=$Phone&Total=$Total&Address=$Address");
        }
        else if($Card_Month != $Card_Details['Expiry_Month'] || $Card_Year != $Card_Details['Expiry_Year'])
        {
            $_SESSION['message'] = "Incorrect Expiry Date!";
            header("Location: card-payment.php?fname=$FName&lname=$LName&Email=$Email&Phone=$Phone&Total=$Total&Address=$Address");
        }
        else if(!preg_match("/^[0-9]{3}+$/",$Card_CVV) || $Card_Details['Card_CVV'] != $Card_CVV)
        {
            $_SESSION['message'] = "Invalid CVV!";
            header("Location: card-payment.php?fname=$FName&lname=$LName&Email=$Email&Phone=$Phone&Total=$Total&Address=$Address");
        }
        else
        {
            $Order = "INSERT INTO orders (user_id,fname,lname,email,phone,address,amount_paid,Status,payment_method) VALUES ('$User_ID','$FName','$LName','$Email','$Phone','$Address','$Total','0','$Payment_Method')";
            $Order_Run = mysqli_query($userconnection,$Order);
            if($Order_Run)
            {
                $Order_ID = mysqli_insert_id($userconnection);
                $Product = "SELECT * FROM cart";
                $Product_run = mysqli_query($userconnection,$Product);
                if(mysqli_num_rows($Product_run) > 0)
                {
                    foreach($Product_run as $data)
                    {
                        $Size = $data['size'];
                        $Quantity = $data['qty'];
                        $Pro_ID = $data['product_id'];
                        $Pro = "SELECT * FROM product WHERE ID = '$Pro_ID'";
                        $Pro_Run = mysqli_query($dataconnection,$Pro);
                        if(mysqli_num_rows($Pro_Run)>0)
                        {   
                            $Order_Details = "INSERT INTO orders_details (Product_ID,Order_ID,Order_Size,Order_Quantity) VALUES ('$Pro_ID','$Order_ID','$Size','$Quantity')";
                            $Order_Details_Run = mysqli_query($userconnection,$Order_Details);
                            $Get_Stock = "SELECT * FROM stock WHERE Product_ID = '$Pro_ID' AND Product_Size ='$Size'";
                            $Get_Stock_Run = mysqli_query($dataconnection,$Get_Stock);
                            if(mysqli_num_rows($Get_Stock_Run)>0)
                            {
                                $Stock_Row = mysqli_fetch_array($Get_Stock_Run);
                                $qtty = $Stock_Row['Product_Quantity'];
                                $deduct_stock = $qtty - $Quantity;
                                $Update_Stock = "UPDATE stock SET Product_Quantity='$deduct_stock' WHERE Product_ID='$Pro_ID' AND Product_Size='$Size'";
                                $Update_Stock_Run = mysqli_query($dataconnection,$Update_Stock);   
                            }
                        } 
                    }
                    send_receipt($Order_ID,$FName,$LName,$Email,$Phone,$Address,$Total,$Payment_Method);
                }
            }
            $clear_cart = "TRUNCATE TABLE cart";
            $clear_cart_run = mysqli_query($userconnection,$clear_cart);
            $_SESSION['Items'] = "0";
            $_SESSION['message'] = "Order Placed Successfully!";
            header("Location: order-complete.php");
            }
        
    }
?>