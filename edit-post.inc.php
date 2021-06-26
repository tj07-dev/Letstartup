<?php
session_start();
if (isset($_POST['idea-submit']) && !empty($_GET['p_id']) )
{
    
    require 'dbh.inc.php';    
    $post_title = $_POST['p_title'];
    $post_type = $_POST['post_t'];
    $post_tag = $_POST['post_tag'];
    $post_content = $_POST['p_content'];
    $post_date = date('l Y-m-d H:i:s');
    $post_by = $_SESSION['emailId'];
    $s_level = $_POST['s_level'];
    $single_founder = $_POST['single_founder'];
    $do_name = $_POST['do_name'];
    $do_mail = $_POST['do_mail'];
    $registerd_s = $_POST['registerd_s'];
    $do_reg_name = $_POST['do_reg_name'];
    
    
    
    if (empty($post_title) || empty($post_content) || empty($single_founder) || empty($registerd_s))
    {
        header("Location: edit-post.php?error=emptyfields");
        exit();
    }
    else
    {   if($registerd_s=='yes'){
        $registerd_s = $do_reg_name;
        }
        
        // $FileNameNew = 'default.png';
        // require 'upload.inc.php';

        $PitchFileNameNew = 'default.pdf';
        require 'uploadfile.inc.php';

        if($single_founder=='no'){
            $sql = "update not_single_founder set other_f_full_name=?,other_f_email_id=? where post_id=? AND fundraiser_email_id=?;";
            $stmt = mysqli_stmt_init($conn);
    
            if (!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: edit-post.php?error=sqlerror");
                exit();
            }
            else
            {
                mysqli_stmt_bind_param($stmt, "ssss",$post_by,$do_name,$_GET['p_id'],$do_mail);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
            }
        }
        $sql = "update posts set post_title=?, stage=?, resgister_name=?, post_date=?, post_content=?,post_type=?,post_tag=?,pitch_file=? where post_id=? ";
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: edit-post.php?error=sqlerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "sssssssss", $post_title,$s_level,$registerd_s,$post_date,$post_content,
            $post_type,$post_tag,$PitchFileNameNew,$_GET['p_id']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            header("Location: edit-post.php?operation=success&p_id=".$_GET['p_id']);
        
        }
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
}

else
{
    header("Location: index.php");
    exit();
}