<?php

    session_start();
    require 'dbh.inc.php';
    
    define('TITLE',"Edit Profile | Letstartup");
    
    if(!isset($_SESSION['userId']))
    {
        header("Location: login.php");
        exit();
    }
    
    include 'HTML-head.php';  
?> 
</head>
<body style="background: repeating-linear-gradient( 45deg , #fff6e5, #ffebde 155px) fixed center;" >

    <?php include 'Profile/navbar.php'; ?>
      <div class="container text-dark font-weight-bolder"  >
      <div class="row">
            <div class="col text-center"><h1 class="mt-5" style="text-shadow:0px 12px 9px #30733f;color:#090929;">Edit Your Profile</h1></div>
          </div>
        <div class="row">

        <div class="col text-center" id="user-section">
              
              <div class="cover-img" id='blah-cover' style="background: repeating-linear-gradient( 45deg , #aad8ff, #c8e0ff 155px) fixed center;border-radius: 22px;"></div>
              
              <form action="profileUpdate.inc.php" method='post' enctype="multipart/form-data"
                    style="padding: 0 30px 0 30px;">
                    
                    <img class="profile-img" id="blah"  src="#"> 
                    <br>
                    <br>
                    <label class="btn btn-outline-success ">
                        Change Profile Picture <input type="file" id="imgInp" name='dp' hidden>
                    </label>
                    <br>

                    <hr>

                    <h2><?php echo strtoupper($_SESSION['name']); ?></h2>
                    <br>
                  
                    <div class="form-row">
                      <div class="col">
                        <input type="text" class="form-control" name="name" placeholder="Name"
                               value="<?php echo $_SESSION['name'] ?>" >
                        <small id="emailHelp" class="form-text text-muted"></small>
                      </div>
                    </div>
                  
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" placeholder="email" 
                               value="<?php echo $_SESSION['emailId'] ?>" >
                        <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                  
                    <div class="form-group">
                                <label >Gender</label><br>
                                <input id="toggle-on" class="toggle toggle-left" name="gender" value="M" type="radio" 
                                    <?php 
                                        if ($_SESSION['gender'] == 'M'){ ?> 
                                            checked="checked"
                                    <?php } ?>>
                                <label for="toggle-on" class="btn-r">M</label>
                                <input id="toggle-off" class="toggle toggle-right" name="gender" value="F" type="radio"
                                    <?php if ($_SESSION['gender'] == 'F'){ ?> 
                                            checked="checked"
                                    <?php } ?>>
                                <label for="toggle-off" class="btn-r">F</label>
                    </div>
                  
                  <hr>
                  
                    <div class="form-group">
                        <label for="headline">Phone</label>
                        <input class="form-control" type="text" id="phone" name="pnum" 
                               placeholder="Your Profile Headline" value='<?php echo $_SESSION['phone']; ?>'><br>
                        
                        <label for="edit-address">Address</label>
                        <textarea class="form-control" id="edit-address" rows="10" name="add" maxlength="5000"
                            placeholder="What you want to tell people about yourself" 
                            ><?php echo $_SESSION['address']; ?></textarea>
                    </div>
                  
                  <hr>
                  
                  <div class="form-group">
                        <label for="old-pwd">Change Password</label>
                        <input type="password" class="form-control" id="old-pwd" name="old-pwd"
                               placeholder="Current Password">
                    </div>
                  
                    <div class="form-row">
                      <div class="col">
                        <input type="password" class="form-control" id="exampleInputPassword" name="pwd"
                               placeholder="New Password">
                      </div>
                      <div class="col">
                        <input type="password" class="form-control" id="exampleInputPassword1" name="pwd-repeat"
                               placeholder="Repeat New Password">
                      </div>
                    </div>
                  
                  <br><input type="submit" class="btn btn-primary" name="update-profile" value="Update Profile">
                  
              </form>
              
              
          </div>

        </div>


      </div> 


      <?php include 'Hunter/include/footer.php'; ?>

<?php include 'HTML-Foot.php'; ?>                      

        
                            <script>
                                var dp = '<?php echo $_SESSION["profilePic"]; ?>';
                                
                                $('#blah').attr('src', 'uploads/'+ dp);
                                
                                function readURL(input) {

                                    if (input.files && input.files[0]) {
                                      var reader = new FileReader();

                                      reader.onload = function(e) {
                                        $('#blah').attr('src', e.target.result);
                                        
                                      }

                                      reader.readAsDataURL(input.files[0]);
                                    }
                                  }

                                  $("#imgInp").change(function() {
                                    readURL(this);
                                  });
                                  
                                  
                            </script>
        
    </body>
</html>