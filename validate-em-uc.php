<?php

require 'dbh.inc.php';
if (isset($_POST['search'])) {
   $Name = $_POST['search'];
   $Query = "select fundraiser_email_id as e_id from fundraiser where fundraiser_email_id LIKE '$Name%' union select investor_email_id as e_id from investor where investor_email_id LIKE '$Name%';";
   $ExecQuery = MySQLi_query($conn, $Query);


   $Result = mysqli_fetch_assoc($ExecQuery)
       ?>
       <?php echo !empty($Result['e_id']) ? "<i class='fa fa-close'></i>  *email already registerd <input type='text' name='ema_val_coa' value='1' hidden>" : "<i class='fa fa-check'></i> available<input type='text' name='ema_val_coa' value='8' hidden>";?>
    </a>
   <?php
}
?>
