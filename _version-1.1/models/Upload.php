<?php
class Upload{
  public $connection;
  public $time;
  public $week;
  public $filename;
  public $tmp_file;
  public $temp_table;
  public $handle;

  public function __construct($properties){
    $this->connection = $properties['connection'];
    $this->week       = $properties['week'];
    $this->filename   = $properties['filename'];
    $this->tmp_file   = $properties['tmp_file'];
    $this->temp_table = $this->get_temp_table_name();

  }

  public function check_if_csv(){
    $filename = explode(".", $this->filename);
    if($filename[1] == 'csv'){
      return true;
    }else{
      return false;
    }
  }

  public function create_temp_table(){
    $sql = "CREATE TABLE IF NOT EXISTS `mybod4god`.`".$this->temp_table."` (
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

      $result = $this->process_query($sql);
    }

    public function get_data(){
      $sql = "SELECT * FROM `mybod4god`.`".$this->temp_table."`;";
      $result = $this->process_query($sql);
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

    public function get_temp_table_name(){
      $temp_table = 'week'.$this->week.'_'.time();
      return $temp_table;
    }

    public function insert_csv_data(){
      $this->create_temp_table();
      while($data = fgetcsv($this->handle)){
        $weigh_in_competitor_id = mysqli_real_escape_string($this->connection, $data[0]);
        $weigh_in_firstname     = mysqli_real_escape_string($this->connection, $data[1]);
        $weigh_in_lastname      = mysqli_real_escape_string($this->connection, $data[2]);
        $weigh_in_begin         = mysqli_real_escape_string($this->connection, $data[3]);
        $weigh_in_previous      = mysqli_real_escape_string($this->connection, $data[4]);
        $weigh_in_current       = mysqli_real_escape_string($this->connection, $data[5]);
        $weigh_in_team_id       = mysqli_real_escape_string($this->connection, $data[6]);
        $weigh_in_week          = mysqli_real_escape_string($this->connection, $data[7]);
        $sql                    = "INSERT INTO `mybod4god`.`".$this->temp_table."` (
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
        // echo('<pre>');
        // print_r($sql);
        // echo('</pre>');
        $this->process_query($sql);
      }
      fclose($this->handle);
      print('>>> Import Complete...<br>');
    }

    public function process_query($sql){
      return $result = mysqli_query($this->connection, $sql);
    }

    public function set_file_handle(){
      $this->handle = fopen($this->tmp_file, "r");
    }

}
 ?>
