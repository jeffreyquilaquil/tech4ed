<?php

  class Database
  {
    public $db;
    function __construct()
    {
      $this->db = new mysqli('localhost:3306', 'root', '', 'info_kiosk');
      if (mysqli_connect_errno()) {
        echo "
          <script type='text/javascript'>
            alert('Cannot establish connection to database.');
          </script>
        ";
        exit;
      }

      if($this->is_connected()){
    #    var_dump($this->selectSingleData('backup', ['backup_date']));
      #  $db2 = new mysqli('db4free.net:3306/dostinfokiosk', 'dostinfokiosk', '#SjFk8#oStxgZpYThNdP', 'dostinfokiosk');
      }
    }

    function is_connected(){
      $connected = @fsockopen('www.db4free.net', 80, $error);
      var_dump($connected);
      return ($connected ? true : false);
    }

    function insertSingleRow(string $table, array $data){
      $query = "INSERT INTO ".$table." SET";
      $dataCount = count($data);
      $i = 1;
      foreach($data as $key => $value){
        $comma = ($i < $dataCount ? ',' : '');
        $query .= ' '.$key.' = '.'"'.$value.'"'.$comma;
        $i++;
      }
      $this->db->query($query);
      echo $this->db->error;
    }

    function selectSingleData(string $table, array $data, $where = 1){
      $query = "SELECT";
      $i = 1;
      $dataCount = count($data);
      foreach($data as  $value){
        $comma = ($i < $dataCount ? ',' : '');
        $query .= ' '.$value.$comma;
        $i++;
      }
      $query .= " FROM ".$table;
      $query .= " WHERE ".$where;
      $result = $this->db->query($query);
      echo $this->db->error;
      return $result;
    }
  }

 ?>