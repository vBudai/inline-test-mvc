<?php

namespace base;

use database\Database;

class BaseModel
{

    protected Database $db;
    protected string $table;

    public function __construct()
    {
        $this->db = new Database();
        $this->table = "";
    }

    public function insert(array $data) : void
    {
        $this->db->insert($this->table, $data);
    }

    public function select(array $selectedFields, array $params): bool|array
    {
        return $this->db->select($this->table, $selectedFields, $params);
    }

    public function search(array $selectedFields, string $field, string $data): bool|array
    {
        return $this->db->search($this->table, $selectedFields, $field, $data);
    }

}