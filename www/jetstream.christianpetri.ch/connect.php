<?php

/**
 * Class HandelDB
 */
class HandelDB
{
    /**
     * @var array
     */
    private $ini = array();
    /**
     * @var null
     */
    private $conn = null;

    /**
     *
     */
    private function connectToDB()
    {
        $this->ini = parse_ini_file($_SERVER["DOCUMENT_ROOT"] . '/../.ini');
        try {
            $this->conn = new PDO("mysql:host={$this->ini['servername']};dbname={$this->ini['dbname']};charset=utf8mb4", $this->ini['username'], $this->ini['password']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        $this->ini = "";
    }

    /**
     * @param $sql
     * @return mixed
     */
    private function select($sql)
    {
        try {
            $this->connectToDB();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->disconectFromDB();
    }

    //close the DB connection

    /**
     *
     */
    private function disconectFromDB()
    {
        $this->select(null);
        $this->conn = null;
    }

    /**
     * @return mixed
     */
    public function getHelloWorld()
    {
        return $this->select('
				SELECT @@version;
				');
    }

    /**
     * @return mixed
     */
    public function getServiceDataFromDB()
    {
        return $this->select(
            '
                SELECT 
                  serviceauftrag_id, 
                  serviceauftrag_kundenname, 
                  serviceauftrag_telefon, 
                  serviceauftrag_email,  
                  status_name, 
                  prioritaet_name,
                  dienstleistung_name 
                FROM v_serviceauftrag;
				');
    }

    /**
     * @return mixed
     */
    public function getDienstleistungDataFromDB()
    {
        return $this->select(
            '
            SELECT 
                dienstleistung_id,
                dienstleistung_name
            FROM v_dienstleistung;
				');
    }

    /**
     * @return mixed
     */
    public function getStatusDataFormDB()
    {
        return $this->select(
            '
                Select 
                    status_id, 
                    status_name 
                from v_status
				');

    }

    /**
     * @return mixed
     */
    public function getPrioritaetDataFormDB()
    {
        return $this->select(
            '
                Select 
                    `prioritaet_id`,
                    `prioritaet_name`,
                    `prioritaet_zusaetzliche_tage`,
                    `prioritaet_tage_bis_zur_fertigstellung` 
                FROM `v_prioritaet`
				');

    }

    /**
     * @param $serviceauftrag_id
     * @return mixed
     */
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

    /**
     * @param $serviceauftrag_id
     * @param $serviceauftrag_kundenname
     * @param $serviceauftrag_email
     * @param $serviceauftrag_telefon
     * @param $status_id
     * @return mixed
     */
    public function updateServiceDataForServiceIdInDB
    (
        $serviceauftrag_id,
        $serviceauftrag_kundenname,
        $serviceauftrag_email,
        $serviceauftrag_telefon,
        $status_id
    )
    {
        $this->connectToDB();
        $sql =
            '
            CALL `spUpdateServiceauftrag`
            ( 
                :serviceauftragKundenname,  
                :serviceauftragEmail,  
                :serviceauftragTelefon, 
                :statusId,
                :serviceauftragId 
            )
        ';

        try {

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':serviceauftragId', $serviceauftrag_id, PDO::PARAM_INT);
            $stmt->bindParam(':serviceauftragKundenname', $serviceauftrag_kundenname);
            $stmt->bindParam(':serviceauftragEmail', $serviceauftrag_email);
            $stmt->bindParam(':serviceauftragTelefon', $serviceauftrag_telefon);
            $stmt->bindParam(':statusId', $status_id, PDO::PARAM_INT);

            return $stmt->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->disconectFromDB();
    }

    /**
     * @param $serviceauftrag_kundenname
     * @param $serviceauftrag_email
     * @param $serviceauftrag_telefon
     * @param $status_id
     * @param $dienstleistung_id
     * @param $prioritaet_id
     */
    public function addServiceDataToTheDB
    (
        $serviceauftrag_kundenname,
        $serviceauftrag_email,
        $serviceauftrag_telefon,
        $status_id,
        $dienstleistung_id,
        $prioritaet_id
    )
    {
        $this->connectToDB();
        $sql = ' 
            CALL `spAddServiceauftrag`
            (
                :serviceauftragKundenname,
                :serviceauftragEmail  ,
                :serviceauftragTelefon,
                :statusId,
                :dienstleistungId,
                :prioritaetId
            )                
        ';

        try {
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':serviceauftragKundenname', $serviceauftrag_kundenname);
            $stmt->bindParam(':serviceauftragEmail', $serviceauftrag_email);
            $stmt->bindParam(':serviceauftragTelefon', $serviceauftrag_telefon);
            $stmt->bindParam(':statusId', $status_id, PDO::PARAM_INT);
            $stmt->bindParam(':dienstleistungId', $dienstleistung_id, PDO::PARAM_INT);
            $stmt->bindParam(':prioritaetId', $prioritaet_id, PDO::PARAM_INT);

            $stmt->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->disconectFromDB();
    }
}

$DB = new HandelDB;
