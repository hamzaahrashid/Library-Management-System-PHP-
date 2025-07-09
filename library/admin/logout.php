<?php
session_start();
if(isset($_SESSION['login_user']))
{
unset($_SESSION['login_user']); //logging out 
}
header("location:../index.php") //directing to the index.php (home page) after loggging out
 
?>