<?php
session_start();
require 'dbh.inc.php';
if (isset($_POST['show_n']) &&$_POST['show_n'] == true && $_SESSION['u_prof'] !='in') {
   $Query = "select i.post_id,inv_s.name as name,inv_s.profile_pic,i.investor_e_id as e_id from investor as inv_s,i_intrested as i,posts as p where i.post_id=p.post_id and i.visited='not' and p.post_by='".$_SESSION['emailId']."' and i.investor_e_id=inv_s.investor_email_id union select f.post_id,fun_s.name as name,fun_s.profile_pic,f.fundraiser_e_id as e_id from fundraiser as fun_s,f_intrested as f,posts as p where f.post_id=p.post_id and f.visited='not' and f.fundraiser_e_id=fun_s.fundraiser_email_id and p.post_by='".$_SESSION['emailId']."';";
   $ExecQuery = MySQLi_query($conn, $Query);
   while($Result = mysqli_fetch_assoc($ExecQuery)){
       ?>
    <a href="view_notification.php?<?php echo "view-noti_i=".$Result['e_id']."&po_v_id=".$Result['post_id'];?>" class="pl-3 ml-n2"><div id="vanillatoasts-container">
    <div id="toast-3" class="vanillatoasts-toast vanillatoasts-success">
    <h4 class="vanillatoasts-title mt-n2 text-dark "><?php echo ucwords($Result['name']);?> ( <small class="" style="color: chocolate;"><?php echo $Result['e_id'];?></small> )</h4>
    <p class="vanillatoasts-text"><?php echo ucwords($Result['name']);?> is intrested in your post</p>
    <img src="uploads/<?php echo ucwords($Result['profile_pic']);?>" class="vanillatoasts-icon">
    </div>
    </div></a>
   <?php
}
    $Query = "select i.post_id,inv_s.name as name,inv_s.profile_pic,i.investor_e_id as e_id from investor as inv_s,i_intrested as i,posts as p where i.post_id=p.post_id and i.visited='true' and p.post_by='".$_SESSION['emailId']."' and i.investor_e_id=inv_s.investor_email_id union select f.post_id,fun_s.name as name,fun_s.profile_pic,f.fundraiser_e_id as e_id from fundraiser as fun_s,f_intrested as f,posts as p where f.post_id=p.post_id and f.visited='true' and f.fundraiser_e_id=fun_s.fundraiser_email_id and p.post_by='".$_SESSION['emailId']."';";
    $ExecQuery = MySQLi_query($conn, $Query);
    while($Result = mysqli_fetch_assoc($ExecQuery)){
       ?>
    <a href="view_notification.php?<?php echo "view-noti_i=".$Result['e_id']."&po_v_id=".$Result['post_id'];?>" class=" pl-3 ml-n2"><div id="vanillatoasts-container">
    <div id="toast-3" class="vanillatoasts-toast vanillatoasts-success" style="background:#51840026">
    <h4 class="vanillatoasts-title mt-n2 "><?php echo ucwords($Result['name']);?> ( <small class="" style="color: chocolate;"><?php echo $Result['e_id'];?></small> )</h4>
    <p class="vanillatoasts-text"><?php echo ucwords($Result['name']);?> is intrested in your post</p>
    <img src="uploads/<?php echo ucwords($Result['profile_pic']);?>" class="vanillatoasts-icon">
    </div>
    </div></a>
   <?php
}
}
?>
