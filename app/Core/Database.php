<?php

namespace App\Core;

use PDO;

class Database
{
    protected $connection = null;

    private $databaseInfo;

    private $charset = 'utf8';
    private $dsn = '';
    private $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
 
    public function __construct()
    {
        $this->databaseInfo = require $_SERVER['DOCUMENT_ROOT'].'/config/database.php';

        $this->connection = new PDO(
            "mysql:host=".$this->databaseInfo['host'].";dbname=".$this->databaseInfo['database'].";charset=".$this->databaseInfo['charset'],
            $this->databaseInfo['username'], $this->databaseInfo['password'], $this->databaseInfo['options']);
         
    }
 
    public function select($query = "" , $params = [])
    {
        try {
            $stmt = $this->executeStatement( $query , $params );
            $result = $stmt->fetchAll();
 
            return $result;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }
        return false;
    }

    public function update($query = "", $params = [])
    {
        try {
            $stmt = $this->executeStatement( $query , $params );

            return $stmt;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }
        return false;
    }

    public function delete($query = "", $params = [])
    {
        try {
            $stmt = $this->executeStatement( $query , $params );
            
            return $stmt;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }
        return false;
    }

    public function create($query = "", $params = [])
    {
        try {
            $stmt = $this->executeStatement( $query , $params );
 
            return $stmt;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }
        return false;
    }

    private function executeStatement($query = "", $params = [])
    {
        try {
            $stmt = $this->connection->prepare($query);
 
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }

            // foreach ($params as $key => $value) {                
            //     $stmt->bindParam($value);
            // }

            $stmt->execute($params);

            return $stmt;

        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }   
    }
}
