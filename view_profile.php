
<?php
    session_start();
    include_once 'dbh.inc.php';

if(!isset($_SESSION['emailId']))
{
    header("Location: login.php");
    exit();
}else{
    if(!empty($_GET['profile_i']) && $_GET['profile_i']!=$_SESSION['emailId'])
    {
        $sql = 'INSERT INTO user_follower(users_id,follower_id) 
        VALUES (?,?)';
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
            die('SQL ERROR');
        }
        else{
            mysqli_stmt_bind_param($stmt,"ss",$_SESSION['emailId'],$_GET['profile_i']);
            mysqli_stmt_execute($stmt);
            header("Location: profile.php?success");
        }
    }
    else if(!empty($_GET['view-profile_i']) && $_GET['view-profile_i']!=$_SESSION['emailId'])
    {   
        include 'Profile/user_prof.php';
    }
    else{
        header("Location: profile.php?error");
    }
}
?> 
</html>