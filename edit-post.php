<?php
    session_start();
    include_once 'dbh.inc.php';
    
    define('TITLE',"Edit Posts");
    if($_SESSION['u_prof']=='in')
    {
        header("Location: profile.php");
        exit();
    }
    
    if(!isset($_SESSION['userId']))
    {
        header("Location: login.php");
        exit();
    }
    if(!isset($_GET['p_id']) || !isset($_GET['o_ty'])){
      header("Location: profile.php");
      exit();
    }
    if($_GET['o_ty']=='delete'){
      $sql = "DELETE FROM posts WHERE  post_id=? AND post_by=?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql))
      {
          die('SQL error');
      }
      else
      {
          mysqli_stmt_bind_param($stmt, "ss", $_GET['p_id'],$_SESSION['emailId']);
          mysqli_stmt_execute($stmt);
          header("Location: profile.php");
      }
      exit();
    }
    
    include 'HTML-head.php';
?>  

        <link rel="stylesheet" type="text/css" href="Hunter/css/comp-creation.css">
</head>

<body style="background: repeating-linear-gradient( 45deg , #fff6e5, #ffebde 155px) fixed center;" >

    <?php include 'Profile/navbar.php'; ?>
    
    <div id="signup">
            <div class="container text-dark font-weight-bolder">
            <div class="row">
            <div class="col-md-12 mt-5">
            <?php
                if(isset($_GET['error']))
                {
                    if($_GET['error'] == 'emptyfields')
                    {
                        echo '<div class="alert alert-danger" role="alert">
                        <strong>Error Empty Field: </strong> Fill All The Fields 
                      </div>';
                    }
                    else if ($_GET['error'] == 'sqlerror')
                    {
                        echo '<div class="alert alert-danger" role="alert">
                        <strong>Website Error: </strong>Contact admin to have the issue fixed 
                      </div>';
                    }
                    else if ($_GET['error'] == 'filesizeexceeded')
                    {
                        echo '<div class="alert alert-danger" role="alert">
                        <strong>File Error: </strong>Pitch file exceeded 25 MB 
                      </div>';
                    }
                    else if ($_GET['error'] == 'invalidfiletype')
                    {
                        echo '<div class="alert alert-danger" role="alert">
                        <strong>File Extension Error: </strong>Please upload file in PDF extension. 
                      </div>';
                    }
                    else if ($_GET['error'] == 'fileuploaderror')
                    {
                        echo '<div class="alert alert-danger" role="alert">
                        <strong>Error: </strong>No pitch file uploaded
                      </div>';
                    }
                }
                else if (isset($_GET['operation']) == 'success')
                {
                    echo '<div class="alert alert-success" role="alert">
                    <strong>Success</strong> Post Updated
                  </div>';
                }
            ?>
            </div>
            </div>
                <?php
                $sql = "select * from posts where post_id=? AND post_by=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql))
                {
                    die('SQL error');
                }
                else
                {
                    mysqli_stmt_bind_param($stmt, "ss", $_GET['p_id'],$_SESSION['emailId']);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $rowi = mysqli_fetch_assoc($result);
                
                ?>
                <div class="row">
                    <div class="col offset text-center">
                    <form id="signup-form" action="edit-post.inc.php?p_id=<?php echo $_GET['p_id'];?>" method='post' 
                                  enctype="multipart/form-data">
                        <h1 class="mt-5" style="text-shadow:0px 12px 9px #30733f;color:#090929;">Editing in Idea</h1>
                        <small>Ideas Every where</small>
                        <br>
                        <div class="form-row">
 

                          <div class="form-group col-md-12 text-left">
                              <img id="blah"  src="uploads/<?php echo $_GET['p_id'];?>" alt="your image" 
                                    style="width: 150px; object-fit: cover;border-radius:9%;box-shadow: 0px 0px 20px 8px #6c6f6424;">
                              <!-- <br><br><label class="btn btn-outline-dark">
                                  Pitch Image <input type="file" id="imgInp" name='dp' hidden>
                            </label> -->
                          </div>
                        </div>
                        
                        <div class="form-row mt-3">

                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="p_type">Post Type <b>( <?php echo $rowi['post_type'];?> )</b></label>
                            <select name="post_t" id="p_type" class="form-control">
                                <option value="public">Public</option>
                                <option value="protected">Protected</option>
                                <option value="private" selected>Private</option>
                            </select>
                          </div>
                          <div class="form-group col-md-4">
                          <label for="post_tag">Categories Tag <b>( <?php echo $rowi['post_tag'];?> )</b></label>
                            <select name="post_tag" id="post_type" class="form-control">
                                <?php
                                $sql = "select id, tag from categories;";
                                $stmt = mysqli_stmt_init($conn);
                                if(!mysqli_stmt_prepare($stmt,$sql)){
                                    die('sql error');
                                }
                                else{
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);

                                    if(mysqli_num_rows($result) == 0){
                                        echo "<h5 class='text-center text-muted'>You cannot create a topic before the admin creates "
                                        . "some categories</h5>";
                                    }else{
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                                                echo '<option value='.$row['tag'].'>' . $row['tag'] . '</option>';
                                            }
                                    }

                                }
                                ?>
                                <option value="Other" selected>Other</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="s_level">Stage <b>( <?php echo $rowi['stage'];?> )</b></label>
                            <select name="s_level" id="s_level" class="form-control">
                                <option value="Idea Stage"selected>Idea Stage</option>
                                <option value="Proof Of Concept">Proof Of Concept</option>
                                <option value="Beta Launched">Beta Launched</option>
                                <option value="Early Transaction">Early Transaction</option>
                                <option value="Steady Revenue" >Steady Revenue</option>
                            </select>

                          </div>
                            </div>
                        <div class="form-row">

                          <div class="form-group col-md-12 pt-4 text-left">
                            <label for="single-founder"><b>Are you a single founder ?</b></label>
                                 <input type="radio" name="single_founder" id="single-founder" value="yes" onchange="a_query_y_n(this)" checked> Yes 
                                 <input type="radio" name="single_founder" id="single-founder" value="no"onchange="a_query_y_n(this)" > No
                          </div>
                        </div>
                        <div class="form-row" id="do_single-founder" style="display:none">

                        <div class="form-group col-md-5">
                        <label for="do_name">Full Name</label>
                        <input type="text" class="form-control"  name="do_name" placeholder="Full Name" maxlength="25">
                        </div>
                        <div class="form-group col-md-5">
                        <label for="do_email">Email</label>
                        <input type="email" class="form-control"  name="do_mail" placeholder="Email">
                        </div>
                        <div class="form-group col-md-2">

                        </div>
                        </div>
                        <div class="form-row">

                        <div class="form-group col-md-12 text-left">
                        <label for="registerd_s"><b>Do you have registerd name of the startup ?</b></label>
                            <input type="radio" name="registerd_s" value="yes" onchange="a_query_y_n(this)" id="registerd_s"> Yes 
                            <input type="radio" name="registerd_s" value="no" onchange="a_query_y_n(this)" id="registerd_s" checked> No
                        </div>
                        </div>
                        <div class="form-row" id="do_registerd_s" style="display:none">

                        <div class="form-group col-md-10">
                        <label for="do_reg_namee">Registerd Name</label>
                        <input type="text" class="form-control"  name="do_reg_name" placeholder="Registerd Name" maxlength="55">
                        </div>
                        <div class="form-group col-md-2"></div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="title">Post Title</label>
                            <input type="text" class="form-control" id="p_title" name="p_title" value="<?php echo $rowi['post_title'];?>" placeholder="<?php echo $rowi['post_title'];?>">
                          </div>
                        <div class="form-group col-md-10">
                            <label for="p_content">Quick Pitch</label>
                            <textarea class="form-control" id="p_content"  name="p_content" rows="6" maxlength="1000"
                            placeholder="<?php echo $rowi['post_content'];?>"><?php echo $rowi['post_content'];?></textarea>
                          </div>
                          <div class="form-group col-md-2">
                            <label for="pitch_doc">Upload Pitch</label>
                            <input type="file"  id="pitch_doc" name="pitch_doc" accept="application/pdf" hidden>
                            <label for="pitch_doc" class="form-control"><b>Choose Pitch PDF</b></label>
                        </div>
                        <?php
                      }
                      ?>
                          <div class="form-group col-md-12">
                          <input type="submit" class="btn btn-primary btn-lg btn-block" name="idea-submit" value="Update Idea">
                          </div>
                        </div>  
                    </form>
                </div>
                    
                </div>
                
            </div>
        </div>
    
    
    <?php include 'Hunter/include/footer.php'; ?>

    <script type="text/javascript">
        function a_query_y_n(x){
            if(x.checked){
                if(x.id=="single-founder"){
                    if(x.value=="no"){
                        document.getElementById("do_single-founder").style.display = "flex";
                    }else{
                        document.getElementById("do_single-founder").style.display = "none";
                    }
                }
                if(x.id=="registerd_s"){
                    if(x.value=="yes"){
                        document.getElementById("do_registerd_s").style.display = "flex";
                    }else{
                        document.getElementById("do_registerd_s").style.display = "none";
                    }
                }

            }
        }
        </script>
    <?php include 'HTML-Foot.php'; ?>  
    <script>
            $('#blah').attr('src', 'uploads/<?php echo $rowi['post_img'];?>');
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
