
<?php
    session_start();
    require 'dbh.inc.php';
    
    define('TITLE',"Complaint | LetsStartUp");
    
    if(!isset($_SESSION['emailId']))
    {
        header("Location: login.php");
        exit();
    }
    
include 'HTML-head.php';
?>  
<body>
<?php include 'Profile\navbar.php';?>
<div class="container mt-5 mb-5" style="background: repeating-linear-gradient(45deg, #fff0f0, transparent 100px) fixed center;">
    <div class="row mt-5 mb-5">
        <div class="col-md-12 mt-5 mb-5">
        <form id="" action="complaint.inc.php" method='post' 
                                  enctype="multipart/form-data">
                        <h1 class="mt-5 mb-4 text-dark" style="text-shadow:0px 12px 9px #30733f;color:#090929;">Complaint</h1>
                        <br>
            <?php  if(isset($_GET['error']))
              {
                  echo '<div class="form-row">';

                  if($_GET['error'] == 'emptyfields')
                  {
                      echo '<div class="alert alert-danger" role="alert">
                              <strong>Error: </strong> Fill In All The Fields
                            </div>';
                  }
                  else if ($_GET['error'] == 'sqlerror')
                  {
                      echo '<div class="alert alert-danger" role="alert">
                              <strong>Website Error: </strong> Contact admin to have the issue fixed
                            </div>';
                  }
                  echo '</div>';
              }
              else if (isset($_GET['operation']) == 'success')
              {
                  echo '<div class="alert alert-success" role="alert">
                          <strong>Successful : </strong> Complaint Registerd Successfully 
                        </div>';
              }
              
          ?>
        <div class="form-row text-dark font-weight-bold">
        <?php
        if (isset($_GET['u_id']) && isset($_GET['p_ti']) && isset($_GET['r_ty']) && isset($_GET['report']) && $_GET['r_ty'] == 'other' && $_GET['report'] == 'true'){
        ?>
        <div class="form-group col-md-12">
              <div class="row">
                  <div class="col-2"><label for="">Report User ID</label></div>
                  <div class="col-1 ml-n5 text-center"><label for="" > : </label></div>
                  <div class="col-9 ml-n5"><label for=""><?php echo $_GET['u_id']; ?></label></div>
              </div>
              <div class="row">
                  <div class="col-2"><label for="">Report Post Title </label></div>
                  <div class="col-1 ml-n5 text-center"><label for=""> : </label></div>
                  <div class="col-9 ml-n5"><label for=""><?php echo $_GET['p_ti']; ?></label></div>
              </div>
            <hr>          
       </div>
       <?php }
       else if(isset($_GET['u_id']) && isset($_GET['r_ty'])  && isset($_GET['p_id']) && isset($_GET['report']) && $_GET['r_ty']=='inappropriate' && $_GET['report']=='true'){
        $lc_date = date('l Y-m-d H:i:s');
        $lc_title = "Inappropiate post Post ID: ".$_GET['p_id']." By: ".$_GET['u_id'];
        $lc_body = "Required Action To Report";
        $sql = "INSERT INTO `complaint`(`complainee_id`, `date_of_complaint`, `complaint_subject`, `main_complaint`) VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            die('SQL ERROR');
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt,"ssss",$_SESSION['emailId'],$lc_date,$lc_title,$lc_body);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        echo '<div class="alert alert-success" role="alert">
        <strong>Successful : </strong> Complaint Registerd Successfully <a href="profile.php">GO BACK</a>
      </div>';
      exit();
       }
       ?>
        <div class="form-group col-md-12">
            <label for="c_title">Complaint Title</label>
            <textarea class="form-control" name="c_title" rows="2" maxlength="1000"
            placeholder="Complaint Title"></textarea>
        </div>
        <div class="form-group col-md-12">
            <label for="c_body">Complaint Body</label>
            <textarea class="form-control" name="c_body" rows="5" maxlength="1000"
            placeholder="Complaint Body"></textarea>
        </div>
        <div class="form-group col-md-12">
        <input type="submit" class="btn btn-primary btn-lg btn-block" name="c-submit" value="Submit">
        </div>
        </div>
        </div>
</div>
</div>


<?php include 'Hunter/include/footer.php'; ?>
<?php include 'HTML-Foot.php'; ?>

</body>
</html>