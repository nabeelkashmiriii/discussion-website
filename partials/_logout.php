<?php
session_start();
echo "logging You Out Please Wait...";
session_destroy();
header("location: /forum/index.php");
?>