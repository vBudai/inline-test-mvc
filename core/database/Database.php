<?php

namespace database;

use database\DbConnect;

class Database
{

    private DbConnect $db;


    public function __construct()
    {
        $this->db = new DbConnect();
    }


    public function insert(string $table, array $data) : void
    {
        if($table == "" || empty($data))
            return ;

        $i = 0;
        $coll = '';
        $mask = '';
        foreach ($data as $key => $value) {
             if ($i === 0) {
                 $coll = $coll . "$key";
                 $mask = $mask . "'" . "$value" . "'";
             } else {
                 $coll = $coll . ", $key";
                 $mask = $mask . ", '" . "$value" . "'";
             }
             $i++;
        }

        $sql = "INSERT INTO $table ($coll) VALUES ($mask)";

        $query = $this->db->getConn()->prepare($sql);
        $query->execute();
    }

    public function select(string $table, array $selectedFields, array $params): bool|array
    {
        if($table == "")
            return false;

        $sql = "";
        if(empty($selectedFields))
            $sql = "SELECT * FROM $table";
        else
            $sql = "SELECT " . implode(', ', $selectedFields) . " FROM $table";

        if(!empty($params)){
            $i = 0;
            foreach ($params as $key => $value){
                if(!is_numeric($value))
                    $value = "'" . $value . "'";
                if($i === 0)
                    $sql = $sql . " WHERE $key = $value";
                else
                    $sql = $sql . " AND $key = $value";

                $i++;
            }
        }

        $query = $this->db->getConn()->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function search(string $table, array $selectedFields, string $field, string $data): bool|array
    {

        if($table == "")
            return false;

        $sql = "";
        if(empty($selectedFields))
            $sql = "SELECT * FROM $table WHERE $field LIKE '%$data%'";
        else
            $sql = "SELECT " . implode(', ', $selectedFields) . " FROM $table WHERE $field LIKE '%$data%'";
        
        $query = $this->db->getConn()->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }


}