<?php
$c_con = 0;

function check_w_ru($sql){
    global $c_con,$conn,$row;
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        die('SQL error');
    }
    else if($c_con===0)
    {   
        include 'useauthu.i.php';
    }else if($c_con===1){
        include 'useauthu.i.php'; 
    }
}

$sql = "select `investor_email_id`, `linked_in`, `name`, `phone`, `type_of_invest`, `invest_buget`, `invested_before`, `address`, `profile_pic` from investor as i where i.investor_email_id = ? ";
$po = check_w_ru($sql);
if($c_con===0){

}else{
    $sql = "select `fundraiser_email_id`, `linked_in`, `name`, `phone`, `address`, `profile_pic` from fundraiser as f where f.fundraiser_email_id = ? ";
    check_w_ru($sql);
    if($c_con===1){

    }
    else if($c_con===2){
            echo '<div class="h1 mt-5 pt-3 alert alert-danger">
            <marquee>
            <strong>404</strong> : User Not Found 
            <strong>404</strong> : User Not Found 
            </marquee>
            </div>';
            exit();
    }
}
?>