<?php session_start();?>
<?php include("dataconnection.php");?>
<?php
if(isset($_POST['saveprobtn']))
{
    $User_ID = $_POST['user_id'];
    $User_Fname = $_POST['fname'];
    $User_Lname = $_POST['lname'];
    $User_Email = $_POST['email'];
    $User_Password = $_POST['pass'];
    $User_Phone = $_POST['phone'];
    $User_Address = $_POST['address'];
    $User_Status = '1';

    if(!preg_match("/^[a-zA-Z]+$/",$User_Fname))
    {
        $_SESSION['message'] = "Invalid First Name!";
        header("location: editprofile.php?id=$User_ID");
    }
    else if(!preg_match("/^[a-zA-Z]+$/",$User_Lname))
    {
        $_SESSION['message'] = "Invalid Last Name!";
        header("location: editprofile.php?id=$User_ID");
    }
    else if(!preg_match('/^[0-9]{10,11}+$/', $User_Phone))
    {
        $_SESSION['message'] = "Invalid Phone Number!";
        header("location: editadmin.php?id=$User_ID");
    }
    else
    {
        $Editprofile = "UPDATE user SET User_Email='$User_Email',User_Password = '$User_Password',User_First_Name='$User_Fname',User_Last_Name='$User_Lname',User_Status='$User_Status',User_Phone='$User_Phone',User_Address='$User_Address' WHERE ID = $User_ID";
        $Editprofile_run = mysqli_query($userconnection,$Editprofile);
        if($Editprofile)
        {
            $_SESSION['message'] = "Profile Edited Successfully";
            header("Location: editprofile.php?id=$User_ID");
        }
        else
        {
            $_SESSION['message'] = "Profile Edited Unsuccessfully";
            header("Location: editprofile.php?id=$User_ID");
        }
    }
    
}

else if(isset($_POST['savepassbtn']))
{
        $User_ID = $_POST['user_id'];
        $Old_Pass = $_POST['opassword'];
        $New_Pass = $_POST['password'];
        $Con_Pass = $_POST['cpassword'];
        $uppercase = preg_match('@[A-Z]@', $New_Pass);
        $lowercase = preg_match('@[a-z]@', $New_Pass);
        $number    = preg_match('@[0-9]@', $New_Pass);

        if($Old_Pass == $New_Pass)
        {
            $_SESSION['message'] = "New Password is same as Old Password!";
            header("location: editpass.php?id=$User_ID");
        }
        else
        {
            if(!$uppercase || !$lowercase || !$number || strlen($New_Pass) < 8)
            {
                $_SESSION['message'] = "New Password must be at least 8 characters in length, and should include at least one upper case letter and one number";
                header("location: editpass.php?id=$User_ID");
            }
            else
            {
                if($New_Pass != $Con_Pass)
                {
                    $_SESSION['message'] = "New Password is not same as Confirm Password!";
                    header("location: editpass.php?id=$User_ID");
                }
                else
                {
                    $Pass = "UPDATE user SET User_Password='$New_Pass' WHERE ID = '$User_ID' ";
                    $Pass_Query = mysqli_query($userconnection,$Pass);
                    if($Pass_Query)
                    {
                        $_SESSION['message'] = "Password had been changed successfully!";
                        header("location: editpass.php?id=$User_ID");
                    }
                }
            }
        }
}
else if(isset($_POST['resetpassbtn']))
{
        $Token = $_POST['user_token'];
        $Email = $_POST['user_email'];
        $New_Pass = $_POST['password'];
        $Con_Pass = $_POST['cpassword'];
        $uppercase = preg_match('@[A-Z]@', $New_Pass);
        $lowercase = preg_match('@[a-z]@', $New_Pass);
        $number    = preg_match('@[0-9]@', $New_Pass);
        if(!empty($Token))
        {
            $Check_Token = "SELECT * FROM user WHERE User_Token = '$Token'";
            $Check_Token_Run = mysqli_query($userconnection,$Check_Token);
            if(mysqli_num_rows($Check_Token_Run) > 0)
            {
                if(!$uppercase || !$lowercase || !$number || strlen($New_Pass) < 8)
                {
                    $_SESSION['message'] = "New Password must be at least 8 characters in length, and should include at least one upper case letter and one number";
                    header("location: passreset.php?token=$Token&email=$Email");
                }
                else
                {
                    if($New_Pass != $Con_Pass)
                    {
                        $_SESSION['message'] = "New Password is not same as Confirm Password!";
                        header("location: passreset.php?token=$Token&email=$Email");
                    }
                    else
                    {
                        $Pass = "UPDATE user SET User_Password='$New_Pass' WHERE User_Email = '$Email' AND User_Token = '$Token'";
                        $Pass_Query = mysqli_query($userconnection,$Pass);
                        if($Pass_Query)
                        {
                            $New_Token = md5(rand());
                            $Update_Token = "UPDATE user SET User_Token = '$New_Token' WHERE User_Token='$Token'" ;
                            $Update_Token_Run = mysqli_query($userconnection,$Update_Token);
                            $_SESSION['message'] = "Password had been reset successfully!";
                            header("location: login.php");
                        }
                        else
                        {
                            $_SESSION['message'] = "Password had been reset unsuccessfully!";
                            header("location: passreset.php?token=$Token&email=$Email");
                        }
                    }
                }
            }
            else
            {
            $_SESSION['message'] = "Invalid User Token!";
            header("location: login.php");
            }
        }
        else
        {
            $_SESSION['message'] = "Invalid User Token!";
            header("location: login.php");
        }
            
        
}
?>