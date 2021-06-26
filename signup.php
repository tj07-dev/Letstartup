<?php

    session_start();
    define('TITLE',"User Signup");
    
    if(isset($_SESSION['userId']))
    {
        header("Location: index.php");
        exit();
    }
    include 'HTML-head.php';
?>  
    
    
    <body style="background: url('Hunter/img/background.jpg') center;background-size: cover;">
    <?php include 'Profile\navbar.php';?>
        <div id="signup" >
            <div class="container text-dark">
                <div class="row">
                    <div class="col offset text-center font-weight-bold">
                    <form id="signup-form" action="signup.inc.php" method='post' 
                                  enctype="multipart/form-data">
                        <h1 class="mt-5 text-dark" style="text-shadow:0px 12px 9px #30733f;color:#090929;">Signup Form</h1>
                        <br>

              <?php
          
              if(isset($_GET['error']))
              {
                  echo '<div class="form-row">';

                  if($_GET['error'] == 'emptyfields')
                  {
                      echo '<div class="alert alert-danger" role="alert">
                              <strong>Error: </strong> Fill In All The Fields
                            </div>';
                  }
                  else if ($_GET['error'] == 'invalidmailuid')
                  {
                      echo '<div class="alert alert-danger" role="alert">
                              <strong>Error: </strong> Please enter a valid email and user name
                            </div>';
                  }
                  else if ($_GET['error'] == 'invalidmail')
                  {
                      echo '<div class="alert alert-danger" role="alert">
                              <strong>Error: </strong> Please enter a valid email
                            </div>';
                  }
                  else if ($_GET['error'] == 'invaliduid')
                  {
                      echo '<div class="alert alert-danger" role="alert">
                              <strong>Error: </strong> Please enter a valid user name
                            </div>';
                  }
                  else if ($_GET['error'] == 'passwordcheck')
                  {
                      echo '<div class="alert alert-danger" role="alert">
                              <strong>Error: </strong> Passwords donot match
                            </div>';
                  }
                  else if ($_GET['error'] == 'usertaken')
                  {
                      echo '<div class="alert alert-danger" role="alert">
                              <strong>Error: </strong> This User name is already taken
                            </div>';
                  }
                  else if ($_GET['error'] == 'invalidimagetype')
                  {
                      echo '<div class="alert alert-danger" role="alert">
                              <strong>Error: </strong> Invalid image type 
                            </div>';
                  }
                  else if ($_GET['error'] == 'imguploaderror')
                  {
                      echo '<div class="alert alert-danger" role="alert">
                              <strong>Error: </strong> Image upload error, please try again
                            </div>';
                  }
                  else if ($_GET['error'] == 'imgsizeexceeded')
                  {
                      echo '<div class="alert alert-danger" role="alert">
                              <strong>Error: </strong> Image too large
                            </div>';
                  }
                  else if ($_GET['error'] == 'sqlerror')
                  {
                      echo '<div class="alert alert-danger" role="alert">
                              <strong>Website Error: </strong> Contact admin to have the issue fixed
                            </div>';
                  }
                  else if($_GET['error'] == 'emptyfield_inv')
                  {
                      echo '<div class="alert alert-danger" role="alert">
                              <strong>Error: </strong> Tell Us Where Have You Invested
                            </div>';
                  }
                  echo '</div>';
              }
              else if (isset($_GET['signup']) == 'success')
              {
                  echo '<div class="alert alert-success" role="alert">
                          <strong>Successfull, Please check your mail for the password.
                        </div>';
              }
              
          ?>
                        <div class="form-row">
 

                          <div class="form-group col-md-12 ">
                              <img id="blah"  src="#" alt="your image" 
                                    style="height: 180px; width: 185px; object-fit: cover;border-radius:50%;box-shadow: 2px 2px 20px 1px blue;">
                              <br><br><label class="btn btn-primary ">
                                  Choose Profile <input type="file" id="imgInp" name='dp' hidden>
                            </label>
                          </div>
                        </div>
                        
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="uid" placeholder="Full Name" maxlength="25">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="email">Email <span id="display-email-c" class="ml-3" style="color:#b10000"></span> </label>
                            <input type="email" class="form-control" id="email" name="mail" placeholder="Email">
                          </div>
                        </div>
                       <div class="form-row">
                          <!--<div class="form-group col-md-4">
                            <label for="pwd">Password</label>
                            <input type="password" class="form-control" minlength="8" id="pwd" name="pwd" placeholder="Password">
                          </div>
                          <div class="form-group col-md-4">
                            <label for="pwd-repeat">Password Repeat</label>
                            <input type="password" class="form-control" minlength="8" id="pwd-repeat" name="pwd-repeat" 
                                   placeholder="Repeat Password">
                          </div>-->
                          <div class="form-group col-md-6">
                            <label for="">Contact No.</label>
                            <input type="text" class="form-control" id="" name="pnum" placeholder="Contact No." maxlength="12">
                          </div>
                        
                        <div class="form-group col-md-6">
                            <label for="add">Where Do You Live</label>
                            <input type="text" class="form-control" id="add" name="add" maxlength="1000"
                            placeholder="Address/ City/ State/ Pincode">
                          </div>
                          </div>

                        <div class="form-row ">
                        <div class="form-group col-md-6">
                            <label for="">Linked-in URL</label>
                            <input type="url" class="form-control" id="" name="l_url" placeholder="Linkedin profile URL" maxlength="50">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="">Date Of Birth</label>
                            <input type="date" class="form-control" id="" name="dob" placeholder="Date Of Birth">
                          </div>

                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6 align-self-center">
                                <label >Gender</label><br>
                                <input id="toggle-on_g" class="toggle toggle-left" name="gender" value="M" type="radio" checked>
                                <label for="toggle-on_g" class="btn-r">M</label>
                                <input id="toggle-off_g" class="toggle toggle-right" name="gender" value="F" type="radio">
                                <label for="toggle-off_g" class="btn-r">F</label>
                            </div>
                            <div class="form-group col-md-6">
                            <label>Fundraise/Investor</label><br>
                            <input id="toggle-on" class="toggle toggle-left" name="user_p"  onchange="a_query_y_n(this)" value="fun" type="radio" checked>
                            <label for="toggle-on" class="btn-r">F</label>
                            <input id="toggle-off" class="toggle toggle-right" name="user_p"  onchange="a_query_y_n(this)"  value="in" type="radio">
                            <label for="toggle-off" class="btn-r">I</label>
                            </div>

                        </div>
                        <div class="form-row" id="this_i_inv" style="display:none">
                            <div class="form-group col-md-2 align-self-center">
                                <label for="s_tof_i">Type Of Investor</label>
                            <select name="s_tof_i" id="s_tof_i" class="form-control">
                                <option value="Personal Investor"selected>Personal Investor</option>
                                <option value="Angel Investo">Angel Investor</option>
                                <option value="Venture Capitalist">Venture Capitalist</option>
                                <option value="Other">Other</option>

                            </select>
                            </div>
                            <div class="form-group col-md-4">
                            <label for="amt_in_y">Investment Budget For The Year (In Lacs)</label><br>
                            <input class="form-control" type="number" name="amt_in_y" id="amt_in_y" placeholder="10000">
                            </div>
                            <div class="form-group col-md-6">
                            <label for="i_before" class="mb-3">Have You Invested Before</label><br>
                            <input  type="radio" name="i_before" id="i_before" value="yes" onchange="a_query_y_n(this)"> Yes 
                                 <input  type="radio" name="i_before" id="i_before" value="no"onchange="a_query_y_n(this)"> No
                            </div>

                        </div>


                        <div class="form-row" id="this_t_us_w" style="display:none">
                        <div class="form-group col-md-12">
                            <label for="t_us_w">Tell Us Where You Have Invested</label>
                            <textarea class="form-control" id="t_us_w" name="t_us_w" rows="3" maxlength="1000"
                            placeholder="Tell Us Where Have You Invested"></textarea>
                          </div>
                       </div>


                        <div class="form-row">
                        
                          <div class="form-group col-md-12">
                          <input type="submit" class="btn btn-primary btn-lg btn-block" name="signup-submit" value="Signup">
                          </div>
                        </div> 
                    </form>
                </div>
                    
                </div>
                
            </div>
        </div>
        
        
        
                            
        <?php include 'Hunter/include/footer.php'; ?>              
<?php include 'HTML-Foot.php'; ?>
        
        <script>
            $('#blah').attr('src', 'Hunter/img/default_user.png');
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
         <script type="text/javascript">
        function a_query_y_n(x){
            if(x.checked){
                if(x.name=="user_p"){
                    if(x.value=="in"){
                        document.getElementById("this_i_inv").style.display = "flex";
                    }else{
                        document.getElementById("this_i_inv").style.display = "none";
                        document.getElementById("this_t_us_w").style.display = "none";
                    }
                }
                if(x.name=="i_before"){
                    if(x.value=="yes"){
                        document.getElementById("this_t_us_w").style.display = "flex";
                    }else{
                        document.getElementById("this_t_us_w").style.display = "none";
                    }
                }

            }
        }
        </script>
        
    </body>
</html>