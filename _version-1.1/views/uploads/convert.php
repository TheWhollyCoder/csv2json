<?php
require('../../../../__CONNECT/myb4g-connect.php');
require('../../models/Upload.php');
// ***** Upload CSV File *****
//Check if a File was submited
if(isset($_POST['upload_csv'])){
  if($_FILES['file']['name']){
    echo('>>> File Upload Successful...<br>');
  }else{
    echo('>>>No Files Array to print...<br>');
  }
// *** Construct Upload Properties Array *****
$filename = $_FILES['file']['name'];
$tmp_file = $_FILES['file']['tmp_name'];

$properties = array(
  'connection'    =>    $connection,
  'week'          =>    $_POST['week'],
  'filename'      =>    $filename,
  'tmp_file'      =>    $tmp_file
);
// ***** Instantiate Upload Object *****
$upload = new Upload($properties);
                // echo('<pre>');
                // print_r($upload);
                // echo('</pre>');
// Check if file is CSV
if($upload->check_if_csv($upload->filename)){
  // Open Temporary File to Read Contents
  $upload->set_file_handle();
  //Insert data into MySQL
  $upload->insert_csv_data();
}else{
  exit('>>> There has been an error...<br>');
}
  //Retrieve data from MySQL
  $data_filename = './json/'.$upload->temp_table.'.json';
  //Convert data to JSON
  $retrieved_data = $upload->get_data();
  //Create JSON File
  if($retrieved_data){
    if(file_put_contents($data_filename, $retrieved_data)){
      echo('>>> '.$data_filename . ' file created');
    }else{
      echo('>>> There has been some error...<br>');
    }
  }else{
    echo('>>> There has been a problem retrieving data...<br>');
  }

//Download JSON data
  echo('<br><a href="'.$data_filename.'" target="_blank">Download JSON File</a>');
  echo('<br><a href="upload.php" target="_blank">Convert Another File</a>');
  echo('<br><a href="results.php?week='.$upload->week.'" target="_blank">View Week '.$upload->week.' Results</a>');
}
 ?>
