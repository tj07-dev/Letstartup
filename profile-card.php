
<div class="pl-5 sticky-top" id="hero" style="z-index: revert;background-attachment: inherit;background: repeating-linear-gradient(45deg
, #fff0f0, transparent 100px) fixed center;">
    <div class='card card-profile text-center prof-card-if'>
                <img alt='' class='card-img-top card-user-cover' src='Hunter/img/background.png' style="background: cover;">
                <div class='card-block'>
                    <a href='profile.php'>
                        <img src='uploads/<?php echo $_SESSION["profilePic"] ?>' class='card-img-profile'>
                    </a>
                    <a href="edit-profile.php">
                        <i class="fa fa-edit fa-2x edit-profile" aria-hidden="true"></i>
                    </a>
                    <h4 class='card-title'>
                    <?php echo ucwords($_SESSION['name']); ?>
                        <small class="text-muted">
                            <?php echo $_SESSION['emailId']; ?>
                        </small>
                        <br>
                        <small class="text-muted"><?php 
                        if($_SESSION['u_prof']!='in'){
                            echo "Fundraiser";
                            
                        }
                        else{
                            echo "Investor";
                        }
                        ?></small>
                        <br><br><br>
                    </h4>
                </div>
            </div>
</div>
