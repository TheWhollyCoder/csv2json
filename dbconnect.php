<?php
// Connect to Database
$db_host      = 'localhost';
$db_user      = 'root';
$db_password  = 'whollymath';
$db           = 'whollycoders';
$connection = mysqli_connect($db_host, $db_user, $db_password, $db) or die('>>> Connection Error!!!');
if($connection){
  echo('>>> Welcome to WhollyCoder DBMS!!! --- Database Connection Successful...<br>');
}
 ?>
