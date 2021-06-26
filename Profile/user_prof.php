
<?php

define('TITLE','Profile | LetsStartUp');

if(!isset($_SESSION['emailId']))
{
    header("Location: index.php");
    exit();
}
include 'HTML-head.php';
?>  
<body>
<?php include 'Profile\navbar.php';?>

<?php include 'userprof.i.php';?>
<div class="container mt-5 mb-5 ">
    <div class="row mb-5">
        <div class=" col-5 input-group-text justify-content-center" style="border: none;background: url(Hunter/img/background.png) center;">
            <div class='card card-profile text-center prof-card-if' style="position: inherit;">
                <img alt='' class='card-img-top card-user-cover' src='Hunter/img/background.png' style="background: cover;">
                <div class='card-block'>
                    <a href='#'>
                        <img src='uploads/<?php echo $row["profile_pic"] ?>' class='card-img-profile'>
                    </a>
                    <a href="<?php echo $row['linked_in']; ?>">
                        <i class="fa fa-linkedin fa-2x edit-profile" aria-hidden="true"></i>
                    </a>
                    <h4 class='card-title mb-5'>
                    <?php echo ucwords($row['name']); ?>
                        <small class="text-muted">
                        <?php if($c_con == 0){echo $row['investor_email_id'];}else{echo $row['fundraiser_email_id'];}?>
                        </small>
                        <br>
                        <small class="text-muted"><?php 
                        if($c_con === 1){
                            echo "FUNDRAISER";
                            
                        }
                        else{
                            echo "INVESTOR";
                        }
                        ?></small>
                    </h4>
                    <?php
                    $sql = "select id from user_follower where users_id = ? and follower_id = ?;";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                        die('SQL ERROR');
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($stmt,"ss",$_SESSION['emailId'],$_GET['view-profile_i']);
                        mysqli_stmt_execute($stmt);
                        $f_result = mysqli_stmt_get_result($stmt);
                        $ff_row = mysqli_fetch_assoc($f_result);
                        $f_sy = false;
                        if(isset($ff_row)){
                            $f_sy =true;
                        }
                    }
                    mysqli_stmt_close($stmt);
                    if($f_sy){
                        echo '<div class="btn btn-block btn-outline-primary disabled">Followed</div>';
                    }else{?>
                    <div class="btn btn-block btn-outline-primary">
                    <a style="color:black;" href="view_profile.php?profile_i=<?php if($c_con == 0){echo $row['investor_email_id'];}else{echo $row['fundraiser_email_id'];}?>">
                    Follow</a>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>

        <div class="col-7  breadcrumb input-group-text" style="border: none;background: url(Hunter/img/background.jpg) center;">
            <div class="container-fluid p-5 text-left text-dark">
            <div class="row h3 mb-4 text-center justify-content-center font-weight-bolder" style="text-shadow:0px 12px 9px #30733f;color:#090929;">
            Profile Detail
            </div>
            <hr>
            <div class="row">
                <div class="col-2 text-dark font-weight-bolder">Full Name</div>
                <div class="col-1 text-dark font-weight-bolder"> : </div>
                <div class="col-8"><?php echo ucwords($row['name']); ?></div>
            </div>
            <div class="row">
                <div class="col-2 text-dark font-weight-bolder">Email</div>
                <div class="col-1 text-dark font-weight-bolder"> : </div>
                <div class="col-8"><?php if($c_con == 0){echo $row['investor_email_id'];}else{echo $row['fundraiser_email_id'];}?></div>
            </div>
            <div class="row">
                <div class="col-2 text-dark font-weight-bolder">Phone</div>
                <div class="col-1 text-dark font-weight-bolder"> : </div>
                <div class="col-8"><?php echo $row['phone']; ?></div>
            </div>
            <div class="row">
                <div class="col-2 text-dark font-weight-bolder">LinkedIn</div>
                <div class="col-1 text-dark font-weight-bolder"> : </div>
                <div class="col-8"><a href="#"><?php echo $row['linked_in']; ?></a></div>
            </div>
            <div class="row">
                <div class="col-2 text-dark font-weight-bolder">Address</div>
                <div class="col-1 text-dark font-weight-bolder"> : </div>
                <div class="col-8"><?php echo $row['address']; ?></div>
            </div>
            <hr>
            <?php if($c_con == 0){?>          
            <div class="row">
                <div class="col-4 text-dark font-weight-bolder">Type Of Investment</div>
                <div class="col-1 text-dark font-weight-bolder"> : </div>
                <div class="col-7"><?php echo $row['type_of_invest']; ?></div>
            </div>
            <div class="row">
                <div class="col-4 text-dark font-weight-bolder">Investment Budget</div>
                <div class="col-1 text-dark font-weight-bolder"> : </div>
                <div class="col-7"><?php echo $row['invest_buget']; ?> Rs</div>
            </div>
            <div class="row">
                <div class="col-4 text-dark font-weight-bolder">Previosly Invested</div>
                <div class="col-1 text-dark font-weight-bolder"> : </div>
                <div class="col-7"><?php echo ucwords($row['invested_before']); ?></div>
            </div>
            <?php }?>  
            </div>
    
    </div>

    </div>



    <?php if($c_con == 1){?>
    <div class="row mt-5">
        <div class="col-3  mt-5 sticky-top" style="z-index: revert;background: repeating-linear-gradient(45deg, #fff0f0, transparent 100px) fixed center;">
        </div>
        <div class="col-9 ">
        <ul class="nav nav-tabs justify-content-sm-end" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" 
                             aria-controls="posts" aria-selected="true">Recent Posts</a>
                        </li>
                    </ul>

                    <br>

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active post-s-l" id="posts" role="tabpanel" aria-labelledby="posts-tab">

                            <div class="d-flex pl-3 p-2 mb-4" style="border-radius: 8px;/*box-shadow: inset 0px 0px 12px 10px #13008e1f;*/color: black;font-size: larger;color:#090929;">
                               
                              <div class="lh-100 ">
                                <h1 class="mb-0 lh-100 post-s-l-f">Latest Posts</h1>
                              </div>
                            </div>  
                                    <?php
                                        $sql = "select post_id,post_title,post_img,post_by,post_date,post_content,post_type,post_tag
                                        ,f.name,f.profile_pic 
                                        from posts,fundraiser as f
                                        where  post_type='public' AND f.fundraiser_email_id=post_by AND f.fundraiser_email_id = '".$_GET['view-profile_i']."'
                                        order by post_id desc
                                        LIMIT 15;";
                                        $stmt = mysqli_stmt_init($conn);
                                        

                                        if (!mysqli_stmt_prepare($stmt, $sql))
                                        {
                                            die('SQL error');
                                        }
                                        else
                                        {
                                            mysqli_stmt_execute($stmt);
                                            $result = mysqli_stmt_get_result($stmt);
                                            $num_of_p_u = mysqli_num_rows($result);
                                            if($num_of_p_u===0){
                                                echo "<div class='alert alert-success'>No Post Or idea pitched</div>";
                                            }
                                        while ($row = mysqli_fetch_assoc($result))
                                        {
                                            echo '                            <div class="container mt-3 border border-primary p-4 rounded mb-3" style="text-align:justify;box-shadow:inset 0px 0px 10px 6px #b7a7ff8a">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                        <img style=" border-radius: 50%;height: 42px;width: 42px;"src="uploads/'.$row['profile_pic'].'" alt="">
                                                        </div>
                                                    <div class="col-sm-4">
                                                        <div class="row" style="color:black;font-weight:bolder;">
                                                            '.ucwords($row['name']).'
                                                        </div>
                                                        <div class="row">
                                                            <small>'.$row['post_by'].'</small> 
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mt-3" style="text-align:right;">
                                                <!--<a href="view_profile.php?profile_i='.$row['post_by'].'"><i class="fa fa-check"></i><small> Follow </small><i class="fa fa-user-plus"></i>
                                                </a>-->
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 mb-4">
                                                <hr>
                                                <b style="color:black">'.$row['post_title'].'</b>
                                                
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                <div class="row">
                                                <div class="col">
                                                <img src="uploads/'.$row['post_img'].'" alt="">
                                                </div>
                                                </div>
                                                <hr>
                                                <div class="row mt-3">
            
                                                    <div class="col-sm-6">
                                                    <small style="color:black"><i class="fa fa-tag"></i> '.$row['post_tag'].'</small> 
                                                    
                                                    </div>
                                                    <div class="col-sm-6">
                                                    <small style="color:black"><i class="fa fa-check"></i> Intrested</small> 
                                                    
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="col-sm-8 text-dark font-weight-light" >'.$row['post_content'].'</div>
                                            </div>
                                            
                                        </div>';
                                        }
                                    }
                                ?>   


                            

                        </div>
  

                        </div>
        </div>
    </div>
    <?php }?>
</div>
<?php include 'Hunter/include/footer.php'; ?>
<?php include 'HTML-Foot.php'; ?>

</body>
</html>