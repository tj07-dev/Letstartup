<?php
if(!isset($_SESSION['userId']) && !isset($_SESSION['emailId']))
{
  
echo '  <header id="header" class="sticky-top">
  <div class="container d-flex align-items-center ">

    <a href="index.php" class="logo mr-auto"><img src="assets/img/logo.png" alt=""></a>


    <nav class="nav-menu d-none d-lg-block">
      <ul>
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="index.php#about">About</a></li>
        <li><a href="index.php#portfolio">Team</a></li>
        <li><a href="index.php#contact">Contact Us</a></li>
        <li><a href="signup.php">Join</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
    </nav>

  </div>
</header>';


}
else{
  

echo '        <nav class="navbar sticky-top navbar-expand-md" style="background:repeating-linear-gradient( 45deg, orange, #ef7b2d 155px) fixed center;;box-shadow: 0px 2px 4px 1px red;">
            <a class="navbar-brand" href="profile.php">
                <img src="assets/img/logo.png" class="mt-2" height="40" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-right" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto mr-1">';
              if($_SESSION['u_prof']!='in'){
                echo '              <li class="nav-item px-3">
                <a class="nav-link" href="#" id="notification-fo-lt">
                    <i class="fa fa-bell fa-2x" aria-hidden="true"></i>
                    <span class="badge text-blue" style="margin-left: -9px;margin-top: -9px;position: absolute;background: white;border-radius: 24px;">
                    NEW</span>
                </a>
                <div id="display-notification-fo-lt" class="pt-5 pl-5 pb-4 overflow-auto shadow container  mt-n2" style="display:none;border-radius: 25px 25px 13px 13px;background: repeating-linear-gradient(
                  45deg , rgb(248 255 135), rgb(255 255 255) 155px) center center fixed;position: absolute;max-height: 550px;margin-left: -169px; max-width: 400px;min-height: -webkit-fill-available;" class="mt-5 pt-4">
                </div>
                
            </li>';
              }

              echo '<li class="">
               <div  style="border:none;position: absolute;" class="mt-5 pt-4" id="display"></div> 
                </li>
                 <li class="nav-item px-3">
                 <div class="d-flex">
                 <div class="searchbar mt-1">
                   <input class="search_input" id="searc-hbar" type="text" name="" placeholder="Search">
                   <a href="#" class="search_icon"><i class="fa fa-search"></i></a>
                 </div>
               </div>
               
               
                </li>
                <li class="nav-item dropdown px-3">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-gear fa-2x" aria-hidden="true"></i>
                  </a>
                  <div style="border:none" class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="profile.php">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>';
                    if($_SESSION['u_prof']!='in'){
                      echo '<a class="dropdown-item" href="create-post.php">Create Post</a>';
                    }
                    
                    echo '<div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="complaint.php">Complaint</a>
                  </div>
                </li>
                <li class="nav-item px-3">
                  <a class="nav-link" href="logout.inc.php">
                      <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
                  </a>
                </li>
              </ul>
            </div>
        </nav>';
      
      } ?>