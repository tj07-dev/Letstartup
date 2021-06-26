
<?php
    session_start();
    include_once 'dbh.inc.php';

if(!isset($_SESSION['emailId']))
{
    header("Location: login.php");
    exit();
}else{
    if(!empty($_GET['p_id']) &&!empty($_GET['profile_i']) && $_GET['profile_i']!=$_SESSION['emailId'])
    {   

        // intrested user in post

        if($_SESSION['u_prof'] =='in'){
            $sql = 'INSERT INTO i_intrested(post_id, investor_e_id) 
        VALUES (?,?)';
        }
        else{
            $sql = 'INSERT INTO f_intrested(post_id, fundraiser_e_id) 
        VALUES (?,?)';
        }
        
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
            die('SQL ERROR');
        }
        else{
            mysqli_stmt_bind_param($stmt,"ss",$_GET['p_id'],$_SESSION['emailId']);
            mysqli_stmt_execute($stmt);
            header("Location: profile.php?success");
        }
    }
    else if(!empty($_GET['view-noti_i']) && $_GET['view-noti_i']!=$_SESSION['emailId'] && !empty($_GET['po_v_id']))
    {   
        include 'Profile/view-notificition-det.php';
    }
    else{
        header("Location: profile.php?error");
    }
}
?> 
</html>