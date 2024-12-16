<?php
session_start();
session_destroy();
header("Location: account-section/login.php");
exit;
?>
