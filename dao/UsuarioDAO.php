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
        $query = "INSERT INTO usuario (nome, email, senha, crmv, cpf, clinica_id, especialidade_id) VALUES (:nome, :email, :senha, :crmv, :cpf, :clinica_id, :especialidade_id)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':nome', $usuario->getNome());
        $stmt->bindParam(':email', $usuario->getEmail());
        $stmt->bindParam(':senha', $usuario->getSenha());
        $stmt->bindParam(':crmv', $usuario->getCrmv());
        $stmt->bindParam(':cpf', $usuario->getCpf());
        $stmt->bindParam(':clinica_id', $usuario->getClinicaId());
        $stmt->bindParam(':especialidade_id', $usuario->getEspecialidadeId());
       
    
        return $stmt->execute();
    }

    public function update(Usuario $usuario, int $id): bool {
        $query = "
        UPDATE usuario SET
        nome = :nome,
        email = :email,
         senha = :senha,
        crmv = :crmv,
        cpf = :cpf,
        clinica_id = :clinica_id,
        especialidade_id = :especialidade_id
        where id = :id
        ";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':nome', $usuario->getNome());
        $stmt->bindParam(':email', $usuario->getEmail());
        $stmt->bindParam(':senha', $usuario->getSenha());
        $stmt->bindParam(':crmv', $usuario->getCrmv());
        $stmt->bindParam(':cpf', $usuario->getCpf());
        $stmt->bindParam(':clinica_id', $usuario->getClinicaId());
        $stmt->bindParam(':especialidade_id', $usuario->getEspecialidadeId());
        $stmt->bindParam(':id', $id);
    
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

    public function selectById(int $id)  {
        $query = "
        SELECT
        u.*,
        e.id as e_id,
        e.nome as e_nome,
        e.descricao as e_descricao
        from usuario u
        left join especialidade e on u.especialidade_id = e.id
        WHERE u.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result){
           return null; 
        }
        $result = Usuario::fromArray($result);
        return $result;
    }

    public function checkId($id){
    $query = "
    SELECT 1 FROM usuario WHERE id = :id
    ";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$result){
        return null;
    }

    return $result;
    }






    public function delete(Int $id) : bool{
        $query = "DELETE FROM usuario WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }


}
?>
