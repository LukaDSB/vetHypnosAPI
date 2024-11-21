<?php
class Paciente {
    private $conn;
    private $table_name = 'paciente';

    public $id;
    public $nome;
    public $especie;
    public $idade;
    public $sexo;
    public $peso;
    
    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT id, nome, especie, idade, sexo, peso FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
