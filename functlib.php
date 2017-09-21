<?php




// $filename;
// $fileNameArray;
// $_FILES['file']['name'] = 'csvdata.csv';
//$sql = 'SELECT * FROM `B4GWeek8_1489675506` LIMIT 0, 30 ';
function get_data($connection, $temp_table){
  $sql_select_records = "SELECT * FROM `mybod4god`.`$temp_table`";
  $result = mysqli_query($connection, $sql_select_records);
  $competition_data = array();
  while($row = mysqli_fetch_array($result)){
    $competition_data[] = array(
      'weigh_id'        =>  $row['weigh_in_id'],
      'competitor_id'   =>  $row['weigh_in_competitor_id'],
      'firstname'       =>  $row['weigh_in_firstname'],
      'lastname'        =>  $row['weigh_in_lastname'],
      'begin'           =>  $row['weigh_in_begin'],
      'previous'        =>  $row['weigh_in_previous'],
      'current'         =>  $row['weigh_in_current'],
      'TeamID'          =>  $row['weigh_in_team_id'],
      'week'            =>  $row['weigh_in_week']
    );
  }
  return json_encode($competition_data);
}

function getTemporaryTableName($t, $week){
  $temp_table = 'week'.$week.'_'.$t;
  return $temp_table;
}


function checkIfCSV($filename){
  $filename = explode(".", $filename);
  if($filename[1] == 'csv'){
    return true;
  }else{
    return false;
  }
}

function setFileNameArray(){
  $filename = explode(".", $_FILES['file']['name']);
  // print_r($filename);
  echo('<br>File Name Array Set...<br>');
  return $filename;
}

function getFileNameArray($filename){
  return($filename);
}


function getDatbaseConnection(){

}

function getFileType(){
  echo '<br>'.$filename[1];
}

// $filename = setFileNameArray();
// // print_r($filename);
// $fileNameArray = getFileNameArray($filename);
// echo('File Array: ');
// print_r($fileNameArray);

//
// include('dbconnect.php');
// if(isset($_POST['submit'])){
//   if($_FILES['file']['name']){
//     print_r($_FILES);
// /*
// Array (
//   [file] => Array (
//     [name] => csvdata.csv
//     [type] => application/vnd.ms-excel
//     [tmp_name] => C:\wamp64\tmp\php3B85.tmp
//     [error] => 0
//     [size] => 71
//     )
//   )
//
// */
//     $filename = explode(".", $_FILES['file']['name']);
//     if($filename[1] == 'csv'){
//       $handle = fopen($_FILES['file']['tmp_name'], "r");
//       include('tablecreate.php');
//       while($data = fgetcsv($handle)){
//         $excel_name = mysqli_real_escape_string($connection, $data[0]);
//         $excel_email = mysqli_real_escape_string($connection, $data[1]);
//         $sql_insert_data = "INSERT INTO `table_excel` (
//           `excel_id`,
//           `excel_name`,
//           `excel_email`,
//           `excel_dateCreated`
//         ) VALUES (
//           NULL,
//           '$excel_name',
//           '$excel_email',
//           CURRENT_TIMESTAMP
//         );";
//         mysqli_query($connection, $sql_insert_data);
//       }
//       fclose($handle);
//       print('Import Complete...');
//     }
//   }
// }
 ?>
