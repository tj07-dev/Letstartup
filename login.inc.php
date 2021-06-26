<?php

if (isset($_POST['login-submit']))
{
    
    require 'dbh.inc.php';
    
    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];
    $user_p = $_POST['user_p'];
    
    if (empty($mailuid) || empty($password))
    {
        header("Location: login.php?error=emptyfields");
        exit();
    }
    else
    {
        
        if($user_p!='in'){
            $user_p_id='fundraiser_email_id';
            $sql = "SELECT * FROM fundraiser WHERE fundraiser_email_id=?;";
        }else{
            $user_p_id='investor_email_id';
            $sql = "SELECT * FROM investor WHERE investor_email_id=?;";
        }
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: login.php?error=sqlerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $mailuid);
            mysqli_stmt_execute($stmt);
            
            $result = mysqli_stmt_get_result($stmt);
            
            if($row = mysqli_fetch_assoc($result))
            {  
                
                $pwdCheck = password_verify($password, $row['password']);
                if ($pwdCheck == false)
                {
                    header("Location: login.php?error=wrongpwd");
                    exit();
                }
                else if($pwdCheck == true)
                {
                    session_start();
                    $_SESSION['userId'] = $row['id'];
                    $_SESSION['emailId'] = $row[$user_p_id];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['phone'] = $row['phone'];
                    $_SESSION['address'] = $row['address'];
                    $_SESSION['profilePic'] = $row['profile_pic'];
                    $_SESSION['DateOfBirth'] = $row['DOB'];
                    $_SESSION['gender'] = $row['gender'];
                    $_SESSION['u_prof'] = $user_p;
                    
                    
                    
                    header("Location: profile.php?login=success");
                    exit();
                }
                else
                {
                    header("Location: login.php?error=wrongpwd");
                    exit();
                }
            }
            else
            {
                header("Location: login.php?error=nouser");
                exit();
            }
        }
    }
    
}
 else 
{
    header("Location: login.php");
    exit();
}