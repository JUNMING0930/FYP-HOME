<?php session_start();?>
<?php include("dataconnection.php");?>
<?php
if(isset($_POST['loginbtn']))
{
    $User_Email = $_POST['email'];
    $User_Password = $_POST['password'];

    $Login = "SELECT * FROM user WHERE User_Email='$User_Email' AND User_Password = '$User_Password'";
    $Login_run = mysqli_query($userconnection,$Login);

    if(mysqli_num_rows($Login_run) > 0)
    {
        $data = mysqli_fetch_array($Login_run);
        $User_ID = $data['ID']; 
        $User_Fname = $data['User_First_Name'];
        $User_Lname = $data['User_Last_Name']; 
        $User_Email = $data['User_Email'];    
        header("Location: index.php?id=$User_ID");    
        $_SESSION['Email'] = $User_Email; 
        $_SESSION['Name'] = $User_Fname. " " .$User_Lname;
        $_SESSION['Fname'] = $User_Fname;
        $_SESSION['Lname'] = $User_Lname;
        $_SESSION['ID'] = $User_ID;
        $page_title = "Home Page";
        $_SESSION['message'] = "Login Successfully!";
        header("Location: index.php?id=$User_ID");
    }
    else
    {
        $_SESSION['message'] = "Invalid Username or Password";
        header("Location: login.php");
    }
}
?>