<body onload="pageLoad()" >
    
    <div id="loader-wrapper" style="background: url() center;background-size: cover">
    <img src='Hunter/img/LS.png' id='loader-logo' style="height: 250px; width: 250px; object-fit: cover;border-radius:50%;box-shadow: inset 2px 2px 20px 1px blue;">
 
        <div class="loader">
            <div class="loader__bar"></div>
            <div class="loader__bar"></div>
            <div class="loader__bar"></div>
            <div class="loader__bar"></div>
            <div class="loader__bar"></div>
            <div class="loader__ball"></div>
        </div>
  
       <img   src='Hunter/img/logols.png'  id='loader-logo' style="width: 370px;margin-top:25em">

    </div>
    
    <div id="content" style="display: none">
        
        <?php include 'Profile\navbar.php'; ?> 
        
        <div class="container-fluid">
            
            <div class="row">

                <div class="col-sm-3 mt-3" >

                    <?php include 'profile-card.php'; ?>

                </div>

                <div class="col-sm-8 mt-5 mb-4 ml-4" style="background: repeating-linear-gradient( 45deg , #fff6e5, #ffebde 155px) fixed center;" >

                    <div class="text-center p-3 mt-4 mb-5" style="background: repeating-linear-gradient( 45deg , #aad8ff, #c8e0ff 155px) fixed center;border-radius: 22px;">
                        <h2 class='text-muted mt-3 ml-2 mb-4'><b style="text-shadow:0px 12px 9px #30733f;color:#090929;">Welcome <?php echo ucwords($_SESSION['name']); ?> </b></h2>
                        <br>
                        <div class="container">
                            <div class="row">
                            <div class="col text-left">
                                <div class="row"><a href="#"><img src='uploads/<?php echo $_SESSION["profilePic"] ?>' class='card-img-profile card-img-profile-k'></a></div>
                            
                            <?php echo ucwords($_SESSION['name']); ?>
                            <br>
                            <small class="text-muted"><?php 
                        if($_SESSION['u_prof']!='in'){
                            echo "Fundraiser";
                            
                        }
                        else{
                            echo "Investor";
                        }
                        ?></small>
                                <?php

                                    $sql = "SELECT count(follower_id) as follow FROM user_follower WHERE users_id = '".$_SESSION['emailId']."' UNION ALL SELECT count(follower_id)  FROM user_follower WHERE follower_id = '".$_SESSION['emailId']."';";
                                    $stmt = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($stmt, $sql))
                                    {
                                        die('SQL error');
                                    }
                                    else
                                    {
                                        mysqli_stmt_execute($stmt);
                                        $result = mysqli_stmt_get_result($stmt);
                                        $row_uf = mysqli_fetch_assoc($result);
                                        $row_ufo = mysqli_fetch_assoc($result);
                                        mysqli_stmt_close($stmt);
                                        
                                    }
                                        ?>
                        
                            </div>
                                <div class="col">
                                <div class="row" style="color: black;font-size: larger;text-shadow:0px 12px 9px #30733f;color:#090929;">
                                <div class="col"><i class="fa">Follower</i><hr></div>
                                <div class="col"><i class="fa">Following</i><hr></div>
                                </div>
                                <div class="row" style="color: black;">
                                <div class="col"><i class="fa"><?php echo $row_ufo['follow'];?></i></div>
                                <div class="col"><i class="fa"><?php echo $row_uf['follow'];?></i></div>
                                </div>
                                </div>
                            </div>
                        </div>



                    </div>
     



                    <ul class="nav nav-tabs justify-content-sm-end" id="myTab" role="tablist">
                    <li class="nav-item">
                          <a class="nav-link" id="oi_posts-tab" data-toggle="tab" href="#oi_posts" role="tab" 
                             aria-controls="oi_posts" aria-selected="false">Public Posts</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" 
                             aria-controls="posts" aria-selected="true">Recent Posts</a>
                        </li>
                    </ul>

                    <br>

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active post-s-l" id="posts" role="tabpanel" aria-labelledby="posts-tab">

                            <div class="d-flex pl-3 p-2" style="border-radius: 8px;/*box-shadow: inset 0px 0px 12px 10px #13008e1f;background: url(Hunter/img/night_06.png);*/color: black;font-size: larger;color:#090929;">
                              <div class="lh-100">
                                <h1 class="mb-0 lh-100 post-s-l-f">Latest Posts</h1>
                              </div>
                            </div>  
                                <?php
                                        if($row_uf['follow']===0){
                                            echo '<div class="row alert alert-danger mt-5" role="alert">
                                                    <strong>You Follow NONE: </strong> Follow to get ideas/post.
                                                    </div>';
                                        }else{

                                        $sql = "SELECT follower_id  FROM user_follower WHERE users_id = '".$_SESSION['emailId']."';";
                                        $stmt = mysqli_stmt_init($conn);
                                        if (!mysqli_stmt_prepare($stmt, $sql))
                                        {
                                            die('SQL error');
                                        }
                                        else
                                        {
                                            mysqli_stmt_execute($stmt);
                                            $result = mysqli_stmt_get_result($stmt);
                                            $numReas = mysqli_num_rows($result);
                                            $counter = 0;
                                            $sto_st = "(";
                                            while($row_inv = mysqli_fetch_array($result)){
                                                $sto_st .= "'".$row_inv['follower_id']."'";
                                                if(++$counter != $numReas){
                                                    $sto_st .=",";
                                                }
                                            }
                                            $sto_st.=")";
                                            mysqli_stmt_close($stmt);
                                        }
                                        
                                       

                                        $sql = "select post_id,post_title,post_img,post_by,post_date,post_content,post_type,post_tag,f.name,f.profile_pic from posts p,fundraiser as f where p.post_by in ".$sto_st." and f.fundraiser_email_id in ".$sto_st." and p.post_by = f.fundraiser_email_id and post_type in ('protected','public')
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
                                        while ($row = mysqli_fetch_assoc($result))
                                        {
                                            echo '                            <div class="container mt-3 border-primary p-4 rounded mb-3" style="text-align:justify;box-shadow:inset 0px 0px 10px 6px #b7a7ff8a">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a href="view_profile.php?view-profile_i='.$row['post_by'].'"><div class="row">
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
                                                    </div></a>
                                                </div>
                                                <div class="col-sm-6 mt-3" style="text-align:right;">
                                                <a href="#" class="view_c_repo_rt"><i class="fa fa-ellipsis-v mr-3"></i>
                                                </a>
                                                
                                                <div class="col-sm-5 offset-5 pt-2 border  mt-n3" style="display:none;z-index:1;background:#ffffff;position: absolute;text-align: right;">
                                                <small>Report</small><hr>
                                                <a href="complaint.php?r_ty=inappropriate&report=true&u_id='.$row['post_by'].'&p_id='.$row['post_id'].'">Inappropriate</a><br>
                                                <a href="complaint.php?r_ty=other&report=true&u_id='.$row['post_by'].'&p_id='.$row['post_id'].'&p_ti='.$row['post_title'].'">other</a>
                                                </div>
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
                                                    <small style="color:black">';?>
                                                    <?php 
                                                    require_once('Profile/val_of_in_v_f.php');
                                                    $val_of_in_v = val_of_in_v_fun($row['post_id'],$conn);
                                                    if($val_of_in_v){
                                                        echo '<i class="fa fa-check mr-1" style="font-size: 19px;font-style: oblique;color:#6301ff;"></i> Intrested</small>';
                                                    }else{
                                                        echo '<i class="fa fa-thumbs-up "></i> <a href="view_notification.php?profile_i='.$row['post_by'].'&p_id='.$row['post_id'].'">Intrested</a>
                                                    </small>';
                                                    }
                                                    ?>
                                                    <?php 
                                                    echo ' 
                                                    
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="col-sm-8 text-dark font-weight-light" >'.$row['post_content'].'</div>
                                            </div>
                                            
                                        </div>';
                                        }
                                    }
                                }
                                ?>   
                        </div>
                        <div class="tab-pane fade post-s-l" id="oi_posts" role="tabpanel" aria-labelledby="oi_posts-tab">
                        <div class="d-flex pl-3 p-2" style="border-radius: 8px;/*box-shadow: inset 0px 0px 12px 10px #13008e1f;background: url(Hunter/img/night_06.png);*/color: black;font-size: larger;color:#090929;">
                        <div class="lh-100">
                            <h1 class="mb-0 lh-100 post-s-l-f">Latest Posts</h1>
                        </div>
                        </div>  
                                <?php
                                $sql = "select post_id,post_title,post_img,post_by,post_date,post_content,post_type,post_tag
                                ,f.name,f.profile_pic 
                                from posts,fundraiser as f
                                where  post_type='public' AND f.fundraiser_email_id=post_by
                                order by post_id desc;";
                                $stmt = mysqli_stmt_init($conn);
                                    

                                if (!mysqli_stmt_prepare($stmt, $sql))
                                {
                                    die('SQL error');
                                }
                                else
                                {
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                    echo '                            <div class="container mt-3 border-primary p-4 rounded mb-3" style="text-align:justify;box-shadow:inset 0px 0px 10px 6px #b7a7ff8a">
                                    <div class="row">
                                        <div class="col-sm-6">
                                        <a href="view_profile.php?view-profile_i='.$row['post_by'].'"><div class="row">
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
                                            </div></a>
                                        </div>
                                        <div class="col-sm-6 mt-3" style="text-align:right;">
                                        <a href="#" class="view_c_repo_rt"><i class="fa fa-ellipsis-v mr-3"></i>
                                            </a>
                                            
                                            <div class="col-sm-5 offset-5 pt-2 border  mt-n3" style="display:none;z-index:1;background:#ffffff;position: absolute;text-align: right;">
                                            <small>Report</small><hr>
                                            <a href="complaint.php?r_ty=inappropriate&report=true&u_id='.$row['post_by'].'&p_id='.$row['post_id'].'">Inappropriate</a><br>
                                            <a href="complaint.php?r_ty=other&report=true&u_id='.$row['post_by'].'&p_id='.$row['post_id'].'&p_ti='.$row['post_title'].'">other</a>
                                            </div>
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
                                            <small style="color:black">';?>
                                                <?php 
                                                require_once('Profile/val_of_in_v_f.php');
                                                $val_of_in_v = val_of_in_v_fun($row['post_id'],$conn);
                                                if($val_of_in_v){
                                                    echo '<i class="fa fa-check mr-1" style="font-size: 19px;font-style: oblique;color:#6301ff;"></i> Intrested</small>';
                                                }else{
                                                    echo '<i class="fa fa-thumbs-up "></i> <a href="view_notification.php?profile_i='.$row['post_by'].'&p_id='.$row['post_id'].'">Intrested</a>
                                                </small>';
                                                }
                                                ?>
                                            <?php 
                                            echo '</div>
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
            </div>
            <?php include 'Hunter/include/footer.php'; ?>
        </div>
    </div>
    

    
    <?php include 'HTML-Foot.php'; ?>

    <script>
        var myVar;

        function pageLoad() {
          myVar = setTimeout(showPage,3800);
        }

        function showPage() {
          document.getElementById("loader-wrapper").style.display = "none";
          document.getElementById("content").style.display = "block";
        }
    </script>  
    
</body>