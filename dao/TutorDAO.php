<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../dto/TutorCompletoDTO.php';
require_once __DIR__ . '/../dto/ContatoDTO.php';
require_once __DIR__ . '/../entity/Tutor.php';
require_once __DIR__ . '/../entity/Contato.php';

class TutorDAO
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // public function insert(TutorDTO $tutor): bool{
    //     $this->conn->beginTransaction();
    //     try {
    //         $query = "INSERT INTO tutor (nome, cpf) VALUES (:nome, :cpf)";

    //         if ($tutor instanceof TutorCompletoDTO && $tutor->getEndereco()) {
    //             $enderecoQuery = "INSERT INTO endereco (cidade_id, rua, numero, bairro) VALUES (:cidade_id, :rua, :numero, :bairro)";
    //             $enderecoStmt = $this->conn->prepare($enderecoQuery);
    //             $cidade = $tutor->getEndereco()->getCidadeId();
    //             $cidadeId = $cidade ? $cidade->getcidadeId() : null;
    //             $enderecoStmt->bindValue(':cidade_id', $cidadeId);
    //             $enderecoStmt->bindValue(':rua', $tutor->getEndereco()->getRua());
    //             $enderecoStmt->bindValue(':numero', $tutor->getEndereco()->getNumero());
    //             $enderecoStmt->bindValue(':bairro', $tutor->getEndereco()->getBairro());
    //             $enderecoStmt->execute();
    //             $enderecoId = $this->conn->lastInsertId();

    //             $query = "INSERT INTO tutor (nome, cpf, endereco_id) VALUES (:nome, :cpf, :endereco_id)";
    //         }

    //         $stmt = $this->conn->prepare($query);
    //         $stmt->bindValue(':nome', $tutor->getNome()->getValue());
    //         $stmt->bindValue(':cpf', $tutor->getCpf()->getValue());

    //         if (isset($enderecoId)) {
    //             $stmt->bindValue(':endereco_id', $enderecoId);
    //         }

    //         $stmt->execute();
    //         $tutorId = $this->conn->lastInsertId();

    //         if ($tutor instanceof TutorCompletoDTO && !empty($tutor->getContatos())) {
    //             foreach ($tutor->getContatos() as $contato) {
    //                 $contatoQuery = "INSERT INTO contato (descricao, tipo_contato_id) VALUES (:desc, :tipo_id)";
    //                 $contatoStmt = $this->conn->prepare($contatoQuery);
    //                 $contatoStmt->bindValue(':desc', $contato->getDescricao());
    //                 $contatoStmt->bindValue(':tipo_id', $contato->getTipoContatoId());
    //                 $contatoStmt->execute();
    //                 $contatoId = $this->conn->lastInsertId();

    //                 $junctionQuery = "INSERT INTO tutor_contatos (tutor_id, contato_id) VALUES (:tutor_id, :contato_id)";
    //                 $junctionStmt = $this->conn->prepare($junctionQuery);
    //                 $junctionStmt->bindValue(':tutor_id', $tutorId);
    //                 $junctionStmt->bindValue(':contato_id', $contatoId);
    //                 $junctionStmt->execute();
    //             }
    //         }

    //         $this->conn->commit();
    //         return true;
    //     } catch (Exception $e) {
    //         $this->conn->rollBack();
    //         error_log("Erro ao inserir tutor: " . $e->getMessage());
    //         return false;
    //     }
    // }

     public function insert(TutorDTO $tutor): bool
    {
        $this->conn->beginTransaction();
        try {
            $query = "INSERT INTO tutor (nome, cpf) VALUES (:nome, :cpf)";

            if ($tutor instanceof TutorCompletoDTO && $tutor->getEndereco()) {
                $enderecoQuery = "INSERT INTO endereco (cidade_id, rua, numero, bairro) VALUES (:cidade_id, :rua, :numero, :bairro)";
                $enderecoStmt = $this->conn->prepare($enderecoQuery);
                
                $cidadeId = $tutor->getEndereco()->getCidadeId();
                $enderecoStmt->bindValue(':cidade_id', $cidadeId);
                $enderecoStmt->bindValue(':rua', $tutor->getEndereco()->getRua());
                $enderecoStmt->bindValue(':numero', $tutor->getEndereco()->getNumero());
                $enderecoStmt->bindValue(':bairro', $tutor->getEndereco()->getBairro());
                $enderecoStmt->execute();
                $enderecoId = $this->conn->lastInsertId();

                $query = "INSERT INTO tutor (nome, cpf, endereco_id) VALUES (:nome, :cpf, :endereco_id)";
            }

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':nome', $tutor->getNome()->getValue());
            $stmt->bindValue(':cpf', $tutor->getCpf()->getValue());

            if (isset($enderecoId)) {
                $stmt->bindValue(':endereco_id', $enderecoId);
            }

            $stmt->execute();
            $tutorId = $this->conn->lastInsertId();

            if ($tutor instanceof TutorCompletoDTO && !empty($tutor->getContatos())) {
                foreach ($tutor->getContatos() as $contato) {
                    $contatoQuery = "INSERT INTO contato (descricao, tipo_contato_id) VALUES (:desc, :tipo_id)";
                    $contatoStmt = $this->conn->prepare($contatoQuery);
                    $contatoStmt->bindValue(':desc', $contato->getDescricao());
                    $contatoStmt->bindValue(':tipo_id', $contato->getTipoContatoId());
                    $contatoStmt->execute();
                    $contatoId = $this->conn->lastInsertId();

                    $junctionQuery = "INSERT INTO tutor_contatos (tutor_id, contato_id) VALUES (:tutor_id, :contato_id)";
                    $junctionStmt = $this->conn->prepare($junctionQuery);
                    $junctionStmt->bindValue(':tutor_id', $tutorId);
                    $junctionStmt->bindValue(':contato_id', $contatoId);
                    $junctionStmt->execute();
                }
            }

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("Erro ao inserir tutor: " . $e->getMessage());
            return false;
        }
    }

    public function getAll(): array
    {
        $query = "
            SELECT 
                t.id AS tutor_id, t.nome AS tutor_nome, t.cpf AS tutor_cpf,
                e.id AS endereco_id, e.rua AS endereco_rua, e.numero AS endereco_numero, e.bairro AS endereco_bairro,
                ci.id AS cidade_id, ci.nome AS cidade_nome,
                es.id AS estado_id, es.nome AS estado_nome
            FROM tutor t
            LEFT JOIN endereco e ON e.id = t.endereco_id
            LEFT JOIN cidade ci ON ci.id = e.cidade_id
            LEFT JOIN estado es ON es.id = ci.estado_id
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $tutorsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($tutorsData)) {
            return [];
        }

        $tutorIds = array_column($tutorsData, 'tutor_id');
        $placeholders = implode(',', array_fill(0, count($tutorIds), '?'));

        $contatosQuery = "
            SELECT
                co.id AS contato_id_ref, co.descricao AS contato_descricao,
                tc.id AS tipo_contato_id_ref, tc.descricao AS tipo_contato_descricao,
                tc_j.tutor_id
            FROM contato co
            JOIN tutor_contatos tc_j ON co.id = tc_j.contato_id
            LEFT JOIN tipo_contato tc ON tc.id = co.tipo_contato_id
            WHERE tc_j.tutor_id IN ($placeholders)
        ";
        $contatosStmt = $this->conn->prepare($contatosQuery);
        $contatosStmt->execute($tutorIds);
        $contatosResult = $contatosStmt->fetchAll(PDO::FETCH_ASSOC);

        $contatosByTutorId = [];
        foreach ($contatosResult as $contato) {
            $contatosByTutorId[$contato['tutor_id']][] = $contato;
        }

        $result = [];
        foreach ($tutorsData as $tutorData) {
            $tutorId = $tutorData['tutor_id'];
            $tutorData['contatos'] = $contatosByTutorId[$tutorId] ?? [];
            $result[] = Tutor::fromArray($tutorData);
        }

        return $result;
    }

    public function selectById(int $id): ?Tutor
    {
        $query = "
            SELECT 
                t.id AS tutor_id, t.nome AS tutor_nome, t.cpf AS tutor_cpf,
                e.id AS endereco_id, e.rua AS endereco_rua, e.numero AS endereco_numero, e.bairro AS endereco_bairro,
                ci.id AS cidade_id, ci.nome AS cidade_nome,
                es.id AS estado_id, es.nome AS estado_nome, es.sigla AS estado_sigla
            FROM tutor t
            LEFT JOIN endereco e ON e.id = t.endereco_id
            LEFT JOIN cidade ci ON ci.id = e.cidade_id
            LEFT JOIN estado es ON es.id = ci.estado_id
            WHERE t.id = :id
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $tutorData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$tutorData) {
            return null;
        }

        $contatosQuery = "
            SELECT
                co.id AS contato_id_ref, co.descricao AS contato_descricao,
                tc.id AS tipo_contato_id_ref, tc.descricao AS tipo_contato_descricao
            FROM contato co
            JOIN tutor_contatos tc_j ON co.id = tc_j.contato_id
            LEFT JOIN tipo_contato tc ON tc.id = co.tipo_contato_id
            WHERE tc_j.tutor_id = :tutor_id
        ";
        $contatosStmt = $this->conn->prepare($contatosQuery);
        $contatosStmt->bindParam(':tutor_id', $id);
        $contatosStmt->execute();
        $contatosData = $contatosStmt->fetchAll(PDO::FETCH_ASSOC);

        $tutorData['contatos'] = $contatosData;
        return Tutor::fromArray($tutorData);
    }

    public function update($id, TutorCompletoDTO $tutor): bool
    {
        $this->conn->beginTransaction();
        try {
            $query = "UPDATE tutor SET nome = :nome, cpf = :cpf, endereco_id = :endereco_id WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':nome', $tutor->getNome()->getValue());
            $stmt->bindValue(':cpf', $tutor->getCpf()->getValue());
            $stmt->bindValue(':endereco_id', $tutor->getEnderecoId());
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            $deleteJunctionQuery = "DELETE FROM tutor_contatos WHERE tutor_id = :tutor_id";
            $deleteStmt = $this->conn->prepare($deleteJunctionQuery);
            $deleteStmt->bindValue(':tutor_id', $id);
            $deleteStmt->execute();

            foreach ($tutor->getContatos() as $contato) {
                $contatoQuery = "INSERT INTO contato (descricao, tipo_contato_id) VALUES (:desc, :tipo_id)";
                $contatoStmt = $this->conn->prepare($contatoQuery);
                $contatoStmt->bindValue(':desc', $contato->getDescricao());
                $contatoStmt->bindValue(':tipo_id', $contato->getTipoContatoId());
                $contatoStmt->execute();
                $contatoId = $this->conn->lastInsertId();

                $junctionQuery = "INSERT INTO tutor_contatos (tutor_id, contato_id) VALUES (:tutor_id, :contato_id)";
                $junctionStmt = $this->conn->prepare($junctionQuery);
                $junctionStmt->bindValue(':tutor_id', $id);
                $junctionStmt->bindValue(':contato_id', $contatoId);
                $junctionStmt->execute();
            }

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("Erro ao atualizar tutor: " . $e->getMessage());
            return false;
        }
    }

    public function delete(int $id): bool
    {
        $this->conn->beginTransaction();
        try {
            $deleteJunctionQuery = "DELETE FROM tutor_contatos WHERE tutor_id = :tutor_id";
            $deleteStmt = $this->conn->prepare($deleteJunctionQuery);
            $deleteStmt->bindValue(':tutor_id', $id);
            $deleteStmt->execute();
            
            $query = "DELETE FROM tutor WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("Erro ao deletar tutor: " . $e->getMessage());
            return false;
        }
    }

    public function checkId(int $id)
    {
        $query = "SELECT 1 FROM tutor WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}