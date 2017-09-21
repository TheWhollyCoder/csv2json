<?php
$sql_create_table = "CREATE TABLE IF NOT EXISTS `mybod4god`.`$temp_table` (
   `weigh_in_id` INT NOT NULL AUTO_INCREMENT ,
   `weigh_in_competitor_id` INT NOT NULL ,
   `weigh_in_firstname` VARCHAR(255) NOT NULL ,
   `weigh_in_lastname` VARCHAR(255) NOT NULL ,
   `weigh_in_begin` FLOAT(0) NOT NULL ,
   `weigh_in_previous` FLOAT(0) NOT NULL ,
   `weigh_in_current` FLOAT(0) NOT NULL ,
   `weigh_in_team_id` INT NOT NULL ,
   `weigh_in_week` INT NOT NULL ,
   PRIMARY KEY (`weigh_in_id`)
 ) ENGINE = InnoDB;";

   $query = mysqli_query($connection, $sql_create_table);
   if($query){
     echo('>>> Table Created...<br>');
   }else{
     echo('>>> There has been an error...<br>');
   }
 ?>
