<?php include("dataconnection.php");?>
<?php
session_start();
if(isset($_POST['signupbtn']))
{
    $User_Fname = $_POST['fname'];
    $User_Lname = $_POST['lname'];
    $User_Email = $_POST['email'];
    $User_Password = $_POST['password'];
    $User_Cpassword = $_POST['cpassword'];
    $User_Status = '1';
    $User_Token = md5(rand());

    $Check_User_Email = "SELECT User_Email FROM user WHERE User_Email = '$User_Email'";
    $Check_User_Email_run = mysqli_query($userconnection,$Check_User_Email);
    
    if(!filter_var($User_Email,FILTER_VALIDATE_EMAIL))
    {
        $_SESSION['message'] = "Please Enter Valid Email!";
        header("location: sign-up.php");
    }
    else if(mysqli_num_rows($Check_User_Email_run) > 0 )
    {
    $_SESSION['message'] = "Email Adress is already existed!";
    header("location: sign-up.php");
    }
    else if($User_Password != $User_Cpassword)
    {
        $_SESSION['message'] = "Password is not same as Confirm Password!";
        header("location: sign-up.php");
    }
    else if(!preg_match("/^[a-zA-Z]+$/",$User_Fname))
    {
        $_SESSION['message'] = "Invalid First Name!";
        header("location: sign-up.php");
    }
    else if(!preg_match("/^[a-zA-Z]+$/",$User_Lname))
    {
        $_SESSION['message'] = "Invalid Last Name!";
        header("location: sign-up.php");
    }
    else
    {
        $Signup = "INSERT INTO user (User_Email,User_Password,User_First_Name,User_Last_Name,User_Status,User_Token) VALUES ('$User_Email','$User_Password','$User_Fname','$User_Lname','$User_Status','$User_Token')";
        $Signup_run = mysqli_query($userconnection,$Signup);
        if($Signup_run)
        {
            $_SESSION['message'] = "Account Created Successfully!";
            header("location: login.php");
        }
    }

    

}
?>