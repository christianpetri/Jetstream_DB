<?php

class HandelDB
{
    private $ini = array();

    private function connectToDB()
    {
        $this->ini = parse_ini_file($_SERVER["DOCUMENT_ROOT"] . '/../.ini');
        //echo print_r($this->ini);
        try {
            $this->conn = new PDO("mysql:host={$this->ini['servername']};dbname={$this->ini['dbname']};charset=utf8mb4", $this->ini['username'], $this->ini['password']);
            //$this->conn = new PDO("mysql:host=mysql.jetstream.christianpetri.ch;dbname=jetstream;charset=utf8mb4","jetstream","awk&dava!");
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        $this->ini = "";
    }

    private function select($sql)
    {
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
    private function disconectFromDB()
    {
        $sql = null;
        $stmt = null;
        $this->conn = null;
    }

    public function getHelloWorld()
    {
        try {
            $this->connectToDB();
            $stmt = $this->conn->prepare('
				SELECT @@version;
				');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->disconectFromDB();
    }

    public function getServiceDataFromDB()
    {
        try {
            $this->connectToDB();
            $stmt = $this->conn->prepare('				
                    SELECT serviceauftrag_id, 
                    serviceauftrag_kundenname, 
                    serviceauftrag_telefon, 
                    serviceauftrag_email,  
                    status_name, 
                    prioritaet_name,
                    dienstleistung_name 
                    FROM v_serviceauftrag;
				');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->disconectFromDB();
    }

    public function getStatusDataFormDB()
    {
        try {
            $this->connectToDB();
            $stmt = $this->conn->prepare('		
                Select 
                    status_id, 
                    status_name 
                from v_status
				');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->disconectFromDB();
    }

    public function getServiceDataForServiceIdFromDB($serviceauftrag_id)
    {
        try {
            $this->connectToDB();
            $stmt = $this->conn->prepare('
        SELECT serviceauftrag_id, 
                    serviceauftrag_kundenname, 
                    serviceauftrag_telefon, 
                    serviceauftrag_email,  
                    status_name, 
                    prioritaet_name,
                    dienstleistung_name 
                    FROM v_serviceauftrag
                    where serviceauftrag_id = :serviceauftrag_id
        ');

            $stmt->bindParam(':serviceauftrag_id', $serviceauftrag_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->disconectFromDB();
    }

    /*

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
