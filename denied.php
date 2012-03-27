<?php
include_once "init_oauth.php";
session_start();
echo "DENIED <a href='/authorize.php?user_id=". $_SESSION[SESSION_KEY_USER] ."'>try again</a>";
?>

