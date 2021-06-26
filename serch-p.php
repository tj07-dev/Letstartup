<?php
require 'dbh.inc.php';
if (isset($_POST['search'])) {
   $Name = $_POST['search'];
   $Query = "select fundraiser_email_id,name from fundraiser where name LIKE '%$Name%' union select investor_email_id,name from investor where name LIKE '%$Name%' LIMIT 5;";
   $ExecQuery = MySQLi_query($conn, $Query);


   while ($Result = MySQLi_fetch_array($ExecQuery)) {
       ?>
   <a class="dropdown-item" href="view_profile.php?view-profile_i=<?php echo $Result['fundraiser_email_id'] ;?>"> 
       <?php echo $Result['name'] ;?>
    </a>
   <?php
}}
?>
