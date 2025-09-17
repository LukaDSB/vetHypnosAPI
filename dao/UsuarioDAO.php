<?php
require_once __DIR__ . '/../dto/Usuario.php';
require_once __DIR__ . '/../config/Database.php';

class UsuarioDAO
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function insert(Usuario $usuario): bool
    {
        $query = "INSERT INTO usuario (nome, email, senha, crmv, cpf, clinica_id, especialidade_id) 
                  VALUES (:nome, :email, :senha, :crmv, :cpf, :clinica_id, :especialidade_id)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':nome', $usuario->getNome());
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->bindValue(':senha', $usuario->getSenha());
        $stmt->bindValue(':crmv', $usuario->getCrmv());
        $stmt->bindValue(':cpf', $usuario->getCpf());
        $stmt->bindValue(':clinica_id', $usuario->getClinicaId());
        $stmt->bindValue(':especialidade_id', $usuario->getEspecialidadeId());

        return $stmt->execute();
    }

    public function findByEmail(string $email)
    {
        $query = "SELECT * FROM usuario WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsuarios(): array
    {
        $query = "SELECT id, nome, email, crmv, cpf, clinica_id, especialidade_id, senha FROM usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $result[] = Usuario::fromArray($row);
        }
        return $result;
    }

    public function getUsuarioById($id): ?Usuario
    {

        $query = "
        SELECT
            u.id, u.nome, u.email, u.senha, u.crmv, u.cpf, u.clinica_id, u.especialidade_id,
            esp.id AS especialidade_id_ref, esp.nome AS especialidade_nome, esp.descricao AS especialidade_descricao,
            cl.id AS clinica_id_ref, cl.nome AS clinica_nome,
            en.id AS endereco_id_ref, en.rua AS endereco_rua, en.numero AS endereco_numero, en.bairro AS endereco_bairro,
            ci.id AS cidade_id_ref, ci.nome AS cidade_nome,
            es.id AS estado_id_ref, es.nome AS estado_nome
        FROM usuario u
        LEFT JOIN especialidade esp ON esp.id = u.especialidade_id
        LEFT JOIN clinica cl ON cl.id = u.clinica_id
        LEFT JOIN endereco en ON en.id = cl.endereco_id
        LEFT JOIN cidade ci ON ci.id = en.cidade_id
        LEFT JOIN estado es ON es.id = ci.estado_id
        WHERE u.id = :id
    ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }


        $usuario = Usuario::fromArray($row);


        if ($usuario->getClinica()) {
            $clinicaId = $usuario->getClinica()->getId();

            $contatosQuery = "
            SELECT
                co.id AS contato_id_ref, co.descricao AS contato_descricao,
                tc.id AS tipo_contato_id_ref, tc.descricao AS tipo_contato_descricao
            FROM contato co
            JOIN clinica_contatos cc ON co.id = cc.contato_id
            LEFT JOIN tipo_contato tc ON tc.id = co.tipo_contato_id
            WHERE cc.clinica_id = :clinica_id
            ";
            $contatosStmt = $this->conn->prepare($contatosQuery);
            $contatosStmt->bindValue(':clinica_id', $clinicaId);
            $contatosStmt->execute();

            $contatos = [];
            while ($contatoRow = $contatosStmt->fetch(PDO::FETCH_ASSOC)) {
                $contatos[] = Contato::fromArray($contatoRow);
            }


            $usuario->getClinica()->setContatos($contatos);
        }

        return $usuario;
    }

}