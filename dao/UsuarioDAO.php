<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once __DIR__ . '/../config/database.php';
class UsuarioDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function insert(Usuario $user) {
        $query = "INSERT INTO usuarios (nome, especialidade, email, senha) VALUES (:nome, :especialidade, :email, :senha)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':nome', $user->getNome());
        $stmt->bindParam(':especialidade', $user->getEspecialidade());
        $stmt->bindParam(':email', $user->getEmail());
        $stmt->bindParam(':senha', $user->getSenha());
        
        return $stmt->execute();
    }

    public function getAllUsuarios(){
        $query = "SELECT * FROM usuarios";
        $stmt = $this->conn->prepare($query);
    
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return ['error' => 'Falha na consulta ao banco de dados'];
    }
}
?>
