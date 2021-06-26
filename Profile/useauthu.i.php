<?php
        mysqli_stmt_bind_param($stmt,'s',$_GET['view-profile_i']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        if(isset($row)){
            return $row;
        }else{
            $c_con++;
        }
?>