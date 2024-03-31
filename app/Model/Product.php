<?php

namespace StarRole\PhpMvc\Model;
use StarRole\PhpMvc\Config\Database;

class Product{
    private $table = 'products';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll(){
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }
}