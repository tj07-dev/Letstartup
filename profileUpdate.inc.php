<?php
session_start();

if (isset($_POST['update-profile']))
{
    
    require 'dbh.inc.php';
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $oldPassword = $_POST['old-pwd'];
    $password = $_POST['pwd'];
    $passwordRepeat  = $_POST['pwd-repeat'];
    $gender = $_POST['gender'];
    $p_no = $_POST['pnum'];
    $address = $_POST['add'];

    
    
    if (empty($email))
    {
        header("Location: edit-profile.php?error=emptyemail");
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        header("Location: edit-profile.php?error=invalidmail");
        exit();
    }
    else
    {
        
        if($_SESSION['u_prof']!='in'){
            $sql = "SELECT * FROM fundraiser WHERE fundraiser_email_id=?;";
        }else{
            $sql = "SELECT * FROM investor WHERE investor_email_id=?;";
        }
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: edit-profile.php?error=sqlerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['emailId']);
            mysqli_stmt_execute($stmt);
            
            $result = mysqli_stmt_get_result($stmt);
           
            
            if($row = mysqli_fetch_assoc($result))
            {
                $pwdChange = false;
                
                if( (!empty($password) || !empty($passwordRepeat)) && empty($oldPassword))
                {
                    header("Location: edit-profile.php?error=emptyoldpwd");
                    exit();
                }
                if( empty($password) && empty($passwordRepeat) && !empty($oldPassword))
                {
                    header("Location: edit-profile.php?error=emptynewpwd");
                    exit();
                }
                if (!empty($password) && empty($passwordRepeat) && !empty($oldPassword))
                {
                    header("Location: edit-profile.php?error=emptyreppwd");
                    exit();
                }
                if (empty($password) && !empty($passwordRepeat) && !empty($oldPassword))
                {
                    header("Location: edit-profile.php?error=emptynewpwd");
                    exit();
                }
                if (!empty($password) && !empty($passwordRepeat) && !empty($oldPassword))
                {
                    $pwdCheck = password_verify($oldPassword, $row['password']);
                    if ($pwdCheck == false)
                    {
                        header("Location: edit-profile.php?error=wrongpwd");
                        exit();
                    }
                    if ($oldPassword == $password)
                    {
                        header("Location: edit-profile.php?error=samepwd");
                        exit();
                    }
                    if ($password !== $passwordRepeat)
                    {
                        header("Location: edit-profile.php?error=passwordcheck&mail=".$email);
                        exit();
                    }
                    $pwdChange = true;
                }
                
                    

                    $FileNameNew = $_SESSION['profilePic'];
                    require 'upload.inc.php';

                    if($_SESSION['u_prof']!='in'){
                        $user_p_id='fundraiser_email_id';
                        $sql = "UPDATE fundraiser " 
                        ."SET fundraiser_email_id=?,"
                        ."name=?,"
                        ."phone=?,"
                        ."address=?,"
                        ."profile_pic=?,"
                        ."gender=? ";

                                
                    }else{
                        $user_p_id='investor_email_id';
                        $sql = "UPDATE investor " 
                        ."SET investor_email_id=?,"
                        ."name=?,"
                        ."phone=?,"
                        ."address=?,"
                        ."profile_pic=?,"
                        ."gender=? ";
                    }
                    if ($pwdChange)
                    {
                        $sql .= ", password=? "
                                . "WHERE ".$user_p_id."=?;";
                    }
                    else
                    {
                        $sql .= "WHERE ".$user_p_id."=?;";
                    }
                    
                    
                    $stmt = mysqli_stmt_init($conn);
                    
                    if (!mysqli_stmt_prepare($stmt, $sql))
                    {
                        header("Location: edit-profile.php?error=sqlerror");
                        // echo sql;
                        exit();
                    }
                    else
                    {
                        if ($pwdChange)
                        {
                            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ssssssss", $email,$name, $p_no, $address,$FileNameNew,
                                $gender, $hashedPwd,$email);
                        }
                        else
                        {
                            mysqli_stmt_bind_param($stmt, "sssssss", $email,$name, $p_no, $address,$FileNameNew,$gender,$email);
                        }
                        

                        
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                        

                    $_SESSION['emailId'] = $email;
                    $_SESSION['name'] = $name;
                    $_SESSION['phone'] = $p_no;
                    $_SESSION['address'] = $address;
                    $_SESSION['profilePic'] = $FileNameNew;
                    $_SESSION['gender'] = $gender;

                        header("Location: edit-profile.php?edit=success");
                        exit();
                    }
                
            }
            else 
            {
                header("Location: edit-profile.php?error=sqlerror");
                exit();
            }
        }
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
}

else
{
    header("Location: edit-profile.php");
    exit();
}