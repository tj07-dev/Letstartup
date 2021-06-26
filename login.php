<?php

    session_start();
    define('TITLE',"User Login");
    function strip_bad_chars( $input ){
      $output = preg_replace( "/[^a-zA-Z0-9_-]/", "", $input);
      return $output;
  }
    if(isset($_SESSION['userId']))
    {
        header("Location: index.php");
        exit();
    }
    include 'HTML-head.php';
?>  
<style>
      #team {
      display: grid;
      grid-template-columns: repeat(3);
      grid-template-rows: repeat(2);

  }
</style>
<?php include 'Profile\navbar.php';?>

<body style="background: url('Hunter/img/background.jpg') center;background-size: cover;">
 <!--start from here-->

    <section id="cover">
        <div id="cover-caption">
            <div class="container text-dark font-weight-bold">
              <div class="row">
                <div class="col">
                <h2 class=" mb-3 h1"><b>Ideas Everywhere!</b></h2>
                    <img src='Hunter\img\LS.png'style="width: 150px; object-fit: cover;border-radius:50%;box-shadow: inset 2px 2px 20px 1px blue;">
                    <br>
                    
                    <hr>
                    
                    <?php
                    
                        if(isset($_GET['error']))
                        {
                            if($_GET['error'] == 'emptyfields')
                            {
                                echo '<div class="alert alert-danger" role="alert">
                                        <strong>Error: </strong>Fill In All The Fields
                                      </div>';
                            }
                            else if($_GET['error'] == 'nouser')
                            {
                                echo '<div class="alert alert-danger" role="alert">
                                        <strong>Error: </strong>Username does not exist
                                      </div>';
                            }
                            else if ($_GET['error'] == 'wrongpwd')
                            {;
                                echo '<div class="alert alert-danger" role="alert">
                                        <strong>Error: </strong>Wrong password - 
                                         <a href="reset-pwd.php" class="alert-link">Forgot Password?</a>
                                      </div>';
                            }
                            else if ($_GET['error'] == 'sqlerror')
                            {
                                echo '<div class="alert alert-danger" role="alert">
                                        <strong>Error: </strong>Website error. Contact admin to have it fixed
                                      </div>';
                            }
                            
                        }
                        else if(isset($_GET['newpwd']))
                        {
                            if($_GET['newpwd'] == 'passwordupdated')
                            {
                                echo '<div class="alert alert-success" role="alert">
                                        <strong>Password Updated </strong>Login with your new password
                                      </div>';
                            }
                        }
                    ?>
                    <form method="post" action="login.inc.php" class="">
                                          <div class="form-row">
                      <div class="form-group col-md-12">
                            <label class=" h3">Fundraiser/Investor</label><br>
                            <input id="toggle-on" class="toggle toggle-left" name="user_p" value="fun" type="radio" checked>
                            <label for="toggle-on" class="btn-r">F</label>
                            <input id="toggle-off" class="toggle toggle-right" name="user_p" value="in" type="radio">
                            <label for="toggle-off" class="btn-r">I</label>
                            </div>
                      </div>
                    <div class="form-row">
                    <div class="form-group col-md-12 form-inline justify-content-center">
                    
                            <label class="sr-only">Name</label>
                            <input type="text" id="name" name="mailuid"
                                   class="form-control form-control-lg mr-1" placeholder="Username">

                            <label class="sr-only">Email</label>
                            <input type="password" id="password" name="pwd"
                                   class="form-control form-control-lg mr-1" placeholder="Password">
 
                        <input type="submit" class="btn btn-primary btn-lg" name="login-submit" value="Login">
                      </div>
                    
                      </div>
                      </form>
                        <div class="form-row">
                          <div class="form-group col-md-12">
                          <br><a href="signup.php" class="btn btn-light btn-lg mr-1">Signup</a>
                          </div>
                          
                        </div>
                    

                    
                </div>
            </div>
                      </div>
        </div>
    </section>

    <?php include 'Hunter/include/footer.php'; ?>
<?php include 'HTML-Foot.php'; ?>
</body> 
</html>