<?php
// Connect to Database
$db_host      = "mybod4god.db.8324862.hostedresource.com";
$db_user      = "mybod4god";
$db_password  = 'Wh0llym@th';
$db           = 'mybod4god';
$connection = mysqli_connect($db_host, $db_user, $db_password, $db) or die('>>> Connection Error!!!');
if($connection){
  echo('>>> Welcome to WhollyCoder DBMS!!! --- Database Connection Successful...<br>');
}
 ?>
