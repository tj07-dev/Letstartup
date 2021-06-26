<?php

if (isset($_POST['signup-submit']))
{
    require 'dbh.inc.php';
    $Name = $_POST['uid'];
    $email = $_POST['mail'];
    //$password = $_POST['pwd'];
    //$passwordRepeat  = $_POST['pwd-repeat'];
    $gender = $_POST['gender'];
    $user_p = $_POST['user_p'];
    $dob = $_POST['dob'];
    $p_no = $_POST['pnum'];
    $address = $_POST['add'];
    $linkedin = $_POST['l_url'];
    $password = rand(100000,999999);

    if(!empty($_POST['ema_val_coa']) && $_POST['ema_val_coa']=='8' )
    {
    }
    else{
        header("Location: signup.php?error=invalidmail");
        exit();
    }
    if($user_p=='in'){
        $s_tof_i = $_POST['s_tof_i'];
        $i_before = $_POST['i_before'];
        $t_us_w = $_POST['t_us_w'];
        $amt_in_y = $_POST['amt_in_y'];
        if($i_before=="yes"){
        if(empty($t_us_w)){
            header("Location: signup.php?error=emptyfield_inv");
            exit();
        }
        }else{
            $t_us_w=$i_before;  
        }
    }
    if (empty($linkedin) || empty($Name) || empty($email)  || empty($gender) || empty($user_p) || empty($dob) || empty($address) || empty($p_no))
    {
        header("Location: signup.php?error=emptyfields&uid=".$Name."&mail=".$email);
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*/", $Name))
    {
        header("Location: signup.php?error=invalidmailuid");
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        header("Location: signup.php?error=invalidmail&uid=".$Name);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*/", $Name))
    {
        header("Location: signup.php?error=invaliduid&mail=".$email);
        exit();
    }
    else
    {
        // checking if a user already exists with the given username
        
        if($user_p!='in'){
            $sql = "select fundraiser_email_id from fundraiser where fundraiser_email_id=?;";
        }else{
            $sql = "select investor_email_id from investor where investor_email_id=?;";
        }
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: signup.php?error=sqlerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $Name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            
            $resultCheck = mysqli_stmt_num_rows($stmt);
            
            if ($resultCheck > 0)
            {
                header("Location: signup.php?error=usertaken&mail=".$email);
                exit();
            }
            else
            {
                $FileNameNew = 'default.png';
                require 'upload.inc.php';
                if($user_p!='in'){
                    $sql = "insert into fundraiser(fundraiser_email_id,linked_in,name,phone,address,profile_pic,DOB,gender,password) "
                            ."values (?,?,?,?,?,?,?,?,?)";
                }else{
                    $sql = "insert into investor(investor_email_id,linked_in,name,phone,type_of_invest,invest_buget,
                            invested_before,address,profile_pic,DOB,gender,password) "
                            ."values (?,?,?,?,?,?,?,?,?,?,?,?)";
                }
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql))
                {
                    header("Location: signup.php?error=sqlerror");
                    exit();
                }
                else
                {   $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    if($user_p=='in'){
                    mysqli_stmt_bind_param($stmt, "ssssssssssss", $email,$linkedin, $Name, $p_no, $s_tof_i,$amt_in_y,
                        $t_us_w,
                        $address,
                            $FileNameNew,$dob,$gender,$hashedPwd);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    
                    //$base_url = "http://localhost/letstartup/";           
			        $mail_body = "
			        <p>Hi ".$Name.",</p>
			        <p>Thanks for Registration. Your password is ".$password."</p>
                    <p> You can login with this password.</p>
			        <p>Best Regards,<br /><b>Let'sStartUp</b></p>
			        ";
			        require 'class/class.phpmailer.php';
			        $mail = new PHPMailer;
			        $mail->IsSMTP();								            //Sets Mailer to send message using SMTP
			        $mail->Host = 'smtp.gmail.com';		                        //Sets the SMTP hosts of your Email hosting, this for Gmail
			        $mail->Port = '465';								        //Sets the default SMTP server port
			        $mail->SMTPAuth = true;							            //Sets SMTP authentication. Utilizes the Username and Password variables
			        $mail->Username = 'letsstartupacro@gmail.com';				//Sets SMTP username
			        $mail->Password = 'LetsStartUp@1234';					    //Sets SMTP password
			        $mail->SMTPSecure = 'ssl';							        //Sets connection prefix. Options are "", "ssl" or "tls"
			        $mail->From = 'letsstartupacro@gmail.com';			        //Sets the From email address for the message
			        $mail->FromName = 'LetsStartUp';					        //Sets the From name of the message
			        $mail->AddAddress($email, $Name);		                    //Adds a "To" address			
			        $mail->WordWrap = 50;							            //Sets word wrapping on the body of the message to a given number of characters
			        $mail->IsHTML(true);							            //Sets message type to HTML				
			        $mail->Subject = 'Email Verification';			            //Sets the Subject of the message
			        $mail->Body = $mail_body;						            //An HTML or plain text message body
			        if($mail->Send())								            //Send an Email. Return true on success or false on error
			        {
                        header("Location: signup.php?signup=success");
			        }
                    exit();
                    }else{
                        mysqli_stmt_bind_param($stmt, "sssssssss", $email,$linkedin, $Name, $p_no, $address,
                        $FileNameNew,$dob,$gender,$hashedPwd);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                        //$base_url = "http://localhost/letstartup/";          
                        $mail_body = "
                        <p>Hi ".$Name.",</p>
                        <p>Thanks for Registration.Your password is ".$password."</p>
                        <p> You can login with this password.</p>
                        <p>Best Regards,<br /><b>Let'sStartUp</b></p>";
                        require 'class/class.phpmailer.php';
                        $mail = new PHPMailer;
                        $mail->IsSMTP();								        //Sets Mailer to send message using SMTP
                        $mail->Host = 'smtp.gmail.com';                         //Sets the SMTP hosts of your Email hosting, this for Gmail
                        $mail->Port = '465';                                    //Sets the default SMTP server port
                        $mail->SMTPAuth = true;	                                //Sets SMTP authentication. Utilizes the Username and Password variables
                        $mail->Username = 'letsstartupacro@gmail.com';          //Sets SMTP username
                        $mail->Password = 'LetsStartUp@1234';	                //Sets SMTP password
                        $mail->SMTPSecure = 'ssl';					            //Sets connection prefix. Options are "", "ssl" or "tls"
                        $mail->From = 'letsstartupacro@gmail.com';	            //Sets the From email address for the message
                        $mail->FromName = 'LetsStartUp';			            //Sets the From name of the message
                        $mail->AddAddress($email, $Name);		                //Adds a "To" address			
                        $mail->WordWrap = 50;							        //Sets word wrapping on the body of the message to a given number of characters
                        $mail->IsHTML(true);							        //Sets message type to HTML				
                        $mail->Subject = 'Email Verification';			        //Sets the Subject of the message
                        $mail->Body = $mail_body;						        //An HTML or plain text message body
                        if($mail->Send())								        //Send an Email. Return true on success or false on error
                        {
                            header("Location: signup.php?signup=success");
                        }
                        exit();
                    }
                }
            }
        }
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
}

else
{
    header("Location: signup.php");
    exit();
}