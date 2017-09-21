<?php

















include('dbconnect.php');
if(isset($_POST['submit'])){
  if($_FILES['file']['name']){
    print_r($_FILES);
/*
Array (
  [file] => Array (
    [name] => csvdata.csv
    [type] => application/vnd.ms-excel
    [tmp_name] => C:\wamp64\tmp\php3B85.tmp
    [error] => 0
    [size] => 71
    )
  )

*/
    $filename = explode(".", $_FILES['file']['name']);
    if($filename[1] == 'csv'){
      $handle = fopen($_FILES['file']['tmp_name'], "r");
      include('tablecreate.php');
      while($data = fgetcsv($handle)){
        $excel_name = mysqli_real_escape_string($connection, $data[0]);
        $excel_email = mysqli_real_escape_string($connection, $data[1]);
        $sql_insert_data = "INSERT INTO `table_excel` (
          `excel_id`,
          `excel_name`,
          `excel_email`,
          `excel_dateCreated`
        ) VALUES (
          NULL,
          '$excel_name',
          '$excel_email',
          CURRENT_TIMESTAMP
        );";
        mysqli_query($connection, $sql_insert_data);
      }
      fclose($handle);
      print('Import Complete...');
    }
  }
}
 ?>
