<?php
session_start();
if (isset($_POST['idea-submit']))
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
        header("Location: create-post.php?error=emptyfields");
        exit();
    }
    else
    {   if($registerd_s=='yes'){
        $registerd_s = $do_reg_name;
        }
        
        $FileNameNew = 'default.png';
        require 'upload.inc.php';

        $PitchFileNameNew = 'default.pdf';
        require 'uploadfile.inc.php';


        $sql = "insert into posts(post_title, stage, resgister_name,post_img,post_by, post_date, post_content,post_type,post_tag,pitch_file) "
                . "values (?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: create-post.php?error=sqlerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "ssssssssss", $post_title,$s_level,$registerd_s,
            $FileNameNew,$post_by,$post_date,$post_content,
            $post_type,$post_tag,$PitchFileNameNew);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $inss_id =  mysqli_insert_id($conn);
            
        }
        if($single_founder=='no'){
            $sql = "insert into not_single_founder(fundraiser_email_id,other_f_full_name,other_f_email_id,post_id) "
            . "values (?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
    
            if (!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: create-post.php?error=sqlerror");
                exit();
            }
            else
            {
                mysqli_stmt_bind_param($stmt, "ssss",$post_by,$do_name,$do_mail,$inss_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);

            }
        }
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: create-post.php?operation=success");
}

else
{
    header("Location: index.php");
    exit();
}