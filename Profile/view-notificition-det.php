<?php

define('TITLE','Post Detail');
if(!isset($_SESSION['emailId']))
{
    header("Location: index.php");
    exit();
}
include 'HTML-head.php';
include 'navbar.php';
if(!empty($_GET['po_v_id'])){
$sql = 'update f_intrested set visited="true" where post_id=? and fundraiser_e_id=?';
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
    die('SQL ERROR');
    exit();
}
else{
    mysqli_stmt_bind_param($stmt,"ss",$_GET['po_v_id'],$_GET['view-noti_i']);
    mysqli_stmt_execute($stmt);
}
mysqli_stmt_close($stmt);
$sql = 'update i_intrested set visited="true" where post_id=? and investor_e_id=?';
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
    die('SQL ERROR');
    exit();
}
else{
    mysqli_stmt_bind_param($stmt,"ss",$_GET['po_v_id'],$_GET['view-noti_i']);
    mysqli_stmt_execute($stmt);
}
mysqli_stmt_close($stmt);
}
$sql = 'select post_title,post_img,post_content,post_tag
from posts
where post_id=?;';
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
    die('SQL ERROR');
    exit();
}
else{
    mysqli_stmt_bind_param($stmt,"s",$_GET['po_v_id']);
    mysqli_stmt_execute($stmt);
    $gt_result = mysqli_stmt_get_result($stmt);
    $gt_f_row = mysqli_fetch_assoc($gt_result);
    if(isset($gt_f_row)){
        $sql = 'select investor_e_id from i_intrested where post_id=?;';
        if(!mysqli_stmt_prepare($stmt,$sql)){
            die('SQL ERROR');
            exit();
        }else{
            mysqli_stmt_bind_param($stmt,"s",$_GET['po_v_id']);
            mysqli_stmt_execute($stmt);
            $i_gt_result = mysqli_stmt_get_result($stmt);
            // $i_gt_f_row = mysqli_fetch_assoc($gt_result);
        }
        $sql = 'select fundraiser_e_id from f_intrested where post_id=?;';
        if(!mysqli_stmt_prepare($stmt,$sql)){
            die('SQL ERROR');
            exit();
        }else{
            mysqli_stmt_bind_param($stmt,"s",$_GET['po_v_id']);
            mysqli_stmt_execute($stmt);
            $f_gt_result = mysqli_stmt_get_result($stmt);
            // $f_gt_f_row = mysqli_fetch_assoc($gt_result);
        }

?>

<body>
<div class="container mt-5 mb-5 ">
<div class="row mb-n4">
            <div class="col-12 h5 mb-4 text-body text-justify">
            <?php echo $gt_f_row['post_title']; ?>
            <hr>
            </div>
</div>
    <div class="row mb-5">
        <div class=" col-5 input-group-text justify-content-center" style="background: none;
    border: none;">
            <div class="col" style="background: url(uploads/<?php echo $gt_f_row['post_img']; ?>) center no-repeat;
    background-size: cover;height: -webkit-fill-available;border-radius: 25px;    min-height: 300px;
">

            </div>
        </div>

        <div class="col-7" style="">
        <div class="row">
            <div class="container-fluid text-left ">
            
            <div class="mt-3 p-3 col-12 text-justify overflow-auto mb-1" style="max-height: 272px;min-height: 272px;box-shadow: inset 0px 0px 7px 0px #80ff70c7;">
            <?php echo $gt_f_row['post_content']; ?>
            </div>
                   
            <div class="col-12 mt-1 text-capitalize text-body" style="">
                <hr>
                <i class="fa fa-tag"></i> <?php echo $gt_f_row['post_tag']; ?>
            </div>
            </div>
            </div>
    
    </div>

    </div>
    <div class="row">
        <div class="h2 col-12 post-s-l-f text-right">
            User Interested In This Post
        </div>
        <div class="col-12">
        <ul class="nav nav-tabs justify-content-sm-end" id="myTab" role="tablist">
        <li class="nav-item">
                          <a class="nav-link " id="o_posts-tab" data-toggle="tab" href="#o_posts" role="tab" 
                             aria-controls="o_posts" aria-selected="false">Fundraiser</a>
                        </li>                
        <li class="nav-item">
                          <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" 
                             aria-controls="posts" aria-selected="true">Investors </a>
                        </li>

    </ul>

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade  show active post-s-l" id="posts" role="tabpanel" aria-labelledby="posts-tab">

                            <div class="d-flex pl-3 p-2" style="border-radius: 8px;/*box-shadow: inset 0px 0px 12px 10px #13008e1f;background: url(Hunter/img/night_06.png);*/color: black;font-size: larger;color:#090929;">
                              <div class="lh-100">
                                <h1 class="mb-0 lh-100 post-s-l-f">Investor's Email ID</h1>
                              </div>
                            </div>
                            <div class="container mt-4">
                                    <div class="row">
                                        
                                            <?php
                                        while($i_gt_f_row = mysqli_fetch_assoc($i_gt_result)){
                                                echo "<div class='col-12 mt-4 mb-4 ml-3'><a href='view_profile.php?view-profile_i=".$i_gt_f_row['investor_e_id']."' style='background: aquamarine;box-shadow: 0px 0px 5px 2px #6c5c7b8c;border-radius: 6px;' class='border p-3 text-body'>".$i_gt_f_row['investor_e_id'].'</a></div>';
                                        }
                                    ?>
                                        
                                    </div>
                                </div>   
                        </div>
                        <div class="tab-pane fade  post-s-l" id="o_posts" role="tabpanel" aria-labelledby="o_posts-tab">

                            <div class="d-flex pl-3 p-2" style="border-radius: 8px;/*box-shadow: inset 0px 0px 12px 10px #13008e1f;background: url(Hunter/img/night_06.png);*/color: black;font-size: larger;color:#090929;">
                              <div class="lh-100">
                                <h1 class="mb-0 lh-100 post-s-l-f">Fundraiser's Email ID</h1>
                              </div>
                            </div>  
                            <div class="container mt-4">
                                    <div class="row">
                                            <?php
                                        while($i_gt_f_row = mysqli_fetch_assoc($f_gt_result)){
                                            echo "<div class='col-12 mt-4 mb-4 ml-3'><a href='view_profile.php?view-profile_i=".$i_gt_f_row['fundraiser_e_id']."' style='background: aquamarine;box-shadow: 0px 0px 5px 2px #6c5c7b8c;border-radius: 6px;' class='border p-3 text-body'>".$i_gt_f_row['fundraiser_e_id'].'</a></div>';
                                        }
                                    ?>
                                    </div>
                                </div>   
                        </div>
                                        

                        </div>

        </div>
    </div>
                                    </div>
    <?php include 'Hunter/include/footer.php'; ?>
</body>

<?php
}
else{
    echo '<div class="h1 mt-5 pt-3 alert alert-danger">
    <marquee>
    <strong>404</strong> : Nothing Is Here
    <strong>404</strong> : Nothing Is Here 
    </marquee>
    </div>';
}
}
mysqli_stmt_close($stmt);

include 'HTML-Foot.php';
?>