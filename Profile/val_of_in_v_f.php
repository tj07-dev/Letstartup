<?php


function val_of_in_v_fun($row_i,$conn){
    
    if($_SESSION['u_prof'] =='in'){
        $sql = 'SELECT id FROM i_intrested WHERE post_id=? AND investor_e_id=?;';
    }
    else{
        $sql = 'SELECT id FROM f_intrested WHERE post_id=? AND fundraiser_e_id=?;';
    }
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        die('SQL ERROR');
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt,"ss",$row_i,$_SESSION['emailId']);
        mysqli_stmt_execute($stmt);
        $f_result = mysqli_stmt_get_result($stmt);
        $ff_row = mysqli_fetch_assoc($f_result);
        $f_sy_ii = false;
        if(isset($ff_row)){
            $f_sy_ii =true;
        }
    }
    mysqli_stmt_close($stmt);

    return $f_sy_ii;
}
?>