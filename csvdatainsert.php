<?php
while($data = fgetcsv($handle)){
  $weigh_in_competitor_id = mysqli_real_escape_string($connection, $data[0]);
  $weigh_in_firstname     = mysqli_real_escape_string($connection, $data[1]);
  $weigh_in_lastname      = mysqli_real_escape_string($connection, $data[2]);
  $weigh_in_begin         = mysqli_real_escape_string($connection, $data[3]);
  $weigh_in_previous      = mysqli_real_escape_string($connection, $data[4]);
  $weigh_in_current       = mysqli_real_escape_string($connection, $data[5]);
  $weigh_in_team_id       = mysqli_real_escape_string($connection, $data[6]);
  $weigh_in_week          = mysqli_real_escape_string($connection, $data[7]);
  $sql_insert_data        = "INSERT INTO `mybod4god`.`$temp_table` (
    `weigh_in_id`,
    `weigh_in_competitor_id`,
    `weigh_in_firstname`,
    `weigh_in_lastname`,
    `weigh_in_begin`,
    `weigh_in_previous`,
    `weigh_in_current`,
    `weigh_in_team_id`,
    `weigh_in_week`
  ) VALUES (
    NULL,
    '$weigh_in_competitor_id',
    '$weigh_in_firstname',
    '$weigh_in_lastname',
    '$weigh_in_begin',
    '$weigh_in_previous',
    '$weigh_in_current',
    '$weigh_in_team_id',
    '$weigh_in_week'
  );";
  mysqli_query($connection, $sql_insert_data);
}
fclose($handle);
print('>>> Import Complete...<br>');
 ?>
