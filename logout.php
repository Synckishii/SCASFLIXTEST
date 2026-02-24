<?php
// logout.php - Destroys session and redirects to login page
session_start();
session_destroy();
header("Location: login.php?tab=signin&msg_type=info&msg=You+have+been+signed+out.");
exit();
?>
