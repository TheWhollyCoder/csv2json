<?php
// ***** Upload CSV File *****
//Check if a File was submited
if(isset($_POST['upload'])){
  include('functlib.php');
  $t=time();
  $week = $_POST['week'];
  $temp_table = getTemporaryTableName($t, $week);
  if($_FILES['file']['name']){
    echo('>>> File Upload Successful...<br>');
    // echo('<pre>');
    // print_r($_FILES);
    // echo('</pre>');
  }else{
    echo('>>>No Files Array to print...<br>');
  }

// Check if file is CSV
$filename = $_FILES['file']['name'];
if(checkIfCSV($filename)){
  // Open Temporary File to Read Contents
  $handle = fopen($_FILES['file']['tmp_name'], "r");
  include('b4gconnect.php');
  include('tablecreate.php');
  //Insert data into MySQL
  include('csvdatainsert.php');
}else{
  exit('>>> There has been an error...<br>');
}
//Retrieve data from MySQL
  $data_file_name = $temp_table.'.json';
  //Convert data to JSON
  $retrieved_data = get_data($connection, $temp_table);
  //Create JSON File
  if($retrieved_data){
    if(file_put_contents($data_file_name, $retrieved_data)){
      echo('>>> '.$data_file_name . ' file created');
    }else{
      echo('>>> There has been some error...<br>');
    }
  }else{
    echo('>>> There has been a problem retrieving data...<br>');
  }

//Download JSON data
  echo('<br><a href="'.$data_file_name.'" target="_blank">Download JSON File</a>');
  echo('<br><a href="upload.php" target="_blank">Convert Another File</a>');
  echo('<br><a href="results.php?week='.$week.'" target="_blank">View Week '.$week.' Results</a>');
}
 ?>
