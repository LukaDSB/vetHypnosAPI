<?php
class User {
    private $conn;
    private $table_name = 'usuarios';

    public $id;
    public $nome;
    public $especialidade;
    public $email;
    public$senha;

public function __construct($db) {
    $this->conn = $db;
}

public function read() {
    $query = "SELECT id, nome, especialidade, email FROM " . $this->table_name;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
}

public function getAllNames() {
    $query = "SELECT nome FROM usuarios";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

public function create() {
    $query = "INSERT INTO " . $this->table_name . " SET nome=:nome, email=:email";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":nome", $this->nome);
    $stmt->bindParam(":email", $this->email);
    return $stmt->execute();
}
    
public function update() {
    $query = "UPDATE " . $this->table_name . " SET nome = :nome, email = :email WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":nome", $this->nome);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":id", $this->id);
    return $stmt->execute();
}
    
public function delete() {
    $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $this->id);
    return $stmt->execute();
}
    
}
?>
