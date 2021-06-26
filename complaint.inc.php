<?php
session_start();
if (isset($_POST['c-submit']))
{
    require 'dbh.inc.php';
    $c_title = $_POST['c_title'];
    $c_body = $_POST['c_body'];
    $c_date = date('l Y-m-d H:i:s');
    $c_by = $_SESSION['emailId'];

    if (empty($c_title) || empty($c_body))
    {
        header("Location: complaint.php?error=emptyfields");
        exit();
    }
    else
    {

    $sql = "INSERT INTO `complaint`(`complainee_id`, `date_of_complaint`, `complaint_subject`, `main_complaint`) VALUES (?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        die('SQL ERROR');
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt,"ssss",$c_by,$c_date,$c_title,$c_body);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        header("Location: complaint.php?operation=success");
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    }
    
}

else
{
    header("Location: signup.php");
    exit();
}