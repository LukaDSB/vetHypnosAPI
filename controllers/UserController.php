<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';

class UserController {
    private $conn;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->user = new User($this->conn);
    }

    public function getAllUsers() {
        $stmt = $this->user->read();
        $users_arr = array();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $user_item = array(
                "id" => $id,
                "nome" => $nome,
                "especialidade" => $especialidade,
                "email" => $email
            );
            array_push($users_arr, $user_item);
        }

        http_response_code(200);
        echo json_encode($users_arr);
    }

    public function createUser($data) {
        if (empty($data['nome']) || empty($data['email']) || empty($data['senha'])) {
            http_response_code(400);
            echo json_encode(["message" => "Os campos Nome, Email e Senha são obrigatórios."]);
            return;
        }
    
        $especialidade = isset($data['especialidade']) ? $data['especialidade'] : null;
    
        $query = "INSERT INTO usuarios (nome, especialidade, email, senha) VALUES (:nome, :especialidade, :email, :senha)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':nome', $data['nome']);
        $stmt->bindParam(':especialidade', $especialidade);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':senha', $data['senha']);
    
        if ($stmt->execute()) {
            http_response_code(201);
            echo json_encode(["message" => "Usuário criado com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Erro ao criar usuário."]);
        }
    }
    

    public function updateUser($id, $data) { // Mudança de nome do parâmetro
        $this->user->id = $id;
        $this->user->nome = $data['nome']; // Mudança aqui
        $this->user->email = $data['email']; // Mudança aqui
        
        if($this->user->update()) {
            echo json_encode(["message" => "Usuário atualizado"]);
        } else {
            echo json_encode(["message" => "Erro ao atualizar usuário"]);
        }
    }

    public function deleteUser($id) {
        $this->user->id = $id;
        
        if($this->user->delete()) {
            echo json_encode(["message" => "Usuário deletado"]);
        } else {
            echo json_encode(["message" => "Erro ao deletar usuário"]);
        }
    }
}
?>
