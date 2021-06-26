
<?php
    session_start();
    include_once 'dbh.inc.php';
function strip_bad_chars( $input ){
    $output = preg_replace( "/[^a-zA-Z0-9_-]/", "", $input);
    return $output;
}

if(!isset($_SESSION['userId']))
{
    header("Location: login.php");
    exit();
}else{
    define('TITLE',"Welcome ".ucwords($_SESSION['name']));
    include 'HTML-head.php';
    echo '</head>';
    if($_SESSION['u_prof']!='in'){
        include 'Profile/fundraiser.php';

    }
    else{
        include 'Profile/investor.php';
    }
}
?> 
</html>