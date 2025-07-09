<?php

   $db=mysqli_connect("localhost","root","","library"); 

   if(!$db)
   {
   	die("Connection Failed: ".mysqli_connect_error());
   }

   echo "Connected Successfully ";

?>