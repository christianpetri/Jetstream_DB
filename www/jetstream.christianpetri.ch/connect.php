<?php
class HandelDB
{
  private $ini = array();
  private function connectToDB(){
      $this->ini = parse_ini_file('../.ini');
      //echo print_r($this->ini);
      try {
          $this->conn = new PDO("mysql:host={$this->ini['servername']};dbname={$this->ini['dbname']};charset=utf8mb4",$this->ini['username'],$this->ini['password']);
		//$this->conn = new PDO("mysql:host=mysql.jetstream.christianpetri.ch;dbname=jetstream;charset=utf8mb4","jetstream","awk&dava!");
          // set the PDO error mode to exception
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
              echo "Connection failed: " . $e->getMessage();
      }
      $this->ini = "";
  }
  public function select($sql){
      try {
          $this->connectToDB();
          $stmt = $this->conn->prepare($sql);
          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
          //// TODO: wirte to log file
          echo $e->getMessage();
      }
      $this->disconectFromDB();
  }
  //close the DB connection
  private function disconectFromDB(){
      $sql= null;
      $stmt = null;
      $this->conn = null;
  }

	public function getHelloWorld(){
		try {
			$this-> connectToDB();
			$stmt =  $this->conn->prepare('
				SELECT @@version;
				');
			$stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
		$this->disconectFromDB();
	}
  /*
  public function getHelloWorld($c_id){
    try {
      $this-> connectToDB();
      $stmt =  $this->conn->prepare('
        SELECT @@version;
        ');

      $stmt->bindParam(':c_id'      ,			$c_id  ,			PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $this->disconectFromDB();
  }



  public function getDataInJSON(){
		try {
			$this-> connectToDB();
			$stmt =  $this->conn->prepare('
        SELECT * from
			');
			$stmt->execute();
			return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
		$this->disconectFromDB();
	}
  */
}
$DB = new HandelDB;
