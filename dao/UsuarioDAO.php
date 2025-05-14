<?php
require_once __DIR__ . '/../dto/UsuarioDTO.php';
require_once __DIR__ . '/../config/Database.php';

class UsuarioDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function insert(Usuario $usuario): bool {
        $query = "INSERT INTO usuarios (nome, email, senha, crmv, cpf, clinica_id, especialidade_id) VALUES (:nome, :email, :senha, :crmv, :cpf, :clinica_id, :especialidade_id)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':nome', $usuario->getNome());
        $stmt->bindParam(':email', $usuario->getEmail());
        $stmt->bindParam(':senha', $usuario->getSenha());
        $stmt->bindParam(':crvm', $usuario->getCrmv());
        $stmt->bindParam(':cpf', $usuario->getCpf());
        $stmt->bindParam(':clinica_id', $usuario->getClinicaId());
        $stmt->bindParam(':especialidade_id', $usuario->getEspecialidadeId());
       
    
        return $stmt->execute();
    }
    

    public function getAllUsuarios(): array {
        $query = "
        select 
        u.*,
        e.id as e_id,
        e.nome as e_nome,
        e.descricao as e_descricao
        from usuario u
        left join especialidade e on u.especialidade_id = e.id
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Usuario::fromArray($row);
        }
        
        return $result;
    }
}
?>
